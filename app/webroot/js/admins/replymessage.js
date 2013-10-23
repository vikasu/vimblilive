// validate signup form on keyup and submit

$(document).ready(function($) {
	$("#replymsg").validate({
		rules : {
			"data[Message][message_type]" : {
				required : true
			},
			"data[Message][users][]" : {
				required : true
			},
			"data[Message][message]" : {
				required : true
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