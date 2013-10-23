<?php
       echo $this->Html->script('jquery-1.7.2.min.js');
       echo $this->Html->css('validationEngine.jquery');
       echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine-en.js');
       echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine.js');
?>

<!-- starting of script-->
<script type="text/javascript">
       jQuery(document).ready(function(){      
	    jQuery("#form").validationEngine();
	    
	      // restrict the user_limit field for individual if alredy individual is selected
	      var userType = jQuery("#SubscriptionPlanUsertype").val();
	      if(userType == "Individual"){
		     jQuery('#user_limit').hide();
	      }else{
		     jQuery('#user_limit').show();  
	      }
	      
	      // restrict the user_limit field for individual on change function
	      jQuery("#SubscriptionPlanUsertype").change(function(){
		    var userType = jQuery("#SubscriptionPlanUsertype").val();
		    if(userType == "Individual") {
			    jQuery('#user_limit').hide();
		    }else{
			    jQuery('#user_limit').show();  
		    }
	      });
       });      
</script>

<script>
       function showRadioChk(id){		
	      if (id == 0) {		
		      jQuery("#chkdiv1").addClass("hideDiv");
	      }
	      if (id == 1) {		
		      jQuery("#chkdiv1").removeClass("hideDiv");		
	      }
       }
</script>
<!-- ending of script-->

<!-- Starting  of css-->
<style>
         .name{background:#def3ca; margin:3px; width:80px;display:none; float:left; text-align:center; }
</style>

<style type="">
ul.main-form { width:100%; }
.showDiv { display:block; }
.hideDiv { display:none; }
#promo{ border:none !important; background: none; box-shadow: none; }
</style>
<!-- End of css-->
<?php
        $breadcrumbList=array(
                            '0'=>array(
                                    'name'=>'Manage Plan',  
                                    'controller' => 'payments',
                                    'action' => 'admin_subscription'
                                    ),
                                'Add Promotional code'
                                );
            echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>
<div class="left">
	    <?php echo $this->Session->flash(); ?>
		 <div class="widgetbox">
            	<h3><span>Add Plan</span></h3>
				<?php echo $this->Session->flash(); ?>
				<div class="content">
				    
				    <?php echo $this->element("message/errors");?>
				    
					<div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>					
					<?php echo $this->Form->create('Payment', array('controller' => 'payments','action' => 'admin_add_plan/'.base64_encode(@$this->data['SubscriptionPlan']['id']),'prefix'=>'admin','id'=>'form')); ?>
			    			<div class="form_default">
						<table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
							
							<tr>
								      <td width="180px">User Type<em>*</em> :</td>
                                                                    <td><?php echo $this->Form->input('SubscriptionPlan.usertype',array('type'=>'select','size'=>'1','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'options'=>array('Individual'=>'Individual','Group'=>'Group'),'empty'=>'---Select---')); ?></td>
								
							</tr>
                                                              
                                                        </tr>
							<tr>
                                                                <td width="180px">Item Name<em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('SubscriptionPlan.plan_title',array('size'=>'15','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="180px">Plan Text <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('SubscriptionPlan.plan_text',array('size'=>'15','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                                                </td>
                                                        </tr>
                                                        <tr id="user_limit">
                                                                <td width="180px" >User Limit <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('SubscriptionPlan.user_limit',array('size'=>'15','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td width="180px">Billing Amount ($)  <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('SubscriptionPlan.amount',array('size'=>'15','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td width="180px">Billing Cycle<em>*</em> :</td>
                                                                <td>
								      <?php echo $this->Form->input('SubscriptionPlan.billing_cycle',array('type'=>'select','size'=>'1','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'options'=>array('Day'=>'Daily','Week'=>'Weekly','Month'=>'Monthly','Year'=>'Y	early'))); ?>
                                                                    
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td width="180px">End of Billing Cycle :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('SubscriptionPlan.plan_months',array('size'=>'15','div'=>false,'label'=>false,'error'=>false)); ?>
                                                                </td>
                                                        </tr>
                                                         
						</table>
						<table cellpadding="0" cellspacing="0" width="500px">
							<tr>     
							        <td>									
								<?php echo $this->Form->button('Save', array('id'=>'save',"name"=>"save",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
								<?php //echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '/admin/payments/index'",'style'=>'margin-left:0px !important'));?> 
								</td>				  			     </tr> 
						</table>
					</div><!-- form_default -->
	
					<?php echo $this->Form->end(); ?>
				
				</div><!-- content -->
		 </div><!-- widgetbox -->
</div><!-- left -->