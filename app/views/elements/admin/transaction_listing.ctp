<?php// pr($transaction);die;?>
<?php echo $this->Form->create('', array('controller' => 'payments' ,'action' => 'index','prefix'=>'admin','id'=>'adform'));?>
<table width="100%" cellpadding="0" cellspacing="0"  border="0"  class="dyntable">
	<?php if(!empty($transaction)){  ?>
	 <thead>
	<tr>
		<th  class="head1" align="left" width="25%">
			User 
		</th>
		
	
	<!--	<th  width="22%" align="left" class="head1">
			Status
		</th>  -->
		<th  width="28%" align="left" class="head1">
			Plan Title
		</th>
		
		<th  class="head1" align="left" width="15%">
                        Amount
                 </th>
                 <th  class="head1" align="left" width="20%">
                      Payment-Id
                 </th>
		<th  width="30%" align="center" class="head1">
			Payment Date
		</th>
		
	</tr>
	 <thead>
        
         <?php 
	$class= 'even';
        
	foreach ($transaction as $row) {
		//$class = '';
                //pr($row);die;
		$class = ($class == 'even')?'odd':'even';
		
		if($row['User']['name'] == 0){
			$row['SubscriptionPlan']['status'] = "Deactive";
		}else{
			$row['SubscriptionPlan']['status'] = "Active";
		}
                
                  $date=$row['Transaction']['created'];
      
     $day=explode(' ',$row['Transaction']['created']);
   //  pr($day['0']);
   // $days=date('M .d,Y',$day['0']);
 //  $submit = date("M. d, Y", strtotime($submits[0]));
    //pr($days);
		?>
         
         <?php //pr($row); ?>
                
		<tr class="<?php echo $class?>">
			
			<td style="padding-left:9px; padding:8px"><?php echo ucwords($row['User']['name']);?></td>
			<td style="padding-left:9px; padding:8px"><?php echo ucwords($row['SubscriptionPlan']['plan_title']);?></td>
                        <td style="padding-left:9px"><?php echo "$".ucwords($row['Transaction']['AMT']);?></td>
			<td style="padding-left:9px"><?php echo ucwords($row['Transaction']['payment_id']);?></td>
                        <td style="padding-left:10px"><?php echo date("M. d, Y",strtotime($day['0']));?></td>
		<td class="center" style="text-align:center;">
		
			
		</tr>
			
		<?php } } else { ?>
		<tr>
			<td colspan="5" align="center">No record found</td>
		</tr>
		<?php } ?>
</table>

	
	
<?php echo $this->Form->end(); ?>
