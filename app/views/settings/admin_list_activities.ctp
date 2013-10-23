<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>

<?php //pr($conLists); die;
    $breadcrumbList=array(
                            '0'=>array(
                                    'name'=>'Manage Connection Groups',  
                                    'controller' => 'connections',
                                    'action' => 'connection_groups'
                                    ),
                                'Connection List'
                                );
            echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
	
?>
<div class="left"> 
            <?php //echo $this->Html->link('Add New',array('controller'=>'admins','action'=>'add'), array('class' => 'addNewButton')); ?>
            <h1 class="pageTitle">Connection List</h1> 
            <?php
                if ($session->check('Message.flash') || $session->check('Message.auth'))
		{   
                      echo $this->Session->flash();   
                }          
            ?>
	    
            <!--<div style="font-size:12px;font-weight:bold;color:red;" align='center'>  </div>-->
	    <div class="dataTables_wrapper" id="example_wrapper">
		
		
		
                        <div id="content" class="form">
                        <?php echo $this->Form->create('', array('controller' => 'categories' ,'action' => 'index','prefix'=>'admin','id'=>'adform'));?>
                                <table cellspacing="0" cellpadding="0" border="0" id="example" class="dyntable">
				    <thead>
					 <tr>
					    <th class="head1 sorting" width="10%">Sr. No.</th>
					    <th class="head1 sorting" width="20%">Title</th>
					    <th class="head1 sorting" width="30%">Description</th>
					    <th class="head1 sorting" width="15%">Rating</th>	
					    <th class="head1 sorting" width="25%">Status</th>
					 </tr>
				    </thead>
					
				    <tbody>
                                            <?php $i=0;	//pr($activityLists);
					    $j = 0;
                                                foreach($activityLists as $page){
						$j = $j+1;
                                                if($i%2==0) { $classVar='class="even"'; } else { $classVar='class="odd"'; } 
                                            ?>
					     <script>
                                            jQuery(function() {
                                                var refId = <?php echo $j ?>;
                                                var starDivId = '#'+refId; 
                                                jQuery(starDivId).raty({
                                                    readOnly : true,
                                                    score    : <?php echo $page['Activity']['rating']; ?>,
                                                    path : "<?php echo SITE_URL; ?>img/",
						    number: 5
						    });
                                            });
                                            </script>
					     
						<tr <?php echo $classVar?>>
							<td>
							<?php echo $i+1; ?>
							</td>
							<td>
							<?php echo $page['Activity']['title'];?></td>
							<td>
							<?php echo $page['Activity']['description'];?>
							</td>
							
							<td>
							    <div class="dbRefRate" id="<?php echo $j; ?>"></div>
						    	</td>
							
							<td>
							    <?php echo $page['Activity']['status'] == 1 ? 'Active' : 'Inactive'; ?>	
							</td>
                                                       
                                            <?php $i++; } ?>
						<?php
							if(count($activityLists) ==0){
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
				
                        </div>
                </div><!-- dataTables_wrapper -->
</div><!-- left -->
<?php echo $this->Html->script('setStatus');?>