<?php
/*
	* Customers Controller class
	* PHP versions 5.1.4
	* @filesource
	* @author     
	* @link       http://www.smartdatainc.net/
	* @version 0.0.1.3 
*/
App::import('Sanitize');
class UserGroupsController extends AppController{

	var $name 	= 'UserGroups';
	var $uses 	= array('UserGroup');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('RequestHandler','Cookie','Email', 'Auth');
	 
	
	function beforeFilter(){
		parent::beforeFilter();
		if(($this->params['action'] != 'admin_login') && (@$this->params['prefix'] == 'admin'))
		{
		    $this->Auth->allow('');
		} else {
		       
		}
	    }
	
	    
	/** 
	@function : admin_index 
	@description : listing of categories,
	@params : NULL
	@Created by : 
	@Modify : NULL
	@Created Date : Nov 21, 2012
	*/
	function admin_index(){
		$this->loadModel('User');
		
		//$condition = array();
		//$condition['1']['AND'][]['User.group_payment_status'] = 1;
		//$condition['1']['OR'][]['User.manager_id'] = NULL;
		//$condition['1']['OR'][]['User.manager_id'] = 'User.id';
		
		
		//prx($condition);
		
		/*
		$userData = $this->User->find('all', array(
							'conditions' => array(
									'User.group_payment_status' => 1, 
							 'OR' => array(
									'User.manager_id' => NULL,
									'User.manager_id' =>'User.id'
								
							  )
						    )
						)
					);		
		*/
		//$userData = $this->User->find('all',array('conditions'=>array('User.group_payment_status' =>1)));
		//pr($finalArr); die;
		$userData = $this->User->find('all',array('conditions'=>array("OR"=>array(array('User.group_payment_status' => 1,'User.manager_id' => null),array('User.group_payment_status' => 1,'User.manager_id = User.id')))));
		//$sharedMission = $this->Mission->find('all',array('conditions'=>array("OR"=>array(array('Mission.owner'=>$_SESSION['Auth']['User']['id'],'Mission.end_time <'=>$curTime,'Mission.shared_by_gm'=>0,'Mission.id <>' =>$crMissionId['Mission']['id']),array('Mission.edited_by'=>$_SESSION['Auth']['User']['id'],'Mission.end_time <'=>$curTime,'Mission.shared_by_gm'=>0,'Mission.id <>' =>$crMissionId['Mission']['id'])))));
		
		//pr($userData); die;
		
		
		//$condition = array('Company.status' => array('User.group_payment_status' => 1, 'User.manager_id'=>null));
		
		//$condition = array('Company.status' => array('User.group_payment_status' => 1, 'User.manager_id'=> 'User.id'));
		//$userData = $this->User->find('all',array('conditions'=>$condition));
		//prx($userData);
		if((isset($this->data["UserGroup"]["setStatus"])))
		{
			$status = ife($_POST['active'],1,0);
			$record = $this->data["UserGroup"]["Record"];
			$CheckedList=$_POST['box1'];
			$controller= $this->params['controller'];
			$action='index'; 
			$prefix='admin';
			$model='UserGroup';
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
					$criteria .= " and (UserGroup.title LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and UserGroup.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and UserGroup.status = '".$matchshow."'";
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
			'limit' => $this->rec_limit_in_admin,
			'order' => array(
				'UserGroup.id' => 'DESC'
			)
		);
		
		$this->set('pagetitle',"Manage Customers");
		$this->set('usergrouplist', $this->paginate('UserGroup',$criteria));
		$this->set('userData',$userData);
		//echo '<pre>'; print_r($userData);die;
	//pr($this->paginate('UserGroup',$criteria)); die;
	}    
	
	/*
	Function Name: admin_delete
	Params: NULL
	Created BY: 
	Created ON : Nov. 20, 2012
	Description : To delete Product - Admin Panel 
	*/
	function admin_delete($id=null){
	    $id = base64_decode($id);
	    $this->UserGroup->id = $id;
            $this->UserGroup->delete($id);
            $this->Session->setFlash('User Group deleted sucessfully.','message/green');
            $this->redirect(array('action' => 'index'));
        }
      
	/**
	@function:admin_view 
	@description		view User Details,
	@Created by: 		 
	@Modify:		NULL
	@Created Date:		Nov. 20, 2012
	*/
	function admin_view($id){
		$id = base64_decode($id);	
		$this->layout = 'admin';
		$this->set('pagetitle',"View User Group");
		$this->UserGroup->id = $id;
		$this->data = $this->UserGroup->read();
		
	}
	
	
	/**
	@function:admin_add 
	@description		Add user group from admin panel
	@Created by: 		Sandeep Verma
	@Modify:		NULL
	@Created Date:		Nov. 22, 2012
	*/
	function admin_add($id=null){ 
  		$id = base64_decode($id);
		$this->layout = 'admin';	
  		//App::import('Model','EmailTemplate');
      		//$this->EmailTemplate = & new EmailTemplate();
		
		$this->set('pagetitle',"Add User");
		$this->UserGroup->id = $id;
		$admin_id=0;
		if(empty($this->data)){
			$this->data = $this->UserGroup->read();
		}else if(!empty($this->data)){	
			$this->UserGroup->set($this->data);
			if($this->UserGroup->validates()){
				
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
	
				$this->data['UserGroup']['title'] = ucwords(strtolower($this->data['UserGroup']['title']));
				$this->data['UserGroup']['status'] = '1';

				if($this->UserGroup->save($this->data)) {
					$userGroupId = $this->UserGroup->getLastInsertId();						
			
						$condition=array('UserGroup.id'=>$userGroupId);
						$user_group = $this->UserGroup->find('first',array('conditions'=>$condition,'fields'=>array('id','title','description')));
						
						//SEND EMAIL TO ADDED USER
										
						$this->Session->setFlash('UserGroup has been saved successfully.','default',array('class'=>'message/green'));
						$this->redirect('index');
				}
				
			} else{
				$errorArray = $this->UserGroup->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	/**
	@function:admin_edit 
	@description		Edit user group from admin panel
	@Created by: 		Sandeep Verma
	@Modify:		NULL
	@Created Date:		Nov. 22, 2012
	*/
	function admin_edit($id=null){
  		$id = base64_decode($id);
		$this->layout = 'admin';	
  		//App::import('Model','EmailTemplate');
      		//$this->EmailTemplate = & new EmailTemplate();
		
		$this->set('pagetitle',"Edit Customer");
		$this->UserGroup->id = $id;
		$admin_id=0;
		if(empty($this->data)){
			$this->data = $this->UserGroup->read();
		}else if(!empty($this->data)){
			
			$this->UserGroup->set($this->data);
			
			if($this->UserGroup->validates()){
				
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
				$this->data['UserGroup']['title'] = ucwords(strtolower($this->data['User']['title']));
				$this->data['UserGroup']['status'] = '1';
				
				if($this->UserGroup->save($this->data)) {
					
					$userGroupId = $this->UserGroup->getLastInsertId();						
           
						$condition=array('UserGroup.id'=>$userGroupId);
						$user = $this->UserGroup->find('first',array('conditions'=>$condition,'fields'=>array('id','title','description','status')));
						
						//SEND EMAIL TO ADDED USER
										
						$this->Session->setFlash('Account has been saved successfully.','default',array('class'=>'message/green'));
						$this->redirect('index');
				}
				
				
			} else{
				$errorArray = $this->User->validationErrors;
				//$this->set('errors',$errorArray);
			}
		}
	}
  }//end class
?>