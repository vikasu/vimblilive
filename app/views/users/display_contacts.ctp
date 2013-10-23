
<!--Current Mission Section Starts-->
<section class="current-mission manggrpdsbrd" style="position:relative;">
     <ul class=manag-actvty>
	 <?php //pr($conLists); exit;
	 if(empty($conLists)){ ?>
	      <li style="text-align:center;">No connection found.</li> 
	 <?php } else { 
	      //pr($conLists); exit; ?>
	  <input id="connection-group" type="hidden" name="data[ConGroupRelation][group_id]" value="">
	     
	  <?php   
	 foreach($conLists as $connection) { ?>
	 <li>
	     <section class="mng-actvty connctn_name">
		<?php
		if($connection['Connection']['name'] != ''){ ?>
		<a href="<?php echo $this->Html->url(array('controller'=>'connections','action'=>'connection_detail',base64_encode($connection['Connection']['id']))); ?>" class="fl-l"><?php echo $connection['Connection']['name']; ?></a>
		<?php //pr($connectionIds); exit;
		if(array_key_exists($connection['Connection']['id'], $connectionIds)){
		    // echo '  '.$this->Html->image($connectionIds[$connection['Connection']['id']].'-icon.png', array('height'=>'20', 'width'=>'20', 'title'=>'Contact once more'));
		?>
		<span class="num_bg"> <?php echo $connectionIds[$connection['Connection']['id']]; ?></span>
            <?php
            }    
		} else {
		    echo 'N/A';
	      }
	      ?>
	     </div></section>
	     <section class="mng-time"><?php
			 $contactEmail = '';
			if(!empty($connection['ConnectionEmail'])) {
			
			 foreach($connection['ConnectionEmail'] as $email):
				 $contactEmail = $contactEmail.$email['email'].', ';
			 endforeach;
			 $email_display = substr($contactEmail,0,strlen($contactEmail)-2);
			 echo $this->Html->link($email_display, array('controller'=>'messages', 'action'=>'send_new_message', base64_encode($connection['Connection']['id']),base64_encode($email['email'])));
			} else {
			     echo 'N/A';
			}
		    ?></section>
	     <section class="mng-rtng">
		   <?php $contactNum = '';
			if(!empty($connection['ConnectionPhone'])){
			 
			 foreach($connection['ConnectionPhone'] as $phone):
				 $contactNum = $contactNum.$phone['phone'].', ';
			 endforeach;
			 $phone_display = substr($contactNum,0,strlen($contactNum)-2); 
			  echo $phone_display; 
		   } else {
			echo 'N/A';
		   }
		   ?>
	     </section>
	 </li>
	 <?php }
	 } ?>
     </ul>
     <!--Select De-Select Blue Button-->
</section>
<!--Current Mission Section End-->