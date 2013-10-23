<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
<?php
     $today=($refInfo['UserReflection']['rating_today'] !=0 || $refInfo['UserReflection']['rating_today'] !="" )?$refInfo['UserReflection']['rating_today']:0;
     $tomorrow=($refInfo['UserReflection']['rating_tomorrow'] !=0 || $refInfo['UserReflection']['rating_tomorrow'] !="" )?$refInfo['UserReflection']['rating_tomorrow']:0;
     
	$ans1=($refInfo['UserReflection']['ans_1'] !=0 || $refInfo['UserReflection']['ans_1'] !="" )?$refInfo['UserReflection']['ans_1']:0;
	$ans2=($refInfo['UserReflection']['ans_2'] !=0 || $refInfo['UserReflection']['ans_2'] !="" )?$refInfo['UserReflection']['ans_2']:0;
	$ans3=($refInfo['UserReflection']['ans_3'] !=0 || $refInfo['UserReflection']['ans_3'] !="" )?$refInfo['UserReflection']['ans_3']:0;
?>

<script type="text/javascript">
jQuery(document).ready(function(){
	
	//Current machin time
	var currentTime = new Date()
	var hours = currentTime.getHours()
	var minutes = currentTime.getMinutes()

	if (minutes < 10)
	minutes = "0" + minutes

	var machineTime = hours + ":" + minutes + ":00";
	//alert(machineTime);
	jQuery("#ReflectionJDate").val(machineTime);
	
jQuery(function() {
        jQuery("#cal").datepicker({maxDate: '+0d',dateFormat: 'dd/mm/yy'});
	
});
jQuery(".open_webcam").live('click',function(event){
	event.preventDefault();
	jQuery('.webcam_table').toggle('slow');
});

	jQuery("#saveReflection").click(function(){
		var capturedUrl = jQuery("#upload_results").children('h3').html();
		jQuery("#imageTaken").attr('value',capturedUrl);
		//return false;
	});
	
	//ON THE GROUPS TO SHARE
	jQuery("#shareChk").live('click',function(){ 
			if(jQuery(this).is(":checked")){
				jQuery(".shareWith").slideDown('slow');
			}else{
				jQuery(".shareWith").slideUp('slow');
			}
		});
	//END OF ON THE GROUPS TO SHARE
	
	
        //Hiding The File name
           jQuery(".yello_close1").click(function(){
	      jQuery(".image_name").slideUp('fast');
	    });
	   
         //Hiding The Image Thumbnail
	 
	  jQuery(".yello_close2").click(function(){
	      jQuery(".image_name1").slideUp('fast');
	    });
	  
    //Auto-Suggestion for Connections
	function autoComp(){
          //Auto-Complete- Starts
          $(function() {
               //var availableTags =  [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ];
               var availableTags =  [<?php echo $autoCompleteConList; ?>];
               //alert(availableTags);
               function split( val ) {
                    return val.split( /,\s*/ );
               }
               function extractLast( term ) {
                    return split( term ).pop();
               }
               $( ".autoSuggestInput" )
                    // don't navigate away from the field on tab when selecting an item
                    .bind( "keydown", function( event ) {
                    if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "autocomplete" ).menu.active ) {
                         event.preventDefault();
                    }
                    })
                    .autocomplete({
                         minLength: 0,
                         source: function( request, response ) {
                              // delegate back to autocomplete, but extract the last term
                              //response( $.ui.autocomplete.filter(
                              //availableTags, extractLast( request.term ) ) );
                              var results = $.ui.autocomplete.filter(availableTags, extractLast( request.term ));
                              response(results.slice(0, 20));
        
                         },
                         focus: function() {
                              // prevent value inserted on focus
                              return false;
                         },
                         select: function( event, ui ) {
                              var terms = split( this.value );
                              // remove the current input
                              terms.pop();
                              // add the selected item
                              terms.push( ui.item.value );
                              //$("#MissionConnectionConnectionIds").val(ui.item.value); 
                              // add placeholder to get the comma-and-space at the end
                              terms.push( "" );
                              this.value = terms.join( ", " );
                              return false;
                         }
                    });
          });
          //Auto-Complete- Ends
     }
     
     //Run autocomplete for first time
     autoComp(); //function called for autocomplete
     
     //Auto-Suggestion for Groups
	function autoComp1(){
          //Auto-Complete- Starts
          $(function() {
               //var availableTags =  [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ];
               var availableTags =  [<?php echo $autoForGroups; ?>];
               //alert(availableTags);
               function split( val ) {
                    return val.split( /,\s*/ );
               }
               function extractLast( term ) {
                    return split( term ).pop();
               }
               $( ".autoSuggestInputGroup" )
                    // don't navigate away from the field on tab when selecting an item
                    .bind( "keydown", function( event ) {
                    if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "autocomplete" ).menu.active ) {
                         event.preventDefault();
                    }
                    })
                    .autocomplete({
                         minLength: 0,
                         source: function( request, response ) {
                              // delegate back to autocomplete, but extract the last term
                              //response( $.ui.autocomplete.filter(
                              //availableTags, extractLast( request.term ) ) );
                              var results = $.ui.autocomplete.filter(availableTags, extractLast( request.term ));
                              response(results.slice(0, 20));
        
                         },
                         focus: function() {
                              // prevent value inserted on focus
                              return false;
                         },
                         select: function( event, ui ) {
                              var terms = split( this.value );
                              // remove the current input
                              terms.pop();
                              // add the selected item
                              terms.push( ui.item.value );
                              //$("#MissionConnectionConnectionIds").val(ui.item.value); 
                              // add placeholder to get the comma-and-space at the end
                              terms.push( "" );
                              this.value = terms.join( ", " );
                              return false;
                         }
                    });
          });
          //Auto-Complete- Ends
     }
     
     //Run autocomplete for first time
     autoComp1(); //function called for autocomplete
	  
});
        
</script>
<script>
jQuery(function() {
   
   jQuery('#today_star').raty({
	scoreName: 'data[UserReflection][rating_today]',
	path:'<?php echo SITE_URL ?>img/',
	score:'<?php echo $today ?>',
	size: 28,
	starHalf: 'star-half-big.png',
	starOff: 'star-off-big.png',
	starOn: 'star-on-big.png'
	});
   jQuery('#tomorrow_star').raty({
	scoreName: 'data[UserReflection][rating_tomorrow]',
	path:'<?php echo SITE_URL ?>img/',
	score:'<?php echo $tomorrow ?>',
	size: 28,
	starHalf: 'star-half-big.png',
	starOff: 'star-off-big.png',
	starOn: 'star-on-big.png'
	});
   jQuery('#ans1').raty({
	scoreName: 'data[UserReflection][ans_1]',
	path:'<?php echo SITE_URL ?>img/',
	score:'<?php echo $ans1 ?>',
	size: 28,
	starHalf: 'star-half-big.png',
	starOff: 'star-off-big.png',
	starOn: 'star-on-big.png'
	});
   jQuery('#ans2').raty({
	scoreName: 'data[UserReflection][ans_2]',
	path:'<?php echo SITE_URL ?>img/',
	score:'<?php echo $ans2 ?>',
	size: 28,
	starHalf: 'star-half-big.png',
	starOff: 'star-off-big.png',
	starOn: 'star-on-big.png'
	});
   jQuery('#ans3').raty({
	scoreName: 'data[UserReflection][ans_3]',
	path:'<?php echo SITE_URL ?>img/',
	score:'<?php echo $ans3 ?>',
	size: 28,
	starHalf: 'star-half-big.png',
	starOff: 'star-off-big.png',
	starOn: 'star-on-big.png'
	});
   
    $(".cancel_btn").click(function(){

	$.ajax({
			url: '<?php echo SITE_URL ?>reflections/delete_image/'+<?php echo $refInfo["UserReflection"]["id"] ?>,	
			success: function(data){
			    //window.location.reload(true);
			}
		    }); 
    });
   
  
});
</script>
<style>
.basic-details .textarea {
    height: 80px;
    width: 294px;
}
li {
    list-style: none outside none;
    padding: 2px;
}
#today_star { margin-left: 7px;  width: 112px !important;}
#tomorrow_star { margin-left: 7px;  width: 187px !important;}
.textbox span input { margin: 16px 8px 0 !important;}
.calInput { background:url("../img/cal_icon.png") no-repeat 115px 2px !important; }
.noBground { background:none !important; height:auto !important; padding-left:0px;}
.noBground input { margin-left:4px !important; border:1px solid red; }
/*Css for spacing questions And Stars*/
.refQuestion { font-weight:normal !important; margin-top: 10px; margin-left: 10px;}
.starForAns { margin-bottom:0px !important;}
.reflection {padding-bottom: 25px;}
img#rating_img{ padding-left: 5px;}
/*Css for spacing questions And Stars*/
.checkbox { float:left;}
.form_default label {
    float: inherit;
    padding: 5px;
}
div.checkbox {
    padding:2px;
    width:300px;
    background:none;
    height:15px;
}
.form_default textarea {
    width: 485px;
}
.user-list {
    box-shadow: 1px 1px 3px #CCCCCC inset;
    max-height: 178px;
    max-width: 308px;
    padding: 4px 0 0 8px;
}
/*Css For Showing Thumbnail And Uploaded file Name*/
.image_name {
        /* border: 1px solid #DFDFDF; */
         border-radius: 4px 4px 4px 4px;
	 color: #6E6D52;
	 float: right;
	 font-size: 14px;
	 height: 30px;
         margin-right: 32px;
         margin-top: -30px;
         width: 197px;
	 height: 60px;
}
.image_name1 {
        /*  border: 1px solid #DFDFDF; */
         border-radius: 4px 4px 4px 4px;
         color: #6E6D52;
         float: right;
	 height: 24px;
	 margin-left: 52px;
	 margin-top: -11px;
}
.image_resize {
    
    height: 40px;
    margin-left: 70px;
    margin-top: 3px;
    width: 50px;
}
.cancel_btn{
    float: right;
    margin-right: -1px;
    margin-top: 13px;
}
.cancel_btn1 {
    float: right;
    margin-top: 4px;
}
p.img_line{
    margin-top:8px;
    margin-left:9px;
}
#today_star{
    width: 150px !important; margin-left: 7px;
}
#ans1{
     width: 150px !important; margin-left: 7px;
}
#ans2{
     width: 150px !important; margin-left: 7px;
}
#ans3{
     width: 150px !important; margin-left: 7px;
}
.cancel_btn6 {
    float: inherit;
    margin-right: -1px !important;
    margin-top: -43px !important;
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
			  <?php echo $this->Form->create('Reflection', array('controller' => 'reflections','action' => 'edit_reflection','id'=>'addConForm', 'name'=>'addConForm','enctype'=>'multipart/form-data')); ?>
                          <?php echo $this->Form->input('UserReflection.id',array('type'=>'hidden','value'=>$refInfo['UserReflection']['id'])); ?>
			  <div class="signup-hdng addcnncthdn"><h3 class=bebas>Edit<span>Reflection</span></h3></div>
                          <!--Basic Details Starts-->
                          <section class="basic-details mediadetails">
                              <!--Left Panel Starts-->
                                  <section class=bscdtl-lft>
                                              <ul>
                                                <li><div class="textbox noBground" style="position:relative;"><span class="noBground"><?php echo $this->Form->input('UserReflection.reflection_date',array('type'=>'text','placeholder'=>'Enter title here)','div'=>false,'label'=>false,'id'=>'cal', 'class' =>'calInput','error'=>false,'value'=>date('d/m/Y',strtotime($refInfo["UserReflection"]["local_reflection_date"])),'style'=>'width:130px')); ?></span></div></li>
						<?php echo $this->Form->input('j_date',array('type'=>'hidden')); ?>
						
						<li> <div id="star"></div></li>
						<div class="refQuestion" style="font-size:15px; margin-top: 10px;">How do you feel now?</div>
						<div id="today_star"></div>
						</li>
						<div class="refQuestion" style="font-size:15px; margin-top: 10px;">How do you feel about tomorrow?</div>
						<div id="tomorrow_star"></div>
						</li>
				
				<div class="refQuestion"><?php echo $refInfo['Question_1']['question']; ?></div></li>
				<div class="starForAns" id="ans1" style="margin-bottom:-19px;"></div>
				<input type="hidden" name="data[UserReflection][question_id1]" value="<?php echo $refInfo['UserReflection']['question_id1'] ?>">
				
				<div class="refQuestion"><?php echo $refInfo['Question_2']['question']; ?></div></li>
				<div class="starForAns" id="ans2" style="margin-bottom:-19px;"></div>
				<input type="hidden" name="data[UserReflection][question_id2]" value="<?php echo $refInfo['UserReflection']['question_id2'] ?>">
				
				<div class="refQuestion"><?php echo $refInfo['Question_3']['question']; ?></div></li>
				<div class="starForAns" id="ans3" style="margin-bottom:-19px;"></div>
				<input type="hidden" name="data[UserReflection][question_id3]" value="<?php echo $refInfo['UserReflection']['question_id3'] ?>">
				
				
				<li style="margin-top:35px;"><?php echo $this->Form->input('UserReflection.description',array('placeholder'=>'Write something!','type'=>'textarea','size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','error'=>false,'value'=>$refInfo['UserReflection']['description'])); ?></li>
				<br>
				<li><?php echo $form->input('UserReflection.file', array('type' => 'file', 'label' => 'Upload file', "label" => false)); ?>
				
				<!--Diplaying Image File Name-->
				 <?php if(($refInfo['UserReflection']['file_name']) != "") { ?>
				
				
				   <?php   $sam=split('[.]', $refInfo['UserReflection']['file_name']);
				    //pr($sam); die;
				   if($sam[1]=='jpeg' || $sam[1]=='png' || $sam[1]=='jpg') { ?>
					<div class="image_name">
				<a class="open_webcam" href="<?php echo SITE_URL ?>app/webroot/files/reflections/<?php echo $refInfo['UserReflection']['file_name'] ?>"><img width=60 height=60 style="padding: 0px 14px" src="<?php echo SITE_URL ?>app/webroot/files/reflections/<?php echo $refInfo['UserReflection']['file_name'] ?>" alt="" style="border:1px solid #ccc; margin-right:20px;" /></a>	<a class="yello_close1" href="javascript:void(0);">
				 <img class="cancel_btn6" id="<?php echo $refInfo['UserReflection']['file_name'] ?>" onclick ="return alert('Do you want to delete')" src="<?php echo SITE_URL ?>img/yelloclose.png" alt="cross">
				 </a>
					</div>
				   <?php  } else { ?>   
				 
				 
				<div class="image_name"> 
				 <a class="yello_close1" href="javascript:void(0);">
				 <img class="cancel_btn" src="<?php echo SITE_URL ?>img/yelloclose.png" alt="cross">
				 </a>
				 <p class="img_line">(<?php echo $refInfo['UserReflection']['file_name']; ?>)</p>
				</div>
				<?php } } ?>
				<!--Diplaying Image File Name-->
				<?php /* ?>
				<div class="inputz" style="margin:10px 0px; padding:0px !important;">
                                    <a class="open_webcam" href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_camera.png" alt="" /></a>
                                    <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_video.png" alt="" /></a>
                                    <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_link.png" alt="" /></a>
                                    <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_mike.png" alt="" /></a>
                                    <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_dox.png" alt="" /></a>
				    <!--Diplaying Image Thumbnail-->
				    <?php if(($refInfo['UserReflection']['captured_image']) != "") { ?>
				    <div class="image_name1"> 
				 <a class="yello_close2" href="javascript:void(0);">
				 <img class="cancel_btn1" src="<?php echo SITE_URL ?>img/yelloclose.png" alt="cross">
				 </a>
				 <?php echo $html->image("/app/webroot/files/cam_img/".$refInfo['UserReflection']['captured_image'],array('class' => 'image_resize')); ?> 
				</div>
				<?php } ?>
				<!--Diplaying Image File Thumbnail-->
                                </div>
                                <?php */ ?>
				</li>
			<!-- webcam image code ** Starts** -->
                              <table style="display:none;" class="webcam_table">
                              <tr>
                               <td valign=top>
                                <!-- First, include the JPEGCam JavaScript Library -->
                                <?php echo $this->Html->script('webcam'); ?>
                                <!-- Configure a few settings -->
                                <script language="JavaScript">
                                    webcam.set_api_url( '<?php echo SITE_URL; ?>jpegcam/htdocs/test.php' );
                                    webcam.set_quality( 90 ); // JPEG quality (1 - 100)
                                    webcam.set_shutter_sound( true ); // play shutter click sound
                                </script>
                                
                                <!-- Next, write the movie to the page at 320x240 -->
                                <script language="JavaScript">
                                    document.write( webcam.get_html(400, 240) );
                                </script>
                                
                                <!-- Some buttons for controlling things -->
                                <br/><form>
                                    <div class="blubtn-small"><input type=button value="Configure..." onClick="webcam.configure()"></div>
                                    &nbsp;&nbsp;
                                    <div class="blubtn-small"><input type=button value="Take Snapshot" onClick="take_snapshot()"></div>
                                </form>
                                
                                <!-- Code to handle the server response (see test.php) -->
                                <script language="JavaScript">
                                    webcam.set_hook( 'onComplete', 'my_completion_handler' );
                                    
                                    function take_snapshot() {
                                        // take snapshot and upload to server
                                        document.getElementById('upload_results').innerHTML = '<h1>Uploading...</h1>';
                                        webcam.snap();
                                    }
                                    
                                    function my_completion_handler(msg) {
                                        // extract URL out of PHP output
                                        if (msg.match(/(http\:\/\/\S+)/)) {
                                            var image_url = RegExp.$1;
                                            // show JPEG image in page
                                            document.getElementById('upload_results').innerHTML = 
                                                //'<h1>Upload Successful!</h1>' + 
                                                '<h3 style="display:none">JPEG URL: ' + image_url + '</h3>' + 
                                                '<img src="' + image_url + '">';
                                            
                                            // reset camera for another shot
                                            webcam.reset();
                                        }
                                        else alert("PHP Error: " + msg);
                                    }
                                </script>
                                
                                </td>
                                </tr>
                                <tr>
                                 <td valign=top>
                                    <div id="upload_results"></div>
                                 </td>
                                </tr>
                                </table>
                                        
					<?php echo $form->input('UserReflection.captured_image', array('type' => 'hidden','id'=>'imageTaken','value'=>'')); ?></li>
					  
                        <!-- webcam image code ** End ** -->
				<div style="clear:both;"></div>
				  <li style="margin-top: 10px; float: left; padding-left: 10px;"><label class="mediammnry"><b>Shared on: &nbsp</b>
				  <?php $prvDate = ''; $cnt = 0;
				  foreach($allShared as $row){ $cnt = $cnt+1;
				  if($row['shared_on'] != ""){
				    $shared_date = date('Y-m-d',strtotime($row['shared_on']));
				  }else{
				    $shared_date = $refInfo['UserReflection']['reflection_date'];
				    $row['shared_on'] = $refInfo['UserReflection']['reflection_date'];
				  }
				  
				    if($shared_date != $prvDate){
					echo "</br>".date('M. d, Y',strtotime($row['shared_on'])).': ';
				    }
				    echo $row['attendy_display_name'];
				    if(date('Y-m-d',strtotime($row['shared_on'])) != $prvDate && $cnt != count($allShared)){echo ', ';}
				    
				    $prvDate = date('Y-m-d',strtotime($row['shared_on']));
				  }
				 //echo $sharedConnections = isset($connectionNames) && !empty($connectionNames) ? implode(', ',$connectionNames) : '';
				  ?>
				</label>
				  <li style="margin-top: 10px; float: left; padding-left: 10px;"><label class="mediammnry"><input id="shareChk" type="checkbox" value="" style="margin-right:5px;"/>Select to share. With this option you'll send an email to the connections you select containing the words in the comment section and a link to the attachment. No ratings will be shared.</label>
                                </li>
				  
				<div style="clear:both;"></div>
				<?php /* ?>
                                <li class="shareWith" style="margin-top:10px; display:none;"><div style="border:1px solid #ccc; overflow-y:scroll; height:120px; width: 308px; margin: 0 0 15px 5px; border-radius:4px;">
					<div class="user-list">
					<?php echo $this->Form->input('UserReflection.group_id',array('selected'=>$selectedGroups, 'label'=>false,'error'=>false,'type' => 'select', 'multiple' => 'checkbox','options' => $allGroups,'empty'=>'')); ?>
					</div>
				</li>
                                <?php */ ?>  
                                
				<li class="shareWith" style="margin-top:10px; display:none; float: left; padding-left: 10px; width: 100% !important;">
				<div style="font-weight:bold;">Share with Connections</div>
				<?php
				$sharedConnections = isset($connectionNames) && !empty($connectionNames) ? implode(', ',$connectionNames) : '';
				?>
				<input type="hidden" name="data[UserReflection][already_shared]" value="<?php echo $sharedConnections; ?>">
				<div class="textbox ttletxt"><span><?php echo $form->input('UserReflection.connection_title]', array('value'=>'','type' => 'text','placeholder' => 'Start writing connection name', 'class'=>'autoSuggestInput', "label" => false)); ?></span></div>
				
				<?php /* ?>
				<div style="margin-top:10px; font-weight:bold;">Share with Groups</div>
				<?php 
				$sharedGroups = isset($groupNames) && !empty($groupNames) ? implode(', ',$groupNames) : '';
				?>
				<div class="textbox ttletxt"><span><?php echo $form->input('UserReflection.group_title]', array('value'=>$sharedGroups,'type' => 'text','placeholder' => 'Start writing connection name', 'class'=>'autoSuggestInputGroup', "label" => false)); ?></span></div>
				</li>
				<?php */ ?>
				  
				</ul>
				<div style="clear:both;"></div>	    
                              <br>
                              
                            <section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Save',array('class'=>'submit','id'=>'saveReflection', 'div'=>false,'label'=>false)); ?></div></section>
                        </section> 
                          <?php echo $this->Form->end(); ?>
                         </section> 
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
