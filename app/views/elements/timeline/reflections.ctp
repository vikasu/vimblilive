<ul class="crrntprgr-list crntrflctn">
<?php if(!empty($recentReflections)) { ?>
     <?php $i = 0;
    foreach($recentReflections as $row){
    $i = $i+1;
    
    //Avg rating
    //$avgRate = ($row['UserReflection']['ans_1']+$row['UserReflection']['ans_2']+$row['UserReflection']['ans_3']+$row['UserReflection']['rating_today']+$row['UserReflection']['rating_tomorrow'])/5; 	
    
    ?>
    <script>
        jQuery(function() {
            var refId = <?php echo $i ?>;
            var starDivId = '#'+refId; 
            jQuery(starDivId).raty({
                score    : '<?php echo $row['UserReflection']['rating_today'] ?>',
                path: "<?php echo SITE_URL ?>/img"
                });
        });
    </script>
    
    <li>
        <div class="dbRefDate"><?php echo date('d/m/Y',strtotime($row['UserReflection']['reflection_date'])); ?></div>
        <div class="dbRefDesc"><?php echo substr($row['UserReflection']['description'],0,80); ?>...</div>
        <div class="dbRefRate" id="<?php echo $i; ?>"></div>
     </li>
    <?php } } else { ?>
    <li style="text-align:center;">No reflections available .</li>
    <?php } ?>
    
</ul>