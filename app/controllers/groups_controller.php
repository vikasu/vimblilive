<?php
/*
	* Groups Controller class
	* PHP versions 5.1.4
	* @filesource
	* @author     Vikas Uniyal
	* @link       http://www.smartdatainc.net/
	* @version 0.0.1.3 
*/
App::import('Sanitize');
class GroupsController extends AppController{

	var $name 	= 'Groups';
	var $uses 	= array('User','ManagerUser','UserGroup','UserGroupsUser','Connection','ConnectionGroup','ConnectionPhone','ConnectionEmail','ConnectionAddress','ConGroupRelation','Message','Cohort','CohortUser','SponsorManager','Mission','Question','MissionUser','Communication','UserReflection','CalendarEvent','Activity','ImportEmail','FlagSetting','ActivityAttendy','ScheduleBalance');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('GoogleCal','RequestHandler','Cookie','Email','Auth','Upload','Common','Import');
 
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(($this->params['action'] != 'admin_login') && (@$this->params['prefix'] == 'admin'))
		{
		    $this->Auth->allow('sign_up');
		} else {
		       $this->Auth->allow('');
		}
	    
	    }
	
	
	/**
	@function: dashboard
	@description		Group dashboard
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Dec. 26, 2012
	*/
	function dashboard(){
		
		if(@$_SESSION['User']['reload'] == 1){
			$_SESSION['User']['reload'] = 0;
			$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
		}
		
		//Set flag value :: Start
		$exist = $this->FlagSetting->find('first',array('conditions'=>array('FlagSetting.user_id'=>$_SESSION['Auth']['User']['id'])));
		if(empty($exist)){
			$this->setting_default_flagValues($_SESSION['Auth']['User']['id']);
		}
		//Set flag value :: End
		
		$this->layout = "group_dashboard";
		
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
		$criteria .= " and (User.manager_id = '".$_SESSION['Auth']['User']['id'].")')";
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
		
		//$allGroups = $this->UserGroup->find('list',array('conditions'=>array("OR"=>array(array('UserGroup.group_owner'=>0, 'UserGroup.status'=>1),array('UserGroup.group_owner'=>$_SESSION['Auth']['User']['id'], 'UserGroup.status'=>1))),'fields'=>array('UserGroup.id','UserGroup.title')));
		//$this->set(compact('allGroups'));
		
		$allGroups = $this->Cohort->find('list',array('conditions'=>array("OR"=>array(array('Cohort.group_owner'=>0, 'Cohort.status'=>1),array('Cohort.group_owner'=>$_SESSION['Auth']['User']['id'], 'Cohort.status'=>1))),'fields'=>array('Cohort.id','Cohort.title')));
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
					$criteria .= " and (User.title LIKE '%".$value1."%')";
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
		//pr($criteria);
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','User Groups');
		
		/** sorting and search */
		if($this->RequestHandler->isAjax()==0)
			$this->layout = 'group_dashboard';
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
			'limit' => 30,
			'recursive'=>2,
			'order' => array(
				'User.id' => 'DESC'
			)
		);
		//pr($criteria);
		$this->set('pagetitle',"User List");                
		$this->set('userList', $this->paginate('User',$criteria));
		//pr($this->paginate('User',$criteria)); die;
	}
	
	/** 
	@function : add_user
	@description : add new user by group manages
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan 14, 2013
	*/
	function add_user($id=null){
		$id = base64_decode($id);
		$this->set(compact('id'));
		$this->User->id = $id;
		
		$this->set('pagetitle','Add User');
		$this->layout = "inner_pages";
		if(empty($this->data)){
			$this->data = $this->User->read();
			$selecedUserType = $this->ManagerUser->find('first',array('conditions'=>array('ManagerUser.user_id'=>$id)));
			$this->set('selectedUserType',$selecedUserType['ManagerUser']['type']);
		}
		else
		{
			//echo $id; echo '<br>'; pr($this->data); die;
			if($this->data['User']['action'] != ''){ // If delete
				//echo $id;
				//echo '<pre>'; print_r($this->data); die;
				$newStatus = NULL;
				$grpStatus = 0;
				$free_subscription_start = date('Y-m-d').' 23:59:59';
				$this->User->updateAll(array('User.manager_id'=>"'$newStatus'", 'User.group_payment_status'=>"'$grpStatus'", 'User.free_subscription_start'=>"'$free_subscription_start'"),array('User.id'=>$id)); 
				$this->accessDelEmail($id); //Send email to user
				
				//Add entry in transaction table :: Start
				$this->loadModel('Transaction');
				$tranArr = array();
				
				$tranArr['Transaction']['type'] = 'free'; //For next 30 days
				$tranArr['Transaction']['user_id'] = $id;
				$tranArr['Transaction']['sub_date'] = date('Y-m-d H:i:s');
				
				$thirtyDaysPlus = strtotime('+30 days' , strtotime (date('Y-m-d H:i:s')));
				$after30Days = date('Y-m-d H:i:s', $thirtyDaysPlus);
				
				$tranArr['Transaction']['expiry_date'] = $after30Days;
				
				$this->Transaction->save($tranArr);
				//Add entry in transaction table :: Start
				
				$this->Session->setFlash('User deleted successfully', 'default', array('class' => 'flash_success'));
				$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
			}
			
			$this->data['User']['manager_id'] = $_SESSION['Auth']['User']['id'];
			$newPassword = $this->random_gen(2);
			$randomPassword = Security::hash (Configure::read ('Security.salt') . $newPassword);
			$this->data['User']['password'] = $randomPassword;
			if($this->data['ManagerUser']['type'] == 2){ //Admin user
				$this->data['User']['group_payment_status'] = 1;
			} else{ //Normal user
				$this->data['User']['individual_payment_status'] = 1;	
			}
			//$this->data['User']['status'] = $this->data['User']['status'];
			$this->data['User']['invitation_time'] = date("Y-m-d H:i:s");
			
			//pr($this->data); die;
			
			$existUser = $this->User->find('first',array('conditions'=>array('User.email'=>$this->data["User"]["email"])));
			
			//if(empty($existUser) || $id == ""){
			if(empty($existUser)){ 
				$this->data['User']['id'] = ($existUser['User']['id'] != "")?$existUser['User']['id']:$id;
				
				//pr($this->data); //die;
				if($this->User->save($this->data['User'])){
					//echo 'save'; die;	
					/*Add all shared (to group) missions to the user*/
					$recentUserId = $this->data['User']['id'];
					if($recentUserId == ""){
						$recentUserId = $this->User->getLastInsertId();
					}
					//echo $recentUserId; die;
					//Set Schedule balance vars
					$this->add_default_values($recentUserId);
					
					//Save entry in communication ::Start
					if($this->data['User']['id'] == ""){
						$comArr = array();
						$comArr['Communication']['user_id'] = $recentUserId;
						
						$this->Communication->save($comArr);
					}
					//Save entry in communication ::End
					
					$missionSharedWithGroup = $this->Mission->find('all',array('conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_with'=>'group'),'fields'=>array('Mission.id')));
					//pr($missionSharedWithGroup); die;
					if($recentUserId != ""){
						foreach($missionSharedWithGroup as $missionId){
							$this->data['MissionUser']['mission_id'] = $missionId['Mission']['id'];
							$this->data['MissionUser']['shared_with_id'] = $recentUserId;
							$this->MissionUser->create();
							$this->MissionUser->save($this->data['MissionUser']);
						}
					}
					/*** *** ****/
					
					$this->data['ManagerUser']['manager_id'] = $_SESSION['Auth']['User']['id'];
					if($id == ""){
						$this->data['ManagerUser']['user_id'] = $this->User->getLastInsertId();
					}else {
						$this->ManagerUser->deleteAll(array('ManagerUser.user_id'=>$id));
						$this->data['ManagerUser']['user_id'] = $id;
					}
					$this->ManagerUser->save($this->data['ManagerUser']);
					//echo $id; die;
					if($id == ""){
						//Entry in user_groups_user table
						$lastUserId = $this->User->getLastInsertId();
						$this->data['UserGroupsUser']['user_id'] = $lastUserId;
						$this->UserGroupsUser->save($this->data['UserGroupsUser']);
						
						
						/***** Send Email to User :: Start *****/
						//fetch out the user info
						$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$lastUserId)));
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
						
						//Fetch content of 'Email_Template'
						$template = $this->Common->getEmailTemplate(6);
						
						$this->Email->from = INFO_EMAIL;
						$this->Email->additionalParams = '-f support@vimbli.com'; //if mail gets failed
						
						$this->Email->subject = $template['EmailTemplate']['subject'];
						$data=$template['EmailTemplate']['description'];
						$expName = explode(' ',trim($userInfo['User']['name']));
						$first_name = $expName[0];
						$data=str_replace('{NAME}',$first_name,$data);
						$data=str_replace('{GROUP_MANAGER}',$_SESSION['Auth']['User']['name'],$data);
						$data=str_replace('{EMAIL}',$userInfo['User']['email'],$data);
						$data=str_replace('{PASSWORD}',$newPassword,$data);
						//echo $newPassword; die;
						$hashedId = base64_encode($lastUserId);
						$login_link = '<a href='.SITE_URL.'users/activate_user/'.$hashedId.'>'.SITE_URL.'users/login</a>';
						$data=str_replace('{LOGIN_LINK}',$login_link,$data);
						
						$this->set('data',$data);
						$this->Email->to = $userInfo['User']['email'];
						$this->Email->template='commanEmailTemplate';
						$this->Email->send();
						/***** Send Email to User :: End *****/
					//echo 1;
					}
					//echo 2; die;
					$this->Session->setFlash('User saved successfully. An email has been sent to the user with his/her login details.', 'default', array('class' => 'flash_success'));
					$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
				} else {
					$this->Session->setFlash('There is some problem. Please try later.', 'default', array('class' => 'flash_error'));
				}
			} else { //email exist in vimbli
				
				//If editing the user:: Start (added on Aug. 20)
				if($id != ""){
					$this->User->save($this->data);
				}
				//Editing user::End
				
				if(($existUser['User']['manager_id'] != "") AND ($existUser['User']['manager_id'] != 0)){ //User is already under some group
					if($existUser['User']['manager_id'] == $_SESSION['Auth']['User']['id']){
						
						if($this->data['ManagerUser']['type'] == 1){ //Applied for Normal/Individual user
							if($existUser['User']['individual_payment_status'] == 1 AND $existUser['User']['group_payment_status'] == 0){
								$this->Session->setFlash('User already existed in group as normal user.', 'default', array('class' => 'flash_success'));
							} elseif($existUser['User']['individual_payment_status'] == 0 AND $existUser['User']['group_payment_status'] == 1){
								$status = 1;
								$this->User->updateAll(array('User.individual_payment_status'=>"'$status'"),array('User.id'=>$existUser['User']['id']));
								
								//Set Schedule balance vars
								$this->add_default_values($existUser['User']['id']);
								
								//Save entry in communication ::Start
								$comArr = array();
								$comArr['Communication']['user_id'] = $existUser['User']['id'];
								
								$this->Communication->save($comArr);
								//Save entry in communication ::End
								
								$this->Session->setFlash('User added successfully.', 'default', array('class' => 'flash_success'));
								//SEND EMAIL TO ADDED USER
								$this->sendEmailToUser($existUser['User']['id'], 8);
							} else {
								$new_status = $this->data['User']['status'];
								$this->User->updateAll(array('User.status'=>"'$new_status'"),array('User.id'=>$existUser['User']['id']));
								$this->Session->setFlash('User already exists in the group. Status updated successfully.', 'default', array('class' => 'flash_success'));
							}
						} else { //Applied for Group Admin
							
							if($existUser['User']['individual_payment_status'] == 1 AND $existUser['User']['group_payment_status'] == 0){
								$status = 1;
								$this->User->updateAll(array('User.group_payment_status'=>"'$status'"),array('User.id'=>$existUser['User']['id']));
								
								$new_status = $this->data['User']['status'];
								$this->User->updateAll(array('User.status'=>"'$new_status'"),array('User.id'=>$existUser['User']['id']));
								
								$this->Session->setFlash('User added successfully.', 'default', array('class' => 'flash_success'));
								//SEND EMAIL TO ADDED USER
								$this->sendEmailToUser($existUser['User']['id'], 9);
							} elseif($existUser['User']['individual_payment_status'] == 0 AND $existUser['User']['group_payment_status'] == 1){
								$this->Session->setFlash('User already existed in group as group admin.', 'default', array('class' => 'flash_success'));
							} else {
								$new_status = $this->data['User']['status'];
								$this->User->updateAll(array('User.status'=>"'$new_status'"),array('User.id'=>$existUser['User']['id']));
								//$this->Session->setFlash('User already exists in the group.', 'default', array('class' => 'flash_success'));
								$this->Session->setFlash('User already exists in the group. Status updated successfully.', 'default', array('class' => 'flash_success'));
							}
						}
					} else {
						$this->Session->setFlash('User already exists in another group. Please request user to end the other membership before adding the user again.', 'default', array('class' => 'flash_success'));
					}
					//$this->redirect(array('controller'=>'groups','action'=>'add_user'));
					$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
					
				} else { //User can be added
					$rec = array();
					$rec['User']['id'] = $existUser['User']['id'];
					if($this->data['ManagerUser']['type'] == 2){ //Admin user
						$rec['User']['group_payment_status'] = 1;
					} else{ //Normal user
						$rec['User']['individual_payment_status'] = 1;	
					}
					$rec['User']['manager_id'] = $_SESSION['Auth']['User']['id'];
					$this->User->save($rec['User']);
					
					/*Add all shared (to group) missions to the user*/
					$recentUserId = $existUser['User']['id'];
					$missionSharedWithGroup = $this->Mission->find('all',array('conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_with'=>'group'),'fields'=>array('Mission.id')));
					//pr($missionSharedWithGroup); die;
					foreach($missionSharedWithGroup as $missionId){
						$this->data['MissionUser']['mission_id'] = $missionId['Mission']['id'];
						$this->data['MissionUser']['shared_with_id'] = $recentUserId;
						$this->MissionUser->create();
						$this->MissionUser->save($this->data['MissionUser']);
					}
					/*** *** ****/
					
					//SEND EMAIL TO ADDED USER
					$this->sendEmailToUser($existUser['User']['id'], 8);
					
					$this->Session->setFlash('User added to the group.', 'default', array('class' => 'flash_success'));
					$this->redirect(array('controller'=>'groups','action'=>'dashboard'));	
				}
				
			} 
			
		}
	}
	
	/** 
	@function : perform_actions 
	@description : perform various action from dashboard page,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 15, 2013
	*/
	function perform_actions()
	{
		//pr($this->data); die;
		if($this->data['User']['action'] == 'delete')
		{
			foreach($this->data['User']['ids'] as $ids){
				//$this->User->delete($ids, true);
				//$newStatus = NULL;
				//$this->User->updateAll(array('User.manager_id'=>"'$newStatus'"),array('User.id'=>$ids));
				
				$newStatus = NULL;
				$grpStatus = 0;
				$free_subscription_start = date('Y-m-d').' 23:59:59';
				$this->User->updateAll(array('User.manager_id'=>"'$newStatus'", 'User.group_payment_status'=>"'$grpStatus'", 'User.free_subscription_start'=>"'$free_subscription_start'"),array('User.id'=>$ids)); 
				$this->accessDelEmail($ids); //Send email to user
				
				//Add entry in transaction table :: Start
				$this->loadModel('Transaction');
				$tranArr = array();
				
				$tranArr['Transaction']['type'] = 'free'; //For next 30 days
				$tranArr['Transaction']['user_id'] = $ids;
				$tranArr['Transaction']['sub_date'] = date('Y-m-d H:i:s');
				
				$thirtyDaysPlus = strtotime('+30 days' , strtotime (date('Y-m-d H:i:s')));
				$after30Days = date('Y-m-d H:i:s', $thirtyDaysPlus);
				
				$tranArr['Transaction']['expiry_date'] = $after30Days;
				
				$this->Transaction->save($tranArr);
				
			}
			
			$this->Session->setFlash('User deleted successfully', 'default', array('class' => 'flash_success'));
		}
		
		else if($this->data['User']['action'] == 'grouping')
		{
			foreach($this->data['User']['ids'] as $ids):
				$cohort_id = $this->data['CohortUser']['cohort_id'];
				
				$existed = $this->CohortUser->find('first',array('conditions'=>array('CohortUser.user_id'=>$ids)));
				
					if($existed['CohortUser']['id'] != "")
					{ 
					$this->CohortUser->updateAll(array('CohortUser.cohort_id'=>"'$cohort_id'"),array('CohortUser.id'=>$existed['CohortUser']['id'])); 
					} else { 
						$this->data['CohortUser']['user_id'] = $ids;
						$this->data['CohortUser']['cohort_id'] = $cohort_id;
						$this->CohortUser->create();
						$this->CohortUser->save($this->data);
					}
			endforeach;
			$this->Session->setFlash('User cohort updated successfully.', 'default', array('class' => 'flash_success'));
		}
		
		else if($this->data['User']['action'] == 'activate')
		{
			foreach($this->data['User']['ids'] as $ids):
				$status = 1;
					$this->User->updateAll(array('User.status'=>"'$status'"),array('User.id'=>$ids));
					$this->Session->setFlash('User activated successfully.', 'default', array('class' => 'flash_success'));
			endforeach;
		}
		else if($this->data['User']['action'] == 'deactivate')
		{
			foreach($this->data['User']['ids'] as $ids):
				$status = 0;
				$this->User->updateAll(array('User.status'=>"'$status'"),array('User.id'=>$ids));
			endforeach;
			$this->Session->setFlash('User deactivated successfully.', 'default', array('class' => 'flash_success'));
		}
		
		$this->redirect(array('controller'=>'groups','action'=>'dashboard',base64_encode($_SESSION['Auth']['User']['id'])));
	}
	
	
	/** 
	@function : cohorts
	@description : list all user cohorts
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 14, 2013
	*/ 
	function cohorts(){
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
		$criteria .= " and (Cohort.group_owner = '".$_SESSION['Auth']['User']['id']."' OR Cohort.group_owner = 0)";
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
					$criteria .= " and (Cohort.title LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and Cohort.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and Cohort.status = '".$matchshow."'";
					$this->set('show',$show);
				}
			}
			
		}
		//pr($criteria);
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','User Groups');
		
		/** sorting and search */
		if($this->RequestHandler->isAjax()==0)
			$this->layout = 'group_dashboard';
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
				'Cohort.id' => 'DESC'
			)
		);
		//pr($criteria);
		$this->set('pagetitle',"User Groups");                
		$this->set('userGroupList', $this->paginate('Cohort',$criteria));
		//pr($this->paginate('UserGroup',$criteria)); die;
	}
	
	
	/**
	@function:add_group 
	@description		Add Cohort
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date : Jan 14, 2013
	*/
	function add_cohort($id=null){ 
  		$id = base64_decode($id);
		$this->layout = 'inner_pages';	
  		
		$this->set('pagetitle',"Add Cohort");
		$this->Cohort->id = $id;
		$admin_id=0;
		if(empty($this->data)){
			$this->data = $this->Cohort->read();
		}else if(!empty($this->data)){	
			$this->Cohort->set($this->data);
			if($this->Cohort->validates()){
				//pr($this->data); die;
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
	
				//$this->data['Cohort']['title'] = ucwords(strtolower($this->data['Cohort']['title']));
				$this->data['Cohort']['status'] = '1';
				$this->data['Cohort']['group_owner'] = $_SESSION['Auth']['User']['id'];

				if($this->Cohort->save($this->data)) {
					$userGroupId = $this->Cohort->getLastInsertId();						
			
						$condition=array('Cohort.id'=>$userGroupId);
						$user_group = $this->Cohort->find('first',array('conditions'=>$condition,'fields'=>array('id','title','description')));
						
						//SEND EMAIL TO ADDED USER
										
						$this->Session->setFlash('Cohort has been saved successfully.', 'default', array('class' => 'flash_success'));
						$this->redirect('cohorts');
				}
				
			} else{
				$errorArray = $this->Cohort->validationErrors;
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
		if($this->data['Cohort']['action'] == 'delete')
		{
			foreach($this->data['Cohort']['ids'] as $ids){
				$this->Cohort->delete($ids, true);
			}
			$this->Session->setFlash('Cohort has been deleted successfully', 'default', array('class' => 'flash_success'));
		}
		
		else if($this->data['Cohort']['action'] == 'activate')
		{
			foreach($this->data['Cohort']['ids'] as $ids):
				$status = 1;
				$this->Cohort->updateAll(array('Cohort.status'=>"'$status'"),array('Cohort.id'=>$ids));
			endforeach;
			$this->Session->setFlash('Group activated successfully.', 'default', array('class' => 'flash_success'));
		}
		else if($this->data['Cohort']['action'] == 'deactivate')
		{
			foreach($this->data['Cohort']['ids'] as $ids):
				$status = 0;
				$this->Cohort->updateAll(array('Cohort.status'=>"'$status'"),array('Cohort.id'=>$ids));
			endforeach;
			$this->Session->setFlash('Cohort deactivated successfully.', 'default', array('class' => 'flash_success'));
		}
		else if($this->data['Cohort']['action'] == 'edit')
		{
			$this->redirect(array('controller'=>'groups','action'=>'add_cohort',base64_encode($this->data['Cohort']['ids'][0])));
		}
		
		$this->redirect(array('controller'=>'groups','action'=>'cohorts'));
	}
	
	
	/** 
	@function : send_message
	@description : send_message to user
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan 16, 2013
	*/
	function send_message($id=null){
		$id = base64_decode($id);
		$this->set(compact('id'));
		
		$this->set('pagetitle','Send Message');
		$this->layout = "inner_pages";
		
		//Users of group
		$allUsers = $this->User->find('list',array('conditions'=>array('User.manager_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('User.id','User.name')));
		$this->set(compact('allUsers'));
		//Cohort List
		$cohortList = $this->Cohort->find('list',array('conditions'=>array('Cohort.group_owner'=>$_SESSION['Auth']['User']['id']),'fields'=>array('Cohort.id','Cohort.title')));
		$this->set(compact('cohortList'));
		
		if(!empty($this->data))
		{
			$this->data['Message']['from_user_id'] = $_SESSION['Auth']['User']['id'];
			
			if($this->data['Message']['msg_to'] == 'individual')
			{
				foreach($this->data['User']['user_id'] as $row){
					//echo '<pre>'; print_r($this->data);
					$this->data['Message']['to_user_id'] = $row;
					$this->data['Message']['created'] = date('Y-m-d H:i:s');
					$this->data['Message']['local_message_time'] = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'));
					$this->Message->create();
					$this->Message->save($this->data);
					
					$emailOfUser = $this->User->find('first',array('conditions'=>array('User.id'=>$row),'fields'=>array('User.email')));
					//echo '====<br><pre>'; print_r($emailOfUser);
					//Send Email
					$from = $_SESSION['Auth']['User']['email'];
					$headers = "From:" . $from;
					mail($emailOfUser['User']['email'],$this->data['Message']['subject'],strip_tags($this->data['Message']['content']),$headers);
					
				}
			}
			else if($this->data['Message']['msg_to'] == 'cohort')
			{
				foreach($this->data['Cohort']['cohort_id'] as $row){
					$cohortUsers = $this->CohortUser->find('all',array('conditions'=>array('CohortUser.cohort_id'=>$row),'fields'=>array('CohortUser.user_id')));
					
					foreach($cohortUsers as $row){
					$this->data['Message']['to_user_id'] = $row['CohortUser']['user_id'];
					$this->data['Message']['created'] = date('Y-m-d H:i:s');
					$this->data['Message']['local_message_time'] = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'));
					$this->Message->create();
					$this->Message->save($this->data);
					
					$emailOfUser = $this->User->find('first',array('conditions'=>array('User.id'=>$row['CohortUser']['user_id']),'fields'=>array('User.email')));
					//Send Email
					$from = $_SESSION['Auth']['User']['email'];
					$headers = "From:" . $from;
					mail($emailOfUser['User']['email'],$this->data['Message']['subject'],strip_tags($this->data['Message']['content']),$headers);
				}
				}	
			}
			else if($this->data['Message']['msg_to'] == 'group')
			{
				$groupUsers = $this->User->find('all',array('conditions'=>array('User.manager_id'=>$_SESSION['Auth']['User']['id']),'fields'=>array('User.id')));
				//pr($groupUsers);die;
				foreach($groupUsers as $row){
					$this->data['Message']['to_user_id'] = $row['User']['id'];
					$this->data['Message']['created'] = date('Y-m-d H:i:s');
					$this->data['Message']['local_message_time'] = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'));
					$this->Message->create();
					$this->Message->save($this->data);
					
					$emailOfUser = $this->User->find('first',array('conditions'=>array('User.id'=>$row['User']['id']),'fields'=>array('User.email')));
					//Send Email
					$from = $_SESSION['Auth']['User']['email'];
					$headers = "From:" . $from;
					mail($emailOfUser['User']['email'],$this->data['Message']['subject'],strip_tags($this->data['Message']['content']),$headers);
				}
			}
			else{
				$this->data['Message']['created'] = date('Y-m-d H:i:s');
				$this->data['Message']['local_message_time'] = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'));
				$this->Message->save($this->data);
				
				$emailOfUser = $this->User->find('first',array('conditions'=>array('User.id'=>$this->data['Message']['to_user_id']),'fields'=>array('User.email')));
				//Send Email
				$from = $_SESSION['Auth']['User']['email'];
				$headers = "From:" . $from;
				mail($emailOfUser['User']['email'],$this->data['Message']['subject'],strip_tags($this->data['Message']['content']),$headers);
			
			}			
			
			$this->Session->setFlash('Message sent successfully.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
		}
	}
	
	/** 
	@function : add_sponsor
	@description : add new sponsor by group manages
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan 17, 2013
	*/
	function add_sponsor($id=null){
		$id = base64_decode($id);
		$this->set(compact('id'));
		$this->User->id = $id;
		
		$this->set('pagetitle','Add User');
		$this->layout = "inner_pages";
		if(empty($this->data)){
			$this->data = $this->User->read();
			$selecedUserType = $this->ManagerUser->find('first',array('conditions'=>array('ManagerUser.user_id'=>$id)));
			$this->set('selectedUserType',$selecedUserType['ManagerUser']['type']);
		}
		else
		{
			//prx($this->data);die;
			//$this->data['User']['manager_id'] = $_SESSION['Auth']['User']['id'];
			$newPassword = $this->random_gen(2);
			$randomPassword = Security::hash (Configure::read ('Security.salt') . $newPassword);
			$this->data['User']['password'] = $randomPassword;
			$this->data['User']['status'] = 1;
			$this->data['User']['is_sponsor'] = 1;
			$this->data['User']['user_type'] = 3;
			//$this->data['User']['invitation_time'] = date("Y-m-d H:i:s");
			
			//Find if already exist
			$existSponsor = $this->User->find('first',array('conditions'=>array('User.email'=>$this->data["User"]["email"])));
			//echo pr($existSponsor); exit;
			if(empty($existSponsor)){ 
				if($this->User->save($this->data['User'])){
					
					$this->data['SponsorManager']['manager_id'] = $_SESSION['Auth']['User']['id'];
					if($id == ""){
						$this->data['SponsorManager']['sponsor_id'] = $this->User->getLastInsertId();
					}else {
						$this->SponsorManager->deleteAll(array('SponsorManager.user_id'=>$id));
						$this->data['SponsorManager']['sponsor_id'] = $id;
					}
					$this->SponsorManager->save($this->data['SponsorManager']);
					
					if($id == ""){
					//Entry in user_groups_user table
					$lastUserId = $this->User->getLastInsertId();
					
					/***** Send Email to User :: Start *****/
					//fetch out the user info
					$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$lastUserId)));
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
					
					//Fetch content of 'FORGOT_PASSWORD'
					$template = $this->Common->getEmailTemplate(7);
					
					$this->Email->from = $_SESSION['Auth']['User']['name'].'<'.$_SESSION['Auth']['User']['email'].'>';;
					$this->Email->subject = $template['EmailTemplate']['subject'];
					$data=$template['EmailTemplate']['description'];
					$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
					$data=str_replace('{GROUP_MANAGER}',$_SESSION['Auth']['User']['name'],$data);
					$data=str_replace('{EMAIL}',$userInfo['User']['email'],$data);
					$data=str_replace('{PASSWORD}',$newPassword,$data);
					$data=str_replace('{SENDER}',strtok($_SESSION['Auth']['User']['name'], " "),$data);
					
					//$hashedId = base64_encode($lastUserId);
					$login_link = '<a href='.SITE_URL.'users/login/first_login>'.SITE_URL.'users/login</a>';
					$data=str_replace('{LOGIN_LINK}',$login_link,$data);
					
					$this->set('data',$data);
					$this->Email->to = $userInfo['User']['email'];
					$this->Email->template='commanEmailTemplate';
					$this->Email->send();
				/***** Send Email to User :: End *****/
					}	
					$this->Session->setFlash('Sponsor saved successfully. An email has been sent to the sponsor with his/her login details.', 'default', array('class' => 'flash_success'));
					if($_SESSION['Auth']['User']['user_type'] == 2){
						$this->redirect(array('controller'=>'groups','action'=>'dashboard'));	
					} else {
						$this->redirect(array('controller'=>'users','action'=>'welcome'));
					}
					
				}else {
					$this->Session->setFlash('There is some problem. Please try later.', 'default', array('class' => 'flash_error'));
				}
			}else{
				$existForThisUser = $this->SponsorManager->find('first',array('conditions'=>array('SponsorManager.sponsor_id'=>$existSponsor['User']['id'],'SponsorManager.manager_id'=>$_SESSION['Auth']['User']['id'])));
				
				if(empty($existForThisUser)){
				$isSponsor = 1;
				$this->User->updateAll(array('User.is_sponsor'=>"'$isSponsor'"),array('User.id'=>$existSponsor['User']['id']));
				$rec = array();
				$rec['SponsorManager']['sponsor_id'] = $existSponsor['User']['id'];
				$rec['SponsorManager']['manager_id'] = $_SESSION['Auth']['User']['id'];
				$this->SponsorManager->save($rec['SponsorManager']);
				
				/***** Send Email to User :: Start *****/
					//fetch out the user info
					$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$existSponsor['User']['id'])));
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
					
					//Fetch content of 'FORGOT_PASSWORD'
					$template = $this->Common->getEmailTemplate(10);
					
					$this->Email->from = $_SESSION['Auth']['User']['name'].'<'.$_SESSION['Auth']['User']['email'].'>';
					$this->Email->subject = $template['EmailTemplate']['subject'];
					$data=$template['EmailTemplate']['description'];
					$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
					$data=str_replace('{GROUP_MANAGER}',$_SESSION['Auth']['User']['name'],$data);
					$data=str_replace('{SENDER}',strtok($_SESSION['Auth']['User']['name'], " "),$data);
					
					//$hashedId = base64_encode($lastUserId);
					$login_link = '<a href='.SITE_URL.'users/login>'.SITE_URL.'users/login</a>';
					$data=str_replace('{LOGIN_LINK}',$login_link,$data);
					
					$this->set('data',$data);
					$this->Email->to = $userInfo['User']['email'];
					$this->Email->template='commanEmailTemplate';
					$this->Email->send();
				/***** Send Email to User :: End *****/
				
				$this->Session->setFlash('The email already exists on Vimbli, we have added sponsor rights and have sent a notification to the owner', 'default', array('class' => 'flash_success'));
				}else{
					$this->Session->setFlash('This user is already exists as your sponsor.', 'default', array('class' => 'flash_success'));
				}
			}
			//pr($this->data); die;
		}
	}
	
	/** 
	@function : message_list
	@description : Listing of messages
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan 21, 2013
	*/
	function message_list($id=null){
		$id = base64_decode($id);
		
		$this->layout = 'group_dashboard';	
  		$this->set('pagetitle',"Message List");
		
		$allMessages = $this->Message->find('all',array('conditions'=>array("OR"=>array(array('Message.to_user_id'=>$_SESSION['Auth']['User']['id'], 'Message.from_user_id'=>$id),array('Message.from_user_id'=>$_SESSION['Auth']['User']['id'], 'Message.to_user_id'=>$id))),'order'=>'Message.created DESC'));
		$this->set(compact('allMessages'));
		//pr($allMessages); die;
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
		$this->layout = 'group_dashboard';
		$sharedMission = $this->Mission->find('all',array('conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_by_gm'=>1),'order'=>'Mission.id DESC'));
		
		//pr($sharedMission); die;
		$this->set(compact('sharedMission'));
	}
	
	
	/**
	@function: view
	@description		Mission detail page
	@Created by: 		Vikas Uniyal
	@Modify:		
	@Created Date:		Jan. 03, 2013
	*/
	function view_mission($id=NULL){
		$this->set('pagetitle','View Mission');
		$this->layout = "individual_dashboard";
		if($id == ""){ 
			$missionDetail = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id']),'order'=>'Mission.id DESC','recursive'=>2));
		}else{
			$id= base64_decode($id);
			$missionDetail = $this->Mission->find('first',array('conditions'=>array('Mission.id'=>$id),'order'=>'Mission.id DESC','recursive'=>2));
		}
		if(!empty($missionDetail)){
			$this->set(compact('missionDetail'));
		} else {
			$this->Session->setFlash('No mission to display.', 'default', array('class' => 'flash_success'));
			$this->redirect($this->referer());
		}
		//pr($missionDetail); die;
	}
	
	
	
	
	
	/**
	@function: export
	@description		export
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Dec. 26, 2012
	*/
	function export(){
		
		$this->layout = "group_dashboard";
		$this->set('pagetitle','Export data');
	}
	
	/** 
	@function : export_data 
	@description : Export user data for GM
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jul. 05, 2013
	*/
	function export_users() {
		
		$this->layout=false;
		$this->autoRender=false;
		Configure::write('debug',0);
		
		$data =" User, Added, Active/Inactive, Date status changed, Cohort, Sponsor, Sponsor name, Mission, Total days, Days remaining, Last daily reflection, Total daily reflections (30 days), Total ratings, Access, Action flag \n";
		$data .="\n"; // Add blank row
		
		$userInfo = $this->User->find('all',array('conditions'=>array('User.manager_id'=>$_SESSION['Auth']['User']['id']),'recursive'=>2));
	        //echo '<pre>'; print_r($userInfo); die;
	      
		foreach($userInfo as $user)
		{
			$activationDate = ($user['User']['activation_date'] != '')?date('M-d-Y',strtotime($user['User']['activation_date'])):date('M-d-Y',strtotime($user['User']['created']));
			$cohortName = ($user['CohortUser']['Cohort']['title'] != '')?$user['CohortUser']['Cohort']['title']:'--';
			
			//Fetch data related to each user :: Start
			$status = ($user['User']['status'] == 1)?'Active':'Inactive';
			$recentMission = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$user['User']['id'],'Mission.shared_by_gm'=>0), 'order'=>'Mission.id DESC'));
			//echo '<pre>'; print_r($recentMission); //die;
			if((!empty($recentMission)) AND ($recentMission['Mission']['end_time'] >= $this->Common->userTime($usrData['User']['timezone'],date('Y-m-d H:i:s')))){
				if($recentMission['Mission']['sponsor_id'] != ""){
					$sponsorDate = date('M-d-Y', strtotime($recentMission['Mission']['sponsor_add_date']));;
					$sponsorName = $recentMission['Sponsor']['name'];	
				}
				
				$missionUpdated = date('M-d-Y',strtotime($recentMission['Mission']['modified']));
				
				$total_days = round((strtotime($recentMission['Mission']['end_time'])-strtotime($recentMission['Mission']['start_time']))/86400);
				$elapsed_days = round((strtotime($this->Common->userTime($usrData['User']['timezone'],date('Y-m-d 23:59:59')))-strtotime($recentMission['Mission']['start_time']))/86400);
				$daysRemaining = $total_days-$elapsed_days;
				$daysRemaining = ($daysRemaining >=1)?$daysRemaining:0;
				
			}else{
				$sponsorDate = $sponsorName = $missionUpdated = $total_days = $daysRemaining = '--';
			}
			
			//Reflection
			$refData = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.user_id'=>$user['User']['id']),'order'=>'UserReflection.id DESC'));
			if(!empty($refData)){
				$refDate = date('M. d',strtotime($refData['UserReflection']['modified']));
			}else{
				$refDate = '--';	
			}
			
			//Reflection in last 30 days
			$today = $this->Common->userTime($user['User']['timezone'],date('Y-m-d H:i:s'));
			$thirtyDaysAgo = strtotime('-30 days' , strtotime ($today));
			$oneMonthAgoDate = date('Y-m-d H:i:s', $thirtyDaysAgo);
			
			$refDataIn30Days = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$user['User']['id'],'UserReflection.local_reflection_date >='=>$oneMonthAgoDate)));
			if(!empty($refDataIn30Days)){
				$totalRef = $refDataIn30Days;
			}else{
				$totalRef = '--';	
			}
			
			//Rated in last 30 days
			$ratedRef = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$user['User']['id'],'UserReflection.rating_today <>'=>0,'UserReflection.local_reflection_date >='=>$oneMonthAgoDate)));
			$calEvent = $this->CalendarEvent->find('count',array('conditions'=>array('CalendarEvent.user_id'=>$user['User']['id'],'CalendarEvent.rating <>'=>0,'CalendarEvent.local_start >='=>$oneMonthAgoDate)));
			$act = $this->Activity->find('count',array('conditions'=>array('Activity.activity_owner'=>$user['User']['id'],'Activity.rating <>'=>0,'Activity.local_start >='=>$oneMonthAgoDate)));
			$emails = $this->ImportEmail->find('count',array('conditions'=>array('ImportEmail.user_id'=>$user['User']['id'],'ImportEmail.rating <>'=>0,'ImportEmail.local_email_date >='=>$oneMonthAgoDate)));
			$mission = $this->Mission->find('count',array('conditions'=>array('Mission.owner'=>$user['User']['id'],'Mission.shared_by_gm'=>0,'Mission.rating <>'=>0,'Mission.start_time >='=>$oneMonthAgoDate)));
			
			$totalRated = 0;
			$totalRated = $ratedRef+$calEvent+$act+$emails+$mission;
			$totalRated = ($totalRated > 0)?$totalRated:'--';
			
			//Access level
			$accessLevels = '';
			if($user['User']['individual_payment_status'] == 1){
				$accessLevels = $accessLevels.'Ind/ ';
			}if($user['User']['group_payment_status'] == 1){
				$accessLevels = $accessLevels.'Grp/ ';
			}if(!empty($user['SponsorManager'])){
				$accessLevels = $accessLevels.'Sp/ ';
			}
			
			$accessLevels = substr($accessLevels,0,strlen($accessLevels)-2);
			
			//Flags
			if($user['User']['status'] == 0){ // If user is inactive
				$flag = 'Gray';
			}else{
				if((!empty($recentMission)) AND ($recentMission['Mission']['end_time'] >= $this->Common->userTime($user['User']['timezone'],date('Y-m-d H:i:s')))){
					//Fetch flag params values
					$flagParms = $this->FlagSetting->find('first',array('conditions'=>array('FlagSetting.user_id'=>$_SESSION['Auth']['User']['id'])));
					
					if($recentMission['Mission']['sponsor_id'] != ""){
						$activeSp = 1;	
					}
					
					//Last reflection
					$refOlderThen = round((strtotime($this->Common->userTime($user['User']['timezone'],date('Y-m-d 23:59:59')))-strtotime($refData['UserReflection']['local_reflection_date']))/86400);
					
					if(($recentMission['Mission']['sponsor_id'] == "") OR ($daysRemaining < $flagParms['FlagSetting']['days_remaining']) OR ($refOlderThen > $flagParms['FlagSetting']['last_reflection']) OR ($refDataIn30Days < $flagParms['FlagSetting']['total_reflection_in_30_days'])){
						$flag = 'Yellow';	
					}else{
						$flag = 'Green';
					}
					
					
				}else{
					$flag = 'Red';	
				}
			}
			
			//Fetch data related to each user :: End
			$data .=$user['User']['name'].",";
			$data .=date('M-d-Y',strtotime($user['User']['created'])).",";
			$data .=$status.",";
			$data .=$activationDate.","; //Date status changed
			$data .=$cohortName.","; //Cohort
			$data .=$sponsorDate.","; //Sponsor added date
			$data .=$sponsorName.","; //Sponsor name
			$data .=$missionUpdated.","; //Mission updated date
			$data .=$total_days.","; //Total days in mission
			$data .=$daysRemaining.","; //Days remaining
			$data .=$refDate.","; //Last reflection date
			$data .=$totalRef.","; //total reflection in 30 days
			$data .=$totalRated.","; //total event with rating
			$data .=$accessLevels.","; //Access
			$data .=$flag."\n"; //Flag
		}
		//echo '<pre>'; print_r($data); die;
		//die;
		$filename ="User_Listing_.csv";
		$fp = fopen($filename,"w");
		if($fp){
			fwrite($fp,$data);
			fclose($fp);
		}
		
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: csv" . date("Y-m-d") . ".csv");
		header( "Content-disposition: filename=User_Listing_".date("d/m/Y").".csv");
		
		/*
		header("Content-type: application/vnd.ms-excel");
		header('Content-Disposition: attachment; filename=User_Listing_'.date("d/m/Y").".csv");
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: no-cache');
		header('Content-Length: ' . filesize($filename));
		ob_clean();
		flush();
		readfile($filename);
		unlink($filename);
		*/
		print $data;
		exit;
	}
	
	/** 
	@function : export_cohort_weekly 
	@description : Export user data for GM
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jul. 09, 2013
	*/
	function export_cohort_weekly($week=null) {
	
		$this->layout=false;
		$this->autoRender=false;
		Configure::write('debug',0);
		
		//Calculate dates according to the weeks :: Start
		$lastSatDate=date('Y-m-d', strtotime('last Saturday'));
		$lastSatDate=$lastSatDate.' '.'23:59:59';
		//pr($lastSatDate); 
		$days=7*$week;
		$days=($days-1)." "."days";
		$lastSunDate = strtotime('-'.$days, strtotime ($lastSatDate));
		$lastSunDate = date('Y-m-d', $lastSunDate);
		$lastSunDate=$lastSunDate.' '.'00:00:00';
		//Calculate dates according to the weeks :: End
		
		//Find all cohort
		$allCohort = $this->Cohort->find('all',array('conditions'=>array('Cohort.group_owner'=>$_SESSION['Auth']['User']['id'])));
		
		//Generate CSV
		$data =" Week ending, Cohort, Active, Active Mission, Active Sponsor, Mission Connections, Avg Connection Status, K2S Set, Avg K2S Status, Work hours set, Scheduled WH, Scheduled All, Avg Daily Reflections, Avg Reflections per day (total), Daily Rating, Avg Event rating \n";
		$data .="\n"; // Add blank row
		$tmpCnt = 0;
		for($weekCnt = 1; $weekCnt <=$week; $weekCnt++)
		{
			// Export for group :: Start
			
			//Calculation for Group :: Start
			$lastSunDate = strtotime('-6 days', strtotime ($lastSatDate));
			$lastSunDate = date('Y-m-d', $lastSunDate).' 00:00:00';
			
			//Active user in group
			$active_user_data = $this->User->find('all',array('conditions'=>array('User.manager_id'=>$_SESSION['Auth']['User']['id'],'User.status'=>1,'User.created BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
			$active_user_in_grp = count($active_user_data);
			$active_user_in_grp = ($active_user_in_grp >= 1)?$active_user_in_grp:'--';
			
			if($active_user_in_grp < 1){
				$active_mission_grp = $active_sponsor_grp = $active_con_grp = $k2s_grp = $work_hrs = $daily_reflection = $totalRated = 'n/a';
			}else{
				//Active missions
				$active_mission_grp = $active_sponsor_grp = $active_con_grp = $k2s_grp = $totalRated = 0;
				foreach($active_user_data as $user){
					$recentMission = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$user['User']['id'],'Mission.shared_by_gm'=>0), 'order'=>'Mission.id DESC'));
					//pr($recentMission); die;
					if(!empty($recentMission)){
						$active_mission_grp = $active_mission_grp+1;
						
						//Sponsor
						if($recentMission['Mission']['sponsor_id'] != ""){
							$active_sponsor_grp = $active_sponsor_grp+1;
						}
						
						//Connections
						$active_con_grp = $active_con_grp+count($recentMission['MissionConnection']);
						$k2s_grp = $k2s_grp+count($recentMission['KeyToSuccess']);
					}
				
					//work hrs
					$Scheduled_hrs_grp = $this->ScheduleBalance->find('all',array('conditions'=>array('ScheduleBalance.user_id'=>$user['User']['id'])));
					foreach($Scheduled_hrs_grp as $s_hr){
						$day_hr = $day_hr+(strtotime($s_hr['ScheduleBalance']['end'])-strtotime($s_hr['ScheduleBalance']['start']));
					}
					
					//Reflections
					$refCnt = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$user['User']['id'], 'UserReflection.reflection_date BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
					$daily_reflection = $daily_reflection+$refCnt;
					
					//Rated event in TL
					$ratedRef = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$user['User']['id'],'UserReflection.rating_today <>'=>0,'UserReflection.reflection_date BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
					$calEvent = $this->CalendarEvent->find('count',array('conditions'=>array('CalendarEvent.user_id'=>$user['User']['id'],'CalendarEvent.rating <>'=>0,'CalendarEvent.local_start BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
					$act = $this->Activity->find('count',array('conditions'=>array('Activity.activity_owner'=>$user['User']['id'],'Activity.rating <>'=>0,'Activity.local_start BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
					$emails = $this->ImportEmail->find('count',array('conditions'=>array('ImportEmail.user_id'=>$user['User']['id'],'ImportEmail.rating <>'=>0,'ImportEmail.local_email_date BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
					$mission = $this->Mission->find('count',array('conditions'=>array('Mission.owner'=>$user['User']['id'],'Mission.shared_by_gm'=>0,'Mission.rating <>'=>0,'Mission.start_time BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
					
					$totalRated = $ratedRef+$calEvent+$act+$emails+$mission;
					//echo $totalRated; die;
				}
				
				
				$active_mission_grp = ($active_mission_grp >= 1)?$active_mission_grp:'--';
				$active_sponsor_grp = ($active_sponsor_grp >= 1)?$active_sponsor_grp:'--';
				$active_con_grp = number_format($active_con_grp/$active_mission_grp,2);
				$active_con_grp = ($active_con_grp > 0)?$active_con_grp:'--';
				$k2s_grp = number_format($k2s_grp/$active_mission_grp,2);
				$k2s_grp = ($k2s_grp > 0)?$k2s_grp:'--';
				$work_hrs = number_format($day_hr/3600,2);
				$work_hrs = ($work_hrs > 0)?$work_hrs:'--';
				//echo $daily_reflection; die;
				$daily_reflection = number_format($daily_reflection/$active_user_in_grp,2);
				$daily_reflection = ($daily_reflection > 0)?$daily_reflection:'--';
				$totalRated = number_format($totalRated/$active_user_in_grp,2);
				$totalRated = ($totalRated > 0)?$totalRated:'--';
				
			}
			//Calculation for Group :: End
			
			
			$data .=date('d M y',strtotime($lastSatDate)).","; //Week date
			$data .="Group,"; // Cohort Name
			$data .=$active_user_in_grp.","; // Active users
			$data .=$active_mission_grp.","; // Active Missions
			$data .=$active_sponsor_grp.","; // Active Sponsors
			$data .=$active_con_grp.","; // connections/active missions
			$data .="N/A,"; // Avg connection status
			$data .=$k2s_grp.","; // avg nmbr of k2s per active mission
			$data .="N/A,"; // Avg K2S status
			$data .=$work_hrs.","; // Avg work hrs per active member
			$data .="N/A,"; // % Scheduled work hrs
			$data .="N/A,"; // % Scheduled All hrs
			$data .=$daily_reflection.","; // Avg daily reflection per active user
			$data .=$totalRated.","; // Avg rated event in past week
			$data .="N/A,"; // Avg Daily Rating
			$data .="N/A, \n"; // Avg Event rating
			// Export for group :: End
			
			foreach($allCohort as $cohort){ //For cohort
				//Calculate variables :: Start
				
				//Active user in cohort
				$this->CohortUser->bindModel(array('belongsTo'=>array('User')));
				$allCohortUser = $this->CohortUser->find('all',array('conditions'=>array('CohortUser.cohort_id'=>$cohort['Cohort']['id'],'User.status'=>1,'User.created BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
				
				
				$active_user_in_co = count($allCohortUser);
				$active_user_in_co = ($active_user_in_co >= 1)?$active_user_in_co:'--';
				
				if($active_user_in_co < 1){
					$active_mission_co = $active_sponsor_co = $active_con_co = $k2s_co = $work_hrs_co = $daily_reflection_co = $totalRated_co = 'n/a';
					//$cohortName = "Group";
					$cohortName = $cohort['Cohort']['title'];
				}else{
					$cohortName = $cohort['Cohort']['title'];
					//Active missions
					$active_mission_co = $active_sponsor_co = $active_con_co = $k2s_co = $totalRated_co = 0;
					foreach($allCohortUser as $userCo){
						$recentMission = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$userCo['User']['id'],'Mission.shared_by_gm'=>0), 'order'=>'Mission.id DESC'));
						//pr($recentMission); die;
						if(!empty($recentMission)){
							$active_mission_co = $active_mission_co+1;
							
							//Sponsor
							if($recentMission['Mission']['sponsor_id'] != ""){
								$active_sponsor_co = $active_sponsor_co+1;
							}
							
							//Connections
							$active_con_co = $active_con_co+count($recentMission['MissionConnection']);
							$k2s_co = $k2s_co+count($recentMission['KeyToSuccess']);
						}
					
						//work hrs
						$Scheduled_hrs_grp = $this->ScheduleBalance->find('all',array('conditions'=>array('ScheduleBalance.user_id'=>$userCo['User']['id'])));
						foreach($Scheduled_hrs_grp as $s_hr){
							$day_hr = $day_hr+(strtotime($s_hr['ScheduleBalance']['end'])-strtotime($s_hr['ScheduleBalance']['start']));
						}
						
						//Reflections
						$refCnt = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$userCo['User']['id'], 'UserReflection.reflection_date BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
						$daily_reflection_co = $daily_reflection_co+$refCnt;
						
						//Rated event in TL
						$ratedRef = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$userCo['User']['id'],'UserReflection.rating_today <>'=>0,'UserReflection.reflection_date BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
						$calEvent = $this->CalendarEvent->find('count',array('conditions'=>array('CalendarEvent.user_id'=>$userCo['User']['id'],'CalendarEvent.rating <>'=>0,'CalendarEvent.local_start BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
						$act = $this->Activity->find('count',array('conditions'=>array('Activity.activity_owner'=>$userCo['User']['id'],'Activity.rating <>'=>0,'Activity.local_start BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
						$emails = $this->ImportEmail->find('count',array('conditions'=>array('ImportEmail.user_id'=>$userCo['User']['id'],'ImportEmail.rating <>'=>0,'ImportEmail.local_email_date BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
						$mission = $this->Mission->find('count',array('conditions'=>array('Mission.owner'=>$userCo['User']['id'],'Mission.shared_by_gm'=>0,'Mission.rating <>'=>0,'Mission.start_time BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
						
						$totalRated_co = $ratedRef+$calEvent+$act+$emails+$mission;
						//echo $totalRated; die;
					}
					
					
					$active_mission_co = ($active_mission_co >= 1)?$active_mission_co:'--';
					$active_sponsor_co = ($active_sponsor_co >= 1)?$active_sponsor_co:'--';
					$active_con_co = number_format($active_con_co/$active_mission_co,2);
					$active_con_co = ($active_con_co > 0)?$active_con_co:'--';
					$k2s_co = number_format($k2s_co/$active_mission_co,2);
					$k2s_co = ($k2s_co > 0)?$k2s_co:'--';
					$work_hrs_co = number_format($day_hr/3600,2);
					$work_hrs_co = ($work_hrs_co > 0)?$work_hrs_co:'--';
					//echo $daily_reflection; die;
					$daily_reflection_co = number_format($daily_reflection_co/$active_user_in_grp,2);
					$daily_reflection_co = ($daily_reflection_co > 0)?$daily_reflection_co:'--';
					$totalRated_co = number_format($totalRated_co/$active_user_in_grp,2);
					$totalRated_co = ($totalRated_co > 0)?$totalRated_co:'--';
					
				}
				
				//Calculate Variables :: End
				
				//Fetch data related to each user :: End
				$data .=date('d M y',strtotime($lastSatDate)).","; //Week date
				$data .=$cohortName.","; // Cohort Name
				$data .=$active_user_in_co.","; // Active users
				$data .=$active_mission_co.","; // Active Missions
				$data .=$active_sponsor_co.","; // Active Sponsors
				$data .=$active_con_co.","; // connections/active missions
				$data .="N/A,"; // Avg connection status
				$data .=$k2s_co.","; // avg nmbr of k2s per active mission
				$data .="N/A,"; // Avg K2S status
				$data .=$work_hrs_co.","; // Avg work hrs per active member
				$data .="N/A,"; // % Scheduled work hrs
				$data .="N/A,"; // % Scheduled All hrs
				$data .=$daily_reflection_co.","; // Avg daily reflection per active user
				$data .=$totalRated_co.","; // Avg rated event in past week
				$data .="N/A,"; // Avg Daily Rating
				$data .="N/A, \n"; // Avg Event rating	
				
			}
			
			$lastSatDate = strtotime('-7 days', strtotime ($lastSatDate));
			$lastSatDate = date('Y-m-d H:i:s', $lastSatDate);
			
		}
		//pr($data); die;
		$filename ="Cohort_weekly_list_.csv";
		$fp = fopen($filename,"w");
		if($fp){
			fwrite($fp,$data);
			fclose($fp);
		}
	
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: csv" . date("Y-m-d") . ".csv");
		header( "Content-disposition: filename=Cohort_weekly_list_".date("d/m/Y").".csv");
		
		/*
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=Cohort_weekly_list_'.date("d/m/Y").".csv");
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		ob_clean();
		flush();
		readfile($filename);
		unlink($filename);
		*/
		print $data;
		exit;
	}
	
	/** 
	@function : export_questions 
	@description : Export questions data for GM
	@params : NULL
	@Created by : Sunny chauhan
	@Modify : NULL
	@Created Date : Jul. 08, 2013
	*/
	function export_questions($week=null) {
		//pr($this->data); die;
		$this->loadModel('Question');
		$this->loadModel('CohortUser');
		$this->loadModel('Cohort');
		$this->layout=false;
		$this->autoRender=false;
		Configure::write('debug',0);
		$id=$week;
		$lastSatDate=date('Y-m-d', strtotime('last Saturday'));
		$lastSatDate=$lastSatDate.' '.'00:00:00';
		//pr($lastSatDate); 
		$days=(7)*$id;
		$days=($days-1)." "."days";
		$lastSunDate = strtotime('-'.$days, strtotime ($lastSatDate));
		$lastSunDate = date('Y-m-d', $lastSunDate);
		$lastSunDate=$lastSunDate.' '.'00:00:00';
		//pr($lastSunDate);  die;
		$data =" Question, Type, Basis, Rating, Cohort, Date, Time \n";
		$data .="\n"; // Add blank row
		
		$groupUser = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id'])));
		//pr($groupUser); die;
		$questionsInfo = $this->Question->find('all',array('conditions'=>array('Question.manager_id'=>$groupUser['User']['id'])));
		//pr($questionsInfo); die;
		$users = $this->User->find('all',array('conditions'=>array('User.manager_id'=>$groupUser['User']['id'])));
		//pr($users); die;
		$questions=array();
		//$questions = array_merge($questions,array('UserReflection.local_reflection_date BETWEEN ? AND ?'=>array($lastSatDate,$lastSunDate)));  
		foreach($users as $user){
			$UserReflection = $this->UserReflection->find('all',array('conditions'=>array('UserReflection.user_id'=>$user['User']['id'],'UserReflection.local_reflection_date BETWEEN ? and ?'=>array($lastSunDate,$lastSatDate))));
			$questions[]=$UserReflection;
		}
		$questions=array_filter($questions);
		$questions = Set::sort($questions,'{n}.local_reflection_date','aesc');
//		pr($questions); die;
		//pr(array_filter($questions)); die;
	        //echo '<pre>'; print_r($userInfo); die;
		//pr($questions); die;
		foreach($questions as $question)
		{
			//pr($question);
			$cohortUsers = $this->CohortUser->find('first',array('conditions'=>array('CohortUser.user_id'=>$question[$id]['User']['id'])));
			//pr($cohortUsers);
			$cohortUsersNo = $this->CohortUser->find('count',array('conditions'=>array('CohortUser.cohort_id'=>$cohortUsers['CohortUser']['cohort_id'])));
			//pr($cohortUsersNo); die;
			if($cohortUsersNo>=5){
				$cohortNameInfo = $this->Cohort->find('first',array('conditions'=>array('Cohort.id'=>$cohortUsers['CohortUser']['cohort_id'])));
				//pr($cohortName); die;
				$cohortName = $cohortNameInfo['Cohort']['title'];
				//pr($cohortName); die; 
			}else{
				$cohortName = "Group";
			}
			$i=0;
			//pr(sizeof($question)); die;
			for($i=0;$i<sizeof($question);$i++){
				$dateTime=explode(" ",$question[$i]['UserReflection']['local_reflection_date']);
				//$dateTime[0] = date();
				$dateTime[0] = date("M d Y", strtotime($dateTime[0]));
				$dateTime[1] = substr($dateTime[1],0,-3);
				//pr($dateTime[0]); die;
				
				//for Static questions one and two
				
				if($question[$i]['UserReflection']['rating_today']==""){
					$question[$i]['UserReflection']['rating_today']=0;
				}
				
				if($question[$i]['UserReflection']['rating_tomorrow']==""){
					$question[$i]['UserReflection']['rating_tomorrow']=0;
				}
				
				//pr($question[$i]['UserReflection']['rating_tomorrow'); die;
				// for question 1
				if($question[$i]['UserReflection']['ans_1']==""){
					$rating1 = 0;
				}else{
					$rating1 = $question[$i]['UserReflection']['ans_1'];
					//pr($question[$i]['Question_1']['rating_strength']); die;
				}
				
				// for question 1
				if($question[$i]['UserReflection']['ans_2']==""){
					$rating2 = 0;
				}else{
					$rating2 = $question[$i]['UserReflection']['ans_2'];
				}
				
				// for question 1
				if($question[$i]['UserReflection']['ans_3']==""){
					$rating3 = 0;
				}else{
					$rating3 = $question[$i]['UserReflection']['ans_3'];
				}
				
				// for static questions one
				$data .="How do you feel about today?".",";
				$data .="Fixed".",";
				$data .="3".",";
				$data .=$question[$i]['UserReflection']['rating_today'].",";
				$data .=$cohortName.","; 
				$data .=$dateTime[0].",";
				$data .=$dateTime[1]."\n";
				
				// for static questions two 
				$data .="How do you feel about tomorrow?".",";
				$data .="Fixed".",";
				$data .="3".",";
				$data .=$question[$i]['UserReflection']['rating_tomorrow'].",";
				$data .=$cohortName.","; 
				$data .=$dateTime[0].",";
				$data .=$dateTime[1]."\n";
				//pr($data); die;
				
				// for question 1
				$data .=$question[$i]['Question_1']['question'].",";
				$type = ($question[$i]['Question_1']['frequency'] == 1)?'Fixed':'Random';
				$data .=$type.",";
				$data .=$question[$i]['Question_1']['rating_strength'].",";
				$data .=$rating1.",";
				$data .=$cohortName.","; 
				$data .=$dateTime[0].",";
				$data .=$dateTime[1]."\n";
				//pr($data); 
				
				// for question 2
				$data .=$question[$i]['Question_2']['question'].",";
				$type = ($question[$i]['Question_2']['frequency'] == 1)?'Fixed':'Random';	
				$data .=$type.",";
				$data .=$question[$i]['Question_1']['rating_strength'].",";
				$data .=$rating2.",";
				$data .=$cohortName.","; 
				$data .=$dateTime[0].",";
				$data .=$dateTime[1]."\n";
				//pr($data);
				
				// for question 3
				$data .=$question[$i]['Question_3']['question'].",";
				$type = ($question[$i]['Question_3']['frequency'] == 1)?'Fixed':'Random';	
				$data .=$type.",";
				$data .=$question[$i]['Question_1']['rating_strength'].",";
				$data .=$rating3.",";
				$data .=$cohortName.","; 
				$data .=$dateTime[0].",";
				$data .=$dateTime[1]."\n"; 
				//pr($data); die */
			}
		}//die;
		//echo '<pre>'; print_r($data); die;
		$filename ="Questions_Listing.csv";
		$fp = fopen($filename,"w");
		if($fp){
			fwrite($fp,$data);
			fclose($fp);
		}
		
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: csv" . date("Y-m-d") . ".csv");
		header( "Content-disposition: filename=Questions_Listing_".date("d/m/Y").".csv");
		
		/*
		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename=QuestionsInfo_'.date("d/m/Y").".csv");
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filename));
		ob_clean();
		flush();
		readfile($filename);
		unlink($filename);
		*/
		print $data;
		exit;
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
		//Configure::write('debug',0);
		$perform_action = array_values(array_filter($this->data['Export']));
		
		$date = date('m/d/Y h:i:s a', time());
		//pr($perform_action); exit;
		if($perform_action[0] == 'user_listing') {
			$csv_output = "";
			$csv_output .= "Name;Cohort;Email;Address;BirthDate;\n";
			$all_users = $this->User->find('all', array('conditions'=>array('User.manager_id'=>$_SESSION['Auth']['User']['id']),'recursive'=>2)); 
			//pr($all_users); exit;
			
			foreach($all_users as $row){
			   $csv_output .= "\"".$row['User']['name']."\"".";";
			   $csv_output .= "\"".$row['CohortUser']['Cohort']['title']."\"".";";
			   $csv_output .= "\"".$row['User']['email']."\"".";";
			   $csv_output .= "\"".$row['User']['address']."\"".";";
			   $csv_output .= "\"".$row['User']['birthdate']."\""."\n";
			   $filename = 'UserList_'.$date;
			}
		} elseif($perform_action[0] == 'questions'){
			$csv_output = "";
			$csv_output .= "Question;Frequency;Rating;\n";
			$all_questions = $this->Question->find('all', array('conditions'=>array('Question.manager_id'=>array($_SESSION['Auth']['User']['id'], '0')))); 
			//pr($all_questions); exit;
			
			foreach($all_questions as $row){
				
				$frequency = ($row['Question']['frequency'] == 0)?'Random':'Always ask';
				
			   $csv_output .= "\"".$row['Question']['question']."\"".";";
			   $csv_output .= "\"".$frequency."\"".";";
			   $csv_output .= "\"".$row['Question']['rating_strength']."\""."\n";
			   $filename = 'QueList_'.$date;
			}
		} elseif($perform_action[0] == 'missions'){
			$csv_output = "";
			$csv_output .= "Title;StartDate;EndDate;Rating;Sponsor;Description;\n";
			$all_missions = $this->Mission->find('all',array('conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'])));
			//pr($all_missions); exit;
			
			foreach($all_missions as $row){
				$stDate = date('Y-m-d ',strtotime($row['Mission']['start_time'])).' 00:00:00';
				$endDate = date('Y-m-d ',strtotime($row['Mission']['end_time'])).' 23:59:59';
			   $csv_output .= "\"".$row['Mission']['title']."\"".";";
			   $csv_output .= "\"".$stDate."\"".";";
			   $csv_output .= "\"".$endDate."\"".";";
			   $csv_output .= "\"".$row['Mission']['rating']."\"".";"; 
			   $csv_output .= "\"".$row['Sponsor']['name']."\"".";";
			   $csv_output .= "\"".$row['Mission']['description']."\""."\n";
			   $filename = 'MissionList_'.$date;
			}
		} else {
			$this->Session->setFlash('Please select report to export', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'groups','action'=>'export'));
		}
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: csv" . date("Y-m-d") . ".csv");
		header( "Content-disposition: filename=".$filename.".csv");
		print $csv_output;
		exit;
	}/**/
	
	/** 
	@function : sendEmailToUser 
	@description : Send email to user when added by admin,
	@params : userid,template_id,
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Mar. 14, 2013
	*/
	function sendEmailToUser($userId, $template_id)
	{
		//fetch user's info
		$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$userId)));
		
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
		
		//Fetch content of 'EMAIL'
		$template = $this->Common->getEmailTemplate($template_id);
		
		$this->Email->from = INFO_EMAIL;
		$this->Email->subject = str_replace('{GROUP_NAME}',$_SESSION['Auth']['User']['name'],$template['EmailTemplate']['subject']);
		$data=$template['EmailTemplate']['description'];
		$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
		$site_link = '<a href='.SITE_URL.'>'.SITE_URL.'</a>';
		$data=str_replace('{SITE_LINK}',$site_link,$data);
		
		$this->set('data',$data);
		$this->Email->to = $userInfo['User']['email'];
		$this->Email->template='commanEmailTemplate';
		$this->Email->send();
		/***** Send Welcome Email to User :: End *****/
		return true;
	}
	
	
	function send_mail(){
		//$to = "Hennies@outlook.com";
		$to = "sdm_os@yahoo.com";
		//$to = "smaartdatatest@gmail.com";
		$subject = "Registered Successfull";
		$message = "Hello! This is a simple email message.";
		$from = "support@vimbli.com";
		$headers = "From:" . $from;
		
		if(mail($to,$subject,$message,$headers)){
			die('Mail Sent');
		} else {
			die('Mail Not');
		}
	}
	
	//Function to show values in GM dashboard
	function userValues($userId=NULL,$column=NULL){
		
		$this->autoRender = false;
		$usrData = $this->User->find('first',array('conditions'=>array('User.id'=>$userId)));
		
		$this->loadModel('mission');
		$recentMission = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$userId,'Mission.shared_by_gm'=>0), 'order'=>'Mission.id DESC'));
		
		if($column == 'mission'){ 
			//Find out the last updated mission date if exist
			if((!empty($recentMission)) AND ($recentMission['Mission']['end_time'] >= $this->Common->userTime($usrData['User']['timezone'],date('Y-m-d H:i:s')))){
				echo $recentMission = date('M. d',strtotime($recentMission['Mission']['modified']));
			}else{
				echo '-';	
			}
		}elseif($column == 'total_days'){ 
			//Find out the last updated mission date if exist
			if((!empty($recentMission)) AND ($recentMission['Mission']['end_time'] >= $this->Common->userTime($usrData['User']['timezone'],date('Y-m-d H:i:s')))){
				echo $total_days = round((strtotime($recentMission['Mission']['end_time'])-strtotime($recentMission['Mission']['start_time']))/86400);
			}else{
				echo '-';	
			}
		}elseif($column == 'remaining_days'){ 
			//Find out the last updated mission date if exist
			if((!empty($recentMission)) AND ($recentMission['Mission']['end_time'] >= $this->Common->userTime($usrData['User']['timezone'],date('Y-m-d H:i:s')))){
				$total_days = round((strtotime($recentMission['Mission']['end_time'])-strtotime($recentMission['Mission']['start_time']))/86400);
				$elapsed_days = round((strtotime($this->Common->userTime($usrData['User']['timezone'],date('Y-m-d 23:59:59')))-strtotime($recentMission['Mission']['start_time']))/86400);
				$remaining_days = $total_days-$elapsed_days;
				echo $remaining_days = ($remaining_days >= 1)?$remaining_days:0;
			}else{
				echo '-';	
			}
		}elseif($column == 'last_reflection'){ //Recent reflection in last 7 days
			$today = $this->Common->userTime($usrData['User']['timezone'],date('Y-m-d H:i:s'));
			
			//$oneWeekAgo = strtotime('-1 week' , strtotime ($today));
			$oneWeekAgo = strtotime('-30 days' , strtotime ($today));
			$oneWeekAgoDate = date('Y-m-d H:i:s', $oneWeekAgo);
			
			$refData = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.user_id'=>$userId,'UserReflection.local_reflection_date >='=>$oneWeekAgoDate),'order'=>'UserReflection.id DESC'));
			
			//Find out the last updated mission date if exist
			if(!empty($refData)){
				echo $refDate = date('M. d',strtotime($refData['UserReflection']['modified']));
			}else{
				echo '-';	
			}
		}elseif($column == 'total_reflection'){ //'reflections/activity' in last 30 days
			$today = $this->Common->userTime($usrData['User']['timezone'],date('Y-m-d H:i:s'));
			
			$oneMonthAgo = strtotime('-30 days' , strtotime ($today));
			$oneMonthAgoDate = date('Y-m-d H:i:s', $oneMonthAgo);
			
			$refData = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$userId,'UserReflection.local_reflection_date >='=>$oneMonthAgoDate)));
			
			$ratedRef = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$userId,'UserReflection.rating_today <>'=>0,'UserReflection.local_reflection_date >='=>$oneMonthAgoDate)));
			$calEvent = $this->CalendarEvent->find('count',array('conditions'=>array('CalendarEvent.user_id'=>$userId,'CalendarEvent.rating <>'=>0,'CalendarEvent.local_start >='=>$oneMonthAgoDate)));
			$act = $this->Activity->find('count',array('conditions'=>array('Activity.activity_owner'=>$userId,'Activity.rating <>'=>0,'Activity.local_start >='=>$oneMonthAgoDate)));
			$emails = $this->ImportEmail->find('count',array('conditions'=>array('ImportEmail.user_id'=>$userId,'ImportEmail.rating <>'=>0,'ImportEmail.local_email_date >='=>$oneMonthAgoDate)));
			$mission = $this->Mission->find('count',array('conditions'=>array('Mission.owner'=>$userId,'Mission.shared_by_gm'=>0,'Mission.rating <>'=>0,'Mission.start_time >='=>$oneMonthAgoDate)));
			
			$totalRated = 0;
			$totalRated = $ratedRef+$calEvent+$act+$emails+$mission;
			
			//Find out the last updated mission date if exist
			if((!empty($refData)) OR ($totalRated > 0)){
				$refDate = date('M. d',strtotime($refData['UserReflection']['modified']));
				echo $refData.'/'.$totalRated;
			}else{
				echo '-';	
			}
		}elseif($column == 'sponsor'){ //Find sponsor added date
			if((!empty($recentMission)) AND ($recentMission['Mission']['end_time'] >= $this->Common->userTime($usrData['User']['timezone'],date('Y-m-d H:i:s'))) AND ($recentMission['Mission']['sponsor_id'] != "")){
				echo $sp = date('M. d', strtotime($recentMission['Mission']['sponsor_add_date']));
			}else{
				echo '-';	
			}
		}elseif($column == 'sponsor_contact'){ //Find last contact with sponsor
			if((!empty($recentMission)) AND ($recentMission['Mission']['end_time'] >= $this->Common->userTime($usrData['User']['timezone'],date('Y-m-d H:i:s'))) AND ($recentMission['Mission']['sponsor_id'] != "")){
				
				//Find interactions with sponsor
				$spInEmail = $this->ImportEmail->find('first',array('conditions'=>array('ImportEmail.email_from LIKE'=>'%'.$recentMission["Sponsor"]["email"].'%','ImportEmail.user_id'=>$userId),'order'=>'ImportEmail.id DESC'));
				
				echo 'N/A';
			}else{
				echo 'N/A';	
			}
		}
		elseif($column == 'flag'){
			if($usrData['User']['status'] == 0){ // If user is inactive
				return 'gray';
			}
			
			if((!empty($recentMission)) AND ($recentMission['Mission']['end_time'] >= $this->Common->userTime($usrData['User']['timezone'],date('Y-m-d H:i:s')))){
				//Fetch flag params values
				$flagParms = $this->FlagSetting->find('first',array('conditions'=>array('FlagSetting.user_id'=>$_SESSION['Auth']['User']['id'])));
				
				if($recentMission['Mission']['sponsor_id'] != ""){
					$activeSp = 1;	
				}
				
				//Mission remaining days
				$total_days = round((strtotime($recentMission['Mission']['end_time'])-strtotime($recentMission['Mission']['start_time']))/86400);
				$elapsed_days = round((strtotime($this->Common->userTime($usrData['User']['timezone'],date('Y-m-d 23:59:59')))-strtotime($recentMission['Mission']['start_time']))/86400);
				$remaining_days = $total_days-$elapsed_days;
				
				//Last reflection
				$refInfo = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.user_id'=>$userId),'order'=>'UserReflection.id DESC'));
				$refOlderThen = round((strtotime($this->Common->userTime($usrData['User']['timezone'],date('Y-m-d 23:59:59')))-strtotime($refInfo['UserReflection']['local_reflection_date']))/86400);
				
				//Ref in last 30 days
				$oneMonthAgo = strtotime('-30 days' , strtotime ($today));
				$oneMonthAgoDate = date('Y-m-d H:i:s', $oneMonthAgo);
				$refData = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$userId,'UserReflection.local_reflection_date >='=>$oneMonthAgoDate)));
			
				
				if(($recentMission['Mission']['sponsor_id'] == "") OR ($remaining_days < $flagParms['FlagSetting']['days_remaining']) OR ($refOlderThen > $flagParms['FlagSetting']['last_reflection']) OR ($refData < $flagParms['FlagSetting']['total_reflection_in_30_days'])){
					return 'yellow';	
				}else{
					return 'green';
				}
				
				
			}else{
				return 'red';	
			}
		}
	}
	
	
	/** 
	@function : accessDelEmail 
	@description : Send email to user after deletion from group,
	@params : User_id
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jul. 17, 2013
	*/
	function accessDelEmail($id=NULL){
		/***** Send Email to User :: Start *****/
		//fetch out the user info
		$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
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
		
		//Fetch content of 'Email_Template'
		$template = $this->Common->getEmailTemplate(20);
		
		$this->Email->from = INFO_EMAIL;
		$this->Email->subject = $template['EmailTemplate']['subject'];
		$data=$template['EmailTemplate']['description'];
		$expName = explode(' ',trim($userInfo['User']['name']));
		$first_name = $expName[0];
		$data=str_replace('{NAME}',$first_name,$data);
		$data=str_replace('{GROUP}',$_SESSION['Auth']['User']['name'],$data);
		$gm_email_link = '<a href="mailto:'.$_SESSION['Auth']['User']['email'].'">group manager</a>';
		$data=str_replace('{GM_EMAIL}',$gm_email_link,$data);
		$subscribe_link = '<a href="'.SITE_URL.'">subscribe</a>';
		$data=str_replace('{SUBSCRIBE_LINK}',$subscribe_link,$data);
		$del_account_link = '<a href="'.SITE_URL.'">delete</a>';
		$data=str_replace('{DEL_ACCOUNT}',$del_account_link,$data);
				
		
		$this->set('data',$data);
		$this->Email->to = $userInfo['User']['email'];
		$this->Email->template='commanEmailTemplate';
		$this->Email->send();
		/***** Send Email to User :: End *****/
	}
	
	/** 
	@function : export_activities 
	@description : Export Activity data for Individual
	@params : NULL
	@Created by : Sunny chauhan
	@Modify : NULL
	@Created Date : Aug. 02, 2013
	*/
	function export_activities() {
		$id = $_SESSION['Auth']['User']['id'];
		$this->loadModel('Activity');
		$this->loadModel('User');
		$this->layout=false;
		$this->autoRender=false;
		$current_user_info = $this->User->find('first',array(
						       'conditions'=>array('User.id'=>$id),
						       'fields'=>array('User.email','User.name')
						       ));
		$activities = $this->Activity->find('all',array('conditions'=>array('Activity.activity_owner'=>$id)));
		$this->loadModel('User');
		$current_user_info = $this->User->find('first',array(
						       'conditions'=>array('User.id'=>$id),
						       'fields'=>array('User.email','User.name')
						       ));
		//
		//
		//pr($current_user_info); 
		//pr($id); die;
		$this->loadModel('Timeline');
		$this->loadModel('UserReflection');
		$this->loadModel('StrengthValue');
		$this->layout=false;
		$this->autoRender=false;
		//Configure::write('debug',0);
		$data = "All Activities in Timeline \n";
		$data.="Title;Type;Rating;Start Date; End Date \n";
		//$data .="\n"; // Add blank row
		$timelineInfo = $this->Timeline->find('all',array('conditions'=>array('Timeline.user_id'=>$id)));
		//$reflections = Set::sort($activities,'{n}.created','asc');
		//pr($timelineInfo); 
		foreach($timelineInfo as $reflection)
		{
				// check for type of timeline
				if($reflection['Timeline']['model_name'] == "CalendarEvent"){
					$type = "Calendar";
				}elseif($reflection['Timeline']['model_name'] == "ImportEmail"){
					$type = "Email";
				}elseif($reflection['Timeline']['model_name'] == "UserReflection"){
					$type = "Reflection";
				}else{
					$type = "Activity";
				}
				// converting start date to USA format
				if(!empty($reflection['Timeline']['start_date'])){
					$reflection['Timeline']['start_date'] = date('M. d Y h:i',strtotime($reflection['Timeline']['start_date']));
				}else{
					$reflection['Timeline']['start_date'] = 'N/A';
				}
				
				// converting start date to USA format
				if(!empty($reflection['Timeline']['end_date'])){
					$reflection['Timeline']['end_date'] = date('M. d Y h:i',strtotime($reflection['Timeline']['end_date']));
				}else{
					$reflection['Timeline']['end_date'] = 'N/A';
				}
				
				
				// checking condition for availability of description
				if(empty($reflection['Timeline']['description'])){
					$reflection['Timeline']['description'] = 'N/A';
				}
				
				// checking condition for availability of description
				if(empty($reflection['Timeline']['title'])){
					$reflection['Timeline']['title'] = 'N/A';
				}
				
				// checking condition for availability of rating
				if(empty($reflection['Timeline']['rating'])){
					$reflection['Timeline']['rating'] = 'N/A';
				}
				
				// creating data for csv
				
				$data .= $reflection['Timeline']['title'].";";
				$data .= $type.";";
				$data .= $reflection['Timeline']['rating'].";";
				$data .= $reflection['Timeline']['start_date'].";";
				$data .= $reflection['Timeline']['end_date']."\n";
				//$data .= $attendies."\n";
		}//pr($data); die;
		/*$data.= "\n";
		$data.= "\n";
		$data.= "Reflections \n";
		$data.=" Reflection Date;Reflection;Question 1;Rating 1;Question 2;Rating 2;Question 3;Rating 3;Today Question;Rating_today;Tomorrow Question;Rating_tomorrow;Attendies \n";
		$reflections = $this->UserReflection->find('all',array('conditions'=>array('UserReflection.user_id'=>$id)));
		//$reflections = Set::sort($activities,'{n}.created','asc');
		foreach($reflections as $reflection)
		{
				// converting start date to USA format
				if(!empty($reflection['UserReflection']['local_reflection_date'])){
					$reflection['UserReflection']['local_reflection_date'] = date('M. d Y',strtotime($reflection['UserReflection']['local_reflection_date']));
				}else{
					$reflection['UserReflection']['local_reflection_date'] = 'N/A';
				}
				
				
				// checking condition for availability of description
				if(empty($reflection['UserReflection']['description'])){
					$reflection['UserReflection']['description'] = 'N/A';
				}
				
				// checking condition for availability of rating
				if(empty($reflection['UserReflection']['rating_today'])){
					$reflection['UserReflection']['rating_today'] = 'N/A';
				}
				
				// checking condition for availability of rating
				if(empty($reflection['UserReflection']['rating_tomorrow'])){
					$reflection['UserReflection']['rating_tomorrow'] = 'N/A';
				}
				
				// checking condition for availability of attendy
				$attendies = array();
				foreach($reflection['ReflectionAttendy'] as $ref_attendy){
					$attendies[] = $ref_attendy['attendy_display_name'];
					//$attendies[] = $act_attendy['attendy_display_name'];
				}
				
				// making all attendies array value as comma separated
				$attendies = implode(',',$attendies);
				if(empty($attendies)){
					$attendies = 'N/A';
				}
				
				// checking condition for availability of question 1 & its corresponding rating
				if(empty($reflection['Question_1']['question'])){
					$reflection['Question_1']['question'] = 'N/A';
				}
				if(empty($reflection['Question_1']['rating_strength'])){
					$reflection['Question_1']['rating_strength'] = 'N/A';
				}
				
				// checking condition for availability of question 1 & its corresponding rating
				if(empty($reflection['Question_2']['question'])){
					$reflection['Question_2']['question'] = 'N/A';
				}
				if(empty($reflection['Question_1']['rating_strength'])){
					$reflection['Question_1']['rating_strength'] = 'N/A';
				}
				
				// checking condition for availability of question 1 & its corresponding rating
				if(empty($reflection['Question_3']['question'])){
					$reflection['Question_3']['question'] = 'N/A';
				}
				if(empty($reflection['Question_3']['rating_strength'])){
					$reflection['Question_3']['rating_strength'] = 'N/A';
				}
				
				// creating data for csv
				$data .= $reflection['UserReflection']['local_reflection_date'].";";
				$data .= $reflection['UserReflection']['description'].";";
				$data .= $reflection['Question_1']['question'].";";
				$data .= $reflection['Question_1']['rating_strength'].";";
				$data .= $reflection['Question_2']['question'].";";
				$data .= $reflection['Question_2']['rating_strength'].";";
				$data .= $reflection['Question_3']['question'].";";
				$data .= $reflection['Question_3']['rating_strength'].";";
				$data .="How do you feel about today?".";";
				$data .= $reflection['UserReflection']['rating_today'].";";
				$data .="How do you feel about tomorrow?".";";
				$data .= $reflection['UserReflection']['rating_tomorrow'].";";
				$data .= $attendies."\n";
		}*/
		$data.= "\n";
		$data.= "\n";
		$data.= "Activities \n";
		$data.=" Activity; Description;Rating;Attendy ;Start Date; End Date \n";
		foreach($activities as $activity)
		{
				// converting start date to USA format
				if(!empty($activity['Activity']['local_start'])){
					$activity['Activity']['local_start'] = date('M. d Y h:i',strtotime($activity['Activity']['local_start']));
				}else{
					$activity['Activity']['local_start'] = 'N/A';
				}
				
				// converting end date to USA format
				if(!empty($activity['Activity']['local_end'])){
					$activity['Activity']['local_end'] = date('M. d Y h:i',strtotime($activity['Activity']['local_end']));
				}else{
					$activity['Activity']['local_end'] = 'N/A';
				}
				
				// checking condition for availability of title
				if(empty($activity['Activity']['title'])){
					$activity['Activity']['title'] = 'N/A';
				}
				
				// checking condition for availability of description
				if(empty($activity['Activity']['description'])){
					$activity['Activity']['description'] = 'N/A';
				}
				
				// checking condition for availability of rating
				if(empty($activity['Activity']['rating'])){
					$activity['Activity']['rating'] = 'N/A';
				}
				
				// checking condition for availability of attendy
					$attendies = array();
				foreach($activity['ActivityAttendy'] as $act_attendy){
					$attendies[] = $act_attendy['attendy_display_name'];
				}
				
				// making all attendies array value as comma separated
				$attendies = implode(',',$attendies);
				if(empty($attendies)){
					$attendies = 'N/A';
				}
				
				// creating data for csv
				$data .= $activity['Activity']['title'].";";
				$data .= $activity['Activity']['description'].";";
				$data .= $activity['Activity']['rating'].";";
				$data .= $attendies.";";
				$data .= $activity['Activity']['local_start'].";";
				$data .= $activity['Activity']['local_end']."\n";
		}
		//pr($data);die;
		$filename ="Activities_Listing".$id.".csv";
		$fp = fopen('files/user'.DS.$filename,"w");
		if($fp){
			fwrite($fp,$data);
			fclose($fp);
		}
		//$path = 'http://vimbli.com/beta/settings/export_data_after_login/'.$filename;
		$path = SITE_URL.'groups/export_data_after_login/'.$filename;
		$this->Email->from = INFO_EMAIL;
		$this->Email->to = "sdd.sdei@gmail.com";
		//$this->Email->to = $current_user_info['User']['email'];
		$template = $this->Common->getEmailTemplate(24);
		$this->Email->sendAs= 'html';
		$this->Email->subject = $template['EmailTemplate']['subject'];
		$description = $template['EmailTemplate']['description'];
		$description = str_replace('{NAME}',$current_user_info['User']['name'],$description);
		$description = str_replace('{FILENAME}',$filename,$description);
		$description = str_replace('{LINK}',$path,$description);
		$this->set('data',$description);
		$this->Email->template='commanEmailTemplate';
		//pr($this->email);die;
		$this->Email->send();
		$this->Session->setFlash('Vimbli is preparing your export. When complete we will send you a link to the email.','default',array('class'=>'flash_success'));
		$this->redirect($this->referer());
	}
	
	/** 
	@function : export_reflections 
	@description : Export reflections data for Individual
	@params : NULL
	@Created by : Sunny chauhan
	@Modify : NULL
	@Created Date : Aug. 02, 2013
	*/
	function export_reflections() {
		$this->loadModel('UserReflection');
		$this->loadModel('User');
		$this->layout=false;
		$this->autoRender=false;
		$current_user_info = $this->User->find('first',array(
						       'conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id']),
						       'fields'=>array('User.email','User.name')
						       ));
		$data =" Reflection Date;Reflection;Question 1;Rating 1;Question 2;Rating 2;Question 3;Rating 3;Today Question;Rating_today;Tomorrow Question;Rating_tomorrow ;Attendies \n";
		$reflections = $this->UserReflection->find('all',array('conditions'=>array('UserReflection.user_id'=>$_SESSION['Auth']['User']['id'])));
		//$reflections = Set::sort($activities,'{n}.created','asc');
		foreach($reflections as $reflection)
		{
				// converting start date to USA format
				if(!empty($reflection['UserReflection']['local_reflection_date'])){
					$reflection['UserReflection']['local_reflection_date'] = date('M. d Y',strtotime($reflection['UserReflection']['local_reflection_date']));
				}else{
					$reflection['UserReflection']['local_reflection_date'] = 'N/A';
				}
				
				
				// checking condition for availability of description
				if(empty($reflection['UserReflection']['description'])){
					$reflection['UserReflection']['description'] = 'N/A';
				}
				
				// checking condition for availability of rating
				if(empty($reflection['UserReflection']['rating_today'])){
					$reflection['UserReflection']['rating_today'] = 'N/A';
				}
				
				// checking condition for availability of rating
				if(empty($reflection['UserReflection']['rating_tomorrow'])){
					$reflection['UserReflection']['rating_tomorrow'] = 'N/A';
				}
				
				// checking condition for availability of attendy
				$attendies = array();
				foreach($reflection['ReflectionAttendy'] as $ref_attendy){
					$attendies[] = $ref_attendy['attendy_display_name'];
					//$attendies[] = $act_attendy['attendy_display_name'];
				}
				
				// making all attendies array value as comma separated
				$attendies = implode(',',$attendies);
				if(empty($attendies)){
					$attendies = 'N/A';
				}
				
				// checking condition for availability of question 1 & its corresponding rating
				if(empty($reflection['Question_1']['question'])){
					$reflection['Question_1']['question'] = 'N/A';
				}
				if(empty($reflection['Question_1']['rating_strength'])){
					$reflection['Question_1']['rating_strength'] = 'N/A';
				}
				
				// checking condition for availability of question 1 & its corresponding rating
				if(empty($reflection['Question_2']['question'])){
					$reflection['Question_2']['question'] = 'N/A';
				}
				if(empty($reflection['Question_1']['rating_strength'])){
					$reflection['Question_1']['rating_strength'] = 'N/A';
				}
				
				// checking condition for availability of question 1 & its corresponding rating
				if(empty($reflection['Question_3']['question'])){
					$reflection['Question_3']['question'] = 'N/A';
				}
				if(empty($reflection['Question_3']['rating_strength'])){
					$reflection['Question_3']['rating_strength'] = 'N/A';
				}
				
				// creating data for csv
				$data .= $reflection['UserReflection']['local_reflection_date'].";";
				$data .= $reflection['UserReflection']['description'].";";
				$data .= $reflection['Question_1']['question'].";";
				$data .= $reflection['Question_1']['rating_strength'].";";
				$data .= $reflection['Question_2']['question'].";";
				$data .= $reflection['Question_2']['rating_strength'].";";
				$data .= $reflection['Question_3']['question'].";";
				$data .= $reflection['Question_3']['rating_strength'].";";
				$data .="How do you feel about today?".";";
				$data .= $reflection['UserReflection']['rating_today'].";";
				$data .="How do you feel about tomorrow?".";";
				$data .= $reflection['UserReflection']['rating_tomorrow'].";";
				$data .= $attendies."\n";
		}
		$filename ="Reflections_Listing".$_SESSION['Auth']['User']['id'].".csv";
		$fp = fopen('files/user'.DS.$filename,"w");
		if($fp){
			fwrite($fp,$data);
			fclose($fp);
		}
		$path = 'http://vimbli.com/settings/export_data_after_login/'.$filename;
		//$path = SITE_URL.'groups/export_data_after_login/'.$filename;
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
		$this->Session->setFlash('Vimbli is preparing your export. When complete we will send you a link to the email.','default',array('class'=>'flash_success'));
		$this->redirect($this->referer());
	}
	
	/** 
	@function : export_data_after_login 
	@description : Download Export data file only after user is login otherwise not
	@params : NULL
	@Created by : Sunny chauhan
	@Modify : NULL
	@Created Date : Aug. 06, 2013
	*/
	
	public function export_data_after_login($filename){
		$this->autoRender = false;
		if($_SESSION){
			//$this->redirect('http://vimbli.com/beta/files/user'.DS.$filename);
			$this->redirect(SITE_URL.'files/user'.DS.$filename);
		}
	}
	
	function ajax_add_sponsor($user=null,$mail=null){
		$this->autoRender = false;
		$this->layout = false;
		$newPassword = $this->random_gen(2);
			$randomPassword = Security::hash (Configure::read ('Security.salt') . $newPassword);
			//$this->data['User']['id'] = $id;
			$this->data['User']['name'] = $user;
			$this->data['User']['email'] = $mail;
			$this->data['User']['password'] = $randomPassword;
			$this->data['User']['status'] = 1;
			$this->data['User']['is_sponsor'] = 1;
			$this->data['User']['user_type'] = 3;
			$existSponsor = $this->User->find('first',array('conditions'=>array('User.email'=>$this->data["User"]["email"])));
			if(empty($existSponsor)){ 
				if($this->User->save($this->data['User'])){
					
					$id = $this->User->getLastInsertId();	
					//echo "sam";die;
					$this->data['SponsorManager']['manager_id'] = $_SESSION['Auth']['User']['id'];
					if($id == ""){
						$this->data['SponsorManager']['sponsor_id'] = $this->User->getLastInsertId();
					}else {
						$this->SponsorManager->deleteAll(array('SponsorManager.user_id'=>$id));
						$this->data['SponsorManager']['sponsor_id'] = $id;
					}
					$this->SponsorManager->save($this->data['SponsorManager']);
					
					//if($id == ""){
					//Entry in user_groups_user table
					$lastUserId = $this->User->getLastInsertId();
					
					/***** Send Email to User :: Start *****/
					//fetch out the user info
					$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$lastUserId)));
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
					
					//Fetch content of 'FORGOT_PASSWORD'
					$template = $this->Common->getEmailTemplate(7);
					
					$this->Email->from = $_SESSION['Auth']['User']['name'].'<'.$_SESSION['Auth']['User']['email'].'>';;
					$this->Email->subject = $template['EmailTemplate']['subject'];
					$data=$template['EmailTemplate']['description'];
					$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
					$data=str_replace('{GROUP_MANAGER}',$_SESSION['Auth']['User']['name'],$data);
					$data=str_replace('{EMAIL}',$userInfo['User']['email'],$data);
					$data=str_replace('{PASSWORD}',$newPassword,$data);
					$data=str_replace('{SENDER}',strtok($_SESSION['Auth']['User']['name'], " "),$data);
					
					//$hashedId = base64_encode($lastUserId);
					$login_link = '<a href='.SITE_URL.'users/login/first_login>'.SITE_URL.'users/login</a>';
					$data=str_replace('{LOGIN_LINK}',$login_link,$data);
					
					$this->set('data',$data);
					$this->Email->to = $userInfo['User']['email'];
					$this->Email->template='commanEmailTemplate';
					$this->Email->send();
				/***** Send Email to User :: End *****/
					
					$_SESSION['sp_msz'] = "Sponsor saved successfully. An email has been sent to the sponsor with his/her login details.";
					//$this->Session->write('test',$_SESSION['tst']);
					//}	
				}else {
					$_SESSION['sp_msz'] = 'There is some problem. Please try later.';
				}
			}else{
				$existForThisUser = $this->SponsorManager->find('first',array('conditions'=>array('SponsorManager.sponsor_id'=>$existSponsor['User']['id'],'SponsorManager.manager_id'=>$_SESSION['Auth']['User']['id'])));
				
				if(empty($existForThisUser)){
				$isSponsor = 1;
				$this->User->updateAll(array('User.is_sponsor'=>"'$isSponsor'"),array('User.id'=>$existSponsor['User']['id']));
				$rec = array();
				$rec['SponsorManager']['sponsor_id'] = $existSponsor['User']['id'];
				$rec['SponsorManager']['manager_id'] = $_SESSION['Auth']['User']['id'];
				$this->SponsorManager->save($rec['SponsorManager']);
				
				/***** Send Email to User :: Start *****/
					//fetch out the user info
					$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$existSponsor['User']['id'])));
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
					
					//Fetch content of 'FORGOT_PASSWORD'
					$template = $this->Common->getEmailTemplate(10);
					
					$this->Email->from = $_SESSION['Auth']['User']['name'].'<'.$_SESSION['Auth']['User']['email'].'>';
					$this->Email->subject = $template['EmailTemplate']['subject'];
					$data=$template['EmailTemplate']['description'];
					$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
					$data=str_replace('{GROUP_MANAGER}',$_SESSION['Auth']['User']['name'],$data);
					$data=str_replace('{SENDER}',strtok($_SESSION['Auth']['User']['name'], " "),$data);
					
					//$hashedId = base64_encode($lastUserId);
					$login_link = '<a href='.SITE_URL.'users/login>'.SITE_URL.'users/login</a>';
					$data=str_replace('{LOGIN_LINK}',$login_link,$data);
					
					$this->set('data',$data);
					$this->Email->to = $userInfo['User']['email'];
					$this->Email->template='commanEmailTemplate';
					$this->Email->send();
				/***** Send Email to User :: End *****/
					$_SESSION['sp_msz'] = 'The email already exists on Vimbli, we have added sponsor rights and have sent a notification to the owner';
				
				}else{
					$_SESSION['sp_msz'] = 'This user is already exists as your sponsor.';
				}
				
			}
			
			echo $this->render('/elements/dashboard/invite_sponsor');
			exit;
	}
	
	
    
  }//end class
?>