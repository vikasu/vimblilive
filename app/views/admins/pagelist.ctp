<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php echo $javascript->link('admins/pagelist.js');?>

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
        	        	Manage Pages:
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
      	    <form method="post" name="pageactionform" action ="/admins/pageactions">
        	<tr>
        	    <td valign="top" class="grid_header"><table class="grid_brd" width="100%" border="0" cellpadding="0" cellspacing="0" class="grid_brd">
        	      <tr>
        	
        	<!-- <tr>
        	    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="grid_brd">
        	      <tr>
        	        <td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          <tr> -->
        	          	<td width="25" align="center"><?php echo $this->Form->input("File.selectAll", array('class' => '', 'name' =>  'data[Cmspage][selectAll]', 'value' => 1, 'type' => 'checkbox', 'div' => false, 'label' => '', 'escape' => false));?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	          	
        	          
        	            <td width="65" class="left_padd"><?php echo $this->Paginator->sort('Page Title', 'Cmspage.page_title'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
												        	           
						<td width="65" class="left_padd"><?php echo $this->Paginator->sort('Position', 'Cmspage.link_pos'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="65" class="left_padd">&nbsp;Status</td>
        	            <td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="65" align="center">Edit</td>
						
        	            
       	              <!-- </tr>
      	             </table>
      	            </td> -->
      	          </tr>
        	        <?php if(count($fetchedcmslist)>0){?>
        	        <?php foreach ($fetchedcmslist as $cmsData) {?>
        	        <tr>
        	        <!-- <td>
        	          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid_brd">
        	          <tr> -->
        	          	<td width="25" align="center">
	        	          			
	        	          				<input type = 'Checkbox' id= 'Userid_<?php echo $cmsData['Cmspage']['id'];?>' Name ='data[Cmspage][id][]' value =<?php echo $cmsData['Cmspage']['id'];?>>
	        	          				<!-- <input type="checkbox" name="checkbox" id="checkbox" /> -->
	        	          		</td>
		        	            <td width="2">
		        	            	<img src="/img/header_seperator.gif" width="2" height="29" alt="" />
		        	    </td>
        	          	
        	            <td width="65" class="left_padd"><?php echo $cmsData['Cmspage']['page_title']; ?></td>
        	            <td width="2" align="center">&nbsp;</td>
    
						<td width="65" class="left_padd">
								<?php  
										$link_pos = $cmsData['Cmspage']['link_pos']; 
										if($link_pos==1)
										{
											$showLink = 'Header';
										}
										elseif($link_pos==2)
										{
											$showLink = 'Footer';
										}
										else
										{
											$showLink = 'Header and Footer';
										}
											
										echo $showLink;
								?>
						</td>
        	            <td width="2" align="center">&nbsp;</td>
			            
        	            <td width="65" class="left_padd">
        	                <?php $id = $cmsData['Cmspage']['id'];?>
        	            	<?php if($cmsData['Cmspage']['cms_status'] ==1) { ?>
        	            		<a href="/admins/pageunpublish/<?php echo $id ?>">
        	            		 Published	
        	            		 <!-- <img src="/img/status1.gif" width="20" title="Unpublish" height="17" alt="" /> -->
        	            		</a> 
        	            	<?php }else{?>
        	            		<a href='/admins/pagepublish/<?php echo $id ?>'>
        	            		 Unpublished 
        	            		 <!-- <img src="/img/status2.gif" width="20" title="Publish" height="17" alt="" /> -->
        	            		</a>
        	            	<?php }?>	
        	            
        	            </td>
           	            <td width="2" align="center">&nbsp;</td>
        	            <td width="65" align="center">
        	            	<a href="/admins/pageedit/<?php echo $id ?>"><img src="/img/edit_icon.gif" alt="" width="20" title="Edit" height="17" /></a>
        	            </td>
		        	            
	      	          	 <!-- </tr>
	      	          	</table>
	      	          </td> -->
	      	          </tr>
      	          	<?php }}else{?>
      	            	 <tr>
	        	        <td class="bot_brd">
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
        	    <td><table width="27%" border="0" cellspacing="0" cellpadding="0">
        	      <tr>
						<td align="left"><input type="submit" name="data[Cmspage][action]" value="Publish" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						<td align="left"><input type="submit" name="data[Cmspage][action]" value="Unpublish" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						 	
      	        </tr>  
      	      </table></td>
      	    </tr>
      	    </form>
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
						<td align="left"><img src="/img/status1.gif" width="20" height="17" alt="" />
							&nbsp;&nbsp;Publish Page
						</td>
      	        
      	        		<td align="left"><img src="/img/status2.gif" width="20" height="17" alt="" />
      	        			&nbsp;&nbsp;Unpublish Page
      	        		</td>
      	        
      	        		<td align="left"><img src="/img/edit_icon.gif" width="20" height="17" alt="" />
      	        			&nbsp;&nbsp;Edit Page</td>
      	        </tr>
      	        </table></td>
      	    </tr> -->
      	     </table></td>
      	    </tr>
          </table>
          

          
          