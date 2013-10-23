<style>
ul.main-form { width:100%; }
</style>
<div class="left">
	<?php echo $this->Session->flash(); ?>
	<div class="widgetbox">
        <h3><span>Edit Account</span></h3>
	    <?php echo $this->Session->flash(); ?>
	    <div class="content">
		<?php echo $this->element("message/errors");?>
		<div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>
		<?php echo $this->Form->create('Admin', array('controller' => 'admins','action' => 'edit_account','prefix'=>'admin','id'=>'edit_account')); ?>
		<?php //echo $this->Form->hidden('Admin.id',array('div'=>false,'label'=>false,'value'=>$id)); ?>
                 <div class="form_default">
		    <table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
			<tr>
			    <td width="140px">Old Password <em>*</em> :</td>
			    <td>
				<?php
				echo $this->Form->input('Admin.oldpassword',array('type'=>'password','size'=>'60','div'=>false,'label'=>false,'class' =>'','id'=>'','value'=>'')); ?>
			    </td>
                        </tr>
			<tr>
			    <td width="140px">Password <em>*</em> :</td>
			    <td>
				<?php echo $this->Form->input('Admin.pwd',array('type'=>'password','size'=>'60','div'=>false,'label'=>false,'class' =>'','id'=>'password','value'=>'')); ?>
			    </td>
                        </tr>
			<tr>
			    <td width="140px">Confirm Password <em>*</em> :</td>
			    <td>
				<?php echo $this->Form->password('Admin.confirmpassword',array('type'=>'password','size'=>'60','div'=>false,'label'=>false,'class' =>'','value'=>'')); ?>
			    </td>
                        </tr>
                        <tr>
			    <td width="140px">Email :</td>
                            <td>
				<?php echo $this->Form->input('Admin.email',array('size'=>'60','div'=>false,'label'=>false,'class' =>'')); ?>
                            </td>
                        </tr>
                        
		    </table>
		    <table cellpadding="0" cellspacing="0" width="500px">
			<tr>     
			    <td>
                                <?php echo $this->Form->button('Save', array('id'=>'save',"name"=>"save",'onclick' => "return ajax_form('edit_account','admin/admins/edit_account','receiver')",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
				<?php echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '/admin/admins/index'",'style'=>'margin-left:0px !important'));?> 
			    </td>
			</tr> 
		    </table>
		</div><!-- form_default -->
		<?php echo $this->Form->end(); ?>
	    </div><!-- content -->
	</div><!-- widgetbox -->
</div><!-- left -->