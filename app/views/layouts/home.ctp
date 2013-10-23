<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- <meta name="google-translate-customization" content="7911a044d95ad279-b983b63e080687e8-g6b17ea85654d7a9c-a"></meta> -->
<title><?php echo $pagetitle; ?></title>
<?php
    //echo $this->Html->meta('icon', $this->Html->url('/img/favicon_vimbli.ico'));
    echo $this->Html->css('tcss/style');
    echo $this->Html->script(array('jquery-1.7.2.min','tjs/custom'));
    //echo $javascript->link(array('validate/jquery.validate.js'));
    echo $javascript->link(array('frontend.js'));
?>
<!--[if IE 9]>
<?php echo $this->Html->css('tcss/ie_style'); ?>
<![endif]-->
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>

<div id="popupWindow"></div>
<!--Main Starts-->
<section id="main"> 
    <!--Header Start-->   
    <header>
    	<?php echo $this->element("tlayout/header"); ?>
    </header>
    <!--Header Closed-->  
    
    <!--Menu Start-->
    <section class="hot_products_wrap">
    	<?php echo $this->element("tlayout/menu"); ?>
    </section>
    <!--Menu Start-->
    
    <!--Content Start-->
    <section id="content">
	<?php echo $content_for_layout; ?>
    </section>
    <!--Content Closed-->
    
    <!--Footer Start-->
    <footer>
    	<?php echo $this->element("tlayout/footer"); ?>
    </footer>
    <!--Footer Closed-->
             
</section>

<section class="overlay">
    <span class="ajaxicon"><?php echo $this->Html->image('icons/small/white/ajax.gif', array('alt'=>"Loading", 'title'=>"Loading") ); ?></span>
</section>

<!--Main Ends--> 
<?php echo $this->element('sql_dump');?>
</body>
</html>