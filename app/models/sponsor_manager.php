<?php
    class SponsorManager extends AppModel {
        var $name = 'SponsorManager';
		
	var $belongsTo = array(
		'User' =>array(
			'className'=> 'User',
			'foreignKey'=> 'sponsor_id'
		    )
		);
	
}
?>