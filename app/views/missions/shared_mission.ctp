<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    echo $this->Html->css('jquery-latest');
    echo $this->Html->script('jquery.qtip-1.0.0-rc3.min'); ?>

<script type="text/javascript">
jQuery(document).ready(function(){
    
    initMenus();
    $('#menuaccrdn li ul:first, #menuaccrdn li > ul:first').show();
      
      //change activity rating from list
      jQuery("#rating_img").live('click', function(){
	    var modelName = jQuery(this).parent().attr('modelname');
	    var activity_id = jQuery(this).attr('entity_id');
	    var current_rating = jQuery('#rating_id'+activity_id).val(); 
	    $.ajax({
		  url: '<?php echo SITE_URL?>timelines/update_ratings/'+modelName+'/'+activity_id+'/'+current_rating,
		  success: function(data) {
		    //alert(data);
		  }
		});
     });
     
     //alert(jQuery(".reflectionRating").children().attr('id'));
     
     jQuery("#entity_options").change(function(){
	jQuery('#refineForm').submit();
	});
     
});

</script>
<style>

/*********
===========================Added Jan-11-2012============================*********/
/*.mng-actvty a { background: url('/img/admin-arrow-top.jpeg') no-repeat 20px 0px; }*/

select{
    border:none !important;
    font-size:14px !important;
}

#entity_options option{
    padding:0 3px;
}

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


.cnnctns-actns {
    height: 18px !important;
    padding: 3px 10px !important;
    width: auto !important;
}

li a {display:inline-block;}
li a {display:block;}
  
.cnnctns-actns {
 width:450px; height:30px; padding-top:10px;
}

 ul.tabs li {
 width:222px;
 }
ul.manag-actvty li a { background: none!important; width:auto!important; color:inherit!important;}
ul.menu li ul li a { font-weight:normal !important; padding-left:0px !important; padding-top:0px !important; padding-right:5px !important; font-family: arial !important; word-spacing:0 !important; }
ul.menu li ul li a:hover { border-left: none !important; }
.crntrflctn li .crntprgrss-actn img { margin:0px !important;}
.image_icon { padding:5px; float:left;}
.mng-rtng { word-wrap: break-word;}
.crntprgrss-actn a { float: left !important; }
.mng-time {
    width: 100px !important;
}
.mng-actvty {
    width: 400px !important;
}
 </style>
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
                           <h3 class="hwdtwrks dshbrd timeline_small_icon">My Setup & Data</h3>
			   <!--Right Panel Starts-->
                           <section class="dshbrd-right close_to_left">
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Right Panel Starts-->
                           <section class="dshbrd-right close_to_left">
                               <!--Current Reflection Section Starts-->
                               <section class="current-mission manggrpdsbrd">
                                    <!--Heading-->
                                    <h3 class=wrdspcn>Shared <span>Missions</span>
				    
				    <div class="addimprt-btns">
					
                                    </div>
				    
				    </h3>
				    
				    <div class="clr-b"></div>
                                    <div class="btn-wrapr">
                                        
                                   </div>
				   
                                   <div class="clr-b"></div>
				    <!-- Foundation Setup slider starts -->
                                    <ul id="menuaccrdn" class="menu">
					<li>
                                            <?php //echo $this->element("timeline/alldata");?>
					    
					    <!--Current Activities Section Starts-->
					    <ul class="manag-actvty crrntprgr-list crntrflctn">
					     <li class="actvity-header">
						    <section class="mng-actvty">Title</section>
						    <section class="mng-time">Start Date</section>
						    <section class="mng-time">End Date</section>
						    <section class="mng-rtng">Rating</section>
						    <section class="crntprgrss-actn">Action</section>
						</li>
					     <?php
					     if(empty($sharedMission)){
						  echo '<li>No records found.</li>';
					     } else { ?>
					     
					     <!------ Activities Data ------->
						<?php  $i = 0;  
						foreach($sharedMission as $row) {
						     $i = $i+1; ?>
						    <script>
						    jQuery(function() {
							var refId = <?php echo $i ?>;
							var starDivId = '#rating_div'+refId; 
							jQuery(starDivId).raty({
							    score    : <?php echo $row['Mission']['rating']; ?>,
							    path: "<?php echo SITE_URL ?>/img",
							    scoreName: 'data[Mission][rating]',
							    number:3,
							    entity_id: '<?php echo $row['Mission']['id']; ?>',
							    rating_id : '<?php echo $row['Mission']['id']; ?>'
							    });
						    });
						    </script>
						
						<li>
						    <section class="mng-actvty">
						       <?php if($row['Mission']['title'] != ''){
							    echo substr($row['Mission']['title'],0,50);
						     } else {
							  echo 'N/A';
						     }
						     ?>
						    </div></section>
						    
						    <section class="mng-time">
						    <?php if($row['Mission']['start_time'] != ''){
							  echo date('M. d, Y',strtotime($row['Mission']['start_time']));
						     } else {
							  echo 'N/A';
						     }
						     ?>
						     
						       
						    </section>
						    
						    <section class="mng-time">
						    <?php if($row['Mission']['end_time'] != ''){
							  echo date('M. d, Y',strtotime($row['Mission']['end_time']));
						     } else {
							  echo 'N/A';
						     }
						     ?>
						     
						       
						    </section>
						    <section class="mng-rtng" id="actRateContainer">
							<?php if($row['Mission']['rating'] != '') { ?>
							    <div class="dbRefRate" modelname='Mission' id="rating_div<?php echo $i; ?>"></div>
							<?php
							} else {
							    echo 'N/A';
							}
							?>
							 
						    </section>
						    <section class="crntprgrss-actn">
							    <a href="<?php echo SITE_URL ?>missions/view_recent_mission/<?php echo base64_encode($row['Mission']['id']) ?>"><img src="<?php echo SITE_URL ?>img/mission_icon.png"class="image_icon" title="Mission" alt="Mission"></a>
							<?php if($row['Mission']['edited_by'] == $_SESSION['Auth']['User']['id']){ ?>
							    <a href="<?php echo SITE_URL ?>missions/current_mission_setup/<?php echo base64_encode($row['Mission']['id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="" title="Profile" /></a>
							<?php }else{ ?>
							    <a href="<?php echo SITE_URL ?>missions/edit_shared_mission/<?php echo base64_encode($row['Mission']['id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="" title="Profile" /></a>
							<?php } ?>
							<a onclick="return confirm('Are you sure to delete this record?');" href="<?php echo SITE_URL ?>missions/delete_shared_mission/<?php echo base64_encode($row['Mission']['id']) ?>"><img src="<?php echo SITE_URL ?>img/delete_icon.png" alt="" title="Message List" /></a>
						    </section>
						</li>
						<?php } ?>
					     
						
					<?php } ?>	
					    </ul>
					<!--Current Activities Section End-->
					    
                                        </li>
				    </ul>
				    <!-- Foundation Setup slider starts -->
                               </section>
                               <!--Current Reflection Section End-->
                           </section>
                           <!--Right Panel End-->
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