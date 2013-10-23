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
			  
                          <div class="signup-hdng pricehdng"><h3 class=bebas>Complete&nbsp;&nbsp;<span>Transaction</span></h3></div>
                          <!--Transaction As-->
			  <?php echo $this->Form->create('User', array('controller' => 'users','action' => 'complete_transaction','id'=>'signUpStep2', 'name'=>'signUpStep2')); ?>
                          <section class=regtype>
                              <div class=signuplogin-btn><?php echo $this->Form->submit('Individual',array('name'=>'data[User][user_type]','class'=>'','div'=>false,'label'=>false)); ?></div>
                              <p>Realizing your dreams outside a <span>formal group</span></p>
                          </section>
                          <section class=regtype>
                              <div class=signuplogin-btn><?php echo $this->Form->submit('Group',array('name'=>'data[User][user_type]','class'=>'','div'=>false,'label'=>false)); ?></div>
                              <p>Work with a group to realize their  <span>full potential</span></p>
                          </section>
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