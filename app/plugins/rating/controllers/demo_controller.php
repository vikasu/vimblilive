<?php
/**
 * Controller for the rating plugin demo.
 *
 * @author Michael Schneidt <michael.schneidt@arcor.de>
 * @copyright Copyright 2009, Michael Schneidt
 * @license http://www.opensource.org/licenses/mit-license.php
 * @link http://bakery.cakephp.org/articles/view/ajax-star-rating-plugin-1
 * @version 2.5
 */
class DemoController extends RatingAppController {
  var $uses = array('Rating.Rating', 'Foobar');
  
  /**
   * Demo page.
   */
  function index() {
    $this->layout = 'demo';

    $foobar = $this->Foobar->find('first');
    
    // create demo model data
    if (empty($foobar)) {
      $foobar = $this->Foobar->create();
      
      $foobar['Foobar']['id'] = String::uuid();
      $foobar['Foobar']['user_id'] = String::uuid();
      $foobar = $this->Foobar->save($foobar);
    }
    
    $this->set('foobar', $foobar);
  }
  
  /**
   * Demo login.
   */
  function login() {
    if (!$this->Session->check('User.id') && !$this->Cookie->read('User.id')) {
      App::import('Core', 'String');
      $uuid = String::uuid();
      
      $this->Session->write('User.id', $uuid);
      $this->Cookie->write('User.id', $uuid);
      
      $this->Cookie->delete('Rating.guest_id');
      $this->Session->delete('Rating.guest_id');
    } else if ($this->Cookie->read('User.id')) {
      $this->Session->write('User.id', $this->Cookie->read('User.id'));
    }
    
    $this->redirect('/rating/demo');
    $this->autoRender = false;
  }
  
  /**
   * Demo logout.
   */
  function logout() {
    $this->Cookie->delete('User.id');
    $this->Session->delete('User.id');
    
    $this->redirect('/rating/demo');
    $this->autoRender = false;
  }
}
?>