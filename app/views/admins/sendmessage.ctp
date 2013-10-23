<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>

<?php echo $javascript->link('admins/sendmessage.js');?>
<?php echo $session->flash(); ?>	

<?php echo $this->Form->create('Admin',array('name'=>'sendmsg','id'=>'sendmsg'));?>
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
        		<td class="left_title"><div class="leftclass"><h2>Send Message/Alerts :</h2></div>
	        	    
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
        	<tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Message Type *: </label></td>
        		<td>
        			<?php echo $this->Form->select('Message.message_type',$this->requestAction("/commons/messageType"),null,array('div'=>false,'label'=>false,'class'=>'width200','empty'=>'select'));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Select User *: </label></td>
        		<td>
        			<?php echo $this->Form->select('Message.users',$this->requestAction("/commons/UserList"),null,array('div'=>false,'label'=>false,'class'=>'width200','style'=>'height:150px','multiple' => true));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Message *: </label></td>
        		<td>
        			<?php echo $this->Form->input('Message.message',array('div'=>false,'label'=>false,'class'=>'width200'));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td></td>
        		<td>
					<input type="submit" value="Send" class="button" style="width:80px;" />
        	       	<div class="buttonEnding rightclass"></div>
 					&nbsp;&nbsp;
	        	    <input type="button" value="Cancel" class="button" style="width:80px;" onclick="javascript:location.href='/admins/messagelist'"/>
	        	    <div class="buttonEnding rightclass"></div>
	        	   <?php //echo $this->Form->submit('Submit');?>
        		</td>
      	     </tr>
      	     
      </table>
	 </td>
   </tr>
</table>
<?php echo $this->Form->end();?>