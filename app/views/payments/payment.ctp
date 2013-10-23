<?php //pr($_SESSION); die;?>
<?php echo $this->Html->script('jquery.raty');
    echo $this->Html->css('stylesheet');
    ?>
    <?php //pr($payment); die;
    
    $totalAmt = number_format($payment['SubscriptionPlan']['amount']*$payment['SubscriptionPlan']['plan_months'],2);
    
    ?>
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

	jQuery("#promo_code").live('keyup',function(){
	    var p_code = jQuery(this).val();
	  //alert(custom_val);
	   var code = $(this);
	    var main_amt = parseFloat(<?php echo $payment['SubscriptionPlan']['amount'] ?>);
	    var period = parseFloat(<?php echo $payment['SubscriptionPlan']['plan_months'] ?>);
	    jQuery.ajax({
		url: "<?php echo SITE_URL ?>payments/update_amt/"+p_code+"/"+main_amt+"/"+period,
		success: function(msg) { //alert(msg);
				if(msg == 'invalid'){
				    var oriz_amt = parseFloat(<?php echo $payment['SubscriptionPlan']['amount'] ?>);
				    var oriz_amt1 = oriz_amt+' '+'USD';
				    //var custom_val;
				      //alert('sam'); 
				    jQuery("#msgDiv").show();
				    jQuery("#main_amount").val(oriz_amt);
				    jQuery("#main_amount_label").html(oriz_amt1);
				}else{
				    //var custom_val = jQuery("#custom").val();
				    //var append_custom_val = custom_val+':'+p_code;
				    //alert(append_custom_val);
				    //jQuery("#custom").val(append_custom_val);
				    jQuery("#msgDiv").hide();
				    jQuery("#main_amount").val(msg);
				    jQuery("#amount").val(msg);
				    jQuery("#a3").val(msg);
				    jQuery("#main_amount_label").html(msg);
				    //jQuery("#invoice").val(p_code);
				    
				    jQuery("#promo").val(jQuery("#promo_code").val());
				}
		} 
	    });
	    
	});
	
	jQuery("#promo_code").live('paste',function(){
	    var p_code = jQuery(this).val();
	    var main_amt = parseFloat(<?php echo $payment['SubscriptionPlan']['amount'] ?>);
	    var period = parseFloat(<?php echo $payment['SubscriptionPlan']['plan_months'] ?>);
	    var code = $(this);
	    jQuery.ajax({
		url: "<?php echo SITE_URL ?>payments/update_amt/"+p_code+"/"+main_amt+"/"+period,
		success: function(msg) { //alert(msg);
			       if(msg == 'invalid'){
				    var oriz_amt = parseFloat(<?php echo $payment['SubscriptionPlan']['amount'] ?>);
				    var oriz_amt1 = oriz_amt+' '+'USD'; 
				    jQuery("#msgDiv").show();
				    jQuery("#main_amount").val(oriz_amt);
				    jQuery("#main_amount_label").html(oriz_amt1);
				}else{
				    //var custom_val = jQuery("#custom").val();
				    //var append_custom_val = custom_val+':'+p_code;
				   ////jQuery("#custom").val(append_custom_val);
				    //alert(jQuery("#custom").val());
				    //custom_val = 
				    jQuery("#msgDiv").hide();
				    jQuery("#main_amount").val(msg);
				    jQuery("#amount").val(msg);
				    jQuery("#a3").val(msg);
				    jQuery("#main_amount_label").html(msg);
				    //jQuery("#invoice").val(p_code);
				    
				    jQuery("#promo").val(jQuery("#promo_code").val());
				}
		} 
	    });
	    
	});
	jQuery("#checkout").click(function(){
	    //alert("clicked");
	    //return false;
	    if($("#checkbox").attr("checked")){
		//alert("unclicked");
		return true;
	    }else{
		alert('Please confirm recurring payment');
		return false;
	    }
	});
	
        
});
</script>
<style>

img {
    border: medium none;
    padding-left: 2px;
    padding-top: 18px;
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
    width: 261px;
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
                         
			
			    <?php //echo $this->Form->create('Payments',array('id'=>'form','controller'=>'payments','action'=>'express_checkout')); ?>
                              <div class="signup-hdng addcnncthdn"><h3 class=bebas>Payment<span>Details</span></h3></div><br/>
                             <table border=0 cellpadding=0 cellspacing="0" class="tableformfield" >
                               
				  <tr>
                                        <td width="180px" style="padding-bottom:14px">Item name  :</td>
                                        <td  style="padding-bottom:14px">
                                      <label for="150" style="padding-left:6px";><?php echo $payment['SubscriptionPlan']['plan_title'];?></label>
				   <!--   <input type="hidden" value="<?php //echo $payment['SubscriptionPlan']['id'];?>" name="subscriptionType"/> -->
				        </td>
                                </tr>
				    <tr>
			
				    </tr>
				
                                <tr >
                                        <td class="param_name"  style="padding-bottom:16px">Payment per cycle:
</td>
                                        <td style="padding-bottom:16px">
                                        	<label for="150" style="padding-left:6px";>
							<?php 
							    echo $payment['SubscriptionPlan']['amount'].' '."USD";
							?>
						</label>
					</td>
                                </tr>
				
				<tr >
                                        <td class="param_name"  style="padding-bottom:16px">Billing cycle:</td>
                                        <td style="padding-bottom:16px">
                                        	<label for="150" style="padding-left:6px";>
						<!--<input type="hidden" value="<?php// echo $payment['SubscriptionPlan']['billing_cycle'];?>" name="billing_cycle"/>  -->
							<?php 
							    echo $payment['SubscriptionPlan']['billing_cycle'];
							?>
						</label>
					</td>
                                </tr>
				
				<tr >
                                        <td class="param_name">End of Billing cycle:</td>
                                        <td >
                                        	<label for="150" style="padding-left:6px";>
							<?php
							    if($payment['SubscriptionPlan']['plan_months'] == 0){
								echo "Ongoing
";
							    }else{
								echo $payment['SubscriptionPlan']['plan_months'];
							    }
							    
							?>
						</label>
					</td>
                                </tr>
                                  
                                <tr>
                                      
                                        <td >
                                     <!--   <input type="hidden" size="5" maxlength="3" name="cccode" value="USD" class="text"> -->
					<!--<input type="hidden" name="plan_id" value="<?php// echo $payment['SubscriptionPlan']['id'];?>" class="text"> -->
                                        </td>
                                </tr>
				<tr>
				     <td class="param_name">Promotional Code:</td>
				     <td >
					<div class=textbox><span>
					<input type="text" size="10" maxlength="10" name="invoice" id="promo_code" class="text" AutoComplete="off"></span></div>
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
                                        <td class="param_name">Recurring Amount due per cycle($):</td>
                                        <td >
                                        	<label id="main_amount_label" for="150" style="padding-left:6px";>
							<?php 
							    echo $payment['SubscriptionPlan']['amount'].' '."USD";
							?>
						</label>
						<!--<input type="hidden" id="main_amount" value="<?php// echo $payment['SubscriptionPlan']['amount'];?>" name="subscriptionAmount"/>  -->
                                              
                                        </td>
                                </tr></table><br>

				<input type="checkbox" id="checkbox"/> <span style=" font-style: italic;">I accept responsibility for the recurring payment</span><br>

		<form action="https://www.paypal.com/cgi-bin/webscr">
		    <input type="hidden" name="cmd" value="_xclick-subscriptions" />    
		    <input type="hidden" name="cpp_header_image" value="http://www.vimbli.com/img/logo-180.png" />
		    <input type="hidden" name="item_name" value="Vimbli Subscription">
		    <input type="hidden" name="item_number" value="<?php echo $payment['SubscriptionPlan']['id'] ?>"> <!-- Plan Id-->
		    <input type="hidden" name="business" value="hennie@vimbli.com" />
		    <input type="hidden" name="currency_code" value="USD" />
		    <input type="hidden" name="no_shipping" value="1" />
		    <input type="hidden" name="rm" value="2">
		    <input type="hidden" name="on0" value="Promo code">
		    <input type="hidden" id="promo" name="os0" value="N/A"> <!-- value of promo if exist-->
		    <input type="hidden" name="on1" value="Payment type">
		    <input type="hidden" id="promo" name="os1" value="Recurring Payment"> <!-- value of promo if exist-->
		    
		    
		    <input type="hidden" id= 'a3' name="a3" value="<?php echo $payment['SubscriptionPlan']['amount'] ?>" /> <!--amount to billed each recurrence-->
			 <input type="hidden" name="p3" value="1" /> <!--number of time periods between each recurrence i.e. billing cycle-->
			 <input type="hidden" name="t3" value="<?php echo $payment['SubscriptionPlan']['billing_cycle']?>" /> <!--time period (D=days, W=weeks, M=months, Y=years)-->
			 <?php if($payment['SubscriptionPlan']['plan_months'] == 0){?>
			 <input type="hidden" name="src" value="1" />
			 <?php } ?>
			 <input type="hidden" name="sra" value="1" />
			 <input type="hidden" name="srt" value="<?php echo $payment['SubscriptionPlan']['plan_months'] ?>" />
		    <?php
				 $url = SITE_URL.'payments/notify_url/user:'.$_SESSION["Auth"]["User"]["id"];
		    ?>
		    <input type="hidden" name="notify_url" value="<?php echo $url;?>" />
		    <input type="hidden" name="return" value="<?php echo SITE_URL ?>payments/thankyou" /> 
		    <!--<input type="hidden" name="return" value="http://192.168.0.1:8005/payments/thankyou" />-->
		    <input type="hidden" name="cancel_return" value="<?php echo SITE_URL ?>payments/subscription_plans" />
		    <div style="margin-left:120px;margin-top: 18px;"><?php echo $this->Form->submit('https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif',array('style'=>'width:150px','id'=>'checkout'))?></div>
		</form>
		
				    
				    
				
			     <div style="width:490px;height:100px; border:solid 1px lightgrey;border-radius: 10px";>
				        <?php echo $this->Html->image('paypal2.jpeg',array('height'=>'68px','width'=>'170px'));?>
					<span id="para">Your transaction is processed by Paypal. No credit card information is stored by Vimbli.</span>
			     </div>
			  
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
    color:#0F559B ;
    font-size:15px;
    margin-top: 40px;
    position: absolute;
    width: 303px;
}
em{
    color:red;
}
</style>