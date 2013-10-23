<?php  echo $this->Html->script('password_strength.js');?>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery("#addUserForm").validationEngine();
});
</script>
<style>
	
</style>

<!--Center Align Inner Content Section Starts-->
<section class="content-pane full_content-pane">
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
                      
		      <?php if($this->data['User']['id'] == ""){ ?>
			<div class=signup-hdng><h3 class=bebas>Add<span> User</span>  </h3></div>
		      <?php }else{ ?>
			<div class=signup-hdng><h3 class=bebas>Manage<span> Member</span>  </h3></div>
		      <?php } ?>
                      <!--SignUp Form Fields-->
                      <?php	
			      if(isset($selectedUserType)) {
			      $finaleSelectedUserType[] = $selectedUserType;
			      $disabled = 'disabled';
			      
			      } else {
				$finaleSelectedUserType = '';
				$disabled = '';
			      }
		      echo $this->Form->create('User', array('url' => array('controller' => 'groups', 'action' => 'add_user',base64_encode($id)),'id'=>'addUserForm', 'name'=>'addUserForm')); ?>
                      <ul class=form-fields>
                          <li><div class=textbox><span><?php echo $this->Form->input('User.name',array('placeholder'=>'Enter Name here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                          <li><div class=textbox><span><?php echo $this->Form->input('User.email',array('placeholder'=>'Enter email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
			<div style="padding: 5px 5px 2px 7px;">Status:</div>
                          <li style="padding-bottom: 0px;">
                          <div class=><span style="padding: 0 0 0 7px;">
                              <?php
			      $this->data['User']['status'] = ($this->data['User']['status'] != "")?$this->data['User']['status']:1;
			      //echo $form->input('User.status', array('label'=>false,'type'=>'radio','options'=>array('1'=>'Active','2'=>'Deactive'),'style'=>'','class'=>'','error'=>false));?>
				<?php //echo $form->input('User.status', array('label'=>false,'type'=>'radio','options'=>array('1'=>'Active','0'=>'Deactive'),'legend'=>false,'div'=>false,'style'=>'','class'=>'validate[required]','error'=>false));?>
				<input name="data[User][status]" type="radio" value="1" <?php if($this->data['User']['status'] == 1){ ?> checked="checked" <?php } ?>>Active
				<br>
				<input name="data[User][status]" type="radio" value="0" <?php if($this->data['User']['status'] == 0){ ?> checked="checked" <?php } ?> style="margin:2px 0 0 7px;">Inactive
				 
			  </span></div><br/>
                          </li>
			  
			  <div style="padding: 5px 5px 2px 7px;">Current Access:
			  
			  <?php
				$accessLevels = '';
				if($this->data['User']['individual_payment_status'] == 1){
					$accessLevels = $accessLevels.'Individual, ';
				}if($this->data['User']['group_payment_status'] == 1){
					$accessLevels = $accessLevels.'Admin, ';
				}if(!empty($this->data['SponsorManager']['id'])){
					$accessLevels = $accessLevels.'Sponsor, ';
				}
				
				echo substr($accessLevels,0,strlen($accessLevels)-2);
			    ?>
			  
			  </div>
                          
                          <div style="padding: 5px 5px 2px 7px;">Add additional access:</div>
                          <li class=dob>
                          <div class="textbox add-user-drp"><span>
                              <?php
			      echo $form->input('ManagerUser.type', array('label'=>false,'type'=>'select','selected'=>$finaleSelectedUserType,'options'=>array('1'=>'Normal User','2'=>'Admin User'),'div'=>false,'style'=>'','class'=>'','error'=>false));?>
                          </span></div>
                          </li>
			<?php if($this->data['User']['id'] == ""){ ?>
                          <li><div class=signuplogin-btn><?php echo $this->Form->submit('Add',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
			<?php }else{ ?> 
				<li><div class=signuplogin-btn><?php echo $this->Form->submit('Save',array('class'=>'','div'=>false,'label'=>false)); ?></div>
				<div class=signuplogin-btn style="margin-left:0px; background: none">
				<input type="image" value="Delete" name="data[User][action]" src="<?php echo SITE_URL ?>img/delete_big.png" style="background: none;" onclick='return confirm("Are you sure to delete this user from group?")'>
				<?php //echo $this->Html->image('delete_big.png',array('name'=>'data[User][action]','class'=>'','div'=>false,'label'=>false,'onclick'=>'return confirm("Are you sure to delete this user from group?")')); ?></div>
				
				</li>
			<?php }?>
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