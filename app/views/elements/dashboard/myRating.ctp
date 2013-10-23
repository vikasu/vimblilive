<!-- Script for submit form -->
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".select_rating").change(function(){
            jQuery(".content-pane").addClass('blurDiv');
	    jQuery("#loaderDiv").show();
            jQuery("#ratingFrm").submit();
        });
    });
    
    //load the cliders after 0.5 seconds of page load.
      setTimeout(show_my_rating,1000);
      function show_my_rating(){
           jQuery(".my_rating_box").slideDown();
      }
</script>
<style>
   .my_rating_box{ display:none;}
</style>

<form name="ratingFrm" id="ratingFrm" method="POST" action="<?php echo SITE_URL ?>users/welcome">
 <!--My Rating Section Starts-->
   <section class="dshbrd-right dshbrd-right-new bottom_sprtr">
      <h3 style="padding-top: 7px; padding-bottom:25px;">My<span>Satisfaction
      </span></h3>
   <section class = "my_rating_box">
      <!--Stars Rating Section Starts-->
      <section class="star_rating side_bg">
        <a class="dcrtn_none star_img" href="javascript:void(0)">
          <?php
                $ratingNumber = number_format((float)$final_rating, 1, '.', ''); 
		$explodeRatingNumber = explode('.',$ratingNumber); 
		$ratingBeforeDecimal = $explodeRatingNumber[0];
		$ratingAfterDecimal = $explodeRatingNumber[1];
		if($ratingBeforeDecimal <= 3){
			if($ratingBeforeDecimal == 0){
				if($ratingAfterDecimal == 1 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.1.png"/>';
				}elseif($ratingAfterDecimal == 2){
					echo '<img src= "'.SITE_URL.'img/stars/1.2.png"/>';
				}elseif($ratingAfterDecimal == 3){
					echo '<img src= "'.SITE_URL.'img/stars/1.3.png"/>';
				}elseif($ratingAfterDecimal == 4 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.4.png"/>';
				}elseif($ratingAfterDecimal == 5 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.5.png"/>';
				}elseif($ratingAfterDecimal == 6 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.6.png"/>';
				}elseif($ratingAfterDecimal == 7 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.7.png"/>';
				}elseif($ratingAfterDecimal == 8 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.8.png"/>';
				}elseif($ratingAfterDecimal == 9 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.9.png"/>';
				}else{
					echo '<img src= "'.SITE_URL.'img/stars/empty_star.png"/>';
				}
				echo '<img src= "'.SITE_URL.'img/stars/empty_star.png"/>';
				echo '<img src= "'.SITE_URL.'img/stars/empty_star.png"/>';
			}elseif($ratingBeforeDecimal == 1){
				echo '<img src= "'.SITE_URL.'img/stars/full_star.png"/>';
				if($ratingAfterDecimal == 1 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.1.png"/>';
				}elseif($ratingAfterDecimal == 2){
					echo '<img src= "'.SITE_URL.'img/stars/1.2.png"/>';
				}elseif($ratingAfterDecimal == 3){
					echo '<img src= "'.SITE_URL.'img/stars/1.3.png"/>';
				}elseif($ratingAfterDecimal == 4 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.4.png"/>';
				}elseif($ratingAfterDecimal == 5 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.5.png"/>';
				}elseif($ratingAfterDecimal == 6 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.6.png"/>';
				}elseif($ratingAfterDecimal == 7 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.7.png"/>';
				}elseif($ratingAfterDecimal == 8 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.8.png"/>';
				}elseif($ratingAfterDecimal == 9 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.9.png"/>';
				}else{
					echo '<img src= "'.SITE_URL.'img/stars/empty_star.png"/>';
				}
				echo '<img src= "'.SITE_URL.'img/stars/empty_star.png"/>';
			}elseif($ratingBeforeDecimal == 2){
				echo '<img src= "'.SITE_URL.'img/stars/full_star.png"/>';
				echo '<img src= "'.SITE_URL.'img/stars/full_star.png"/>'; 
				if($ratingAfterDecimal == 1 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.1.png"/>';
				}elseif($ratingAfterDecimal == 2){
					echo '<img src= "'.SITE_URL.'img/stars/1.2.png"/>';
				}elseif($ratingAfterDecimal == 3){
					echo '<img src= "'.SITE_URL.'img/stars/1.3.png"/>';
				}elseif($ratingAfterDecimal == 4 ){
					echo '<img src= "'.SITE_URL.'img/stars/img/stars/1.4.png"/>';
				}elseif($ratingAfterDecimal == 5 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.5.png"/>';
				}elseif($ratingAfterDecimal == 6 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.6.png"/>';
				}elseif($ratingAfterDecimal == 7 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.7.png"/>';
				}elseif($ratingAfterDecimal == 8 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.8.png"/>';
				}elseif($ratingAfterDecimal == 9 ){
					echo '<img src= "'.SITE_URL.'img/stars/1.9.png"/>';
				}else{
					echo '<img src= "'.SITE_URL.'img/stars/empty_star.png"/>';
				}
				
			}elseif($ratingBeforeDecimal == 3 && $ratingAfterDecimal == 0){
				echo '<img src= "'.SITE_URL.'img/stars/full_star.png"/>';
				echo '<img src= "'.SITE_URL.'img/stars/full_star.png"/>';
				echo '<img src= "'.SITE_URL.'img/stars/full_star.png"/>'; 
			}
		}
            
          ?>
        </a>
        <span><?php echo $final_rating; ?>/3</span>
        <p><?php echo $ratingVal; ?></p>
         <div class="rate_now_btn">
            <a href="<?php echo SITE_URL ?>reflections/add_reflection">
               <div class="blubtn-big blubtn_new rating_button">
                 <input type="button" value="Rate Now">
               </div>
            </a>
         </div>
      </section>
      <!--Stars Rating Section Ends-->
      <!--Rated Section Starts-->
      <section class="outer_boxes side_bg">
        <section class="iner_info">
            <h3 class="grey_hdng_small">What did I rate?</h3>
            <p>Days with Reflections <?php echo $total_rated_days; ?> of <?php echo $total_days; ?></p>
            <p>Rated events in the period <?php echo $total_rated_events; ?> of <?php echo $total_events; ?></p>
            <div class="outer_blu_btn">
               <a href="<?php echo SITE_URL ?>timelines/index/<?php echo base64_encode($_SESSION['Auth']['User']['id']) ?>/rated">
                  <div class="blubtn-big blubtn_new rating_button">
                    <input type="button" value="Details">
                  </div>
               </a>
            </div>
        </section>
      </section>
      <!--Rated Section Ends-->
      <!--Settings Section Starts-->
      <section class="outer_boxes">
        <section class="iner_info">
            <h3 class="grey_hdng_small">settings</h3>
            <select class="select_action_new select_rating" name="data[Rating][time_frame]">
                <option value="Day" <?php if(isset($_SESSION["Rating"]["time_frame"]) AND $_SESSION["Rating"]["time_frame"] == "Day"){?> selected="selected" <?php } ?>>Day</option>
                <option value="Week" <?php if(isset($_SESSION["Rating"]["time_frame"]) AND $_SESSION["Rating"]["time_frame"] == "Week"){?> selected="selected" <?php } ?>>Week</option>
                <option value="Month" <?php if(isset($_SESSION["Rating"]["time_frame"]) AND $_SESSION["Rating"]["time_frame"] == "Month"){?> selected="selected" <?php } ?>>Month</option>
                <option value="Mission" <?php if(isset($_SESSION["Rating"]["time_frame"]) AND $_SESSION["Rating"]["time_frame"] == "Mission"){?> selected="selected" <?php } ?>>Mission</option>
                <option value="Year" <?php if(isset($_SESSION["Rating"]["time_frame"]) AND $_SESSION["Rating"]["time_frame"] == "Year"){?> selected="selected" <?php } ?>>Year</option>
            </select>
            <select class="select_action_new select_rating" name="data[Rating][activity_type]">
                <option value="Reflection" <?php if(isset($_SESSION["Rating"]["activity_type"]) AND $_SESSION["Rating"]["activity_type"] == "Reflection"){?> selected="selected" <?php } ?>>Reflection</option>
                <option value="All" <?php if(isset($_SESSION["Rating"]["activity_type"]) AND $_SESSION["Rating"]["activity_type"] == "All"){?> selected="selected" <?php } ?>>All</option>
            </select>
        </section>
      </section>
      <!--Settings Section Ends-->
   </section>
   </section>
<!--My Rating Section Ends-->
</form>