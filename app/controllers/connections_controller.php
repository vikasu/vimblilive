<?php
/*
	* Customers Controller class
	* PHP versions 5.1.4
	* @filesource
	* @author     Vikas Uniyal
	* @link       http://www.smartdatainc.net/
	* @version 0.0.1.3 
*/
App::import('Sanitize');
class ConnectionsController extends AppController{

	var $name 	= 'Connections';
	var $uses 	= array('Connection','ConnectionGroup','ConnectionPhone','ConnectionEmail','ConnectionAddress','ConGroupRelation','CalendarEvent','EventAttendy','ImportEmail','SyncDetail','Cron','Process','DeletedItem','Mission','MissionConnection');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('GoogleCal','RequestHandler','Cookie','Email','Auth','Upload','Common','Import','Getmail');
	 
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(($this->params['action'] != 'admin_login') && (@$this->params['prefix'] == 'admin'))
		{
		    $this->Auth->allow('sign_up','oauthVendor','saveEmails');
		} else {
		       $this->Auth->allow('oauthVendor','saveEmails','saveGoogleMail','oauthRefresh','googleEvent','googleContact','testCron','syncInBackground','refreshTokenBackProcess','immediate_fetch','bg_con_sync','sync_connection_background','revokeToken');
		}
	    
	    }
	
	
	/** 
	@function : index 
	@description : list all connections
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 14, 2012
	*/ 
	function index($id){
		$this->loadModel('User');
		$date = $this->User->find('first',array('fields'=>array('User.last_con_update'),'conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id'])));
		$this->set('date',$date['User']['last_con_update']);
		//Fetch the status of immediate/first sync
		$firstSyncProcess = $this->Process->find('first',array('conditions'=>array('Process.user_id'=>$_SESSION['Auth']['User']['id'],'Process.title'=>'first_sync')));
		$this->set(compact('firstSyncProcess'));
		
		$bgConSyncProcess = $this->Process->find('first',array('conditions'=>array('Process.user_id'=>$_SESSION['Auth']['User']['id'],'Process.title'=>'bg_con_sync')));
		$this->set(compact('bgConSyncProcess'));
		
		
		$id = base64_decode($id);
		/** for paging and sorting we are setting values */
		if(empty($this->data)){
			if(isset($this->params['named']['searchin']))
				$this->data['Search']['searchin']=$this->params['named']['searchin'];
			else
				$this->data['Search']['searchin']='';
	
			if(isset($this->params['named']['keyword']))
				$this->data['Search']['keyword']=$this->params['named']['keyword'];
			else
				$this->data['Search']['keyword']='';
			if(isset($this->params['named']['showtype']))
				$this->data['Search']['show']=$this->params['named']['showtype'];
			else
				$this->data['Search']['show']='';				
		}
		$adminData=array();
		$adminData=$this->Session->read('SESSION_ADMIN');
		$this->set('adminData', $adminData);
		$value = '';		
		$show = '';				
		$criteria=' 1 ';
		$flag = '';
		$criteria .= " and Connection.user_id = '".$id."'";
		$matchshow = '';
		$fieldname = '';
		$this->set('show',20);
		/* SEARCHING */
		$reqData = $this->data;
		$options['name'] = "Name";
		$options['email'] = "Email";
		$showArr = $this->getStatus();
		$this->set('showArr',$showArr);
		$this->set('options',$options);
		//All group listing
		//$allGroups = $this->ConnectionGroup->find('list',array('conditions'=>array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),'fields'=>array('ConnectionGroup.id','ConnectionGroup.title')));
		$allGroups = $this->ConnectionGroup->find('list',array('conditions'=>array("OR"=>array(array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),array('ConnectionGroup.group_owner'=>$_SESSION['Auth']['User']['id'], 'ConnectionGroup.status'=>1))),'fields'=>array('ConnectionGroup.id','ConnectionGroup.title')));
		$this->set(compact('allGroups'));
		if(!empty($this->data['Search'])){
			//pr($this->data); die;
			if(empty($this->data['Search']['searchin'])){
				$fieldname = 'All';
			} else {
				$fieldname = $this->data['Search']['searchin'];
			}
			$value = $this->data['Search']['keyword'];
			$show = $this->data['Search']['show'];
			if($show == 'Active'){
				$matchshow = '1';
			}
			if($show == 'Deactive'){
				$matchshow = '0';
			}
			
			// sanitze the search data
			
			$value1 = Sanitize::escape($value);
			
			if($value1 !="") {
				if(trim($fieldname)=='All'){
					$criteria .= " and (Connection.name LIKE '%".$value1."%')";
					$emailcriteria = " ConnectionEmail.email LIKE '%".$value1."%'";
					$flag = 1;
					
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							if($fieldname == 'name'){
								$criteria .= " and Connection.".$fieldname." LIKE '%".$value1."%'";
								$flag = 2;
							}
							else{
								$flag = 3;
								$emailcriteria = " ConnectionEmail.".$fieldname." LIKE '%".$value1."%'";
							}
					
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and Connection.status = '".$matchshow."'";
					$this->set('show',$show);
				}
			}
			
		}
		
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','Connection Groups');
		
		/** sorting and search */
		if($this->RequestHandler->isAjax()==0)
			$this->layout = 'individual_dashboard';
		else
			$this->layout = 'ajax';
		
		$this->set('keyword', $value);
		$this->set('fieldname',$fieldname);
		
		/* ******************* page limit sction **************** */
		$sess_limit_name = $this->params['controller']."_limit";
		$sess_limit_value = $this->Session->read($sess_limit_name);
		if(!empty($this->data['Record']['limit'])){
			$limit = $this->data['Record']['limit'];
			$this->Session->write($sess_limit_name , $this->data['Record']['limit'] );
		}elseif(!empty($sess_limit_value)){
			$limit = $sess_limit_value;
		}else{
			$limit = $this->rec_limit_in_admin;  // set default value
		}
		$this->data['Record']['limit'] = $limit;
		/* ******************* page limit sction ********$this->set("keyword",$value);
			******** */
		
		
		$this->paginate = array(
			'limit' => 40,
			'recursive' => 2
			
		);
		//pr($this->Connection->find('all')); exit;
		$this->set('pagetitle',"Connection Listing");
		//if criteria is for all
		if($flag == 1) {
			$email_conn_listing = $this->paginate('ConnectionEmail',$emailcriteria);
			
			foreach($email_conn_listing as $connection) {
				$all_connection_id[] = $connection['ConnectionEmail']['connection_id'];
			}
			
			$find_connection_list = $this->Connection->find('all', array('conditions'=>array('Connection.id'=>$all_connection_id, 'Connection.user_id' =>$id, 'Connection.status' => '1' )));
			//pr($email_conn_listing);
			$name_conn_listing = $this->paginate('Connection',$criteria);
			$final_conn_list = array_merge($name_conn_listing,$find_connection_list );
		} elseif($flag ==2) {
			//if criteria is for seraching name
			$this->paginate = array(
				'limit' => 40,
				'recursive' => 2,
				'order' => array(
					'Connection.name' => 'ASC'
				),
				'group' => array(
					'Connection.contact_id'
				)
			);
			
			$final_conn_list = $this->paginate('Connection',$criteria);
		} elseif($flag ==3) {
			//if criteria is for seraching email
			$this->paginate = array(
				'limit' => 40,
				'recursive' => 2,
				'order' => array(
					'ConnectionEmail.email' => 'ASC'
				),
				'group' => array(
					'Connection.contact_id'
				)
			);
			$email_conn_list = $this->paginate('ConnectionEmail',$emailcriteria);
			
			foreach($email_conn_list as $connection) {
				$all_connection_id[] = $connection['ConnectionEmail']['connection_id'];
			}
			//pr($all_connection_id); 
			$final_conn_list = $this->Connection->find('all', array('conditions'=>array('Connection.id'=>$all_connection_id, 'Connection.user_id' =>$id, 'Connection.status' => '1' )));
			
		} else { 
			$this->paginate = array(
				'limit' => 40,
				'recursive' => 2,
				'order' => array(
					'Connection.name' => 'ASC'
				),
				'group' => array(
					'Connection.contact_id'
				)
			);
			
			$final_conn_list = $this->paginate('Connection',$criteria);
		}
		
		$this->set('conLists', $final_conn_list);
		//pr($final_conn_list); die;
	}
	
	
	/** 
	@function : connection_detail
	@description : list all connections
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 14, 2012
	*/ 
	function connection_detail($id){
		$this->set('pagetitle','Connections');
		$this->layout = "individual_dashboard";
		$this->set(compact('id'));
		$id = base64_decode($id);
	   
		$conInfo = $this->Connection->find('first',array('conditions'=>array('Connection.id'=>$id),'recursive'=>2));
		//pr($conInfo); exit;
		$this->set(compact('conInfo'));
	}
	
	/** 
	@function : set_import_info
	@description : list all connections
	@params : NULL
	@Created by :Sandeep Verma
	@Modify : NULL
	@Created Date : Jan. 22, 2012
	*/ 
	function set_import_info(){
		//echo '<pre>'; print_r($_SESSION); die;
		//Used in welcome function
		$user_last_login = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('User.id','User.last_accessed')));
		//pr($user_last_login); die;
		if($user_last_login['User']['last_accessed'] == '0000-00-00 00:00:00'){
			$_SESSION['change_pass'] = 1;
		}
		
		//If GM changed the status to inactive
		if($_SESSION['Auth']['User']['status'] == 0){
			$this->Cookie->destroy('Auth');
			$this->Session->delete('user_email');
			$this->Session->delete('first_login');
			$this->Session->delete('Connection');
			$this->Session->delete('Schedule');
			$this->Session->setFlash('Your account exists but is not active. Please contact your Group Manager if you believe this is an error.', 'default', array('class' => 'flash_success'));
			$this->redirect($this->Auth->logout());
		}
		
		//If user have sync detail, send him to dashboard
		$syncDetail = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		if($syncDetail['SyncDetail']['oauth_json_response'] != ""){
			$this->redirect(array('controller'=>'users','action'=>'welcome'));
		}
		
		$this->set('pagetitle','Import Connections');
		//$this->layout = "inner_pages";
		$this->layout = 'individual_dashboard';
		if(!empty($this->data))
		{ //echo'here'; exit;
			//pr($this->data); die;
			$this->Session->time =  3600*24;  
			$this->Session->write('Connection.source', $this->data['Connection']['source']);
			$this->Session->write('Connection.email', $this->data['Connection']['email']);
			$this->Session->write('Connection.password', base64_encode($this->data['Connection']['password']));
			$this->Session->write('Connection.current_time', time());
			
			//Send request for auth token
			$gmailToken = $this->Import->getGmailToken(trim($this->data['Connection']['email']),$this->data['Connection']['password']);
			//pr($gmailToken); die;
			if(!isset($gmailToken['Error'])) {
				$existedInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
				//Save user info in table
				//pr($existedInfo); die;
				$connectionInfo = array();
								
				if(!empty($existedInfo)){
					$connectionInfo['SyncDetail']['id'] = $existedInfo['SyncDetail']['id'];
				} else{
					$connectionInfo['SyncDetail']['id'] = '';
				}
				
				if($this->data['Connection']['source'] == 'gmail')
					$this->data['Connection']['source'] = 1;
				else if($this->data['Connection']['source'] == 'yahoo')
					$this->data['Connection']['source'] = 2;
				else
					$this->data['Connection']['source'] = 3;
				//pr($existedInfo); die;
				//Save key for contacts
				$connectionInfo['SyncDetail']['source'] = $this->data['Connection']['source'];
				$connectionInfo['SyncDetail']['link_email'] = $this->data['Connection']['email'];
				$connectionInfo['SyncDetail']['user_id'] = $_SESSION['Auth']['User']['id'];
				$connectionInfo['SyncDetail']['access_token_for_contact'] = $gmailToken['Auth'];
				
				//Cal Auth key
				$calendar = new GoogleCalComponent();
				$cal_auth_key = $calendar->__construct1(trim($this->data['Connection']['email']),$this->data['Connection']['password']);
				$connectionInfo['SyncDetail']['access_token_for_calendar'] = $cal_auth_key;
				
				$this->SyncDetail->save($connectionInfo);
				
				
				$this->redirect(array('controller'=>'users','action'=>'welcome',base64_encode($_SESSION['Auth']['User']['id'])));
			} else{
				//$this->Session->setFlash('Wrong username/password.', 'default', array('class' => 'flash_error'));
				$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));		
			}
			
		}	
	}
	
	
	/** 
	@function : import_connections 
	@description : Import connections of user
	@params : NULL
	@Created by :
	@Modify : NULL
	@Created Date : Dec. 11, 2012
	*/ 
	function import_connections($ajaxRequest=null){
		//check if connection cookie is set
		$this->layout = 'ajax';
		$this->autoRender = false;
		//$connection_cookie = $this->Session->read('Connection');
		
		$current_time = date('Y-m-d H:i:s');
		//echo  $current_time;
		//echo '<br>--'.$_SESSION['Auth']['User']['last_accessed']; die;
		$time_diff = (strtotime($current_time) - strtotime($_SESSION['Auth']['User']['last_accessed']));
		$estFinalTime = date('m',$time_diff);
		$estimated_time = $estFinalTime % 30;
		//echo date('m:s',$time_diff); exit;
		if($estimated_time == 0 || $ajaxRequest==1) {
			//echo $estimated_time.'<br>--'.$ajaxRequest; die;
			$existedInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		
			if(!empty($existedInfo)) {
				$this->data['Connection']['source'] = $existedInfo['SyncDetail']['source'];
				$this->data['Connection']['email'] = $existedInfo['SyncDetail']['link_email'];
				$this->data['Connection']['password'] = base64_decode($connection_cookie['password']);
				
				$link_email = $existedInfo['SyncDetail']['link_email'];
				$access_token = $existedInfo['SyncDetail']['access_token_for_contact'];
				
				if($existedInfo['SyncDetail']['source'] == 1)//Gmail
				{
					if($_SESSION['Connection']['email'] != "" && $_SESSION['Connection']['password'] != "" ){
						/**** Get Emails from Gmail Inbox***/
						$gmailMails = $this->Getmail->getEmails($_SESSION['Connection']['email'],base64_decode($_SESSION['Connection']['password']));
						//pr($gmailMails); exit;
						/**** Save Emails to Vimbli :: Start ***/
						$allEmails = array();
						//$this->ImportEmail->deleteAll(array('ImportEmail.user_id'=> $_SESSION['Auth']['User']['id']), true);
						$date = date ( 'Y-m-j'); 
						$initialDate = strtotime ( '-7 day' , strtotime ($date) ) ;
						$initialDate = date ( 'Y-m-j' , $initialDate );
						
						$this->ImportEmail->recursive = -1;
						$existedEmails = $this->ImportEmail->find('all',array('conditions'=>array('ImportEmail.user_id'=>$_SESSION['Auth']['User']['id'])));
						
						//pr($existedEmails); exit;
						foreach($gmailMails as $emailData){
							if(strtotime($emailData['on']) > strtotime($initialDate)) { 
								$allEmails['ImportEmail']['user_id'] = $_SESSION['Auth']['User']['id'];
								$allEmails['ImportEmail']['source'] = 1;
								$allEmails['ImportEmail']['email_subject'] = $emailData['subject'];
								$allEmails['ImportEmail']['email_uid'] = $emailData['uid'];
								$allEmails['ImportEmail']['email_from'] = $emailData['from'];
								$allEmails['ImportEmail']['email_date'] = $emailData['on'];
								$allEmails['ImportEmail']['is_read'] = $emailData['seen'];
								$allEmails['ImportEmail']['email_body'] = $emailData['body'];
								$allEmails['ImportEmail']['created'] = date('Y-m-d H:i:s');
								
								foreach($existedEmails as $exEmail_key=>$exEmail_val){
									if($exEmail_val['ImportEmail']['email_uid'] == $emailData['uid']){
										$allEmails['ImportEmail']['id'] = $exEmail_val['ImportEmail']['id'];
										$allEmails['ImportEmail']['rating'] = $exEmail_val['ImportEmail']['rating'];
										break;
									} else{
										$allEmails['ImportEmail']['id'] = '';
									}
								}
								
								//pr($allEmails); exit;
								$this->ImportEmail->create();
								$this->ImportEmail->save($allEmails);
							}
						}
					}
					/**** Save Emails to Vimbli :: End ***/
					
					
					/** Import Google Calendar **** Start****
					@author: Sandeep Verma 
					@Modified By: Vikas Uniyal (Jan. 10, 2012)*/
					//$googleCalendarEvents = $this->Import->getGmailContacts($this->data['Connection']['email'],$this->data['Connection']['password']);
					
					$existedInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
					$link_email_for_cal = $existedInfo['SyncDetail']['link_email'];
					$access_token_for_cal = $existedInfo['SyncDetail']['access_token_for_calendar'];
				
					$calendar = new GoogleCalComponent();
					$calendar->fetchCalEvents($access_token_for_cal,$link_email_for_cal,$link_email_for_cal);
					$calendar->map("location", "details");
					$calendar->enable_log(true);
					$allEventsDetail = $calendar->connect();
				
					/*$calendar = new GoogleCalComponent();
					$calendar->__construct1($this->data['Connection']['email'],$this->data['Connection']['password'],$this->data['Connection']['email']);
					$calendar->map("location", "details");
					$calendar->enable_log(true);
					$allEventsDetail = $calendar->connect();
					*/
					//pr($allEventsDetail); die;
					//Save events in vimbli db
					$eventData = array();
					$attendyData = array();
					//$this->CalendarEvent->deleteAll(array('CalendarEvent.user_id'=> $_SESSION['Auth']['User']['id']), true);
					$this->CalendarEvent->recursive = -1;
					$existedCalendarEvents = $this->CalendarEvent->find('all',array('conditions'=>array('CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'])));
						
					foreach($allEventsDetail as $event){
						$eventData['CalendarEvent']['event_id'] = $event['event_id'];
						$eventData['CalendarEvent']['user_id'] = $_SESSION['Auth']['User']['id'];
						$eventData['CalendarEvent']['title'] = $event['title'];
						$eventData['CalendarEvent']['start_time'] = $event['start_time'];
						$eventData['CalendarEvent']['end_time'] = $event['end_time'];
						$eventData['CalendarEvent']['details'] = $event['details'];
						$eventData['CalendarEvent']['creator_display_name'] = $event['creator_display_name'];
						$eventData['CalendarEvent']['creator_email'] = $event['creator_email'];
						$eventData['CalendarEvent']['created'] = $event['created'];
						$eventData['CalendarEvent']['modified'] = $event['modified'];
						foreach($existedCalendarEvents as $excalEvent_key=>$excalEvent_val){
							if($excalEvent_val['CalendarEvent']['event_id'] == $event['event_id']){
								$eventData['CalendarEvent']['id'] = $excalEvent_val['CalendarEvent']['id'];
								$eventData['CalendarEvent']['rating'] = $excalEvent_val['CalendarEvent']['rating'];
								break;
							} else{
								$eventData['CalendarEvent']['id'] = '';
							}
						}
						$this->CalendarEvent->create();
						if($this->CalendarEvent->save($eventData)){
							$eventId = $this->CalendarEvent->getLastInsertId();
							if(!empty($event['attendees'])){
								foreach($event['attendees'] as $attendy){
									$attendyData['EventAttendy']['event_id'] = $eventId;
									$attendyData['EventAttendy']['attendy_display_name'] = $attendy['atn_display_name'];
									$attendyData['EventAttendy']['attendy_email'] = $attendy['atn_email'];
									$this->EventAttendy->create();
									$this->EventAttendy->save($attendyData);
								}
							}
						}
					}
					/***** End *****/
					
					/**** Import Contacts***/
					//$gmailContacts = $this->Import->getGmailContacts($this->data['Connection']['email'],$this->data['Connection']['password']);
					$gmailContacts = $this->Import->getGmailContact($link_email,$access_token);
					
					if(isset($gmailContacts['Error']) && !empty($gmailContacts['Error'])){
						$this->Session->setFlash('Wrong email or password. Please try again.');
					}else {
						//Delete all old imported connections
						//$this->Connection->deleteAll(array('Connection.user_id'=>$_SESSION['Auth']['User']['id'],'Connection.source <>'=>0),true);
						$this->Connection->recursive = -1;
						$existedConnections = $this->Connection->find('all',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
							
						$i = 1;
						//pr($gmailContacts); exit;
						foreach($gmailContacts as $gContacts){
							$conInfoArray = array();
							$conName = ($gContacts['title'] != "")?$gContacts['title']:'N/A';
							$conInfoArray['Connection']['name'] = $conName;
							$conInfoArray['Connection']['name'] = $conName;
							$conInfoArray['Connection']['source'] = 1;
							$conInfoArray['Connection']['contact_id'] = $gContacts['id'];
							$conInfoArray['Connection']['user_id'] = $_SESSION['Auth']['User']['id'];
							$i++;
							foreach($existedConnections as $excon_key=>$excon_val){
								if($excon_val['Connection']['contact_id'] == $gContacts['id']){
									$conInfoArray['Connection']['id'] = $excon_val['Connection']['id'];
									break;
								} else{
									$conInfoArray['Connection']['id'] = '';
								}
							}
							//pr($conInfoArray); 
							$this->Connection->create();
							$this->Connection->save($conInfoArray['Connection']);
							$lastInsertId = $this->Connection->getLastInsertId();
							$connectId = isset($lastInsertId) && !empty($lastInsertId) ? $lastInsertId : $conInfoArray['Connection']['id'];
							//echo $connectId; exit;
							// save phone numbers - Starts
							$this->ConnectionPhone->deleteAll(array('ConnectionPhone.connection_id'=>$connectId));
							
							$phoneArray = array();
							if(isset($gContacts['phone']) && !empty($gContacts['phone'])) {
								foreach($gContacts['phone'] as $phone_key=>$phone_val) {
									$phone_val = ($phone_val != '') ? $phone_val : 'N/A';
									$phoneArray[$phone_key]['ConnectionPhone']['connection_id'] = $connectId;
									$phoneArray[$phone_key]['ConnectionPhone']['phone'] = $phone_val;
								}
							}
							$this->ConnectionPhone->create();
							$this->ConnectionPhone->saveAll($phoneArray);
							
							// save emails - Starts
							$this->ConnectionEmail->deleteAll(array('ConnectionEmail.connection_id'=>$connectId));
							$emailArray = array();
							if(isset($gContacts['emails']) && !empty($gContacts['emails'])) {
								foreach($gContacts['emails'] as $email_key=>$email_val) {
									$email_val = ($email_val != '') ? $email_val : 'N/A';
									$emailArray[$email_key]['ConnectionEmail']['connection_id'] = $connectId;
									$emailArray[$email_key]['ConnectionEmail']['email'] = $email_val;
								}
							}
							$this->ConnectionEmail->create();
							$this->ConnectionEmail->saveAll($emailArray);
							
							//save addresses - Starts
							$this->ConnectionAddress->deleteAll(array('ConnectionAddress.connection_id'=>$connectId));
							$addressArray = array();
							if(isset($gContacts['address']) && !empty($gContacts['address'])) {
								foreach($gContacts['address'] as $address_key=>$address_val) {
									$address_val = ($address_val != '') ? $address_val : 'N/A';
									$addressArray[$address_key]['ConnectionAddress']['connection_id'] = $connectId;
									$addressArray[$address_key]['ConnectionAddress']['address'] = $address_val;
								}
							}
							$this->ConnectionAddress->create();
							$this->ConnectionAddress->saveAll($addressArray);
							
							//save connection group
							$conGroupArr = array();
							$conGroupArr['ConGroupRelation']['connection_id'] = $connectId;
							$conGroupArr['ConGroupRelation']['group_id'] = 1; //Default Group
							$this->ConGroupRelation->create();
							$this->ConGroupRelation->save($conGroupArr);
							
						} 
						//pr( base64_encode($_SESSION['Auth']['User']['id'])); exit;
						$this->Session->write('imported',1);
						if($ajaxRequest == 1)
						{
						$this->redirect($this->referer());
						}
						else {
						echo json_encode('Data Imported'); //exit;
						//$this->redirect(array('controller'=>'connections','action'=>'index', base64_encode($_SESSION['Auth']['User']['id'])));
						}
					}//exit;
					
				}
				else if($this->data['Connection']['source'] == 'yahoo')
				{
					$this->Session->setFlash('Yet to implement.');	
				}
				else if($this->data['Connection']['source'] == 'hotmail')
				{
					$this->Session->setFlash('Yet to implement.');	
				}
			}
		} else {
			echo 'Wait for right time'; exit;
			//return false;
		}
		
	}
	
	/** 
	@function : sync_connections
	@description : Sync connections only,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 31, 2013
	*/
	function sync_connections()
	{
		$existedInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		
		if(!empty($existedInfo)){
			if($existedInfo['SyncDetail']['source'] == 3){ //Hotmail
				$this->Session->setFlash('Yet to implement.');
			}else if($existedInfo['SyncDetail']['source'] == 2){ //Yahoo
				$this->Session->setFlash('Yet to implement.');
			}else{ //Source is gmail
				$link_email = $existedInfo['SyncDetail']['link_email'];
				$access_token = $existedInfo['SyncDetail']['access_token_for_contact'];
				
				//$this->data['SyncDetail']['password'] = base64_decode($_SESSION['Connection']['password']);
				//pr($this->data); exit;
				/**** Import Contacts***/
				$gmailContacts = $this->Import->getGmailContact($link_email,$access_token);
				//pr($gmailContacts); die;
				if(isset($gmailContacts['Error']) && !empty($gmailContacts['Error'])){
					$this->Session->setFlash('Wrong email or password. Please try again.');
					$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
				}else {
					$this->Connection->recursive = -1;
					$existedConnections = $this->Connection->find('all',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
					/*
					$existedConnections = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']), 'fields'=>array('id','contact_id')));
					foreach($gmailContacts as $fetchCon_key=>$fetchCon_val){
						foreach($existedConnections as $existConection){
							if($existConection == $fetchCon_val['id']){
								unset($gmailContacts[$fetchCon_key]);
							}
						}
					}
					*/
					$i = 1;
					//pr($gmailContacts); exit;
					foreach($gmailContacts as $gContacts){
						$conInfoArray = array();
						$conName = ($gContacts['title'] != "")?$gContacts['title']:'N/A';
						$conInfoArray['Connection']['name'] = $conName;
						$conInfoArray['Connection']['name'] = $conName;
						$conInfoArray['Connection']['source'] = 1;
						$conInfoArray['Connection']['contact_id'] = $gContacts['id'];
						$conInfoArray['Connection']['user_id'] = $_SESSION['Auth']['User']['id'];
						$i++;
						foreach($existedConnections as $excon_key=>$excon_val){
							if($excon_val['Connection']['contact_id'] == $gContacts['id']){
								$conInfoArray['Connection']['id'] = $excon_val['Connection']['id'];
								$conInfoArray['Connection']['status'] = $excon_val['Connection']['status'];
								break;
							} else{
								$conInfoArray['Connection']['id'] = '';
							}
						}
						//pr($conInfoArray); 
						$this->Connection->create();
						$this->Connection->save($conInfoArray['Connection']);
						$lastInsertId = $this->Connection->getLastInsertId();
						$connectId = isset($lastInsertId) && !empty($lastInsertId) ? $lastInsertId : $conInfoArray['Connection']['id'];
						//echo $connectId; exit;
						// save phone numbers - Starts
						$this->ConnectionPhone->deleteAll(array('ConnectionPhone.connection_id'=>$connectId));
						
						$phoneArray = array();
						if(isset($gContacts['phone']) && !empty($gContacts['phone'])) {
							foreach($gContacts['phone'] as $phone_key=>$phone_val) {
								$phone_val = ($phone_val != '') ? $phone_val : 'N/A';
								$phoneArray[$phone_key]['ConnectionPhone']['connection_id'] = $connectId;
								$phoneArray[$phone_key]['ConnectionPhone']['phone'] = $phone_val;
							}
						}
						$this->ConnectionPhone->create();
						$this->ConnectionPhone->saveAll($phoneArray);
						
						// save emails - Starts
						$this->ConnectionEmail->deleteAll(array('ConnectionEmail.connection_id'=>$connectId));
						$emailArray = array();
						if(isset($gContacts['emails']) && !empty($gContacts['emails'])) {
							foreach($gContacts['emails'] as $email_key=>$email_val) {
								$email_val = ($email_val != '') ? $email_val : 'N/A';
								$emailArray[$email_key]['ConnectionEmail']['connection_id'] = $connectId;
								$emailArray[$email_key]['ConnectionEmail']['email'] = $email_val;
							}
						}
						$this->ConnectionEmail->create();
						$this->ConnectionEmail->saveAll($emailArray);
						
						//save addresses - Starts
						$this->ConnectionAddress->deleteAll(array('ConnectionAddress.connection_id'=>$connectId));
						$addressArray = array();
						if(isset($gContacts['address']) && !empty($gContacts['address'])) {
							foreach($gContacts['address'] as $address_key=>$address_val) {
								$address_val = ($address_val != '') ? $address_val : 'N/A';
								$addressArray[$address_key]['ConnectionAddress']['connection_id'] = $connectId;
								$addressArray[$address_key]['ConnectionAddress']['address'] = $address_val;
							}
						}
						$this->ConnectionAddress->create();
						$this->ConnectionAddress->saveAll($addressArray);
						
						//save connection group
						$conGroupArr = array();
						$conGroupArr['ConGroupRelation']['connection_id'] = $connectId;
						$conGroupArr['ConGroupRelation']['group_id'] = 1; //Default Group
						$this->ConGroupRelation->create();
						$this->ConGroupRelation->save($conGroupArr);
						
					} 
				}
			}
			$this->Session->setFlash('Connections sync successfully.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'connections','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
		} else{
			$this->Session->setFlash('Please enter your email/password for sync.', 'default', array('class' => 'flash_error'));
			$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
		}
	}
	
	/** 
	@function : sync_emails
	@description : Sync emails only,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 31, 2013
	*/
	function sync_emails()
	{
		//phpinfo();
		$gmailMails = $this->Getmail->getEmails($this->data['Connection']['email'],$this->data['Connection']['password']);
		
		if($_SESSION['Connection']['email'] != "" && $_SESSION['Connection']['password'] != "" ){
			if($_SESSION['Connection']['source'] == 'yahoo'){
				$this->Session->setFlash('Yet to implement.');
			}else if($_SESSION['Connection']['source'] == 'hotmail'){
				$this->Session->setFlash('Yet to implement.');
			}else{ //Source is gmail
				$this->data['Connection']['email'] = $_SESSION['Connection']['email'];
				$this->data['Connection']['password'] = base64_decode($_SESSION['Connection']['password']);
				
				/**** Get Emails from Gmail Inbox***/
				$gmailMails = $this->Getmail->getEmails($this->data['Connection']['email'],$this->data['Connection']['password']);
				//pr($gmailMails); exit;
				/**** Save Emails to Vimbli :: Start ***/
				$allEmails = array();
				//$this->ImportEmail->deleteAll(array('ImportEmail.user_id'=> $_SESSION['Auth']['User']['id']), true);
				$date = date ( 'Y-m-j'); 
				$initialDate = strtotime ( '-7 day' , strtotime ($date) ) ;
				$initialDate = date ( 'Y-m-j' , $initialDate );
				
				$this->ImportEmail->recursive = -1;
				$existedEmails = $this->ImportEmail->find('all',array('conditions'=>array('ImportEmail.user_id'=>$_SESSION['Auth']['User']['id'])));
				
				//pr($existedEmails); exit;
				foreach($gmailMails as $emailData){
					if(strtotime($emailData['on']) > strtotime($initialDate)) { 
						$allEmails['ImportEmail']['user_id'] = $_SESSION['Auth']['User']['id'];
						$allEmails['ImportEmail']['source'] = 1;
						$allEmails['ImportEmail']['email_subject'] = $emailData['subject'];
						$allEmails['ImportEmail']['email_uid'] = $emailData['uid'];
						$allEmails['ImportEmail']['email_from'] = $emailData['from'];
						$allEmails['ImportEmail']['email_date'] = $emailData['on'];
						$allEmails['ImportEmail']['is_read'] = $emailData['seen'];
						$allEmails['ImportEmail']['email_body'] = $emailData['body'];
						$allEmails['ImportEmail']['created'] = date('Y-m-d H:i:s');
						
						foreach($existedEmails as $exEmail_key=>$exEmail_val){
							if($exEmail_val['ImportEmail']['email_uid'] == $emailData['uid']){
								$allEmails['ImportEmail']['id'] = $exEmail_val['ImportEmail']['id'];
								$allEmails['ImportEmail']['rating'] = $exEmail_val['ImportEmail']['rating'];
								break;
							} else{
								$allEmails['ImportEmail']['id'] = '';
							}
						}
						
						//pr($allEmails); exit;
						$this->ImportEmail->create();
						$this->ImportEmail->save($allEmails);
					}
				}
				/**** Save Emails to Vimbli :: End ***/
			}
			$this->Session->setFlash('Emails sync successfully.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'timelines','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
		} else{
			$this->Session->setFlash('Please enter your email/password for sync.', 'default', array('class' => 'flash_error'));
			$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
		}
		
	}
	
	/** 
	@function : sync_events
	@description : Sync events only,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 31, 2013
	*/
	function sync_events()
	{
		$existedInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		
		if(!empty($existedInfo)){
			if($existedInfo['SyncDetail']['source'] == 3){
				$this->Session->setFlash('Yet to implement.');
			}else if($existedInfo['SyncDetail']['source'] == 2){
				$this->Session->setFlash('Yet to implement.');
			}else{ //Source is gmail
				
				$link_email_for_cal = $existedInfo['SyncDetail']['link_email'];
				$access_token_for_cal = $existedInfo['SyncDetail']['access_token_for_calendar'];
				
				//$this->data['Connection']['email'] = $_SESSION['Connection']['email'];
				//$this->data['Connection']['password'] = base64_decode($_SESSION['Connection']['password']);
				
				/** Import Google Calendarm **** Start*****/
				//$calendar = new GoogleCalComponent();
				//$calendar->__construct1($this->data['Connection']['email'],$this->data['Connection']['password'],$this->data['Connection']['email']);
				//$calendar->map("location", "details");
				//$calendar->enable_log(true);
				//$allEventsDetail = $calendar->connect();
				
				
				$calendar = new GoogleCalComponent();
				$calendar->fetchCalEvents($access_token_for_cal,$link_email_for_cal,$link_email_for_cal);
				$calendar->map("location", "details");
				$calendar->enable_log(true);
				$allEventsDetail = $calendar->connect();
				
				//pr($allEventsDetail); die;
				//Save events in vimbli db
				$eventData = array();
				$attendyData = array();
				//$this->CalendarEvent->deleteAll(array('CalendarEvent.user_id'=> $_SESSION['Auth']['User']['id']), true);
				$this->CalendarEvent->recursive = -1;
				$existedCalendarEvents = $this->CalendarEvent->find('all',array('conditions'=>array('CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'])));
				//pr($existedCalendarEvents); die;	
				foreach($allEventsDetail as $event){
					$eventData['CalendarEvent']['event_id'] = $event['event_id'];
					$eventData['CalendarEvent']['user_id'] = $_SESSION['Auth']['User']['id'];
					$eventData['CalendarEvent']['title'] = $event['title'];
					$eventData['CalendarEvent']['start_time'] = $event['start_time'];
					$eventData['CalendarEvent']['end_time'] = $event['end_time'];
					$eventData['CalendarEvent']['details'] = $event['details'];
					$eventData['CalendarEvent']['creator_display_name'] = $event['creator_display_name'];
					$eventData['CalendarEvent']['creator_email'] = $event['creator_email'];
					$eventData['CalendarEvent']['created'] = $event['created'];
					$eventData['CalendarEvent']['modified'] = $event['modified'];
					foreach($existedCalendarEvents as $excalEvent_key=>$excalEvent_val){
						if($excalEvent_val['CalendarEvent']['event_id'] == $event['event_id']){
							$eventData['CalendarEvent']['id'] = $excalEvent_val['CalendarEvent']['id'];
							$eventData['CalendarEvent']['rating'] = $excalEvent_val['CalendarEvent']['rating'];
							break;
						} else{
							$eventData['CalendarEvent']['id'] = '';
						}
					}
					$this->CalendarEvent->create();
					if($this->CalendarEvent->save($eventData)){
						$eventId = $this->CalendarEvent->getLastInsertId();
						if(!empty($event['attendees'])){
							foreach($event['attendees'] as $attendy){
								$attendyData['EventAttendy']['event_id'] = $eventId;
								$attendyData['EventAttendy']['attendy_display_name'] = $attendy['atn_display_name'];
								$attendyData['EventAttendy']['attendy_email'] = $attendy['atn_email'];
								$this->EventAttendy->create();
								$this->EventAttendy->save($attendyData);
							}
						}
					}
				}
				/***** End *****/
			}
			$_SESSION['filter_model'] == 'all';
			$this->Session->setFlash('Events sync successfully.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'timelines','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
		} else{
			$this->Session->setFlash('Please enter your email/password for sync.', 'default', array('class' => 'flash_error'));
			$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
		}
		
	}
	
	
	
	/*
	function CreateArray($XmlFilePath) {
		if (!file_exists($XmlFilePath)) return FALSE;
		$Class = Array();
		$Class['UsersFileXml'] = file_get_contents($XmlFilePath);
		$Class['FileXml'] = simplexml_load_string($Class['UsersFileXml']);
		$Class['FileJson'] = json_encode($Class['FileXml']);
		$Array = json_decode($Class['FileJson'],TRUE);
		unset($Class);
	
		return $Array;
	}
	*/
	
	
	/** 
	@function : activateContacts 
	@description : Activate contacts from import page,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function activateContacts()
	{
		//pr($this->data); die;
		foreach($this->data['Connection']['toActivate'] as $id):
			$status = 1;
			if($this->Common->connectionCount($_SESSION['Auth']['User']['id'])<MAX_ACTIVATED_CONNECTION)
			{ 
				$this->Connection->updateAll(array('Connection.status'=>"'$status'"),array('Connection.id'=>$id));
			} else { 
				$this->Session->setFlash('You can activate maximum 3 connections in vimbli address book.', 'default', array('class' => 'flash_error'));		
			}
		endforeach;
		$this->redirect(array('controller'=>'connections','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
	}
	
	/** 
	@function : perform_actions 
	@description : perform various action from index page,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function perform_actions()
	{
		//pr($this->data); die;
		if($this->data['Connection']['action'] == 'delete')
		{
			//pr($this->data['Connection']['ids']); 
			//$delItem = array();
			foreach($this->data['Connection']['ids'] as $ids){
				//pr($ids);
				$delItem = array();
				//pr($this->Connection->id); die;
				 $this->Connection->id = $ids;
				$item_info = $this->Connection->find('first',array('conditions'=>array('Connection.id'=>$ids)));
				//pr($item_info); die;
				$this->loadModel('DeletedItem');
				
				$delItem['DeletedItem']['user_id'] = $item_info['Connection']['user_id'];
				$delItem['DeletedItem']['item_id'] = end(explode("/",$item_info['Connection']['contact_id']));
				$delItem['DeletedItem']['item_type'] = 'Connection';
				//pr($delItem);
				$this->DeletedItem->create();
				$this->DeletedItem->save($delItem);
				$this->Connection->delete($ids,true);
			}
			//pr($delItem); die;
			$this->Session->setFlash('Connections deleted successfully', 'default', array('class' => 'flash_success'));
		}
		
		else if($this->data['Connection']['action'] == 'grouping')
		{
			foreach($this->data['Connection']['ids'] as $ids):
				$group_id = $this->data['ConGroupRelation']['group_id'];
				$existConRel = $this->ConGroupRelation->find('count',array('conditions'=>array('ConGroupRelation.group_id'=>$group_id,'ConGroupRelation.connection_id'=>$ids)));
				$relArr = array();
				if($existConRel == 0){
					$relArr['ConGroupRelation']['connection_id'] = $ids;
					$relArr['ConGroupRelation']['group_id'] = $group_id;
					$relArr['ConGroupRelation']['user_id'] = $_SESSION['Auth']['User']['id'];
					
					$this->ConGroupRelation->save($relArr); 
					$this->Session->setFlash('Connections group updated successfully.', 'default', array('class' => 'flash_success'));
				}
				
			endforeach;
		}
		
		else if($this->data['Connection']['action'] == 'activate')
		{
			foreach($this->data['Connection']['ids'] as $ids):
				$status = 1;
				if($this->Common->connectionCount($_SESSION['Auth']['User']['id'])<MAX_ACTIVATED_CONNECTION)
				{ 
					$this->Connection->updateAll(array('Connection.status'=>"'$status'"),array('Connection.id'=>$ids));
					$this->Session->setFlash('Connections activated successfully.', 'default', array('class' => 'flash_success'));
				} else { 
					$this->Session->setFlash('You can activate maximum 150 connections in vimbli address book.', 'default', array('class' => 'flash_error'));		
				}
			endforeach;
		}
		else if($this->data['Connection']['action'] == 'deactivate')
		{
			foreach($this->data['Connection']['ids'] as $ids):
				$status = 0;
				$this->Connection->updateAll(array('Connection.status'=>"'$status'"),array('Connection.id'=>$ids));
			endforeach;
			$this->Session->setFlash('Connections deactivated successfully.', 'default', array('class' => 'flash_success'));
		}
		else if($this->data['Connection']['action'] == 'view')
		{
			$this->redirect(array('controller'=>'connections','action'=>'connection_detail',base64_encode($this->data['Connection']['ids'][0])));
		}
		else if($this->data['Connection']['action'] == 'edit')
		{
			$this->Session->setFlash('Edit action is Under process.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'connections','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
		}
		
		$this->redirect(array('controller'=>'connections','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
	}
	
	
	/** 
	@function : connection_groups
	@description : list all connection group in front end
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 19, 2012
	*/ 
	function connection_groups(){
		Configure::write('debug', 2);
		//$this->layout='default';
		/** for paging and sorting we are setting values */
		if(empty($this->data)){
			if(isset($this->params['named']['searchin']))
				$this->data['Search']['searchin']=$this->params['named']['searchin'];
			else
				$this->data['Search']['searchin']='';
	
			if(isset($this->params['named']['keyword']))
				$this->data['Search']['keyword']=$this->params['named']['keyword'];
			else
				$this->data['Search']['keyword']='';
			if(isset($this->params['named']['showtype']))
				$this->data['Search']['show']=$this->params['named']['showtype'];
			else
				$this->data['Search']['show']='';
				
			
		}
		$adminData=array();
		$adminData=$this->Session->read('SESSION_ADMIN');
		$this->set('adminData', $adminData);
		$value = '';		
		$show = '';				
		$criteria=' 1 ';
		$criteria .= " and ConnectionGroup.group_owner = '".$_SESSION['Auth']['User']['id']."' OR ConnectionGroup.group_owner = 0";
		$matchshow = '';
		$fieldname = '';
		$this->set('show',20);
		/* SEARCHING */
		$reqData = $this->data;
		$options['name'] = "Name";
		$options['email'] = "Email";
		$showArr = $this->getStatus();
		$this->set('showArr',$showArr);
		$this->set('options',$options);
		if(!empty($this->data['Search'])){
			//pr($this->data); die;
			if(empty($this->data['Search']['searchin'])){
				$fieldname = 'All';
			} else {
				$fieldname = $this->data['Search']['searchin'];
			}
			$value = $this->data['Search']['keyword'];
			$show = $this->data['Search']['show'];
			if($show == 'Active'){
				$matchshow = '1';
			}
			if($show == 'Deactive'){
				$matchshow = '0';
			}
			
			// sanitze the search data
			
			$value1 = Sanitize::escape($value);
			
			if($value1 !="") {
				if(trim($fieldname)=='All'){
					$criteria .= " and (ConnectionGroup.title LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and ConnectionGroup.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and ConnectionGroup.status = '".$matchshow."'";
					$this->set('show',$show);
				}
			}
			
		}
		//pr($criteria);
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','Connection Groups');
		
		/** sorting and search */
		if($this->RequestHandler->isAjax()==0)
			$this->layout = 'individual_dashboard';
		else
			$this->layout = 'ajax';
		
		$this->set('keyword', $value);
		$this->set('fieldname',$fieldname);
		
		/* ******************* page limit sction **************** */
		$sess_limit_name = $this->params['controller']."_limit";
		$sess_limit_value = $this->Session->read($sess_limit_name);
		if(!empty($this->data['Record']['limit'])){
			$limit = $this->data['Record']['limit'];
			$this->Session->write($sess_limit_name , $this->data['Record']['limit'] );
		}elseif(!empty($sess_limit_value)){
			$limit = $sess_limit_value;
		}else{
			$limit = $this->rec_limit_in_admin;  // set default value
		}
		$this->data['Record']['limit'] = $limit;
		/* ******************* page limit sction ********$this->set("keyword",$value);
			******** */
		
		
		$this->paginate = array(
			'limit' => 20,
			'order' => array(
				'ConnectionGroup.id' => 'DESC'
			),
			'recursive'=>0
		);
		//pr($criteria);
		$this->set('pagetitle',"Connection Groups");                
		$this->set('conGroupList', $this->paginate('ConnectionGroup',$criteria));
		//pr($this->paginate('ConnectionGroup',$criteria)); die;
	}
	
	/**
	@function:add_group 
	@description		Add connection group from front
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Dec. 19, 2012
	*/
	function add_group($id=null){ 
  		$id = base64_decode($id);
		$this->layout = 'inner_pages';	
  		
		$this->set('pagetitle',"Add Connection Group");
		$this->ConnectionGroup->id = $id;
		$admin_id=0;
		if(empty($this->data)){
			$this->data = $this->ConnectionGroup->read();
		}else if(!empty($this->data)){	
			$this->ConnectionGroup->set($this->data);
			if($this->ConnectionGroup->validates()){
				//pr($this->data); die;
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
	
				$this->data['ConnectionGroup']['title'] = ucwords(strtolower($this->data['ConnectionGroup']['title']));
				$this->data['ConnectionGroup']['status'] = '1';
				$this->data['ConnectionGroup']['group_owner'] = $_SESSION['Auth']['User']['id'];

				if($this->ConnectionGroup->save($this->data)) {
					$userGroupId = $this->ConnectionGroup->getLastInsertId();						
			
						$condition=array('ConnectionGroup.id'=>$userGroupId);
						$user_group = $this->ConnectionGroup->find('first',array('conditions'=>$condition,'fields'=>array('id','title','description')));
						
						//SEND EMAIL TO ADDED USER
										
						$this->Session->setFlash('Group has been saved successfully.', 'default', array('class' => 'flash_success'));
						$this->redirect('connection_groups');
				}
				
			} else{
				$errorArray = $this->ConnectionGroup->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	/** 
	@function : group_actions 
	@description : perform various action for connection groups,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 19, 2012
	*/
	function group_actions()
	{
		//pr($this->data); die;
		if($this->data['ConnectionGroup']['action'] == 'delete')
		{
			foreach($this->data['ConnectionGroup']['ids'] as $ids){
				$this->ConnectionGroup->delete($ids, true);
			}
			$this->Session->setFlash('Group has been deleted successfully', 'default', array('class' => 'flash_success'));
		}
		
		else if($this->data['ConnectionGroup']['action'] == 'activate')
		{
			foreach($this->data['ConnectionGroup']['ids'] as $ids):
				$status = 1;
				$this->ConnectionGroup->updateAll(array('ConnectionGroup.status'=>"'$status'"),array('ConnectionGroup.id'=>$ids));
			endforeach;
			$this->Session->setFlash('Connections activated successfully.', 'default', array('class' => 'flash_success'));
		}
		else if($this->data['ConnectionGroup']['action'] == 'deactivate')
		{
			foreach($this->data['ConnectionGroup']['ids'] as $ids):
				$status = 0;
				$this->ConnectionGroup->updateAll(array('ConnectionGroup.status'=>"'$status'"),array('ConnectionGroup.id'=>$ids));
			endforeach;
			$this->Session->setFlash('Connections deactivated successfully.', 'default', array('class' => 'flash_success'));
		}
		//else if($this->data['Connection']['action'] == 'view')
		//{
		//	$this->redirect(array('controller'=>'connections','action'=>'connection_detail',base64_encode($this->data['Connection']['ids'][0])));
		//}
		else if($this->data['ConnectionGroup']['action'] == 'edit')
		{
			$this->redirect(array('controller'=>'connections','action'=>'add_group',base64_encode($this->data['ConnectionGroup']['ids'][0])));
		}
		
		$this->redirect(array('controller'=>'connections','action'=>'connection_groups'));
	}
	
	
	/** 
	@function : admin_connection_groups 
	@description : listing of categories,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 12, 2012
	*/
	
	function admin_connection_groups(){
		
		//pr($this->data); die;
		if((isset($this->data["ConnectionGroup"]["setStatus"])))
		{
			//echo 'hi'; die;
			$status = ife($_POST['active'],1,0);
			$record = $this->data["ConnectionGroup"]["Record"];
			$CheckedList=$_POST['box1'];
			$controller= $this->params['controller'];
			$action='connection_groups'; 
			$prefix='admin';
			$model='ConnectionGroup';
			$relation=null;
			
			switch($status)
			{ 
			    case '1': 
				$this->setStatus('1',$CheckedList,$model,$relation,$controller,$action,$prefix,$record); 
			    break;
			    case '0':
				$this->setStatus('0',$CheckedList,$model,$relation,$controller,$action,$prefix,$record); 
			    break; 
			}
		}
		
		/** for paging and sorting we are setting values */
		if(empty($this->data)){
			if(isset($this->params['named']['searchin']))
				$this->data['Search']['searchin']=$this->params['named']['searchin'];
			else
				$this->data['Search']['searchin']='';
	
			if(isset($this->params['named']['keyword']))
				$this->data['Search']['keyword']=$this->params['named']['keyword'];
			else
				$this->data['Search']['keyword']='';
			if(isset($this->params['named']['showtype']))
				$this->data['Search']['show']=$this->params['named']['showtype'];
			else
				$this->data['Search']['show']='';
				
			
		}
		$adminData=array();
		$adminData=$this->Session->read('SESSION_ADMIN');
		
		$this->set('adminData', $adminData);
		$value = '';		
		$show = '';				
		$criteria=' 1 ';
		$criteria .= " and ConnectionGroup.group_owner = 0"; //Show only owned by admin
		$matchshow = '';
		$fieldname = '';
		$this->set('show',10);
		/* SEARCHING */
		$reqData = $this->data;
		$options['title'] = "Name";
		$options['email'] = "Email";
		$showArr = $this->getStatus();
		$this->set('showArr',$showArr);
		$this->set('options',$options);
		if(!empty($this->data['Search'])){
			if(empty($this->data['Search']['searchin'])){
				$fieldname = 'All';
			} else {
				$fieldname = $this->data['Search']['searchin'];
			}
			$value = $this->data['Search']['keyword'];
			$show = $this->data['Search']['show'];
			if($show == 'Active'){
				$matchshow = '1';
			}
			if($show == 'Deactive'){
				$matchshow = '0';
			}
			
			// sanitze the search data
			
			$value1 = Sanitize::escape($value);
			
			if($value1 !="") {
				if(trim($fieldname)=='All'){
					$criteria .= " and (ConnectionGroup.title LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and ConnectionGroup.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and ConnectionGroup.status = '".$matchshow."'";
					$this->set('show',$show);
				}
			}
			
		}
		
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','Connection Groups');
		
		/** sorting and search */
		if($this->RequestHandler->isAjax()==0)
			$this->layout = 'admin';
		else
			$this->layout = 'ajax';
		
		$this->set('keyword', $value);
		$this->set('fieldname',$fieldname);
		
		/* ******************* page limit sction **************** */
		$sess_limit_name = $this->params['controller']."_limit";
		$sess_limit_value = $this->Session->read($sess_limit_name);
		if(!empty($this->data['Record']['limit'])){
			$limit = $this->data['Record']['limit'];
			$this->Session->write($sess_limit_name , $this->data['Record']['limit'] );
		}elseif(!empty($sess_limit_value)){
			$limit = $sess_limit_value;
		}else{
			$limit = $this->rec_limit_in_admin;  // set default value
		}
		$this->data['Record']['limit'] = $limit;
		/* ******************* page limit sction ********$this->set("keyword",$value);
			******** */
		
		//pr($criteria); die;
		$this->paginate = array(
			'limit' => $this->rec_limit_in_admin,
			'order' => array(
				'ConnectionGroup.id' => 'DESC'
			),
			'recursive'=>0
		);
		//echo 'Hey@@@';die;
		$this->set('pagetitle',"Connection Groups");                
		$this->set('conGroupList', $this->paginate('ConnectionGroup',$criteria));
		//pr($this->paginate('ConnectionGroup',$criteria)); die;
		
	}
	
	/*
	Function Name: delete_connection
	Params: NULL
	Created BY: Vikas Uniyal
	Created ON : Dec. 14, 2012
	Description : To delete Connection 
	*/
	function delete_connection($id=null){
	    $id = base64_decode($id);
	    //pr($id); die;
	    $this->Connection->id = $id;
	   // $this->Connection->delete($id,true);
            $this->Session->setFlash('Connection deleted sucessfully.','message/green');
            $this->redirect($this->referer());
        }
	
	
	/*
	Function Name: admin_list_connections
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Dec. 12, 2012
	Description : for the listing connection in a group - Admin Panel
	*/
	function admin_list_connections($id) {
	    $this->layout='admin';
	    $id = base64_decode($id);
	    
	    $this->set('pagetitle',"Connection list");
	    $this->paginate=array('order'=>'ConGroupRelation.id ASC','limit'=>20,'recursive'=>2);
	    $conLists = $this->paginate('ConGroupRelation',array('ConGroupRelation.group_id'=>$id));
	    $this->set('conLists', $conLists);
	    //pr($conLists); die;
	     
	}
	
	
	/*commented on Dec. 13, 2012 (Vikas Uniyal)
	function admin_list_connections($id){
		
		$id = base64_decode($id);
		
		if((isset($this->data["Connection"]["setStatus"])))
		{
			//pr($this->data); die;
			
			$status = ife($_POST['active'],1,0);
			$record = $this->data["Connection"]["Record"];
			$CheckedList=$_POST['box1'];
			$controller= $this->params['controller'];
			$action='list_connections/'.$id; 
			$prefix='admin';
			$model='Connection';
			$relation=null;
			
			switch($status)
			{ 
			    case '1': 
				$this->setStatus('1',$CheckedList,$model,$relation,$controller,$action,$prefix,$record); 
			    break;
			    case '0':
				$this->setStatus('0',$CheckedList,$model,$relation,$controller,$action,$prefix,$record); 
			    break; 
			}
		}
		
		
		if(empty($this->data)){
			
			//$criteria =array('conditions'=>array('ConGroupRelation.group_id'=>$id));
			
			if(isset($this->params['named']['searchin']))
				$this->data['Search']['searchin']=$this->params['named']['searchin'];
			else
				$this->data['Search']['searchin']='';
	
			if(isset($this->params['named']['keyword']))
				$this->data['Search']['keyword']=$this->params['named']['keyword'];
			else
				$this->data['Search']['keyword']='';
			if(isset($this->params['named']['showtype']))
				$this->data['Search']['show']=$this->params['named']['showtype'];
			else
				$this->data['Search']['show']='';
				
			
		}
		$adminData=array();
		$adminData=$this->Session->read('SESSION_ADMIN');
		$this->set('adminData', $adminData);
		$value = '';		
		$show = '';				
		$criteria=' 1 ';
		$matchshow = '';
		$fieldname = '';
		$this->set('show',10);
		
		//$criteria. ='ConGroupRelation.group_id'=>$id;
		$criteria .= "and ConGroupRelation.group_id = '".$id."'";
		// SEARCHING 
		$reqData = $this->data;
		$options['name'] = "Name";
		$options['email'] = "Email";
		$showArr = $this->getStatus();
		$this->set('showArr',$showArr);
		$this->set('options',$options);
		if(!empty($this->data['Search'])){
			if(empty($this->data['Search']['searchin'])){
				$fieldname = 'All';
			} else {
				$fieldname = $this->data['Search']['searchin'];
			}
			$value = $this->data['Search']['keyword'];
			$show = $this->data['Search']['show'];
			if($show == 'Active'){
				$matchshow = '1';
			}
			if($show == 'Deactive'){
				$matchshow = '0';
			}
			
			// sanitze the search data
			
			$value1 = Sanitize::escape($value);
			
			if($value1 !="") {
				if(trim($fieldname)=='All'){
					$criteria .= " and (User.name LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and User.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and User.status = '".$matchshow."'";
					$this->set('show',$show);
				}
			}
			
			
		}
		
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','Admin Users');
		
		// sorting and search 
		if($this->RequestHandler->isAjax()==0)
			$this->layout = 'admin';
		else
			$this->layout = 'ajax';
		
		$this->set('keyword', $value);
		$this->set('fieldname',$fieldname);
		
		// ******************* page limit sction 
		$sess_limit_name = $this->params['controller']."_limit";
		$sess_limit_value = $this->Session->read($sess_limit_name);
		if(!empty($this->data['Record']['limit'])){
			$limit = $this->data['Record']['limit'];
			$this->Session->write($sess_limit_name , $this->data['Record']['limit'] );
		}elseif(!empty($sess_limit_value)){
			$limit = $sess_limit_value;
		}else{
			$limit = $this->rec_limit_in_admin;  // set default value
		}
		$this->data['Record']['limit'] = $limit;
		//******************* page limit sction ********$this->set("keyword",$value);
		//	******** 
		
		
		$this->paginate = array(
			'limit' => $this->rec_limit_in_admin,
			'order' => array(
				'ConGroupRelation.id' => 'DESC'
			),
		);
		
		$this->set('pagetitle',"Manage Customers");                
		$this->set('conList', $this->paginate('ConGroupRelation',$criteria));
		//pr($this->paginate('ConGroupRelation',array('ConGroupRelation.group_id'=>$id))); die;
	}
		 */
	
	
	/*
	Function Name: admin_delete_connection
	Params: NULL
	Created BY: Vikas Uniyal
	Created ON : Dec. 13, 2012
	Description : To delete Connection - Admin Panel 
	*/
	function admin_delete_connection($id=null){
	    $id = base64_decode($id);
	    
	    $this->Connection->id = $id;
	    $this->Connection->delete($id,true);
            $this->Session->setFlash('Connection deleted sucessfully.','message/green');
            $this->redirect($this->referer());
        }
	
	
	/**
	@function:admin_add_connection_group 
	@description		Add connection group from admin panel
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Dec. 12, 2012
	*/
	function admin_add_connection_group($id=null){ 
  		$id = base64_decode($id);
		$this->layout = 'admin';	
  		//App::import('Model','EmailTemplate');
      		//$this->EmailTemplate = & new EmailTemplate();
		
		$this->set('pagetitle',"Add Connection Group");
		$this->ConnectionGroup->id = $id;
		$admin_id=0;
		if(empty($this->data)){
			$this->data = $this->ConnectionGroup->read();
		}else if(!empty($this->data)){	
			$this->ConnectionGroup->set($this->data);
			if($this->ConnectionGroup->validates()){
				
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
	
				//$this->data['ConnectionGroup']['title'] = (strtolower($this->data['ConnectionGroup']['title']));
				$this->data['ConnectionGroup']['status'] = '1';

				if($this->ConnectionGroup->save($this->data)) {
					//pr($this->data);die;
					$userGroupId = $this->ConnectionGroup->getLastInsertId();						
			
						$condition=array('ConnectionGroup.id'=>$userGroupId);
						$user_group = $this->ConnectionGroup->find('first',array('conditions'=>$condition,'fields'=>array('id','title','description')));
						
						//SEND EMAIL TO ADDED USER
										
						$this->Session->setFlash('Group has been saved successfully.','default',array('class'=>'message/green'));
						$this->redirect('connection_groups');
				}
				
			} else{
				$errorArray = $this->ConnectionGroup->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	
	/*
	Function Name: admin_delete
	Params: NULL
	Created BY: Vikas Uniyal
	Created ON : Dec. 12, 2012
	Description : To delete Product - Admin Panel 
	*/
	function admin_delete($id=null){
	    $id = base64_decode($id);
	    $this->ConnectionGroup->id = $id;
            $this->ConnectionGroup->delete($id);
	    
            $this->Session->setFlash('Connection Group deleted sucessfully.','message/green');
            $this->redirect(array('action' => 'connection_groups'));
        }
	
	
	
	/** 
	@function : 	connection 
	@description : Add Connection
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 12, 2012
	*/ 
	function add_connection($id =NULL){
		
		$this->set(compact('id'));
		$id = base64_decode($id);
		$selected = $this->ConnectionGroup->find('list',array('conditions'=>array("OR"=>array(array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),array('ConnectionGroup.group_owner'=>$_SESSION['Auth']['User']['id'], 'ConnectionGroup.status'=>1))),'recursive'=>0));
		
		$this->set('pagetitle','Add Connection');
		$this->layout = "inner_pages";
		
		$this->Connection->id = $id;
		//All group listing
		$allGroups = $this->ConnectionGroup->find('list',array('conditions'=>array("OR"=>array(array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),array('ConnectionGroup.group_owner'=>$_SESSION['Auth']['User']['id'], 'ConnectionGroup.status'=>1))),'recursive'=>0));
		
		$this->ConGroupRelation->recursive = -1;
		$linked_group_id = $this->ConGroupRelation->find('all',array('conditions'=>array('ConGroupRelation.connection_id'=>$id),'recursive'=>0));
		if(is_array($linked_group_id) && !empty($linked_group_id)) {
			foreach($linked_group_id as $gid_key=>$gid_val) {
				$relation_id[$gid_val['ConGroupRelation']['group_id']] = $gid_val['ConGroupRelation']['id'];
			}
		}
		
		//pr($relation_id);
		$this->set(compact('allGroups'));
		
		if(empty($this->data)) {
			$connection_details = $this->Connection->read();
			//pr($connection_details); exit;
			$this->set(compact('connection_details'));
		} else { //pr($this->data); exit;
			
			if(is_uploaded_file($this->data['Connection']['file']['tmp_name']))
			{
			    $fileName=$this->data['Connection']['file']['name'];
			    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
			    $this->data['Connection']['image']='Connection'.time().'.'.$ext;   
			   
			    App::import('Lib','resize');   
			    $image = new ImageResize();
	       
			    move_uploaded_file($this->data['Connection']['file']['tmp_name'],'files/connections/original/'.$this->data['Connection']['image']);
			    $image->resize('files/connections/original/'.$this->data['Connection']['image'],'files/connections/medium/'.$this->data['Connection']['image'],'aspect_fill',160,110,0,0,0,0);
		       
		       }
			$this->data['Connection']['id'] = $id;
			
			//If connection edited :: Start
			if($id != "")
			$this->data['Connection']['is_edited'] = 1;
			//If connection edited :: End

			$this->data['Connection']['user_id'] = $_SESSION['Auth']['User']['id'];
			$this->data['Connection']['source'] = 0;
			$connection_groups = $this->data['ConGroupRelation']['group_id'];
			$connection_group_relation = array();
			$delete_relation = array();
			foreach($connection_groups as $key=>$val) {
				if(array_key_exists($val['group_id'], $relation_id)) {
					$connection_group_relation[$key]['ConGroupRelation']['id'] = $val['group_id'];
					unset($relation_id[$val['group_id']]);
				} 
				$connection_group_relation[$key]['ConGroupRelation']['group_id'] = $val['group_id'];
				$connection_group_relation[$key]['ConGroupRelation']['connection_id'] = $id;
			}
			//pr($relation_id); die;
			unset($this->data['ConGroupRelation']['group_id']);
			if(is_array($relation_id) && !empty($relation_id)) {
				foreach($relation_id as $del_key=>$del_val) {
					$this->ConGroupRelation->delete($del_val);
				}
			}
			
			//pr($relation_id); exit;
			//pr($connection_group_relation); exit;
			//pr($this->Connection->updateAll($this->data)); die;
			$this->data['Connection']['dob'] = $this->data['Connection']['birth_year'].'-'.$this->data['Connection']['birth_month'].'-'.$this->data['Connection']['birth_day'];
			//pr($this->data); die;
			if($this->Connection->save($this->data)){
				//save connection group
				$this->ConGroupRelation->saveAll($connection_group_relation);
				$this->Session->setFlash('Connection added successfully', 'default', array('class' => 'flash_success'));
				$this->redirect(array('controller'=>'connections','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
			}
		}
		
	}
	
	/** 
	@function : 	save_source_in_session 
	@description : Save link-data source in session for further use
	@params : source 
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Feb. 12, 2012
	*/ 
	function save_source_in_session($source=NULL){
		if($source == 'yahoo'){
			$_SESSION['link_source'] = 2;
		} elseif($source == 'hotmail'){
			$_SESSION['link_source'] = 3;
		} else{
			$_SESSION['link_source'] = 1;
		}
	}
	
	/** 
	@function : 	oauthVendor 
	@description : Get and save oauth access token
	@params :  
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Apr. 05, 2012
	*/ 
	function oauthVendor(){
		
		$this->layout = false;
		App::import('Vendor', 'google_data_link', array('file' => 'google_data_link'.DS.'google_data_link.php'));
		$tokenInfo = get_access_token();
		/*
		echo '<pre>'; print_r($tokenInfo); echo "<br>=============<br>";
		echo "Sessions: <br>";
		print_r($_SESSION);
		die;
		*/
		
		$existId = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		//echo stripcslashes($existId['SyncDetail']['oauth_json_response']); die;
		//echo '<pre>'; print_r($existId); die;
		if($existId['SyncDetail']['id'] != ""){
			$this->data['SyncDetail']['id'] = $existId['SyncDetail']['id'];
		}
		$_SESSION['link_source'] = 1;
		$this->data['SyncDetail']['user_id'] = $_SESSION['Auth']['User']['id'];
		$this->data['SyncDetail']['source'] = $_SESSION['link_source'];
		$this->data['SyncDetail']['link_email'] = $tokenInfo['email'];
		$this->data['SyncDetail']['oauth_access_token'] = $tokenInfo['access_token'];
		$this->data['SyncDetail']['refresh_token'] = $tokenInfo['refresh_token'];
		$this->data['SyncDetail']['oauth_json_response'] = mysql_real_escape_string($tokenInfo['json_resp']);
		
		$this->SyncDetail->save($this->data);
		//$this->redirect(array('controller'=>'users','action'=>'welcome'));
		//echo '<pre>'; print_r($this->data); 
		//echo "<br>=====Session vals ========<br>";
		//$existId1 = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		//echo '<pre>'; print_r($_SESSION); die;
		
	}
	
	
	/** 
	@function : 	oauthRefresh 
	@description : Refresh oauth access token
	@params :  
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Apr. 22, 2012
	*/ 
	function oauthRefresh($function=NULL){
		//Configure::write('debug', 2);
		$this->layout = false;
		
		$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		$tokenVal = stripcslashes($syncInfo['SyncDetail']['oauth_json_response']);
		//echo $tokenVal; die;
		App::import('Vendor', 'google_refresh_token', array('file' => 'google_refresh_token'.DS.'google_refresh_token.php'));
		$tokenInfo = get_refresh_token($tokenVal);
		//echo '<pre>'; print_r($tokenInfo); die;
		$existId = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		
		$this->data['SyncDetail']['id'] = $existId['SyncDetail']['id'];
		$this->data['SyncDetail']['oauth_access_token'] = $tokenInfo['access_token'];
		$this->data['SyncDetail']['refresh_token'] = $tokenInfo['refresh_token'];
		$this->data['SyncDetail']['oauth_json_response'] = mysql_real_escape_string($tokenInfo['json_resp']);
		
		$this->SyncDetail->save($this->data);
		
		if($function == 'bg_con_sync'){
			$this->redirect(array('controller'=>'connections','action'=>'bg_con_sync'));
		} else{
			$this->redirect(array('controller'=>'connections','action'=>'chkToken',$function));
		}
		
		
	}
	
	/** 
	@function : 	chkToken 
	@description : check the existing oauth access token
	@params :  function, i.e funcional area from where the request coming
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Apr. 07, 2012
	*/ 
	function chkToken($function=NULL){
		$sync_detail = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		$timeFirst = strtotime($sync_detail['SyncDetail']['modified']);
		$timeSecond = strtotime(date('Y-m-d H:i:s'));
		$differenceInSeconds = $timeSecond - $timeFirst;
		if(empty($sync_detail)){
			$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
		} elseif($differenceInSeconds >3500){
			$this->redirect(array('controller'=>'connections','action'=>'oauthRefresh',$function));
		} elseif($function == 'email'){
			$this->redirect(array('controller'=>'connections','action'=>'saveGoogleMail'));
		} elseif($function == 'event'){
			$this->redirect(array('controller'=>'connections','action'=>'googleEvent'));
		} elseif($function == 'contact'){
			$this->redirect(array('controller'=>'connections','action'=>'googleContact'));
		} 
	}
	
	/** 
	@function : 	saveGoogleMail 
	@description : Fetch and save google inbox emails
	@params :  
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Apr. 12, 2012
	*/ 
	function saveGoogleMail(){
		//Fetch Sync detail of user
		$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		
		//Fetch Email:: Start
		$email = $syncInfo['SyncDetail']['link_email'];
		$token = $syncInfo['SyncDetail']['oauth_access_token'];
		
		App::import('Vendor', 'google_email', array('file' => 'google_email' . DS . 'google_email.php'));
		tryMe($email,$token);
		
		//Calculate and save local time for all emails
		$last_400_Email = $this->ImportEmail->find('all',array('conditions'=>array('ImportEmail.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'ImportEmail.id DESC','fields'=>array('ImportEmail.id','ImportEmail.user_id','ImportEmail.email_date')));
		$mailArr = array();
		foreach($last_400_Email as $emailRow){
			$mailArr['ImportEmail']['id'] = $emailRow['ImportEmail']['id'];
			$mailArr['ImportEmail']['local_email_date'] = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],$emailRow['ImportEmail']['email_date']);
			
			$this->ImportEmail->save($mailArr);
		}
		
		$this->redirect(array('controller'=>'timelines','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
	}
	
	/** 
	@function : 	googleEvent 
	@description : Fetch and save google calendar events
	@params :  
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Apr. 15, 2012
	*/ 	
	function googleEvent(){
		$this->layout = false;
		App::import('Vendor', 'google_event', array('file' => 'google_event'.DS.'google_event.php'));
		
		$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		$tokenVal = stripcslashes($syncInfo['SyncDetail']['oauth_json_response']);
		
		$allEventsDetail = get_events($tokenVal);
		$existingIds = $this->CalendarEvent->find('list',array('conditions'=>array('CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('CalendarEvent.id','CalendarEvent.event_id')));
		//echo '<pre>'; print_r($existingIds); die;
		//echo '===========<br><pre>'; print_r($allEventsDetail); echo "<br>=============<br>"; die;
		
		$eventData = array();
		$attendyData = array();
		
		$today = date ('Y-m-d'); 
		$OneWeekBackDate = date('Y-m-d',strtotime($today. "-7 day"));
		$OneWeekForwardDate = date('Y-m-d',strtotime($today. "+7 day"));
		$OneWeekForwardDate = $OneWeekForwardDate.' '.'23:59:59';
		$OneWeekBackDate = $OneWeekBackDate.' '.'00:00:00';
		
		//Deleted events from TL (these item should not save in sync process)
		$delItems = $this->DeletedItem->find('list',array('conditions'=>array('DeletedItem.user_id'=>$_SESSION['Auth']['User']['id'],'DeletedItem.item_type'=>'calendar'),'fields'=>array('DeletedItem.id','DeletedItem.item_id')));
		//pr($delItems); die;
		//==========//
		
		foreach($allEventsDetail as $event){
			//Event Start and end dates
			if($event['start']['dateTime'] != ""){
				$event['start']['dateTime'] = $event['start']['dateTime'];
				$event['end']['dateTime'] = $event['end']['dateTime'];
			} else{
				$event['start']['dateTime'] = $event['start']['date'];
				$event['end']['dateTime'] = $event['end']['date'];
			}
			
			$stExpDate = explode('T',$event['start']['dateTime']);
			if(strpos($event['start']['dateTime'],'+')){
				$expOn = '+';
			}else{
				$expOn = '-';
			}
			$timeExp = explode($expOn,$stExpDate[1]);
			$local_start = $stExpDate[0].' '.$timeExp[0];
			$event['start']['dateTime'] = $this->Common->serverTime($_SESSION['Auth']['User']['timezone'],$local_start);
			
			$endExpDate = explode('T',$event['end']['dateTime']);
			$endtimeExp = explode($expOn,$endExpDate[1]);
			$local_end = $endExpDate[0].' '.$endtimeExp[0];
			$event['end']['dateTime'] = $this->Common->serverTime($_SESSION['Auth']['User']['timezone'],$local_end);
			
			if((date('Y-m-d H:i:s', strtotime($event['start']['dateTime'])) >= $OneWeekBackDate) && (date('Y-m-d H:i:s', strtotime($event['end']['dateTime'])) <= $OneWeekForwardDate)){
				$eventData['CalendarEvent']['event_id'] = $event['id'];
				$eventData['CalendarEvent']['user_id'] = $_SESSION['Auth']['User']['id'];
				$eventData['CalendarEvent']['title'] = $event['summary'];
				$eventData['CalendarEvent']['start_time'] = $event['start']['dateTime'];
				$eventData['CalendarEvent']['end_time'] = $event['end']['dateTime'];
				$eventData['CalendarEvent']['details'] = $event['description'];
				$creatorDisplayName = ($event['creator']['displayName'] != "")?$event['creator']['displayName']:$event['creator']['email'];
				$eventData['CalendarEvent']['creator_display_name'] = $creatorDisplayName;
				$eventData['CalendarEvent']['creator_email'] = $event['creator']['email'];
				$eventData['CalendarEvent']['created'] = date('Y-m-d H:i:s', strtotime($event['created']));
				$eventData['CalendarEvent']['modified'] = date('Y-m-d H:i:s', strtotime($event['updated']));
				$eventData['CalendarEvent']['local_start'] = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],$eventData['CalendarEvent']['start_time']);
				$eventData['CalendarEvent']['local_end'] = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],$eventData['CalendarEvent']['end_time']);
				$eventData['CalendarEvent']['local_start'] = $local_start;
				$eventData['CalendarEvent']['local_end'] = $local_end;
				
				//If event already exist
				if(in_array($event['id'],$existingIds)){
					$existedEventInfo = $this->CalendarEvent->find('first',array('conditions'=>array('CalendarEvent.event_id'=>$event['id'],'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'])));
					$eventData['CalendarEvent']['id'] = $existedEventInfo['CalendarEvent']['id'];
					$eventData['CalendarEvent']['rating'] = $existedEventInfo['CalendarEvent']['rating'];
				}else{
					$eventData['CalendarEvent']['id'] = '';
					$eventData['CalendarEvent']['rating'] = 0;
				}
				
				//echo '<pre>'; print_r($eventData); //die;
				$this->CalendarEvent->create();
				//echo '<pre>'; print_r($eventData);
				//If item is in deleted list, do not save this
				
				if((in_array($event['id'],$delItems)) == false){
					if($this->CalendarEvent->save($eventData)){
						if(in_array($event['id'],$existingIds)){
							$eventId = $existedEventInfo['CalendarEvent']['id'];
						} else{
							$eventId = $this->CalendarEvent->getLastInsertId();	
						}
						
						if(!empty($event['attendees'])){
							$this->EventAttendy->deleteAll(array('EventAttendy.event_id'=>$eventId));
							foreach($event['attendees'] as $attendy){
								$attendyData['EventAttendy']['event_id'] = $eventId;
								$attendyDisplayName = ($attendy['displayName'] != "")?$attendy['displayName']:$attendy['email'];
								$attendyData['EventAttendy']['attendy_display_name'] = $attendyDisplayName;
								$attendyData['EventAttendy']['attendy_email'] = $attendy['email'];
								$this->EventAttendy->create();
								$this->EventAttendy->save($attendyData);
							}
						}
					}
				}
			} 
			
		}//die;
		//Update the last_updated_date in user table
		$sync_date = date('Y-m-d H:i:s');
		$this->loadModel('User');
		$this->User->updateAll(array('User.last_timeline_update'=>"'$sync_date'"),array('User.id'=>$syncInfo['SyncDetail']['user_id']));	
		
		//echo '<pre>'; print_r($eventData); die;
		$this->redirect(array('controller'=>'timelines','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
		
	}
	
	/** 
	@function : 	googleContact 
	@description : Fetch and save google contacts
	@params :  
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Apr. 22, 2012
	*/ 
	function googleContact(){
		$this->layout = false;
		App::import('Vendor', 'google_contact', array('file' => 'google_contact'.DS.'google_contact.php'));
		
		$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		$tokenVal = stripcslashes($syncInfo['SyncDetail']['oauth_json_response']);
		
		$gmailContacts = get_contacts($tokenVal);
		//echo '<pre>'; print_r($existingIds); die;
		//echo '===========<br><pre>'; print_r($gmailContacts); echo "<br>=============<br>"; die;
		
		$existingIds = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('Connection.id','Connection.contact_id')));
		//echo '<pre>'; print_r($existingIds); die;
		//Save contact info
		
		$i = 1;
		foreach($gmailContacts as $gContacts){
			$conInfoArray = array();
			$conName = ($gContacts['name'] != "")?$gContacts['name']:'N/A';
			$conInfoArray['Connection']['name'] = $conName;
			$conInfoArray['Connection']['source'] = 1;
			$conInfoArray['Connection']['contact_id'] = $gContacts['id'];
			$conInfoArray['Connection']['user_id'] = $_SESSION['Auth']['User']['id'];
			$i++;
			
			//If event already exist
			if(in_array($gContacts['id'],$existingIds)){
				$existedContactInfo = $this->Connection->find('first',array('conditions'=>array('Connection.contact_id'=>$gContacts['id'],'Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
				$conInfoArray['Connection']['id'] = $existedContactInfo['Connection']['id'];
				$conInfoArray['Connection']['status'] = $existedContactInfo['Connection']['status'];
			}
			
			//pr($conInfoArray); 
			$this->Connection->create();
			$this->Connection->save($conInfoArray['Connection']);
			
			$lastInsertId = $this->Connection->getLastInsertId();
			$connectId = isset($lastInsertId) && !empty($lastInsertId) ? $lastInsertId : $conInfoArray['Connection']['id'];
			//echo $connectId; exit;
			/**/
			// save phone numbers - Starts
			$this->ConnectionPhone->deleteAll(array('ConnectionPhone.connection_id'=>$connectId));
			
			$phoneArray = array();
			if(isset($gContacts['phoneNumber']) && !empty($gContacts['phoneNumber'])) {
				foreach($gContacts['phoneNumber'] as $phone_key=>$phone_val) {
					$phone_val = ($phone_val != '') ? $phone_val : 'N/A';
					$phoneArray[$phone_key]['ConnectionPhone']['connection_id'] = $connectId;
					$phoneArray[$phone_key]['ConnectionPhone']['phone'] = $phone_val;
				}
			}
			$this->ConnectionPhone->create();
			$this->ConnectionPhone->saveAll($phoneArray);
			/**/
			
			// save emails - Starts
			$this->ConnectionEmail->deleteAll(array('ConnectionEmail.connection_id'=>$connectId));
			$emailArray = array();
			if(isset($gContacts['emailAddress']) && !empty($gContacts['emailAddress'])) {
				foreach($gContacts['emailAddress'] as $email_key=>$email_val) {
					$email_val = ($email_val != '') ? $email_val : 'N/A';
					$emailArray[$email_key]['ConnectionEmail']['connection_id'] = $connectId;
					$emailArray[$email_key]['ConnectionEmail']['email'] = $email_val;
				}
			}
			$this->ConnectionEmail->create();
			$this->ConnectionEmail->saveAll($emailArray);
			/**/
			//save addresses - Starts
			$this->ConnectionAddress->deleteAll(array('ConnectionAddress.connection_id'=>$connectId));
			$addressArray = array();
			if(isset($gContacts['postalAddress']) && !empty($gContacts['postalAddress'])) {
				foreach($gContacts['postalAddress'] as $address_key=>$address_val) {
					$address_val = ($address_val != '') ? $address_val : 'N/A';
					$addressArray[$address_key]['ConnectionAddress']['connection_id'] = $connectId;
					$addressArray[$address_key]['ConnectionAddress']['address'] = $address_val;
				}
			}
			$this->ConnectionAddress->create();
			$this->ConnectionAddress->saveAll($addressArray);
			/**/
			//save connection group
			if((in_array($gContacts['id'],$existingIds)) == false){
				$this->ConGroupRelation->deleteAll(array('ConGroupRelation.connection_id'=>$connectId));
				$conGroupArr = array();
				$conGroupArr['ConGroupRelation']['connection_id'] = $connectId;
				$conGroupArr['ConGroupRelation']['group_id'] = 1; //Default Group
				$this->ConGroupRelation->create();
				$this->ConGroupRelation->save($conGroupArr);
			}
			
			
		}
		$sync_date = date('Y-m-d H:i:s');
		$this->loadModel('User');
		$this->User->updateAll(array('User.last_con_update'=>"'$sync_date'"),array('User.id'=>$syncInfo['SyncDetail']['user_id']));	
		
		$this->Session->setFlash('Connections sync successfully.', 'default', array('class' => 'flash_success'));
		$this->redirect(array('controller'=>'connections','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
		
	}//End Sync Connections
	
	
	
	function syncInBackground(){
		Configure::write('debug', 2);
		
		$cronData = $this->Cron->find('first',array('Cron.title'=>'AUTOMATIC_SYNC'));
		$date = date('Y-m-d H:i:s');
		//Check the time difference from last cron
		$timeFirst = strtotime($cronData['Cron']['created']);
		$timeSecond = strtotime(date('Y-m-d H:i:s'));
		$differenceFromLastCron = $timeSecond - $timeFirst;
		//if($differenceFromLastCron >36000){ //If last cron ran befor 10 hours, manually set status to 0
			//$this->Cron->updateAll(array('Cron.status'=>"'0'",'Cron.created'=>"'".$date."'"),array('Cron.title'=>'AUTOMATIC_SYNC'));
		//}//End
		
		//if($cronData['Cron']['status']==0)
		//{
			//Update cron's status 1 that indicates its running now.
			$date = date('Y-m-d H:i:s');
		        $this->Cron->updateAll(array('Cron.status'=>"'1'",'Cron.created'=>"'".$date."'"),array('Cron.title'=>'AUTOMATIC_SYNC'));
			
			//Function code comes here
			$this->layout = false;
			$this->autoRender = false;
			//Find all records from sync_details table
			$AllUserSyncData = $this->SyncDetail->find('all',array('conditions'=>array('SyncDetail.oauth_json_response <>'=>'')));
			//echo '<pre>'; print_r($AllUserSyncData); die;
					
			foreach($AllUserSyncData as $syncInfo){
				if($syncInfo['SyncDetail']['user_id'] != ""){
					
					//Set flag as the process start for this user.
					$process_status = 1;
					$this->SyncDetail->updateAll(array('SyncDetail.process_flag'=>"'$process_status'"),array('SyncDetail.user_id'=>$syncInfo['SyncDetail']['user_id']));
					
					echo $syncInfo['SyncDetail']['user_id'].'<br>';
					//Check if token is expired or not
					$timeFirst = strtotime($syncInfo['SyncDetail']['modified']);
					$timeSecond = strtotime(date('Y-m-d H:i:s'));
					$differenceInSeconds = $timeSecond - $timeFirst;
					if($differenceInSeconds >3500){ //Token is expired
						
						//Refresh the token
						$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$syncInfo['SyncDetail']['user_id'])));
						$tokenVal = stripcslashes($syncInfo['SyncDetail']['oauth_json_response']); //Full response
						
						//echo $tokenVal; die;
						App::import('Vendor', 'google_refresh_token', array('file' => 'google_refresh_token'.DS.'google_refresh_token.php'));
						$tokenInfo = get_refresh_token($tokenVal);
						//echo '<pre>'; print_r($tokenInfo); echo "<br>=============<br>";
						//die;
						
						$this->data['SyncDetail']['id'] = $syncInfo['SyncDetail']['id'];
						$this->data['SyncDetail']['oauth_access_token'] = $tokenInfo['access_token'];
						$this->data['SyncDetail']['refresh_token'] = $tokenInfo['refresh_token'];
						$this->data['SyncDetail']['oauth_json_response'] = mysql_real_escape_string($tokenInfo['json_resp']);
						
						$this->SyncDetail->save($this->data);
					}
					
					$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$syncInfo['SyncDetail']['user_id'])));
					
					//echo '<pre>'; print_r($syncInfo); die;
					//Sync calendar events :: Start
					App::import('Vendor', 'google_event', array('file' => 'google_event'.DS.'google_event.php'));
					$tokenVal = stripcslashes($syncInfo['SyncDetail']['oauth_json_response']);
					
					try{					
						$allEventsDetail = get_events($tokenVal);
					} catch(Exception $e){
						echo 'Message: ' .$e->getMessage();
					}
					
					$existingIds = $this->CalendarEvent->find('list',array('conditions'=>array('CalendarEvent.user_id'=>$syncInfo['SyncDetail']['user_id']),'fields'=>array('CalendarEvent.id','CalendarEvent.event_id')));
					//echo '<pre>'; print_r($existingIds); die;
					
					//echo '===========<br><pre>'; print_r($allEventsDetail); echo "<br>=============<br>"; die;
					
					$eventData = array();
					$attendyData = array();
					
					//echo '<pre>'; print_r($syncInfo); die;
					$today = date ('Y-m-d'); 
					$OneWeekBackDate = date('Y-m-d',strtotime($today. "-7 day"));
					$OneWeekForwardDate = date('Y-m-d',strtotime($today. "+7 day"));
					$OneWeekForwardDate = $OneWeekForwardDate.' '.'23:59:59';
					$OneWeekBackDate = $OneWeekBackDate.' '.'00:00:00';
					
					//Deleted events from TL (these item should not save in sync process)
					$delItems = $this->DeletedItem->find('list',array('conditions'=>array('DeletedItem.user_id'=>$syncInfo['SyncDetail']['user_id'],'DeletedItem.item_type'=>'calendar'),'fields'=>array('DeletedItem.id','DeletedItem.item_id')));
					//pr($delItems); die;
					//==========//
					
					foreach($allEventsDetail as $event){
						
						//Event Start and end dates
						if($event['start']['dateTime'] != ""){
							$event['start']['dateTime'] = $event['start']['dateTime'];
							$event['end']['dateTime'] = $event['end']['dateTime'];
						} else{
							$event['start']['dateTime'] = $event['start']['date'];
							$event['end']['dateTime'] = $event['end']['date'];
						}
						
						$crUserInfo = array();
						$crUserInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$syncInfo['SyncDetail']['user_id']), 'fields'=>array('User.id','User.timezone')));
						
						$stExpDate = explode('T',$event['start']['dateTime']);
						if(strpos($event['start']['dateTime'],'+')){
							$expOn = '+';
						}else{
							$expOn = '-';
						}
						$timeExp = explode($expOn,$stExpDate[1]);
						$local_start = $stExpDate[0].' '.$timeExp[0];
						$event['start']['dateTime'] = $this->Common->serverTime($crUserInfo['User']['timezone'],$local_start);
						
						$endExpDate = explode('T',$event['end']['dateTime']);
						$endtimeExp = explode($expOn,$endExpDate[1]);
						$local_end = $endExpDate[0].' '.$endtimeExp[0];
						$event['end']['dateTime'] = $this->Common->serverTime($crUserInfo['User']['timezone'],$local_end);
						
						
						if((date('Y-m-d H:i:s', strtotime($event['start']['dateTime'])) >= $OneWeekBackDate) && (date('Y-m-d H:i:s', strtotime($event['end']['dateTime'])) <= $OneWeekForwardDate)){
							
							$eventData['CalendarEvent']['event_id'] = $event['id'];
							$eventData['CalendarEvent']['user_id'] = $syncInfo['SyncDetail']['user_id'];
							$eventData['CalendarEvent']['title'] = $event['summary'];
							$eventData['CalendarEvent']['start_time'] = $event['start']['dateTime'];
							$eventData['CalendarEvent']['end_time'] = $event['end']['dateTime'];
							$eventData['CalendarEvent']['details'] = $event['description'];
							$creatorDisplayName = ($event['creator']['displayName'] != "")?$event['creator']['displayName']:$event['creator']['email'];
							$eventData['CalendarEvent']['creator_display_name'] = $creatorDisplayName;
							$eventData['CalendarEvent']['creator_email'] = $event['creator']['email'];
							$eventData['CalendarEvent']['created'] = date('Y-m-d H:i:s', strtotime($event['created']));
							$eventData['CalendarEvent']['modified'] = date('Y-m-d H:i:s', strtotime($event['updated']));
							$eventData['CalendarEvent']['local_start'] = $local_start;
							$eventData['CalendarEvent']['local_end'] = $local_end;
							
							
							/**/
							//If event already exist
							if(in_array($event['id'],$existingIds)){
								$existedEventInfo = $this->CalendarEvent->find('first',array('conditions'=>array('CalendarEvent.event_id'=>$event['id'],'CalendarEvent.user_id'=>$syncInfo['SyncDetail']['user_id'])));
								$eventData['CalendarEvent']['id'] = $existedEventInfo['CalendarEvent']['id'];
								$eventData['CalendarEvent']['rating'] = $existedEventInfo['CalendarEvent']['rating'];
							}else{
								$eventData['CalendarEvent']['id'] = '';
								$eventData['CalendarEvent']['rating'] = 0;
							}
																												
							//echo '<pre>'; print_r($eventData); die;
							$this->CalendarEvent->create();
							//If item is in deleted list, do not save this
							if((in_array($event['id'],$delItems)) == false){
								if($this->CalendarEvent->save($eventData)){
									if(in_array($event['id'],$existingIds)){
										$eventId = $existedEventInfo['CalendarEvent']['id'];
									} else{
										$eventId = $this->CalendarEvent->getLastInsertId();	
									} 
									if(!empty($event['attendees'])){
										$this->EventAttendy->deleteAll(array('EventAttendy.event_id'=>$eventId));
										foreach($event['attendees'] as $attendy){
											$attendyData['EventAttendy']['event_id'] = $eventId;
											$attendyDisplayName = ($attendy['displayName'] != "")?$attendy['displayName']:$attendy['email'];
											$attendyData['EventAttendy']['attendy_display_name'] = $attendyDisplayName;
											$attendyData['EventAttendy']['attendy_email'] = $attendy['email'];
											$this->EventAttendy->create();
											$this->EventAttendy->save($attendyData);
										}
									}
								}
							}
						}
						
					}
					//Sync calendar events :: End
					
					//Sync Emails :: Start
					//putted outside loop because all its functioning is defined in vendor file.
					//$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>50)));
					
					$email = $syncInfo['SyncDetail']['link_email'];
					$token = $syncInfo['SyncDetail']['oauth_access_token'];
						//echo 'Yes'; die;
						//App::import('Vendor', 'google_email_auto', array('file' => 'google_email_auto' . DS . 'google_email_auto.php'));
						//tryMe($email,$token);
						
					try{					
						App::import('Vendor', 'google_email_auto', array('file' => 'google_email_auto' . DS . 'google_email_auto.php'));
						tryMe($email,$token);
						
					} catch(Exception $e){
						echo 'Message: ' .$e->getMessage();
					}
					
					//Calculate and save local time for all emails
					$crUserData = array();
					$crUserData = $this->User->find('first',array('conditions'=>array('User.id'=>$syncInfo['SyncDetail']['user_id']), 'fields'=>array('User.id','User.timezone')));
					$last_400_Email = $this->ImportEmail->find('all',array('conditions'=>array('ImportEmail.user_id'=>$crUserData['User']['id']),'order'=>'ImportEmail.id DESC','fields'=>array('ImportEmail.id','ImportEmail.user_id','ImportEmail.email_date')));
					$mailArr = array();
					foreach($last_400_Email as $emailRow){
						$mailArr['ImportEmail']['id'] = $emailRow['ImportEmail']['id'];
						$mailArr['ImportEmail']['local_email_date'] = $this->Common->userTime($crUserData['User']['timezone'],$emailRow['ImportEmail']['email_date']);
						
						$this->ImportEmail->save($mailArr);
					}
					
					//Sync Emails :: End
					
					//Unset flag as the process start for this user.
					$process_status_unset = 0;
					$this->SyncDetail->updateAll(array('SyncDetail.process_flag'=>"'$process_status_unset'"),array('SyncDetail.user_id'=>$syncInfo['SyncDetail']['user_id']));
					
				}
				
				//Update the last_updated_date in user table
				$Newdate = date('Y-m-d H:i:s');
				$this->loadModel('User');
				$this->User->updateAll(array('User.last_timeline_update'=>"'$Newdate'"),array('User.id'=>$syncInfo['SyncDetail']['user_id']));
			
				
			}
			
					
			//Set the cron status 0 again that indicates that the cron stop now
			$Newdate = date('Y-m-d H:i:s');
			$this->Cron->updateAll(array('Cron.status'=>"'0'",'Cron.created'=>"'".$Newdate."'"),array('Cron.title'=>'AUTOMATIC_SYNC'));
			
		//}
				
		exit;
		
	}
	
	
	
	function testCron(){
		echo date("Y-m-d H:i:s"); die;
		
		
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
	    $template = $this->Common->getEmailTemplate(10);
	    
	    $this->Email->from = INFO_EMAIL;
	    $this->Email->subject = str_replace('{PERIOD}','Daily',$template['EmailTemplate']['subject']);
	    $data=$template['EmailTemplate']['description'];
	    
	    $this->set('data',$data);
	    $this->Email->to = "smaartdatatest@gmail.com";
	    $this->Email->template='commanEmailTemplate';
	    $this->Email->send();
	exit;
    }
    
    
    /*
     *
     */
    function set_link_session(){
	$this->autoRender = false;
	$_SESSION['Connection']['immediate_fetch'] = 1;
	return 1;
	exit;
    }
    
    
    /*
     *
     */
    function immediate_fetch($userId = NULL){
	//Fetch Sync detail of user
	$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$userId)));
	//echo '<Pre>'; print_r($syncInfo); die;
	
	//Fetch Email:: Start
	$email = $syncInfo['SyncDetail']['link_email'];
	$token = $syncInfo['SyncDetail']['oauth_access_token'];
	
	App::import('Vendor', 'google_email', array('file' => 'google_email' . DS . 'google_email.php'));
	tryMe($email,$token);
	
	//Calculate and save local time for all emails
	$crUserData = $this->User->find('first',array('conditions'=>array('User.id'=>$userId), 'fields'=>array('User.id','User.timezone')));
	$last_400_Email = $this->ImportEmail->find('all',array('conditions'=>array('ImportEmail.user_id'=>$crUserData['User']['id']),'order'=>'ImportEmail.id DESC','fields'=>array('ImportEmail.id','ImportEmail.user_id','ImportEmail.email_date')));
	$mailArr = array();
	foreach($last_400_Email as $emailRow){
		$mailArr['ImportEmail']['id'] = $emailRow['ImportEmail']['id'];
		$mailArr['ImportEmail']['local_email_date'] = $this->Common->userTime($crUserData['User']['timezone'],$emailRow['ImportEmail']['email_date']);
		
		$this->ImportEmail->save($mailArr);
	}
	
	//Fetch Email:: End
	
	
	//Fetch Events:: Start
	$tokenVal = stripcslashes($syncInfo['SyncDetail']['oauth_json_response']);
	
	App::import('Vendor', 'google_event', array('file' => 'google_event'.DS.'google_event.php'));
	
	$allEventsDetail = get_events($tokenVal);
	$existingIds = $this->CalendarEvent->find('list',array('conditions'=>array('CalendarEvent.user_id'=>$syncInfo['SyncDetail']['user_id']),'fields'=>array('CalendarEvent.id','CalendarEvent.event_id')));
	//echo '<pre>'; print_r($existingIds); die;
	
	//echo '===========<br><pre>'; print_r($allEventsDetail); echo "<br>=============<br>"; //die;
	
	$eventData = array();
	$attendyData = array();
	
	//echo '<pre>'; print_r($syncInfo); die;
	$today = date ('Y-m-d'); 
	$OneWeekBackDate = date('Y-m-d',strtotime($today. "-7 day"));
	$OneWeekForwardDate = date('Y-m-d',strtotime($today. "+7 day"));
	$OneWeekForwardDate = $OneWeekForwardDate.' '.'23:59:59';
	$OneWeekBackDate = $OneWeekBackDate.' '.'00:00:00';
	
	//Deleted events from TL (these item should not save in sync process)
	$delItems = $this->DeletedItem->find('list',array('conditions'=>array('DeletedItem.user_id'=>$_SESSION['Auth']['User']['id'],'DeletedItem.item_type'=>'calendar'),'fields'=>array('DeletedItem.id','DeletedItem.item_id')));
	//pr($delItems); die;
	//==========//
		
	foreach($allEventsDetail as $event){
		//Event Start and end dates
		if($event['start']['dateTime'] != ""){
			$event['start']['dateTime'] = $event['start']['dateTime'];
			$event['end']['dateTime'] = $event['end']['dateTime'];
		} else{
			$event['start']['dateTime'] = $event['start']['date'];
			$event['end']['dateTime'] = $event['end']['date'];
		}
		
		$stExpDate = explode('T',$event['start']['dateTime']);
		if(strpos($event['start']['dateTime'],'+')){
			$expOn = '+';
		}else{
			$expOn = '-';
		}
		$timeExp = explode($expOn,$stExpDate[1]);
		$local_start = $stExpDate[0].' '.$timeExp[0];
		$event['start']['dateTime'] = $this->Common->serverTime($_SESSION['Auth']['User']['timezone'],$local_start);
		
		$endExpDate = explode('T',$event['end']['dateTime']);
		$endtimeExp = explode($expOn,$endExpDate[1]);
		$local_end = $endExpDate[0].' '.$endtimeExp[0];
		$event['end']['dateTime'] = $this->Common->serverTime($_SESSION['Auth']['User']['timezone'],$local_end);
		
		if((date('Y-m-d H:i:s', strtotime($event['start']['dateTime'])) >= $OneWeekBackDate) && (date('Y-m-d H:i:s', strtotime($event['end']['dateTime'])) <= $OneWeekForwardDate)){
			$eventData['CalendarEvent']['event_id'] = $event['id'];
			$eventData['CalendarEvent']['user_id'] = $syncInfo['SyncDetail']['user_id'];
			$eventData['CalendarEvent']['title'] = $event['summary'];
			$eventData['CalendarEvent']['start_time'] = $event['start']['dateTime'];
			$eventData['CalendarEvent']['end_time'] = $event['end']['dateTime'];
			$eventData['CalendarEvent']['details'] = $event['description'];
			$creatorDisplayName = ($event['creator']['displayName'] != "")?$event['creator']['displayName']:$event['creator']['email'];
			$eventData['CalendarEvent']['creator_display_name'] = $creatorDisplayName;
			$eventData['CalendarEvent']['creator_email'] = $event['creator']['email'];
			$eventData['CalendarEvent']['created'] = date('Y-m-d H:i:s', strtotime($event['created']));
			$eventData['CalendarEvent']['modified'] = date('Y-m-d H:i:s', strtotime($event['updated']));
			$eventData['CalendarEvent']['local_start'] = $local_start;
			$eventData['CalendarEvent']['local_end'] = $local_end;
			
			/**/
			//If event already exist
			if(in_array($event['id'],$existingIds)){
				$existedEventInfo = $this->CalendarEvent->find('first',array('conditions'=>array('CalendarEvent.event_id'=>$event['id'],'CalendarEvent.user_id'=>$syncInfo['SyncDetail']['user_id'])));
				$eventData['CalendarEvent']['id'] = $existedEventInfo['CalendarEvent']['id'];
				$eventData['CalendarEvent']['rating'] = $existedEventInfo['CalendarEvent']['rating'];
			}
																								
			//echo '<pre>'; print_r($eventData); die;
			$this->CalendarEvent->create();
			//If item is in deleted list, do not save this
			if((in_array($event['id'],$delItems)) == false){
				if($this->CalendarEvent->save($eventData)){
					if(in_array($event['id'],$existingIds)){
						$eventId = $existedEventInfo['CalendarEvent']['id'];
					} else{
						$eventId = $this->CalendarEvent->getLastInsertId();	
					}
					
					if(!empty($event['attendees'])){
						$this->EventAttendy->deleteAll(array('EventAttendy.event_id'=>$eventId));
						foreach($event['attendees'] as $attendy){
							$attendyData['EventAttendy']['event_id'] = $eventId;
							$attendyDisplayName = ($attendy['displayName'] != "")?$attendy['displayName']:$attendy['email'];
							$attendyData['EventAttendy']['attendy_display_name'] = $attendyDisplayName;
							$attendyData['EventAttendy']['attendy_email'] = $attendy['email'];
							$this->EventAttendy->create();
							$this->EventAttendy->save($attendyData);
						}
					}
				}
			}
		}
		/**/
	}
	//Fetch Events:: End

	//Update the last_updated_date in user table
	$sync_date = date('Y-m-d H:i:s');
	$this->loadModel('User');
	$this->User->updateAll(array('User.last_timeline_update'=>"'$sync_date'"),array('User.id'=>$syncInfo['SyncDetail']['user_id']));	
	
	
	//Fetch Contact:: Start
	/**/
	
	App::import('Vendor', 'google_contact', array('file' => 'google_contact'.DS.'google_contact.php'));
		
	$tokenVal = stripcslashes($syncInfo['SyncDetail']['oauth_json_response']);
	
	$gmailContacts = get_contacts($tokenVal);
	//echo '<pre>'; print_r($existingIds); die;
	//echo '===========<br><pre>'; print_r($gmailContacts); echo "<br>=============<br>"; die;
	
	$existingIds = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$syncInfo['SyncDetail']['user_id']),'fields'=>array('Connection.id','Connection.contact_id')));
	//echo '<pre>'; print_r($existingIds); die;
	//Save contact info
	
	//Deleted connections (these item should not save in sync process)
	$delCon = $this->DeletedItem->find('list',array('conditions'=>array('DeletedItem.user_id'=>$_SESSION['Auth']['User']['id'],'DeletedItem.item_type'=>'Connection'),'fields'=>array('DeletedItem.id','DeletedItem.item_id')));
	//pr($delCon); die;
	
	$i = 1;
	foreach($gmailContacts as $gContacts){
		$conInfoArray = array();
		$conName = ($gContacts['name'] != "")?$gContacts['name']:'N/A';
		$conInfoArray['Connection']['name'] = $conName;
		$conInfoArray['Connection']['source'] = 1;
		$conInfoArray['Connection']['contact_id'] = $gContacts['id'];
		$conInfoArray['Connection']['user_id'] = $syncInfo['SyncDetail']['user_id'];
		$i++;
		
		if((in_array($gContacts['id'],$delCon)) == false){
			//If event already exist
			if(in_array($gContacts['id'],$existingIds)){
				$existedContactInfo = $this->Connection->find('first',array('conditions'=>array('Connection.contact_id'=>$gContacts['id'],'Connection.user_id'=>$syncInfo['SyncDetail']['user_id'])));
				$conInfoArray['Connection']['id'] = $existedContactInfo['Connection']['id'];
				$conInfoArray['Connection']['status'] = $existedContactInfo['Connection']['status'];
			}
			
			//pr($conInfoArray); 
			$this->Connection->create();
			$this->Connection->save($conInfoArray['Connection']);
			
			$lastInsertId = $this->Connection->getLastInsertId();
			$connectId = isset($lastInsertId) && !empty($lastInsertId) ? $lastInsertId : $conInfoArray['Connection']['id'];
			//echo $connectId; exit;
			
			// save phone numbers - Starts
			$this->ConnectionPhone->deleteAll(array('ConnectionPhone.connection_id'=>$connectId));
			
			$phoneArray = array();
			if(isset($gContacts['phoneNumber']) && !empty($gContacts['phoneNumber'])) {
				foreach($gContacts['phoneNumber'] as $phone_key=>$phone_val) {
					$phone_val = ($phone_val != '') ? $phone_val : 'N/A';
					$phoneArray[$phone_key]['ConnectionPhone']['connection_id'] = $connectId;
					$phoneArray[$phone_key]['ConnectionPhone']['phone'] = $phone_val;
				}
			}
			$this->ConnectionPhone->create();
			$this->ConnectionPhone->saveAll($phoneArray);
			
			
			// save emails - Starts
			$this->ConnectionEmail->deleteAll(array('ConnectionEmail.connection_id'=>$connectId));
			$emailArray = array();
			if(isset($gContacts['emailAddress']) && !empty($gContacts['emailAddress'])) {
				foreach($gContacts['emailAddress'] as $email_key=>$email_val) {
					$email_val = ($email_val != '') ? $email_val : 'N/A';
					$emailArray[$email_key]['ConnectionEmail']['connection_id'] = $connectId;
					$emailArray[$email_key]['ConnectionEmail']['email'] = $email_val;
				}
			}
			$this->ConnectionEmail->create();
			$this->ConnectionEmail->saveAll($emailArray);
			
			//save addresses - Starts
			$this->ConnectionAddress->deleteAll(array('ConnectionAddress.connection_id'=>$connectId));
			$addressArray = array();
			if(isset($gContacts['postalAddress']) && !empty($gContacts['postalAddress'])) {
				foreach($gContacts['postalAddress'] as $address_key=>$address_val) {
					$address_val = ($address_val != '') ? $address_val : 'N/A';
					$addressArray[$address_key]['ConnectionAddress']['connection_id'] = $connectId;
					$addressArray[$address_key]['ConnectionAddress']['address'] = $address_val;
				}
			}
			$this->ConnectionAddress->create();
			$this->ConnectionAddress->saveAll($addressArray);
			
			//save connection group
			if((in_array($gContacts['id'],$existingIds)) == false){
				$this->ConGroupRelation->deleteAll(array('ConGroupRelation.connection_id'=>$connectId));
				$conGroupArr = array();
				$conGroupArr['ConGroupRelation']['connection_id'] = $connectId;
				$conGroupArr['ConGroupRelation']['group_id'] = 1; //Default Group
				$this->ConGroupRelation->create();
				$this->ConGroupRelation->save($conGroupArr);
			}
		}
		
	}
	/**/
	//Fetch Contact:: End
	//Update the last_updated_date in user table
	$sync_date = date('Y-m-d H:i:s');
	$this->loadModel('User');
	$this->User->updateAll(array('User.last_con_update'=>"'$sync_date'"),array('User.id'=>$syncInfo['SyncDetail']['user_id']));	
	
	//Update process status to completed (1)
	$status = 0;
	$this->Process->updateAll(array('Process.status'=>"'$status'"),array('Process.user_id'=>$userId,'Process.title'=>'first_sync'));
	
	return 1;
	exit;
    }
    
    
    function bg_con_sync(){
	$this->layout = false;
	$this->autoRender = false;
	
	//echo '1'; exit;
	
	$sync_detail = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
	$timeFirst = strtotime($sync_detail['SyncDetail']['modified']);
	$timeSecond = strtotime(date('Y-m-d H:i:s'));
	$differenceInSeconds = $timeSecond - $timeFirst;
	if($sync_detail['SyncDetail']['oauth_json_response'] == ""){
		$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
	} elseif($differenceInSeconds >3500){
		$function = 'bg_con_sync';
		$this->redirect(array('controller'=>'connections','action'=>'oauthRefresh',$function));
	} else{
		$command = "php /srv/www/htdocs/app/webroot/cron_dispatcher.php /connections/sync_connection_background/".$_SESSION['Auth']['User']['id'];
		exec($command."> /dev/null &");
	} 
	
	$this->redirect(array('controller'=>'connections','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
	
	exit;
	
    }
    
    function sync_connection_background($userId){
		
		$this->layout = false;
		$this->autoRender = false;
		
		//Enter record in processes table
		$existRec = $this->Process->find('first',array('conditions'=>array('Process.user_id'=>$userId,'Process.title'=>'bg_con_sync')));
		$processArr = array();
		if($existRec['Process']['id'] != ""){
			$processArr['Process']['id'] = $existRec['Process']['id'];	
		}
		$processArr['Process']['user_id'] = $userId;
		$processArr['Process']['title'] = 'bg_con_sync';
		$processArr['Process']['status'] = 1;
		$processArr['Process']['created'] = date('Y-m-d H:i:s');
		$this->Process->save($processArr);
		
		
		//Find all records from sync_details table
		$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$userId)));
		
		//Fetch Contact:: Start
		App::import('Vendor', 'google_contact', array('file' => 'google_contact'.DS.'google_contact.php'));
			
		$tokenVal = stripcslashes($syncInfo['SyncDetail']['oauth_json_response']);
		
		$gmailContacts = get_contacts($tokenVal);
		//echo '<pre>'; print_r($existingIds); die;
		//echo '===========<br><pre>'; print_r($gmailContacts); echo "<br>=============<br>"; die;
		
		$existingIds = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$syncInfo['SyncDetail']['user_id']),'fields'=>array('Connection.id','Connection.contact_id')));
		//echo '<pre>'; print_r($existingIds); die;
		//Save contact info
		
		//Deleted connections (these item should not save in sync process)
		$delItems = $this->DeletedItem->find('list',array('conditions'=>array('DeletedItem.user_id'=>$userId,'DeletedItem.item_type'=>'Connection'),'fields'=>array('DeletedItem.id','DeletedItem.item_id')));
		//echo '<pre>'; print_r($delItems); die;
		
		/*
		foreach($gmailContacts as $gContacts){
			if((in_array(end(explode("/",$gContacts['id'])),$delItems)) == false){
				echo 'Not Deleted: '.end(explode("/",$gContacts['id'])).'<br>';
			}else{
				echo '<br><br>Deleted: '.end(explode("/",$gContacts['id'])).'<br>';
			}
			
		}
		exit;
		*/
		
		$i = 1;
		foreach($gmailContacts as $gContacts){
			$conInfoArray = array();
			$conName = ($gContacts['name'] != "")?$gContacts['name']:'N/A';
			$conInfoArray['Connection']['name'] = $conName;
			$conInfoArray['Connection']['source'] = 1;
			$conInfoArray['Connection']['contact_id'] = $gContacts['id'];
			$conInfoArray['Connection']['user_id'] = $syncInfo['SyncDetail']['user_id'];
			$i++;
			
			$last_id_of_cn = end(explode("/",$gContacts['id']));
			if((in_array($last_id_of_cn,$delItems)) == false){
				//If event already exist
				if(in_array($gContacts['id'],$existingIds)){
					$existedContactInfo = $this->Connection->find('first',array('conditions'=>array('Connection.contact_id'=>$gContacts['id'],'Connection.user_id'=>$syncInfo['SyncDetail']['user_id'])));
					$conInfoArray['Connection']['id'] = $existedContactInfo['Connection']['id'];
					$conInfoArray['Connection']['status'] = $existedContactInfo['Connection']['status'];
				}
				
				//pr($conInfoArray); 
				$this->Connection->create();
				$this->Connection->save($conInfoArray['Connection']);
				
				$lastInsertId = $this->Connection->getLastInsertId();
				$connectId = isset($lastInsertId) && !empty($lastInsertId) ? $lastInsertId : $conInfoArray['Connection']['id'];
				//echo $connectId; exit;
				
				// save phone numbers - Starts
				$this->ConnectionPhone->deleteAll(array('ConnectionPhone.connection_id'=>$connectId));
				
				$phoneArray = array();
				if(isset($gContacts['phoneNumber']) && !empty($gContacts['phoneNumber'])) {
					foreach($gContacts['phoneNumber'] as $phone_key=>$phone_val) {
						$phone_val = ($phone_val != '') ? $phone_val : 'N/A';
						$phoneArray[$phone_key]['ConnectionPhone']['connection_id'] = $connectId;
						$phoneArray[$phone_key]['ConnectionPhone']['phone'] = $phone_val;
					}
				}
				$this->ConnectionPhone->create();
				$this->ConnectionPhone->saveAll($phoneArray);
				
				
				// save emails - Starts
				$this->ConnectionEmail->deleteAll(array('ConnectionEmail.connection_id'=>$connectId));
				$emailArray = array();
				if(isset($gContacts['emailAddress']) && !empty($gContacts['emailAddress'])) {
					foreach($gContacts['emailAddress'] as $email_key=>$email_val) {
						$email_val = ($email_val != '') ? $email_val : 'N/A';
						$emailArray[$email_key]['ConnectionEmail']['connection_id'] = $connectId;
						$emailArray[$email_key]['ConnectionEmail']['email'] = $email_val;
					}
				}
				$this->ConnectionEmail->create();
				$this->ConnectionEmail->saveAll($emailArray);
				
				//save addresses - Starts
				$this->ConnectionAddress->deleteAll(array('ConnectionAddress.connection_id'=>$connectId));
				$addressArray = array();
				if(isset($gContacts['postalAddress']) && !empty($gContacts['postalAddress'])) {
					foreach($gContacts['postalAddress'] as $address_key=>$address_val) {
						$address_val = ($address_val != '') ? $address_val : 'N/A';
						$addressArray[$address_key]['ConnectionAddress']['connection_id'] = $connectId;
						$addressArray[$address_key]['ConnectionAddress']['address'] = $address_val;
					}
				}
				$this->ConnectionAddress->create();
				$this->ConnectionAddress->saveAll($addressArray);
				
				//save connection group
				if((in_array($gContacts['id'],$existingIds)) == false){
					$this->ConGroupRelation->deleteAll(array('ConGroupRelation.connection_id'=>$connectId));
					$conGroupArr = array();
					$conGroupArr['ConGroupRelation']['connection_id'] = $connectId;
					$conGroupArr['ConGroupRelation']['group_id'] = 1; //Default Group
					$this->ConGroupRelation->create();
					$this->ConGroupRelation->save($conGroupArr);
				}
			} 
			
		}
		/**/
		//Fetch Contact:: End
		
		//Update the last_updated_date in user table
		$date = date('Y-m-d H:i:s');
		$this->loadModel('User');
		$this->User->updateAll(array('User.last_con_update'=>"'$date'"),array('User.id'=>$userId));
		
		//Update process status to completed (1)
		$status = 0;
		$this->Process->updateAll(array('Process.status'=>"'$status'"),array('Process.user_id'=>$userId,'Process.title'=>'bg_con_sync'));
		
		exit;
		
	}
	
	
	/** 
	@function : 	revokeToken 
	@description : revokeToken access token
	@params :  
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : May 06, 2012
	*/ 
	function revokeToken($function=NULL){
		//Configure::write('debug', 2);
		$this->layout = false;
		
		$syncInfo = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		$tokenVal = stripcslashes($syncInfo['SyncDetail']['oauth_json_response']);
		//echo $tokenVal; die;
		App::import('Vendor', 'google_refresh_token', array('file' => 'google_refresh_token'.DS.'google_refresh_token.php'));
		$tokenInfo = get_refresh_token($tokenVal,'revokeToken');
		
		$tokenInfo = 1;
		if($tokenInfo == 1){
			
			$existId = $this->SyncDetail->find('first',array('conditions'=>array('SyncDetail.user_id'=>$_SESSION['Auth']['User']['id'])));
		        $id = $existId['SyncDetail']['id']; 
			
			$this->SyncDetail->delete($id);
			
			$status = 0;
			$this->Process->updateAll(array('Process.status'=>"'$status'"),array('Process.user_id'=>$_SESSION['Auth']['User']['id']));
			
		}
		$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
	}
	
	
	/** 
	@function : 	totalTouchforConnection
	@description : Total touch for a connection in a mission
	@params :  
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Jul 15, 2013
	*/ 
	function totalTouchforConnection($conId=NULL, $missionId=NULL){
		
		$this->layout = false;
		$touches = 0;
		
		$recentMission = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$missionId), 'order'=>'Mission.id DESC'));
		$timeDiff = ceil((strtotime($recentMission['Mission']['end_time']) - strtotime($recentMission['Mission']['start_time'])) / (60 * 60 * 24));
		
		$conInMission = $this->MissionConnection->find('first',array('conditions'=>array('MissionConnection.mission_id'=>$missionId,'MissionConnection.connection_id'=>$conId)));
		
		if(!empty($conInMission)){
			if($conInMission['MissionConnection']['frequency'] == 'Weekly'){ //Weekly
				$period_days = 7;
			}elseif($conInMission['MissionConnection']['frequency'] == 'Monthly'){ //Monthly
				$period_days = 30;
			}else{
				$period_days = $timeDiff;
			}
			$touch_in_one_day = $conInMission['MissionConnection']['hours']/$period_days;
			$touches = round($timeDiff*$touch_in_one_day);
		}
		
		return $touches;
	}
	
	/** 
	@function : 	actualTouchByCon
	@description : Actual touches by a connection in a mission period or till date 
	@params :  
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Jul 15, 2013
	*/ 
	function actualTouchByCon($conId=NULL, $missionId=NULL){
		
		$this->layout = false;
		$touchesViaReflections = $all_messages_sent = $all_email_imported = $touchesViaCalendarEvents = $touchesViaActEvents = 0;
		$totalTouches = 0; $tmpActCnt = 0; $tmpCalCnt = 0; 
		
		$recentMission = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$missionId), 'order'=>'Mission.id DESC'));
		$startDate = $recentMission['Mission']['start_time'];
		$endDate = ($recentMission['Mission']['end_time'] > $this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s')))?$recentMission['Mission']['end_time']:$this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'));
		
		$conInMission = $this->MissionConnection->find('first',array('conditions'=>array('MissionConnection.mission_id'=>$missionId,'MissionConnection.connection_id'=>$conId)));
		
		if(!empty($conInMission)){
			
			//fetch all the message sent to connections
			//message data
			
			$this->loadModel('Message');
			$this->Message->recursive  = -1;
			$all_messages_sent = $this->Message->find('count',array('conditions'=>array(
												   'Message.from_user_id'=>$_SESSION['Auth']['User']['id'],
												   'Message.to_user_type'=>'connection',
												   'Message.to_user_id'=>$missionId,
												   'Message.local_message_time BETWEEN ? and ?'=>array($startDate,$endDate)
												   )
									       )
								  );
			
			//reflections shared
			$this->UserReflection->recursive  = 3;
			$this->loadModel('UserReflection');
			$all_reflections = $this->UserReflection->find('all',array('conditions'=>array(
												   'UserReflection.user_id'=>$_SESSION['Auth']['User']['id'],
												   'UserReflection.local_reflection_date BETWEEN ? and ?'=>array($startDate,$endDate)
												   )
									       )
								  );
			//pr($all_reflections); die;
			//get all connections ids with which it is shared
			$ref_attendy = array();
			foreach($all_reflections as $sharedReflection){
				//Fetch con from reflectionAttendies
				foreach($sharedReflection['ReflectionAttendy'] as $attendy){
				$ref_attendy[] = $attendy['connection_id'];
				}
				
			}
			$newAttendyArr  = $ref_attendy;
			$mission_con_id = array();
			$mission_con_id[]=$missionId;
			
			$touchesViaReflections = count(array_intersect($newAttendyArr,$mission_con_id));
			$touchesViaReflections = ($touchesViaReflections != "") ? $touchesViaReflections : 0;
			
			//events occured
			$all_cal_events = $this->CalendarEvent->find('all',array('conditions'=>array(
												   'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],
												   //'CalendarEvent.start_time BETWEEN ? and ?'=>array($oneWeekAgoDate,$current_date)
												   'CalendarEvent.local_start >='=>$startDate,
												   'CalendarEvent.local_start <='=>$endDate 
												   )
									       )
								  );
			//echo '<pre>'; print_r($all_cal_events); die;
			//get all emails of Attendys of Calnedar Events
			unset($eventAttendyEmails);
			$eventAttendyEmails = array();
			foreach($all_cal_events as $calendarEvent){
				foreach($calendarEvent['EventAttendy'] as $eventAttendy){
					$eventAttendyEmails[] = $eventAttendy['attendy_email'] ;
					
				}
				
			}
			
			//Some emails are comma saparated
			$tmpeveArr = array();
			$cnteve=0;
			foreach($eventAttendyEmails as $keyeve => $valeve){
				if(strpos($valeve,',') == false){
					$tmpeveArr[$cnteve] = $valeve;
				} else{
					$expactemail = explode(',',$valeve);
					foreach($expactemail as $row){
						$tmpeveArr[$cnteve] = trim($row);
						$cnteve = $cnteve+1;
					}
				}
				$cnteve = $cnteve+1;
			}
			$eventAttendyEmails = $tmpeveArr;
			
			//fetch all emails of this particular connection and check its intersection with Attendys
			$connectionEmails = $this->ConnectionEmail->find('list',array('conditions'=>array('ConnectionEmail.connection_id'=>$missionId), 'fields'=>array('email')));
			
			foreach($connectionEmails as $allEmailcalKey => $allEmailCalVal){
				if($tmpCalCnt == 0){
					$userAllMailCal[0] = $allEmailCalVal;
					$tmpCalCnt = $tmpCalCnt+count(array_intersect($eventAttendyEmails,$userAllMailCal));
				}
			}
			
			$touchesViaCalendarEvents = $tmpCalCnt;
			
			//Touches via Activity::start
			//echo $touchesViaCalendarEvents; die;
			$this->loadModel('Activity');
			$all_act_events = $this->Activity->find('all',array('conditions'=>array(
												   'Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],
												   'Activity.local_start >='=>$startDate,
												   'Activity.local_start <='=>$endDate 
												   )
									       )
								  );
			//echo '<pre>'; print_r($all_act_events); die;
			
			//get all emails of Attendys of Activity Events
			
			$actAttendyEmails = array();
			foreach($all_act_events as $actEvent){
				foreach($actEvent['ActivityAttendy'] as $actAttendy){
					$actAttendyEmails[] = $actAttendy['attendy_email'] ;
					
				}
				
			}
			
			//Some emails are comma saparated
			$tmpactArr = array();
			$cntact=0;
			foreach($actAttendyEmails as $keyact => $valact){
				if(strpos($valact,',') == false){
					$tmpactArr[$cntact] = $valact;
				} else{
					$expactemail = explode(',',$valact);
					foreach($expactemail as $row){
						$tmpactArr[$cntact] = trim($row);
						$cntact = $cntact+1;
					}
				}
				$cntact = $cntact+1;
			}
			$actAttendyEmails = $tmpactArr;
			//pr($actAttendyEmails); die; 
			//fetch all emails of this particular connection and check its intersection with Attendys
			$actconEmails = $this->ConnectionEmail->find('list',array('conditions'=>array('ConnectionEmail.connection_id'=>$conId), 'fields'=>array('email')));
			
			//unset($tmpActCnt);
			foreach($actconEmails as $allEmailKay => $allEmailVal){
				if($tmpActCnt == 0){
					$userAllMail[0] = $allEmailVal;
					$tmpActCnt = $tmpActCnt+count(array_intersect($actAttendyEmails,$userAllMail));
				}
			}
			
			$touchesViaActEvents = $tmpActCnt;
			
			//Touches via Activity:: End
			foreach($connectionEmails as $con_key => $con_val){
				$con_email_to_count = $con_val;
			}
			
			$all_email_imported = $this->ImportEmail->find('count',array('conditions'=>array(
												   'ImportEmail.user_id'=>$_SESSION['Auth']['User']['id'],
												   'ImportEmail.email_from LIKE'=>'%'.$con_email_to_count.'%',
												   'ImportEmail.local_email_date BETWEEN ? and ?'=>array($startDate,$endDate)
												   )
									       )
								  );
			//echo $all_email_imported; die;
			
			$totalTouches = $touchesViaReflections+$all_messages_sent+$all_email_imported+$touchesViaCalendarEvents+$touchesViaActEvents;
			
		}
		
		return $totalTouches;
	}
	
	
	
    
  }//end class
?>