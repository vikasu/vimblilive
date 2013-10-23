<?php //pr($missionDetail); die; ?>
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
                       <a href='<?php echo $html->url(array('controller'=>'users', 'action'=>'welcome')); ?>'><h3 class="hwdtwrks dshbrd">Dashboard</h3></a>
                       
                       <!--Right Panel Starts-->
                           <section class=dshbrd-right>
			      <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                               <!--Current Reflection Section Starts-->
                               <section class="current-mission manggrpdsbrd">
                                    
				   <?php echo $this->Form->create('Mission', array('url'=>array('controller' => 'missions','action' => 'update_mission'),'id'=>'addMissionForm', 'name'=>'addMissionForm','enctype'=>'multipart/form-data')); ?>
                                   <!--Heading-->
                                    <h3 class=wrdspcn>Mission<span>Detail</span></h3>
                                    <!--Mission Fields Starts-->
                                    <ul class="missin-flds missionview">
                                        <li>
                                             <label>Title:</label>
                                             <div class="for-input"><?php echo $missionDetail['Mission']['title']; ?></div>
                                        </li>
                                        <li>
                                             <label>Start:</label>
                                             <div class="for-input"><?php echo date('M-d-Y',strtotime($missionDetail['Mission']['start_time'])); ?></div>
                                        </li>
                                        <li>
                                             <label>End:</label>
                                             <div class="for-input"><?php echo date('M-d-Y',strtotime($missionDetail['Mission']['end_time'])); ?></div>
                                        </li>
                                        <li>
                                             <label>Description:</label>
                                             <div class="for-input"><?php echo $missionDetail['Mission']['description']; ?></div>
                                        </li>
                                        <li>
                                             <label>Definition of success:</label>
                                             <div class="for-input"><?php echo $missionDetail['Mission']['definition_of_success']; ?></div>
                                        </li>
                                         <li>
                                             <label>Sponsor:</label>
                                             <div class="for-input"><?php echo $missionDetail['Sponsor']['name']; ?></div>
                                        </li>
                                       </ul>
                                    <!--Mission Fields End-->
				    
				    <!--Connection frequency Starts-->
                                    <section class="milstone">
                                         <!--Heading Starts-->
                                         <h3 class=wrdspcn>Shared<span>with</span></h3>
                                         <!--Listing Goes Here-->
                                       <ul class="manag-actvty milsstnview kysccs">
                                            <li class="actvity-header odd">
                                                <section class="mng-actvty">Name</section>
                                            </li>
					    <?php //pr($missionDetail); exit;
					    foreach($missionDetail['MissionUser'] as $row){  ?>
                                            <li>
                                                <section class="mng-actvty"><?php echo $row['User']['name']; ?></section>
                                            </li> 
                                            <?php } ?>
				       </ul>
					<!--Connection Notes- Starts-->
					<h3 class=wrdspcn>Connection<span>Notes</span></h3>
					<ul class="manag-actvty milsstnview kysccs">
					     <?php //pr($missionDetail); exit;
					     if(isset($missionDetail['Mission']['connection_notes']) && !empty($missionDetail['Mission']['connection_notes'])){  ?>
						  <li>
						     <?php echo $missionDetail['Mission']['connection_notes']; ?>
						  </li> 
					     <?php } else { ?>
						  <li>
						      <section class="mng-time">Not available</section>
						  </li> 
						  
					     <?php
					      } ?>
					</ul>
					<!--Connection Notes- Ends-->
                                    </section>
                                    <!--Connection frequency End-->
				    <?php /* ?>
                                    <!--Milestones Starts-->
                                    <section class="milstone">
                                         <!--Heading Starts-->
                                         <h3>Milestones</h3>
                                         <ul class="manag-actvty milsstnview">
                                            <li class="actvity-header odd">
                                                <section class="mng-actvty">Description</section>
                                                <section class="mng-time">Measure of success:</section>
                                                <section class="mng-time">Expected hours:</section>
                                            </li>
					    <?php foreach($missionDetail['Milestone'] as $milestone){ ?>
                                            <li>
                                                <section class="mng-actvty"><?php echo $milestone['description']; ?></section>
                                                <section class="mng-time"><?php echo $milestone['success_measures']; ?></section>
                                                <section class="mng-time"><?php echo $milestone['expected_hrs']; ?></section>
                                            </li> 
                                            <?php } ?>
                                       </ul>
                                        
                                        <!--End-->
                                    </section>
                                    <!--Milestones End-->
                                    <?php */ ?>
                                    <!--Key To Success Starts-->
                                    <section class="milstone">
                                         <!--Heading Starts-->
                                         <h3 class=wrdspcn>Key<span>to Success</span></h3>
                                         <!--Listing Goes Here-->
                                       <ul class="manag-actvty milsstnview kysccs">
                                            <li class="actvity-header odd">
                                                <section class="mng-actvty" style="width:150px !important">Description</section>
                                                <section class="mng-time" style="width:80px !important">Expected hours</section>
						<section class="mng-time" style="width:80px !important">Period</section>
						<section class="mng-time" style="width:80px !important">Start</section>
						<section class="mng-time" style="width:80px !important">End</section>
						<section class="mng-time" style="width:100px !important">Keywords</section>
                                                
                                            </li>
					    <?php foreach($missionDetail['KeyToSuccess'] as $keyToSuccess){  ?>
                                            <li>
                                                <section class="mng-actvty" style="width:150px !important"><?php echo $keyToSuccess['description']; ?></section>
                                                <section class="mng-time" style="width:80px !important"><?php echo $keyToSuccess['expected_hrs']; ?></section>
                                                
					       <section class="mng-time" style="width:80px !important"><?php
					          if($keyToSuccess['period'] == 0)
						       echo 'Weekly' ;
						  elseif($keyToSuccess['period'] == 1)
						       echo 'Monthly' ;
						  elseif($keyToSuccess['period'] == 2)
						       echo 'Mission' ;
						  else
						       echo 'Unrecognized';?></section>
					       
					       <section class="mng-time" style="width:80px !important"><?php echo $keyToSuccess['start_date']; ?></section>
						<section class="mng-time" style="width:80px !important"><?php echo $keyToSuccess['end_date']; ?></section>
					       <section class="mng-time" style="width:100px !important"><?php echo $keyToSuccess['ranking']; ?></section>
					   
					    </li> 
                                            <?php } ?>
					    <br>
					    <!--Mission Notes- Starts-->
					     <h3 class=wrdspcn>Mission<span>Notes</span></h3>
					     <ul class="manag-actvty milsstnview kysccs">
						  <?php //pr($missionDetail); exit;
						  if(isset($missionDetail['Mission']['mission_notes']) && !empty($missionDetail['Mission']['mission_notes'])){  ?>
						       <li>
							  <?php echo $missionDetail['Mission']['mission_notes']; ?>
						       </li> 
						  <?php } else { ?>
						       <li>
							   <section class="mng-time">Not available</section>
						       </li> 
						       
						  <?php
						   } ?>
					     </ul>
					<!--Mission Notes- Ends-->
					
					    <?php if($missionDetail['Mission']['owner'] == $_SESSION['Auth']['User']['id']){?>
						           <section class=svcnntn><a href="<?php echo $this->Html->url(array('controller'=>'missions','action'=>'current_mission_setup', base64_encode($missionDetail['Mission']['id'])));?>"><div class="blubtn-big"><input type="button" value="Edit Mission" /></div></a></section>
						   <?php } else { ?>
					     <li><section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Submit',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></section></li>
					     <?php } ?>
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

