<script src="/js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
<?php echo $javascript->link('admins/helpcatlist.js');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td><img src="/img/spacer.gif" width="1" height="10" alt="" />
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
						<div style='float: left;'>Manage Help Category:</div>
						<div class='rightclass' style="width: 90px;">
							<input type="button" value="Add Category" class="button"
								style="width: 80px;"
								onclick="javascript:location.href='/admins/addhelpcat'" />
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
											<li><?php echo $paginator->prev('Prev',array('class'=>'selected') , null, array('class'=>'disabled'));?>
											</li>
											<li><?php echo $this->Paginator->numbers(array('class'=>'selected')); ?>
											</li>
											<li><?php echo $paginator->next('Next', array('class'=>'selected') , null, array('class'=>'disabled'));?>
											</li>
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
		<td><img src="/img/spacer.gif" width="1" height="5" alt="" /></td>
	</tr>
	<form method="post" name="helpcatactionform"
		action="/admins/helpcataction">
		<tr>
			<td valign="top" class="grid_header"><table class="grid_brd"
					width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<!--<td class="grid_header">
        	         <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          <tr>
					 -->
						<td width="25" align="center"><?php echo $this->Form->input("File.selectAll", array('class' => '', 'name' =>  'data[Helpcategory][selectAll]', 'value' => 1, 'type' => 'checkbox', 'div' => false, 'label' => '', 'escape' => false));?>
						</td>
						<td width="2"><img src="/img/header_seperator.gif" width="2"
							height="29" alt="" /></td>


						<td width="65" class="left_padd"><?php echo $this->Paginator->sort('Help Category', 'Helpcategory.hc_name'); ?>
						</td>
						<td width="2"><img src="/img/header_seperator.gif" width="2"
							height="29" alt="" /></td>

						<td width="65" class="left_padd">Status</td>
						<td width="2" align="center"><img src="/img/header_seperator.gif"
							width="2" height="29" alt="" /></td>

						<td width="65" align="center">Edit</td>
						<td width="2" align="center"><img src="/img/header_seperator.gif"
							width="2" height="29" alt="" /></td>

						<td width="56" align="center">Delete</td>

						<!-- </tr>
      	             </table>
      	            </td> -->
					</tr>
					<?php if(count($fetchedhelpcatlist)>0){?>
					<?php foreach ($fetchedhelpcatlist as $fetchedhelpcatdata) {?>
					<?php $id = $fetchedhelpcatdata['Helpcategory']['id'];?>
					<tr>
						<!-- <td>
        	          <table width="100%" border="0" cellspacing="0" cellpadding="0">
        	          <tr> -->
						<td width="25" align="center"><input type='Checkbox'
							id='Userid_<?php echo $fetchedhelpcatdata['Helpcategory']['id'];?>'
							Name='data[Helpcategory][id][]'
							value=<?php echo $fetchedhelpcatdata['Helpcategory']['id'];?>> <!-- <input type="checkbox" name="checkbox" id="checkbox" /> -->
						</td>
						<td width="2"><img src="/img/header_seperator.gif" width="2"
							height="29" alt="" />
						</td>


						<td width="65" class="left_padd"><a
							href="/admins/helplist/<?php echo $id ?>"> <?php echo $fetchedhelpcatdata['Helpcategory']['hc_name']; ?>
						</a>
						</td>
						<td width="2" align="center">&nbsp;</td>

						<td width="65" class="left_padd"><?php if($fetchedhelpcatdata['Helpcategory']['hc_status'] ==1) { ?>
							<a href="/admins/inactivehelpcat/<?php echo $id ?>"> Published <!--  <img src="/img/status1.gif" width="20" title="Inactive" height="17" alt="" /> -->
						</a> <?php }else{?> <a
							href='/admins/activehelpcat/<?php echo $id ?>'> Unpublished <!-- <img src="/img/status2.gif" width="20" title="Active" height="17" alt="" /> -->
						</a> <?php }?>
						</td>
						<td width="2" align="center">&nbsp;</td>

						<td width="65" align="center"><a
							href="/admins/edithelpcat/<?php echo $id ?>"><img
								src="/img/edit_icon.gif" alt="" width="20" title="Edit"
								height="17" /> </a>
						</td>
						<td width="2" align="center">&nbsp;</td>

						<td width="56" align="center"><a
							href="/admins/deletehelpcat/<?php echo $id ?>"><img
								src="/img/delete_icon.png" alt="" title="Delete" width="20"
								height="17" /> </a>
						</td>

						<!-- </tr>
	      	          	</table>
	      	          </td> -->
					</tr>
					<?php }
}else{?>
					<tr>
						<td class="bot_brd">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<!-- <td width="25"><input type="checkbox" name="checkbox2" id="checkbox2" /></td> -->
									<td colspan="9" align="center">Data Not Found</td>

								</tr>
							</table>
						</td>
					</tr>

					<?php }?>
					<!-- </table> -->
					<!-- </td>
      	        </tr> -->
				</table></td>

		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>

		<!--  <tr>
        	 	<td> 
        	 		Legend :
        	 	</td>
        	 </tr> -->
		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td><table width="40%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left"><input type="submit"
							name="data[Helpcategory][action]" value="Publish" class="button"
							style="width: 80px;" />
							<div class="buttonEnding"></div></td>
						<td align="left"><input type="submit"
							name="data[Helpcategory][action]" value="Unpublish"
							class="button" style="width: 80px;" />
							<div class="buttonEnding"></div></td>
						<td align="left"><input type="button"
							name="data[Helpcategory][action]" value="Delete" class="button"
							style="width: 80px;" onclick="javascript:confirmdeleteall();" />
							<div class="buttonEnding"></div></td>
					</tr>
				</table></td>
		</tr>
	</form>
</table>
</td>
</tr>
</table>



