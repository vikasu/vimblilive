<?php
ob_start();
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/*
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/957/The-App-Controller
 */

class AppController extends Controller {

    var $helpers =array('Form','Html','Javascript','Ajax','Session','BreadcrumbDiv');
    var $components =array('RequestHandler','Session','Cookie','Auth');
    var $uses =array('User');
    //Pages that do not require Admin authentication
    var $nonLoginActions = array('admin_login');
   
    var $rec_limit_in_admin = 20;
	  
    function beforeFilter() {
	ini_set('max_execution_time', '600');

	$this->Auth->allowedActions = array('admin_login','_checkAuth', 'display', 'sign_up','display_faq');
    	$this->_checkAuth();
	
	if(!empty($this->params['admin'])) {
	    $LoggedInUserinfo = $this->Auth->user();
	    $this->set('LoggedInUserinfo',$LoggedInUserinfo);
        } else {
	    if($this->Auth->user()) {
	       // $this->isAuthorized();
	    }
        }
	
	if(@$_SESSION['Auth']['User']['id'] != ""){
	$loginUserInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id'])));
	$this->set(compact('loginUserInfo'));
	}
    }
    
    
    
    
    function isAuthorized() {
	
    }
    
    
    function _checkAuth() {
	// Setup the field for auth        		
        if(!empty($this->params['admin'])) {
	   
	    //Condition for logout the front User
	    if($this->Auth->user('role')=="") {
		$this->Auth->logout();
	    }
	   
	    $this->Auth->userModel = 'Admin';
	    $this->Auth->userScope = array('Admin.status' => 1);
            
	    $this->Auth->fields = array(
            	'username' => 'email',
            	'password' => 'password'
            );
	   
	    $this->Auth->loginAction = array(
              	'controller' => 'admins',
              	'action'     => 'login',
              	'admin'=> true			
            );
             
            $this->Auth->loginRedirect = array( 
                'controller' => 'admins',
                'action' => 'dashboard' ,
              	'admin'=> true
            );
            
	    // Where the auth will redirect user after logout
            $this->Auth->logoutRedirect = array(
              	'controller' => 'admins',
              	'action'     => 'login',
		'admin' => true
	    );
	
	}
	else { 
	    //Condition for logout the Admin User
	    if($this->Auth->user('role')=='Admin') {
		$this->Auth->logout();
	    }
	   
	    //pr($this->Auth->user);exit;
	    $this->Auth->userModel = 'User';
	    $this->Auth->userScope = array('User.user_type' => $this->data['User']['user_type']);
	        $this->Auth->fields = array(
	            'username' => 'email',
	            'password' => 'password'
	    );

	    $this->Auth->loginAction = array(
                'controller' => 'users',
                'action' => 'login'
            ); 
            
	    $this->Auth->loginRedirect = array( 
                'controller' => 'users',
                'action' => 'welcome' 
            ); 
            
	    // Where the auth will redirect user after logout
            $this->Auth->logoutRedirect = array(
              	'controller' => 'users',
              	'action'     => 'login'		
            );
        }
        // Set to off since we do something inside login
        $this->Auth->autoRedirect = false;
        // Set the type of authorization
    }
    
    
    /* Function for the change Status field in the database */
    function setStatus($status=null,$CheckedList,$model,$relation,$controller,$action,$prefix,$Flashname)
    {
	/*** start search plural name of  $Flashname **/
	$lowerFlashName=strtolower($Flashname);
	$replaceFlashName =array("category"); 
	if(in_array($lowerFlashName,$replaceFlashName)) {
	    $countFlashName=strlen($Flashname); 
	}
	/**** end search plural name of  $Flashname *********/
	
	$counter=0;
	$viewlist='';
	if($status == '1') {			
	    if(count($CheckedList)<1) {
		$this->Session->setFlash('No Record Selected','message/yellow');	
		$this->redirect(array("controller" =>$controller , "action" => $action));
	    } else {
		for($i=0; $i<count($CheckedList); $i++) {
		    if(!empty($relation)) {
			$this->$model->$relation->id = $CheckedList[$i]; 
			$this->$model->$relation->saveField('status', '1');
			$counter++;
		    } else {
			$this->$model->id = $CheckedList[$i];
			$this->$model->saveField('status', '1');
			$counter++;
		    } 
		} 
		
		if($counter == 1) {
		    $viewlist=$Flashname." ";
		} else {
		    if(in_array($lowerFlashName,$replaceFlashName)) {
			$Flashname=substr($Flashname,0,$countFlashName-1);
			$viewlist=$Flashname."ies ";
		    } else {
			$viewlist=$Flashname."s ";
		    } 
		}
		$this->Session->setFlash($viewlist.'has been activated successfully','message/green');
		if(!empty($prefix)) {
		    $this->redirect(array("controller" =>$controller,"action" =>$action ,'prefix'=>$prefix));
		} else {
		    $this->redirect(array("controller" =>$controller,"action" =>$action ));
		}
	    }
	} else if($status == '0') {
	    if(count($CheckedList)<1) {
		$this->Session->setFlash('No Record Selected','message/yellow');	
		$this->redirect(array("controller" =>$controller , "action" => $action));
	    } else {
		for($i=0; $i<count($CheckedList); $i++) {   
		    if(!empty($relation)) {
			$this->$model->$relation->id = $CheckedList[$i]; 
			$this->$model->$relation->saveField('status', '0');
			$counter++;
		    } else {
			$this->$model->id = $CheckedList[$i]; 
			$this->$model->saveField('status', '0');
			$counter++;
		    }
		}
		
		if($counter == 1) {
		    $viewlist = $Flashname." ";
		} else {
		    if(in_array($lowerFlashName,$replaceFlashName)) {
			$Flashname=substr($Flashname,0,$countFlashName-1);
			$viewlist=$Flashname."ies ";
		    } else {
			$viewlist=$Flashname."s ";
		    }
		}
		
		$this->Session->setFlash($viewlist.'has been Deactivated successfully','message/green');	
		
		if(!empty($prefix)) {
		    $this->redirect(array("controller" =>$controller,"action" =>$action ,'prefix'=>$prefix));
		} else {
		    $this->redirect(array("controller" =>$controller,"action" =>$action ));
		}
	    }
      } else {
	if(count($CheckedList)<1) {
	    $this->Session->setFlash('No Record Selected','message/yellow');	
	    $this->redirect(array("controller" =>$controller , "action" => $action));
	} else {
	    $this->Session->setFlash('invalid request','message/yellow');	
	    $this->redirect(array("controller" =>$controller , "action" => $action));
	}
      }
    }
    
    function getStatus(){
		$statusArr = array(
			'Active' => 'Active',
			'Deactive' => 'Inactive'
		);
		return $statusArr;
    }
    
    //Function to generate random string
    function random_gen($length)
    {
      $random= "";
      srand((double)microtime()*1000000);
      $char_list = "ABCDEFGHJKLMNPQRSTUVWXYZ";
      $char_list .= "abcdefghijkmnpqrstuvwxyz";
      $char_list .= "123456789";
      $char_list .= "_$";
      // Add the special characters to $char_list if needed
    
      for($i = 0; $i < $length; $i++)  
      {    
	 $random .= substr($char_list,(rand()%(strlen($char_list))), 1);  
      }  
      return $random;
    }
    
    


      
}