<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    echo $this->Html->css('jquery-latest');
    echo $this->Html->script('jquery.qtip-1.0.0-rc3.min'); ?>

<script type="text/javascript">
jQuery(document).ready(function(){
  
    initMenus();
    $('#menuaccrdn li ul:first, #menuaccrdn li > ul:first').show();
      
      //change activity rating from list
      jQuery("#rating_img").live('click', function(){
	    var modelName = jQuery(this).parent().attr('modelname');
	    var activity_id = jQuery(this).attr('entity_id');
	    var current_rating = jQuery('#rating_id'+activity_id).val(); 
	    $.ajax({
		  url: '<?php echo SITE_URL?>timelines/update_ratings/'+modelName+'/'+activity_id+'/'+current_rating,
		  success: function(data) {
		    //alert(data);
		  }
		});
     });
     
     //alert(jQuery(".reflectionRating").children().attr('id'));
     
     jQuery("#entity_options").change(function(){
	jQuery('#refineForm').submit();
	});	
});
/* function(){
	    var no=JQuery(".crntprgrss-actn input:checkbox:checked").val('');
	  } */
</script>
<style>

/*********
===========================Added Jan-11-2012============================*********/
/*.mng-actvty a { background: url('/img/admin-arrow-top.jpeg') no-repeat 20px 0px; }*/

select{
    border:none !important;
    font-size:14px !important;
}

#entity_options option{
    padding:0 3px;
}

.group_slctbx {
    background: none repeat scroll 0 0 #EDEDED;
    border: 1px solid #DBDBDB;
    cursor: pointer;
    float: left;
    height: 26px;
    line-height: 26px;
    text-align: center;
    width: 60px;
}

.group-slctcate-drop ul li a {
    background: none repeat scroll 0 0 #F6F6F6;
    border-bottom: 1px dashed #DEDEDE;
    color: #5D5C5C;
    display: block;
    font-size: 14px;
    padding: 3px 10px;
    text-align: left;
    width:100px;
}
.group-slctcate-drop ul li a:hover { background: none repeat scroll 0 0 #EEEEEE; text-decoration:none; }
.group-slctcate-drop { display:none; }


.cnnctns-actns {
    height: 18px !important;
    padding: 3px 10px !important;
    width: auto !important;
}

li a {display:inline-block;}
li a {display:block;}
  
.cnnctns-actns {
 width:450px; height:30px; padding-top:10px;
}

 ul.tabs li {
 width:222px;
 }
ul.manag-actvty li a { background: none!important; width:auto!important; color:inherit!important;}
  #blubtn-mid { background: url("") no-repeat scroll left top transparent !important; margin-left: -14px;}
  .custom{padding: 0 0 5;}

.blurDiv { opacity: 0.6; }
#loaderDiv { display: none; position: absolute; top: 260px; left: 730px; 
}
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
                           <h3 class="hwdtwrks dshbrd timeline_small_icon">My Setup & Data</h3>
			   
                           <!--Right Panel Starts-->
                           <section class="dshbrd-right close_to_left">
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Current Reflection Section Starts-->
                               <section class="current-mission manggrpdsbrd">
				
				<div id="loaderDiv"><img src="<?php echo SITE_URL ?>img/ajax-loader.gif"></div>
				
                                    <!--Heading--><?php //echo strtotime($_SESSION['Auth']['User']['last_timeline_update']); die;?>
                                    <h3 class=wrdspcn style="width: 200px;float: left">Time<span>Line</span></h3>
				    <span style="float:right;"><i>Last Updated: </i>
				    <?php
				    if($date != ""){
					$date = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],$date);
					echo date('H:ia, M. d, Y',strtotime($date));
				    }else{
					echo 'N/A';
				    }
				    ?></span><br></span><br>
				    <div class="clr-b"></div>
                                    <div class="btn-wrapr">
                                        <!--
					<div class="cnnctns-actns"><input class='actionButton' id="delete" type='button' name="data[Connection][action]" value="Delete"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="activate" type='button' name="data[Connection][action]" value="Activate"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="deactivate" type='button' name="data[Connection][action]" value="Deactivate"></div>
                                        -->                                   
                                   <form action="<?php echo SITE_URL ?>timelines/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']); ?>/<?php echo $event_type; ?> " method="post" id="refineForm" name="refineForm">
                                       <!-- <i><?php echo 'Recently added activities: '.$_SESSION["Timeline"]["last_updated"]; ?></i> -->
					
					<?php /* ?>
                                        <a class="blubtn-mid" href="<?php echo SITE_URL ?>connections/import_connections/1">
                                        <input type="button" value="Sync Now" />
                                        </a>
					<?php */ ?>
					 <a class="blubtn-mid" id="blubtn-mid" href="javascript:void(0)">
					    <img class ="custom" id ="act_btn" src="<?php echo SITE_URL ?>img/delete.png" alt="Delete"/>
                                        </a>
					
					    <a class="blubtn-mid" id="blubtn-mid" href="javascript:void(0)">
						<img class ="custom" id ="con_btn" src="<?php echo SITE_URL ?>img/confirm.png" alt="Confirm"/>
                                        </a>
                                    
					<!--<a class="blubtn-mid" href="<?php echo SITE_URL ?>connections/sync_emails">-->
					<!--<a class="blubtn-mid" href="<?php echo SITE_URL ?>connections/saveEmails">-->
					  <a class="" href="<?php echo SITE_URL ?>activities/add_activity">
                                        <!--<input type="button" value="Add Activity" />-->
					<img class ="custom" id ="act_btn" src="<?php echo SITE_URL ?>img/add_activity.png" alt="Add Activity"/>
                                        </a>
					<a class="" href="<?php echo SITE_URL ?>connections/chkToken/email">
					    <!--<input type="button" value="Sync Emails" />-->
					    <img class ="custom" id ="act_btn" src="<?php echo SITE_URL ?>img/sync_email.png" alt="Sync Emails"/>
                                        </a>
					<a class="" href="<?php echo SITE_URL ?>connections/chkToken/event">
                                        <!--<input type="button" value="Sync Events" />-->
					<img class ="custom" id ="act_btn" src="<?php echo SITE_URL ?>img/sync_events.png" alt="Sync Events"/>
                                        </a>
                                   
				
					<div style="float:right;" class="slctsrch">
                                             <div class="slctbx"style="width:130px; margin: 0 0 3px;">
                                                <select id="entity_options" name="data[Timeline][entity_type]" style="padding-top:3px;">
						    <option value="all" <?php if(@$_SESSION['filter_model'] == 'all'){ ?>selected="selected"<?php } ?>>All Activities</option>
						    <option value="CalendarEvent" <?php if(@$_SESSION['filter_model'] == 'CalendarEvent'){ ?>selected="selected"<?php } ?>>Calendar Events</option>
						    <option value="ImportEmail" <?php if(@$_SESSION['filter_model'] == 'ImportEmail'){ ?>selected="selected"<?php } ?>>Emails</option>
						    <option value="UserReflection" <?php if(@$_SESSION['filter_model'] == 'UserReflection'){ ?>selected="selected"<?php } ?>>Reflections</option>
						    <option value="Activity"  <?php if(@$_SESSION['filter_model'] == 'Activity'){ ?>selected="selected"<?php } ?>>Added Activities</option>
						    <option value="Mission" <?php if(@$_SESSION['filter_model'] == 'Mission'){ ?>selected="selected"<?php } ?>>Other</option>
						</select>
						 <!--
						 All Activities <img src="<?php echo SITE_URL ?>img/arrw_down_slctcat.png" alt="" />
                                                 <div class="slctcate-drop">
                                                     <ul>
                                                         <li class="searchtype" id="name"><a href="#">Name</a></li>
                                                         <li class="searchtype" id="email"><a href="#">Email</a></li>
                                                     </ul>
                                                 </div>
						 -->
                                             </div>
                                             <!--
					     <input style="border:1px solid #ddd; float:left; padding:5px;" type="text" name="data[Search][keyword]">
                                             <input id="searchIn" type="hidden" name="data[Search][searchin]" value="">
                                             <div class="cnnctns-actns"><input type="submit" value="Search"></div>
                                             -->
					     </form>
                                        </div>
                                   
                                   </div><br/><br/>
                                   <div class="clr-b"></div>
				    
				    
				    <?php /* ?>
				    <div class="clr-b"></div>
                                    <div class="btn-wrapr">
                                        <form action="<?php echo SITE_URL ?>timelines/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>" method="post" id="searchForm" name="searchForm">
                                        <div style="float:left;" class="slctsrch">
                                             <div class="slctbx" style="width:128px !important;">
                                                 All Activities <img src="<?php echo SITE_URL ?>img/arrw_down_slctcat.png" alt="" />
                                                 <div class="slctcate-drop">
                                                     <ul>
                                                         <li class="searchtype" id="name"><a href="#">Name</a></li>
                                                         <li class="searchtype" id="email"><a href="#">Email</a></li>
                                                     </ul>
                                                 </div>
                                             </div>
                                             </form>
					</div>
				    </div>
				    <?php */ ?>
                                    <!-- Foundation Setup slider starts -->
                                    <ul id="menuaccrdn" class="menu">
					<?php /* ?><li> <a href="#">Calendar Events</a>
                                            <?php echo $this->element("timeline/calendar_events");?>
                                        </li>
				    
					<li> <a href="#">Emails</a>
                                            <?php echo $this->element("timeline/emails");?>
                                        </li>
				            <li> <a href="#">Messages</a>
                                            <?php echo $this->element("timeline/messages");?>
                                        </li>
					<li> <a href="#">Activities</a>
                                            <?php echo $this->element("timeline/activities");?>
                                        </li>
                                        <!-- Core-Elements Section- Ends-->
                                        <!-- Performance Section- Ends-->
                                        <li><a href="#">Reflections</a>
                                                              <?php echo $this->element("timeline/reflections");?>
                                        </li>
                                        <!-- Performance Section- Ends-->
                                        <!-- Bio Section- Starts-->
                                        <li> <a href="#">Connection</a>
                                            <?php echo $this->element("timeline/connections");?>
                                        </li>
                                            <!-- Bio Section- Ends-->
                                        <!-- Account Section- Starts-->
                                        <li> <a href="#">Mission</a>
                                            <?php echo $this->element("timeline/missions");?>
                                        </li>
					<?php */ ?>
					
					<li>
                                            <?php echo $this->element("timeline/alldata");?>
                                        </li>
				    </ul>
				    <!-- Foundation Setup slider starts -->
                               </section>
                               <!--Current Reflection Section End-->
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
	  
	// for gaining ids for bulk records  
	  $("#act_btn").click(function(){
	    var checkids = new Array();
	    var i =0;
	    $('.allchk').each(function () {
           if (this.checked) {
            
	     checkids += $(this).val() + ",";
	   	  
           }
	  i = i+1; 
});
	   checkids =  checkids.substr(0,checkids.length-1)
	    $.trim(checkids);
	    //alert(checkids); return false;
	    jQuery(".current-mission").addClass('blurDiv');
	    jQuery("#loaderDiv").show();
	    jQuery.ajax({
		    url: '<?php echo SITE_URL ?>timelines/delete_bulk_record/'+checkids,	
		    success: function(data){
			window.location.reload(true);
		    }
		});
	    
	  });
	  
	  
	  $("#con_btn").click(function(){
	    var checkids = new Array();
	    var i =0;
	    $('.allchk').each(function () {
           if (this.checked) {
            
	     checkids += $(this).val() + ",";
	   	  
           }
	  i = i+1; con_btn
});
	   checkids =  checkids.substr(0,checkids.length-1)
	    $.trim(checkids);
	   // alert(checkids);
	   jQuery(".current-mission").addClass('blurDiv');
	   jQuery("#loaderDiv").show();
	   
	    jQuery.ajax({
		    url: '<?php echo SITE_URL ?>timelines/confirm_bulk_record/'+checkids,	
		    success: function(data){
			window.location.reload(true);
			
		    }
		});
	    
	  });
	  
	jQuery(".custom").click(function(){
	    jQuery(".current-mission").addClass('blurDiv');
	    jQuery("#loaderDiv").show();
	});  
	
     });	  
     
    </script>
    