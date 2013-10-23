<style>
.mng-actns img {margin-right:0px;}
.mng-chk { width:20px; }
.mng-actvty { width:800px; }
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

 <?php //pr($queLists); die; ?>

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
                           <h3 class="hwdtwrks dshbrd grp_usrdata_small_icon">My Group Setup & Data</h3>
                           <!--Right Panel Starts-->
                           <section class="dshbrd-right close_to_left">
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Current Mission Section Starts-->
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
                                    <h3>Manage<span>Questions</span>
                                    <div class="addimprt-btns">
                                        <a class="blubtn-mid" href="<?php echo SITE_URL ?>reflections/add_question">
                                        <input type="button" value="Add Question" />
                                        </a>
                                    </div>
                                    </h3>
                                    <div class="clr-b"></div>
                                    <div class="btn-wrapr">
                                        <div class="cnnctns-actns"><input class='actionButton' id="delete" type='button' name="data[Question][action]" value="Delete"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="activate" type='button' name="data[Question][action]" value="Activate"></div>
                                        <div class="cnnctns-actns"><input class='actionButton' id="deactivate" type='button' name="data[Question][action]" value="Deactivate"></div>
					<div class="cnnctns-actns"><input class='actionButton' id="edit" type='button' name="data[Question][action]" value="Edit"></div>
                                    </div>
                                   <div class="clr-b"></div>
                                    
                                   <form action="<?php echo SITE_URL ?>reflections/question_actions" method="post" id="conlistForm" name="conlistForm">
                                    
                                    <input id='actionTaken' type='hidden' name='data[Question][action]' value=''>
                                    
                                    <ul class=manag-actvty>
                                        <li class="actvity-header">
                                            <section class="mng-chk"><input type="checkbox" id="all"></section>
                                            <section class="mng-actvty scdnnam">
                                            <?php echo $paginator->sort('Question', 'Question.question'); ?>
                                            </section>
                                            <section class="mng-actns scdnnam"><?php echo $paginator->sort('Status', 'Question.status'); ?><?php if($paginator->sortKey() == 'Connection.status'){
				//echo ' '.$image; 
			}?></section>
                                        </li>
                                        
                                        <?php //pr($queLists); exit;
                                        if(empty($queLists)){ ?>
                                             <li style="text-align:center;">No question found.</li> 
                                        <?php } else { 
					     //pr($queLists); exit; ?>
					 <?php   
                                        foreach($queLists as $question) { ?>
                                        <li>
					     <section class="mng-chk"><input type="checkbox" class="allchk" name="data[Question][ids][]" value="<?php echo $question['Question']['id']; ?>"></div></section>
                                            <section class="mng-actvty"><?php
					    if($question['Question']['question'] != "") {
						echo $html->link($question['Question']['question'],array("controller"=>"reflections","action"=>"add_question",base64_encode($question['Question']['id'])));
					    }
					    ?></section>
                                            <section class="mng-time" style="width:70px;">
                                             <?php echo $status = ($question['Question']['status'] == 1)?'Active':'Inactive'; ?>
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