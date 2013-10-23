<?php //echo '<pre>';  print_r($_SESSION);
        $_SESSION['link_source'] = 1;
?>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery('.loading_icon').hide();
           jQuery('#importConnections').submit(function() {
               jQuery('.loading_icon').show(); 
    });
           
        jQuery("#importConnections").validationEngine();
        
        //default source is gmail
        jQuery("#gmail").addClass('current_sourse');
        jQuery("#source").attr('value','gmail');
        
        jQuery(".source").click(function(){
                jQuery(".source").removeClass('current_sourse');
                jQuery(this).addClass('current_sourse');
                jQuery("#source").attr('value',jQuery(this).attr("id"));
                
                $.ajax({
                        url: "<?php echo SITE_URL ?>connections/save_source_in_session/"+jQuery(this).attr('id'),
                        success: function(msg) { //alert(msg);
                                       //$(".loadVideo").hide();
                        }
                });
        });
        
        jQuery("#password").val('');

       
     //disabled the button in case of yahoo   
        jQuery("#yahoo").click(function(){
            jQuery("input[type=submit]").attr("disabled", "disabled");
                });
        
     //disabled the button in case of msn  
        jQuery("#hotmail").click(function(){
            jQuery("input[type=submit]").attr("disabled", "disabled");
                });
        
     //remove disabled function the button in case of gmail   
        jQuery("#gmail").click(function(){
            jQuery("input[type=submit]").removeAttr("disabled");  
                });
          //Testing for oauth popup
        jQuery("#tst").click(function(){
                /*set session via ajax that will help in immediate fetching on welcome page*/
                $.ajax({                    
                    url: "<?php echo SITE_URL ?>connections/set_link_session",
                    success: function(){
                            
                        }
                });
                
                var screen_height= screen.height;
                var screen_width= screen.width;
                
                window.open ("https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=http://vimbli.com/connections/oauthVendor&client_id=531104926444-8nlmhg0vo16tnj90ejc5m60sqk5g8ktl.apps.googleusercontent.com&scope=https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://mail.google.com/ https://www.googleapis.com/auth/calendar https://www.googleapis.com/auth/calendar.readonly http://www.google.com/m8/feeds/&access_type=offline&approval_prompt=force","mywindow","height="+screen_height+",width="+screen_width);
		
		//Redirect this to welcome
		window.location='<?php echo SITE_URL ?>users/welcome';
                
	});

});


        

</script>
<style>
.current_sourse { padding:3px; background:#ccc; border:1px solid #bbb;}
.selectOption { width: 10px !important;}
#tst{
      background: url("../css/images/link_now.png") no-repeat scroll left top transparent;
    display: inline-block;
    height: 63px;
    margin-bottom: 6px;
    margin-left: 134px;
    padding-left: 177px;
    cursor:pointer;
}
.auth_btn{
       /* background: url("../css/images/bluebtn_big_right.png") no-repeat scroll right top transparent;
    color: #FFFFFF;
    display: inline-block;
    font-family: 'Bebas';
    font-size: 16px;
    height: 37px;
    padding-right: 20px;*/
}

/*css for icons on set_import_info*/
#yahoo {
        height: 125px;
        width: 130px;
}
#gmail {
         height: 125px;
         width: 130px;
}
#hotmail {
        height: 125px;
        width: 130px;
}
.importbtn{
        padding-top:0px !important;
}
.importbtn a{
        color: #551AA4;
        text-decoration: none;
}
.chusnenter
{
        padding-top:12px !important;
}
/*css for icons on set_import_info*/
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
                      
                          <div class="signup-hdng imprtcnncthdn"><h3 class=bebasLink <span id="">My Data</span></h3></div>
                          <!--Choose Connections From Starts-->
                          <section class="chusnenter stpn">
                               <h4>Put your data to work by linking your primary account to Vimbli</h4>
                               <ul class="trsctnlist importlst">
                                  <li id="yahoo"><!--<a href="javascript:void(0);"><img class="source" id="yahoo" src="<?php //echo SITE_URL ?>img/icon_yahoo.jpeg" alt="" /></a>--></li>
                                  <li><a href="javascript:void(0);"><img class="source" id="gmail" src="<?php echo SITE_URL ?>img/icon_google.jpeg" alt="" class="imprtgmail" /></a></li>
                                  <li id="hotmail"><!--<a href="javascript:void(0);"><img class="source" id="hotmail" src="<?php //echo SITE_URL ?>img/icon_msn.jpeg" alt="" /></a>--></li>
                               </ul>
                          </section>
                          <!--Enter Information Starts-->
                          <section class=chusnenter>
                               <!--<h4>Step 2: Enter the login information for the account you want to link with Vimbli</h4>-->
                               
                               <?php echo $this->Form->create("Connection",array("controller"=>'connections',"action"=>'set_import_info',"method"=>"POST",'id'=>'importConnections')); ?>
                                <ul class="trsctnlist entrinfo">
                                   <!-- <li><div class=textbox><span><?php //echo $this->Form->input('Connection.email',array('value'=>$_SESSION['Auth']['User']['email'], 'placeholder'=>'Enter your email Address','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                                    <li><div class=textbox><span><?php //echo $this->Form->input('Connection.password',array('placeholder'=>'Password','label'=>false,'div'=>false,'id'=>'password','class'=>'validate[required]','error'=>false)); ?></span></div></li>-->
                                    <li class=importbtn><!--<div class="blubtn-big"><?php //echo $this->Form->submit('Link Now',array('class'=>'submit','div'=>false,'label'=>false)); ?></div>-->
                                         <div class="" id="tst"><?php //echo $this->Form->submit('Link Now',array('class'=>'auth_btn','div'=>false,'label'=>false)); ?></div>
                                    <?php echo $this->Html->image('icon_loading.gif', array('class'=>'loading_icon', 'style'=>'display:none;')); ?>
                                    </li>
                                    <li class=importbtn style="margin-top:13px;">Vimbli will never share your data with third parties. We may use aggregate data for research and product development purposes. Please see Vimbli's  <?php echo $html->link('Terms of Service' ,array('controller'=>'pages','action'=>'terms_of_services'));?> and <?php echo $html->link('Privacy Policy' ,array('controller'=>'pages','action'=>'privacy'));?> for more information.</li>
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