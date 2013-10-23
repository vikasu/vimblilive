<!--Current Activities Section Starts-->
    <ul class=manag-actvty>
	<?php //pr($activityList); exit;
	if(empty($allEmails)){ ?>
	     <li style="text-align:center;">No events found.</li> 
	<?php } else { 
	     //pr($allEmails); exit; ?>
	    
	 <?php  $i = 0;  
	foreach($allEmails as $email) {
	     $i = $i+1; ?>
	    
	
	<li>
	    <section class="mng-actvty">
	     <?php if($email['ImportEmail']['email_subject'] != ''){
		  echo $html->link($email['ImportEmail']['email_subject'],array('controller'=>'timelines','action'=>'email_detail',base64_encode($email['ImportEmail']['id'])));
		  //echo $connection['Connection']['name'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
	    </div></section>
	    <section class="mng-time">
	    <?php if($email['ImportEmail']['email_from'] != ''){
		  echo $email['ImportEmail']['email_from'];
	     } else {
		  echo 'N/A';
	     }
	     ?>
   
	    </section>
	    <section class="mng-rtng">
		<?php if($email['ImportEmail']['source'] != '') {
		    if($email['ImportEmail']['source'] == 1)
			echo 'Gmail';
		    elseif($email['ImportEmail']['source'] == 2)
			echo 'Yahoo';
		    elseif($email['ImportEmail']['source'] == 3)
			echo 'Hotmail';
		     else
			echo 'Unrecognized';
		 } else {
		    echo 'N/A';
		}
		?>
		 
	    </section>
	</li>
	<?php } } ?>
    </ul>
<!--Current Activities Section End-->