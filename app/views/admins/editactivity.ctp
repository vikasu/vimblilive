<?php //pr($this->data);?>
<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<?php echo $javascript->link('admins/editactivity.js');?>
<?php $id = $this->data['Activity']['id'];?>

<?php echo $this->Form->create('Admin',array('name'=>'editactivity','id'=>'editactivity','action'=>"/editactivity/$id"));?>
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
        		<td class="left_title">Edit Activity:
	        	    
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
      	     <tr>
        		<td align="left" valign="top" style="width:150px;"><label>Activity Name *: </label></td>
				<td>      	     
					<?php   echo $this->Form->input('Activity.id',array('type'=>'hidden','value'=>$this->data['Activity']['id']));
							echo $this->Form->input('Activity.activity_name',array('div'=>false,'label'=>false,'type'=>'text','class'=>'width200'));?>        						
        		</td>
       	     </tr>    	     
      	      <tr>
      	      	<td></td>
      	      	<td></td>
      	      </tr>
      	     <tr>
      	     	<td></td>
        		<td align="left" valign="top">
        				<input type="submit" value="Save" class="button" style="width:80px;"/>
	        	    	<div class="buttonEnding rightclass"></div>
	        	    	&nbsp;&nbsp;
	        	    	<input type="button" value="Cancel" class="button" style="width:80px;" onclick="javascript:location.href='/admins/activitylist'"/>
	        	    	<div class="buttonEnding rightclass"></div>
        		</td>
      	     </tr>
      </table>
	 </td>
   </tr>
</table>
<?php echo $this->Form->end();?>