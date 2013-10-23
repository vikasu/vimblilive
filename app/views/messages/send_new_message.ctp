<?php echo $this->Html->script('tiny_mce/tiny_mce'); ?>
<?php //pr($sponsorList['User']['name']); die; ?>
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

.content-pane{ width: 1025px !important;}
.signuplogin_new .basic-details .textarea, .signuplogin_new .textbox span { width: 100% !important;}
</style>

<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
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
			<?php echo $this->Form->create('Message', array('url'=>array('controller' => 'messages','action' => 'send_new_message'),'id'=>'sendMsgForm', 'name'=>'sendMsgForm','enctype'=>'multipart/form-data')); ?>
                        <?php //check if email is given to send a message
			if(isset($msgToemail) && !empty($msgToemail)) { ?>
				 <span style="padding-left:10px; margin-bottom:10px;">Message To:</span><br>
				 <input type="hidden" name="data[Message][to_user_id]" value="<?php echo $id ?>">
				 <input type="hidden" name="data[Message][msg_to]" value="connection" >
				 <div class=textbox><span><?php echo $this->Form->input('Message.email',array('disabled'=>'disabled','value'=>$msgToemail,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div>
			<?php
			} else { ?>
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
				      <input type="radio" id="connection" class="msgTo" name="data[Message][msg_to]" value="connection" style="margin-left:10px;">Connections
				      <input type="radio" id="sponsor" class="msgTo" name="data[Message][msg_to]" value="sponsor" style="margin-left:10px;">Sponsors
				      <input type="radio" id="groupmanager" class="msgTo" name="data[Message][msg_to]" value="groupmanager" style="margin-left:10px;">Group Manager
				      </li>
				      
				      <li class="individual listing" style="margin-top:10px; display:block;"><div style="border:1px solid #ccc; overflow-y:scroll; height:120px; width: 600px; margin: 0 0 15px 5px; border-radius:4px;">
						<span style="float:left; width:95%; padding:5px; background:#eee; text-align:center;">Select Users</span>
						<?php
						  if(!empty($allUsers)){
						       foreach($allUsers as $key=>$val): ?>
						           <span style="float:left; width:95%; padding:5px;"><input type="checkbox" name="data[User][user_id][]" value="<?php echo $key; ?>" style="margin:0 3px 0 0;"><?php echo $val; ?></span>
						       <?php
						       endforeach;
						  } else {
						       echo '--------------- No user available ---------------';
						  }?>
						  </div>
					</li>
				      
					<li class="connection listing" style="margin-top:10px; display:none;"><div style="border:1px solid #ccc; overflow-y:scroll; height:120px; width: 600px; margin: 0 0 15px 5px; border-radius:4px;">
						<span style="float:left; width:95%; padding:5px; background:#eee; text-align:center;">Select Connections</span>
						
						<?php
						  
						  
						  //pr($conList);
						  //die;
						  if(!empty($conList)){
						       foreach($conList as $row): 
						       
						       $contactEmail = '';
						       if(!empty($row['ConnectionEmail'])) {
                                                       
                                                        foreach($row['ConnectionEmail'] as $email):
                                                                $contactEmail = $contactEmail.$email['email'].', ';
                                                        endforeach;
                                                        $emailIds = substr($contactEmail,0,strlen($contactEmail)-2);
						       } else {
							    $emailIds = 'N/A';
						       }
						       ?>
						       
							    <span style="float:left; width:95%; padding:5px;"><input type="checkbox" name="data[Connection][con_id][]" value="<?php echo $row['Connection']['id']; ?>" style="margin:0 3px 0 0;"><?php echo $row['Connection']['name'].' ('.$emailIds.')'; ?></span>
						       <?php
						       endforeach;
						  } else {
						       echo '--------------- No Connections available ---------------';
						  }?>
						  </div>
					</li>
					
					<li class="sponsor listing" style="margin-top:10px; display:none;"><div style="border:1px solid #ccc; overflow-y:scroll; height:120px; width: 600px; margin: 0 0 15px 5px; border-radius:4px;">
						<span style="float:left; width:95%; padding:5px; background:#eee; text-align:center;">Select Sponsor</span>
						<?php
						  if(!empty($sponsorList)){
						       foreach($sponsorList as $key): //pr($key['User']);?>
								<?php if(!empty($key['User']['id'])){ ?>
							    <span style="float:left; width:95%; padding:5px;"><input type="checkbox" name="data[Sponsor][sponsor_id][]" value="<?php echo $key['User']['id']; ?>" style="margin:0 3px 0 0;"><?php echo $key['User']['name']; ?></span>
						       <?php }
						       endforeach;
						  } else {
						       echo '--------------- No Sponsors available ---------------';
						  }?>
						  </div>
					</li>
				      
				  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
                          <!--Basic Details End-->
			  <?php }
			}?>
			  
			  <!--Basic Details Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
			      <section class=bscdtl-lft>
                                  <ul>
                                      <li class="msg_subject_new"><div class=textbox><span><?php echo $this->Form->input('Message.subject',array('placeholder'=>'Subject','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
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