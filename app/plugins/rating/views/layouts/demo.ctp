<?php
/**
 * Layout for the rating plugin demo.
 *
 * @author Michael Schneidt <michael.schneidt@arcor.de>
 * @copyright Copyright 2009, Michael Schneidt
 * @license http://www.opensource.org/licenses/mit-license.php
 * @link http://bakery.cakephp.org/articles/view/ajax-star-rating-plugin-1
 * @version 2.5
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Rating plugin v2.5 DEMO</title>
  <?php echo $javascript->link('../rating/js/demo/jquery-1.4.2.min'); ?>
  <?php echo $javascript->link('../rating/js/rating_jquery_min'); ?>
  <?php //echo $javascript->link('../rating/js/demo/protoaculous1.6.packed.js'); ?>
  <?php //echo $javascript->link('../rating/js/rating_prototype_min'); ?>
    
  <?php echo $html->css('/rating/css/rating'); ?>
</head>
<body>
  <?php echo $content_for_layout; ?>
</body>
</html>