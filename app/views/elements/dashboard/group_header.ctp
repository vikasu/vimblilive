<style>
    .absDiv{
        position: absolute;
        border: 1px solid red;
        top:38px;
        left: 665px;
        width: 333px;
        background-color:#FDFDFC;
        border: 1px solid #EDF3F8;
    }
</style>
<script>
  $(document).ready(function(){
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
  })
</script>
<?php //echo 'asdf'; die; ?>
<!--Center Align Main Header Starts-->
    <header id=header>
         <!--Left Header Include Logo-->
         <h1 class=logo title=Vimbli><a href="<?php echo SITE_URL; ?>">Vimbli</a></h1>
         <!--Right Header Main Navigation Starts-->
         <section class="thought_details">
         <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
            <td valign="middle"><?php echo $thought['Thought']['thought_of_day'];?></td>
          </tr>
         </table>  
         </section>
         <section class="nav_dropdown">
		<section class="menu_top">
		    <a href="<?php echo SITE_URL ?>groups/dashboard">
    			<section class="muenu_top_inner">
    			  <img alt="My Gruop" src="<?php echo SITE_URL ?>img/group.png">
    			  <span>My Group</span>
    			</section>
		    </a>
		</section>
		<section class="menu_top">
		    <a href="javascript:void(0)">
		      <section class="muenu_top_inner">
      			<img alt="My Group Setup & data" src="<?php echo SITE_URL ?>img/timeline.png">
      			<span>My Group Setup <br/> & Data</span>
		      </section>
		    </a>
		    <ul class="sub_drop">
		      <li><a href="<?php echo SITE_URL ?>groups/add_user">Add new users</a></li>
		      <li><a href="<?php echo SITE_URL ?>groups/shared_mission">Manage shared missions</a></li>
		      <li><a href="<?php echo SITE_URL ?>reflections/questions">Maintain rated questions</a></li>
		      <li><a href="<?php echo SITE_URL ?>users/manage_profile">Set group profile</a></li>
		      <li><a href="<?php echo SITE_URL ?>groups/export">Export data</a></li>
		    </ul>
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
		      <li><a href="<?php echo SITE_URL ?>groups/send_message">Send messages</a></li>
		    </ul>
		</section>
		<section class="menu_top last">
		  <a href="javascript:void(0)">
      <section class="muenu_top_inner">
		    &nbsp;
		  </section>
		  </a>
		</section>
	    </section>
         <nav id=main-nav style="position: relative;">
              <span class="menu_icon"></span>
             <ul class="topnav topdashbrnav">
                 <li><a href="<?php echo SITE_URL ?>groups/dashboard"> <?php echo strtok($_SESSION['Auth']['User']['name'],' '); ?></a>&nbsp;&nbsp;|</li>
                 <li class="chageFunctnlDiv-list"><a href="javascript:void();">
                     <?php
                         if($_SESSION['Auth']['User']['user_type'] == 1){
                              echo 'Individual';
                         }elseif($_SESSION['Auth']['User']['user_type'] == 2){
                              echo 'Group';
                         }elseif($_SESSION['Auth']['User']['user_type'] == 3){
                              echo 'Sponsor';
                         }
                    ?>
                 </a>
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
                
             </ul>
	     
	     <?php
	     $actionArr = array('dashboard');
	     if(in_array($this->params['action'], $actionArr)){?>
			<!-- absolute infobox:: Start -->
			<!--<div class="absDiv">
			    <a href="mailto:support@vimbli.com" style="color: #FFBF00; font-size: 16px; float: left; padding:6px 47px; text-decoration:none;">
				Always in Beta ... Give Feedback!
			    </a>
			</div>-->
			<!-- absolute infobox:: End -->
		<?php } ?>
	      <section class="prfle_pic">
		    <?php if($loginUserInfo['User']['image'] == ""){ ?>
                     <img src="<?php echo SITE_URL ?>img/usergrp_pic.png" alt="Group" />
                    <?php } else { ?>
                        <img src="<?php echo SITE_URL ?>files/user/medium/<?php echo $loginUserInfo['User']['image'] ?>" alt="Group" />
                    <?php } ?>
       </section>
         </nav>
         <!--Right Header Main Navigation End--> 
    </header>
    <!--Center Align Main Header End-->
    

<script type="text/javascript">
/*    
jQuery(document).ready(function(){
     window.setInterval(function import_data() { //alert('here');
          $.ajax({
          url: '<?php //echo SITE_URL?>connections/import_connections',
          success: function(data) {
            //alert(data);
          }
        });
     },40000);
});*/    
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
          
	 });
</script>