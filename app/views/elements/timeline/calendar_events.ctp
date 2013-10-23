<!--Current Activities Section Starts-->
    <ul class=manag-actvty>
	<?php //pr($activityList); exit;
    	if(empty($calendarEvents)){ ?>
	     <li style="text-align:center;">No events found.</li> 
	<?php } else { 
	     //pr($calendarEvents); exit; ?>
	    
	 <?php  $i = 0;  
	foreach($calendarEvents as $events) {
	     $i = $i+1; ?>
	    
	
	<li>
	    <section class="mng-actvty">
	     <?php if($events['CalendarEvent']['title'] != ''){
		  //echo $html->link($events['CalendarEvent']['title'],array('controller'=>'activities','action'=>'activity_detail',base64_encode($events['CalendarEvent']['id'])));
		  echo $events['CalendarEvent']['title'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
	    </div></section>
	    <section class="mng-time">
	    <?php if($events['CalendarEvent']['start_time'] != '' || $events['CalendarEvent']['end_time'] != ''){
		  echo $events['CalendarEvent']['start_time'].' To '.$events['CalendarEvent']['start_time'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
   
	    </section>
	    <section class="mng-rtng">
		<?php if($events['CalendarEvent']['creator_display_name'] != '') {
		    echo $events['CalendarEvent']['creator_display_name'].' ('.$events['CalendarEvent']['creator_email'].')';
		 } else {
		    echo 'N/A';
		}
		?>
		 
	    </section>
	</li>
	<?php } } ?>
    </ul>
<!--Current Activities Section End-->