$(function() {
	$("#textfield2").datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true
	});
});

$(function() {
	$("#textfield3").datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true
	});
});

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
	if (n > 1) {

		if (confirm("Are you want to delete selected?")) {
			document.forms['actionform'].submit();
		} else {
			return false;
		}
	} else {
		alert("Please select user First");
	}
}

function changeDiv(radioobject) {
	var val = radioobject.id;
	if (val == 'joindate') {
		//alert('Hello');
		$('#divNoDate').hide();
		$('#divByDate').show();

	} else {
		$('#divNoDate').show();
		$('#divByDate').hide();
	}
}
