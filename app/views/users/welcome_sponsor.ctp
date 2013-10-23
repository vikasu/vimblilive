<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    echo $this->Html->script('jquery.qtip-1.0.0-rc3.min');?>
<script type="text/javascript">
jQuery(document).ready(function(){
 //open qtip to show all ideas
    jQuery(".clickmission").each(function() {
	jQuery(this).qtip({
	    content: {
	    text: '<img src="loading.gif" alt="loading" />',
	    url: '<?php echo SITE_URL; ?>users/display_actions',
	    data: {id:jQuery(this).attr('id')},
		title: {
		text: 'Complete Mission',
		button: 'X' // Close buttonfgr
		}
	    },
	    show: {
		when: 'click',
		delay: 100
	    },
	    hide: 'mousedown',
	    tip: 'topLeft',
	    style:
	    {
	    width:300
	    },
	    position: { corner: { target: 'topLeft', tooltip: 'middleRight' }, adjust: { x: 10, y: 10 } }
	});
    });
    
    // open popup for adding Notes
    jQuery(".notes").each(function() {
	//var =  jQuery(this).attr('id');
	jQuery(this).qtip({
	    content: {
	    text: '<img src="loading.gif" alt="loading" />',
	    url: '<?php echo SITE_URL; ?>users/display_notes/',
	    data: {'id':jQuery(this).attr('id'),'edit_note':125},
		title: {
		text: 'Add Note',
		button: 'X' // Close buttonfgr
		}
	    },
	    show: {
		when: 'click',
		delay: 100
	    },
	    hide: 'mousedown',
	    tip: 'topLeft',
	    style:
	    {
	    width:300
	    },
	    position: { corner: { target: 'topLeft', tooltip: 'middleRight' }, adjust: { x: 10, y: 10 } }
	});
    });
    
    //updating rating values
     jQuery("#rating_img").live('click', function(){
	    //var modelName = jQuery(this).parent().attr('modelname');
	    
	    var activity_id = jQuery(this).attr('entity_id');
	    //alert(activity_id);
	    var current_rating = jQuery('#rating_id'+activity_id).val();
	   // alert(current_rating);
	    $.ajax({
		  url: '<?php echo SITE_URL?>missions/update_ratings/'+activity_id+'/'+current_rating,
		  success: function(data) {
		    //alert(data);
		  }
		});
     });
    
    
  /*  $('.star').raty({
	 readOnly : true,
	cancel    : false,
	cancelOff : 'cancel-off.png',
	cancelOn  : 'cancel-on.png',
	half      : false,
	size      : 24,
	starHalf  : 'star-half.png',
	starOff   : 'star-off.png',
	starOn    : 'star-on.png',
	number: 3,
	scoreName: '',
	score : '',
	path : '<?php //echo SITE_URL; ?>/img'
    });  */
    
  /*  $('.star_output').raty({
	 readOnly : true,
	cancel    : false,
	cancelOff : 'cancel-off.png',
	cancelOn  : 'cancel-on.png',
	half      : false,
	size      : 24,
	starHalf  : 'star-half.png',
	starOff   : 'star-off.png',
	starOn    : 'star-on.png',
	number: 3,
	scoreName: '',
	score : '<?php  //echo $sponsor['Mission']['sp_rating'];?>',
	path : '<?php //echo SITE_URL; ?>/img'
    }); */
});
</script>
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
                           <h3 class="hwdtwrks dshbrd spnsr_small_icon">My Sponsorships</h3>
                           
			   <!--Right Panel Starts-->
                           <section class=dshbrd-right>
                              
			      
                               <!--Current Mission Section Starts-->
                                  <h3>Active&nbsp;&nbsp;<span>Sponsorships</span></h3><hr>
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
                                    <ul class=manag-actvty>
                                        <li class="actvity-header">
                                                <section class="mng-rtng mng-rtng-sp-name" style="width: 65px">Name</section>
                                                <section class="mng-rtng mng-rtng-sp-msn" style="width: 65px">Mission</section>
                                                <section class="mng-rtng" style="width: 65px">Start</section>
						<section class="mng-rtng" style="width: 65px">End</section>
						<section class="mng-rtng mng-rtng-sp-name" style="width: 75px">My Commitment</section>
						<section class="mng-rtng mng-rtng-sp-name" style="width: 140px !important">Notes</section>
                                                <section class="mng-rtng" style="width: 85px">My level of engagement</section>
                                                 <section class="mng-rtng" style="width: 65px">Actions</section>
			
                                        
                                        </li>
                                        <?php //pr($mission_Sponsor_User); die;?>
                                       <?php if(empty($mission_Sponsor_User)) {
						echo "<div style='margin-top:70px; text-align: center'>No Active Sponsorships<div>";
				       }else{
					     $i = 0;
                                             foreach($mission_Sponsor_User as $sponsor)  {
						//pr($sponsor['Mission']['sp_rating']); die;
						$i = $i+1;
						?>
						<script>
							jQuery(function() {
							    var refId = <?php echo $i ?>;
							    var starDivId = '#rating_div'+refId; 
							    jQuery(starDivId).raty({
								score    : '<?php echo $tmp=($sponsor["Mission"]["sp_rating"] != '')?$sponsor["Mission"]["sp_rating"]:0; ?>',
								path: "<?php echo SITE_URL ?>img",
								scoreName: 'data[Mission][id]',
								number:3,
								entity_id: '<?php echo $sponsor['Mission']['id']; ?>',
								rating_id : '<?php echo $sponsor['Mission']['id']; ?>'
								});
							})
						</script>
					    <li >
						<?php 					
						// condition check for Mission start_time
							if(empty($sponsor['Mission']['start_time'])){
							    $sponsor['Mission']['start_time'] = '-';
							    
							}else{
							   $sponsor['Mission']['start_time']=date("M d, y",strtotime($sponsor['Mission']['start_time']));
							}
							
							// condition check for Mission end_time
							if(empty($sponsor['Mission']['end_time'])){
							    $sponsor['Mission']['end_time'] = '-';
							    
							}else{
							   $sponsor['Mission']['end_time']=date("M d, y",strtotime($sponsor['Mission']['end_time']));
							}
						
							// condition check for Mission sp_accept
							 if(empty($sponsor['Mission']['sp_accept'])){ 
								$sp_accept = $this->Html->link('Accept Now',array('controller'=>'missions','action'=>'mission_accepted',base64_encode($sponsor['Mission']['id']),$_SESSION['Auth']['User']['id']));
							 } else{
								    $sponsor['Mission']['sp_accept']=date("M d, y",strtotime($sponsor['Mission']['sp_accept']));
								    $sp_accept = $sponsor['Mission']['sp_accept'];
							    }
							    
							// condition check for Mission sp_note
							if(empty($sponsor['Mission']['sp_note'])){
							    $note = $this->Html->link('Add Note','javascript:void(0)',array('id'=>$sponsor['Mission']['id'], 'class'=>'notes'));
							}else{
							    $note_from_db = $sponsor['Mission']['sp_note'];
							    $edit_image = $this->Html->link($this->Html->image("/img/icons/small/black/edit.png", array("alt" => "Edit",'id'=>$sponsor['Mission']['id'],'class'=>'notes','height'=>'13px')), 'javascript:void(0)', array('escape' => false,'value'=>$sponsor['Mission']['id']));
							    $note = $note_from_db.'.'.$edit_image ;
							    //pr($note); di
							}
							
							// condition check for Mission ownner name
							if(empty($sponsor['Owner']['name'])){
							    $sponsor['Owner']['name'] = '-';
							}
							
							// condition check for Mission name
							if(empty($sponsor['Mission']['title'])){
							    $mission_Name = '-';							    
							}else{
							   $mission_Name = $this->Html->link($sponsor['Mission']['title'],array('controller'=>'missions','action'=>'view',base64_encode($sponsor['Mission']['id'])));
							}
							?>
							<section class="mng-rtng mng-rtng-sp-name" style="width: 65px"><?php echo $sponsor['Owner']['name'] ;?></section>
							<section class="mng-rtng mng-rtng-sp-msn" style="width: 65px"><?php echo $mission_Name ;?></section>
							<section class="mng-rtng" style="width: 65px"><?php echo $sponsor['Mission']['start_time'] ;?></section>
							<section class="mng-rtng" style="width: 65px"><?php echo $sponsor['Mission']['end_time'] ;?></section>
							<section class="mng-rtng mng-rtng-sp-name" style="width: 75px"><?php echo $sp_accept ;?></section>
							<section class="mng-rtng mng-rtng-sp-name" style="width: 140px !important"><div><?php echo $note ;?></div></section>
							<section class="mng-rtng" style="width: 85px"><div id="rating_div<?php echo $i ?>"></div></section>
							<section class="mng-rtng" style="width: 65px"><?php echo $this->Html->link($this->Html->image("complete.png", array("alt" => "Action",'id'=>$sponsor['Mission']['id'],'class'=>'clickmission')), 'javascript:void(0)', array('escape' => false,'value'=>$sponsor['Mission']['id']));?>
							<?php //echo $html->link($html->image("Completed_mission.png",array('alt'=>'test')), array('javascript:void(0)'), array('id'=>$sponsor['Mission']['id'],'class'=>'clickmission','escape' => false));?>
							</section>
						</li>
						
                                            <?php } } ;?>
				
                                    </ul>
                        </section><br><br>
			</section>
                         <section class=dshbrd-right>
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
                                    <ul class=manag-actvty>
					<h3>History&nbsp;&nbsp;<span></span></h3><hr><br>
					    <li class="actvity-header">
						    <section class="mng-rtng mng-rtng-sp-name" style="width: 40px">Name</section>
						    <section class="mng-rtng mng-rtng-sp-msn"  style="width: 50px">Mission</section>
						    <section class="mng-rtng"  style="width: 60px">Start</section>
						    <section class="mng-rtng"  style="width: 65px">End</section>
						    <section class="mng-rtng mng-rtng-sp-name"  style="width: 70px">My Commitment</section>
						     <section class="mng-rtng mng-rtng-sp-name"  style="width: 45px">Notes</section>
						    <section class="mng-rtng"  style="width: 60px">My level of engagement</section>
						     <section class="mng-rtng"  style="width: 65px">Date Completed</section>
						     <section class="mng-rtng"  style="width: 60px">My rating of the outcome for the participant</section>
					    </li>
					    <?php if(empty($mission_Sponsor_Users_history)) {
						echo "<div style='margin-top:70px; text-align:center; font-style:italic;'>No Sponsorship History<div>";
					    }else{
							    $i = 0; $j = 0;
							    foreach($mission_Sponsor_Users_history as $sponsor_history)  {
								    $i = $i+1;
								    $j = $j+1;
					    ?>
						<script>
							jQuery(function() {
							   //alert('there'); 
							    var refId = <?php echo $i ?>;
							    var starDivId = '#'+refId; 
							     //alert(starDivId);	    
							    $(starDivId).raty({
								readOnly : true,
							       cancel    : false,
							       cancelOff : 'cancel-off.png',
							       cancelOn  : 'cancel-on.png',
							       half      : false,
							       size      : 24,
							       starHalf  : 'star-half.png',
							       starOff   : 'star-off.png',
							       starOn    : 'star-on.png',
							       number: 3,
							       scoreName:'',
							       score : '<?php echo $sponsor_history['Mission']['sp_rating'];?>',
							       path : '<?php echo SITE_URL; ?>img'
							   });
							});
						</script>
						<script>
							
							    jQuery(function() {
							    var refId2 = <?php echo $j ?>;
							    var starDivId2 = '#'+refId2+'complete'; 
							     //alert(starDivId2);	    
							    $(starDivId2).raty({
								readOnly : true,
							       cancel    : false,
							       cancelOff : 'cancel-off.png',
							       cancelOn  : 'cancel-on.png',
							       half      : false,
							       size      : 24,
							       starHalf  : 'star-half.png',
							       starOff   : 'star-off.png',
							       starOn    : 'star-on.png',
							       number: 3,
							       scoreName:'',
							       score : '<?php echo $sponsor_history['Mission']['sp_complete_rating'];?>',
							       path : '<?php echo SITE_URL; ?>img'
							   });
							});
						</script>
						 <li>
						    <?php 
							// condition check for Mission start_time
							if(empty($sponsor_history['Mission']['start_time'])){
							    $sponsor_history['Mission']['start_time'] = '-';
							    
							}else{
							   $sponsor_history['Mission']['start_time'] = date("M d, y",strtotime($sponsor_history['Mission']['start_time']));
							}
							
							// condition check for Mission end_time
							if(empty($sponsor_history['Mission']['end_time'])){
							    $sponsor_history['Mission']['end_time'] = '-';
							    
							}else{
							   $sponsor_history['Mission']['end_time'] = date("M d, y",strtotime($sponsor_history['Mission']['end_time']));
							}
							
							// condition check for Mission sp_complete_date
							if(!empty($sponsor_history['Mission']['sp_complete_date'])){
							    $sponsor_history['Mission']['sp_complete_date'] = date("M d, y",strtotime($sponsor_history['Mission']['sp_complete_date']));
							}else{
							    $sponsor_history['Mission']['sp_complete_date']= '-';
							}
							
							// condition check for Mission sp_accept
							if($sponsor_history['Mission']['sp_accept'] == ""){
								$sponsor_history['Mission']['sp_accept'] = "-";
							 } else{
								     $sponsor_history['Mission']['sp_accept'] = date("M d, y",strtotime($sponsor_history['Mission']['sp_accept']));
								     $sp_accept = $sponsor_history['Mission']['sp_accept']; 
								}
							
							// condition check for Mission sp_note
							
							//if(empty($sponsor_history['Mission']['sp_note'])){
							  //  $sponsor_history['Mission']['sp_note'] = '-';
							//}
							
							// condition check for Mission ownner name
							if(empty($sponsor_history['Owner']['name'])){
							    $sponsor_history['Owner']['name'] = '-';
							}
							
							// condition check for Mission name
							if(empty($sponsor_history['Mission']['title'])){
							    $mission_Name = '-';							    
							}else{
							   $mission_Name = $this->Html->link($sponsor_history['Mission']['title'],array('controller'=>'missions','action'=>'view',base64_encode($sponsor_history['Mission']['id'])));
							}
							
				// end of conditions		    ;?>
						    
							<section class="mng-rtng mng-rtng-sp-name" style="width: 40px"><?php echo $sponsor_history['Owner']['name'] ;?></section>
							<section class="mng-rtng mng-rtng-sp-msn" style="width: 50px"><?php echo $mission_Name ;?></section>
							<section class="mng-rtng" style="width: 60px"><?php echo $sponsor_history['Mission']['start_time'] ;?></section>
							<section class="mng-rtng" style="width: 65px"><?php echo $sponsor_history['Mission']['end_time'] ;?></section>
							<section class="mng-rtng mng-rtng-sp-name" style="width: 70px"><?php echo $sponsor_history['Mission']['sp_accept'];?></section>
							<section class="mng-rtng mng-rtng-sp-name" style="width: 45px"><?php echo $sponsor_history['Mission']['sp_complete_note'] ;?><br>****<br><?php echo $sponsor_history['Mission']['sp_note'] ;?></section>
							<section class="mng-rtng" style="width: 60px"><div id="<?php echo $i ?>"></div></section>
							<section class="mng-rtng" style="width: 65px"><?php echo $sponsor_history['Mission']['sp_complete_date'] ;?></section>
							<section class="mng-rtng" style="width: 60px"><div id="<?php echo $j.'complete' ?>"><?php echo $sponsor_history['Mission']['sp_complete_rating'];?></div></section>
						</li>
                                    
                                                <?php } } ;?>
				
                                    </ul>
				</section>
			     </section>    
                                    <!--Select De-Select Blue Button-->
                          
                              
                               
                               <div class="paging_full_numbers" id="example_paginate">
                             
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
    
<style>
    .mng-rtng{ float: left;  padding: 0 10px; width: 80px;}
    .notes {margin-top:-25px !important;}
</style>