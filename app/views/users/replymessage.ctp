<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<?php $userIdTo =  $messageDetails['Message']['user_id_to'];
	  //pr($messageDetails);
	  echo $javascript->link('admins/replymessage.js');
	  echo $session->flash(); ?>	
<?php $msgId = $messageDetails['Message']['id'];?>

<?php echo $this->Form->create('User',array('name'=>'replymsg','id'=>'replymsg','action'=>"/replymessage/$msgId"));?>
<?php echo $this->Form->input('Message.frommsg',array('type'=>'hidden','value'=>$messageDetails['Message']['user_id_to']));?>
<?php echo $this->Form->input('Message.tomsg',array('type'=>'hidden','value'=>$messageDetails['Message']['user_id_from']));?>
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
        		<td class="left_title"><div class="leftclass"><h2>Send a Message </h2></div>
	        	    
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
        	<!-- <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Message Type *: </label></td>
        		<td>
        			<?php //echo $this->Form->select('Message.message_type',$this->requestAction("/commons/messageType"),null,array('div'=>false,'label'=>false,'class'=>'inpttextarealogin','empty'=>'select'));?>
        		</td>
      	     </tr>  -->
      	     
      	     <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Reply To *: </label></td>
        		<td>
        		    <?php $userIdFrom = $messageDetails['Message']['user_id_from'];?>
        			<?php $messageTo = $this->requestAction("/commons/findUserById/$userIdFrom");?>
        			<?php echo $messageTo['User']['name'];//echo $this->Form->input('Message.users',array('div'=>false,'label'=>false,'class'=>'inpttextarealogin','readonly'=>true,'value'=>$messageTo['User']['name']));?>
        			<?php echo $this->Form->input('Message.user_id_to',array('type'=>'hidden','value'=>$userIdFrom));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Message *: </label></td>
        		<td>
        			<?php echo $this->Form->input('Message.message',array('div'=>false,'label'=>false,'class'=>'inpttextarealogin'));?>
        		</td>
      	     </tr>
      	     
      	     <tr>
        		<td></td>
        		<td>
					<input type="submit" value="Send" class="button" style="width:80px;" /><div class="buttonEnding"></div>
        	       	
 					&nbsp;&nbsp;
	        	    <input type="button" value="Cancel" class="button" style="width:80px;" onclick="javascript:location.href='/users/message'"/><div class="buttonEnding"></div>
	        	    
	        	   <?php //echo $this->Form->submit('Submit');?>
        		</td>
      	     </tr>
      	     
      </table>
	 </td>
   </tr>
</table>
<?php echo $this->Form->end();?>