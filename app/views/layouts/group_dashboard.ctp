<!DOCTYPE HTML>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title><?php echo 'Vimbli :: '.$pagetitle; ?></title>
  <style>
    .sub_page_contents { padding:120px 34px 17px 79px!important; }
  </style>
  <!--[if lt IE 9]>
  <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php
    echo $this->Html->meta('icon', $this->Html->url('/img/favicon_vimbli.ico'));
    echo $this->Html->css('style');
    echo $this->Html->css('fontz');
    echo $this->Html->css('scrollbar');
    echo $this->Html->css('jqtransform');
    echo $this->Html->script('jquery-1.7.2.min');
    echo $this->Html->script('jquery.tinyscrollbar.min');
        
    echo $this->Html->css('validationEngine.jquery');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine-en.js');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine.js');
    echo $this->Html->script('jquery.jqtransform');
    echo $this->Html->script('custom');
    echo $this->Html->script('jquery-ui');
    echo $this->Html->css('jquery-ui-1.9.2.custom');
  ?>
  
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
<section id=header-wrap style="background:url('../img/inner_header_bg.png') repeat-x scroll left bottom transparent; height:44px;">
  <!-- Top menu :: Begin -->
    <?php echo $this->element("dashboard/group_header"); ?>
  <!-- Top menu :: End -->
</section>
<!--100 Percent Width Header Outer Wrapper End-->
<!--Main Content Starts-->
<section id=content-wrap>
  
    <?php echo $content_for_layout; ?>
  
</section>
<!--Center Align Mid Work With Otherz Sign Up Section End-->
<?php //echo $this->element("home_layout/footer"); ?>

<?php echo $this->element("dashboard/group_footer"); ?>

</body>
</html>