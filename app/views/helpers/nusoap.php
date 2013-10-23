<?php 
App::import('Vendor','nusoap',array('file' => 'nusoap/nusoap.php'));
$server = new soap_server;
$server->register('hello');

class NusoapHelper extends AppHelper {
    

	
	function hello($name) { 
			return 'Hello, ' . $name;
			pr(get_included_files());
	}	

}
?>