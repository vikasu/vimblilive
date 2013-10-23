<?php

    class Communication extends AppModel {
        var $name = 'Communication';
	
	var $belongsTo = array(
			       'User'=>array(
					     'className'=> 'User',
					     'foreignKey'=>'user_id'
					     )
			       );
	
	
}
?>