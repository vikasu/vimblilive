<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
                          <!--SignUp Heading-->
			  <?php echo $this->element("message/errors");?>
			  <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
			  
                          <div class="signup-hdng pricehdng"><h3 class=bebas>Choose<span>Subscription</span></h3></div>
                          <!--Transaction As-->
			  <?php echo $this->Form->create('User', array('controller' => 'users','action' => 'subscription','id'=>'subscriptionForm', 'name'=>'subscriptionForm')); ?>
			   <input type="hidden" name="data[User][id_of_user]" value="<?php echo $userId ?>">
			   <?php if($_SESSION['paymentFor'] == 'Group'){ ?>
				    <input type="hidden" name="data[User][subscription]" value="Group">
			  	    <section class=regtype>
					     <p>Work with a group to realize their  <span>full potential. Click the following button to process the payment.</span></p>
				    </section>
				    <section class=regtype>
					     <div class=signuplogin-btn><?php echo $this->Form->submit('Payment',array('name'=>'data[User][payment]','class'=>'','div'=>false,'label'=>false)); ?></div>
				    </section>
			   <?php } else{ ?>
				    <input type="hidden" name="data[User][subscription]" value="Individual">
				    <section class=regtype>
					     <p>Realizing your dreams outside a <span>formal group.  Click the following button to process the payment.</span></p>
				    </section>
				    <section class=regtype>
					     <div class=signuplogin-btn><?php echo $this->Form->submit('Payment',array('name'=>'data[User][payment]','class'=>'','div'=>false,'label'=>false)); ?></div>
				    </section>
			   
			   <?php } ?>
			  
			  <?php echo $this->Form->end(); ?>
                          <!--Transaction Method-->
                          <section class=trnsctn-method>
                               <h4>Paypal</h4>
                               <ul class=trsctnlist>
                                  <li><a href="#"><img src="<?php echo SITE_URL ?>img/Mastercard.png" alt="" /></a></li>
                                  <li><a href="#"><img src="<?php echo SITE_URL ?>img/Discover-Network.png" alt="" /></a></li>
                                  <li><a href="#"><img src="<?php echo SITE_URL ?>img/Delta.png" alt="" /></a></li>
                                  <li><a href="#"><img src="<?php echo SITE_URL ?>img/Visa.png" alt="" /></a></li>
                                  <li><a href="#"><img src="<?php echo SITE_URL ?>img/American-Express.png" alt="" /></a></li>
                               </ul>
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