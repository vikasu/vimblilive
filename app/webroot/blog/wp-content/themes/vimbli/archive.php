<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
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
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
?>

			<h1 class="page-title">
<?php if ( is_day() ) : ?>
				<?php printf( __( 'Daily Archives: <span>%s</span>', 'twentyten' ), get_the_date() ); ?>
<?php elseif ( is_month() ) : ?>
				<?php printf( __( 'Monthly Archives: <span>%s</span>', 'twentyten' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyten' ) ) ); ?>
<?php elseif ( is_year() ) : ?>
				<?php printf( __( 'Yearly Archives: <span>%s</span>', 'twentyten' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyten' ) ) ); ?>
<?php else : ?>
				<?php _e( 'Blog Archives', 'twentyten' ); ?>
<?php endif; ?>
			</h1>

<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archive.php and that will be used instead.
	 */
	 get_template_part( 'loop', 'archive' );
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
<?php get_sidebar(); ?>
<?php get_footer(); ?>
