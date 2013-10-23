<?php //pr($faqlist);die;?>
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php echo $javascript->link('admins/messagelist.js');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<img src="/img/spacer.gif" width="1" height="10" alt="" />
		</td>
	</tr>
	<tr>
		<td><img src="/img/spacer.gif" width="1" height="25" alt="" /></td>
	</tr>
    <tr> 
    	<td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
        	        <td class="left_title">
        	          <div style='float:left;'>
        	        	Manage Messages:
        	          </div>	
        	          <div class='rightclass' style="width:140px;">
        	           <input type="button" value="Send Message/Alerts" class="button" style="width:140px;" onclick="javascript:location.href='/admins/sendmessage'" /><div class="buttonEnding"></div>
					  </div>	
        	        
        	        </td>
        	        
      	          </tr>
        	      <tr>
        	        <td><img src="/img/spacer.gif" width="1" height="15" alt="" /></td>
      	          </tr>
        	      <tr>
        	        <td>
        	        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          		<tr>
        	            		<td align="right" class="paging">
	        	            		 <div class="rightclass">
	                        			<ul>
			                            	<li><?php echo $paginator->prev('Prev',array('class'=>'selected') , null, array('class'=>'disabled'));?></li>
	                        		        <li><?php echo $this->Paginator->numbers(array('class'=>'selected')); ?></li>
	                		                <li><?php echo $paginator->next('Next', array('class'=>'selected') , null, array('class'=>'disabled'));?></li>
	                            		</ul>
	                          		</div> 
			                        <div>
			                          	<?php echo $session->flash(); ?>	
					                </div> 
                        		</td>
      	            		</tr>
      	            	</table>
      	            </td>
      	          </tr>
      	      </table>
      	     </td>
      	    </tr>
        	<tr>
        	    <td>
        	    	<img src="/img/spacer.gif" width="1" height="5" alt="" /></td>
      	    </tr>
      	    <form method="post" name="messageatactionform" action ="/admins/messageaction">
        	<tr>
        	        <td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid_brd">
        	          <tr>
        	            
        	            <td width="25" align="center"><?php echo $this->Form->input("File.selectAll", array('class' => '', 'name' =>  'data[Message][selectAll]', 'value' => 1, 'type' => 'checkbox', 'div' => false, 'label' => '', 'escape' => false));?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	          
        	            <td width="65" class="left_padd"><?php echo $this->Paginator->sort('Message Type', 'Message.message_type'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
												        	           
						<td width="100" class="left_padd"><?php echo $this->Paginator->sort('Message', 'Message.message'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
						<td width="65" class="left_padd"><?php echo $this->Paginator->sort('Sent By', 'Message.user_id_from'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
						
        	            <td width="45" class="left_padd">&nbsp;&nbsp;Status</td>
        	            <td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>

        	            <td width="85" class="left_padd"><?php echo $this->Paginator->sort('Sent On', 'Message.created'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
						<td width="45" align="center">Delete</td>
      	          </tr>
      	          <?php //pr($messagelist);?>
        	        <?php if(count($messagelist)>0){?>
        	        <?php foreach ($messagelist as $messageData) { ?>
        	        <tr>
        	            <td width="25" align="center">
	        	          			
	        	          				<input type = 'Checkbox' class="attribute" id= 'Userid_<?php echo $messageData['Message']['id'];?>' Name ='data[Message][id][]' value =<?php echo $messageData['Message']['id'];?>>
	        	          				<!-- <input type="checkbox" name="checkbox" id="checkbox" /> -->
	        	         </td>
		        	     <td width="2">
		        	            	<img src="/img/header_seperator.gif" width="2" height="29" alt="" />
		        	     </td>
        	          
        	            <td width="65" class="left_padd">
        	            	<?php 
        	            			$id = $messageData['Message']['id'];
        	            			$msgType = $messageData['Message']['message_type'];
        	            			if($msgType=='0')
        	            			{
        	            				$msgTypeVal = "Normal";
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
        	            <td width="2" align="center">&nbsp;</td>
    
						<td width="100" class="left_padd">
							<?php 
        	            			$messageContent = $messageData['Message']['message'];
        	            			
        	            			if(strlen($messageData['Message']['message'])>20)
        	            			{
        	            				$messageContent = substr($messageData['Message']['message'],0,20);
        	            				$messageContent = $messageContent.'....';
        	            				echo "<a href=/admins/showmessage/$id>".$messageContent."</a>";
        	            			}
        	            			else
        	            			{
        	            				echo "<a href=/admins/showmessage/$id>".$messageContent."</a>";
        	            			}
        	            	?>
						</td>
        	            <td width="2" align="center">&nbsp;</td>
			                       	            
           	            <td width="65" class="left_padd">
        	             	<?php 
        	             			$messageUserFrom = $messageData['Message']['user_id_from'];
        	             			$msgFromUserData = $this->requestAction("/commons/findUserById/$messageUserFrom");
        	            			echo ucfirst($msgFromUserData['User']['name']);;
        	            	?>
        	             </td>
           	            <td width="2" align="center">&nbsp;</td>
           	            
        	           	<td width="45" class="left_padd">
        	             	<?php 
		        	             	$messageStatus = $messageData['Message']['message_status'];
		        	             	$msgStatus = $messageStatus!=0?"Read":"<a href=/admins/showmessage/$id><strong>Unread</strong></a>";
		        	             	echo $msgStatus;
        	             	?>
        	            </td>
           	            <td width="2" align="center">&nbsp;</td>
           	            
           	            <td width="85" class="left_padd">
        	             	<?php 
        	            			$messagetime = $messageData['Message']['created'];
        	            			echo date('n-j-Y g:i a',strtotime($messagetime));
        	            			//echo $messagetime;
        	            	?>
        	             </td>
           	            <td width="2" align="center">&nbsp;</td>

        	            <td width="45" align="center">
		        	            	<a href="/admins/deletemessage/<?php echo $id;?>"><img src="/img/delete_icon.png" alt="" title ="Delete" width="20" height="17" /></a>
		        	    </td>
	      	          </tr>
      	          	<?php }}else{?>
      	            	 <tr>
	        	        <td class="bot_brd" colspan="12">
	        	          <table width="100%" border="0" cellspacing="0" cellpadding="0">
	        	          <tr>
		        	            <!-- <td width="25"><input type="checkbox" name="checkbox2" id="checkbox2" /></td> -->	        	       
		        	            <td colspan="9" align="center"> Data Not Found </td>
	      	          	 </tr>
	      	          	</table>
	      	          </td>
	      	          </tr>
      	            <?php }?> 
      	          <!-- </table> --><!-- </td>
      	        </tr> --> 
      	          </table></td>
      	    </tr>
        	  <tr>
        	    <td>&nbsp;</td>
      	    </tr>
      	    <tr>
        	    <td><table width="40%" border="0" cellspacing="0" cellpadding="0">
        	      <tr>
						<td align="left"><input type="button" name="data[Faq][action]" value="Delete" class="button" style="width:80px;" onclick ="javascript:confirmdeleteall();"/><div class="buttonEnding"></div></td>
      	        </tr>  
      	      </table></td>
      	    </tr></form>
       	      </table></td>
      	    </tr>
          </table>