<?php

    // app/models/UserReflection.php
    class UserReflection extends AppModel {
        var $name = 'UserReflection';
	var $errMsg = array();
	
	var $belongsTo = array(
	    'User' => array(
		    'className' => 'User',
		    'foreignKey'=> 'user_id',
		),
	    'Question_1' => array(
		    'className' => 'Question',
		    'foreignKey'=> 'question_id1',
		),
	    'Question_2' => array(
		    'className' => 'Question',
		    'foreignKey'=> 'question_id2',
		),
	    'Question_3' => array(
		    'className' => 'Question',
		    'foreignKey'=> 'question_id3',
		)
	    );
	
	var $hasMany = array(
	    'ShareReflection' => array(
		    'className' => 'ShareReflection',
		    'foreignKey'=> 'reflection_id',
		),
	    'ReflectionAttendy' => array(
		    'className' => 'ReflectionAttendy',
		    'foreignKey'=> 'reflection_id',
		)
	    );
	
}
?>