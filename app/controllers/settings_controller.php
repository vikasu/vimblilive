<?php
/*
	* Settings Controller class
	* PHP versions 5.1.4
	* @filesource
	* @author     Sandeep Verma
	* @link       http://www.smartdatainc.net/
	* @version 0.0.1.3 
*/
App::import('Sanitize');
class SettingsController extends AppController{

	var $name 	= 'Settings';
	var $uses 	= array('ConnectionCoverage','ActivityPerformance','ScheduleBalance','Mission','UserReflection','LifeValueDetail', 'LifeValue','StrengthValue','CoreValue','User','Setting','Activity','ActivityType','Connection','ConnectionGroup','ConnectionPhone','ConnectionEmail','ConnectionAddress','ConGroupRelation','Communication','Timezone','ImportEmail','CalendarEvent','Message','FlagSetting');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('GoogleCal','RequestHandler','Cookie','Email','Auth','Upload','Common','Import');
	 
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(($this->params['action'] != 'admin_login') && (@$this->params['prefix'] == 'admin'))
		{
		    $this->Auth->allow('sign_up','export_connections');
		} else {
		       $this->Auth->allow('export_connections');
		}
	    
	    }
	
	
	/** 
	@function : index 
	@description : list all activities
	@params : NULL
	@Created by :Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 14, 2012
	*/ 
	function index($id, $from=NULL){
		//pr($id);pr($from);die;
		//pr($this->Session->read('Auth.User'));DIE;
		
		//$this->render('Element/foundation/core');
		//If comming from change password first time
		/*Take user to change pass tab*/
		$_SESSION['Connection']['stValSave'] = 0;
		if($from != ""){
			$this->set('changePass',1);
		}
		
		$id = base64_decode($id);
		//prx($id);die;
		$this->set('heading','Settings');
		//pr($this->data); exit;
		$this->loadModel('RatingWeightage');
		$user_weightage = $this->RatingWeightage->find('first',array('conditions'=>array('RatingWeightage.user_id'=>$_SESSION['Auth']['User']['id'])));
		$this->set('user_weightage',$user_weightage);  //setting data for rating weightage
		
		$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id'])));
		$this->set(compact('userInfo'));
		
		if(empty($this->data)) {
			//pr($this->data); die;
			//set activities and place it in other to elseif blocks
			$workHrsDetails = $this->ScheduleBalance->find('all',array('conditions'=>array('ScheduleBalance.user_id'=>$id)));
			$this->set(compact('workHrsDetails'));
			
			$selectedDayArr = array();
			foreach($workHrsDetails as $row){
				$selectedDayArr[$row['ScheduleBalance']['day']]['start'] = $row['ScheduleBalance']['start'];
				$selectedDayArr[$row['ScheduleBalance']['day']]['end'] = $row['ScheduleBalance']['end'];
			}
			$this->set(compact('selectedDayArr'));
			
			//set missions and place it in other to elseif blocks
			$missionDetail = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$id)));
			$this->set(compact('missionDetail'));
			
			//set activities and place it in other to elseif blocks
			$activityList = $this->Activity->find('all',array('conditions'=>array('Activity.activity_owner'=>$id)));
			$this->set(compact('activityList'));
			
			//set communications and place it in other to elseif blocks
			$user_communication = $this->Communication->find('first',array('conditions'=>array('Communication.user_id'=>$id)));
			$this->set(compact('user_communication'));
			
			
			//set activities and place it in other to elseif blocks
			$settingDetails = $this->Setting->find('first',array('conditions'=>array('Setting.user_id'=>$id)));
			$this->set(compact('settingDetails'));
			
			//set connectionCoverage and place it in other to elseif blocks
			$connectionCoverage = $this->ConnectionCoverage->find('first',array('conditions'=>array('ConnectionCoverage.user_id'=>$id)));
			$this->set(compact('connectionCoverage'));
			
			$this->Connection->recursive = 2;
			$conInfo = $this->Connection->find('first',array('conditions'=>array('Connection.id'=>$id),'recursive'=>2));
			$this->set(compact('conInfo'));

			//set user bio-data
			$this->User->id = $id;
			$this->data = $this->User->read();
			
			//set saved core values
			$find_core_values = $this->CoreValue->find('all', array('conditions'=>array('CoreValue.user_id'=>$id))); 
			unset($find_core_values[0]['CoreValue']['id']);
			unset($find_core_values[0]['CoreValue']['user_id']);
			$selected_core_values = isset($find_core_values[0]['CoreValue']) && is_array($find_core_values[0]['CoreValue']) ?  array_values($find_core_values[0]['CoreValue']) : '';
			$this->set('selected_core_values', $selected_core_values);
			
			//set saved strength values
			$find_strength_values = $this->StrengthValue->find('first', array('conditions'=>array('StrengthValue.user_id'=>$id),'order'=>array('StrengthValue.created DESC'))); 
			//prx($find_strength_values);die;
			$stValArr = array();
			for($i=1; $i<=7; $i++)
			{
				if($find_strength_values['StrengthValue'][$i] != ""){
					$stValArr[]=trim($find_strength_values['StrengthValue'][$i]);
					$this->data['StrengthValue'][$i] = $find_strength_values['StrengthValue'][$i];
				}
			}
			$this->data['StrengthValue']['rating'] = $find_strength_values['StrengthValue']['rating'];
			$this->data['StrengthValue']['notes'] = $find_strength_values['StrengthValue']['notes'];
			$this->data['StrengthValue']['attachment'] = $find_strength_values['StrengthValue']['attachment'];
			$this->data['StrengthValue']['created'] = $find_strength_values['StrengthValue']['created'];
			//pr($this->data); die;
			$this->set(compact('stValArr'));
			
			unset($find_strength_values[0]['StrengthValue']['id']);
			unset($find_strength_values[0]['StrengthValue']['user_id']);
			$selected_strength_values = isset($find_strength_values[0]['StrengthValue']) && is_array($find_strength_values[0]['StrengthValue']) ?  array_values($find_strength_values[0]['StrengthValue']) : '';
			$this->set('selected_strength_values', $selected_strength_values);
			
			// set strengthValues data as history 16 july 2013
			$history_strength_values = $this->StrengthValue->find('all',array('conditions'=>array('StrengthValue.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>array('StrengthValue.created DESC')));
			
			//unset($history_strength_values[0]);
			$this->set(compact('history_strength_values'));
			//pr($history_strength_values); die;
			//set live values data
			$selectedLifeValues = $this->LifeValue->find('all', array('conditions'=>array('LifeValue.user_id'=>$id)));
			$selectedLifeValuesDetails = $this->LifeValueDetail->find('all', array('conditions'=>array('LifeValueDetail.user_id'=>$id)));
			$this->set(array('selectedLifeValues'=>$selectedLifeValues, 'selectedLifeValuesDetails'=>$selectedLifeValuesDetails));
			
			//timezones
			$timezones = $this->Timezone->find('list',array('conditions'=>array(),'fields'=>array('Timezone.id','Timezone.timezone_location'),'order'=>'Timezone.timezone_location ASC'));
			$this->set(compact('timezones'));
			//pr($timezones); die;
		
		} elseif(isset($this->data['CoreValue']) && !empty($this->data['CoreValue'])){
			/* Other settings or tabs- Starts */
			//set missions and place it in other to elseif blocks
			$missionDetail = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$id)));
			$this->set(compact('missionDetail'));
			
			//set activities and place it in other to elseif blocks
			$activityList = $this->Activity->find('all',array('conditions'=>array('Activity.activity_owner'=>$id)));
			$this->set(compact('activityList'));
			
			//set communications and place it in other to elseif blocks
			$user_communication = $this->Communication->find('first',array('conditions'=>array('Communication.user_id'=>$id)));
			$this->set(compact('user_communication'));
			
			
			//set activities and place it in other to elseif blocks
			$settingDetails = $this->Setting->find('first',array('conditions'=>array('Setting.user_id'=>$id)));
			$this->set(compact('settingDetails'));
			
			//set connectionCoverage and place it in other to elseif blocks
			$connectionCoverage = $this->ConnectionCoverage->find('first',array('conditions'=>array('ConnectionCoverage.user_id'=>$id)));
			$this->set(compact('connectionCoverage'));
			
			$this->Connection->recursive = 2;
			$conInfo = $this->Connection->find('first',array('conditions'=>array('Connection.id'=>$id),'recursive'=>2));
			$this->set(compact('conInfo'));

			/* Other settings or tabs- Ends */
			$submitted_core_values = $this->data['CoreValue'];
			
			//set user data
			$this->User->id = $id;
			$this->data = $this->User->read();
			//pr($this->data); die;
			//set strength values
			$find_strength_values = $this->StrengthValue->find('all', array('conditions'=>array('StrengthValue.user_id'=>$id))); 
			unset($find_strength_values[0]['StrengthValue']['id']);
			unset($find_strength_values[0]['StrengthValue']['user_id']);
			$selected_strength_values = isset($find_strength_values[0]['StrengthValue']) && is_array($find_strength_values[0]['StrengthValue']) ?  array_values($find_strength_values[0]['StrengthValue']) : '';
			$this->set('selected_strength_values', $selected_strength_values);
			//set Core submitted values
			$this->set('selected_core_values', array_values(array_filter($submitted_core_values)));
			
			//set live values data
			$selectedLifeValues = $this->LifeValue->find('all', array('conditions'=>array('LifeValue.user_id'=>$id)));
			$selectedLifeValuesDetails = $this->LifeValueDetail->find('all', array('conditions'=>array('LifeValueDetail.user_id'=>$id)));
			$this->set(array('selectedLifeValues'=>$selectedLifeValues, 'selectedLifeValuesDetails'=>$selectedLifeValuesDetails));
		
			//pr(array_filter($this->data['CoreValue'])); exit;
		} elseif(isset($this->data['StrengthValue']) && !empty($this->data['StrengthValue'])){
			//pr($this->data); die;
			
			//Find attachment/Rating/Notes from last record
		/*	$exist = $this->StrengthValue->find('first',array('conditions'=>array('StrengthValue.user_id'=>$_SESSION['Auth']['User']['id'])));
			if(!empty($exist)){
				$otherVal['attachment'] = $exist['StrengthValue']['attachment'];
				$otherVal['rating'] = $exist['StrengthValue']['rating'];
				$otherVal['notes'] = $exist['StrengthValue']['notes'];
				
				//fetch existing val
				for($cnt=1; $cnt <=7; $cnt++){
					if($exist['StrengthValue'][$cnt] != "")
					$oldVals[$cnt] = $exist['StrengthValue'][$cnt];
				}
				//pr($oldVals); 
			}  */
			//pr($otherVal); 
			//------//
			//pr($this->data); die;
			
			$submitted_strength_values = $this->data['StrengthValue'];
			//pr($submitted_strength_values);
			//set user data
			$this->User->id = $id;
			$this->data = $this->User->read();
			//pr($this->data); die;
			//set core values
			$find_core_values = $this->CoreValue->find('all', array('conditions'=>array('CoreValue.user_id'=>$id))); 
			unset($find_core_values[0]['CoreValue']['id']);
			unset($find_core_values[0]['CoreValue']['user_id']);
			$selected_core_values = isset($find_core_values[0]['CoreValue']) && is_array($find_core_values[0]['CoreValue']) ?  array_values($find_core_values[0]['CoreValue']) : '';
			$this->set('selected_core_values', $selected_core_values);
			//set submitted Strength values
			$this->set('selected_strength_values', array_values(array_filter($submitted_strength_values)));
			
			$submitted_strength = array(); $key = 1;
			foreach($submitted_strength_values as $stArr=>$stVal)
			{
			  if(trim($stVal) != '0' AND trim($stVal) != '')//Value is string '0'
			  {
			    $submitted_strength['StrengthValue'][$key] = $stVal;
			    $key++;
			  }
			}
			$submitted_strength['StrengthValue']['user_id'] = $_SESSION['Auth']['User']['id'];
			//pr($submitted_strength); die;
			//$indexStart = (count($oldVals) != 0)?count($oldVals):1;
			
		/*	foreach($submitted_strength['StrengthValue'] as $newSt){
				if((in_array($newSt, $oldVals) == false) AND ($indexStart <7)){
					$indexStart = $indexStart+1;
					$newVal[$indexStart] = $newSt;
				}
			}
			
			$submitted_strength['StrengthValue'] = $oldVals+$newVal+$otherVal;
			//Delete old strengths
			//$this->StrengthValue->deleteAll(array('StrengthValue.user_id'=>$_SESSION['Auth']['User']['id']), true);
		*/	
			//Save new Strengths
			//$submitted_strength['StrengthValue']['user_id'] = $_SESSION['Auth']['User']['id'];
			//pr($submitted_strength); 
			$this->StrengthValue->save($submitted_strength);
			$this->redirect($this->referer());
			//set live values data
			$selectedLifeValues = $this->LifeValue->find('all', array('conditions'=>array('LifeValue.user_id'=>$id)));
			$selectedLifeValuesDetails = $this->LifeValueDetail->find('all', array('conditions'=>array('LifeValueDetail.user_id'=>$id)));
			$this->set(array('selectedLifeValues'=>$selectedLifeValues, 'selectedLifeValuesDetails'=>$selectedLifeValuesDetails));
			
		} 
		
		if($this->RequestHandler->isAjax()==0)
			$this->layout = 'individual_dashboard';
		else
			$this->layout = 'ajax';
		
		$this->paginate = array(
			'limit' => 20,
			'order' => array(
				'Setting.id' => 'DESC'
			)
		);

		$this->set('pagetitle',"Settings");                
		//$this->set('activityList', $this->paginate('Settings',$criteria));
		
		$this->loadModel('Transaction');
		$this->loadModel('SubscriptionPlan');
		$current_user_trans=$this->Transaction->find('first',array('conditions'=>array('Transaction.user_id'=> $this->Session->read('Auth.User.id')),'order'=>'Transaction.id DESC'));
		$this->set('current_user_trans',$current_user_trans);	 
		//echo '<pre>'; print_r($current_user_trans);
		
	}
	
	
	/** 
	@function : update_ratings 
	@description : Update rating of an activity,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function update_ratings($activity_id=NULL, $rating=NULL) {
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';	
			$this->data['Activity']['id'] = $activity_id;
			$this->data['Activity']['rating'] = $rating;
			if($this->Activity->save($this->data)) {
				echo json_encode('Rating Update Successfully');
				exit;
			}else{
				echo json_encode('Please try again');
				exit;
			}
		}
	}
	
	
	/** 
	@function : update_bio_info 
	@description : Update Bio of user,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function update_bio_info($id) {
		
		 //$this->autoRender = false;
		$id = base64_decode($id);
		
		if(!empty($this->data )) { //pr($this->data); die;
			//pr($this->data); die;
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			$this->data['User']['id'] = $id;
			unset($this->data['ChangePass']);
			//pr($this->data['User']['email']);
			//pr($this->data['User']['email']); die;
			
			if($this->Auth->user('email')!=$this->data['User']['secondaryemail']) {
				if($this->User->validates()) {
			
				
				/*if(is_uploaded_file($this->data['User']['file']['tmp_name']))
				{
				    $fileName=$this->data['User']['file']['name'];
				    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
				   
				    $this->data['User']['image']='image'.time().'.'.$ext;   
				   
				   
				    App::import('Lib','resize');   
				    $image = new ImageResize();
		       
				    move_uploaded_file($this->data['User']['file']['tmp_name'],'files/user/original/'.$this->data['User']['image']);
				    $image->resize('files/user/original/'.$this->data['User']['image'],'files/user/medium/'.$this->data['User']['image'],'aspect_fill',208,139,0,0,0,0);
			       } */
				
					$this->User->save($this->data, array('validate'=>false));
					$this->Session->setFlash('Bio information has been saved successfully.','default',array('class'=>'flash_success'));
					$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
				}
			}else{
			$this->Session->setFlash('Back-up email address should be different from primary email.','default',array('class'=>'flash_error'));
			$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
			}
		}else{
			$this->data=$this->User->read();
			//pr($this->data); die;
		}
	}
	
	/** 
	@function : update_core_values 
	@description : Update Core Values of a user,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function update_core_values($id) {
		$id = base64_decode($id);
		if(!empty($this->data )) {
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			unset($this->data['ChangePass']);
			$this->data['CoreValue']['user_id'] = $id;
			//pr($this->data); exit;
			if($this->CoreValue->validates()) {
				$this->CoreValue->deleteAll(array('CoreValue.user_id' => $id));
				$this->CoreValue->saveAll($this->data, array('validate'=>false));
				$this->Session->setFlash('Core values has been saved successfully.','default',array('class'=>'flash_success'));
				$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
			}
		}
	}
	
	/** 
	@function : update_strength_values 
	@description : Update Strength Values of a user,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function update_strength_values($id) {
		$id = base64_decode($id);
		$this->autoRender = false;
		//prx($id); die;
		if(!empty($this->data)) {
			
			//Find attachment from last record
			//$exist = $this->StrengthValue->find('first',array( 'order' => array('StrengthValue.created DESC')));
			//pr($exist); die;
		#	if(!empty($exist)){
		#		$submitted_strength['StrengthValue']['attachment'] = $exist['StrengthValue']['attachment'];
		#	}
			//prx($this->data);die;
			
			$submitted_strength = array();
			
			foreach($this->data['StrengthValue'] as $stArr=>$stVal)
			{
				//pr($stVal); die;
				if(!is_array($stVal)){
					if($stVal != '0' AND $stVal != '')//Value is string '0'
					{ 
					  $submitted_strength['StrengthValue'][$stArr] = $stVal;
					}
				}
			}
			$submitted_strength['StrengthValue']['user_id'] = $_SESSION['Auth']['User']['id'];
			
			//Delete old strengths
			//$this->StrengthValue->deleteAll(array('StrengthValue.user_id'=>$_SESSION['Auth']['User']['id']), true);
			
			//pr($submitted_strength);
			//pr($this->data); die;
			if(is_uploaded_file($this->data['StrengthValue']['file']['tmp_name']))
			{
				$fileName=$this->data['StrengthValue']['file']['name'];
				$fileName_change = explode( '.', $fileName );
				//pr($fileName[0]); die;
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				//pr($ext);  die;
				$this->data['StrengthValue']['attachment']=$fileName_change[0].'_'.time().'.'.$ext;   
				$submitted_strength['StrengthValue']['attachment']=$fileName_change[0].'_'.time().'.'.$ext;   
				//App::import('Lib','resize');   
				//$image = new ImageResize();
				
				move_uploaded_file($this->data['StrengthValue']['file']['tmp_name'],'files/strength/'.$submitted_strength['StrengthValue']['attachment']);
			}
			//prx($submitted_strength); die;
			if($this->StrengthValue->save($submitted_strength)){
				$_SESSION['Connection']['stValSave']=1;
			}
			
			$this->Session->setFlash('Strength values has been saved successfully.','default',array('class'=>'flash_success'));
			$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
			
		}
	}
	
	/** 
	@function : update_life_values 
	@description : Update Life Values of a user,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function update_life_values($id) {
		$id = base64_decode($id);
		if(!empty($this->data )) {
			//pr($this->data); exit;
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			$submitted_data = $this->data['LifeValue'];
			//pr($submitted_data); exit;
			foreach($submitted_data as $key=>$val){
				if($val['current'] ==1 && is_array($val)){
					$save_life_value[$key]['LifeValue']['user_id'] = $id;
					$save_life_value[$key]['LifeValue']['life_value_title'] = $key;
					$save_life_value[$key]['LifeValue']['time_duration'] = 1;
				} elseif($val['monthly'] == 1 && is_array($val)){
					$save_life_value[$key]['LifeValue']['user_id'] = $id;
					$save_life_value[$key]['LifeValue']['life_value_title'] = $key;
					$save_life_value[$key]['LifeValue']['time_duration'] = 2;
				} else {
					$save_life_value_details['LifeValueDetail']['user_id'] = $id;
					$save_life_value_details['LifeValueDetail']['notes'] = $submitted_data['notes'];
					$save_life_value_details['LifeValueDetail']['rating'] = $submitted_data['rating'];
				}
			}
			//pr(array_values($save_life_value)); exit;
			//pr(array_values($save_life_value)); echo 'here<br>'; pr($save_life_value_details);  exit;
			if($this->LifeValue->validates() && $this->LifeValueDetail->validates()) {
				$this->LifeValue->deleteAll(array('LifeValue.user_id' => $id));
				$this->LifeValue->create();
				$this->LifeValue->saveAll(array_values($save_life_value), array('validate'=>false));
				$this->LifeValueDetail->deleteAll(array('LifeValueDetail.user_id' => $id));
				$this->LifeValueDetail->saveAll($save_life_value_details, array('validate'=>false));

				$this->Session->setFlash('Life values has been saved successfully.','default',array('class'=>'flash_success'));
				$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
			}
			
		}
	}
	
	
	/** 
	@function : update_password 
	@description : Update Strength Values of a user,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function update_password($id) {
		$id = base64_decode($id);
		if(!empty($this->data)) {
			pr($this->data); 
 			//find timezone info and save user's data
			if($this->data['User']['timezone'] != $_SESSION['Auth']['User']['timezone']){
				$zoneInfo = $this->Timezone->find('first',array('conditions'=>array('Timezone.id'=>$this->data['User']['timezone'])));
				//pr($zoneInfo);
				$udata = array();
				
				if($this->data['User']['dst']==1) {
					$udata['User']['dst'] = 1;
				}else{
					$udata['User']['dst'] = 0;		
				}
				//pr($udata['User']['dst']); die;
				$udata['User']['id'] = $_SESSION['Auth']['User']['id'];
				$udata['User']['timezone'] = $zoneInfo['Timezone']['id'];
				$udata['User']['timezone_diff'] = $zoneInfo['Timezone']['difference_in_seconds'];
				
				//pr($_SESSION['Auth']['User']['id']); die;
				$this->User->save($udata);
				
				//Update local time for all activities to new timzone
				$this->updateLocalTime($zoneInfo['Timezone']['id']);
				//die;
			}else{
		
				$zoneInfo = $this->Timezone->find('first',array('conditions'=>array('Timezone.id'=>$this->data['User']['timezone'])));
				
				$udata = array();
				if($this->data['User']['dst']==1) {
					$udata['User']['dst'] = 1;
				}else{
					$udata['User']['dst'] = 0;		
				}
				//pr($udata['User']['dst']); die;
				$udata['User']['id'] = $_SESSION['Auth']['User']['id'];
				$udata['User']['timezone'] = $zoneInfo['Timezone']['id'];
				$udata['User']['timezone_diff'] = $zoneInfo['Timezone']['difference_in_seconds'];
				$this->User->save($udata);
				
				//Update local time for all activities to new timzone
				$this->updateLocalTime($zoneInfo['Timezone']['id']);
			}
			//timesone update :: End
			
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			$this->User->id = $id;
			//pr($this->data); exit;
			$user_details = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
			//$user_details = array();
			//$this->loadModel('User');
			$submitted_data = $this->data;
			//pr($user_details);
			if(($submitted_data['User']['old_password'] != "") OR ($submitted_data['User']['new_password'] != "") OR ($submitted_data['User']['confirm_password'] != "")){
				if($submitted_data['User']['new_password'] == $submitted_data['User']['confirm_password']) {
					$submitted_data['User']['old_password'] = $this->Auth->password($submitted_data['User']['old_password']);
					//pr($submitted_data['User']['old_password']);
					//pr($user_details['User']['password']);die;
					if($user_details['User']['password'] == $submitted_data['User']['old_password']) {
						$user_details['User']['password'] = $this->Auth->password($submitted_data['User']['new_password']);
						$this->User->save($user_details);
						//pr($user_details); die;
						$this->Session->setFlash('User info updated successfully.','default',array('class'=>'flash_success'));
						//$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
						//$this->redirect($this->referer());
						if($_SESSION['Auth']['User']['user_type'] == 1){ //Individual
							$this->redirect(array('controller' => 'users', 'action' => 'welcome'));	
						}elseif($_SESSION['Auth']['User']['user_type'] == 2){ //Group
							$this->redirect(array('controller' => 'groups', 'action' => 'dashboard'));
						}else{ //Sponsor
							$this->redirect(array('controller' => 'users', 'action' => 'welcome_sponsor'));
						}
					} else{
						$this->Session->setFlash('Old password incorrect.','default',array('class'=>'flash_error'));
						//$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
						$this->redirect($this->referer());
					}
				}else{
					$this->Session->setFlash('Password & confirm password fields do not match.','default',array('class'=>'flash_error'));
					//$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
					$this->redirect($this->referer());
				}
			}else{
				$this->Session->setFlash('User info updated successfully.','default',array('class'=>'flash_success'));
				$this->redirect($this->referer());
			}
		}
	}
	
	/** 
	@function : updateLocalTime 
	@description : Update local-time for all activities of user,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jun. 27, 2013
	*/
	function updateLocalTime($zoneId = Null){
		$userId = $_SESSION['Auth']['User']['id'];
		
		//Update Activities
		$myAct = $this->Activity->find('all',array('conditions'=>array('Activity.activity_owner'=>$userId),'fields'=>array('Activity.id','Activity.activity_owner','Activity.full_start_time','Activity.full_end_time')));
		foreach($myAct as $act){
			$actArr = array();
			$actArr['Activity']['id'] = $act['Activity']['id'];
			$actArr['Activity']['local_start'] = $this->Common->userTime($zoneId,$act['Activity']['full_start_time']);
			$actArr['Activity']['local_end'] = $this->Common->userTime($zoneId,$act['Activity']['full_end_time']);
			
			$this->Activity->save($actArr);
		}
		
		//Update Reflection
		$myRef = $this->UserReflection->find('all',array('conditions'=>array('UserReflection.user_id'=>$userId),'fields'=>array('UserReflection.id','UserReflection.reflection_date','UserReflection.local_reflection_date')));
		foreach($myRef as $ref){
			$refArr = array();
			$refArr['UserReflection']['id'] = $ref['UserReflection']['id'];
			$refArr['UserReflection']['local_reflection_date'] = $this->Common->userTime($zoneId,$ref['UserReflection']['reflection_date']);
			
			$this->UserReflection->save($refArr);
		}
		
		//Update Emails
		$myMail = $this->ImportEmail->find('all',array('conditions'=>array('ImportEmail.user_id'=>$userId),'fields'=>array('ImportEmail.id','ImportEmail.email_date','ImportEmail.local_email_date')));
		foreach($myMail as $mail){
			$mailArr = array();
			$mailArr['ImportEmail']['id'] = $mail['ImportEmail']['id'];
			$mailArr['ImportEmail']['local_email_date'] = $this->Common->userTime($zoneId,$mail['ImportEmail']['email_date']);
			
			$this->ImportEmail->save($mailArr);
		}

		//Update Calendar Events
		$myEvent = $this->CalendarEvent->find('all',array('conditions'=>array('CalendarEvent.user_id'=>$userId),'fields'=>array('CalendarEvent.id','CalendarEvent.user_id','CalendarEvent.start_time','CalendarEvent.end_time')));
		foreach($myEvent as $event){
			$eventArr = array();
			$eventArr['CalendarEvent']['id'] = $event['CalendarEvent']['id'];
			$eventArr['CalendarEvent']['local_start'] = $this->Common->userTime($zoneId,$event['CalendarEvent']['start_time']);
			$eventArr['CalendarEvent']['local_end'] = $this->Common->userTime($zoneId,$event['CalendarEvent']['end_time']);
			
			$this->CalendarEvent->save($eventArr);
		}
		
		//Update Messages
		$myMessage = $this->Message->find('all',array('conditions'=>array('Message.from_user_id'=>$userId),'fields'=>array('Message.id','Message.from_user_id','Message.local_message_time')));
		foreach($myMessage as $message){
			$messageArr = array();
			$messageArr['Message']['id'] = $message['Message']['id'];
			$messageArr['Message']['local_message_time'] = $this->Common->userTime($zoneId,$message['Message']['created']);
			$this->ImportEmail->save($messageArr);
		}
		
	}
	
	/** 
	@function : export_data 
	@description : Update Strength Values of a user,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function export_data() {
		$this->Connection->recursive = 2;
		//$this->Connection->unbindModel(array('hasMany'=>array('MissionConnection')));
		//$all_connections = $this->Connection->find('all', array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('Connection.id','Connection.name','Connection.id'))); 
		//pr($all_connections); exit;
		$perform_action = array_values(array_filter($this->data['Export']));
		$date = date('m/d/Y h:i:s a', time());
		//pr($perform_action); exit;
		if($perform_action[0] == 'activity_info') {
			$csv_output = "";
			$csv_output .= "Title;Description;Activity-Type-Title;Activity-Type-Description;Start-Time;End-Time;Rating;Created;\n";
			//pr($all_activities); exit;
			$all_activities = $this->Activity->find('all', array('conditions'=>array('Activity.activity_owner'=>$_SESSION['Auth']['User']['id']))); 
			foreach($all_activities as $faq){
			   $csv_output .= "\"".$faq['Activity']['title']."\"".";";
			   $csv_output .= "\"".$faq['Activity']['description']."\"".";";
			   $csv_output .= "\"".$faq['ActivityType']['title']."\"".";";
			   $csv_output .= "\"".$faq['ActivityType']['description']."\"".";";
			   $csv_output .= "\"".$faq['Activity']['start_time']."\"".";";
			   $csv_output .= "\"".$faq['Activity']['end_time']."\"".";";
			   $csv_output .= "\"".$faq['Activity']['rating']."\"".";";
			   $csv_output .= "\"".$faq['Activity']['created']."\""."\n";
			   $filename = 'activities_'.$date;
				
			}
		} elseif($perform_action[0] == 'reflection_info'){
			$csv_output = "";
			$csv_output .= "Reflection-date;Title;Description;Question-1;Question-2;Question-3;Rating-today;Rating-Tomorrow;Captured-Image;Captured-Voice;Captured-Video;File-Name;Owner-name;Owner-Email;Status;Created;Modified\n";
			
			$all_reflections = $this->UserReflection->find('all', array('conditions'=>array('UserReflection.user_id'=>$_SESSION['Auth']['User']['id']))); 
			//pr($all_reflections); exit;
			foreach($all_reflections as $faq){
			   $csv_output .= "\"".$faq['UserReflection']['reflection_date']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['title']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['description']."\"".";";
			   $csv_output .= "\"".$faq['Question_1']['question']."\"".";";
			   $csv_output .= "\"".$faq['Question_2']['question']."\"".";";
			   $csv_output .= "\"".$faq['Question_3']['question']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['rating_today']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['rating_tomorrow']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['captured_image']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['captured_voice']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['captured_video']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['file_name']."\"".";";
			    $csv_output .= "\"".$faq['User']['name']."\"".";";
			   $csv_output .= "\"".$faq['User']['email']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['status']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['created']."\"".";";
			   $csv_output .= "\"".$faq['UserReflection']['modified']."\""."\n";
			   $filename = 'reflections_'.$date;
		
			}
		}elseif($perform_action[0] == 'connection_info'){
			$csv_output = "";
			$csv_output .= "Title;ConnectionPhone;ConnectionEmail;ConnectionAddress;Connection-Groups\n";
			$this->Connection->recursive = 2;
			$this->Connection->unbindModel(array('hasMany'=>array('MissionConnection')));
			$all_connections = $this->Connection->find('all', array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('Connection.id','Connection.name','Connection.id'))); 
			//pr($all_connections); exit;
			foreach($all_connections as $faq){
				if($faq['Connection']['source'] == 1)
					$source = 'Gmail';
				elseif($faq['Connection']['source'] == 2)
					$source = 'Yahoo';
				elseif($faq['Connection']['source'] == 1)
					$source = 'HotMail';
				else
					$source = 'Undefined';
			   $emails = $phones = $addresses = $all_conn_groups = '';
			   foreach($faq['ConnectionPhone'] as $phone){
				$phones .= $phone['phone']."\n";
			   }
			    foreach($faq['ConnectionEmail'] as $email){
				$emails .= $email['email']."\n";
			   }
			    foreach($faq['ConnectionAddress'] as $address){
				$addresses .= $address['address']."\n";
			   }
			   foreach($faq['ConGroupRelation'] as $conn_group){
				$all_conn_groups .= $conn_group['ConnectionGroup']['title']."\n";
			   }
			   //echo $emails; exit;
			   $csv_output .= "\"".$faq['Connection']['name']."\"".";";
			   $csv_output .= "\"".$phones."\"".";";
			   $csv_output .= "\"".$emails."\"".";";
			   $csv_output .= "\"".$addresses."\"".";";
			   $csv_output .= "\"".$all_conn_groups."\""."\n";
			   $filename = 'connections_'.$date;
			   
			}
		}elseif($perform_action[0] == 'all_data'){
			$csv_output = "ALL-ACTIVITIES:\n";
			$csv_output .= "Title;Description;Activity-Type-Title;Activity-Type-Description;Start-Time;End-Time;Rating;Created;\n";
			$all_activities = $this->Activity->find('all', array('conditions'=>array('Activity.activity_owner'=>$_SESSION['Auth']['User']['id']))); 
			$all_reflections = $this->UserReflection->find('all', array('conditions'=>array('UserReflection.user_id'=>$_SESSION['Auth']['User']['id']))); 
			$this->Connection->recursive = 2;
			$this->Connection->unbindModel(array('hasMany'=>array('ConGroupRelation','MissionConnection')));
			$all_connections = $this->Connection->find('all', array('condition'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']))); 
			//pr(); die;
			foreach($all_activities as $activity){
			   //activities data
			   $csv_output .= "\"".$activity['Activity']['title']."\"".";";
			   $csv_output .= "\"".$activity['Activity']['description']."\"".";";
			   $csv_output .= "\"".$activity['ActivityType']['title']."\"".";";
			   $csv_output .= "\"".$activity['ActivityType']['description']."\"".";";
			   $csv_output .= "\"".$activity['Activity']['start_time']."\"".";";
			   $csv_output .= "\"".$activity['Activity']['end_time']."\"".";";
			   $csv_output .= "\"".$activity['Activity']['rating']."\"".";";
			   $csv_output .= "\"".$activity['Activity']['created']."\""."\n";
			   
			}
			$csv_output .= "\nALL-REFLECTIONS\n";
			$csv_output .= "Reflection-date;Title;Description;Question-1;Question-2;Question-3;Rating-today;Rating-Tomorrow;Captured-Image;Captured-Voice;Captured-Video;File-Name;Owner-name;Owner-Email;Status;Created;Modified\n";
			
			foreach($all_reflections as $reflection){
			//reflections data
			   $csv_output .= "\"".$reflection['UserReflection']['reflection_date']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['title']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['description']."\"".";";
			   $csv_output .= "\"".$reflection['Question_1']['question']."\"".";";
			   $csv_output .= "\"".$reflection['Question_2']['question']."\"".";";
			   $csv_output .= "\"".$reflection['Question_3']['question']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['rating_today']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['rating_tomorrow']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['captured_image']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['captured_voice']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['captured_video']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['file_name']."\"".";";
			   $csv_output .= "\"".$reflection['User']['name']."\"".";";
			   $csv_output .= "\"".$reflection['User']['email']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['status']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['created']."\"".";";
			   $csv_output .= "\"".$reflection['UserReflection']['modified']."\""."\n";
			   
			}
			//$csv_output .= "\nALL-CONNECTIONS:\n";
			//$csv_output .= "Title;Description;DOB;Strength;ConnectionPhone;ConnectionEmail;ConnectionAddress;Connection-Groups\n";
			
			/* foreach($all_connections as $faq){
			  //connections data
			  if($faq['Connection']['source'] == 1)
					$source = 'Gmail';
				elseif($faq['Connection']['source'] == 2)
					$source = 'Yahoo';
				elseif($faq['Connection']['source'] == 1)
					$source = 'HotMail';
				else
					$source = 'Undefined';
			   $emails = $phones = $addresses = $all_conn_groups = '';
			   foreach($faq['ConnectionPhone'] as $phone){
				$phones .= $phone['phone']."\n";
			   }
			    foreach($faq['ConnectionEmail'] as $email){
				$emails .= $email['email']."\n";
			   }
			    foreach($faq['ConnectionAddress'] as $address){
				$addresses .= $address['address']."\n";
			   }
			   foreach($faq['ConGroupRelation'] as $conn_group){
				$all_conn_groups .= $conn_group['ConnectionGroup']['title']."\n";
			   }
			   //echo $emails; exit;
			   $csv_output .= "\"".$faq['Connection']['name']."\"".";";
			   $csv_output .= "\"".$faq['Connection']['description']."\"".";";
			   $csv_output .= "\"".$faq['Connection']['dob']."\"".";";
			   $csv_output .= "\"".$faq['Connection']['strength']."\"".";";
			   $csv_output .= "\"".$phones."\"".";";
			   $csv_output .= "\"".$emails."\"".";";
			   $csv_output .= "\"".$addresses."\"".";";
			   $csv_output .= "\"".$all_conn_groups."\""."\n";
			   
			}*/
			$filename = 'all_data_'.$date;
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: csv" . date("Y-m-d") . ".csv");
		header( "Content-disposition: filename=".$filename.".csv");
		print $csv_output;
		exit;
	}
	
	/** 
	@function : export_connections 
	@description : Update Strength Values of a user,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Aug. 02, 2013
	*/
	function export_connections($id) {
		//$id = $_SESSION['Auth']['User']['id'];
		$this->loadModel('User');
		$this->layout=false;
		$this->autoRender=false;
		$current_user_info = $this->User->find('first',array(
						       'conditions'=>array('User.id'=>$id),
						       'fields'=>array('User.email','User.name')
						       ));
		$data =" Name;Phone;Email;Group \n";
		//$data .="\n"; // Add blank row
		$this->Connection->recursive = 2;
		$this->Connection->unbindModel(array('hasMany'=>array('ConnectionAddress','MissionConnection')));
		$allConData = $this->Connection->find('all',array('conditions'=>array('Connection.user_id'=>$id),'fields'=>array('Connection.id','Connection.name')));
		//pr($allConData); die;
		foreach($allConData as $reflection)
		{
				// checking condition for availability of description
				if(empty($reflection['Connection']['name'])){
					$reflection['Connection']['name'] = 'N/A';
				}
				
				// checking condition for availability of phone
				$phone = array();
				foreach($reflection['ConnectionPhone'] as $ref_attendy){
					$phone[] = $ref_attendy['phone'];
					//$attendies[] = $act_attendy['attendy_display_name'];
				}
				
				// making all phone array value as comma separated
				$phone = implode(',',$phone);
				if(empty($phone)){
					$phone = 'N/A';
				}
				
				// checking condition for availability of email
				$email = array();
				foreach($reflection['ConnectionEmail'] as $ref_attendy){
					$email[] = $ref_attendy['email'];
					//$attendies[] = $act_attendy['attendy_display_name'];
				}
				
				// making all email array value as comma separated
				$email = implode(',',$email);
				if(empty($email)){
					$email = 'N/A';
				}
				
				// checking condition for availability of phone
				$group = array();
				foreach($reflection['ConGroupRelation'] as $ref_attendy){
					$group[] = $ref_attendy['ConnectionGroup']['title'];
					//$attendies[] = $act_attendy['attendy_display_name'];
				}
				
				// making all phone array value as comma separated
				$group = implode(',',$group);
				if(empty($group)){
					$group = 'N/A';
				}
				// creating data for csv
				$data .= $reflection['Connection']['name'].";";
				$data .= $phone.";";
				$data .= $email.";";
				$data .= $group."\n";
		}//pr($data); die;
		$filename ="Connections_Listing".$id.".csv";
		$fp = fopen('files/user'.DS.$filename,"w");
		if($fp){
			fwrite($fp,$data);
			fclose($fp);
		}
		$path = 'http://vimbli.com/settings/export_data_after_login/'.$filename;
		//mail("sdd.sdei@gmail.com",'connections','apache'); die;
		//$path = SITE_URL.'settings/export_data_after_login/'.$filename;
		$this->Email->from = INFO_EMAIL;
		//$this->Email->to = "sdd.sdei@gmail.com";
		$this->Email->to = $current_user_info['User']['email'];
		$template = $this->Common->getEmailTemplate(24);
		$this->Email->sendAs= 'html';
		$this->Email->subject = $template['EmailTemplate']['subject'];
		$description = $template['EmailTemplate']['description'];
		$description = str_replace('{NAME}',$current_user_info['User']['name'],$description);
		$description = str_replace('{FILENAME}',$filename,$description);
		$description = str_replace('{LINK}',$path,$description);
		$this->set('data',$description);
		$this->Email->template='commanEmailTemplate';
		$this->Email->send();
	}
	
	/** 
	@function : bk_export_data 
	@description : Export All data for Individual
	@params : NULL
	@Created by : Sunny chauhan
	@Modify : NULL
	@Created Date : Aug. 06, 2013
	*/
	
	public function bk_export_connections(){
		$this->autoRender = false;
		$command = "php /srv/www/htdocs/app/webroot/cron_dispatcher.php /settings/export_connections/".$_SESSION['Auth']['User']['id'];
		exec($command."> /dev/null &");
		$this->Session->setFlash('Vimbli is preparing your export. When complete we will send you a link to the email.','default',array('class'=>'flash_success'));
		$this->redirect($this->referer());
	}
	
	/**
	@function:delete_strength 
	@description		delete strength
	@Created by: 		sunny chauhan
	@Modify:		NULL
	@Created Date:		july. 16, 2013
	*/
	function export_data_after_login($filename=null){
  		$this->autoRender = false;
		if($_SESSION){
			$this->redirect('http://vimbli.com/files/user'.DS.$filename);
		}
		
	}
	
	
    /** 
	@function : update_schedule_balance 
	@description : Update Schedule Balance of a user,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function update_schedule_balance($id) {
		$id = base64_decode($id);
		if(!empty($this->data )) {
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			$submitted_data = $this->data['ScheduleBalance'];
			//pr($submitted_data); exit;
			foreach($submitted_data as $key=>$val){
				$valid_data = array_filter($val);
				if(!empty($valid_data) && is_array($valid_data)){
					$save_schedule_balance[$key]['ScheduleBalance']['user_id'] = $id;
					$save_schedule_balance[$key]['ScheduleBalance']['day'] = $key;
					$save_schedule_balance[$key]['ScheduleBalance']['start'] = $val['start'];
					$save_schedule_balance[$key]['ScheduleBalance']['end'] = $val['end'];
				}
			} 
			//pr(array_values($save_schedule_balance)); exit;
			$userInfoArr = array();
			$userInfoArr['User']['id'] = $_SESSION['Auth']['User']['id'];
			$userInfoArr['User']['exclude_keywords'] = $this->data['User']['exclude_keywords'];
			$this->User->save($userInfoArr);
			if($this->ScheduleBalance->validates()) {
				$this->ScheduleBalance->deleteAll(array('ScheduleBalance.user_id' => $id));
				$this->ScheduleBalance->create();
				$this->ScheduleBalance->saveAll(array_values($save_schedule_balance), array('validate'=>false));
				$this->Session->setFlash('Schedule balance has been saved successfully.','default',array('class'=>'flash_success'));
				$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
			}
			
		}
	}
	
	/** 
	@function : delete_account 
	@description : Update Strength Values of a user,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function delete_account($id) {
		$id = base64_decode($id);
		if(!empty($this->data )) { 
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			//pr($this->data); exit;
			$this->data['User']['id'] = $id;
			$perform_actions = array_values(array_filter($this->data['User']));
			//pr($perform_actions); die;
			if($perform_actions[0] == 'delete') {
				$this->User->deleteAll(array('User.id' => $id));
				$this->Session->setFlash('Account deleted successfully.','default',array('class'=>'flash_success'));
				$this->redirect(array('controller' => 'users', 'action' => 'sign_up'));	
			}else{
				$this->Session->setFlash('Invalid selection.','default',array('class'=>'flash_error'));
				$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
			}
			
		}
	}
	
	/**
	@function:activity_performance 
	@description		Add Activity
	@Created by: 		Sandeep Verma
	@Modify:		NULL
	@Created Date:		Dec. 19, 2012
	*/
	function activity_performance($id=null){ 
  		$id = base64_decode($id);
		if(!empty($this->data)){    
			$submitted_data = array_values($this->data['ActivityPerformance']);
			foreach($submitted_data as $key=>$val){
				if($val['goal'] !='' && $val['keywords'] !=''){
					$save_activity_performance[$key]['ActivityPerformance']['user_id'] = $id;
					$save_activity_performance[$key]['ActivityPerformance']['activity_id'] = $val['activity_id'];
					$save_activity_performance[$key]['ActivityPerformance']['goal'] = trim($val['goal']);
					$save_activity_performance[$key]['ActivityPerformance']['keywords'] = trim($val['keywords']);
				} else {
					unset($val[$key]);
				}
			}
				
			if($this->ActivityPerformance->deleteAll(array('ActivityPerformance.user_id' => $id))) {
				$this->ActivityPerformance->saveAll($save_activity_performance);
				$this->Session->setFlash('Activity Performance has been saved successfully.', 'default', array('class' => 'flash_success'));
				$this->redirect('index/'.base64_encode($_SESSION['Auth']['User']['id']));
				
			} else{
				$errorArray = $this->ActivityPerformance->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	/**
	@function:activity_performance 
	@description		Add Activity
	@Created by: 		Sandeep Verma
	@Modify:		NULL
	@Created Date:		Dec. 19, 2012
	*/
	function update_settings($id=null){ 
  		$id = base64_decode($id);
		if(!empty($this->data)){    
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			//pr($this->data); exit;
			$this->data['Setting']['user_id'] = $id;
				
			if($this->Setting->deleteAll(array('Setting.user_id' => $id))) {
				$this->Setting->save($this->data);
				$this->Session->setFlash('Performance Activity/reflection settings has been saved successfully.', 'default', array('class' => 'flash_success'));
				$this->redirect('index/'.base64_encode($_SESSION['Auth']['User']['id']));
				
			} else{
				$errorArray = $this->Setting->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	/**
	@function:activity_performance 
	@description		Add Activity
	@Created by: 		Sandeep Verma
	@Modify:		NULL
	@Created Date:		Dec. 19, 2012
	*/
	function connection_coverage($id=null){ 
  		$id = base64_decode($id);
		if(!empty($this->data)){    
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			//pr($this->data); exit;
			$this->data['ConnectionCoverage']['user_id'] = $id;
				
			if($this->ConnectionCoverage->save($this->data)) {
				$this->Session->setFlash('Connection coverage has been saved successfully.', 'default', array('class' => 'flash_success'));
				$this->redirect('index/'.base64_encode($_SESSION['Auth']['User']['id']));
			} else{
				$errorArray = $this->ConnectionCoverage->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	function update_communication($id=null){
		$id = base64_decode($id);
		if(!empty($this->data)){
			//pr($this->data);die;
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			$this->data['Communication']['user_id'] = $id;
			$submitted_data = $this->data;
			foreach($submitted_data['Communication'] as $key=>$val){
				if(is_array($val)){
					foreach($val as $time_key=>$time_val) {
						if($time_val != ''){
							$save_communication_array['Communication'][$time_key] = $time_val;
						}
					}
					
				} else{
					$save_communication_array['Communication'][$key] = $val;
					
				}
				
			}
			//pr($save_communication_array); exit;
			if($this->Communication->save($save_communication_array, array('validate'=>false) )) {
				$this->Session->setFlash('Communication details has been saved successfully.', 'default', array('class' => 'flash_success'));
				$this->redirect('index/'.base64_encode($_SESSION['Auth']['User']['id']));
			} else{
				$errorArray = $this->ConnectionCoverage->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	/**
	@function:delete_strength 
	@description		delete strength
	@Created by: 		sunny chauhan
	@Modify:		NULL
	@Created Date:		july. 16, 2013
	*/
	function delete_strength($id=null){
  		$id = base64_decode($id);
		$this->autoRender = false;
		$this->loadModel('StrengthValue');
		if($this->StrengthValue->delete($id)){
		    $_SESSION['Connection']['stValSave']=1;
		}
		$this->Session->setFlash('Strength value has been deleted.', 'default', array('class' => 'flash_success'));
		$this->redirect($this->referer());
		
	}
	
	/**
	@function:delete_strength 
	@description		delete strength
	@Created by: 		sunny chauhan
	@Modify:		NULL
	@Created Date:		july. 16, 2013
	*/
	function manage_rating_weightage($id=null){
  		$id = base64_decode($id);
		$this->autoRender = false;
		$this->loadModel('RatingWeightage');
			$user_weightage = $this->RatingWeightage->find('first',array('conditions'=>array('RatingWeightage.user_id'=>$id),'fields'=>array('RatingWeightage.id')));
			if(!empty($user_weightage)){
				$this->RatingWeightage->id = $user_weightage['RatingWeightage']['id'];
			}
			if($this->RatingWeightage->save($this->data)){
					$this->Session->setFlash('Rating Weightage has been updated.', 'default', array('class' => 'flash_success'));
					$this->redirect($this->referer());
			}
	}
	
	
  }//end class
?>