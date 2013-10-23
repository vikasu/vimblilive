<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
<style>
div.entry-content a {
    color: #0066CC;
}

</style>
<div id="container">
<!--Center Align Inner Content Section Starts-->
<section class="content-pane about-pane" role="main">
  <!--Flexible WhiteBox With Shadows Starts-->
  <section class="whitebox">
      <section class="whiteboxtop">
	  <section class="whiteboxtop-right"></section>
      </section>
      <section class="whiteboxmid">
	  <section class="whiteboxmid-right">
	       <!--All Your Content Goes Here-->
	       <section class="aboutpane-inner">
              <div class=side_bar >
			   <?php get_sidebar(); ?>
            </div>
              <section class="about-us blog-left">
				  <?php
                /* Run the loop to output the post.
                 * If you want to overload this in a child theme then include a file
                 * called loop-single.php and that will be used instead.
                 */
                get_template_part( 'loop', 'page' );
                ?>
            </section>
	       </section>
	  </section>
      </section>
      <section class="whiteboxbot">
	  <section class="whiteboxbot-right"></section>
      </section>
  </section>
  <!--Flexible WhiteBox With Shadows End-->
</section>
<!--Center Align Inner Content Section End-->
</div>
<?php get_footer(); ?>
