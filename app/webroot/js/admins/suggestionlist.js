$(document).ready(function() {
	// Listen for click on toggle checkbox
	$('#FileSelectAll').click(function(event) {
		if (this.checked) {
			// Iterate each checkbox
			$(':checkbox').each(function() {
				this.checked = true;
			});
		} else {
			$(':checkbox').each(function() {
				this.checked = false;
			});
		}
	});

});
function confirmdeleteall() {
	var n = $("input:checked").length;
	if (n >= 1) {
		if (confirm("Are you want to delete selected?")) {
			document.forms['suggestionactionform'].submit();
		} else {
			return false;
		}
	} else {
		alert("Please select");
	}
}
