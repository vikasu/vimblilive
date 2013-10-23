<?php
    // app/models/User.php
    class ConnectionGroup extends AppModel {
        var $name = 'ConnectionGroup';
		
	var $hasMany = array(
	    'ConGroupRelation'=>array(
		    'className' => 'ConGroupRelation',
		    'foreignKey'=> 'group_id',
		    'dependent'=> true
	    )
	    );
	
	
}
?>