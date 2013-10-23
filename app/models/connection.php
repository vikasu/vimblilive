<?php
    // app/models/User.php
    class Connection extends AppModel {
        var $name = 'Connection';
		
	var $hasMany = array(
	    'ConnectionPhone' => array(
		    'className' => 'ConnectionPhone',
		    'foreignKey'=> 'connection_id',
		    'fields'	=> array('ConnectionPhone.phone'),
		    'dependent'=> true
		),
	    'ConnectionEmail' => array(
		    'className' => 'ConnectionEmail',
		    'foreignKey'=> 'connection_id',
		    'fields'	=> array('ConnectionEmail.email'),
		    'dependent'=> true
		),
	    'ConnectionAddress' => array(
		    'className' => 'ConnectionAddress',
		    'foreignKey'=> 'connection_id',
		    'fields'	=> array('ConnectionAddress.address'),
		    'dependent'=> true
		),
	    'ConGroupRelation'=>array(
		    'className' => 'ConGroupRelation',
		    'foreignKey'=> 'connection_id',
		    'dependent'=> true
	    ),'MissionConnection'=>array(
		    'className' => 'MissionConnection',
		    'foreignKey'=> 'connection_id',
		    'dependent'=> true
	    )
	    );
	
	
}
?>