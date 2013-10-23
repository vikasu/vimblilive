<?php //pr($userList); die; ?>
<style>
.mng-actns img {margin-right:0px;}
.mng-chk { width:20px; }
.mng-actvty { width:180px; }
.mng-time { width:335px !important;}
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
      
    $('.slctbx').click(function(){
            $('.slctcate-drop').slideToggle(300);							
            });
     $('.group_slctbx').click(function(){
            $('.group-slctcate-drop').slideToggle(300);							
            });
     
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
                       <h3 class="hwdtwrks dshbrdgrphdn">Group <span>Dashboard</span></h3>
                       <!--Left Panel Starts-->
                       <section class=dshbrd-left>
                           <?php echo $this->element('dashboard/group_left'); ?>
                       </section>
                       <!--Left Panel End-->
                       <!--Right Panel Starts-->
                       <section class=dshbrd-right>
                        
                            <?php echo $this->element("message/errors");?>
                            <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                            
                            <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                        
                           <!--Current Mission Section Starts-->
                           <section class="current-mission manggrpdsbrd">
                                <h3>Message&nbsp;&nbsp;<span>Listing</span>
                                    
                                </h3>
                                
                                <div class="clr-b"></div>
				    
                                   <div class="clr-b"></div>
                                <form action="<?php echo SITE_URL ?>groups/perform_actions" method="post" id="conlistForm" name="conlistForm">
                                    <input id='actionTaken' type='hidden' name='data[User][action]' value=''>
                                        
                                <ul class=manag-actvty>
				    
				    <li class=dhbrdgrplst-hdr>
                                        <section class="mng-actvty" style="font-weight:bold; color:#1560AC;">Subject</section>
					<section class="mng-time" style="font-weight:bold; color:#1560AC;">Content</section>
                                        <section class="mng-rtng" style="font-weight:bold; color:#1560AC;">Date</section>
                                    </li>
				    
				<?php //pr($activityList); exit;
				if(empty($allMessages)){ ?>
				     <li style="text-align:center;">No message found.</li> 
				<?php } else { 
				     //pr($allEmails); exit; ?>
				    
				 <?php  $i = 0;  
				foreach($allMessages as $message) {
				     $i = $i+1; ?>
				    
				<li>
				    <section class="mng-actvty" style="width: 157px;">
				     <?php if($message['Message']['subject'] != ''){
					  echo $html->link(htmlspecialchars_decode($message['Message']['subject']),array('controller'=>'timelines','action'=>'message_detail',base64_encode($message['Message']['id'])));
					  //echo $connection['Connection']['name'];
				     } else {
					  echo 'N/A';
				     }
				     ?>
				    </div></section>
				    <section class="mng-time">
				    <?php if($message['Message']['content'] != ''){
					  echo substr(htmlspecialchars_decode($message['Message']['content']),0,100).'...';
				     } else {
					  echo 'N/A';
				     }
				     ?>
			   
				    </section>
				    <section class="mng-rtng" style="width:146px;">
					<?php if(($message['Message']['local_message_time'] != '') AND ($message['Message']['local_message_time'] != '0000-00-00 00:00:00')) {
					      echo date('M. d, Y h:i a',strtotime($message['Message']['local_message_time']));
					 } else {
					    echo 'N/A';
					}
					?>
					 
				    </section>
				</li>
				<?php } } ?>
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