<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
<?php
     $today=($refInfo['UserReflection']['rating_today'] !=0 || $refInfo['UserReflection']['rating_today'] !="" )?$refInfo['UserReflection']['rating_today']:0;
     $tomorrow=($refInfo['UserReflection']['rating_tomorrow'] !=0 || $refInfo['UserReflection']['rating_tomorrow'] !="" )?$refInfo['UserReflection']['rating_tomorrow']:0;
     $ans1=($refInfo['UserReflection']['ans_1'] !=0 || $refInfo['UserReflection']['ans_1'] !="" )?$refInfo['UserReflection']['ans_1']:0;
     $ans2=($refInfo['UserReflection']['ans_2'] !=0 || $refInfo['UserReflection']['ans_2'] !="" )?$refInfo['UserReflection']['ans_2']:0;
     $ans3=($refInfo['UserReflection']['ans_3'] !=0 || $refInfo['UserReflection']['ans_3'] !="" )?$refInfo['UserReflection']['ans_3']:0;
?>
<script>
     jQuery(function() { 
         jQuery(today).raty({
             readOnly : true,
             path     : '<?php echo SITE_URL ?>img/',
             score    : <?php echo $today ?>,
             size: 24,
             starHalf: 'star-half-big.png',
             starOff: 'star-off-big.png',
             starOn: 'star-on-big.png'
             });
         jQuery(tomorrow).raty({
             readOnly : true,
             path     : '<?php echo SITE_URL ?>img/',
             score    : <?php echo $tomorrow ?>,
             size: 24,
             starHalf: 'star-half-big.png',
             starOff: 'star-off-big.png',
             starOn: 'star-on-big.png'
             });
         jQuery(ans_1).raty({
             readOnly : true,
             path     : '<?php echo SITE_URL ?>img/',
             score    : <?php echo $ans1 ?>,
             size: 24,
             starHalf: 'star-half-big.png',
             starOff: 'star-off-big.png',
             starOn: 'star-on-big.png'
             });
         jQuery(ans_2).raty({
             readOnly : true,
             path     : '<?php echo SITE_URL ?>img/',
             score    : <?php echo $ans2 ?>,
             size: 24,
             starHalf: 'star-half-big.png',
             starOff: 'star-off-big.png',
             starOn: 'star-on-big.png'
             });
         jQuery(ans_3).raty({
             readOnly : true,
             path     : '<?php echo SITE_URL ?>img/',
             score    : <?php echo $ans3 ?>,
             size: 24,
             starHalf: 'star-half-big.png',
             starOff: 'star-off-big.png',
             starOn: 'star-on-big.png'
             });
     });
 </script>

<style>
.mng-actns img {margin-right:0px;}
.connectall h3 { padding-left:42px; }
.ratingLi { margin-bottom:10px !important;}
#today{width: 150px !important;}
#tomorrow{width: 150px !important;}
#ans_1{width: 150px !important;}
#ans_2{width: 150px !important;}
#ans_3{width: 150px !important;}
</style>
 <?php //pr($refInfo); die; ?>
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
                           <h3 class="hwdtwrks dshbrd ref_small_icon">My Thoughts & Reflections</h3>
                           <!--Right Panel Starts-->
                           <section class="dshbrd-right connectall">
                                  <!--SignUp Heading-->
                                  <div class="signup-hdng addcnncthdn"><h3 class=bebas>Reflection<span>Detail</span></h3></div>
                                  <!--Basic Details Starts-->
                                  <section class="basic-details connection-detail">
                                      <!--Left Panel Starts-->
                                      <section class=bscdtl-lft>
                                          <section class=cnnctn-detil>
                                               <section class=cnnctn-info style="padding-left:0px;">
                                                   <ul>
                                                      <li><h4><?php echo date('M. d, Y',strtotime($refInfo['UserReflection']['local_reflection_date'])); ?></h4></li>
                                                      <li></li>
                                                   </ul>
                                               </section>
                                          </section>
                                          <!--Notes If Any Starts-->
                                          <section class="notes">
                                               <h4>Description</h4>
                                               <section class="notesinfo">
                                                   <p><?php echo $refInfo['UserReflection']['description']; ?></p>
                                               </section>
                                          </section>
                                          <!--Notes If Any End-->
                                          <!--Attachments If Any Starts-->
                                          <section class="notes">
                                               <h4>Attachments</h4>
                                               <section class="notesinfo">
                                                   <?php if($refInfo['UserReflection']['captured_image'] || $refInfo['UserReflection']['file_name'] || $refInfo['UserReflection']['captured_voice'] || $refInfo['UserReflection']['captured_video']) { ?>
                                                            <?php if($refInfo['UserReflection']['captured_image'] != "") { ?>
                                                            <a class="open_webcam" href="<?php echo SITE_URL ?>app/webroot/files/cam_img/<?php echo $refInfo['UserReflection']['captured_image'] ?>"><img width=60 height=60 src="<?php echo SITE_URL ?>app/webroot/files/cam_img/<?php echo $refInfo['UserReflection']['captured_image'] ?>" alt="" style="border:1px solid #ccc; margin-right:20px;" /></a>
                                                            <?php } ?>
                                                            <?php if($refInfo['UserReflection']['captured_voice'] != "") { ?>
                                                            <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_video.png" alt="" /></a>
                                                            <?php } ?>
                                                            <?php if($refInfo['UserReflection']['captured_video'] != "") { ?>
                                                            <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_mike.png" alt="" /></a>
                                                            <?php } ?>
                                                            <?php
                                                            $imgExtArr = array('jpg','jpeg','png','gif','bmp');
                                                            if($refInfo['UserReflection']['file_name'] != "") {
                                                                $ext = pathinfo($refInfo['UserReflection']['file_name'], PATHINFO_EXTENSION);
                                                                
                                                                if(in_array($ext,$imgExtArr)){ // If uploaded file is an image
                                                                ?>
                                                                <a class="open_webcam" href="<?php echo SITE_URL ?>app/webroot/files/reflections/<?php echo $refInfo['UserReflection']['file_name'] ?>"><img width=60 height=60 src="<?php echo SITE_URL ?>app/webroot/files/reflections/<?php echo $refInfo['UserReflection']['file_name'] ?>" alt="" style="border:1px solid #ccc; margin-right:20px;" /></a>
                                                                <?php
                                                                } else{ ?>
                                                                    <a href="<?php echo SITE_URL ?>app/webroot/files/reflections/<?php echo $refInfo['UserReflection']['file_name'] ?>"><img src="<?php echo SITE_URL ?>img/attachment.png" alt="" /></a>
                                                                <?php 
                                                                }
                                                                ?>
                                                            
                                                            <?php } ?>
                                                       <?php } else {?>
                                                       <i><font color="#5D5C5C" size="2px">No Attachments</font></i>
                                                       <?php } ?>
                                               </section>
                                          </section>
                                          <!--Attachments If Any End-->
                                          
                                          <!--Participants If Any Starts-->
                                          <section class="notes">
                                               <h4>Participants</h4>
                                               <section class="notesinfo">
                                                   <?php //echo $participant;
                                                    echo $allAttendy = $this->Common->fetch_participant($refInfo['UserReflection']['id']);
                                                   ?>
                                               </section>
                                          </section>
                                          <!--Participants If Any End-->
                                          
                                          <section class=notes>
                                                   <ul>
                                                      <li style="margin-bottom:10px;"><h4>Other Detail</h4></li>
                                                      <li>How do you feel about today?</li>
                                                      <li id="today" class="ratingLi"></li>
                                                      <li>How do you feel about tomorrow?</li>
                                                      <li id="tomorrow" class="ratingLi"></li>
                                                      <li><?php echo $refInfo['Question_1']['question']; ?></li>
                                                       <li id="ans_1" class="ratingLi"></li>
                                                      <li><?php echo $refInfo['Question_2']['question']; ?></li>
                                                       <li id="ans_2" class="ratingLi"></li>
                                                      <li><?php echo $refInfo['Question_3']['question']; ?></li>
                                                       <li id="ans_3" class="ratingLi"></li>
                                                      
                                                   </ul>
                                          </section>
                                          
                                          <section class=svcnntn><a href="<?php echo $this->Html->url(array('action'=>'edit_reflection', base64_encode($refInfo['UserReflection']['id'])));?>"><div class="blubtn-big"><input type="button" value="Edit  Reflection" /></div></a></section>
                                          
                                          
                                      </section>
                                      <!--Left Panel Starts-->
                                      <!--Right Contacts Starts
                                      <section class="rgt-cntcts">
                                           <section class="rgt-cntctsimg"><a href="#"><img src="<?php echo SITE_URL ?>img/connections_right_img.png" alt="" /></a></section>
                                           <section class="rgt-cntctsimg"><a href="#"><img src="<?php echo SITE_URL ?>img/connections_right_img.png" alt="" /></a></section>
                                           <section class="rgt-cntctsimg"><a href="#"><img src="<?php echo SITE_URL ?>img/connections_right_img.png" alt="" /></a></section>
                                           <section class="rgt-cntctsimg"><a href="#"><img src="<?php echo SITE_URL ?>img/connections_right_img.png" alt="" /></a></section>
                                      </section>
                                      <!--Right Contacts End-->
                                  </section>
                                  <!--Basic Details End-->
                                  <!--Add Connection Button-->
                                  <!--<section class=svcnntn><div class="blubtn-big"><input type="button" value="Edit  Connection" /></div></section>-->
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