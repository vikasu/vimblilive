<?php
    class Mission extends AppModel {
        var $name = 'Mission';
		
	var $hasMany = array(
	    'Milestone' => array(
		    'className' => 'Milestone',
		    'foreignKey'=> 'mission_id',
		    'dependent'=> true
		),
	    'KeyToSuccess' => array(
		    'className' => 'KeyToSuccess',
		    'foreignKey'=> 'mission_id',
		    'dependent'=> true
		),
	    'MissionConnection' => array(
		    'className' => 'MissionConnection',
		    'foreignKey'=> 'mission_id',
		    'dependent'=> true
		),
	    'MissionUser' => array(
		    'className' => 'MissionUser',
		    'foreignKey'=> 'mission_id',
		    'dependent'=> true
		)
	    );
	
	var $belongsTo = array(
		'Sponsor' =>array(
			'className'=> 'User',
			'foreignKey'=> 'sponsor_id'
		    ),
	    'Owner' => array(
		    'className' => 'User',
		    'foreignKey'=> 'owner',
		    'dependent'=> true
		)
		);
	
	
}
?>