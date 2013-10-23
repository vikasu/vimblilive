<?php 
 echo $this->Html->script('jquery-1.7.2.min.js');
 echo $this->Html->css('validationEngine.jquery');
 echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine-en.js');
 echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine.js');
?>
<script type="text/javascript">
 jQuery(document).ready(function(){      
    jQuery("#form").validationEngine();
 });      
</script>
<style>
ul.main-form
{
    width:100%;
}	
</style>
<?php
    $breadcrumbList=array(
    '0'=>array(
	'name'=>'Manage Email Templates',  
	'controller' => 'email_templates',
	'action' => 'index'
	),
    'Add Email Templates'
    );
    echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
?>
<div class="left">
<?php echo $this->Session->flash(); ?>
    <div class="widgetbox">
    <h3><span>Add Email Template</span></h3>
    <?php echo $this->Session->flash(); ?>
	    <div class="content">
		    <div>Note: All fields marked with (<em style="color:red;">*</em>) are required.</div>
		    <br/>
		    <?php echo $this->Form->create('EmailTemplate', array('controller' => 'email_templates','action' => 'add','prefix'=>'admin','id'=>'form')); ?>
		    <div class="form_default">
			    <div style="width:800px;padding-bottom:20px;">
			    <div style="width: 400px; float: left; clear: both;">
			    <table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
				<tr>
				    <td width="100px">Title <em>*</em> :</td>
				    <td>
					<?php echo $this->Form->input('EmailTemplate.title',array('size'=>'30','div'=>false,'label'=>false,'class' =>'validate[required]')); ?>
				    </td>
				</tr>
				<tr>
				    <td width="100px">Head Title <em>*</em> :</td>
				    <td>
					<?php echo $this->Form->input('EmailTemplate.head_title',array('size'=>'30','div'=>false,'label'=>false,'class' =>'validate[required]')); ?>
				    </td>
				</tr>
				<tr>
				    <td width="100px">Subject <em>*</em> :</td>
				    <td>
				        <?php echo $this->Form->input('EmailTemplate.subject',array('size'=>'30','div'=>false,'label'=>false,'class' =>'validate[required]')); ?>
				    </td>
				</tr>
			    </table>
			    </div>
			    <div style="width: 325px; float: left; max-height: 128px;font-size:10px;border:1px solid black;margin-bottom:20px;">
				<h3 style="text-align:center;">Template Variables</h3>
				<div style="overflow-y:scroll;max-height:104px;">
				<span><b>{FIRST_NAME}</b> - For first name of the user</span><br/>
				<span><b>{LAST_NAME}</b> - For last name of the user</span><br/>
				<span><b>{USERNAME}</b> - For username of the user</span><br/>
				<span><b>{PASSWORD}</b> - For password of the user</span><br/>
				<span><b>{EMAIL}</b> - For Email of the user</span><br/>			
				<span><b>{LOGIN_LINK}</b> - For login page url of the site</span>
				</div>
			    </div>
			    </div>
			    <div style="width:730px;float:left;">
			    <table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
				<tr>
					<td width="120px" style="top:0px;">Content <em>*</em> :</td>
					<td width="400px">
						<?php echo $this->Form->input('EmailTemplate.description',array('type' =>'textarea','cols'=>'35','rows'=>'14' ,'div'=>false,'label'=>false,'class' =>'validate[required]')); ?>
					</td> 
				</tr>
			    </table>
			    </div>
			    <div style="width:800px;float:left;">
			    <table cellpadding="0" cellspacing="0" width="400px">
				<tr>     
				    <td>
					<?php echo $this->Form->button('Save', array('id'=>'save',"name"=>"save",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
					<?php echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '/admin/email_templates'",'style'=>'margin-left:0px !important'));?>
				    </td>
				</tr> 
			    </table>
			    </div>
			    
		    </div><!-- form_default -->
		    <?php echo $this->Form->end(); ?>
		    </div><!-- content -->
     </div><!-- widgetbox -->
</div><!-- left -->
<?php echo $this->Html->script('tiny_mce/tiny_mce'); ?>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		skin : "o2k7",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",
     
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
                
                style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Bold text', inline : 'b',styles:{color : '#485E9A'}},
			{title : 'Bold large text', inline : 'b',styles:{color : '#485E9A','font-size':'18px'}},
                        {title : 'Italic text', inline : 'i'},
                        {title : 'Underline text', inline : 'u'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			//{title : 'Example 1', inline : 'span', classes : 'example1'},
			//{title : 'Example 2', inline : 'span', classes : 'example2'},
			//{title : 'Table styles'},
			//{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],
		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	}); 
</script>
<!-- /TinyMCE -->