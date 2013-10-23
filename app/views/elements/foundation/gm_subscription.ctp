
<?php
    // changing date to USA format
    $explode_sub_date = explode(' ',$current_user_trans['Transaction']['sub_date']);
    $sub_date = date("M. d, Y", strtotime($explode_sub_date[0]));
    $explode_exp_date = explode(' ',$current_user_trans['Transaction']['expiry_date']);
    $exp_date = date("M. d, Y", strtotime($explode_exp_date[0]));
?>
<ul>
    <li>
        <!--Sub Menu Content Starts-->
        <section class="innerexpand">
            <div id="wrapper" >
                            <!--User Actions form - Starts--> 
                            <ul class="missin-flds missionview accntlist" style="border: 1px solid #ccc; margin:0px; padding: 5px;">
                                <form id="" action="<?php echo SITE_URL.'settings/update_bio_info/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
                                    <li> <h3 class=wrdspcn>Manage<span>Subscription</span></h3>
                                    </li>
                                            <div><span><li><label>User Type:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.user_type',array( 'value'=>'Group User','div'=>false,'label'=>false,'class' =>'validate[required]','   error'=>false,'disabled'=>'disabled')); ?><div></li></span></div><br>
                                            <!-- CHECKING AVAILABILITY OF PALN TITLE-->  
                                        <?php if(!empty($current_user_trans['SubscriptionPlan']['plan_title'])) {?>
                                            <div><span><li><label>Item Name:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.user_type',array( 'value'=>'Individual User','div'=>false,'label'=>false,'class' =>'validate[required]','   error'=>false,'disabled'=>'disabled')); ?><div></li></span></div><br>
                                        <?php } else {?>
                                            <div><span><li><label>Item Name:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.user_type',array( 'value'=>'N/A','div'=>false,'label'=>false,'class' =>'validate[required]','   error'=>false,'disabled'=>'disabled')); ?><div></li></span></div><br>
                                        <?php }?>
                                            <!-- CHECKING AVAILABILITY OF PALN USER LIMIT-->
                                        <?php if(!empty($current_user_trans['SubscriptionPlan']['user_limit'])) { ?>
                                            <div><span><li><label>User Limit:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.user_limit',array( 'value'=>$current_user_trans['SubscriptionPlan']['user_limit'],'div'=>false,'label'=>false,'class' =>'validate[required]','   error'=>false,'disabled'=>'disabled')); ?><div></li></span></div><br>
                                        <?php } else { ?>
                                             <div><span><li><label>User Limit:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.user_limit',array( 'value'=>'N/A','div'=>false,'label'=>false,'class' =>'validate[required]','   error'=>false,'disabled'=>'disabled')); ?><div></li></span></div><br>
                                        <?php } ?>
                                            <!-- CHECKING AVAILABILITY OF USER TYPE AS FREE OR PAID-->
                                        <?php if($current_user_trans['Transaction']['type']=="free") { //echo 1;?>
                                             <div><span><li><label>First payment:</label><div style="padding-top: 14px;">30 Day Trial- Ending:<?php echo $this->Form->input('User.status',array('value'=>$exp_date,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>
                                        <?php }elseif($current_user_trans['Transaction']['type']=="paid"){ //echo 2; //die;?>    
                                             <div><span><li><label>First payment:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.status',array('value'=>$sub_date,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>
                                        <?php }else{ //echo 3; //die;?>
                                              <div><span><li><label>First payment:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.status',array('value'=>'N/A','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>
                                        <?php }?>
                                            <!-- CHECKING AVAILABILITY OF PALN DURATION-->
                                        <?php if(!empty($current_user_trans['SubscriptionPlan']['plan_months'])) {?>
                                               <div><span><li><label>End of Billing Cycle:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.plan_months',array('value'=>$current_user_trans['SubscriptionPlan']['plan_months'].' '.'months','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>    
                                        <?php }elseif($current_user_trans['SubscriptionPlan']['plan_months'] == 0) {?>
                                             <div><span><li><label>End of Billing Cycle:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.plan_months',array('value'=>'Never','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>    
                                     <?php }  else {?>
                                                <div><span><li><label>End of Billing Cycle</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.plan_months',array('value'=>'N/A','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'disabled'=>'disabled')); ?></div></li></span></div><br>    
                                        <?php }?>
                                            <!-- SHOWS EXPIRE DATE IF USER TYPE IS PAID-->
                                        <?php if($current_user_trans['Transaction']['type'] == "paid") { ?>
                                                <div><span><li><label>Expires On:</label><div style="padding-top: 14px;"><?php echo $this->Form->input('User.exp_date',array('value'=>$exp_date,'div'=>false,'label'=>false,'class' =>'validate[required]','   error'=>false,'disabled'=>'disabled')); ?><div></li></span></div><br>
                                        <?php  } ?>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <?php echo  $this->Html->image("/img/update.png", array('class'=>'account_btns',"alt" => "Update","url"=>array('controller'=>'payments','action'=>'subscription_plans'))) ;?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Html->image("/img/deactivate.png", array("alt" => "Updat","url"=>array('controller'=>'users','action'=>'deactivate_user/'.base64_encode($_SESSION['Auth']['User']['id'])))) ;?>
                                                        </td>
                                                        <td>
                                                            <?php echo $this->Html->image("/img/delete_big.png", array("alt" => "Updat","onclick" => "return confirm(\"Are you sure?\");","url"=>array('controller'=>'users','action'=>'delete_user/'.base64_encode($_SESSION['Auth']['User']['id'])))) ;?>
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
   ul.menu li ul li a:hover {
                   border-left:  0px !important;
    }
    ul.menu li ul li a{
         padding-left:  15px !important;
}
</style>