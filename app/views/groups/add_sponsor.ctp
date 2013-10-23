<?php  echo $this->Html->script('password_strength.js');?>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery("#addUserForm").validationEngine();
});
</script>



<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
     <!--Flexible WhiteBox With Shadows Starts-->
     <section class="whitebox signuplogin signuplogin_new">
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
                      
                      <div class=signup-hdng><h3 class=bebas>Invite<span> Sponsor</span>  </h3></div>
                      <!--SignUp Form Fields-->
                      <?php	
			      if(isset($selectedUserType)) {
			      $finaleSelectedUserType[] = $selectedUserType;
			      $disabled = 'disabled';
			      
			      } else {
				$finaleSelectedUserType = '';
				$disabled = '';
			      }
		      echo $this->Form->create('User', array('url' => array('controller' => 'groups', 'action' => 'add_sponsor',base64_encode($id)),'id'=>'addUserForm', 'name'=>'addUserForm')); ?>
                      <ul class=form-fields>
                          <li><div class=textbox><span><?php echo $this->Form->input('User.name',array('placeholder'=>'Enter Name here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                          <li><div class=textbox><span><?php echo $this->Form->input('User.email',array('placeholder'=>'Enter email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>$disabled)); ?></span></div></li>
                          <li><div class=signuplogin-btn><?php echo $this->Form->submit('Add',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
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