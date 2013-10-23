// validate signup form on keyup and submit
 	 //jQuery.noConflict();
     jQuery(document).ready(function($) {
    	   jQuery.noConflict();
    	   jQuery.validator.addMethod("username",function(value,element)
			{
			return this.optional(element) || /^[a-zA-Z]+(([\'\,\.\-][a-zA-Z])?[a-zA-Z]*)*$/i.test(value); 
			},"Please enter only characters");
                        
			jQuery.validator.addMethod("alphaNumber",function(value,element)
			{
			return this.optional(element) || /^[0-9]*[ a-z A-Z ]+[0-9]*$/i.test(value); 
			},"Please enter only characters & numbers");
			
			jQuery.validator.addMethod("phoneNumber",function(value,element)
			{
			return this.optional(element) || /^[0-9 ,+-]+$/i.test(value);
			},"Please enter valid weight");
                        
			jQuery.validator.addMethod("characterORnumber",function(value,element)
			{
			return this.optional(element) || /^[a-zA-Z0-9 ]+$/i.test(value);
			},"Field can be either character or number or combination of both");                        
			
			
       jQuery("#contactus").validate({ 
         rules: { 
            "data[Contactus][sender_name]": {
               required: true,
               minlength: 2,
               maxlength: 15
            },
	 	    "data[Contactus][sender_email]": {
	                required: true,
	                email: true
	                //remote: "emails.php"
	            },
            "data[Contactus][subject]": {
                required: true
            },   
            
            "data[Contactus][ver_code]": {
            	required: true,
            	equalTo: "#ContactusCapchaval"
            }            
          
  
         },
    messages: {
        "data[Contactus][ver_code]": {
            required: "Please enter captcha code",
            equalTo: "Please enter the same captcha code as above"
        },
        "data[Contactus][ContactusCapchval]": {
            equalTo: "Please enter the same captcha code as above"
        }
    	},         
         // the errorPlacement has to take the table layout into account
			errorPlacement: function(error, element) {
					error.appendTo( element.parent() );
			},
			// set this class to error-labels to indicate valid fields
			success: function(label) {
				// set &nbsp; as text for IE
				label.html("&nbsp;").addClass("checked");
			}
         
       
      });
      // to toggle between state field and state list menu
       jQuery("#UserCountry").change(function() {
       			var country = jQuery("#UserCountry").val();
 			 if (country != '230') {
 			  
 			  	jQuery('#nonusstatediv').removeClass("switch_off");
 			 	jQuery('#nonusstatediv').addClass("switch_on");
 			 	jQuery('#usstatediv').removeClass("switch_on");
 			 	jQuery('#usstatediv').addClass("switch_off");
 			 }
 			 else
 			 {
 			 	jQuery('#nonusstatediv').removeClass("switch_on");
 			 	jQuery('#nonusstatediv').addClass("switch_off");
 			 	jQuery('#usstatediv').removeClass("switch_off");
 			 	jQuery('#usstatediv').addClass("switch_on");
 			 }
 			 
 			 });
     });
