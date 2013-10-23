<?php //$_SESSION['openPass'] = 1; ?>

<?php 
    echo $this->Html->script('password_strength.js');
?>

<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#password').passwordStrength();
        
        jQuery("#signUpForm").validationEngine();
        
});
</script>

<style>
/* Style for password strength meter */
.is0{background:url('<?php echo SITE_URL ?>img/password_strength.png') no-repeat 0 0;width:138px;height:14px; margin:3px 0px 3px 7px;}
.is10{background-position:0 -14px;}
.is20{background-position:0 -14px;}
.is30{background-position:0 -28px;}
.is40{background-position:0 -28px;}
.is50{background-position:0 -42px;}
.is60{background-position:0 -42px;}
.is70{background-position:0 -56px;}
.is80{background-position:0 -56px;}
.is90{background-position:0 -70px;}
.is100{background-position:0 -70px;}
.is110{background-position:0 -84px;}
.is120{background-position:0 -84px;}
</style>

<script>
jQuery(document).ready(function(){
     jQuery(".msgTo").click(function(){
		jQuery(".listing").hide();
		var classToShow = "."+jQuery(this).attr('id');
		jQuery(classToShow).show();
	});
     
     //For Jquery Tabs
     initMenus();
     $('#menuaccrdn li ul:first, #menuaccrdn li > ul:first').show();
    
     var openPass = '<?php echo @$_SESSION['openPass']?>';
    
     if(openPass != ""){
	  //jQuery(".innerexpand").hide();
	  //jQuery(".accountTab").css('display','block');
     }
});
</script>
<style>
.msrdtxt input { width:216px; }
.expttxt input { width:112px !important; }
.nmbrtxt input { width:28px !important;}
.datetxt input { width:141px !important; }
.milstone select { font-size:12px !important; margin: 17px 0 0 !important; }

.keydes { width: 188px !important; }
.keyhrs { width: 110px !important; }
.keyranking { width: 65px !important; }
</style>

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
 
 ul.perf_tabs li {
 width:166px;
 }
.sc_balance { border: 1px solid #ccc !important; height:20px !important; width:80px!important; }
input.sc_balance {
    font-size: 14px !important;
    margin-top: 0px !important;
}
/****
-------------------jQuery Tabs Style------------------****/
#wrapper { margin:0 auto; width:676px; }
.innerexpand ul.tabs { margin:0; padding:0; float:left; list-style:none; height:32px; border-bottom:1px solid #ccc; border-left:1px solid #ccc; width:100%; }
.innerexpand ul.tabs li { float:left; margin:0; padding:0; height:31px; line-height:31px; border:1px solid #999; border-left:none; margin-bottom:-1px; overflow:hidden; position:relative; background:#e0e0e0; width:auto; }
.innerexpand ul.tabs li a { text-decoration:none; color:#000; display:block; font-size:1.2em; padding:0 18px; border:1px solid #fff; outline:none; font-family:calibri; font-size:15px; word-spacing:normal; background:none;  }
.innerexpand ul.tabs li a:hover { background:#ccc; padding-left:19px; border-left:0; margin-left:0; }
.innerexpand ul.tabs li.active, ul.tabs li.active a:hover { background:#fff; border-bottom:1px solid #fff; }
/**************************Tab Content CSS**************************/
.innerexpand .tab_container { border:1px solid #ccc !important; border-top:none !important; overflow:hidden; clear:both; float:left; width:100%; background:#fff; }
.innerexpand .tab_content { padding:10px; font-size: 1.2em; }
.innerexpand .tab_content:after { font-size:0; line-height:0; height:0; content:'.'; visibility:hidden; display:block; clear:both }

/****
-------------------jQuery Performance Profile Tabs Style------------------****/
#wrapper { margin:0 auto; width:676px; }
.innerexpand ul.perf_tabs { margin:0; padding:0; float:left; list-style:none; height:32px; border-bottom:1px solid #ccc; border-left:1px solid #ccc; width:100%; }
.innerexpand ul.perf_tabs li { float:left; margin:0; padding:0; height:31px; line-height:31px; border:1px solid #ccc; border-left:none; margin-bottom:-1px; overflow:hidden; position:relative; background:#e0e0e0; }
.innerexpand ul.perf_tabs li a { text-decoration:none; color:#000; display:block; font-size:1.2em; padding:0 18px; border:1px solid #fff; outline:none; font-family:calibri; font-size:15px; word-spacing:normal; background:none;  }
.innerexpand ul.perf_tabs li a:hover { background:#ccc; padding-left:19px; border-left:0; margin-left:0; }
.innerexpand ul.perf_tabs li.active, ul.tabs li.active a:hover { background:#fff; border-bottom:1px solid #fff; }
/**************************Tab Content CSS**************************/
.innerexpand .perf_tab_container { border:1px solid #ccc; border-top:none; overflow:hidden; clear:both; float:left; width:100%; background:#fff; }
.innerexpand .perf_tab_content { padding:10px; font-size: 1.2em; }
.innerexpand .perf_tab_content:after { font-size:0; line-height:0; height:0; content:'.'; visibility:hidden; display:block; clear:both }

/****
-------------------jQuery Account Tabs Style------------------****/
#wrapper { margin:0 auto; width:676px; }
.innerexpand ul.acc_tabs { margin:0; padding:0; float:left; list-style:none; height:32px; border-bottom:1px solid #ccc; border-left:1px solid #ccc; width:100%; }
.innerexpand ul.acc_tabs li { float:left; margin:0; padding:0; height:31px; line-height:31px; border:1px solid #ccc; border-left:none; margin-bottom:-1px; overflow:hidden; position:relative; background:#e0e0e0; }
.innerexpand ul.acc_tabs li a { text-decoration:none; color:#000; display:block; font-size:1.2em; padding:0 18px; border:1px solid #fff; outline:none; font-family:calibri; font-size:15px; word-spacing:normal; background:none;  }
.innerexpand ul.acc_tabs li a:hover { background:#ccc; padding-left:19px; border-left:0; margin-left:0; }
.innerexpand ul.acc_tabs li.active, ul.tabs li.active a:hover { background:#fff; border-bottom:1px solid #fff; }
/**************************Tab Content CSS**************************/
.innerexpand .acc_tab_container { border:1px solid #ccc; border-top:none; overflow:hidden; clear:both; float:left; width:100%; background:#fff; }
.innerexpand .acc_tab_content { padding:10px; font-size: 1.2em; }
.innerexpand .acc_tab_content:after { font-size:0; line-height:0; height:0; content:'.'; visibility:hidden; display:block; clear:both }

.innerexpand #wrapper .tab_container a { border:none; padding-left:0; font-family:calibri; font-size:14px; text-decoration:underline; }
.innerexpand #wrapper .tab_container a:hover { text-decoration:none; }

.coreelemnts .textbox input { width:425px; }
.prfnmnc form input[type=checkbox] { float:left; margin:4px 10px 0 0; }
.prfnmnc form input[type=text] { border:1px solid #ccc; border-radius:4px; box-shadow:0 0 4px #aaa; padding:3px 6px; width:175px !important; margin-right:20px; } 

.biolist li label { padding-top:18px; width:100px; }
.biolist li input[type=text] { width:275px; }

.accntlist li label { padding-top:18px; }
.accntlist li input[type=text] { width:275px; }

.chkbxlft li input[type=checkbox] { float:left; margin:4px 10px 0 0; }

.lifelists { overflow:hidden; }
.lifelists li { float:left; width:100%; }
.lifelists li label { float:left; width:150px; }
.lifelists li input[type=checkbox] { float:left; margin:4px 10px 0 0; }
.lifelists li input[type=text] { width:275px; }

.cnnctnslist input[type=text] { border:1px solid #ccc;border-radius:4px; box-shadow:0 0 4px #aaa; padding:5px 6px; width:175px !important; }
.cnnctnslist .textbox input[type=text] { border:none; box-shadow: 0 0 0 #fff; }

.dlyrmndr input[type=checkbox] { float:left; margin:4px 10px 0 0;  }
.dlyrmndr li label { float:left; width:160px; }
.dlyrmndr input:-moz-placeholder { margin-top:0 !important; }

.lifelists #life_rating { width:200px }
.wrap_tab_content{ padding-left: 20px !important;}
</style>

<script type="text/javascript">
jQuery(document).ready(function(){
     var open_ac_tab = '<?php echo @$_SESSION["first_login"] ?>';
     if(open_ac_tab != ""){
	jQuery(".wrap_tab_content").hide();
	jQuery(".pwd_tab_content").show();
     }
});
</script>

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
                       <a href='<?php echo $html->url(array('controller'=>'users', 'action'=>'welcome')); ?>'>
		       <h3 class="hwdtwrks dshbrd spnsr_profile_small_icon">My Setup</h3></a>
                                              
		       <!--Right Panel Starts-->
                           <section class="dshbrd-right close_to_left">
			      <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Current Reflection Section Starts-->
                               <section class="current-mission manggrpdsbrd">
                                    <!--Heading-->
                                    <h3 class=wrdspcn>Manage<span>Profile</span></h3>
                                    <!-- Foundation Setup slider starts -->
                                    <ul id="menuaccrdn" class="menu">
                                        <!-- Bio Section- Starts-->
                                        <li> <a href="#">Bio</a>
                                            <?php echo $this->element("foundation/sponsor_bio"); ?>
                                        </li>
                                            <!-- Bio Section- Ends-->
                                        <!-- Account Section- Starts-->
                                        <li> <a href="#" id="tmp">Account</a>
                                            <?php echo $this->element("foundation/sponsor_account");?>
                                        </li>
                                    <!-- Account Section- Ends-->
                                    </ul>
				    <!-- Foundation Setup slider starts -->
                               </section>
                               <!--Current Reflection Section End-->
                           </section>
		       
		       
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


<script type="text/javascript">
jQuery(document).ready(function(){
	
     jQuery(function() {
             jQuery( ".calInput" ).datepicker();
             
     });

     jQuery("#addMissionForm").validationEngine();
	
     /*   
     //Script for clone crMission section
     jQuery("#addfields").click(function(){
          var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png'/></a>");
          
          jQuery("#crMission table tr td li").last().append(img);
          jQuery(img).click(function(){
                  jQuery(img).parent('li').remove();
          });
          jQuery("#crMission table tr td li").last().find('input[type=text]').val('');
     });
     //End script for clone crMission section
     */
    
     //Script for clone milestone section
     jQuery("#add_milestone").click(function(){
          var clone = jQuery("#milestoneClone table tr td li").last().clone();
          jQuery(clone).appendTo(jQuery("#milestoneClone table tr td"));
          
          var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png'/></a>");
          
          jQuery("#milestoneClone table tr td li").last().append(img);
          jQuery(img).click(function(){
                  
                  jQuery(img).parent('li').remove();
                          
          });
          
          clone.find('input[type=text]').val('');
     });
     //End script for clone crMission section
     
     //Script for clone Key to success section
     jQuery("#add_key").click(function(){
          var clone = jQuery("#keyClone table tr td li").last().clone();
          jQuery(clone).appendTo(jQuery("#keyClone table tr td"));
          
          var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png'/></a>");
          
          jQuery("#keyClone table tr td li").last().append(img);
          jQuery(img).click(function(){
                  
                  jQuery(img).parent('li').remove();
                          
          });
          
          clone.find('input[type=text]').val('');
     });
     //End script for clone Key to success section
       
});
</script>

<?php $this->Session->delete('first_login'); ?>

