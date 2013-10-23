<?php echo $this->Html->script('tiny_mce/tiny_mce'); ?>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#sendMsgForm").validationEngine();
	
	jQuery(".msgTo").click(function(){
		jQuery(".listing").hide();
		var classToShow = "."+jQuery(this).attr('id');
		jQuery(classToShow).show();
	});
	
});
</script>
<style>
.basic-details .textarea {
	height: 118px !important;
    width: 450px !important;
}



</style>

<!--Center Align Inner Content Section Starts-->
<section class="content-pane full_content-pane">
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin signuplogin_new">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
                          <!--SignUp Heading-->
			  <?php echo $this->Form->create('Message', array('url'=>array('controller' => 'groups','action' => 'send_message'),'id'=>'sendMsgForm', 'name'=>'sendMsgForm','enctype'=>'multipart/form-data')); ?>
                          
			  <input type="hidden" name="data[Message][to_user_id]" value="<?php echo $id ?>">
				  
			  <div class="signup-hdng addcnncthdn"><h3 class=bebas>Send<span> Message</span></h3></div>
                          
			  <?php if($id==""){?>
			  <!--Basic Details Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
			      <section class=bscdtl-lft>
                                  <ul>
                                      <li>
				      <span style="padding-left:10px; margin-bottom:10px;">Message To:</span><br>
				      <input type="radio" id="individual" class="msgTo" name="data[Message][msg_to]" value="individual" checked="checked" style="margin-left:5px;">Individual User
				      <input type="radio" id="cohort" class="msgTo" name="data[Message][msg_to]" value="cohort" style="margin-left:10px;">Cohorts
				      <input type="radio" id="group" class="msgTo" name="data[Message][msg_to]" value="group" style="margin-left:10px;">Group
				      </li>
				      
				      <li class="individual listing" style="margin-top:10px; display:block;"><div style="border:1px solid #ccc; overflow-y:scroll; height:120px; width: 308px; margin: 0 0 15px 5px; border-radius:4px;">
						<span style="float:left; width:95%; padding:5px; background:#eee; text-align:center;">Select Users</span>
						<?php foreach($allUsers as $key=>$val): ?>
						    <span style="float:left; width:95%; padding:5px;"><input type="checkbox" name="data[User][user_id][]" value="<?php echo $key; ?>" style="margin:0 3px 0 0;"><?php echo $val; ?></span>
						<?php endforeach; ?>
						  </div>
					</li>
				      
					<li class="cohort listing" style="margin-top:10px; display:none;"><div style="border:1px solid #ccc; overflow-y:scroll; height:120px; width: 308px; margin: 0 0 15px 5px; border-radius:4px;">
						<span style="float:left; width:95%; padding:5px; background:#eee; text-align:center;">Select Cohorts</span>
						<?php foreach($cohortList as $key=>$val): ?>
						    <span style="float:left; width:95%; padding:5px;"><input type="checkbox" name="data[Cohort][cohort_id][]" value="<?php echo $key; ?>" style="margin:0 3px 0 0;"><?php echo $val; ?></span>
						<?php endforeach; ?>
						  </div>
					</li>
				      
				  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Basic Details End-->
			  <?php } ?>
			  
			  <!--Basic Details Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
			      <section class=bscdtl-lft>
                                  <ul>
                                      <li><div class=textbox><span><?php echo $this->Form->input('Message.subject',array('placeholder'=>'Subject','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Basic Details End-->
                          <!--Note & Strength Check Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
                              <section class=bscdtl-lft>
                                  <ul>
                                      <li>
				      <span style="padding-left:10px;">Message:</span><br>
				      <?php //echo $this->Form->input('Message.content',array('type'=>'textarea','size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','error'=>false,'style'=>'margin-top:5px')); ?></li>
				      <?php echo $this->Form->input('Message.content',array('error'=>false,'type' =>'textarea','cols'=>'10','rows'=>'14' ,'div'=>false,'label'=>false,'class' =>'mceEditor validate[required]')); ?>
				  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Note & Strength Check End-->
                          <!--Add Connection Button-->
                          <section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Send',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></section>
			  
			  <?php echo $this->Form->end(); ?>
			  
                      </section>
                 </section>
             </section>
             <section class=whiteboxbot>
                 <section class=whiteboxbot-right></section>
             </section>
         </section>
         <!--Flexible WhiteBox With Shadows End-->
    </section>
<!--Center Align Inner Content Section End-->

<script type="text/javascript">
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