<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

<style>
    .class_center {  width: 100%; margin-bottom: 24px;}
    .class_right {  float: right; margin-bottom: 24px;}
    .class_none { float: left; width: 100%; margin-bottom: 24px;}
</style>
<Script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></Script>
<script>
    $(document).ready(function(){
	$('.entry-content img').each(function(){
	   
	   var imageclass = $(this).attr('class');
	   
	   if(imageclass != ""){
	    imageclass = imageclass;
	   } else{
	    imageclass = 'test';
	   }
	   
	   
	   if(imageclass.indexOf('alignright') >= 0){
    	    $(this).parent().parent().addClass('class_right');
	   }
	   else if(imageclass.indexOf('aligncenter') >= 0){
	    $(this).css('float','none');
	    $(this).parent().parent().addClass('class_center');
	   }
	   else if(imageclass.indexOf('alignnone') >= 0){
	    $(this).css('float','none');
	    $(this).parent().parent().addClass('class_none');
	   }
	});
    });
</script>

<section id="content-wrap">
  
<!--Center Align Inner Content Section Starts-->
<section class="content-pane about-pane">
  <!--Flexible WhiteBox With Shadows Starts-->
  <section class="whitebox">
      <section class="whiteboxtop">
	  <section class="whiteboxtop-right"></section>
      </section>
      <section class="whiteboxmid">
	  <section class="whiteboxmid-right">
	       <!--All Your Content Goes Here-->
	       <section class="aboutpane-inner">
            <!--SideBar-->
            <div class=side_bar >
					<?php get_sidebar(); ?>
			  </div>
		    <!--About Us-->
		    <section class="about-us blog-left">
			     <section class="about-desc">
				<!-- #container -->
				   <div id="post_content" role="main">
					<?php
					/* Run the loop to output the posts.
					 * If you want to overload this in a child theme then include a file
					 * called loop-index.php and that will be used instead.
					 */
					 get_template_part( 'loop', 'index' );
					?>
				</div>
				<!-- #container -->
			   </section>
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


  
</section>
		
<?php get_footer(); ?>
