<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />

<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.validate.js"></script>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/js/jquery.alerts.js"></script>
<script type="text/javascript" src="/js/jquery.validation.js"></script>  
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>


<?php echo $session->flash(); ?>	

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
        		<td class="left_title"><div class="leftclass"><h2>Message :</h2></div>
	        	    
				</td>
      	     </tr>
      	   </table>
	 </td>
   </tr>
   
   <tr>
 	<td>
    	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
        	<tr>
        		<td style="width: 185px;" align="left" valign="top"><label>From : </label></td>
        		<td><?php 
        				$id = $msgData['Message']['id'];
        				$messageUserFrom = $msgData['Message']['user_id_from'];
        				$msgFromUserData = $this->requestAction("/commons/findUserById/$messageUserFrom");
        				echo ucfirst($msgFromUserData['User']['name']);;
        				
        		
        			?>
        		</td>
      	     </tr>
			
			<tr>
				<td colspan="2"></td>
			</tr>	
		    
		     <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Message Type : </label></td>
        		<td><?php 
        				$msgType = $msgData['Message']['message_type'];
        				if($msgType=='0')
        				{
        					$msgTypeVal = "Normal Message";
        				}
        				elseif ($msgType=='1')
        				{
        					$msgTypeVal = "Notification";
        				}
        				elseif ($msgType=='2')
        				{
        					$msgTypeVal = "Warning";
        				}
        				elseif ($msgType=='3')
        				{
        					$msgTypeVal = "Feedback";
        				}
        				elseif ($msgType=='4')
        				{
        					$msgTypeVal = "Suggestion";
        				}
        				else
        				{
        					$msgTypeVal = "Other";
        				}
        				echo $msgTypeVal;
        			?>
        		</td>
      	     </tr>	     
      	   
      	     <tr>
				<td colspan="2"></td>
			 </tr>	
      	   
      	   	  <tr>
        		<td style="width: 185px;" align="left" valign="top"><label>Message  : </label></td>
        		<td><?php 
		        		echo $msgData['Message']['message'];
        			?>
        		</td>
      	     </tr>	     
      	   
      	     <tr>
				<td colspan="2"></td>
			 </tr>	
      	     
      	     
      	     <tr>
        		<td></td>
        		<td>
					<input type="button" value="Reply" class="button" style="width:80px;" onclick="javascript:location.href='/admins/replymessage/<?php echo $id;?>'"/>
	        	    <div class="buttonEnding rightclass"></div>
					 &nbsp;&nbsp;
	        	    <input type="button" value="Back" class="button" style="width:80px;" onclick="javascript:location.href='/admins/messagelist'"/>
	        	    <div class="buttonEnding rightclass"></div>
	        	   <?php //echo $this->Form->submit('Submit');?>
        		</td>
      	     </tr>
      	     
      </table>
	 </td>
   </tr>
</table>