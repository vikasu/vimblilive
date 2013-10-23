<style>
ul.main-form { width:100%; }
</style>
<?php
    $breadcrumbList=array(
	   '0'=>array(
		   'name'=>'Manage Admin Staff',  
		   'controller' => 'admins',
		   'action' => 'index'
		   ),
	       'Edit Admin Staff'
	       );
    echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>
<div class="left">
	<?php echo $this->Session->flash(); ?>
	<div class="widgetbox">
        <h3><span>Edit Admin Staff</span></h3>
	    <?php echo $this->Session->flash(); ?>
	    <div class="content">
		<?php echo $this->element("message/errors");?>
		<div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>
		<?php echo $this->Form->create('Admin', array('controller' => 'admins','action' => 'edit/'.base64_encode($this->data['Admin']['id']),'prefix'=>'admin','id'=>'admin_edit')); ?>
		<div class="form_default">
		    <table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
			<tr>
			    <td width="140px">Name :</td>
			    <td>
				<?php echo $this->Form->input('Admin.name',array('size'=>'60','div'=>false,'id'=>'','label'=>false,'class' =>'','error'=>false)); ?>
			    </td>
                        </tr>
			<tr>
			    <td width="140px">Password <em>*</em> :</td>
			    <td>
				<?php echo $this->Form->input('Admin.pwd',array('type'=>'password','size'=>'60','div'=>false,'label'=>false,'class' =>'','id'=>'password','value'=>'','error'=>false)); ?>
			    </td>
                        </tr>
			<tr>
			    <td width="140px">Confirm Password <em>*</em> :</td>
			    <td>
				<?php echo $this->Form->input('Admin.confirmpassword',array('type'=>'password','size'=>'60','div'=>false,'label'=>false,'class' =>'','value'=>'','error'=>false)); ?>
			    </td>
                        </tr>
			<tr>
			    <td width="140px">Email <em>*</em> :</td>
                            <td>
				<?php echo $this->Form->input('Admin.email',array('size'=>'60','div'=>false,'label'=>false,'class' =>'','error'=>false)); ?>
                            </td>
                        </tr>
		    </table>
		    <table cellpadding="0" cellspacing="0" width="500px">
			<tr>     
			    <td>								    <?php echo $this->Form->button('Save', array('id'=>'save',"name"=>"save",'onclick' => "return ajax_form('admin_edit','admin/admins/edit','receiver')",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
				<?php echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '/admin/admins/index'",'style'=>'margin-left:0px !important'));?> 
			    </td>
			</tr> 
		    </table>
		</div><!-- form_default -->
		<?php echo $this->Form->end(); ?>
	    </div><!-- content -->
	</div><!-- widgetbox -->
</div><!-- left -->