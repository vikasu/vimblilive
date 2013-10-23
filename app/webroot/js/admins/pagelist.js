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
