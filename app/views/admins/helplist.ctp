<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php echo $javascript->link('admins/helplist.js');?>
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
        	        <td class="left_title_new">
        	          <div style='float:left;'>
        	        	<h2>Help - <?php echo $helpcatname;?></h2> 
        	          </div>	
        	          <div class='rightclass'>
						<input type="button" value="Add Help Topic" class="button" style="width:100px;" onclick="javascript:location.href='/admins/addhelp/<?php echo $helpcatid;?>'"/>
        	        	<div class="buttonEnding rightclass"></div>
        	        	&nbsp;&nbsp;	
        	        	<input type="button" value="Cancel" class="button" style="width:80px;" onclick="javascript:location.href='/admins/helpcatlist'"/>
        	        	<div class="buttonEnding rightclass"></div>
        	        	
        	        	
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
      	    <form method="post" name="helpactionform" action ="/admins/helpactionform">
        	<tr>
        	    <td valign="top" class="grid_header"><table class="grid_brd" width="100%" border="0" cellpadding="0" cellspacing="0">
        	      <tr>
        	        <!-- <td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          <tr> -->
        	          	
        	          	<td width="25" align="center"><?php echo $this->Form->input("File.selectAll", array('class' => '', 'name' =>  'data[Help][selectAll]', 'value' => 1, 'type' => 'checkbox', 'div' => false, 'label' => '', 'escape' => false));?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	          
        	            <td width="65" class="left_padd"><?php echo $this->Paginator->sort('Help Topic', 'Help.help_topic'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="65" align="center">Status</td>
        	            <td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="65" align="center">Edit</td>
						<td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>        	            

						<td width="56" align="center">Delete</td>
        	            
       	              <!-- </tr>
      	             </table>
      	            </td> -->
      	          </tr>
      	          <?php //pr($fetchedhelplist);?>
        	        <?php if(count($fetchedhelplist)>0){?>
        	        <?php foreach ($fetchedhelplist as $fetchedhelpdata) {?>
        	        <tr>
        	        <!-- <td class="bot_brd">
        	          <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          <tr> -->

        	           <td width="25" align="center">
	        	          			    
	        	          			    <?php echo $this->Form->input('Help.catid',array('type'=>'hidden','value'=>$fetchedhelpdata['Help']['help_cat_id']));?>
	        	          				<input type = 'Checkbox' id= 'Userid_<?php echo $fetchedhelpdata['Help']['id'];?>' Name ='data[Help][id][]' value =<?php echo $fetchedhelpdata['Help']['id'];?>>
	        	          				<!-- <input type="checkbox" name="checkbox" id="checkbox" /> -->
	        	          		</td>
		        	            <td width="2">
		        	            	<img src="/img/header_seperator.gif" width="2" height="29" alt="" />
		        	    </td>
        	            
        	            <td width="65" class="left_padd bot_brd" style="padding-left:7px;">
        	            	<?php 
        	            			if(strlen($fetchedhelpdata['Help']['help_topic']))
        	            			{
        	            				$helpData = substr(strip_tags($fetchedhelpdata['Help']['help_topic']), 0,20).'....'; 
        	            			}
        	            			else
        	            			{
        	            				$helpData = strip_tags($fetchedhelpdata['Help']['help_topic']);
        	            			}
        	            			echo $helpData;
        	            	?>
        	            </td>
        	            <td width="2" class="bot_brd" align="center">&nbsp;</td>
			            
        	            <td width="65" align="center" class="bot_brd">
        	                <?php $id = $fetchedhelpdata['Help']['id'];
        	                      $catid = $fetchedhelpdata['Help']['help_cat_id'];
        	                ?>
        	            	<?php if($fetchedhelpdata['Help']['help_status'] ==1) { ?>
        	            		<a href="/admins/inactivehelp/<?php echo $catid;?>/<?php echo $id ?>">
        	            		 Published
        	            		 <!-- <img src="/img/status1.gif" width="20" title="Inactive" height="17" alt="" /> -->
        	            		</a> 
        	            	<?php }else{?>
        	            		<a href='/admins/activehelp/<?php echo $catid;?>/<?php echo $id ?>'>
        	            		 Unpublished
        	            		 <!-- <img src="/img/status2.gif" width="20" title="Active" height="17" alt="" /> -->
        	            		</a>
        	            	<?php }?>	
        	            
        	            </td>
           	            <td width="2" align="center" class="bot_brd">&nbsp;</td>
        	           
        	            <td width="65" align="center" class="bot_brd">
        	            	<a href="/admins/edithelp/<?php echo $catid;?>/<?php echo $id ?>"><img src="/img/edit_icon.gif" alt="" width="20" title="Edit" height="17" /></a>
        	            </td>
        	             <td width="2" align="center" class="bot_brd">&nbsp;</td>

        	            <td width="56" align="center" class="bot_brd">
        	            	<a href="/admins/deletehelp/<?php echo $catid;?>/<?php echo $id ?>"><img src="/img/delete_icon.png" alt="" title ="Delete" width="20" height="17" /></a>
		        	    </td>
		        	            
	      	          	 <!-- </tr>
	      	          	</table>
	      	          </td> -->
	      	          </tr>
      	          	<?php }}else{?>
      	            	 <tr>
	        	        <td class="bot_brd" colspan="10">
	        	          <table width="100%" border="0" cellspacing="0" cellpadding="0">
	        	          <tr>
		        	            <!-- <td width="25"><input type="checkbox" name="checkbox2" id="checkbox2" /></td> -->	        	       
		        	            <td colspan="10" align="center"> Data Not Found </td>
		        	            
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
						<td align="left"><input type="submit" name="data[Help][action]" value="Publish" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						<td align="left"><input type="submit" name="data[Help][action]" value="Unpublish" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						<td align="left"><input type="button" name="data[Help][action]" value="Delete" class="button" style="width:80px;" onclick ="javascript:confirmdeleteall();"/><div class="buttonEnding"></div></td>
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
						<td>Active Help Topic</td>
      	        
      	        		<td align="left"><img src="/img/status2.gif" width="20" height="17" alt="" /></td>
						<td>Inactive Help Topic</td>
      	        
      	        		<td align="left"><img src="/img/delete_icon.png" width="20" height="17" alt="" /></td>
						<td>Delete Help Topic</td>
      	        
      	        		<td align="left"><img src="/img/edit_icon.gif" width="20" height="17" alt="" /></td>
						<td>Edit Help Topic</td>
      	        </tr>  
      	        
      	      </table></td>
      	    </tr> --> 
        	  
      	      </table></td>
      	    </tr>
          </table>
          

          
          