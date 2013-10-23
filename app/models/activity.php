<?php

    // app/models/Activity.php
    class Activity extends AppModel {
        var $name = 'Activity';
	var $errMsg = array();
	
	var $belongsTo = array(
	    'ActivityType' => array(
		    'className' => 'ActivityType',
		    'foreignKey'=> 'activity_type_id',
		)
	    );
	
	var $hasMany = array(
	    'ActivityAttendy' => array(
		    'className' => 'ActivityAttendy',
		    'foreignKey'=> 'event_id',
		)
	    );
	
	var $validate = array(
	    
	    'title' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => "Title cannot be empty",
			'last' => true
		)
	    )/*,
	    'activity_type_id' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => "Select Activity Type",
			'last' => true
			)
	    )*/
	);
}
?>