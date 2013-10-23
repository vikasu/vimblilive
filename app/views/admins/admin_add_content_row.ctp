<?php //pr($this->data);die; ?>
<style type="">
	ul.main-form{
		width:100%;
	}	
</style>
<?php
	if(empty($id)){ 	
		$breadcrumbList=array(
		       '0'=>array(
			       'name'=>'Manage Content Row',  
			       'controller' => 'admins',
			       'action' => 'admin_content_row_list'
			       ),
			'Add Content Row'
			);
	}else{
		$breadcrumbList=array(
	       '0'=>array(
		       'name'=>'Manage Content Row',  
		       'controller' => 'admins',
		       'action' => 'admin_content_row_list'
		       ),
		'Update Content Row'
		);
	}
	echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>

<div class="left">
<?php echo $this->Session->flash(); ?>
     <div class="widgetbox">
	<!-- checking form for add or edit-->
	<?php 	if(empty($id)){ ?>
		    <h3><span>Add Content Row</span></h3> 
		<?php }else{  ?>
		    <h3><span>Update Content Row</span></h3>
		 <?php } 
		 echo $this->Session->flash();
	?>
	    <div class="content">
	    <?php echo $this->element("message/errors");?>
	    <div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>
	    <?php echo $this->Form->create('Admin', array('controller' => 'admins','action' => 'admin_add_content_row/'.base64_encode(@$this->data['ContentRow']['id']),'prefix'=>'admin','id'=>'form','enctype'=>'multipart/form-data')); ?>
	    <div class="form_default">
	    <table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
	    <tr>
		<td width="140px">Link<em>*</em> :</td>
		<td>
		    <?php echo $this->Form->input('ContentRow.link',array('size'=>'60','div'=>false,'id'=>'','label'=>false,'class' =>'','maxlength'=>'40')); ?>
		    <td><?php echo "(maximum length 40 char)";?></td>
		</td>
	    </tr>
	    <tr>
		<td width="140px">Descriprtion <em>*</em> :</td>
		<td>
		    <?php echo $this->Form->input('ContentRow.description',array('type'=>'textarea','size'=>'60','div'=>false,'label'=>false,'class' =>'','id'=>'','maxlength'=>'204')); ?>
		<td><?php echo "(maximum length 400 char)";?></td>
		</td>
	    </tr>
	    <tr>
		<td width="140px">Image<em>*</em> :</td>
		<td>
		    <?php echo $this->Form->input('ContentRow.content_image',array('type'=>'file','size'=>'60','div'=>false,'label'=>false,'class' =>'','id'=>'','value'=>'')); ?>
		</td>
	    </tr>
	  
		    
	    </table>
	    <table cellpadding="0" cellspacing="0" width="500px">
	    <tr>     
		<td>
		    <?php echo $this->Form->button('Save', array('id'=>'save',"name"=>"save",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
		    <?php echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '".SITE_URL."admin/admins/content_row_list'",'style'=>'margin-left:0px !important'));?> 
		</td>
	    </tr> 
	    </table>
        </div><!-- form_default -->
        <?php echo $this->Form->end(); ?>
    </div><!-- content -->
     </div><!-- widgetbox -->
</div><!-- left -->