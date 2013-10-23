<?php 
    echo $this->Html->script('jquery-1.7.2.min.js');
    echo $this->Html->css('validationEngine.jquery');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine-en.js');
    echo $this->Html->script('jqueryValidationEngine/jquery.validationEngine.js');
    echo $this->Html->script('tiny_mce/tiny_mce');
?>
<script type="text/javascript">
   jQuery(function(){
    //alert('hii');
    var checked = jQuery('.msgTo').first().attr('checked',true);
    if(checked){
		$("#user-list input:checkbox").prop("checked",true);
		jQuery('#user-list').css('display','block');
		jQuery('#group-list').css('display','none');
		jQuery('#sponsor-list').css('display','none');
		jQuery('#groupmanager-list').css('display','none');
    }
    jQuery('.msgTo').click(function(){
	var val =jQuery(this).val();
	if(val == 'all'){
		    $("#user-list input:checkbox").prop("checked",true);
		    jQuery('#user-list').css('display','block');
		    jQuery('#group-list').css('display','none');
		    jQuery('#sponsor-list').css('display','none');
		     jQuery('#groupmanager-list').css('display','none');
		}
		if(val == 'group'){
		    $("#user-list input:checkbox").prop("checked",false);
		    jQuery('#group-list').css('display','block');
		    jQuery('#user-list').css('display','none');
		    jQuery('#sponsor-list').css('display','none');
		    jQuery('#groupmanager-list').css('display','none');
		}
		if(val == 'sponsor'){
		    $("#user-list input:checkbox").prop("checked",false);
		    jQuery('#sponsor-list').css('display','block');
		    jQuery('#group-list').css('display','none');
		    jQuery('#user-list').css('display','none');
		    jQuery('#groupmanager-list').css('display','none');
		}
		if(val == 'groupmanager'){
		    $("#user-list input:checkbox").prop("checked",false);
		     jQuery('#groupmanager-list').css('display','block')
		    jQuery('#MessageToUserId').css('display','block');
		    jQuery('#user-list').css('display','none');
		    jQuery('#group-list').css('display','none');
		    jQuery('#sponsor-list').css('display','none');
		}
    })
    })
   
   
</script>
<style>
.form_default label {
    float: inherit;
    padding: 5px;
}
div.checkbox {
    padding:2px;
}
.form_default textarea {
    width: 485px;
}
</style>
<?php
        $breadcrumbList=array(
                            '0'=>array(
                                    'name'=>'Send Messages',  
                                    'controller' => 'messages',
                                    'action' => 'add'
                                    ),
                                'Create'
                                );
            echo $this->BreadcrumbDiv->showBreadcrumb($breadcrumbList);
	?>
<div class="left">
	    <?php echo $this->Session->flash(); ?>
		 <div class="widgetbox">
            	<h3><span>Send MEssage</span></h3>
				<?php echo $this->Session->flash(); ?>
				<div class="content">
				    <?php echo $this->element("message/errors");?>
				    
					<div>Note: All fields marked with (<em style="color:red;">*</em>) are required. </div><br/>
					<div style="margin-left:90px"><ul>
				     <li style=" list-style-type: none;">
				     <!-- <span style="padding-left:10px; margin-bottom:10px;">Message To:</span><br>  -->
				      <input type="radio" id="all" class="msgTo" name="data[Message][msg_to]" value="all" checked="checked" style="margin-left:5px;"> All
				      <input type="radio" id="group" class="msgTo" name="data[Message][msg_to]" value="group" style="margin-left:10px;"> Group
				      <input type="radio" id="sponsor" class="msgTo" name="data[Message][msg_to]" value="sponsor" style="margin-left:10px;"> Sponsor
				      <input type="radio" id="groupmanager" class="msgTo" name="data[Message][msg_to]" value="groupmanager" style="margin-left:10px;"> Admin/GroupManager
				      </li>
				    </ul></div><br/>	
					<?php echo $this->Form->create('Message', array('controller' => 'message','action' => 'admin_add','prefix'=>'admin','id'=>'form')); ?>
					<div class="form_default">
						<table border=0 cellpadding=0 cellspacing="0" class="tableformfield">
							
							<tr>
                                                                <td width="100px">Email to: <em>*</em> :</td>
                                                                <td >
								    <div class="user-list" id="user-list">
									<?php echo $this->Form->input('Message.to_user_id1',array('label'=>false,'error'=>false,'type' => 'select', 'multiple' => 'checkbox','options' => $usersList,'empty'=>'')); ?>
								    </div>
								  
								
								    <div  class="user-list" id="group-list">
									<?php echo $this->Form->input('Message.to_user_id2',array('label'=>false,'error'=>false,'type' => 'select', 'multiple' => 'checkbox','options' => $groupList,'empty'=>'')); ?>
								    </div>
								
								
								    <div  class="user-list" id="sponsor-list">
									<?php echo $this->Form->input('Message.to_user_id3',array('label'=>false,'error'=>false,'type' => 'select', 'multiple' => 'checkbox','options' => $sponsorList,'empty'=>'')); ?>
								    </div>
								    
								    <div  class="user-list" id="groupmanager-list">
									<?php echo $this->Form->input('Message.to_user_id4',array('label'=>false,'error'=>false,'type' => 'select', 'multiple' => 'checkbox','options' => $groupManagerList,'empty'=>'')); ?>
								    </div>
	
								    
								</td>
                                                        </tr>
							
							<tr>
                                                                <td width="100px">Subject <em>*</em> :</td>
                                                                <td>
                                                                    <?php echo $this->Form->input('Message.subject',array('error'=>false,'size'=>'60','div'=>false,'label'=>false,'class' =>'validate[required]')); ?>
                                                                </td>
                                                        </tr>
							
							<tr>
                                                                <td width="50px" style="top:0px;">Message <em>*</em> :</td>
								<td>
                                                                    <?php echo $this->Form->input('Message.content',array('error'=>false,'type' =>'textarea','cols'=>'40','rows'=>'14' ,'div'=>false,'label'=>false,'class' =>'mceEditor validate[required]')); ?>
                                                                </td> 
                                                        </tr>
						</table>
						<table cellpadding="0" cellspacing="0" width="500px">
							<tr>     
							        <td>									
								<?php echo $this->Form->button('Send', array('id'=>'save',"name"=>"save",'type'=>'submit','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false));?>
								<?php echo $this->Form->button('cancel', array('id'=>'cancel',"name"=>"cancel",'type'=>'button','div'=>false,'label'=>false,'tabindex'=>'1','escape'=>false,'onclick'=>"window.location.href = '/admin/pages'",'style'=>'margin-left:0px !important'));?> 
								</td>				  			     </tr> 
						</table>
					</div><!-- form_default -->
	
					<?php echo $this->Form->end(); ?>
				
				</div><!-- content -->
		 </div><!-- widgetbox -->
</div><!-- left -->

<script type="text/javascript">

/* //ajax request to fetch user for a user group
jQuery(document).ready(function(){
    jQuery('.select_usergroups').live('change', function(){
	var user_group_id = jQuery('.select_usergroups').val();
	jQuery.ajax({
	    type:'post',
	    url: '<?php echo SITE_URL; ?>admin/messages/add',
	    data: {id: user_group_id },
	    success: function (response) { alert(response);
		jQuery('.somediv').empty().html(response);
	    }
	});
    });
}); */
	tinyMCE.init({
		// General options
		mode : "specific_textareas",
		theme : "advanced",
		editor_selector :"mceEditor",
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