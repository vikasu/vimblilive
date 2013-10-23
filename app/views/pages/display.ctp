<style>
.about-us li {
    list-style: inherit !important;
    margin-left: 40px !important;
  }
</style>
<script>
  jQuery(document).ready(function(){
    var pathname = '<?php echo $_SERVER["HTTP_HOST"]?>';
    if(pathname == 'www.vimbli.com' || pathname == 'vimbli.com'){
      jQuery('img').each(function(){
	var realSrc=jQuery(this).attr('src');
	var newSrc=realSrc.replace('../../../js/upload/','http://www.vimbli.com/beta/js/upload/');
	jQuery(this).attr('src',newSrc);
	
	var anchorSrc=jQuery(this).parent().attr('href');
	var newAnchorSrc=anchorSrc.replace('../../../js/upload/','http://www.vimbli.com/beta/js/upload/');
	jQuery(this).parent().attr('href',newAnchorSrc);
	
      });
    }
  });
</script>
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
			<h3 class=abthdn><?php echo $page_contents['Page']['title']; ?></h3>
			<section class=about-desc>
			   <?php echo $page_contents['Page']['content']; ?>
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


