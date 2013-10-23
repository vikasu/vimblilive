<!--Current Activities Section Starts-->
    <ul class=manag-actvty>
	<?php //pr($activityList); exit;
	if(empty($allMessages)){ ?>
	     <li style="text-align:center;">No message found.</li> 
	<?php } else { 
	     //pr($allEmails); exit; ?>
	    
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
	    <?php if($message['Message']['content'] != ''){
		  echo htmlspecialchars_decode($message['Message']['content']);
	     } else {
		  echo 'N/A';
	     }
	     ?>
   
	    </section>
	    <section class="mng-rtng">
		<?php if($message['Message']['created'] != '') {
		      echo $message['Message']['created'];
		 } else {
		    echo 'N/A';
		}
		?>
		 
	    </section>
	</li>
	<?php } } ?>
    </ul>
<!--Current Activities Section End-->