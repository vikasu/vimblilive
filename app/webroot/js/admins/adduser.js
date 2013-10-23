var currentTime = new Date();
var year = currentTime.getFullYear();
jQuery.noConflict();
jQuery(function() {
	jQuery("#joindate").datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		yearRange: '1920:year'
	});
});