<?php

class CtreeHelper extends AppHelper {

	function indentTree($array, $counter=0){
		$ret = '';
		$array2 = array();
		$pre = '';
		for($i = 0;$i < $counter; $i++){
			$pre .=  "--";
		}
		//echo "<pre>"; print_r($array);
        if(!empty($array))
		{
		foreach($array as $key => $value){
			if($key == 'children'){
				if(isset($value['Category']) || (isset($value['children']) && sizeof($value['children']) > 0)){
					$indented[] = $this->indentTree($value, ++$counter);
				}
				else{
					if(sizeof($value) > 0) {
					$indented[] = $this->indentTree($value, $counter);
					}
				}
			}
			elseif($key == 'Category'){
				$indented[$value['id']] = ''.$pre.''.$value['category_name'];
			}
			elseif(isset($value['Category']['category_name'])){
				$indented[] = $this->indentTree($value, $counter);
			}
		}
          return $this->flatten_array($indented, 2);
        }
		
	}
	
	function flatten_array($array, $preserve_keys = 0, &$out = array()) {
		foreach($array as $key => $child){
			if(is_array($child)){
				$out = $this->flatten_array($child, $preserve_keys, $out);
			} 
			elseif($preserve_keys + is_string($key) > 1){
				$out[$key] = $child;
			} 
			else {
				$out[] = $child;
			}
		}
		return $out;
	}

}

?>