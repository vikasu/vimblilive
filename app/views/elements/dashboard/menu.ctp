<!--Center Align Main Header Starts-->
<header id=header>
     <!--Left Header Include Logo-->
     <h1 class=logo title=Vimbli><?php echo $this->Html->link('Vimbli', SITE_URL); ?></h1>
     <!--Right Header Main Navigation Starts-->
     <nav id=main-nav>
         <ul class=topnav>
             <li><?php echo $this->Html->link('WHY SOS?', array('controller'=>'pages', 'action'=>'display','why_sos')); ?></li>
             <li><?php echo $this->Html->link('About', array('controller'=>'pages', 'action'=>'display','about_us')); ?></li>
             <li><?php echo $this->Html->link('Blog', SITE_URL.'blog/'); ?></li>
             <li><?php echo $this->Html->link('Contact', 'mailto:'.CONTACT_EMAIL); ?></li>
             <li><?php echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login'), array('escape'=>false)); ?></li>
             <li class=signup><?php echo $this->Html->link('Sign Up'.$this->Html->image('signup_arrow_top_right.png'), array('controller'=>'users', 'action'=>'sign_up'), array('escape'=>false)); ?></li>
         </ul>
     </nav>
     <!--Right Header Main Navigation End--> 
</header>
<!--Center Align Main Header End-->