$(document).ready(function($) {
	$("#addfaq").validate({
		rules : {
			"data[Faq][faq_que]" : {
				required : true
			},
			"data[Faq][faq_ans]" : {
				required : true
			},
			"data[Faq][priority]" : {
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