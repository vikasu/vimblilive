<style>
.mng-actns img {margin-right:0px;}
.mng-chk { width:20px; }
.mng-actvty { width:230px; }
.mng-time { width: 250px !important;}
.mng-rtng { width: 180px;}
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
                           <h3 class="hwdtwrks dshbrd msg_small_icon">My Messages</h3>
                           
                           <!--Right Panel Starts-->
                           <section class="dshbrd-right close_to_left">
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Current Mission Section Starts-->
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
                                    <h3>Inbox<span></span>
                                    <div class="addimprt-btns">
                                        <a class="blubtn-mid" href="<?php echo SITE_URL ?>messages/send_new_message">
                                        <input type="button" value="Send Message" />
                                        </a>
                                    </div>
                                    </h3>
                                    <div class="clr-b"></div>
                                    <div class="btn-wrapr">
                                        <div class="cnnctns-actns"><input class='actionButton' id="delete" type='button' name="data[Message][action]" value="Delete"></div>
                                        
                                   <form action="<?php echo SITE_URL ?>messages/inbox" method="post" id="searchForm" name="searchForm">
                                        <div style="float:right;" class="slctsrch">
                                             <div class="slctbx">
                                                 All <img src="<?php echo SITE_URL ?>img/arrw_down_slctcat.png" alt="" />
                                                 <div class="slctcate-drop">
                                                     <ul>
                                                         <li class="searchtype" id="subject"><a href="#">Subject</a></li>
                                                         <li class="searchtype" id="content"><a href="#">Content</a></li>
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
                                    
                                   <form action="<?php echo SITE_URL ?>messages/perform_actions" method="post" id="conlistForm" name="conlistForm">
                                    
                                    <input id='actionTaken' type='hidden' name='data[Message][action]' value=''>
                                    
                                    <ul class=manag-actvty>
                                        <li class="actvity-header">
                                            <section class="mng-chk"><input type="checkbox" id="all"></section>
                                            <section class="mng-actvty scdnnam">
                                            <?php echo $paginator->sort('Subject', 'Message.subject'); ?>
                                            </section>
                                            <section class="mng-time scdnnam">
                                             <?php echo $paginator->sort('Content', 'Message.content'); ?>
					    </section>
					    <section class="mng-rtng">
                                             <?php echo $paginator->sort('From', 'User.name'); ?>
					    </section>
					    <section class="mng-actns scdnnam">
                                             <?php echo $paginator->sort('Date', 'Message.local_message_time'); ?>
					    </section>
                                        </li>
                                        
                                        <?php 
                                        if(empty($msgList)){ ?>
                                             <li style="text-align:center;">No Record found.</li> 
                                        <?php } else { 
					     ?>
					 <input id="connection-group" type="hidden" name="data[ConGroupRelation][group_id]" value="">
                                            
					 <?php   
                                        foreach($msgList as $row) { ?>
                                        <li>
					     <section class="mng-chk"><input type="checkbox" class="allchk" name="data[Message][ids][]" value="<?php echo $row['Message']['id']; ?>"></div></section>
                                            <section class="mng-actvty">
                                             <?php if($row['Message']['subject'] != ''){
                                                  echo $html->link($row['Message']['subject'],array('controller'=>'timelines','action'=>'message_detail',base64_encode($row['Message']['id'])));
                                                  
					     } else {
						  echo 'N/A';
					     }
                                             ?>
                                            </div></section>
                                            <section class="mng-time">
					    <?php if($row['Message']['content'] != ''){
                                                  echo substr(htmlspecialchars_decode($row['Message']['content']),0,150);
                                                  
					     } else {
						  echo 'N/A';
					     }
                                             ?></section>
                                            <section class="mng-rtng">
                                                  <?php if($row['Message']['from_user_id'] != ''){
						    echo $row['User']['name'];
                                                    } else {
							 echo 'N/A';
						    }
						    ?>
                                            </section>
                                            <section class="mng-time" style="width:70px;">
                                             <?php if($row['Message']['local_message_time'] != '' AND $row['Message']['local_message_time'] != '0000-00-00 00:00:00'){
                                                  echo date('M. d, Y',strtotime($row['Message']['local_message_time']));
                                                  
					     } else {
						  echo 'N/A';
					     }
                                             ?>
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