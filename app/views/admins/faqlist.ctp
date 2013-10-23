<?php //pr($faqlist);die;?>
<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php echo $javascript->link('admins/faqlist.js');?>
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
        	        	Manage FAQ :
        	          </div>	
        	          <div class='rightclass' style="width:90px;">
						<input type="button" value="Add FAQ" class="button" style="width:80px;" onclick="javascript:location.href='/admins/addfaq'"/>
        	        	<div class="buttonEnding"></div>
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
      	    <form method="post" name="faqatactionform" action ="/admins/faqaction">
        	<tr>
        	    <!-- <td valign="top">
        	    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="grid_brd">
        	      <tr> -->
        	        <td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid_brd">
        	          <tr>
        	            
        	            <td width="25" align="center"><?php echo $this->Form->input("File.selectAll", array('class' => '', 'name' =>  'data[Faq][selectAll]', 'value' => 1, 'type' => 'checkbox', 'div' => false, 'label' => '', 'escape' => false));?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	          
        	            <td width="65" class="left_padd"><?php echo $this->Paginator->sort('FAQ Qusetion', 'Faq.faq_que'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
												        	           
						<td width="65" align="left_padd"><?php echo $this->Paginator->sort('FAQ Answer', 'Faq.faq_ans'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="65" class="left_padd">&nbsp;&nbsp;Status</td>
        	            <td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="65" align="center">Edit</td>
						<td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>        	            

						<td width="56" align="center">Delete</td>
        	            
       	              <!-- </tr>
      	             </table>
      	            </td> -->
      	          </tr>
        	        <?php if(count($faqlist)>0){?>
        	        <?php foreach ($faqlist as $faqData) {?>
        	        <tr>
        	        <!-- <td>
        	          <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          <tr> -->
        	            <td width="25" align="center">
	        	          			
	        	          				<input type = 'Checkbox' class="attribute" id= 'Userid_<?php echo $faqData['Faq']['id'];?>' Name ='data[Faq][id][]' value =<?php echo $faqData['Faq']['id'];?>>
	        	          				<!-- <input type="checkbox" name="checkbox" id="checkbox" /> -->
	        	          		</td>
		        	            <td width="2">
		        	            	<img src="/img/header_seperator.gif" width="2" height="29" alt="" />
		        	    </td>
        	          
        	            <td width="65" class="left_padd">
        	            		<?php 
        	            				if(strlen($faqData['Faq']['faq_que'])>10)
        	            				{
        	            					$faqDataList = substr(strip_tags($faqData['Faq']['faq_que']),0,10).'....';
        	            				}
        	            				else
        	            				{
        	            					$faqDataList = strip_tags($faqData['Faq']['faq_que']);
        	            				}
        	            				echo $faqDataList;
        	            		
        	            		?></td>
        	            <td width="2" align="center">&nbsp;</td>
    
						<td width="65" class="left_padd">
							<?php 
									if(strlen($faqData['Faq']['faq_ans'])>10)
									{
											$faqDataAnsList = substr(strip_tags($faqData['Faq']['faq_ans']),0,10).'....';
										
									}
									else 
									{
										$faqDataAnsList = strip_tags($faqData['Faq']['faq_ans']);
									}	
									
									echo $faqDataAnsList; 
							?>
						</td>
        	            <td width="2" align="center">&nbsp;</td>
			            
        	            <td width="65" class="left_padd">
        	                <?php $id = $faqData['Faq']['id'];?>
        	            	<?php if($faqData['Faq']['faq_status'] ==1) { ?>
        	            		<a href="/admins/inactivefaq/<?php echo $id ?>">
        	            		 Published
        	            		 <!-- <img src="/img/status1.gif" width="20" title="Inactive" height="17" alt="" /> -->
        	            		</a> 
        	            	<?php }else{?>
        	            		<a href='/admins/activefaq/<?php echo $id ?>'>
        	            		 Unpublished
        	            		 <!-- <img src="/img/status2.gif" width="20" title="Active" height="17" alt="" /> -->
        	            		</a>
        	            	<?php }?>	
        	            
        	            </td>
           	            <td width="2" align="center">&nbsp;</td>
        	            <td width="65" align="center">
        	            	<a href="/admins/editfaq/<?php echo $id ?>"><img src="/img/edit_icon.gif" alt="" width="20" title="Edit" height="17" /></a>
        	            </td>

        	            <td align="center" width="2">&nbsp;</td>	
        	            <td width="56" align="center">
		        	            	<a href="/admins/deletefaq/<?php echo $id ?>"><img src="/img/delete_icon.png" alt="" title ="Delete" width="20" height="17" /></a>
		        	    </td>
		        	            
	      	          	 <!-- </tr>
	      	          	</table>
	      	          </td> -->
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
						<td align="left"><input type="submit" name="data[Faq][action]" value="Publish" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						<td align="left"><input type="submit" name="data[Faq][action]" value="Unpublish" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						<td align="left"><input type="button" name="data[Faq][action]" value="Delete" class="button" style="width:80px;" onclick ="javascript:confirmdeleteall();"/><div class="buttonEnding"></div></td>
      	        </tr>  
      	      </table></td>
      	    </tr></form>
      	    
      	    <!-- <tr>
        	 	<td> 
        	 		Legend :
        	 	</td>
        	 </tr>
        	 <tr>
        	 	<td>&nbsp;</td>
        	 </tr>
        	<tr>
        	    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        	      <tr>
						<td align="left"><img src="/img/status1.gif" width="20" height="17" alt="" /></td>
						<td>Actiave FAQ</td>
      	        
      	        		<td align="left"><img src="/img/status2.gif" width="20" height="17" alt="" /></td>
						<td>Deactiave FAQ</td>
      	        
      	        		<td align="left"><img src="/img/delete_icon.png" width="20" height="17" alt="" /></td>
						<td>Delete FAQ</td>
      	        
      	        		<td align="left"><img src="/img/edit_icon.gif" width="20" height="17" alt="" /></td>
						<td>Edit FAQ</td>
      	        </tr>  
      	        
      	      </table></td>
      	    </tr> -->
      	    
      	    
       	      </table></td>
      	    </tr>
          </table>
          