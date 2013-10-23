<?php
    
    class CohortUser extends AppModel {
        var $name = 'CohortUser';
		
	var $belongsTo = array(
	    'Cohort' => array(
		    'className' => 'Cohort',
		    'foreignKey'=> 'cohort_id'
		)
	    );
	
	
}
?>