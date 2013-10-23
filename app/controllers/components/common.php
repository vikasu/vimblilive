<?php 
class CommonComponent extends Object
{
    var $components = array('Session','Email');
    
    
    
    // get EmailTemplate List
    // get a list of templates on the basis of Id
    function getEmailTemplate($id = null) {
            if( empty($id) || is_null($id) ){
                    return false;
            }
            App::import('Model','EmailTemplate');
            $this->EmailTemplate = & new EmailTemplate();
            $template = $this->EmailTemplate->find('first',array(
                    'conditions'=>array("EmailTemplate.id" => $id)));
            return $template;
    }
    
    // User can activate only 150 connections in V1
    function connectionCount($id = null) {
            
            App::import('Model','Connection');
            $this->Connection = & new Connection();
            $activated = $this->Connection->find('count',array(
                    'conditions'=>array("Connection.user_id" => $id,"Connection.status" => 1)));
            return $activated;
    }
    
    //Count activity in TL
    function count_tl_act($user_id, $time_span) {
	/*** Initialization of vars :: Start ***/
	    $totalActivities = 0;
	    $start = "";
	    $end = "";
	    $todayDate = date('Y-m-d');
	/*** Initialization of vars :: End ***/
	
	$dateOneDayBack = date('Y-m-d',strtotime(date("Y-m-d", strtotime($todayDate)) . "-1 day"));
	
	if($time_span == 'daily'){
	    $start = $dateOneDayBack.' 00:00:00';
	    $end = $dateOneDayBack.' 23:59:59';
	} elseif($time_span == 'weekly') {
	    $todayDate = date('Y-m-d',strtotime ( '-1 day' , strtotime($todayDate)));
	    $dateOneWeekBack = date('Y-m-d',strtotime ( '-7 day' , strtotime($todayDate)));
	    $todayDate;
	    $start = $dateOneWeekBack.' 00:00:00';
	    $end = $dateOneDayBack.' 23:59:59';
	} elseif($time_span == 'monthly') { 
	    $todayDate = date('Y-m-d',strtotime ('-1 day' , strtotime($todayDate)));
	    $todayDate = $todayDate.' 23:59:59';
	    $dateOneMonthBack = date('Y',strtotime($todayDate)).'-'.date('m',strtotime($todayDate)).'-01 00:00:00';
	    
	    $end = $todayDate;
	    $start = $dateOneMonthBack;
	}
	
	//Find count in mission
	App::import('Model','Mission');
        $this->Mission = & new Mission();
	$missionCount =  $this->Mission->find('count',array('conditions'=>array('Mission.owner'=>$user_id,'Mission.start_time BETWEEN ? AND ?'=>array($start,$end))));
	
	
	//Find count in Activities
	App::import('Model','Activity');
        $this->Activity = & new Activity();
	$activityCount =  $this->Activity->find('count',array('conditions'=>array('Activity.activity_owner'=>$user_id,'Activity.start_date BETWEEN ? AND ?'=>array($start,$end))));
	
	//Find count in Reflection
	App::import('Model','UserReflection');
        $this->UserReflection = & new UserReflection();
	$refCount =  $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$user_id,'UserReflection.reflection_date BETWEEN ? AND ?'=>array($start,$end))));
	
	//Find count in CalendarEvent
	App::import('Model','CalendarEvent');
        $this->CalendarEvent = & new CalendarEvent();
	$calEventCount =  $this->CalendarEvent->find('count',array('conditions'=>array('CalendarEvent.user_id'=>$user_id,'CalendarEvent.start_time BETWEEN ? AND ?'=>array($start,$end))));
	
	
	//Find count in Emails
	//Importing this model with a different way as it is creating problem in usual way
	$this->ImportEmail = ClassRegistry::init('ImportEmail');
	$emailCount =  $this->ImportEmail->find('count',array('conditions'=>array('ImportEmail.user_id'=>$user_id,'ImportEmail.email_date BETWEEN ? AND ?'=>array($start,$end))));
	
	return $totalActivities = $missionCount+$activityCount+$refCount+$calEventCount+$emailCount;
	
    }
    
    
    
    // Find user's time 
    function userTime($timezoneId = null,$dateToconvert = null) {
      
	App::import('Model','Timezone');
	App::import('Model','User');
	$this->Timezone = & new Timezone();
	$this->User = & new User();
        //pr($_SESSION['Auth']['User']['dst']); die;
	$userTimezoneInfo = $this->Timezone->find('first',array('conditions'=>array("Timezone.id" => $timezoneId)));
	$userInfo = $this->User->find('first',array('conditions'=>array("User.id" => $_SESSION['Auth']['User']['id']),'fields'=>array('User.dst')));
	//pr($userInfo['User']['dst']); die;
	if($userInfo['User']['dst']==1){
	     $userLocalTime = date("Y-m-d H:i:s", strtotime($dateToconvert)+$userTimezoneInfo['Timezone']['difference_in_seconds']+3600);
	}else{
	    $userLocalTime = date("Y-m-d H:i:s", strtotime($dateToconvert)+$userTimezoneInfo['Timezone']['difference_in_seconds']);
	}
	
	//$serverTime = date("Y-m-d H:i:s");
	//pr($userLocalTime); die;
	
	return $userLocalTime;
    }
    
    // Find server time from user's time 
    function serverTime($timezoneId = null,$dateToconvert = null) {
      
	App::import('Model','Timezone');
	$this->Timezone = & new Timezone();
        $this->User = & new User();
	$userTimezoneInfo = $this->Timezone->find('first',array('conditions'=>array("Timezone.id" => $timezoneId)));
	
	//$serverTime = date("Y-m-d H:i:s");
	$userInfo = $this->User->find('first',array('conditions'=>array("User.id" => $_SESSION['Auth']['User']['id']),'fields'=>array('User.dst')));
	//pr($userInfo); die;
	if($userInfo['User']['info']==1){
	     $serverTime = date("Y-m-d H:i:s", strtotime($dateToconvert)-$userTimezoneInfo['Timezone']['difference_in_seconds']+3600);
	}else{
	    $serverTime = date("Y-m-d H:i:s", strtotime($dateToconvert)-$userTimezoneInfo['Timezone']['difference_in_seconds']);
	}
	
	
	return $serverTime;
    }
    

}
?>