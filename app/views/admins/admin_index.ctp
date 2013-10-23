<?php 
    $breadcrumbList=array( 'Manage Admin Staff' );
    echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>
<div class="left"> 
            <?php echo $this->Html->link('Add New',array('controller'=>'admins','action'=>'add'), array('class' => 'addNewButton')); ?>
            <h1 class="pageTitle">Manage Admin Staff</h1> 
            <?php
                if ($session->check('Message.flash') || $session->check('Message.auth'))
		{   
                      echo $this->Session->flash();   
                }          
            ?>
	    
            <!--<div style="font-size:12px;font-weight:bold;color:red;" align='center'>  </div>-->
	    <div class="dataTables_wrapper" id="example_wrapper">
		
		
		
                        <div class="dataTables_length" id="dataTables_filter"> <div class="form_default">
			    		     
			</div></div>
			<div id="content" class="form">
                        <?php echo $this->Form->create('', array('controller' => 'categories' ,'action' => 'index','prefix'=>'admin','id'=>'adform'));?>
                                <table cellspacing="0" cellpadding="0" border="0" id="example" class="dyntable">
				    <thead>
					 <tr>
					    <th class="head1 sorting" width="5%" align="center"><input type="checkbox" class="checkall"></th>
					    <th class="head1 sorting" width="20%"><?php echo $paginator->sort('name');?></th>
					    <th class="head1 sorting" width="30%"><?php echo $paginator->sort('email');?></th>
					    <th class="head1 sorting" width="15%">Role</th>
					    <th class="head1 sorting" width="10%"><?php echo $paginator->sort('active');?></th>	
					    <th class="head1 sorting" width="10%"><?php echo $paginator->sort('created');?></th>
					    <th class="head0 sorting" width="10%">Action</th>
					 </tr>
				    </thead>
					
				    <tbody>
                                            <?php $i=0;			 
                                                foreach($list as $page){ 
                                                if($i%2==0) { $classVar='class="even"'; } else { $classVar='class="odd"'; } 
                                            ?>
						<tr <?php echo $classVar?>>
							<td><input type="checkbox" name="box1[]" value="<?php echo $page['Admin']['id'];?>" ></td>
							<td><?php echo $page['Admin']['name'];?></td>
							
							<td>
							<?php
							    echo $page['Admin']['email'];?>
							</td>
							
							<td>
							<?php
							    echo $page['Admin']['type'];?>
							</td>
							
							<td class="center">
								      <?php echo $html->setStatusVal($page['Admin']['status']); ?>
							</td>
                                                        <td class="center">
                                                              <?php echo $html->setDateFormat($page['Admin']['created']); ?>
                                                        </td>
							<td class="center">
								<?php
								if($_SESSION['Auth']['User']['type'] == 'Admin'){ //if super admin logged in
								echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"Edit Category", 'title'=>"Edit Admin User") ),array('controller'=>'admins','action'=>'edit',base64_encode($page['Admin']['id'])),array('escape'=>false,'class'=>'manage_actions'), false);
								if($page['Admin']['type'] != 'Admin'){
								    echo $this->Html->link($this->Html->image('icons/small/black/close.png', array('alt'=>"Delete Admin User", 'title'=>"Delete Admin User") ),array('controller'=>'admins','action'=>'delete',base64_encode($page['Admin']['id'])),array('escape'=>false),'Are you sure you want to delete this Admin User?', false);
								}
								}
								else{ //if sub admin logged in
								if($_SESSION['Auth']['User']['id'] == $page['Admin']['id']){
								    echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"Edit Category", 'title'=>"Edit Admin User") ),array('controller'=>'admins','action'=>'edit',base64_encode($page['Admin']['id'])),array('escape'=>false,'class'=>'manage_actions'), false);
								}
								}
								?>
							</td>
						</tr>
                                            <?php $i++; } ?>
						<?php
							if(count($list) ==0){
								echo "<tr class=odd>";
									echo "<td colspan=7>No record found.</td>";
								
								echo "</tr>";
							}
						?>
				    </tbody>
				</table>
				<div class="dataTables_info" id="example_info">
					<?php echo $form->input('setStatus', array('type' => 'hidden','id'=>'setStatus'));?>
					<?php echo $form->input('Record', array('type' => 'hidden','id'=>'Record','value'=>'Admin user'));?>
                                        <?php
					if($_SESSION['Auth']['User']['type'] == 'Admin'){ // Only super admin can change status
					echo $this->Form->button("Active",array('type'=>'submit','div'=>false,'class'=>'iconlink','name' => 'active','id'=>'stactive','value'=>1)); ?>
					<?php echo $this->Form->button("Inactive",array('type'=>'submit','div'=>false,'class'=>'iconlink','name' => 'inactive','id'=>'stdeactive','value'=>1));
					}
					?>
					<?php echo $this->Paginator->counter('Page {:page} of {:pages}, showing {:current} records out of {:count} total'); ?>	
				</div> 
				<?php echo $this->Form->end(); ?>

                                <div class="paging_full_numbers" id="example_paginate">
                                      <?php
                                            echo $this->Paginator->first('First');
                                            // Shows the next and previous links
                                            echo $this->Paginator->prev('Previous', null, null, array('class' => 'disabled'));
                                            // Shows the page numbers
                                            echo $this->Paginator->numbers(array('separator'=>''));
                                            echo $this->Paginator->next('Next', null, null, array('class' => 'disabled'));
                                            // prints X of Y, where X is current page and Y is number of pages
                                            //echo $this->Paginator->counter();
                                            echo $this->Paginator->last('Last');
				       ?>
                                </div>
				
				<div class="iconlegend" style="margin-left:200px;">
                                    <?php echo $this->Html->image('icons/small/black/edit.png', array('alt'=>"Edit Admin User", 'title'=>"Edit Admin User") );?> <span>Edit Admin User</span>
				    <?php echo $this->Html->image('icons/small/black/close.png', array('alt'=>"Delete Admin User", 'title'=>"Delete Admin User") );?> <span>Delete Admin User</span>
                                </div>
				
                        </div>
                </div><!-- dataTables_wrapper -->
</div><!-- left -->
<?php echo $this->Html->script('setStatus');?>