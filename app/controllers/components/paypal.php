<?php 

//App::uses('HttpSocket', 'Network/Http');
App::import('Core', 'HttpSocket');



/**
*Purpose of this class to payment for subscription palan through paypal.
**/ 
class PaypalComponent extends Object {

	public $request = array();

	private $test = false;
	private $liveServer = 'https://api-3t.paypal.com/nvp'; # https://api.paypal.com/nvp
	private $testServer = 'https://api-3t.sandbox.paypal.com/nvp'; # https://api.sandbox.paypal.com/nvp
	private $methodName = 'CreateRecurringPaymentsProfile';
    
	public function sendRequest()
	{
	    $nvpreq = '';
		//pr($this->request); die;
	    foreach ($this->request as $fldname => $val)
		if($val != '') $nvpreq .= strtoupper($fldname) . "=" . urlencode($val) . "&";
		//print_r($nvpreq);die;
		$url = ($this->test) ? $this->testServer : $this->liveServer;
		$post = "METHOD=" . $this->methodName . "&" . $nvpreq . "&VERSION=56.0";
		$retstr = $this->sendAPIRequest($url . "?" . $post);
		$retarrtmp = explode("&",$retstr);
		//print_r($retarrtmp);die;
		$retarr = array();
    
		    for($i=0;$i<count($retarrtmp);$i++)
			{
			    $sparr = explode("=",$retarrtmp[$i]);
			    $txt = urldecode($sparr[0]);
			    $val = urldecode($sparr[1]);
			    $retarr[$txt] = $val;
			}
	//print_r($retarr);die;
		    return $retarr;
	}
    
	/**
	 * True for test server. False for production.
	 * @param bool $isTest
	 */
	public function setIsTest($isTest)
	{
	    $this->test = $isTest;
	}
    
	private function sendAPIRequest($url)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $response = curl_exec($ch);
    
	    if(curl_errno($ch))
		$response = curl_error($ch);
    
	    curl_close($ch);
	    //print_r($response);die;
	    return $response;
	}
		
}
