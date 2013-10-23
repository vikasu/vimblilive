<?php
class GcmComponent extends Object 
{
	private $key;
	private $registration_ids;
	private $collapse_key;
	private $messageText;
	
	public function setKey($key) 
	{
		$this->key = $key;
	}
	
	public function setRegistrationIds($registrationIds) 
	{
		$this->registration_ids = $registrationIds;
	}
	
	public function setCollapseKey($collapseKey) 
	{
		$this->collapse_key = $collapseKey;
	}
	
	public function setMessageText($text) 
	{
		$this->messageText = $text;
	}
	
	public function sendMessageToPhone() 
	{
		$headers = array('Authorization: key=' . $this->key,
				'Content-Type: application/x-www-form-urlencoded;charset=UTF-8');
	
		print_r($this->registration_ids);
	
		$data = array(
				//'registration_id' => $this->registration_ids,
				'registration_id' => $this->registration_ids,
				'collapse_key' => $this->collapse_key,
				'data.message' => $this->messageText
		);
	
		$curlpost = "";
		foreach($data as $key=>$value) {
			$curlpost .= "{$key}={$value}&";
		}
		$curlpost = rtrim($curlpost, '&');
	
		$ch = curl_init();
	
		//curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
		curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
	
		if ($headers)
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $curlpost);
	
		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if (curl_errno($ch)) {
			//request failed
			return false;//probably you want to return false
		}
		if ($httpCode != 200) {
			//request failed
			return false;//probably you want to return false
		}
		curl_close($ch);
		return $response;
	
	}
	
}
?>
