<ul class="missin-flds missionview prfnmnc">
    <?php //pr($activityList); exit;
	if(empty($activityList)){ ?>
	     <li style="text-align:center;">No mission found.</li> 
	<?php } else { ?>
    <li>
        <label>Title:</label>
        <?php echo $missionDetail['Mission']['title']; ?>
   </li>
    <li>
        <label>Sponsor:</label>
        <?php echo $missionDetail['Sponsor']['name']; ?>
   </li>
   <li>
        <label>Frequency:</label>
        <?php echo $missionDetail['Mission']['frequency']; ?>
   </li>
   <li>
      <!--Key To Success Starts-->
      <section class="milstone">
          <!--Heading Starts-->
          <h3 class=wrdspcn>Key<span>to Success</span></h3>
          <!--Listing Goes Here-->
          <ul class="manag-actvty milsstnview kysccs">
              <?php foreach($missionDetail['KeyToSuccess'] as $keyToSuccess){ ?>
              <li>
                  <section class="mng-actvty"><?php echo $keyToSuccess['description']; ?></section>
              </li> 
              <?php } ?>
          </ul>
      </section>
      <!--Key To Success End-->
   </li>

   <li>
     <!--Milestones Starts-->
     <section class="milstone">
          <h3>Milestones</h3>
          <ul class="manag-actvty milsstnview">
             <?php foreach($missionDetail['Milestone'] as $milestone){ ?>
             <li>
                 <section class="mng-actvty"><?php echo $milestone['description']; ?></section>
             </li> 
             <?php } ?>
        </ul>
     </section>
     <!--Milestones End-->
  </li>
   <?php } ?>
</ul>
 