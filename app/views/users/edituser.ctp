<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
	$.noConflict();
	$("#UserBioDob").datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true
	});
});
</script>

<?php 
	$cntName = $this->data['UserBio']['country'];
	$cntdata = $this->requestAction("/commons/countryNameList/$cntName");
 	echo $javascript->link('users/signup.js');
	echo $session->flash(); 
?>	

<?php echo $this->Form->create('User',array('name'=>'signup','id'=>'signup'));?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
	<td>
  		<img src="/img/spacer.gif" width="1" height="10" alt="" />
    </td>
 </tr>
 <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	<tr>
        		<td class="left_title">Edit User Details:
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
        	<tr>
        		<td style="width: 185px;" align="left" valign="top"><label>First Name *: </label></td>
        		<td>	
        			<?php echo $this->Form->input('User.id');?>
        			<?php echo $this->Form->input('User.name',array('div'=>false,'label'=>false,'class'=>'width200'));?></td>
      	     </tr>
      	     
      	     <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Last Name : </label></td>
        		<td><?php echo $this->Form->input('User.last_name',array('div'=>false,'label'=>false,'class'=>'width200'));?></td>
      	     </tr>
      	     
      	      <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Current Weight :</label></td>
        		<td>	
        			<?php echo $this->Form->input('UserBio.weight_current',array('div'=>false,'label'=>false,'class'=>'width200'));?>
        		</td>
      	     </tr>
      	     
      	      <tr>
        		<td align="left" valign="top">
        			<label for="UserBioEmploymentGender">Gender :</label>
				</td>
				<td>		
					<div>
							<input type="radio" name="data[UserBio][gender]" <?php if((isset($this->data)) && ($this->data['UserBio']['gender']=="M")){echo "checked";}?> id = 'male' value="M"> Male
							<input type="radio" name="data[UserBio][gender]" <?php if((isset($this->data)) && ($this->data['UserBio']['gender']=="F")){echo "checked";}?> id = 'male' value="F"> Female
							<span style="margin-right:76px;">&nbsp;</span>						
	        			<?php  
	        					/* $options=array('M'=>'Male','F'=>'Female');
								$attributes=array('legend'=>false);
								echo $this->Form->radio('UserBio.gender',$options,$attributes,array('style'=>'margin-right:92px;'));*/
								echo $this->Form->error('UserBio.gender');
						?>
					</div>
				</td>
				
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentCity">Date Of Birth :</label></td>
        		<td><?php 
		        		echo $this->Form->input('UserBio.dob',array('div'=>false,'label'=>false,'type'=>'text','readonly'=>true,'class'=>'width200'));
        			?>
        		</td>
      	     </tr>

      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentCity">City :</label></td>
        		<td><?php 
		        		echo $this->Form->input('UserBio.city',array('div'=>false,'label'=>false,'type'=>'text','class'=>'width200'));
        			?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentState">State :</label></td>
        		<td>
        			<?php echo $this->Form->input('UserBio.state',array('div'=>false,'label'=>false,'type'=>'text','class'=>'width200'));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentCountry">Country :</label></td>
        		<td>
					<?php echo $this->Form->select('UserBio.country',$this->requestAction('/commons/countryList'),$cntdata['Country']['id'],array('empty'=>'select','class'=>'width200'));?>     
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentZip">Zip :</label></td>
        		<td>
					<?php echo $this->Form->input('UserBio.zip',array('div'=>false,'label'=>false,'type'=>'text','class'=>'width200'));?>        		
        		</td>
       	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Relationship Status :</label></td>
        		<td>
        			<?php echo $this->Form->select('UserBio.relationship_status',$this->requestAction('/commons/relationShipList'),null,array('empty'=>'select','class'=>'width200'));?>
        		</td>
      	     </tr>
      	     
      	    <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Household Income :</label></td>
        		<td>
        			<?php echo $this->Form->select('UserBio.household_income',$this->requestAction('/commons/incomeList'),null,array('empty'=>'select','class'=>'width200'));?>
        		</td>
      	     </tr>
      	     
     	    <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Highest Education :</label></td>
        		<td>
      	     		<?php echo $this->Form->select('UserBio.education_highest',$this->requestAction('/commons/educationList'),null,array('empty'=>'select','class'=>'width200'));?>
				</td>
      	     </tr>
      	           	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Employment Status :</label></td>
        		<td>	
        			<?php echo $this->Form->select('UserBio.employment_status',$this->requestAction('/commons/employementList'),null,array('empty'=>'select','class'=>'width200'));?>
        		</td>
      	     </tr>

      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Employemet Industry :</label></td>
        		<td>
        			<?php echo $this->Form->select('UserBio.employment_industry',$this->requestAction('/commons/industryList'),null,array('empty'=>'select','class'=>'width200'));?>
       			</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"> <label for="UserBioEmploymentStatus">Work Type :</label></td>
        		<td>
					<?php echo $this->Form->select('UserBio.work_type',$this->requestAction('/commons/workList'),null,array('empty'=>'select','class'=>'width200'));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
      	     	
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Religion View :</label></td>
        		<td>
        			<?php echo $this->Form->select('UserBio.religion_view',$this->requestAction('/commons/relViewList'),null,array('empty'=>'select','class'=>'width200'));?>
				</td>
      	     </tr>
      	     
      	     <tr>
      	     	
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Religious Activity :</label></td>
        		<td>
        			<?php echo $this->Form->select('UserBio.religious_activity',$this->requestAction('/commons/relActivityList'),null,array('empty'=>'select','class'=>'width200'));?>
				</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Political View :</label></td>
        		<td> 
        			<?php echo $this->Form->select('UserBio.political_view',$this->requestAction('/commons/polViewList'),null,array('empty'=>'select','class'=>'width200'));?>
        		</td>
      	     </tr>

      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Living Arrangement :</label></td>
        		<td>
        			<?php echo $this->Form->select('UserBio.living_arrangement',$this->requestAction('/commons/livingList'),null,array('empty'=>'select','class'=>'width200'));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td></td>
        		<td>
        			<input type="submit" value="Update" class="button" style="width:80px;" />
        	       	<div class="buttonEnding rightclass"></div>  	
        	      	&nbsp;&nbsp;
        	        <input type="button" value="Cancel" class="button" style="width:80px;" onclick="javascript:location.href='/admins/listuser'"/>
	        	    <div class="buttonEnding rightclass"></div>
	        	  			
        			<?php //echo $this->Form->submit('Submit');?>
        		</td>
      	     </tr>
      	     
      </table>
	 </td>
   </tr>
</table>
<?php echo $this->Form->end();?>