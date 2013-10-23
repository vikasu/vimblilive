<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<?php //echo $this->Form->create('Admin',array('name'=>'signup','id'=>'signup'));?>
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
        		<td class="left_title">User Details:
	        	   
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
        	<tr>
        		<td style="width: 185px;" align="left" valign="top"><label>First Name : </label></td>
        		<td>	
        			<?php //echo //$this->Form->input('User.id');?>
        			<?php echo $userData['User']['name'];?>
      	     </tr>
      	     
      	     <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Last Name : </label></td>
        		<td>	
        			<?php $userLastName = $userData['User']['last_name']!=''?ucfirst($userData['User']['last_name']):'N/A'; ?>
        			<?php echo $userLastName;?>
      	     </tr>
      	     
      	     <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Email : </label></td>
        		<td>	
        			<?php //echo //$this->Form->input('User.id');?>
        			<?php echo $userData['User']['email'];?>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top">
        			<label for="UserBioEmploymentGender">Gender :</label>
				</td>
				<td>		
					<?php if($userData['UserBio']['gender']=='M'){echo "Male"; }else{echo "Female";}?>
				</td>
				
      	     </tr>

      	     <tr>
        		<td align="left" valign="top">
        			<label for="UserBioEmploymentGender">DOB :</label>
				</td>
				<td>		
					<?php echo date("m-d-Y",strtotime($userData['UserBio']['dob']));?>
				</td>
				
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Current Weight(lbs) :</label></td>
        		<td>	
        		<?php 
        				$userweight = $userData['UserBio']['weight_current']!=''?$userData['UserBio']['weight_current']:'N/A';
        				echo $userweight;
        		?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Current Height(ft/inch) :</label></td>
        		<td>	
        		<?php 
        				$userheight = $userData['UserBio']['height_current']!=''?$userData['UserBio']['height_current']:'N/A';
        				echo $userheight;
        		?>
        		</td>
      	     </tr>
      	     
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentCity">City :</label></td>
        		<td><?php 
        				$usercity = $userData['UserBio']['city']!=''?$userData['UserBio']['city']:'N/A';
        				echo $usercity;
        			?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentState">State :</label></td>
        		<td>
				<?php 
						$userstate = $userData['UserBio']['state']!=''?$userData['UserBio']['state']:'N/A';
        				echo $userstate;
        		?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentCountry">Country :</label></td>
        		<td>
        		 <?php 
        				$usercnt = $userData['UserBio']['country']!=''?$userData['UserBio']['country']:'N/A';
        				echo $usercnt;
        		 ?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentZip">Zip :</label></td>
        		<td>
        		<?php 
        				$userZIP = $userData['UserBio']['zip']!=''?$userData['UserBio']['zip']:'N/A';
        				echo $userZIP;
        		?>
        		</td>
       	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Relationship Status :</label></td>
        		<td>
        		<?php 
        			$userrelstatus = $userData['UserBio']['relationship_status']!=''?$userData['UserBio']['relationship_status']:'N/A';
        			echo $userrelstatus;
        		?>
        		</td>
      	     </tr>
      	     
      	    <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Household Income :</label></td>
        		<td>
        		<?php 
        			$userincome = $userData['UserBio']['household_income']!=''?$userData['UserBio']['household_income']:'N/A';
        			echo $userincome;
        		?>
        		</td>
      	     </tr>
      	     
     	    <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Highest Education :</label></td>
        		<td>
        		<?php 
	       			$usereducation = $userData['UserBio']['education_highest']!=''?$userData['UserBio']['education_highest']:'N/A';
        			echo $usereducation;
        		?>
        		</td>
      	     </tr>
      	           	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Employment Status :</label></td>
        		<td>	
        		<?php 
        			$useremploy = $userData['UserBio']['employment_status']!=''?$userData['UserBio']['employment_status']:'N/A';
        			echo $useremploy;	
        		?>
        		</td>
      	     </tr>

      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Employemet Industry :</label></td>
        		<td>
        		<?php 
        				$userIndustry = $userData['UserBio']['employment_industry']!=''?$userData['UserBio']['employment_industry']:'N/A';
        				echo $userIndustry;
        		?>
       			</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"> <label for="UserBioEmploymentStatus">Work Type :</label></td>
        		<td>
        		<?php 
        				$userwork = $userData['UserBio']['work_type']!=''?$userData['UserBio']['work_type']:'N/A';
        				echo $userwork;
        		?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Religion View :</label></td>
        		<td>
        		<?php 
        				$userrelview = $userData['UserBio']['religion_view']!=''?$userData['UserBio']['religion_view']:'N/A';
        				echo $userrelview;
        		?>
				</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Religious Activity :</label></td>
        		<td>
        		<?php 
        				$userrelactivity = $userData['UserBio']['religious_activity']!=''?$userData['UserBio']['religious_activity']:'N/A';
        				echo $userrelactivity;
        		?>
				</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Political View :</label></td>
        		<td> 
        		<?php 
        				$userpolview = $userData['UserBio']['political_view']!=''?$userData['UserBio']['political_view']:'N/A';
        				echo $userpolview;
        		?>
        		</td>
      	     </tr>

      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Living Arrangement :</label></td>
        		<td>
        		<?php 
        				$userlivara = $userData['UserBio']['living_arrangement']!=''?$userData['UserBio']['living_arrangement']:'N/A';
        				echo $userlivara;
        		?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td align="left" valign="top"><label for="UserBioEmploymentStatus">Last Login Through :</label></td>
        		<td>
        		<?php 
        				$lastAppUsed = $userData['User']['last_uses'];
        				if($lastAppUsed==0)
        				{
        					echo "Website";
        				}
        				else
        				{
        					echo "Mobile";
        				}
        		?>
        		</td>
      	     </tr>
      	     
      	     <tr><td>&nbsp;</td></tr>
      	     <tr>
        		
        		<td>
        			<input type="button" value="Edit" class="button" style="width:80px;" onclick="javascript:location.href='/admins/edituser/<?php echo $userData['User']['id']?>'"/>
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