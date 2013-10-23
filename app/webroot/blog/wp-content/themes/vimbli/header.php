<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: VIMBLI :: Blog</title>
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
/*** Site Constent ***/
define('WP_SITE_URL', get_bloginfo('url'));
define('CONTACT_EMAIL', 'support@vimbli.com');
define('CAKE_SITE_URL', 'http://'.$_SERVER['HTTP_HOST']); 
/**********************/
?>
<link rel="stylesheet" href="<?php echo WP_SITE_URL; ?>/wp-content/themes/vimbli/blog.css">
<link rel="stylesheet" href="<?php echo WP_SITE_URL; ?>/wp-content/themes/vimbli/style.css">
<link rel="stylesheet" href="<?php echo WP_SITE_URL; ?>/wp-content/themes/vimbli/fontz.css">
<script src="js/jquery-latest.js"></script>
<script src="js/custom.js"></script>
<?php wp_head(); ?>
<style>
html {
    margin-top: 0px !important;
}
.wysija-submit{
    background: none repeat scroll 0 0 #1560AC;
    border-radius: 4px 4px 4px 4px;
    color: #FFFFFF !important;
    cursor: pointer;
    overflow: visible;
    padding: 3px 10px;
}
.absDiv{
        position: absolute;
        border: 1px solid red;
        top:38px;
        left: 735px;
        width: 264px;
        background-color:#FDFDFC;
        border: 1px solid #EDF3F8;
    }
</style>

<link rel="icon" href="<?php echo CAKE_SITE_URL.'/img/favicon_vimbli.ico'; ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo CAKE_SITE_URL.'/img/favicon_vimbli.ico'; ?>" type="image/x-icon" />

<!--Google Analytics script :: Start-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-44602439-1', 'vimbli.com');
  ga('send', 'pageview');

</script>
<!--Google Analytics script :: End-->

<!--Freshdesk script :: Start-->
<script type="text/javascript" src="http://assets.freshdesk.com/widget/freshwidget.js"></script>
<style type="text/css" media="screen, projection">
	@import url(http://assets.freshdesk.com/widget/freshwidget.css); 
</style> 
<script type="text/javascript">
	FreshWidget.init("", {"queryString": "&widgetType=popup&formTitle=Vimbli+%3A%3A+Help+%26+Support", "widgetType": "popup", "buttonText": "Feedback & Support", "buttonColor": "#1560AC", "buttonBg": "#FEAF00", "backgroundImage": "", "alignment": "2", "offset": "56%", "formHeight": "500px", "url": "http://vimbli.freshdesk.com"} );
</script>
<!--Freshdesk script :: End-->

</head>
<body class="inner_body">
<!--100 Percent Width Header Outer Wrapper Starts-->
<section id=header-wrap>
    <!--Center Align Main Header Starts-->
    <header id=header style="position: relative;">
         <!--Left Header Include Logo-->
         <h1 class=logo title=Vimbli><a href="<?php echo CAKE_SITE_URL; ?>">Vimbli</a></h1>
         <!--Right Header Main Navigation Starts-->
         <nav id=main-nav>
             <ul class=topnav>
                 <li><a href="<?php echo CAKE_SITE_URL.'/pages/why_sos'; ?>">WHY SOS?</a></li>
                 <li><a href="<?php echo CAKE_SITE_URL.'/pages/about_us'; ?>">About</a></li>
		 <li><a href="<?php echo WP_SITE_URL; ?>">Blog</a></li>
                 <li><a href="mailto:<?php echo CONTACT_EMAIL; ?>">Contact</a></li>
                 <li><a href="<?php echo CAKE_SITE_URL.'/users/login'; ?>">Login</a></li>
                 <li class=signup><a href="<?php echo CAKE_SITE_URL.'/users/sing_up'; ?>">Sign Up<img src="<?php echo WP_SITE_URL; ?>/wp-content/themes/vimbli/images/signup_arrow_top_right.png" alt="" /></a></li>
             </ul>
	 </nav>
         <!--Right Header Main Navigation End-->
	 
	<!-- absolute infobox:: Start -->
	<!--<div class="absDiv">
	    <a href="mailto:support@vimbli.com" style="color: #FFBF00; font-size: 16px; float: left; padding: 5px 10px 5px 10px; text-decoration:none;">
		Always in Beta ... Give Feedback!
	    </a>
	</div>-->
	<!-- absolute infobox:: End --> 
	 
    </header>
    <!--Center Align Main Header End-->
</section>
<!--100 Percent Width Header Outer Wrapper End--> 