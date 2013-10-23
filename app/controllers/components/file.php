<?php
/**
	* Component for File handling
	* 
	*
	* PHP versions 5.1.4
	* @filesource
	* @author     Sujeesh.V 
	* @link       http://www.supportresort.com/
	* @link       http://cribhut.com Cribhut
	* @copyright  Copyright © 2007 Cribhut
	* @version 0.0.1 
	*   - Initial release
	*/
class FileComponent extends Object {
	/**
	* Controller name
	* @access public
	*/
	public $controller;
	public $fileName;
	public $destPath;
	public $useHash = false;
	public $cleanName = false;

	public function startup( &$controller ) {
		$this->controller = &$controller;
    }

	public function getFileName() {
		return $this->fileName;
	}

	public function setFileName($fname) {	
		$this->fileName  = $fname;
	}

	public function setDestPath($path) {
		$this->destPath = $path;
	}

	public function uploadFile($originName,$tmp_name,$getRandomName =  TRUE) {	
		if(is_dir($this->destPath))	{
			$this->fileName = str_replace(".jpeg",".jpg",".gif",$this->fileName);
			$extDot = explode(".",$this->fileName);
			$ext = $extDot[count($extDot)-1];
			$this->fileName = ($getRandomName)?$this->getRandomFilename():$this->fileName;
			if(!strstr($this->fileName,".")) {
				$this->fileName .= ".".$ext;
			}

			if($this->cleanName)	{
				$this->fileName = $this->clean_string(substr($this->fileName,0,strlen($this->fileName)-(strlen($ext) + 1))).".".$ext;
			}

			//$origin = strtolower(basename($originName));
			
			$dest   = $this->destPath."/".$this->fileName;
			
			if(move_uploaded_file($tmp_name,$dest))	{
				//chmod($dest,0777);
				return $this->fileName;
			}else
				return false;		
		}else {
			echo 'Destination directory does not exists!';
		}
	}

	public function getRandomFileName() {	
		if($this->useHash===true) {
			$fileName  = md5($this->controller->misc->generate_unique_string(10));
		}else {
			$fileName  = rand(1000,1000000);
		}		
		
		if($this->is_exists($fileName)) {			
			$this->getRandomFileName();	
		}else {
			return $fileName;			
		}
	}

	public function is_exists($filename) {
		if(file_exists($this->destPath."/".$filename)) {
			return true;
		} else {
			return false;
		}
	}

	public function createHashValue($fileName) {
		return md5(file_get_contents($fileName)+filesize($fileName));
	} 

	public function getFileExt($fileName) {
		return substr($fileName,strpos($fileName,"/")+1);
	}

	/* allow letters, numbers and underscore(-) only. removing anything else with underscore.
	for ex "myname is : No -- 007 i.e. Mr. Bond" will be changed to "myname_is_no_007_ie_mr_bond"
	*/
	public function clean_string($text)	{
		$text = preg_replace('/[^\w]/', '_', $text);
		$text = preg_replace('/[\_\-]{1,}/', '_', $text);
		$text = preg_replace('/^\_?(.*?)\_?$/', '\1', $text);
		return strtolower($text);
	}
}
?>