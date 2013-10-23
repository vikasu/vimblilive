<ul class="wrap_tab_content pwd_tab_content">
  <li>
      <!--Sub Menu Content Starts-->
      <section class="innerexpand accountTab">
        <?php //echo $this->element("message/errors");?>
        <?php //echo $this->Session->flash(); echo $this->Session->flash('auth');?>

           <ul class="missin-flds missionview biolist">
               <form id="update_password" action="<?php echo SITE_URL.'settings/update_password/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
                            
                            <?php /* Bio Section starts  */
                             //echo $this->Form->create('ChangePass', array('controller' => 'Settings','action' => 'update_password/'.base64_encode($_SESSION['Auth']['User']['id']),'id'=>'changePasswordForm', 'name'=>'changePasswordForm')); ?>
                            <li><h3 class=wrdspcn>Change<span>Password</span></h3>
                            </li>
                            <li><label>Current Password:</label>
                                 <div class=textbox><span><?php echo $this->Form->input('User.old_password',array('type'=>'password','id'=>'old_password','placeholder'=>'Current Password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                            </li>
                            <li><label>New Password:</label>
                                 <div class=textbox><span><?php echo $this->Form->input('User.new_password',array('type'=>'password','id'=>'password','placeholder'=>'New Password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                            </li>
                            <li><label></label>
                                <div id="passwordStrengthDiv" class="is0" style="float:left;"></div>
                                <div id="strengthWords" class="" style="width:100px; float:left; font-weight:bold;"></div>
                            </li>
                            <li><label>Confirm Password:</label>
                                 <div class=textbox><span><?php echo $this->Form->input('User.confirm_password',array('type'=>'password','id'=>'confirm_password','placeholder'=>'New Password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                            </li>
                            <li>
                                 <div class=signuplogin-btn><?php echo $this->Form->end('Change Password',array('class'=>'','div'=>false,'label'=>false)); ?></div>
                            </li>
            </ul>
      </section>
      <!--Sub Menu Content End-->
  </li>
</ul>