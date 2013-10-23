<style type="">
	ul.main-form{
		width:100%;
	}	
</style>
<?php
$breadcrumbList=array(
       '0'=>array(
	       'name'=>'Manage Carosuel Image',  
	       'controller' => 'admins',
	       'action' => 'admin_homes_image_listing'
	       ),
	'Add carousel Image'
	);
echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>
<?php //pr($this->data); die;?>
<div class="left">
<?php echo $this->Session->flash(); ?>
     <div class="widgetbox">
    <h3><span>Add Carosel Image</span></h3>
	    <?php echo $this->Session->flash(); ?>
	    <div class="content">
	    <?php echo $this->element("message/errors");?>
	    <div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>
	    <?php echo $this->Form->create('Admin', array('controller' => 'admins','action' => 'admin_add_carousel_image/'.base64_encode(@$this->data['CarouselDetail']['id']),'prefix'=>'admin','id'=>'form','enctype'=>'multipart/form-data')); ?>
	    <div class="form_default">
	    <table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
	    <tr>
		<td width="140px">title <em>*</em> :</td>
		<td>
		    <?php echo $this->Form->input('CarouselDetail.carousel_title',array('size'=>'60','div'=>false,'id'=>'','label'=>false,'class' =>'','error'=>false,'maxlength'=>'40')); ?>
		    <td><?php echo "(maximum length 40 char)";?></td>
		</td>
	    </tr>
	    <tr>
		<td width="140px">descriprtion <em>*</em> :</td>
		<td>
		    <?php echo $this->Form->input('CarouselDetail.carousel_description',array('type'=>'textarea','size'=>'60','div'=>false,'label'=>false,'class' =>'','id'=>'','error'=>false,'maxlength'=>'204')); ?>
		<td><?php echo "(maximum length 400 char)";?></td>
		</td>
	    </tr>
	    <tr>
		<td width="140px">image <em>*</em> :</td>
		<td>
		    <?php echo $this->Form->input('CarouselDetail.Carousel_image',array('type'=>'file','size'=>'60','div'=>false,'label'=>false,'class' =>'','id'=>'','value'=>'','error'=>false)); ?>
		</td>
	    </tr>
	  
		    
	    </table>
	    <table cellpadding="0" cellspacing="0" width="500px">
	    <tr>     
		<td>
		    <?php echo $this->Form->button('Save', array('id'=>'save',"name"=>"save",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
		    <?php echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '".SITE_URL."admin/admins/homes_image_listing'",'style'=>'margin-left:0px !important'));?> 
		</td>
	    </tr> 
	    </table>
        </div><!-- form_default -->
        <?php echo $this->Form->end(); ?>
    </div><!-- content -->
     </div><!-- widgetbox -->
</div><!-- left -->