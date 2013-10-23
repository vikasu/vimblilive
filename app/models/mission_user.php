<?php
    class MissionUser extends AppModel {
        var $name = 'MissionUser';
		
	var $belongsTo = array(
		'Mission' =>array(
			'className'=> 'Mission',
			'foreignKey'=> 'mission_id'
		    ),
		'User' =>array(
			'className'=> 'User',
			'foreignKey'=> 'shared_with_id'
		    )
		);
	
	
}
?>