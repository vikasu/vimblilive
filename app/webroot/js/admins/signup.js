// validate signup form on keyup and submit
 jQuery.noConflict();
     jQuery(document).ready(function($) {
			$.validator.addMethod("username",function(value,element)
			{
			return this.optional(element) || /^[a-zA-Z]+(([\'\,\.\-][a-zA-Z])?[a-zA-Z]*)*$/i.test(value); 
			},"Please enter only characters");
                        
			$.validator.addMethod("alphaNumber",function(value,element)
			{
			return this.optional(element) || /^[0-9]*[ a-z A-Z ]+[0-9]*$/i.test(value); 
			},"Please enter only characters & numbers");
			
			$.validator.addMethod("phoneNumber",function(value,element)
			{
			return this.optional(element) || /^[0-9 ,+-]+$/i.test(value);
			},"Please enter valid weight");
            
			$.validator.addMethod("height",function(value,element)
			{
			//return this.optional(element) || /^[0-9 ,+-]+$/i.test(value);
			return this.optional(element) || /^[0-9]+\' ?[0-9]+\"$/.test(value);
			},"Please enter valid height");
			
			$.validator.addMethod("characterORnumber",function(value,element)
			{
			return this.optional(element) || /^[a-zA-Z0-9 ]+$/i.test(value);
			},"Field can be either character or number or combination of both");                        
			
			
       $("#signup").validate({ 
         rules: { 
            "data[User][name]": {
               required: true,
               minlength: 2,
               maxlength: 15
            },
            "data[User][userpassword]": {
                minlength: 6,
                maxlength: 15
                                        
            },
            "data[User][password_confirm]": {
                equalTo: "#UserUserpassword"
            },
	 	    "data[User][email]": {
	                required: true,
	                email: true
	                //remote: "emails.php"
	            },
            "data[UserBio][dob]": {
                required: true
            },   
	         
            "data[UserBio][gender]": {
                required: true
            },   

            
            "data[UserBio][weight_current]": {
                phoneNumber: true
            },
            
            "data[UserBio][zip]": {
                characterORnumber: true
            },
            "data[UserBio][height_current]": {
            	height: true
            },
            
           /* "data[UserBio][city]": {
            	username: true
            },
            
            "data[UserBio][state]": {
            	username: true
            },
            	
            "data[UserBio][country]": {
            	username: true
            }*/
            
            
            /*,
            
            "data[User][phone]": {
                required: true,
                phoneNumber: true
            },            
            "data[User][fax]": {
                phoneNumber: true
            },            
            "data[User][zipcode]": {
                required: true,
                characterORnumber: true
            }*/
  
         },
    messages: {

        "data[User][firstname]": {
            required: "Please enter first name",
            username: "Space/Special characters not allowed.",
            maxlength:"max length 15 character",
            minlength: "Firstname must consists of at least 2 characters"
        },
        "data[User][lastname]": {
            username: "Space/Special characters not allowed.",
            maxlength:"max length 15 character"
        },        
        "data[User][email]": {
            required: "Please enter your email address"
        },        
        "data[User][password]": {
            required: "Please provide a password",
            minlength: "Password must be at least 6 characters long"
        },
        "data[User][password_confirm]": {
            required: "Please confirm your password",
            equalTo: "Please enter the same password as above"
        },
        "data[UserBio][dob]": {
            required: "Please enter Date of Birth"
        },
        
        "data[UserBio][gender]": {
            required: "Please select gender"
        },  
        
        "data[UserBio][weight_current]": {
            required: "Please enter valid weight"
        },
        
        "data[UserBio][zip]": {
            characterORnumber: "Please enter valid zip code",
            minlength: "Please enter valid zip code"
        },
        "data[UserBio][height_current]": {
        	required: "Please enter valid height in inches"
        },
        
        /*,
        
        "data[User][phone]": {
            required: "Please enter valid weight"
        },  
        "data[User][fax]": {
            phoneNumber: "Please enter valid FAX number"
        },         
        "data[User][zipcode]": {
            required: "Please enter your zip code",
            characterORnumber: "Please enter valid zip code",
            minlength: "Please enter valid zip code"
        }*/
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
       $("#UserCountry").change(function() {
       			var country = $("#UserCountry").val();
 			 if (country != '230') {
 			  
 			  	$('#nonusstatediv').removeClass("switch_off");
 			 	$('#nonusstatediv').addClass("switch_on");
 			 	$('#usstatediv').removeClass("switch_on");
 			 	$('#usstatediv').addClass("switch_off");
 			 }
 			 else
 			 {
 			 	$('#nonusstatediv').removeClass("switch_on");
 			 	$('#nonusstatediv').addClass("switch_off");
 			 	$('#usstatediv').removeClass("switch_off");
 			 	$('#usstatediv').addClass("switch_on");
 			 }
 			 
 			 });
     });
			
