<?php
class UserBio extends AppModel {
	var $name = 'UserBio';
	var $validate = array(
		
		'gender' => array(
				'notempty' => array(
						'rule' => array('notempty'),
						'message' => 'Please select gender',
						//'allowEmpty' => false,
						//'required' => false,
						//'last' => false, // Stop validation after this rule
						//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),

		'dob' => array(
				'date' => array(
						'rule' => array('date'),
						'message' => 'Please enter Date of Birth in proper format',
						//'allowEmpty' => false,
						//'required' => false,
						//'last' => false, // Stop validation after this rule
						//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),
			
		'weight_current' => array(
				'numeric' => array(
						'rule' => array('numeric'),
						'message' => 'Please enter weight in Numeric format',
						'allowEmpty' => true,
						//'required' => false,
						//'last' => false, // Stop validation after this rule
						//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
		),
			
	);
	
}
