<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<?php echo $javascript->link('users/timegoal.js');?>

<?php 
	echo $session->flash(); 
?>	

<?php echo $this->Form->create('User',array('name'=>'timegoal','id'=>'timegoal'));?>
<?php echo $this->Form->input('SetupTimecare.id',array('type'=>'hidden'));?>
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
        		<td class="left_title"><h2>Time Goal:</h2>
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
      	     <tr>
        		<td align="left" valign="top" width="30%">
        			<label for="UserBioEmploymentStatus"> 
        				How long to you like to spend on a task without interruption or a break?
        			</label>
        		</td>
        		<td valign="top">
        			<?php echo $this->Form->select('SetupTimecare.productive_time_slot',$this->requestAction('/commons/commonGoalMinList'),null,array('empty'=>'Select','style'=>'width: 150px','class'=>'inpttextareaselect'));?>
				</td>
      	     </tr>
      	     
      	     
      	     <tr>
      	     	<td>&nbsp;</td>
      	     </tr>
      	     
      	     
      	     <tr>
        		<td align="left" valign="top" width="30%">
        			<label for="UserBioEmploymentStatus">
        				How much of a good day is typically scheduled?
        			</label>
        		</td>
        		<td valign="top"> 
        			<?php echo $this->Form->select('SetupTimecare.schedule_level',$this->requestAction('/commons/commonDaySchList'),null,array('empty'=>'Select','style'=>'width: 150px','class'=>'inpttextareaselect'));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td></td>
        		<td>
        			<div>
    					<input type="submit" value="Update" class="button" style="width:75px;"/><div class="buttonEnding"></div>
					</div>
        		</td>
      	     </tr>
      	     
      </table>
	 </td>
   </tr>
</table>
<?php echo $this->Form->end();?>