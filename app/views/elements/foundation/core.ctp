
<ul>
<li>
    <!--Sub Menu Content Starts-->
    <section class="innerexpand">
         <div id="wrapper">
          <ul class="tabs">
            <!--<li><a href="#tab1">Values</a></li>-->
            <li><a href="#tab2">Strengths</a></li>
            <!--<li><a href="#tab3">Life</a></li>-->
          </ul>
          <div class="tab_container">
            <?php ; /*
            <div id="tab1" class="tab_content"> 
              <!--Core Value Section starts -->
             <ul class="missin-flds missionview coreelemnts">
             <form id="update_core_values" action="<?php echo SITE_URL.'settings/update_core_values/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
             <?php // Core Value form starts  
              //echo $this->Form->create('', array('controller' => 'Settings','action' => 'settings/update_core_values/'.base64_encode($_SESSION['Auth']['User']['id'])));
              $first_core_value = isset($selected_core_values[0]) ? $selected_core_values[0] : '';
              $second_core_value = isset($selected_core_values[1]) ? $selected_core_values[1] : '';
              $third_core_value = isset($selected_core_values[2]) ? $selected_core_values[2] : '';
              $fourth_core_value = isset($selected_core_values[3]) ? $selected_core_values[3] : '';
              $fifth_core_value = isset($selected_core_values[4]) ? $selected_core_values[4] : '';
              $sixth_core_value = isset($selected_core_values[5]) ? $selected_core_values[5] : '';
              $seventh_core_value = isset($selected_core_values[6]) ? $selected_core_values[6] : '';
              $core_value_rating = isset($selected_core_values[7]) ? $selected_core_values[7] : '';
              $core_value_notes = isset($selected_core_values[8]) ? $selected_core_values[8] : '';
              
              ?>
             </li>
              <li> <span>My core values are important to me.  I realize my understanding of my values could change with time, but below the 7 values that I view as the most important in my decision making.</span><br><span> <a user_id="<?php echo base64_encode($_SESSION['Auth']['User']['id']); ?>" href="#" id="all_core_values" style="background:none;color: #2C8CBD; text-decoration:underline; display:inherit;"  >Need Help? </a></span>
             </li>
             <li>
                  <div class=textbox><span><?php echo $this->Form->input('CoreValue.first',array('value'=>$first_core_value,'placeholder'=>'First Core Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('CoreValue.second',array('value'=>$second_core_value,'placeholder'=>'Second Core Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('CoreValue.third',array('value'=>$third_core_value,'placeholder'=>'Third Core Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('CoreValue.fourth',array('value'=>$fourth_core_value,'placeholder'=>'Fourth Core Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('CoreValue.fifth',array('value'=>$fifth_core_value,'placeholder'=>'Fifth Core Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('CoreValue.sixth',array('value'=>$sixth_core_value,'placeholder'=>'Sixth Core Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('CoreValue.seventh',array('value'=>$seventh_core_value,'placeholder'=>'Seventh Core Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li> Level of Alignment with my current life: 
                  <span><div id="core_rating"></div> </span></li>
              
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('CoreValue.notes',array('value'=>$core_value_notes,'placeholder'=>'Specify notes here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              
              <li>
                  <div class=signuplogin-btn><?php echo $this->Form->end('Save',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
              </ul>
              <!--Core Value Section ends -->
              </div> */ ?>
            <div id="tab2" class="tab_content"> 
              <!--Strength Value Section starts -->
             <ul class="missin-flds missionview coreelemnts">
             <form id="update_strength_values" action="<?php echo SITE_URL.'settings/update_strength_values/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" enctype="multipart/form-data">
             <li>
             <?php // Core Value Section starts  */
              //echo $this->Form->create('StrengthValue', array('controller' => 'Settings','action' => 'update_strength_values/'.base64_encode($_SESSION['Auth']['User']['id'])));
              //pr($selected_strength_values);exit;
              $first_strength_value = isset($selected_strength_values[0]) ? $selected_strength_values[0] : '';
              $second_strength_value = isset($selected_strength_values[1]) ? $selected_strength_values[1] : '';
              $third_strength_value = isset($selected_strength_values[2]) ? $selected_strength_values[2] : '';
              $fourth_strength_value = isset($selected_strength_values[3]) ? $selected_strength_values[3] : '';
              $fifth_strength_value = isset($selected_strength_values[4]) ? $selected_strength_values[4] : '';
              $sixth_strength_value = isset($selected_strength_values[5]) ? $selected_strength_values[5] : '';
              $seventh_strength_value = isset($selected_strength_values[6]) ? $selected_strength_values[6] : '';
              $strength_value_rating = isset($selected_strength_values[7]) ? $selected_strength_values[7] : '';
              $strength_value_notes = isset($selected_strength_values[8]) ? $selected_strength_values[8] : '';
              ?>
             </li>
              <li>
                    <span>
                         Working with and towards your <a href="http://wp.me/P3AAlx-6W" target="_blank" style="background:none;color: #2C8CBD; text-decoration:underline; display:inherit; padding-right: 0px;"  >strengths</a> are important.<br>
                         Write down the 7 strengths that best describes you. No need to get it perfect the first time.
                         Your strengths will evolve, as will your understanding of your strengths, but start with an initial
                         list.<br>
                         Need inspiration? Start with <a user_id="<?php echo base64_encode($_SESSION['Auth']['User']['id']); ?>" href="javascript:void(0)" id="all_strength_values" style="background:none;color: #2C8CBD; text-decoration:underline; display:inherit; padding-right: 0px;"  >this list</a> based on Peterson and Seligman's book Character
                         Strengths and Virtues.
                    </span>
             </li>
             <li>
                  <div class=textbox><span><?php echo $this->Form->input('StrengthValue.1',array('placeholder'=>'First Strength Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('StrengthValue.2',array('placeholder'=>'Second Strength Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('StrengthValue.3',array('placeholder'=>'Third Strength Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('StrengthValue.4',array('placeholder'=>'Fourth Strength Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('StrengthValue.5',array('placeholder'=>'Fifth Strength Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('StrengthValue.6',array('placeholder'=>'Sixth Strength Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('StrengthValue.7',array('placeholder'=>'Seventh Strength Value','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              
              <li> Level of Alignment with my current life: 
                  <span><div id="strength_rating"></div> </span></li>
              
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('StrengthValue.notes',array('placeholder'=>'Specify notes here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              
                    <?php if(empty($this->data['StrengthValue']['attachment'])) { ?>
                    <li>
                         <div style="margin-left:7px;"><span><?php echo $form->input('StrengthValue.file', array('type' => 'file', 'label' => 'Upload file', "label" => false)); ?></span></div>
                    </li>
                    <?php } else {?>
                    <li style="background: none !important;">
                                   <div style="margin-left:7px; width:300px;float:left"><span><?php echo $form->input('StrengthValue.file', array('type' => 'file', 'label' => 'Upload file', "label" => false)); ?></span></div>
                                   <div style="width:auto; float:left ;  padding-left: 10px;"><a href="<?php echo SITE_URL?>files/strength/<?php echo $this->data['StrengthValue']['attachment']?>" target="_blank" style="background: none !important; color: #1560AC; margin-top: -6px;"><?php echo $this->data['StrengthValue']['attachment'];?></a></div>
                    </li>
                    <?php } ?>
               <li>
               <?php if(!empty($this->data['StrengthValue']['created'])) {
            $this->data['StrengthValue']['created'] = date("M d, y",strtotime($this->data['StrengthValue']['created']));
               ?>
                    <div  style=" padding-left:8px; font-family: 'ProximaNova-Regular';">Current as on:  <?php echo $this->data['StrengthValue']['created'];?></div>
               <?php } ?>
               </li>
              <li>
                    <div class="signuplogin-btn"><input type="submit" value="save" id="save"></div>
              <!--    <div class=signuplogin-btn><?php //echo $this->Form->end('Save',array('class'=>'','div'=>false,'label'=>false,'id'=>'save')); ?></div></li> -->
              </ul>
              <!--Strength Value Section ends -->
          <!-- <li><button id="save" value="button" class=signuplogin-btn></button></li>  -->
            </div>
            
            <!-- Showing Strength values History-->
             <h2 style="color: #1560AC; margin-left:10px; margin-bottom: 0px; font-weight:bold">Previous</h2>
            <?php //pr($history_strength_values); //die;
                
               unset($history_strength_values[0]);
                 //pr($history_strength_values);
               if(!empty($history_strength_values)){
                     $i = 0;
                    foreach($history_strength_values as $history){
                                 $i = $i+1;
                                  $strength_val = array($history['StrengthValue']['1'],$history['StrengthValue']['2'],$history['StrengthValue']['3'],$history['StrengthValue']['4'],$history['StrengthValue']['5'],$history['StrengthValue']['6'],$history['StrengthValue']['7']);
                                   $strength_val = array_filter($strength_val);
                                   $strength = implode(', ',$strength_val);
                                   if(empty($history['StrengthValue']['notes'])){
                                           $history['StrengthValue']['notes'] = "No Notes";
                                   }
                                   if(!empty($history['StrengthValue']['created'])){
                                       $history['StrengthValue']['created'] = date("M d, y",strtotime($history['StrengthValue']['created'])); 
                                   }
                                   if(empty($strength_val)){
                                       $strength = "No Strengths Defined"; 
                                   }
                                   
                                   ?>
                               
                               <script>
                                   //display rating  for strength values   
                                   jQuery(function() {
                                         var refId = <?php echo $i ?>;
					var starDivId = '#'+refId; 
                                        $(starDivId).raty({
                                          cancel    : false,
                                          readOnly  : true,
                                          cancelOff : 'cancel-off.png',
                                          cancelOn  : 'cancel-on.png',
                                          half      : false,
                                          size      : 24,
                                          starHalf  : 'star-half.png',
                                          starOff   : 'star-off.png',
                                          starOn    : 'star-on.png',
                                          number    :  3,
                                          rating_id : '1',
                                          scoreName: '',
                                          score : '<?php echo $history["StrengthValue"]["rating"] ;?>',
                                          path : '<?php echo SITE_URL; ?>/img'
                                        });
                                   });
                              </script>
                               
                               
                                <div style="border:1px solid #ccc; padding:10px;margin:10px; background: #EFEFEF">
                                   <div style="font-family: 'Bebas';  color: #1560AC;"><span><?php echo $history['StrengthValue']['created'];?></span><span style="float:right;margin-top: -15px; line-height: 10px;"><a href="<?php echo SITE_URL ?>settings/delete_strength/<?php echo base64_encode($history['StrengthValue']['id']);?>" style="background: none !important;color: #1560AC; width: 20px; padding-right: 0px;"><img src="<?php echo SITE_URL?>img/remove.png" style=" height:20px !important; padding-top: 7px;"/></a></span></div>
                                   <div style="padding-bottom: 3px;"><?php echo $strength;?></div>
                                   <div style="padding-bottom: 3px;"><?php echo $history['StrengthValue']['notes'];?></div>
                                   <div style="padding-bottom: 3px;">Career Alignment:<span style="padding:10px;" id="<?php echo $i ;?>"></span></div>
                                             <?php  if(empty($history['StrengthValue']['attachment'])){ ?>
                                   <div style="padding-bottom: 3px;"><span style="font-family: 'arial';  color: #1560AC;">No Attachment</span></div>
                                             <?php  } else { ?>
                                   <div style="padding-bottom: 3px;"><span style="font-family: 'arial';  color: #1560AC;"><a href="<?php echo SITE_URL?>files/strength/<?php echo $history['StrengthValue']['attachment'];?>" style="background: none !important;color: #1560AC; width: 200px;line-height: 2px;"><?php echo $history['StrengthValue']['attachment'];?></a></span></div>
                                             <?php } ?>  
                              </div>
                              <?php //return $history['StrengthValue']['rating'] ;?>
             <?php  } ?>      
        <?php } else { ?>
                               <div style="   background: none repeat scroll 0 0 #CCCCCC; color: black;margin: 10px;text-align: center;">No Strengths Selected Previously</div>
        <?php } ?>
               
            
            <?php /*
            <div id="tab3" class="tab_content">
              <!--Life Value Section - Starts -->
            <ul class="lifelists">
              <form id="update_life_values" action="<?php echo SITE_URL.'settings/update_life_values/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" >
             <?php //pr($selectedLifeValues); exit;
             // show selected checkboxes for Edit mode  
              $liveValueNotes = isset($selectedLifeValuesDetails[0]['LifeValueDetail']['notes']) ? $selectedLifeValuesDetails[0]['LifeValueDetail']['notes'] : '';
              $checkHomeFamily = $checkHomeFamilyCurrent = $checkHomeFamilyMonthly = '';
              $checkPartner = $checkPartnerCurrent = $checkPartnerMonthly = '';
              $checkHealth = $checkHealthCurrent = $checkHealthMonthly = '';
              $checkPersonalGrowth = $checkPersonalGrowthCurrent = $checkPersonalGrowthMonthly = '';
              $checkCareer = $checkCareerCurrent =$checkCareerMonthly = '';
              $checkFinances = $checkFinancesCurrent =$checkFinancesMonthly ='';
              $checkRelationships = $checkRelationshipsCurrent = $checkRelationshipsMonthly ='';
              $checkCommunity = $checkCommunityCurrent = $checkCommunityMonthly = '';
              $checkFun = $checkFunCurrent = $checkFunMonthly = '';
              $checkFaithSpiturality = $checkFaithSpituralityCurrent = $checkFaithSpituralityMonthly = '';
              
              for($i=0; $i<sizeof($selectedLifeValues); $i++) {
                  switch($selectedLifeValues[$i]['LifeValue']['life_value_title']) {
                      case('Home/Family'):
                          $checkHomeFamily = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkHomeFamilyCurrent = 'checked';
                          else
                              $checkHomeFamilyMonthly = 'checked';
                          break;
                      case('Partner'):
                          $checkPartner = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkPartnerCurrent = 'checked';
                          else
                              $checkPartnerMonthly = 'checked';
                          break;
                      case('Health'):
                          $checkHealth = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkHealthCurrent = 'checked';
                          else
                              $checkHealthMonthly = 'checked';
                          break;
                      case('Personal Growth'):
                          $checkPersonalGrowth = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkPersonalGrowthCurrent = 'checked';
                          else
                              $checkPersonalGrowthMonthly = 'checked';
                          break;
                      case('Career'):
                          $checkCareer = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkCareerCurrent = 'checked';
                          else
                              $checkCareerMonthly = 'checked';
                          break;
                      case('Finances'):
                          $checkFinances = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkFinancesCurrent = 'checked';
                          else
                              $checkFinancesMonthly = 'checked';
                          break;
                      case('Relationships'):
                          $checkRelationships = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkRelationshipsCurrent = 'checked';
                          else
                              $checkRelationshipsMonthly = 'checked';
                          break;
                      case('Community'):
                          $checkCommunity = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkCommunityCurrent = 'checked';
                          else
                              $checkCommunityMonthly = 'checked';
                          break;
                      case('Fun'):
                          $checkFun = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkFunCurrent = 'checked';
                          else
                              $checkFunMonthly = 'checked';
                          break;
                      case('Faith/Spiturality'):
                          $checkFaithSpiturality = 'checked';
                          if($selectedLifeValues[$i]['LifeValue']['time_duration'] ==1)
                              $checkFaithSpituralityCurrent = 'checked';
                          else
                              $checkFaithSpituralityMonthly = 'checked';
                          break;
                 
                  }
                  //echo $checkHomeFamilyCurrent; exit;
                  //$home_family_value = $selectedLifeValues[$i]['LifeValue']['life_value_title'] == 'Home/Family' ? 'checked' : '';
                  //$home_family_value
              }
             ?>
              <li><?php echo $this->Form->checkbox('LifeValue.Home/Family',array('checked'=>$checkHomeFamily,'value'=>'Home/Family','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Home/Family</label>
                  <?php echo $this->Form->checkbox('Home/Family.current',array('checked'=>$checkHomeFamilyCurrent,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Home/Family.monthly',array('checked'=>$checkHomeFamilyMonthly,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              <li><?php echo $this->Form->checkbox('LifeValue.Partner',array('checked'=>$checkPartner,'value'=>'Partner','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Partner</label>
                  <?php echo $this->Form->checkbox('Partner.current',array('checked'=>$checkPartnerCurrent,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Partner.monthly',array('checked'=>$checkPartnerMonthly,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              <li><?php echo $this->Form->checkbox('LifeValue.Health',array('checked'=>$checkHealth,'value'=>'Health','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Health</label>
                  <?php echo $this->Form->checkbox('Health.current',array('checked'=>$checkHealthCurrent, 'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Health.monthly',array('checked'=>$checkHealthMonthly, 'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              <li><?php echo $this->Form->checkbox('LifeValue.Personal Growth',array('checked'=>$checkPersonalGrowth,'value'=>'Personal Growth','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Personal Growth</label>
                  <?php echo $this->Form->checkbox('Personal Growth.current',array('checked'=>$checkPersonalGrowthCurrent,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Personal Growth.monthly',array('checked'=>$checkPersonalGrowthMonthly,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              <li><?php echo $this->Form->checkbox('LifeValue.Career',array('checked'=>$checkCareer,'value'=>'Career','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Career</label>
                  <?php echo $this->Form->checkbox('Career.current',array('checked'=>$checkCareerCurrent,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Career.monthly',array('checked'=>$checkCareerMonthly,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              <li><?php echo $this->Form->checkbox('LifeValue.Finances',array('checked'=>$checkFinances,'value'=>'Finances','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Finances</label>
                  <?php echo $this->Form->checkbox('Finances.current',array('checked'=>$checkFinancesCurrent,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Finances.monthly',array('checked'=>$checkFinancesMonthly,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              <li><?php echo $this->Form->checkbox('LifeValue.Relationships',array('checked'=>$checkRelationships,'value'=>'Relationships','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Relationships</label>
                  <?php echo $this->Form->checkbox('Relationships.current',array('checked'=>$checkRelationshipsCurrent,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Relationships.monthly',array('checked'=>$checkRelationshipsMonthly,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              <li><?php echo $this->Form->checkbox('LifeValue.Community',array('checked'=>$checkCommunity,'value'=>'Community','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Community</label>
                  <?php echo $this->Form->checkbox('Community.current',array('checked'=>$checkCommunityCurrent,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Community.monthly',array('checked'=>$checkCommunityMonthly,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              <li><?php echo $this->Form->checkbox('LifeValue.Fun',array('checked'=>$checkFun,'value'=>'Fun','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Fun</label>
                  <?php echo $this->Form->checkbox('Fun.current',array('checked'=>$checkFunCurrent,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Fun.monthly',array('checked'=>$checkFunMonthly,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              <li><?php echo $this->Form->checkbox('LifeValue.Faith/Spiturality',array('checked'=>$checkFaithSpiturality,'value'=>'Faith/Spiturality','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <label>Faith/Spiturality</label>
                  <?php echo $this->Form->checkbox('Faith/Spiturality.current',array('checked'=>$checkFaithSpituralityCurrent,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                  <?php echo $this->Form->checkbox('Faith/Spiturality.monthly',array('checked'=>$checkFaithSpituralityMonthly,'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
              </li>
              
              <li> Level of Alignment with my current life: 
                  <span><div id="life_rating"></div> </span></li>
              
              <li>
                  <div class=textbox><span><?php echo $this->Form->input('LifeValue.notes',array('value'=>$liveValueNotes,'placeholder'=>'Specify notes here','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
              
              <li>
                  <div class=signuplogin-btn><?php echo $this->Form->end('Save',array('class'=>'','div'=>false,'label'=>false)); ?></div></li>
              
              
            </ul>
            <!--Life Value Section - Ends -->
            </div>
          </div> */ ?>
        </div>
    </section>
    <!--Sub Menu Content End-->
    </li>
</ul>
<style>
     #strength_rating{width: 120px !important}
</style>
