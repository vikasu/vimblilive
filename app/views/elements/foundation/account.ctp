
<?php
        // changing date to USA format
        $submits=explode(' ',$current_user_trans['Transaction']['sub_date']);
        $submit = date("M. d, Y", strtotime($submits[0]));
        $expires=explode(' ',$current_user_trans['Transaction']['expiry_date']);
        $expire = date("M. d, Y", strtotime($expires[0]));
?>

<ul>
    <li>
        <!--Sub Menu Content Starts-->
        <section class="innerexpand">
            <div id="wrapper">
                <ul class="acc_tabs">
                    <li><a href="#acc_tab1">Time Zone & Password</a></li>
                    <li><a href="#acc_tab5">Refresh Authorization</a></li>
                    <li><a href="#acc_tab2">Export</a></li>
                    <li><a href="#acc_tab3">Subscription</a></li>
                </ul>
                <div class="acc_tab_container">
                    <div id="acc_tab1" class="acc_tab_content"> 
                        <!--Change Password form - Starts--> 
                        <ul class="missin-flds missionview accntlist">
                            <form id="update_password" action="<?php echo SITE_URL.'settings/update_password/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
                            <!-- Select Timezone -->
                            <li><h3 class=wrdspcn>Confirm<span>Time Zone</span></h3>
                            </li>
                            <li><label>Time Zone:</label>
                               <div class="textbox" style="margin-top:-1px";><span><?php
                                        $users_timezone = $_SESSION['Auth']['User']['timezone']; 
                                        echo $this->Form->input('User.timezone',array('type'=>'select', 'options'=>$timezones,'placeholder'=>'User Type','div'=>false,'label'=>false,'class' =>'validate[required] timezone_select','error'=>false, 'empty'=>'-Select-')); ?></span>
                                    <br>Please select your time zone and DST status to help us do the math right
                                    <br>
                                         <?php echo $this->Form->input('User.dst',array('type'=>'checkbox','label'=>false,'id'=>'timezone_check'));?><p>DST currently observed</p>
                                </div>
                               
                            </li>
                            <!-- End Timezone -->
                                                        
                            <?php /* Bio Section starts  */
                             //echo $this->Form->create('ChangePass', array('controller' => 'Settings','action' => 'update_password/'.base64_encode($_SESSION['Auth']['User']['id']),'id'=>'changePasswordForm', 'name'=>'changePasswordForm')); ?>
                            <li style="padding-top: 25px;"><h3 class=wrdspcn>Change<span>Password</span></h3>
                            </li>
                            <li><label>Current Password:</label>
                                 <div class=textbox><span><?php echo $this->Form->input('User.old_password',array('type'=>'password','id'=>'old_password','placeholder'=>'Current Password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                            </li>
                            <li><label>New Password:</label>
                                <div class=textbox><span><?php echo $this->Form->input('User.new_password',array('value'=>'','type'=>'password','id'=>'password','placeholder'=>'New Password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                            </li>
                            <li><label></label>
                                <div id="passwordStrengthDiv" class="is0" style="float:left;"></div>
                                <div id="strengthWords" class="" style="width:100px; float:left; font-weight:bold;"></div>
                            </li>
                            <li><label>Confirm Password:</label>
                                 <div class=textbox><span><?php echo $this->Form->input('User.confirm_password',array('type'=>'password','id'=>'confirm_password','placeholder'=>'New Password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                            </li>
                            <li>
                                 <div class=signuplogin-btn><?php echo $this->Form->end('Update',array('class'=>'','div'=>false,'label'=>false)); ?></div>
                            </li>
                        </ul>
                        <!--Change Password form - Ends--> 
                    </div>
                    
                     <!--Refresh Authorization Form Start-->
                    <div id="acc_tab5" class="acc_tab_content"> 
                        <ul class="missin-flds missionview accntlist">
                           <!-- <form id="update_password" action="<?php //echo SITE_URL.'settings/update_password/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >-->
                            
                            <?php /* Bio Section starts  */
                             //echo $this->Form->create('ChangePass', array('controller' => 'Settings','action' => 'update_password/'.base64_encode($_SESSION['Auth']['User']['id']),'id'=>'changePasswordForm', 'name'=>'changePasswordForm')); ?>
                            <li><h3 class=wrdspcn>Refresh<span>Authorization</span></h3>
                            </li>
                            <!--<li><label>Current Password:</label>
                                 <div class=textbox><span><?php //echo $this->Form->input('User.old_password',array('type'=>'password','id'=>'old_password','placeholder'=>'Current Password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                            </li>
                            <li><label>New Password:</label>
                                <div class=textbox><span><?php //echo $this->Form->input('User.new_password',array('value'=>'','type'=>'password','id'=>'password','placeholder'=>'New Password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                            </li>
                            <li><label></label>
                                <div id="passwordStrengthDiv" class="is0" style="float:left;"></div>
                                <div id="strengthWords" class="" style="width:100px; float:left; font-weight:bold;"></div>
                            </li>
                            <li><label>Confirm Password:</label>
                                 <div class=textbox><span><?php //echo $this->Form->input('User.confirm_password',array('type'=>'password','id'=>'confirm_password','placeholder'=>'New Password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
                            </li>-->
                            <li>
                                <p>
                                    In the case of a corrupt authorization token use "Refresh" to reset the authorization.
                                    <br> If you want to revoke the authorization use the "Refresh" and select the "Cancel" option on the authorization screen.
                                </p>
                            </li>
                            <li>
                                 <div class="signuplogin-btn">
                                 
                                 <input type="button" class="imagelink" value="Refresh"  id="authrization"/>
                                 <?php //echo $this->From->end('Reset Authorization',array('class'=>'','div'=>false,'label'=>false)); ?></div>
                            </li>
                        </ul>
                    </div>
                   <!--Refresh Authorization Ends-->
                 <div id="loaderDiv"><img src="<?php echo SITE_URL ?>img/ajax-loader.gif"></div>        
                    <div id="acc_tab2" class="acc_tab_content"> 
                        <!--Export data form - Starts--> 
                     <ul class="missin-flds missionview chkbxlft">
                           <form id="export_data" action="<?php echo SITE_URL.'settings/export_data/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
                            <li><h3 class=wrdspcn>Export:</h3>  </li>
                             <li>
                              
                                <div style="float:left;width:100px;"><label id="label" styl>All Data</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
                                    <a href="<?php echo SITE_URL ?>timelines/bk_export_data" class="a"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                                </li>
                            
                          <!--  <li>
                                <?php //echo $this->Form->checkbox('Export.data1',array('value'=>'all_data','id'=>'password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                <label>All Data</label>
                            </li>-->
                             <li>
                              
                                <div style="float:left;width:100px;"><label id="label">Connection Info</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
				<a href="<?php echo SITE_URL ?>settings/bk_export_connections" class="b"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                            </li>
                             <li>
                              
                                <div style="float:left;width:100px;"><label id="label">Activity Info</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
				<a href="<?php echo SITE_URL ?>groups/export_activities" class="a"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
				<!--<a href="<?php echo SITE_URL ?>timelines/bk_export_data" class="a"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>-->
                            </li>
                            <li>
                              
                                <div style="float:left;width:100px;"><label id="label">Reflection Info</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
				<a href="<?php echo SITE_URL ?>groups/export_reflections" class="b"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                            </li>
                             <li>
                              
                                <div style="float:left;width:100px;"><label id="label">Attachment</label></div>
				<div style="float:left;width:100px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
				<a href="<?php echo SITE_URL ?>homes/download" class="a"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" class="upload"/></a>
                            </li>
                            
                        </ul>
                        <!--Export data form - Ends--> 
                    </div>
                    <div id="acc_tab3" class="acc_tab_content"> 
                            <!--User Actions form - Starts--> 
                            <ul class="missin-flds missionview accntlist">
                                <form id="" action="<?php echo SITE_URL.'settings/update_bio_info/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
                                <li> <h3 class=wrdspcn>Manage<span>Subscription</span></h3>
                                </li>
                                        <div><span><li><label>User Type:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.user_type',array( 'value'=>'Individual User','div'=>false,'label'=>false,'class' =>'validate[required]','   error'=>false,'disabled'=>'disabled')); ?><div></li></span></div><br>
                                    <?php if(!empty($current_user_trans['SubscriptionPlan']['plan_title'])) {?>
                                        <div><span><li><label>Item Name:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.user_type',array( 'value'=>'Individual User','div'=>false,'label'=>false,'class' =>'validate[required]','   error'=>false,'disabled'=>'disabled')); ?><div></li></span></div><br>
                                    <?php } else {?>
                                        <div><span><li><label>Item Name:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.user_type',array( 'value'=>'N/A','div'=>false,'label'=>false,'class' =>'validate[required]','   error'=>false,'disabled'=>'disabled')); ?><div></li></span></div><br>
                                    <?php }?>
                                    
                                    <?php if($current_user_trans['Transaction']['type']=="free") {?>
                                          <div><span><li><label>First payment:</label><div style="padding-top: 14px;">30 Day Trial- Ending:<?php echo $this->Form->input('User.status',array('value'=>$expire,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>

                                    <?php }elseif($current_user_trans['Transaction']['type']=="paid"){?>    
                                          <div><span><li><label>First payment:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.status',array('value'=>$submit,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>
                                     <?php }else{?>
                                           <div><span><li><label>First payment:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.status',array('value'=>'NA','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>
                                     <?php }?>
                                    <?php if(!empty($current_user_trans['SubscriptionPlan']['plan_months'])) {?>
                                            <div><span><li><label>End of Billing Cycle:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.plan_months',array('value'=>$current_user_trans['SubscriptionPlan']['plan_months'].' '.'months','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>    
                                    <?php }elseif($current_user_trans['SubscriptionPlan']['plan_months'] == 0) {?>
                                             <div><span><li><label>End of Billing Cycle:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.plan_months',array('value'=>'Ongoing','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>    
                                     <?php } else {?>
                                             <div><span><li><label>End of Billing Cycle:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.plan_months',array('value'=>'N/A','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>    
                                    <?php }?>
                                    
                                        
                                     <?php  if($current_user_trans['Transaction']['type']=="paid" && $current_user_trans['SubscriptionPlan']['plan_months'] != 0){?>
                                            <div><span><li><label>Expires On:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.exp_date',array('value'=>$expire,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>
                                    <?php }else {  ?>
                                                    <div><span><li><label>Expires On:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.exp_date',array('value'=>'On cancellation
','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>
                                       <?php     }?>
                            <table class="disc">
                                <tr>
                                    <td ><?php echo  $this->Html->image("/img/update.png", array('class'=>'account_btns',"alt" => "Update","url"=>array('controller'=>'payments','action'=>'subscription_plans'))) ;?>  </td>
                                  
                                    <td><?php echo $this->Html->image("/img/deactivate.png", array( 'class'=>'account_btns',"alt" => "Updat","url"=>array('controller'=>'users','action'=>'deactivate_user/'.base64_encode($_SESSION['Auth']['User']['id'])))) ;?>
                                    </td>
                                    <td><?php echo $this->Html->image("/img/delete_big.png", array('class'=>'account_btns',"alt" => "Updat","onclick" => "return confirm(\"Are you sure?\");","url"=>array('controller'=>'users','action'=>'delete_user/'.base64_encode($_SESSION['Auth']['User']['id'])))) ;?>
                                    </td>
                                </tr>
                                <tr>
                                <td class="td">
                                    <div style="margin-top:-60px">
                                        Update your <br>
                                        subscription to<br>
                                        extend the<br>
                                        subscription or add<br> 
                                        functionality.
                                    </div>
                                </td>
                                <td class="td">
                                        Vimbli will retain<br>
                                        data in deactivated<br> 
                                        accounts for 12 <br>
                                        months. If you don't<br> 
                                        activate the account <br>
                                        before the 12 <br>
                                        months expire all <br>
                                        your data will be <br>
                                         deleted. 
                                </td>
                                
                                <td class="td">
                                    <div style="margin-top:-49px">
                                        Vimbli will delete<br>
                                        all your personal<br>
                                        data. We'll not be<br>
                                         able to recover your<br>
                                        data if you opt for<br>
                                        deletion.
                                    </div>
                                </td>
                                </tr>
                            </table>    
                    </div>
                    <div id="acc_tab4" class="acc_tab_content"> 
                        <!--Delete account form - Starts-->     
                       <ul class="missin-flds missionview chkbxlft">
                            <form id="delete_account" action="<?php echo SITE_URL.'settings/delete_account/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" onsubmit ="return confirm('Sure You Want to Delete Your Account');">
                             
                              <li> <h3 class=wrdspcn>Delete<span>Account</span></h3>
                             </li>
                             <li><?php echo $this->Form->checkbox('User.delete',array('value'=>'delete','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                  <label>Delete My Account</label>
                              </li>
                              <li>
                                  <div class=signuplogin-btn><?php echo $this->Form->end('Delete',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
                          
                        </ul>
                        <!--Delete account form - Ends-->     
                    </div>  
                </div>
            </div>
        </section>
        <!--Sub Menu Content End-->
    </li>
</ul>
<style>
    .checkbox {
            background: none !important;
    }
    
    p {
        margin: 0   px;
        padding: 0;
    }
    input, select, textarea {
    background: none ;
    color: #5D5C5C;
    font-family: calibri,Arial,Helvetica,sans-serif;
    font-size: 14px;
    padding: 3px;
}
td a{
    background:white !important;
    
}

.td{
     padding-left:30px;  
    }
.a{
    hover:none;
    background:#FFF9EB!important  ;
    border-left:none !important;
    
  }
.b{
    hover:none;
    background:none!important   ;
    border:none !important;
   
       
  }
 label#label {
    float: left;
    font-family: 'ProximaNova-Semibold';
    padding-left: 25px !important;
    padding-top: 22px !important;
    width: 160px;
}
img#upload {
    border: medium none;
    padding-left: 215px !important;
    vertical-align: middle;
}


.disc tr td a:hover{
    border-left:5px solid white !important;
}
.blurDiv { opacity: 0.6; }
#loaderDiv { display: none; position: absolute; top: 320px; left: 700px; 
}  
</style>
