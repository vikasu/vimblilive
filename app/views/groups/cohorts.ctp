<style>
.mng-actns img {margin-right:0px;}
.mng-chk { width:20px; }
.mng-actvty { width:265px; }
.btn-wrapr { overflow:visible; float:left; width:100%; }
</style>

<script type="text/javascript">
jQuery(document).ready(function(){
     jQuery('.actionButton').click(function(){
          if (jQuery("#conlistForm input:checkbox:checked").length > 0)
          {
              if(jQuery(this).attr('id') == 'view' || jQuery(this).attr('id') == 'edit')
              {
                    if (jQuery("#conlistForm input:checkbox:checked").length > 1)
                    {
                         jQuery('#chkMsg').html('Please select single recored for view or edit.');
                         jQuery('#chkMsg').slideDown('slow');
                         jQuery('#chkMsg').delay(3000).slideUp('slow');
                         return false;
                    }
              }
               jQuery("#actionTaken").val(jQuery(this).attr('id'));
               jQuery('#conlistForm').submit();
          }
          else
          {
               jQuery('#chkMsg').html('Please select atleast one record.');
               jQuery('#chkMsg').slideDown('slow');
               jQuery('#chkMsg').delay(3000).slideUp('slow');
               return false;
          }
     });
     
});
</script>

 <?php //pr($conLists); die; ?>

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
                           <!--Heading Goes Here-->
                           <h3 class="hwdtwrks dshbrd">Dashboard</h3>
                           <!--Left Panel Starts-->
                           <section class=dshbrd-left>
                              <?php echo $this->element('dashboard/group_left'); ?>
                           </section>
                           <!--Left Panel End-->
                           <!--Right Panel Starts-->
                           <section class=dshbrd-right>
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Current Mission Section Starts-->
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
                                    <h3>Manage<span>Cohorts</span>
                                    <div class="addimprt-btns">
                                        <a class="blubtn-mid" href="<?php echo SITE_URL ?>groups/add_cohort">
                                        <input type="button" value="Add New Cohort" />
                                        </a>
                                    </div>
                                    </h3>
                                    <div class="clr-b"></div>
                                    <div class="btn-wrapr">
                                        <div class="cnnctns-actns"><input class='actionButton' id="delete" type='button' name="data[Cohort][action]" value="Delete"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="activate" type='button' name="data[Cohort][action]" value="Activate"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="deactivate" type='button' name="data[Cohort][action]" value="Deactivate"></div>
                                        <!--<div class="cnnctns-actns"><input class='actionButton' id="view" type='button' name="data[Cohort][action]" value="View"></div>-->
                                        <div class="cnnctns-actns"><input class='actionButton' id="edit" type='button' name="data[Cohort][action]" value="Edit"></div>
                                    
                                   
                                   <form action="<?php echo SITE_URL ?>groups/cohorts" method="post" id="searchForm" name="searchForm">
                                        <div style="float:right;" class="slctsrch">
                                             <input style="border:1px solid #ddd; float:left; padding:5px;" type="text" name="data[Search][keyword]">
                                             <input id="searchIn" type="hidden" name="data[Search][searchin]" value="title">
                                             <div class="cnnctns-actns"><input type="submit" value="Search"></div>
                                             </form>
                                        </div>
                                   
                                   </div>
                                   <div class="clr-b"></div>
                                    
                                   <form action="<?php echo SITE_URL ?>groups/group_actions" method="post" id="conlistForm" name="conlistForm">
                                    
                                    <input id='actionTaken' type='hidden' name='data[Cohort][action]' value=''>
                                    
                                    <ul class=manag-actvty>
                                        <li class="actvity-header">
                                            <section class="mng-chk"><input type="checkbox" id="all"></section>
                                            <section class="mng-actvty scdnnam">
                                            <?php echo $paginator->sort('Title', 'Cohort.title'); ?>
                                            <?php //if($paginator->sortKey() == 'Connection.name'){
				//echo ' '.$html->image('admin-arrow-top.jpeg',array('border'=>0,'alt'=>'')).' '.$html->image('admin-arrow-bottom.jpeg',array('border'=>0,'alt'=>'')); 
			//}?>        
                                             <!--<img src="http://172.24.0.9:9953/img/sorting_img.png" alt="" />-->
                                             </section>
                                            <section class="mng-time scdnnam">
                                             <?php echo $paginator->sort('Status', 'Cohort.status'); ?><?php if($paginator->sortKey() == 'Cohort.title'){
				//echo ' '.$image; 
			}?>
                                            </section>
                                            <section class="mng-rtng">Created</section>
                                        </li>
                                        
                                        <?php //	pr($conGroupList); exit;
                                        if(empty($userGroupList)){ ?>
                                             <li style="text-align:center;">No cohorts found.</li> 
                                        <?php } else {
                                        foreach($userGroupList as $group) { ?>
                                        <li>
                                            <section class="mng-chk"><input <?php if($group['Cohort']['group_owner'] == 0) { ?> disabled="disabled" <?php } else {?> class="allchk" <?php } ?>type="checkbox"  name="data[Cohort][ids][]" value="<?php echo $group['Cohort']['id']; ?>"></div></section>
                                            <section class="mng-actvty"><?php echo $group['Cohort']['title']; ?></div></section>
                                            <section class="mng-time"><?php 
                                                  echo $status = ($group['Cohort']['status'] == 1)?'Active':'Inactive';
                                             ?></section>
                                            <section class="mng-rtng">
                                                  <?php echo date('M. d, Y',strtotime($group['Cohort']['created'])); ?>
                                            </section>
                                        </li>
                                        <?php } } ?>
                                    </ul>
                                    <!--Select De-Select Blue Button-->
                               </section>
                               <!--Current Mission Section End-->
                               
                               
                               <div class="paging_full_numbers" id="example_paginate">
                              <?php  if($paginator->numbers()){
                                
                                      echo $paginator->first('First', array('class'=>"homeLink"));echo '&nbsp;&nbsp;';
                                      echo $paginator->prev('Previous',array('class'=>"disabled"));  echo '&nbsp;&nbsp;';
                                      echo $paginator->numbers(array('separator'=>'')); echo '&nbsp;&nbsp;';
                                      echo $paginator->next('Next',array('class'=>"disabled")); echo '&nbsp;';
                                      echo $paginator->last('Last',array('class'=>"homeLink"));
                                      //echo $paginator->counter(array(	'format' => 'Page %page% of %pages% ' ));
                              }
                                      
                              ?> 
                                      &nbsp;
                              </div>
                               
                               
                           </section>
                           <!--Right Panel End-->
                           <!--Clear Div-->
                           <section class=clr-b></section>
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
    <script type="text/javascript">
     $(document).ready(function(){
		$('.slctbx').click(function(){
		 $('.slctcate-drop').slideToggle(300);							
		 });		
       });
    </script>