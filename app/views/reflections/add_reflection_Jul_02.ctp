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
	//jQuery( "#datepicker" ).datepicker();
	//jQuery( "#datepicker_tomorrow" ).datepicker();
	
	
});


jQuery(".open_webcam").live('click',function(event){
	event.preventDefault();
	jQuery('.webcam_table').toggle('slow');
});

	jQuery("#addConForm").validationEngine();
	
	//Script for clone
	jQuery("#Discount #edit_otherDiscount").click(function(){
	
			  if(jQuery("#Discount table tr").last().children().last().children().is('a')) {	
				var clone = jQuery("#Discount table tr").last().clone(); // clone the last <tr>
				jQuery(clone).appendTo($("#Discount table"));
				jQuery(clone).find('td a').click(function(){
				jQuery(this).parent('td').parent('tr').remove();
				});
				
			clone.find('input[type=text]').val('');
			}else{
				var clone = jQuery("#Discount table tr").last().clone();
				var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png' /></a>");
				
				jQuery(clone).find('td').first().append(img);
				jQuery(img).click(function(){
					
					jQuery(img).parent('td').parent('tr').remove();
						
				});
				jQuery(clone).appendTo(jQuery("#Discount table"));
				clone.find('input[type=text]').val('');
			}
		
	});
	//End script for clone
	
	
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
	number:3,
	size: 24,
	path:'<?php echo SITE_URL ?>img/',
	starHalf: 'star-half-big.png',
	starOff: 'star-off-big.png',
	starOn: 'star-on-big.png'
	
	});
   jQuery('#tomorrow_star').raty({
	scoreName: 'data[UserReflection][rating_tomorrow]',
	number:3,
	size: 24,
	path:'<?php echo SITE_URL ?>img/',
	starHalf: 'star-half-big.png',
	starOff: 'star-off-big.png',
	starOn: 'star-on-big.png'
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
#today_star { margin-left: 10px;  width: 112px !important;}
#tomorrow_star { margin-left: 10px; width: 187px !important; }
.starForAns{width: 189px !important; margin-bottom:0px;}
.textbox span input { margin: 16px 8px 0 !important;}
.calInput { background:url("../img/cal_icon.png") no-repeat 115px 2px !important; }
.noBground { background:none !important; height:auto !important; padding-left:0px;}
.noBground input { margin-left:4px !important; border:1px solid red; }

.refQuestion { font-weight:normal !important;  margin-left: 10px;}
.blurDiv { opacity: 0.4; }
#loaderDiv { display: none; position: absolute; top: 500px; left: 600px; 
}

</style>
<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
     
         <section class="whitebox signuplogin" style="width:720px;">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
		      <div id="loaderDiv"><img src="<?php echo SITE_URL ?>img/ajax-loader.gif"></div>
                          <!--SignUp Heading-->
			  <?php echo $this->Form->create('Reflection', array('controller' => 'reflections','action' => 'add_reflection','id'=>'addConForm', 'name'=>'addConForm','enctype'=>'multipart/form-data')); ?>
                          <div class="signup-hdng addcnncthdn"><h3 class=bebas>Add<span>Reflection</span></h3></div>
                          <!--Basic Details Starts-->
                          <section class="basic-details mediadetails">
                              <!--Left Panel Starts-->
                                  <section class=bscdtl-lft>
                                              <ul>
						<?php $today = date('Y-m-d H:i:s');
							$refDate = date('d/m/Y',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],$today)));
						?>
							<li><div class="textbox noBground" style="position:relative; margin-bottom: 10px;"><span class="noBground"><?php echo $this->Form->input('UserReflection.reflection_date',array('type'=>'text','placeholder'=>'Enter title here)','div'=>false,'label'=>false,'id'=>'cal', 'class' =>'calInput','error'=>false,'value'=>$refDate,'style'=>'width:130px')); ?></span></div></li>
							<?php echo $this->Form->input('j_date',array('type'=>'hidden')); ?>
						<li> <div id="star"></div></li>
						<li style="margin-bottom:10px;">
						<div class="refQuestion" style="font-size:15px;">How do you feel about today?</div>
						<div class="starForAns" id="today_star"></div>
						</li>
						<li style="margin-bottom:10px; margin-top:10px;">
						<div class="refQuestion" style="font-size:15px;">How do you feel about tomorrow?</div>
						<div class="starForAns" id="tomorrow_star"></div>
						</li>
				
                                
				<?php //pr($finalQuestions); exit;
				$cnt = 0;
				foreach($finalQuestions as $key=>$val): 
				$cnt = $cnt+1; ?>
				<script>
					jQuery(function() {
					   var qid = <?php echo $val['Question']['id']; ?>;
					   var starDivIds = '#'+qid; 
					   jQuery(starDivIds).raty({
						size: 24,
						path:'<?php echo SITE_URL ?>img/',
						starHalf: 'star-half-big.png',
						starOff: 'star-off-big.png',
						starOn: 'star-on-big.png',
						scoreName: 'data[UserReflection][ans_<?php echo $cnt ?>]',
						number: '<?php echo $val['Question']['rating_strength']; ?>'
						});
					});
				</script>
									
				<li style="margin-top:10px;"><div id="tomorrow_star"></div>
                                <div class="refQuestion" style="font-size:15px;"><?php echo $val['Question']['question']; ?></div></li>
				<div class="starForAns" id="<?php echo $val['Question']['id']; ?>"></div>
				<input type="hidden" name="data[UserReflection][question_id<?php echo $cnt ?>]" value="<?php echo $val['Question']['id']; ?>">
				<?php endforeach; ?>
				  
				<li style="margin-top:20px;"><?php echo $this->Form->input('UserReflection.description',array('placeholder'=>'Write something!','type'=>'textarea','size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','error'=>false)); ?></li>
				<br>
				<li><?php echo $form->input('UserReflection.file', array('type' => 'file', 'label' => 'Upload file', "label" => false)); ?>
				
				
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
					    var new_image_url=image_url.replace(/app/, "/beta/app/"); 
                                            // show JPEG image in page
                                            document.getElementById('upload_results').innerHTML = 
                                                //'<h1>Upload Successful!</h1>' + 
                                                '<h3 style="display:none">JPEG URL: ' + new_image_url + '</h3>' + 
                                                '<img src="' + new_image_url + '">';
                                            
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
				  <li style="margin-top: 10px; float: left; padding-left: 10px;"><label class="mediammnry"><input id="shareChk" type="checkbox" value="" style="margin-right:5px;"/>Select to share. With this option you'll send an email to the connections you select containing the words in the comment section and a link to the attachment. No ratings will be shared.</label>
                                </li>
				  
				<div style="clear:both;"></div>
				<?php /* ?>
				<li class="shareWith" style="margin-top:10px; display:none;"><div style="border:1px solid #ccc; overflow-y:scroll; height:120px; width: 308px; margin: 0 0 15px 5px; border-radius:4px;">
                                <span style="float:left; width:95%; padding:5px; background:#eee; text-align:center;">Select Group</span>
                                <?php foreach($allGroups as $key=>$val): ?>
                                    <span style="float:left; width:95%; padding:5px;"><input type="checkbox" name="data[UserReflection][group_id][]" value="<?php echo $key; ?>" style="margin:0 3px 0 0;"><?php echo $val; ?></span>
                                <?php endforeach; ?>
                                  </div>
                                </li>
                                <?php */ ?>
				<li class="shareWith" style="margin-top:10px; display:none; float: left; padding-left: 10px;">
				<div style="font-weight:bold;">Share with Connections</div>
				<div class="textbox ttletxt"><span><?php echo $form->input('UserReflection.connection_title]', array('value'=>'','type' => 'text','placeholder' => 'Start writing connection name', 'class'=>'autoSuggestInput', "label" => false)); ?></span></div>
				
				<?php /* ?>
				<div style="margin-top:10px; font-weight:bold;">Share with Groups</div>
				<div class="textbox ttletxt"><span><?php echo $form->input('UserReflection.group_title]', array('value'=>'','type' => 'text','placeholder' => 'Start writing connection name', 'class'=>'autoSuggestInputGroup', "label" => false)); ?></span></div>
				</li>
				<?php */ ?>
				</ul>
				<div style="clear:both;"></div>	      
                              <br>
                              
                            <section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Save',array('class'=>'custom','id'=>'saveReflection', 'div'=>false,'label'=>false)); ?></div></section>
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
<script>
	jQuery(document).ready(function(){
		  
	jQuery(".custom").click(function(){
	    jQuery(".signup-pane").addClass('blurDiv');
	    jQuery("#loaderDiv").show();
	});  
	});
</script>