<?php //pr($faqlist);die;?>

<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php echo $javascript->link('admins/suggestionlist.js');?>

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
        	        	Suggestions :
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
      	    <form method="post" name="suggestionactionform" action ="/admins/suggestionaction">
        	<tr>
        	        <td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid_brd">
        	          <tr>
        	            
        	            <td width="25" align="center"><?php echo $this->Form->input("File.selectAll", array('class' => '', 'name' =>  'data[Contactus][selectAll]', 'value' => 1, 'type' => 'checkbox', 'div' => false, 'label' => '', 'escape' => false));?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	          
        	            <td width="65" class="left_padd"><?php echo $this->Paginator->sort('Sender', 'Contactus.sender_name'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
												        	           
						<td width="80" class="left_padd"><?php echo $this->Paginator->sort('Sender Email', 'Contactus.sender_email'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
						<td width="65" class="left_padd"><?php echo $this->Paginator->sort('Subject', 'Contactus.subject'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
						
        	            <td width="65" class="left_padd"><?php echo $this->Paginator->sort('Message', 'Contactus.query'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="115" class="left_padd"><?php echo $this->Paginator->sort('Sent On', 'Contactus.created'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="60" class="left_padd"> Status</td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	                    	            
						<td width="56" align="center">Delete</td>
      	          </tr>
      	          <?php //pr($messagelist);?>
        	        <?php if(count($suggestionlist)>0){?>
        	        <?php foreach ($suggestionlist as $suggestiondata) { ?>
        	        <tr>
        	        	<?php 	$id = $suggestiondata['Contactus']['id'];?>
        	            <td width="25" align="center">
	        	          			
	        	          				<input type = 'Checkbox' class="attribute" id= 'Userid_<?php echo $suggestiondata['Contactus']['id'];?>' Name ='data[Contactus][id][]' value =<?php echo $suggestiondata['Contactus']['id'];?>>
	        	          				<!-- <input type="checkbox" name="checkbox" id="checkbox" /> -->
	        	         </td>
		        	     <td width="2">
		        	            	<img src="/img/header_seperator.gif" width="2" height="29" alt="" />
		        	     </td>
        	          
        	          
        	            <td width="65" class="left_padd">
        	            	<?php  
        	            		$sender = $suggestiondata['Contactus']['sender_name'];
        	            		echo $sender;
        	            	?>
        	            </td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
												        	           
						<td width="80" class="left_padd">
							<?php 
								$senderEmail = $suggestiondata['Contactus']['sender_email'];
								echo $senderEmail;
							?>
						</td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
						<td width="65" class="left_padd">
        	            	<?php 
        	            		
        	            			$msgType = $suggestiondata['Contactus']['subject'];
        	            			if($msgType=='Message')
        	            			{
        	            				$msgTypeVal = "Message";
        	            			}
        	            			elseif ($msgType=='Suggestion')
        	            			{
        	            				$msgTypeVal = "Suggestion";
        	            			}
        	            			elseif ($msgType=='Idea')
        	            			{
        	            				$msgTypeVal = "Idea";
        	            			}
        	            			else
        	            			{
        	            				$msgTypeVal = "Other";
        	            			}        	            			
        	            			echo $msgTypeVal;
        	            	?>
        	            </td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
						
        	            <td width="65" class="left_padd">
							<?php 
								$message = $suggestiondata['Contactus']['query'];
								if(strlen($message)>10)
								{
									$suggmsg = substr($message, 0,10);
							?>
									<a href="/admins/showsuggestion/<?php echo $id;?>">
										<?php echo $suggmsg.'....';?>
									</a>
							<?php }
								else
								{
								?>
									<a href="/admins/showsuggestion/<?php echo $id;?>">
										<?php echo $message;?>
							 		</a>
							 	<?php	
								}
							 ?>
        	            
        	            </td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
	
        	            <td width="115" class="left_padd">
        	            	<?php 
        	            			$messagetime = $suggestiondata['Contactus']['created'];
        	            			echo date('m-d-Y h:i a',strtotime($messagetime));
        	            			//echo $messagetime;
        	            	?>        	            </td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
    
    					 <td width="60" class="left_padd">
    					 	<?php 
		        	             	$messageStatus = $suggestiondata['Contactus']['suggestion_status'];
		        	             	$msgStatus = $messageStatus!=0?"Read":"<a href=/admins/showsuggestion/$id><strong>Unread</strong></a>";
		        	             	echo $msgStatus;
        	             	?>
  		       	         </td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
    
    
        	            <td width="56" align="center">
		        	            	<a href="/admins/deletesuggestion/<?php echo $id;?>"><img src="/img/delete_icon.png" alt="" title ="Delete" width="20" height="17" /></a>
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
          