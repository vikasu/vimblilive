<?php
class PromotionalCode extends AppModel{
   
 
  var $validate = array(
	    
	    'unique_code' => array(
		'notEmpty' => array(
			'rule' =>'isUnique',
			'message' => 'Promotional code Already Exist',
			
		)
	    )
            );
	   
}

?>