<?php

/**
* Class Name: AdminsController it extends class AppController
* Description: This class is for controlling all the functions which relates to the USER type "admin"
*
*/

class WebservicesController extends AppController {
	
	var $name = 'Webservices';
	var $uses = array('User','UserBio','BioEmployeeindustry','BioEmployeestatus','BioHighesteducation','BioHouseholdincome','BioWorktype','SetupConnectivity','Activity','Keyword','Faq','Helpcategory','Help','SetupCommunication','SetupSelfcare','SetupTimecare','SyncMysql','DailyReflection','DailyActivity','Contactus','SetupsConnectivity','SetupsCommunication','SetupsSelfcare','SetupsTimecare','Gcmdevice','GcmNotification');
	var $helpers = array('Nusoap');
	var $components = array('Gcm');	
	
	function index(){ //$postdata = file_get_contents("php://input");pr($postdata); exit;
		$this->autoRender=false;
		App::import('Vendor','nusoap',array('file' => 'nusoap/nusoap.php'));
		$server = new soap_server;
		$server->register('hello',                // method name
							array('name' => 'xsd:string'),        // input parameters
							array('return' => 'xsd:string'),      // output parameters
							'urn:AppWebService',                      // namespace
							'urn:AppWebService#hello',                // soapaction
							'rpc',                                // style
							'encoded',                            // use
							'Says hello to the caller'            // documentation
						); 	
						
		echo $this->hello("SKM");	
			
		$postdata = isset($postdata) ? $postdata : '';
		$server->service($postdata); 						
	}

	function hello() { 
	  print_r($_REQUEST); exit;
		//echo json_encode(array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5)); exit; 

			//$name = $this->data['name'];
	        $this->autoRender=false;
			//pr(get_included_files());
			//return 'Hello, ' . $name;
	}
	
	function signup()
	{
		$this->autoRender=false;
		//echo "<pre>"; print_r($_REQUEST); exit;
		$useremail = $_REQUEST['email'];
		$userpass = $_REQUEST['password']; 
		
		if($useremail!="" AND $userpass!=""){
			$this->data ['User']['email'] = $useremail;
			$this->data ['User']['password'] = md5($userpass);
			$this->data['User']['join_date'] = date("Y-m-d");
			$this->data['User']['user_type'] = 0;
			$this->data['User']['user_status'] = 0;
			$this->User->save($this->data['User']); 
			if ($this->User->save($this->data['User']))
			{
				$success = 1;
				$msg = "demouseradded";
				$userId = $this->User->getLastInsertID();
				$this->data['UserBio']['user_id'] = $userId;
				if($this->UserBio->save($this->data['UserBio']))
				{
					$success = 1;
					$msg = "demouseradded";
				}else{
					$this->User->delete($userId);
					$success = 0;
					$msg = "signupfailed";
				}
			}else{
				$success = 0;
				$msg = "signupfailed";
			}
		}else{
			$success = 0;
			$msg = "signupfailed";
		}
		
		$returnVal = array(
					 "Data" =>  array(												   
									   'success'=>$success,
									   'message'=>$msg
									  )
					);				
		echo json_encode($returnVal);			
	}
	
	function login()
	{ //echo "HHHHHHHHHH"; print_r($_REQUEST); exit;
		$this->autoRender=false;
		
		$useremail = $_REQUEST['email'];
		$userpass = md5($_REQUEST['password']); 
		
		if($useremail!="" AND $userpass!=""){
			$this->User->recursive = -1;
			
			$userDetail = $this->User->find('all',array('fields' => array('User.id','User.name','User.last_name','User.email','User.password','User.gmail_token','User.join_date','User.user_type','User.user_status','User.loggedfirst','User.remember_date','User.last_uses','User.last_login','User.unique_device_id'),'conditions'=>array('User.email' => $useremail,'User.password'=>$userpass,'User.user_type'=>0)));						
			//echo "<pre>"; print_r($userDetail);
			if($userDetail!="" AND !empty($userDetail)){ 
			
				/*if($userDetail['0']['User']['loggedfirst']=='0'){ 
					$success = 1;
					$msg = "You looged in for 1st time.";
				}elseif($userDetail['0']['User']['loggedfirst']=='1'){
					$success = 2;
					$msg = "";
				}*/
				if($userDetail['0']['User']['user_status']=='0'){
					$success = 1;
					$msg = "demouser";
				}else{
					$success = 1;
					$msg = "liveuser";
				}
			}else{ 
				$success = 0;
				$msg = "notavimbliuser";
			}		
		}else{
			$success = 0;
			$msg = "User email/password missing.";		
		}
		
			$returnVal = array(
						 "Data" =>  array(												   
										   'success'=>$success,
										   'message'=>$msg,
										   'userdetail'=>$userDetail
										  )
						);				
			echo json_encode($returnVal);			
	}		
	function rememberme()
	{
	    //print_r($_REQUEST); exit;
		$this->autoRender=false;
		
		$deviceid = $_REQUEST['iemiNumber'];
		//$remdate = $_REQUEST['remDate']; 
		$user_id = $_REQUEST['userid']; 
		$remdate = DboSource::expression('NOW()');
		if ($this->User->save(array("id"=>$user_id,"unique_device_id"=>$deviceid,'remember_date'=>$remdate)))
			{
				$returnVal = array('success'=>1,'message'=>"Rememeber date is set for 14 days");
			}else{
				$returnVal = array('success'=>0,'message'=>"Rememeber date can not be updated");
			}
			
		echo json_encode($returnVal);	
	}

	
	function alreadyRemember()
	{

		$this->autoRender=false;
		$deviceid = $_REQUEST['iemiNumber'];
		
		$this->User->recursive = -1;
		$userData = $this->User->find('first',array('conditions'=>array("User.unique_device_id"=>$deviceid)));
		
		$dateDiff = (strtotime(date("Y-m-d H:i:s")) - strtotime($userData['User']['remember_date']))/86400;		
		if($dateDiff>=0 && $dateDiff<=14)
		{
			$returnVal = array('success'=>1,'message'=>"You have logged in for 14 days");
		}
		else
		{
			$returnVal = array('success'=>0,'message'=>"");
		}
		if($userData['user_status']==0){
			$success = 0;
			$message = "";
		}else{
			$success = 1;
			$message = "";
		}
		$returnVal = array('success'=>$success,'message'=>$message);
		echo json_encode($returnVal);
		
	}
	
	function logout()
	{
		$this->autoRender=false;
		$deviceid = $_REQUEST['iemiNumber'];
		
		$this->User->recursive = -1;
		$userData = $this->User->find('first',array('conditions'=>array("User.unique_device_id"=>$deviceid)));

		$user_id = $userData['User']['id'];
		
		$remdate = date("Y-m-d H:i:s", strtotime("0000-00-00 00:00:00"));
		
		if($this->User->save(array("id"=>$user_id,'remember_date'=>$remdate,"User.unique_device_id"=>null)))
		{
			$returnVal = array('success'=>1,'message'=>"Logout");
		}
		else
		{
			$returnVal = array('success'=>0,'message'=>"Failed");
		}
		echo json_encode($returnVal);
		
	}
	
	function biolist(){ 
	    $this->autoRender=false;
	
		$bioemployeeindustry = $this->BioEmployeeindustry->find('all', array('fields' => array('BioEmployeeindustry.id','BioEmployeeindustry.value')));
		$bioemployeestatus = $this->BioEmployeestatus->find('all', array('fields' => array('BioEmployeestatus.id','BioEmployeestatus.value')));
		$biohighesteducation = $this->BioHighesteducation->find('all', array('fields' => array('BioHighesteducation.id','BioHighesteducation.value')));
		$biohouseholdincome = $this->BioHouseholdincome->find('all', array('fields' => array('BioHouseholdincome.id','BioHouseholdincome.value')));
		$bioworktype = $this->BioWorktype->find('all', array('fields' => array('BioWorktype.id','BioWorktype.value')));						
				
		$returnArray = array(
							 "Data" =>  array(
											   'success'=>1,
											   'bioemployeeindustry'=>$bioemployeeindustry,
											   'bioemployeestatus'=>$bioemployeestatus,
											   'biohighesteducation'=>$biohighesteducation,
											   'biohouseholdincome'=>$biohouseholdincome,
											   'bioworktype'=>$bioworktype
											 )		 
							);					
		echo json_encode($returnArray);
	}
	
	function setupconnection(){ //print_r($_REQUEST); exit;
	  $this->autoRender=false;
	  $connData = $_REQUEST['connData']; //echo count($connData);
	  $connData = str_replace("[","",$connData);
	  $connData = str_replace("]","",$connData);
	  $connDataArray = explode("},",$connData);
	  
	  
	  foreach($connDataArray as $connDataValues){
		$connDataValues = str_replace("{","",$connDataValues);
		$connDataValues = str_replace("}","",$connDataValues);
	    $connDataValueArray = explode(",",$connDataValues);
            //echo str_replace("name=","",$connDataValueArray[2]); echo "<br>";
			$user_id = "";
		    $contact_id = "";
			$contact_name = str_replace("name=","",$connDataValueArray[2]);
			$contact_number = str_replace("number=","",$connDataValueArray[0]);
			$touches = str_replace("spinnerValueByPos=","",$connDataValueArray[1]);
		$this->SetupConnectivity->create();	
		$this->SetupConnectivity->save(
						  array(
								"touches"=>$touches,
								"contact_name"=>$contact_name,
								"contact_phone"=>$contact_number
								)
						);
	  }
	}
	
	function getbio(){	
	    $this->autoRender=false;
		$useremail = $_REQUEST['email'];
		$userid = $this->getUserIdFromEmail($useremail);
		$getbio = $this->UserBio->find('all', array('fields' => array('UserBio.id','UserBio.user_id','UserBio.gender','UserBio.dob','UserBio.city','UserBio.state','UserBio.country','UserBio.zip','UserBio.relationship_status','UserBio.household_income','UserBio.education_highest','UserBio.employment_status','UserBio.employment_industry','UserBio.work_type','UserBio.religion_view','UserBio.religious_activity','UserBio.political_view','UserBio.weight_current','UserBio.height_current','UserBio.living_arrangement'),'conditions'=>array('UserBio.user_id' => $userid)));
		$returnArray = array(
							 "Data" =>  array(
											   'success'=>1,
											   'getbio'=>$getbio
											  )
							);
		echo json_encode($returnArray);
	}

	function getuser(){	
	    $this->autoRender=false;
		$useremail = $_REQUEST['email'];
		$this->User->unBindModel(array('hasMany' => array('AllocateTime', 'SetupCommunication', 'SetupConnectivity', 'SetupDatasource', 'SetupEnvironment', 'SetupSelfcare', 'SetupTimecare', 'Suggestion', 'DailyReflection')));
		$getuser = $this->User->find('all', array('fields' => array('User.id','User.name','User.last_name','User.email','User.password','User.gmail_token','User.join_date','User.user_type','User.user_status','User.loggedfirst','User.remember_date','User.last_uses','User.last_login','User.unique_device_id','User.liveuser','User.ipnid'),'conditions'=>array('User.email' => $useremail)));
		$returnArray = array(
							 "Data" =>  array(
											   'success'=>1,
											   'getuser'=>$getuser
											  )
							);
		echo json_encode($returnArray);
	}		
	
	function activitylist(){	
	    $this->autoRender=false;
		$activitylist = $this->Activity->find('all', array('fields' => array('Activity.id','Activity.activity_name')));
		$returnArray = array(
							 "Data" =>  array(
											   'success'=>1,
											   'activitylist'=>$activitylist
											  )
							);
		echo json_encode($returnArray);
	}
	
	function keywordlist(){	
	    $this->autoRender=false;
	    //$activityid = $_REQUEST['activityid'];
		$keywordlist = $this->Keyword->find('all', array('fields' => array('Keyword.id','Keyword.activity_id','Keyword.keyword_name')));
		
		$returnArray = array(
					 "Data" =>  array(
									   'success'=>1,
									   'keywordlist'=>$keywordlist
									  )
					);
		echo json_encode($returnArray);
	}

	function faqlist(){	
	    $this->autoRender=false;
		$faqlist = $this->Faq->find('all', array('fields' => array('Faq.faq_que','Faq.faq_ans','Faq.priority'),'condition' => array('Faq.faq_status'=>'1')));
		//echo "<pre>"; print_r($faqlist); exit;
		$returnArray = array(
					 "Data" =>  array(
									   'success'=>1,
									   'faqlist'=>$faqlist
									  )
					);
		echo json_encode($returnArray);
	}

	function helplist(){	
	    $this->autoRender=false;
		$helpArray = $this->Helpcategory->find('all', array('fields' => array('Helpcategory.id','Helpcategory.hc_name'),'conditions' => array('Helpcategory.hc_status'=>'1')));
		
		$returnArray = array(
					 "Data" =>  array(
									   'success'=>1,
									   'helplist'=>$helpArray
									  )
					);
		echo json_encode($returnArray);
	}	
	
		function test(){
		$this->autoRender=false;
		$json = file_get_contents('php://input');  
		$data = json_decode($json);  
		/*foreach ($data as $id => $jsons) {  
			$query= "insert into table(a,b,c) values(".$jsons->a.",".$jsons->b.",".$jsons->c.",'".$jsons->c."')";  
			//echo $query;  
			echo "\n";  
			$query_exec = mysql_query($query) or die(mysql_error());  
		}*/ 
		echo "Success";
	}
	
	function getUserIdFromEmail($emailid){
		$this->autoRender=false;
		$getidArray = $this->User->find('first',array('fields' => array('User.id'),'conditions'=>array("User.email"=>$emailid)));
		//print_r($getidArray['User']);
		return $getidArray['User']['id'];
	}	
	
	function getUserColumnById($userid, $column){
		$this->autoRender=false;
		$getidArray = $this->User->find('first',array('fields' => array('User.'.$column),'conditions'=>array("User.id"=>$userid)));
		return $getidArray['User'][$column];
	}
	
	function synctowebsetup(){
		$this->autoRender=false;
		
		$json = file_get_contents('php://input');  
		$data = json_decode($json);
		echo "--------Before-------";
		
		$tablename = $data[0]->tablename;
		$syncdatetime = $data[0]->syncdatetime; //echo "<br>";
		$tabledata = $data[1];
		//print_r($tabledata); exit;
		
		switch($tablename){
			case "setup_connectivities":
				$succ_sc = $this->syncsetupconnectivities($tabledata,$syncdatetime);
				if($succ_sc==1){
					echo 1;
					echo $this->updatesynctime("setup_connectivities",$tabledata[0]->emailid,$syncdatetime);
				}				 
			break;	
			case "setup_selfcares":
				$succ_ss = $this->syncsetupselfcare($tabledata,$syncdatetime);
				if($succ_ss==1){
					echo 2;
					$this->updatesynctime("setup_selfcares",$tabledata[0]->emailid,$syncdatetime);
				}
			break;			
			case "setup_timecares":
				$succ_stc = $this->syncsetuptimecare($tabledata[0]->emailid,$tabledata[0]->productive_time_slot,$tabledata[0]->schedule_level,$syncdatetime);
				if($succ_stc==1){
					echo 3;
					$this->updatesynctime("setup_timecares",$tabledata[0]->emailid,$syncdatetime,$syncdatetime);
				}				 
			break;	
			case "user_bios":
				$succ_ub = $this->syncsetupbio($tabledata);
				if($succ_ub==1){
					echo 4;
					$this->updatesynctime("user_bios",$tabledata[0]->emailid,$syncdatetime);
				}
			break;			
			case "setup_communications":
				$succ_stcm = $this->syncsetupcommunication($tabledata[0]->emailid,$tabledata[0]->wrap_up_time,$tabledata[0]->weekly_summary_day,$tabledata[0]->weekly_summary_time,$tabledata[0]->localtimezone,$syncdatetime);
				if($succ_stcm==1){
					echo 5;
					$this->updatesynctime("setup_communications",$tabledata[0]->emailid,$syncdatetime);
				}			
			break;
			case "daily_reflections":
				$succ_dr = $this->syncsetupdailyreflection($tabledata);
				if($succ_dr==1){
					echo 6;
					$this->updatesynctime("daily_reflections",$tabledata[0]->emailid,$syncdatetime);
				}		
			break;
			case "daily_activities":
			$succ_da = $this->syncsetupdailyactivities($tabledata);
			if($succ_da==1){
				echo 7;
				$this->updatesynctime("daily_activities",$tabledata[0]->emailid,$syncdatetime);
			}
			break;
			case "messages":
			$succ_co = $this->synccontactuses($tabledata);
			if($succ_co==1){
				echo 8;
				$this->updatesynctime("contactuses",$tabledata[0]->emailid,$syncdatetime);
			}
			break;
		}
		echo "--------After-------";
	}
	
	function updatesynctime($tablename,$emailid,$syncdatetime){
		$this->autoRender=false;		

		$getidArray = $this->SyncMysql->find('all',array('fields' => array('SyncMysql.id'),'conditions'=>array("SyncMysql.emailid"=>$emailid,"SyncMysql.sync_mobile_datetime"=>$syncdatetime)));
		$dbid = "";
		if(!empty($getidArray[0]['SyncMysql']['id'])){
			$dbid = $getidArray[0]['SyncMysql']['id'];
		}
		
		$this->data['SyncMysql']['id'] = $dbid;
		$this->data['SyncMysql'][$tablename] = 1;
		$this->data['SyncMysql']['sync_mobile_datetime'] = $syncdatetime;
		$this->data['SyncMysql']['emailid'] = $emailid;
		
		$this->SyncMysql->save($this->data['SyncMysql']);
	}
	
	function syncsetuptimecare($emailid,$pts,$sl,$syncdatetime){
		$this->autoRender=false;
		
		$success = 0;
		$userid = "";
		$userid = $this->getUserIdFromEmail($emailid);
		$this->data['SetupTimecare']['user_id'] = $userid;
		$this->data['SetupTimecare']['emailid'] = $emailid;
		$this->data['SetupTimecare']['productive_time_slot'] = $pts;
		$this->data['SetupTimecare']['schedule_level'] = $sl;
		$countData = $this->SetupTimecare->find('count',array('conditions'=>array("SetupTimecare.emailid"=>$emailid)));
		//echo $countData;
		$getidArray = array();
		if($countData>0){
			$getidArray = $this->SetupTimecare->find('first',array('fields' => array('SetupTimecare.id'),'conditions'=>array("SetupTimecare.emailid"=>$emailid)));
		}
		//print_r($getidArray);
		if(!empty($getidArray))
			$getid = $getidArray['SetupTimecare']['id'];
		else
			$getid = "";
			
		$this->SetupsTimecare->save(array("id"=>"","user_id"=>$userid,"emailid"=>$emailid,'productive_time_slot'=>$pts,'productive_time_slot'=>$pts,'schedule_level'=>$sl,'created_mobile'=>$syncdatetime));
		
			//print_r(array("id"=>$getid,"user_id"=>$userid,"emailid"=>$emailid,'productive_time_slot'=>$pts,'productive_time_slot'=>$pts,'schedule_level'=>$sl));
			if ($this->SetupTimecare->save(array("id"=>$getid,"user_id"=>$userid,"emailid"=>$emailid,'productive_time_slot'=>$pts,'productive_time_slot'=>$pts,'schedule_level'=>$sl)))
				$success = 1;
			else
				$success = 0;
				
		return $success;	
	}
	
	function syncsetupselfcare($dataArray,$syncdatetime){
		$this->autoRender=false;
		
		$success = 0;		
		if(count($dataArray)>0){
			$getidArray = $this->SetupSelfcare->find('all',array('fields' => array('SetupSelfcare.id'),'conditions'=>array("SetupSelfcare.emailid"=>$dataArray[0]->emailid)));
			//echo count($getidArray);
			foreach($dataArray as $id=>$selfcdata){
				 $dbid = ""; 
			     if(!empty($getidArray[$id]['SetupSelfcare']['id'])){
					$dbid = $getidArray[$id]['SetupSelfcare']['id'];
				 }
				//$this->data['SetupSelfcare'] = array();
				
				$userid = "";
				$userid = $this->getUserIdFromEmail($selfcdata->emailid);
				$this->data['SetupSelfcare']['user_id'] = $userid;				
				
				$this->data['SetupSelfcare']['emailid'] = $selfcdata->emailid;
				$this->data['SetupSelfcare']['avtivity_name'] = $selfcdata->activity_name;
				$this->data['SetupSelfcare']['time_spent'] = $selfcdata->time_spent;
				$this->data['SetupSelfcare']['keywords'] = $selfcdata->keywords;

				$this->data['SetupSelfcare']['id'] = "";
				$this->data['SetupSelfcare']['created_mobile'] = $syncdatetime;
				$this->SetupsSelfcare->save($this->data['SetupSelfcare']);
				
				$this->data['SetupSelfcare']['id'] = $dbid;
				if($this->SetupSelfcare->save($this->data['SetupSelfcare']))
					$success = 1;
				else
					$success = 0;					
					
			}
		}
		
		return $success;
	}
		
	function syncsetupconnectivities($dataArray,$syncdatetime){
		$this->autoRender=false;
		$success = 0;		
		if(count($dataArray)>0){ 
			$getidArray = $this->SetupConnectivity->find('all',array('fields' => array('SetupConnectivity.id'),'conditions'=>array("SetupConnectivity.emailid"=>$dataArray[0]->emailid)));
			foreach($dataArray as $id=>$conndata){
				 $dbid = ""; 
			     if(!empty($getidArray[$id]['SetupConnectivity']['id'])){
					$dbid = $getidArray[$id]['SetupConnectivity']['id'];
				 }
				
				//$this->data['SetupConnectivity'] = array();
				$userid = "";
				$userid = $this->getUserIdFromEmail($conndata->emailid);
				$this->data['SetupConnectivity']['user_id'] = $userid;					
				
				$this->data['SetupConnectivity']['emailid'] = $conndata->emailid;
				$this->data['SetupConnectivity']['touches'] = $conndata->touches;
				$this->data['SetupConnectivity']['contact_name'] = $conndata->contact_name;
				$this->data['SetupConnectivity']['contact_phone'] = $conndata->contact_phone;
				$this->data['SetupConnectivity']['contact_email'] = $conndata->contact_email;
				$this->data['SetupConnectivity']['contact_id'] = $conndata->contactid;
				$this->data['SetupConnectivity']['relationship_strength'] =$conndata->relationship_strength;
				$this->data['SetupConnectivity']['relationship_notes'] =$conndata->relationship_notes;
				$this->data['SetupConnectivity']['photo'] = $conndata->photo;
				//print_r($this->data['SetupConnectivity']);
				
				$this->data['SetupConnectivity']['id'] = "";
				$this->data['SetupConnectivity']['created_mobile'] = $syncdatetime;
				$this->SetupsConnectivity->save($this->data['SetupConnectivity']);
				
				$this->data['SetupConnectivity']['id'] = $dbid;
				$this->SetupConnectivity->save($this->data['SetupConnectivity']);
			}
		}
		
		return 1;
	}	
	
	
	
	function syncsetupcommunication($emailid,$wut,$wsd,$wst,$ltz,$syncdatetime){ 
		$this->autoRender=false;
		
		/*$wsdnum = 1;
		switch($wsd){
			case "Sunday":
				$wsdnum = 1;
			break;
			case "Monday":
				$wsdnum = 2;
			break;
			case "Tuesday":
				$wsdnum = 3;
			break;
			case "Wednesday":
				$wsdnum = 4;
			break;
			case "Thursday":
				$wsdnum = 5;
			break;
			case "Friday":
				$wsdnum = 6;
			break;
			case "Saturday":
				$wsdnum = 7;
			break;
		
		}*/	
		$success = 0;
		$userid = "";
		$userid = $this->getUserIdFromEmail($emailid);
		$this->data['SetupCommunication']['user_id'] = $userid;		
		$this->data['SetupCommunication']['emailid'] = $emailid;
		$this->data['SetupCommunication']['wrap_up_time'] = $wut;
		$this->data['SetupCommunication']['weekly_summary_day'] = $wsd;
		$this->data['SetupCommunication']['weekly_summary_time'] = $wst;
		$this->data['SetupCommunication']['localtimezone'] = $ltz;
		//print_r($this->data['SetupCommunication']); exit;
		$countData = $this->SetupCommunication->find('count',array('conditions'=>array("SetupCommunication.emailid"=>$emailid)));
		//echo $countData; exit;
		$getidArray = array();
		if($countData>0){
			$getidArray = $this->SetupCommunication->find('first',array('fields' => array('SetupCommunication.id'),'conditions'=>array("SetupCommunication.emailid"=>$emailid)));
		}
		//print_r($getidArray); exit;
		if(!empty($getidArray))
			$getid = $getidArray['SetupCommunication']['id'];
		else
			$getid = "";
			
		$this->SetupsCommunication->save(array("id"=>"","user_id"=>$userid,"emailid"=>$emailid,'wrap_up_time'=>$wut,'weekly_summary_day'=>$wsd,'weekly_summary_time'=>$wst,'localtimezone'=>$ltz,'created_mobile'=>$syncdatetime));	
			
			
			if ($this->SetupCommunication->save(array("id"=>$getid,"user_id"=>$userid,"emailid"=>$emailid,'wrap_up_time'=>$wut,'weekly_summary_day'=>$wsd,'weekly_summary_time'=>$wst,'localtimezone'=>$ltz)))
				$success = 1;
			else
				$success = 0;
				
		return $success;	
	}
	
	function syncsetupdailyreflection($dataArray){
		$this->autoRender=false;
		
		$success = 0;
		if(count($dataArray)>0){

			foreach($dataArray as $id=>$drdata){
				$dbid = ""; 
				$getidArray = $this->DailyReflection->find('first',array('fields' => array('DailyReflection.id'),'conditions'=>array("DailyReflection.emailid"=>$drdata->emailid,"DailyReflection.today_date"=>$drdata->today_date,"DailyReflection.today_time"=>$drdata->today_time)));
				$dbid = $getidArray['DailyReflection']['id'];
				//$this->data['DailyReflection'] = array();
				//print_r($getidArray); exit;
				$userid = "";
				$userid = $this->getUserIdFromEmail($drdata->emailid);
				$this->data['DailyReflection']['user_id'] = $userid;				
				$this->data['DailyReflection']['id'] = $dbid;
				$this->data['DailyReflection']['today_mood'] = $drdata->today_mood;
				$this->data['DailyReflection']['tomrr_mood'] = $drdata->tomrr_mood;
				$this->data['DailyReflection']['memorable_thought'] = $drdata->memorable_thought;
				$this->data['DailyReflection']['today_date'] = $drdata->today_date;
				$this->data['DailyReflection']['today_time'] = $drdata->today_time;
				$this->data['DailyReflection']['emailid'] = $drdata->emailid;
				//print_r($this->data['DailyReflection']); exit;
				if($this->DailyReflection->save($this->data['DailyReflection']))
					$success = 1;
				else
					$success = 0;
			}
		}
		
		return $success;
	}	
	
	
	function syncsetupdailyactivities($dataArray){
		$this->autoRender=false;
		
		$success = 0;	
		if(count($dataArray)>0){
			
			foreach($dataArray as $id=>$dadata){
				$dbid = ""; 
				$getidArray = $this->DailyActivity->find('first',array('fields' => array('DailyActivity.id'),'conditions'=>array("DailyActivity.emailid"=>$dadata->emailid,"DailyActivity.today_date"=>$dadata->today_date,"DailyActivity.start_time"=>$dadata->start_time,"DailyActivity.end_time"=>$dadata->end_time)));
				$dbid = $getidArray['DailyActivity']['id'];
				//$this->data['DailyActivity'] = array();
				//print_r($getidArray); exit;
				$userid = "";
				$userid = $this->getUserIdFromEmail($dadata->emailid);
					
				$this->data['DailyActivity']['user_id'] = $userid;				
				$this->data['DailyActivity']['id'] = $dbid;
				$this->data['DailyActivity']['calendarcallogid'] = $dadata->calendarcallogid;
				$this->data['DailyActivity']['activity_name'] = $dadata->activity_name;
				$this->data['DailyActivity']['activity_title'] = $dadata->activity_title;
				$this->data['DailyActivity']['participant'] = $dadata->participant;
				$this->data['DailyActivity']['today_date'] = $dadata->today_date;
				$this->data['DailyActivity']['start_time'] = $dadata->start_time;
				$this->data['DailyActivity']['end_time'] = $dadata->end_time;
				$this->data['DailyActivity']['start_date'] = $dadata->start_date;
				$this->data['DailyActivity']['end_date'] = $dadata->end_date;
				$this->data['DailyActivity']['engagement'] = $dadata->engagement;
				$this->data['DailyActivity']['satishfaction'] = $dadata->satishfaction;
				$this->data['DailyActivity']['notes'] = $dadata->notes;
				$this->data['DailyActivity']['rating'] = $dadata->rating;
				$this->data['DailyActivity']['tagged'] = $dadata->tagged;
				$this->data['DailyActivity']['hours'] = $dadata->hours;
				$this->data['DailyActivity']['category'] = $dadata->category;
				$this->data['DailyActivity']['participantid'] = $dadata->participantid;
				$this->data['DailyActivity']['splitted'] = $dadata->splitted;
				$this->data['DailyActivity']['starteventid'] = $dadata->starteventid;
				$this->data['DailyActivity']['emailid'] = $dadata->emailid;
				$this->data['DailyActivity']['deleted'] = $dadata->deleted;
				//print_r($this->data['DailyActivity']); exit;
				if($this->DailyActivity->save($this->data['DailyActivity']))
					$success = 1;
				else
					$success = 0;
			}
		}
		
		return $success;
	}	
	
	function synccontactuses($dataArray){
		$this->autoRender=false;
		
		$success = 0;
		
		if(count($dataArray)>0){
			foreach($dataArray as $id=>$dadata){
				$dbid = ""; 
				$userid = "";
				$userid = $this->getUserIdFromEmail($dadata->emailid);
				$username = $this->getUserColumnById($userid,"name");
				$getidCount = $this->Contactus->find('count',array('conditions'=>array("Contactus.sender_email"=>$dadata->emailid,"Contactus.created_ondevice"=>$dadata->created)));
				if($getidCount==0){				
					$this->data['Contactus']['to_user_id'] = "1";	
					$this->data['Contactus']['sender_name'] = $username;
					$this->data['Contactus']['sender_email'] = $dadata->emailid;
					$this->data['Contactus']['subject'] = "Feedback";
					$this->data['Contactus']['query'] = $dadata->message;
					$this->data['Contactus']['created_ondevice'] = $dadata->created;
				}				

				if($this->Contactus->save($this->data['Contactus']))
					$success = 1;
				else
					$success = 0;
			}
		return $success;	
		}		
	}

	function trim_value(&$value) 
	{ 
		$value = trim($value); 
	}	
		
	function syncsetupbio($dataArray){
		$this->autoRender=false;
		
		$success = 0;
		if(count($dataArray)>0){

			foreach($dataArray as $id=>$dadata){
				$userid = "";
				$userid = $this->getUserIdFromEmail($dadata->emailid);
				
				$this->data['User']['id'] = $userid;
				$this->data['User']['name'] = $dadata->name;
				$this->data['User']['last_name'] = $dadata->last_name;
				
				$getidArray = $this->UserBio->find('first',array('fields' => array('UserBio.id'),'conditions'=>array("UserBio.user_id"=>$userid)));
				$dbid = $getidArray['UserBio']['id'];
				
				/*if($dadata->dob!=""){
					$dobArray = explode("-",$dadata->dob);
				}
				array_walk($dobArray,array($this, "trim_value"));
				//$dobStr = trim($dobArray[2]."-".$dobArray[1]."-".$dobArray[0]);*/
				
				$this->data['UserBio']['id'] = $dbid;
				$this->data['UserBio']['user_id'] = $userid;			
				$this->data['UserBio']['gender'] = $dadata->gender;
				$this->data['UserBio']['dob'] = $dadata->dob;
				$this->data['UserBio']['city'] = $dadata->city;
				$this->data['UserBio']['state'] = $dadata->state;
				$this->data['UserBio']['country'] = $dadata->country;
				$this->data['UserBio']['zip'] = $dadata->zip;
				$this->data['UserBio']['relationship_status'] = $dadata->relationship_status;
				$this->data['UserBio']['household_income'] = $dadata->household_income;
				$this->data['UserBio']['education_highest'] = $dadata->education_highest;
				$this->data['UserBio']['employment_status'] = $dadata->employment_status;
				$this->data['UserBio']['employment_industry'] = $dadata->employment_industry;
				$this->data['UserBio']['work_type'] = $dadata->work_type;
				$this->data['UserBio']['religion_view'] = $dadata->religion_view;
				$this->data['UserBio']['religious_activity'] = $dadata->religious_activity;
				$this->data['UserBio']['political_view'] = $dadata->political_view;
				$this->data['UserBio']['weight_current'] = $dadata->weight_current;
				$this->data['UserBio']['height_current'] = $dadata->height_current;
				$this->data['UserBio']['living_arrangement'] = $dadata->living_arrangement;
				$this->data['UserBio']['emailid'] = $dadata->emailid;
				//print_r($this->data['UserBio']); //print_r($this->data['User']);
				$this->User->save($this->data['User']);
				if($this->UserBio->save($this->data['UserBio']))
					$success = 1;
				else
					$success = 0;
			}
		}
		
		return $success;
	}	


	function getsyncedselfcare(){
	    $this->autoRender=false;
		$useremail = $_REQUEST['email'];
		$synceddata = $this->SetupSelfcare->find('all', array('conditions'=>array('SetupSelfcare.emailid' => $useremail)));	
		if(!empty($synceddata)){
			$returnArray = array(
								 "Data" =>  array(
												   'success'=>1,
												   'synceddata'=>$synceddata
												  )
								);
			echo json_encode($returnArray);			
		}else{
			echo "";
		}
	}
	
	function getsyncedtimecare(){
	    $this->autoRender=false;
		$useremail = $_REQUEST['email'];
		$synceddata = $this->SetupTimecare->find('all', array('conditions'=>array('SetupTimecare.emailid' => $useremail)));		
		if(!empty($synceddata)){
			$returnArray = array(
								 "Data" =>  array(
												   'success'=>1,
												   'synceddata'=>$synceddata
												  )
								);
			echo json_encode($returnArray);			
		}else{
			echo "";
		}
	}

	function getsyncedcomm(){
	    $this->autoRender=false;
		$useremail = $_REQUEST['email'];
		$synceddata = $this->SetupCommunication->find('all', array('conditions'=>array('SetupCommunication.emailid' => $useremail)));		
		if(!empty($synceddata)){
			$returnArray = array(
								 "Data" =>  array(
												   'success'=>1,
												   'synceddata'=>$synceddata
												  )
								);
			echo json_encode($returnArray);			
		}else{
			echo "";
		}
	}

	function getsyncedconn(){
	    $this->autoRender=false;
		$useremail = $_REQUEST['email'];
		$synceddata = $this->SetupConnectivity->find('all', array('conditions'=>array('SetupConnectivity.emailid' => $useremail)));		
		if(!empty($synceddata)){
			$returnArray = array(
								 "Data" =>  array(
												   'success'=>1,
												   'synceddata'=>$synceddata
												  )
								);
			echo json_encode($returnArray);			
		}else{
			echo "";
		}
	}

	function getsynceddailyreflection(){
	    $this->autoRender=false;
		$useremail = $_REQUEST['email'];
		$synceddata = array();
		$today_date_formatted = strtotime(date("Y-m-d"));
		for($i=0;$i<7;$i++){		
			$sdate = date("Y-m-d",$today_date_formatted); //echo "<br>"; 
			$cond = "DailyReflection.emailid = '$useremail' AND DailyReflection.today_date ='".$sdate."'";
			$synceddatatemp = $this->DailyReflection->find('all', array('conditions'=>$cond));		
			$synceddata = array_merge($synceddata,$synceddatatemp);
			$today_date_formatted = $today_date_formatted - 86400; 
		}
		
		/*$lastsevenddate = $this->DailyReflection->find('all', array('fields'=>array('DISTINCT DailyReflection.today_date'),'conditions'=>array('DailyReflection.emailid' => $useremail),'order'=>array('DailyReflection.today_date DESC'),'limit'=>7));
		foreach($lastsevenddate as $sdate){
			$cond = "DailyReflection.emailid = '$useremail' AND DailyReflection.today_date ='".$sdate['DailyReflection']['today_date']."'";
			$synceddatatemp = $this->DailyReflection->find('all', array('conditions'=>$cond));		
			$synceddata = array_merge($synceddata,$synceddatatemp);
		}*/

		if(!empty($synceddata)){
			$returnArray = array(
								 "Data" =>  array(
												   'success'=>1,
												   'synceddata'=>$synceddata
												  )
								);
			echo json_encode($returnArray);			
		}else{
			echo "";
		}
	}

	function getsynceddailyactivities(){
	    $this->autoRender=false;
		$useremail = $_REQUEST['email']; 
		$synceddata = array();
		$today_date_formatted = strtotime(date("Y-m-d"));
		for($i=0;$i<7;$i++){		
			$sdate = date("Y-m-d",$today_date_formatted); //echo "<br>"; 
			$cond = "DailyActivity.emailid = '$useremail' AND DailyActivity.today_date ='".$sdate."'";
			$synceddatatemp = $this->DailyActivity->find('all', array('conditions'=>$cond));		
			$synceddata = array_merge($synceddata,$synceddatatemp);
			$today_date_formatted = $today_date_formatted - 86400; 
		}
		//$lastsevenddate = $this->DailyActivity->find('all', array('fields'=>array('DISTINCT DailyActivity.today_date'),'conditions'=>array('DailyActivity.emailid' => $useremail),'order'=>array('DailyActivity.today_date DESC'),'limit'=>7));
		//foreach($lastsevenddate as $sdate){ echo $sdate['DailyActivity']['today_date']; echo "<br>";
			
		//}
		if(!empty($synceddata)){
			$returnArray = array(
								 "Data" =>  array(
												   'success'=>1,
												   'synceddata'=>$synceddata
												  )
								);
			echo json_encode($returnArray);			
		}else{
			echo "";
		}
	}	
	
	function registerdevice(){
		$this->autoRender=false;
		$success = 0;
		$deviceid = $_REQUEST['regid'];
		$useremail = $_REQUEST['email'];
		$userid = $this->getUserIdFromEmail($useremail);
		$this->data['Gcmdevice']['deviceid'] = $deviceid;
		$this->data['Gcmdevice']['user_id'] = $userid;
		$this->data['Gcmdevice']['emailid'] = $useremail;
		
		//print_r($this->data['Gcmdevice']); exit;
		$cond = "Gcmdevice.deviceid = '$deviceid' AND Gcmdevice.emailid = '$useremail'";
		$countData = $this->Gcmdevice->find('count',array('conditions'=>$cond));
		//echo $countData;
		if($countData==0){
			if($this->Gcmdevice->save($this->data['Gcmdevice']))
				$success = 1;
		}else{
			$success = 1;
		}
				
		return $success;
	}

	function sendnotifications($regidArray){ 
		$this->autoRender=false;
		// Replace with real server API key from Google APIs  
        $apiKey = "AIzaSyAlV0HyBypMdDzL8y7Y-i-QZ17YGp-ZSgg";
		
		/*$regidArray = array();
		$regidArray = $this->Gcmdevice->find('all',array('conditions'=>array("Gcmdevice.emailid"=>"notifications@vimbli.com"))); //print_r($regidArray); exit;
		$registrationIDs = array();
		$i=0;
		foreach($regidArray as $regids){ 
			$registrationIDs[$i] = $regids['Gcmdevice']['deviceid'];
			$i++;
		}
		$registrationIDs = array( "APA91bFEFPEuqBvolcGDNLTR4SFfe-1spt002Zad3KZINQ16bP-T4tOwaC1XM14ys-Lic9dtKMDt9xN8xD-O-x7SxclWMAd5UDmhIqLoUuIgPlGr5urGzwPBvIHTEu2Cb7bwtHzBOXUB74Jig20B0w0CBsGLxL1jtg");*/
		
		$registrationIDs = $regidArray;
		// Message to be sent
        $message = "Hi!! It's time for Daily Reflection";
		
		// Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';
		
		$fields = array(
           'registration_ids' => $registrationIDs,
           'data' => array( "message" => $message ),
            );
        $headers = array(
          'Authorization: key=' . $apiKey,
          'Content-Type: application/json'
          );

        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_POST, true );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		
        //curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields ));

        // Execute post
        $result = curl_exec($ch);

        // Close connection
        curl_close($ch);
        echo $result;
        //print_r($result);
        //var_dump($result);
	}
	
	function timezone_diff($tz_from, $tz_to, $time_str = 'now')
	{
		$this->autoRendar = false;
		$dt = new DateTime($time_str, new DateTimeZone($tz_from));
		$offset_from = $dt->getOffset();
		$timestamp = $dt->getTimestamp();
		$offset_to = $dt->setTimezone(new DateTimezone($tz_to))->setTimestamp($timestamp)->getOffset();
		return $offset_to - $offset_from;
	}

	function time_translate($tz_from, $tz_to, $time_str = 'now', $format = 'Y-m-d H:i:s')
	{
		$this->autoRendar = false;
		$dt = new DateTime($time_str, new DateTimezone($tz_from));
		$timestamp = $dt->getTimestamp();
		return $dt->setTimezone(new DateTimezone($tz_to))->setTimestamp($timestamp)->format($format);
	}	
	
	function getconvertedtime($scheduledatetime,$localtz="+5.50",$datetimeformat="Y-m-d H:i:s",$find){
		$this->autoRender=false;

		$tz = substr($localtz, 1);
		/*$tz_arr = explode(":", $tz);
		$tz_sec = ($tz_arr[0]*60*60)+($tz_arr[1]*60);*/
		$tz_sec = ($tz*60*60);

		$sign = substr($localtz, 0,1);
		$starttime = $scheduledatetime;//"2012-08-24 21:30";
		$starttimeintosec = strtotime($starttime);
		if($find=="gmt"){
			if($sign=="+"){
				$sign="-";
			}else if($sign=="-"){
				$sign="+";
			}
		}
		switch($sign){
			case "+":
				$endtimeintosec = $starttimeintosec + $tz_sec;
			break;
			case "-":
				$endtimeintosec = $starttimeintosec - $tz_sec;
			break;
		}

		echo "<br>";
		return date($datetimeformat,$endtimeintosec);

	}
	function cronschdeuledtime(){
		$this->autoRender=false;
		/*echo "2012-08-24 21:30"; echo "<br>";
		echo $gmttime = $this->getconvertedtime("2012-08-24 21:30","+5.50","Y-m-d H:i","gmt");
		echo "<br>";
		echo $this->getconvertedtime($gmttime,"-5.00","Y-m-d H:i","local");*/
		
			
		$getdeviceregids = $this->SetupCommunication->find('all', array(
					'fields' => array('SetupCommunication.*','Gcmdevice.*'),
					'joins' => array(
						array(
							'table' => 'gcmdevices',
							'alias' => 'Gcmdevice',
							'type' => 'LEFT',
							'conditions' => array(
							 'SetupCommunication.emailid=Gcmdevice.emailid',
							)
						)
					),
					'order' => 'SetupCommunication.wrap_up_time'
				)); //pr($getdeviceregids); exit;
		
		
		foreach($getdeviceregids as $getdeviceregidArray){
			if(!empty($getdeviceregidArray['Gcmdevice']['deviceid'])){
				
				##START# Schedule WEEKLY Notification #############
				$this->data = array();
				$today_day = date("l");
				$scheduled_weeklyday = $getdeviceregidArray['SetupCommunication']['weekly_summary_day'];
				if($today_day == $scheduled_weeklyday){
					echo "Today is: ".$scheduled_weeklyday." - Time for weekly journal:: ".$getdeviceregidArray['SetupCommunication']['emailid'];
					$sendtime_weekly = date("Y-m-d")." ".$getdeviceregidArray['SetupCommunication']['weekly_summary_time'];
					$gmttime_weekly = $this->getconvertedtime($sendtime_weekly,$getdeviceregidArray['SetupCommunication']['localtimezone'],"Y-m-d H:i:s","gmt"); echo "<br>";
					$TimeZoneOffset = date("Z")/3600;
					if($TimeZoneOffset>0)
						$TimeZoneOffset = "+".$TimeZoneOffset;			
					$localtime_weekly = $this->getconvertedtime($gmttime_weekly,$TimeZoneOffset,"Y-m-d H:i:s","local");
					$cond_weekly = "GcmNotification.deviceregid = '".$getdeviceregidArray['Gcmdevice']['deviceid']."' AND GcmNotification.emailid = '".$getdeviceregidArray['Gcmdevice']['emailid']."' AND GcmNotification.sendtime = '$localtime' AND GcmNotification.type = 'weekly'";
					echo $countData_weekly = $this->GcmNotification->find('count',array('conditions'=>$cond_weekly)); 
					
					if($countData_weekly==0){
						$this->data['GcmNotification']['id'] = "";
						echo $this->data['GcmNotification']['deviceregid'] = $getdeviceregidArray['Gcmdevice']['deviceid'];
						$this->data['GcmNotification']['emailid'] = $getdeviceregidArray['SetupCommunication']['emailid'];
						$this->data['GcmNotification']['sendtime'] = $localtime_weekly;
						$this->data['GcmNotification']['type'] = 'weekly';
						echo "<br>";
						pr($this->data);
						$this->GcmNotification->save($this->data['GcmNotification']);	
					}
				}
				//pr($getdeviceregidArray); exit;
				//exit;
				##END# Schedule WEEKLY Notification #############
				
				##START# Schedule DAILY Notification #############
				$this->data['GcmNotification'] = array(); echo "Emptied data"; //pr($this->data); //exit;
				$sendtime = date("Y-m-d")." ".$getdeviceregidArray['SetupCommunication']['wrap_up_time'];
				$gmttime = $this->getconvertedtime($sendtime,$getdeviceregidArray['SetupCommunication']['localtimezone'],"Y-m-d H:i:s","gmt"); echo "<br>";
				$TimeZoneOffset = date("Z")/3600;
				if($TimeZoneOffset>0)
					$TimeZoneOffset = "+".$TimeZoneOffset;			
				$localtime = $this->getconvertedtime($gmttime,$TimeZoneOffset,"Y-m-d H:i:s","local");
				
				$cond = "GcmNotification.deviceregid = '".$getdeviceregidArray['Gcmdevice']['deviceid']."' AND GcmNotification.emailid = '".$getdeviceregidArray['Gcmdevice']['emailid']."' AND GcmNotification.sendtime = '$localtime' AND GcmNotification.type = 'daily'";
				$countData = $this->GcmNotification->find('count',array('conditions'=>$cond)); 
				
				if($countData==0){
					$this->data['GcmNotification']['id'] = "";
					echo $this->data['GcmNotification']['deviceregid'] = $getdeviceregidArray['Gcmdevice']['deviceid'];
					$this->data['GcmNotification']['emailid'] = $getdeviceregidArray['SetupCommunication']['emailid'];
					$this->data['GcmNotification']['sendtime'] = $localtime;
					$this->data['GcmNotification']['type'] = 'daily';
					echo "<br>";
					$this->GcmNotification->save($this->data['GcmNotification']);				
				}
				##END# Schedule DAILY Notification #############	
			}
		}
	}
	
	function cronsendpushnotification(){
		$this->autoRender=false;
		
		$cond = "GcmNotification.sendtime <= NOW() AND ISNULL(GcmNotification.pickuptime) AND ISNULL(GcmNotification.senttime)";
		$sendtoregids = $this->GcmNotification->find('all',array('conditions'=>$cond,'order'=>'GcmNotification.sendtime ASC')); //print_r($sendtoregids); exit;
		$regidArray = array();
		$i = 0;
		if(!empty($sendtoregids)){
			foreach($sendtoregids as $sendtoregidArray){		
				$this->data['GcmNotification']['id'] = $sendtoregidArray['GcmNotification']['id'];
				$this->data['GcmNotification']['pickuptime'] = date("Y-m-d H:i:s"); //pr($this->data['GcmNotification']); exit;
				if($this->GcmNotification->save($this->data['GcmNotification'])){
					$this->GcmNotification->save(array("id"=>$sendtoregidArray['GcmNotification']['id'],"senttime"=>date("Y-m-d H:i:s")));
				}
			
				$regidArray[$i] = $sendtoregidArray['GcmNotification']['deviceregid'];
				$i++;
			}		
		}
		//pr($regidArray);
		$this->sendnotifications($regidArray);
	}
	
	function sss(){
		$this->autoRender=false;
		
		$cond = "GcmNotification.sendtime >= NOW() AND ISNULL(GcmNotification.pickuptime) AND ISNULL(GcmNotification.senttime)";
		$sendtoregids = $this->GcmNotification->find('all',array('conditions'=>$cond,'order'=>'GcmNotification.sendtime ASC')); //pr($sendtoregids); exit;
		$regidArray = array();
		$i = 0;
		if(!empty($sendtoregids)){
			foreach($sendtoregids as $sendtoregidArray){	

			if($sendtoregidArray['GcmNotification']['emailid']=='notifications@vimbli.com'){
				$this->data['GcmNotification']['id'] = $sendtoregidArray['GcmNotification']['id'];
				$this->data['GcmNotification']['pickuptime'] = date("Y-m-d H:i:s"); //pr($this->data['GcmNotification']); exit;
				//$this->GcmNotification->save($this->data['GcmNotification']);	
			
				$regidArray[$i] = $sendtoregidArray['GcmNotification']['deviceregid'];
				$i++;			
			}

			}		
		}
		pr($regidArray);
		$this->sendnotifications($regidArray);
	}	
	
	function ccc(){
		$this->autoRender=false;
		/*echo "2012-08-24 21:30"; echo "<br>";
		echo $gmttime = $this->getconvertedtime("2012-08-24 21:30","+5.50","Y-m-d H:i","gmt");
		echo "<br>";
		echo $this->getconvertedtime($gmttime,"-5.00","Y-m-d H:i","local");*/
		
			
		$getdeviceregids = $this->SetupCommunication->find('all', array(
					'fields' => array('SetupCommunication.*','Gcmdevice.*'),
					'joins' => array(
						array(
							'table' => 'gcmdevices',
							'alias' => 'Gcmdevice',
							'type' => 'LEFT',
							'conditions' => array(
							 'SetupCommunication.emailid=Gcmdevice.emailid',
							)
						)
					),
					'order' => 'SetupCommunication.wrap_up_time'
				)); //pr($getdeviceregids); exit;
		
		
		foreach($getdeviceregids as $getdeviceregidArray){
			if(!empty($getdeviceregidArray['Gcmdevice']['deviceid'])){
				
				##START# Schedule WEEKLY Notification #############
				$this->data = array();
				$today_day = date("l");
				$scheduled_weeklyday = $getdeviceregidArray['SetupCommunication']['weekly_summary_day'];
				if($today_day == $scheduled_weeklyday){
					echo "Today is: ".$scheduled_weeklyday." - Time for weekly journal:: ".$getdeviceregidArray['SetupCommunication']['emailid'];
					$sendtime_weekly = date("Y-m-d")." ".$getdeviceregidArray['SetupCommunication']['weekly_summary_time'];
					$gmttime_weekly = $this->getconvertedtime($sendtime_weekly,$getdeviceregidArray['SetupCommunication']['localtimezone'],"Y-m-d H:i:s","gmt"); echo "<br>";
					$TimeZoneOffset = date("Z")/3600;
					if($TimeZoneOffset>0)
						$TimeZoneOffset = "+".$TimeZoneOffset;			
					$localtime_weekly = $this->getconvertedtime($gmttime_weekly,$TimeZoneOffset,"Y-m-d H:i:s","local");
					$cond_weekly = "GcmNotification.deviceregid = '".$getdeviceregidArray['Gcmdevice']['deviceid']."' AND GcmNotification.emailid = '".$getdeviceregidArray['Gcmdevice']['emailid']."' AND GcmNotification.sendtime = '$localtime' AND GcmNotification.type = 'weekly'";
					echo $countData_weekly = $this->GcmNotification->find('count',array('conditions'=>$cond_weekly)); 
					
					if($countData_weekly==0){
						$this->data['GcmNotification']['id'] = "";
						echo $this->data['GcmNotification']['deviceregid'] = $getdeviceregidArray['Gcmdevice']['deviceid'];
						$this->data['GcmNotification']['emailid'] = $getdeviceregidArray['SetupCommunication']['emailid'];
						$this->data['GcmNotification']['sendtime'] = $localtime_weekly;
						$this->data['GcmNotification']['type'] = 'weekly';
						echo "<br>";
						pr($this->data);
						$this->GcmNotification->save($this->data['GcmNotification']);				
					}
				}
				//pr($getdeviceregidArray); exit;
				//exit;
				##END# Schedule WEEKLY Notification #############
				
				##START# Schedule DAILY Notification #############
				$this->data = array(); echo "Emptied data"; pr($this->data); //exit;
				$sendtime = date("Y-m-d")." ".$getdeviceregidArray['SetupCommunication']['wrap_up_time'];
				$gmttime = $this->getconvertedtime($sendtime,$getdeviceregidArray['SetupCommunication']['localtimezone'],"Y-m-d H:i:s","gmt"); echo "<br>";
				$TimeZoneOffset = date("Z")/3600;
				if($TimeZoneOffset>0)
					$TimeZoneOffset = "+".$TimeZoneOffset;			
				$localtime = $this->getconvertedtime($gmttime,$TimeZoneOffset,"Y-m-d H:i:s","local");
				
				$cond = "GcmNotification.deviceregid = '".$getdeviceregidArray['Gcmdevice']['deviceid']."' AND GcmNotification.emailid = '".$getdeviceregidArray['Gcmdevice']['emailid']."' AND GcmNotification.sendtime = '$localtime' AND GcmNotification.type = 'daily'";
				$countData = $this->GcmNotification->find('count',array('conditions'=>$cond)); 
				
				if($countData==0){
					$this->data['GcmNotification']['id'] = "";
					echo $this->data['GcmNotification']['deviceregid'] = $getdeviceregidArray['Gcmdevice']['deviceid'];
					$this->data['GcmNotification']['emailid'] = $getdeviceregidArray['SetupCommunication']['emailid'];
					$this->data['GcmNotification']['sendtime'] = $localtime;
					$this->data['GcmNotification']['type'] = 'daily';
					echo "<br>";
					$this->GcmNotification->save($this->data['GcmNotification']);				
				}
				##END# Schedule DAILY Notification #############	
			}
		}
	}	
	
}	
?>