<?php echo $this->Html->script('simpletreemenu');
    echo $this->Html->css('simpletree'); ?>
    
    <script type="text/javascript">

//ddtreemenu.createTree(treeid, enablepersist, opt_persist_in_days (default is 1))
jQuery(document).ready(function(){ 
ddtreemenu.createTree("treemenu", true, 5)
ddtreemenu.flatten('treemenu', 'collaspe')
})
</script>
    
<style>
.usrgrp-pic img {
    height: 114px !important;
    margin-right: 2px !important;
    margin-top: 2px !important;
    width: 198px !important;
}
</style>
    
<?php //pr($_SESSION['Auth']['User']); die; ?>
<section class=grayboxtop>
    <section class=grayboxbot>
        <section class=grayboxmid>
             <!--All Your Content Goes Here-->
             <!--User Group Section Starts-->
             <section class=usergroup>
                 <h4>Quick Links</h4>
                 <!--
                 <section class=usrgrp-pic>
                     <img src="<?php //echo SITE_URL ?>img/usergrp_pic.png" alt="" />
                 </section>
                 -->
             </section>
             <!--User Group Section End-->
             <!--Dashboard Content Seperater Starts-->
             <section class=dsbrd-sprtr></section>
             <!--Dashboard Left Navigation Starts-->
             <nav class=left-nav>
                <ul id="treemenu" class="treeview">
                    </li>
                    <li><img src="<?php echo SITE_URL ?>css/images/research_icon.png" alt="" class="expand-icon" /><a href="<?php echo SITE_URL ?>users/sponsor_profile">Manage Profile</a><span></span>
                    <li><img src="<?php echo SITE_URL ?>css/images/reflect_icon.png" alt="" class="expand-icon" /><a href="javascript://void()">Messages</a><span></span>
                        <ul>
                            <li class="<?php if($this->params['controller']=='messages' AND $this->params['action']=='inbox'){ ?>active<?php } ?>">
                              <a href="<?php echo SITE_URL ?>messages/inbox">Inbox</a>
                            </li>
                            <li class="<?php if($this->params['controller']=='messages' AND $this->params['action']=='sent'){ ?>active<?php } ?>">
                              <a href="<?php echo SITE_URL ?>messages/sent">Sent Items</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
                   
             </nav>
             <!--Dashboard Left Navigation End-->
             <!--Clear Div-->
             <section class=clr-b></section>
        </section>
    </section>
</section>
