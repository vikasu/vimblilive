<!--100 Percent Width Outer Footer Starts-->
<section id=foo-wrap>
    <!--Center Align Main Footer Starts-->
    <footer id=foo>
         <!--Footer Sub Links List Starts-->
         <ul class="foosub-links hottopix">
             <li class=foolnk-hdng><h3>Hot topics</h3></li>
             <li><?php echo $this->Html->link('What is the value from Onboarding?', array('controller'=>'pages', 'action'=>'display','onboarding_value')); ?></li>
             <li><?php echo $this->Html->link('How does it work?', array('controller'=>'pages', 'action'=>'display','how_it_works')); ?></li>
             <li><?php echo $this->Html->link('Which service is right for you', array('controller'=>'pages', 'action'=>'display','right_service')); ?></li>
             <li><?php echo $this->Html->link('Most read blog topics.', '/app/webroot/blog?page_id=15'); ?></li>
         </ul>
         <!--Footer Sub Links List End-->
         <!--Footer Sub Links List Starts-->
         <ul class=foosub-links>
             <li class=foolnk-hdng><h3>Company</h3></li>
             <li><?php echo $this->Html->link('About', array('controller'=>'pages', 'action'=>'display','about_us')); ?></li>
             <li><?php echo $this->Html->link('Contact', 'mailto:'.CONTACT_EMAIL); ?></li>
             <li><?php echo $this->Html->link('Blog', '/blog'); ?></li>
         </ul>
         <!--Footer Sub Links List End-->
         <!--Footer Sub Links List Starts-->
         <ul class=foosub-links>
             <li class=foolnk-hdng><h3>Products and Services</h3></li>
             <li><?php echo $this->Html->link('Services offered', array('controller'=>'pages', 'action'=>'display','services_offered')); ?></li>
             <li><?php echo $this->Html->link('Privacy', array('controller'=>'pages', 'action'=>'display','privacy')); ?></li>
             <li><?php echo $this->Html->link('Terms of Service', array('controller'=>'pages', 'action'=>'display','terms_of_services')); ?></li>
         </ul>
         <!--Footer Sub Links List End-->
         <!--Footer Sub Links List Starts-->
         <ul class="foosub-links foocontact">
             <li class=foolnk-hdng><h3>Make Contact / Stay in Touch</h3></li>
             <li><div class=foosocial><a href="http://www.facebook.com/vimbli" class="fb">Facebook</a></div><div class=foosocial><a href="#" class="flckr">Flickr</a></div><div class=foosocial><a href="https://plus.google.com/u/0/b/115828741893458865305/115828741893458865305/posts" class="stmlb-upn">G+</a></div><div class=foosocial><a href="https://twitter.com/VimIQ" class="twitter">Twitter</a></div><div class=foosocial><a href="#" class="yahoo">Yahoo</a></div><div class=foosocial><a href="mailto:<?php echo CONTACT_EMAIL ?>" class="email">Email</a></div></li>
             <li class=kontactlst><a href="#">San Francisco, <br />CA, United States.</a></li>
         </ul>
         <!--Footer Sub Links List End-->
    </footer>
    <!--Center Align Main Footer End-->
    <!--Copyright Info Starts-->
    <div class=copyrgt>Copyright &copy;Vimbli, Inc. 2012. All rights reserved.</div>
    <!--Copyright Info Ends-->
    <div style="float:left;">
        <?php echo $this->element('sql_dump'); ?>
    </div>
</section>
<!--100 Percent Width Outer Footer End-->

