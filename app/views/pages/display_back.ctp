<!DOCTYPE html>
<html>
  <style>
  .sub_page_contents { padding:120px 34px 17px 79px!important; }
  </style>
<?php echo $this->element("home_layout/header"); ?>
<body>
<!--100 Percent Width Header Outer Wrapper Starts-->
<section id=header-wrap>
  <?php echo $this->element("home_layout/menu"); ?>  
</section>
<!--100 Percent Width Header Outer Wrapper End--> 
<!--100 Percent Width Banner Outer Wrapper Starts-->
<section id=banner-wrap >
    <!--Center Align Main Banner Starts-->
    <div class="sub_page_contents">
    <?php echo $page_contents['Page']['content']; ?>
    </div>
    <!--Center Align Main Banner End-->
</section>
<!--100 Percent Width Banner Outer Wrapper End--> 
<!--Center Align Mid Work With Otherz Sign Up Section Starts-->
<section class=signup-mid>
    <span>Work with others to get there faster</span>
    <div class=blubtn-big>
	<?php echo $this->Html->link('<input type="button" value="Sign-up" />', array('controller'=>'users', 'action'=>'registration'), array('escape'=>false)); ?>
             </div>
</section>
<!--Center Align Mid Work With Otherz Sign Up Section End-->
<?php echo $this->element("home_layout/footer");
echo $this->element('sql_dump'); ?> 
</body>
</html>