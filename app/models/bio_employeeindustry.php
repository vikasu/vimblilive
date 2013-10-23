<?php
class BioEmployeeindustry extends AppModel {
	var $name = 'BioEmployeeindustry';
	var $validate = array(
		'value' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'value' => 'Please enter value',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			 'isUnique' =>array(
			 	'rule' =>array('isUnique'),
			 	'value' => 'Value with same name exists.',
			 	//'allowEmpty' => false,
			 	//'required' => false,
			 	//'last' => false, // Stop validation after this rule
			 	//'on' => 'create', // Limit validation to 'create' or 'update' operations
			 			
			 	),
				
			)			
		);
	}

