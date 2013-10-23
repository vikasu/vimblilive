
<?php  echo $this->Html->script('password_strength.js');?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('form:first *:input[type!=hidden]:first').focus();
	jQuery('#password').passwordStrength();
        
        jQuery("#signUpForm").validationEngine();
        
});
</script>

<style>
/* Style for password strength meter */
.is0{background:url('../img/password_strength.png') no-repeat 0 0;width:138px;height:14px; margin:3px 0px 3px 7px;}
.is10{background-position:0 -14px;}
.is20{background-position:0 -14px;}
.is30{background-position:0 -28px;}
.is40{background-position:0 -28px;}
.is50{background-position:0 -42px;}
.is60{background-position:0 -42px;}
.is70{background-position:0 -56px;}
.is80{background-position:0 -56px;}
.is90{background-position:0 -70px;}
.is100{background-position:0 -70px;}
.is110{background-position:0 -84px;}
.is120{background-position:0 -84px;}
#aboveText{margin-top:20px; border:1px solid #ccc;padding: 5px; border-radius: 10px;text-align: center}
</style>

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
                      
                      <div class=signup-hdng><h3 class=bebas>Sign-up  </h3></div>
		      <div id="aboveText">
			Sign-up for a 30-day trial. No strings attached.<br>
			You can activate your subscription at any time during the<br>
			subscription.<br>
			Contact us if you believe you have a story that qualifies for a <br>
			free or almost free subscription.

		      </div>
                      <!--SignUp Form Fields-->
                      <?php echo $this->Form->create('User', array('controller' => 'users','action' => 'sign_up','id'=>'signUpForm', 'name'=>'signUpForm')); ?>
                      <ul class=form-fields>
                          <li><div class=textbox><span><?php echo $this->Form->input('User.name',array('placeholder'=>'<First Last> for individual or <Group Name> if representing a group','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                          <li><div class=textbox><span><?php echo $this->Form->input('User.email',array('placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                          <li><div class=textbox><span><?php echo $this->Form->input('User.pwd',array('type'=>'password','id'=>'password','placeholder'=>'A 2+ character password you can remember','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                              <div id="passwordStrengthDiv" class="is0" style="float:left;"></div>
                              <div id="strengthWords" class="" style="width:100px; float:left; font-weight:bold;"></div>
                          </li>
                          <div style="padding: 5px 5px 2px 7px;">Provide your birthday to confirm you are older than 13 years</div>
                          <li class=dob><div class=textbox><span>
                              <?php echo $form->input('User.birth_day', array('label'=>false,'type'=>'select','options'=>$this->Common->get_days(),'div'=>false,'style'=>'','class'=>'','empty'=>'Day','error'=>false));?>
                          </span></div>
                          <div class=textbox><span>
                              <?php echo $form->input('User.birth_month', array('label'=>false,'type'=>'select','options'=>$this->Common->get_months(),'div'=>false,'style'=>'','class'=>'','empty'=>'Month','error'=>false));?>
                          </span></div>
                          <div class=textbox><span>
                              <?php echo $form->input('User.birth_year', array('label'=>false,'type'=>'select','options'=>$this->Common->get_years(),'div'=>false,'style'=>'','class'=>'','empty'=>'Year','error'=>false));?>
                          </span></div>
                          </li>
                          
                          <li><input type="checkbox" name="data[User][agree]" value=1 style="margin-left:5px"><div class=terms>I accept the <?php echo $html->link('Terms-of-Service',array('controller'=>'pages','action'=>'display','terms_of_services'),array('target'=>'_blank')) ?> and <?php echo $html->link('Privacy Policy',array('controller'=>'pages','action'=>'display','privacy'),array('target'=>'_blank')); ?></div></li>
                          <li><div class=signuplogin-btn><?php echo $this->Form->submit('Register',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
                      </ul>
                      <?php echo $this->Form->end(); ?>
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