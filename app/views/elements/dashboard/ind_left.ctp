<style>
.usrgrp-pic img { width:<?php echo GROUP_LOGO_WIDTH ?> !important; height:<?php echo GROUP_LOGO_HEIGHT ?>;}


.usrgrp-pic img {
    height: 114px !important;
    margin-right: 2px !important;
    margin-top: 2px !important;
    width: 198px !important;
}



</style>
<?php echo $this->Html->script('simpletreemenu');
    echo $this->Html->css('simpletree'); ?>
  <script type="text/javascript" src="http://download.skype.com/share/skypebuttons/js/skypeCheck.js"></script>  
<script type="text/javascript">

//ddtreemenu.createTree(treeid, enablepersist, opt_persist_in_days (default is 1))
jQuery(document).ready(function(){ 
ddtreemenu.createTree("treemenu", true, 5)
ddtreemenu.flatten('treemenu', 'collaspe')
});
</script>

<section class=grayboxtop>
    <section class=grayboxbot>
        <section class=grayboxmid>
             <!--All Your Content Goes Here-->
             <!--User Group Section Starts-->
             <section class=usergroup>
                 <h4>User Group</h4>
                 <section class=usrgrp-pic>
                    <?php
                    if($loginUserInfo['User']['manager_id'] != ""){
                       $manager_details = $this->requestAction('users/return_group_logo');
                       //pr($manager_details); die;
                       $manager_image =  $manager_details['User']['image'];?>
                                <img src="<?php echo SITE_URL ?>files/user/medium/<?php echo $manager_image; ?>" alt="Group Image" />
                    <?php
                    } else {   ?> 
                            <img src="<?php echo SITE_URL ?>img/usergrp_pic.png" alt="Group Image" />
                        <?php
                    } ?>
                 </section>
             </section>
             <!--User Group Section End-->
             <!--Dashboard Content Seperater Starts-->
             <section class=dsbrd-sprtr></section>
             <!--Dashboard Content Seperater End-->
             <!--Individual User Pic Starts-->
             <!--Individual User Pic End-->
             <!--Dashboard Left Navigation Starts-->
             <nav class=left-nav>
                <ul id="treemenu" class="treeview">
                   <!--<li><a href="javascript:ddtreemenu.flatten('treemenu', 'expand')"><img src="<?php // echo SITE_URL ?>css/images/expand_blue.png" alt="" class="expand-icon" />Expand All</a><span></span></li>
                    <li><a href="javascript:ddtreemenu.flatten('treemenu', 'contact')"><img src="<?php // echo SITE_URL ?>css/images/collapse_blue.png" alt="" class="expand-icon" />Collaspe All</a><span></span></li>-->
                    <li><img src="<?php echo SITE_URL ?>css/images/journey_icon.png" alt="" class="expand-icon" /> <a href="<?php echo SITE_URL ?>users/welcome">Journey</a><span></span>
                    </li>
                
                    <li><img src="<?php echo SITE_URL ?>css/images/reflect_icon.png" alt="" class="expand-icon" /><a href="<?php echo SITE_URL ?>reflections/add_reflection" >Reflect</a><span></span>
                    </li>
                
                    <li><img src="<?php echo SITE_URL ?>css/images/refine_icon.png" alt="" class="expand-icon" /><a href="javascript://void()">Refine</a><span></span>
                        <ul>
                              <li class="">
                                   <a href="javascript://void()">Mission</a>
                                   <ul>
                                        <li class=sub_sub_li>
                                             <a href="<?php echo SITE_URL ?>groups/add_sponsor">Invite</a>
                                        </li>
                                        <li class=sub_sub_li>
                                             <a href="<?php echo SITE_URL ?>missions/current_mission_setup">Add</a>
                                        </li>
                                        <li class=sub_sub_li>
                                             <a href="<?php echo SITE_URL ?>missions/view_current_mission">Current</a>
                                        </li>
                                        <li class=sub_sub_li>
                                             <a href="<?php echo SITE_URL ?>missions/recent_missions">Recent</a>
                                        </li>
                                        <li class=sub_sub_li>
                                             <a href="<?php echo SITE_URL ?>missions/shared_mission">Shared</a>
                                        </li>
                                        <li class=sub_sub_li>
                                          <!--   <a href="<?php echo SITE_URL ?>missions/draft_mission">Draft</a> -->
                                        </li>
                                   </ul>
                              </li>
                    
                    
                              <li class="<?php if($this->params['controller']=='timeline' AND $this->params['action']=='index'){ ?>active<?php } ?>">
                              <a href="<?php echo SITE_URL ?>timelines/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>">Timeline</a>
                            </li>
                              <!--<li class="<?php //if($this->params['controller']=='activities' AND $this->params['action']=='index'){ ?>active<?php //} ?>">
                              <a href="<?php //echo SITE_URL ?>activities/index/<?php //echo base64_encode($_SESSION['Auth']['User']['id']) ?>">Activities</a>-->
                            </li>
                            <li class="<?php if($this->params['controller']=='connections' AND $this->params['action']=='index'){ ?>active<?php } ?>">
                              <a href="<?php echo SITE_URL ?>connections/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>">Connections</a>
                            </li>
                             <li class="<?php if($this->params['controller']=='settings' AND $this->params['action']=='index'){ ?>active<?php } ?>">
                              <a href="<?php echo SITE_URL ?>settings/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>">My Settings</a>
                            </li>
                           
                        
                        </ul>
                    </li>
                    <li><img src="<?php echo SITE_URL ?>css/images/research_icon.png" alt="" class="expand-icon" /><a href="javascript://void()">Research</a><span></span>
                        <ul>
                            <li><a href="<?php echo SITE_URL ?>pages/about_us">About</a></li>
                            <li><a href="<?php echo SITE_URL ?>faqs/display_faq">FAQs</a></li>
                            <li><a href="<?php echo SITE_URL ?>pages/how_it_works">Tips</a></li>
                        </ul>
                    </li>
                    
                    <li><img src="<?php echo SITE_URL ?>css/images/message_icon.png" alt="" class="expand-icon" /><a href="<?php echo SITE_URL ?>messages/send_new_message">Messages</a><span></span>
                        <!--<ul>
                            <li class="<?php// if($this->params['controller']=='messages' AND $this->params['action']=='send_new_message'){ ?>active<?php //} ?>">
                              <a href="<?php //echo SITE_URL ?>messages/send_new_message">Send a message</a>
                            </li>
                            <?php /*<li class="<?php if($this->params['controller']=='messages' AND $this->params['action']=='inbox'){ ?>active<?php } ?>">
                              <a href="<?php echo SITE_URL ?>messages/inbox">Inbox</a>
                            </li> */ ?>
                            <li class="<?php //if($this->params['controller']=='messages' AND $this->params['action']=='sent'){ ?>active<?php// } ?>">
                              <a href="<?php //echo SITE_URL ?>messages/sent">Sent Items</a>
                            </li>
                        </ul>-->
                    </li>
                    
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
                          <h4 class="knwstnd-hdn">Watch this space</h4><br/>
                          <p>Coming soon .. </p>   <br/>
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
