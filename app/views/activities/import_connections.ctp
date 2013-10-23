<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery("#importConnections").validationEngine();
        
        jQuery(".source").click(function(){
                jQuery(".source").removeClass('current_sourse');
                jQuery(this).addClass('current_sourse');
                jQuery("#source").attr('value',jQuery(this).attr("id"));
        });
   
        <?php if(@$_SESSION['imported'] == 1) { ?>
         jQuery("html, body").animate({ scrollTop: 600 }, "slow");
        <?php } ?>
});
</script>
<style>
.current_sourse { padding:3px; background:#ccc; border:1px solid #bbb;}
.selectOption { width: 10px !important;}
</style>

<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
                          <!--SignUp Heading-->
                                <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                      
                          <div class="signup-hdng imprtcnncthdn"><h3 class=bebasLink <span>My Data</span></h3></div>
                          <!--Choose Connections From Starts-->
                          <section class="chusnenter stpn">
                               <h4>Step 1: Identify the source to use</h4>
                               <ul class="trsctnlist importlst">
                                  <li><a href="javascript:void(0);"><img class="source" id="yahoo" src="<?php echo SITE_URL ?>img/icon_import_yahoo.png" alt="" /></a></li>
                                  <li><a href="javascript:void(0);"><img class="source" id="gmail" src="<?php echo SITE_URL ?>img/icon_import_gmail.png" alt="" class="imprtgmail" /></a></li>
                                  <li><a href="javascript:void(0);"><img class="source" id="hotmail" src="<?php echo SITE_URL ?>img/icon_import_mssngr.png" alt="" /></a></li>
                               </ul>
                          </section>
                          <!--Enter Information Starts-->
                          <section class=chusnenter>
                               <h4>Step 2: Enter Information</h4>
                               
                               <?php echo $this->Form->create("Connection",array("controller"=>'connections',"action"=>'import_connections',"method"=>"POST",'id'=>'importConnections')); ?>
                                <ul class="trsctnlist entrinfo">
                                    <li><div class=textbox><span><?php echo $this->Form->input('Connection.email',array('placeholder'=>'Enter your email Address','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                    <li><div class=textbox><span><?php echo $this->Form->input('Connection.password',array('placeholder'=>'Password','label'=>false,'div'=>false,'id'=>'password','class'=>'validate[required]','error'=>false)); ?></span></div></li>
                                    <li class=importbtn><div class="blubtn-big"><?php echo $this->Form->submit('Link Now',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></li>
                                    <li class=importbtn style="padding-top:5px;">Vimbli will import your full address book.  When completed you will have the option to activate specific contacts in your address book as connections to track in Vimbli.</li>
                                </ul>
                                <?php echo $this->Form->input('Connection.source',array('type'=>'hidden','value'=>'','id'=>'source','class'=>'validate[required]')); ?>
                               <?php echo $this->Form->end(); ?>
                          </section>
                          
                          <?php //if(!empty($allContacts)){ ?>
                          <!--Your Contacts Listing-->
                          <!--<section class="trnsctn-method listingcntcts">
                                <?php //if(@$_SESSION['imported'] == 1) {?>
                                        <font color="green">Connection imported successfully. Select and click 'Activate' button to activate contacts.</font>
                                <?php// } $this->Session->delete('imported');?>
                               <h4>Your Contacts</h4>
                               <ul class=cntctlisthdr>
                                   <li class="selectOption"><input id="all" type="checkbox"></li>
                                   <li>Full Name</li>
                                   <li>Contact Name</li>
                                   <li class=nobrdr>Contact No.</li>
                               </ul>
                               <!--Custome ScrollBar Starts-->
                               <!--Don't Delete, Move These Classes-->
                              <!-- <form action="<?php //echo SITE_URL ?>connections/activateContacts" method="post">
                               <section id="scrollbar1" class="cntctlistng">
                                   <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
                                   <div class="viewport">
                                       <div class="overview">
                                           <!--All Your Content Goes Here-->                           
                                          <!-- <ul class=cntctlist <?php //if(count($allContacts) < 7) { ?> style="width:478px !important; border-bottom:1px solid #DEDEDE; border-right:1px solid #DEDEDE;"<?php //} ?>>
                                              <?php //pr($allContacts); exit;
                                              // foreach($allContacts as $contacts){ ?>
                                                <li>
                                                   <div class="selectOption"><input class="allchk" type="checkbox" name="data[Connection][toActivate][]" value="<?php //echo $contacts['Connection']['id']; ?>"></div>
                                                   <div><?php //echo $contacts['Connection']['name']; ?></div>
                                                   <div>
                                                   <?php
                                                       // $contactEmail = '';
                                                      //  foreach($contacts['ConnectionEmail'] as $email):
                                                       //         $contactEmail = $contactEmail.$email['email'].', ';
                                                       // endforeach;
                                                      //  echo substr($contactEmail,0,strlen($contactEmail)-2);
                                                   ?>
                                                   </div>
                                                   <div>
                                                   <?php
                                                       // if(!empty($contacts['ConnectionPhone'] )) {
                                                          //      $contactNum = '';
                                                         //       foreach($contacts['ConnectionPhone'] as $phone):
                                                         //               $contactNum = $contactNum.$phone['phone'].', ';
                                                          //      endforeach;
                                                          //      echo substr($contactNum,0,strlen($contactNum)-2);
                                                       // } else {
                                                           //     echo 'N/A';
                                                       // }
                                                   ?>
                                                   </div>
                                                </li>
                                              <?php //} ?>
                                           </ul>
                                       </div>
                                   </div>
                               </section>
                               
                               <div class="blubtn-mid actvnsltd"><input type="submit" value="Activate Selected"></div>
                               </form>
                               
                               <!--Custome ScrollBar Starts-->
                        <!--  </section> -->
                          <?php //} ?>
                          
                          
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