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
			  <?php echo $this->Form->create('Connection', array('controller' => 'connections','action' => 'add_connection','id'=>'addConForm', 'name'=>'addConForm','enctype'=>'multipart/form-data')); ?>
                          <div class="signup-hdng addcnncthdn"><h3 class=bebas>Add<span>Connection</span></h3></div>
                          <!--Basic Details Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
			      <section class=bscdtl-lft>
                                  <ul>
                                      <li><div class=textbox><span><?php echo $this->Form->input('Connection.name',array('placeholder'=>'Your name here - first last please :)','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                      <li><div class=textbox><span><?php echo $this->Form->input('Connection.email',array('placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                      
					<div id="Discount" style="float:left;">
					<table><tr><td>
						<li><div class=textbox><span><input type="text" name="data[ConnectionPhone][phone][]" placeholder="Your phone number"/><?php //echo $this->Form->input('ConnectionPhone.phone',array('placeholder'=>'Your phone number','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
					</td></tr></table>
					<li><a href="javascript:void(0);" id="edit_otherDiscount" class="addmore AddMore" style="padding-top:0px;">Add more phone numbers?</a></li>
					</div>
					
                                  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Basic Details End-->
                          <!--Select Group & Touch Goals Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
                              <section class=bscdtl-lft>
                                  <ul>
                                      <li><div class=textbox><span><?php echo $form->select('Connection.group_id',@$allGroups,null,array('type'=>'select','label'=>false,'div'=>false,'error'=>false,'size'=>1,'empty'=>'Select a group')); ?></span></div></li>
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
                                      <li><?php echo $this->Form->input('Connection.description',array('type'=>'textarea','size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','error'=>false)); ?></li>
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