<style>
.mng-actns img {margin-right:0px;}
.connectall h3 { padding-left:42px; }
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
                           <!--Left Panel Starts-->
                           <section class=dshbrd-left>
                              <?php echo $this->element('dashboard/ind_left'); ?>
                           </section>
                           <!--Left Panel End-->
                           <!--Right Panel Starts-->
                           <section class="dshbrd-right connectall">
                                  <!--SignUp Heading-->
                                  <div class="signup-hdng addcnncthdn"><h3 class=bebas>Activity<span>Detail</span></h3></div>
                                  <!--Basic Details Starts-->
                                  <section class="basic-details connection-detail">
                                      <!--Left Panel Starts-->
                                      <section class=bscdtl-lft>
                                          <section class=cnnctn-detil>
                                              
                                               <section class=cnnctn-info>
                                                   <ul>
                                                      <li><h4><?php echo $activityInfo['Activity']['title']; ?></h4></li>
                                                       <br>
                                                      <li><?php echo $activityInfo['Activity']['description']; ?></li>
                                                       <br>
                                                      <li><?php echo 'Activity Type: '.$activityInfo['ActivityType']['title']; ?></li>
                                                      <br>
                                                      <li><?php echo 'Time: '.$activityInfo['Activity']['start_time'].' To '.$activityInfo['Activity']['end_time']; ?>
                                                      </li>
                                                      <br>
                                                      
                                                   </ul>
                                                   
                                               </section>
                                          </section>
                                       <section class=svcnntn><i>Last Updated: <?php echo date('M. d, Y',strtotime($activityInfo['Activity']['modified'])); ?></i></section>
                                 
                                          <!--Notes If Any Starts-->
                                          <section class="notes">
                                               <h4>Notes</h4>
                                               <section class="notesinfo">
                                                   <p><?php echo $activityInfo['Activity']['description']; ?></p>
                                               </section>
                                          </section>
                                          <!--Notes If Any End-->
                                          <!--Other Info If Any Starts-->
                                         
                                          <!--Other Info If Any End-->
                                      </section>
                                      <!--Left Panel Starts-->
                                      </section>
                                  <!--Basic Details End-->
                                  <!--Add Connection Button-->
                                  <section class=svcnntn><a href="<?php echo $this->Html->url(array('action'=>'add_activity', $id));?>"><div class="blubtn-big"><input type="button" value="Edit  Activity" /></div></a></section>
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