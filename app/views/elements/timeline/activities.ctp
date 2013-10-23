<!--Current Activities Section Starts-->
    <ul class=manag-actvty>
	<?php //pr($activityList); exit;
	if(empty($activityList)){ ?>
	     <li style="text-align:center;">No activities found.</li> 
	<?php } else { 
	     //pr($conLists); exit; ?>
	    
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
		  echo $activity['Activity']['start_time'].' To '.$activity['Activity']['start_time'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
   
	    </section>
	    <section class="mng-rtng">
		<?php if($activity['Activity']['rating'] != '') { ?>
		    <div class="dbRefRate" id="rating_div<?php echo $i; ?>"></div>
		<?php
		} else {
		    echo 'N/A';
		}
		?>
		 
	    </section>
	</li>
	<?php } } ?>
    </ul>
<!--Current Activities Section End-->