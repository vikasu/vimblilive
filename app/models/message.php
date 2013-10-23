<?php

    // app/models/Setting.php
    class Message extends AppModel {
        var $name = 'Message';
	var $errMsg = array();
	
	var $belongsTo = array(
	    'User' => array(
		    'className' => 'User',
		    'foreignKey'=> 'from_user_id',
		)
	    );
	
}
?>