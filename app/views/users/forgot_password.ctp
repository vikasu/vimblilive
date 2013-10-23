<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery("#forPassForm").validationEngine();
});
</script>

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
                      
                      <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                      
                      <div class="signup-hdng loginhdn"><h3 class=bebas>Forgot  <span>Password?</span></h3></div>
                      <!--SignUp Form Fields-->
                      <?php echo $this->Form->create("User",array("controller"=>'users',"action"=>'forgot_password',"method"=>"POST",'id'=>'forPassForm')); ?>
                      <ul class=form-fields>
                          <li><div class=textbox><span><?php echo $this->Form->input('User.email',array('placeholder'=>'Enter your email Address','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                          <li><div class=signuplogin-btn><?php echo $this->Form->submit('Submit',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></li>
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