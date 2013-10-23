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
 <?php echo $this->Form->create('', array('controller' => 'reflections' ,'action' => 'reflections','prefix'=>'admin','id'=>'adform'));?>
<table width="100%" cellpadding="0" cellspacing="0"  border="0"  class="dyntable">
	<?php if(!empty($reflections)){  ?>
	 <thead>
	<tr>
	<!--	<th class="head1 sorting" width="3%" align="center"><input type="checkbox" class="checkall"></th>  -->
		<th  class="head1" align="left" width="80%">
			<?php echo $paginator->sort('Question', 'Question.question'); ?><?php if($paginator->sortKey() == 'Question.question'){
				echo ' '.$image; 
			}?>
		</th>
		
		
		<th  class="head1" align="left" width="10%">
			Frequency
		</th>
		
	<!--	<th  class="head1" align="left" width="10%">
			<?php //echo $paginator->sort('Status', 'Question.status'); ?><?php //if($paginator->sortKey() == 'UserReflection.status'){
				//echo ' '.$image; }?>
			
		</th> -->
	
		<th  width="30%" align="center" class="head1">
			<?php echo $paginator->sort('Rating', 'Question.rating_strength'); ?><?php if($paginator->sortKey() == 'UserReflection.created'){
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
	foreach ($reflections as $row) {
		if($row['Question']['frequency'] == 0){
			$row['Question']['frequency'] = "Random";
		}else{
			$row['Question']['frequency'] = "Always Ask";
		}
		if($row['Question']['status'] == 0){
			$row['Question']['status'] = "Deactive";
		}else{
			$row['Question']['status'] = "Active";
		}
		$adminId=0;
		$getname='';
               //get sales person name
	       //$adminId=$row['User']['admin_id'];
	         //$getname= $this->requestAction("/menus/getAdminName/$adminId");
		$class = ($class == 'even')?'odd':'even';?>
		<tr class="<?php echo $class?>">
		<!--	<td align="center" style="padding:8px"><input type="checkbox" name="box1[]" value="<?php //echo $row['Question']['id'];?>" ></td> -->
			
			<td style="padding-left:9px"><?php echo ucwords($row['Question']['question']);?></td>
			<td style="padding-left:9px"><?php echo ucwords($row['Question']['frequency']);?></td>
		<!--	<td style="padding-left:9px"><?php //echo ucwords($row['Question']['status']);?></td> -->
			<td style="padding-left:25px"><?php echo ucwords($row['Question']['rating_strength']);?></td>
			<?php /* ?>
			<td>--<?php //echo ucwords($row['User']['name']);?></td>
				<td class="center"><?php echo $html->setStatusVal($row['Question']['status']); ?></td>
				<td><?php echo $html->setDateFormat($row['Question']['created']); ?></td>
				<?php */ ?>
				<td class="center" style="text-align:center;">
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"edit Questions", 'title'=>"Edit Question") ),array('controller'=>'reflections','action'=>'admin_add_question',base64_encode($row['Question']['id'])),array('escape'=>false,'class'=>'manage_actions'), false); ?>
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/close.png', array('alt'=>"Delete Question", 'title'=>"Delete Question") ),array('controller'=>'reflections','action'=>'admin_delete_question',base64_encode($row['Question']['id'])),array('escape'=>false),'Are you sure you want to delete this Question?', false); ?>
				</td>
			
		</tr>
			
		<?php
		//$class = 
		}?>
		<tr>
			<td colspan="5" align="left">
		<div class="dataTables_info" id="example_info">
					<?php echo $form->input('UserReflection.setStatus', array('type' => 'hidden','id'=>'setStatus'));?>
					<?php echo $form->input('UserReflection.Record', array('type' => 'hidden','id'=>'Record','value'=>'User'));?>
					<?php //echo $this->Form->button("Active",array('type'=>'submit','div'=>false,'class'=>'iconlink','name' => 'active','id'=>'stactive','value'=>1)); ?>
					<?php //echo $this->Form->button("Inactive",array('type'=>'submit','div'=>false,'class'=>'iconlink','name' => 'inactive','id'=>'stdeactive','value'=>1)); ?>
	
	
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
