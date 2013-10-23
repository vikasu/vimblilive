<?php
    class ConGroupRelation extends AppModel {
        var $name = 'ConGroupRelation';
		
	var $belongsTo = array(
	    'Connection' => array(
		    'className' => 'Connection',
		    'foreignKey'=> 'connection_id'
		),
	    'ConnectionGroup'=>array(
		    'className' => 'ConnectionGroup',
		    'foreignKey'=> 'group_id'
	    )
	    );
	

}
?>