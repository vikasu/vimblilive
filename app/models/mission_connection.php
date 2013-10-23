<?php
    class MissionConnection extends AppModel {
        var $name = 'MissionConnection';
		
	var $belongsTo = array(
		'Mission' =>array(
			'className'=> 'Mission',
			'foreignKey'=> 'mission_id'
		    ),
		'Connection' =>array(
			'className'=> 'Connection',
			'foreignKey'=> 'connection_id'
		    )
		);
	
	
}
?>