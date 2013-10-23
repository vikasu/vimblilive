// validate signup form on keyup and submit

$(document).ready(function($) {
	$("#changepassform").validate({
		rules : {
			"data[User][oldpassword]" : {
				required : true,
				minlength : 6,
				maxlength : 15
			},
			"data[User][newpassword]" : {
				required : true,
				minlength : 6,
				maxlength : 15
			},
			"data[User][connewpassword]" : {
				required : true,
				minlength : 6,
				maxlength : 15,
				equalTo : "#UserNewpassword"
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
