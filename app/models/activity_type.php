<?php
    // app/models/User.php
    class ActivityType extends AppModel {
        var $name = 'ActivityType';
		
	var $hasMany = array(
	    'Activities'=>array(
		    'className' => 'Activities',
		    'foreignKey'=> 'activity_type_id',
		    'dependent'=> true
	    )
	    );
	
	
}
?>