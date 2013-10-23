<?php
/*
	* Activities Controller class
	* PHP versions 5.1.4
	* @filesource
	* @author     Sandeep Verma
	* @link       http://www.smartdatainc.net/
	* @version 0.0.1.3 
*/
App::import('Sanitize');
class ActivitiesController extends AppController{

	var $name 	= 'Activities';
	var $uses 	= array('Activity','ActivityType','Connection','ActivityAttendy','ConnectionGroup','ConnectionPhone','ConnectionEmail','ConnectionAddress','ConGroupRelation','ImportEmail','CalendarEvent','EventAttendy');
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
	@function : index 
	@description : list all activities
	@params : NULL
	@Created by :Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 14, 2012
	*/ 
	function index($id){
	
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
		$criteria .= " and Activity.activity_owner = '".$id."'";
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
		//$this->set(compact('allGroups'));
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
					$criteria .= " and (Activity.title LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and Activity.".$fieldname." LIKE '%".$value1."%'";
							
					
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and Activity.status = '".$matchshow."'";
					$this->set('show',$show);
				}
			}
			
		}
		
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','Activities');
		
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
				'Activity.id' => 'DESC'
			)
		);
		//pr($criteria);
		$this->set('pagetitle',"Activities");                
		$this->set('activityList', $this->paginate('Activity',$criteria));
		//pr($this->paginate('Activity',$criteria)); die;
	}
	
	/** 
	@function : perform_actions 
	@description : perform various action from index page,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function perform_actions()
	{
		//pr($this->data); die;
		if($this->data['Activity']['action'] == 'delete')
		{
			foreach($this->data['Activity']['ids'] as $ids){
				$this->Activity->delete($ids, true);
			}
			$this->Session->setFlash('Activity(s) deleted successfully', 'default', array('class' => 'flash_success'));
		}
		
		else if($this->data['Activity']['action'] == 'activate')
		{
			foreach($this->data['Activity']['ids'] as $ids) :
				$status = 1;
				$this->Activity->updateAll(array('Activity.status'=>"'$status'"),array('Activity.id'=>$ids));
			endforeach;
			$this->Session->setFlash('Activity(s) activated successfully.', 'default', array('class' => 'flash_success'));
				
		}
		else if($this->data['Activity']['action'] == 'deactivate')
		{
			foreach($this->data['Activity']['ids'] as $ids):
				$status = 0;
				$this->Activity->updateAll(array('Activity.status'=>"'$status'"),array('Activity.id'=>$ids));
			endforeach;
			$this->Session->setFlash('Activity(s) deactivated successfully.', 'default', array('class' => 'flash_success'));
		}
		else if($this->data['Activity']['action'] == 'view')
		{
			$this->redirect(array('controller'=>'activities','action'=>'activity_detail',base64_encode($this->data['Connection']['ids'][0])));
		}
		else if($this->data['Activity']['action'] == 'edit')
		{
			$this->Session->setFlash('Edit action is Under process.', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'activities','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
		}
		
		$this->redirect(array('controller'=>'activities','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
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
	@function : activity_detail
	@description : list all activities
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 14, 2012
	*/ 
	function activity_detail($id){
		$this->set('pagetitle','Activities');
		$this->layout = "individual_dashboard";
		$this->set(compact('id'));
		$id = base64_decode($id);
	   
		$activityInfo = $this->Activity->find('first',array('conditions'=>array('Activity.id'=>$id)));
		$this->set(compact('activityInfo'));
		
	}
	
	/**
	@function:add_group 
	@description		Add Activity
	@Created by: 		Sandeep Verma
	@Modify:		NULL
	@Created Date:		Dec. 19, 2012
	*/
	function add_activity($id=null){
		//Configure::write('debug', 0);
  		$id = base64_decode($id);
		$this->set(compact('id'));
		$this->layout = 'inner_pages';	
  		
		$this->set('pagetitle',"Add Activity");
		$this->Activity->id = $id;
		$admin_id=0;
		$activityTypes = $this->ActivityType->find('list', array('conditions'=>array('status'=>1)));
		$this->set(compact('activityTypes'));
		
		$allCon = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id'],'Connection.status'=>1),'fields'=>array('Connection.id','Connection.name')));
		$this->set(compact('allCon'));
		
		$autoCompleteConList_first = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'Connection.created DESC'));
		$autoCompleteConList = array();
		foreach($autoCompleteConList_first as $listKey=>$listVal){
			$autoCompleteConList[] = str_replace('"','',$listVal);
		}
		//unset($autoCompleteConList[725]);
		$autoCompleteConList = '"'.implode('","', $autoCompleteConList).'"';
		//echo $autoCompleteConList; exit;
		$this->set(compact('autoCompleteConList'));
		//pr($autoCompleteConList); die;
		if(empty($this->data)){
			$this->data = $this->Activity->read();
			$this->set('rating', $this->data['Activity']['rating']);
			$stTime = explode(' ',$this->data['Activity']['start_time']);
			$this->set('stTime', $stTime[0]);
			$endTime = explode(' ',$this->data['Activity']['end_time']);
			$this->set('endTime', $endTime[0]);
			
			$sharedWithConnectionIds = $this->ActivityAttendy->find('list',array('conditions'=>array('ActivityAttendy.event_id'=>$this->data['Activity']['id']), 'fields'=>('connection_id')));
			//$sharedWithConnectionTime = $this->MissionConnection->find('first',array('conditions'=>array('MissionConnection.mission_id'=>$recentMission['Mission']['id'])));
			$connectionNames = $this->Connection->find('list',array('conditions'=>array('Connection.id'=>$sharedWithConnectionIds), 'fields'=>('name')));
			//pr($connectionNames); exit;
			$this->set(compact('connectionNames'));
			
			//set array of participant ids
			if($id != ""){
				$allPartArr = array();
				foreach($this->data['ActivityAttendy'] as $pRow){
					$allPartArr[] = $pRow['connection_id'];	
				}
				$this->set(compact('allPartArr'));
			}
			//pr($allPartArr); die;
			
		}else if(!empty($this->data)){
			//pr($this->data); die;
			$this->Activity->set($this->data);
			if($this->Activity->validates()){
				//pr($this->data); die;
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
	
				$this->data['Activity']['title'] = strtolower($this->data['Activity']['title']);
				$this->data['Activity']['status'] = '1';
				$this->data['Activity']['activity_owner'] = $_SESSION['Auth']['User']['id'];

				$stDate = explode('/',$this->data['Activity']['start_date']);
				$this->data['Activity']['start_date'] = $stDate[2].'-'.$stDate[0].'-'.$stDate[1];
				$endDate = explode('/',$this->data['Activity']['end_date']);
				$this->data['Activity']['end_date'] = $endDate[2].'-'.$endDate[0].'-'.$endDate[1];
				
				$this->data['Activity']['start_time'] = $this->data['Activity']['st_time'].' '.$this->data['Activity']['start_time_slot'];
				$this->data['Activity']['end_time'] = $this->data['Activity']['en_time'].' '.$this->data['Activity']['end_time_slot'];
				
				//New fields added for calculation point of view.
				$this->data['Activity']['full_start_time'] = $this->data['Activity']['start_date'].' '.$this->data['Activity']['start_time'];
				$this->data['Activity']['full_end_time'] = $this->data['Activity']['end_date'].' '.$this->data['Activity']['end_time'];
				$this->data['Activity']['full_start_time'] = date("Y-m-d H:i:s",strtotime($this->data['Activity']['full_start_time']));
				$this->data['Activity']['full_end_time'] = date("Y-m-d H:i:s",strtotime($this->data['Activity']['full_end_time']));
				
				//New fields
				$this->data['Activity']['local_start'] = $this->data['Activity']['full_start_time'];
				$this->data['Activity']['local_end'] = $this->data['Activity']['full_end_time'];
				
				//Convert back to UTC
				$this->data['Activity']['full_start_time'] = $this->Common->serverTime($_SESSION['Auth']['User']['timezone'],$this->data['Activity']['full_start_time']);
				$this->data['Activity']['full_end_time'] =  $this->Common->serverTime($_SESSION['Auth']['User']['timezone'],$this->data['Activity']['full_end_time']);
				
				if($this->data['Activity']['rating'] == ""){
					$this->data['Activity']['rating'] = 0;
				}
				//echo '<pre>'; print_r($this->data); die;
				if($this->Activity->save($this->data)) {
					
					$actId = $this->Activity->getLastInsertId();
					if($this->data['Activity']['id'] != ""){
						$actId = $this->data['Activity']['id'];
					} else{
						$actId = $actId;
					}
						
					/**/
					if(!empty($this->data['Connection']['con_id'])){
						//Save participants
						//Delete All old participants
						$this->ActivityAttendy->deleteAll(array('ActivityAttendy.event_id'=>$actId),true);
												
						foreach($this->data['Connection']['con_id'] as $conKey=>$conVal){
							//Fetch Connection data
							$conData = $this->Connection->find('first',array('conditions'=>array('Connection.id'=>$conVal)));
							
							$participantArr = array();
							
							$participantArr['ActivityAttendy']['event_id'] = $actId;
							$participantArr['ActivityAttendy']['attendy_display_name'] = $conData['Connection']['name'];
							//Fetch emails
							$contactEmail = '';
                                                        foreach($conData['ConnectionEmail'] as $email):
                                                                $contactEmail = $contactEmail.$email['email'].', ';
                                                        endforeach;
                                                        $contactEmail = substr($contactEmail,0,strlen($contactEmail)-2);
							
							$participantArr['ActivityAttendy']['attendy_email'] = $contactEmail;
							$participantArr['ActivityAttendy']['connection_id'] = $conData['Connection']['id'];
							
							$this->ActivityAttendy->create();
							$this->ActivityAttendy->save($participantArr);
						}
					} 
					
					//Save Connections
					$this->ActivityAttendy->deleteAll(array('ActivityAttendy.event_id'=>$actId), true);
					$allConnectionNames = array_map('trim',explode(',',$this->data['Activity']['connection_title']));
					$allConnectionInfo = $this->Connection->find('all',array('conditions'=>array('Connection.name'=>$allConnectionNames, 'Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
					//pr($allConnectionInfo); die;
					foreach($allConnectionInfo as $row){
						
						//Emails of connection
						$contactEmail = '';
						if(!empty($row['ConnectionEmail'])) {
						
						 foreach($row['ConnectionEmail'] as $email):
							 $contactEmail = $contactEmail.$email['email'].', ';
						 endforeach;
						 $contactEmail = substr($contactEmail,0,strlen($contactEmail)-2);
						} else {
						     echo 'N/A';
						}
						
						$actConnection['ActivityAttendy']['event_id'] = $actId;
						$actConnection['ActivityAttendy']['attendy_display_name'] = $row['Connection']['name'];
						$actConnection['ActivityAttendy']['attendy_email'] = $contactEmail;
						$actConnection['ActivityAttendy']['connection_id'] = $row['Connection']['id'];
						//pr($actConnection); die;
						$this->ActivityAttendy->create();
						$this->ActivityAttendy->save($actConnection);
					}//End::Save connections
					
					$this->Session->setFlash('Activity has been saved successfully.', 'default', array('class' => 'flash_success'));
					$this->redirect(array('controller'=>'timelines','action'=>'index',base64_encode($_SESSION['Auth']['User']['id'])));
				}
				
			} else{
				$errorArray = $this->Activity->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	/** 
	@function : admin_activity_types 
	@description : listing of Activity types,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 12, 2012
	*/
	
	function admin_activity_types(){
		//pr($this->data); die;
		if((isset($this->data["ActivityType"]["setStatus"])))
		{
			//echo 'hi'; die;
			$status = ife($_POST['active'],1,0);
			$record = $this->data["ActivityType"]["Record"];
			$CheckedList=$_POST['box1'];
			$controller= $this->params['controller'];
			$action='activity_types'; 
			$prefix='admin';
			$model='ActivityType';
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
					$criteria .= " and (ActivityType.title LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and ActivityType.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and ActivityType.status = '".$matchshow."'";
					$this->set('show',$show);
				}
			}
			
		}
		
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','Activity Types');
		
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
				'ActivityType.id' => 'DESC'
			)
		);
		
		$this->set('pagetitle',"Activity Types");                
		$this->set('activityTypeList', $this->paginate('ActivityType',$criteria));
		//pr($this->paginate('ConnectionGroup',$criteria)); die;
	}
	
	
	/*
	Function Name: admin_list_activities
	params: NULL
	Created BY:Sandeep Verma
	Created ON : Dec. 12, 2012
	Description : for the listing connection in a group - Admin Panel
	*/
	function admin_list_activities($id) {
	    $this->layout='admin';
	    $id = base64_decode($id);
	    $this->set('pagetitle',"Activities list");
	    $this->paginate=array('order'=>'Activity.id ASC','limit'=>20,'recursive'=>2);
	    $activityLists = $this->paginate('Activity',array('Activity.activity_type_id '=>$id));
	    $this->set('activityLists', $activityLists);
	    //pr($activityLists); die;
	     
	}

	
	/**
	@function:admin_add_activity_type 
	@description		Add connection group from admin panel
	@Created by: 		Sandeep Verma
	@Modify:		NULL
	@Created Date:		Dec. 12, 2012
	*/
	function admin_add_activity_type($id=null){ 
  		$id = base64_decode($id);
		$this->layout = 'admin';	
  		//App::import('Model','EmailTemplate');
      		//$this->EmailTemplate = & new EmailTemplate();
		
		$this->set('pagetitle',"Add Activity Type");
		$this->ActivityType->id = $id;
		$admin_id=0;
		if(empty($this->data)){
			$this->data = $this->ActivityType->read();
		}else if(!empty($this->data)){	
			$this->ActivityType->set($this->data);
			if($this->ActivityType->validates()){
				
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
	
				$this->data['ActivityType']['title'] = ucwords(strtolower($this->data['ActivityType']['title']));
				$this->data['ActivityType']['status'] = '1';

				if($this->ActivityType->save($this->data)) {
					$this->Session->setFlash('Group has been saved successfully.','default',array('class'=>'message/green'));
					$this->redirect('activity_types');
				}
				
			} else{
				$errorArray = $this->ActivityType->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	/*
	Function Name: delete_activity_type
	Params: NULL
	Created BY: Vikas Uniyal
	Created ON : Dec. 14, 2012
	Description : To delete Connection 
	*/
	function admin_delete_activity_type($id=null){
	    $id = base64_decode($id);
	    
	    $this->ActivityType->id = $id;
	    $this->ActivityType->delete($id,true);
            $this->Session->setFlash('Activity type deleted sucessfully.','message/green');
            $this->redirect($this->referer());
        }
	
	/*
	Function Name: export_activities	
	Params: NULL
	Created BY: Maneesh Garg
	Created ON : Dec. 14, 2012
	Description : To Export Activities 
	*/
	function export_activities() {
	     $csv_output = "";
             $csv_output .= "Title;Description;Activity-Type-Title;Activity-Type-Description;Start-Time;End-Time;Rating;Created;\n";
	     //pr($all_activities); exit;
	     $all_activities = $this->Activity->find('all', array('condition'=>array('Activity.activity_owner'=>$_SESSION['Auth']['User']['id']))); 
             foreach($all_activities as $faq){
                $csv_output .= "\"".$faq['Activity']['title']."\"".";";
		$csv_output .= "\"".$faq['Activity']['description']."\"".";";
		$csv_output .= "\"".$faq['ActivityType']['title']."\"".";";
		$csv_output .= "\"".$faq['ActivityType']['description']."\"".";";
		$csv_output .= "\"".$faq['Activity']['start_time']."\"".";";
		$csv_output .= "\"".$faq['Activity']['end_time']."\"".";";
		$csv_output .= "\"".$faq['Activity']['rating']."\"".";";
                $csv_output .= "\"".$faq['Activity']['created']."\""."\n";
		
             }
		$filename = 'test';
		header("Content-type: application/vnd.ms-excel");
		header("Content-disposition: csv" . date("Y-m-d") . ".csv");
		header( "Content-disposition: filename=".$filename.".csv");
		print $csv_output;
		exit;
	}
	
	
	/**
	@function:edit_event 
	@description		edit_event
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Feb. 7, 2013
	*/
	function edit_event($id=null){
		//Configure::write('debug', 0);
  		$id = base64_decode($id);
		$this->set(compact('id'));
		$this->layout = 'inner_pages';	
  		
		$this->set('pagetitle',"Edit Event");
		$this->CalendarEvent->id = $id;
		$admin_id=0;
		$activityTypes = $this->ActivityType->find('list', array('conditions'=>array('status'=>1)));
		$this->set(compact('activityTypes'));
		
		$allCon = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id'],'Connection.status'=>1),'fields'=>array('Connection.id','Connection.name')));
		$this->set(compact('allCon'));
		
		$autoCompleteConList_first = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'Connection.created DESC'));
		$autoCompleteConList = array();
		foreach($autoCompleteConList_first as $listKey=>$listVal){
			$autoCompleteConList[] = str_replace('"','',$listVal);
		}
		//unset($autoCompleteConList[725]);
		$autoCompleteConList = '"'.implode('","', $autoCompleteConList).'"';
		//echo $autoCompleteConList; exit;
		$this->set(compact('autoCompleteConList'));
		
		if(empty($this->data)){
			$this->data = $this->CalendarEvent->read();
			//pr($this->data); die;
			$this->set('rating', $this->data['CalendarEvent']['rating']);
			$this->set('stTime', $this->data['CalendarEvent']['local_start']);
			$this->set('endTime', $this->data['CalendarEvent']['local_end']);
			
			//$sharedWithConnectionIds = $this->EventAttendy->find('list',array('conditions'=>array('EventAttendy.event_id'=>$this->data['CalendarEvent']['id']), 'fields'=>('attendy_display_name')));
			$connectionNames = $this->EventAttendy->find('list',array('conditions'=>array('EventAttendy.event_id'=>$this->data['CalendarEvent']['id']), 'fields'=>('attendy_display_name')));
			//pr($connectionNames); exit;
			$this->set(compact('connectionNames'));
			
			//set array of participant ids
			if($id != ""){
				$allPartArr = array();
				foreach($this->data['EventAttendy'] as $pRow){
					$allPartArr[] = $pRow['connection_id'];	
				}
				$this->set(compact('allPartArr'));
			}
			//pr($allPartArr); die;
			//die(pr($this->data));
		}else if(!empty($this->data)){
			//pr($this->data); die;
			
			$this->CalendarEvent->set($this->data);
			if($this->CalendarEvent->validates()){
				//pr($this->data); die;
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
	
				$this->data['CalendarEvent']['title'] = ucwords(strtolower($this->data['CalendarEvent']['title']));
				
				$this->data['CalendarEvent']['start_time'] = $this->data['CalendarEvent']['st_time'].' '.$this->data['CalendarEvent']['start_time_slot'];
				$this->data['CalendarEvent']['end_time'] = $this->data['CalendarEvent']['en_time'].' '.$this->data['CalendarEvent']['end_time_slot'];
				
				
				$stDate = explode('/',$this->data['CalendarEvent']['start_date']);
				$this->data['CalendarEvent']['start_time'] = $stDate[2].'-'.$stDate[0].'-'.$stDate[1].' '.date('H:i:s',strtotime($this->data['CalendarEvent']['start_time']));
				$endDate = explode('/',$this->data['CalendarEvent']['end_date']);
				$this->data['CalendarEvent']['end_time'] = $endDate[2].'-'.$endDate[0].'-'.$endDate[1].' '.date('H:i:s',strtotime($this->data['CalendarEvent']['end_time']));
				
				
				$this->data['CalendarEvent']['local_start'] = $this->data['CalendarEvent']['start_time'];
				$this->data['CalendarEvent']['local_end'] = $this->data['CalendarEvent']['end_time'];
				
				//UTC time
				$this->data['CalendarEvent']['start_time'] = $this->Common->serverTime($_SESSION['Auth']['User']['timezone'],$this->data['CalendarEvent']['start_time']);
				$this->data['CalendarEvent']['end_time'] = $this->Common->serverTime($_SESSION['Auth']['User']['timezone'],$this->data['CalendarEvent']['end_time']);
				
				//pr($this->data); die;
				$this->data['CalendarEvent']['is_edited'] = 1;
				$this->data['CalendarEvent']['confirm'] = 1; 
				if($this->CalendarEvent->save($this->data)) {
					
					$actId = $this->Activity->getLastInsertId();
					if($this->data['CalendarEvent']['id'] != ""){
						$actId = $this->data['CalendarEvent']['id'];
					} else{
						$actId = $actId;
					}
					
					//Save Connections
					$this->EventAttendy->deleteAll(array('EventAttendy.event_id'=>$actId), true);
					$allConnectionNames = array_map('trim',explode(',',$this->data['CalendarEvent']['connection_title']));
					$allConnectionInfo = $this->Connection->find('all',array('conditions'=>array('Connection.name'=>$allConnectionNames, 'Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
					//echo '<pre>'; print_r($allConnectionInfo); die;
					foreach($allConnectionInfo as $row){
						
						//Emails of connection
						$contactEmail = '';
						if(!empty($row['ConnectionEmail'])) {
						
						 foreach($row['ConnectionEmail'] as $email):
							 $contactEmail = $contactEmail.$email['email'].', ';
						 endforeach;
						 $contactEmail = substr($contactEmail,0,strlen($contactEmail)-2);
						} else {
						     echo 'N/A';
						}
						
						$actConnection['EventAttendy']['event_id'] = $actId;
						$actConnection['EventAttendy']['attendy_display_name'] = $row['Connection']['name'];
						$actConnection['EventAttendy']['attendy_email'] = $contactEmail;
						$actConnection['EventAttendy']['connection_id'] = $row['Connection']['id'];
						//echo '<pre>'; print_r($actConnection); die;
						$this->EventAttendy->create();
						$this->EventAttendy->save($actConnection);
					}//End::Save connections
					
					$this->Session->setFlash('Event has been edited successfully.', 'default', array('class' => 'flash_success'));
					$_SESSION['filter_model'] == 'all';
					$this->redirect(array('controller'=>'timelines','action'=>'index',base64_encode($_SESSION["Auth"]["User"]["id"])));
				}
				
			} else{
				$errorArray = $this->Activity->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	/**
	@function:edit_email 
	@description		Edit email
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Feb. 07, 2013
	*/
	function edit_email($id=null){
		//Configure::write('debug', 0);
  		$id = base64_decode($id);
		$this->set(compact('id'));
		$this->layout = 'inner_pages';	
  		
		$this->set('pagetitle',"Edit Email");
		$this->ImportEmail->id = $id;
		$admin_id=0;
		$activityTypes = $this->ActivityType->find('list', array('conditions'=>array('status'=>1)));
		$this->set(compact('activityTypes'));
		
		$allCon = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id'],'Connection.status'=>1),'fields'=>array('Connection.id','Connection.name')));
		$this->set(compact('allCon'));
		
		if(empty($this->data)){
			$this->data = $this->ImportEmail->read();
			//pr($this->data); die;
			$this->set('rating', $this->data['ImportEmail']['rating']);
			$this->set('stTime', $this->data['ImportEmail']['email_date']);
			//$this->set('endTime', $this->data['ImportEmail']['end_time']);
			
			//set array of participant ids
			if($id != ""){
				$allPartArr = array();
				foreach($this->data['EventAttendy'] as $pRow){
					$allPartArr[] = $pRow['connection_id'];	
				}
				$this->set(compact('allPartArr'));
			}
			//pr($allPartArr); die;
			
		}else if(!empty($this->data)){
			//pr($this->data); die;
			$this->CalendarEvent->set($this->data);
			if($this->CalendarEvent->validates()){
				//pr($this->data); die;
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
	
				$this->data['ImportEmail']['email_subject'] = ucwords(strtolower($this->data['ImportEmail']['email_subject']));
				
				$this->data['ImportEmail']['start_time'] = $this->data['ImportEmail']['st_time'].' '.$this->data['ImportEmail']['start_time_slot'];
				
				$stDate = explode('/',$this->data['ImportEmail']['start_date']);
				$this->data['ImportEmail']['email_date'] = $stDate[2].'-'.$stDate[0].'-'.$stDate[1].' '.date('H:i:s',strtotime($this->data['ImportEmail']['start_time']));
				
				//pr($this->data); die;
				$this->data['ImportEmail']['is_edited'] = 1;
				$this->data['ImportEmail']['confirm'] = 1;
				if($this->ImportEmail->save($this->data)) {
					
					$this->Session->setFlash('Email has been edited successfully.', 'default', array('class' => 'flash_success'));
					$_SESSION['filter_model'] == 'all';
					$this->redirect(array('controller'=>'timelines','action'=>'index',$_SESSION["Auth"]["User"]["id"]));
				}
				
			} else{
				$errorArray = $this->Activity->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
    
  }//end class
?>