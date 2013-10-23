<?php //echo '<pre>'; print_r($userlist); die;
echo $javascript->link('selectAllCheckbox');
$add_url_string ="/keyword:".$keyword."/searchin:".$fieldname; ?>
<?php
if($paginator->sortDir() == 'asc'){
	$image = $html->image('admin-arrow-top.gif',array('border'=>0,'alt'=>''));
}
else if($paginator->sortDir() == 'desc'){
	$image = $html->image('admin-arrow-bottom.gif',array('border'=>0,'alt'=>''));
}
else{
	$image = '';
}
?>
 <?php echo $this->Form->create('', array('controller' => 'customers' ,'action' => 'index','prefix'=>'admin','id'=>'adform'));?>
<table width="100%" cellpadding="0" cellspacing="0"  border="0"  class="dyntable">
	<?php if(!empty($userlist)){  ?>
	 <thead>
	<tr>
		<th class="head1 sorting" width="3%" align="center"><input type="checkbox" class="checkall"></th>
		<th  class="head1" align="left" width="20%">
			<?php echo $paginator->sort('Name', 'User.name'); ?><?php if($paginator->sortKey() == 'User.name'){
				echo ' '.$image; 
			}?>
		</th>
		<th  width="22%" align="left" class="head1">
			Primary Owner
		</th>
		<th  width="28%" align="left" class="head1">
			<?php echo $paginator->sort('Email', 'User.email'); ?><?php if($paginator->sortKey() == 'User.email'){
				echo ' '.$image; 
			}?>
		</th>
		
		<th  width="25%" align="left" class="head1">
			Access Level
		</th>
		
		<th  class="head1" align="left" width="7%">
			<?php echo $paginator->sort('Status', 'User.status'); ?><?php if($paginator->sortKey() == 'User.status'){
				echo ' '.$image; 
			}?>
		</th>
		<th  width="10%" align="center" class="head1">
			<?php echo $paginator->sort('Created', 'User.created'); ?><?php if($paginator->sortKey() == 'User.created'){
				echo ' '.$image; 
			}?>
		</th>
		
		<th  class="head1" align="center" style="text-align:center;">
			Action
		</th> 
	</tr>
	 <thead>
	<?php //pr($userlist); 
	$class= 'even'; $userIdArr = array();
	foreach ($userlist as $row) {
		if(in_array($row['User']['id'], $userIdArr) == false){
			$adminId=0;
			$getname='';
		       //get sales person name
		       //$adminId=$row['User']['admin_id'];
			 //$getname= $this->requestAction("/menus/getAdminName/$adminId");
			$class = ($class == 'even')?'odd':'even';?>
			<tr class="<?php echo $class?>">
				<td align="center" style="padding:8px"><input type="checkbox" name="box1[]" value="<?php echo $row['User']['id'];?>" ></td>
				
				<td><?php echo ucwords($row['User']['name']);?></td>
				<?php if($row['User']['primaryname'] == ''){ ?>
					<td><?php echo ucwords($row['User']['name']);?></td>
				<?php } else{ ?>
					<td><?php echo ucwords($row['User']['primaryname']);?></td>
				<?php }?>
				
					<td><?php echo $row['User']['email'];?></td>
					<td>
						<?php
						$accessLevels = '';
						if($row['User']['individual_payment_status'] == 1){
							$accessLevels = $accessLevels.'Individual, ';
						}if($row['User']['group_payment_status'] == 1){
							$accessLevels = $accessLevels.'Group, ';
						}if($row['SponsorManager']['id'] != ""){
							$accessLevels = $accessLevels.'Sponsor, ';
						}
						
						echo substr($accessLevels,0,strlen($accessLevels)-2);
						?>
					</td>
					<td class="center"><?php echo $html->setStatusVal($row['User']['status']); ?></td>
					<td><?php echo $html->setDateFormat($row['User']['created']); ?></td>
					<td class="center" style="text-align:center;">
						<?php echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"Edit User", 'title'=>"Edit User") ),array('controller'=>'users','action'=>'add',base64_encode($row['User']['id']),1),array('escape'=>false,'class'=>'manage_actions'), false); ?>
						<?php echo  $this->Html->link($this->Html->image('icons/small/black/close.png', array('alt'=>"Delete User", 'title'=>"Delete User") ),array('controller'=>'users','action'=>'delete',base64_encode($row['User']['id'])),array('escape'=>false),'Are you sure you want to delete this User?', false); ?>
					</td> 
			</tr>
				
			<?php
			
			$userIdArr[] = $row['User']['id'];
		}
	}
		
		?>
		<tr>
			<td colspan="5" align="left">
		<div class="dataTables_info" id="example_info">
					<?php echo $form->input('setStatus', array('type' => 'hidden','id'=>'setStatus'));?>
					<?php echo $form->input('Record', array('type' => 'hidden','id'=>'Record','value'=>'User'));?>
					<?php echo $this->Form->button("Active",array('type'=>'submit','div'=>false,'class'=>'iconlink','name' => 'active','id'=>'stactive','value'=>1)); ?>
					<?php echo $this->Form->button("Inactive",array('type'=>'submit','div'=>false,'class'=>'iconlink','name' => 'inactive','id'=>'stdeactive','value'=>1)); ?>
	
	
					<?php //echo $this->Paginator->counter('Page {:page} of {:pages}, showing {:current} records out of {:count} total'); ?>	
				</div>
		</td>
		</tr>	
			
		<tr><td height="8" colspan="5"></td></tr>
		<tr>
			<td colspan="7" style="padding-bottom:10px;">
			<?php  echo $this->element('admin/paging_box');?>
			</td>
		</tr>	
		<?php } else {?>
		<tr>
			<td colspan="5" align="center">No record found</td>
		</tr>
		<?php } ?>
</table>
<?php echo $this->Form->end(); ?>
