        	<?php //pr($fetcheduser)?>
        	
        	<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
	 		<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
        	<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        	
        	<script type="text/javascript">
			$(function() {
				$( "#textfield2" ).datepicker({
					dateFormat: 'yy-mm-dd',
					changeMonth: true,
					changeYear: true
				});
			});
			</script>
        	
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
        	        <td class="left_title">Search:
        	          <div class="rightclass">
        	        	<input type="button" value="Add User" class="button" style="width:80px;" onclick="javascript:location.href='/admins/adduser'"/>
        	        	<div class="buttonEnding rightclass"></div>
        	         </div>	
        	        </td>
      	          </tr>
      	          <form method="post" >
        	      <tr>
        	        <td>
        	        	<table width="100%" border="0" cellspacing="5px" cellpadding="0">
	        	          	<tr>
	        	            	<td colspan="5" align="left"><img src="/img/spacer.gif" width="1" height="20" alt="" /></td>
	       	              	</tr>
	        	          	
	        	          	<!--<tr>
		        	            <td align="left"></td>
		        	            <td align="left"></td>
		        	            <td align="left">Search in:</td>
		        	            <td align="left">&nbsp;</td>
		        	            <td align="left">&nbsp;</td>
	      	                </tr>-->
	      	                
	      	                <tr>
	      	                
		        	            <td>
			        	            <input type="radio" name="data[User][searchOption]" checked value="appuser" id="appuser" onclick ="javascript: changeDiv(this);" /> Search:
								</td> 
							
								<td>
									<input type="text" name="data[User][searchFieldNoDate]" id="textfield1" style="width:150px;margin-left: 3px;"/>
								</td> 

								<td>
  								 		<input type="radio" name="data[User][searchOption]" checked value="appuser" id="appuser" onclick ="javascript: changeDiv(this);" /> Advance Search:
  								</td>
  							
  								<td>					 		
							        	<input type="text" name="data[User][searchFieldNoDate]" id="textfield1" style="width:150px;"/>
				        	             <select style="width:150px;">
				        	             		<option>Select</option>
				        	             		<option>App User</option>
				        	             		<option>Location</option>
				        	             </select>
								 </td>
								 
							</tr>
							<tr>
								<td></td>
								<td align="left">
		        	            	<input type="submit" value="Search" class="button" style="width:74px;"/><div class="buttonEnding"></div>
		        	            	<!-- </td>
		        	            	<td align="left"> -->
		        	            	<input type="reset" value="Clear" class="button" style="width:72px;"/><div class="buttonEnding"></div>
		        	            </td>
								<td>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Between:
								</td>
								<td>
									<input type="text" name="data[User][searchFieldDate]" id="textfield2" style="width:150px;" <?php if(isset($serachData)) { ?> value="<?php echo $serachData;?>"<?php } ?> />
									<input type="text" name="data[User][searchFieldDate]" id="textfield2" style="width:150px;" <?php if(isset($serachData)) { ?> value="<?php echo $serachData;?>"<?php } ?> />
								</td>						
							</tr>
	      	                
	      	                
	        	          	<!--  <tr>
		        	            <td colspan="3">
		        	             <div style="float:left;">
			        	            <input type="radio" name="data[User][searchOption]" checked value="appuser" id="appuser" onclick ="javascript: changeDiv(this);" /> App User
									<input type="radio" name="data[User][searchOption]"  value="joindate" id = "joindate" <?php if(isset($datesearch)) { echo "checked";} ?> onclick ="javascript: changeDiv(this);" /> Join Date
									<input type="radio" name="data[User][searchOption]" value="location" id = "location" onclick ="javascript: changeDiv(this);" <?php if(isset($location)) { echo "checked";} ?> /> Geography Based 
								 </div>	
								 <div id='divNoDate' style="float:left; margin-left:5px;<?php if(isset($datesearch)) { echo "display:none"; } ?>;">
		        	            	<input type="text" name="data[User][searchFieldNoDate]" id="textfield1" style="width:150px;" <?php if(isset($serachData)) { ?> value="<?php echo $serachData;?>"<?php } ?> />
		        	             </div> 
		        	             <div id='divByDate' style=" float:left; margin-left:5px; <?php if(isset($datesearch)) { echo "display:block";  }else{ echo "display:none;";}?> ;" >
		        	                <input type="text" name="data[User][searchFieldDate]" id="textfield2" style="width:150px;" <?php if(isset($serachData)) { ?> value="<?php echo $serachData;?>"<?php } ?> />
		        	             </div>
									
									
						         </td> 
		        	            
		        	            
		        	            <td align="left"><input type="submit" value="Search" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
		        	            <td align="left"><input type="reset" value="Clear" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
		      	            </tr>
		      	            -->
	    	 	         </table>
	    	 	     </td>
      	           </tr>
      	           </form>
      	      </table>
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
        	        	Manage Users:
        	          </div>	
        	          <div class='rightclass'>
        	        	 <a href="/admins/exportuserlistcsv">CSV</a> | <a href="/admins/exportuserlistexcel">EXCEL</a> | <a href="/admins/exportuserlistpdf">PDF</a>
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
		                                <!-- <li class="selected"><a href="#" title="">1</a></li>
		                                <li><a href="#" title="">2</a></li>
		                                <li><a href="#" title="">3</a></li>  -->
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
        	                    	            
        	            <td width="56" class="left_padd"><?php echo $this->Paginator->sort('User Name', 'User.name'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <!-- <td width="180" class="left_padd"> --><?php //echo $this->Paginator->sort('Email', 'User.email'); ?><!-- </td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td> -->
        	           
        	            <td width="56" align="center"><?php echo $this->Paginator->sort('City', 'UserBio.city'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	           
        	            <td width="56" align="center"><?php echo $this->Paginator->sort('State', 'UserBio.state'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	           
						<td width="56" align="center"><?php echo $this->Paginator->sort('Country', 'UserBio.country'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
						        	           
        	           
        	            <td width="85" align="center"><?php echo $this->Paginator->sort('Join Date', 'User.join_date'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	       
        	            <td width="56" align="center">Status</td>
        	            <td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="56" align="center">Edit</td>
        	            <td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="56" align="center">Delete</td>
        	            
       	              </tr>
      	             </table>
      	            </td>
      	          </tr>
        	      <!-- <tr>
        	        <td class="bot_brd"> -->
        	         <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0"> -->
        	        <?php if(count($fetcheduser)>0){?>
	        	        <?php foreach ($fetcheduser as $userData) {?>
	        	        <tr>
	        	        <td class="bot_brd">
	        	          <table width="100%" border="0" cellspacing="0" cellpadding="0">
	        	          <tr>
		        	            <td width="56" class="left_padd"><a href="mailto:<?php echo $userData['User']['email'];?>"><?php echo $userData['User']['name']; ?></a></td>
		        	            <td width="2">&nbsp;</td>
		        	       
		        	            <!-- <td width="180" class="left_padd"> --><?php //echo $userData['User']['email']; ?><!-- </td>
		        	            <td width="2">&nbsp;</td> -->
		   
		        	            <td width="56" align="left_padd"><?php echo $userData['UserBio']['city']; ?></td>
		        	            <td width="2">&nbsp;</td>
		        	            
		        	            <td width="56" align="left_padd"><?php echo $userData['UserBio']['state']; ?></td>
		        	            <td width="2">&nbsp;</td>
		        	            
		        	            <td width="56" align="left_padd"><?php echo $userData['UserBio']['country']; ?></td>
		        	            <td width="2">&nbsp;</td>
		        	            
		        	            <td width="85" align="left_padd"><?php echo $userData['User']['join_date'] ;?></td>
		        	            <td width="2" align="center">&nbsp;</td>

		        	            <td width="56" align="center">
		        	                <?php $id = $userData['User']['id'];?>
		        	            	<?php if($userData['User']['user_status'] ==1) { ?>
		        	            		<a href="/admins/inactive/<?php echo $id ?>">
		        	            		 <img src="/img/status1.gif" width="20" height="17" alt="" />
		        	            		</a> 
		        	            	<?php }else{?>
		        	            		<a href='/admins/active/<?php echo $id ?>'>
		        	            		 <img src="/img/status2.gif" width="20" height="17" alt="" />
		        	            		</a>
		        	            	<?php }?>	
		        	            
		        	            </td>
		           	            <td width="2" align="center">&nbsp;</td>
		        	            
		        	            <td width="56" align="center">
		        	            	<a href="/admins/edituser/<?php echo $id ?>"><img src="/img/edit_icon.gif" alt="" width="20" height="17" /></a></td>
	
		        	            <td width="56" align="center">
		        	            	<a href="/admins/deleteuser/<?php echo $id ?>"><img src="/img/delete_icon.png" alt="" width="20" height="17" /></a>
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
          
         <script type="text/javascript">

			function changeDiv(radioobject)
			{

			//	alert(radioobject.id);	
				
				var val = radioobject.id;
				if(val == 'joindate')
					{
						//alert('Hello');
						$('#divNoDate').hide();
						$('#divByDate').show();
						
					}
				else{	
						$('#divNoDate').show();
						$('#divByDate').hide();
					}
				 //*/
				
				
			}
         

		 </script>
          
          