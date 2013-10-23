<?php 
$breadcrumbList=array(
       "Thoughts Of Day Listing"
	);
echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>
<div class="left"> 
            <?php echo $this->Html->link('Add Thought Of Day',array('controller'=>'admins','action'=>'admin_add_thought'), array('class' => 'addNewButton')); ?>
             <h1 class="pageTitle">Thoughts Of Day Listing</h1> 
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
            <?php if(!empty($thoughts)){  ?>
                <thead>
                   <tr>
                       <th  class="head1" align="left" width="30%">
                               Sr. No
                       </th>
                       <th  class="head1" align="left" width="40%">
                               Thought OF The Day
                       </th>
                       <th  class="head1" align="left" width="10%">
                               Status
                       </th>
                       <th  class="head1" align="left" width="10%">
                               Action
                       </th>
                    </tr>
                <thead>
                <?php
                     $class = '';
		     $id = 1;
                     foreach ($thoughts as $data) { 
                        $class = ($class == 'even')?'odd':'even';
                        if($data['Thought']['status'] == 1) {
                                 $status =  $this->Html->link($this->Html->image('active.png', array('alt'=>"Active", 'title'=>"status Change",'class'=>'change_status') ),array('controller'=>'admins','action'=>'admin_thought_status',base64_encode($data['Thought']['id'])),array('escape'=>false,'class'=>'manage_actions'), false);
                        }else{
                                 $status =  $this->Html->link($this->Html->image('deactive.png', array('alt'=>"Deactive", 'title'=>"status Change",'class'=>'change_status') ),array('controller'=>'admins','action'=>'admin_thought_status',base64_encode($data['Thought']['id'])),array('escape'=>false,'class'=>'manage_actions'), false);
                        }
                 ?>
		
                        <tr class = "<?php echo $class;?>">
                        <td style="padding: 10px;"><?php echo $id; $id++;?></td>
                                 <td style="padding: 10px;"class="<?php echo  $data['Thought']['id'];?>"><?php echo $data['Thought']['thought_of_day'];?></td>
                                 
                                   <td style="padding: 10px;"><?php echo $status;?></td>
                                 <td style="padding: 10px;">
                                    <?php echo  $this->Html->link($this->Html->image('icons/small/black/edit.png', array('alt'=>"edit image", 'title'=>"Edit Image") ),array('controller'=>'admins','action'=>'admin_add_thought',base64_encode($data['Thought']['id'])),array('escape'=>false,'class'=>'edit_thought'), false); ?>
                                    <?php echo  $this->Html->link($this->Html->image('icons/small/black/close.png', array('alt'=>"delete image", 'title'=>"Delete Image") ),array('controller'=>'admins','action'=>'admin_delete_thought',base64_encode($data['Thought']['id'])),array('escape'=>false,'class'=>'edit_rating'),'Are you sure you want to delete this Thought ?', false); ?>
                                 </td>
				 
				  <!--<script>
				    jQuery('.<?php //echo $data['Thought']['id']?>').live('dblclick',function(e){
						jQuery('.input').html('<td style="padding: 10px;"class="<?php //echo  $data['Thought']['id'];?>"><?php echo $data['Thought']['thought_of_day'];?></td>');
						//jQuery(this).show();
						var inp_val = jQuery(this).html();
						var id = <?php //echo $data['Thought']['id']?>;
						jQuery(this).html('<input type="text" class ="input" name="box" value='+inp_val+'>');
						//alert(inp_val);
						jQuery('.input').focusout(function(e){
						var val = jQuery('.input').val();
				          jQuery.ajax({
						url:'/admin/admins/ajax/'+val+'/'+id,
						success:function(data){
							    //alert(data);
							    jQuery('.input').remove();
							    jQuery('.<?php //echo $data['Thought']['id']?>').html(''+data+'');
						}
				    });
					
				     });
				     e.preventDefault();
				    return false;
				    })
				    </script>-->
				 
                 <?php } }else{ ?>
                    NO RECORDS
                 <?php } ?>
         </table>		
                        </div>
                </div><!-- dataTables_wrapper -->
</div><!-- left -->
