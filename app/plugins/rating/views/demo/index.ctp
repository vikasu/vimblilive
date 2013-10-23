<?php
/**
 * View for the rating plugin demo.
 *
 * @author Michael Schneidt <michael.schneidt@arcor.de>
 * @copyright Copyright 2009, Michael Schneidt
 * @license http://www.opensource.org/licenses/mit-license.php
 * @link http://bakery.cakephp.org/articles/view/ajax-star-rating-plugin-1
 * @version 2.5
 */
?>

<h1 style="display:inline">Rating plugin v2.5</h1>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="display:inline">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="8711411">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="">
<img alt="" border="0" src="https://www.paypal.com/de_DE/i/scr/pixel.gif" width="1" height="1">
</form>
<h3>Demo for CakePHP v1.3.0</h3>
<h5>[one-time / guest rating / user rating mark / flash message]</h5>
<?php
  echo $this->element('rating', array(
      'plugin' => 'rating',
      'model' => 'Foobar',
      'id' => $foobar['Foobar']['id']
  ));
?>
<h5>[one-time / mouseover messages / login link / fallback flash]</h5>
<?php
  echo $this->element('rating', array(
      'plugin' => 'rating',
      'model' => 'Foobar',
      'id' => $foobar['Foobar']['id'],
      'name' => 'demo1',
      'config' => array(
          'Rating.flash' => false,
          'Rating.fallbackFlash' => true,
          'Rating.guest' => false,
          'Rating.showUserRatingMark' => false,
          'Rating.showMouseOverMessages' => true,
          'Rating.mouseOverMessages' => array(
              'login' => __('Please <a href="demo/login">login</a> to rate', true))
      )
  ));
?>
<h5>[changeable / 10 stars / user rating stars]</h5>
<?php
  echo $this->element('rating', array(
      'plugin' => 'rating',
      'model' => 'Foobar',
      'id' => $foobar['Foobar']['id'],
      'name' => 'demo2',
      'config' => array(
          'Rating.flash' => false,
          'Rating.guest' => false,
          'Rating.maxRating' => 10,
          'Rating.allowChange' => true,
          'Rating.showUserRatingStars' => true,
          'Rating.showUserRatingMark' => false
      )
  ));
?>
<h5>[deletable / mouseover messages / changed status text]</h5>
<?php
  echo $this->element('rating', array(
      'plugin' => 'rating',
      'model' => 'Foobar',
      'id' => $foobar['Foobar']['id'],
      'name' => 'demo3',
      'config' => array(
          'Rating.flash' => false,
          'Rating.guest' => false,
          'Rating.allowChange' => true,
          'Rating.allowDelete' => true,
          'Rating.statusText' => '%AVG% average from %VOTES%',
          'Rating.showMouseOverMessages' => true)
  ));
?>
<br/>
<h4>
<?php
  if ($session->read(Configure::read('Rating.sessionUserId'))) {
    echo 'Your are logged in. ('.$session->read(Configure::read('Rating.sessionUserId')).')';
  } else {
    echo 'Your are guest. ('.$session->read('Rating.guest_id').')';
  }
?>
</h4>
<?php
  if ($session->read(Configure::read('Rating.sessionUserId'))) {
    echo $form->create('', array('action' => 'logout', 
                                 'type' => 'link'));
    echo $form->submit('Logout');
    echo $form->end();
  } else {
    echo $form->create('', array('action' => 'login', 
                                 'type' => 'link'));
    echo $form->submit('Login');
    echo $form->end();
  }
?>