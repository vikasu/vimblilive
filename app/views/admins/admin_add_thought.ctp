<style type="">
	ul.main-form{
		width:100%;
	}	
</style>
<?php
	if(empty($id)){ 	
		$breadcrumbList=array(
		       '0'=>array(
			       'name'=>'Manage Thought',  
			       'controller' => 'admins',
			        'action' => 'admin_thoughts_listing'
			       ),
			'Add Thought Of Day'
			);
	}else{
		$breadcrumbList=array(
	       '0'=>array(
		       'name'=>'Manage Thought',  
			'controller' => 'admins',
			'action' => 'admin_thoughts_listing'
		       ),
		'Update Thought Of Day'
		);
	}
	echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>
<?php //pr($this->data); die;?>
<div class="left">
<?php echo $this->Session->flash(); ?>
     <div class="widgetbox">
     <?php if(empty($id)){ ?>
	<h3><span>Add Thought Of The Day</span></h3> 
     <?php }else{  ?>
	<h3><span>Update Thought Of The Day</span></h3>
     <?php } ?>
    
	    <?php echo $this->Session->flash(); ?>
	    <div class="content">
	    <?php echo $this->element("message/errors");?>
	    <div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>
	    <?php echo $this->Form->create('Admin', array('controller' => 'admins','action' => 'admin_add_thought/'.base64_encode(@$this->data['Thought']['id']),'prefix'=>'admin','id'=>'form','enctype'=>'multipart/form-data')); ?>
	    <div class="form_default">
	    <table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
	    <tr>
		<td width="140px">Thought Of Day<em>*</em> :</td>
		<td>
		    <?php echo $this->Form->input('Thought.thought_of_day',array('size'=>'60','div'=>false,'id'=>'thought','label'=>false)); ?>
		</td>
	    </tr>
	    </table>
	    <table cellpadding="0" cellspacing="0" width="500px">
	    <tr>     
		<td>
		    <?php echo $this->Form->button('Save', array('id'=>'save',"name"=>"save",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
		    <?php echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '".SITE_URL."admin/admins/thoughts_listing'",'style'=>'margin-left:0px !important'));?> 
		</td>
	    </tr> 
	    </table>
        </div><!-- form_default -->
        <?php echo $this->Form->end(); ?>
    </div><!-- content -->
     </div><!-- widgetbox -->
</div><!-- left -->