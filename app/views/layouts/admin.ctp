<?php echo $html->docType('xhtml-trans'); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
    <?php echo $html->charset('utf-8'); ?>
    <?php echo $html->meta('icon', '/icon.ico'); ?>
    <title><?php echo 'Vimbli :: '.$pagetitle; ?></title>
    <?php echo $this->Html->css('admin'); ?>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <?php echo $this->Html->script(array('jquery-1.7.2.min','general'));?>
    <link href="chrome://webdeveloper/content/stylesheets/outline_frames.css" id="webdeveloper-outline-frames" rel="stylesheet" type="text/css">
</head>
<body class="bodygrey">

<div id="popupWindow"></div>

    
    <div id="cboxOverlay" style="display: none;"></div>
    <div id="colorbox" class="" style="padding-bottom: 20px; padding-right: 0px; display: none;">
	<div id="cboxWrapper"><div>
	<div id="cboxTopLeft" style="float: left;"></div>
	<div id="cboxTopCenter" style="float: left;"></div>
	<div id="cboxTopRight" style="float: left;"></div>
    </div>
	
    <div style="clear: left;">
	<div id="cboxMiddleLeft" style="float: left;"></div>
	<div id="cboxContent" style="float: left;">
	    <div id="cboxLoadedContent" style="width: 0pt; height: 0pt; overflow: hidden; float: left;"></div>
	    <div id="cboxLoadingOverlay" style="float: left;"></div>
	    <div id="cboxLoadingGraphic" style="float: left;"></div>
	    <div id="cboxTitle" style="float: left;"></div>
	    <div id="cboxCurrent" style="float: left;"></div>
	    <div id="cboxNext" style="float: left;"></div>
	    <div id="cboxPrevious" style="float: left;"></div>
	    <div id="cboxSlideshow" style="float: left;"></div>
	    <div id="cboxClose" style="float: left;"></div>
	</div>
	<div id="cboxMiddleRight" style="float: left;"></div>
    </div>
    
    <div style="clear: left;">
	<div id="cboxBottomLeft" style="float: left;"></div>
	<div id="cboxBottomCenter" style="float: left;"></div>
	<div id="cboxBottomRight" style="float: left;"></div>
    </div>

    </div>
	<div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div>
    </div>
    
<div class="headerspace"></div>

<?php echo $this->element("adminLayout/header"); ?>

<?php echo $this->element("adminLayout/sidebar"); ?>


<div class="maincontent">
    <?php echo $content_for_layout; ?>          

    <br clear="all"> 
</div><!--maincontent-->
 
<?php  echo $this->element("adminLayout/footer"); ?>
<!--Overlay-->
<section class="overlay"></section>
</body></html>