<style>
.mng-actns img {margin-right:0px;}
.mng-chk { width:20px; }
.mng-actvty { width:545px; }
.btn-wrapr { overflow:visible; float:left; width:100%; }
#label{font-weight: bold !important; margin-left: 10px}
#cohort_week1{ border: 1px solid #ccc; width: 40px; height: 20px;}
#cohort_week2{ border: 1px solid #ccc; width: 40px; height: 20px;}
.image{width:74%; float:left}
#weeks{width: 50px; float:left;}
.manag-actvty a{ float: right;}
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
     jQuery("#upload3").click(function(){
	  var question_val = jQuery('#cohort_week2').val();
	       if(jQuery.isNumeric(question_val)== true){
		    var questions_info="<?php echo SITE_URL ?>groups/export_questions/"+question_val;
		       jQuery("#urlTest").attr("href",questions_info);
		    return true;
	       }else{
		    alert('Enter integer value only');
		    return false;    
	       }
     });
     jQuery("#cohort_export").click(function(){
	       var question_val = jQuery('#cohort_week1').val();
	       if(jQuery.isNumeric(question_val)== true){
		    var cohort_exp_url="<?php echo SITE_URL ?>groups/export_cohort_weekly/"+jQuery('#cohort_week1').val();
		    jQuery("#cohort_exp_link").attr("href",cohort_exp_url);
		    return true;
	       }else{
		    alert('Enter integer value only');
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
                           <section class=dshbrd-right>
                              
                              <?php echo $this->element("message/errors");?>
                                <?php echo $this->Session->flash(); echo $this->Session->flash('auth');?>
                              
                              <div id="chkMsg" style="display:none; border:1px solid #EF5943; float;left; text-align:center; color:#ff0000; width:97%; background:#FFC6CA; margin: 0 0 10px; padding: 5px 5px 5px 10px; "></div>
                              
                               <!--Current Mission Section Starts-->
                               <section class="current-mission manggrpdsbrd" style="position:relative;">
                                    <h3>Export<span>Data</span>
                                   
                                    </h3>
                                   
                                    <ul class=manag-actvty>
					
                        <!--Export data form - Starts--> 
                        <ul >
                       <!--     <form id="export_data" action="<?php //echo SITE_URL.'groups/export_data/'.base64_encode($_SESSION['Auth']['User']['id']); ?>" method="POST" > -->
                             <li>
                              
                                <div style="float:left;width:130px;"><label id="label">User Info</label></div>
				<?php echo $this->Form->create();
				   $optionsArr=array('1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','11'=>'11','12'=>'12');
				?>
				<div style="float:left;width:130px;">&nbsp;<?php //echo $this->Form->input('weeks',array('type'=>'select','options'=>$optionsArr,'default'=>12,'label'=>false));?></div><!--<div style="float:left;width:60px;margin-left: -58px;margin-top: 3px;">Weeks</div>-->
				<a href="<?php echo SITE_URL ?>groups/export_users"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" id="upload"/></a>
                            </li>
			      <li>
                               
                                <div style="float:left;width:130px;"><label id="label">Cohort Info</label></div>
				<?php //echo $this->Form->create();?>
				
				<div style="float:left;width:60px;"><?php echo $this->Form->input('weeks',array('type'=>'text','label'=>false,'id'=>'cohort_week1'));?></div><div id="weeks">Weeks</div>
				<div class="image"><a href="<?php echo SITE_URL ?>groups/export_cohort_weekly" id="cohort_exp_link"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" id="cohort_export"/></a></div>
                            </li>
			      <li>
                               
                                <div style="float:left;width:130px;"><label id="label">Questions</label></div>
				<?php //echo $this->Form->create();?>
				<div style="float:left;width:60px;"><?php echo $this->Form->input('weeks',array('type'=>'text','label'=>false,'id'=>'cohort_week2'));?></div><div id="weeks">Weeks</div>
				<a href="<?php echo SITE_URL ?>groups/export_questions" id="urlTest"><img src="<?php echo SITE_URL ?>img/export_csv.jpg" width="50px" height="50px" alt="export csv" id="upload3"/></a>
                            </li>
			    <?php /* ?>
			    <li>
                                <?php echo $this->Form->checkbox('Export.data1',array('value'=>'all_data','id'=>'password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                <label>All Data</label>
                            </li>
                            
                           
                            <li>
                                 <?php echo $this->Form->checkbox('Export.data3',array('value'=>'activity_info','id'=>'password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                <label>Activity Info</label>
                            </li>
                            <li>
                                 <?php echo $this->Form->checkbox('Export.data4',array('value'=>'reflection_info','id'=>'password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                <label>Reflection Info</label>
                            </li>
                            <li>
                                 <?php echo $this->Form->checkbox('Export.data5',array('value'=>'attachment','id'=>'password','div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?>
                                <label>Attachments</label>
                            </li>
                              <?php */ ?>
                          <!--  <li>
                                <div class=signuplogin-btn><?php //echo $this->Form->end('Export',array('class'=>'','div'=>false,'label'=>false)); ?></div>
                            </li>
                        </ul>
                        <!--Export data form - Ends--> 
                    
                                    </ul>
                                    <!--Select De-Select Blue Button-->
                               </section>
                               <!--Current Mission Section End-->
                               
                               
                               
                               
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