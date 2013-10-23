<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    echo $this->Html->css('jquery-latest');
    echo $this->Html->script('jquery.qtip-1.0.0-rc3.min'); ?>

<script type="text/javascript">
jQuery(function() {
$('#star').raty({
  readOnly  : true,
  cancel    : true,
  cancelOff : 'cancel-off-big.png',
  cancelOn  : 'cancel-on-big.png',
  half      : true,
  size      : 24,
  starHalf  : 'star-half-big.png',
  starOff   : 'star-off-big.png',
  starOn    : 'star-on-big.png',
  number: 3,
  scoreName: 'data[ImportEmail][rating]',
  score : '<?php echo isset($eventDetails['CalendarEvent']['rating']) ? $eventDetails['CalendarEvent']['rating']  : ''; ?>',
  path : '<?php echo SITE_URL; ?>/img'
});
});
</script>

<style>
/*
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
                              <?php echo $this->element('dashboard/ind_left'); ?>
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
					<li> <h3 class=wrdspcn>Date</h3>
                                           <span><?php echo date('Y-m-d H:i',strtotime($eventDetails['CalendarEvent']['start_time'])).' To '.date('Y-m-d H:i',strtotime($eventDetails['CalendarEvent']['end_time'])) ?></span>
					</li>
					<li> <h3 class=wrdspcn>Title</h3>
                                            <span><?php echo $eventDetails['CalendarEvent']['title'] ?></span>
                                        </li>
					<li> <h3 class=wrdspcn>Rating</h3>
                                           <span><div id="star"></div></span>
					</li>
					<li> <h3 class=wrdspcn>Notes<span></span></h3>
                                           <span>
					    <?php
						if($eventDetails['CalendarEvent']['notes'] != "")
						echo $eventDetails['CalendarEvent']['notes'];
						else
						echo 'N/A';
					    ?>
					    </span>
					</li>
					<li> <h3 class=wrdspcn>Description<span></span></h3>
                                           <span>
					    <?php
						if($eventDetails['CalendarEvent']['details'] != "")
						echo $eventDetails['CalendarEvent']['details'];
						else
						echo 'N/A';
					    ?>
					    </span>
					</li>
					<li> <h3 class=wrdspcn>Attendies<span></span></h3>
                                           <span>
					    <?php foreach($eventDetails['EventAttendy'] as $attendies){
						echo $attendies['attendy_display_name'].'<br>';
					    } ?>
					   </span>
					</li>
				    </ul>
				    <!-- Foundation Setup slider starts -->
                               </section>
                               <!--Current Reflection Section End-->
                           </section>
			   
			   <section class=svcnntn><a href="<?php echo $this->Html->url(array('controller'=>'activities','action'=>'edit_event', base64_encode($eventDetails["CalendarEvent"]["id"])));?>"><div class="blubtn-big"><input type="button" value="Edit  Event" /></div></a></section>
			   
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