<?php
    // app/models/User.php
    class CalendarEvent extends AppModel {
        var $name = 'CalendarEvent';
		
	var $hasMany = array(
	    'EventAttendy' => array(
		    'className' => 'EventAttendy',
		    'foreignKey'=> 'event_id',
		    'dependent'=> true
		)
	    );
	
	
}
?>