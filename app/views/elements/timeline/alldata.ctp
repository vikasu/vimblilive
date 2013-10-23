
<style>
ul.menu li ul li a { font-weight:normal !important; padding-left:0px !important; padding-top:0px !important; padding-right:5px !important; font-family: arial !important; word-spacing:0 !important; }
ul.menu li ul li a:hover { border-left: none !important; }
.crntrflctn li .crntprgrss-actn img { margin:0px !important;}
.image_icon { padding:5px; float:left;}
.mng-rtng { word-wrap: break-word; width: 90px;}
.crntprgrss-actn a { float: left !important; }
.mng-time {
    width: 120px !important;
}
.mng-actvty {
    width: 300px !important;
}



.paging_full_numbers span a {
    background: url("images/buttonbg5.png") repeat-x scroll left top #EEEEEE !important;
    border: 1px solid #CCCCCC !important;
    border-radius: 3px 3px 3px 3px !important;
    color: #000000 !important;
    cursor: pointer !important;
    display: inline-block !important;
    margin-left: 5px !important;
    padding: 2px 8px !important;
    font-family: 'Arial' !important;
}

.tymlynlyst .image_icon { padding:0; }
.tymlynlyst .crntprgrss-actn a { padding:0 !important; }
ul.menu .tymlynlyst li { border-bottom:1px solid #EDEDED; } 
.tymlynlyst .crntprgrss-actn a img { margin-left:5px !important; }
.separate { margin-right:20px;}
</style>

<script>
 function confirmDelete(){
	//alert('hell0'); return false;
    var agree=confirm("Are you sure you want to delete this record?");
    alert(agree); return false;
    if(agree)
	 return true;
    else
	 //return false;
	  location.reload(); 	  
    }
</script>

<!--Current Activities Section Starts-->
    <ul class="manag-actvty crrntprgr-list crntrflctn tymlynlyst">
     <li class="actvity-header">
	    <section class="nosorting">
	       <input type="checkbox" id="all">
	    </section>
	    <section class="mng-actvty scdnnam">
	       <?php echo $paginator->sort('Activity', 'Timeline.title'); ?>
	    </section>
	    <section class="mng-time scdnnam">
	       <?php echo $paginator->sort('Start Date', 'Timeline.start_date'); ?>
	    </section>
	    <section class="mng-time nosorting">
           <?php echo $paginator->sort('Start Time', ''); ?>
        </section>
	    <section class="mng-rtng scdnnam">
	       <?php echo $paginator->sort('Rating', 'Timeline.rating'); ?>
	    </section>
	    <section class="crntprgrss-actn scdnnam nosorting">
           <?php echo $paginator->sort('Action', ''); ?>
        </section>
	</li>
     <?php
     if(empty($all_timeline_act)){
	  echo '<li>No records found.</li>';
     } else { ?>
     
     <!------ Activities Data ------->
	<?php  $i = 0;  
	foreach($all_timeline_act as $row) {
	    //pr($row);
	     $i = $i+1; ?>
	    <script>
	    jQuery(function() {
		var refId = <?php echo $i ?>;
		var starDivId = '#rating_div'+refId; 
		jQuery(starDivId).raty({
		    score    : '<?php echo $tmp=($row["Timeline"]["rating"] != '')?$row["Timeline"]["rating"]:0; ?>',
		    path: "<?php echo SITE_URL ?>/img",
		    scoreName: 'data[Activity][rating]',
		    number:3,
		    entity_id: '<?php echo $row['Timeline']['entity_id']; ?>',
		    rating_id : '<?php echo $row['Timeline']['entity_id']; ?>'
		    });
	    });
	    </script>
	
	<li >
	    <section class="crntprgrss-actn" style="float: left">
		
		<input type="checkbox"  class="allchk" name="data[Timeline][ids][]" value="<?php echo $row['Timeline']['model_name'].'_'.$row['Timeline']['entity_id']; ?>">
	    
	    </section>
	    <section class="mng-actvty">
	       <?php if($row['Timeline']['title'] != ''){
		    echo substr($row['Timeline']['title'],0,40);
	     } else {
		    if($row['Timeline']['model_name'] == 'UserReflection'){
			echo 'Reflection';
		    } else{
		      echo 'N/A';  
		    }
	     }
	     ?>
	    </div></section>
	    
	    <section class="mng-time">
	    <?php if($row['Timeline']['start_date'] != ''){
		  echo date('M. d, Y',strtotime($row['Timeline']['start_date']));
	     } else {
		  echo 'N/A';
	     }
	     ?>
	     
	       
	    </section>
	    
	    <section class="mng-time">
	    <?php if($row['Timeline']['start_date'] != ''){
		  echo date('H:i',strtotime($row['Timeline']['start_date']));  //showing time by sorting the datetime
	     } else {
		  echo 'N/A';
	     }
	     ?>
	     
	       
	    </section>
	    <section class="mng-rtng" id="actRateContainer">
		<?php if($row['Timeline']['rating'] != '') { ?>
		    <div class="dbRefRate" modelname='<?php echo $row['Timeline']["model_name"] ?>' id="rating_div<?php echo $i; ?>"></div>
		<?php
		} else { ?>
		    <div class="dbRefRate" modelname='<?php echo $row['Timeline']["model_name"] ?>' id="rating_div<?php echo $i; ?>"></div>
		<?php }
		?>
		 
	    </section>
	    <section class="crntprgrss-actn">
	       <?php if($row['Timeline']['model_name'] == 'Activity'){ 
		     $confirmStatuss = $this->requestAction('/timelines/confirm_edit/'.$row['Timeline']['model_name'].'_'.$row['Timeline']['entity_id']);
		    if($confirmStatuss == 1){ ?>
			 
			   <?php // pr($id); die; ?>
					<a href="javascript:void(0)"><img src="<?php echo SITE_URL ?>img/confirm_icon.png" title="Status" alt="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"> </a>
			<?php } else {?>
					<a href="javascript:void(0)"><img src="<?php echo SITE_URL ?>img/question.png" title="Status" alt="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"> </a>
			<?php } ?> 
				<a href="javascript:void(0)" class="separate"><img src="<?php echo SITE_URL ?>img/activity_icon.png"class="image_icon" title="Activity" alt="Activity"> </a>
				<a href="<?php echo SITE_URL ?>activities/add_activity/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="Edit" title="Edit" /></a>
				<a onclick="return confirm('Are you sure to delete this record?');" href="<?php echo SITE_URL ?>timelines/delete_record/Activity/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Delete" /></a>
		    
	       <?php } else if($row['Timeline']['model_name'] == 'Mission'){ ?>
		    <?php
			$confirmStatuss = $this->requestAction('/timelines/confirm_edit/'.$row['Timeline']['model_name'].'_'.$row['Timeline']['entity_id']);
		   // pr($confirmStatuss);die;
		     
			if($confirmStatuss == 1){ ?>
				     <a href="javascript:void(0)"><img src="<?php echo SITE_URL ?>img/confirm_icon.png" title="Status" alt="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"></a>
			<?php } else {?>
				    <a href="javascript:void(0)" ><img src="<?php echo SITE_URL ?>img/question.png" title="Status" alt="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"></a>
			<?php } ?>
				    <a href="javascript:void(0)" class="separate"><img src="<?php echo SITE_URL ?>img/mission_icon.png"class="image_icon" title="Mission" alt="Mission"></a>  
				    <a href="<?php echo SITE_URL ?>missions/current_mission_setup/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="Edit" title="Edit" /></a>
				    <a onclick="return confirm('Are you sure to delete this record?');" href="<?php echo SITE_URL ?>timelines/delete_record/Mission/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Delete" /></a>
		    
	       <?php } else if($row['Timeline']['model_name'] == 'UserReflection'){ ?>
			    <?php   $confirmStatuss = $this->requestAction('/timelines/confirm_edit/'.$row['Timeline']['model_name'].'_'.$row['Timeline']['entity_id']);
				
			    if($confirmStatuss == 1){ ?>
				    <a href="javascript:void(0)" ><img src="<?php echo SITE_URL ?>img/confirm_icon.png" title="Status" alt="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"></a>
			    <?php } else {?>
				    <a href="javascript:void(0)" ><img src="<?php echo SITE_URL ?>img/question.png" title="Status" alt="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"></a>
			     <?php } ?>
				    <a href="javascript:void(0)" class="separate"><img src="<?php echo SITE_URL ?>img/reflection_icon.png"class="image_icon" title="Reflection" alt="Reflection"></a>  
				    <a href="<?php echo SITE_URL ?>reflections/edit_reflection/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="Edit" title="Edit" /></a>
				    <a onclick="return confirm('Are you sure to delete this record?');" href="<?php echo SITE_URL ?>timelines/delete_record/UserReflection/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Delete" /></a>
		    
	       <?php } else if($row['Timeline']['model_name'] == 'CalendarEvent'){ ?>
		    <?php
			$confirmStatuss = $this->requestAction('/timelines/confirm_edit/'.$row['Timeline']['model_name'].'_'.$row['Timeline']['entity_id']);

			if($confirmStatuss == 1){ ?>
				    <a href="javascript:void(0)" ><img src="<?php echo SITE_URL ?>img/confirm_icon.png" title="Status" alt="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"></a>
				 
			<?php } else {?>
				    <a href="javascript:void(0)" ><img src="<?php echo SITE_URL ?>img/question.png" title="Status" alt="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"></a>
			<?php } ?>
				    <a href="javascript:void(0)" class="separate"><img src="<?php echo SITE_URL ?>img/event_icon.png"class="image_icon" title="Calendar Events" alt="Calendar Events"></a>
				    <a href="<?php echo SITE_URL ?>activities/edit_event/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="" title="Edit" /></a>
				    <a onclick="return confirm('Are you sure to delete this record?');" href="<?php echo SITE_URL ?>timelines/delete_record/CalendarEvent/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Delete" /></a>
		    
	       <?php } else if($row['Timeline']['model_name'] == 'ImportEmail'){
		    $iconName = ($row['Timeline']['is_read'] == 0)?'unread_mail_icon.png':'email_icon.png';
		    $tipTxt = ($row['Timeline']['is_read'] == 0)?'Unread Email':'Email';
		    ?>
		    <?php   $confirmStatuss = $this->requestAction('/timelines/confirm_edit/'.$row['Timeline']['model_name'].'_'.$row['Timeline']['entity_id']);
		    if($confirmStatuss == 1){ ?>
		    
		 <a href="javascript:void(0)" ><img src="<?php echo SITE_URL ?>img/confirm_icon.png" alt="Status" title="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"/></a>
		    <?php } else {?>
				     <a href="javascript:void(0)" ><img src="<?php echo SITE_URL ?>img/question.png" alt="Status" title="Status" class="update_confirm" value="<?php echo base64_encode($row['Timeline']['model_name']);?>/<?php echo base64_encode($row['Timeline']['entity_id']);?>"/></a>
		    <?php } ?>
		     <a href="javascript:void(0)" class="separate"><img src="<?php echo SITE_URL ?>img/<?php echo $iconName ?>"class="image_icon" title="<?php echo $tipTxt ?>" alt="<?php echo $tipTxt ?>"></a>
		     <a href="<?php echo SITE_URL ?>activities/edit_email/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="" title="Edit" /></a>
		     <a onclick="return confirm('Are you sure to delete this record?');" href="<?php echo SITE_URL ?>timelines/delete_record/ImportEmail/<?php echo base64_encode($row['Timeline']['entity_id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Delete" /></a>
	       <?php } ?>
	    </section>
	</li>
	<?php } ?>
     
	
<?php } ?>	
    </ul>
<!--Current Activities Section End-->
<div class="paging_full_numbers" id="example_paginate" style="margin-top:20px;">
     <?php  if($paginator->numbers()){
       
	     echo $paginator->first('First', array('class'=>"homeLink"));echo '&nbsp;&nbsp;';
	     echo $paginator->prev('Previous',array('class'=>"disabled"));  echo '&nbsp;&nbsp;';
	     echo $paginator->numbers(array('separator'=>'')); echo '&nbsp;&nbsp;';
	     echo $paginator->next('Next',array('class'=>"disabled")); echo '&nbsp;';
	     echo $paginator->last('Last',array('class'=>"homeLink"));
     }
	     
     ?> 
	     &nbsp;
</div>
<script type="text/javascript">
   $(document).ready(function(){
	 jQuery('.menu .tymlynlyst li.actvity-header > section:first').attr('style', 'padding-left:10px !important');
	 jQuery('.menu .tymlynlyst li.actvity-header > section:last').attr('style', 'padding-right:10px !important');
	 jQuery('.update_confirm').click(function(){
	 var val = $(this).attr('value');
	 var curr = $(this);
	    jQuery.ajax({
			url:"<?php echo SITE_URL;?>/timelines/change_confirm_status/"+jQuery(this).attr('value'),
			success: function(data){
			    curr.css('class','update_confirm');
			    if(data == 1) {				
				curr.attr({
				    src: '<?php echo SITE_URL ?>img/confirm_icon.png',
				    value: val,
				    alt:'Status',
				    title:'Status'
				});
			    }else{
				curr.attr({
				    src: '<?php echo SITE_URL ?>img/question.png',
				    value: val,
				    alt:'Status',
				    title:'Status'
				});
			    }
			}
		    });
	})
});
</script>