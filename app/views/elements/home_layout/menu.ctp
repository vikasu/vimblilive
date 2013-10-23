<!--Center Align Main Header Starts-->
<header id=header>
     <!--Left Header Include Logo-->
     <h1 class=logo title=Vimbli><?php echo $this->Html->link('Vimbli', SITE_URL); ?></h1>
     <!--Right Header Main Navigation Starts-->
     <nav id=main-nav style="position: relative;">
         <ul class=topnav>
             <li><?php echo $this->Html->link('WHY SOS?','http://vimbli.com/pages/why_sos'); ?></li>
             <li><?php echo $this->Html->link('About','http://vimbli.com/pages/about_us'); ?></li>
             <li><?php echo $this->Html->link('Blog','http://vimbli.com/app/webroot/blog/'); ?></li>
             <li><?php echo $this->Html->link('Contact', 'mailto:'.CONTACT_EMAIL); ?></li>
             <li><?php echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login'), array('escape'=>false)); ?></li>
             <li class=signup><?php echo $this->Html->link('Sign Up'.$this->Html->image('signup_arrow_top_right.png'), array('controller'=>'users', 'action'=>'sign_up'), array('escape'=>false)); ?>
               <?php //echo $this->Html->link('Sign Up'.$this->Html->image('signup_arrow_top_right.png'), "http://signmeup.vimbli.com/", array('escape'=>false)); ?>
             </li>
         </ul>
         
        <!-- absolute infobox:: Start -->
        <!--<div class="absDiv">
            <a href="mailto:support@vimbli.com" style="color: #FFBF00; font-size: 16px; float: left; padding:6px 40px; text-decoration:none;">
                Always in Beta ... Give Feedback!
            </a>
        </div>-->
        <!-- absolute infobox:: End -->
         
     </nav>
     <!--Right Header Main Navigation End--> 
</header>
<!--Center Align Main Header End-->

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