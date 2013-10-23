<?php
class Help extends AppModel {
	var $name = 'Help';
	var $validate = array(
			'help_topic' => array(
					'notempty' => array(
							'rule' => array('notempty'),
							'message' => 'Please enter Help Topic',
							//'allowEmpty' => false,
							//'required' => false,
							//'last' => true, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
				),
	);
	
}
	?>