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
class UsersController extends AppController{

	var $name 	= 'Users';
	var $uses 	= array('FlagSetting','Timeline','ConnectionEmail','CalendarEvent','Message','ImportEmail','MissionUser','Connection','Activity','UserReflection','Mission','User','SponsorManager','EmailTemplate','Communication','SyncDetail','Process','Timezone');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('RequestHandler','Cookie','Email','Auth','Common');
	 
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(($this->params['action'] != 'admin_login') && (@$this->params['prefix'] == 'admin'))
		{
		    $this->Auth->allow('sign_up');
		} else {
		       $this->Auth->allow('subscription','forgot_password','complete_transaction','password_changed','registered','activate_user','login','loginIfSessionLost','run_in_background','calc_myRating');
		}
	    
	    }
	/** 
	@function : opauth_complete 
	@description : opauth_complete,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : feb 11, 2012
	*/
	public function opauth_complete() {
		debug($this->data);
	}
   
	/** 
	@function : admin_index 
	@description : listing of categories,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Nov 21, 2012
	*/
	function admin_index(){
		
		if((isset($this->data["User"]["setStatus"])))
		{
			$status = ife($_POST['active'],1,0);
			$record = $this->data["User"]["Record"];
			$CheckedList=$_POST['box1'];
			$controller= $this->params['controller'];
			$action='index'; 
			$prefix='admin';
			$model='User';
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
		$matchshow = '';
		$fieldname = '';
		$this->set('show',10);
		/* SEARCHING */
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
		
		
		$this->paginate = array(
			'limit' => 30,
			'order' => array(
				'User.id' => 'DESC'
			)
		);
		//echo '<pre>'; print_r(array_unique($this->paginate('User',$criteria)));die;
		$this->set('pagetitle',"Manage Customers");                
		$this->set('userlist', $this->paginate('User',$criteria));
	}    
	
	/*
	Function Name: admin_delete
	Params: NULL
	Created BY:Vikas Uniyal
	Created ON : Nov. 20, 2012
	Description : To delete Product - Admin Panel 
	*/
	function admin_delete($id=null){
	    $id = base64_decode($id);
	    $this->User->id = $id;
            $this->User->delete($id);
	    //************Code for delete user from the sync detail table @Sachin Thakur 25 Apr.2013 
	    $this->SyncDetail->deleteAll(array('SyncDetail.user_id'=>$id),false);
	    //************End Code for delete user from the sync detail table @Sachin Thakur 25 Apr.2013
            $this->Session->setFlash('User deleted sucessfully.','message/green');
            $this->redirect(array('action' => 'index'));
        }
      
	/**
	@function:admin_view 
	@description		view User Details,
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Nov. 20, 2012
	*/
	function admin_view($id){
		$id = base64_decode($id);	
		$this->layout = 'admin';
		$this->set('pagetitle',"View User");
		$this->User->id = $id;
		$this->data = $this->User->read();
		
	}
	
	
	/**
	@function:admin_add 
	@description		Add user from admin panel
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Nov. 20, 2012
	$Updated on: 22 Nov by Sandeep Verma
	*/
	function admin_add($id=null,$tmp=NULL,$edit_data=null){ //pr($id);
	// pr($tmp); pr($edit_data);die;
		$this->loadModel('User');
		//$userDataInfo = $this->User->find('list',array('recursive'=>-1,'conditions'=>array('AND'=>array('User.group_payment_status' => 1),array('User.manager_id'=>null)),'fields'=>array('User.name')));
		
		$userDataInfo = $this->User->find('list',array('recursive'=>-1,'conditions'=>array("OR"=>array(array('User.group_payment_status' => 1,'User.manager_id' => null),array('User.group_payment_status' => 1,'User.manager_id = User.id'))),'fields'=>array('id', 'name')));
		//pr($userDataInfo); die;
		$this->set('userDataInfo',$userDataInfo);
		if(!empty($edit_data)){
			$this->set(compact('edit_data'));
		}
		if($tmp == 2) {
			$this->set(compact('tmp'));
		}
  		$id = base64_decode($id);
		$this->layout = 'admin';	
  		//App::import('Model','EmailTemplate');
      		//$this->EmailTemplate = & new EmailTemplate();
		
		$this->set('pagetitle',"Add User");
		
		$this->loadModel('UserGroup');
		//$userGroupLists = array();
		//$userGroupLists = $this->UserGroup->find('list', array('fields'=>array('id', 'title')));
		//pr($userlists); exit;
		//$this->set('userGroupLists',$userGroupLists);
	    
		$this->User->id = $id;
		$admin_id=0;
		if(empty($this->data)){
			$this->data = $this->User->read();
			//pr($this->data); die;
			if($this->data['User']['group_payment_status']==1){
				$this->set(compact('tmp'));
			}
			
			if($this->data['User']['primaryemail']==""){
				$this->data['User']['primaryemail']=$this->data['User']['email'];
			}
			//pr($this->data['User']['primaryemail']); die;
			$selected = '';
		//	if(!empty($this->data['UserGroup'])) {
		//		foreach($this->data['UserGroup'] as $user_group) {
		//			 $selected[] = $user_group['id'];
		//		}
		//	}
		//	$this->set('selected', $selected)
			//pr($this->data['User']['birthdate']); die;
			$date = explode("-",@$this->data['User']['birthdate']);
			$this->data['User']['birth_year'] = @$date[0];
			$this->data['User']['birth_month'] = @$date[1];
			$this->data['User']['birth_day'] = @$date[2];
		}else if(!empty($this->data)){
			//pr($this->data); die;
			$this->User->set($this->data);
			$_SESSION['User']['applyFor'] = $this->data['User']['user_type'];
			if($this->User->validates()){
				
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
				if($id!=NULL)
					unset($this->data['User']['password']);
				else
					$this->data['User']['password'] = $this->Auth->password($this->data['User']['password']);
	
				$this->data['User']['name'] = ucwords(strtolower($this->data['User']['name']));
				$this->data['User']['birthdate'] = $this->data['User']['birth_year'].'-'.$this->data['User']['birth_month'].'-'.$this->data['User']['birth_day'];
				$this->data['User']['status'] = '1';
				$user_group_ids =   $this->data['UserGroup']['id'];
				
				if($this->data['User']['access_level'] == "individual"){
					$this->data['User']['individual_payment_status'] = 1;
					$this->data['User']['user_type'] = 1;
				} else if($this->data['User']['access_level'] == "group"){
					$this->data['User']['group_payment_status'] = 1;
					$this->data['User']['user_type'] = 2;
					//pr($this->data['User']['access_level']); die;
				} else{
					$this->data['User']['user_type'] = 3;
				}//die;
				//pr($this->data['User']['id']); die;;
				if($this->User->save($this->data, array('validate'=>false))) {
					if(empty($this->data['User']['id'])){
						$userId = $this->User->getLastInsertId();
						$this->add_default_values($userId);	
					}
					
					
					//Add entry in transaction table :: Start
					$this->loadModel('Transaction');
					$tranArr = array();
					
					$tranArr['Transaction']['type'] = 'free'; //For next 30 days
					$tranArr['Transaction']['user_id'] = $userId;
					$tranArr['Transaction']['sub_date'] = date('Y-m-d H:i:s');
					
					$thirtyDaysPlus = strtotime('+1 day' , strtotime (date('Y-m-d H:i:s')));
					$after30Days = date('Y-m-d H:i:s', $thirtyDaysPlus);
					
					$tranArr['Transaction']['expiry_date'] = $after30Days;
					
					$this->Transaction->save($tranArr);
					//Add entry in transaction table :: Start
					
					//Save entry in communication ::Start
					if($this->data['User']['id'] == ""){
						$comArr = array();
						$comArr['Communication']['user_id'] = $userId;
						
						$this->Communication->save($comArr);
					}
					//Save entry in communication ::End
					
					$saved_user_id = isset($userId) ? $userId : $id;
					$save_relation = array();
					foreach($user_group_ids as $key=>$val){
						$save_relation[$key]['UserGroupsUser']['user_id'] = $saved_user_id;
						$save_relation[$key]['UserGroupsUser']['group_id'] = $val;
					}
					//pr($save_relation); exit;
					$this->loadModel('UserGroupsUser');
					$this->UserGroupsUser->saveAll($save_relation, array('validate'=>false));
					$this->data['User']['password'] = $original_password;
						$condition=array('User.id'=>$userId);
						$user = $this->User->find('first',array('conditions'=>$condition,'fields'=>array('id','email','email','name')));
						
						//SEND EMAIL TO ADDED USER
						$this->sendEmailToUser($userId, 3);
						//pr($edit_data); die;
						$this->Session->setFlash('Account has been created successfully.','message/green');
						//pr($this->data); die;
						if($this->data['User']['hidden_val'] == 'user_group') {
							$this->redirect(array('controller'=>'user_groups','action'=>'index'));
						}else{ 
							//echo "sam"; die;
							$this->redirect('index');
						}
				}
				
			} else{ 
				if((array_key_exists('email',$this->User->validationErrors)) AND (sizeof($this->User->validationErrors) == 1) AND ($this->User->validationErrors['email'] == ADMIN_EMAIL_EXIST)){ 
					$userInfo = $this->User->find('first',array('conditions'=>array('User.email'=>trim($this->data['User']['email']))));
					/**If user already paid for both, GM and Individual**/
					if(($userInfo['User']['individual_payment_status'] == 1) AND ($userInfo['User']['group_payment_status'] == 1)){
						if($_SESSION['User']['applyFor'] == 1){
							$this->Session->setFlash('User email already have user access.','default',array('class'=>'success_msg'));	
						} else {
							$this->Session->setFlash('User email already have group access.','default',array('class'=>'success_msg'));
						}
						
						$this->redirect(array('controller'=>'users','action'=>'admin_add'));
					}
					/**If user already paid for GM not for Individual**/
					elseif(($userInfo['User']['individual_payment_status'] == 0) AND ($userInfo['User']['group_payment_status'] == 1)){
						$this->data['User']['id'] = $userInfo['User']['id'];
						
						if($_SESSION['User']['applyFor'] == 1){
							$payStatus = 1; 
							$this->User->updateAll(array('User.individual_payment_status'=>"'$payStatus'"),array('User.id'=>$userInfo["User"]["id"]));
							$this->Session->setFlash('Email already exist in vimbli. User functionality has been added to this email now.','default',array('class'=>'success_msg'));
						} else {
							//$payStatus = 1; 
							//$this->User->updateAll(array('User.group_payment_status'=>"'$payStatus'"),array('User.id'=>$userInfo["User"]["id"]));
							$this->Session->setFlash('Email already has group manager access.','default',array('class'=>'success_msg'));
						}
						//$this->User->save($this->data['User']);
						//SEND EMAIL TO ADDED USER
						$this->sendEmailToUser($userInfo['User']['id'], 8); //User function added
						//$this->redirect(array('controller'=>'users','action'=>'admin_index'));
						$this->redirect($this->referer());
						
					}
					/**If user already paid for Individual not for GM**/
					elseif(($userInfo['User']['individual_payment_status'] == 1) AND ($userInfo['User']['group_payment_status'] == 0)){
						$this->data['User']['id'] = $userInfo['User']['id'];
						
						if($_SESSION['User']['applyFor'] == 1){
							//$payStatus = 1; 
							//$this->User->updateAll(array('User.individual_payment_status'=>"'$payStatus'"),array('User.id'=>$userInfo["User"]["id"]));
							$this->Session->setFlash('User email already have user access.','default',array('class'=>'success_msg'));
						} else {
							$payStatus = 1; 
							$this->User->updateAll(array('User.group_payment_status'=>"'$payStatus'"),array('User.id'=>$userInfo["User"]["id"]));
							$this->Session->setFlash('Email already exist in vimbli. Group functionality has been added to this email now.','default',array('class'=>'success_msg'));
						}
						
						//$this->User->save($this->data['User']);
						//SEND EMAIL TO ADDED USER
						$this->sendEmailToUser($userInfo['User']['id'], 9);//GM function added
						$this->redirect(array('controller'=>'users','action'=>'admin_add'));
					}
					/**If email existed as sponsor but not as a paid user**/
					elseif(($userInfo['User']['individual_payment_status'] == 0) AND ($userInfo['User']['group_payment_status'] == 0)) {
						
						$this->data['User']['id'] = $userInfo['User']['id'];
						if($_SESSION['User']['applyFor'] == 1){
							$payStatus = 1; 
							$this->User->updateAll(array('User.individual_payment_status'=>"'$payStatus'"),array('User.id'=>$userInfo["User"]["id"]));
							$this->Session->setFlash('Email already exist in vimbli. User functionality has been added to this email now.','default',array('class'=>'success_msg'));
							//SEND EMAIL TO ADDED USER
							$this->sendEmailToUser($userInfo['User']['id'], 8);//GM function added
						} else {
							$payStatus = 1; 
							$this->User->updateAll(array('User.group_payment_status'=>"'$payStatus'"),array('User.id'=>$userInfo["User"]["id"]));
							$this->Session->setFlash('Email already exist in vimbli. Group functionality has been added to this email now.','default',array('class'=>'success_msg'));
							//SEND EMAIL TO ADDED USER
							$this->sendEmailToUser($userInfo['User']['id'], 9);//GM function added
						}
						//$this->User->save($this->data['User']);
						//$this->redirect(array('controller'=>'users','action'=>'admin_index'));
						$this->redirect($this->referer());
					}
				} 
				
				$errorArray = $this->User->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	
	/** 
	@function : sign_up 
	@description : register user to vimbli
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Nov 30, 2012
	*/
	function sign_up(){
		
		
		$this->set('pagetitle','Sign Up');
		$this->layout = "inner_pages";
		
		/*if(@$_SESSION['Auth']['User']['id'] != "")
		{ $this->redirect(array('controller'=>'users','action'=>'welcome')); } */
		$this->Session->destroy();
		$this->Session->delete('User');
		Cache::clear();
		header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
		
		
		
		if(!empty($this->data))
		{	
			$this->User->set($this->data);
			$this->User->validate=$this->User->validateSignUp;
			if($this->User->validates()){
				
				if(@$this->data['User']['agree'] != "")
				{
					uses('sanitize');
					$this->Sanitize = new Sanitize;
					$this->data = $this->Sanitize->clean($this->data);
					$this->data['User']['password'] = $this->Auth->password($this->data['User']['pwd']);
					$this->data['User']['name'] = ucwords(strtolower($this->data['User']['name']));
					$this->data['User']['birthdate'] = $this->data['User']['birth_year'].'-'.$this->data['User']['birth_month'].'-'.$this->data['User']['birth_day'];
					$this->data['User']['status'] = '1';
					$this->data['User']['free_subscription_start'] = date('Y-m-d H:i:s');
					
					/***** Age should be 13+ ****/
					$today = date('Y-m-d');
					$dob = $this->data['User']['birthdate'];
					$dateBefore13yrs = date('Y-m-d', strtotime(date("Y-m-d", strtotime($today)) . " -13 year"));
					
					if($dateBefore13yrs >= $dob)
					{
						if($this->User->save($this->data)) {
							$this->Session->write('recentUserId',$this->User->getLastInsertId());						
							
							//Set Schedule balance vars
							$this->add_default_values($this->User->getLastInsertId());
							
							//Add entry in transaction table :: Start
							$this->loadModel('Transaction');
							$tranArr = array();
							
							$tranArr['Transaction']['type'] = 'free'; //For next 30 days
							$tranArr['Transaction']['user_id'] = $this->User->getLastInsertId();
							$tranArr['Transaction']['sub_date'] = date('Y-m-d H:i:s');
							
							$thirtyDaysPlus = strtotime('+30 days' , strtotime (date('Y-m-d H:i:s')));
							//$thirtyDaysPlus = strtotime('+1 day' , strtotime (date('Y-m-d H:i:s')));
							$after30Days = date('Y-m-d H:i:s', $thirtyDaysPlus);
							
							$tranArr['Transaction']['expiry_date'] = $after30Days;
							
							$this->Transaction->save($tranArr);
							//Add entry in transaction table :: Start
							
							$this->Session->setFlash('Details has been saved successfully.');
							$this->Session->setFlash('Basic Info saved successfully. Please continue.', 'default', array('class' => 'flash_success'));
							$this->redirect(array('controller'=>'users','action'=>'complete_transaction'));
						}
					}else{
						$errorArray[] = 'You must be older than 13 years';
						$this->set('validationErrorsArray',$errorArray);
					}
				} else{
					$errorArray[] = 'You must agree to the terms of use';
					$this->set('validationErrorsArray',$errorArray);
				}
				
			} else{ 
				if((array_key_exists('email',$this->User->validationErrors)) AND (sizeof($this->User->validationErrors) == 1) AND ($this->User->validationErrors['email'] == ADMIN_EMAIL_EXIST)){ 
					$userInfo = $this->User->find('first',array('conditions'=>array('User.email'=>trim($this->data['User']['email']))));
					/**If user already paid for both, GM and Individual**/
					if(($userInfo['User']['individual_payment_status'] == 1) AND ($userInfo['User']['group_payment_status'] == 1)){
						$this->Session->setFlash('User email already exist on Vimbli. Please login. If you lost your password try the lost password option. If it still does not work, contact Vimbli.', 'default', array('class' => 'flash_success'));
						$this->redirect(array('controller'=>'users','action'=>'login'));
					
					}
					/**If user already paid for GM not for Individual**/
					elseif(($userInfo['User']['individual_payment_status'] == 0) AND ($userInfo['User']['group_payment_status'] == 1)){
						/**count all the users under this GM*
						 * Uncomment while implementing the subscription moudle
						$myUsers = $this->User->find('count',array('conditions'=>array('User.manager_id'=>$userInfo['User']['id'])));
						*//**If GM reches the max number of user according to the subscription plan*
						if($userInfo['User']['no_of_users'] <= $myUsers){
							
						}*/
						
						/** Update the manager_if field for this GM*
						 * Add itself as an individual too
						**/
						$this->data['User']['id'] = $userInfo['User']['id'];
						$manager_id = $userInfo['User']['id'];
						$this->data['User']['individual_payment_status'] = 1; //Payment will be covered under group subscription
						//$this->User->save($this->data['User']);
						$payStatus = 1; 
						$this->User->updateAll(array('User.individual_payment_status'=>"'$payStatus'",'User.manager_id'=>"'$manager_id'"),array('User.id'=>$userInfo["User"]["id"]));
						
						//Set Schedule balance vars
						$this->add_default_values($userInfo["User"]["id"]);
								
						//Save entry in communication ::Start
						$comArr = array();
						$comArr['Communication']['user_id'] =  $userInfo['User']['id'];
						
						$this->Communication->save($comArr);
						//Save entry in communication ::End
						
						$this->Session->setFlash('User email already exist on Vimbli. Please login. If you lost your password try the lost password option. If it still does not work, contact Vimbli.', 'default', array('class' => 'flash_success'));
						$this->redirect(array('controller'=>'users','action'=>'login'));
						
					}
					/**If user already paid for Individual not for GM**/
					elseif(($userInfo['User']['individual_payment_status'] == 1) AND ($userInfo['User']['group_payment_status'] == 0)){
						$_SESSION['paymentFor'] = 'Group'; //Needed in subscription function
						$this->Session->setFlash('Email already exist in vimbli. Please continue with Group subscription if you want to add a group to your profile.', 'default', array('class' => 'flash_success'));
						$this->redirect(array('controller'=>'users','action'=>'subscription',$userInfo['User']['id']));
					}
					/**If email existed as sponsor but not as a paid user**/
					elseif(($userInfo['User']['individual_payment_status'] == 0) AND ($userInfo['User']['group_payment_status'] == 0)) {
						$this->Session->setFlash('Email already exist in vimbli database. Please continue.', 'default', array('class' => 'flash_success'));
						$_SESSION['recentUserId'] = $userInfo['User']['id']; // Needed in complete_transaction function
						$this->redirect(array('controller'=>'users','action'=>'complete_transaction'));
							
					}
				} 
				
				$errorArray = $this->User->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
		        
	}
	
	
	/** 
	@function : complete_transaction 
	@description : Second step of user registration
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : Mar. 11, 2013; Jul. 26, 2013
	@Created Date : Dec 04, 2012
	*/
	function complete_transaction(){
		$this->set('pagetitle','Complete transaction');
		$this->layout = "inner_pages";
		if($_SESSION['recentUserId'] == "")
		{
			$this->redirect(array('controller' => 'users', 'action' => 'sign_up'));
		}
		
		if(!empty($this->data))
		{
			//pr($this->data); die;
			$this->data = Sanitize::clean($this->data, array('encode' => false));
			if($this->data['User']['user_type'] == "Group") {
				$this->data['User']['is_manager'] = 1;
				//manager can register 10users for free
				$this->data['User']['no_of_users'] = 10;
				$this->data['User']['user_type'] = 2;
				$this->data['User']['group_payment_status'] = 1; 
				$_SESSION['paymentFor'] = 'Group';
			}else {
				$this->data['User']['is_manager'] = 0;
				$this->data['User']['user_type'] = 1;
				$this->data['User']['individual_payment_status'] = 1;
				$_SESSION['paymentFor'] = 'Individual';
			}
			$this->data['User']['id'] = $_SESSION['recentUserId'];
			$this->User->save($this->data['User']);
			//$this->redirect(array('controller'=>'users','action'=>'subscription',$_SESSION["recentUserId"]));
			
			//fetch user's info
			$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['recentUserId'])));
			
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
			$template = $this->Common->getEmailTemplate(3);
			
			$this->Email->from = INFO_EMAIL;
			$this->Email->subject = $template['EmailTemplate']['subject'];
			$data=$template['EmailTemplate']['description'];
			$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
			$site_link = '<a href='.SITE_URL.'>'.SITE_URL.'</a>';
			$data=str_replace('{SITE_LINK}',$site_link,$data);
			
			$this->set('data',$data);
			$this->Email->to = $userInfo['User']['email'];
			//$this->Email->to = "smaartdatatest@gmail.com";
			$this->Email->template='commanEmailTemplate';
			$this->Email->send();
			/***** Send Welcome Email to User :: End *****/
			
			//Redirect user to welcome widow immediatly after registration
			$email = $userInfo['User']['email'];
			$pass = $userInfo['User']['password'];
			//$this->Auth->userScope = array('User.user_type' => $userInfo['User']['user_type']);
			$loginArray = array('email' => $email, 'password' => $pass);
			//pr($loginArray);
			if ($this->Auth->login($loginArray)) { //echo 1; die;
				if($userInfo['User']['user_type'] == 2)//i.e group manager
					$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
				else 
					$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
			} else { //echo 2; die;
			}
			
					
		}
		
	}
	
	/** 
	@function : subscription 
	@description : subscription page
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : Mar. 11, 2013
	@Created Date : Mar. 08, 2013
	*/
	function subscription($id=NULL){
		$this->set('pagetitle','Subscription');
		$this->layout = "inner_pages";
		$userId = $id;
		$this->set(compact('userId'));
		
		if(!empty($this->data))
		{	
			if($this->data['User']['subscription'] == "Group") {
				$this->data['User']['group_payment_status'] = 1; //Paid successfully for group
				$this->data['User']['user_type'] = 2;
			}else {
				$this->data['User']['individual_payment_status'] = 1; //Paid successfully for individual
				$this->data['User']['user_type'] = 1;
			}
			$this->data['User']['id'] = $this->data['User']['id_of_user'];
			//pr($this->data); die;
			$this->User->save($this->data['User']);
			
			//Save entry in communication ::Start
			$comArr = array();
			$comArr['Communication']['user_id'] = $this->data['User']['id_of_user'];
			$this->Communication->save($comArr);
			//Save entry in communication ::End
			
			/**Process the payment using paypal**/
			/***********************************/
			
			//fetch user's info
			$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$this->data["User"]["id_of_user"])));
			
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
			$template = $this->Common->getEmailTemplate(3);
			
			$this->Email->from = INFO_EMAIL;
			$this->Email->subject = $template['EmailTemplate']['subject'];
			$data=$template['EmailTemplate']['description'];
			$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
			$site_link = '<a href='.SITE_URL.'>'.SITE_URL.'</a>';
			$data=str_replace('{SITE_LINK}',$site_link,$data);
			
			$this->set('data',$data);
			$this->Email->to = $userInfo['User']['email'];
			$this->Email->template='commanEmailTemplate';
			$this->Email->send();
			/***** Send Welcome Email to User :: End *****/
			
			//Redirect user to welcome widow immediatly after registration
			$email = $userInfo['User']['email'];
			$pass = $userInfo['User']['password'];
			//$this->Auth->userScope = array('User.user_type' => $userInfo['User']['user_type']);
			$loginArray = array('email' => $email, 'password' => $pass);
			//pr($loginArray);
			if ($this->Auth->login($loginArray)) { //echo 1; die;
				if($userInfo['User']['user_type'] == 2)//i.e group manager
					$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
				else 
					$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
			} else { //echo 2; die;
			}
			//$this->redirect(array('controller'=>'users','action'=>'registered'));
		}
	}
	
	
	/*
	Function Name: registered
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Dec. 04, 2012
	Description : tmp. landing page after login
	*/
	function registered() {
		$this->Session->delete('recentUserId');
		echo 'Registeration Successful'; die;
	}
	
	/** 
	@function : login 
	@description : Users login
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 04, 2012
	*/
	function return_group_logo(){
		$manager = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['manager_id'])));
		return $manager; 
	}
	
	/** 
	@function : login 
	@description : Users login
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 04, 2012
	*/ 
	function login($email=null,$tmp=NULL){
		//echo "<pre>";print_r($this->data);die;
		
		//Create cookie if remember checked :: Start
		$this->loadModel('User');
		if(!empty($this->data))
		{
			//pr($this->data); die;
			
				//pr($dormant); die;
				$this->User->validate=$this->User->validateLogin;
				$this->User->set($this->data);
				if($this->User->validates()){
				    $user = $this->Auth->user();
				    if($user) {
					if (!empty($this->data) && $this->data['User']['remember_me']) {
					$cookie = array();
					//pr($this->data); die;
					$cookie['email'] = $this->data['User']['email'];
					$cookie['password'] = $this->data['User']['password'];
					$cookie['user_type'] = $this->data['User']['user_type'];
					
					// Cookie is valid for 14 days
					$this->Cookie->write('Auth.email', $cookie['email'], false, 1209600);
					$this->Cookie->write('Auth.password', $cookie['password'], false, 1209600);
					$this->Cookie->write('Auth.user_type', $cookie['user_type'], false, 1209600);
					unset($this->data['User']['remember_me']);
					}
				   // $this->redirect(array('controller' => 'users', 'action' => 'welcome'));
				    }
				}
			
		}
		
		//Create cookie if remember checked :: End
		
		//If remembered :: Start
		$email = $this->Cookie->read('Auth.email');
		$pass = $this->Cookie->read('Auth.password');
		$user_type = $this->Cookie->read('Auth.user_type');
		$cookie = array('email' => $email, 'password' => $pass);
		//echo $user_type;
		//pr($cookie); die;
		
		if($this->data['User']['email'] != ""){
			$dormant = $this->User->find('first',array('recursive'=>-1,'conditions'=>array('User.email'=>$this->data['User']['email'])));
		}
		
		// if dormant user
		if(!empty($dormant)){
			//Check for inactive Account
			$dorm_usr = $dormant['User']['id'];
			if(($_SESSION['Auth']['User']['manager_id'] != "") OR ($_SESSION['Auth']['User']['manager_id'] != 0)){
				$dorm_usr = $_SESSION['Auth']['User']['manager_id'];
			}
			
			$this->loadModel('Transaction');
			$transInfo = $this->Transaction->find('first',array('conditions'=>array('Transaction.user_id'=>$dorm_usr),'order'=>'Transaction.id DESC'));
			
			//pr($transInfo); die;
			if($dormant['User']['dormant_user'] == 1){
				$this->redirect(array('controller' => 'payments', 'action' => 'deactivated_user'));
			}if(($transInfo['Transaction']['expiry_date'] != '') AND ($transInfo['Transaction']['expiry_date'] < date('Y-m-d H:i:s')) AND ($transInfo['Transaction']['expiry_date'] != $transInfo['Transaction']['sub_date'])){ //3rd conditions means never ending recurring
				$this->redirect(array('controller' => 'payments', 'action' => 'deactivated_user'));
			}
		}else{ 
			if($this->Auth->login($cookie)) {
				if($user_type == 3){
					$this->redirect(array('controller' => 'users', 'action' => 'welcome_sponsor'));
				} elseif($user_type == 2){
					$this->redirect(array('controller' => 'groups', 'action' => 'dashboard'));
				} else{
					$this->redirect(array('controller' => 'users', 'action' => 'welcome'));
				}
				
			}
		}
		//If remembered :: End
		
		
		if($tmp != ""){
			
			$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$tmp)));
		
			$email = $userInfo['User']['email'];
			$pass = $userInfo['User']['password'];
			//$this->Auth->userScope = array('User.user_type' => $userInfo['User']['user_type']);
			$loginArray = array('email' => $email, 'password' => $pass);
			
			if ($this->Auth->login($loginArray)) { //echo 1; die;
				$_SESSION['Auth']['redirect'] = '/users/welcome';
				//echo '<pre>'; print_r($_SESSION); die;
				//$this->redirect(array('controller' => 'timelines', 'action' => 'index',base64_encode($tmp)));
				$this->redirect(array('controller' => 'users', 'action' => 'welcome'));	
			} else { //echo 2; die;
				$this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
		}/**/
		
		//pr($this->data); die;
		//echo '<pre>'; print_r($_SESSION); die;
		//echo $email; die;
		if($email == 'first_login'){
			$this->Session->write('first_login',1);
		}
		$this->set('pagetitle','Login');
		$this->layout = "inner_pages";
		
		if(@$_SESSION['Auth']['User']['id'] != "")
		{
			
			//Used in welcome function
			if($_SESSION['Auth']['User']['last_accessed'] == '0000-00-00 00:00:00'){
				$_SESSION['change_pass'] = 1;
			}
			
			$saveLastAccess = array();
			$saveLastAccess['User']['last_accessed'] =   date("Y-m-d H:i:s");
			$saveLastAccess['User']['id']= $_SESSION['Auth']['User']['id'];
			//delete exiting entry & save new record with updated time
			$this->User->save($saveLastAccess);
			
			/** Run Logout if user not paid for respective account @ Mar. 11, 2013**/
			if($this->data['User']['user_type'] == 1){
				if($_SESSION['Auth']['User']['individual_payment_status'] != 1){
					$this->noaccess();
				}
			} elseif($this->data['User']['user_type'] == 2){
				if($_SESSION['Auth']['User']['group_payment_status'] != 1){
					$this->noaccess();
				}
			} elseif($this->data['User']['user_type'] == 3){ //For sponsor
				$isSponsor = $this->SponsorManager->find('first',array('conditions'=>array('SponsorManager.sponsor_id'=>$_SESSION['Auth']['User']['id'])));
				
				if(empty($isSponsor)){
					$this->noaccess();
				}
			}
			/** Run Logout :: End**/
			
			/* Update field in db and Manually over write the session for user-type, which is selected from login window*/
			if($this->data['User']['user_type'] != ""){
				$loginType = $this->data['User']['user_type']; 
				$this->User->updateAll(array('User.user_type'=>"'$loginType'"),array('User.id'=>$_SESSION['Auth']['User']['id']));
				$_SESSION['Auth']['User']['user_type'] = $this->data['User']['user_type'];
			}
			
			if($_SESSION['Auth']['User']['user_type'] == 3)
			{
				//i.e individual
				$this->redirect(array('controller'=>'users','action'=>'welcome_sponsor'));
			}
			else if($_SESSION['Auth']['User']['user_type'] == 2){
				//i.e group manager
				$this->redirect(array('controller'=>'groups','action'=>'dashboard'));
			}
			else {
				$userdata=$this->Auth->User();
				if(!empty($this->data))
				{
					
					$this->User->validate=$this->User->validateLogin;
					$this->User->set($this->data);
					if($this->User->validates()){
					    $user = $this->Auth->user();
					    if($user) {
						if (!empty($this->data) && $this->data['User']['remember_me']) {
						$cookie = array();
						pr($this->data); die;
						$cookie['email'] = $this->data['User']['email'];
						$cookie['password'] = $this->data['User']['password'];
						$cookie['user_type'] = $this->data['User']['user_type'];
						// Cookie is valid for 14 days
						$this->Cookie->write('Auth.email', $cookie['email'], false, 1209600);
						$this->Cookie->write('Auth.password', $cookie['password'], false, 1209600);
						unset($this->data['User']['remember_me']);
						}
					   // $this->redirect(array('controller' => 'users', 'action' => 'welcome'));
					    }
					}
			    
				}
			else { 	
				$email = $this->Cookie->read('Auth.email');
				$pass = $this->Cookie->read('Auth.password');
				$cookie = array('email' => $email, 'password' => $pass);
				
				if (!empty($email) && !empty($pass)) {
		    
					if ($this->Auth->login($cookie)) {
						$this->redirect(array('controller' => 'users', 'action' => 'welcome'));	
					} else {
					    $this->Cookie->destroy('Auth');
					    # delete invalid cookie
					}
				}
				//$this->redirect('/admin/users/index');
			    }
				$this->redirect(array('controller'=>'connections','action'=>'set_import_info'));
			}
		}
		
		//$userdata=$this->Auth->User();
			   
		/*if(!empty($this->data))
		{
			
			$this->User->validate=$this->User->validateLogin;
			$this->User->set($this->data);
			if($this->User->validates()){
			    $user = $this->Auth->user();
			   
			    if($user) {
				if (!empty($this->data) && $this->data['User']['remember_me']) {
				$cookie = array();
				$cookie['email'] = $this->data['User']['email'];
				$cookie['password'] = $this->data['User']['password'];
				// Cookie is valid for 14 days
				$this->Cookie->write('Auth.email', $cookie['email'], false, 1209600);
				$this->Cookie->write('Auth.password', $cookie['password'], false, 1209600);
				unset($this->data['User']['remember_me']);
				}
			    $this->redirect(array('controller' => 'users', 'action' => 'welcome'));
			    }
			}
	    
		}
		else { 	
			$email = $this->Cookie->read('Auth.email');
			$pass = $this->Cookie->read('Auth.password');
			$cookie = array('email' => $email, 'password' => $pass);
			
			if (!empty($email) && !empty($pass)) {
	    
				if ($this->Auth->login($cookie)) {
					$this->redirect(array('controller' => 'users', 'action' => 'welcome'));	
				} else {
				    $this->Cookie->destroy('Auth');
				    # delete invalid cookie
				}
			}
			//$this->redirect('/admin/users/index');
		    }*/
		    
		//$this->redirect(array('controller' => 'users', 'action' => 'welcome'));
	
	}
	
	
	/*
	Function Name: logout
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Dec. 04, 2012
	Description : for logout user
	*/
	function logout() { 
		$this->autoRender=false;
		$this->Cookie->destroy('Auth');
		$this->Session->delete('user_email');
		$this->Session->delete('first_login');
		$this->Session->delete('Connection');
		$this->Session->delete('Schedule');
		$this->Session->delete('Rating');
		$this->Session->setFlash('User logged out.', 'default', array('class' => 'flash_success'));
		$this->redirect($this->Auth->logout());
	}
	
	/*
	Function Name: noaccess
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Mar. 11, 2013
	Description : for logout user if enter in no access area
	*/
	function noaccess() { 
		$this->autoRender=false;
		$this->Cookie->destroy('Auth');
		$this->Session->delete('user_email');
		$this->Session->delete('first_login');
		$this->Session->delete('Connection');
		$this->Session->setFlash('You do not have access to this area.');
		$this->redirect($this->Auth->logout());
	}
	
	/*
	function run_in_background($Command, $Priority = 0)
	{
	    if($Priority)
		$PID = shell_exec("nohup nice -n $Priority $Command 2> /dev/null & echo $! &");
	    else
		$PID = shell_exec("nohup $Command 2> /dev/null & echo $! &");
	    return($PID);
	}
	
	function execInBackground($cmd) {
		if (substr(php_uname(), 0, 7) == "Windows"){
		    pclose(popen("start /B ". $cmd, "r")); 
		}
		else {
		    exec($cmd . " > /dev/null &");  
		}
	} */
	
	     
	/*
	Function Name: welcome
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Dec. 04, 2012
	Description : tmp. landing page after login
	*/
	function welcome() {
		//echo '<pre>'; print_r($_SESSION); die;
		/*Cron/background-process to immediate fetch (exclude "beta" after transfer to vimbli.com)*/
		if($_SESSION['Connection']['immediate_fetch'] == 1){
			$command = "php /srv/www/htdocs/app/webroot/cron_dispatcher.php /connections/immediate_fetch/".$_SESSION['Auth']['User']['id'];
			exec($command."> /dev/null &");
			$_SESSION['Connection']['FIRST_SYNC_COMMAND'] = $command;
			
			//Enter record in processes table
			$existRec = $this->Process->find('first',array('conditions'=>array('Process.user_id'=>$_SESSION['Auth']['User']['id'],'Process.title'=>'first_sync')));
			$processArr = array();
			if($existRec['Process']['id'] != ""){
				$processArr['Process']['id'] = $existRec['Process']['id'];	
			}
			$processArr['Process']['user_id'] = $_SESSION['Auth']['User']['id'];
			$processArr['Process']['title'] = 'first_sync';
			$processArr['Process']['status'] = 1;
			$processArr['Process']['created'] = date('Y-m-d H:i:s');
			$this->Process->save($processArr);
		}
		/*******************/
		
		//Last updated time to show in balance
		$date = $this->User->find('first',array('fields'=>array('User.last_timeline_update'),'conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id'])));
		$this->set('date',$date['User']['last_timeline_update']);
		//----- //
				
		//For Schedule section
		if(!empty($this->data)){
			//pr($this->data); die;
			//Sessions for Schedule balance
			if($this->data['Schedule']['day_hrs'] == 'work'){
				$this->Session->write('Schedule.day_hrs','work');
			}else{
				$this->Session->write('Schedule.day_hrs','all');
			}
			
			if($this->data['Schedule']['week'] == 'prev'){
				$this->Session->write('Schedule.week','prev');
			}else{
				$this->Session->write('Schedule.week','next');
			}
			
			//Sessions for My-Rating
			if($this->data['Rating']['time_frame'] == 'Year'){
				$this->Session->write('Rating.time_frame','Year');
			}elseif($this->data['Rating']['time_frame'] == 'Day'){
				$this->Session->write('Rating.time_frame','Day');
			}elseif($this->data['Rating']['time_frame'] == 'Month'){
				$this->Session->write('Rating.time_frame','Month');
			}elseif($this->data['Rating']['time_frame'] == 'Mission'){
				$this->Session->write('Rating.time_frame','Mission');
			}else{ //Default will be day
				$this->Session->write('Rating.time_frame','Week');
			}
			
			if($this->data['Rating']['activity_type'] == 'Reflection'){
				$this->Session->write('Rating.activity_type','Reflection');
			}else{
				$this->Session->write('Rating.activity_type','All');
			}
		}else{
			$this->Session->write('Rating.time_frame','Week');
		}
		//pr($_SESSION); die;
		
		//if first login after changePass/inviteUser go to change pass
		if(isset($_SESSION['change_pass']) && $_SESSION['change_pass'] == 1){
			$this->redirect(array('controller'=>'settings','action'=>'index',base64_encode($_SESSION['Auth']['User']['id']),'change_password'));
		}
		
		$user_id = $_SESSION['Auth']['User']['id'];
		$this->loadMOdel('UserReflection');
		$this->loadMOdel('Mission');
		
		$this->set('pagetitle','Welcome');
		if($_SESSION['Auth']['User']['user_type'] == 1)
			$this->layout = "individual_dashboard";
		elseif($_SESSION['Auth']['User']['user_type'] == 2)
			$this->layout = "group_dashboard";
		//$this->MissionUser->recursive = 2;
		//*********modified on 31 june
		$totalMission= $this->Mission->find('all',array('recursive'=>-1,'conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id']),'fields'=>array('Mission.title'), 'order'=>'Mission.id DESC'));
		$this->set('totalMission',$totalMission);
		$mission_ids=$totalMission= $this->Mission->find('all',array('recursive'=>-1,'conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id']),'fields'=>array('Mission.id'), 'order'=>'Mission.id DESC'));
		//pr($mission_ids);
		$this->set('mission_ids',$mission_ids);
		
		/*****************/
		//pr($totalMission); die;
		$recentMission = $this->Mission->find('first',array('recursive'=>2,'conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_by_gm'=>0), 'order'=>'Mission.id DESC'));
		$this->set(compact('recentMission'));
		//pr($recentMission); die;
		//General progress calculations
		//Convert time according to user's timezone
		$userDate = date('Y-m-d',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
		$userDateTime = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
			
		$mission_duration = floor((strtotime($recentMission['Mission']['end_time']) - strtotime($recentMission['Mission']['start_time']))/86400);
		$mission_duration = $mission_duration+1; //Coz, mission starts from 00:00 and ends on 23:59
		$mission_duration_in_hrs = ceil((strtotime($recentMission['Mission']['end_time']) - strtotime($recentMission['Mission']['start_time']))/3600);
		//echo $mission_duration; die;
		$days_spent_till_date = floor((strtotime($userDateTime) - strtotime($recentMission['Mission']['start_time']))/86400);
		$hrs_spent_till_date = floor((strtotime($userDateTime) - strtotime($recentMission['Mission']['start_time']))/3600);
		$hrs_spent_till_date = ($hrs_spent_till_date>$mission_duration_in_hrs)?$mission_duration_in_hrs:$hrs_spent_till_date;
		$duration_percentage = ($hrs_spent_till_date/$mission_duration_in_hrs)*100;
		
		$this->set("days_in_mission",$mission_duration);
		if($days_spent_till_date >$mission_duration){
			$days_spent_till_date = $mission_duration;
		}
		$this->set("elapsed_duration",$days_spent_till_date);
		$this->set(compact('duration_percentage'));
		
		$all_connections = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
		$all_connections_ids = array_keys($all_connections);
		//pr($recentMission); exit;
		//Connection Coverage calculations
		$totalTargetTouches = 0;
		$totalTouchesCount = 0;
		$targetedTouchWeekly = 0;
		$targetedTouchMonthly = 0;
		$targetedTouchMission = 0;
		
		
		$current_date = $userDateTime;
		$connectionIdsMsgSent = $connIdsMsgNotSent = $connTouchesOnce = $eventAttendyEmails = $refSharedWithConnections = array();
		
		foreach($recentMission['MissionConnection'] as $mis_con_key=>$mis_con_val){
			
			if($mis_con_val['frequency'] == 'Weekly'){
				$oneWeekAgo = strtotime ( '-1 week' , strtotime ($current_date));
				$oneWeekAgoDate = date ('Y-m-j H:i:s', $oneWeekAgo);
				
				/*** Calculation for total targeted touches :: Start @Vikas Uniyal, Apr. 09, 2013 ***/
				$targetedTouchWeekly = ($mission_duration/7)*$mis_con_val['hours'];
				$targetedTouchWeekly = ceil($targetedTouchWeekly);
				//echo $totalTargetTouches; die;
				$totalTargetTouches = $totalTargetTouches+$targetedTouchWeekly;
				//echo $totalTargetTouches; die;
				/*** Calculation for total hrs :: End ***/
				
				if($mission_duration_in_hrs < 168){ //If mission is less then 1 week
					$current_date = $recentMission['Mission']['end_time'];
					$oneWeekAgoDate = $recentMission['Mission']['start_time'];
					
					//In this case touches should be:
					//$mis_con_val['hours'] = ($mis_con_val['hours']/7)*($mission_duration_in_hrs/24);
				}
				
				if($oneWeekAgoDate <$recentMission['Mission']['start_time']){
					$oneWeekAgoDate = $recentMission['Mission']['start_time'];
				}
				//echo $oneWeekAgoDate;
				//echo '<br>'.$current_date; die;
				//echo '<pre>'; print_r($mis_con_val); die;
				//fetch all the message sent to connections
				//message data
				$this->Message->recursive  = -1;
				$all_messages_sent = $this->Message->find('count',array('conditions'=>array(
													   'Message.from_user_id'=>$_SESSION['Auth']['User']['id'],
													   'Message.to_user_type'=>'connection',
													   'Message.to_user_id'=>$mis_con_val['connection_id'],
													   'Message.local_message_time BETWEEN ? and ?'=>array($oneWeekAgoDate,$current_date)
													   )
										       )
									  );
				
				//reflections shared
				$this->UserReflection->recursive  = 3;
				$current_date = date('Y-m-d',strtotime($current_date)).' 23:59:59';
				$all_reflections = $this->UserReflection->find('all',array('conditions'=>array(
													   'UserReflection.user_id'=>$_SESSION['Auth']['User']['id'],
													   'UserReflection.local_reflection_date BETWEEN ? and ?'=>array($oneWeekAgoDate,$current_date)
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
				$mission_con_id[]=$mis_con_val['connection_id'];
				
				$touchesViaReflections = count(array_intersect($newAttendyArr,$mission_con_id));
				$touchesViaReflections = ($touchesViaReflections != "") ? $touchesViaReflections : 0;
				
				//events occured
				$all_cal_events = $this->CalendarEvent->find('all',array('conditions'=>array(
													   'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],
													   //'CalendarEvent.start_time BETWEEN ? and ?'=>array($oneWeekAgoDate,$current_date)
													   'CalendarEvent.local_start >='=>$oneWeekAgoDate,
													   'CalendarEvent.local_start <='=>$current_date 
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
				
				//echo "<pre>"; print_r($eventAttendyEmails); 
				//fetch all emails of this particular connection and check its intersection with Attendys
				$connectionEmails = $this->ConnectionEmail->find('list',array('conditions'=>array('ConnectionEmail.connection_id'=>$mis_con_val['connection_id']), 'fields'=>array('email')));
				
				unset($tmpCalCnt);
				foreach($connectionEmails as $allEmailcalKey => $allEmailCalVal){
					if($tmpCalCnt == 0){
						$userAllMailCal[0] = $allEmailCalVal;
						$tmpCalCnt = $tmpCalCnt+count(array_intersect($eventAttendyEmails,$userAllMailCal));
					}
				}
				
				$touchesViaCalendarEvents = $tmpCalCnt;
				//echo '<pre>'; print_r($connectionEmails); die;
				//echo $touchesViaCalendarEvents; die;
				
				//Touches via Activity::start
				//echo $touchesViaCalendarEvents; die;
				$all_act_events = $this->Activity->find('all',array('conditions'=>array(
													   'Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],
													   //'CalendarEvent.start_time BETWEEN ? and ?'=>array($oneWeekAgoDate,$current_date)
													   'Activity.local_start >='=>date("Y-m-d", strtotime($oneWeekAgoDate)),
													   'Activity.local_start <='=>date("Y-m-d",strtotime($current_date)) 
													   )
										       )
									  );
				//echo '<pre>'; print_r($all_act_events); die;
				
				//get all emails of Attendys of Activity Events
				unset($actAttendyEmails);
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
				
				//fetch all emails of this particular connection and check its intersection with Attendys
				$actconEmails = $this->ConnectionEmail->find('list',array('conditions'=>array('ConnectionEmail.connection_id'=>$mis_con_val['connection_id']), 'fields'=>array('email')));
				
				unset($tmpActCnt);
				foreach($actconEmails as $allEmailKay => $allEmailVal){
					if($tmpActCnt == 0){
						$userAllMail[0] = $allEmailVal;
						$tmpActCnt = $tmpActCnt+count(array_intersect($actAttendyEmails,$userAllMail));
					}
				}
				
				$touchesViaActEvents = $tmpActCnt;
				
				//echo '<pre>'; print_r($actAttendyEmails);
				//echo '<pre>'; print_r($userAllMail); 
				//echo $tmpActCnt;
				//echo 'Weekly: '.$touchesViaActEvents; //die;
				//Touches via Activity:: End
				
				foreach($connectionEmails as $con_key => $con_val){
					$con_email_to_count = $con_val;
				}
				
				$all_email_imported = $this->ImportEmail->find('count',array('conditions'=>array(
													   'ImportEmail.user_id'=>$_SESSION['Auth']['User']['id'],
													   'ImportEmail.email_from LIKE'=>'%'.$con_email_to_count.'%',
													   'ImportEmail.local_email_date BETWEEN ? and ?'=>array($oneWeekAgoDate,$current_date)
													   )
										       )
									  );
				//echo $all_email_imported; die;
				$totalTouches = $touchesViaReflections+$all_messages_sent+$all_email_imported+$touchesViaCalendarEvents+$touchesViaActEvents;
				
				if($totalTouches > $totalTargetTouches){
					$totalTouches = $totalTargetTouches;
				}
				
				//Save Connections Calculated Value ::Start
				$this->loadModel('MissionConnection');
				$touchesToSave = ceil($totalTouches);
				$modifiedDate = date('Y-m-d H:i:s');
				$this->MissionConnection->UpdateAll(array('MissionConnection.calculated_touch'=>"'$touchesToSave'",'MissionConnection.modified'=>"'$modifiedDate'"),array('MissionConnection.id'=>$mis_con_val['id'])); 
				//Save Connections Calculated Value ::End
				
				$totalTouchesCount = $totalTouchesCount+$totalTouches; //To show under Connectivity heading
				
				if($totalTouches <= $mis_con_val['hours'])
					$connIdsMsgNotSent[$mis_con_val['connection_id']] = $targetedTouchWeekly - $totalTouches;
				
				$totalTouchesPercentage[$mis_con_val['connection_id']] = ($totalTouches/$mis_con_val['hours'])*100;
				//pr($mis_con_val['hours']); exit;
				//compare total connections and total messages sent
				
				
			} elseif($mis_con_val['frequency'] == 'Monthly'){
				$oneMonthAgo = strtotime ( '-1 month' , strtotime ($current_date));
				$oneMonthAgoDate = date ( 'Y-m-j G:i:s' , $oneMonthAgo);
				
				if($mission_duration_in_hrs < 720){ //If mission is less then 1 Month
					$current_date = $recentMission['Mission']['end_time'];
					$oneMonthAgoDate = $recentMission['Mission']['start_time'];
					
					//In this case touches should be:
					//$mis_con_val['hours'] = ($mis_con_val['hours']/30)*($mission_duration_in_hrs/24);
				}
				
				if($oneMonthAgoDate <$recentMission['Mission']['start_time']){
					$oneMonthAgoDate = $recentMission['Mission']['start_time'];
				}
				
				/*** Calculation for total target touches :: Start @Vikas Uniyal, Apr. 09, 2013 ***/
				$targetedTouchMonthly = ($mission_duration/30)*$mis_con_val['hours'];
				$targetedTouchMonthly = ceil($targetedTouchMonthly);
				$totalTargetTouches = $totalTargetTouches+$targetedTouchMonthly;
				//echo $targetedTouchMonthly; die;
				/*** Calculation for total hrs :: End ***/
				
				$this->Message->recursive  = -1;
				$all_messages_sent = $this->Message->find('count',array('conditions'=>array(
													   'Message.from_user_id'=>$_SESSION['Auth']['User']['id'],
													   'Message.to_user_type'=>'connection',
													   'Message.to_user_id'=>$mis_con_val['connection_id'],
													   'Message.local_message_time BETWEEN ? and ?'=>array($oneMonthAgoDate,$current_date)
													   )
										       )
									  );
				//reflections shared
				$this->UserReflection->recursive  = 3;
				$all_reflections = $this->UserReflection->find('all',array('conditions'=>array(
													   'UserReflection.user_id'=>$_SESSION['Auth']['User']['id'],
													   'UserReflection.local_reflection_date BETWEEN ? and ?'=>array($oneMonthAgoDate,$current_date)
													   )
										       )
									  );
				//get all connections ids with which it is shared
				$ref_attendy = array();
				foreach($all_reflections as $sharedReflection){
					//Fetch con from reflectionAttendies
					foreach($sharedReflection['ReflectionAttendy'] as $attendy){
					$ref_attendy[] = $attendy['connection_id'];
					}
					
				}
				$newAttendyArr  = $ref_attendy;
				//pr($newAttendyArr); die;
				$mission_con_id = array();
				$mission_con_id[]=$mis_con_val['connection_id'];
				$touchesViaReflections = count(array_intersect($newAttendyArr,$mission_con_id));
				$touchesViaReflections = ($touchesViaReflections != "") ? $touchesViaReflections : 0;
				
				
				//events occured
				$all_cal_events = $this->CalendarEvent->find('all',array('conditions'=>array(
													   'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],
													   'CalendarEvent.local_start BETWEEN ? and ?'=>array($oneMonthAgoDate,$current_date)
													   )
										       )
									  );
				//echo "<pre>"; print_r($all_cal_events); die;
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
				$connectionEmails = $this->ConnectionEmail->find('list',array('conditions'=>array('ConnectionEmail.connection_id'=>$mis_con_val['connection_id']), 'fields'=>array('email')));
				
				unset($tmpCalCnt);
				foreach($connectionEmails as $allEmailcalKey => $allEmailCalVal){
					if($tmpCalCnt == 0){
						$userAllMailCal[0] = $allEmailCalVal;
						$tmpCalCnt = $tmpCalCnt+count(array_intersect($eventAttendyEmails,$userAllMailCal));
					}
				}
				
				$touchesViaCalendarEvents = $tmpCalCnt;
				//echo $touchesViaCalendarEvents; die;
				
				//echo 'Ago: '.$oneMonthAgoDate;
				//echo '<br>CurDate: '.$current_date;
				
				
				//Touches via Activity::start
				$all_act_events = $this->Activity->find('all',array('conditions'=>array(
													   'Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],
													   //'CalendarEvent.start_time BETWEEN ? and ?'=>array($oneWeekAgoDate,$current_date)
													   'Activity.local_start >='=>date("Y-m-d", strtotime($oneMonthAgoDate)),
													   'Activity.local_start <='=>date("Y-m-d",strtotime($current_date)) 
													   )
										       )
									  );
				//echo '<pre>'; print_r($all_act_events); 
				//get all emails of Attendys of Activity Events
				unset($actAttendyEmails);
				$actAttendyEmails = array();
				foreach($all_act_events as $actEvent){
					foreach($actEvent['ActivityAttendy'] as $actAttendy){
						$actAttendyEmails[] = $actAttendy['attendy_email'] ;
						
					}
					
				}
				//echo '<pre>'; print_r($actAttendyEmails); die;
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
				
				//fetch all emails of this particular connection and check its intersection with Attendys
				$actconEmails = $this->ConnectionEmail->find('list',array('conditions'=>array('ConnectionEmail.connection_id'=>$mis_con_val['connection_id']), 'fields'=>array('email')));
				unset($tmpActCnt);
				foreach($actconEmails as $allEmailKay => $allEmailVal){
					if($tmpActCnt == 0){
						$userAllMail[0] = $allEmailVal;
						$tmpActCnt = $tmpActCnt+count(array_intersect($actAttendyEmails,$userAllMail));
					}
				}
				
				$touchesViaActEvents = $tmpActCnt;
				//echo '<pre>'; print_r($actAttendyEmails);
				//echo '<pre>'; print_r($userAllMail); 
				//echo 'Monthly: '.$touchesViaActEvents; //die;
				//echo $touchesViaActEvents; die;
				//Touches via Activity:: End
				
				foreach($connectionEmails as $con_key => $con_val){
					$con_email_to_count = $con_val;
				}
				
				$all_email_imported = $this->ImportEmail->find('count',array('conditions'=>array(
													   'ImportEmail.user_id'=>$_SESSION['Auth']['User']['id'],
													   'ImportEmail.email_from LIKE'=>'%'.$con_email_to_count.'%',
													   'ImportEmail.local_email_date BETWEEN ? and ?'=>array($oneMonthAgoDate,$current_date)
													   )
										       )
									  );
				$totalTouches = $touchesViaReflections+$all_messages_sent+$all_email_imported+$touchesViaCalendarEvents+$touchesViaActEvents;
				//echo $totalTargetTouches; die;
				if($totalTouches > $totalTargetTouches){
					$totalTouches = $totalTargetTouches;
				}
				
				//Save Connections Calculated Value ::Start
				$this->loadModel('MissionConnection');
				$touchesToSave = ceil($totalTouches);
				$modifiedDate = date('Y-m-d H:i:s');
				$this->MissionConnection->UpdateAll(array('MissionConnection.calculated_touch'=>"'$touchesToSave'",'MissionConnection.modified'=>"'$modifiedDate'"),array('MissionConnection.id'=>$mis_con_val['id'])); 
				//Save Connections Calculated Value ::End
				
				//echo $totalTouches; die;
				$totalTouchesCount = $totalTouchesCount+$totalTouches; //To show under Connectivity heading
				//echo $totalTouchesCount; die;
				/*
				if($totalTouches == $mis_con_val['hours'] || $totalTouches > $mis_con_val['hours'])
					$connectionIdsMsgSent[$mis_con_key] = $mis_con_val['connection_id'];
				else
					$connIdsMsgNotSent[$mis_con_key] = $mis_con_val['connection_id'];
				*/
				if($totalTouches <= $mis_con_val['hours'])
					$connIdsMsgNotSent[$mis_con_val['connection_id']] = $targetedTouchMonthly - $totalTouches;
				
				$totalTouchesPercentage[$mis_con_val['connection_id']] = ($totalTouches/$mis_con_val['hours'])*100;
				
				//compare total connections and total messages sent
			} elseif($mis_con_val['frequency'] == 'Mission'){
				$missionStartTime = $recentMission['Mission']['start_time'];
				//$missionEndTime = $recentMission['Mission']['end_time'];
				
				/*** Calculation for total targeted touches :: Start @Vikas Uniyal, Apr. 09, 2013 ***/
				$targetedTouchMission = $mis_con_val['hours'];
				$totalTargetTouches = $totalTargetTouches+$targetedTouchMission;
				/*** Calculation for total hrs :: End ***/
					
				$this->Message->recursive  = -1;
				$all_messages_sent = $this->Message->find('count',array('conditions'=>array(
													   'Message.from_user_id'=>$_SESSION['Auth']['User']['id'],
													   'Message.to_user_type'=>'connection',
													   'Message.to_user_id'=>$mis_con_val['connection_id'],
													   'Message.local_message_time BETWEEN ? and ?'=>array($missionStartTime,$current_date)
													   )
											)
									  );
				//reflections shared
				$this->UserReflection->recursive  = 3;
				$all_reflections = $this->UserReflection->find('all',array('conditions'=>array(
													   'UserReflection.user_id'=>$_SESSION['Auth']['User']['id'],
													   'UserReflection.local_reflection_date BETWEEN ? and ?'=>array($missionStartTime,$current_date)
													   )
										       )
									  );
				//echo '<pre>'; print_r($all_reflections); die;
				//get all connections ids with which it is shared
				$ref_attendy = array();
				foreach($all_reflections as $sharedReflection){
					//Fetch con from reflectionAttendies
					foreach($sharedReflection['ReflectionAttendy'] as $attendy){
					$ref_attendy[] = $attendy['connection_id'];
					}
					
				}
				//echo '<pre>'; print_r($ref_attendy); die;
				$newAttendyArr  = $ref_attendy;
				//echo '<pre>'; print_r($newAttendyArr); 
				$mission_con_id = array();
				$mission_con_id[]=$mis_con_val['connection_id'];
				//echo '<pre>'; print_r($mission_con_id);  
				$touchesViaReflections = count(array_intersect($newAttendyArr,$mission_con_id));
				$touchesViaReflections = ($touchesViaReflections != "") ? $touchesViaReflections : 0;
				//echo $touchesViaReflections; //die;
				//events occured
				$all_cal_events = $this->CalendarEvent->find('all',array('conditions'=>array(
													   'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],
													   'CalendarEvent.local_start BETWEEN ? and ?'=>array($missionStartTime,$current_date)
													   )
										       )
									  );
				
				//pr($all_cal_events); die;
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
				$connectionEmails = $this->ConnectionEmail->find('list',array('conditions'=>array('ConnectionEmail.connection_id'=>$mis_con_val['connection_id']), 'fields'=>array('email')));
				
				unset($tmpCalCnt);
				foreach($connectionEmails as $allEmailcalKey => $allEmailCalVal){
					if($tmpCalCnt == 0){
						$userAllMailCal[0] = $allEmailCalVal;
						$tmpCalCnt = $tmpCalCnt+count(array_intersect($eventAttendyEmails,$userAllMailCal));
					}
				}
				
				$touchesViaCalendarEvents = $tmpCalCnt;
				//echo $touchesViaCalendarEvents; die;
				
				//Touches via Activity::start
				$all_act_events = $this->Activity->find('all',array('conditions'=>array(
													   'Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],
													   //'CalendarEvent.start_time BETWEEN ? and ?'=>array($oneWeekAgoDate,$current_date)
													   'Activity.local_start >='=>date("Y-m-d", strtotime($missionStartTime)),
													   'Activity.local_start <='=>date("Y-m-d",strtotime($current_date)) 
													   )
										       )
									  );
				//echo '<pre>'; print_r($all_act_events); die;
				
				//get all emails of Attendys of Activity Events
				unset($actAttendyEmails);
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
				
				//fetch all emails of this particular connection and check its intersection with Attendys
				$actconEmails = $this->ConnectionEmail->find('list',array('conditions'=>array('ConnectionEmail.connection_id'=>$mis_con_val['connection_id']), 'fields'=>array('email')));
				
				unset($tmpActCnt);
				foreach($actconEmails as $allEmailKay => $allEmailVal){
					if($tmpActCnt == 0){
						$userAllMail[0] = $allEmailVal;
						$tmpActCnt = $tmpActCnt+count(array_intersect($actAttendyEmails,$userAllMail));
					}
				}
				
				$touchesViaActEvents = $tmpActCnt;
				
				//echo $touchesViaActEvents; die;
				//Touches via Activity:: End
				
				foreach($connectionEmails as $con_key => $con_val){
					$con_email_to_count = $con_val;
				}
				
				$all_email_imported = $this->ImportEmail->find('count',array('conditions'=>array(
													   'ImportEmail.user_id'=>$_SESSION['Auth']['User']['id'],
													   'ImportEmail.email_from LIKE'=>'%'.$con_email_to_count.'%',
													   'ImportEmail.local_email_date BETWEEN ? and ?'=>array($missionStartTime,$current_date)
													   )
										       )
									  );
				
				$totalTouches = $touchesViaReflections+$all_messages_sent+$all_email_imported+$touchesViaCalendarEvents+$touchesViaActEvents;
				if($totalTouches > $totalTargetTouches){
					$totalTouches = $totalTargetTouches;
				}
				
				//Save Connections Calculated Value ::Start
				$this->loadModel('MissionConnection');
				$touchesToSave = ceil($totalTouches);
				$modifiedDate = date('Y-m-d H:i:s');
				$this->MissionConnection->UpdateAll(array('MissionConnection.calculated_touch'=>"'$touchesToSave'",'MissionConnection.modified'=>"'$modifiedDate'"),array('MissionConnection.id'=>$mis_con_val['id'])); 
				//Save Connections Calculated Value ::End
				
				$totalTouchesCount = $totalTouchesCount+$totalTouches; //To show under Connectivity heading
				
				if($totalTouches <= $mis_con_val['hours'])
					$connIdsMsgNotSent[$mis_con_val['connection_id']] = $targetedTouchMission - $totalTouches;
				
				$totalTouchesPercentage[$mis_con_val['connection_id']] = ($totalTouches/$mis_con_val['hours'])*100;
				
			} else{
				$connection_coverage = 0;
			}
		}
		
		//pr($totalTouchesPercentage); exit;
		if(sizeof($recentMission['MissionConnection']) != 0){
			$connection_coverage = (array_sum($totalTouchesPercentage)/sizeof($recentMission['MissionConnection']));
		}else{
			$connection_coverage = (array_sum($totalTouchesPercentage));
		}
		//echo array_sum($totalTouchesPercentage);
		//echo '<br>'.sizeof($recentMission['MissionConnection']);
		//echo $totalTouchesCount; die;
		$this->Session->write('connectionsNotTouched',$connIdsMsgNotSent);
		$this->set(compact('connection_coverage'));
		$this->set(compact('totalTouchesCount'));
		$totalTargetTouches = round($totalTargetTouches);
		$this->set(compact('totalTargetTouches'));
		
		//KeyToSuccess calculations
		//pr($recentMission); exit;
		$mission_duration = floor((strtotime($recentMission['Mission']['end_time']) - strtotime($recentMission['Mission']['start_time']))/86400);
		//Configure::write('debug',2);
		//$current_date = date("2013-02-18 11:50:s");
		$current_date = $userDateTime; 		  
		$timePassedTillNow = floor(strtotime($current_date) - strtotime($recentMission['Mission']['start_time']));
		
		//pr($recentMission['KeyToSuccess']); die;
		foreach($recentMission['KeyToSuccess'] as $k2sElement){
			$totalK2sDays = ceil((strtotime($k2sElement['end_date'].' 23:59:59') - strtotime($k2sElement['start_date'].' 00:00:00'))/86400);
			//echo $totalK2sDays; die;
			if(($k2sElement['start_date'].' 00:00:00') < ($recentMission['Mission']['start_time'])){
				$totalK2sDays = ceil((strtotime($k2sElement['end_date'].' 23:59:59') - strtotime($recentMission['Mission']['start_time']))/86400);
			}
			//echo $totalK2sDays; die;
			//pr($k2sElement); die;
			if($k2sElement['period'] == 0){
				//echo '<pre>'; print_r($k2sElement);die;
				//echo $k2sElement['start_date']; die;
				$numberOfWeeks = ($totalK2sDays/7);
				$totalK2sHours = (($k2sElement['expected_hrs'])*$numberOfWeeks);
				$daysTillNow = floor((strtotime($current_date) - strtotime($k2sElement['start_date']))/86400);
				$hoursDoneTillNow = ($k2sElement['expected_hrs']/7)*$daysTillNow;
				
				//get the events based on K2S keywords
				$allKeywords = explode(',',$k2sElement['ranking']);
				$hoursSpentOnEvent = NULL;
				//caecho $hoursDoneTillNow; exit;
				$eventsIdArr = array();
				foreach($allKeywords as $keyWordval){
					$keyWordToSearch = trim($keyWordval);
					
					$eventsBaseOnKeywords = $this->CalendarEvent->find('all', array('conditions'=>array(
														  //'Timeline.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],
														       'CalendarEvent.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'CalendarEvent.local_start BETWEEN ? and ?'=>array($k2sElement['start_date'].' 00:00:00',$current_date)
														       )));
					
					//echo '<pre>'; print_r($eventsBaseOnKeywords); //die;
					foreach($eventsBaseOnKeywords as $tl_key=>$_tlval){
						if(in_array($_tlval['CalendarEvent']['id'],$eventsIdArr)==false){
							//echo $current_date; die;
							if($_tlval['CalendarEvent']['local_end'] <= $current_date){
								$hoursSpentOnEvent += strtotime($_tlval['CalendarEvent']['local_end']) - strtotime($_tlval['CalendarEvent']['local_start']);
							} else{
								$hoursSpentOnEvent += strtotime($current_date) - strtotime($_tlval['CalendarEvent']['local_start']);
							}
							$eventsIdArr[]= $_tlval['CalendarEvent']['id'];
						}
					}
					
					$actBaseOnKeywords = $this->Activity->find('all', array('conditions'=>array(
														  //'Timeline.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],
														       'Activity.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'Activity.local_start BETWEEN ? and ?'=>array($k2sElement['start_date'].' 00:00:00',$current_date)
														       )));
					
					//echo '<pre>'; print_r($actBaseOnKeywords); die;
					foreach($actBaseOnKeywords as $acttl_key=>$_acttlval){
						if(in_array($_acttlval['Activity']['id'],$eventsIdArr)==false){
							//echo $current_date; die;
							if($_acttlval['Activity']['local_end'] <= $current_date){
								$hoursSpentOnEvent += strtotime($_acttlval['Activity']['local_end']) - strtotime($_acttlval['Activity']['local_start']);
							} else{
								$hoursSpentOnEvent += strtotime($current_date) - strtotime($_acttlval['Activity']['local_start']);
							}
							$eventsIdArr[]= $_acttlval['Activity']['id'];
						}
					}
					
				}
				
				$hoursSpentOnEvent = $hoursSpentOnEvent/3600;
				//echo $hoursSpentOnEvent; die;
				//new added by Vikas (if invested hrs>total then it should be 100%max)
				$hoursSpentOnEvent = ($hoursSpentOnEvent>$totalK2sHours)?$totalK2sHours:$hoursSpentOnEvent;
				$totalHoursDoneTillNow = $hoursDoneTillNow+$hoursSpentOnEvent;
				//$totalK2sHours; 
				
				//$k2sCalculated[$k2sElement['id']] = floor(($totalHoursDoneTillNow/$totalK2sHours)*100);
				$k2sCalculated[$k2sElement['id']] = floor(($hoursSpentOnEvent/$totalK2sHours)*100);
				$k2sSpentHrs[$k2sElement['id']] = ceil($hoursSpentOnEvent); //Absolute invested value
				
				//Save K2S Calculated Value ::Start
				$this->loadModel('KeyToSuccess');
				$hrsToSave = $k2sSpentHrs[$k2sElement['id']];
				$modifiedDate = date('Y-m-d H:i:s');
				$this->KeyToSuccess->UpdateAll(array('KeyToSuccess.calculated_hrs'=>"'$hrsToSave'",'KeyToSuccess.modified'=>"'$modifiedDate'"),array('KeyToSuccess.id'=>$k2sElement['id'])); 
				//Save K2S Calculated Value ::End
				
				//pr($k2sSpentHrs); die;
				//echo $k2sCalculated.'<br>';
			}elseif($k2sElement['period'] == 1){ 
				//echo $k2sElement['description']; exit;
				$numberOfMonths = ($totalK2sDays/30);
				$totalK2sHours = $totalK2sHours+(($k2sElement['expected_hrs'])*$numberOfMonths);
				$daysTillNow = floor((strtotime($current_date) - strtotime($k2sElement['start_date']))/86400);
				$hoursDoneTillNow = ($k2sElement['expected_hrs']/30)*$daysTillNow;
				//get the events based on K2S keywords
				$allKeywords = explode(',',$k2sElement['ranking']);
				$hoursSpentOnEvent = NULL;
				$eventsIdArr = array();
				
				foreach($allKeywords as $keyWordval){
					$keyWordToSearch = trim($keyWordval);
					
					$eventsBaseOnKeywords = $this->CalendarEvent->find('all', array('conditions'=>array(
														  //'Timeline.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],
														       'CalendarEvent.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'CalendarEvent.local_start BETWEEN ? and ?'=>array($k2sElement['start_date'].' 00:00:00',$current_date)
														       )));
					
					foreach($eventsBaseOnKeywords as $tl_key=>$_tlval){
						//echo $current_date; die;
						if(in_array($_tlval['CalendarEvent']['id'],$eventsIdArr)==false){
							if($_tlval['CalendarEvent']['local_end'] <= $current_date){
								$hoursSpentOnEvent += strtotime($_tlval['CalendarEvent']['local_end']) - strtotime($_tlval['CalendarEvent']['local_start']);
							} else{
								$hoursSpentOnEvent += strtotime($current_date) - strtotime($_tlval['CalendarEvent']['local_start']);
							}
							$eventsIdArr[]= $_tlval['CalendarEvent']['id'];
						}
					}
					
					$actBaseOnKeywords = $this->Activity->find('all', array('conditions'=>array(
														  //'Timeline.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],
														       'Activity.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'Activity.local_start BETWEEN ? and ?'=>array($k2sElement['start_date'].' 00:00:00',$current_date)
														       )));
					
					//echo '<pre>'; print_r($actBaseOnKeywords); die;
					foreach($actBaseOnKeywords as $acttl_key=>$_acttlval){
						//echo $current_date; die;
						if(in_array($_acttlval['Activity']['id'],$eventsIdArr)==false){
							if($_acttlval['Activity']['local_end'] <= $current_date){
								$hoursSpentOnEvent += strtotime($_acttlval['Activity']['local_end']) - strtotime($_acttlval['Activity']['local_start']);
							} else{
								$hoursSpentOnEvent += strtotime($current_date) - strtotime($_acttlval['Activity']['local_start']);
							}
						$eventsIdArr[]= $_acttlval['Activity']['id'];
						}
					}
					
				}
				$hoursSpentOnEvent = $hoursSpentOnEvent/3600;
				//echo 'Hrs Spent: '.$hoursSpentOnEvent; 
				//echo '<br>TotalK2Shrs: '.$totalK2sHours;
				//echo '<br>';
				//echo date('Y-m-d H:i:s'); exit;
				//new added by Vikas (if invested hrs>total then it should be 100%max)
				$hoursSpentOnEvent = ($hoursSpentOnEvent>$totalK2sHours)?$totalK2sHours:$hoursSpentOnEvent;
				 
				$totalHoursDoneTillNow = $hoursDoneTillNow+$hoursSpentOnEvent;
				$k2sCalculated[$k2sElement['id']] = floor(($hoursSpentOnEvent/$totalK2sHours)*100);
				$k2sSpentHrs[$k2sElement['id']] = round($hoursSpentOnEvent); //Absolute invested value
				//pr($k2sCalculated); die;
				
				//Save K2S Calculated Value ::Start
				$this->loadModel('KeyToSuccess');
				$hrsToSave = $k2sSpentHrs[$k2sElement['id']];
				$modifiedDate = date('Y-m-d H:i:s');
				$this->KeyToSuccess->UpdateAll(array('KeyToSuccess.calculated_hrs'=>"'$hrsToSave'",'KeyToSuccess.modified'=>"'$modifiedDate'"),array('KeyToSuccess.id'=>$k2sElement['id']));
				//Save K2S Calculated Value ::End
				
			}elseif($k2sElement['period'] == 2){
				//pr($k2sElement); die;
				//Vikas(For mission: total hrs will be expected hrs)
				$totalK2sHours = $totalK2sHours+$k2sElement['expected_hrs'];
				$daysTillNow = floor((strtotime($current_date) - strtotime($k2sElement['start_date']))/86400);
				$hoursDoneTillNow = ($k2sElement['expected_hrs']/$totalK2sDays)*$daysTillNow;
				//get the events based on K2S keywords
				$allKeywords = explode(',',$k2sElement['ranking']);
				$hoursSpentOnEvent = NULL;
				$eventsIdArr = array();
				
				foreach($allKeywords as $keyWordval){
					$keyWordToSearch = trim($keyWordval);
				
					$eventsBaseOnKeywords = $this->CalendarEvent->find('all', array('conditions'=>array(
														  //'Timeline.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],
														       'CalendarEvent.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'CalendarEvent.local_start BETWEEN ? and ?'=>array($k2sElement['start_date'].' 00:00:00',$current_date)
														       )));
					
					foreach($eventsBaseOnKeywords as $tl_key=>$_tlval){
						//echo $current_date; die;
						if(in_array($_tlval['CalendarEvent']['id'],$eventsIdArr)==false){
							if($_tlval['CalendarEvent']['local_end'] <= $current_date){
								$hoursSpentOnEvent += strtotime($_tlval['CalendarEvent']['local_end']) - strtotime($_tlval['CalendarEvent']['local_start']);
							} else{
								$hoursSpentOnEvent += strtotime($current_date) - strtotime($_tlval['CalendarEvent']['local_start']);
							}
							$eventsIdArr[]= $_tlval['CalendarEvent']['id'];
						}
					}
					
					$actBaseOnKeywords = $this->Activity->find('all', array('conditions'=>array(
														  //'Timeline.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],
														       'Activity.title LIKE'=>'%'.$keyWordToSearch.'%',
														       'Activity.local_start BETWEEN ? and ?'=>array($k2sElement['start_date'].' 00:00:00',$current_date)
														       )));
					
					//echo '<pre>'; print_r($actBaseOnKeywords); die;
					foreach($actBaseOnKeywords as $acttl_key=>$_acttlval){
						//echo $current_date; die;
						if(in_array($_acttlval['Activity']['id'],$eventsIdArr)==false){
							if($_acttlval['Activity']['local_end'] <= $current_date){
								$hoursSpentOnEvent += strtotime($_acttlval['Activity']['local_end']) - strtotime($_acttlval['Activity']['local_start']);
							} else{
								$hoursSpentOnEvent += strtotime($current_date) - strtotime($_acttlval['Activity']['local_start']);
							}
						$eventsIdArr[]= $_acttlval['Activity']['id'];
						}
					}
				}
				$hoursSpentOnEvent = $hoursSpentOnEvent/3600;
				//new added by Vikas (if invested hrs>total then it should be 100%max)
				//$hoursSpentOnEvent = ($hoursSpentOnEvent>$totalK2sHours)?$totalK2sHours:$hoursSpentOnEvent;
				$totalHoursDoneTillNow = $hoursDoneTillNow+$hoursSpentOnEvent;
				//$k2sCalculated[$k2sElement['id']] = floor(($totalHoursDoneTillNow/$totalK2sHours)*100);
				$hoursSpentOnEvent = ($hoursSpentOnEvent>$totalK2sHours)?$totalK2sHours:$hoursSpentOnEvent;
				$k2sCalculated[$k2sElement['id']] = floor(($hoursSpentOnEvent/$totalK2sHours)*100);
				$k2sSpentHrs[$k2sElement['id']] = round($hoursSpentOnEvent); //Absolute invested value
				
				//Save K2S Calculated Value ::Start
				$this->loadModel('KeyToSuccess');
				$hrsToSave = $k2sSpentHrs[$k2sElement['id']];
				$modifiedDate = date('Y-m-d H:i:s');
				$this->KeyToSuccess->UpdateAll(array('KeyToSuccess.calculated_hrs'=>"'$hrsToSave'",'KeyToSuccess.modified'=>"'$modifiedDate'"),array('KeyToSuccess.id'=>$k2sElement['id']));
				//Save K2S Calculated Value ::End
				
			}
			//echo $totalK2sHours; die;
			//echo "Total Spend Hrs: <br>"; pr($k2sSpentHrs);die;
			//echo '<pre>'; print_r($k2sCalculated); die;
			//$k2s_calc[$k2s['id']] = $k2s['id'];
			
		}
		//echo "Total Spend Hrs: <br>"; pr($k2sSpentHrs);die;
		$this->set(compact('k2sCalculated'));
		$this->set(compact('k2sSpentHrs'));
		$this->set(compact('totalK2sHours'));
		
		$recentReflections = $this->UserReflection->find('all',array('conditions'=>array('UserReflection.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'UserReflection.reflection_date DESC','limit'=>5));
		$this->set(compact('recentReflections'));
		//pr($recentReflections);	die;
		
		//Shared mission count
		$sharedMissionCount = $this->MissionUser->find('count',array('conditions'=>array('MissionUser.shared_with_id'=>$_SESSION['Auth']['User']['id'])));
		$this->set(compact('sharedMissionCount'));
		
		
		/***** Calculation for Schedule :: Start ******/
		$this->calc_schedule();
		/***** Calculation for Schedule :: End ******/
		
		/***** Calculation for My-Rating :: Start ******/
		$this->calc_myRating();
		/***** Calculation for My-Rating :: End ******/
		
	}
	
	/** 
	@function : calc_schedule 
	@description : Calculation for scheduling
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Jun. 18, 2013
	*/
	function calc_schedule(){
		//$start_date = '2013-06-18 00:00:00';
		//$end_date = '2013-06-18 23:59:59';
		
		$userData = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id'])));
		//$userData['User']['exclude_keywords'] = 'Run';
		if($userData['User']['exclude_keywords'] != ""){ //if exclding word is set by user
			$expKeywords = explode(',', $userData['User']['exclude_keywords']);
			$excludeKeywordsArr = array_map('trim',$expKeywords); 
			//pr($excludeKeywordsArr); //die;
			foreach($excludeKeywordsArr as $word){
			    $wordsCondArr[]='CalendarEvent.title NOT LIKE "%'.$word.'%"';
			}
		} else{ //Dummy condition if no exclding word is set by user
			$wordsCondArr[]= 'CalendarEvent.title  != ""';
		}
		//pr($wordsCondArr); die;
		$sheduledDayAvgNxtWeekArr = array();
		$totalHrsNextWeek = 0;
		//For Next week 
		for($dayCnt = 0; $dayCnt <=6; $dayCnt++){ //Run for week
			$sheduledDayHrs = 0; $schedule_time_cal = 0;
			$scheduledDays = array();
			
			$this->loadModel('ScheduleBalance');
			$allScheduledDay = $this->ScheduleBalance->find('all',array('conditions'=>array('ScheduleBalance.user_id'=>$_SESSION['Auth']['User']['id'])));
			foreach($allScheduledDay as $scheduling){
				$scheduledDays[] = substr($scheduling['ScheduleBalance']['day'],0,3);
			}
			$this->set(compact('scheduledDays'));
			
			$userDate = date('Y-m-d',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
			$userDateTime = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
			
			
			if(isset($_SESSION["Schedule"]["day_hrs"]) AND $_SESSION["Schedule"]["day_hrs"] == "work"){ // Set to work-hours
				$dayName = date('l',strtotime("+".$dayCnt." Days",strtotime($userDate)));
				
				$workHrsInfo = $this->ScheduleBalance->find('first',array('conditions'=>array('ScheduleBalance.user_id'=>$_SESSION['Auth']['User']['id'],'ScheduleBalance.day'=>$dayName)));
				
				$workHrsInfo['ScheduleBalance']['start'] = ($workHrsInfo['ScheduleBalance']['start'] != "")?$workHrsInfo['ScheduleBalance']['start']:'00:00:00';
				$workHrsInfo['ScheduleBalance']['end'] = ($workHrsInfo['ScheduleBalance']['end'] != "")?$workHrsInfo['ScheduleBalance']['end']:'23:59:59';
				
				$start_date = date('Y-m-d H:i:s',strtotime("+".$dayCnt." Days",strtotime($userDate.' '.$workHrsInfo['ScheduleBalance']['start'])));
				$end_date = date('Y-m-d H:i:s',strtotime("+".$dayCnt." Days",strtotime($userDate.' '.$workHrsInfo['ScheduleBalance']['end'])));
				
				$daySelected = 0; 
				if($workHrsInfo['ScheduleBalance']['id'] != ""){
					$workHrsDiff = round((strtotime($end_date)-strtotime($start_date))/3600);
					$daySelected = 1;
				}
				
			} else{ 
				$start_date = date('Y-m-d H:i:s',strtotime("+".$dayCnt." Days",strtotime($userDate.' 00:00:00')));
				$end_date = date('Y-m-d H:i:s',strtotime("+".$dayCnt." Days",strtotime($userDate.' 23:59:59')));
			}
			
			//Event that run entire day
			$this->CalendarEvent->unbindModel(array('hasMany'=>array('EventAttendy')));
			$eventsFromCal = $this->CalendarEvent->find('count',array('conditions'=>array(
												'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],
												'CalendarEvent.local_start <='=>$start_date,
												'CalendarEvent.local_end >='=>$end_date
												)
											)
										  );
			//All other events which starts or end in the day
			
			//$start_date = '2013-10-10 00:00:00';
			//$end_date = '2013-10-10 23:59:59';
			
			//Conditions with keywords
			$cond = array();
			$sql1 = $wordsCondArr;
			array_push($sql1,'CalendarEvent.local_start >="'.$start_date.'"');
			array_push($sql1,'CalendarEvent.local_start <="'.$end_date.'"');
			array_push($sql1,'CalendarEvent.user_id ='.$_SESSION["Auth"]["User"]["id"]);
			
			$sql2 = $wordsCondArr;
			array_push($sql2,'CalendarEvent.local_end >="'.$start_date.'"');
			array_push($sql2,'CalendarEvent.local_end <="'.$end_date.'"');
			array_push($sql2,'CalendarEvent.user_id ='.$_SESSION["Auth"]["User"]["id"]);
			
			$cond['OR'][] = $sql1;
			$cond['OR'][] = $sql2;
			
			//pr($cond); //die;
			
			$this->CalendarEvent->unbindModel(array('hasMany'=>array('EventAttendy')));
			$allEventsFromCal = $this->CalendarEvent->find('all',array('conditions'=>$cond,'order'=>array('CalendarEvent.local_start ASC')
											)
										  );
			//pr($allEventsFromCal);  die;
			
			foreach($allEventsFromCal as $calEve){
				if($calEve['CalendarEvent']['local_start'] < $calEve['CalendarEvent']['local_end']){ //End date should be greater then start
					$overLappedMinute = 0;
					//If event starts in past
					if($calEve['CalendarEvent']['local_start'] <=$start_date){
						$schedule_time_cal = $schedule_time_cal+round((strtotime($calEve['CalendarEvent']['local_end']) - strtotime($start_date))/60);
					}
					//If event end in future
					else if($calEve['CalendarEvent']['local_end'] >=$end_date){
						$schedule_time_cal = $schedule_time_cal+round((strtotime($end_date) - strtotime($calEve['CalendarEvent']['local_start']))/60);
					}
					//If starts today and ends today
					else if($calEve['CalendarEvent']['local_start'] >=$start_date AND $calEve['CalendarEvent']['local_end'] <=$end_date){
						if(($calEve['CalendarEvent']['local_start'] < $prevEveEndTime) AND ($calEve['CalendarEvent']['local_end'] > $prevEveEndTime)){ //if event overlap
							//echo $prevEveEndTime;
							$overLappedMinute = round((strtotime($prevEveEndTime) - strtotime($calEve['CalendarEvent']['local_start']))/60);
							//Add this time to the startdata of event
							$calEve['CalendarEvent']['local_start'] = date('Y-m-d H:i:s',strtotime('+'.$overLappedMinute.' minutes', strtotime($calEve['CalendarEvent']['local_start'])));
							//Now find the actual elapsed time
							$schedule_time_cal = $schedule_time_cal+round((strtotime($calEve['CalendarEvent']['local_end']) - strtotime($calEve['CalendarEvent']['local_start']))/60);
						} else{ //If not overlapping
							//echo $calEve['CalendarEvent']['title'];
							if($calEve['CalendarEvent']['local_end'] > $prevEveEndTime){
								$schedule_time_cal = $schedule_time_cal+round((strtotime($calEve['CalendarEvent']['local_end']) - strtotime($calEve['CalendarEvent']['local_start']))/60);
							}
						}
						
					}
					$prevEveEndTime = $calEve['CalendarEvent']['local_end'];
				}
			}
			$sheduledDayHrs = ($schedule_time_cal)/60;
			
			$workHrsDiff = ($workHrsDiff != "")?$workHrsDiff:24;
			//pr($sheduledDayAvgNxtWeekArr); die;
			if(($eventsFromCal != 0) || ($sheduledDayHrs >= $workHrsDiff)){//if any full day event
				$sheduledDayAvgNxtWeekArr[date('D',strtotime($start_date))] = 100;
			} elseif($_SESSION["Schedule"]["day_hrs"] == 'work' AND $daySelected == 0){
				$sheduledDayAvgNxtWeekArr[date('D',strtotime($start_date))] = 0;
			}else{
				$sheduledDayAvgNxtWeekArr[date('D',strtotime($start_date))] = round(($sheduledDayHrs*100)/$workHrsDiff);
			}
			$totalHrsNextWeek = $totalHrsNextWeek+$sheduledDayHrs;
		}
		
		//echo $totalHrsNextWeek;
		$this->set(compact('totalHrsNextWeek'));
		$this->set(compact('sheduledDayAvgNxtWeekArr'));
		//pr($_SESSION['Schedule']); 
		//pr($sheduledDayAvgNxtWeekArr); die;
		
		//For Last week
		$sheduledDayLastWeekArr = array();
		$totalHrsLastWeek = 0; $i=1;
		for($dayCnt_lastweek = 6; $dayCnt_lastweek >=0; $dayCnt_lastweek--){ //Run for week
			$sheduledDayHrs_lastweek = 0; $schedule_time_cal_lastweek = 0;
			
			$userDate_lastweek = date('Y-m-d',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
			$userDateTime_lastweek = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
			
			if(isset($_SESSION["Schedule"]["day_hrs"]) AND $_SESSION["Schedule"]["day_hrs"] == "work"){ // Set to work-hours
				$dayName_lastweek = date('l',strtotime("-".$dayCnt_lastweek." Days",strtotime($userDate_lastweek)));
				$workHrsInfo_lastweek = $this->ScheduleBalance->find('first',array('conditions'=>array('ScheduleBalance.user_id'=>$_SESSION['Auth']['User']['id'],'ScheduleBalance.day'=>$dayName_lastweek)));
				//pr($workHrsInfo_lastweek);
				//echo '*************';
				$workHrsInfo_lastweek['ScheduleBalance']['start'] = ($workHrsInfo_lastweek['ScheduleBalance']['start'] != "")?$workHrsInfo_lastweek['ScheduleBalance']['start']:'00:00:00';
				$workHrsInfo_lastweek['ScheduleBalance']['end'] = ($workHrsInfo_lastweek['ScheduleBalance']['end'] != "")?$workHrsInfo_lastweek['ScheduleBalance']['end']:'23:59:59';
				
				$start_date_lastweek = date('Y-m-d H:i:s',strtotime("-".$dayCnt_lastweek." Days",strtotime($userDate_lastweek.' '.$workHrsInfo_lastweek['ScheduleBalance']['start'])));
				$end_date_lastweek = date('Y-m-d H:i:s',strtotime("-".$dayCnt_lastweek." Days",strtotime($userDate_lastweek.' '.$workHrsInfo_lastweek['ScheduleBalance']['end'])));
				
				$daySelected_lastweek = 0; 
				if($workHrsInfo_lastweek['ScheduleBalance']['id'] != ""){
					$workHrsDiff_lastweek = round((strtotime($end_date_lastweek)-strtotime($start_date_lastweek))/3600);
					$daySelected_lastweek = 1;
				} 
				
			} else{ 
				$start_date_lastweek = date('Y-m-d H:i:s',strtotime("-".$dayCnt_lastweek." Days",strtotime($userDate_lastweek.' 00:00:00')));
				$end_date_lastweek = date('Y-m-d H:i:s',strtotime("-".$dayCnt_lastweek." Days",strtotime($userDate_lastweek.' 23:59:59')));
			}
			//echo '<br>'.$daySelected_lastweek; 
			//Event that run entire day
			$this->CalendarEvent->unbindModel(array('hasMany'=>array('EventAttendy')));
			$eventsFromCal_lastweek = $this->CalendarEvent->find('count',array('conditions'=>array(
												'CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],
												'CalendarEvent.local_start <='=>$start_date_lastweek,
												'CalendarEvent.local_end >='=>$end_date_lastweek
												)
											)
										  );
			
			//pr($eventsFromCal_lastweek);
			//All other events which starts or end in the day
			
			//Conditions array
			$cond_lastweek = array();
			$sql1_lastweek = $wordsCondArr;
			array_push($sql1_lastweek,'CalendarEvent.local_start >="'.$start_date_lastweek.'"');
			array_push($sql1_lastweek,'CalendarEvent.local_start <="'.$end_date_lastweek.'"');
			array_push($sql1_lastweek,'CalendarEvent.user_id ='.$_SESSION["Auth"]["User"]["id"]);
			
			$sql2_lastweek = $wordsCondArr;
			array_push($sql2_lastweek,'CalendarEvent.local_end >="'.$start_date_lastweek.'"');
			array_push($sql2_lastweek,'CalendarEvent.local_end <="'.$end_date_lastweek.'"');
			array_push($sql2_lastweek,'CalendarEvent.user_id ='.$_SESSION["Auth"]["User"]["id"]);
			
			$cond_lastweek['OR'][] = $sql1_lastweek;
			$cond_lastweek['OR'][] = $sql2_lastweek;
			
			$this->CalendarEvent->unbindModel(array('hasMany'=>array('EventAttendy')));
			$allEventsFromCal_lastweek = $this->CalendarEvent->find('all',array('conditions'=>$cond_lastweek,'order'=>array('CalendarEvent.local_start ASC')
											)
										  );
			//pr($allEventsFromCal_lastweek); 
			foreach($allEventsFromCal_lastweek as $calEve_lastweek){
				if($calEve_lastweek['CalendarEvent']['local_start'] < $calEve_lastweek['CalendarEvent']['local_end']){ //End date should be greater then start
					$overLappedMinute_lastweek = 0;
					//If event starts in past
					if($calEve_lastweek['CalendarEvent']['local_start'] <=$start_date_lastweek){
						$schedule_time_cal_lastweek = $schedule_time_cal_lastweek+round((strtotime($calEve_lastweek['CalendarEvent']['local_end']) - strtotime($start_date_lastweek))/60);
					}
					//If event end in future
					else if($calEve_lastweek['CalendarEvent']['local_end'] >=$end_date_lastweek){
						$schedule_time_cal_lastweek = $schedule_time_cal_lastweek+round((strtotime($end_date_lastweek) - strtotime($calEve_lastweek['CalendarEvent']['local_start']))/60);
					}
					//If starts today and ends today
					else if($calEve_lastweek['CalendarEvent']['local_start'] >=$start_date_lastweek AND $calEve_lastweek['CalendarEvent']['local_end'] <=$end_date_lastweek){
						if(($calEve_lastweek['CalendarEvent']['start_time'] < $prevEveEndTime_lastweek) AND ($calEve_lastweek['CalendarEvent']['local_end'] > $prevEveEndTime_lastweek)){ //if event overlap
							$overLappedMinute_lastweek = round((strtotime($prevEveEndTime_lastweek) - strtotime($calEve_lastweek['CalendarEvent']['local_start']))/60);
							//Add this time to the startdata of event
							$calEve_lastweek['CalendarEvent']['local_start'] = date('Y-m-d H:i:s',strtotime('+'.$overLappedMinute_lastweek.' minutes', strtotime($calEve_lastweek['CalendarEvent']['local_start'])));
							//Now find the actual elapsed time
							$schedule_time_cal_lastweek = $schedule_time_cal_lastweek+round((strtotime($calEve_lastweek['CalendarEvent']['local_end']) - strtotime($calEve_lastweek['CalendarEvent']['local_start']))/60);
						} else{ //If not overlapping
							if($calEve_lastweek['CalendarEvent']['local_end'] > $prevEveEndTime_lastweek){	
								$schedule_time_cal_lastweek = $schedule_time_cal_lastweek+round((strtotime($calEve_lastweek['CalendarEvent']['local_end']) - strtotime($calEve_lastweek['CalendarEvent']['local_start']))/60);
							}
						}
						
					}
					$prevEveEndTime_lastweek = $calEve_lastweek['CalendarEvent']['local_end'];
				}
			} 
			$sheduledDayHrs_lastweek = ($schedule_time_cal_lastweek)/60;
			//pr($sheduledDayAvgNxtWeekArr_lastweek); die;
			
			$workHrsDiff_lastweek = ($workHrsDiff_lastweek != "")?$workHrsDiff_lastweek:24;
			if(($eventsFromCal_lastweek != 0) || ($sheduledDayHrs_lastweek >= $workHrsDiff_lastweek)){//if any full day event
				$sheduledDayLastWeekArr[date('D',strtotime($start_date_lastweek))] = 100; //echo 'asdf'; die;
			} elseif($_SESSION["Schedule"]["day_hrs"] == 'work' AND $daySelected_lastweek == 0){
				$sheduledDayLastWeekArr[date('D',strtotime($start_date_lastweek))] = 0;
			}else{
				$sheduledDayLastWeekArr[date('D',strtotime($start_date_lastweek))] = round(($sheduledDayHrs_lastweek*100)/$workHrsDiff_lastweek);
			}
			$totalHrsLastWeek = $totalHrsLastWeek+$sheduledDayHrs_lastweek;
		} //die; //echo $totalHrsLastWeek; die;
		$this->set(compact('totalHrsLastWeek'));
		$this->set(compact('sheduledDayLastWeekArr'));
		
		//pr($_SESSION['Schedule']);
		//pr($sheduledDayLastWeekArr); die;
		
		$cntScheduledDaysInVimbli = $this->ScheduleBalance->find('all',array('conditions'=>array('ScheduleBalance.user_id'=>$_SESSION['Auth']['User']['id'])));
		$this->set('totalDayForAvg',count($cntScheduledDaysInVimbli));
		$allSchDaysArr = array();
		foreach($cntScheduledDaysInVimbli as $day){
			$allSchDaysArr[] = substr($day['ScheduleBalance']['day'],0,3);
		}
		$this->set(compact('allSchDaysArr'));
		
	}
	
	/** 
	@function : calc_myRating 
	@description : Calculation for ratings for dashboard "My Rating"
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Oct. 14, 2013
	*/
	function calc_myRating(){
		
		$userDateTime = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
		//End date should be of yesterday date
		//$end_date = date('Y-m-d',strtotime('-1 Day', strtotime($userDateTime))).' 23:59:59';
		$end_date = $userDateTime;
		
		//Variable initialization :: Start
		$total_rated_days = 0; $act_dates_arr = array();
		$start_date = NULL; $rated_ref_count = 0; $total_ref_rate = 0; $final_rating = 0;
		$all_act_rate = 0; $rated_act_count = 0; $total_act_rate = 0; 
		$user_ref_weight = 60; $user_all_weight = 40; // default weightage
		$time_frame = (isset($_SESSION['Rating']['time_frame']))?$_SESSION['Rating']['time_frame']:'Week'; //Get time-frame from session
		$activity_type = (isset($_SESSION['Rating']['activity_type']))?$_SESSION['Rating']['activity_type']:'Reflection'; //Get activity-type from session
		//Variable initialization :: End
		
		SWITCH(trim($time_frame)){
			CASE 'Day':
				$start_date = date('Y-m-d H:i:s',strtotime('-1 Day', strtotime($userDateTime)));
			break;
			CASE 'Week':
				$start_date = date('Y-m-d H:i:s',strtotime('-7 Day', strtotime($userDateTime)));
			break;
			CASE 'Month':
				$start_date = date('Y-m-d H:i:s',strtotime('-30 Day', strtotime($userDateTime)));
			break;
			CASE 'Year':
				$start_date = date('Y-m-d H:i:s',strtotime('-365 Day', strtotime($userDateTime)));
			break;
			CASE 'Mission':
				$this->Mission->unbindModel(array('hasMany'=>array('Milestone','KeyToSuccess','MissionConnection','MissionUser')));
				$recentMission = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_by_gm'=>0), 'fields'=>array('Mission.id','Mission.start_time','Mission.end_time'), 'order'=>'Mission.id DESC'));
				$start_date = $recentMission['Mission']['start_time'];
				$end_date = date('Y-m-d',strtotime('-1 Day', strtotime($end_date))).' 23:59:59'; // Count till yesterday
			break;
		}
		
		//For mission: if mission is passed then end date = mission end date
		if(!empty($recentMission) AND ($recentMission['Mission']['end_time'] < $userDateTime)){
			$end_date = $recentMission['Mission']['end_time'];
		}
		//echo $start_date; echo '<br>'.$end_date;
		//Write session for date, it will be used in timeline
		$this->Session->write('Rating.start_date',$start_date);
		$this->Session->write('Rating.end_date',$end_date);
		
		//Total days
		$total_days = round(abs(strtotime($end_date)-strtotime($start_date))/86400);
		$this->set(compact('total_days'));
		
		//** Fetch reflection data :: Start **//
		$this->UserReflection->unbindModel(array('hasMany'=>array('ShareReflection','ReflectionAttendy')));
		$ref_fields = array('UserReflection.id','UserReflection.user_id','UserReflection.local_reflection_date','UserReflection.rating_today');
		$allReflection = $this->UserReflection->find('all',array('conditions'=>array('UserReflection.user_id'=>$_SESSION['Auth']['User']['id'],'UserReflection.rating_today <>'=>0,'UserReflection.local_reflection_date BETWEEN ? AND ?'=>array($start_date,$end_date)), 'fields'=>$ref_fields));
		//pr($allReflection);
		//Events with rated+non-rated
		
		$rated_ref_count = count($allReflection);
		//Count rating
		foreach($allReflection as $ref){
			$total_ref_rate = $total_ref_rate+$ref['UserReflection']['rating_today'];
			
			//Count for rated_days (Unique dates)
			if(in_array(date('Y-m-d',strtotime($ref['UserReflection']['local_reflection_date'])),$act_dates_arr) == false){
				$total_rated_days = $total_rated_days+1;
				$act_dates_arr[] = date('Y-m-d',strtotime($ref['UserReflection']['local_reflection_date']));
			}
		}
		//** Fetch reflection data :: End**//
		if(trim($activity_type) == "Reflection"){
			if(!empty($allReflection)){
				$ref_avg_rate = $total_ref_rate/$rated_ref_count;
				$final_rating = $ref_avg_rate;
			}
			
		}elseif(trim($activity_type) == "All"){
			//** Activity data :: Start**//
			$this->Activity->unbindModel(array('hasMany'=>array('ActivityAttendy')));
			$added_act_fields = array('Activity.id','Activity.activity_owner','Activity.local_start','Activity.rating');
			$all_added_act = $this->Activity->find('all',array('conditions'=>array('Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],'Activity.rating <>'=>0,'Activity.local_start BETWEEN ? AND ?'=>array($start_date,$end_date)), 'fields'=>$added_act_fields));
			//pr($all_added_act);
			//Events with rated+non-rated
			
			$rated_act_count = $rated_act_count+count($all_added_act);
			foreach($all_added_act as $act){
				$all_act_rate= $all_act_rate+$act['Activity']['rating'];
				
				//Count for rated_days (Unique dates)
				if(in_array(date('Y-m-d',strtotime($act['Activity']['local_start'])),$act_dates_arr) == false){
					$total_rated_days = $total_rated_days+1;
					$act_dates_arr[] = date('Y-m-d',strtotime($act['Activity']['local_start']));
				}
			}
			
			//** Email data :: Start**//
			$email_fields = array('ImportEmail.id','ImportEmail.user_id','ImportEmail.local_email_date','ImportEmail.rating');
			$all_email = $this->ImportEmail->find('all',array('conditions'=>array('ImportEmail.user_id'=>$_SESSION['Auth']['User']['id'],'ImportEmail.rating <>'=>0,'ImportEmail.local_email_date BETWEEN ? AND ?'=>array($start_date,$end_date)), 'fields'=>$email_fields));	
			//pr($all_email);
			//Events with rated+non-rated
			
			$rated_act_count = $rated_act_count+count($all_email);
			foreach($all_email as $email){
				$all_act_rate= $all_act_rate+$email['ImportEmail']['rating'];
				
				//Count for rated_days (Unique dates)
				if(in_array(date('Y-m-d',strtotime($email['ImportEmail']['local_email_date'])),$act_dates_arr) == false){
					$total_rated_days = $total_rated_days+1;
					$act_dates_arr[] = date('Y-m-d',strtotime($email['ImportEmail']['local_email_date']));
				}
			}
			
			//** Calendar data :: Start**//
			$this->CalendarEvent->unbindModel(array('hasMany'=>array('EventAttendy')));
			$event_fields = array('CalendarEvent.id','CalendarEvent.user_id','CalendarEvent.local_start','CalendarEvent.rating');
			$all_event = $this->CalendarEvent->find('all',array('conditions'=>array('CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],'CalendarEvent.rating <>'=>0,'CalendarEvent.local_start BETWEEN ? AND ?'=>array($start_date,$end_date)), 'fields'=>$event_fields));
			//pr($all_event);
			//Events with rated+non-rated
			
			$rated_act_count = $rated_act_count+count($all_event);
			foreach($all_event as $event){
				$all_act_rate= $all_act_rate+$event['CalendarEvent']['rating'];
				
				//Count for rated_days (Unique dates)
				if(in_array(date('Y-m-d',strtotime($event['CalendarEvent']['local_start'])),$act_dates_arr) == false){
					$total_rated_days = $total_rated_days+1;
					$act_dates_arr[] = date('Y-m-d',strtotime($event['CalendarEvent']['local_start']));
				}
			}
			
			//** Mission data :: Start**//
			$this->Mission->unbindModel(array('hasMany'=>array('Milestone','KeyToSuccess','MissionConnection','MissionUser')));
			$mission_fields = array('Mission.id','Mission.owner','Mission.start_time','Mission.end_time','Mission.rating');
			$all_mission = $this->Mission->find('all',array('conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_by_gm'=>0,'Mission.rating <>'=>0,'Mission.start_time BETWEEN ? AND ?'=>array($start_date,$end_date)), 'fields'=>$mission_fields));
			//pr($all_mission);
			//Events with rated+non-rated
			
			$rated_act_count = $rated_act_count+count($all_mission);
			foreach($all_mission as $mission){
				$all_act_rate= $all_act_rate+$mission['Mission']['rating'];
				//Count for rated_days (Unique dates)
				if(in_array(date('Y-m-d',strtotime($mission['Mission']['start_time'])),$act_dates_arr) == false){
					$total_rated_days = $total_rated_days+1;
					$act_dates_arr[] = date('Y-m-d',strtotime($mission['Mission']['start_time']));
				}
			}
			
			//Find user adjusted weight if set by user
			$this->loadModel('RatingWeightage');
			$rating_weight = $this->RatingWeightage->find('first',array('conditions'=>array('RatingWeightage.user_id'=>$_SESSION['Auth']['User']['id'])));
			if(!empty($rating_weight)){
				$user_ref_weight = ($rating_weight['RatingWeightage']['reflection_weightage'] != "")?$rating_weight['RatingWeightage']['reflection_weightage']:60;
				$user_all_weight = ($rating_weight['RatingWeightage']['allActivity_weightage'] != "")?$rating_weight['RatingWeightage']['allActivity_weightage']:40;
			}
			
			//Calculation as per set weight
			$final_ref_rate = ($rated_ref_count != 0)?(($total_ref_rate*$user_ref_weight)/($rated_ref_count*100)):0;
			$final_other_rate = ($rated_act_count != 0)?(($all_act_rate*$user_all_weight)/($rated_act_count*100)):0;
			$final_rating = $final_ref_rate+$final_other_rate;
			
		}
		
		//Calculate all events (Ref+other) :: start
		$total_events = $this->UserReflection->find('count',array('conditions'=>array('UserReflection.user_id'=>$_SESSION['Auth']['User']['id'],'UserReflection.local_reflection_date BETWEEN ? AND ?'=>array($start_date,$end_date))));
		$total_events = $total_events+$this->Activity->find('count',array('conditions'=>array('Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],'Activity.local_start BETWEEN ? AND ?'=>array($start_date,$end_date))));
		$total_events = $total_events+$this->ImportEmail->find('count',array('conditions'=>array('ImportEmail.user_id'=>$_SESSION['Auth']['User']['id'],'ImportEmail.local_email_date BETWEEN ? AND ?'=>array($start_date,$end_date))));	
		$total_events = $total_events+$this->CalendarEvent->find('count',array('conditions'=>array('CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],'CalendarEvent.local_start BETWEEN ? AND ?'=>array($start_date,$end_date))));
		$total_events = $total_events+$this->Mission->find('count',array('conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_by_gm'=>0,'Mission.start_time BETWEEN ? AND ?'=>array($start_date,$end_date))));
		//Calculate all events (Ref+other) :: end
		
		$total_rated_events = $rated_ref_count+$rated_act_count;
		$this->set(compact('total_rated_events'));
		
		$this->set(compact('total_rated_days'));
		
		$this->set(compact('total_events'));
		
		//Round the final rating
		$final_rating = ($final_rating < 0)?0:$final_rating;
		$final_rating = round($final_rating,1);
		$this->set(compact('final_rating'));
		
		//Find rating text
		if($final_rating < 1){
			$this->loadModel('Rating');
			$ratingVal = $this->Rating->find('first',array('conditions'=>array('Rating.rating'=>0.0)));
		}else{
			$this->loadModel('Rating');
			$ratingVal = $this->Rating->find('first',array('conditions'=>array('Rating.rating'=>$final_rating)));
		}
		$this->set('ratingVal',$ratingVal['Rating']['rating_quote']);
	}
	
	
	/** 
	@function : forgot_password 
	@description : forgot password
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 04, 2012
	*/ 
	function forgot_password(){
		$this->set('pagetitle','Forgot Password');
		$this->layout = "inner_pages";
		
		if(!empty($this->data))
		{
			$this->User->set($this->data);
			$exist = $this->User->find('count',array('conditions'=>array('User.email'=>$this->data["User"]["email"])));
			
			if($exist > 0){
				$newPassword = $this->random_gen(2);
				$randomPassword = Security::hash (Configure::read ('Security.salt') . $newPassword);
				
		$this->User->updateAll(array('User.password'=>"'$randomPassword'"),array('User.email'=>$this->data["User"]["email"]));
		
		/***** Send Email to User :: Start *****/
		//fetch out the user info
			$userInfo = $this->User->find('first',array('conditions'=>array('User.email'=>$this->data["User"]["email"])));
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
			$template = $this->Common->getEmailTemplate(1);
			
			$this->Email->from = INFO_EMAIL;
			$this->Email->subject = $template['EmailTemplate']['subject'];
			$data=$template['EmailTemplate']['description'];
			$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
			$data=str_replace('{EMAIL}',$userInfo['User']['email'],$data);
			$data=str_replace('{PASSWORD}',$newPassword,$data);
			$login_link = '<a href='.SITE_URL.'users/login/'.base64_encode($userInfo["User"]["email"]).'>'.SITE_URL.'users/login</a>';
			$data=str_replace('{LOGIN_LINK}',$login_link,$data);
			
			$this->set('data',$data);
			$this->Email->to = $userInfo['User']['email'];
			$this->Email->template='commanEmailTemplate';
			$this->Email->send();
			/***** Send Email to User :: End *****/
		
				$this->redirect(array('controller'=>'users','action'=>'password_changed'));
			}else{
				$this->Session->setFlash('No such email found in vimbli', 'default', array('class' => 'flash_error'));
			}
			
		}
	}
	
	
	/** 
	@function : password_changed 
	@description : Password changed successfully page
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 04, 2012
	*/
	function password_changed(){
		$this->set('pagetitle','Password Changed');
		$this->layout = "inner_pages";
	}
	
	/** 
	@function : diplay_ideas 
	@description : Display 
	@params : NULL
	@Created by :Sandeep verma
	@Modify : NULL
	@Created Date : Dec. 04, 2012
	*/
	function display_ideas(){
		$id = $_GET['id'];
		 // Configure::write('debug', 0);
		//$id=$this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$id),'fields'=>array('Mission.id')));
		// pr($id); die;
		$this->layout = false;
		//$activityList = $this->Activity->find('all',array('conditions'=>array('Activity.activity_owner'=>$_SESSION['Auth']['User']['id']),'order'=>'Activity.created DESC','limit'=>10));
		//$this->set(compact('activityList'));
		$path=$this->User->find('all',array('conditions'=>array('User.calendar_path')));
		//pr($path); die;
		$this->set('path',$path);
		$this->loadModel('CalendarEvent');
		$this->loadModel('Activity');
		$this->loadModel('KeyToSuccess');
		//$this->autoRender = false;
		$k2sdetails=$this->KeyToSuccess->find('first',array('conditions'=>array('KeyToSuccess.id'=>$id),'fields'=>array('KeyToSuccess.ranking')));
		
		//pr($k2sdetails); die;
		$k2sdetails=explode(',',$k2sdetails['KeyToSuccess']['ranking']);
		
		$ccdate=date('Y-m-d');
		$cdate=strtotime($ccdate);
		$fdate=strtotime("+7 days",$cdate);
		$fdate= date('Y-m-d',$fdate);
		//pr($ccdate);
		//pr($fdate);
		$totalcalc=array();
		$totalacts=array();
		$calVisitedArr = array();
		$actVisitedArr = array();
		
		foreach($k2sdetails as $keyWordToSearch) { 
			$eventsBaseOnKeywords = $this->CalendarEvent->find('all', array('conditions'=>array('CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],'CalendarEvent.title LIKE'=>'%'.trim($keyWordToSearch).'%','CalendarEvent.start_time BETWEEN ? and ?'=>array($ccdate,$fdate))));
			//pr($eventsBaseOnKeywords);
			
			foreach($eventsBaseOnKeywords as $cals) {
				if(in_array($cals['CalendarEvent']['id'],$calVisitedArr)==false){
					//$event_arr[$event_cnt]['model_name']='CalendarEvent';
					$title=$cals['CalendarEvent']['title'];
					$date=$cals['CalendarEvent']['start_time'];
					$date=date("F. d, Y", strtotime($date));
					$rating=$cals['CalendarEvent']['rating'];
					$details=$cals['CalendarEvent']['details'];
					//$title=$cals['CalendarEvent']['title'];
					$arr1 =array('model_name'=>'CalendarEvent','title'=>$title,'start_time'=>$date,'rating'=>$rating,'details'=>$details);
					//pr($arr1); die;
					$totalcalc[]=$arr1;
					//pr($totalcalc); die;
					$calVisitedArr[]= $cals['CalendarEvent']['id'];
				}
			}
			
			
			$actsBaseOnKeywords = $this->Activity->find('all', array('conditions'=>array('Activity.activity_owner'=>$_SESSION['Auth']['User']['id'],'Activity.title LIKE'=>'%'.$keyWordToSearch.'%','Activity.full_start_time BETWEEN ? and ?'=>array($ccdate,$fdate))));
			
			foreach($actsBaseOnKeywords as $acts) {
				if(in_array($acts['Activity']['id'],$actVisitedArr)==false){
					$title=$acts['Activity']['title'];
					$date=$acts['Activity']['start_time']=$acts['Activity']['full_start_time'];
					$date=date("F. d, Y", strtotime($date));
					$rating=$acts['Activity']['rating'];
					$details=$acts['Activity']['description'];
					$arr2 =array('model_name'=>'Activity','title'=>$title,'start_time'=>$date,'rating'=>$rating,'details'=>$details);
					$totalacts[]=$arr2;
					$actVisitedArr[]= $acts['Activity']['id'];
				}
			}
			//
			//pr($totalacts); die;
		} 
		
		$result = array_merge($totalcalc, $totalacts);
		$result = Set::sort($result,'{n}.start_time','asc');
		
		//echo '<pre>'; print_r($result);die;
		$this->set('result',$result);
	}
		
	
	
	/** 
	@function : display_contacts 
	@description : Display 
	@params : NULL
	@Created by :Sandeep verma
	@Modify : NULL
	@Created Date : Dec. 04, 2012
	*/
	function display_contacts(){
		$this->layout = false;
		//pr($_SESSION['connectionsNotTouched']); exit;
		$connectionIds  = array_keys($_SESSION['connectionsNotTouched']);
		
		$conLists = $this->Connection->find('all',array('conditions'=>array('Connection.id'=>$connectionIds),'fields'=>array('Connection.id','Connection.name'),'order'=>'Connection.created DESC','limit'=>10));
		//pr($conLists);
		$newArr = array();
		foreach($conLists as $key=>$val){
			$conLists[$key]['Connection']['remaining_touch'] = $_SESSION['connectionsNotTouched'][$conLists[$key]['Connection']['id']];
		}
		$conLists = Set::sort($conLists,'{n}.Connection.remaining_touch','desc');
		
		//echo '<pre>'; print_r($conLists); die;
		arsort($_SESSION['connectionsNotTouched']);
		//echo '<pre>'; print_r($_SESSION['connectionsNotTouched']); die;
		//$conListOnce = $this->Connection->find('all',array('conditions'=>array('Connection.id'=>$_SESSION['connectionsTouchedOnce']),'order'=>'Connection.created DESC','limit'=>10));
		
		$this->set(array('connectionIds'=>$_SESSION['connectionsNotTouched']));
		$this->set(compact('conLists'));
		
	}
	
	/** 
	@function : user_connection_list 
	@description : Display 
	@params : NULL
	@Created by :Sandeep verma
	@Modify : NULL
	@Created Date : Dec. 04, 2012
	*/
	function user_connection_list(){
		$this->layout = false;
		//$conLists = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id'], 'Connection.name LIKE'=>'%'.$connection_title.'%'),'order'=>'Connection.created DESC','limit'=>10));
		$conLists = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'Connection.created DESC','limit'=>10));
		
		echo json_encode($conLists); exit;
		
	}
	
	/** 
	@function : activate_user 
	@description : Activate invited user from link 
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 15, 2013
	*/
	function activate_user($id = null){
		$this->layout = false;
		$id = base64_decode($id);
		//find user info
		$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
		$invitedTime = $userInfo['User']['invitation_time'];
		$crTime = date("Y-m-d H:i:s");
		
		$your_date = strtotime($invitedTime);
		$calcDiff = strtotime($crTime) - $your_date;
		$hrsDiff = floor($datediff/(60*60));
		
		if($hrsDiff <=24)
		{
			$status = 1;
			$newFlag = 'green';
			$activation_date = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'));
			$this->User->updateAll(array('User.status'=>"'$status'"),array('User.id'=>$id));
			$this->User->updateAll(array('User.is_flaged'=>"'$newFlag'"),array('User.id'=>$id));
			$this->User->updateAll(array('User.activation_date'=>"'$activation_date'"),array('User.id'=>$id));
			$this->Session->setFlash('Your account has been activated successfully. Please login.', 'default', array('class' => 'flash_success'));
			//Creating session to populate the email/pass in login screen
			$this->Session->write('user_email',$userInfo['User']['email']);
			//$this->Session->write('user_pass',$userInfo['User']['password']);
			
			$this->redirect(array('controller'=>'users','action'=>'login'));			
		} else {
			$this->redirect(array('controller'=>'users','action'=>'expired'));			
		}
	}
	
	function expired(){
		$this->set('pagetitle','Link Expired');
		$this->layout = "inner_pages";
	}
	
	
	/** 
	@function : manage_profile 
	@description : Update Bio of user,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function manage_profile() {
		$this->set('pagetitle','Manage Profile');
		$this->layout = "group_dashboard";
		$id = $_SESSION['Auth']['User']['id'];
		$this->loadModel('Transaction');
		$this->loadModel('SubscriptionPlan');
		$current_user_trans=$this->Transaction->find('first',array('conditions'=>array('Transaction.user_id'=> $this->Session->read('Auth.User.id')),'order'=>'Transaction.id DESC'));
		$this->set('current_user_trans',$current_user_trans);
		if(empty($this->data )) {
			$this->User->id = $id;
			//$this->data = $this->User->read();
			$this->data=$this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id'])));
			//$this->set(compact('$userInfo'));
			//timezones
			$timezones = $this->Timezone->find('list',array('conditions'=>array(),'fields'=>array('Timezone.id','Timezone.timezone_location'),'order'=>'Timezone.timezone_location ASC'));
			$this->set(compact('timezones'));
			//pr($timezones); die;
			App::import('FlagSetting');			
			$flagArr=$this->FlagSetting->find('first',array('FlagSetting.user_id'=>$_SESSION['Auth']['User']['id']));
					
			$this->data = array_merge($this->data,$flagArr);
			//pr($this->data);die;
			
		} else {
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			$this->data['User']['id'] = $id;
			unset($this->data['ChangePass']);
			if($this->User->validates()) {
				if(is_uploaded_file($this->data['User']['file']['tmp_name']))
				{
				    $fileName=$this->data['User']['file']['name'];
				    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
				   
				    $this->data['User']['image']='image'.time().'.'.$ext;   
				   
				   
				    App::import('Lib','resize');   
				    $image = new ImageResize();
		       
				    move_uploaded_file($this->data['User']['file']['tmp_name'],'files/user/original/'.$this->data['User']['image']);
				    $image->resize('files/user/original/'.$this->data['User']['image'],'files/user/medium/'.$this->data['User']['image'],'aspect_fill',208,139,0,0,0,0);
			       }
				//$this->Session->write('Auth', $this->User->read(null, $this->Auth->User($id)));
				$this->User->save($this->data, array('validate'=>false));
				
				//$_SESSION['Auth']['User']['image']=$this->data['User']['file']['name'];
				
				$this->Session->setFlash('Your profile saved successfully.','default',array('class'=>'flash_success'));
				//$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
			}
		}
	}
	
	
	function welcome_sponsor(){
	//	if($_SESSION['first_login'] == 1){
	//		$this->redirect(array('controller'=>'users','action'=>'sponsor_profile'));
	//	}
		$this->set('pagetitle','Welcome');
		$this->layout = "individual_dashboard";
		$this->loadModel('Mission');
		$this->loadModel('User');
		$today_Date = date('Y-m-d').' '.'23:59:59';
		$mission_Sponsor_User = $this->Mission->find('all',array('conditions'=>array('Mission.sponsor_id'=>$_SESSION['Auth']['User']['id'],'Mission.end_time >'=> $today_Date,'Mission.sp_complete'=>0)));
		$this->set('mission_Sponsor_User',$mission_Sponsor_User);
		$mission_Sponsor_Users_history = $this->Mission->find('all',array('conditions'=>array('Mission.sponsor_id'=>$_SESSION['Auth']['User']['id'],'OR'=>array('Mission.end_time <'=> $today_Date,'Mission.sp_complete'=>1))));
		$this->set('mission_Sponsor_Users_history',$mission_Sponsor_Users_history);
		$recentRelation = $this->SponsorManager->find('first',array('conditions'=>array('SponsorManager.sponsor_id'=>$_SESSION['Auth']['User']['id']), 'fields'=>array('SponsorManager.id','SponsorManager.sponsor_id','SponsorManager.manager_id'), 'order'=>'SponsorManager.id DESC'));
		$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$recentRelation['SponsorManager']['manager_id'])));
		$this->set('recentRelation', $userInfo);
		return $mission_Sponsor_User;
	}
	
	function sponsor_users(){
		$this->set('pagetitle','Welcome');
		$this->layout = "individual_dashboard";
		$this->loadModel('SponsorManager');
		$Sponsor_User = $this->SponsorManager->find('all',array('conditions'=>array('SponsorManager.sponsor_id'=>$_SESSION['Auth']['User']['id'])));
		//pr($Sponsor_User); die;
		$this->set('Sponsor_User',$Sponsor_User);
	}
	
	
	/** 
	@function : sponsor_profile 
	@description : Update Bio of user,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Mar. 06, 2013
	*/
	function sponsor_profile() {
		$this->set('pagetitle','Manage Profile');
		$this->layout = "individual_dashboard";
		$id = $_SESSION['Auth']['User']['id'];
		if(empty($this->data )) {
			$this->User->id = $id;
			$this->data = $this->User->read();
		} else {
			uses('sanitize');
			$this->Sanitize = new Sanitize;
			$this->data = $this->Sanitize->clean($this->data);
			$this->data['User']['id'] = $id;
			unset($this->data['ChangePass']);
			if($this->User->validates()) {
				if(is_uploaded_file($this->data['User']['file']['tmp_name']))
				{
				    $fileName=$this->data['User']['file']['name'];
				    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
				   
				    $this->data['User']['image']='image'.time().'.'.$ext;   
				   
				   
				    App::import('Lib','resize');   
				    $image = new ImageResize();
		       
				    move_uploaded_file($this->data['User']['file']['tmp_name'],'files/user/original/'.$this->data['User']['image']);
				    $image->resize('files/user/original/'.$this->data['User']['image'],'files/user/medium/'.$this->data['User']['image'],'aspect_fill',208,139,0,0,0,0);
			       }
			       
				$this->User->save($this->data, array('validate'=>false));
				$this->Session->setFlash('Your profile saved successfully.','default',array('class'=>'flash_success'));
				//$this->redirect(array('controller' => 'settings', 'action' => 'index', base64_encode($id)));
			}
		}
	}
	
	
	
	/** 
	@function : changeFunView 
	@description : changeFunView,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Mar. 12, 2013
	*/
	function changeFunView($areaCode=NULL) {
		$this->autoRender=false;
		//Update user-type in db and overwrite session value
		$this->User->updateAll(array('User.user_type'=>"'$areaCode'"),array('User.id'=>$_SESSION['Auth']['User']['id']));
		$_SESSION['Auth']['User']['user_type'] = $areaCode;
		if($areaCode == 1)
			echo SITE_URL.'users/welcome';
		elseif($areaCode == 2)
			echo SITE_URL.'groups/dashboard';
		elseif($areaCode == 3)
			echo SITE_URL.'users/welcome_sponsor';
		
		exit;
	}
	
	
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
		$this->Email->subject = $template['EmailTemplate']['subject'];
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
	
	
	/** 
	@function : k2sTotalHrs 
	@description : Total hrs for each K2s,
	@params : $k2sId,
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Apr. 03, 2013
	*/
	function k2sTotalHrs($k2sId=NULL){
		$totalHrs = 0; //Initialization
		
		$this->loadModel('KeyToSuccess');
		$k2sElement = $this->KeyToSuccess->find('first',array('conditions'=>array('KeyToSuccess.id'=>$k2sId)));
		
		//$recentMission = $this->Mission->find('first',array('recursive'=>2,'conditions'=>array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.shared_by_gm'=>0), 'order'=>'Mission.id DESC'));
		
		$totalK2sDays = ceil((strtotime($k2sElement['KeyToSuccess']['end_date'].' 23:59:59') - strtotime($k2sElement['KeyToSuccess']['start_date'].' 00:00:00'))/86400);
		
		
		/*
		if(($k2sElement['start_date'].' 00:00:00') < ($recentMission['Mission']['start_time'])){
			$totalK2sDays = ceil((strtotime($k2sElement['end_date'].' 23:59:59') - strtotime($recentMission['Mission']['start_time']))/86400);
		}*/
		
		if($k2sElement['KeyToSuccess']['period'] == 0){ //Weekly
			$numberOfWeeks = ($totalK2sDays/7);
			$totalHrs = (($k2sElement['KeyToSuccess']['expected_hrs'])*$numberOfWeeks);
		} elseif($k2sElement['KeyToSuccess']['period'] == 1){ //Monthly
			$numberOfMonths = ($totalK2sDays/30);
			$totalHrs = (($k2sElement['KeyToSuccess']['expected_hrs'])*$numberOfMonths);
		} elseif($k2sElement['KeyToSuccess']['period'] == 2){ //Mission
			$totalHrs = $k2sElement['KeyToSuccess']['expected_hrs'];	
		}
		
		return round($totalHrs);
	}

	
	
	function loginIfSessionLost($user_id){
		//echo "ID: ".$user_id;
		//echo '<br>========<br><pre>';
		//$this->redirect(array('controller' => 'timelines', 'action' => 'index',base64_encode($user_id)));
		//die;
		$userInfo = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
		
		//Redirect user to welcome widow immediatly after sync
		$email = $userInfo['User']['email'];
		$pass = $userInfo['User']['password'];
		//$this->Auth->userScope = array('User.user_type' => $userInfo['User']['user_type']);
		$loginArray = array('email' => $email, 'password' => $pass);
		
		//echo "http://www.vimbli.com/beta/timelines/index/".base64_encode($user_id);
		//die;
		//pr($loginArray);
		
		if ($this->Auth->login($loginArray)) { //echo 1; die;
			$_SESSION['Connection']['mail_redirect'] = 1;
			//header('Location: http://www.vimbli.com/beta/timelines/index/'.base64_encode($user_id));
			$this->redirect(array('controller' => 'timelines', 'action' => 'index',base64_encode($user_id),1));
			//$this->redirect(array('controller' => 'timelines', 'action' => 'index',base64_encode($user_id)));	
		} else { //echo 2; die;
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
		//$this->redirect(array('controller' => 'timelines', 'action' => 'index',base64_encode($user_id)));
		//print_r($_SESSION);
		//die;
	}
	
	
	// crea	ted on 3rd july 2013
	// sunny chauhan
	// used to manage the flag values in element/foundation/gm_flag
	
	function manage_flag(){			
		if(empty($this->data)){
			$this->data = $this->FlagSetting->read();
		     }else{		
			//pr($this->data); die;
				$udata = array();
				//$udata = $this->FlagSetting->read();
				$udata['FlagSetting']['user_id']=$_SESSION['Auth']['User']['id'];
				$udata['FlagSetting']['no_active_mission']=1;
				if($this->data['FlagSetting']['active_sponsor_check']==0){
					$udata['FlagSetting']['active_sponsor']=0;
					$udata['FlagSetting']['active_sponsor_check']=0;
				}else{
					$udata['FlagSetting']['active_sponsor_check']=1;
					$udata['FlagSetting']['active_sponsor']=1;
				}
				if($this->data['FlagSetting']['days_remaining_check']==0){
					$udata['FlagSetting']['days_remaining']=0;
					$udata['FlagSetting']['days_remaining_check']=0;
				}else{
					$udata['FlagSetting']['days_remaining']=$this->data['FlagSetting']['days_remaining'];
					$udata['FlagSetting']['days_remaining_check']=1;
				}
				if($this->data['FlagSetting']['last_reflection_check']==0){
					$udata['FlagSetting']['last_reflection']=0;
					$udata['FlagSetting']['last_reflection_check']=0;
				}else{
					$udata['FlagSetting']['last_reflection']=$this->data['FlagSetting']['last_reflection'];
					$udata['FlagSetting']['last_reflection_check']=1;
				}
				if($this->data['FlagSetting']['total_reflection_check']==0){
					$udata['FlagSetting']['total_reflection_in_30_days']=0;
					$udata['FlagSetting']['total_reflection_check']=0;
				}else{
					$udata['FlagSetting']['total_reflection_in_30_days']=$this->data['FlagSetting']['total_reflection_in_30_days'];
					$udata['FlagSetting']['total_reflection_check']=1;
					//pr($udata['FlagSetting']['total_reflection_in_30_days']); die;
				}
				//pr($udata['FlagSetting']['total_reflection_in_30_days']); die;
				if($this->data['FlagSetting']['last_contact_with_sponsor_check']==0){
					$udata['FlagSetting']['last_contact_with_sponsor']=0;
					$udata['FlagSetting']['last_contact_with_sponsor_check']=0;
				}else{
					$udata['FlagSetting']['last_contact_with_sponsor']=$this->data['FlagSetting']['last_contact_with_sponsor'];
					$udata['FlagSetting']['last_contact_with_sponsor_check']=1;
				}
				
				$udata['FlagSetting']['id']=$this->data['FlagSetting']['id'];
				#pr($udata);die;
				if($this->FlagSetting->save($udata)){
					$this->Session->setFlash('Record Updated Successfully.','default',array('class'=>'flash_success'));
					$this->redirect(array('controller' => 'users', 'action' => 'manage_profile'));
				
				}else{
				echo "not updated";
				}
			}

	}
	
	
	// created on 3rd july 2013
	// sunny chauhan
	// used to set the default values in gm_flag
	
	function setting_default_flagValues($id=null){
		$this->autoRender=false;
		$userInfo = $this->FlagSetting->find('first',array('conditions'=>array('FlagSetting.id'=>$id)));
		//pr($userInfo); die;
		if($userInfo){
			$userInfo['FlagSetting']['active_mission']=1;
			$userInfo['FlagSetting']['active_sponsor']=0;
			$userInfo['FlagSetting']['days_remaining']=7;
			$userInfo['FlagSetting']['last_reflection']=7;
			$userInfo['FlagSetting']['total_reflection_in_30_days']=10;
			$userInfo['FlagSetting']['last_contact_with_sponsor']=14;
			$userInfo['FlagSetting']['days_remaining_check']=1;
			$userInfo['FlagSetting']['no_active_sponsor_check']=1;
			$userInfo['FlagSetting']['last_reflection_check']=1;
			$userInfo['FlagSetting']['total_reflection_check']=1;
			$userInfo['FlagSetting']['last_contact_with_sponsor_check']=1;
		}
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
		$this->loadModel('Question');
		$this->loadModel('CohortUser');
		$this->loadModel('Cohort');
		$this->layout=false;
		$this->autoRender=false;
		//Configure::write('debug',2);
		$id=$week;
		//pr($id); die;
		//pr($id); die;
		//echo 'Sam';
		//$lastSatDate1=date('Y-m-d h:i:s', strtotime('last Saturday'));
		//pr($lastSatDate1);
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
		//pr($data); die;
		$filename ="QuestionsInfo.csv";
		$fp = fopen($filename,"w");
		if($fp){
			fwrite($fp,$data);
			fclose($fp);
		}
	
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
		exit;
	}
	
	/**
	@function: display_actions
	@description:	complete the mission
	@Created by: 	Sunny Chauhan
	@Modify:	
	@Created Date:	Jul. 19, 2013
	*/
	public function display_actions ($id=null) {
		$id = $_GET['id'];
		$this->set('id',$id);
		$this->layout = "";
	}
	
	/**
	@function: display_notes
	@description:	display and edit note
	@Created by: 	Sunny Chauhan
	@Modify:	
	@Created Date:	Jul. 19, 2013
	*/
	public function display_notes ($id=null,$edit_note = null) {
		//pr($edit_note);
		$edit_note = $_GET['edit_note'];
		$id = $_GET['id'];
		$this->loadModel = 'Misssion';
		$this->layout = "";
		$this->set('id',$id);
		//$id = $_GET['edit_note'];
		//pr($c); die;
		if(isset($edit_note)){
			$this->Mission->id = $id;
			$this->data = $this->Mission->read();
			//pr($this->data);
		}
		
	}
	
	
	/**
	@function: deactivate_user
	@description:	deactive particular user
	@Created by: 	Sanchit Negi
	@Modify:	july 22 2013
	@Created Date:	Jul. 19, 2013
	*/
	public function deactivate_user($id=null){
		$id = base64_decode($id);
		$this->autoRender = false;
		$status = 1; 
		if($this->User->updateAll(array('User.dormant_user'=>"'$status'"),array('User.id'=>$id))){
			$this->Cookie->destroy('Auth');
			$this->Session->delete('user_email');
			$this->Session->delete('first_login');
			$this->Session->delete('Connection');
			$this->Session->delete('Schedule');
			$this->Session->setFlash('Your account has been deactivated successfully.', 'default', array('class' => 'flash_success'));
			$this->redirect($this->Auth->logout());	
		}
		//$this->Session->setFlash('Your account has been deactivated successfully.','default',array('class'=>'flash_success'));
		//$this->redirect(array('controller'=>'users','action'=>'login'));
	}
	
	
	
	/**
	@function: deactivate_user
	@description:	delete particular user
	@Created by: 	Sanchit Negi
	@Modify:	
	@Created Date:	Jul. 19, 2013
	*/
	
	public function delete($id=null){
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('The User  has been deleted.'));
			$this->redirect(array('action' => 'index'));
		 }
               else{
			$this->Session->setFlash(__('Unable to delete User.'));
		      }    
        }
	
	/**
	@function: delete_user
	@description:	delete user with all data
	@Created by: 	Sunny Chauhan
	@Modify:	
	@Created Date:	Jul. 22, 2013
	*/
	
	public function delete_user($id=null){
		$this->autoRender = false;
		$id = base64_decode($id);
		//pr($id); die;
		$info = $this->User->find('all',array('conditions'=>array('User.id'=>$id)));
		//pr($info);die;
		if ($this->User->delete($id, $cascade)) {
			$this->Session->setFlash('The User  has been deleted.', 'default', array('class' => 'flash_success'));
			$this->redirect($this->Auth->logout());	
		 }
               else{
			$this->Session->setFlash(__('Unable to delete User.'));
		      }    
        }
}//end class
?>