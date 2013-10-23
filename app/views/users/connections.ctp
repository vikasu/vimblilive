<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php //echo $javascript->link('admins/messagelist.js');?>
<div style="width:730px;margin:0 auto;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	   <tr>
    	<td>
        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
        	        <td class="left_title">
        	        	<span class='spnclass'>Connections:</span>
        	        </td>
        	        
      	          </tr>
        	     
        	      <tr>
        	        <td>
        	        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          		<tr>
        	            		<td class="paging">
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
      	    <tr><td>&nbsp;</td></tr>
        	<tr>
        	        <td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid_brd">
        	          <tr>
        	                    	          
        	            <td width="65" class="left_padd"><?php echo $this->Paginator->sort('Contact Name', 'SetupConnectivity.contact_name'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
												        	           
						<td width="80" class="left_padd"><?php echo $this->Paginator->sort('Number', 'SetupConnectivity.contact_phone'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
						<td width="65" class="left_padd"><?php echo $this->Paginator->sort('Touches/week', 'SetupConnectivity.touches'); ?></td>
						
        	            

      	          </tr>
      	          <?php //pr($messagelist);?>
        	        <?php if(count($setupConnectivitylist)>0){?>
        	        <?php foreach ($setupConnectivitylist as $setupConnectivityData) { ?>
        	        <tr>
        	        	
        	            <td width="65" class="left_padd">
        	            	<?php 
        	            		$id = $setupConnectivityData['SetupConnectivity']['id'];
        	            		echo $setupConnectivityData['SetupConnectivity']['contact_name'];
        	            	?>
        	            </td>
        	            <td width="2" align="center">&nbsp;</td>
    
						<td width="80" class="left_padd">
							<?php 
								echo $setupConnectivityData['SetupConnectivity']['contact_phone'];
        	            	?>
						</td>
        	            <td width="2" align="center">&nbsp;</td>
           	            
        	           	<td width="65" class="left_padd">
        	             	<?php 
        	             	echo $setupConnectivityData['SetupConnectivity']['touches'];
        	             	?>
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
      	    </table></td>
      	    </tr>
          </table>
          </div><div class="clear"></div>