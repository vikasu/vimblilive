<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
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
        	        	Manage Keywords :
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
        	<tr>
        	    <!-- <td valign="top">
        	    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="grid_brd">
        	      <tr> -->
        	        <td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid_brd">
        	          <tr>       	                 	            
        	            <td width="65" class="left_padd"><?php echo $this->Paginator->sort('Keyword Name', 'Keyword.keyword_name'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>												        	           				      	  
        	            <td width="65" align="center">Edit</td>
       	              <!-- </tr>
      	             </table>
      	            </td> -->
      	          </tr>
        	        <?php if(count($keywordlist)>0){?>
        	        <?php foreach ($keywordlist as $keywordData) { ?>
        	        <tr>
        	        <!-- <td>
        	          <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          <tr> -->
			            
        	            <td width="65" class="left_padd">
							<?php echo $keywordData['Keyword']['keyword_name']; ?>
        	            </td>
           	            <td width="2" align="center">&nbsp;</td>
        	            <td width="65" align="center">
        	            	<a href="/admins/editkeyword/<?php echo $keywordData['Keyword']['id'].'/'.$keywordData['Keyword']['activity_id'] ?>"><img src="/img/edit_icon.gif" alt="" width="20" title="Edit" height="17" /></a>
        	            </td>
		        	            
	      	          	 <!-- </tr>
	      	          	</table>
	      	          </td> -->
	      	          </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
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
        	    <td></td>
      	    </tr> 	      	    
       	      </table></td>
      	    </tr>
          </table>
          