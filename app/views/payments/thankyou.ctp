<style>
.basic-details .textarea {
    height: 80px;
    width: 294px;
}
li {
    list-style: none outside none;
    padding: 2px;
}
#today_star { margin-left: 10px;  width: 112px !important;}
#tomorrow_star { margin-left: 10px; width: 187px !important; }
.starForAns{width: 189px !important; margin-bottom:0px;}
.textbox span input { margin: 16px 8px 0 !important;}
.calInput { background:url("../img/cal_icon.png") no-repeat 115px 2px !important; }
.noBground { background:none !important; height:auto !important; padding-left:0px;}
.noBground input { margin-left:4px !important; border:1px solid red; }

.refQuestion { font-weight:normal !important;  margin-left: 10px;}
.blurDiv { opacity: 0.4; }
#loaderDiv { display: none; position: absolute; top: 500px; left: 600px; 
}

</style>
<?php
     //pr($arr); die;
    echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
     
         <section class="whitebox signuplogin" style="width:720px;">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
		      <div id="loaderDiv"><img src="<?php echo SITE_URL ?>img/ajax-loader.gif"></div>
                          <!--SignUp Heading-->
			  <div class="signup-hdng addcnncthdn"><h3 class=bebas>Thank<span> You</span></h3></div>
                          <!--Basic Details Starts-->
                          <section class="basic-details mediadetails">
                              <!--Left Panel Starts-->
                                  <section class=bscdtl-lft>
                                              <ul>
                                                    <li>
                                                        <div id="star"></div>
                                                    </li>
                                                    <li style="margin-bottom:10px;">
                                                        <div class="refQuestion" style="font-size:15px;">Thankyou for subscribing to Vimbli.</div>
                                                    </li>
                                                    <li>
							<div class="refQuestion" style="font-size:15px;">You have been successfully subscribed to Vimbli</div>
                                                    </li>
                                                    <li> 
                                                        <div class="refQuestion" style="font-size:15px;"><?php echo $this->Html->link('Click here',array('controller'=>'users','action'=>'welcome'))?> to proceed..</div>
                                                    </li>
                                    </section> 
                     
                         </section> 
                      </section>
                 </section>
             </section>
             <section class=whiteboxbot>
                 <section class=whiteboxbot-right></section>
             </section>
         </section>
         <!--Flexible WhiteBox With Shadows End-->
    </section>
<!--Center Align Inner Content Section End-->
<script>
	jQuery(document).ready(function(){
		  
	jQuery(".custom").click(function(){
	    jQuery(".signup-pane").addClass('blurDiv');
	    jQuery("#loaderDiv").show();
	});  
	});
</script>