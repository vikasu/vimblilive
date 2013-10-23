<?php //prx($contentRow);die;?>
<html>
      <?php echo $this->element("home_layout/header"); ?>
<body>
<!--100 Percent Width Header Outer Wrapper Starts-->
<section id=header-wrap>
      <?php echo $this->element("home_layout/menu"); ?> 
</section>
<!--100 Percent Width Header Outer Wrapper End--> 
<!--100 Percent Width Banner Outer Wrapper Starts-->
<div id="container" class="banner-slide">
      <div id="example"> 
	    <div id="slides">
		  <div class="arrowcntrls">
			<a href="#" class="prev"><img src="<?php echo SITE_URL ?>img/slider-img/arrow-prev.png" alt="Arrow Prev"></a>
			 <a href="#" class="next"><img src="<?php echo SITE_URL ?>img/slider-img/arrow-next.png" alt="Arrow Next"></a>
                  </div>   
		  <div class="slides_container">
                        <?php foreach ($links as $path):?>
			<div class="slide">
			      <?php  //pr($links);die; ?>
			      <?php   echo $this->Html->image("/img/slider-img/newsliderimg/".$path['CarouselDetail']['carousel_image']); ?>  
			      <!--Slider Title With Caption, Button Starts-->
			      <section class=slidercap>
				          
					  <h4>
						<?php $str= $path['CarouselDetail']['carousel_title']; 
						echo $str;?>
					  </h4><br/>
					  
					<span>
				<span>
				    <?php $str= $path['CarouselDetail']['carousel_description'];
					  echo $path['CarouselDetail']['carousel_description'];
				    ?>
				</span>
						
			      	    <p>
					  <a href="<?php echo SITE_URL?>users/sign_up">
						<div class=banner-btn>
							   <img src="img/how.png">
				                    <!-- <img src="<?php //echo SITE_URL ?>img/banner_btn_arrow.png" alt="" class="bnnrbtn-arrw" />-->
						</div>
					  </a>
				    </p>
				 
			      </section>
			</div>  	
			<?php endforeach;?>		
		  </div> 
            </div>
      </div>
</div>     
	

		
       
	
<!--100 Percent Width Banner Outer Wrapper End--> 

<!--Center Align Mid Work With Otherz Sign Up Section Starts-->
<section class=signup-mid>
    <span>Join Now!</span>
    
      <a class="blubtn-big blubtn_new" href="<?php echo SITE_URL?>users/sign_up">
      <input type="button" value="Sign Up" />
            <!--<img src="img/sign_up.png">-->
      </a>
    
</section>
<section class="bottom_signup">
  <section class="whiteboxtop">
       <section class="whiteboxtop-right"></section>
   </section>
   <section class="whiteboxmid">
      <section class="whiteboxmid-right">
        <ul class="sign_uplisting">
	<?php foreach($contentRow as $row) {?>
          <li>
            <a class="lt_img_home" href="<?php echo $row['ContentRow']['link'] ?>"><img alt="My Setup" src="<?php echo SITE_URL ?>img/contentRowImage/<?php echo $row['ContentRow']['content_image']?>"></a>
            <div class="blubtn-big blubtn_new fl-r">
              <a href="<?php echo SITE_URL?>users/sign_up"><input type="button" value="Sign Up" /></a>
            </div>
            <div class="signup_info">
              <table cellpadding="0" cellspacing="0" width="100%" border="0" height="114">
                <tr>
                  <td valign="middle">
                    <p><?php echo $row['ContentRow']['description']?><a href="<?php echo $row['ContentRow']['link'] ?>">More ...</a></p></td>
                </tr>
              </table>
            </div>
         </li>
      <?php } ?>
        </ul>
      </section>
   </section>
   <section class="whiteboxbot">
       <section class="whiteboxbot-right"></section>
   </section>
</section>
<!--Center Align Mid Work With Otherz Sign Up Section End-->
<!--100 Percent Width Outer Footer Starts-->
<?php echo $this->element("home_layout/footer"); ?> 
<script type="text/javascript">
  $(document).ready(function(){
	  $('#slides').find('.pagination').addClass('slider-pagi');						 
     });
</script>

<style>
      .slidercap h4 {
	    font-family: calibri;
	    font-size:35px;
	    line-height: 1.1;
      }
      .blubtn-big {
    /*background: none;*/
    display: inline-block;
    height: 37px;
    padding-left: 19px;
}
.banner-slide .slides_container div.slide img {
    height: auto;
  
    width: 100%;
}
.banner-btn { background:none; padding-left:25px; height:51px; position:relative; display:inline-block; margin-top:45px; cursor:pointer; }

</style>
