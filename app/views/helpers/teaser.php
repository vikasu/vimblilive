<?php
/*
* AppController class
* PHP versions 5.1.4
* @filesource
* @author  Gurpreet Singh Ahluwalia
* @date 26-july-2012
* @link       http://www.smartdatainc.net/
* @version 0.0.1 
*   - Initial release
* @return [Hyperlinktext+teaser]  || [text+teaser]
*/

class TeaserHelper extends AppHelper{
    
     var $helpers = array('Html');
    
    //function to truncate text and show read more link
    /*
	*********In controller**********
	var $helpers = array('Teaser'); 
	 
	**********In view****************
	$parms => array(
		    'prefix' => '', 			[null]['passvalue']
		    'controller' => '',			['passvalue']
		    'action' =>'' ,			['passvalue']
		    'readmore' => '' 			[null]['passvalue'] 
		
	) 
	echo $this->Teaser->truncateText($page['Page']['content'],35,$parms);
	
    */
    function truncateText($mytext,$chars = 25,$params=null) {   
	/*
	    Custom variable  $prefix , $suffix
	*/
		
	$totalchar=strlen($mytext);
	$text=$mytext;
	
	$prefix="...";
	$suffix="";
	
	    if($totalchar > $chars)
	    {
		$mytext = substr($mytext,0,$chars);  
		$mytext = substr($mytext,0,strrpos($mytext,' '));
		if($mytext == '')
		{
		    $mytext = substr($text,0,$chars);  
		}
		else
		{
		    
		}
		
	    }
	    if(($params!=null) && is_array($params) && $totalchar > $chars)
	    {		
		    $mytext =trim($mytext);
		     
		    if(!empty($params['prefix']))
		    {
			    if(!empty($params['readmore']))
			    {
				$teaserlink =$this->Html->link($params['readmore'],array('controller' =>$params['controller'] ,'action' =>$params['action'],'prefix' => $params['prefix']) );
			    }
			    else
			    {
				$teaserlink = $this->Html->link('read more',array('controller' =>$params['controller'] ,'action' =>$params['action'],'prefix' => $params['prefix']) );
			    } 
			
		    }
		    else
		    {
			 if(!empty($params['readmore']))
			 {
				$teaserlink = $this->Html->link($params['readmore'],array('controller' =>$params['controller'] ,'action' =>$params['action']) );
			 }
			 else
			 {
				$teaserlink =$this->Html->link('read more',array('controller' =>$params['controller'] ,'action' =>$params['action']) );
			 }
		    } 
		
		    if(!empty($params['readmore']))
		    {
			$mytext=$mytext.$prefix.$teaserlink.$suffix;
		    }
		    else
		    {
			$mytext=$mytext.$prefix;		    
		    }
	    }
	//$mytext = $mytext." <a href='$link?$var=$id'>read more...</a>";  
	return $mytext;  
    }  
}
?>