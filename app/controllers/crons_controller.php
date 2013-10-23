<?php
/*
* HomesController class
* PHP versions 5.2.12
* @filesource
* @author	Vikas Uniyal 
* @date		Mar. 19, 2013
* @link       http://www.smartdatainc.net/
* @version 1.0.0 
* - Initial release
*/
App::import('Sanitize');
class CronsController extends AppController
{
    var $name = 'Crons';
    var $components = array('Email','Common');
    var $uses = array('EmailTemplate','User','Communication','Mission');
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('send_daily_reminders','send_test_reminders','send_weekly_reminders','send_monthly_reminders','testCron');
	
	
    }
    
    function testCron(){ //echo date("Y-m-d H:i:s"); die;
	if(mail("smaartdatatest@gmail.com","Cron Successful","Cron run successfully.")){
	    echo "Mail Sent";
	} else{
	    echo "Mail Not Sent";
	}
	exit;
    }
    
    
    
    /*
	Function Name: send_daily_reminders
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Mar. 19, 2013
	Description : Daily reminders for users
    */
    function send_daily_reminders() {
	define('VIMBLI_LIVE_LINK','www.vimbli.com/');
	$this->layout = false;
	$this->autoRender = false;
	$period = 'daily';
	
	$userIds = $this->Communication->find('all',array('conditions'=>array('Communication.daily_reminder'=>1),'fields'=>array('Communication.id,Communication.user_id,Communication.daily_reminder','User.id','User.name','User.email')));
	//pr($userIds); die;
	
	foreach($userIds as $row){
	    $missionInfo= $this->Mission->find('first',array('recursive'=>2,'conditions'=>array('Mission.owner'=>$row['User']['id']), 'order'=>'Mission.id DESC'));
	    $crTime = date('Y-m-d H:i:s');
	    
	    if(!empty($missionInfo)){ //If user have a mission
		$missionDuration = floor((strtotime($missionInfo['Mission']['end_time']) - strtotime($missionInfo['Mission']['start_time']))/86400);
		if($missionInfo['Mission']['end_time'] < $crTime){ //Mission expired
		    $elapsedDays = $missionDuration;
		    $templateId = 12;
		} else { //Mission active
		    $elapsedDays = floor((strtotime($crTime) - strtotime($missionInfo['Mission']['start_time']))/86400);
		    $templateId = 11;
		}
	    }else{ //If user do not have a mission
		$templateId = 13;
	    }
	    
	    //Total activity of timeline in last day
	    $totalActInTl = $this->Common->count_tl_act($row['User']['id'],$period);
	    
	    //Avg of activities related to mission in
	    //$avgActRelatedToMission = $this->Common->count_avg_act($row['User']['id'],$period,$totalActInTl);
	    
	    /***** Send Email to User :: Start *****/
	    $this->Email->smtpOptions = array(
		    'port'=>SMTP_PORT,
		    'timeout '=> SMTP_TIME_OUT,
		    'host' => SMTP_HOST,
		    'username'=>SMTP_USER_NAME,
		    'password'=>SMTP_PASSOWRD 
	    );
	    $this->Email->sendAs= 'html';
	    
	    /******import emailTemplate Model and get template****/
	    //Fetch content of 'DAILY_REMINDER'
	    $template = $this->Common->getEmailTemplate($templateId);
	    
	    $this->Email->from = INFO_EMAIL;
	    $this->Email->subject = str_replace('{PERIOD}','Daily',$template['EmailTemplate']['subject']);
	    $data=$template['EmailTemplate']['description'];
	    $data=str_replace('{NAME}',$row['User']['name'],$data);
	    $data=str_replace('{MISSION_NAME}',$missionInfo['Mission']['title'],$data);
	    $data=str_replace('{ELAPSED_DAYS}',$elapsedDays,$data);
	    $data=str_replace('{TOTAL_DAYS}',$missionDuration,$data);
	    $data=str_replace('{TL_ITEM_IN_PERIOD}',$totalActInTl,$data);
	    
	    $reflection_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'reflections/add_reflection/>Reflect</a>';
	    $data=str_replace('{REFLECTION_LINK}',$reflection_link,$data);
	    $tl_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'timelines/index/'.base64_encode($row["User"]["id"]).'>timeline</a>';
	    $data=str_replace('{TL_LINK}',$tl_link,$data);
	    $shared_mission_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'missions/shared_mission/>shared mission</a>';
	    $data=str_replace('{SHARED_MISSION_LINK}',$shared_mission_link,$data);
	    $add_mission_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'missions/current_mission_setup/>own mission</a>';
	    $data=str_replace('{ADD_MISSION_LINK}',$add_mission_link,$data);
	    $recent_mission_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'users/welcome/>recent mission</a>';
	    $data=str_replace('{RECENT_MISSION_LINK}',$recent_mission_link,$data);
	    
	    
	    $this->set('data',$data);
	    $this->Email->to = $row['User']['email'];
	    //$this->Email->to = "rakesh.pant@gmail.com";
	    //$this->Email->to = "smaartdatatest@gmail.com";
	    $this->Email->template='commanEmailTemplate';
	    //echo 'AAA<pre>'; print_r($this->Email);
	   
	    $this->Email->send();
	    //exit;
	    /***** Send Email to User :: End *****/
	    //pr($this->Email->htmlMessage);
	}
	
	exit;
    }
    
    
    
    /*
	Function Name: send_weekly_reminders
	params: NULL
	Created BY:Sunny Chauhan
	Created ON : June. 10, 2013
	Description : Weekly reminders for users
    */
    function send_weekly_reminders() {
	define('VIMBLI_LIVE_LINK','www.vimbli.com/');
	$this->layout = false;
	$this->autoRender = false;
	$period = 'weekly'; //change it to weekly once recognize by client
	$weekDay = strtolower(date('N'));
	$userIds = $this->Communication->find('all',array('conditions'=>array('Communication.weekly_reminder'=>1,'Communication.weekly_day'=>$weekDay),'fields'=>array('Communication.id,Communication.user_id,Communication.weekly_reminder','User.id','User.name','User.email')));
	//echo '<pre>'; print_r($userIds); die;
	foreach($userIds as $row){
	    $missionInfo= $this->Mission->find('first',array('recursive'=>2,'conditions'=>array('Mission.owner'=>$row['User']['id']), 'order'=>'Mission.id DESC'));
	    $crTime = date('Y-m-d H:i:s');
	    $crTime1 = strtotime ( '-1 day' , strtotime($crTime));
	    $crTime1 = date('Y-m-d H:i:s',$crTime1);
	    //  pr($crTime); 
	    $oneWeekAgo = strtotime ( '-7 day' , strtotime($crTime1));
	    $oneWeekAgo=date('Y-m-d H:i:s',$oneWeekAgo);
	    //pr($oneWeekAgo);
	    if(!empty($missionInfo)){ //If user have a mission
		$missionDuration = floor((strtotime($missionInfo['Mission']['end_time']) - strtotime($missionInfo['Mission']['start_time']))/86400)+1;
		//pr($missionDuration);
		if($missionInfo['Mission']['end_time']>$oneWeekAgo){
		    
		  if($missionInfo['Mission']['end_time'] > $crTime1){
		    $elapsedDays = floor((strtotime($crTime1) - strtotime($missionInfo['Mission']['start_time']))/86400)+1;
		  } else{
		    $elapsedDays = floor((strtotime($missionInfo['Mission']['end_time']) - strtotime($missionInfo['Mission']['start_time']))/86400)+1;
		  }
		  //pr($elapsedDays);
		  $remaining_days=$missionDuration-$elapsedDays;
		  //pr($remaining_days); die; 
		    $templateId = 18;
		   // pr($remaining_days); die;
		
	    //Total activity of timeline in last day
	    $totalActInTl = $this->Common->count_tl_act($row['User']['id'],$period); 
	    
	    /***** Send Email to User :: Start *****/
	    $this->Email->smtpOptions = array(
		    'port'=>SMTP_PORT,
		    'timeout '=> SMTP_TIME_OUT,
		    'host' => SMTP_HOST,
		    'username'=>SMTP_USER_NAME,
		    'password'=>SMTP_PASSOWRD 
	    );
	    $this->Email->sendAs= 'html';
	    
	    /******import emailTemplate Model and get template****/
	    //Fetch content of 'DAILY_REMINDER'
	   
	    $template = $this->Common->getEmailTemplate($templateId);
	    
	    $this->Email->from = INFO_EMAIL; 
	    $this->Email->subject = str_replace('{PERIOD}','Weekly',$template['EmailTemplate']['subject']); 
	    $data=$template['EmailTemplate']['description'];
	    $data=str_replace('{NAME}',strtok($row['User']['name'], " "),$data);
	    //$data=str_replace('{PERIOD}',$this->Email->subject,$data);
	     $data=str_replace('{ELAPSED_DAYS}',$elapsedDays,$data);
	     $data=str_replace('{REMAINING_DAYS}',$remaining_days,$data);
	     
	    
	    $data=str_replace('{MISSION_NAME}',$missionInfo['Mission']['title'],$data);
	    $data=str_replace('{TOTAL_DAYS}',$missionDuration,$data);
	    $data=str_replace('{TL_ITEM_IN_PERIOD}',$totalActInTl,$data);
	    
	    $reflection_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'reflections/add_reflection/>Reflect</a>';
	    $data=str_replace('{REFLECTION_LINK}',$reflection_link,$data);
	    $tl_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'timelines/index/'.base64_encode($row["User"]["id"]).'>timeline</a>';
	    $data=str_replace('{TL_LINK}',$tl_link,$data);
	    $shared_mission_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'missions/shared_mission/>shared mission</a>';
	    $data=str_replace('{SHARED_MISSION_LINK}',$shared_mission_link,$data);
	    $add_mission_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'missions/current_mission_setup/>own mission</a>';
	    $data=str_replace('{ADD_MISSION_LINK}',$add_mission_link,$data);
	    $recent_mission_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'users/welcome/>recent mission</a>';
	    $data=str_replace('{RECENT_MISSION_LINK}',$recent_mission_link,$data);
	    $progress_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'users/welcome/>progress</a>';
	    $data=str_replace('{PROGRESS}',$progress_link,$data);
	    $this->set('data',$data);
	    $this->Email->to = $row['User']['email'];
	    //$this->Email->to = "smaartdatatest@gmail.com";
	    $this->Email->template='commanEmailTemplate';
	    //if($row['User']['id'] == 171){
		$this->Email->send();
		//echo '<pre>'; print_r($data); exit;
	    //}
	    //echo '<pre>'; print_r($data); 
	    /***** Send Email to User :: End *****/
	    //	($this->Email->htmlMessage);
	    }
	    }
	}
	exit;
    }
    
    
    
    
    function send_test_reminders() {
	define('VIMBLI_LIVE_LINK','www.vimbli.com/');
	/***** Send Email to User :: Start *****/
	    $this->Email->smtpOptions = array(
		    'port'=>SMTP_PORT,
		    'timeout '=> SMTP_TIME_OUT,
		    'host' => SMTP_HOST,
		    'username'=>SMTP_USER_NAME,
		    'password'=>SMTP_PASSOWRD 
	    );
	    $this->Email->sendAs= 'html';
	    
	    /******import emailTemplate Model and get template****/
	    //Fetch content of 'DAILY_REMINDER'
	    $template = $this->Common->getEmailTemplate(11);
	    
	    $this->Email->from = INFO_EMAIL;
	    $this->Email->subject = str_replace('{PERIOD}','Daily',$template['EmailTemplate']['subject']);
	    $data=$template['EmailTemplate']['description'];
	    $data=str_replace('{NAME}',$row['User']['name'],$data);
	    $data=str_replace('{MISSION_NAME}',$missionInfo['Mission']['title'],$data);
	    $data=str_replace('{ELAPSED_DAYS}',$elapsedDays,$data);
	    $data=str_replace('{TOTAL_DAYS}',$missionDuration,$data);
	    $data=str_replace('{TL_ITEM_IN_PERIOD}',$totalActInTl,$data);
	    
	    $reflection_link = '<a href='.VIMBLI_LIVE_LINK.'reflections/add_reflection/>Reflect</a>';
	    $data=str_replace('{REFLECTION_LINK}',$reflection_link,$data);
	    $tl_link = '<a href='.VIMBLI_LIVE_LINK.'timelines/index/'.base64_encode($row["User"]["id"]).'>timeline</a>';
	    //echo VIMBLI_LIVE_LINK.'timelines/index/'.base64_encode($row["User"]["id"]); die;
	    $data=str_replace('{TL_LINK}',$tl_link,$data);
	    $shared_mission_link = '<a href='.VIMBLI_LIVE_LINK.'missions/shared_mission/>shared mission</a>';
	    $data=str_replace('{SHARED_MISSION_LINK}',$shared_mission_link,$data);
	    $add_mission_link = '<a href='.VIMBLI_LIVE_LINK.'missions/current_mission_setup/>own mission</a>';
	    $data=str_replace('{ADD_MISSION_LINK}',$add_mission_link,$data);
	    $recent_mission_link = '<a href='.VIMBLI_LIVE_LINK.'users/welcome/>recent mission</a>';
	    $data=str_replace('{RECENT_MISSION_LINK}',$recent_mission_link,$data);
	    
	    
	    $this->set('data',$data);
	    //$this->Email->to = $row['User']['email'];
	    $this->Email->to = "smaartdatatest@gmail.com";
	    $this->Email->template='commanEmailTemplate';
	    echo 'AAA<pre>'; print_r($this->Email);
	    //die;
	    $this->Email->send();
	    
	    /***** Send Email to User :: End *****/
	
	exit;
    }
    
     /*
	Function Name: send_Monthly_reminders
	params: NULL
	Created BY:Sunny Chauhan
	Created ON : June. 11, 2013
	Description : Monthly reminders for users
    */
    function send_monthly_reminders() {
	define('VIMBLI_LIVE_LINK','www.vimbli.com/');
	//Configure::write('debug', 2);
	$this->layout = false;
	$this->autoRender = false;
	$period = 'monthly'; //change it to weekly once recognize by client
	
	$userIds = $this->Communication->find('all',array('conditions'=>array('Communication.daily_reminder'=>1),'fields'=>array('Communication.id,Communication.user_id,Communication.monthly_reminder','User.id','User.name','User.email')));
	
	$this->loadModel('StrengthValue');
	$strengthvalues=array('first','second','third','fourth','fifth','sixth','seventh');
	
	foreach($userIds as $row){
	    
	    $strengthArr=array();
	    
	    $st=$this->StrengthValue->find('first',array('conditions'=>array('user_id'=>$row['User']['id'])));
	    foreach($strengthvalues as $values){
	    
		    $strengthArr[]=$st['StrengthValue'][$values];//die;
	       }
	    $strengthArr = array_filter($strengthArr);
	    	    
	    $strength = "";
				$cnt1 = 0;
				for($cnt1=0; $cnt1 <= sizeof($strengthArr); $cnt1++){
					$strength = $strength.'<Br>'.($cnt1+1).'. '.$strengthArr[$cnt1];
				}
				$strength = substr($strength,0,strlen($strength)-3);
	
	    $missionInfo= $this->Mission->find('first',array('recursive'=>2,'conditions'=>array('Mission.owner'=>$row['User']['id']), 'order'=>'Mission.id DESC'));
	    // pr($missionInfo); die;
	    $crTime = date('Y-m-d H:i:s');
	    $crTime1 = date('Y-m-d',strtotime ( '-1 day' , strtotime($crTime)));
	    $crTime1 = $crTime1.' 23:59:59';
	    $oneMonthAgo = date('Y',strtotime($crTime1)).'-'.date('m',strtotime($crTime1)).'-01 00:00:00';
	    $lastMonth = date('F',strtotime($crTime1));
	    //pr($oneWeekAgo); die;
	        if(!empty($strengthArr)){
		    $templateId = 16;
		    }else{
			$templateId = 17;
		}
		    if(!empty($missionInfo)){ //If user have a mission
		    
			    $missionDuration = floor((strtotime($missionInfo['Mission']['end_time']) - strtotime($missionInfo['Mission']['start_time']))/86400)+1;
			    //pr($missionDuration);
			    if($missionInfo['Mission']['end_time']>$oneMonthAgo){
			      
			      if($missionInfo['Mission']['end_time'] > $crTime1){
				$elapsedDays = floor((strtotime($crTime1) - strtotime($missionInfo['Mission']['start_time']))/86400)+1;
			      } else{
				$elapsedDays = floor((strtotime($missionInfo['Mission']['end_time']) - strtotime($missionInfo['Mission']['start_time']))/86400)+1;
			      }
			      
			      
			      //pr($elapsedDays);
			       $elapsedDays = $elapsedDays+1;
			      $remaining_days=$missionDuration-$elapsedDays;
			      //pr($remaining_days); die; 
				
			       // pr($remaining_days); die;
			 
				//Total activity of timeline in last day
	    $totalActInTl = $this->Common->count_tl_act($row['User']['id'],$period); 
	    
	    /***** Send Email to User :: Start *****/
	    $this->Email->smtpOptions = array(
		    'port'=>SMTP_PORT,
		    'timeout '=> SMTP_TIME_OUT,
		    'host' => SMTP_HOST,
		    'username'=>SMTP_USER_NAME,
		    'password'=>SMTP_PASSOWRD 
	    );
	    $this->Email->sendAs= 'html';
	    
	    /******import emailTemplate Model and get template****/
	    //Fetch content of 'DAILY_REMINDER'
	    $template = $this->Common->getEmailTemplate($templateId);
	    $this->Email->from = INFO_EMAIL; 
	    $this->Email->subject = str_replace('{PERIOD}',$lastMonth,$template['EmailTemplate']['subject']); 
	    $data=$template['EmailTemplate']['description'];
	    $data=str_replace('{NAME}',strtok($row['User']['name'], " "),$data);
	    $data=str_replace('{STRENGTH}',$strength,$data);
	     //pr($data); die;
 	    $data=str_replace('{PERIOD}',$lastMonth,$data);
	    $data=str_replace('{ELAPSED_DAYS}',$elapsedDays,$data);
	    $data=str_replace('{REMAINING_DAYS}',$remaining_days,$data);
	    	     
	    $data=str_replace('{DATE_MISSION_WAS_SAVED}',date('F d, Y',strtotime($missionInfo['Mission']['modified'])),$data);
	    $data=str_replace('{MISSION_NAME}',$missionInfo['Mission']['title'],$data);
	    $data=str_replace('{TOTAL_DAYS}',$missionDuration,$data);
	    $data=str_replace('{TL_ITEM_IN_PERIOD}',$totalActInTl,$data);
	    $strength_link='<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'settings/index/'.base64_encode($row["User"]["id"]).'/strengths>Strengths</a>';
	    $data=str_replace('{STRENGTH_LINK}',$strength_link,$data);
	    $reflection_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'reflections/add_reflection/>Reflect</a>';
	    $data=str_replace('{REFLECTION_LINK}',$reflection_link,$data);
	    $tl_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'timelines/index/'.base64_encode($row["User"]["id"]).'>timeline</a>';
	    $data=str_replace('{TL_LINK}',$tl_link,$data);
	    $shared_mission_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'missions/shared_mission/>shared mission</a>';
	    $data=str_replace('{SHARED_MISSION_LINK}',$shared_mission_link,$data);
	    $add_mission_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'missions/current_mission_setup/>own mission</a>';
	    $data=str_replace('{ADD_MISSION_LINK}',$add_mission_link,$data);
	    $recent_mission_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'users/welcome/>recent mission</a>';
	    $data=str_replace('{RECENT_MISSION_LINK}',$recent_mission_link,$data);
	    $progress_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'users/welcome/>progress</a>';
	    $data=str_replace('{PROGRESS}',$progress_link,$data);
	    $strength_link = '<a target="_blank" href=http://'.VIMBLI_LIVE_LINK.'settings/index/'.base64_encode($row["User"]["id"]).'/strengths>Strengths</a>';
	    $data=str_replace('{STRENGTH_LINK}',$strength_link,$data);
	    $this->set('data',$data);
	    $this->Email->to = $row['User']['email'];
	    //$this->Email->to = "smaartdatatest@gmail.com";
	    $this->Email->template='commanEmailTemplate';
	    //if($row['User']['id'] == 193){
	    $this->Email->send();
	    //echo '<pre>'; print_r($data);
	    }
	    //echo '<pre>'; print_r($data);
	    //exit;
	    }
	    
	    /***** Send Email to User :: End *****/
	    //	($this->Email->htmlMessage);
	    //}
	}
	exit;
    }
    
    
    
}
?>