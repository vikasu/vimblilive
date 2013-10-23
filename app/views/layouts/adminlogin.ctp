<?php echo $html->docType('xhtml-trans'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <?php echo $html->charset('utf-8'); ?>
      <?php echo $html->meta('icon', '/icon.ico'); ?>
      <title><?php echo 'Vimbli :: '.$pagetitle ?></title>
<?php e($html->css(array('admin/style'))); ?>
    <?php echo $javascript->link(array('jquery-1.7.2.min'));?>
    </head>
    
    <body>
	  <?php if($session->check('Message.flash')){ ?>
	    <div class='flash'>
		<?php echo $session->flash();?>
	    </div>
	  <?php } ?>
	  <?php e($content_for_layout); ?>
    </body>

<?php echo $this->element('sql_dump');?>
</html>