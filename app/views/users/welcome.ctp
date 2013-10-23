<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    echo $this->Html->script('jquery.qtip-1.0.0-rc3.min');?>
<script type="text/javascript">
jQuery(document).ready(function(){
 
    jQuery('.toggle_all_sec').click(function(){
        
        jQuery('.all_sections').toggle("slow");
    });
    
   
   
jQuery('#ideas').qtip({
   content: {
    text: '<textarea style="height:158px;font-size: 14px;width:234px;"readonly>Need to make adjustments before drafting your progress report?\n\nMove the color dots or edit the events in your timeline.\n\nREADY Hit Send and check your email ...</textarea><br><div class="blubtn-small disableButton" style="margin-left:60px;"><input  type="button" value="SEND" id="send_sponsor_email" style="padding-bottom:2px; width:66px;"  /></div>',
    title: {
            text: 'Message to Sponsor',
            button: 'X' // Close button
            }
    },
    show: {
    when: 'click',
    delay: 100
   },
   hide: 'mousedown',
   tip: 'topLeft',
   position: { corner: { target: 'topLeft', tooltip: 'middleRight' }, adjust: { x: 10, y: 10 } }
})

//open qtip to show all ideas
    jQuery(".send_note").each(function() {
    jQuery(this).qtip({
	
	content: {
	text: '<img src="loading.gif" alt="loading" />',
	url: '<?php echo SITE_URL; ?>users/display_ideas',
	data: {id:jQuery(this).attr('custom')},
            title: {
            text: 'Upcoming Events',
            button: 'X' // Close buttonfgr
            }
	},
        show: {
            when: 'click',
            delay: 100
        },
   	hide: 'mousedown',
	tip: 'topLeft',
        style:
{
width:300
},
        position: { corner: { target: 'topLeft', tooltip: 'middleRight' }, adjust: { x: 10, y: 10 } }
    });
    });
    
//open qtip to show all ideas
    jQuery('#contacts').qtip({
	content: {
	text: '<img src="loading.gif" alt="loading" />',
	url: '<?php echo SITE_URL; ?>users/display_contacts/',
            title: {
            text: 'My Connections',
            button: 'X' // Close button
            }
	},
        show: {
            when: 'click',
            delay: 100
        },
   	hide: 'mousedown',
	tip: 'topLeft',
        style:
{
width:300
},
        position: { corner: { target: 'topLeft', tooltip: 'middleRight' }, adjust: { x: 10, y: 10 } }
    });
    
/*
    //check session and run immediate fetch
    var immediate_fetch = "<?php //echo $_SESSION['Connection']['immediate_fetch'] ?>";
    if(immediate_fetch == 1){
	$.ajax({                    
                    url: "<?php //echo SITE_URL ?>connections/immediate_fetch",
                    success: function(msg){
                            
                        }
                });
    }
*/    

jQuery("#send_sponsor_email").live('click',function(){
     var param_for_url = jQuery("#con_dot_val").html();
     var k2s_vals = '';
    jQuery(".k2s_hid_val").each(function(){
	k2s_vals=k2s_vals+jQuery(this).attr('id')+'='+jQuery(this).html()+';';
    });
    //k2s_vals=55;
     jQuery.ajax({
          url: "<?php echo SITE_URL ?>missions/send_DB_email/"+param_for_url+"/"+k2s_vals,
          success: function(msg) { //alert(msg);
                         jQuery("#ideas").qtip("api").hide();
			 jQuery("#msgDiv").show();
			 jQuery("#msgDiv").fadeOut(8000);
	  } 
    });
});

  
});
</script>
<style>
.num_bg { float:right !important; }
.blurDiv { opacity: 0.6; }
#loaderDiv { display: none; position: absolute; top: 260px; left: 550px; 
</style>
 <!--Center Align Inner Content Section Starts-->
    <section class="content-pane about-pane">
    
	<div id="loaderDiv"><img src="<?php echo SITE_URL ?>img/ajax-loader.gif"></div>
    
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
                               <h3 class="hwdtwrks dshbrd dshbrd_small_icon">My <span>Status</span></h3>
                           </a>
                           <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash();
				
				if($this->Session->flash('auth') != "You are not authorized to access that location."){
				    echo $this->Session->flash('auth');
				}
				?>
                          <?php echo $this->Element('/dashboard/myRating');?>
                           
                           <!--Right Panel Starts-->
                           <section class="dshbrd-right dshbrd-right-new">
                            <div id="msgDiv" class="flash_success" style="display: none;">Check your email for the update. Make final edits and share with your sponsor(s).</div>
                            
			    
                              
                            
                               <!--Current Mission Section Starts-->
                               <section class="bottom_sprtr current-mission">
			      
                                    <h3>
                                       <div class="crrnthdng">current <span>mission</span></div>
					<div class="acgvtrgt" style="width:340px;">
					
					    <?php
						if($recentMission['Mission']['title'] != ""){
						    if(strlen($recentMission['Mission']['title']) <=23){
							    echo $recentMission['Mission']['title'];  
						    } else{
							    echo substr($recentMission['Mission']['title'],0,23).'...';     
						       }
						}else{
						    echo 'N/A';
						}
					    ?>
					    <!--<img src="<?php echo SITE_URL ?>css/images/mission_notification_icon.png" alt="" />-->
					</div>
                                    <?php if($recentMission['Mission']['id'] != ""){ ?>
				    <div class="addimprt-btns mission_box">
                                        <a class="yllwbtn-mid ylw_btn_lrg" href="<?php echo SITE_URL ?>missions/view_recent_mission/<?php echo base64_encode($recentMission['Mission']['id']) ?>">
                                        <input type="button" value="View/Edit Mission" />
                                        </a>
                                    </div>
				    <?php } else{ ?>
					<div class="addimprt-btns mission_box">
					    <?php if($sharedMissionCount != 0){ ?>
						<a class="yllwbtn-mid" href="<?php echo SITE_URL ?>missions/shared_mission">
					    <?php } else{ ?>
						<a class="yllwbtn-mid" href="<?php echo SITE_URL ?>missions/current_mission_setup">
					    <?php } ?>
					    <input type="button" value="Start A Mission" />
					    </a>
					</div>
				    <?php } ?>
				    
                                    </h3>
                                    <div class="clr-b"></div>
                                    <?php echo $this->element("dashboard/action_board_mission");?>
                               </section>
                               <!--Current Mission Section End-->
                               <!--<a href="#" class="toggle_all_sec"  style="background: #DDDDDD; color: #1560AC;
    padding: 10px 0 10px 10px; margin: 10px 0 10px 0; float:left; width:680px; font-weight:bold;" /> Execution </a>-->
                               <div class="all_sections"  style="display:block; float:left; width:100%;" >
                               <!--Balance Area Starts-->
                               <section class="balance-pane graybg no_bg no_mrgn">
                                    <?php echo $this->element("dashboard/action_board_balance");?>
                               </section>
			  
			       <div class="schedule_box" style="float:left; width: 100%; text-align: center; padding-bottom: 8px;">
				    <form method="Post" action="<?php echo SITE_URL ?>timelines/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>">
					<input type="hidden" name="data[Timeline][entity_type]" value="CalendarEvent">
					<!--<div class="blubtn-small"><input id="take_action" type="submit" value="Review &nbsp; the &nbsp; past &nbsp; 7 &nbsp; days" /></div>-->
					<span class="blubtn-big blubtn_new"><input type="submit" value="Review past week"/></span>
				    </form>
			       </div>
			       <div class="bottom_sprtr schedule_box" style="float:left; width: 100%; text-align: center;">
				    <?php if($_SESSION['Auth']['User']['calendar_path'] != ""){ ?>
					<a href="<?php echo trim($_SESSION['Auth']['User']['calendar_path']) ?>" target="_blank">
				    <?php } else{?>
					<a href="https://www.google.com/calendar" target="_blank">
				    <?php } ?>
					<!--<div class="blubtn-small"><input type="button" value="Shape &nbsp; the &nbsp; next &nbsp; 7 &nbsp; days" /></div>-->
					<span class="blubtn-big blubtn_new"><input type="submit" value="Review next week" /></span>
				    </a>
			       </div>
			       
			       <div style="clear: both"></div>
                               <!--Balance Area End-->
                               <!--Cadence Starts-->
                               <!--<section class="balance-pane">
                                    <?php //echo $this->element("dashboard/action_board_cadence");?>
                               </section>-->
                               <!--Cadence Starts-->
                               <!--Recent Reflections Section Starts-->
                               <section class="no_bg current-mission crrntrflctn graybg no_mrgn padd_topn">
                                    <?php echo $this->element("dashboard/action_board_reflection");?>
                               </section>
                               <!--Recent Reflections Section End-->
                               </div>
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
    
<?php $_SESSION['Connection']['immediate_fetch'] == 0; ?>