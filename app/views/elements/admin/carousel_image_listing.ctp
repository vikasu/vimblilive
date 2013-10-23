
 <?php echo $this->Form->create('', array('controller' => 'customers' ,'action' => 'index','prefix'=>'admin','id'=>'adform'));?>
<table width="100%" cellpadding="0" cellspacing="0"  border="0"  class="dyntable">
	<?php if(!empty($homes_images)){  ?>
	 <thead>
	<tr>
		<th  class="head1" align="left" width="20%">
			Image Name
		</th>
		
		<th  width="28%" align="left" class="head1">
                        Title	
		
	
		
		<th  class="head1" align="left" width="45%">
			Description
		</th>
		</th>
			<th  width="22%" align="left" class="head1">
			Status
		</th>
                <th  class="head1" align="center" style="text-align:center;">
			Action
		</th>
		 
	<!--	<th  width="10%" align="center" class="head1">
			Modified
		</th> 
		
		<th  class="head1" align="center" style="text-align:center;">
			Action
		</th>  --> 
	</tr>
	 <thead>
         <?php 
	
	foreach ($homes_images as $row) {
		//$class = 'even';
		//pr($row['CarouselDetail']['carousel_image']); die;
		$class = ($class == 'even')?'odd':'even';
		if($row['CarouselDetail']['status'] == 1) {
			$status =  $this->Html->link($this->Html->image('active.png', array('alt'=>"Active", 'title'=>"status Change",'class'=>'change_status') ),array('controller'=>'admins','action'=>'admin_change_status_carousel_image',base64_encode($row['CarouselDetail']['id'])),array('escape'=>false,'class'=>'manage_actions'), false);
		}else{
			$status =  $this->Html->link($this->Html->image('deactive.png', array('alt'=>"Deactive", 'title'=>"status Change",'class'=>'change_status') ),array('controller'=>'admins','action'=>'admin_change_status_carousel_image',base64_encode($row['CarouselDetail']['id'])),array('escape'=>false,'class'=>'manage_actions'), false);
		}
	;?>
		<tr class="<?php echo $class?>">
			<td style="padding-left:9px; padding:8px"><img src="<?php echo SITE_URL?>img/slider-img/newsliderimg/<?php echo $row['CarouselDetail']['carousel_image'];?>"  width="120px"/></td>
			<td style="padding-left:9px"><?php echo $row['CarouselDetail']['carousel_title'];?></td>
                          <td style="padding-left:9px"><?php echo $row['CarouselDetail']['carousel_description'];?></td>
			<td style="padding-left:9px"><?php echo $status ;?></td> 
                         
                  <!--  <td style="padding-left:9px"><?php //$row['Payment']['modified'];?></td>-->

				<td class="center" style="text-align:center;">
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"edit image", 'title'=>"Edit Image") ),array('controller'=>'admins','action'=>'admin_add_carousel_image',base64_encode($row['CarouselDetail']['id'])),array('escape'=>false,'class'=>'manage_actions'), false); ?>
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/close.png', array('alt'=>"Delete Question", 'title'=>"Delete Question") ),array('controller'=>'admins','action'=>'admin_delete_carousel_image',base64_encode($row['CarouselDetail']['id'])),array('escape'=>false),'Are you sure you want to delete this Image?', false); ?>
				</td>  
			
		</tr>
			
		<?php } } else { ?>
		<tr>
			<td colspan="5" align="center">No record found</td>
		</tr>
		<?php } ?>
</table>
<?php echo $this->Form->end(); ?>
