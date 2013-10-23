        	<?php //pr($fetcheduser)?>
        	
        	<link rel="stylesheet" type="text/css" href="/css/validate_form.css" />   
	 		<link type="text/css" href="/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />
        	<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
			<?php echo $javascript->link('admins/listuser.js');?>
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
        	        <td>
					 <div class="leftclass"><h2>Search:</h2></div>
        	          <div class="rightclass">
        	        	
        	         </div>	
        	        </td>
      	          </tr>
        	   	 <tr>
        	   	   <td align="center">
		              <?php echo $session->flash(); ?>	
        	   	   </td>
        	   	 </tr>      	          
      	          <form method="post" name="seachform" id="seachform">
        	      <tr>
        	        <td>
        	        	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	        	          	<tr>
	        	            	<td colspan="5" align="left"><img src="/img/spacer.gif" width="1" height="20" alt="" /></td>
	       	              	</tr>
	        	          	<tr>
		        	            <td align="left">Search in:</td>
		        	            <td align="left"><!-- Email Id: --></td>
		        	            <td align="left"><!-- Username: --></td>
		        	            <td align="left">&nbsp;</td>
		        	            <td align="left">&nbsp;</td>
	      	                </tr>
	      	                
	        	          	<tr>
	        	          		<td width="31%">
		        	          		<div style="float:left;">
				        	            <input type="radio" name="data[User][searchOption]" checked value="appuser" id="appuser" onclick ="javascript: changeDiv(this);" />  Name
										<input type="radio" name="data[User][searchOption]"  value="joindate" id = "joindate" <?php if(isset($datesearch)) { echo "checked";} ?> onclick ="javascript: changeDiv(this);" /> Signed up between
									</div>	
	        	          		</td>
	        	          		
	        	          		<td width="32%">
									 <div id='divNoDate' style="margin-left:5px;<?php if(isset($datesearch)) { echo "display:none"; } ?>;">
			        	            	<input type="text" name="data[User][searchFieldNoDate]" id="textfield1" style="width:100px;" <?php if(isset($serachData)) { ?> value="<?php echo $serachData;?>"<?php } ?> />
			        	             </div> 
			        	             <div id='divByDate' style=" margin-left:5px; <?php if(isset($datesearch)) { echo "display:block";  }else{ echo "display:none;";}?> ;" >
			        	                <input type="text" name="data[User][searchFieldDatestart]" readonly id="textfield2" style="width:100px;" <?php if(isset($serachstartDate)) { ?> value="<?php echo $serachstartDate;?>"<?php }else{?>value="2012-01-01"<?php } ?> />
			        	                <input type="text" name="data[User][searchFieldDateend]" readonly id="textfield3" style="width:100px;" <?php if(isset($serachendDate)) { ?> value="<?php echo $serachendDate;?>"<?php }else{?>value="<?php echo date("Y-m-d"); ?>"<?php } ?> />
			        	             </div>
						         </td> 
	        	          		
		        	          	<td width="36%">
		        	          		<input type="submit" value="Search" class="button" style="width:80px;"/><div class="buttonEnding"></div>			
		        	          		<input type="button" value="Clear" class="button" style="width:80px;" onclick="javascript:location.href='/admins/listuser'"/><div class="buttonEnding"></div>
		        	          		<input type="button" value="Add User" class="button" style="width:80px;" onclick="javascript:location.href='/admins/adduser'"/><div class="buttonEnding rightclass"></div>
		        	          	</td>
						     </tr>
						     <tr>    
		    					
		      	            </tr>
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
        	        	Export to: 
        	        	<a href="/admins/exportuserlistcsv"><img src="/img/csv_icon.gif" height="20px"/></a> 
        	        	<a href="/admins/exportuserlistexcel"><img src="/img/exel_icon.jpg" height="20px"/></a>
        	        	<a href="/admins/exportuserlistpdf"><img src="/img/pdf_icon.jpg" height="20px"/></a>
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
      	    <form method="post" name="actionform" action ="/admins/actions">
        	<!-- <tr>
        	    <td valign="top">
        	    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="grid_brd"> -->
        	      <tr>
        	        
        	        <td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0" class="grid_brd">
        	          <tr>
          	            <td width="25" align="center"><?php echo $this->Form->input("File.selectAll", array('class' => '', 'name' =>  'data[User][selectAll]', 'value' => 1, 'type' => 'checkbox', 'div' => false, 'label' => '', 'escape' => false));?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="60" class="left_padd"><?php echo $this->Paginator->sort('First Name', 'User.name'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>

        	            <td width="60" class="left_padd"> <?php echo $this->Paginator->sort('Last Name', 'User.last_name'); ?> </td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td> 
        	            
        	            <td width="180" class="left_padd"> <?php echo $this->Paginator->sort('Email', 'User.email'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td> 
        	           
        	            <!-- <td width="56" class="left_padd"> --><?php //echo $this->Paginator->sort('State', 'UserBio.state'); ?><!-- </td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td> -->
        	           
						<!-- <td width="56" class="left_padd"> --><?php //echo $this->Paginator->sort('Country', 'UserBio.country'); ?><!-- </td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td> -->
						        	           
        	           
        	            <td width="85" class="left_padd"><?php echo $this->Paginator->sort('Join Date', 'User.join_date'); ?></td>
        	            <td width="2"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	       
        	            <td width="56" align="left">Status</td>
        	            <td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="56" align="center">Edit</td>
        	            <td width="2" align="center"><img src="/img/header_seperator.gif" width="2" height="29" alt="" /></td>
        	            
        	            <td width="56" align="center">Delete</td>
        	            <td width="2" align="center"><!-- <img src="/img/header_seperator.gif" width="2" height="29" alt="" /> --></td>
       	              </tr>
      	             <!-- </table>
      	            </td>
      	          </tr> -->
        	      <!-- <tr>
        	        <td class="bot_brd"> -->
        	         <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0"> -->
        	        <?php if(count($fetcheduser)>0){?>
	        	        <?php foreach ($fetcheduser as $userData) {?>
	        	          <tr>
	        	          		<td width="25" align="center">
	        	          			
	        	          				<input type = 'Checkbox' id= 'Userid_<?php echo $userData['User']['id'];?>' Name ='data[User][id][]' value =<?php echo $userData['User']['id']; ?>>
	        	          				<!-- <input type="checkbox" name="checkbox" id="checkbox" /> -->
	        	          		</td>
		        	            <td width="2">
		        	            	<img src="/img/header_seperator.gif" width="2" height="29" alt="" />
		        	            </td>
	        	          
		        	            <td width="60" class="left_padd">
		        	            	<a href="/admins/viewuser/<?php echo $userData['User']['id'];?>"><?php echo ucfirst($userData['User']['name']); ?></a>
		        	            </td>
		        	            <td width="2">&nbsp;</td>	
		        	            
		        	            <td width="60" class="left_padd"> 
		        	            	<a href="/admins/viewuser/<?php echo $userData['User']['id'];?>"><?php echo $userData['User']['last_name'];?></a>
		        	            </td>
		        	            <td width="2">&nbsp;</td> 
		        	            
		        	            
		        	            <td width="180" class="left_padd"> 
		        	            	<a href="mailto:<?php echo $userData['User']['email']; ?>"><?php echo $userData['User']['email']; ?></a>
		        	            </td>
		        	            <td width="2">&nbsp;</td> 
		        	            		   
		        	            <!-- <td width="56" class="left_padd"> -->
		        	            	<?php $usercity = $userData['UserBio']['city']!=''?ucfirst($userData['UserBio']['city']):'N/A'; 
		        	            		  //echo $usercity;
		        	            	?>
		        	            <!-- </td>
		        	            <td width="2">&nbsp;</td> -->
		        	            
		        	            <!-- <td width="56" class="left_padd"> -->
		        	            	<?php $userstate = $userData['UserBio']['state']!=''?ucfirst($userData['UserBio']['state']):'N/A'; 
		        	            	      //echo $userstate;
		        	            	?>
			        	        <!-- </td>
		        	            <td width="2">&nbsp;</td>
		        	            
		        	            <td width="56" class="left_padd"> -->
		        	            	<?php $usercountry = $userData['UserBio']['country']!=''?ucfirst($userData['UserBio']['country']):'N/A'; 
		        	            	      //echo $usercountry;
		        	            	?>
		        	            <!-- </td>	
		        	            <td width="2">&nbsp;</td> -->
		        	            
		        	            <td width="85" class="left_padd"><?php echo date("m/d/Y",strtotime($userData['User']['join_date']));?></td>
		        	            <td width="2" align="center">&nbsp;</td>

		        	            <td width="56" align="left">
		        	                <?php $id = $userData['User']['id'];?>
		        	            	<?php if($userData['User']['user_status'] ==1) { ?>
		        	            		<a href="/admins/inactive/<?php echo $id ?>">
		        	            			Active
		        	            		 <!-- <img src="/img/status1.gif" width="20" height="17" alt="" /> -->
		        	            		</a> 
		        	            	<?php }else{?>
		        	            		<a href='/admins/active/<?php echo $id ?>'>
		        	            			Unactive
		        	            		 <!-- <img src="/img/status2.gif" width="20" height="17" alt="" /> -->
		        	            		</a>
		        	            	<?php }?>	
		        	            
		        	            </td>
		           	            <td width="2" align="center">&nbsp;</td>
		        	            
		        	            <td width="56" align="center">
		        	            	<a href="/admins/edituser/<?php echo $id ?>"><img src="/img/edit_icon.gif" alt="" width="20" height="17" /></a></td>
								<td width="2" align="center">&nbsp;</td>
		        	            <td width="56" align="center">
		        	            	<a href="/admins/deleteuser/<?php echo $id ?>"><img src="/img/delete_icon.png" alt="" width="20" height="17" /></a>
		        	            </td>
		        	            <td width="2" align="center">&nbsp;</td>
	      	          	 </tr>
      	          	<?php }}else{?>
      	            	 <tr>
	 	        	            <!-- <td width="25"><input type="checkbox" name="checkbox2" id="checkbox2" /></td> -->	        	       
		        	            <td colspan="18" align="center"> Data Not Found </td>
		        	            
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
						<td align="left"><input type="submit" name="data[User][action]" value="Active" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						<td align="left"><input type="submit" name="data[User][action]" value="Unactive" class="button" style="width:80px;"/><div class="buttonEnding"></div></td>
						<td align="left"><input type="button" name="data[User][action]" value="Delete" class="button" style="width:80px;" onclick ="javascript:confirmdeleteall();"/><div class="buttonEnding"></div></td>
      	        </tr>  
      	      </table></td>
      	    </tr></form>
      	     <tr>
      	     	<td>&nbsp;</td>
      	     </tr>
      	      </table></td>
      	    </tr> 
      	    
          </table>         