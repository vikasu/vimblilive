
<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
    <?php $strength=($connection_details['Connection']['strength'] !=0 ||$connection_details['Connection']['strength'] !="" )?$connection_details['Connection']['strength']:0; ?>
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
	
	
		jQuery('#strengths').raty({
			scoreName: 'data[Connection][strength]',
			path:'<?php echo SITE_URL ?>img/',
			starHalf: 'star-half-big.png',
			starOff: 'star-off-big.png',
			starOn: 'star-on-big.png',
			number: 3,
			score: <?php echo $strength ?>
		});
	
	//SLIDE GROUPS
	jQuery("#assignGroup").live('click',function(){ 
			if(jQuery(this).is(":checked")){
				jQuery(".conGroup").slideDown('slow');
			}else{
				jQuery(".conGroup").slideUp('slow');
			}
		});
	//END SLIDE GROUP
        
});
</script>
<style>
.user-list {
   /* box-shadow: 1px 1px 3px #CCCCCC inset;*/
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

 input[type="textarea"] {height:21px; margin-left:6px; resize:none; padding:10px; font-f	

   }
   input, select, textarea
   {
    font-family: calibri, Arial, Helvetica, sans-serif; color:#5d5c5c;
   }
   body {
    color:#5d5c5c; font-family: calibri, Arial, Helvetica, sans-serif; background:#fff;
    }
    
    .readInfo {
    padding: 5px 0 5px 5px;
}
input, select, textarea {
    color: #5D5C5C;
    font-family: calibri,Arial,Helvetica,sans-serif;
    font-size: 12px;
 
}
.selctbox{
 width:75px !important;  
}
.selctbox1{
 width:140px !important;  
}
#strengths{
    width: 120px !important;
}
.signuplogin_new .basic-details .textarea, .signuplogin_new .textbox span{ width:90%;}
</style>

<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin signuplogin_new">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
                          <!--SignUp Heading-->
			  <?php echo $this->Form->create('Connection', array('controller' => 'connections','action' => 'add_connection/'.$id,'id'=>'addConForm', 'name'=>'addConForm','enctype'=>'multipart/form-data')); ?>
                          <div class="signup-hdng addcnncthdn"><h3 class=bebas>Connection<span>Detail</span></h3></div>
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
					}
					?>
                                  <ul>
                                    <span style="float:left; margin-left:5px;"><i>Name:</i></span>  
				    <br/>
				    <li><div class="readInfo"><span><?php echo $connection_name ?></span></div></li>
				    
				    <span style="float:left; margin-left:5px;"><i>Email:</i></span>
					<br>
				      <?php
				      if(is_array($connection_emails) && !empty($connection_emails)) { ?>
					
					<?php
					foreach($connection_emails as $email_key=>$email_val) { ?>
					
					<li><div class="readInfo"><span><?php echo $email_val['email'] ?></span></div></li>
					<?php /*
						<li><?php echo $this->Form->input('ConnectionEmail.'.$email_key.'.email',array('disabled'=>'disabled', 'value'=>$email_val['email'],'placeholder'=>'Your email, me@serviceprovider.com','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false));
						echo $this->Form->input('ConnectionEmail.'.$email_key.'.connection_id',array('value'=>$email_val['connection_id'],'type'=>'hidden','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false));
						echo $this->Form->input('ConnectionEmail.'.$email_key.'.id',array('value'=>$email_val['id'],'type'=>'hidden','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>
					      */ ?>
					<?php	
					}
				      }else {
				      ?>
				      <li><div class="readInfo"><span>N/A</span></div></li>
                                      <?php } ?>
				    
				    <span style="float:left; margin-left:5px;"><i>Phone:</i></span>
				    <br>
				    <?php
				      if(is_array($connection_phone) && !empty($connection_phone)) { ?>
					
						
				      <?php
					foreach($connection_phone as $phone_key=>$phone_val) { ?>
					    <li><div class="readInfo"><span><?php echo $phone_val['phone']; ?></span></div></li>
					<?php	
					} ?>
					
					<?php 
				      }else {
				      ?>
				      <li><div class="readInfo"><span>N/A</span></div></li>
					<?php } ?>
					
					<?php
						$dob = explode('-',$connection_details['Connection']['dob']);
					?>
					  </li>
				          <span style="float:left; margin-left:5px;"><i>Address:</i></span>
					  <br>
				      <?php 
				      if(is_array($connection_address) && !empty($connection_address)) { ?>
				        <?php
					foreach($connection_address as $add_key=>$add_val) { ?>
					    <li><div class="readInfo"><span><?php echo $add_val['address']; ?></span></div></li>
					<?php	
					} ?>
					
					<?php 
				      }else {
				      ?>
				      <li><div class="readInfo"><span>N/A</span></div></li>
					<?php } ?>
					
					    <span style="float:left; margin-left:5px;"><i>DOB:</i></span><BR>
				      
					<div class=textbox style="float:left;"><span>
						<select style="width:60px" name="data[Connection][birth_day]">
							<option value="">Day</option>
							<?php for($day=1; $day<=31; $day++){ ?>
								<option value="<?php echo $day ?>" <?php if($dob[2]==$day){?>selected="selected"<?php } ?>><?php echo $day ?></option>
							<?php } ?>
						</select>
					</span></div>
					
					<div class=textbox style="float:left;"><span>
						<select style="width:100px" name="data[Connection][birth_month]">
							<option value="">Month</option>
							<option value="01" <?php if($dob[1]=='01'){?>selected="selected"<?php } ?>>January</option>
							<option value="02" <?php if($dob[1]=='02'){?>selected="selected"<?php } ?>>February</option>
							<option value="03" <?php if($dob[1]=='03'){?>selected="selected"<?php } ?>>March</option>
							<option value="04" <?php if($dob[1]=='04'){?>selected="selected"<?php } ?>>April</option>
							<option value="05" <?php if($dob[1]=='05'){?>selected="selected"<?php } ?>>May</option>
							<option value="06" <?php if($dob[1]=='06'){?>selected="selected"<?php } ?>>June</option>
							<option value="07" <?php if($dob[1]=='07'){?>selected="selected"<?php } ?>>July</option>
							<option value="08" <?php if($dob[1]=='08'){?>selected="selected"<?php } ?>>August</option>
							<option value="09" <?php if($dob[1]=='09'){?>selected="selected"<?php } ?>>September</option>
							<option value="10" <?php if($dob[1]=='10'){?>selected="selected"<?php } ?>>October</option>
							<option value="11" <?php if($dob[1]=='11'){?>selected="selected"<?php } ?>>November</option>
							<option value="12" <?php if($dob[1]=='12'){?>selected="selected"<?php } ?>>December</option>
						</select>
					</span></div>
					
					<div class=textbox style="float:left;"><span>
						<select style="width:65px" name="data[Connection][birth_year]">
							<option value="">Year</option>
							<?php for($year=date('Y'); $year>=(date('Y')-80); $year--){ ?>
								<option value="<?php echo $year ?>" <?php if($dob[0]==$year){?>selected="selected"<?php } ?>><?php echo $year ?></option>
							<?php } ?>
						</select>
					</span></div><br/><br/>
					
				    
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
				      <li style="margin-bottom:10px;"><input id="assignGroup" type="checkbox" value="" />Assign Connection Group<li>
				      <li class="conGroup" style="display:none;">
				      <div class="user-list">
						<?php echo $this->Form->input('ConGroupRelation.group_id',array('selected'=>$selected_groups, 'label'=>false,'error'=>false,'type' => 'select', 'hidden'=>true,'multiple' => 'checkbox','options' => $allGroups,'empty'=>'')); ?>
					    </div>
				      </li>
				      <?php
					$touchDurationArr = array('None',1,2,3,4,5,6,7);
					$touchGoalArr = array("Weekly"=>"Weekly","Monthly"=>"Monthly","Yearly"=>"Yearly");
				      ?>
				       <li><div class=textbox style="float:left"><span><div class="input select">
				        <select name="data[Connection][touch_duration]" class="selctbox">
						<?php foreach($touchDurationArr as $key=>$val){ ?>
							<option value="<?php echo $key ?>" <?php if($key==$connection_details['Connection']['touch_duration']){?> selected="selected"<?php } ?>><?php echo $val ?></option>
						<?php } ?>
					</select>
				    </div>  </span></div>
					<div class=textbox style="float:left"><span> <div class="input select">
				        <select name="data[Connection][touch_goals]" class="selctbox1">
						<option value="">Touch Goals</option>
						<?php foreach($touchGoalArr as $key=>$val){ ?>
							<option value="<?php echo $key ?>" <?php if($key==$connection_details['Connection']['touch_goals']){?> selected="selected"<?php } ?>><?php echo $val ?></option>
						<?php } ?>
					</select>
				      </div></span></div></li>
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
				      <br>
					
				      
				      <li class=strgntcnntn style=" padding: 10px 8px 10px 0 !important; ">Strength of Connection<div id="strengths" style="width: auto !important"></div></li>
				  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Note & Strength Check End-->
                          <!--Add Connection Button-->
                          <section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Save',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></section>
			  
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