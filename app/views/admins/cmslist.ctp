<?php //pr($fetchedcmslist);?>

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
        	        	Manage Cms:
        	          </div>	
        	          <div class='rightclass'>
						<input type="button" value="Add Cms" class="button" style="width:80px;" onclick="javascript:location.href='/admins/addcms'"/>
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
			                        <div style="float:left;">
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
        	<tr>
        	    <td valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="grid_brd">
        	      <tr>
        	        <td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          <tr>
        	            <td width="65" class="left_padd"><?php echo $this->Paginator->sort('Page Title', 'Cmspage.page_title'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
												        	           
						<td width="65" align="left_padd"><?php echo $this->Paginator->sort('Position', 'Cmspage.link_pos'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="65" align="center">Status</td>
        	            <td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="65" align="center">Edit</td>
						<td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>        	            

						<td width="56" align="center">Delete</td>
        	            
       	              </tr>
      	             </table>
      	            </td>
      	          </tr>
        	        <?php if(count($fetchedcmslist)>0){?>
        	        <?php foreach ($fetchedcmslist as $cmsData) {?>
        	        <tr>
        	        <td class="bot_brd">
        	          <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          <tr>
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
											$showLink = 'Header and Footer both';
										}
											
										echo $showLink;
								?>
						</td>
        	            <td width="2" align="center">&nbsp;</td>
			            
        	            <td width="65" align="center">
        	                <?php $id = $cmsData['Cmspage']['id'];?>
        	            	<?php if($cmsData['Cmspage']['cms_status'] ==1) { ?>
        	            		<a href="/admins/cmsinactive/<?php echo $id ?>">
        	            		 <img src="/img/status1.gif" width="20" title="Inactive" height="17" alt="" />
        	            		</a> 
        	            	<?php }else{?>
        	            		<a href='/admins/cmsactive/<?php echo $id ?>'>
        	            		 <img src="/img/status2.gif" width="20" title="Active" height="17" alt="" />
        	            		</a>
        	            	<?php }?>	
        	            
        	            </td>
           	            <td width="2" align="center">&nbsp;</td>
        	            <td width="65" align="center">
        	            	<a href="/admins/editcms/<?php echo $id ?>"><img src="/img/edit_icon.gif" alt="" width="20" title="Edit" height="17" /></a>
        	            </td>

        	            <td width="56" align="center">
		        	            	<a href="/admins/deletecms/<?php echo $id ?>"><img src="/img/delete_icon.png" alt="" title ="Delete" width="20" height="17" /></a>
		        	    </td>
		        	            
	      	          	 </tr>
	      	          	</table>
	      	          </td>
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
        	  <!--<tr>
        	    <td><table width="40%" border="0" cellspacing="0" cellpadding="0">
        	      <tr>
						<td align="left"><input type="submit" value="Activate" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						<td align="left"><input type="submit" value="Deactivate" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						<td align="left"><input type="submit" value="Delete" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
      	        </tr>  -->
      	      </table></td>
      	    </tr>
          </table>
          

          
          