<?php
    // app/models/User.php
    class Transaction extends AppModel {
        
	
	var $belongsTo = array(
	    'User' => array(
		    'className' => 'User',
		    'foreignKey'=> 'user_id'
		) ,
	    'SubscriptionPlan' => array(
		    'className' => 'SubscriptionPlan',
		    'foreignKey'=> 'plan_id'
		) 
	    );
    }