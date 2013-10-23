<?php
    // app/models/UserGroup.php
    class UserGroup extends AppModel {
        var $name = 'UserGroup';
	
	var $hasAndBelongsToMany = array (
	     'User' => array(
		    'className' => 'User',
		    'foreignKey' => 'group_id',
		    'associationForeignKey' => 'user_id',
		    'joinTable' => 'user_groups_users',
		    'unique' => true,
		    )
		);
	
	var $errMsg = array();
	
	var $validate = array(
	    
	    'title' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => TITLE_EMPTY,
			'last' => true,
		),
		'isUnique' => array(
		    'rule' => 'isUnique',
		    'message' => 'Usergroup with this name already exists.'
		)
	    ),
	    'description' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => TITLE_EMPTY,
			'last' => true,
		)
	    )
	);
	

}
?>