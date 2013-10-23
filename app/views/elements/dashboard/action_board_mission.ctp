<?php echo $this->Html->css('jquery-ui');
echo $this->Html->script(array('jquery.ui.touch-punch.min'));

$calculatedDurationPercentage = $duration_percentage;
if($calculatedDurationPercentage <0){
     $calculatedDurationPercentage = 0;
}

$calculatedConnectionCoverage = $connection_coverage;
//$connection_coverage_calc = $connection_coverage;
$connection_coverage_calc = $totalTouchesCount;
$connection_coverage_new = $totalTouchesCount;
//Slider values for general
$slider_val_for_general = 0;
$slider_val_for_general = ($elapsed_duration/$days_in_mission)*100;

//Slider values for connectivity
$slider_val_for_connectivity = 0;
$slider_val_for_connectivity = ($totalTouchesCount/$totalTargetTouches)*100;
//echo $totalTouchesCount; die;
/*Don't need the adjustment for duration now ********
if($recentMission['Mission']['progress_general'] != NULL || $recentMission['Mission']['progress_general'] != 0) 
     $duration_percentage = $recentMission['Mission']['progress_general'];
**********/

if($recentMission['Mission']['progress_connectivity'] != "" || $recentMission['Mission']['progress_connectivity'] != 0){
     $connection_coverage_new = $connection_coverage_calc+$recentMission['Mission']['progress_connectivity'];   //Adjusted Slider Value    
}
$_SESSION['Adj']['connectivity'] = $connection_coverage_new; //Needed in controller when saving dragged vals

/*===If no mission setup for user===*/
if(empty($recentMission)){
     $duration_percentage = 0; 
     $connection_coverage_new = 0;
     $days_in_mission = 0;
     $elapsed_duration = 0;
}
//echo $connection_coverage; die;

//Calculation for dot colours

$touch_for_one_day = 0;
$target_touch_till_date = 0;
$avg_touch_till_today = 0;

$touch_for_one_day = $totalTargetTouches/$days_in_mission;
$target_touch_till_date = $touch_for_one_day*(floor($elapsed_duration));
$avg_touch_till_today = ceil(($connection_coverage_new*100)/$target_touch_till_date); 

//End calc for dots colour
?>

<style>
.ui-slider .ui-slider-handle { border:none; width:16px; height:18px; top:-5px; }
.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default
{ background: url("<?php echo SITE_URL ?>css/images/circle_red.png") repeat-x scroll 50% 50%; }
.ui-widget-content { background: #aaa; }
.goal-red { background:#1b80e5; }
.crntprgrss-chek { width: 318px !important; /*height: 5px !important;*/}
.crntprgrss-goal { width: 45px !important; padding-left:10px !important; }
.mission_box{ display:none;}
#durationSliderDiv .goal-red { background:#aaa !important; }
.adjSliderSection .ui-widget-content { background:#F0AD14 !important; }
/*.adjSliderSection .crntprgrss-chek { height: 8px !important;}*/
.disableButton { opacity: 1; }

</style>

<script>
jQuery('.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default').css('background','url("gray.png") repeat-x scroll 50% 50%');

//load the cliders after 2.3 seconds of page load.
setTimeout(showBar,2000);
function showBar(){
     jQuery(".mission_box").slideDown();
}
jQuery(function() {

jQuery( "#slider-range-max" ).slider({
range: "max",
min: 0,
max: <?php echo $days_in_mission ?>,
value: <?php echo isset($elapsed_duration) ? $elapsed_duration : 0 ?>,
slide: function( event, ui ) {
return false;
}

});
jQuery( "#gp" ).html( jQuery( "#slider-range-max" ).slider( "value" ));

/****** Connectivity Slider :: Start ********/
jQuery( "#connectivity" ).slider({
range: "max",
min: 0,
max: <?php echo $totalTargetTouches ?>,
value: <?php echo isset($connection_coverage_new) ? $connection_coverage_new : 0 ?>,
slide: function( event, ui ) {
jQuery( "#cnt" ).html( ui.value );
},

change: function( event, ui ) {
    if(jQuery( "#connectivity" ).slider( "value" ) >60)
    {
        jQuery('#connectivity .ui-state-default').css('background','url("<?php echo SITE_URL ?>css/images/circle_green.png") repeat-x scroll 50% 50%');
    } else {
          if(jQuery( "#connectivity" ).slider( "value" ) > 40) {
               jQuery('#connectivity .ui-state-default').css('background','url("<?php echo SITE_URL ?>css/images/circle_yellow.png") repeat-x scroll 50% 50%');
          } else {
               jQuery('#connectivity .ui-state-default').css('background','url("<?php echo SITE_URL ?>css/images/circle_red.png") repeat-x scroll 50% 50%');
          }
    }
     $.ajax({
          url: "<?php echo SITE_URL.'missions/update_mission_progress/'.$recentMission['Mission']['id']; ?>/"+jQuery( "#cnt" ).html()+'/connectivity',
          success: function(msg) { //alert(msg);
                         //$(".loadVideo").hide();
                  
          }
    });
    
}

});
jQuery( "#cnt" ).html('<?php echo $connection_coverage_new ?>');

//Calculated value slider
jQuery( "#connectivityCalc" ).slider({
range: "max",
min: 0,
max: <?php echo $totalTargetTouches ?>,
value: <?php echo isset($totalTouchesCount) ? $totalTouchesCount : 0 ?>,
slide: function( event, ui ) {
return false;
}

});
//jQuery( "#cntCalc" ).html( jQuery( "#connectivityCalc" ).slider( "value" ));
/****** Connectivity Slider :: End ********/

//No Dots for Calculated sliders
jQuery('.calcValues .ui-state-default').css('background','none'); // No dot on slider


<?php //set default image Connectivity bar
if($avg_touch_till_today >= 100) { ?>
     jQuery('#connectivity .ui-state-default').css('background','url("<?php echo SITE_URL ?>css/images/circle_green.png") repeat-x scroll 50% 50%');
     jQuery('#con_dot_val').html(3);
<?php
} else { 
     if(($avg_touch_till_today >= 80) && ($avg_touch_till_today <= 99)) { ?>
               jQuery('#connectivity .ui-state-default').css('background','url("<?php echo SITE_URL ?>css/images/circle_yellow.png") repeat-x scroll 50% 50%');
               jQuery('#con_dot_val').html(2);
          <?php } else { ?>
               jQuery('#connectivity .ui-state-default').css('background','url("<?php echo SITE_URL ?>css/images/circle_red.png") repeat-x scroll 50% 50%');
               jQuery('#con_dot_val').html(1);
     <?php   
     }
} ?>

});
</script>
<!-----------------------------edited by anita-------------------------->
 <?php if($recentMission['Mission']['title'] != ""):?>
 <!----------------------------------------------------->
<ul class="crrntprgr-list mission_box">

     <li>
     <div style="">
         <section class="row1" id="durationSliderDiv">
             <div class=crntprgrss-name>Duration</div>
             <div class=crntprgrss-adjstcalc></div>
             <div class="crntprgrss-chek goal-red calcValues" id="slider-range-max"></div>
             <div class="crntprgrss-goal"><span><?php echo floor($elapsed_duration); ?></span></div>
         </section>
         
         <section class="row2 subrow">
             <div class=crntprgrss-name><?php echo $days_in_mission.' Days'; ?></div>
         </section>
     </div>    
         <div class="crntprgrss-actn mission-right-btn"><div class="blubtn-big blubtn_new disableButton"><input id="ideas" type="button" value=" Share &nbsp;"  /></div></div>
         
     </li>
     <li>
     <div>
        <section class="row1 adjSliderSection">
             <div class=crntprgrss-name>Connectivity</div>
             <div class=crntprgrss-adjstcalc>Adj</div>
             <div class="crntprgrss-chek conAdjVal goal-red" id="connectivity"></div>
             <div class="crntprgrss-goal""><span id="cnt"></span></div>
         </section>
         <section class="row2 subrow">
             <div class=crntprgrss-name><?php echo $totalTargetTouches.' Touches'; ?></div>
             <div class=crntprgrss-adjstcalc>Calc</div>
             <div class="crntprgrss-chek calcValues" id="connectivityCalc"></div>
             <div class=crntprgrss-goal><span id="cntCalc"><?php echo ceil($totalTouchesCount); ?></span></div>
             <div class=crntprgrss-actn></div>
             <div id="con_dot_val" style="border:1px solid red; display: none;" custom=""></div>
         </section>
     </div>
     <div class="crntprgrss-actn mission-right-btn"><div class="blubtn-big blubtn_new"><input id="contacts" type="button" value="Contact" /></div></div>
     </li>

     <div class="clr-b"></div>
     
     
     <section class="k2smnhdn" style="background: none repeat scroll 0 0 #FFF9EB; padding:8px 8px 0 8px;">Keys to success</section>
     
     <!--Subs Starts Here-->
     <?php $cnt = 0; //pr($k2sCalculated);  
     foreach($recentMission['KeyToSuccess'] as $ks_key=>$ks_val) {
          //pr($recentMission['KeyToSuccess']);
          if(array_key_exists($ks_val['id'], $k2sSpentHrs)){
               $calculatedK2sProgress = $k2sSpentHrs[$ks_val['id']];
               
               if($ks_val['progress_k2s'] == NULL || $ks_val['progress_k2s'] == 0){
                         $k2s_progress = $calculatedK2sProgress;
               }else{
                    $k2s_progress = $calculatedK2sProgress+$ks_val['progress_k2s'];
               }
               
               $_SESSION['Adj'][$ks_val["id"]] = $k2s_progress; //Needed in controller when saving dragged vals
               
               $k2s_progress_calc = $calculatedK2sProgress;
          }
         //pr($k2sCalculated); exit;
          $cnt = $cnt+1;
          $divIds = '#cnt'.$cnt;
          $divIdsCalc = '#cntCalc'.$cnt;
          
          $totalHrs = $this->requestAction('users/k2sTotalHrs/'.$ks_val["id"]);
         
          
          //Calculation for dot colours
          $k2s_hrs_for_one_day = 0;
          $target_d2s_hrs_till_date = 0;
          $avg_k2s_hrs_till_today = 0;
          
          $k2s_hrs_for_one_day = $totalHrs/$days_in_mission;
          $target_k2s_hrs_till_date = $k2s_hrs_for_one_day*(floor($elapsed_duration));
          $avg_hrs_till_today = ceil(($k2s_progress*100)/$target_k2s_hrs_till_date); 
          //End calc for dots colour
          
     ?>
         <!--<li class=sub-prgrss>-->
         <li class="sublistngcnt">
         <div>
            <!--<section class="k2smnhdn">Keys to success</section>-->
            <section class="row1 adjSliderSection">
               <div class=crntprgrss-name>
                    <?php 
                         if(strlen($ks_val['description']) <=20){
                              echo $ks_val['description'];  
                         } else{
                              echo substr($ks_val['description'],0,20).'...';     
                         }
                    ?>
               </div>
                 <div class=crntprgrss-adjstcalc>Adj</div>
                 <div class="crntprgrss-chek adjValues" id="cnt<?php echo $cnt ?>" custom="<?php echo $ks_val['id'] ?>"></div>
                 <div class=crntprgrss-goal><span id="keyVal<?php echo $cnt ?>"><?php echo $k2s_progress; ?></span></div>
             </section>
            <section class="row2 subrow">
                 <div class=crntprgrss-name><?php echo round($totalHrs).' Hrs'; ?></div>
	             <div class=crntprgrss-adjstcalc>Calc</div>
                 <div class="crntprgrss-chek calcValues" id="cntCalc<?php echo $cnt ?>"></div>
                 <div class=crntprgrss-goal><span><?php echo $calculatedK2sProgress ?></span></div>
                 <div class=crntprgrss-actn>&nbsp;</div>
                 <div class="k2s_hid_val" id="<?php echo $ks_val['id']; ?>" style="border:1px solid red; display: none;" custom="">10</div>
             </section>
         </div>
         
         <div class="crntprgrss-actn mission-right-btn"><div class="blubtn-big blubtn_new disableButton"><input class="send_note" id="ks_id<?php echo $ks_val['id']; ?>" custom="<?php echo $ks_val['id'] ?>" type="button" value="Take Action"/></div></div>
         
         </li>
         
     <script>
     //alert("<?php echo $totalHrs ?>");
     //jQuery("<?php echo $divIds ?>").css('border','1px solid green');
     
     
     var divId = "<?php echo $divIds ?>";
     var styleDivClass = divId+' .ui-slider-handle';
     //alert(styleDivClass);
     
     /**** Slider for K2S ***/
     jQuery(divId).slider({
     range: "max",
     min: 0,
     max: <?php echo $totalHrs ?>,
     value: <?php echo $k2s_progress; ?>,
     slide: function( event, ui ) {
     jQuery( "#keyVal<?php echo $cnt ?>" ).html( ui.value );
     },
     
     change: function( event, ui ) {
          $.ajax({
          url: "<?php echo SITE_URL.'missions/update_mission_progress/'.$ks_val['id']; ?>/"+jQuery( "#keyVal<?php echo $cnt ?>" ).html()+'/k2s',
          success: function(msg) { //alert(msg);
                         //$(".loadVideo").hide();
          }
      });
     }
     
     });
     <?php //set default circle imaage based on k2s progress
     if($avg_hrs_till_today >= 100) { ?>
          jQuery(divId+' a.ui-slider-handle').css('background','url("<?php echo SITE_URL ?>css/images/circle_green.png") repeat-x scroll 50% 50%');
          var k2sid = '<?php echo '#'.$ks_val['id'] ?>';
          jQuery(k2sid).html(3);
          
     <?php
     } else { 
          if(($avg_hrs_till_today >= 80) && ($avg_hrs_till_today <= 99)) { ?>
               jQuery(divId+' a.ui-slider-handle').css('background','url("<?php echo SITE_URL ?>css/images/circle_yellow.png") repeat-x scroll 50% 50%');
               var k2sid = '<?php echo '#'.$ks_val['id'] ?>';
               jQuery(k2sid).html(2);
          <?php } else { ?>
               jQuery(divId+' a.ui-slider-handle').css('background','url("<?php echo SITE_URL ?>css/images/circle_red.png") repeat-x scroll 50% 50%');
               var k2sid = '<?php echo '#'.$ks_val['id'] ?>';
               jQuery(k2sid).html(1);
     <?php   
     } }
?>
     jQuery( "#keyVal<?php echo $cnt ?>" ).html( jQuery( divId ).slider( "value" ));
     
     
     //Slider for Calculated value
     var divIdCalc = "<?php echo $divIdsCalc ?>";
     jQuery(divIdCalc).slider({
     range: "max",
     min: 0,
     max: <?php echo $totalHrs ?>,
     value: <?php echo $k2s_progress_calc; ?>,
     slide: function( event, ui ) {
          return false;
     }
     });
     
     </script>    
     <?php
     } ?>
</ul>

<!------------------- edited by anita------------------------------------------------------------->
<?php else: ?>
  <div style="width:691px; height:30px;text-align:center;padding-top:14px; ">No Mission Activated</div>
<?php endif;?>
<!------------------------->
<script>
jQuery(document).ready(function(){
     jQuery("#connectivity .ui-slider-handle").hover(function(){
        
               //alert(jQuery(this).parent().next().children().html());
               var cur_val = jQuery(this).parent().next().children().html();
               var target_till_date = '<?php echo $target_touch_till_date ?>';
               var avg_till_date = (cur_val*100)/target_till_date;
                              
               
               if(avg_till_date >= 100) {
                    jQuery(this).css('background','url("<?php echo SITE_URL ?>css/images/circle_green.png") repeat-x scroll 50% 50%');
                    jQuery('#con_dot_val').html(3);
               } else {
                    if((avg_till_date >= 80) && (avg_till_date <= 99)) {
                         jQuery(this).css('background','url("<?php echo SITE_URL ?>css/images/circle_yellow.png") repeat-x scroll 50% 50%');
                         jQuery('#con_dot_val').html(2);
                    } else {
                         jQuery(this).css('background','url("<?php echo SITE_URL ?>css/images/circle_red.png") repeat-x scroll 50% 50%');
                         jQuery('#con_dot_val').html(1);
                    }
               } 
          });
         
     jQuery(".adjValues .ui-slider-handle").hover(function(){ 
               var cur_val_k2s = jQuery(this).parent().next().children().html();
               var total_target = (jQuery(this).parent().parent().next().children().html()).replace(/\D/g, '');
               var k2s_for_one_day = total_target/<?php echo $days_in_mission ?>;
               var elapsed_mission = <?php echo $elapsed_duration ?>;
               var target_till_date_k2s =   k2s_for_one_day*elapsed_mission;             
               var avg_till_date_k2s = (cur_val_k2s*100)/target_till_date_k2s;
               
               var dragk2sid = '#'+jQuery(this).parent().attr('custom');
               
               if(avg_till_date_k2s >= 100) {
                    jQuery(this).css('background','url("<?php echo SITE_URL ?>css/images/circle_green.png") repeat-x scroll 50% 50%');
                    jQuery(dragk2sid).html(3);
               } else {
                    if((avg_till_date_k2s >= 80) && (avg_till_date_k2s <= 99)) {
                         jQuery(this).css('background','url("<?php echo SITE_URL ?>css/images/circle_yellow.png") repeat-x scroll 50% 50%');
                         jQuery(dragk2sid).html(2);
                    } else {
                         jQuery(this).css('background','url("<?php echo SITE_URL ?>css/images/circle_red.png") repeat-x scroll 50% 50%');
                         jQuery(dragk2sid).html(1);
                    }
               }
          });
});
     
</script>