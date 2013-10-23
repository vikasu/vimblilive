<?php 
class ImportComponent extends Object
{
    var $components = array('Session','Email');
    
    // import contacts from gmail
    function getGmailToken($user='', $password='') {
    //========================================== step 1: login ===========================================================
	//$user = 'incredible.sndp@gmail.com';
	//$password = '9872103632';
	$login_url = "https://www.google.com/accounts/ClientLogin";
	$fields = array(
	    'Email' => $user,
	    'Passwd' => $password,
	    'service' => 'cp', // <== contact list service code
	    'source' => 'test-google-contact-grabber',
	    'accountType' => 'GOOGLE',
	);
    
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL,$login_url);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS,$fields);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec($curl);
	$returns = array();
    
	foreach (explode("\n",$result) as $line)
	{
	    $line = trim($line);
	    if (!$line) continue;
	    list($k,$v) = explode("=",$line,2);
	
	    $returns[$k] = $v;
	}
    
	curl_close($curl);
	if(!isset($returns['Error'])) {
		return $returns;
	}
	else {
	    if($returns['Error']=='BadAuthentication') {
		$errorArr = array("Error"=>"User Name and Password is incorrect.");
		//print_r($errorArr);
		return $errorArr;
	    }
	}
	
    echo "<pre>"; 
    print_r($returns);exit;
    }
	
	function getGmailContact($linkEmail=NULL,$accessToken=NULL){
	    //========================== step 2: grab the contact list ===========================================================
	    $feed_url = "http://www.google.com/m8/feeds/contacts/$linkEmail/full?alt=json&max-results=10000";
	
	    $header = array(
		'Authorization: GoogleLogin auth=' . $accessToken,
	    );
	
	    $curl = curl_init();
	    curl_setopt($curl, CURLOPT_URL, $feed_url);
	    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
	
	    $result = curl_exec($curl);
	    curl_close($curl);
	    $data = json_decode($result, true);
	    //$data = json_decode(json_encode((array) simplexml_load_string($result)),1);
	    //echo "<pre>"; print_r($data['feed']['entry'] );exit;
	    $contacts = array();
	    $i=0;
	    if(isset($data['feed']['entry']) && !empty($data['feed']['entry'])){
	    foreach ($data['feed']['entry'] as $key=>$val){
		if(isset($val['id'])) {
		    $contacts[$key]['id'] = $val['id']['$t'];
		}
		if(isset($val['gd$email'])) {
		    foreach($val['gd$email'] as $email_key=>$email_val){
			$contacts[$key]['emails'][$email_key] = $email_val['address'];
		    }
		}
		if(isset($val['gd$phoneNumber'])) {
		    foreach($val['gd$phoneNumber'] as $phone_key=>$phone_val){
			$contacts[$key]['phone'][$phone_key] = $phone_val['$t'];
		    }
		}
		if(isset($val['gd$postalAddress'])) {
		    foreach($val['gd$postalAddress'] as $address_key=>$address_val){
			$contacts[$key]['address'][$address_key] = $address_val['$t'];
		    }
		}
	    
		$contacts[$key]['title'] = $val['title']['$t'];
			    }
	    
	    //echo'<pre>';
	   // print_r($contacts); exit;
	    return $contacts;
	}
	
     }
	
	


}
?>