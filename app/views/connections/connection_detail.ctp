<?php //die(pr($conInfo)); ?>
<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
    <?php $strength=($conInfo['Connection']['strength'] !=0 ||$conInfo['Connection']['strength'] !="" )?$conInfo['Connection']['strength']:0; ?>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery(function() {
		jQuery('#strength').raty({
			scoreName: 'data[Connection][strength]',
			path:'<?php echo SITE_URL ?>img/',
			number: 3,
                        readOnly : true,
			score: <?php echo $strength ?>
		});
  	});
        
});
</script>

<style>
.mng-actns img {margin-right:0px;}
.connectall h3 { padding-left:42px; }
.milsstnview .mng-actvty {
    width: 150px;
}
.milstone {
    float: left;
    padding-top: 25px;
    width: 690px!important;
}
</style>
 <?php //pr($conInfo); die; ?>
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
                           <h3 class="hwdtwrks dshbrd">Dashboard</h3>
                          
                           <!--Right Panel Starts-->
                           <section class="dshbrd-right connectall">
                                  <!--SignUp Heading-->
                                  <div class="signup-hdng addcnncthdn"><h3 class=bebas>Connection<span>Detail</span></h3></div>
                                  <!--Basic Details Starts-->
                                  <section class="basic-details connection-detail">
                                      <!--Left Panel Starts-->
                                      <section class=bscdtl-lft>
                                          <section class=cnnctn-detil>
					  <?php //pr($conInfo); die;?>
                                          <!--     <section class=cnnctn-img>
                                                  <?php //if($conInfo['Connection']['image'] != "") { ?>
                                                       <img width=162 height=110 src="<?php //echo SITE_URL ?>files/connections/medium/<?php //echo $conInfo['Connection']['image'] ?>" alt="" /></section>
                                                  <?php //} //else {?>
                                                       <img width=162 height=110  src="<?php //echo SITE_URL ?>img/connection_img.png" alt="" /></section>
                                                  <?php // } ?>  -->
                                               <section class=cnnctn-info>
                                                   <ul>
                                                      <li><h4><?php echo $conInfo['Connection']['name']; ?></h4></li>
                                                      <li>Email: <?php
                                                        $contactEmail = '';
                                                        foreach($conInfo['ConnectionEmail'] as $email):
                                                                $contactEmail = $contactEmail.$email['email'].', ';
                                                        endforeach;
                                                        echo substr($contactEmail,0,strlen($contactEmail)-2);
                                                   ?></li>
                                                      <br>
                                                      <li>
                                                       Phone: <?php
                                                        if(!empty($conInfo['ConnectionPhone'] )) {
                                                                $contactNum = '';
                                                                foreach($conInfo['ConnectionPhone'] as $phone):
                                                                        $contactNum = $contactNum.$phone['phone'].', ';
                                                                endforeach;
                                                                echo substr($contactNum,0,strlen($contactNum)-2);
                                                        } else {
                                                                echo 'N/A';
                                                        }
                                                   ?>
                                                      </li>
                                                      <li>Address: <?php
                                                        if(!empty($conInfo['ConnectionAddress'] )) {
                                                                $contactAdd = '';
                                                                foreach($conInfo['ConnectionAddress'] as $address):
                                                                        $contactAdd = $contactAdd.$address['address'].', ';
                                                                endforeach;
                                                                echo substr($contactAdd,0,strlen($contactAdd)-2);
                                                        } else {
                                                                echo 'N/A';
                                                        }
                                                   ?></li>
                                                      
                                                      
                                                      
                                                   </ul>
                                                   
                                               </section>
                                          </section>
                                       <section class=svcnntn><i>Last Updated: <?php echo date('M. d, Y',strtotime($conInfo['Connection']['modified'])); ?></i>
                                        <?php /* ?><div class="blubtn-big" style="margin-left:230px;"><input type="button" class="submit" value="SYNC"></div> <?php */ ?>
                                       </section>
                                 
                                          <!--Notes If Any Starts-->
                                         <!-- <section class="notes">
                                               <h4>Notes</h4>
                                               <section class="notesinfo">
                                                   <p><?php //echo $conInfo['Connection']['description']; ?></p>
                                               </section>
                                          </section> -->
                                          <!--Notes If Any End-->
                                          <!--Other Info If Any Starts-->
                                          <section class="notes">
                                               <h4>Other Info</h4>
                                               <section class="notesinfo">
                                                   <p>Connection Group: <?php
						        $conGroups = '';
						       if(!empty($conInfo['ConGroupRelation'])) {
                                                       
                                                        foreach($conInfo['ConGroupRelation'] as $groups):
                                                                $conGroups = $conGroups.$groups['ConnectionGroup']['title'].', ';
                                                        endforeach;
                                                        echo substr($conGroups,0,strlen($conGroups)-2);
						       } else {
							    echo 'N/A';
						       }
                                                   ?>
                                                   </p>
                                                   <div><span>Strength: </span><span id="strength"></span></div>
						  
                                                   <div style="margin-top:5px;"><span>Touch Goal: </span>
							    <?php if(!empty($conInfo['Connection']['touch_duration']) && ($conInfo['Connection']['touch_goals']	)) { ?>
							     <span id="goal"><?php echo $conInfo['Connection']['touch_duration'].' '."(".$conInfo['Connection']['touch_goals']; ?>)</span>
							     <?php } ;?> 
						   </div>
						   <div style="margin-top:5px;">
						    Birthday: <?php
                                                        if((!empty($conInfo['Connection']['dob'])) && ($conInfo['Connection']['dob'] != "0000-00-00")) {
                                                                echo date('M. d, Y',strtotime($conInfo['Connection']['dob']));
                                                        } else {
                                                                echo 'N/A';
                                                        }
                                                   ?>
						   </div>
						   <div style="margin-top:5px;">
						    Notes: <?php
                                                        if((!empty($conInfo['Connection']['description']))) {
                                                                echo $conInfo['Connection']['description'];
                                                        } else {
                                                                echo 'N/A';
                                                        }
                                                   ?>
						   </div>
							     
                                               </section>
                                          </section>
                                          <!--Other Info If Any End-->
                                          <section class="milstone">
                                         <!--Heading Starts-->
                                         <?php if(!empty($conInfo['MissionConnection'])){ ?>
                                         <h3 style="padding-left:0px" class=wrdspcn>Mission<span>Details</span></h3>
                                         <ul class="manag-actvty milsstnview">
                                            <li class="actvity-header odd">
                                                <section class="mng-actvty">Title</section>
                                                <section class="mng-time">Mission Goal</section>
                                                <section class="mng-time">Actual Touches</section>
                                              <!--  <section class="mng-time">Notes</section> -->
                                                <section class="mng-time">End Date</section>
                                            </li>
					    <?php //pr($conInfo['MissionConnection']); 
                                            foreach($conInfo['MissionConnection'] as $missionConnection){ ?>
                                            <li>
                                                <section style="width:150px;" class="mng-actvty"><?php echo $missionConnection['Mission']['title'] != ''?  $missionConnection['Mission']['title'] : 'N/A'; ?></section>
                                                <section class="mng-time"><?php echo $targetTouch = $this->requestAction('/connections/totalTouchforConnection/'.$conInfo['Connection']['id'].'/'.$missionConnection['Mission']['id']); ?></section>
                                                <section class="mng-time"><?php echo $totalTouches = $this->requestAction('/connections/actualTouchByCon/'.$conInfo['Connection']['id'].'/'.$missionConnection['Mission']['id']); ?></section>
                                          <!--      <section class="mng-time"><?php //echo $missionConnection['Mission']['connection_notes'] != ''?  $missionConnection['Mission']['connection_notes'] : 'N/A'; ?></section> -->
                                                <section class="mng-time"><?php echo $missionConnection['Mission']['start_time'] != ''?  date('M. d, Y',strtotime($missionConnection['Mission']['start_time'])) : 'N/A'; ?></section>
                                            </li> 
                                            <?php } ?>
                                       </ul>
                                        <?php } ?>
                                        <!--End-->
                                    </section>
                                      </section>
                                      <!--Left Panel Starts-->
                                      <!--Right Contacts Starts-->
                            <!--      <section class="rgt-cntcts">
                                           <section class="rgt-cntctsimg"><a href="#"><img height=67  src="<?php// echo SITE_URL ?>img/connections_right_img.png" alt="" /></a></section>
                                           <section class="rgt-cntctsimg"><a href="#"><img height=67 src="<?php //echo SITE_URL ?>img/connections_right_img.png" alt="" /></a></section>
                                           <section class="rgt-cntctsimg"><a href="#"><img height=67 src="<?php// echo SITE_URL ?>img/connections_right_img.png" alt="" /></a></section>
                                           <section class="rgt-cntctsimg"><a href="#"><img height=67 src="<?php //echo SITE_URL ?>img/connections_right_img.png" alt="" /></a></section>
                                      </section> -->
                                      <!--Right Contacts End-->
                                  </section>
                                  <!--Basic Details End-->
                                  <!--Add Connection Button-->
                                  <section class=svcnntn><a href="<?php echo $this->Html->url(array('action'=>'add_connection', $id));?>"><div class="blubtn-big"><input type="button" value="Edit" /></div></a></section>
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