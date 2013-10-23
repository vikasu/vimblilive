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
	
	jQuery(function() {
            jQuery( ".calInput" ).datepicker();
        });
	
	
	//var today = '<?php echo date("m/d/Y") ?>';
	//jQuery(".calInput").val(today);
	
	
        
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
.actTime {
    width:95px !important;
}
.actAmPm {
    width:60px !important;
}
.actDate{
    width:120px !important;
}
</style>

<!--Center Align Inner Content Section Starts-->
<section class="content-pane full_content-pane">
         <!--Flexible WhiteBox With Shadows Starts-->
         <section class="whitebox signuplogin full-signuplogin">
             <section class=whiteboxtop>
                 <section class=whiteboxtop-right></section>
             </section>
             <section class=whiteboxmid>
                 <section class=whiteboxmid-right>
                      <!--All Your Content Goes Here-->
                      <section class=signup-pane>
                          <!--SignUp Heading-->
			  <?php echo $this->Form->create('Activity', array('url'=>array('controller' => 'activities','action' => 'edit_event',base64_encode($id)),'id'=>'addConForm', 'name'=>'addConForm','enctype'=>'multipart/form-data')); ?>
                          <?php echo $this->Form->input('CalendarEvent.id',array('div'=>false,'label'=>false,'error'=>false)); ?>
			  <div class="signup-hdng addcnncthdn"><h3 class=bebas>Edit <span>Event</span></h3></div>
                          <!--Basic Details Starts-->
                          <section class=basic-details>
                              <!--Left Panel Starts-->
			      <section class=bscdtl-lft>
				  <ul>
                                      <li><div class=textbox><span><?php echo $this->Form->input('CalendarEvent.title',array('type'=>'text','placeholder'=>'Event Name', 'div'=>false,'label'=>false,'class' =>'validate[required]','error'=>false)); ?></span></div></li>
                        		
					<li><div class=textbox><span><?php echo $this->Form->input('CalendarEvent.event_type_id',array('label'=>false,'error'=>false, 'options' => $activityTypes,'empty'=>'Select Activity Type')); ?></span></div></li>
					<div style="clear:both;"></div>
					
					<?php
					$sharedConnections = isset($connectionNames) && !empty($connectionNames) ? implode(', ',$connectionNames) : '';
					?>
					<li><div class="textbox ttletxt"><span><?php echo $form->input('CalendarEvent.connection_title', array('value'=>$sharedConnections,'type' => 'text','placeholder' => 'Start writing connection name', "label" => false)); ?></span></div>
                                        <?php echo $form->hidden('CalendarEvent.connection_ids', array('type' => 'text','placeholder' => 'Participants', "label" => false)); ?>
					</li>
					
					<div style="clear:both;"></div>
					<span style="float:left; margin-left: 5px;">Start Time:</span>
					<br>
					<?php $st_time_slot = array(); $end_time_slot = array();
					    $st_time_slot[date('A',strtotime($stTime))] = date('A',strtotime($stTime));
					    $end_time_slot[date('A',strtotime($endTime))] = date('A',strtotime($endTime));
					?>   
					<li style="float:left;"><div class=textbox style="float:left"><span><?php echo $this->Form->input('CalendarEvent.st_time',array('value'=>isset($stTime)?date('h:i',strtotime($stTime)):date("h:m"),'placeholder'=>'hh:mm(start)', 'div'=>false,'label'=>false,'class' =>'validate[required] actTime','error'=>false)); ?></span></div>
					    <div class=textbox style="float:left"><span><?php echo $this->Form->input('CalendarEvent.start_time_slot',array('label'=>false,'error'=>false, 'options' => array('AM'=>'AM','PM'=>'PM'),'selected'=>$st_time_slot,'class'=>'actAmPm')); ?></span></div>
					    <div class=textbox style="float:left"><span><?php echo $form->input('CalendarEvent.start_date', array('value'=>isset($stTime)?date("m/d/Y",strtotime($stTime)):date("m/d/Y"),'type' => 'text','placeholder' => 'Start Date','class' =>'calInput validate[required] actDate', "label" => false)); ?></span></div>
					    
					</li>
					<br>
					<span style="float:left; width:300px; margin-top:10px; margin-left: 5px;">End Time:</span>
					<br>
					<li style="float:left; margin-bottom:10px !important;"><div class=textbox style="float:left"><span><?php echo $this->Form->input('CalendarEvent.en_time',array('value'=>isset($endTime)?date('h:i',strtotime($endTime)):date("h:m"),'placeholder'=>'hh:mm(end)', 'div'=>false,'label'=>false,'class' =>'validate[required] actTime','error'=>false)); ?></span></div>
					    <div class=textbox style="float:left"><span><?php echo $this->Form->input('CalendarEvent.end_time_slot',array('label'=>false,'error'=>false, 'options' => array('AM'=>'AM','PM'=>'PM'),'selected'=>$end_time_slot,'class'=>'actAmPm')); ?></span></div>
					    <div class=textbox style="float:left"><span><?php echo $form->input('CalendarEvent.end_date', array('value'=>isset($endTime)?date("m/d/Y",strtotime($endTime)):date("m/d/Y"),'type' => 'text','placeholder' => 'End Date','class' =>'calInput validate[required] actDate', "label" => false)); ?></span></div>
					    
					</li>
					
					<br>
					<li style="padding-left:5px;">
						<div id="star"></div> 
					</li>
					<br>
					<li><div class=textbox><span><?php echo $this->Form->input('CalendarEvent.notes',array('type'=>'text','placeholder'=>'Specify notes here', 'div'=>false,'label'=>false,'class' =>'','error'=>false)); ?></span></div>
					</li>
                        		<li><?php //echo $this->Form->input('CalendarEvent.details',array('type'=>'textarea','size'=>'50','div'=>false,'label'=>false,'class' =>'textarea','error'=>false)); ?></li>
                                  </ul>
                              </section>
                              <!--Left Panel Starts-->
                          </section>
				<!--Add Connection Button-->
                          <section class=svcnntn><div class="blubtn-big"><?php echo $this->Form->submit('Save',array('class'=>'submit','div'=>false,'label'=>false)); ?></div></section>
			  
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

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
<?php echo $this->Html->script('jquery.ui.autocomplete.js'); ?><!--Center Align Inner Content Section End-->

<script type="text/javascript">
jQuery(document).ready(function(){
    
    //Auto-Complete- Starts
     $(function() {
	  //var availableTags =  [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ];
	  var availableTags =  [<?php echo $autoCompleteConList; ?>];
	  //alert(availableTags);
	  function split( val ) {
	       return val.split( /,\s*/ );
	  }
	  function extractLast( term ) {
	       return split( term ).pop();
	  }
	  $( "#CalendarEventConnectionTitle" )
	       // don't navigate away from the field on tab when selecting an item
	       .bind( "keydown", function( event ) {
	       if ( event.keyCode === $.ui.keyCode.TAB && $( this ).data( "autocomplete" ).menu.active ) {
		    event.preventDefault();
	       }
	       })
	       .autocomplete({
		    minLength: 0,
		    source: function( request, response ) {
			 // delegate back to autocomplete, but extract the last term
			 //response( $.ui.autocomplete.filter(
			 //availableTags, extractLast( request.term ) ) );
			 var results = $.ui.autocomplete.filter(availableTags, extractLast( request.term ));
                              response(results.slice(0, 20));
		    },
		    focus: function() {
			 // prevent value inserted on focus
			 return false;
		    },
		    select: function( event, ui ) {
			 var terms = split( this.value );
			 // remove the current input
			 terms.pop();
			 // add the selected item
			 terms.push( ui.item.value );
			 //$("#MissionConnectionConnectionIds").val(ui.item.value); 
			 // add placeholder to get the comma-and-space at the end
			 terms.push( "" );
			 this.value = terms.join( ", " );
			 return false;
		    }
	       });
     });
     //Auto-Complete- Ends
    
    jQuery(function() {
    $('#star').raty({
      cancel    : false,
      cancelOff : 'cancel-off-big.png',
      cancelOn  : 'cancel-on-big.png',
      half      : false,
      size      : 24,
      starHalf  : 'star-half-big.png',
      starOff   : 'star-off-big.png',
      starOn    : 'star-on-big.png',
      number: 3,
      scoreName: 'data[CalendarEvent][rating]',
      score : '<?php echo isset($rating) ? $rating : ''; ?>',
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
});
</script>

<style>
    #star { width: 110px !important;}
</style>