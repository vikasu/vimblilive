<style>
	ul.main-form{
			width:100%;
	}
	
	/*#RatingRatingRange{
			border: medium none;
			box-shadow: none;
	}*/
	#RatingRating{
			border: medium none;
			box-shadow: none;
	}
</style>
<?php
$breadcrumbList=array(
       '0'=>array(
	       'name'=>'Rating List',  
	       'controller' => 'admins',
	       'action' => 'admin_list_rating'
	       ),
	'Mange Rating text'
	);
echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>
<div class="left">
<?php echo $this->Session->flash(); ?>
     <div class="widgetbox">
    <h3><span>Mange Rating text</span></h3>
	    <?php echo $this->Session->flash(); ?>
	    <div class="content">
	    <?php echo $this->element("message/errors");?>
	    <div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>
	    <?php echo $this->Form->create('Admin', array('controller' => 'Admins','action' => 'admin_manage_rating/'.base64_encode($rating['Rating']['id']),'id'=>'addQueForm', 'name'=>'addQueForm')); ?>
	    <?php echo $this->Form->input('Rating.id',array('value'=>$rating['Rating']['id'],'type'=>'hidden')); ?> <!-- hidden field -->
	    <div class="form_default">
	    <table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
	    <tr>
		<td width="140px">Rating Range: <em>*</em> :</td>
		<td>
		    <?php //echo $this->Form->input('Rating.rating_range',array('value'=>$rating['Rating']['rate_start'].' To '.$rating['Rating']['rate_end'],'size'=>'8','div'=>false,'label'=>false,'class' =>'input','error'=>false,'style'=>'margin-top:5px','readonly'=>true)); ?>
		    <?php echo $this->Form->input('Rating.rating',array('value'=>$rating['Rating']['rating'],'size'=>'8','div'=>false,'label'=>false,'class' =>'input','error'=>false,'style'=>'margin-top:5px','readonly'=>true)); ?>
		</td>
	    </tr>
	    <tr>
		<td width="140px">Rating Quote: <em>*</em> :</td>
		<td>
		    <?php //echo $this->Form->input('Rating.rating_quote',array('value'=>$rating['Rating']['rating_quote'],'size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','style'=>'margin-top:5px')); ?>
		     <?php echo $this->Form->input('Rating.rating_quote',array('value'=>$rating['Rating']['rating_quote'],'size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','style'=>'margin-top:5px')); ?>
		</td>
	    </tr>
		    
	    </table>
	    <table cellpadding="0" cellspacing="0" width="500px">
	    <tr>     
		<td>
		    <?php echo $this->Form->button('Save', array('id'=>'save',"name"=>"save",'onclick' => "return ajax_form('admin_add','admin/admins/add','receiver')",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
		    <?php echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '".SITE_URL."/admin/admins/list_rating'",'style'=>'margin-left:0px !important'));?> 
		</td>
	    </tr> 
	    </table>
        </div><!-- form_default -->
        <?php echo $this->Form->end(); ?>
    </div><!-- content -->
     </div><!-- widgetbox -->
</div><!-- left -->
</div>