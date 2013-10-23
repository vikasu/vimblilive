
 <?php echo $this->Form->create('', array('controller' => 'customers' ,'action' => 'index','prefix'=>'admin','id'=>'adform'));?>
<table width="100%" cellpadding="0" cellspacing="0"  border="0"  class="dyntable">
	<?php if(!empty($codes)){  ?>
	 <thead>
	<tr>
		<th  class="head1" align="left" width="20%">
			Id
		</th>
		<th  class="head1" align="left" width="20%">
			Discount Preferred
		</th>
		
		<th  width="28%" align="left" class="head1">
			Promotional Code
		
	<!--	<th  width="22%" align="left" class="head1">
			Status
		</th>  -->
		<th  width="28%" align="center" class="head1">
			Expiration Date
		</th>
		
	
	<!--	<th  width="10%" align="center" class="head1">
			Created
		</th> -->
		
		<th  class="head1" align="center" style="text-align:center;">
			Action
		</th> 
	</tr>
	 <thead>
         <?php 
	$id = 1;
	foreach ($codes as $row) {
		if(!empty($row['PromotionalCode']['expiration_date'])){
			$row['PromotionalCode']['expiration_date']=date('M. d, Y',strtotime($row['PromotionalCode']['expiration_date']));
		}
		//$class = 'even';
		@$class = ($class == 'even')?'odd':'even';
		if($row['PromotionalCode']['status'] == 0){
			$row['PromotionalCode']['status'] = "Deactive";
		}else{
			$row['PromotionalCode']['status'] = "Active";
		}
		
		;?>
		<tr class="<?php echo $class?>">
		<td style="padding-left:9px; padding:8px"><?php echo $id;$id++;?></td>
			<td style="padding-left:9px; padding:8px"><?php echo ucwords($row['PromotionalCode']['amount'])."%";?></td>
			<td style="padding-left:9px"><?php echo $row['PromotionalCode']['unique_code'];?></td>
			<td style="padding-left:9px"><?php echo $row['PromotionalCode']['expiration_date'];?></td>
		<!--	<td style="padding-left:9px"><?php //echo ucwords($row['Payment']['status']);?></td> -->
                    <!--    <td style="padding-left:9px"><?php //echo $row['PromotionalCode']['created'];?></td> -->
                     

				<td class="center" style="text-align:center;">
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"edit Questions", 'title'=>"Edit Question") ),array('controller'=>'payments','action'=>'admin_add_code',base64_encode($row['PromotionalCode']['id'])),array('escape'=>false,'class'=>'manage_actions'), false); ?>
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/close.png', array('alt'=>"Delete Question", 'title'=>"Delete Question") ),array('controller'=>'payments','action'=>'admin_delete_code',base64_encode($row['PromotionalCode']['id'])),array('escape'=>false),'Are you sure you want to delete this Question?', false); ?>
				</td>
			
		</tr>
			
		<?php } } else { ?>
		<tr>
			<td colspan="5" align="center">No record found</td>
		</tr>
		<?php } ?>
</table>
<?php echo $this->Form->end(); ?>
