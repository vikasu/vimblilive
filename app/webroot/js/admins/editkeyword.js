$(document).ready(function($) {
	$("#editkeyword").validate({
		rules : {
			"data[Keyword][keyword_name]" : {
				required : true,
				minlength: 3,
                maxlength: 20
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