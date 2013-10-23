<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#addConForm").validationEngine();
	
	//Script for clone
	jQuery("#Discount #edit_otherDiscount").click(function(){
	
			  if(jQuery("#Discount table tr").last().children().last().children().is('a')) {	
				var clone = jQuery("#Discount table tr").last().clone(); // clone the last <tr>
				jQuery(clone).appendTo($("#Discount table"));
				jQuery(clone).find('td a').click(function(){
				jQuery(this).parent('td').parent('tr').remove();
				});
				
			clone.find('input[type=text]').val('');
			}else{
				var clone = jQuery("#Discount table tr").last().clone();
				var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png'/></a>");
				
				jQuery(clone).find('td').first().append(img);
				jQuery(img).click(function(){
					
					jQuery(img).parent('td').parent('tr').remove();
						
				});
				jQuery(clone).appendTo(jQuery("#Discount table"));
				clone.find('input[type=text]').val('');
			}
		
	});
	//End script for clone
	
        
});
</script>
<style>
.user-list {
    box-shadow: 1px 1px 3px #CCCCCC inset;
    min-height: 170px;
    min-width: 302px;
    overflow-y: scroll;
    padding: 4px 0 0 8px;
    margin-bottom:15px;
}
div.checkbox {
    padding: 3px;
    background: url("") no-repeat scroll left top transparent;
    float:none;
    height: auto;
    width: auto;
}
label {
    padding: 4px;
}
.form_default label {
    float: inherit;
    padding: 5px;
}
input[type="checkbox"] {
    margin: 0;
    padding: 0;
    vertical-align: middle;
}

</style>

<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
                          <!--SignUp Heading-->
			  <?php echo $this->Form->create('Connection', array('controller' => 'connections','action' => 'add_connection/'.$id,'id'=>'addConForm', 'name'=>'addConForm','enctype'=>'multipart/form-data')); ?>
                          <div class="signup-hdng addcnncthdn"><h3 class=bebas>Add<span>Connection</span></h3></div>
                          <!--Basic Details Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
			      <section class=bscdtl-lft>
				<?php //pr($connection_details); exit;
					$connection_name = isset($connection_details['Connection']['name']) ? $connection_details['Connection']['name'] : '';
					$connection_source = isset($connection_details['Connection']['source']) ? $connection_details['Connection']['source'] : '';
					$connection_description = isset($connection_details['Connection']['description']) ? $connection_details['Connection']['description'] : '';
					
					$connection_emails = isset($connection_details['ConnectionEmail']) ? $connection_details['ConnectionEmail'] : '';
					$connection_phone = isset($connection_details['ConnectionPhone']) ? $connection_details['ConnectionPhone'] : '';
					$connection_address = isset($connection_details['ConnectionAddress']) ? $connection_details['ConnectionAddress'] : '';
					$connection_groups = isset($connection_details['ConGroupRelation']) ? $connection_details['ConGroupRelation'] : '';
					$selected_groups = array();
					if(is_array($connection_groups) && !empty($connection_groups)) {
					  foreach($connection_groups as $key=>$val) {
						$selected_groups[$key] = $val['group_id']; 
					  }
					}?>
                                  <ul>
                                      <li><div class=textbox><span><?php echo $this->Form->input('Connection.name',array('placeholder'=>'Your name here - first last please :)', 'value'=> $connection_name, 'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                      
				      <?php
				      if(is_array($connection_emails) && !empty($connection_emails)) { ?>
					<li> Emails:</li>
					<?php
					foreach($connection_emails as $email_key=>$email_val) { ?>
						<li><div class=textbox><span><?php echo $this->Form->input('ConnectionEmail.'.$email_key.'.email',array('disabled'=>'disabled', 'value'=>$email_val['email'],'placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false));
						echo $this->Form->input('ConnectionEmail.'.$email_key.'.connection_id',array('value'=>$email_val['connection_id'],'type'=>'hidden','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false));
						echo $this->Form->input('ConnectionEmail.'.$email_key.'.id',array('value'=>$email_val['id'],'type'=>'hidden','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                      
					<?php	
					}
				      }else {
				      ?>
				      <li><div class=textbox><span><?php echo $this->Form->input('ConnectionEmail.email',array( 'disabled'=>'disabled','placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                      <?php } ?>
					<?php
				      if(is_array($connection_phone) && !empty($connection_phone)) { ?>
					<li> Phone:</li>
					<div id="Discount" style="float:left;">
					<table>
						
				      <?php
					foreach($connection_phone as $phone_key=>$phone_val) { ?>
						<tr><td>
						<li><div class=textbox><span><input disabled= "disabled", type="text" value="<?php echo $phone_val['phone']; ?>" name="data[ConnectionPhone][<?php echo $phone_key;?>][phone]" placeholder="Your phone number"/>
						<input type="hidden" value="<?php echo $phone_val['id']; ?>" name="data[ConnectionPhone][<?php echo $phone_key;?>][id]" />
						<input type="hidden" value="<?php echo $phone_val['connection_id']; ?>" name="data[ConnectionPhone][<?php echo $phone_key;?>][connection_id]" /><?php //echo $this->Form->input('ConnectionPhone.phone',array('placeholder'=>'Your phone number','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
						</td></tr>
					<?php	
					} ?>
					</table>
					<!--<li><a href="javascript:void(0);" id="edit_otherDiscount" class="addmore AddMore" style="padding-top:0px;">Add more phone numbers?</a></li>-->
					</div>
					
					<?php 
				      }else {
				      ?>
				      <div id="Discount" style="float:left;">
					<table><tr><td>
						<li><div class=textbox><span><input disabled= "disabled" type="text" name="data[ConnectionPhone][phone][]" placeholder="Your phone number"/><?php //echo $this->Form->input('ConnectionPhone.phone',array('placeholder'=>'Your phone number','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
					</td></tr></table>
					<!--<li><a href="javascript:void(0);" id="edit_otherDiscount" class="addmore AddMore" style="padding-top:0px;">Add more phone numbers?</a></li>-->
					</div>
					<?php } ?>
					
				      <?php 
				      if(is_array($connection_address) && !empty($connection_address)) { ?>
					<li> Address:</li>
					<?php
					foreach($connection_address as $add_key=>$add_val) { ?>
						<li><div class=textbox><span>
						<?php echo $this->Form->input('ConnectionAddress.'.$add_key.'.address',array( 'disabled'=> 'disabled', 'value'=>$add_val['address'],'placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false));
						echo $this->Form->input('ConnectionAddress.'.$add_key.'.connection_id',array('value'=>$add_val['connection_id'],'type'=>'hidden','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false));
						echo $this->Form->input('ConnectionAddress.'.$add_key.'.id',array('value'=>$add_val['id'],'type'=>'hidden','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
						</span></div></li>
                                      
					<?php	
					}
				      }else { ?>
				      <div style="clear:both;"></div>
				      <li><div class=textbox><span>
				      <?php echo $this->Form->input('ConnectionAddress.address',array( 'disabled'=> 'disabled', 'placeholder'=>'Your address','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
				      </span></div></li>
				       
                                      <?php
				      } ?>
					
                                  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Basic Details End-->
                          <!--Select Group & Touch Goals Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
                              <section class=bscdtl-lft>
                                  <ul><!--
                                      <li><div class=textbox><span><?php //echo $form->select('Connection.group_id',@$allGroups,null,array('type'=>'select','label'=>false,'div'=>false,'error'=>false,'size'=>1,'empty'=>'Select a group')); ?></span></div></li>
				      -->
				      <li>
				      <div class="user-list">
						<?php echo $this->Form->input('ConGroupRelation.group_id',array('selected'=>$selected_groups, 'label'=>false,'error'=>false,'type' => 'select', 'hidden'=>true,'multiple' => 'checkbox','options' => $allGroups,'empty'=>'')); ?>
					    </div>
				      </li>
				      
				      <li><div class=textbox><span><?php echo $form->select('Connection.touch_goals',null,null,array('type'=>'select','label'=>false,'div'=>false,'error'=>false,'size'=>1,'empty'=>'Touch Goals')); ?></span></div></li>
				  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Select Group & Touch Goals End-->
                          <!--Note & Strength Check Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
                              <section class=bscdtl-lft>
                                  <ul>
                                      <li><?php echo $this->Form->input('Connection.description',array('value'=>$connection_description,'type'=>'textarea','size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','error'=>false)); ?></li>
				      <li class=strgntcnntn>Strength of Connection<div class="pwdtrngth"></div></li>
                                      <li><?php echo $form->input('Connection.file', array('type' => 'file', 'label' => 'Upload file', "label" => false)); ?></li>
				      
                                  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Note & Strength Check End-->
                          <!--Add Connection Button-->
                          <section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Save  Connection',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></section>
			  
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