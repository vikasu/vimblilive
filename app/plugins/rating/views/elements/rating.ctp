<?php
/**
 * Element for the rating plugin.
 *
 * @author Michael Schneidt <michael.schneidt@arcor.de>
 * @copyright Copyright 2009, Michael Schneidt
 * @license http://www.opensource.org/licenses/mit-license.php
 * @link http://bakery.cakephp.org/articles/view/ajax-star-rating-plugin-1
 * @version 2.5
 */
?>

<?php
  // default name
  if (empty($name)) {
    $name = 'default';
  }
  
  // default config
  if (empty($config)) {
    $config = 'plugin_rating';
  }
  
    // store overloaded config settings
  if (is_array($config)) {
    $key = current(array_keys($config));
    
    if (preg_match('/Rating\./', $key)) {
      Configure::write($model.$name.$id.'RatingConfig', $config);
      $config = 'plugin_rating';
    } else {
      Configure::write($model.$name.$id.'RatingConfig', $config[$key]);
      $config = $key;
    }
  }
?>

<div id="<?php echo $model.'_rating_'.$name.'_'.$id; ?>" class="rating">
  <?php
    echo $this->requestAction('rating/ratings/view/'.$model.'/'.$id.'/'.base64_encode(json_encode(array('name' => $name, 'config' => $config))), array('return'));
  ?>
</div>