<?php
/*
	* Groups Controller class
	* PHP versions 5.1.4
	* @filesource
	* @link       http://www.smartdatainc.net/
	* @version 0.0.1.3 
*/
App::import('Sanitize');
class MissionsController extends AppController{

	var $name 	= 'Missions';
	var $uses 	= array('MissionConnection','MissionSponsor','Cohort','User','Mission','Milestone','KeyToSuccess','Connection','ConnectionGroup','ConnectionPhone','ConnectionEmail','ConnectionAddress','ConGroupRelation','MissionUser','CohortUser','SponsorManager');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('GoogleCal','RequestHandler','Cookie','Email','Auth','Upload','Common','Import');
	 
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(($this->params['action'] != 'admin_login') && (@$this->params['prefix'] == 'admin'))
		{
		    $this->Auth->allow('sign_up','tmpfun');
		} else {
		       $this->Auth->allow('tmpfun');
		}
	    
	    }
	
	
	/**
	@function: current_mission_setup
	@description		add mission
	@Created by: 		Sandeep Verma
	@Created Date:		Dec. 26, 2012
	@Modified by: 		Vikas Uniyal
	@Modify:		Sep. 16, 2013; Jan. 03, 2013
	*/
	function current_mission_setup($id=null){ //echo $id; exit;
		//pr($id); die;
		$id = base64_decode($id);
		$this->set('pagetitle','Mission Setup');
		if($_SESSION['Auth']['User']['user_type'] == 2)
			$this->layout = "group_dashboard";
		else{
			$this->layout = "individual_dashboard";
		}
		//Users of group
		$allUsers = $this->User->find('list',array('conditions'=>array('User.manager_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('User.id','User.name')));
		$this->set(compact('allUsers'));
		//Cohort List
		$cohortList = $this->Cohort->find('list',array('conditions'=>array('Cohort.group_owner'=>$_SESSION['Auth']['User']['id']),'list'=>array('Cohort.id','Cohort.title')));
		$this->set(compact('cohortList'));
		
		$allSponsors = $this->SponsorManager->find('all',array('conditions'=>array('SponsorManager.manager_id'=>$_SESSION['Auth']['User']['id'],'User.id <>'=>NULL)));
		$this->set(compact('allSponsors'));
		//prx($allSponsors); die;
		$autoCompleteConList_first = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'Connection.created DESC'));
		$autoCompleteConList = array();
		foreach($autoCompleteConList_first as $listKey=>$listVal){
			$autoCompleteConList[] = str_replace('"','',$listVal);
		}
		//unset($autoCompleteConList[725]);
		$autoCompleteConList = '"'.implode('","', $autoCompleteConList).'"';
		//echo $autoCompleteConList; exit;
		$this->set(compact('autoCompleteConList'));
		
		//Shared with cohorts
		if($id != ""){
			$this->loadModel('MissionCohort');
			$allShared = $this->MissionCohort->find('all',array('conditions'=>array('MissionCohort.mission_id'=>$id)));
			foreach($allShared as $rows){
				$shared_cohort_arr[] = $rows['MissionCohort']['cohort_id'];
			}
			$this->set(compact('shared_cohort_arr'));
		}
		
		
		if(empty($this->data)) {
			$recentMission = $this->Mission->find('first',array('order'=>'Mission.id DESC','recursive'=>2,'conditions'=>array('Mission.id'=>$id)));
			$this->data = $recentMission;
			//pr($this->data); die; 
			$sharedWithConnectionIds = $this->MissionConnection->find('list',array('conditions'=>array('MissionConnection.mission_id'=>$recentMission['Mission']['id']), 'fields'=>('connection_id')));
			$sharedWithConnectionTime = $this->MissionConnection->find('first',array('conditions'=>array('MissionConnection.mission_id'=>$recentMission['Mission']['id'])));
			$connectionNames = $this->Connection->find('list',array('conditions'=>array('Connection.id'=>$sharedWithConnectionIds), 'fields'=>('name')));
			
			$this->set(compact('connectionNames'));
			$this->set(compact('recentMission'));
			$this->set(compact('sharedWithConnectionTime'));
			//pr($sharedWithConnectionTime); exit;
		} else {
			//echo '<pre>'; print_r($this->data); die;
			$stTime = explode('/',$this->data['Mission']['start_time']);
			$this->data['Mission']['start_time'] = $stTime[2].'-'.$stTime[1].'-'.$stTime[0].' 00:00:00';
			$endTime = explode('/',$this->data['Mission']['end_time']);
			$this->data['Mission']['end_time'] = $endTime[2].'-'.$endTime[1].'-'.$endTime[0].' 23:59:59';
			
			if($_SESSION['Auth']['User']['user_type'] == 2){
				$this->data['Mission']['shared_by_gm'] = 1;
			}
			$this->data['Mission']['owner'] = $_SESSION['Auth']['User']['id'];
			//pr($this->data); exit;
			$this->data['Mission']['progress_connectivity'] = 0;
			
			//Save sponsor added date
			if($this->data['Mission']['sponsor_id'] != ""){
				if($this->data['Mission']['id'] != ""){ //In edit mission
					$sponsorInfo = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$this->data['Mission']['id'])));
					if($this->data['Mission']['sponsor_id'] != $sponsorInfo['Mission']['sponsor_id']){
						$this->data['Mission']['sponsor_add_date'] = date('Y-m-d H:i:s');
					}
				} else{ //Add mission
					$this->data['Mission']['sponsor_add_date'] = $this->data['Mission']['start_time'];
				}
			}
			
			if($this->Mission->save($this->data)){
				
 				$recentMissionId = $this->data['Mission']['id'] == '' ? $this->Mission->getLastInsertId() : $this->data['Mission']['id'];
				//echo $id; exit;
				//Save Mission shared with users
				$this->MissionUser->deleteAll(array('MissionUser.mission_id'=>$recentMissionId), true);
				
				//Save Mission shared with cohort
				$this->loadModel('MissionCohort');
				$this->MissionCohort->deleteAll(array('MissionCohort.mission_id'=>$recentMissionId), true);
				
				
				$this->data['MissionUser']['mission_id'] = $recentMissionId;
				if($this->data['Message']['msg_to'] == 'individual')
				{
					$shareType = 'individual';
					$this->Mission->updateAll(array('Mission.shared_with'=>"'$shareType'"),array('Mission.id'=>$recentMissionId)); 
					
					foreach($this->data['User']['user_id'] as $row){
						$this->data['MissionUser']['shared_with_id'] = $row;
						$this->MissionUser->create();
						$this->MissionUser->save($this->data['MissionUser']);
					}
				}
				else if($this->data['Message']['msg_to'] == 'cohort')
				{
					$shareType = 'cohort';
					$this->Mission->updateAll(array('Mission.shared_with'=>"'$shareType'"),array('Mission.id'=>$recentMissionId)); 
					
					foreach($this->data['Cohort']['cohort_id'] as $row){
						$cohortUsers = $this->CohortUser->find('all',array('conditions'=>array('CohortUser.cohort_id'=>$row),'fields'=>array('CohortUser.user_id')));
						
						$this->loadModel('MissionCohort');
						$cohortArr['MissionCohort']['mission_id'] = $recentMissionId;
						$cohortArr['MissionCohort']['cohort_id'] = $row;
						$this->MissionCohort->create();
						$this->MissionCohort->save($cohortArr);
						
						foreach($cohortUsers as $row){
							$this->data['MissionUser']['shared_with_id'] = $row['CohortUser']['user_id'];
							$this->MissionUser->create();
							$this->MissionUser->save($this->data['MissionUser']);
						}
						
					}	
				}
				else if($this->data['Message']['msg_to'] == 'group')
				{
					$shareType = 'group';
					$this->Mission->updateAll(array('Mission.shared_with'=>"'$shareType'"),array('Mission.id'=>$recentMissionId)); 
					
					$groupUsers = $this->User->find('all',array('conditions'=>array('User.manager_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('User.id')));
					foreach($groupUsers as $row){
						$this->data['MissionUser']['shared_with_id'] = $row['User']['id'];
						$this->MissionUser->create();
						$this->MissionUser->save($this->data['MissionUser']);
					}
				}
				
				//Share Mission Connection
				$missionConnection = array();
				$this->MissionConnection->deleteAll(array('MissionConnection.mission_id'=>$recentMissionId), true);
				$allConnectionNames = array_map('trim',$this->data['MissionConnection']['connection_title']);
				
				//pr($this->data['MissionConnection']['period']); exit;
				for($i=0; $i<sizeof($allConnectionNames); $i++){
					$allConnectionInfo = $this->Connection->find('first',array('conditions'=>array('Connection.name'=>$allConnectionNames[$i], 'Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
					$missionConnection['MissionConnection']['mission_id'] = $recentMissionId;
					$missionConnection['MissionConnection']['connection_id'] = $allConnectionInfo['Connection']['id'];
					$missionConnection['MissionConnection']['frequency'] = $this->data['MissionConnection']['period'][$i];
					$missionConnection['MissionConnection']['hours'] = $this->data['MissionConnection']['hours'][$i];
					$this->MissionConnection->create();
					//pr($missionConnection);
					if($missionConnection['MissionConnection']['connection_id'] != ""){
						$this->MissionConnection->save($missionConnection);
					}
				}
				//Save Mission Sponsors
				$missionSponsor = array();
				$this->MissionSponsor->deleteAll(array('MissionSponsor.mission_id'=>$recentMissionId), true);
				for($cnt=0; $cnt < sizeof(array_filter($this->data['MissionSponsor']['sponsor_id'])); $cnt++){
					$missionSponsor['MissionSponsor']['mission_id'] = $recentMissionId;
					$missionSponsor['MissionSponsor']['sponsor_id'] = $this->data['MissionSponsor']['sponsor_id'][$cnt];
					$missionSponsor['MissionSponsor']['frequency'] = $this->data['MissionSponsor']['frequency'][$cnt];
					$this->MissionSponsor->create();
					$this->MissionSponsor->save($missionSponsor);
				}
				
				//Save Key to Success
				$keyToSuccess = array();
				$this->KeyToSuccess->deleteAll(array('KeyToSuccess.mission_id'=>$recentMissionId), true);
				for($cnt=0; $cnt < sizeof(array_filter($this->data['KeyToSuccess']['description'])); $cnt++){
					$keyToSuccess['KeyToSuccess']['mission_id'] = $recentMissionId;
					$keyToSuccess['KeyToSuccess']['description'] = $this->data['KeyToSuccess']['description'][$cnt];
					$keyToSuccess['KeyToSuccess']['expected_hrs'] = $this->data['KeyToSuccess']['expected_hrs'][$cnt];
					$keyToSuccess['KeyToSuccess']['period'] = $this->data['KeyToSuccess']['period'][$cnt];
					
					$stTime_k2s = explode('/',$this->data['KeyToSuccess']['start_date'][$cnt]);
					$keyToSuccess['KeyToSuccess']['start_date'] = $stTime_k2s[2].'-'.$stTime_k2s[1].'-'.$stTime_k2s[0];
					$endTime_k2s = explode('/',$this->data['KeyToSuccess']['end_date'][$cnt]);
					$keyToSuccess['KeyToSuccess']['end_date'] = $endTime_k2s[2].'-'.$endTime_k2s[1].'-'.$endTime_k2s[0];
					
					//$keyToSuccess['KeyToSuccess']['start_date'] = date('Y-m-d',strtotime($this->data['KeyToSuccess']['start_date'][$cnt]));
					//$keyToSuccess['KeyToSuccess']['end_date'] = date('Y-m-d',strtotime($this->data['KeyToSuccess']['end_date'][$cnt]));
					$keyToSuccess['KeyToSuccess']['ranking'] = $this->data['KeyToSuccess']['ranking'][$cnt];
					$this->KeyToSuccess->create();
					$this->KeyToSuccess->save($keyToSuccess);
				}
				
				/*******Send Email to Sponsor*****/
				//fetch out the sponsor info
				$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$this->data['Mission']['sponsor_id']),'fields'=>array('User.id','User.name','User.email')));
				/***** Send Welcome Email to User :: Start *****/
				$this->Email->smtpOptions = array(
					'port'=>SMTP_PORT,
					'timeout '=> SMTP_TIME_OUT,
					'host' => SMTP_HOST,
					'username'=>SMTP_USER_NAME,
					'password'=>SMTP_PASSOWRD 
				);
				$this->Email->sendAs= 'html';
				
				/******import emailTemplate Model and get template****/
				App::import('Model','EmailTemplate');
				$this->EmailTemplate = new EmailTemplate;
				
				$template = $this->Common->getEmailTemplate(5);
				
				$this->Email->from = $_SESSION['Auth']['User']['name'].'<'.$_SESSION['Auth']['User']['email'].'>';
				$this->Email->subject = $template['EmailTemplate']['subject'];
				$data=$template['EmailTemplate']['description'];
				$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
				$data=str_replace('{SENDER}',strtok($_SESSION['Auth']['User']['name'], " "),$data);
				
				$timeDiff = ceil((strtotime($this->data['Mission']['end_time']) - strtotime($this->data['Mission']['start_time'])) / (60 * 60 * 24));
				$data=str_replace('{TIME}',$timeDiff,$data);
				
				$key_to_success = "";
				for($cnt=0; $cnt < sizeof($this->data['KeyToSuccess']['description']); $cnt++){
					if($this->data['KeyToSuccess']['description'][$cnt] != ""){
						if($this->data['KeyToSuccess']['period'][$cnt] == 0){ //Weekly
							$period_days = 7;
						}elseif($this->data['KeyToSuccess']['period'][$cnt] == 1){ //Monthly
							$period_days = 30;
						}else{
							$period_days = $timeDiff;
						}
						$hrs_in_day = 	$this->data['KeyToSuccess']['expected_hrs'][$cnt]/$period_days;
						$total_hrs = round($timeDiff*$hrs_in_day);
					
					
					$key_to_success = $key_to_success.'<Br>'.($cnt+1).'. '.$this->data['KeyToSuccess']['description'][$cnt].': '.$total_hrs.' Hours';
					}
				}
				//pr($key_to_success); die;
				//$key_to_success = str_replace(array($cnt,'.'),'',$key_to_success);
				
				$data=str_replace('{KEY_TO_SUCCESS}',$key_to_success,$data);
				//pr($this->data['Mission']['mission_notes']); exit;
				/** missin connections in email-Starts */
				$missionConnections = "";
				$cnt1 = 0;
				$all_emails = '';
				for($cnt1=0; $cnt1 < sizeof($this->data['MissionConnection']['connection_title']); $cnt1++){
					
					if($this->data['MissionConnection']['connection_title'][$cnt1] != ""){
						if($this->data['MissionConnection']['period'][$cnt1] == 'Weekly'){ //Weekly
							$period_days = 7; 
						}elseif($this->data['MissionConnection']['period'][$cnt1] == 'Monthly'){ //Monthly
							$period_days = 30;
						}else{
							$period_days = $timeDiff;
						}
						
					$touch_in_one_day = $this->data['MissionConnection']['hours'][$cnt1]/$period_days;
					
					$touches = ceil($timeDiff*$touch_in_one_day);
					
					$missionConnections = $missionConnections.'<Br>'.($cnt1+1).'. '.$this->data['MissionConnection']['connection_title'][$cnt1].': '.$touches.' Touches';
					}
				}
				// missin connections in email - Ends
				//echo $missionConnections; exit;
				$data=str_replace('{MISSION_CONNECTIONS}',$missionConnections,$data);
				
				$data=str_replace('{MISSION_NOTES}',$this->data['Mission']['mission_notes'],$data);
				
				$mission_link = '<a href='.SITE_URL.'missions/tmpfun/'.base64_encode($recentMissionId).'/'.$userInfo["User"]["id"].'>'.SITE_URL.'missions/view/'.base64_encode($recentMissionId).'</a>';
				$data=str_replace('{MISSION_LINK}',$mission_link,$data);
				
				$confirm_link = '<a href='.SITE_URL.'missions/mission_accepted/'.base64_encode($recentMissionId).'/'.$userInfo["User"]["id"].'>Confirm</a>';
				$data=str_replace('{CONFIRM_LINK}',$confirm_link,$data);
				
				//pr($data); exit;
				$this->set('data',$data);
				$this->Email->to = array($userInfo['User']['email'],$_SESSION['Auth']['User']['email']);
				//$this->Email->to = 'smaartdatatest@gmail.com';
				$this->Email->template='commanEmailTemplate';
				if($this->data['Mission']['shared_checked'] != 0){
					$this->Email->send();
				}
				/***** Send Email to Sponsor :: End *****/
			
			$this->Session->setFlash('Mission saved successfully.', 'default', array('class' => 'flash_success'));
			if($_SESSION['Auth']['User']['user_type'] == 2){
				$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
			}else{
				$this->redirect(array('controller'=>'users','action'=>'welcome'));
			}
				
			}else{
				echo 'Not Saved'; die;
			}
		}
		return $allSponsors;
	}
	
	/**
	@function: tmpfun
	@description		Mission detail page
	@Created by: 		Vikas Uniyal
	@Modify:		
	@Created Date:		Jan. 03, 2013
	*/
	function tmpfun($id,$uId = NULL){
		
		//$id = base64_decode($id);
		$this->set('pagetitle','View Mission');
		$this->layout = "individual_dashboard";
		
		//echo $uId; echo '<br>';
		if($uId != ""){
			$this->User->id = $uId;
			$userInfo = $this->User->read();
			$_SESSION['user_email'] = $userInfo['User']['email'];
		}
		
		$this->redirect(array('controller'=>'missions','action'=>'view',$id));
	}
	
	/**
	@function: view
	@description		Mission detail page
	@Created by: 		Vikas Uniyal
	@Modify:		
	@Created Date:		Jan. 03, 2013
	*/
	function view($id,$uId = NULL){
		$id = base64_decode($id);
		$this->set('pagetitle','View Mission');
		$this->layout = "individual_dashboard";
		
		$missionDetail = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$id),'recursive'=>2));
		$this->set(compact('missionDetail'));
	}
	
	/**
	@function: update_mission
	@description		Update mission by sponsor
	@Created by: 		Vikas Uniyal
	@Modify:		
	@Created Date:		Jan. 17, 2013
	*/
	function update_mission(){
		$id = base64_decode($this->data['Mission']['id']);
		//pr($this->data); die;
		
		//update confirmation status of mission if confirmed by sponsor
		if($this->data['Mission']['confirmation_status'] == 1){
			$status = 1;
			$this->Mission->updateAll(array('Mission.confirmation_status'=>"'$status'"),array('Mission.id'=>$id));
		} else {
			$status = 0;
			$this->Mission->updateAll(array('Mission.confirmation_status'=>"'$status'"),array('Mission.id'=>$id));
		}
		
		if($this->data['KeyToSuccess']['sign_off_status'][0] != ""){
			
			$allk2s = $this->KeyToSuccess->find('all',array('conditions'=>array('KeyToSuccess.mission_id'=>$id)));
			foreach($allk2s as $row):
				$status = 0;
				$this->KeyToSuccess->updateAll(array('KeyToSuccess.sign_off_status'=>"'$status'"),array('KeyToSuccess.id'=>$row['KeyToSuccess']['id']));
			endforeach;
			
			foreach($this->data['KeyToSuccess']['sign_off_status'] as $row):
				$status = 1;
				$this->KeyToSuccess->updateAll(array('KeyToSuccess.sign_off_status'=>"'$status'"),array('KeyToSuccess.id'=>$row));
			endforeach;
		} else {
			$allk2s = $this->KeyToSuccess->find('all',array('conditions'=>array('KeyToSuccess.mission_id'=>$id)));
			foreach($allk2s as $row):
				$status = 0;
				$this->KeyToSuccess->updateAll(array('KeyToSuccess.sign_off_status'=>"'$status'"),array('KeyToSuccess.id'=>$row['KeyToSuccess']['id']));
			endforeach;
		}
		
		//update signoff status of k2s if signoff by sponsor
		
		
		$this->Session->setFlash('Mission saved successfully.', 'default', array('class' => 'flash_success'));
		$this->redirect($this->referer());
			
	}
	
	/**
	@function: view
	@description		Mission detail page
	@Created by: 		Vikas Uniyal
	@Modify:		
	@Created Date:		Jan. 03, 2013
	*/
	function view_recent_mission($id=NULL){
		$this->set('pagetitle','View Mission');
		$this->layout = "individual_dashboard";
		if($id == ""){ 
			$missionDetail = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id']),'order'=>'Mission.id DESC','recursive'=>2));
		}else{
			$id= base64_decode($id);
			//$missionDetail = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$id),'order'=>'Mission.id DESC','recursive'=>2));
			$missionDetail = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$id),'order'=>'Mission.id DESC','recursive'=>2));
		}
		if(!empty($missionDetail)){
			$this->set(compact('missionDetail'));
		} else {
			$this->Session->setFlash('No mission to display.', 'default', array('class' => 'flash_success'));
			$this->redirect($this->referer());
		}
		//pr($missionDetail); die;
		/*
		
		*/
	}
	
	/**
	@function: view
	@description		Mission detail page
	@Created by: 		Vikas Uniyal
	@Modify:		
	@Created Date:		Jan. 03, 2013
	*/
	function view_current_mission($id=NULL){
		$this->set('pagetitle','View Mission');
		$this->layout = "individual_dashboard";
		
		$missionDetail = $this->Mission->find('first',array('recursive'=>2,'conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_by_gm'=>0), 'order'=>'Mission.id DESC'));
		
		if(!empty($missionDetail)){
			$this->set(compact('missionDetail'));
		} else {
			$this->Session->setFlash('No mission to display.', 'default', array('class' => 'flash_success'));
			$this->redirect($this->referer());
		}
		//pr($missionDetail); die;
		/*
		
		*/
	}
	
	/**
	@function: 		update_mission_progress
	@description		Mission detail page
	@Created by: 		Sandeep Verma
	@Modify:		
	@Created Date:		Jan. 29, 2013
	*/
	function update_mission_progress($id=NULL, $value=NULL, $entity=''){
		$this->layout = false;
		$this->autoRender = false;
		//echo $entity; exit;
		if($entity =='general'){
			$this->Mission->updateAll(array('Mission.progress_general'=>"'$value'"),array('Mission.id'=>$id));
			echo json_encode('Update general progress'); exit;
		}elseif($entity =='connectivity'){
			
			//echo $value; 
			//echo $_SESSION['Adj']['connectivity'];
			$pre_value=$value;
			//echo $pre_value; 
			if($value>$_SESSION['Adj']['connectivity']) {
			$value = $value-$_SESSION['Adj']['connectivity']; //Current dragged val+last value shown on slider
			//Find previous val in db
			$prevVal = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$id), 'fields'=>array('Mission.id','Mission.progress_connectivity')));
			$value = $value+$prevVal['Mission']['progress_connectivity'];
			
			$this->Mission->updateAll(array('Mission.progress_connectivity'=>"'$value'"),array('Mission.id'=>$id));
			}else{
				//echo $pre_value;
				//echo $_SESSION['Adj']['connectivity'];
				$diffvalue=$_SESSION['Adj']['connectivity']-$pre_value;
				//echo $diffvalue;
				$_SESSION['Adj']['connectivity']=$pre_value-$diffvalue;
				//echo $_SESSION['Adj']['connectivity'];
				//echo $pre_value;
				$value = $pre_value-$_SESSION['Adj']['connectivity']; //Current dragged val+last value shown on slider
			//Find previous val in db
				//echo $value;
				$prevVal = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$id), 'fields'=>array('Mission.id','Mission.progress_connectivity')));
				//echo $prevVal;
				$value = $prevVal['Mission']['progress_connectivity']-$value;
				
				$this->Mission->updateAll(array('Mission.progress_connectivity'=>"'$value'"),array('Mission.id'=>$id));
			}
			$_SESSION['Adj']['connectivity'] =$pre_value;
			
			echo json_encode('Update connectivity progress'); exit;
		}elseif($entity =='k2s'){
			//echo $value;
			//pr($_SESSION); //exit;
			
			$new_dragged_val = $value; //Used to update session at the end of these lines
			
			//echo '<br>'.$_SESSION['Adj'][$id]; //exit;
			$value = $value-$_SESSION['Adj'][$id]; //Current dragged val-last value shown on slider
			//echo '<br>'.$value; 
			$prevVal = $this->KeyToSuccess->find('first',array('conditions'=>array('KeyToSuccess.id'=>$id), 'fields'=>array('KeyToSuccess.id','KeyToSuccess.progress_k2s')));
			$new_value = $value+$prevVal['KeyToSuccess']['progress_k2s'];
			//echo '<br>Pre: '.$prevVal['KeyToSuccess']['progress_k2s'];
			//echo '<br>'.$new_value; //exit;
			$this->KeyToSuccess->updateAll(array('KeyToSuccess.progress_k2s'=>"'$new_value'"),array('KeyToSuccess.id'=>$id));
			
			$_SESSION['Adj'][$id] = $new_dragged_val;
			
			echo json_encode('Update KeyToSuccess progress'); exit;
		}else{
			return false;
		}
	}
	
	/** 
	@function : shared_mission 
	@description : list all shared mission with user
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 31, 2013
	*/
	function shared_mission()
	{
		$this->set('pagetitle','Shared Mission');
		$this->layout = 'individual_dashboard';
		
		/*
		$missionEdited = $this->Mission->find('all',array('conditions'=>array('Mission.edited_by'=>$_SESSION['Auth']['User']['id'])));
		$editedArr = array();
		foreach($missionEdited as $row){
			$editedArr[] = $row['Mission']['draft_mission_id'];
		}
		//pr($editedArr); die;
		if(sizeof($editedArr) <=1){
			$sharedMission = $this->MissionUser->find('all',array('conditions'=>array('MissionUser.shared_with_id'=>$_SESSION['Auth']['User']['id'],'Mission.id <>'=>$editedArr[0])));
		}else{
			$sharedMission = $this->MissionUser->find('all',array('conditions'=>array('MissionUser.shared_with_id'=>$_SESSION['Auth']['User']['id'],'Mission.id NOT'=>$editedArr)));
		}
		
		//pr($sharedMission); die;
		$sharedMission = array_merge($missionEdited,$sharedMission);
		*/
		$sharedMission = $this->MissionUser->find('all',array('conditions'=>array('MissionUser.shared_with_id'=>$_SESSION['Auth']['User']['id'])));
		$this->set(compact('sharedMission'));
		//pr($sharedMission); die;
	}
	
	/** 
	@function : draft_mission 
	@description : Drafted mission by user
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 31, 2013
	*/
	
	function draft_mission()
	{
		$this->redirect(array('controller'=>'users','action'=>'welcome'));
		$this->set('pagetitle','Shared Mission');
		$this->layout = 'individual_dashboard';
		$sharedMission = $this->Mission->find('all',array('conditions'=>array('Mission.edited_by'=>$_SESSION['Auth']['User']['id'])));
		
		$this->set(compact('sharedMission'));
		//pr($sharedMission); die;
	}
	
	/** 
	@function : delete_shared_mission 
	@description : delete_shared_mission,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Feb. 01, 2013
	*/
	function delete_shared_mission($id=null) {
		$id = base64_decode($id);
	    //echo $id; die;
	    $this->Mission->delete($id, true);
	    
	    $sharedTblinfo = $this->MissionUser->find('all',array('conditions'=>array('MissionUser.mission_id'=>$id,'MissionUser.shared_with_id'=>$_SESSION['Auth']['User']['id'])));
	    foreach($sharedTblinfo as $row){
		$this->MissionUser->delete($row['MissionUser']['id'], true);
	    }
	    
	    //$this->MissionUser->id = $id;
	    //$this->MissionUser->deleteAll(array('MissionUser.mission_id'=>$id,'MissionUser.shared_with_id'=>$_SESSION['Auth']['User']['id']));
            $this->Session->setFlash('Record deleted sucessfully.','default',array('class'=>'flash_success'));
            $this->redirect($this->referer());
	}
	
	/** 
	@function : recent_mission 
	@description : list all recent mission with user
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 31, 2013
	*/
	function recent_missions()
	{
		$this->set('pagetitle','Recent Missions');
		$this->layout = 'individual_dashboard';
		$curTime = date('Y-m-d H:i:s');
		
		$crMissionId = $this->Mission->find('first',array('recursive'=>2,'conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_by_gm'=>0), 'order'=>'Mission.id DESC','fields'=>array('Mission.id')));
		//pr($crMissionId); die;
		//$sharedMission = $this->Mission->find('all',array('conditions'=>array("OR"=>array(array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.end_time <'=>$curTime),array('Mission.edited_by'=>$_SESSION['Auth']['User']['id'],'Mission.end_time <'=>$curTime)))));
		$sharedMission = $this->Mission->find('all',array('conditions'=>array("OR"=>array(array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.end_time <'=>$curTime,'Mission.shared_by_gm'=>0,'Mission.id <>' =>$crMissionId['Mission']['id']),array('Mission.edited_by'=>$_SESSION['Auth']['User']['id'],'Mission.end_time <'=>$curTime,'Mission.shared_by_gm'=>0,'Mission.id <>' =>$crMissionId['Mission']['id']))),'order'=>'Mission.id DESC'));
		
		//pr($sharedMission); die;
		$this->set(compact('sharedMission'));
	}
	
	
	/**
	@function: edit_shared_mission
	@description:		edit_shared_mission
	@Created by: 		Vikas Uniyal
	@Modify:		Jan. 03, 2013
	@Created Date:		Dec. 26, 2012
	*/
	function edit_shared_mission($id=null){ //echo $id; exit;
		$id = base64_decode($id);
		$this->set('pagetitle','Mission Setup');
		$this->layout = 'individual_dashboard';
		//Users of group
		$allUsers = $this->User->find('list',array('conditions'=>array('User.manager_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('User.id','User.name')));
		$this->set(compact('allUsers'));
		//Cohort List
		$cohortList = $this->Cohort->find('list',array('conditions'=>array('Cohort.group_owner'=>$_SESSION['Auth']['User']['id']),'list'=>array('Cohort.id','Cohort.title')));
		$this->set(compact('cohortList'));
		//Sponsor List
		//$allSponsors = $this->User->find('all',array('conditions'=>array('User.user_type'=>3)));
		//$this->set(compact('allSponsors'));
		
		$allSponsors = $this->SponsorManager->find('all',array('conditions'=>array('SponsorManager.manager_id'=>$_SESSION['Auth']['User']['id'])));
		$this->set(compact('allSponsors'));
		
		//Connection List
		//$conList = $this->Connection->find('all',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id'],'Connection.status'=>1)));
		//$this->set(compact('conList'));
		
		$autoCompleteConList_first = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'Connection.created DESC'));
		$autoCompleteConList = array();
		foreach($autoCompleteConList_first as $listKey=>$listVal){
			$autoCompleteConList[] = str_replace('"','',$listVal);
		}
		//unset($autoCompleteConList[725]);
		$autoCompleteConList = '"'.implode('","', $autoCompleteConList).'"';
		//echo $autoCompleteConList; exit;
		$this->set(compact('autoCompleteConList'));
		
		if(empty($this->data)) {
			//echo $id; die;
			$recentMission = $this->Mission->find('first',array('order'=>'Mission.id DESC','recursive'=>2,'conditions'=>array('Mission.id'=>$id)));
			$this->data = $recentMission;
			//pr($recentMission);  exit;
			$this->set(compact('recentMission'));
		} else {	//pr($this->data); die;
			//converted date to proper format
			$stTime = explode('/',$this->data['Mission']['start_time']);
			$this->data['Mission']['start_time'] = $stTime[2].'-'.$stTime[1].'-'.$stTime[0].' 00:00:00';
			$endTime = explode('/',$this->data['Mission']['end_time']);
			$this->data['Mission']['end_time'] = $endTime[2].'-'.$endTime[1].'-'.$endTime[0].' 23:59:59';
			
			//$this->data['Mission']['start_time'] = date('Y-m-d', strtotime($this->data['Mission']['start_time'])); 
			//$this->data['Mission']['end_time'] = date('Y-m-d', strtotime($this->data['Mission']['end_time'])); 
			
			$this->data['Mission']['owner'] = $_SESSION['Auth']['User']['id'];
			$this->data['Mission']['edited_by'] = $_SESSION['Auth']['User']['id'];
			//pr($this->data); exit;
			
			//Save sponsor added date
			if($this->data['Mission']['sponsor_id'] != ""){
				$this->data['Mission']['sponsor_add_date'] = $this->data['Mission']['start_time'];
			}
			
			if($this->Mission->save($this->data)){
 				$recentMissionId = $this->data['Mission']['id'] == '' ? $this->Mission->getLastInsertId() : $this->data['Mission']['id'];
				//echo $id; exit;
				//Save Mission shared with users
				$this->MissionUser->deleteAll(array('MissionUser.mission_id'=>$recentMissionId), true);
				$this->data['MissionUser']['mission_id'] = $recentMissionId;
				if($this->data['Message']['msg_to'] == 'individual')
				{
					$shareType = 'individual';
					$this->Mission->updateAll(array('Mission.shared_with'=>"'$shareType'"),array('Mission.id'=>$recentMissionId)); 
					
					foreach($this->data['User']['user_id'] as $row){
						$this->data['MissionUser']['shared_with_id'] = $row;
						$this->MissionUser->create();
						$this->MissionUser->save($this->data['MissionUser']);
					}
				}
				else if($this->data['Message']['msg_to'] == 'cohort')
				{
					$shareType = 'cohort';
					$this->Mission->updateAll(array('Mission.shared_with'=>"'$shareType'"),array('Mission.id'=>$recentMissionId)); 
					
					foreach($this->data['Cohort']['cohort_id'] as $row){
						$cohortUsers = $this->CohortUser->find('all',array('conditions'=>array('CohortUser.cohort_id'=>$row),'fields'=>array('CohortUser.user_id')));
						
						foreach($cohortUsers as $row){
						$this->data['MissionUser']['shared_with_id'] = $row['CohortUser']['user_id'];
						$this->MissionUser->create();
						$this->MissionUser->save($this->data['MissionUser']);
					}
					}	
				}
				else if($this->data['Message']['msg_to'] == 'group')
				{
					$shareType = 'group';
					$this->Mission->updateAll(array('Mission.shared_with'=>"'$shareType'"),array('Mission.id'=>$recentMissionId)); 
					
					$groupUsers = $this->User->find('all',array('conditions'=>array('User.manager_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('User.id')));
					foreach($groupUsers as $row){
						$this->data['MissionUser']['shared_with_id'] = $row['User']['id'];
						$this->MissionUser->create();
						$this->MissionUser->save($this->data['MissionUser']);
					}
				}
				
				//Share Mission Connection
				$missionConnection = array();
				$this->MissionConnection->deleteAll(array('MissionConnection.mission_id'=>$recentMissionId), true);
				$allConnectionNames = array_map('trim',$this->data['MissionConnection']['connection_title']);
				
				//pr($this->data['MissionConnection']['period']); exit;
				for($i=0; $i<sizeof($allConnectionNames); $i++){
					$allConnectionInfo = $this->Connection->find('first',array('conditions'=>array('Connection.name'=>$allConnectionNames[$i], 'Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
					$missionConnection['MissionConnection']['mission_id'] = $recentMissionId;
					$missionConnection['MissionConnection']['connection_id'] = $allConnectionInfo['Connection']['id'];
					$missionConnection['MissionConnection']['frequency'] = $this->data['MissionConnection']['period'][$i];
					$missionConnection['MissionConnection']['hours'] = $this->data['MissionConnection']['hours'][$i];
					$this->MissionConnection->create();
					//pr($missionConnection);
					if($missionConnection['MissionConnection']['connection_id'] != ""){
						$this->MissionConnection->save($missionConnection);
					}
				}
				
				//Save Mission Sponsors
				$missionSponsor = array();
				$this->MissionSponsor->deleteAll(array('MissionSponsor.mission_id'=>$recentMissionId), true);
				for($cnt=0; $cnt < sizeof(array_filter($this->data['MissionSponsor']['sponsor_id'])); $cnt++){
					$missionSponsor['MissionSponsor']['mission_id'] = $recentMissionId;
					$missionSponsor['MissionSponsor']['sponsor_id'] = $this->data['MissionSponsor']['sponsor_id'][$cnt];
					$missionSponsor['MissionSponsor']['frequency'] = $this->data['MissionSponsor']['frequency'][$cnt];
					$this->MissionSponsor->create();
					$this->MissionSponsor->save($missionSponsor);
				}
				
				//Save Key to Success
				$keyToSuccess = array();
				$this->KeyToSuccess->deleteAll(array('KeyToSuccess.mission_id'=>$recentMissionId), true);
				for($cnt=0; $cnt < sizeof(array_filter($this->data['KeyToSuccess']['description'])); $cnt++){
					$keyToSuccess['KeyToSuccess']['mission_id'] = $recentMissionId;
					$keyToSuccess['KeyToSuccess']['description'] = $this->data['KeyToSuccess']['description'][$cnt];
					$keyToSuccess['KeyToSuccess']['expected_hrs'] = $this->data['KeyToSuccess']['expected_hrs'][$cnt];
					$keyToSuccess['KeyToSuccess']['period'] = $this->data['KeyToSuccess']['period'][$cnt];
					
					$stTime_k2s = explode('/',$this->data['KeyToSuccess']['start_date'][$cnt]);
					$keyToSuccess['KeyToSuccess']['start_date'] = $stTime_k2s[2].'-'.$stTime_k2s[1].'-'.$stTime_k2s[0];
					$endTime_k2s = explode('/',$this->data['KeyToSuccess']['end_date'][$cnt]);
					$keyToSuccess['KeyToSuccess']['end_date'] = $endTime_k2s[2].'-'.$endTime_k2s[1].'-'.$endTime_k2s[0];
					
					//$keyToSuccess['KeyToSuccess']['start_date'] = date('Y-m-d',strtotime($this->data['KeyToSuccess']['start_date'][$cnt]));
					//$keyToSuccess['KeyToSuccess']['end_date'] = date('Y-m-d',strtotime($this->data['KeyToSuccess']['end_date'][$cnt]));
					$keyToSuccess['KeyToSuccess']['ranking'] = $this->data['KeyToSuccess']['ranking'][$cnt];
					$this->KeyToSuccess->create();
					$this->KeyToSuccess->save($keyToSuccess);
				}
				
				/*******Send Email to Sponsor*****/
				//fetch out the sponsor info
				$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$this->data['Mission']['sponsor_id']),'fields'=>array('User.name','User.email')));
				/***** Send Welcome Email to User :: Start *****/
				$this->Email->smtpOptions = array(
					'port'=>SMTP_PORT,
					'timeout '=> SMTP_TIME_OUT,
					'host' => SMTP_HOST,
					'username'=>SMTP_USER_NAME,
					'password'=>SMTP_PASSOWRD 
				);
				$this->Email->sendAs= 'html';
				
				/******import emailTemplate Model and get template****/
				App::import('Model','EmailTemplate');
				$this->EmailTemplate = new EmailTemplate;
				
				$template = $this->Common->getEmailTemplate(5);
				
				$this->Email->from = $_SESSION['Auth']['User']['name'].'<'.$_SESSION['Auth']['User']['email'].'>';
				$this->Email->subject = $template['EmailTemplate']['subject'];
				$data=$template['EmailTemplate']['description'];
				$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
				$data=str_replace('{SENDER}',strtok($_SESSION['Auth']['User']['name'], " "),$data);
				
				$timeDiff = ceil((strtotime($this->data['Mission']['end_time']) - strtotime($this->data['Mission']['start_time'])) / (60 * 60 * 24));
				$data=str_replace('{TIME}',$timeDiff,$data);
				
				$key_to_success = "";
				for($cnt=0; $cnt < sizeof($this->data['KeyToSuccess']['description']); $cnt++){
					if($this->data['KeyToSuccess']['description'][$cnt] != ""){
						if($this->data['KeyToSuccess']['period'][$cnt] == 0){ //Weekly
							$period_days = 7;
						}elseif($this->data['KeyToSuccess']['period'][$cnt] == 1){ //Monthly
							$period_days = 30;
						}else{
							$period_days = $timeDiff;
						}
						$hrs_in_day = 	$this->data['KeyToSuccess']['expected_hrs'][$cnt]/$period_days;
						$total_hrs = round($timeDiff*$hrs_in_day);
										
					$key_to_success = $key_to_success.'<Br>'.($cnt+1).'. '.$this->data['KeyToSuccess']['description'][$cnt].': '.$total_hrs.' Hours';
					}
				}
				$key_to_success = str_replace(array($cnt,'.'),'',$key_to_success);
				
				$data=str_replace('{KEY_TO_SUCCESS}',$key_to_success,$data);
				/** missin connections in email-Starts */
				$missionConnections = "";
				$cnt1 = 0;
				$all_emails = '';
				for($cnt1=0; $cnt1 < sizeof($this->data['MissionConnection']['connection_title']); $cnt1++){
					if($this->data['MissionConnection']['connection_title'][$cnt1] != ""){
						if($this->data['MissionConnection']['period'][$cnt] == 'Weekly'){ //Weekly
							$period_days = 7;
						}elseif($this->data['MissionConnection']['period'][$cnt] == 'Monthly'){ //Monthly
							$period_days = 30;
						}else{
							$period_days = $timeDiff;
						}
					$touch_in_one_day = $this->data['MissionConnection']['hours'][$cnt1]/$period_days;
					$touches = round($timeDiff*$touch_in_one_day);
					
					$missionConnections = $missionConnections.'<Br>'.($cnt1+1).'. '.$this->data['MissionConnection']['connection_title'][$cnt1].': '.$touches.' Touches';
					}
				}
				$missionConnections = str_replace(array($cnt1,'.'),'',$missionConnections);
				
				/** missin connections in email - Ends*/
				//echo $missionConnections; exit;
				$data=str_replace('{MISSION_CONNECTIONS}',$missionConnections,$data);
				
				$data=str_replace('{MISSION_NOTES}',$this->data['Mission']['mission_notes'],$data);
				
				$mission_link = '<a href='.SITE_URL.'missions/view/'.base64_encode($recentMissionId).'>'.SITE_URL.'missions/view/'.base64_encode($recentMissionId).'</a>';
				$data=str_replace('{MISSION_LINK}',$mission_link,$data);
				
				$confirm_link = '<a href='.SITE_URL.'missions/mission_accepted/'.base64_encode($recentMissionId).'/'.$userInfo["User"]["id"].'>Confirm</a>';
				$data=str_replace('{CONFIRM_LINK}',$confirm_link,$data);
				
				$this->set('data',$data);
				//$this->Email->to = $userInfo['User']['email'];
				$this->Email->to = array($userInfo['User']['email'],$_SESSION['Auth']['User']['email']);
				$this->Email->template='commanEmailTemplate';
				if($this->data['Mission']['shared_checked'] != 0){
					$this->Email->send();
				}
				/***** Send Email to Sponsor :: End *****/
			
			$this->Session->setFlash('Mission saved successfully.', 'default', array('class' => 'flash_success'));
			if($_SESSION['Auth']['User']['user_type'] == 2){
				$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
			}else{
				$this->redirect(array('controller'=>'missions','action'=>'draft_mission'));
			}
				
			}
		}
	}
	
	
	/**
	@function: send_DB_email
	@description:	Send email from mission dashboard using the "SHARE" (action button) button
	@Created by: 	Vikas Uniyal
	@Modify:	Jun. 05, 2013
	@Created Date:	Jun. 04, 2013
	*/
	function send_DB_email($con_val=NULL, $k2s_val=NULL){
		/*
		echo $con_val;
		echo '<br> '.$k2s_val;
		die;
		*/
		//Convert params into 2 arrays
		$conValArr = array();
		$conExp = explode('=',$con_val);
		$conColorVal = $conExp[0];
		
		$k2sValArr = array();
		$k2sExp = array_filter(explode(';',$k2s_val));
		//pr($k2sExp);
		foreach($k2sExp as $k2sKey=>$k2sVal){
			$k2sMixExp[] = explode(';',$k2sVal);
		}
		
		foreach($k2sMixExp as $Key1=>$Val1){
			$k2sRefined[$Key1]= $Val1[0];
		}
		
		foreach($k2sRefined as $KeyRefine=>$ValRefine){
			$expVal = explode('=',$ValRefine);
			$k2sFinalArr[$expVal[0]] = $expVal[1];
		}
		//----------------------//
		//pr($k2sFinalArr); die;
		$k2sAvg = ceil(array_sum($k2sFinalArr)/sizeof($k2sFinalArr));
		$missionStatusVal = floor(($conColorVal+$k2sAvg)/2);
		
		//Mission status
		if($missionStatusVal<2){
			$missionStatus = "Behind";	
		}elseif($missionStatusVal>1 AND $missionStatusVal<3){
			$missionStatus = "Slightly behind";	
		}else{
			$missionStatus = "On track";
		}
		
		//Connectivity status
		if($conColorVal<2){
			$conStatus = "Behind";	
		}elseif($conColorVal>1 AND $conColorVal<3){
			$conStatus = "Slightly behind";
		}else{
			$conStatus = "On track";
		}
		
		//K2s Avg status
		if($k2sAvg<2){
			$k2sAvgStatus = "Behind";	
		}elseif($k2sAvg>1 AND $k2sAvg<3){
			$k2sAvgStatus = "Slightly behind";
		}else{
			$k2sAvgStatus = "On track";
		}
		
		$this->autoRender = false;
		/*******Send Email to Sponsor*****/
		$this->User->unbindModel(array('hasMany'=>array('SponsorManager'),'hasAndBelongsToMany'=>array('UserGroup')));
		$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('User.id','User.name','User.email')));
		$recentMission = $this->Mission->find('first',array('recursive'=>2,'conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id']), 'order'=>'Mission.id DESC'));
		
		$sponsorName = ($recentMission['Sponsor']['name'] != "")?$recentMission['Sponsor']['name']:"[Add Name]";
		
		$mission_duration = floor((strtotime($recentMission['Mission']['end_time']) - strtotime($recentMission['Mission']['start_time']))/86400);
		$mission_duration = ($mission_duration+1).' days';
		
		if($recentMission['Mission']['end_time'] > date("Y-m-d H:i:s")){
			$elapsed_days = floor((strtotime(date("Y-m-d H:i:s")) - strtotime($recentMission['Mission']['start_time']))/86400).' days';
		} else{
			$elapsed_days = floor((strtotime($recentMission['Mission']['end_time']) - strtotime($recentMission['Mission']['start_time']))/86400).' days';
		}
		
		
		/***** Send Welcome Email to User :: Start *****/
		$this->Email->smtpOptions = array(
			'port'=>SMTP_PORT,
			'timeout '=> SMTP_TIME_OUT,
			'host' => SMTP_HOST,
			'username'=>SMTP_USER_NAME,
			'password'=>SMTP_PASSOWRD 
		);
		$this->Email->sendAs= 'html';
		
		/******import emailTemplate Model and get template****/
		App::import('Model','EmailTemplate');
		$this->EmailTemplate = new EmailTemplate;
		
		$template = $this->Common->getEmailTemplate(15);
		
		$this->Email->from = $userInfo['User']['email'];
		$this->Email->subject = $template['EmailTemplate']['subject'];
		$data=$template['EmailTemplate']['description'];
		
		$data=str_replace('{SPONSOR_NAME}',$sponsorName,$data);
		$data=str_replace('{USER_NAME}',$userInfo['User']['name'],$data);
		$data=str_replace('{MISSION_NAME}',$recentMission['Mission']['title'],$data);
		$data=str_replace('{TOTAL_MISSION_DAYS}','<b>'.$mission_duration.'</b>',$data);
		$data=str_replace('{ELAPSED_DAYS}','<b>'.$elapsed_days.'</b>',$data);
		$data=str_replace('{MISSION_STATUS}','<b>'.$missionStatus.'</b>',$data);
		$data=str_replace('{CON_STATUS}','<b>'.$conStatus.'</b>',$data);
		$data=str_replace('{K2S_AVG_STATUS}','<b>'.$k2sAvgStatus.'</b>',$data);
		
		
		$key_to_success = ""; $cnt=0;
		foreach($k2sFinalArr as $keyOfk2s=>$valOfk2s){
			$k2sInfo = $this->KeyToSuccess->find('first',array('conditions'=>array('KeyToSuccess.id'=>$keyOfk2s),'fields'=>array('KeyToSuccess.id','KeyToSuccess.description')));
			
			//K2s status
			if($valOfk2s<2){
				$k2sStatus = "Behind";	
			}elseif($valOfk2s>1 AND $valOfk2s<3){
				$k2sStatus = "Slightly behind";
			}else{
				$k2sStatus = "On track";
			}
			
			
			$key_to_success = $key_to_success.($cnt+1).'. '.$k2sInfo['KeyToSuccess']['description'].': <b>'.$k2sStatus.'</b><br>';
			
			$cnt=$cnt+1;
		}
		//echo $key_to_success; die;
		$data=str_replace('{KEY_TO_SUCCESS}',$key_to_success,$data);
		
		$this->set('data',$data);
		$this->Email->to = $userInfo['User']['email'];
		//$this->Email->to = 'smaartdatatest@gmail.com';
		$this->Email->template='commanEmailTemplate';
		//echo '<pre>'; print_r($data); die;
		$this->Email->send();
		/***** Send Email to Sponsor :: End *****/
		return 1;
		exit;
	}
	
	/**
	@function: mission_accepted
	@description:	Accept the mission by sponsor
	@Created by: 	Vikas Uniyal
	@Modify:	
	@Created Date:	Jul. 11, 2013
	*/
	function mission_accepted($missionId=NULL, $userId=NULL){
		$missionId = base64_decode($missionId);
		$missionInfo = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$missionId)));
		
		if($missionInfo['Mission']['sponsor_id'] == $_SESSION['Auth']['User']['id']){ // Sponsor is not changed during edit mission
			
			//Update sponsor info with mission
			$missionArr = array();
			$missionArr['Mission']['id'] = $missionId;
			$missionArr['Mission']['sp_accept'] = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'));
			$this->Mission->save($missionArr);
			
			$this->Session->setFlash('Mission accepted successfully.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'users','action'=>'welcome_sponsor'));
		} else{
			$this->Session->setFlash('You are not a sponsor of this mission.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'users','action'=>'welcome_sponsor'));
		}
			
	}
	
	/**
	@function: mission_completed
	@description:	Complete the mission by sponsor
	@Created by: 	Vikas Uniyal
	@Modify: Jul. 19, 2013	
	@Created Date:	Jul. 11, 2013
	*/
	function mission_completed($missionId=NULL, $userId=NULL,$note_dummyId = null){
		$missionId = base64_decode($missionId);
		if(isset($note_dummyId)){
			$missionArr = array();
			$missionArr['Mission']['id'] = $missionId;
			$missionArr['Mission']['sp_note'] = $this->data['Mission']['sp_note'];
			//pr($missionArr); die;
			$this->Mission->save($missionArr);
			$this->Session->setFlash('Note has been added.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'users','action'=>'welcome_sponsor'));
		}else{
			//pr($this->data); die;
			$missionArr = array();
			$missionArr['Mission']['id'] = $missionId;
			$missionArr['Mission']['sp_complete'] = 1;
			$missionArr['Mission']['sp_complete_note'] = $this->data['Mission']['sp_complete_note'];
			$missionArr['Mission']['sp_complete_date'] = date('Y-m-d H:i:s');
			$missionArr['Mission']['sp_complete_rating'] = $this->data['Mission']['sp_complete_rating'];
			//pr($missionArr); die;
			$this->Mission->save($missionArr);
			$this->Session->setFlash('Mission marked as completed.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'users','action'=>'welcome_sponsor'));
		}
		//pr($this->data['Mission']['sp_rating']); die;
	}
	
	/** 
	@function : update_ratings 
	@description : Update rating of an mission by ajax,
	@params : NULL
	@Created by : Sunny Chauhan
	@Modify : NULL
	@Created Date : July. 19, 2013
	*/
	function update_ratings($activity_id=NULL, $rating=NULL) {
		$this->layout = '';
		$this->data['Mission']['id'] = $activity_id;
		$this->data['Mission']['sp_rating'] = $rating;
		$this->Mission->save($this->data);	
		exit;
	}
	
	/**
	@function: copy_shared_mission
	@description		Copy the shared mission for GM
	@params:		Mission id
	@Created by: 		Vikas Uniyal
	@Modify:		
	@Created Date:		Oct. 14, 2013
	*/
	function copy_shared_mission($mission_id=NULL){
		$this->layout = false;
		$this->autoRender = false;
		
		$adminInfo = $this->Mission->findById($mission_id);
		$adminInfo['Mission']['id'] = NULL;
		$adminInfo['Mission']['title'] = $adminInfo['Mission']['title'].' (Copy)';
		$adminInfo['Mission']['edited_by'] = NULL;
		$adminInfo['Mission']['shared_with'] = NULL;
		$this->Mission->create(); // Create a new record
		$this->Mission->save($adminInfo); //Save new copied record
		
		//Copy K2S for the mission
		$all_K2S = $this->KeyToSuccess->find('all',array('conditions'=>array('KeyToSuccess.mission_id'=>$mission_id)));
		$newMissionId = $this->Mission->getLastInsertId();
		if(!empty($all_K2S)){
			foreach($all_K2S as $copy_k2s){
				$copy_k2s['KeyToSuccess']['id'] = NULL;
				$copy_k2s['KeyToSuccess']['mission_id'] = $newMissionId;
				$this->KeyToSuccess->create(); // Create a new record
				$this->KeyToSuccess->save($copy_k2s); //Save new copied record
			}
		}
		
		$this->Session->setFlash('Mission copies successfully.', 'default', array('class' => 'flash_success'));
		$this->redirect(array('controller'=>'groups','action'=>'shared_mission'));
	}
	
	function allSponsors(){
		$sponsors = $this->SponsorManager->find('all',array('conditions'=>array('SponsorManager.manager_id'=>$_SESSION['Auth']['User']['id'],'User.id <>'=>NULL)));
		return $sponsors;
		
	}
	
	function deleteSponsor($id = null) {
	  $this->autoRender = false;
	  if($this->SponsorManager->delete($id)){
		return 1;
	  }
	}
	
	
	function sponsorStatus($id = null) {
	//$this->autoRender = false;
	//pr($id);die;
	 $this->loadModel('Mission');
	 $sponsors = $this->Mission->find('first',array('recursive'=>-1,'conditions'=>array('Mission.id'=>$id)));
	 //pr($sponsors);   die;
		if($sponsors['Mission']['sp_complete'] == 1){
		       $status = 'Completed';
		}elseif($sponsors['Mission']['sp_accept'] != '' ){
		       $status = 'Accepted';
		}else{
		       $status = 'Activated';	
		}
	 return $status;
	}
  }//end class
?>