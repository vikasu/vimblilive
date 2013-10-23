<?php 
class CommonHelper extends Helper
{
	
	/**get_years
	* return paging variable
	* @param $paging length
	* @return $string: length
	*/
	function get_years(){
		
	     $yearArray = array();
	     $cYear = Date('Y')-100;
	     $sYear = Date('Y');
	     for($i = $sYear; $i >= $cYear; $i-- ){
		$yearArray[$i] = $i;
	     }
	     return $yearArray;

	}
	/** get_months
	* return paging variable
	* @param $paging length
	* @return $string: length
	*/
	function get_days(){
		
	     $yearArray = array();
	     $cYear = 1;
	     $j=0;
	     $sYear = 31;
	     for($i = $cYear; $i <= $sYear; $i++ ){
		if($i <= 9){
		$yearArray[$j.$i] = $i;
		}else{
		$yearArray[$i] = $i;			
		}
	     }
	     return $yearArray;

	}
	/** get_expiry_months	
	* return paging variable
	* @param $paging length
	* @return $string: length
	*/
	function get_months(){
		
	     $expMonths = array();
	     $expMonths = array('01' => 'JANUARY', '02' => 'FEBRUARY', '03' => 'MARCH', '04' => 'APRIL', '05' => 'MAY', '06' => 'JUNE', '07' => 'JULY', '08' => 'AUGUST', '09' => 'SEPTEMBER', '10' => 'OCTOBER', '11' => 'NOVEMBER', '12' => 'DECEMBER');
	     
	     return $expMonths;

	}
	
	
     // Find user's time 
     function userTime($timezoneId = null,$dateToconvert = null) {
	  App::import('Model','Timezone');
	  $this->Timezone = & new Timezone();
	  App::import('Model','User');
	  $this->User = & new User();
	  $userTimezoneInfo = $this->Timezone->find('first',array('conditions'=>array("Timezone.id" => $timezoneId)));
	  //$serverTime = date("Y-m-d H:i:s");
	  $userInfo = $this->User->find('first',array('conditions'=>array("User.id" => $_SESSION['Auth']['User']['id']),'fields'=>array('User.dst')));
	//pr($userInfo['User']['dst']); die;
	if($userInfo['User']['dst']==1){
	     $userLocalTime = date("Y-m-d H:i:s", strtotime($dateToconvert)+$userTimezoneInfo['Timezone']['difference_in_seconds']+3600);
	}else{
	    $userLocalTime = date("Y-m-d H:i:s", strtotime($dateToconvert)+$userTimezoneInfo['Timezone']['difference_in_seconds']);
	}	  
	  return $userLocalTime;
     }
     
     //Fetch reflection attendy
	function fetch_participant($id = NULL){
	
	 App::import('Model','UserReflection');
	 $this->UserReflection = & new UserReflection();
	 
	 App::import('Model','ConGroupRelation');
	 $this->ConGroupRelation = & new ConGroupRelation();
	
	  
	   $refInfo = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.id'=>$id)));
	   $this->set(compact('refInfo'));
	   
	   $participant = '';
	   foreach($refInfo["ShareReflection"] as $row):
		$allparticipants = $this->ConGroupRelation->find('all',array('conditions'=>array('ConGroupRelation.group_id'=>$row["group_id"],'Connection.user_id'=>$_SESSION["Auth"]["User"]["id"])));	   $this->set(compact('allparticipants'));
		$this->set(compact('allparticipants'));
		foreach($allparticipants as $listOfUser):
		     $participant = $participant. $listOfUser['Connection']['name'].', ';
		endforeach;
	   endforeach;
	   $participant = substr($participant,0,strlen($participant)-2);
	   $this->set(compact('participant'));
	   
	  
	   $conShared = '';
	    foreach($refInfo["ReflectionAttendy"] as $row1):
		     $conShared = $conShared. $row1['attendy_display_name'].', ';
	    endforeach;
	   
	   $conShared = substr($conShared,0,strlen($conShared)-2);
	   
	   if($participant != ""){
		$allAttendy = $conShared.', '.$participant;
	   } else{
		$allAttendy = $conShared;
	   }
	   
	   echo $allAttendy;
	}
	
	

} // class ends here ?>