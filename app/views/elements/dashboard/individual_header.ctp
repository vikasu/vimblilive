<style>
    .absDiv{
        position: absolute;
        border: 1px solid red;
        top:38px;
        left: 660px;
        width: 333px;
        background-color:#FDFDFC;
        border: 1px solid #EDE3F8;
    }
  
</style>

<?php //pr($this->params); die;?>
<script type="text/javascript">

jQuery(document).ready(function(){
	jQuery('.chageFunctnlDiv-list').on('click',function(){
			 jQuery('.chageFunctnlDiv').toggle();	  
		 });
          jQuery('.funArea').click(function(){
               jQuery.ajax({
                  url: '<?php echo SITE_URL ?>users/changeFunView/'+jQuery(this).attr("fun_area_type"),
                  success: function(msg) {
                                   window.location=msg;
                    }
               });
          });
	  
	   $('.menu_icon').click(function(){
              $(this).parents('#header').find('.nav_dropdown').slideToggle();
              $(this).toggleClass('menu_icon_hover');
          });
	  
	  $('.muenu_top_inner').click(function(){
	             var me=$(this);
	             var my_m_top=$(me).parents(".menu_top");
	            $(me).parents('.nav_dropdown').find(".menu_top").not(my_m_top).find('.sub_drop').slideUp();
              $(this).parents('.menu_top').find('.sub_drop').slideToggle();
          });
    $('.sub_drop li:last-child').css('bordeBottom','none');
    $('.sub_drop li a').click(function(){
      $(this).parent().find('.subsub_drop').slideToggle();
    })
	 });
</script>


<!--Center Align Main Header Starts-->
    <header id=header>
         <!--Left Header Include Logo-->
         <h1 class=logo title=Vimbli><a href="<?php echo SITE_URL; ?>">Vimbli
         </a></h1>
         <section class="thought_details">
         <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="middle"><?php echo $thought['Thought']['thought_of_day'];?></td>
          </tr>
         </table>  
         </section>
         <section class="nav_dropdown">
	 <?php if($_SESSION['Auth']['User']['user_type'] == 3){ //Menu for sponsor ?>
		<section class="menu_top">
		    <a href="<?php echo SITE_URL ?>users/welcome_sponsor">
    			<section class="muenu_top_inner">
    			  <img alt="My Sponsorship" src="<?php echo SITE_URL ?>img/sponsorship.png">
    			  <span>My Sponsorships</span>
    			</section>
		    </a>
		</section>
		<section class="menu_top">
		    <a href="<?php echo SITE_URL ?>users/sponsor_profile">
		      <section class="muenu_top_inner">
      			<img alt="My Setup" src="<?php echo SITE_URL ?>img/timeline.png">
      			<span>My Setup</span>
		      </section>
		    </a>
		</section>
		<section class="menu_top">
		  <a href="javascript:void(0)">
		<section class="muenu_top_inner">
		    <img alt="More" src="<?php echo SITE_URL ?>img/more.png">
		    <span>More</span>
		  </section>
		  </a>
		    <ul class="sub_drop">
		      <li><?php echo $html->link('Logout',array('controller'=>'users','action'=>'logout'),array('style'=>'color:#000')); ?></li>
		      <li><a href="<?php echo SITE_URL ?>messages/inbox">My Messages</a></li>
		    </ul>
		</section>
		<section class="menu_top last">
		  <a href="javascript:void(0)">
		<section class="muenu_top_inner">
		    
		  </section>
		  </a>
		</section>
	 <?php }else{ //Menu for Individual ?>
		<section class="menu_top">
		    <a href="<?php echo SITE_URL ?>users/welcome">
    			<section class="muenu_top_inner">
    			  <img alt="My Status" src="<?php echo SITE_URL ?>img/status.png">
    			  <span>My Status</span>
    			</section>
		    </a>
		</section>
		<section class="menu_top">
		    <a href="<?php echo SITE_URL ?>reflections/add_reflection">
		      <section class="muenu_top_inner">
      			<img alt="My Thoughts & Reflections" src="<?php echo SITE_URL ?>img/reflection.png">
      			<span>My Thoughts & <br/> Reflections</span>
		      </section>
		    </a>
		</section>
		<section class="menu_top">
		  <a href="javascript:void(0)">
		<section class="muenu_top_inner">
			      <img alt="My Setup & Data" src="<?php echo SITE_URL ?>img/timeline.png">
			      <span>My Setup & <br/> Data</span>
			    </section>
			    </a>
			      <ul class="sub_drop">
				<li><a href="#">mission</a>
		      <ul class="subsub_drop">
			<li><a href="<?php echo SITE_URL ?>missions/current_mission_setup">Add new mission</a></li>
			<li><a href="<?php echo SITE_URL ?>missions/view_current_mission">View current mission</a></li>
			<li><a href="<?php echo SITE_URL ?>missions/recent_missions">View recent missions</a></li>
			<li><a href="<?php echo SITE_URL ?>missions/shared_mission">View shared missions</a></li>
			<li><a href="<?php echo SITE_URL ?>groups/add_sponsor">Invite a sponsor</a></li>
		      </ul>
		    </li>
		      <li><a href="<?php echo SITE_URL ?>timelines/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>">timeline</a></li>
		      <li><a href="<?php echo SITE_URL ?>connections/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>">connections</a></li>
		      <li><a href="<?php echo SITE_URL ?>settings/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>">my settings</a></li>
		    </ul>
		</section>
		<section class="menu_top last">
		  <a href="javascript:void(0)">
		<section class="muenu_top_inner">
		    <img alt="More" src="<?php echo SITE_URL ?>img/more.png">
		    <span>More</span>
		  </section>
		  </a>
		    <ul class="sub_drop">
		      <li><?php echo $html->link('Logout',array('controller'=>'users','action'=>'logout'),array('style'=>'color:#000')); ?></li>
		      <li><a href="<?php echo SITE_URL ?>messages/send_new_message">Message</a></li>
		      <li><a href="http://wp.me/p3AAlx-74">Making the most of Vimbli</a></li>
		      <li><a href="http://vimbli.freshdesk.com/support/home">FAQs</a></li>
		      <li><a href="<?php echo SITE_URL ?>app/webroot/blog/most-read-blog-topics">Related content</a></li>
		    </ul>
		</section>
	    <?php } ?>
	</section>
	
         <!--Right Header Main Navigation Starts-->
         <nav id=main-nav class="fix_head_info" style="position: relative;">
	    <span class="menu_icon"></span>
             <ul class="topnav topdashbrnav">
             <!--<li><a href="#" class="top_msg"><img src="<?php echo SITE_URL ?>img/top_msg.png" /></a>&nbsp;&nbsp;|</li>--> 
	     <?php if($loginUserInfo['User']['dormant_user'] != 1) { ?>
               <?php if($_SESSION['Auth']['User']['user_type'] == 3){ //sponsor?>
                 <li><a href="<?php echo SITE_URL ?>users/welcome_sponsor"><?php echo strtok($_SESSION['Auth']['User']['name'],' '); ?></a>&nbsp;&nbsp;|</li>
               <?php }else{ //sponsor ?>
                    <li><a href="<?php echo SITE_URL ?>users/welcome"><?php echo strtok($_SESSION['Auth']['User']['name'],' '); ?></a>&nbsp;&nbsp;|</li>
               <?php } ?>
                 <li class="chageFunctnlDiv-list"><a id="current_level" href="javascript:void();">
                    <?php
                         if($_SESSION['Auth']['User']['user_type'] == 1){
                              echo 'Individual';
                         }elseif($_SESSION['Auth']['User']['user_type'] == 2){
                              echo 'Group';
                         }elseif($_SESSION['Auth']['User']['user_type'] == 3){
                              echo 'Sponsor';
                         } elseif($this->params['action'] == 'set_import_info'){
                              echo 'Individual';
			      $_SESSION['Auth']['User']['user_type'] = 1;
                         } 
	     } else{ ?>
			<li><a href="javascript:void(0)"><?php echo strtok($_SESSION['Auth']['User']['name'],' '); ?></a>&nbsp;&nbsp;|</li>
		<?php }?>
                 </a>&nbsp;&nbsp;
                    <section class="chageFunctnlDiv">
                       <img src="<?php echo SITE_URL ?>css/images/white_top_arrow.png" alt="" class="arrowtop" />
                        <ul>
                         <?php if($loginUserInfo['User']['individual_payment_status'] != 0){ ?>
                           <li><a href="javascript:void(0);" class="funArea" fun_area_type="1"><img src="<?php echo SITE_URL ?>css/images/individual.png" alt=""/>Individual</a></li>
                         <?php } if($loginUserInfo['User']['group_payment_status'] != 0){ ?>
                           <li><a href="javascript:void(0);" class="funArea" fun_area_type="2"><img src="<?php echo SITE_URL ?>css/images/groups.png" alt=""/>Group</a></li>
                         <?php } if($isSponsorToo != 0){ ?>
                           <li><a href="javascript:void(0);" class="funArea" fun_area_type="3"><img src="<?php echo SITE_URL ?>css/images/sponsor.png" alt=""/>Sponsor</a></li>
                         <?php } ?>
                        </ul>
		    </section>
                 </li>
                 <!--<li><?php// echo $html->link('Logout',array('controller'=>'users','action'=>'logout'),array('style'=>'color:#000')); ?>
</li>-->
                  
             </ul>
	     <?php if($_SESSION['Auth']['User']['user_type'] != 3){ //Not sponsor?>
	     <section class="prfle_pic">
		 <?php
                    if($loginUserInfo['User']['manager_id'] != ""){
                       $manager_details = $this->requestAction('users/return_group_logo');
                       //pr($manager_details); die;
                       $manager_image =  $manager_details['User']['image'];?>
                                <img src="<?php echo SITE_URL ?>files/user/medium/<?php echo $manager_image; ?>" alt="Group" />
                    <?php
                    } else {   ?> 
                            <img src="<?php echo SITE_URL ?>img/usergrp_pic.png" alt="Group" />
                        <?php
                    } ?>
		<!--<img src="<?php //echo SITE_URL ?>img/dummy.jpg" />-->
		
	     <?php
	     $actionArr = array('welcome','display');
	     if(in_array($this->params['action'], $actionArr)){?>
			<!-- absolute infobox:: Start -->
			<!--<div class="absDiv">
			    <a href="mailto:support@vimbli.com" style="color: #FFBF00; font-size: 16px; float: left; padding:6px 47px; text-decoration:none;">
				Always in Beta ... Give Feedback!
			    </a>
			</div>-->
			<!-- absolute infobox:: End -->
		<?php } ?>
       </section>
	<?php } ?>     
	     
         </nav>
         <!--Right Header Main Navigation End--> 
    </header>
    <!--Center Align Main Header End-->