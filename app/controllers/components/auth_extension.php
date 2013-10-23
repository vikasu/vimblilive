<?php 
/**
 * Extends the functionality of AuthComponent to include 'remember me' functionality - the user
 * is remembered for 2 weeks even if the normal Cake session expires.
 * Based on http://www.webdevelopment2.com/cakephp-auth-component-tutorial-3/ - but evolved 
 * considerably :D
 * - the password is not stored in the cookie
 * - instead, a hash of (password + secret string) is stored (the hash is generated using the 
 * application's Salt) - so a password change renders the cookie invalid
 * - together with the username
 * - and the current time (so the cookie is not valid after two weeks even it is stil present in the
 * browser through some hack)
 * - and a hash of all these values (the hash is generated using the Security salt) so any change of
 * one variable can be detected
 * 
 * Assumptions:
 * - that your users' model is called User
 * - the field that stores the username is called username
 * - the field that stores the password is called password
 * 
 * 1) in AppController
 * - include Cookie, Auth, AuthExtension (in this order)
 * - in the constructor set 
 *         $this->Auth->autoRedirect = false;
 * 
 * 2) in your users controller
 *     function login() {
        $this->AuthExtension->checkRememberMe();
    }
    
    function logout() {
        $this->AuthExtension->logout();
        $this->Auth->logout();
        $this->redirect('/');    
    }
 * 
 * 3) in the login form add a field
    echo $form->input('remember_me', array('label' => 'remember me on this site', 'type' => 'checkbox'));
 * 
 */
class AuthExtensionComponent extends Object {
    const cookie_name = 'preferences'; // deceiving name :D
    const cookie_name1 = 'userEmail'; // deceiving name :D
    const cookie_expire_string = '+2 weeks';
    const cookie_expire_seconds = 1209600; //2 * 7 * 24 * 60 * 60;
    
    var $controller = null;
    
    function initialize(&$controller) {
        $this->controller = $controller;
        if ($controller->Auth->user())
        {
            // already authenticated
            return;
        }
        $cookie = $controller->Cookie->read(AuthExtensionComponent::cookie_name);
        if (!$cookie) {
            return;
        }
        
        $all_fields = isset($cookie['username']) && isset($cookie['hash1'])
             && isset($cookie['time']) && isset($cookie['hash']); 

        // all fields present?
        if (!$all_fields) {
            $this->logout();
            return;
        }
        // global hash correct?
        if (Security::hash($cookie['username'] . $cookie['hash1'] . $cookie['time']) 
            !== $cookie['hash'])
        {
            $this->logout();
            return;
        }
        
         if((time() - $cookie['time']) > AuthExtensionComponent::cookie_expire_seconds)
         {
            $this->logout();
            return;
         }
        
        // find the user
        App::import('Model', 'User');
         $User = new User();
        $u = $User->findByUsername($cookie['username']);
        if (!$u) {
            $this->logout();
            return;
        }
        
        if (Security::hash($u['User']['password'] . 'another random string', null, true) 
            === $cookie['hash1']) {
            // user confirmed
            $login_array = array('User' => array(
                'username' => $u['User']['username'],
                'password' => $u['User']['password']));
            $u = null;
            
            if ($controller->Auth->login($login_array)) {
                //  Clear auth message, just in case we use it.
                $controller->Session->del('Message.auth');
                $controller->redirect($controller->Auth->redirect());
            } else { // Delete invalid Cookie
                $this->logout();
            }
        } else {
            $u = null;        
        }
    }
    
    function checkRememberMe() {
        // Auth->autoRedirect must be set to false (i.e. in a beforeFilter) for this to work
        $auth_user = $this->controller->Auth->user();
        if ($auth_user)
        {
            
            //echo "<pre>";print_r($auth_user);exit;
            if (!empty($this->controller->data) && $this->controller->data['User']['remember_me']) {
                $u = $this->controller->User->findById($auth_user['User']['id']);
                
                $cookie = array();
                $cookie['username'] = $u['User']['username'];
                $cookie['hash1'] = Security::hash(
                    $u['User']['password'] . 'another random string', null, true);
                $cookie['time'] = time();
                $cookie['hash'] = Security::hash(
                $cookie['username'] . $cookie['hash1'] . $cookie['time']);
                
                $this->controller->Cookie->write('userEmail',$cookie['email']);
                
                $this->controller->Cookie->write('preferences', $cookie, true, 
                    AuthExtensionComponent::cookie_expire_string);
                unset($this->controller->data['User']['remember_me']);
                $u = null;
            }
            
            elseif (!empty($this->controller->data) && $this->controller->data['Admin']['remember_me']) {
                $u = $this->controller->Admin->findById($auth_user['Admin']['id']);
                $cookie = array();
                $cookie['username'] = $u['Admin']['username'];
                $cookie['hash1'] = Security::hash(
                    $u['Admin']['password'] . 'another random string', null, true);
                $cookie['time'] = time();
                $cookie['hash'] = Security::hash(
                $cookie['username'] . $cookie['hash1'] . $cookie['time']);
                
                $this->controller->Cookie->write('userid',$u['Admin']['id']);
                $this->controller->Cookie->write('userEmail',$cookie['email']);
                $this->controller->Cookie->write('preferences', $cookie, true, 
                    AuthExtensionComponent::cookie_expire_string);
                unset($this->controller->data['Admin']['remember_me']);
                $u = null;
            }
            else {
                // if there is a cookie, it's not good (the user would not have used the login form)
                $this->logout();
            }
            $this->controller->redirect($this->controller->Auth->redirect());
            return;
        }
    }
    
    function logout()
    {
        $this->controller->Cookie->delete(AuthExtensionComponent::cookie_name);
        $this->controller->Cookie->delete(AuthExtensionComponent::cookie_name1);
    }
}
?>