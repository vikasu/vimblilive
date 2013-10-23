<!--Center Align Inner Content Section Starts-->
    <section class="content-pane about-pane">
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class=whitebox>
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=aboutpane-inner>
                           <!--Heading Goes Here-->
                           <h3 class="hwdtwrks dshbrd">Dashboard</h3>
                           <!--Left Panel Starts-->
                           <section class=dshbrd-left>
                              <?php
				      echo $this->element('dashboard/subscription_left');
				?>
                           </section>
                           <!--Left Panel End-->
                           <!--Right Panel Starts-->

			    
                           <section class=dshbrd-right>
                               <!--Current Mission Section Starts-->
			       
			       <?php echo $this->element("message/errors"); ?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
			       
                
                          <div ><h3 class=bebas>Subscription<span>Plans</span></h3></div>
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
				    <ul class=manag-actvty>
                                        <li class="actvity-header" style="height:auto;border:1px solid #ccc; width:680px;background-color: white; border-radius: 10px;">
					    <div><h1  style="padding: 8px 20px;;margin-top: 0px; height: 5px;font-family: 'ProximaNovaCond-Semibold';font-size: 20px;">Activate your account now! </h1></div>
					    <div style="padding:20px">All Vimbli accounts get 30 days free trial.  After 30 days you'll be required to sign-up for a paid account.  You can opt to sign-up earlier.  
								      If you want to do a bulk purchase please contact Vimbli directly for free consultation and quote.
					    </div>
                                            <div id = "container"  >
					   
						<?php foreach($plans as $plan){  ?>
						   <?php echo $this->Form->create('',array('controller'=>'payments','action'=>'payment'));?>
						       <?php
							   echo $this->Form->input('SubscriptionPlan.plan_id',array('type'=>'hidden','value'=>$plan['SubscriptionPlan']['id']));
						       ?>
						<div class="box">
						    <div class="title"><?php echo $plan['SubscriptionPlan']['plan_title']?></div>
						    <div style="text-align: center;margin: 10px;height: 127px;"><?php echo $plan['SubscriptionPlan']['plan_text']?></div>
						    <div style="padding: 20px;"><?php echo $this->Form->submit('get_started.png',array('class'=>'get_started'));?></div>
						</div>
						    <?php echo $this->Form->end();?>
						    <?php }?>
						
					    </div>
					    <div id="below_box">
						    <span">Have a big group or non-profit? <?php echo $this->Html->link('Contact Us','mailto:support@vimbli.com');?></span><br>
						    <span>We w'll do our best to find a good</span><br>
						    <span>solution for you.</span>
					    </div>
                                        
                                        </li>
                                    </section>
                        </section>
			   
                          
                              
                               
                               <div class="paging_full_numbers" id="example_paginate">
                             
                                      &nbsp;
                              </div>
                               
                               
                           </section>
                           <!--Right Panel End-->
                           <!--Clear Div-->
                           <section class=clr-b></section>
                      </section>
                 </section>
             </section>
             <section class=whiteboxbot>
                 <section class=whiteboxbot-right></section>
             </section>
         </section>
         <!--Flexible WhiteBox With Shadows End-->
    </section>
    
<style>
    .mng-rtng{ float: left;  padding: 0 10px; width: 80px;}
    .notes {margin-top:-25px !important;}
    .get_started{width: 117px !important;padding: 0 0 0 4px;}
    .box {
    background-color: white;
    border: 1px solid #CCCCCC;
    border-radius: 16px 16px 10px 10px;
    float: left;
    height: 250px;
    margin: 15px;
    width: 164px;
}
.title {
    background-color: #237FDB;
    font-weight: bold;
    border-radius: 11px 11px 0 0;
    height: 15px;
    padding: 12px;
    text-align: center;
    width: 141px;
    color: white;
}
#container{
    border:1px solid #CCCCCC;height:280px;margin:20px;background-color: #F7F5F5;padding: 5px 0 8px 24px !important; border-radius: 10px;box-shadow:2px 0 2px 2px #e8e8e8;
}
#below_box{
    padding:10px;border:1px solid #CCCCCC;height:60px;margin-left:90px;margin-right:90px;border-radius:10px;text-align: center
}
</style>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.plan_type').first().attr('checked',true);
    });
    
</script>