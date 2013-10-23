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
  <?php /*
    echo $this->Html->css('style');
    echo $this->Html->css('fontz');
    echo $this->Html->css('scrollbar');
    echo $this->Html->script('jquery-1.7.2.min');
    echo $this->Html->script('jquery.tinyscrollbar.min');
    echo $this->Html->script('jquery.jqtransform');
    echo $this->Html->css('jqtransform');
    
    echo $this->Html->css('validationEngine.jquery');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine-en.js');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine.js');
    
   echo $this->Html->script('jquery-ui');
   echo $this->Html->script('jquery-ui.css');
   echo $this->Html->script('custom');
   echo $this->Html->css('jquery-ui-1.9.2.custom');
      */
  ?>
   <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    

</head>

<body class="inner_body">
<!--Main Content Starts-->
<section id=content-wrap>
  
    <?php echo $content_for_layout; ?>
  
</section>
</body>
</html>