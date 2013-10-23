<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>
    	<?php if(isset($title_for_layout))
    		{
    			echo $title_for_layout;
    		}
    		else
    		{
    			echo "Vimbli";
    		} 
    		?>
    </title>
    <meta name="Description" content="<?php if(isset($pageDesc)){echo $pageDesc;}else{echo "FLO360 Description";} ?>" />
    <meta name="Keywords" content="<?php if(isset($pageKeyword)){echo $pageKeyword;}else{echo "FLO360";} ?>" />

<link rel="stylesheet" href="/css/style.css" type="text/css" />
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  

<script type="text/javascript" src="/js/slides.min.jquery.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	//jQuery.noConflict();
	jQuery('#slides,#slides_two,#slides_three').slides({
		preload: true,
		generateNextPrev: true,
		play: 3000
	});
});
</script>

</head>

<body>
<div class="container">
    <?php echo $this->element("user_header");?>
    
    <section class="nav_botbg">
       
	<?php echo $content_for_layout;?>
        
    </section>
    
     <?php echo $this->element("page_footer");?>
</div>

<?php echo $this->element('sql_dump'); ?>
</body>
</html>
