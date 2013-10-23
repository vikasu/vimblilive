// validate signup form on keyup and submit

$(document).ready(function($) {
	$("#forgotpass").validate({
		rules : {
			"data[Admin][email]" : {
				required : true,
				email : true
			//remote: "emails.php"
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
