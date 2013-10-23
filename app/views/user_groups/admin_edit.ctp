<?php 
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
</style>
<?php
        $breadcrumbList=array(
                            '0'=>array(
                                    'name'=>'Manage User',  
                                    'controller' => 'users',
                                    'action' => 'index'
                                    ),
                                'Add User'
                                );
            echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
	?>
<div class="left">
    
    
	    <?php echo $this->Session->flash(); ?>
		 <div class="widgetbox">
            	<h3><span>Add User</span></h3>
				<?php echo $this->Session->flash(); ?>
				<div class="content">
					<div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>					
					<?php echo $this->Form->create('User', array('controller' => 'users','action' => 'add/'.base64_encode(@$this->data['User']['id']),'prefix'=>'admin','id'=>'form')); ?>
					<div class="form_default">
						<table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
							<tr>
                                                                <td width="180px">Name <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('User.name',array('size'=>'50','div'=>false,'label'=>false,'class' =>'validate[required]')); ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="180px">E-Mail <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('User.email',array('size'=>'50','div'=>false,'label'=>false,'class' =>'validate[required]')); ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="180px">Password <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('User.password',array('type'=>'password','size'=>'50','div'=>false,'label'=>false,'class' =>'validate[required]','id'=>false)); ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="180px">Confirm Pasword <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('User.confirmpassword',array('type'=>'password','size'=>'50','div'=>false,'label'=>false,'class' =>'validate[required]','id'=>false)); ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="180px">Birthdate (DD/MM/YYYY) <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $form->input('User.birth_day', array('label'=>false,'type'=>'select','options'=>$this->Common->get_days(),'div'=>false,'style'=>'','class'=>'','empty'=>'DAY'));?>
								    <?php echo $form->input('User.birth_month', array('label'=>false,'type'=>'select','options'=>$this->Common->get_months(),'div'=>false,'style'=>'','class'=>'','empty'=>'MONTH'));?>
								    <?php echo $form->input('User.birth_year', array('label'=>false,'type'=>'select','options'=>$this->Common->get_years(),'div'=>false,'style'=>'','class'=>'','empty'=>'YEAR'));?>
                                                                </td>
                                                        </tr>
							
						</table>
						<table cellpadding="0" cellspacing="0" width="500px">
							<tr>     
							        <td>									
								<?php echo $this->Form->button('Save', array('id'=>'save',"name"=>"save",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
								<?php echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '/admin/users'",'style'=>'margin-left:0px !important'));?> 
								</td>				  			     </tr> 
						</table>
					</div><!-- form_default -->
	
					<?php echo $form->input('User.id'); echo $this->Form->end(); ?>
				
				</div><!-- content -->
		 </div><!-- widgetbox -->
</div><!-- left -->