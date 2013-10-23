<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');   ?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#addConForm").validationEngine();
	
	//Script for clone
	jQuery("#Discount #edit_otherDiscount").click(function(){
	
			  if(jQuery("#Discount table tr").last().children().last().children().is('a')) {	
				var clone = jQuery("#Discount table tr").last().clone(); // clone the last <tr>
				jQuery(clone).appendTo($("#Discount table"));
				jQuery(clone).find('td a').click(function(){
				jQuery(this).parent('td').parent('tr').remove();
				});
				
			clone.find('input[type=text]').val('');
			}else{
				var clone = jQuery("#Discount table tr").last().clone();
				var img = jQuery("<a align ='right' style='float:right; margin-top:-30px; margin-left:320px; text-align:right; color:#D83F4A;' href='javascript:void(0);'><img src='<?php echo SITE_URL ?>img/remove.png'/></a>");
				
				jQuery(clone).find('td').first().append(img);
				jQuery(img).click(function(){
					
					jQuery(img).parent('td').parent('tr').remove();
						
				});
				jQuery(clone).appendTo(jQuery("#Discount table"));
				clone.find('input[type=text]').val('');
			}
		
	});
	//End script for clone
	
        
});
</script>
<style>
.user-list {
    box-shadow: 1px 1px 3px #CCCCCC inset;
    min-height: 170px;
    min-width: 302px;
    overflow-y: scroll;
    padding: 4px 0 0 8px;
    margin-bottom:15px;
}
div.checkbox {
    padding: 3px;
    background: url("") no-repeat scroll left top transparent;
    float:none;
    height: auto;
    width: auto;
}
label {
    padding: 4px;
}
.form_default label {
    float: inherit;
    padding: 5px;
}
input[type="checkbox"] {
    margin: 0;
    padding: 0;
    vertical-align: middle;
}

</style>

<!--Center Align Inner Content Section Starts-->
<section class=content-pane>
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
                          <!--SignUp Heading-->
			  <?php echo $this->Form->create('Activity', array('controller' => 'activities','action' => 'add_activity/'.$id,'id'=>'addConForm', 'name'=>'addConForm','enctype'=>'multipart/form-data')); ?>
                          <div class="signup-hdng addcnncthdn"><h3 class=bebas>Add<span>Activity</span></h3></div>
                          <!--Basic Details Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
			      <section class=bscdtl-lft>
				  <ul>
                                      <li><div class=textbox><span><?php echo $this->Form->input('Activity.title',array('placeholder'=>'Activity Name', 'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                        		<li><div class=textbox><span><?php echo $this->Form->input('Activity.description',array('placeholder'=>'Specify notes here', 'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                        		
					<li><div class=textbox><span><?php echo $this->Form->input('Activity.activity_type_id',array('label'=>false,'error'=>false, 'options' => $activityTypes,'empty'=>'Select Activity Type')); ?></span></div></li>
					<br><br>
					<li>
						<div id="slider-range"></div><br>
						<span id="time"></span>
						<?php echo $this->Form->input('Activity.start_time',array('type'=>'hidden','label'=>false,'error'=>false, 'options' => $activityTypes,'empty'=>'Select Activity Type')); ?>
						<?php echo $this->Form->input('Activity.end_time',array('type'=>'hidden','label'=>false,'error'=>false, 'options' => $activityTypes,'empty'=>'Select Activity Type')); ?>
					</li>
					<br><br>
					<li>
						<div id="star"></div> 
					</li>
                                  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
				<!--Add Connection Button-->
                          <section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Save  Activity',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></section>
			  
			  <?php echo $this->Form->end(); ?>
			  
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
jQuery(function() {
$('#star').raty({
  cancel    : true,
  cancelOff : 'cancel-off-big.png',
  cancelOn  : 'cancel-on-big.png',
  half      : true,
  size      : 24,
  starHalf  : 'star-half-big.png',
  starOff   : 'star-off-big.png',
  starOn    : 'star-on-big.png',
  number: 5,
  scoreName: 'data[Activity][rating]',
  score : <?php echo isset($rating) ? $rating : ''; ?>,
  path : '<?php echo SITE_URL; ?>/img'
});
});

$("#slider-range").slider({
    range: true,
    min: 0,
    max: 1439,
    values: [600, 700],
    slide: slideTime
});
function slideTime(event, ui){
    var val0 = $("#slider-range").slider("values", 0),
	val1 = $("#slider-range").slider("values", 1),
	minutes0 = parseInt(val0 % 60, 10),
	hours0 = parseInt(val0 / 60 % 24, 10),
	minutes1 = parseInt(val1 % 60, 10),
	hours1 = parseInt(val1 / 60 % 24, 10);
    startTime = getTime(hours0, minutes0);
    endTime = getTime(hours1, minutes1);
    $("#time").text(startTime + ' - ' + endTime);
     $("#ActivityStartTime").val(startTime);
      $("#ActivityEndTime").val(endTime);
}
function getTime(hours, minutes) {
    var time = null;
    minutes = minutes + "";
    if (hours < 12) {
	time = "AM";
    }
    else {
	time = "PM";
    }
    if (hours == 0) {
	hours = 12;
    }
    if (hours > 12) {
	hours = hours - 12;
    }
    if (minutes.length == 1) {
	minutes = "0" + minutes;
    }
    return hours + ":" + minutes + " " + time;
}
slideTime();
</script>