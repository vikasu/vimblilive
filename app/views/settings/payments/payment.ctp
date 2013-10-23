<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    ?>
    <?php //pr($payment); die;?>
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
	
	jQuery("#submit").click(function(){
	    jQuery(".signup-pane").addClass('blurDiv');
	    jQuery("#loaderDiv").show();
	});

	 jQuery('.update_confirm').click(function(){
	 var val = $(this).attr('value');
	 var curr = $(this);
	    jQuery.ajax({
			url:"<?php echo SITE_URL;?>/timelines/change_confirm_status/"+jQuery(this).attr('value'),
			success: function(data){
			    curr.css('class','update_confirm');
			    if(data == 1) {				
				curr.attr({
				    src: '<?php echo SITE_URL ?>img/confirm_icon.png',
				    value: val,
				    alt:'Status',
				    title:'Status'
				});
			    }else{
				curr.attr({
				    src: '<?php echo SITE_URL ?>img/question.png',
				    value: val,
				    alt:'Status',
				    title:'Status'
				});
			    }
			}
		    });
	})

	jQuery("#promo_code").live('keyup',function(){
	    var p_code = jQuery(this).val();
	    var main_amt = parseFloat(<?php echo $payment['SubscriptionPlan']['amount'] ?>);
	    
	    jQuery.ajax({
		url: "<?php echo SITE_URL ?>payments/update_amt/"+p_code+"/"+main_amt,
		success: function(msg) { //alert(msg);
				if(msg == 'invalid'){
				    var oriz_amt = parseFloat(<?php echo $payment['SubscriptionPlan']['amount'] ?>);
				    jQuery("#msgDiv").show();
				    jQuery("#main_amount").val(oriz_amt);
				    jQuery("#main_amount_label").html(oriz_amt);
				}else{
				    jQuery("#msgDiv").hide();
				    jQuery("#main_amount").val(msg);
				    jQuery("#main_amount_label").html(msg);
				}
		} 
	    });
	    
	});
	
	jQuery("#promo_code").live('paste',function(){
	    var p_code = jQuery(this).val();
	    var main_amt = parseFloat(<?php echo $payment['SubscriptionPlan']['amount'] ?>);
	    
	    jQuery.ajax({
		url: "<?php echo SITE_URL ?>payments/update_amt/"+p_code+"/"+main_amt,
		success: function(msg) { //alert(msg);
			       if(msg == 'invalid'){
				    var oriz_amt = parseFloat(<?php echo $payment['SubscriptionPlan']['amount'] ?>);
				    jQuery("#msgDiv").show();
				    jQuery("#main_amount").val(oriz_amt);
				    jQuery("#main_amount_label").html(oriz_amt);
				}else{
				    jQuery("#msgDiv").hide();
				    jQuery("#main_amount").val(msg);
				    jQuery("#main_amount_label").html(msg);
				}
		} 
	    });
	    
	});
	
        
});
</script>
<style>
img {
    border: medium none;
    padding-left: 2px;
    padding-top: 10px;
    vertical-align: middle;
}
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
#star{
    width: 115px !important;
}


td{
    padding-top:5px !important;
    margin-left:2px;
}

.blurDiv { opacity: 0.6; }
#loaderDiv { display: none; position: absolute; top: 300px; left: 620px; 
}
</style>

<!--Center Align Inner Content Section Starts-->
<div id="loaderDiv"><img src="<?php echo SITE_URL ?>img/ajax-loader.gif"></div>

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
                         
			
			    <?php echo $this->Form->create('Payments',array('id'=>'form','controller'=>'payments','action'=>'charge_card')); ?>
                              <div class="signup-hdng addcnncthdn"><h3 class=bebas>Payment<span>Details</span></h3></div><br/>
                             <table border=0 cellpadding=0 cellspacing="0" class="tableformfield" >
                               
                           <!--     <tr>
                                        <td width="180px">Firstname <em>*</em> :</td>
                                        <td >
                                       <div class=textbox><span><input type="text" name="firstName" value="" class="text"/> </span></div>
                                        </td>
                              </tr>-->
                              
                                <tr>
                                  <td width="180px">Card type <em>*</em> :</td></span></div>
                                       <td>
                                        <div class=textbox style="float:left"> <span>   <select name="creditCardType">
                                                <option value="Visa" selected="selected">Visa</option>
                                                <option value="MasterCard">MasterCard</option>
                                                <option value="Discover">Discover</option>
                                                <option value="Amex">American Express</option>
                                             </select></span>  </div>                  
                                        </td> 
                                </tr>
				
                                <tr>
                                        <td width="180px">Card number <em>*</em> :</td>
                                        <td>
                                              <div class=textbox><span>   <input type="text" size="15" maxlength="19" name="cardnumber" class="text"></div></span>
                                        </td>
                                </tr>
                                <tr>
                                <td width="180px">Expiry Date <em>*</em> :</td>
                                <td >
                                 <div class=textbox style="float:left"><span>  <select name="expDateMonth">
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                        </select></span></div>
                                    <div class=textbox style="float:left"><span><select name="expDateYear">                                     
                                                <?php  for($i=date("Y"); $i<=date("Y")+12; $i++){?>
                                                <option value="<?php echo $i?>"><?php echo $i?></option>
                                                <?php }?>
                                        </select></span></div>
                                </td>
                                </tr>
                                <tr>
                                        <td width="180px">CVV <em>*</em> :</td>
                                        <td >
                                            <div class=textbox><span><input type="text" size="3" maxlength="4" name="cvv2Number" value="" class="text"></span></div>
                                        </td>
                                </tr>
				  <tr>
                                        <td width="180px">Plan Title <em>*</em> :</td>
                                        <td >
                                      <label for="150" style="padding-left:6px";><?php echo $payment['SubscriptionPlan']['plan_title'];?></label>
				      <input type="hidden" value="<?php echo $payment['SubscriptionPlan']['id'];?>" name="subscriptionType"/>
				        </td>
                                </tr>
				    <tr>
					<td>
					    
					</td>
				    </tr>
				
                                <tr >
                                        <td class="param_name">Plan cost (per month):</td>
                                        <td >
                                        	<label for="150" style="padding-left:6px";>
							<?php 
							    echo $payment['SubscriptionPlan']['amount'];
							?>
						</label>
					</td>
                                </tr>
				<tr >
                                        <td class="param_name">Payment Period:</td>
                                        <td >
                                        	<label for="150" style="padding-left:6px";>
							<?php 
							    echo $payment['SubscriptionPlan']['plan_months'].' '.'months';
							?>
						</label>
					</td>
                                </tr>
                                  
                                <tr>
                                      
                                        <td >
                                        <input type="hidden" size="5" maxlength="3" name="cccode" value="USD" class="text">
					<input type="hidden" name="plan_id" value="<?php echo $payment['SubscriptionPlan']['id'];?>" class="text">
                                        </td>
                                </tr>
				<tr>
				     <td class="param_name">Promotional Code:</td>
				     <td >
					<div class=textbox><span>
					<input type="text" size="10" maxlength="10" name="promoCode" id="promo_code" class="text"></span></div>
				     </td>
                                </tr>
				<tr style="display: none;" id="msgDiv">
				     <td class="param_name">&nbsp</td>
				     <td >
					<span style="color: red;">
					    Not a valid promotional code
					</span>
				     </td>
                                </tr>
				<tr >
                                        <td class="param_name">Payment Amount due($):</td>
                                        <td >
                                        	<label id="main_amount_label" for="150" style="padding-left:6px";>
							<?php 
							    echo $payment['SubscriptionPlan']['amount'];
							?>
						</label>
						<input type="hidden" id="main_amount" value="<?php echo $payment['SubscriptionPlan']['amount'];?>" name="subscriptionAmount"/>
                                              
                                        </td>
                                </tr>
				
                                <tr class="submit">
                                        <td></td><td style="padding-top: 15px !important;"><?php echo $this->Form->submit('pay_now.png',array('id'=>'submit'));?></td>
                                        
                                </tr>
				<tr><td colspan="2"><div style="width:490px;height:100px; border:solid 1px lightgrey";><?php echo $this->Html->image('paypal2.jpeg',array('height'=>'80px','width'=>'180px'));?>
					<span id="para" >Your transaction is processed by Paypal. No credit card information is stored by Vimbli.</span></div></td>
                                   
                               </tr>	
                             </table>
                <?php echo $this->Form->end();?>
		
			 
			  
                      </section>
                 </section>
             </section>
             <section class=whiteboxbot>
                 <section class=whiteboxbot-right></section>
             </section>
         </section>
         <!--Flexible WhiteBox With Shadows End-->
    </section>

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
	  $( "#ActivityConnectionTitle" )
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
      scoreName: 'data[Activity][rating]',
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
    #para {
    float: right;
    margin-right: 79px;
    
    width: 210px;
    color:green ;
    font-size:15px;
    margin-top: 40px;
    position: absolute;
    width: 303px;
}
em{
    color:red;
}
</style>