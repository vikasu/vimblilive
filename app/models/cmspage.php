<?php
class Cmspage extends AppModel {
	var $name = 'Cmspage';
	var $validate = array(
		'page_title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'Please enter Page Title',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			 'isUnique' =>array(
			 	'rule' =>array('isUnique'),
			 	'message' => 'Page Title have same name exist.',
			 	//'allowEmpty' => false,
			 	//'required' => false,
			 	//'last' => false, // Stop validation after this rule
			 	//'on' => 'create', // Limit validation to 'create' or 'update' operations
			 			
			 	),
			'alphanumeric' => array(
				'rule' => array('alphanumeric'),
				'message' => 'Enter Page Title in alphanumeric format',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
				
			),
			
			'content_type' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Please enter Content Type.',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
					'isUnique' =>array(
							'rule' =>array('isUnique'),
							'message' => 'Content Type have same name exist.',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
							 
					),
			),
			
		);
	}
