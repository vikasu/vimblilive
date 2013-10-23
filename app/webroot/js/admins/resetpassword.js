// validate signup form on keyup and submit

$(document).ready(function($) {
	$("#resetpass").validate({
		rules : {
			"data[Admin][newPwd]" : {
				required : true,
				minlength : 6,
				maxlength : 15
			},
			"data[Admin][resetPwd]" : {
				required : true,
				equalTo : "#AdminNewPwd"
			//remote: "emails.php"
			},

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
