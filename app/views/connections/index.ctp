<style>
.mng-actns img {margin-right:0px;}
.mng-chk { width:20px; }
.mng-time { width: 270px !important;}
.mng-actvty { width:210px; }
.mng-rtng { width: 250px !important;}
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
          if (jQuery("#conlistForm input:checkbox:checked").length > 0)
          {
              if(jQuery(this).attr('id') == 'view' || jQuery(this).attr('id') == 'edit')
              {
                    if (jQuery("#conlistForm input:checkbox:checked").length > 1)
                    {
                         jQuery('#chkMsg').html('Please select single recored for view or edit.');
                         jQuery('#chkMsg').slideDown('slow');
                         jQuery('#chkMsg').delay(3000).slideUp('slow');
                         return false;
                    }
              }
               jQuery("#actionTaken").val(jQuery(this).attr('id'));
               jQuery('#conlistForm').submit();
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
	  $('#conlistForm').submit();
     });
      
    //Run Connection sync in bg
    /*
    jQuery("#refConnections").click(function(){
	$.ajax({                    
                    url: "<?php echo SITE_URL ?>connections/bg_con_sync",
                    success: function(msg){
                            if(msg == 'no_token'){
				location.href = "<?php echo SITE_URL ?>connections/set_import_info";
			    } else if(msg == 'running_cmd'){
				jQuery("#still_populating").css('display','block');
			    }
                        }
                });
    });
    */ 
     
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
                           <h3 class="hwdtwrks dshbrd timeline_small_icon">My Setup & Data</h3>
                           
                           <!--Right Panel Starts-->
                           <section class="dshbrd-right close_to_left">
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
			      <?php if(($firstSyncProcess['Process']['status'] == 1) OR ($bgConSyncProcess['Process']['status'] == 1)){ ?>
				<div id="chkMsg" style="display:block; border:1px solid green; float;left; text-align:center; color:green; width:97%; background:#EFFEB9; margin: 0 0 10px; padding: 5px 5px 5px 10px; ">
				  Still updating your Connections.  Please use the rest of Vimbli while we complete the task. 
				</div>
			      <?php } ?>
			      
                               <!--Current Mission Section Starts-->
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
			       <span style="float:right;"><i>Last Updated: </i>
			        <?php
				if($date != ""){
				    $date = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],$date);
				    echo date('M. d, Y',strtotime($date));
				}else{
				    echo 'N/A';
				}
				?>
				</span><br>
                                    <h3>Vimbli<span>Connections</span>
                                    <div class="addimprt-btns">
					
					<!--<a class="blubtn-mid" href="<?php //echo SITE_URL ?>connections/sync_connections">-->
					<!--<a class="blubtn-mid" id="refresh" href="<?php// echo SITE_URL ?>connections/chkToken/contact">-->
					<a id="refConnections" class="blubtn-mid" id="refresh" href="<?php echo SITE_URL ?>connections/bg_con_sync"">
					    <input type="button" value="Refresh" />
                                        </a>
					<!--
					<a class="blubtn-mid" href="<?php echo SITE_URL ?>connections/set_import_info">
                                        <input type="button" value="Add More" />
                                        </a>-->
                                        <a class="blubtn-mid" href="<?php echo SITE_URL ?>connections/connection_groups">
                                        <input type="button" value="My Groups" />
                                        </a>
                                    </div>
                                    </h3>
                                    <div class="clr-b"></div>
                                    <div class="btn-wrapr">
                                        <div class="cnnctns-actns"><input class='actionButton' id="delete" type='button' name="data[Connection][action]" value="Delete"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="activate" type='button' name="data[Connection][action]" value="Activate"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="deactivate" type='button' name="data[Connection][action]" value="Deactivate"></div>
                                        
					<form action="<?php echo SITE_URL ?>connections/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>" method="post" id="searchForm" name="searchForm">
                                        <div style="float:left;" class="slctsrch">
                                             <div class="group_slctbx" style="width:130px;">
                                                 Manage Groups <img src="<?php echo SITE_URL ?>img/arrw_down_slctcat.png" alt="" />
                                                 <div class="group-slctcate-drop">
                                                     <ul>
						       <?php // pr($allGroups); exit;
						       foreach($allGroups as $group_key=>$group_val) { ?>
                                                         <li class="connection-group" group_id = "<?php echo $group_key; ?>" id="name"><a href="#"><?php echo $group_val; ?></a></li>
						     <?php } ?>
						     </ul>
                                                 </div>
                                             </div>
                                             </form>
					</div>
					
					<!--
                                        <div class="cnnctns-actns"><input class='actionButton' id="view" type='button' name="data[Connection][action]" value="View"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="edit" type='button' name="data[Connection][action]" value="Edit"></div>
                                        -->
                                   
                                   <form action="<?php echo SITE_URL ?>connections/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>" method="post" id="searchForm" name="searchForm">
                                        <div style="float:right;" class="slctsrch">
                                             <div class="slctbx">
                                                 All <img src="<?php echo SITE_URL ?>img/arrw_down_slctcat.png" alt="" />
                                                 <div class="slctcate-drop">
                                                     <ul>
                                                         <li class="searchtype" id="name"><a href="#">Name</a></li>
                                                         <li class="searchtype" id="email"><a href="#">Email</a></li>
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
                                    
                                   <form action="<?php echo SITE_URL ?>connections/perform_actions" method="post" id="conlistForm" name="conlistForm">
                                    
                                    <input id='actionTaken' type='hidden' name='data[Connection][action]' value=''>
                                    
                                    <ul class=manag-actvty>
                                        <li class="actvity-header">
                                            <section class="mng-chk"><input type="checkbox" id="all"></section>
                                            <section class="mng-actvty scdnnam">
                                            <?php echo $paginator->sort('Name', 'Connection.name'); ?>
                                            <?php //if($paginator->sortKey() == 'Connection.name'){
				//echo ' '.$html->image('admin-arrow-top.jpeg',array('border'=>0,'alt'=>'')).' '.$html->image('admin-arrow-bottom.jpeg',array('border'=>0,'alt'=>'')); 
			//}?>        
                                             <!--<img src="http://172.24.0.9:9953/img/sorting_img.png" alt="" />-->
                                             </section>
                                            <section class="mng-time scdnnam">
                                             <?php echo $paginator->sort('Email', 'Connection.email'); ?><?php if($paginator->sortKey() == 'Connection.email'){
				//echo ' '.$image; 
			}?>
                                            </section>
                                            <section class="mng-rtng">Phone</section>
                                            <section class="mng-actns scdnnam">Group<?php //echo $paginator->sort('Status', 'Connection.status'); ?><?php if($paginator->sortKey() == 'Connection.status'){
				//echo ' '.$image; 
			}?></section>
                                        </li>
                                        
                                        <?php //pr($conLists); exit;
                                        if(empty($conLists)){ ?>
                                             <li style="text-align:center;">No connection found.</li> 
                                        <?php } else { 
					     //pr($conLists); exit; ?>
					 <input id="connection-group" type="hidden" name="data[ConGroupRelation][group_id]" value="">
                                            
					 <?php   
                                        foreach($conLists as $connection) { ?>
                                        <li>
					     <section class="mng-chk"><input type="checkbox" class="allchk" name="data[Connection][ids][]" value="<?php echo $connection['Connection']['id']; ?>"></div></section>
                                            <section class="mng-actvty">
                                             <?php if($connection['Connection']['name'] != ''){
                                                  echo $html->link($connection['Connection']['name'],array('controller'=>'connections','action'=>'connection_detail',base64_encode($connection['Connection']['id'])));
                                                  //echo $connection['Connection']['name'];
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
                                                        echo substr($contactEmail,0,strlen($contactEmail)-2);
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
                                                        echo substr($contactNum,0,strlen($contactNum)-2);
                                                  } else {
                                                       echo 'N/A';
                                                  }
                                                  ?>
                                            </section>
                                            <section class="mng-time" style="width:100px !important; text-align: center">
                                             <?php
						        $conGroups = '';
						       if(!empty($connection['ConGroupRelation'])) {
                                                       
                                                        foreach($connection['ConGroupRelation'] as $groups):
                                                                $conGroups = $conGroups.$groups['ConnectionGroup']['title'].', ';
                                                        endforeach;
                                                        echo substr($conGroups,0,strlen($conGroups)-2);
						       } else {
							    echo 'N/A';
						       }
                                                   ?></section>
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
	 /* $('#refresh').click(function(){
	    $.ajax({                    
		url: "/test/mytest",
		type:"POST",
		data: usr,
		success: function(msg){
		}
	       });
	  });*/
       });
    </script>