<style>
.dshbrd-right .graybg { padding-left:0px !important; }
.reflection_box {display: none;}
</style>
<h3>Most recent<span>Reflections</span></h3>
<ul class="crrntprgr-list crntrflctn crrntprgr-list-new reflection_box">
<?php if(!empty($recentReflections)) { ?>
     <li class="refHead">
        <div class="dbRefDate">Date</div>
        <div class="dbRefDesc">Description</div>
        <div class="dbRefpart">Participants</div>
        <div class="dbRefRate">Rating</div>
        <div class="dbRefattach">Attachments</div>
    </li>
    <?php   $i = 0;
    foreach($recentReflections as $row){
    $i = $i+1;
    
    //Avg rating
    //$avgRate = ($row['UserReflection']['ans_1']+$row['UserReflection']['ans_2']+$row['UserReflection']['ans_3']+$row['UserReflection']['rating_today']+$row['UserReflection']['rating_tomorrow'])/5; 	
    
    ?>
    <script>
        jQuery(function() {
            var refId = <?php echo $i ?>;
            var starDivId = '#'+refId; 
            jQuery(starDivId).raty({
                readOnly : true,
                score    : <?php echo isset($row['UserReflection']['rating_today']) && !empty($row['UserReflection']['rating_today']) ? $row['UserReflection']['rating_today'] : 0; ?>
                });
        });
        
        //load the cliders after 3.2 seconds of page load.
          setTimeout(show_reflections,2600);
          function show_reflections(){
               jQuery(".reflection_box").slideDown();
          }
    </script>
    
    <li>
        <div class="dbRefDate"><?php echo date('M. d, Y',strtotime($row['UserReflection']['local_reflection_date'])); ?></div>
        <div class="dbRefDesc"><a href="<?php echo SITE_URL ?>reflections/reflection_detail/<?php echo base64_encode($row['UserReflection']['id']) ?>"><?php if($row['UserReflection']['description'] != ""){echo substr($row['UserReflection']['description'],0,50).'...';} else { echo 'Reflection'; } ?></a></div>  <!--edit the link to redirect to the specific reflection page-->
        <div class="dbRefpart"><?php echo $allAttendy = $this->Common->fetch_participant($row['UserReflection']['id']);?></div>
        <div class="dbRefRate" id="<?php echo $i; ?>"></div>
        <div class="dbRefattach">
             <?php if($row['UserReflection']['captured_image'] || $row['UserReflection']['file_name'] || $row['UserReflection']['captured_voice'] || $row['UserReflection']['captured_video']) { ?>
                        <?php if($row['UserReflection']['captured_image'] != "") { ?>
                        <a class="open_webcam" href="<?php echo SITE_URL ?>app/webroot/files/cam_img/<?php echo $row['UserReflection']['captured_image'] ?>"><img width=30 height=30 src="<?php echo SITE_URL ?>app/webroot/files/cam_img/<?php echo $row['UserReflection']['captured_image'] ?>" alt="" style="border:1px solid #ccc;" /></a><!--Adding Image thumbnail size-->
                        <?php } ?>
                        <?php if($row['UserReflection']['captured_voice'] != "") { ?>
                        <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_video.png" alt="" /></a>
                        <?php } ?>
                        <?php if($row['UserReflection']['captured_video'] != "") { ?>
                        <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_mike.png" alt="" /></a>
                        <?php } ?>
                        <?php if($row['UserReflection']['file_name'] != "") {
                         $imgExtArr = array('jpg','jpeg','png','gif','bmp');
                         $ext = pathinfo($row['UserReflection']['file_name'], PATHINFO_EXTENSION);
                         ?>
                         <a href="<?php echo SITE_URL ?>app/webroot/files/reflections/<?php echo $row['UserReflection']['file_name'] ?>">
                         <?php if(in_array($ext,$imgExtArr)){ ?>
                         <img src="<?php echo SITE_URL ?>img/img_icon.png" alt="Image" /></a>
                         <!--<img src="<?php //echo SITE_URL ?>app/webroot/files/reflections/<?php //echo $row['UserReflection']['file_name']?>" alt="Image" width="20px"/></a>-->
                         <?php } else{ ?>
                         <img src="<?php echo SITE_URL ?>img/attachment.png" alt="Attachment" /></a>
                        <?php }} ?>
                   <?php } else {?>
                   <i><font color="#5D5C5C" size="2px">No Attachments</font></i>
                   <?php } ?>
        </div>
    </li>
    <?php } } else { ?>
    <li style="text-align:center;">No reflections available .</li>
    <?php } ?>
    
</ul>



  


<section class=add-reflection>
     <form method="Post" action="<?php echo SITE_URL ?>timelines/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>">
          <input type="hidden" name="data[Timeline][entity_type]" value="UserReflection">
     <div class="blubtn-big blubtn_new blubtn_new_pos"><input type="submit" value="See More" /></div>
     </form>
     
    <div><a class="blubtn-big blubtn_new blubtn_new_pos ylw_btn_lrg" href="<?php echo SITE_URL ?>reflections/add_reflection"><input type="button" value="Add Reflection" /></a></div>
    
</section>
<!--
<section class=add-reflection>
    <label>What made today memorable? Other thoughts?</label>
    <textarea class=textarea></textarea>
    <div class="blubtn-small addbtn"><input type="button" value="Add" /></div>
</section>
-->