<!DOCTYPE html>
<html>
    <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <meta http-equiv="Pragma" content="no-cache">
	    <title>
		   <?php echo $pageTitle; ?>
	    </title>
	   
	    <?php echo $this->Html->css('style'); ?>
	    <!--[if lt IE 9]>
	    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	    <?php //echo $this->html->Script('prototype');  ?>

	    <![endif]-->
    </head>
    <body>
	    <!--main wrapper starts-->
		<section id="main-wrapper">
		    
			<!--Wrapper Start-->
			    <section id="wrapper">
		 
				    <!--header section starts-->
					    <?php
						echo $this->element('homepage/thirdpartypro_header'); 
					    ?>
		
				    <!--header section ends-->
				    <style type="text/css" >
					#banner label{
					    width:115px;
					}
				    </style>
				    <!--Banner Start-->
					    <section id="banner">
						 <?php
						  if ($session->check('Message.flash') || $session->check('Message.auth'))
						  {   
						    echo $this->Session->flash();   						   }          
					     ?>
						<?php echo $this->Form->create('',array('url'=>array('action'=>'contact'),'id'=>'form'))?>
                                                    <ul class="login_form" style="padding-left:250px;">
                                                            <li>
                                                                <label>Business type <?php echo configure::read('mandatory_sign');?></label>
                                                                <div class="field_widget">
								     <?php
                                                                            $business_type=array(
                                                                                                "Nsp" => "Nsp",
                                                                                                "Lsp" => "Lsp",
                                                                                                "Vendor" => "Vendor",
                                                                                                "Corporate Client" => "Corporate Client"
                                                                                                
                                                                                            );
                                                                        echo $this->Form->input('ContactUser.business_type',array('options'=>$business_type,'empty' => 'Select business type...','label'=>false,'class'=>'textfield validate[required]'));?>
                                                           
								</div>
                                                            </li>   
                                                            <li>
                                                                <label>name <?php echo configure::read('mandatory_sign');?></label>
                                                                <div class="field_widget">
								     <?php echo $this->Form->input('ContactUser.name',array('label'=>false,'class'=>'textfield validate[required,custom[onlyLetterSp]]'));?>
                                                           
								</div>
                                                            </li>
							    <li>
                                                                <label>email <?php echo configure::read('mandatory_sign');?></label>
                                                                <div class="field_widget">
								     <?php echo $this->Form->input('ContactUser.email',array('label'=>false,'class'=>'textfield validate[required,custom[email]]'));?>
                                                         
								</div>
                                                            </li> 
							    <li>
                                                                <label>Phone <?php echo configure::read('mandatory_sign');?></label>
                                                                <div class="field_widget">
								   
									 <?php echo $this->Form->input('ContactUser.phone',array('label'=>false,'class' => 'textfield validate[required,custom[phoneNumber]]')); ?>
									<span>Exp. 425-555-0123</span>
								</div>
                                                            </li>
                                                            <li>
                                                                <label>Comment <?php echo configure::read('mandatory_sign');?></label>
                                                                <div class="field_widget">
								   
									 <?php echo $this->Form->input('ContactUser.comment',array('cols' => '12','rows' => '3','label'=>false,'class' => 'textfield validate[required]')); ?>
									 
								</div>
                                                            </li>
							    <li>
                                                                <label>&nbsp;</label> 
                                                                <div class="field_widget">
								   
									<img src="<?php echo $captcha_image_url; ?>" id="captcha" alt="CAPTCHA Image"/>
									<a href="#" onclick="document.getElementById('captcha').src = '<?php echo $captcha_image_url; ?>' + Math.random(); return false">Reload Image</a>
									 
								</div>
                                                            </li>
							    <li>
								<label>Security Code <?php echo configure::read('mandatory_sign');?></label>
                                                                <div class="field_widget">
									<?php
									    echo $this->Form->input('ContactUser.captcha_code', array('id'=>'ValidSecCode','div'=>false,'label'=>false,'size'=>'10','onblur'=>"this.value=removeSpaces(this.value);",'class'=>'textfield validate[required]'));                                                    
									?>
									
									
								</div>
							    </li>
							    <li>
								    <label>&nbsp;</label>
								    <div class="field_widget">
									<span class="yl_btn">
									    
									    <?php echo $this->Form->submit('Submit',array('name'=>'submit','label'=>false,'escape'=>false))?>
									
								    </div>
							    </li>	
												      
								 
						    </ul> 
                                                         
                                            </section>    
				    <!--Banner Closed-->
        
			    </section>
			<!--Wrapper Closed-->
			
			<!--Content Start-->			
				<?php
					//echo $this->element('homepage/thirdpartypro_content'); 
				?> 			
			<!--Content Closed-->
			
			
		</section>
	    <!--main wrapper ends-->
	    
	    <!--footer wrapper starts-->
	    	    <?php
			    echo $this->element('homepage/thirdpartypro_footer'); 
		    ?>
    	    <!--footer wrapper close-->
    </body>
<?php 
    echo $this->Html->script('jquery-1.7.2.min.js');
    echo $this->Html->css('validationEngine.jquery');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine-en.js');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine.js');
    
    /***  **/ 
    echo $this->Html->script('common');
    /*** **/
    
?>
<?php
  //echo $html->script('formvalidations/jvalidation.group');
?>
<script type="text/javascript">
       jQuery(document).ready(function(){      
       jQuery("#form").validationEngine();
    });    
    function removeSpaces(value){	
	return jQuery.trim(value); 	 
    }
</script>
</html>