<?php //echo $this->params['pass'][1]; die;?>
<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    echo $this->Html->css('jquery-latest');
    echo $this->Html->script('jquery.qtip-1.0.0-rc3.min');
    
    echo $this->Html->script('password_strength.js');
    
    $this->Session->delete('change_pass');
  //pr($this->data); die;  
?>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery(".upload").click(function(){
	   jQuery(".innerexpand").addClass('blurDiv');
	   jQuery("#loaderDiv").show();
	});
    jQuery("#reflection_weightage").keyup(function(){
	var ref_val = jQuery("#reflection_weightage").val();
	if(ref_val > 100){
	   jQuery(this).attr('value','');
	   jQuery('#allActivity_weightage').attr('value','');
	   alert('Please enter Valid No. ');
	   return false;
	}
	if(ref_val < 0){
	   jQuery(this).attr('value','');
	   jQuery('#allActivity_weightage').attr('value','');
	    alert('Please enter Valid No. ');
	     return false;
	}
	if(jQuery.isNumeric(ref_val)){
	    var act_val = 100 - ref_val;
	    jQuery('#allActivity_weightage').attr('value',act_val);
	    //alert(jQuery(this).val());
	}else{
	    alert('Please enter Numbers only');
	}
	})
});
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#password').passwordStrength();
        
        jQuery("#signUpForm").validationEngine();
        
	$("#authrization").click(function(){
	      window.location.href="<?php echo SITE_URL ?>connections/revokeToken";
	    });
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

<script type="text/javascript">
jQuery(document).ready(function(){
    //open qtip to show all core values
    jQuery('#all_core_values').qtip({
	content: {
	text: '<img src="loading.gif" alt="loading" />',
	url: '<?php echo SITE_URL; ?>core_values/index/'+ jQuery(this).attr("user_id"),
	title: {
            text: 'Select options',
            button: 'X' // Close button
            }
	},
         show: {
            when: 'click',
            delay: 100,
        },
        
	hide: 'mousedown',
	tip: 'topLeft',
        position: { corner: { target: 'topLeft', tooltip: 'middleRight' }, adjust: { x: 10, y: 10 } }
       
    });
    
    //open qtip to show all strength values
    jQuery('#all_strength_values').qtip({
	content: {
	text: '<img src="loading.gif" alt="loading" />',
	url: '<?php echo SITE_URL; ?>strength_values/index/'+ jQuery(this).attr("user_id"),
	title: {
            text: 'Select options',
            button: 'X' // Close button
            }
	},
         show: {
            when: 'click',
            delay: 100,
        },
        
	hide: 'mousedown',
	tip: 'topLeft',
        position: { corner: { target: 'topLeft', tooltip: 'middleRight' }, adjust: { x: 10, y: 10 } } 
    });

//display rating  for core values   
jQuery(function() {
$('#core_rating').raty({
  cancel    : true,
  cancelOff : 'cancel-off-big.png',
  cancelOn  : 'cancel-on-big.png',
  half      : true,
  size      : 24,
  starHalf  : 'star-half-big.png',
  starOff   : 'star-off-big.png',
  starOn    : 'star-on-big.png',
  number    :  5,
  rating_id : '1',
  scoreName: 'data[CoreValue][rating]',
  score : '<?php echo isset($selected_core_values[7]) ? $selected_core_values[7] : ''; ?>',
  path : '<?php echo SITE_URL; ?>/img'
});
});

//display rating  for strength values   
jQuery(function() {
$('#strength_rating').raty({
  cancel    : false,
  cancelOff : 'cancel-off-big.png',
  cancelOn  : 'cancel-on-big.png',
  half      : false,
  size      : 24,
  starHalf  : 'star-half-big.png',
  starOff   : 'star-off-big.png',
  starOn    : 'star-on-big.png',
  number    :  3,
  rating_id : '1',
  scoreName: 'data[StrengthValue][rating]',
  score : '<?php echo isset($this->data["StrengthValue"]["rating"]) ? $this->data["StrengthValue"]["rating"] : ''; ?>',
  path : '<?php echo SITE_URL; ?>/img'
});
});


//display rating  for life values   
jQuery(function() {
$('#life_rating').raty({
  cancel    : true,
  cancelOff : 'cancel-off-big.png',
  cancelOn  : 'cancel-on-big.png',
  half      : true,
  size      : 24,
  starHalf  : 'star-half-big.png',
  starOff   : 'star-off-big.png',
  starOn    : 'star-on-big.png',
  number    :  5,
  rating_id : '1',
  scoreName: 'data[LifeValue][rating]',
  score : '<?php echo isset($selectedLifeValuesDetails[0]['LifeValueDetail']['rating']) ? $selectedLifeValuesDetails[0]['LifeValueDetail']['rating'] : ''; 	?>',
  path : '<?php echo SITE_URL; ?>/img'
});
});

    //Core elements tabs-starts
   // $(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
	//Core elements tabs-ends
	
	//Performance Profile tabs- Starts
	$(".perf_tab_content").hide(); //Hide all content
	$("ul.perf_tabs li:first").addClass("active").show(); //Activate first tab
	$(".perf_tab_content:first").show(); //Show first tab content
	//On Click Event
	$("ul.perf_tabs li").click(function() {
		$("ul.perf_tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".perf_tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
	//Performance Profile tabs- Ends
	
	//Account tabs- Starts
	$(".acc_tab_content").hide(); //Hide all content
	$("ul.acc_tabs li:first").addClass("active").show(); //Activate first tab
	$(".acc_tab_content:first").show(); //Show first tab content
	//On Click Event
	$("ul.acc_tabs li").click(function() {
		$("ul.acc_tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".acc_tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});
	//Account tabs- Ends
   if(<?php echo $_SESSION['Connection']['stValSave'] ?> == 0){
    initMenus();
    $('#menuaccrdn li ul:first, #menuaccrdn li > ul:last').show();
   }
       
     jQuery('.actionButton').click(function(){
          if (jQuery("#activitylistForm input:checkbox:checked").length > 0)
          {
              if(jQuery(this).attr('id') == 'view' || jQuery(this).attr('id') == 'edit')
              {
                    if (jQuery("#activitylistForm input:checkbox:checked").length > 1)
                    {
                         jQuery('#chkMsg').html('Please select single recored for view or edit.');
                         jQuery('#chkMsg').slideDown('slow');
                         jQuery('#chkMsg').delay(3000).slideUp('slow');
                         return false;
                    }
              }
               jQuery("#actionTaken").val(jQuery(this).attr('id'));
               jQuery('#activitylistForm').submit();
          }
          else
          {
               jQuery('#chkMsg').html('Please select atleast one record.');
               jQuery('#chkMsg').slideDown('slow');
               jQuery('#chkMsg').delay(3000).slideUp('slow');
               return false;
          }
     });
     
     jQuery(".searchtype").click(function(){
          jQuery("#searchIn").attr('value',jQuery(this).attr("id"));
     });
      jQuery(".connection-group").click(function(){
          jQuery("#connection-group").attr('value',jQuery(this).attr("group_id"));
	  jQuery("#actionTaken").val('grouping');
	  $('#activitylistForm').submit();
     });
      jQuery("#rating_img").live('click', function(){
	    var activity_id = jQuery(this).attr('attr');
	    var current_rating = jQuery('#rating_id'+activity_id).val(); 
	    $.ajax({
		  url: '<?php echo SITE_URL?>activities/update_ratings/'+activity_id+'/'+current_rating,
		  success: function(data) {
		    //alert(data);
		  }
		});
     });
      
   
     
     //Take user to change pass tab if 'from' is set(vikas Uniyal Jan 30)
     var from = '<?php echo isset($changePass) ? $changePass : NULL; ?>';
     if(from == 1)
     {
	jQuery("#tmp").click();
     }
    
     
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
#wrapper { margin:0 auto; width:927px !important; }
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

.biolist li label { width: 110px !important; }
#calendar_text{font-style:italic;font-weight: lighter;color: #787878; line-height: 0.4;}

.blurDiv { opacity: 0.4; }
#loaderDiv { display: none; position: absolute; top: 260px; left: 730px; 
</style>
    
 <?php //pr($conLists); die; ?>

<?php /*
if($paginator->sortDir() == 'asc'){
	$image = $html->image('admin-arrow-top.jpeg',array('border'=>0,'alt'=>''));
}
else if($paginator->sortDir() == 'desc'){
	$image = $html->image('admin-arrow-bottom.jpeg',array('border'=>0,'alt'=>''));
}
else{
	$image = '';
} */
?>
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
                           <h3 class="hwdtwrks dshbrd timeline_small_icon">My Setup & Data</h3>
                           
                           <!--Right Panel Starts-->
                           <section class="dshbrd-right close_to_left">
                              
			      <div id="loaderDiv"><img src="<?php echo SITE_URL ?>img/ajax-loader.gif"></div>
			      
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Right Panel Starts-->
                           <section class=dshbrd-right>
                               <!--Current Reflection Section Starts-->
                               <section class="current-mission manggrpdsbrd">
                                    <!--Heading-->
                                    <h3 class=wrdspcn>Foundation<span> Setup</span></h3>
                                    <!-- Foundation Setup slider starts -->
                                    <ul id="menuaccrdn" class="menu" style="display: none;">
                                    <!-- Core-Elements Section- Starts-->
                                        <li> <a href="#">Core Elements <span style="margin-left:100px; font-family:arial; font-size:16px; font-style:italic;">More elements to follow...</span></a>
                                            <?php echo $this->element("foundation/core");?>
                                        </li>
                                        <!-- Core-Elements Section- Ends-->
                                        <!-- Performance Section- Ends-->
                                        <li><a href="#">Performance Profile</a>
                                            <?php echo $this->element("foundation/performance");?>
                                        </li>
                                        <!-- Performance Section- Ends-->
                                        <!-- Bio Section- Starts-->
                                        <li> <a href="#">Bio</a>
                                            <?php echo $this->element("foundation/bio"); ?>
                                        </li>
                                            <!-- Bio Section- Ends-->
                                        <!-- Account Section- Starts-->
                                        <li> <a href="#" id="tmp">Account</a>
                                            <?php echo $this->element("foundation/account");?>
                                        </li>
                                    <!-- Account Section- Ends-->
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

    <!--Center Align Inner Content Section End-->
    <script type="text/javascript">
     $(document).ready(function(){
		$('.slctbx').click(function(){
		 $('.slctcate-drop').slideToggle(300);							
		 });
	  $('.group_slctbx').click(function(){
		 $('.group-slctcate-drop').slideToggle(300);							
		 });
	  
	   $('#backup_email').blur(function() {
		recovery_email_chk();
	   });
	   
	   $('.tmp').click(function() {
		recovery_email_chk();
	   });
	   
	 
	   //load after 3 seconds of page load.
	    setTimeout(showBar,1000);
	    function showBar(){
		 jQuery("#menuaccrdn").show();
	    }
	   $('#menuaccrdn li ul:first, #menuaccrdn li > ul:first').hide();
	   
	
	jQuery(".submit").click(function(){
	    jQuery(".dshbrd-right").addClass('blurDiv');
	    jQuery("#loaderDiv").show();
	});
	
	if(<?php echo $_SESSION['Connection']['stValSave'] ?> == 1){
	    $('#menuaccrdn li ul:first').show();
	}
	
	
	var stn = "<?php echo @$this->params['pass'][1] ?>";
	if(stn == "strengths"){
	    jQuery('#menuaccrdn li ul:first').show();
	    jQuery('#tmp').next().css('display','none');
	}
	   
       });
     
	function recovery_email_chk(){
	    if($("#email").val()==$("#backup_email").val())
		alert('Back-up email address should be different from primary email.');
	    }
     
     
     
    </script>
<?php //$_SESSION['change_pass'] == 0; ?>

    