<?php
/*
* PagesController class
* PHP versions 5.2.12
* @filesource
* @author 	Vikas Uniyal 
* @date 	Nov. 19, 2012
* @link       http://www.smartdatainc.net/
* @version 1.0.0 
*   - Initial release
*/
App::import('Sanitize');
class MessagesController extends AppController
{
 	var $name='Messages';
	var $uses = array('Message','User','Cohort','Connection');
	var $helpers = array('Javascript','Html','Common','Validation','Thumbnail','Ajax','Session','Teaser','BreadcrumbDiv');
	var $components = array('Email','Cookie','Auth','AuthExtension','Common');
	var $paginate =  array('limit'=>10);
	
        function beforeFilter()
	{
            parent::beforeFilter(); 
            $this->Auth->allow('');
	    $this->layout='admin';
        }
	
	/*
	Function Name: admin_add
	Params: NULL
	Created BY:Sandeep Verma
	Created ON : Nov. 19, 2012
	Description : To send mesages to users - Admin Panel 
	*/
	function admin_add()
	{
	
	    $this->set('pagetitle',"Send Message");
	    /**  fetch users **/
	    $this->loadModel('UserGroup');
	    $this->loadModel('User');
	    $usersList = $this->User->find('list', array('fields'=>array('id', 'name')));
	    //$groupList = $this->User->find('list', array('recursive'=>-1,'conditions'=>array('User.group_payment_status' => 1,'User.manager_id'=>null),'fields'=>array('id', 'name')));
	    $groupList = $this->User->find('list',array('recursive'=>'-1','conditions'=>array("OR"=>array(array('User.group_payment_status' => 1,'User.manager_id' => null),array('User.group_payment_status' => 1,'User.manager_id = User.id'))),'fields'=>array('id', 'name')));
	    $groupManagerList = $this->User->find('list',array('conditions'=>array('User.group_payment_status' => 1),'fields'=>array('id','name')));
	    $sponsorList = $this->User->find('list',array('recursive'=>'-1','conditions'=>array('User.status'=>1,'User.user_type'=>3),'fields'=>array('User.id','User.name')));
	    
	    //echo '<pre>'; print_r($groupList); die;
	    $this->set('usersList',$usersList);
	    $this->set('groupList',$groupList);
	    $this->set('sponsorList',$sponsorList);
	    $this->set('groupManagerList',$groupManagerList);
	     if(!empty($this->data)){
		$contents = '';
		uses('sanitize');
		$this->Sanitize = new Sanitize;
		$this->data = $this->Sanitize->clean($this->data);
		$this->Message->set($this->data);
		//set empty value if no user is selected, else unset this rule
		if(!is_array($this->data['Message']['to_user_id1']))
			$this->data['Message']['to_user_id1'] = '';
		else{
			$this->data['Message']['to_user_id'] = $this->data['Message']['to_user_id1'];
			unset($this->Message->validate['to_user_id']['notEmpty']);
		}
		
		if(!is_array($this->data['Message']['to_user_id2']))
			$this->data['Message']['to_user_id2'] = '';
		else{
			$groupUsers = array();
			foreach($this->data['Message']['to_user_id2'] as $id){
				//pr($id); die;
				$users = $this->User->find('all',array('recursive'=>-1,'conditions'=>array('User.manager_id'=>$id)));
				if(!empty($users)){
					$groupUsers[] = $users;	
				}	
			}
			foreach($groupUsers as $group){
				foreach($group as $id){
					$ids[] = $id['User']['id'];
					
				}	
			}
			//pr($ids); die;
			if(!empty($ids)){
				$this->data['Message']['to_user_id'] = $ids;
				unset($this->Message->validate['to_user_id']['notEmpty']);
			}else{
				//$this->data['Message']['to_user_id'] = '';
				$this->Session->setFlash('There is no User belongs to Groups selected.','message/yellow');
				$this->redirect(Controller::referer());
			}
		}
		
		if(!is_array($this->data['Message']['to_user_id3']))
			$this->data['Message']['to_user_id3'] = '';
		else{
			$this->data['Message']['to_user_id'] = $this->data['Message']['to_user_id3'];
			unset($this->Message->validate['to_user_id']['notEmpty']);
		}
		
		if(!is_array($this->data['Message']['to_user_id4']))
			$this->data['Message']['to_user_id4'] = '';
		else{
			$this->data['Message']['to_user_id'] = $this->data['Message']['to_user_id4'];
			unset($this->Message->validate['to_user_id']['notEmpty']);
		}
		//pr($this->data); die;
		//if(!empty($this->data['Message']['to_user_id'])){
			if($this->Message->validates()){
				//set submitted data if validaed successfully
				$to_user_ids = $this->data['Message']['to_user_id'];
				$subject = $this->data['Message']['subject'];
				$content = $this->data['Message']['content'];
				$from_user_email = $_SESSION['Auth']['User']['email'];
				$from_user_id = $_SESSION['Auth']['User']['id'];
				$this->data['Message']['from_user_email'] = $from_user_email;
				//pr($_SESSION['Auth']['User']); exit;
				//send email all selected users
				//pr($this->data['Message']['to_user_id']); die;
				if($this->data['Message']['to_user_id']){
					$this->send_msgs_email($this->data);
					foreach($to_user_ids as $key=>$val){
						//loop through alll data and make save array
						$save_msg[$key]['Message']['from_user_id'] = $from_user_id;
						$save_msg[$key]['Message']['to_user_id'] = $val;
						$save_msg[$key]['Message']['subject'] = $subject;
						$save_msg[$key]['Message']['content'] = $content;
					}
					//pr($save_msg);  die;
					if($this->Message->saveAll($save_msg)){
					    $this->Message->create();
					    $this->Session->setFlash('The Message has been sent','message/green');
					    $this->redirect(Controller::referer());
					}else{
						$this->Session->setFlash('Message sending failed. Please, try again.','message/yellow');
					}	
				}else{
					$this->Session->setFlash('No User is Selected','message/yellow');
				}
			}else{
				$errorArray = $this->Message->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}	
		}
	}
	
	/*
	Function Name: send_msgs_email
	Params: $msg_data
	Created BY:Sandeep Verma
	Created ON : Dec. 12, 2012
	Description : To add new Static Page - Admin Panel 
	*/
	 
	function send_msgs_email($msg_data= array()){
	    $users_ids = $msg_data['Message']['to_user_id'];
	    
	    $this->loadModel('User');
	    $users_emails = $this->User->find('list', array('fields'=>array('email'),'conditions'=>array('User.id '=>$users_ids)));
	    //pr($msg_data); exit;
	    foreach($users_emails as $email) {
		$from = ADMIN_EMAIL;
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From:" . $from;
		
		echo "Mail Sent.";
		mail($email,$msg_data['Message']['subject'],html_entity_decode(stripcslashes($msg_data['Message']['content'])),$headers);
	    }
	}
	
	
	/**
	@function: inbox
	@description		inbox of user
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Jan. 23, 2013
	*/
	function inbox(){
		
		$this->layout = "individual_dashboard";
		
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
		$criteria .= " and (Message.to_user_id = '".$_SESSION['Auth']['User']['id'].")')";
		$matchshow = '';
		$fieldname = '';
		$this->set('show',20);
		/* SEARCHING */
		$reqData = $this->data;
		$options['subject'] = "Subject";
		$options['content'] = "Content";
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
					$criteria .= " and (Message.subject LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and Message.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and Message.status = '".$matchshow."'";
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
			'recursive'=>2,
			'order' => array(
				'Message.id' => 'DESC'
			)
		);
		//pr($criteria);
		$this->set('pagetitle',"Inbox");                
		$this->set('msgList', $this->paginate('Message',$criteria));
		//pr($this->paginate('Message',$criteria)); die;
	}
	
	
	/** 
	@function : perform_actions 
	@description : perform various action for messages,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 19, 2012
	*/
	function perform_actions()
	{
		//pr($this->data); die;
		if($this->data['Message']['action'] == 'delete')
		{
			foreach($this->data['Message']['ids'] as $ids){
				$this->Message->delete($ids, true);
			}
			$this->Session->setFlash('Record has been deleted successfully', 'default', array('class' => 'flash_success'));
		}
		
		$this->redirect($this->referer());
	}
	
	
	/** 
	@function : send_new_message
	@description : send message to user
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan 23, 2013
	*/
	function send_new_message($id=null, $msgToemail=NULL){
		$id = base64_decode($id);
		$msgToemail = base64_decode($msgToemail);
		
		$this->set(compact('id'));
		$this->set('pagetitle','Send Message');
		$this->layout = "inner_pages";
		
		if($msgToemail != NULL){
			$this->set(compact('msgToemail'));
		} else{
			//Users of group
			$allUsers = $this->User->find('list',array('conditions'=>array('User.status'=>1,'User.user_type'=>1),'fields'=>array('User.id','User.name')));
			$this->set(compact('allUsers'));
			//Cohort List
			$conList = $this->Connection->find('all',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
			$this->set(compact('conList'));
			//Users of group
			//pr($conList); die;
			$sponsorList = $this->SponsorManager->find('all',array('conditions'=>array('SponsorManager.manager_id'=>$_SESSION['Auth']['User']['id'])));
			//pr($sponsorList); die;
			//$this->set(compact('allSponsors'));
			//$sponsorList = $this->User->find('list',array('conditions'=>array('User.status'=>1,'User.user_type'=>3),'fields'=>array('User.id','User.name')));
			$this->set(compact('sponsorList'));
		}
		//pr($conList); die;
		if(!empty($this->data))
		{
			//pr($this->data); die;
			$this->data['Message']['from_user_id'] = $_SESSION['Auth']['User']['id'];
			$this->data['Message']['created'] = date('Y-m-d H:i:s');
			$this->data['Message']['local_message_time'] = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'));
			
			if($this->data['Message']['msg_to'] == 'individual')
			{
				foreach($this->data['User']['user_id'] as $row){
					$this->data['Message']['to_user_id'] = $row;
					$this->Message->create();
					$this->Message->save($this->data);
					
					$emailOfUser = $this->User->find('first',array('conditions'=>array('User.id'=>$row),'fields'=>array('User.email')));
					//Send Email
					$from = $_SESSION['Auth']['User']['email'];
					$headers = "From:" . $from;
					echo "Mail Sent.";
					mail($emailOfUser['User']['email'],$this->data['Message']['subject'],strip_tags($this->data['Message']['content']),$headers);
				}
			}
			elseif($this->data['Message']['msg_to'] == 'connection')
			{
				//pr($this->data['Connection']);die;
				if(!isset($this->data['Connection']['con_id']) && !is_array($this->data['Connection']['con_id'])){
					$this->data['Message']['to_user_type'] = 'connection';
					$this->Message->create();
					$this->Message->save($this->data);
					
					//Send Email
					$from = $_SESSION['Auth']['User']['email'];
					$headers = "From:" . $from;
					mail($msgToemail,$this->data['Message']['subject'],strip_tags($this->data['Message']['content']),$headers);
				
				} else  {
					foreach($this->data['Connection']['con_id'] as $row){
						$this->data['Message']['to_user_id'] = $row;
						$this->data['Message']['to_user_type'] = 'connection';
						$this->Message->create();
						$this->Message->save($this->data);
					
						$emailOfUser = $this->Connection->find('first',array('conditions'=>array('Connection.id'=>$row)));
						//pr($emailOfUser); die;
					
						//Send Email
						$from = $_SESSION['Auth']['User']['email'];
						$headers = "From:" . $from;
						mail($emailOfUser['ConnectionEmail'][0]['email'],$this->data['Message']['subject'],strip_tags($this->data['Message']['content']),$headers);
					}
					
				}	
			}
			else if($this->data['Message']['msg_to'] == 'sponsor')
			{
				//pr($this->data);die;
				foreach($this->data['Sponsor']['sponsor_id'] as $row){
					$this->data['Message']['to_user_id'] = $row;
					$this->Message->create();
					$this->Message->save($this->data);
					
					$emailOfUser = $this->User->find('first',array('conditions'=>array('User.id'=>$row),'fields'=>array('User.email')));
					//Send Email
					$from = $_SESSION['Auth']['User']['email'];
					$headers = "From:" . $from;
					echo "Mail Sent.";
					mail($emailOfUser['User']['email'],$this->data['Message']['subject'],strip_tags($this->data['Message']['content']),$headers);
				}	
			}
			else if($this->data['Message']['msg_to'] == 'groupmanager')
			{
				//find groupmanager
				$grpMngrEmail = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['manager_id'])));
				
					$this->data['Message']['to_user_id'] = $grpMngrEmail['User']['id'];
					$this->Message->create();
					$this->Message->save($this->data);
					
					$emailOfUser = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['manager_id']),'fields'=>array('User.email')));
					//Send Email
					$from = $_SESSION['Auth']['User']['email'];
					$headers = "From:" . $from;
					echo "Mail Sent.";
					mail($emailOfUser['User']['email'],$this->data['Message']['subject'],strip_tags($this->data['Message']['content']),$headers);
			}
						
			
			$this->Session->setFlash('Message sent successfully.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'users','action'=>'welcome'));
		}
	}
	
	/**
	@function: sent
	@description		outbox of user
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Jan. 23, 2013
	*/
	function sent(){
		
		$this->layout = "individual_dashboard";
		
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
		$criteria .= " and (Message.from_user_id = '".$_SESSION['Auth']['User']['id'].")')";
		$matchshow = '';
		$fieldname = '';
		$this->set('show',20);
		/* SEARCHING */
		$reqData = $this->data;
		$options['subject'] = "Subject";
		$options['content'] = "Content";
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
					$criteria .= " and (Message.subject LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and Message.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and Message.status = '".$matchshow."'";
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
			'recursive'=>2,
			'order' => array(
				'Message.id' => 'DESC'
			)
		);
		//pr($criteria);
		$this->set('pagetitle',"Inbox");                
		$this->set('msgList', $this->paginate('Message',$criteria));
		//pr($this->paginate('Message',$criteria)); die;
	}
	
	
	
}
?>