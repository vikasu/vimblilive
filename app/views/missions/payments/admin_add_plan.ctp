<?php
//pr($unique_code);die;
    echo $this->Html->script('jquery-1.7.2.min.js');
    echo $this->Html->css('validationEngine.jquery');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine-en.js');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine.js');
?>

<script type="text/javascript">
       jQuery(document).ready(function(){      
	    jQuery("#form").validationEngine();
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
 
 <style>
  .name{background:#def3ca; margin:3px; width:80px;display:none; float:left; text-align:center; }
  </style>

<style type="">
ul.main-form{
	width:100%;
}
.showDiv{display:block;}
.hideDiv{display:none;}
#promo{
    border:none !important;
    background: none;
    box-shadow: none;
}
</style>
<?php //echo pr($id);?>
<?php
        $breadcrumbList=array(
                            '0'=>array(
                                    'name'=>'Manage Codes',  
                                    'controller' => 'payments',
                                    'action' => 'admin_add_code'
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
                                                                <td width="180px">Plan Title <em>*</em> :</td>
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
                                                        <tr>
                                                                <td width="180px">User Limit <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('SubscriptionPlan.user_limit',array('size'=>'15','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td width="180px">Amount(per/month)  $  <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('SubscriptionPlan.amount',array('size'=>'15','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                                                </td>
                                                        </tr>
                                                        <tr>
                                                                <td width="180px">Plan Months <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('SubscriptionPlan.plan_months',array('size'=>'15','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                                                </td>
                                                        </tr>
                                                   <!--     <tr>
                                                                <td width="180px">Status <em>*</em> :</td>
                                                                <td>
                                                                    <?php //echo $form->select('Payment.status',array('1'=>'Active','0'=>'Deactive'),null,array('type'=>'select','class'=>'textbox','label'=>false,'div'=>false,'error'=>false,'size'=>1,'empty'=>'Select')); ?>
                                                                </td>
                                                        </tr> -->
                                                         
                                                        
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