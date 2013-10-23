<?php 

$url = array(
	'keyword' =>$keyword,	
	'searchin' => $fieldname,
	'showtype' => $show
);


$optionspaging = array('url'=>$url,'update'=>'listing');

$paginator->options($optionspaging);

?>
<?php
    $breadcrumbList=array( 'Manage Activity Types' );
    echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>

<div class="left"> 
            <?php echo $this->Html->link('Add New',array('controller'=>'activities','action'=>'add_activity_type','prefix'=>'admin'), array('class' => 'addNewButton')); ?>
            <h1 class="pageTitle">Manage Activity Types</h1> 
            <?php
                if ($session->check('Message.flash') || $session->check('Message.auth'))
		{   
                      echo $this->Session->flash();   
                }          
            ?>
            <!--<div style="font-size:12px;font-weight:bold;color:red;" align='center'>  </div>-->
	    <div class="dataTables_wrapper" id="example_wrapper">
                        <div class="dataTables_length" id="dataTables_filter">
			<div class="form_default">
			    	
				<table width="100%" cellspacing="1" cellpadding="2" class="adminBox" align="center" border="0">
				    <tr>
					    <td>
						    <?php echo $form->create("Activities",array('controller' => 'activities' ,'action' => 'activity_types',"method"=>"Post", "id"=>"frmSearchadmin", "name"=>"frmSearchadmin"));?>

						    <table width="100%" cellspacing="1" cellpadding="1" align="center" border="0">
							    <tr>
								    <td align="left" width="9%">Keyword : </td>
								    <td width="25%">
									    <?php echo $form->input('Search.keyword',array('size'=>'25','class'=>'textbox','label'=>false,'div'=>false,'maxlength'=>'50','value'=>$keyword));?>
								    </td>
								    <td width="10%">
									    <?php echo $form->select('Search.show',@$showArr,null,array('type'=>'select','class'=>'textbox','label'=>false,'div'=>false,'error'=>false,'size'=>1,'empty'=>'All..')); ?>
								    </td>
								    <td width="20%">
									    <?php echo $form->submit('Search',array('alt'=>'Next','width'=>'38','height'=>'31','border'=>'0', "value"=>"search",'div'=>false,'class'=>'btn_53'))?>
								    </td>
								    
							    </tr>
						    </table>
							    <?php echo $form->end();?>
						    </td>
					    </tr>
				    </table>
					   
			</div>
			</div>
			<div id="content" class="form">                        
                                <?php echo $this->element('admin/activity_type_listing'); ?>			
                        </div>
                </div><!-- dataTables_wrapper -->
</div><!-- left -->
