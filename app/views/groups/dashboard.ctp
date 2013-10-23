<?php //pr($userList); die; ?>
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
.crrntprgr-list li .crntprgrss-name { width:130px; }
.crntprgrss-chrt { width:90px !important; text-align: center;}
.crntprgrss-pnsr { width: 55px;}
.crntprgrss-daly { width: 85px !important; text-align: center;}
.crntprgrss-spsr { width: 90px !important;text-align: center;}
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
      
    $('.slctbx').click(function(){
            $('.slctcate-drop').slideToggle(300);							
            });
     $('.group_slctbx').click(function(){
            $('.group-slctcate-drop').slideToggle(300);							
            });
     
});
</script>
 <script>

document.getElementById("checkbox").disabled=true;

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
                       <h3 class="hwdtwrks dshbrdgrphdn grp_db_small_icon"><?php echo $_SESSION['Auth']['User']['name'] ;?> <span>Dashboard</span></h3>
                       
                       <!--Right Panel Starts-->
                       <section class="dshbrd-right close_to_left">
                        
                            <?php echo $this->element("message/errors");?>
                            <?php echo $this->Session->flash();
				if($this->Session->flash('auth') != "You are not authorized to access that location."){
				    echo $this->Session->flash('auth');
				}
			    
			    ?>
                            
                            <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                        
                           <!--Current Mission Section Starts-->
                           <section class="current-mission manggrpdsbrd">
                                <h3>Manage&nbsp;&nbsp;<span>Users</span>
                                    <div class="addimprt-btns">
                                        <a class="blubtn-mid" href="<?php echo SITE_URL ?>groups/cohorts">
                                        <input type="button" value="Cohorts" />
                                        </a>
                                    </div>
                                </h3>
                                
                                <div class="clr-b"></div>
                                    <div class="btn-wrapr">
                                        <div class="cnnctns-actns"><input class='actionButton' id="delete" type='button' name="data[User][action]" value="Delete"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="activate" type='button' name="data[User][action]" value="Activate"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="deactivate" type='button' name="data[User][action]" value="Deactivate"></div>
                                        
					<form action="<?php echo SITE_URL ?>groups/dashboard/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>" method="post" id="searchForm" name="searchForm">
                                        <div style="float:left;" class="slctsrch">
                                             <div class="group_slctbx" style="width:130px;">
                                                 Manage Cohorts <img src="<?php echo SITE_URL ?>img/arrw_down_slctcat.png" alt="" />
                                                 <div class="group-slctcate-drop">
                                                     <ul>
						       <?php 
						       foreach($allGroups as $group_key=>$group_val) { ?>
                                                         <li class="connection-group" group_id = "<?php echo $group_key; ?>" id="name"><a href="#"><?php echo $group_val; ?></a></li>
						     <?php } ?>
						     </ul>
                                                 </div>
                                             </div>
                                             </form>
					</div>
					
                                   <form action="<?php echo SITE_URL ?>groups/dashboard/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>" method="post" id="searchForm" name="searchForm">
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
                                <form action="<?php echo SITE_URL ?>groups/perform_actions" method="post" id="conlistForm" name="conlistForm">
                                    <input id='actionTaken' type='hidden' name='data[User][action]' value=''>
                                        
                                <ul class="crrntprgr-list dhbrdgrp-lst">
                                    <li class=dhbrdgrplst-hdr>
                                        <div class="crntprgrss-ckbx all"><input type="checkbox"  id="all"/></div>
                                        <div class=crntprgrss-name>Name</div>
                                        <div class=crntprgrss-chrt>Cohort</div>
                                        <div class=crntprgrss-chrt style="width: 60px;">Sponsor</div>
                                        <div class=crntprgrss-pnsr style="width: 60px;">Mission</div>
                                        <div class=crntprgrss-daly style="width: 45px;">Total Days</div>
                                        <div class=crntprgrss-spsr style="width: 70px;">Days Left</div>
                                        <div class=crntprgrss-spsr style="width: 72px;">Last Reflection</div>
					<div class=crntprgrss-spsr style="width: 66px;">Total Ratings</div>
					<div class=crntprgrss-spsr style="width: 55px;">Access</div>
                                        <div class=crntprgrss-actn>Actions</div>
                                    </li>
                                    <?php if(!empty($userList)){?>
                                        
                                        <input id="connection-group" type="hidden" name="data[CohortUser][cohort_id]" value="">
                                       <?php
				       $userIdArr = array();
                                    foreach($userList as $row){
					if(in_array($row['User']['id'], $userIdArr) == false){
                                    ?>
                                    <li>
                                        <div class=crntprgrss-ckbx><input type="checkbox" class="allchk"  name="data[User][ids][]" value="<?php echo $row['User']['id']; ?>"/></div>
                                        <div class=crntprgrss-name style="font-family:ProximaNova-Regular;"><?php echo $row['User']['name']; ?></div>
                                        <div class="crntprgrss-chrt">
                                        <?php
                                            if(@$row['CohortUser']['Cohort']['title'] != "")
                                            echo $row['CohortUser']['Cohort']['title'];
                                            else
                                            echo "-";
                                        ?></div>
                                        <div class=crntprgrss-chrt style="width: 60px;"><?php echo $last_ref = $this->requestAction('/groups/userValues/'.$row['User']['id'].'/sponsor'); ?></div>
                                        <div class="crntprgrss-pnsr spsnrr" style="width: 60px;"><?php echo $mission = $this->requestAction('/groups/userValues/'.$row['User']['id'].'/mission'); ?></div>
                                        <div class=crntprgrss-daly style="width: 45px;"><?php echo $total_days = $this->requestAction('/groups/userValues/'.$row['User']['id'].'/total_days'); ?></div>
                                        <div class=crntprgrss-spsr style="width: 70px;"><?php echo $remaining_days = $this->requestAction('/groups/userValues/'.$row['User']['id'].'/remaining_days'); ?></div>
                                        <div class=crntprgrss-spsr style="width: 72px;"><?php echo $last_ref = $this->requestAction('/groups/userValues/'.$row['User']['id'].'/last_reflection'); ?></div>
					<div class=crntprgrss-daly style="width: 66px;"><?php echo $total_ref = $this->requestAction('/groups/userValues/'.$row['User']['id'].'/total_reflection'); ?></div>
					<div class=crntprgrss-spsr style="width: 55px;">
                                            <?php
                                                $accessLevels = '';
                                                if($row['User']['individual_payment_status'] == 1){
                                                        $accessLevels = $accessLevels.'Ind, ';
                                                }if($row['User']['group_payment_status'] == 1){
                                                        $accessLevels = $accessLevels.'Grp, ';
                                                }if(!empty($row['SponsorManager']['id'])){
                                                        $accessLevels = $accessLevels.'Sp, ';
                                                }
                                                
                                                echo substr($accessLevels,0,strlen($accessLevels)-2);
                                            ?>
                                        </div>
                                        <div class=crntprgrss-actn style="width: 100px;">
					    <?php 
						$imageName = trim($this->requestAction('/groups/userValues/'.$row['User']['id'].'/flag'));
					        if($imageName == 'yellow')
                                                    $imageName = 'flag_yellow.png';
                                                elseif($imageName == 'green')
                                                    $imageName = 'flag_green.png';
                                                elseif($imageName == 'red')
                                                    $imageName = 'flag_red.png';
						else
						    $imageName = 'flag_gray.png';
					    ?>
                                            <img src="<?php echo SITE_URL ?>img/<?php echo $imageName ?>" alt="" title="Status" />
					    
					    <a href="<?php echo SITE_URL ?>groups/add_user/<?php echo base64_encode($row['User']['id']) ?>"><img src="<?php echo SITE_URL ?>img/dshbrd_icon_edit.png" alt="" title="Edit" /></a><a href="<?php echo SITE_URL ?>groups/send_message/<?php echo base64_encode($row['User']['id']) ?>"><img src="<?php echo SITE_URL ?>img/send_msg.png" alt="" title="Message" /></a><a href="<?php echo SITE_URL ?>groups/message_list/<?php echo base64_encode($row['User']['id']) ?>"><img src="<?php echo SITE_URL ?>img/msg_list.png" alt="" title="Records" /></a></div>
                                    </li>
                                    <?php
				    $userIdArr[] = $row['User']['id'];
				    }
				    }
				    
				    } else { ?>
                                    <li>
                                        No records found. Please invite users.
                                    </li>
                                    <?php } ?>
                                </ul>
                                </form>
                                <!--Select De-Select Blue Button-->
                                <!--<section class=slctdslct><div class=blubtn-mid><input type="button" value="(DE) Select All" /></div></section>-->
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