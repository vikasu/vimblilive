<style>
.usrgrp-pic img { width:<?php echo GROUP_LOGO_WIDTH ?> !important; height:<?php echo GROUP_LOGO_HEIGHT ?>;}


.usrgrp-pic img {
    height: 114px !important;
    margin-right: 2px !important;
    margin-top: 2px !important;
    width: 198px !important;
}
</style>

<section class=grayboxtop>
    <section class=grayboxbot>
        <section class=grayboxmid style="min-height:600px;">
             <!--All Your Content Goes Here-->
             <!--User Group Section Starts-->
             <section class=usergroup>
                 <section class=usrgrp-pic>
                    <?php if($loginUserInfo['User']['image'] == ""){ ?>
                     <img src="<?php echo SITE_URL ?>img/usergrp_pic.png" alt="" />
                    <?php } else { ?>
                        <img src="<?php echo SITE_URL ?>files/user/medium/<?php echo $loginUserInfo['User']['image'] ?>" alt="Group Image" />
                    <?php } ?>
                 </section>
             </section>
             <!--User Group Section End-->
             <!--Dashboard Content Seperater Starts-->
             <section class=dsbrd-sprtr></section>
             <!--Dashboard Content Seperater End-->
             <!--Dashboard Left Navigation Starts-->
             <nav class=left-nav>
                 <ul>
                     <li class="<?php if($this->params['controller']=='groups' AND $this->params['action']=='dashboard'){ ?>active<?php } ?>"><a href="<?php echo SITE_URL ?>groups/dashboard">Manage Users</a><span></span></li>
                     <li><a href="<?php echo SITE_URL ?>groups/add_user">Invite new users</a><span></span></li>
                     <li><a href="<?php echo SITE_URL ?>groups/send_message">Send message</a><span></span></li>
                     <li class="<?php if($this->params['controller']=='users' AND $this->params['action']=='manage_profile'){ ?>active<?php } ?>"><a href="<?php echo SITE_URL ?>users/manage_profile">Manage Profile</a><span></span></li>
                     <li><a href="<?php echo SITE_URL ?>groups/add_sponsor">Invite Sponsor</a><span></span></li>
                     <li class="<?php if($this->params['controller']=='missions' AND $this->params['action']=='current_mission_setup'){ ?>active<?php } ?>"><a href="<?php echo SITE_URL ?>groups/shared_mission">Missions</a><span></span></li>
                    <li class="<?php if($this->params['controller']=='reflections' AND $this->params['action']=='questions'){ ?>active<?php } ?>"><a href="<?php echo SITE_URL ?>reflections/questions">Manage Questions</a><span></span></li>
                    <li class="<?php if($this->params['controller']=='groups' AND $this->params['action']=='export'){ ?>active<?php } ?>"><a href="<?php echo SITE_URL ?>groups/export">Export</a><span></span></li>
                 
                 </ul>
             </nav>
             <!--Dashboard Left Navigation End-->
             <!--Know Your Stand Starts-->
             <section class=knwstand>
                 <section class=graybxdrktop>
                     <section class=graybxdrktop-right></section>
                 </section>
                 <section class=graybxdrkmid>
                     <section class=graybxdrkmid-right>
                          <!--Content Goes Here-->
                          <h4 class="knwstnd-hdn">Watch this space</h4>
                          <br><p> Coming soon.. </p><br>
                          <input type="button" value="" class="viewmore-btn" />
                     </section>
                 </section>
                 <section class=graybxdrkbot>
                     <section class=graybxdrkbot-right></section>
                 </section>
             </section>
             <!--Know Your Stand End-->
             <!--Clear Div-->
             <section class=clr-b></section>
        </section>
    </section>
</section>