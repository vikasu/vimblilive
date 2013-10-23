// validate signup form on keyup and submit

$(document).ready(function($) {
	$("#signupform").validate({
		rules : {
			"data[User][email]" : {
				required : true,
				email : true
			},
			"data[User][password]" : {
				required : true,
				minlength : 6,
				maxlength : 15
			},
			"data[User][passwordconfirm]" : {
				required : true,
				minlength : 6,
				maxlength : 15,
				equalTo : "#UserPassword"
			}

		},
		// the errorPlacement has to take the table layout into account
		errorPlacement : function(error, element) {
			error.appendTo(element.parent());
		},
		// set this class to error-labels to indicate valid fields
		success : function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}

	});
});
