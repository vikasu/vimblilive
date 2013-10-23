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

		if (confirm("Are you want to delete selected help topics?")) {
			document.forms['helpactionform'].submit();
		} else {
			return false;
		}
	} else {
		alert("Please select help topics First");
	}
}
