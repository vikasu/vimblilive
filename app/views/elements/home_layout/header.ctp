<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo $this->Html->meta('icon', $this->Html->url('/img/favicon_vimbli.ico')); ?>
<title>:: VIMBLI ::</title>
<!--[if lt IE 9]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
echo $this->Html->css('style');
echo $this->Html->css('global');
echo $this->Html->css('fontz');
echo $this->Html->script('jquery-latest');
echo $this->Html->script('jquery.tinyscrollbar.min');
echo $this->Html->script('custom');
echo $this->Html->script('slides.min.jquery');
echo $this->Html->script('jquery.jqtransform');
echo $this->Html->css('jqtransform');
    
echo $javascript->link('/rating/js/rating_jquery');
echo $html->css('/rating/css/rating');
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

<script>
		$(function(){
			$('#slides').slides({
				preload: true,
				preloadImage: '<?php echo SITE_URL ?>img/slider-img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.caption').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.caption').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.caption').animate({
						bottom:0
					},200);
				}
			});
		});
</script>
    
</head>