<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: VIMBLI ::</title>
<!--[if lt IE 9]>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php echo'here'; exit;
echo $this->Html->css('style');
echo $this->Html->css('fontz');
echo $this->Html->script('jquery-latest');
echo $this->Html->script('custom');
?>

</head>
<body class="inner_body">
<!--100 Percent Width Header Outer Wrapper Starts-->
<section id=header-wrap>
    <!--Center Align Main Header Starts-->
    <header id=header>
         <!--Left Header Include Logo-->
         <h1 class=logo title=Vimbli><?php echo $this->Html->link('Vimbli', array('controller'=>'homes', 'action'=>'index')); ?></a></h1>
         <!--Right Header Main Navigation Starts-->
         <nav id=main-nav>
             <ul class=topnav>
                 <li><a href="#">WHY SOS?</a></li>
                 <li><a href="#">About</a></li>
                 <li><a href="#">Contact</a></li>
                 <li><?php echo $this->Html->link('Login', array('controller'=>'users', 'action'=>'login')); ?></li>
                 <li class=signup><?php echo $this->Html->link('Sign Up'.$this->Html->image('signup_arrow_top_right.png', array('SignUp' => 'CakePHP')), array('controller'=>'users', 'action'=>'registration'), array('escape'=>false)); ?></li>
             </ul>
         </nav>
         <!--Right Header Main Navigation End--> 
    </header>
    <!--Center Align Main Header End-->
</section>
<!--100 Percent Width Header Outer Wrapper End-->
<!--Main Content Starts-->
<section id=content-wrap>
    <!--Center Align Inner Content Section Starts-->
    <section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
                          <!--SignUp Heading-->
                          <div class=signup-hdng><h3 class=bebas>sign-up  on  <span>vimbli</span></h3></div>
                          <!--SignUp Form Fields-->
                          <ul class=form-fields>
                              <li><div class=textbox><span><input type="text" value="" placeholder="Name" /></span></div></li>
                              <li><div class=textbox><span><input type="text" value="" placeholder="Email" /></span></div></li>
                              <li><div class=textbox><span><input type="password" value="" placeholder="Password" /></span></div><div class=pwdtrngth></div></li>
                              <li class=dob><div class=textbox><span><input type="text" value="" placeholder="Month" /></span></div><div class="textbox year"><span><input type="text" value="" placeholder="Year" /></span></div><div class="textbox date"><span><input type="text" value="" placeholder="Email" /></span></div></li>
                              <li><div class=checkbox></div><div class=terms>Terms-of-Use / Privacy agreement</div></li>
                              <li class=staysignd><div class="checkbox chkd"></div><div class=terms>Stay signed in on this computer / device</div></li>
                              <li><div class=signuplogin-btn><input type="button" value="Register" /></div></li>
                          </ul>
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
</section>
<!--Main Content End-->
<!--100 Percent Width Outer Footer Starts-->
<section id=foo-wrap>
    <!--Center Align Main Footer Starts-->
    <footer id=foo>
         <!--Footer Sub Links List Starts-->
         <ul class="foosub-links hottopix">
             <li class=foolnk-hdng><h3>Hot topics</h3></li>
             <li><a href="#">What is the value from Onboarding?</a></li>
             <li><a href="#">How does it work?</a></li>
             <li><a href="#">Which service is right for you</a></li>
         </ul>
         <!--Footer Sub Links List End-->
         <!--Footer Sub Links List Starts-->
         <ul class=foosub-links>
             <li class=foolnk-hdng><h3>Company</h3></li>
             <li><a href="#">About</a></li>
             <li><a href="#">Contact</a></li>
             <li><a href="#">Blog</a></li>
         </ul>
         <!--Footer Sub Links List End-->
         <!--Footer Sub Links List Starts-->
         <ul class=foosub-links>
             <li class=foolnk-hdng><h3>Products and Services</h3></li>
             <li><a href="#">Services offered</a></li>
             <li><a href="#">Privacy</a></li>
             <li><a href="#">Terms of Service</a></li>
         </ul>
         <!--Footer Sub Links List End-->
         <!--Footer Sub Links List Starts-->
         <ul class="foosub-links foocontact">
             <li class=foolnk-hdng><h3>Make Contact / Stay in Touch</h3></li>
             <li><div class=foosocial><a href="#" class="fb">Facebook</a></div><div class=foosocial><a href="#" class="flckr">Flickr</a></div><div class=foosocial><a href="#" class="stmlb-upn">Stumble Upon</a></div><div class=foosocial><a href="#" class="twitter">Twitter</a></div><div class=foosocial><a href="#" class="yahoo">Yahoo</a></div><div class=foosocial><a href="#" class="email">Email</a></div></li>
             <li class=kontactlst><a href="#">San Francisco, <br />CA, United States.</a></li>
         </ul>
         <!--Footer Sub Links List End-->
    </footer>
    <!--Center Align Main Footer End-->
    <!--Copyright Info Starts-->
    <div class=copyrgt>Copyright &copy;vimbli.com 2012. All rights reserved.</div>
    <!--Copyright Info Ends-->
</section>
<!--100 Percent Width Outer Footer End-->
</body>
</html>
