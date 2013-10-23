<?php
   
    class CarouselDetail extends AppModel {
        var $name = 'CarouselDetail';
		
	
	 
	    
	    var $validate = array(
		
			'carousel_image' => array(
			'rule' => array(
			'extension', array('jpeg', 'jpg','png','bmp'),
			'message' => 'file not supported.'
		),
		),	
		);
		
	
	
}
?>