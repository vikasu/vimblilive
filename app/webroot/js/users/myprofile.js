var currentTime = new Date();
var year = currentTime.getFullYear();

$(function() {
	jQuery.noConflict();
	jQuery("#UserBioDob").datepicker({
		dateFormat : 'yy-mm-dd',
		changeMonth : true,
		changeYear : true,
		yearRange: '1920:year'
	});
});