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
		    <!--About Us-->
		    <section class=about-us>
			<h3 class=abthdn><?php echo $pagetitle; ?></h3>
			<section class=about-desc>
			  <ul>
			   <?php //echo $page_contents['Page']['content'];
			   foreach($faqList as $faq){
			    echo "<li><p><strong>".$faq['Faq']['ques']."</strong><br />";
			    echo $faq['Faq']['ans']."</p></li>";
			   }
			   ?>
			  </ul>
			  <?php  echo $this->element('admin/paging_box');?>
			</section>
		    </section>
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