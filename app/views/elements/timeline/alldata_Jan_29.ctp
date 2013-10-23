<?php //pr($activityList);  die; ?>
<style>
ul.menu li ul li a { font-weight:normal !important; padding-left:0px !important; padding-top:0px !important; padding-right:5px !important; font-family: arial !important; word-spacing:0 !important; }
ul.menu li ul li a:hover { border-left: none !important; }
.crntrflctn li .crntprgrss-actn img { margin:0px !important;}
.image_icon { padding:5px; float:left;}
.mng-rtng { word-wrap: break-word;}
.crntprgrss-actn a { float: left !important; }
.mng-time {
    width: 165px!important;
}
</style>

<!--Current Activities Section Starts-->
    <ul class="manag-actvty crrntprgr-list crntrflctn">
     <?php
     if(empty($activityList) && empty($recentReflections) && empty($missionDetail) && empty($calendarEvents) && empty($allEmails)){
	  echo '<li>No records found.</li>';
     } else { ?>
     
     <!------ Activities Data ------->
	<?php  $i = 0;  
	foreach($activityList as $activity) {
	     $i = $i+1; ?>
	    <script>
	    jQuery(function() {
		var refId = <?php echo $i ?>;
		var starDivId = '#rating_div'+refId; 
		jQuery(starDivId).raty({
		    score    : <?php echo $activity['Activity']['rating']; ?>,
		    path: "<?php echo SITE_URL ?>/img",
		    scoreName: 'data[Activity][rating]',
		    number:5,
		    entity_id: '<?php echo $activity['Activity']['id']; ?>',
		    rating_id : '<?php echo $activity['Activity']['id']; ?>'
		    });
	    });
	    </script>
	
	<li>
	    <section class="mng-actvty">
	       <?php if($activity['Activity']['title'] != ''){
		  echo $html->link($activity['Activity']['title'],array('controller'=>'activities','action'=>'activity_detail',base64_encode($activity['Activity']['id'])));
		  //echo $connection['Connection']['name'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
	    </div></section>
	    <section class="mng-time">
	    <?php if($activity['Activity']['start_time'] != '' || $activity['Activity']['end_time'] != ''){
		  echo $activity['Activity']['start_time'].' To '.$activity['Activity']['end_time'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
	     
	       
	    </section>
	    <section class="mng-rtng" id="actRateContainer">
		<?php if($activity['Activity']['rating'] != '') { ?>
		    <div class="dbRefRate" id="rating_div<?php echo $i; ?>"></div>
		<?php
		} else {
		    echo 'N/A';
		}
		?>
		 
	    </section>
	    <section class="crntprgrss-actn">
	        <a href="<?php echo SITE_URL ?>activities/activity_detail/<?php echo base64_encode($activity['Activity']['id']) ?>"><img src="<?php echo SITE_URL ?>img/activity_icon.png"class="image_icon" title="Activity" alt="Activity"> </a>
	       <a href="<?php echo SITE_URL ?>activities/add_activity/<?php echo base64_encode($activity['Activity']['id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="" title="Profile" /></a>
	       <a href="<?php echo SITE_URL ?>timelines/delete_record/Activity/<?php echo base64_encode($activity['Activity']['id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Message List" /></a>
	    </section>
	</li>
	<?php } ?>
     
	<!------ Reflection Data ------->
	 <?php $i = 0;
	foreach($recentReflections as $row){
	$i = $i+1;
	
	//Avg rating
	//$avgRate = ($row['UserReflection']['ans_1']+$row['UserReflection']['ans_2']+$row['UserReflection']['ans_3']+$row['UserReflection']['rating_today']+$row['UserReflection']['rating_tomorrow'])/5; 	
	
	?>
	<script>
	    jQuery(function() {
		var refId = <?php echo $i ?>;
		var starDivId = '#refrating_id'+refId; 
		jQuery(starDivId).raty({
		    score    : '<?php echo $row['UserReflection']['rating_today'] ?>',
		    path: "<?php echo SITE_URL ?>/img",
		    entity_id: '<?php echo $row['UserReflection']['id']; ?>',
		    rating_id : '<?php echo 'ref'.$row['UserReflection']['id']; ?>'
		    });
	    });
	</script>
	
	<li><section class="mng-actvty" style="padding:5px">
	    <div class="dbRefDate" style="width:220px;">
	    <a href="<?php echo SITE_URL ?>reflections/reflection_detail/<?php echo base64_encode($row['UserReflection']['id']) ?>">
	       <?php echo substr($row['UserReflection']['description'],0,80); ?>...
	    </a>
	    </div></section>
	    <section class="mng-time"><div class="dbRefDesc"><?php echo $row['UserReflection']['reflection_date']; ?></div></section>
	    <section class="mng-rtng" id="refRateContainger" style="padding:0 10px 0 22px;"><div class="dbRefRate reflectionRating" id="refrating_id<?php echo $i; ?>"></div></section>
	    
	    <section class="crntprgrss-actn">
	       <a href="<?php echo SITE_URL ?>reflections/reflection_detail/<?php echo base64_encode($row['UserReflection']['id']) ?>"><img src="<?php echo SITE_URL ?>img/reflection_icon.png"class="image_icon" title="Reflection" alt="Reflection"></a>
	       <a href="<?php echo SITE_URL ?>reflections/edit_reflection/<?php echo base64_encode($row['UserReflection']['id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="" title="Profile" /></a>
	       <a href="<?php echo SITE_URL ?>timelines/delete_record/UserReflection/<?php echo base64_encode($row['UserReflection']['id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Message List" /></a>
	    </section>
	    
	 </li>
	<?php } ?>
	
	
	<!------ Mission Data ------->
	<?php if(!empty($missionDetail)){ ?>
    <li>
     <section class="mng-actvty">
	  <a href="<?php echo SITE_URL ?>missions/view/<?php echo base64_encode($missionDetail['Mission']['id']) ?>">
	       <?php echo $missionDetail['Mission']['title']; ?>
	  </a>
     </section>
     <section class="mng-time">
	  <?php if($missionDetail['Mission']['start_time'] != '' || $missionDetail['Mission']['end_time'] != ''){
		  echo $missionDetail['Mission']['start_time'].' To '.$missionDetail['Mission']['end_time'];
	     } else {
		  echo 'N/A';
	     }
	     ?>		
     </section>
         <section class="mng-rtng">
               <?php echo $missionDetail['Mission']['frequency']; ?>
         </section>
	 
     <section class="crntprgrss-actn">
	         <a href="<?php echo SITE_URL ?>missions/view/<?php echo base64_encode($missionDetail['Mission']['id']) ?>"><img src="<?php echo SITE_URL ?>img/mission_icon.png"class="image_icon" title="Mission" alt="Mission"></a>
	       <a href="<?php echo SITE_URL ?>missions/current_mission_setup/<?php echo base64_encode($missionDetail['Mission']['id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="" title="Profile" /></a>
	       <a href="<?php echo SITE_URL ?>timelines/delete_record/Mission/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Message List" /></a>
	  </section>
	 
        
   </li>
   <?php } ?>
          
	
	<!------ Connection Data ------->
<?php /* ?>
	<?php   
     foreach($conLists as $connection) { ?>
     <li>
         <section class="mng-actvty">
	  <?php if($connection['Connection']['name'] != ''){
               echo $html->link($connection['Connection']['name'],array('controller'=>'connections','action'=>'connection_detail',base64_encode($connection['Connection']['id'])));
               //echo $connection['Connection']['name'];
          } else {
               echo 'N/A';
          }
          ?>
         </div></section>
         <section class="mng-time">
		<?php $contactNum = '';
                    if(!empty($connection['ConnectionPhone'])){
                     
                     foreach($connection['ConnectionPhone'] as $phone):
                             $contactNum = $contactNum.$phone['phone'].', ';
                     endforeach;
                     echo substr($contactNum,0,strlen($contactNum)-2);
               } else {
                    echo 'N/A';
               }
               ?>
	       </section>
         <section class="mng-rtng">
               <?php
                     $contactEmail = '';
                    if(!empty($connection['ConnectionEmail'])) {
                    
                     foreach($connection['ConnectionEmail'] as $email):
                             $contactEmail = $contactEmail.$email['email'].', ';
                     endforeach;
                     echo substr($contactEmail,0,strlen($contactEmail)-2);
                    } else {
                         echo 'N/A';
                    }
                ?>
         </section>
	 
	 <section class="crntprgrss-actn">
	          <a href="<?php echo SITE_URL ?>connections/connection_detail/<?php echo base64_encode($connection['Connection']['id']) ?>"><img src="<?php echo SITE_URL ?>img/connection_icon.png"class="image_icon" title="Connections" alt="Connections"></a>
               <a href="<?php echo SITE_URL ?>connections/add_connection/<?php echo base64_encode($connection['Connection']['id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="" title="Profile" /></a>
	       <a href="<?php echo SITE_URL ?>timelines/delete_record/Connection/<?php echo base64_encode($connection['Connection']['id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Message List" /></a>
	  </section>
	 
      </li>
     <?php } ?>

<?php */ ?>

     <!----- Event data --->
	 <?php
	 //pr($calendarEvents); die;
	 $i = 0;  
	foreach($calendarEvents as $events) {
	     $i = $i+1; ?>
	
	<li>
	    <section class="mng-actvty">
	     <?php if($events['CalendarEvent']['title'] != ''){
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
	    
	    <section class="crntprgrss-actn">
	          <img src="<?php echo SITE_URL ?>img/event_icon.png"class="image_icon" title="Calendar Events" alt="Calendar Events">
	       <a href="<?php echo SITE_URL ?>timelines/delete_record/CalendarEvent/<?php echo base64_encode($events['CalendarEvent']['id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Message List" /></a>
	    </section>
	  
	</li>
	<?php } ?>
	
	<!------ Email Data ------->
	<?php  $i = 0;  
	foreach($allEmails as $email) {
	     $i = $i+1; ?>
	    
	
	<li>
	    <section class="mng-actvty">
	     <?php if($email['ImportEmail']['email_subject'] != ''){
		  echo $html->link($email['ImportEmail']['email_subject'],array('controller'=>'timelines','action'=>'email_detail',base64_encode($email['ImportEmail']['id'])));
	     } else {
		  echo 'N/A';
	     }
	     ?>
	    </div></section>
	    <section class="mng-time">
	    <?php if($email['ImportEmail']['email_date'] != ''){
		  echo $email['ImportEmail']['email_date'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
   
	    </section>
	    <section class="mng-rtng">
		<?php if($email['ImportEmail']['email_from'] != ''){
		  echo $email['ImportEmail']['email_from'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
		 
	    </section>
	    
	    <section class="crntprgrss-actn">
	          <a href="<?php echo SITE_URL ?>timelines/email_detail/<?php echo base64_encode($email['ImportEmail']['id']) ?>"><img src="<?php echo SITE_URL ?>img/email_icon.png"class="image_icon" title="Emails" alt="Emails"></a>
	       <a href="<?php echo SITE_URL ?>timelines/delete_record/ImportEmail/<?php echo base64_encode($email['ImportEmail']['id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Message List" /></a>
	    </section>
	    
	</li>
	<?php } ?>

<?php /* ?>	
	<!------ Message Data ------->
	<?php  $i = 0;  
	foreach($allMessages as $message) {
	     $i = $i+1; ?>
	    
	<li>
	    <section class="mng-actvty">
	     <?php if($message['Message']['subject'] != ''){
		  echo $html->link(htmlspecialchars_decode($message['Message']['subject']),array('controller'=>'timelines','action'=>'message_detail',base64_encode($message['Message']['id'])));
		  //echo $connection['Connection']['name'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
	    </div></section>
	    <section class="mng-time">
	       <?php if($message['Message']['created'] != '') {
		      echo $message['Message']['created'];
		 } else {
		    echo 'N/A';
		}
		?>
	    </section>
	    <section class="mng-rtng">
		
		<?php if($message['Message']['content'] != ''){
		  echo htmlspecialchars_decode($message['Message']['content']);
	     } else {
		  echo 'N/A';
	     }
	     ?>
		 
	    </section>
	    
	    <section class="crntprgrss-actn">
	        <a href="<?php echo SITE_URL ?>timelines/message_detail/<?php echo base64_encode($message['Message']['id']) ?>"><img src="<?php echo SITE_URL ?>img/message_icon.png"class="image_icon" title="Messages" alt="Messages"></a>
	       <a href="<?php echo SITE_URL ?>timelines/delete_record/Message/<?php echo base64_encode($message['Message']['id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Message List" /></a>
	    </section>
	    
	</li>
	<?php } ?>
<?php */ ?>	
	
<?php } ?>	
    </ul>
<!--Current Activities Section End-->