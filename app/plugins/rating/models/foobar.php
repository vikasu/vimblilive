<?php
/**
 * Model for the rating plugin demo.
 *
 * @author Michael Schneidt <michael.schneidt@arcor.de>
 * @copyright Copyright 2009, Michael Schneidt
 * @license http://www.opensource.org/licenses/mit-license.php
 * @link http://bakery.cakephp.org/articles/view/ajax-star-rating-plugin-1
 * @version 2.5
 */
class Foobar extends AppModel {
  var $name = 'Foobar';
  
  var $hasMany = array(
      'Rating' => array(
          'className'   => 'Rating',
          'foreignKey'  => 'model_id',
          'conditions' => array('Rating.model' => 'Foobar'),
          'dependent'   => true,
          'exclusive'   => true
      )
  );
}
?>