<?php
//pr($unique_code);die;
    echo $this->Html->script('jquery-1.7.2.min.js');
    echo $this->Html->css('validationEngine.jquery');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine-en.js');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine.js');
    echo $this->Html->css('datepickers');
    echo $this->Html->script('datepicker');
?>



<script type="text/javascript">
       jQuery(document).ready(function(){
	      
	    jQuery("#form").validationEngine();
       });   
</script>

<script type="text/javascript">
       jQuery(document).ready(function(){
	      jQuery("#datapicker").datepicker({
		    minDate: 0
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
 
<style>
	.name{background:#def3ca; margin:3px; width:80px;display:none; float:left; text-align:center; }
</style>

<style type="">
    ul.main-form{
		    width:100%;
    }
    .showDiv{
		display:block;
   }
    .hideDiv{
		display:none;
    }
    #promo{
	    border:none !important;
	    background: none;
	    box-shadow: none;
    }
</style>
<?php
        $breadcrumbList=array(
                            '0'=>array(
                                    'name'=>'Manage Codes',  
                                    'controller' => 'payments',
                                    'action' => 'admin_index'
                                    ),
                                '1'=>array('name'=>'Add Promotional code','controller' => 'payments', 'action' => 'admin_add_code')
                                );
            echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
	?>
<div class="left">
    
    
	    <?php echo $this->Session->flash(); ?>
		 <div class="widgetbox">
            	<h3><span>Add Code</span></h3>
				<?php echo $this->Session->flash(); ?>
				<div class="content">
				    
				    <?php echo $this->element("message/errors");?>
				    
					<div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>					
					<?php echo $this->Form->create('Payment',array('controller' => 'payments','action' => 'admin_add_code/'.base64_encode(@$this->data['PromotionalCode']['id']),'prefix'=>'admin','id'=>'form')); ?>
					<div class="form_default">
						<table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
							
							<tr>
                                                                <td width="180px">Promotional Code <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('PromotionalCode.unique_code',array('size'=>'10','div'=>false,'label'=>false,'class' =>'validate[required]','maxlength'=>'10','error'=>false,'id'=>'unique')); ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="180px">Deduction Percentage <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('PromotionalCode.amount',array('size'=>'10','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false,'id'=>'discount','maxlength'=>'4				')); ?>
                                                                </td>
                                                        </tr>
							<tr>
                                                                <td width="180px">Expiration Date <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('PromotionalCode.expiration_date',array('type'=>'text','size'=>'10','div'=>false,'label'=>false,'class' =>'validate[required] ','error'=>false,'id'=>'datapicker')); ?>
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
								</td>				  			     </tr> 
						</table>
					</div><!-- form_default -->
	
					<?php echo $this->Form->end(); ?>
				
				</div><!-- content -->
		 </div><!-- widgetbox -->
</div><!-- left -->
<script>
       jQuery(document).ready (function(){
	
     jQuery("#form").submit(function(){
	   //jQuery("#form").validationEngine();
	  
       var v=$("#discount").val();
       var va=parseInt(isNaN(v));
	      
       if (isNaN(parseInt(v))){
	      
	      alert("Percentage should be  numeric");
	       return false;
      
       }
       else
       {
	       if(v>100){
	         alert("Percentage should be less than 100");
	       return false; 
       }
       }	
      
      
       
      
       
       });
       
	});
	
	
</script>
