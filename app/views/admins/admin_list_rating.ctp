<?php $breadcrumbList=array('Rating List');
      echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>
<div class="left"> 
            
             <h1 class="pageTitle">Manage Rating Text</h1> 
            <?php
                if ($session->check('Message.flash') || $session->check('Message.auth'))
		{   
                      echo $this->Session->flash();   
                }          
            ?>
            <div class="dataTables_wrapper" id="example_wrapper">
	     <div id="content" class="form">                        
             <?php echo $this->Form->create('', array('controller' => 'customers' ,'action' => 'index','prefix'=>'admin','id'=>'adform'));?>
	     <table width="100%" cellpadding="0" cellspacing="0"  border="0"  class="dyntable">
			  <?php if(!empty($rating)){  ?>
			   <thead>
			  <tr>
			       <th  class="head1" align="left" width="30%">
					  Sr. No
				  </th>
				  <th  class="head1" align="left" width="30%">
					  Rating Range
				  </th>
				  <th  class="head1" align="left" width="40%">
					  Rating Quote
				  </th>
				  <th  class="head1" align="left" width="10%">
					  Action
				  </th>
			  </tr>
			   <thead>
			 <?php
				       $class = '';
				       $id = 1;
					foreach ($rating as $data) {
						$class = ($class == 'even')?'odd':'even';
						//$rate_start = $data['Rating']['rate_start'];
						//$rate_end = $data['Rating']['rate_end'];
						//$rating_range = $rate_start." To ".$rate_end;
			  ?>
				  
				  <tr class = "<?php echo $class?>">
					    <td style="padding: 10px;"><?php echo $id; $id++;?></td>
					    <!--<td style="padding: 10px;"><?php// echo $rating_range;?></td>-->
					    <td style="padding: 10px;"><?php echo $data['Rating']['rating'];?></td>
					    <td style="padding: 10px;"><?php echo $data['Rating']['rating_quote'];?></td>
					    <td style="padding: 10px;"><?php echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"edit image", 'title'=>"Edit Image") ),array('controller'=>'admins','action'=>'admin_manage_rating',base64_encode($data['Rating']['id'])),array('escape'=>false,'class'=>'edit_rating'), false); ?></td>
			  <?php } } ?> 
	     </table>		
                        </div>
                </div><!-- dataTables_wrapper -->
</div><!-- left -->
