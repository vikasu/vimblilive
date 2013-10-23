<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    echo $this->Html->css('jquery-latest');
    echo $this->Html->script('jquery.qtip-1.0.0-rc3.min'); ?>

<style>

/*********
===========================Added Jan-11-2012============================*********/

li a {display:inline-block;}
li a {display:block;}
  
.cnnctns-actns {
 width:450px; height:30px; padding-top:10px;
}

 ul.tabs li {
 width:222px;
 }
ul.manag-actvty li a { background: none!important; width:auto!important; color:inherit!important;}
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
                           <h3 class="hwdtwrks dshbrd">Dashboard</h3>
                           <!--Left Panel Starts-->
                           <section class=dshbrd-left>
				<?php if($_SESSION['Auth']['User']['user_type'] == 2){ 
					echo $this->element('dashboard/group_left');
				   } else {
					echo $this->element('dashboard/ind_left');
				   }
				   ?>
                              <?php //echo $this->element('dashboard/ind_left'); ?>
                           </section>
                           <!--Left Panel End-->
                           <!--Right Panel Starts-->
                           <section class=dshbrd-right>
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Right Panel Starts-->
                           <section class=dshbrd-right>
                               <!--Current Reflection Section Starts-->
                               <section class="current-mission manggrpdsbrd">
                                    <!--Heading-->
                                    <!-- Foundation Setup slider starts -->
                                    <ul id="menuaccrdn" class="menu">
					<li> <h3 class=wrdspcn>Dated</h3>
                                           <span><?php
					   if($messageDetail['Message']['local_message_time'] != '' AND $messageDetail['Message']['local_message_time'] != '0000-00-00 00:00:00'){
                                                  echo date('M. d, Y h:i a',strtotime($messageDetail['Message']['local_message_time']));
                                                  
					     } else {
						  echo 'N/A';
					     }
					?>
					</span>
					</li>
					<li>  <h3 class=wrdspcn><span>From</span></h3>
                                           <span><?php echo $messageDetail['User']['email'] ?></span>
					</li>
				
					<li> <h3 class=wrdspcn>Subject</h3>
                                            <span><?php echo htmlspecialchars_decode($messageDetail['Message']['subject']) ?></span>
                                        </li>
					<li> <h3 class=wrdspcn><span>Description</span></h3>
                                           <span><?php echo htmlspecialchars_decode($messageDetail['Message']['content']) ?></span>
					</li>
				    </ul>
				    <!-- Foundation Setup slider starts -->
                               </section>
                               <!--Current Reflection Section End-->
                           </section>
                           <!--Right Panel End-->
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