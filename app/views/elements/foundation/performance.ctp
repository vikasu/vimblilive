<ul>
     <li>
         <!--Sub Menu Content Starts-->
         <section class="innerexpand">
               <div id="wrapper">
                   <ul class="perf_tabs">
                     <li><a href="#perf_tab3">Activities</a></li>
                     <li><a href="#perf_tab4">Communication</a></li>
                    <li><a href="#perf_tab5">Rating&nbspWeights</a></li>
                   </ul>
                   <div class="perf_tab_container">
                    <div id="perf_tab3" class="perf_tab_content"> 
                         <!--Activities listing - Starts-->
                         <ul class="missin-flds missionview cnnctnslist dlyrmndr">
                                    <!-- Schedule Balance-Starts-->
                                   <li>
                                       <h3 class=wrdspcn>SCHEDULE<span>BALANCE</span></h3>
                                       <ul>
                                        
                                        <?php //pr($selectedDayArr);
                                             $mon_check = in_array('Monday',array_keys($selectedDayArr)) ? 'checked' : '';
                                             $tue_check = in_array('Tuesday',array_keys($selectedDayArr)) ? 'checked' : '';
                                             $wed_check = in_array('Wednesday',array_keys($selectedDayArr)) ? 'checked' : '';
                                             $thu_check = in_array('Thursday',array_keys($selectedDayArr)) ? 'checked' : '';
                                             $fri_check = in_array('Friday',array_keys($selectedDayArr)) ? 'checked' : '';
                                             $sat_check = in_array('Saturday',array_keys($selectedDayArr)) ? 'checked' : '';
                                             $sun_check = in_array('Sunday',array_keys($selectedDayArr)) ? 'checked' : '';
                                        ?>
                                        
                                          <form id="schedule_balance" action="<?php echo SITE_URL.'settings/update_schedule_balance/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
                                          <?php /* Core Value form starts  */
                                          $placeholder = 'HH:MM:SS'; ?>
                                          </li>
                                           <li> <span>Work Hours:</span>
                                          </li>
                                          <li><?php echo $this->Form->checkbox('ScheduleBalance.Monday',array('value'=>'Monday','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false, 'checked'=>$mon_check)); ?>
                                               <label>Monday</label>
                                               <?php echo $this->Form->input('Monday.start',array('value'=>date('H:i',strtotime(@$selectedDayArr['Monday']['start'])),'placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                               <?php echo $this->Form->input('Monday.end',array('value'=>date('H:i',strtotime(@$selectedDayArr['Monday']['end'])),'placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                           </li>
                                           <li><?php echo $this->Form->checkbox('ScheduleBalance.Tuesday',array('value'=>'Tuesday','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false, 'checked'=>$tue_check)); ?>
                                               <label>Tuesday</label>
                                               <?php echo $this->Form->input('Tuesday.start',array('value'=>(@$selectedDayArr['Tuesday']['start'] != "")?date('H:i',strtotime(@$selectedDayArr['Tuesday']['start'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                               <?php echo $this->Form->input('Tuesday.end',array('value'=>(@$selectedDayArr['Tuesday']['end'] != "")?date('H:i',strtotime(@$selectedDayArr['Tuesday']['end'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                           </li>
                                           <li><?php echo $this->Form->checkbox('ScheduleBalance.Wednesday',array('value'=>'Wednesday','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false, 'checked'=>$wed_check)); ?>
                                               <label>Wednesday</label>
                                               <?php echo $this->Form->input('Wednesday.start',array('value'=>(@$selectedDayArr['Wednesday']['start'] != "")?date('H:i',strtotime(@$selectedDayArr['Wednesday']['start'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                               <?php echo $this->Form->input('Wednesday.end',array('value'=>(@$selectedDayArr['Wednesday']['end'] != "")?date('H:i',strtotime(@$selectedDayArr['Wednesday']['end'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                           </li>
                                           <li><?php echo $this->Form->checkbox('ScheduleBalance.Thursday',array('value'=>'Thursday','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false, 'checked'=>$thu_check)); ?>
                                               <label>Thursday</label>
                                               <?php echo $this->Form->input('Thursday.start',array('value'=>(@$selectedDayArr['Thursday']['start'] != "")?date('H:i',strtotime(@$selectedDayArr['Thursday']['start'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                               <?php echo $this->Form->input('Thursday.end',array('value'=>(@$selectedDayArr['Thursday']['end'] != "")?date('H:i',strtotime(@$selectedDayArr['Thursday']['end'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                           </li>
                                           <li><?php echo $this->Form->checkbox('ScheduleBalance.Friday',array('value'=>'Friday','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false, 'checked'=>$fri_check)); ?>
                                               <label>Friday</label>
                                               <?php echo $this->Form->input('Friday.start',array('value'=>(@$selectedDayArr['Friday']['start'] != "")?date('H:i',strtotime(@$selectedDayArr['Friday']['start'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                               <?php echo $this->Form->input('Friday.end',array('value'=>(@$selectedDayArr['Friday']['end'] != "")?date('H:i',strtotime(@$selectedDayArr['Friday']['end'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                           </li>
                                           <li><?php echo $this->Form->checkbox('ScheduleBalance.Saturday',array('value'=>'Saturday','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false, 'checked'=>$sat_check)); ?>
                                               <label>Saturday</label>
                                               <?php echo $this->Form->input('Saturday.start',array('value'=>(@$selectedDayArr['Saturday']['start'] != "")?date('H:i',strtotime(@$selectedDayArr['Saturday']['start'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                               <?php echo $this->Form->input('Saturday.end',array('value'=>(@$selectedDayArr['Saturday']['end'] != "")?date('H:i',strtotime(@$selectedDayArr['Saturday']['end'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                           </li>
                                           <li><?php echo $this->Form->checkbox('ScheduleBalance.Sunday',array('value'=>'Sunday','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false, 'checked'=>$sun_check)); ?>
                                               <label>Sunday</label>
                                               <?php echo $this->Form->input('Sunday.start',array('value'=>(@$selectedDayArr['Sunday']['start'] != "")?date('H:i',strtotime(@$selectedDayArr['Sunday']['start'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                               <?php echo $this->Form->input('Sunday.end',array('value'=>(@$selectedDayArr['Sunday']['end'] != "")?date('H:i',strtotime(@$selectedDayArr['Sunday']['end'])):'','placeholder'=>$placeholder,'div'=>false,'label'=>false,'class' =>'validate[required] sc_balance','error'=>false)); ?>
                                           </li>
                                           
                                           <div style="float: left; width: 100%; margin: 15px 0;">
                                             <div style="border: 2px solid #CCCCCC; float: left; width: 90%; padding: 10px; margin-left:22px;">
                                                  <span style="float: left; width: 60%;">
                                                       Exclude calendar entries containing the following keywords from the Scheduled calculation
                                                  </span>
                                                  <span style="float: left; width: 35%; padding-top: 5px;">
                                                       <input type="text" name="data[User][exclude_keywords]" value="<?php echo @$userInfo['User']['exclude_keywords'] ?>">
                                                  </span>
                                             </div>
                                           </div>
                                           
                                           <li>
                                               <div class=signuplogin-btn><?php echo $this->Form->end('Save',array('class'=>'','div'=>false,'label'=>false)); ?></div>
                                           </li>
                                    </ul>
                                   </li>
                              <!-- Schedule Balance-Ends-->
                         </ul>
                         <!-- Activities listing - Ends -->
                    </div>
                    
                    <div id="perf_tab5" class="perf_tab_content"> 
                         <!--Activities listing - Starts-->
                         <ul class="missin-flds missionview cnnctnslist dlyrmndr">
                                    <!-- Schedule Balance-Starts-->
                                   <li>
                                       <h3 class=wrdspcn>Rating<span>Weights</span></h3>
                                       <div style="margin-left: 40px;">Control the value used to calculate the rating when you select "All" in your dashboard
                                        </div><br/>
                                       <ul>
                                        <form id="schedule_balance" action="<?php echo SITE_URL.'settings/manage_rating_weightage/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
                                          </li>
                                      
                                      <?php
                                             $reflection = $user_weightage['RatingWeightage']['reflection_weightage'];
                                             $allActivities = $user_weightage['RatingWeightage']['allActivity_weightage'];
                                             if($reflection == '' && $allActivities == '') {
                                      ?>
                                      
                                        <li>
                                              <label style="margin-left: 40px;width: 110px;">Reflection</label>
                                               <?php echo $this->Form->input('RatingWeightage.reflection_weightage',array('value'=>60,'autocomplete'=>'off','div'=>false,'label'=>false,'class' =>'rating_weight','error'=>false,'id'=>'reflection_weightage','style'=>'width:40px !important')); ?><span> %</span>
                                           </li>
                                        <li>
                                              <label style="margin-left: 40px;width: 110px;">Other Activities</label>
                                           <?php echo $this->Form->input('RatingWeightage.allActivity_weightage',array('value'=>40,'autocomplete'=>false,'div'=>false,'label'=>false,'class' =>'rating_weight','error'=>false,'id'=>'allActivity_weightage','style'=>'width:40px !important')); ?><span> %</span>
                                        </li>
                                      <?php } else { ?>
                                             <li>
                                              <label style="margin-left: 40px;width: 110px;">Reflection</label>
                                               <?php echo $this->Form->input('RatingWeightage.reflection_weightage',array('value'=>$reflection,'autocomplete'=>'off','div'=>false,'label'=>false,'class' =>'rating_weight','error'=>false,'id'=>'reflection_weightage','style'=>'width:40px !important')); ?><span> %</span>
                                           </li>
                                        <li>
                                              <label style="margin-left: 40px;width: 110px;">Other Activities</label>
                                           <?php echo $this->Form->input('RatingWeightage.allActivity_weightage',array('value'=>$allActivities,'autocomplete'=>false,'div'=>false,'label'=>false,'class' =>'rating_weight','error'=>false,'id'=>'allActivity_weightage','style'=>'width:40px !important')); ?><span> %</span>
                                        </li>
                                      <?php } ?>
                                          
                                        <li>
                                             <?php echo $this->Form->input('RatingWeightage.user_id',array('type'=>'hidden','value'=>$_SESSION['Auth']['User']['id'])); ?>
                                        </li>
                                        <li>
                                               <div class=signuplogin-btn><?php echo $this->Form->end('Save',array('class'=>'','div'=>false,'label'=>false)); ?></div>
                                        </li>
                                    </ul>
                                   </li>
                              <!-- Schedule Balance-Ends-->
                         </ul>
                         <!-- Activities listing - Ends -->
                    </div>
                   
                    <div id="perf_tab4" class="perf_tab_content"> 
                       <!--Content--> 
                         <ul class="missin-flds missionview cnnctnslist dlyrmndr">
                              <?php //pr($user_communication); exit;
                              $communication_id = isset($user_communication['Communication']['id']) ? $user_communication['Communication']['id'] : '';
                              
                              $monday_check = $user_communication['Communication']['monday'] != 0 ? 'checked' : '';
                              $tuesday_check = $user_communication['Communication']['tuesday'] != 0 ? 'checked' : '';
                              $wednesday_check = $user_communication['Communication']['wednesday'] != 0 ? 'checked' : '';
                              $thursday_check = $user_communication['Communication']['thursday'] != 0 ? 'checked' : '';
                              $friday_check = $user_communication['Communication']['friday'] != 0 ? 'checked' : '';
                              $saturday_check = $user_communication['Communication']['saturday'] != 0 ? 'checked' : '';
                              $sunday_check = $user_communication['Communication']['sunday'] != 0 ? 'checked' : '';
                              
                              $weekly_day [] = isset($user_communication['Communication']['weekly_day'])  ? $user_communication['Communication']['weekly_day'] : '';
                              $weekly_time= isset($user_communication['Communication']['weekly_time']) != '' ? $user_communication['Communication']['weekly_time'] : '';
                              
                              $monthly_week[]  =isset($user_communication['Communication']['weekly_day']) ? $user_communication['Communication']['weekly_day'] : '';
                              $monthly_time= isset($user_communication['Communication']['monthly_time']) ? $user_communication['Communication']['monthly_time'] : '';
                             
                              ?>
                              <form id="activity_performance" action="<?php echo SITE_URL.'settings/update_communication/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
                              <li>
                                   <h3 class=wrdspcn>Daily Reminder
                                        <span class="span_in_heading">
                                             <?php if($user_communication['Communication']['id'] != ""){ ?>
                                                  <input type="radio" <?php if($user_communication['Communication']['daily_reminder']==1){ ?>checked="checked"<?php } ?> name="data[Communication][daily_reminder]" value="1">Yes
                                                  <input type="radio" <?php if($user_communication['Communication']['daily_reminder']==0){ ?>checked="checked"<?php } ?> name="data[Communication][daily_reminder]" value="0">No
                                             <?php } else {?>
                                                  <input type="radio" checked="checked" name="data[Communication][daily_reminder]" value="1">Yes
                                                  <input type="radio" name="data[Communication][daily_reminder]" value="0">No
                                             <?php } ?>
                                        </span>
                                   </h3>
                              </li>
                           
                              <li><?php echo $this->Form->hidden('Communication.id',array('value'=>$communication_id,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false));
                              echo $this->Form->checkbox('Communication.monday',array('checked'=>$monday_check,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?><label>Monday</label>
                              <?php  //echo $this->Form->text('Monday.monday_time',array('value'=>$monday_time,'style'=>'border: 1px solid #ccc;height:20px; width:80px','placeholder'=>'Time','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>   
                              <li><?php echo $this->Form->checkbox('Communication.tuesday',array('checked'=>$tuesday_check,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?><label>Tuesday</label>
                              <?php  //echo $this->Form->text('Tuesday.tuesday_time',array('value'=>$tuesday_time,'style'=>'border: 1px solid #ccc;height:20px; width:80px','placeholder'=>'Time','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>   
                              <li><?php echo $this->Form->checkbox('Communication.wednesday',array('checked'=>$wednesday_check,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?><label>Wednesday</label>
                              <?php  //echo $this->Form->text('Wednesday.wednesday_time',array('value'=>$wednesday_time,'style'=>'border: 1px solid #ccc;height:20px; width:80px','placeholder'=>'Time','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>   
                              <li><?php echo $this->Form->checkbox('Communication.thursday',array('checked'=>$thursday_check,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?><label>Thursday</label>
                              <?php  //echo $this->Form->text('Thuresday.thursday_time',array('value'=>$thursday_time,'style'=>'border: 1px solid #ccc;height:20px; width:80px','placeholder'=>'Time','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>   
                              <li><?php echo $this->Form->checkbox('Communication.friday',array('checked'=>$friday_check,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?><label>Friday</label>
                              <?php  //echo $this->Form->text('Friday.friday_time',array('value'=>$friday_time,'style'=>'border: 1px solid #ccc;height:20px; width:80px','placeholder'=>'Time','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>   
                              <li><?php echo $this->Form->checkbox('Communication.saturday',array('checked'=>$saturday_check,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?><label>Saturday</label>
                              <?php  //echo $this->Form->text('Saturday.saturday_time',array('value'=>$saturday_time,'style'=>'border: 1px solid #ccc;height:20px; width:80px','placeholder'=>'Time','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>   
                               <li><?php echo $this->Form->checkbox('Communication.sunday',array('checked'=>$sunday_check,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?><label>Sunday</label>
                              <?php  //echo $this->Form->text('Sunday.sunday_time',array('value'=>$sunday_time,'style'=>'border: 1px solid #ccc;height:20px; width:80px','placeholder'=>'Time','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>   
                              
          
                              
                               <li>
                                   <h3 class=wrdspcn>Weekly Reminder
                                        <span class="span_in_heading">
                                        <?php if($user_communication['Communication']['id'] != ""){ ?>
                                             <input type="radio" <?php if($user_communication['Communication']['weekly_reminder']==1){ ?>checked="checked"<?php } ?> name="data[Communication][weekly_reminder]" value="1">Yes
                                             <input type="radio" <?php if($user_communication['Communication']['weekly_reminder']==0){ ?>checked="checked"<?php } ?> name="data[Communication][weekly_reminder]" value="0">No
                                        <?php } else {?>
                                             <input type="radio" name="data[Communication][weekly_reminder]" value="1">Yes
                                             <input type="radio" checked="checked" name="data[Communication][weekly_reminder]" value="0">No
                                        <?php } ?>
                                        </span>
                                   </h3>
                              </li>
                           
                              <li><?php echo $this->Form->input('Communication.weekly_day',array('selected'=>$weekly_day,'options'=>array('1'=>'Monday', '2'=>'Tuesday', '3'=>'Wednesday', '4'=>'Thursday', '5'=>'Friday', '6'=>'Saturday', '7'=>'Sunday'),'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                              <?php  //echo $this->Form->text('Communication.weekly_time',array('value'=>$weekly_time,'style'=>'border: 1px solid #ccc;height:20px; width:80px','placeholder'=>'Time','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>   
                              
                              </li>
                              
                               <li>
                                   <h3 class=wrdspcn>Monthly Summary
                                        <span class="span_in_heading">
                                        <?php if($user_communication['Communication']['id'] != ""){ ?>
                                             <input type="radio" <?php if($user_communication['Communication']['monthly_reminder']==1){ ?>checked="checked"<?php } ?> name="data[Communication][monthly_reminder]" value="1">Yes
                                             <input type="radio" <?php if($user_communication['Communication']['monthly_reminder']==0){ ?>checked="checked"<?php } ?> name="data[Communication][monthly_reminder]" value="0">No
                                        <?php } else {?>
                                             <input type="radio" name="data[Communication][monthly_reminder]" value="1">Yes
                                             <input type="radio" checked="checked" name="data[Communication][monthly_reminder]" value="0">No
                                        <?php } ?>
                                        </span>
                                   </h3>
                              </li>
                           
                              <li><?php //echo $this->Form->input('Communication.monthly_week',array('selected'=>$monthly_week,'options'=>array('1'=>'Last', '2'=>'First'),'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                              <?php //echo $this->Form->input('Communication.monthly_time',array('value'=>$monthly_time,'options'=>array('1'=>'Monday', '2'=>'Tuesday', '3'=>'Wednesday', '4'=>'Thuresday', '5'=>'Friday', '6'=>'Saturday', '7'=>'Sunday'),'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></li>
                             
                             
                              <li>
                                   <div class=signuplogin-btn><?php echo $this->Form->end('Save',array('class'=>'','div'=>false,'label'=>false)); ?></div>
                              </li>
                             
                         </ul>
                    
                    </div>
                   </div>
                 </div>
             
         </section>
         <!--Sub Menu Content End-->
     </li>
   </ul>
   <style>
          .rating_weight{width: 35px !important;}
   </style>