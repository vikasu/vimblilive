<?php
class Helpcategory extends AppModel {
	var $name = 'Helpcategory';
	var $validate = array(
		'hc_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter Category',
				//'allowEmpty' => false,
				//'required' => false,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			 'isUnique' =>array(
			 	'rule' =>array('isUnique'),
			 	'message' => 'Same category exist.',
			 	//'allowEmpty' => false,
			 	//'required' => false,
			 	'last' => true, // Stop validation after this rule
			 	//'on' => 'create', // Limit validation to 'create' or 'update' operations
			 			
			 	),
			/* 'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Enter category in alphanumeric format',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			), */
				
			),
		);
	
	var $hasMany = array(
			'Help' => array(
					'className' => 'Help',
					'foreignKey' => 'help_cat_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			),
			);
	
	}
