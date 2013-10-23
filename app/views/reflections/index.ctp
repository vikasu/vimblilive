<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>

<style>
.mng-actns { width:115px;}
.mng-actns img {margin-right:0px;}
.mng-time { width:180px;}
.mng-part { width:100px;}
.mng-chk { width:20px; }
.mng-actvty { width:85px; }
.mng-rtng { width: 80px;}
/*.mng-actvty a { background: url('/img/admin-arrow-top.jpeg') no-repeat 20px 0px; }*/
</style>
 <?php //pr($refLists); die; ?>

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
                           <h3 class="hwdtwrks dshbrd">Dashboard</h3>
                           <!--Left Panel Starts-->
                           <section class=dshbrd-left>
                              <?php echo $this->element('dashboard/ind_left'); ?>
                           </section>
                           <!--Left Panel End-->
                           <!--Right Panel Starts-->
                           <section class=dshbrd-right>
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                               <!--Current Mission Section Starts-->
                               <form action="<?php echo SITE_URL ?>reflections/perform_actions" method="post" id="conlistForm" name="conlistForm">
                               <section class="current-mission manggrpdsbrd">
                                    <h3>Manage<span>Reflections</span>
                                    <div class="addimprt-btns">
                                         <a class="blubtn-mid" href="<?php echo SITE_URL ?>reflections/add_reflection">
                                        <input type="button" value="Add Reflection" />
                                        </a>
				     </div>
                                    </h3>
                                    
                                    <ul class=manag-actvty>
                                        <li class="actvity-header">
                                            <section class="mng-chk"><input type="checkbox" id="all"></section>
                                            <section class="mng-actvty">
                                            <?php echo $paginator->sort('Date', 'UserReflection.reflection_date'); ?>
                                             </section>
                                            <section class="mng-time">
                                             <?php echo $paginator->sort('Description', 'UserReflection.description'); ?>
                                            </section>
                                            <section class="mng-part">Participants</section>
					    <section class="mng-rtng">Ratings</section>
                                            <section class="mng-actns">Attachments</section>
                                        </li>
                                        
                                        <?php
					//pr($refLists); exit;
                                        if(empty($refLists)){ ?>
                                             <li style="text-align:center;">No reflections found.</li> 
                                        <?php } else { $i = 0;
                                        foreach($refLists as $reflection) {
					 $i = $i+1;
                                        
                                        //Avg rating
                                        //$avgRate = ($reflection['UserReflection']['ans_1']+$reflection['UserReflection']['ans_2']+$reflection['UserReflection']['ans_3']+$reflection['UserReflection']['rating_today']+$reflection['UserReflection']['rating_tomorrow'])/5; 	
                                        ?>
					
					<script>
                                            jQuery(function() {
                                                var refId = <?php echo $i ?>;
                                                var starDivId = '#'+refId; 
                                                jQuery(starDivId).raty({
                                                    readOnly : true,
						    path     : '<?php echo SITE_URL ?>img/',
                                                    score    : <?php echo $reflection['UserReflection']['rating_today'] ?>
                                                    });
                                            });
                                        </script>
					
                                        <li>
                                            <section class="mng-chk"><input type="checkbox" class="allchk" name="data[UserReflection][ids][]" value="<?php echo $reflection['UserReflection']['id']; ?>"></section>
                                            <section class="mng-actvty"><a href="<?php echo SITE_URL ?>reflections/reflection_detail/<?php echo base64_encode($reflection['UserReflection']['id']) ?>"><?php echo date('d/m/Y',strtotime($reflection['UserReflection']['reflection_date'])); ?></a></section>
                                            <section class="mng-time"><a href="<?php echo SITE_URL ?>reflections/reflection_detail/<?php echo base64_encode($reflection['UserReflection']['id']) ?>"><?php echo substr($reflection['UserReflection']['description'],0,80); ?>...</a></section>
					    <section class="mng-part"><?php echo $this->requestAction('/Reflections/getRefUsers/'.$reflection['UserReflection']['id']);?></section>
                                            <section class="mng-rtng"><div style="width: 100px !important;"  id="<?php echo $i; ?>"></div></section>
                                            <section class="mng-actns">
						<!--
						<a class="open_webcam" href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_camera.png" alt="" /></a>
                                                <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_video.png" alt="" /></a>
                                                <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_mike.png" alt="" /></a>
                                                <a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_link.png" alt="" /></a>
						-->
						
						 <?php if($reflection['UserReflection']['captured_image'] || $reflection['UserReflection']['file_name'] || $reflection['UserReflection']['captured_voice'] || $reflection['UserReflection']['captured_video']) { ?>
							<?php if($reflection['UserReflection']['captured_image'] != "") { ?>
							<a class="open_webcam" href="<?php echo SITE_URL ?>app/webroot/files/cam_img/<?php echo $reflection['UserReflection']['captured_image'] ?>"><img width=30 height=30 src="<?php echo SITE_URL ?>app/webroot/files/cam_img/<?php echo $reflection['UserReflection']['captured_image'] ?>" alt="" style="border:1px solid #ccc;" /></a>
							<?php } ?>
							<?php if($reflection['UserReflection']['captured_voice'] != "") { ?>
							<a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_video.png" alt="" /></a>
							<?php } ?>
							<?php if($reflection['UserReflection']['captured_video'] != "") { ?>
							<a href="#"><img src="<?php echo SITE_URL ?>img/icon_gray_mike.png" alt="" /></a>
							<?php } ?>
							<?php if($reflection['UserReflection']['file_name'] != "") { ?>
							<a href="<?php echo SITE_URL ?>app/webroot/files/reflections/<?php echo $reflection['UserReflection']['file_name'] ?>"><img src="<?php echo SITE_URL ?>img/icon_gray_link.png" alt="" /></a>
							<?php } ?>
						   <?php } else {?>
						   <i><font color="#5D5C5C" size="2px">No Attachments</font></i>
						   <?php } ?>
						
					    </section>
                                        </li>
                                        <?php } } ?>
                                    </ul>
                                    <!--Select De-Select Blue Button-->
                               </section>
                               <!--Current Mission Section End-->
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