<?php
class Page extends AppModel{
    
    var $name='Page';
    
    var $validate=array(
                        
                   
                    'title'=> array(
                                    'notEmpty' => array(
						      'rule' => 'notEmpty',
						      'message' => "Please enter page title.",						 
						      'last' => true
				    ) 
                                ),
                    
                    'content'=> array(
                                    'notEmpty' => array(
						      'rule' => 'notEmpty',
						      'message' => "Please enter page content.",						 
						      'last' => true
				    )  
                        
                                )
                         
                
                
                );
    
}

?>