<?php //pr($_SESSION);  ?>
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
                           <?php echo $this->Form->create('payments',array('controller'=>'payments','action'=>'payment'));?>
			    
                           <section class=dshbrd-right>
                               <!--Current Mission Section Starts-->
			       
			       <?php echo $this->element("message/errors"); ?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
			       
                            <?php if($_SESSION['Auth']['User']['user_type'] == 1) { ?>
                            <h3>For&nbsp;&nbsp;<span>Individuals</span></h3><hr>
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
				    <ul class=manag-actvty>
                                        <li class="actvity-header">
                                                 <section class="mng-rtng" style="width: 45px">Select</section>
                                                <section class="mng-rtng" style="width: 100px">Plan</section>
                                                <section class="mng-rtng" style="width: 150px">Description</section>
                                             <!--   <section class="mng-rtng" style="width: 65px">User Limit</section> -->
						<section class="mng-rtng" style="width: 100px">Monthly Equivalent($)</section>
						<section class="mng-rtng" style="width: 95px">Payment period</section>
						<section class="mng-rtng" style="width: 50px">Recurring Payment($)</section>
                                             <!--    <section class="mng-rtng" style="width: 65px">Actions</section> -->
			
                                        
                                        </li>
                                    
                                       <?php if(empty($individual_plans)) {
						echo "<div style='margin-top:70px; text-align: center'>No Individual Plans<div>";
				       }else{
                                             foreach($individual_plans as $plan)  {
						    $recurring_pay = ($plan['SubscriptionPlan']['amount']) * ($plan['SubscriptionPlan']['plan_months'])
						?>
                                             <li>      
                                                <section class="mng-rtng" style="width: 45px"><input type="radio" value="<?php echo $plan['SubscriptionPlan']['id'];?>" name="data[SubscriptionPlan][plan_type]" class="plan_type"></section>
                                                <section class="mng-rtng" style="width: 100px"><?php echo $plan['SubscriptionPlan']['plan_title'] ;?></section>
                                                <section class="mng-rtng" style="width: 150px"><?php echo $plan['SubscriptionPlan']['plan_text'] ;?></section>
                                              <!--  <section class="mng-rtng" style="width: 65px"><?php// echo $plan['SubscriptionPlan']['user_limit'] ;?></section> -->
                                                <section class="mng-rtng" style="width: 100px"><?php echo $plan['SubscriptionPlan']['amount'] ;?></section>
                                                <section class="mng-rtng" style="width: 95px"><?php echo $plan['SubscriptionPlan']['plan_months']." "."months" ;?></section>
						<section class="mng-rtng" style="width: 50px"><?php echo $recurring_pay?></section>
                                            </li>
                                            <?php } };?>				
                                    </ul>
                                    <?php echo $this->Form->submit('get_started.png',array('id'=>'submit')); ?>
                                    <?php //echo $this->Form->end();?>
                                     <?php //echo $this->Html->image("/img/payment.png", array("alt" => "Updat","onclick" => "return confirm(\"Are you sure?\");","url"=>array('controller'=>'users','action'=>'delete_user/'.base64_encode($_SESSION['Auth']['User']['id'])))) ;?>   
                                    </section>
                        </section><br><br>
			    <?php } elseif($_SESSION['Auth']['User']['user_type'] == 2) { ?>
                            <?php //echo $this->Form->create('payments',array('controller'=>'payments','action'=>'subscription_plans'));?>
                            <?php //echo $this->Form->create('',array('controller'=>'payments','action'=>'subscription_plans'));?>
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
                                    <ul class=manag-actvty>
					<h3>For&nbsp;&nbsp;<span>Groups</span></h3><hr><br>
					    <li class="actvity-header">
						<section class="mng-rtng" style="width: 45px">Select</section>
                                                <section class="mng-rtng" style="width: 60px">Plan</section>
                                                <section class="mng-rtng" style="width: 80px">Description</section>
                                                <section class="mng-rtng" style="width: 90px">Active Users</section>
						<section class="mng-rtng" style="width: 140px">Monthly Equivalent($)</section>
						<section class="mng-rtng" style="width: 75px">Payment period</section>
						<section class="mng-rtng" style="width: 70px">Recurring Payment($)</section>
					    </li>
					    <?php if(empty($group_plans)) {
						echo "<div style='margin-top:70px; text-align:center; font-style:italic;'>No Sponsorship History<div>";
					    }else{
							    foreach($group_plans as $plan)  {
								$recurring_pay = ($plan['SubscriptionPlan']['amount']) * ($plan['SubscriptionPlan']['plan_months'])
					    ?>
						<li>    
							<section class="mng-rtng" style="width: 45px"><input type="radio" class ="plan_type" value="<?php echo $plan['SubscriptionPlan']['id'];?>" name="data[SubscriptionPlan][plan_type]"></section>
							<section class="mng-rtng" style="width: 60px"><?php echo $plan['SubscriptionPlan']['plan_title'] ;?></section>
							<section class="mng-rtng" style="width: 80px"><?php echo $plan['SubscriptionPlan']['plan_text'] ;?></section>
							<section class="mng-rtng" style="width: 90px"><?php echo $plan['SubscriptionPlan']['user_limit'] ;?></section>
							<section class="mng-rtng" style="width: 140px"><?php echo $plan['SubscriptionPlan']['amount'] ;?></section>
							 <section class="mng-rtng" style="width: 75px"><?php echo $plan['SubscriptionPlan']['plan_months']." "."months" ;?></section>
							 <section class="mng-rtng" style="width: 70px"><?php echo $recurring_pay ;?></section>
			   
						</li>
                                    
                                                <?php  } } ;?>
				
                                    </ul>
                                    
                                     </section>
				 <?php echo $this->Form->submit('get_started.png',array('id'=>'submit')); ?>
			     </section>
			     <?php } ?>
			    
                                    <?php echo $this->Form->end();?>
                                    <!--Select De-Select Blue Button-->
                          
                              
                               
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
</style>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('.plan_type').first().attr('checked',true);
    });
    
</script>