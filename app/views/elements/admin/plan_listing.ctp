
<?php echo $this->Form->create('', array('controller' => 'payments' ,'action' => 'index','prefix'=>'admin','id'=>'adform'));?>
<table width="100%" cellpadding="0" cellspacing="0"  border="0"  class="dyntable">
	<?php if(!empty($plan)){  ?>
	 <thead>
	<tr>
		<th  class="head1" align="left" width="15%">
			User Type
		</th>
		
		<th  width="15%" align="left" class="head1">
			Item name
		</th>
	<!--	<th  width="22%" align="left" class="head1">
			Status
		</th>  -->
		<th  width="20%" align="left" class="head1">
			Plan Text
		</th>
		
		<th  class="head1" align="left" width="5%">
			User Limit
		</th>
		<th  width="10%" align="center" class="head1">
			Billing amount($)
		</th>
		
		<th  class="head1" align="center" style="text-align:center; width="15%"">
			Billing cycle (months)
		</th>
		
		</th>
		
		<th  class="head1" align="center" style="text-align:center; width="15%"">
			End of cycle
		</th> 
		
	<!--	<th  class="head1" align="center" style="text-align:center; width="15%"">
			Recurring Payment($)
		
		</th> -->
			<th  class="head1" align="center" style="text-align:center;">
			Action
		</th> 
	</tr>
	 <thead>
         <?php 
	$class= 'even'; 
	foreach ($plan as $row) {
		//$class = '';
		$class = ($class == 'even')?'odd':'even';
		//$recurring_pay = ($row['SubscriptionPlan']['amount']) * ($row['SubscriptionPlan']['plan_months']);
		if($row['SubscriptionPlan']['plan_months'] == 0){
			$row['SubscriptionPlan']['plan_months'] = "Never";
		}
		if($row['SubscriptionPlan']['status'] == 0){
			$row['SubscriptionPlan']['status'] = "Deactive";
		}else{
			$row['SubscriptionPlan']['status'] = "Active";
		}
		;?>
		<tr class="<?php echo $class?>">
			<td style="padding-left:9px; padding:8px"><?php echo ucwords($row['SubscriptionPlan']['usertype']);?></td>
			<td style="padding-left:9px; padding:8px"><?php echo $row['SubscriptionPlan']['plan_title'];?></td>
			<td style="padding-left:9px; padding:8px"><?php echo $row['SubscriptionPlan']['plan_text'];?></td>

			<td style="padding-left:9px; padding:22px"><?php echo ucwords($row['SubscriptionPlan']['user_limit']);?></td>

			<td style="padding-left:9px"><?php echo ucwords($row['SubscriptionPlan']['amount']);?></td>
			<td style="padding-left:42px"><?php echo ucwords($row['SubscriptionPlan']['billing_cycle']);?></td>
			<td style="padding-left:49px"><?php echo $row['SubscriptionPlan']['plan_months']?></td>
			<!-- <td style="padding-left:49px"><?php// echo $recurring_pay?></td>  -->
			
                	<td class="center" style="text-align:center;">
				<?php echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"edit Questions", 'title'=>"Edit Question") ),array('controller'=>'payments','action'=>'admin_add_plan',base64_encode($row['SubscriptionPlan']['id'])),array('escape'=>false,'class'=>'manage_actions'), false); ?>
				<?php echo  $this->Html->link($this->Html->image('icons/small/black/close.png', array('alt'=>"Delete Question", 'title'=>"Delete Question") ),array('controller'=>'payments','action'=>'admin_delete_plan',base64_encode($row['SubscriptionPlan']['id'])),array('escape'=>false),'Are you sure you want to delete this Plan?', false); ?>
			</td>
		</tr>
			
		<?php } } else { ?>
		<tr>
			<td colspan="5" align="center">No record found</td>
		</tr>
		<?php } ?>
</table>

	
	
<?php echo $this->Form->end(); ?>
