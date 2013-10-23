<?php 
class TruncateHelper extends AppHelper {
    function myTruncate($string, $limit, $break=" ", $pad="...") { 
    	  // return with no change if string is shorter than $limit  
    	 if(strlen($string) <= $limit) return $string; 
    	 $string = substr($string, 0, $limit); 
    	if(false !== ($breakpoint = strrpos($string, $break))) { 
    		$string = substr($string, 0, $breakpoint); 
    	} 
    	$string = $this->restoreTags($string);
    	return $string . $pad; 
    }
     function restoreTags($input) { 
    		$opened = array(); 
    		// loop through opened and closed tags in order  
    		if(preg_match_all("/< (\/?[a-z]+)>?/i", $input, $matches)) { 
    			foreach($matches[1] as $tag) { 
    				if(preg_match("/^[a-z]+$/i", $tag, $regs)) { 
    					// a tag has been opened  
    					if(strtolower($regs[0]) != 'br') $opened[] = $regs[0]; 
    				} elseif(preg_match("/^\/([a-z]+)$/i", $tag, $regs)) { 
    					// a tag has been closed  
    					unset($opened[array_pop(array_keys($opened, $regs[1]))]); 
    				} 
    			} 
    		} // close tags that are still open  
    		if($opened) { 
    			$tagstoclose = array_reverse($opened); 
    			foreach($tagstoclose as $tag) 
    				$input .= ""; 
    		} 
    		return $input; 
    }
}
 
?>