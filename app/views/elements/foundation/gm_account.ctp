<ul id="gm_account">
  <li>
      <!--Sub Menu Content Starts-->
      <section class="innerexpand accountTab">
        <?php //echo $this->element("message/errors");?>
        <?php //echo $this->Session->flash(); echo $this->Session->flash('auth');?>

           <ul class="missin-flds missionview biolist">
               <form id="update_password" action="<?php echo SITE_URL.'settings/update_password/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
                          
                          <!-- Select Timezone -->
                            <li><h3 class=wrdspcn>Confirm<span>Time Zone</span></h3>
                            </li>
                            <li><label>Time Zone:</label>
                                <div class=textbox><span><?php
                                $users_timezone = $_SESSION['Auth']['User']['id']; 
                                echo $this->Form->input('User.timezone',array('type'=>'select', 'options'=>$timezones,'placeholder'=>'User Type','div'=>false,'label'=>false,'class' =>'validate[required] timezone_select','error'=>false, 'empty'=>'-Select-')); ?></span>
                                <br>Please select your time zone and DST status to help us do the math right<br>
                                <?php echo $this->Form->input('User.dst',array('type'=>'checkbox','label'=>false,'id'=>'timezone_check'));?><p>DST currently observed</p>
                                <br>
                                
                                </div>
                            </li>
                            <!-- End Timezone -->
                            
                            <?php /* Bio Section starts  */
                             //echo $this->Form->create('ChangePass', array('controller' => 'Settings','action' => 'update_password/'.base64_encode($_SESSION['Auth']['User']['id']),'id'=>'changePasswordForm', 'name'=>'changePasswordForm')); ?>
                            <li><br><br><h3 class=wrdspcn>Change<span>Password</span></h3>
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
                                 <div class=signuplogin-btn><?php echo $this->Form->end('update',array('class'=>'','div'=>false,'label'=>false)); ?></div>
                            </li>
            </ul>
      </section>
      <!--Sub Menu Content End-->
  </li>
</ul>