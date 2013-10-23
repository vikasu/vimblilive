
<link rel="stylesheet" href="<?php echo SITE_URL ?>fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo SITE_URL ?>fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script>
jQuery(document).ready(function(){
     jQuery(".msgTo").click(function(){
		jQuery(".listing").hide();
		var classToShow = "."+jQuery(this).attr('id');
		jQuery(classToShow).show();
	});
     
     jQuery(".conChk").live('click',function(){ 
			if(jQuery(this).is(":checked")){
				//jQuery(this).parent().parent().children().children("input:radio").attr("checked", false);
			}else{
				jQuery(this).parent().parent().children().children("input:radio").attr("checked", false);	
			}
		});
});
</script>
<style>
.customform .select {
    float: left;
    position: relative;
    width: 100px;
    margin-top:4px;
}
.msrdtxt input { width:216px; }
.expttxt input { width:112px !important; }
.nmbrtxt input { width:28px !important;}
.datetxt input { width:141px !important; }
.milstone select { font-size:12px !important; margin: 17px 0 0 !important; }

.keydes { width: 170px !important; }
.keydates { width: 90px !important; }
.keyhrs { width: 110px !important; }
.keyranking { width: 145px !important; }
.conrow { padding:5px;}

.textbox span select {
    background: none repeat scroll 0 0 transparent;
    border: medium none;
    color: #787878;
    font-family: calibri;
    font-size: 19px;
    margin: 12px 0 0;
}
.keyperiods{ width: 108px !important;}
.keyperiods_new{ width: 70px !important;}
.spn{margin-left: 100px;	}
#popUp{padding: 10px;width: 345px;border: 1px solid #ccc;border-radius: 10px; text-align: center;margin: 10px 55px 0px 60px; white-space: 5px;}

</style>
<!--Center Align Inner Content Section Starts-->
<section class="content-pane about-pane">
     <!--Flexible WhiteBox With Shadows Starts-->
     <section class=whitebox>
         <section class=whiteboxtop>
             <section class=whiteboxtop-right></section>
         </section>
         <section class=whiteboxmid>
             <section class=whiteboxmid-right>
                  <!--All Your Content Goes Here-->
                  <section class=aboutpane-inner>
                       <!--Heading Goes Here-->
                       <a href='#'><h3 class="hwdtwrks dshbrd timeline_small_icon">My Setup & Data</h3></a>
                       
                       <!--Right Panel Starts-->
                           <section class="dshbrd-right dshbrd-right-new">
                               <!--Current Reflection Section Starts-->
			       
                               <section class="current-mission manggrpdsbrd">
				   <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                                    <?php echo $this->Form->create('Mission', array('url'=>array('controller' => 'missions','action' => 'edit_shared_mission',base64_encode($this->data['Mission']['id'])),'id'=>'addMissionForm', 'name'=>'addMissionForm','enctype'=>'multipart/form-data')); ?>
                                    
                                    <!--Heading-->
                                    <h3 class=wrdspcn>Current<span>Mission</span></h3>
                                    <!--Mission Fields Starts-->
                                    <ul class="missin-flds missin-flds-new">
                                        <li class="title_date">
					     <?php //$mission_id = $recentMission['Mission']['id']?>
                                            <div class="textbox dscrtxt"><span><?php echo $form->input('Mission.title', array('type' => 'text','placeholder' => 'Title','maxlength'=>50, "label" => false)); ?></span></div>
                                            <?php echo $form->input('Mission.owner', array('value'=>$this->data["Mission"]["owner"],'type' => 'hidden', "label" => false)); ?>
					    <?php echo $form->input('Mission.draft_mission_id', array('value'=>$this->data["Mission"]["id"],'type' => 'hidden', "label" => false)); ?>
                                        
					     <div class="textbox datetxt"><span><?php echo $form->input('Mission.start_time', array('value'=>date('d/m/Y',strtotime($recentMission['Mission']['start_time'])),'type' => 'text','placeholder' => 'Start','class' =>'calInput', "label" => false,'style'=>'width:106px !important')); ?></span><a href="#"><img class="slctdate" title="Select Date" alt="" src="<?php echo SITE_URL ?>img/cal_icon.png"></a></div>
                                             <div class="textbox datetxt"><span><?php echo $form->input('Mission.end_time', array('value'=>date('d/m/Y',strtotime($recentMission['Mission']['end_time'])),'type' => 'text','placeholder' => 'End','class' =>'calInput', "label" => false,'style'=>'width:106px !important')); ?></span><a href="#"><img class="slctdate" title="Select Date" alt="" src="<?php echo SITE_URL ?>img/cal_icon.png"></a></div>
					    
					</li>
					
					<li>
                                            <div class="textbox dscrtxt"><span><?php echo $form->input('Mission.description', array('type' => 'text','placeholder' => 'Description', "label" => false)); ?></span></div>
                                        </li>
                                        <li>
                                            <div class="textbox dscrtxt"><span><?php echo $form->input('Mission.definition_of_success', array('type' => 'text','placeholder' => 'Definition of success', "label" => false)); ?></span></div>
                                            
					    
                                            </div></span></div>
                                            </select></div>
					    
                                        </li>
                                        
                                        
                                        <?php /* Share Mission functionality- Starts */ 
                                        if($_SESSION['Auth']['User']['user_type'] == 2) { ?>
					      <li><h3 class=wrdspcn>Share<span>With</span></h3></li>
					<li>
					     <input type="radio" id="individual" class="msgTo" name="data[Message][msg_to]" value="individual" style="margin-left:5px;">Individual User
                                             <input type="radio" id="cohort" class="msgTo" name="data[Message][msg_to]" value="cohort" style="margin-left:10px;">Cohorts
                                             <input type="radio" id="group" class="msgTo" name="data[Message][msg_to]" value="group" checked="checked" style="margin-left:10px;">Group
					</li>
				      
					<li class="individual listing" style="margin-top:10px; display:none;"><div style="border:1px solid #ccc; overflow-y:scroll; height:120px; width: 308px; margin: 0 0 15px 5px; border-radius:4px;">
						<span style="float:left; width:95%; padding:5px; background:#eee; text-align:center;">Select Users</span>
						  <?php
						  if(!empty($cohortList)){
						       foreach($allUsers as $key=>$val): ?>
						           <span style="float:left; width:95%; padding:5px;"><input type="checkbox" name="data[User][user_id][]" value="<?php echo $key; ?>" style="margin:0 3px 0 0;"><?php echo $val; ?></span>
						       <?php
						       endforeach;
						  } else {
						       echo '--------------- No user available ---------------';
						  }?>
						  </div>
					</li>
				      
					<li class="cohort listing" style="margin-top:10px; display:none;"><div style="border:1px solid #ccc; overflow-y:scroll; height:120px; width: 308px; margin: 0 0 15px 5px; border-radius:4px;">
						<span style="float:left; width:95%; padding:5px; background:#eee; text-align:center;">Select Cohorts</span>
						  <?php
						  if(!empty($cohortList)){
						       foreach($cohortList as $key=>$val): ?>
							    <span style="float:left; width:95%; padding:5px;"><input type="checkbox" name="data[Cohort][cohort_id][]" value="<?php echo $key; ?>" style="margin:0 3px 0 0;"><?php echo $val; ?></span>
						       <?php
						       endforeach;
						  } else {
						       echo '--------------- No Cohorts available ---------------';
						  }?>
						  </div>
					</li>
					
					
                                        <?php } /* Share Mission functionality- Ends */
                                        else if($_SESSION['Auth']['User']['user_type'] == 1) {?>
                                             
					      <li><h3 class=wrdspcn>Connection<span>Notes</span></h3></li>
				    <li>
                                        <div class="textbox dscrtxt"><span><?php echo $form->input('Mission.connection_notes', array('type' => 'text','placeholder' => 'Specify connection notes here', "label" => false)); ?></span></div>
                                   </li>
					     <li><h3 class=wrdspcn>Enter<span>Connections</span></h3></li>
				   
                                   <?php 
					     $no_of_con = sizeof($recentMission['MissionConnection']);
					     for($i=0; $i < $no_of_con; $i++) {
						  $con_name = isset($recentMission['MissionConnection'][$i]['Connection']['name']) ? $recentMission['MissionConnection'][$i]['Connection']['name'] : 'N/A';
						  $hours[0] = isset($recentMission['MissionConnection'][$i]['hours']) ? $recentMission['MissionConnection'][$i]['hours'] : '0';
						  $period[0] = isset($recentMission['MissionConnection'][$i]['frequency']) ? $recentMission['MissionConnection'][$i]['frequency'] : '';
                                            ?>
                                             <li>
                                                  <div class="textbox ttletxt"><span><?php echo $form->input('MissionConnection.connection_title][', array('value'=>$con_name,'type' => 'text','placeholder' => 'Start writing connection name', 'class'=>'autoSuggestInput', "label" => false)); ?></span></div>
                                                  <div class="textbox" style="float:left"><span><?php  echo $form->input('MissionConnection.hours][', array('selected'=>$hours,'type'=>'select','options'=>array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7),'empty'=>array('0'=>'None'),'value'=>'', "label" => false, 'class'=>'keyperiods')); ?></span></div>
                                                  <div class="textbox" style="float:left"><span><?php  echo $form->input('MissionConnection.period][', array('selected'=>$period,'type'=>'select','options'=>array('Once per week'=>'Once per week','Once per Month'=>'Once per Month','Twice a month'=>'Twice a month'),'value'=>'', "label" => false, 'class'=>'keyperiods')); ?></span></div>
					     <a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img class="removeRec" src='<?php echo SITE_URL ?>img/remove.png'/></a>
					     </li>
                                   <?php } ?>
                                   
                                   <div id="conClone" style="float:left;">
                                   <table><tr><td>
                                   
                                   <?php $sharedConnections = isset($connectionNames) && !empty($connectionNames) ? implode(', ',$connectionNames) : '';
				          $missionConnHours = isset($sharedWithConnectionTime) && !empty($sharedWithConnectionTime) ? $sharedWithConnectionTime['MissionConnection']['hours'] : '';
					  //pr($sharedWithConnectionTime);
					  @$missionConnPeriod[] = isset($sharedWithConnectionTime) && !empty($sharedWithConnectionTime) ? $sharedWithConnectionTime['MissionConnection']['period'] : ''; ?>
				    <li id="clone_mission_connection">
					<div class="textbox ttletxt"><span><?php echo $form->input('MissionConnection.connection_title][', array('value'=>'','type' => 'text','placeholder' => 'Start writing connection name', 'class'=>'autoSuggestInput', "label" => false)); ?></span></div>
                                        <?php echo $form->hidden('MissionConnection.connection_ids', array('type' => 'text','placeholder' => 'Start writing connection name', "label" => false)); ?>
                                        <div class="textbox" style="float:left"><span><?php  echo $form->input('MissionConnection.hours][', array('value'=>$missionConnHours,'type'=>'select','options'=>array(1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7),'empty'=>array('0'=>'None'),'value'=>'', "label" => false, 'class'=>'keyperiods')); ?></span></div>
					<div class="textbox" style="float:left"><span><?php  echo $form->input('MissionConnection.period][', array('selected'=>$missionConnPeriod,'type'=>'select','options'=>array('Weekly'=>'Weekly','Monthly'=>'Monthly','Mission'=>'Mission'),'value'=>'', "label" => false, 'class'=>'keyperiods')); ?></span></div>
				    </li>
                                    
                                   </td></tr></table>
                                   </div>
                                    
                                    <li><div id="add_con" class="blubtn-big blubtn_new" style="float: right"><input type="button" value="Add More" /></div></li>
				         
					     
                                        <?php } ?>
                                  
				    </ul>
                                    <!--Mission Fields End-->
				   
                                    <!--Key To Success Starts-->
                                    <section class="milstone">
                                         <!--Heading Starts-->
                                         <h3 class=wrdspcn>Keys<span>to Success</span></h3>
                                         <!--Listing Goes Here-->
                                         <ul class="missin-flds">
                                             <?php 
					     $no_of_k2s = sizeof($recentMission['KeyToSuccess']);
					     for($i=0; $i < $no_of_k2s; $i++) {
						  $k2s_description = isset($recentMission['KeyToSuccess'][$i]['description']) ? $recentMission['KeyToSuccess'][$i]['description'] : '';
						  $k2s_expected_hrs = isset($recentMission['KeyToSuccess'][$i]['expected_hrs']) ? $recentMission['KeyToSuccess'][$i]['expected_hrs'] : '';
						  $k2s_period_sel[] = isset($recentMission['KeyToSuccess'][$i]['period']) ? $recentMission['KeyToSuccess'][$i]['period'] : '';
						  $k2s_ranking = isset($recentMission['KeyToSuccess'][$i]['ranking']) ? $recentMission['KeyToSuccess'][$i]['ranking'] : '';
						  $k2s_start = isset($recentMission['KeyToSuccess'][$i]['start_date']) ? date('d/m/Y',strtotime($recentMission['KeyToSuccess'][$i]['start_date'])) : '';
                                                  $k2s_end = isset($recentMission['KeyToSuccess'][$i]['start_date']) ? date('d/m/Y',strtotime($recentMission['KeyToSuccess'][$i]['end_date'])) : '';
					    ?>
                                             <li>
						  <div class="textbox msrdtxt key_dscrptn"><span><?php echo $form->input('KeyToSuccess.description][', array('value'=>$k2s_description,'type' => 'text','placeholder' => 'Description', "label" => false, 'class'=>'keydes')); ?></span></div>
						  <div class="textbox datetxt"><span><?php echo $form->input('KeyToSuccess.expected_hrs][', array('value'=>$k2s_expected_hrs,'type' => 'text','placeholder' => 'Hrs','style'=>'width:30px !important;', "label" => false, 'class'=>'keyhrs')); ?></span></div>
                                                  <div class="textbox" style="float:left"><span><?php  echo $form->input('KeyToSuccess.period][', array('selected'=>$k2s_period_sel,'type'=>'select','options'=>array('0'=>'Weekly','1'=>'Monthly','2'=>'Mission'),'value'=>'', "label" => false, 'class'=>'keyperiods keyperiods_new')); ?></span></div>
                                                  <div class="textbox msrdtxt"><span><?php echo $form->input('KeyToSuccess.start_date][', array('value'=>$k2s_start,'type' => 'text','placeholder' => 'Start',"label" => false, 'class'=>'calInput keydates')); ?></span></div>
                                                  <div class="textbox msrdtxt"><span><?php echo $form->input('KeyToSuccess.end_date][', array('value'=>$k2s_end,'type' => 'text','placeholder' => 'End',"label" => false, 'class'=>'calInput keydates')); ?></span></div>
                                                  <div class="textbox expttxt"><span><?php echo $form->input('KeyToSuccess.ranking][', array('value'=>$k2s_ranking,'type' => 'text','placeholder' => 'Max 5 Keywords, separated by ","', "label" => false, 'class'=>'keyranking','style'=>'width:300px !important;')); ?></span></div>

                                            <a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img class="removeRec" src='<?php echo SITE_URL ?>img/remove.png'/></a>
					     </li>
                                             <?php } ?>
                                             <div id="keyClone" style="float:left;">
                                             <table><tr><td>
                                             <li>
                                                 <div class="textbox msrdtxt key_dscrptn"><span><?php echo $form->input('KeyToSuccess.description][', array('type' => 'text','placeholder' => 'Description',"label" => false, 'class'=>'keydes')); ?></span></div>
                                                 <div class="textbox datetxt"><span><?php echo $form->input('KeyToSuccess.expected_hrs][', array('type' => 'text','placeholder' => 'Hrs','style'=>'width:30px !important;', "label" => false, 'class'=>'keyhrs')); ?></span></div>
                                                 <div class="textbox" style="float:left"><span><?php  echo $form->input('KeyToSuccess.period][', array('type'=>'select','options'=>array('0'=>'Weekly','1'=>'Monthly'),'value'=>'', "label" => false, 'class'=>'keyperiods keyperiods_new')); ?></span></div>
                                                 <div class="textbox msrdtxt"><span><?php echo $form->input('KeyToSuccess.start_date][', array('type' => 'text','placeholder' => 'Start',"label" => false, 'class'=>'calInput keydates k2sStart', 'id'=>'sDate')); ?></span></div>
                                                 <div class="textbox msrdtxt"><span><?php echo $form->input('KeyToSuccess.end_date][', array('type' => 'text','placeholder' => 'End',"label" => false, 'class'=>'calInput keydates k2sEnd', 'id'=>'eDate')); ?></span></div>
                                                 <div class="textbox expttxt"><span><?php echo $form->input('KeyToSuccess.ranking][', array('type' => 'text','placeholder' => 'Max 5 Keywords, separated by ","', "label" => false, 'class'=>'keyranking','style'=>'width:300px !important;')); ?></span></div>
                                                
                                             </li>
                                             </td></tr></table>
                                             </div>
                                             
                                             <li><div id="add_key" class="blubtn-big blubtn_new" style="float: right;"><input type="button" value="Add More" /></div></li>
                                              <li><h3 class=wrdspcn>Mission<span>Notes</span></h3></li>
					      <li>
						  <div class="textbox dscrtxt"><span><?php echo $form->input('Mission.mission_notes', array('type' => 'text','placeholder' => 'Specify mission notes here', "label" => false,'class'=>'notes_inpt')); ?></span></div>
					     </li>
					     <div id="invite_sponsor_element">
						  <?php unset($_SESSION['sp_msz']);?>
						  <?php echo $this->Element('/dashboard/invite_sponsor');?>
					     </div>
					     <li><section class=svcnntn><div class="blubtn-big blubtn_new current_setup_btn"><?php echo $this->Form->submit('Save',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></section></li>
                                         </ul>
                                    </section>
                                    <!--Key To Success End-->
                                    
                                    <?php echo $this->Form->end(); ?>
                                    
                               </section>
                               <!--Current Reflection Section End-->
                           </section>
                           <!--Right Panel End-->
                       <!--Clear Div-->
                       <section class=clr-b></section>
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

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<?php echo $this->Html->script('jquery.ui.autocomplete.js'); ?>
<script type="text/javascript">
jQuery(document).ready(function(){
     
     //Remove cloned results in edit
     jQuery(".removeRec").click(function(){
          jQuery(this).parent().parent().remove();
     });
     
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
                              this.value = terms.join( "" );
                              return false;
                         }
                    });
          });
          //Auto-Complete- Ends
     }
     
     //Run autocomplete for first time
     autoComp(); //function called for autocomplete
     
     //Script for clone connections input
     jQuery("#add_con").click(function(){
         
          var clone = jQuery("#conClone table tr td li").last().clone();
	  //alert(jQuery("#conClone table tr td li").html()); 
          jQuery(clone).appendTo(jQuery("#conClone table tr td"));
          
          var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png'/></a>");
          
          jQuery("#conClone table tr td li").last().append(img);
          jQuery(img).click(function(){
                  jQuery(img).parent('li').remove();
          });
          
          clone.find('input[type=text]').val('');
          autoComp(); //function called for autocomplete, it will be binded with new elements
          
     });
     //End script for clone connections input
	
     jQuery(function() {
          jQuery( ".calInput" ).datepicker({dateFormat: 'dd/mm/yy'});
     });

     jQuery("#addMissionForm").validationEngine();
	
     /*   
     //Script for clone crMission section
     jQuery("#addfields").click(function(){
          var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png'/></a>");
          
          jQuery("#crMission table tr td li").last().append(img);
          jQuery(img).click(function(){
                  jQuery(img).parent('li').remove();
          });
          jQuery("#crMission table tr td li").last().find('input[type=text]').val('');
     });
     //End script for clone crMission section
     */
    
     //Script for clone milestone section
     jQuery("#add_milestone").click(function(){
          var clone = jQuery("#milestoneClone table tr td li").last().clone(); //alert(clone.toSource()); 
          jQuery(clone).appendTo(jQuery("#milestoneClone table tr td"));
          
          var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png'/></a>");
          
          jQuery("#milestoneClone table tr td li").last().append(img);
          jQuery(img).click(function(){
                  
                  jQuery(img).parent('li').remove();
                          
          });
          
          clone.find('input[type=text]').val('');
     });
     //End script for clone crMission section
     
     //Script for clone Key to success section
     jQuery("#add_key").click(function(){
	  
	  var k2sStartDate = jQuery("#MissionStartTime").val();
          var k2sEndDate = jQuery("#MissionEndTime").val();
	  
	  /**For datepicker cloning::Start**/
          jQuery('.calInput').datepicker("destroy"); 
          jQuery('.calInput').removeAttr("id");
          /**For datepicker cloning::End**/
	  
          var clone = jQuery("#keyClone table tr td li").last().clone();
	  //alert(jQuery("#keyClone table tr td li").html()); 
          jQuery(clone).appendTo(jQuery("#keyClone table tr td"));
          
          var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png'/></a>");
          
          jQuery("#keyClone table tr td li").last().append(img);
          jQuery(img).click(function(){
                  
                  jQuery(img).parent('li').remove();
		          
          });
          
          clone.find('input[type=text]').val('');
	  
	  clone.find('.k2sStart').val(k2sStartDate);
          clone.find('.k2sEnd').val(k2sEndDate);
	  
	  jQuery( ".calInput" ).datepicker({dateFormat: 'dd/mm/yy'});
	  
     });
     //End script for clone Key to success section
     
     jQuery('.k2sStart').each(function(){
	  if(jQuery(this).val() == ''){
	       jQuery(this).val(jQuery("#MissionStartTime").val());
	  }
	  //alert(jQuery(this).val());
     });
     jQuery('.k2sEnd').each(function(){
	  if(jQuery(this).val() == ''){
	       jQuery(this).val(jQuery("#MissionEndTime").val());
	  }
	  //alert(jQuery(this).val());
     });
     $(".various").fancybox({
		maxWidth	: 540,
		maxHeight	: 350,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: false,
		closeClick	: false,
		openEffect	: 'none',
		closeEffect	: 'none'
	});
     $('#ajax-btn').click(function() {
        var sEmail = $('#email').val();
	var sponsor_name = $('#sponsor_name').val();
	if (sponsor_name == '') {
	  $('.flash_error').css('display','block');
	  return false;
	}
	if ($.trim(sEmail).length == 0) {
	    $('.flash_error').css('display','block');
            return false;
        }
//        if (validateEmail(sEmail)) {
//	         return true;
//        }else {
//	     $('.flash_error').css('display','block');
//	    return false;
//        }
	
    });
     $('.add_sponsor').live('click', function(){
	  var username = $('#sponsor_name').val();
	   var userEmail = $('#email').val();
	   var id = <?php echo $_SESSION['Auth']['User']['id']; ?>;
	  //alert(userEmail);
	  $.ajax({
		    url:'<?php echo SITE_URL;?>groups/ajax_add_sponsor/'+username+'/'+userEmail,
		    success:function(data){
			      //alert(data);
			      jQuery("#invite_sponsor_element").html(data);
			      $.fancybox.close();
		    }    
	  });
     });
     
     $('.sponsordel').live('click',function(){
	  //alert('hii');
	  $(this).parent().parent('li').remove();
	  var id = $(this).attr('id');
	  $.ajax({
	       url:'<?php echo SITE_URL;?>missions/deleteSponsor/'+id,
	       success: function(data){
	       }
	  })
      });
     $('.sp_invite_radio:radio').live('click',function(){
	  var id = $(this).val();
	  $('.spn').html('Invited');
	  $('.'+id+'').html('Activated');
     }); 
     
});
</script>
