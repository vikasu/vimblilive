<!DOCTYPE html>
<html>
<?php echo $this->element("home_layout/header"); ?>
<body>
<!--100 Percent Width Header Outer Wrapper Starts-->
<section id=header-wrap>
      <?php echo $this->element("home_layout/menu"); ?> 
</section>
<!--100 Percent Width Header Outer Wrapper End--> 
<!--100 Percent Width Banner Outer Wrapper Starts-->
<section id=banner-wrap>
    <!--Center Align Main Banner Starts-->
    <figure id=banner>
         <!--Slider Arrow Prev-->
         <a href="#" class="banner-arrowprev">Prev</a>
         <!--Slider Arrow Next-->
         <a href="#" class="banner-arrownext">Next</a>
         <!--Slider Title With Caption, Button Starts-->
         <section class=slidercap>
              <h4>Use the most of the tools<br /> you have better</h4>
              <span>Unlock the value of your calendar,<br /> address book and email.</span>
              <p><div class=banner-btn><input type="button" value="How?" /><?php echo $this->Html->image('banner_btn_arrow.png', array('SignUp' => 'CakePHP','class'=>'bnnrbtn-arrw')); ?></div></p>
         </section>
         <!--Banner PAgination Starts-->
         <nav class=slider-pagi>
             <ul>
                 <li><a href="#" class="active">1</a></li>
                 <li><a href="#">2</a></li>
                 <li><a href="#">3</a></li>
                 <li><a href="#">4</a></li>
                 <li><a href="#">5</a></li>
             </ul>
         </nav>
    </figure>
    <!--Center Align Main Banner End-->
</section>
<!--100 Percent Width Banner Outer Wrapper End--> 
<!--Center Align Mid Work With Otherz Sign Up Section Starts-->
<section class=signup-mid>
    <span>Work with others to get there faster</span>
    <div class=blubtn-big>
      <a href="<?php echo SITE_URL ?>users/sign_up">
            <input type="button" value="Sign-up" />
      </a>
    </div>
</section>
<!--Center Align Mid Work With Otherz Sign Up Section End-->
<!--100 Percent Width Outer Footer Starts-->
<?php echo $this->element("home_layout/footer"); ?> 
