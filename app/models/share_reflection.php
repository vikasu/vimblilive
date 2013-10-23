<?php

    // app/models/UserReflection.php
    class ShareReflection extends AppModel {
        var $name = 'ShareReflection';
	var $errMsg = array();
	
		
	var $belongsTo = array(
	    'ConnectionGroup'=>array(
		    'className' => 'ConnectionGroup',
		    'foreignKey'=> 'group_id'
	    )
	    );
	
}
?>