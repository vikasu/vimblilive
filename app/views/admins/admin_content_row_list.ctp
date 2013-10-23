
<div class="left"> 
            <?php echo $this->Html->link('Add Content Row',array('controller'=>'admins','action'=>'admin_add_content_row','prefix'=>'admin'), array('class' => 'addNewButton')); ?>
            <h1 class="pageTitle">Manage Content Row</h1> 
            <?php
                if ($session->check('Message.flash') || $session->check('Message.auth'))
		{   
                      echo $this->Session->flash();   
                }          
            ?>
            <!--<div style="font-size:12px;font-weight:bold;color:red;" align='center'>  </div>-->
	    <div class="dataTables_wrapper" id="example_wrapper">
			<div id="content" class="form">                        
                                
 <?php echo $this->Form->create('', array('controller' => 'customers' ,'action' => 'index','prefix'=>'admin','id'=>'adform'));?>
<table width="100%" cellpadding="0" cellspacing="0"  border="0"  class="dyntable">
	<?php
			$id = 1;
			if(!empty($content_rows)){
	    ?>
	 <thead>
	<tr>
	       <th  class="head1" align="left" width="7%">
			Sr. No
		</th>
		<th  class="head1" align="left" width="20%">
			Image Name
		</th>
		
		<th  width="28%" align="left" class="head1">
                        Link	
		
	
		
		<th  class="head1" align="left" width="40%">
			Description
		</th>
		</th>
			<th  width="22%" align="left" class="head1">
			Status
		</th>
                <th  class="head1" align="center" style="text-align:center;">
			Action
		</th>
	</tr>
	 <thead>
         <?php 
	$class = '';
	foreach ($content_rows as $row) {
		//pr($row['CarouselDetail']['carousel_image']); die;
		$class = ($class == 'even')?'odd':'even';
		if($row['ContentRow']['status'] == 1) {
			$status =  $this->Html->link($this->Html->image('active.png', array('alt'=>"Active", 'title'=>"status Change",'class'=>'change_status') ),array('controller'=>'admins','action'=>'admin_change_status_content_row',base64_encode($row['ContentRow']['id'])),array('escape'=>false,'class'=>'manage_actions'), false);
		}else{
			$status =  $this->Html->link($this->Html->image('deactive.png', array('alt'=>"Deactive", 'title'=>"status Change",'class'=>'change_status') ),array('controller'=>'admins','action'=>'admin_change_status_content_row',base64_encode($row['ContentRow']['id'])),array('escape'=>false,'class'=>'manage_actions'), false);
		}
	;?>
		<tr class="<?php echo $class?>">
			<td style="padding-left:9px; padding:8px"><?php echo $id; $id++;?></td>
			<td style="padding-left:9px; padding:8px"><a target ="_blank" href="<?php echo SITE_URL?>img/<?php echo $row['ContentRow']['content_image'];?>"><img src="<?php echo SITE_URL?>img/contentRowImage/<?php echo $row['ContentRow']['content_image'];?>"  width="120px"/></a></td>
			<td style="padding-left:9px"><a href="<?php echo $row['ContentRow']['link'];?>" target="_blank" style="color: blue; text-decoration: underline"><?php echo $row['ContentRow']['link'];?></a></td>
                          <td style="padding-left:9px"><?php echo $row['ContentRow']['description'];?></td>
			<td style="padding-left:9px"><?php echo $status ;?></td> 
                         
                  <!--  <td style="padding-left:9px"><?php //$row['Payment']['modified'];?></td>-->

				<td class="center" style="text-align:center;">
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"edit image", 'title'=>"Edit Image") ),array('controller'=>'admins','action'=>'admin_add_content_row',base64_encode($row['ContentRow']['id'])),array('escape'=>false,'class'=>'manage_actions'), false); ?>
					<?php echo  $this->Html->link($this->Html->image('icons/small/black/close.png', array('alt'=>"Delete Question", 'title'=>"Delete Question") ),array('controller'=>'admins','action'=>'admin_delete_content_row',base64_encode($row['ContentRow']['id'])),array('escape'=>false),'Are you sure you want to delete this Image?', false); ?>
				</td>  
			
		</tr>
			
		<?php } } else { ?>
		<tr>
			<td colspan="5" align="center">No record found</td>
		</tr>
		<?php } ?>
</table>
<?php echo $this->Form->end(); ?>
			
                        </div>
                </div><!-- dataTables_wrapper -->
</div><!-- left -->
