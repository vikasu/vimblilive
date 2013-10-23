<?php
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
 <?php echo $this->Form->create('', array('controller' => 'connections' ,'action' => 'connection_groups','prefix'=>'admin','id'=>'adform'));?>
<table width="100%" cellpadding="0" cellspacing="0"  border="0"  class="dyntable">
	<?php if(!empty($conGroupList)){  ?>
	 <thead>
	<tr>
		<th class="head1 sorting" width="3%" align="center"><input type="checkbox" class="checkall"></th>
		<th  class="head1" align="left" width="30%">
			<?php echo $paginator->sort('Title', 'ConnectionGroup.title'); ?><?php if($paginator->sortKey() == 'ConnectionGroup.title'){
				echo ' '.$image; 
			}?>
		</th>
		
		
		<th  class="head1" align="left" width="10%">
			<?php echo $paginator->sort('Status', 'ConnectionGroup.status'); ?><?php if($paginator->sortKey() == 'ConnectionGroup.status'){
				echo ' '.$image; 
			}?>
		</th>
		<th  width="10%" align="center" class="head1">
			<?php echo $paginator->sort('Created', 'ConnectionGroup.created'); ?><?php if($paginator->sortKey() == 'ConnectionGroup.created'){
				echo ' '.$image; 
			}?>
		</th>
		
		<th  class="head1" align="center" style="text-align:center;">
			Action
		</th> 
	</tr>
	 <thead>
	<?php //pr($conGroupList); exit;
	$class= 'even'; 
	foreach ($conGroupList as $row) {
		$adminId=0;
		$getname='';
               //get sales person name
	       //$adminId=$row['User']['admin_id'];
	         //$getname= $this->requestAction("/menus/getAdminName/$adminId");
		$class = ($class == 'even')?'odd':'even';?>
		<tr class="<?php echo $class?>">
			<td align="center" style="padding:8px"><input type="checkbox" name="box1[]" value="<?php echo $row['ConnectionGroup']['id'];?>" ></td>
			
			<td><?php echo $row['ConnectionGroup']['title'];?></td>
				<td class="center"><?php echo $html->setStatusVal($row['ConnectionGroup']['status']); ?></td>
				<td><?php echo $html->setDateFormat($row['ConnectionGroup']['created']); ?></td>
				<td class="center" style="text-align:center;">
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"Edit Group", 'title'=>"Edit Group") ),array('controller'=>'connections','action'=>'add_connection_group',base64_encode($row['ConnectionGroup']['id'])),array('escape'=>false,'class'=>'manage_actions'), false); ?>
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/close.png', array('alt'=>"Delete Group", 'title'=>"Delete Group") ),array('controller'=>'connections','action'=>'delete',base64_encode($row['ConnectionGroup']['id'])),array('escape'=>false),'Are you sure you want to delete this Group?', false); ?>
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/people.png', array('alt'=>"View Connections", 'title'=>"View Connections") ),array('controller'=>'connections','action'=>'list_connections',base64_encode($row['ConnectionGroup']['id'])),array('escape'=>false,'class'=>'manage_actions'), false); ?>
				</td> 
		</tr>
			
		<?php
		//$class = 
		}?>
		<tr>
			<td colspan="5" align="left">
		<div class="dataTables_info" id="example_info">
					<?php echo $form->input('ConnectionGroup.setStatus', array('type' => 'hidden','id'=>'setStatus'));?>
					<?php echo $form->input('ConnectionGroup.Record', array('type' => 'hidden','id'=>'Record','value'=>'User'));?>
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
