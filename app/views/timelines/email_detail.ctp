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
  score : '<?php echo isset($emailDetails['ImportEmail']['rating']) ? $emailDetails['ImportEmail']['rating']  : ''; ?>',
  path : '<?php echo SITE_URL; ?>/img'
});
});
</script>

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
                                           <span><?php echo $emailDetails['ImportEmail']['email_date'] ?></span>
					</li>
					<li>  <h3 class=wrdspcn><span>From</span></h3>
                                           <span><?php echo $emailDetails['ImportEmail']['email_from'] ?></span>
					</li>
					<li>  <h3 class=wrdspcn>To</h3>
                                           <span><?php echo $_SESSION['Auth']['User']['email'] ?></span>
					</li>
				
				
					<li> <h3 class=wrdspcn><span>Subject</span></h3>
                                            <span><?php echo $emailDetails['ImportEmail']['email_subject'] ?></span>
                                        </li>
					
					<li> <h3 class=wrdspcn>Rating</h3>
                                           <span><div id="star"></div></span>
					</li>
					
					<li> <h3 class=wrdspcn>Description</h3>
                                           <span><?php echo $emailDetails['ImportEmail']['email_body'] ?></span>
					</li>
				    </ul>
				    <!-- Foundation Setup slider starts -->
                               </section>
                               <!--Current Reflection Section End-->
			       
			       <section class=svcnntn><a href="<?php echo $this->Html->url(array('controller'=>'activities','action'=>'edit_email', base64_encode($emailDetails["ImportEmail"]["id"])));?>"><div class="blubtn-big"><input type="button" value="Edit Email" /></div></a></section>
			       
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