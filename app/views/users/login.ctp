<?php //echo $this->Session->flash('auth'); die; ?>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery('form:first *:input[type!=hidden]:first').focus();
        jQuery("#loginForm").validationEngine();

        //Check if caps is on :: STRT
        jQuery('#password').keypress(function(e) { 
            var s = String.fromCharCode( e.which );
            if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
                jQuery(".caps_msg").show();
            }else{
                jQuery(".caps_msg").hide();
            }
        });
        
        jQuery(document).keyup(function(e){
                //alert(e.keyCode); 
                if (e.keyCode == 20) {
                        var s = String.fromCharCode( e.which );
                        if ( s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey ) {
                               //jQuery(".caps_msg").show();
                        }else{
                               jQuery(".caps_msg").hide();
                        }
                }     // enter
        });
        //CAPS :: END

});
</script>

<style>
.caps_msg{
        background: none repeat scroll 0 0 #FFFFFF;
        border: 1px solid #EEEEEE;
        border-radius: 6px 6px 6px 6px;
        box-shadow: 0 0 3px 4px #DDDDDD;
        display: none;
        left: 0;
        padding: 5px 15px;
        position: absolute;
        top: 95px;
        left: 440px;
        width: 120px;
        z-index: 9999;
}
.arrowtop{
/* Rotate div */
transform:rotate(270deg);
-ms-transform:rotate(270deg); /* IE 9 */
-webkit-transform:rotate(270deg); /* Safari and Chrome */
margin: 26px 0 0 -44px
}


.signuplogin .whiteboxmid-right {
    min-height: 430px;
}

</style>

<?php
      //Auto populate email
      $email_value = '';
      if(@$_SESSION['user_email'] != ""){
            $email_value = $_SESSION['user_email'];
            $_SESSION['change_pass'] = 1;
      } elseif(@$this->params['pass'][0] != ""){
            $email_value = base64_decode($this->params['pass'][0]);
            $_SESSION['change_pass'] = 1;
      } else {
            $email_value = '';
      }
     
?>

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
                      
                      <div class="signup-hdng loginhdn"><h3 class=bebas>User  <span>Login</span></h3></div>
                      <!--SignUp Form Fields-->
                      <?php echo $this->Form->create("User",array("controller"=>'users',"action"=>'login',"method"=>"POST",'id'=>'loginForm')); ?>
                      <ul class=form-fields style="position: relative; overflow: visible !important;">
                         <li><div class=textbox><span><?php echo $this->Form->input('User.email',array('value'=>$email_value, 'placeholder'=>'Enter your email Address','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                          <li><div class=textbox><span><?php echo $this->Form->input('User.password',array('placeholder'=>'Password','label'=>false,'div'=>false,'id'=>'password','class'=>'validate[required]','error'=>false)); ?></span></div></li>
                          <!--<div id="caps_msg">(Caps Lock is on)</div>-->
                          
                        <section class="caps_msg" style="display: none;">
                                <img class="arrowtop" alt="" src="<?php echo SITE_URL ?>css/images/white_top_arrow.png">
                                <ul>
                                        <li style="padding: 4px;">Caps lock is on</li>
                                </ul>
                        </section>
                          
                          <li><div class=textbox><span>
                              <?php echo $form->input('User.user_type', array('label'=>false,'type'=>'select','options'=>array('1'=>'Individual User','2'=>'Group Manager','3'=>'Sponsor'),'div'=>false,'style'=>'','class'=>'','error'=>false));?>
                          </span></div></li>
                          <li><input type="checkbox" name="data[User][remember_me]"></div><div class=terms>Keep me logged in for 2 weeks</div></li>
                          <li><div class=signuplogin-btn><?php echo $this->Form->submit('Login',array('class'=>'submit','div'=>false,'label'=>false)); ?></div><?php echo $html->link('Forgot Password?',array('controller'=>'users','action'=>'forgot_password'),array('class'=>'frgtpwd')); ?></li>
                                                    
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
