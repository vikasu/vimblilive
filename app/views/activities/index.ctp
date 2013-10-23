<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
<style>
.mng-actns img {margin-right:0px;}
.mng-chk { width:20px; }
.mng-actvty { width:180px; }
.btn-wrapr { overflow:visible; float:left; width:100%; }
/*.mng-actvty a { background: url('/img/admin-arrow-top.jpeg') no-repeat 20px 0px; }*/
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
</style>

<script type="text/javascript">
jQuery(document).ready(function(){
     jQuery('.actionButton').click(function(){
          if (jQuery("#activitylistForm input:checkbox:checked").length > 0)
          {
              if(jQuery(this).attr('id') == 'view' || jQuery(this).attr('id') == 'edit')
              {
                    if (jQuery("#activitylistForm input:checkbox:checked").length > 1)
                    {
                         jQuery('#chkMsg').html('Please select single recored for view or edit.');
                         jQuery('#chkMsg').slideDown('slow');
                         jQuery('#chkMsg').delay(3000).slideUp('slow');
                         return false;
                    }
              }
               jQuery("#actionTaken").val(jQuery(this).attr('id'));
               jQuery('#activitylistForm').submit();
          }
          else
          {
               jQuery('#chkMsg').html('Please select atleast one record.');
               jQuery('#chkMsg').slideDown('slow');
               jQuery('#chkMsg').delay(3000).slideUp('slow');
               return false;
          }
     });
     
     jQuery(".searchtype").click(function(){
          jQuery("#searchIn").attr('value',jQuery(this).attr("id"));
     });
      jQuery(".connection-group").click(function(){
          jQuery("#connection-group").attr('value',jQuery(this).attr("group_id"));
	  jQuery("#actionTaken").val('grouping');
	  $('#activitylistForm').submit();
     });
      jQuery("#rating_img").live('click', function(){
	    var activity_id = jQuery(this).attr('entity_id');
	    var current_rating = jQuery('#rating_id'+activity_id).val(); 
	    $.ajax({
		  url: '<?php echo SITE_URL?>activities/update_ratings/'+activity_id+'/'+current_rating,
		  success: function(data) {
		    //alert(data);
		  }
		});
     });
     
     
});
</script>

 <?php //pr($conLists); die; ?>

<?php
if($paginator->sortDir() == 'asc'){
	$image = $html->image('admin-arrow-top.jpeg',array('border'=>0,'alt'=>''));
}
else if($paginator->sortDir() == 'desc'){
	$image = $html->image('admin-arrow-bottom.jpeg',array('border'=>0,'alt'=>''));
}
else{
	$image = '';
}
?>
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
                           <h3 class="hwdtwrks dshbrd">Refine</h3>
                           <!--Left Panel Starts-->
                           <section class=dshbrd-left>
                              <?php echo $this->element('dashboard/ind_left'); ?>
                           </section>
                           <!--Left Panel End-->
                           <!--Right Panel Starts-->
                           <section class=dshbrd-right>
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Current Mission Section Starts-->
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
                                    <h3>My <span>Activities</span>
                                    <div class="addimprt-btns">
                                       <?php /* ?>
                                        <a class="blubtn-mid" href="<?php echo SITE_URL ?>connections/add_connection">
                                        <input type="button" value="Add Connection" />
                                        </a>
                                        <?php */ ?>
                                        <a class="blubtn-mid" href="<?php echo SITE_URL ?>activities/add_activity">
                                        <input type="button" value="Add Activity" />
                                        </a>
                                    </div>
                                    </h3>
                                    <div class="clr-b"></div>
                                    <div class="btn-wrapr" style="width:50%">
                                        <div class="cnnctns-actns"><input class='actionButton' id="delete" type='button' name="data[Activity][action]" value="Delete"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="activate" type='button' name="data[Activity][action]" value="Activate"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="deactivate" type='button' name="data[Activity][action]" value="Deactivate"></div>
					<div class="cnnctns-actns" style="padding-top:5px;"><?php echo $this->Html->link('Export', array('controller'=>'activities', 'action'=>'export_activities'), array('style'=>'color:#5D5C5C')); ?></div>
                                    
				    </div>
					
					<!--
                                        <div class="cnnctns-actns"><input class='actionButton' id="view" type='button' name="data[Connection][action]" value="View"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="edit" type='button' name="data[Connection][action]" value="Edit"></div>
                                        -->
                                   
                                   <form action="<?php echo SITE_URL ?>activities/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>" method="post" id="searchForm" name="searchForm">
                                        <div style="float:right;" class="slctsrch">
                                             <div class="slctbx">
                                                 All <img src="<?php echo SITE_URL ?>img/arrw_down_slctcat.png" alt="" />
                                                 <div class="slctcate-drop">
                                                     <ul>
                                                         <li class="searchtype" id="title"><a href="#">Title</a></li>
                                                         <li class="searchtype" id="description"><a href="#">Description</a></li>
                                                     </ul>
                                                 </div>
                                             </div>
                                             <input style="border:1px solid #ddd; float:left; padding:5px;" type="text" name="data[Search][keyword]">
                                             <input id="searchIn" type="hidden" name="data[Search][searchin]" value="">
                                             <div class="cnnctns-actns"><input type="submit" value="Search"></div>
                                             </form>
                                        </div>
                                   
                                   </div>
                                   <div class="clr-b"></div>
                                    
                                   <form action="<?php echo SITE_URL ?>activities/perform_actions" method="post" id="activitylistForm" name="activitylistForm">
                                    
                                    <input id='actionTaken' type='hidden' name='data[Activity][action]' value=''>
                                    
                                    <ul class=manag-actvty>
                                        <li class="actvity-header">
                                            <section class="mng-chk"><input type="checkbox" id="all"></section>
                                            <section class="mng-actvty scdnnam">
						<?php echo $paginator->sort('Title', 'Activity.title'); ?>
                                             </section>
                                            <section class="mng-time scdnnam">Time</section>
                                            <section class="mng-rtng">Rating</section>
                                            <section class="mng-actns scdnnam"><?php echo $paginator->sort('Status', 'Activity.status'); ?><?php if($paginator->sortKey() == 'Connection.status'){
				}?></section>
                                        </li>
                                        
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
                                                var starDivId = '#'+refId; 
                                                jQuery(starDivId).raty({
                                                    score    : <?php echo $activity['Activity']['rating']; ?>,
						    path: "<?php echo SITE_URL ?>/img",
						    scoreName: 'data[Activity][rating]',
						    number:3,
						    entity_id : '<?php echo $activity['Activity']['id']; ?>',
						    rating_id : '<?php echo $activity['Activity']['id']; ?>'
                                                    });
                                            });
					    </script>
                                        
                                        <li>
					     <section class="mng-chk"><input type="checkbox" class="allchk" name="data[Activity][ids][]" value="<?php echo $activity['Activity']['id']; ?>"></div></section>
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
                                            <section class="mng-rtng">
						<?php if($activity['Activity']['rating'] != '') { ?>
						    <div class="dbRefRate" id="<?php echo $i; ?>"></div>
						<?php
						} else {
						    echo 'N/A';
						}
						?>
                                                 
                                            </section>
                                            <section class="mng-time" style="width:70px;">
                                             <?php echo $activity['Activity']['status'] == 1 ? "Active" : "Inactive"; ?>
					    </section>
                                        </li>
                                        <?php } } ?>
                                    </ul>
                                    <!--Select De-Select Blue Button-->
                               </section>
                               <!--Current Mission Section End-->
                               
                               
                               <div class="paging_full_numbers" id="example_paginate">
                              <?php  if($paginator->numbers()){
                                
                                      echo $paginator->first('First', array('class'=>"homeLink"));echo '&nbsp;&nbsp;';
                                      echo $paginator->prev('Previous',array('class'=>"disabled"));  echo '&nbsp;&nbsp;';
                                      echo $paginator->numbers(array('separator'=>'')); echo '&nbsp;&nbsp;';
                                      echo $paginator->next('Next',array('class'=>"disabled")); echo '&nbsp;';
                                      echo $paginator->last('Last',array('class'=>"homeLink"));
                                      //echo $paginator->counter(array(	'format' => 'Page %page% of %pages% ' ));
                              }
                                      
                              ?> 
                                      &nbsp;
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
    <script type="text/javascript">
     $(document).ready(function(){
		$('.slctbx').click(function(){
		 $('.slctcate-drop').slideToggle(300);							
		 });
	  $('.group_slctbx').click(function(){
		 $('.group-slctcate-drop').slideToggle(300);							
		 });
       });
     
    </script>