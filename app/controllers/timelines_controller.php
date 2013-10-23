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
class TimelinesController extends AppController{

	var $name 	= 'Timelines';
	var $uses 	= array('Timeline','Message','ImportEmail','CalendarEvent','EventAttendy','ConnectionCoverage','ActivityPerformance','ScheduleBalance','Mission','UserReflection','LifeValueDetail', 'LifeValue','StrengthValue','CoreValue','User','Setting','Activity','ActivityType','Connection','ConnectionGroup','ConnectionPhone','ConnectionEmail','ConnectionAddress','ConGroupRelation','Communication');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('GoogleCal','RequestHandler','Cookie','Email','Auth','Upload','Common','Import');
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(($this->params['action'] != 'admin_login') && (@$this->params['prefix'] == 'admin'))
		{
		    $this->Auth->allow('sign_up','export_alldata');
		} else {
		       $this->Auth->allow('export_alldata');
		}
	    
	    }
	
	
	/** 
	@function : index 
	@description : list all entities
	@params : NULL
	@Created by :Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 14, 2012
	*/ 
	function index($id=null,$event_type=null){
		$userDateTime = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
		//pr($_SESSION); die;
		$this->loadModel('User');
		$date = $this->User->find('first',array('fields'=>array('User.last_timeline_update'),'conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id'])));
		$this->set('date',$date['User']['last_timeline_update']);
		$id = base64_decode($id);
		$this->set('heading','Settings');
		$this->loadModel('CalendarEvent');
		$this->loadModel('Timeline');
	
		if($this->data['Timeline']['entity_type'] != ""){ 
			$_SESSION['filter_model'] = $this->data['Timeline']['entity_type'];
		}
		if(($event_type == 'rated') AND ($_SESSION['Rating']['activity_type'] == "Reflection")){
			$_SESSION['filter_model'] = 'UserReflection';
		}
		if(($event_type == 'rated') AND ($_SESSION['Rating']['activity_type'] == "All")){
			$_SESSION['filter_model'] = '';
		}
		
		//echo 'Session: '.$_SESSION['filter_model'];
		//pr($this->data); die;
		
		if(((($_SESSION['filter_model'] != 'CalendarEvent') && (empty($this->data))) && (($_SESSION['filter_model'] != 'Activity') && (empty($this->data))) && (($_SESSION['filter_model'] != 'UserReflection') && (empty($this->data))) && (($_SESSION['filter_model'] != 'ImportEmail') && (empty($this->data))) && (($_SESSION['filter_model'] != 'Mission') && (empty($this->data)))) || ($_SESSION['filter_model'] == 'all')) {
			//set missions and place it in other to elseif blocks
			$this->Mission->unbindModel(array('belongsTo'=>array('Sponsor','Owner'), 'hasMany'=>array('MissionUser','Milestone','KeyToSuccess','MissionConnection')));
			$missionFields = array('Mission.id','Mission.title','Mission.description','Mission.start_time','Mission.end_time','Mission.rating','Mission.created');
			$missionDetail = $this->Mission->find('first',array('conditions'=>array('Mission.owner'=>$id,'Mission.start_time <='=>$userDateTime),'fields'=>$missionFields));
			$this->set(compact('missionDetail'));
			$mission_arr = array();
			//pr($missionDetail); die;
			if(!empty($missionDetail))
			{ //$mission_cnt = 0;
				//foreach($missionDetail as $mission_list)
				//{ 
					$mission_arr[0]['model_name']='Mission';
					$mission_arr[0]['id']=$missionDetail['Mission']['id'];
					$mission_arr[0]['title']=$missionDetail['Mission']['title'];
					$mission_arr[0]['description']=$missionDetail['Mission']['description'];
					$mission_arr[0]['start_time']=$missionDetail['Mission']['start_time'];
					$mission_arr[0]['end_time']=$missionDetail['Mission']['end_time'];
					$mission_arr[0]['rating']=$missionDetail['Mission']['rating'];
					$mission_arr[0]['created']=$missionDetail['Mission']['created'];
					$mission_arr[0]['is_read']=1;
					
				//$mission_cnt++;
				//}
			}
			
			//set activities and place it in other to elseif blocks
			$this->Activity->unbindModel(array('belongsTo'=>array('ActivityType'), 'hasMany'=>array('ActivityAttendy')));
			$actFields = array('Activity.id','Activity.title','Activity.description','Activity.local_start','Activity.local_end','Activity.rating','Activity.created');
			$activityList = $this->Activity->find('all',array('conditions'=>array('Activity.activity_owner'=>$id,'Activity.local_start <='=>$userDateTime),'fields'=>$actFields,'order'=>'Activity.created DESC'));
			$this->set(compact('activityList'));
			//pr($activityList); die; 
			$act_arr = array();
			if(!empty($activityList))
			{ $act_cnt = 0;
				foreach($activityList as $act_list)
				{ 
					$act_arr[$act_cnt]['model_name']='Activity';
					$act_arr[$act_cnt]['id']=$act_list['Activity']['id'];
					$act_arr[$act_cnt]['title']=$act_list['Activity']['title'];
					$act_arr[$act_cnt]['description']=$act_list['Activity']['description'];
					$act_arr[$act_cnt]['start_time']=$act_list['Activity']['local_start'];
					$act_arr[$act_cnt]['end_time']=$act_list['Activity']['local_end'];
					$act_arr[$act_cnt]['rating']=$act_list['Activity']['rating'];
					$act_arr[$act_cnt]['created']=$act_list['Activity']['created'];
					$act_arr[$act_cnt]['is_read']=1;
				$act_cnt++;
				}
			}
			//pr($act_arr); die;
			$this->UserReflection->unbindModel(array('belongsTo'=>array('User','Question_1','Question_2','Question_3'), 'hasMany'=>array('ShareReflection','ReflectionAttendy')));
			$refFields = array('UserReflection.id','UserReflection.description','UserReflection.local_reflection_date','UserReflection.reflection_date','UserReflection.rating_today','UserReflection.created');
			$recentReflections = $this->UserReflection->find('all',array('conditions'=>array('UserReflection.user_id'=>$_SESSION['Auth']['User']['id'],'UserReflection.local_reflection_date <='=>$userDateTime),'fields'=>$refFields,'order'=>'UserReflection.reflection_date DESC'));
			$this->set(compact('recentReflections'));
			//pr($recentReflections); die;
			$ref_arr = array();
			if(!empty($recentReflections))
			{ $ref_cnt = 0;
				foreach($recentReflections as $ref_list)
				{ 
					$ref_arr[$ref_cnt]['model_name']='UserReflection';
					$ref_arr[$ref_cnt]['id']=$ref_list['UserReflection']['id'];
					$ref_arr[$ref_cnt]['title']=$ref_list['UserReflection']['description'];
					$ref_arr[$ref_cnt]['description']=$ref_list['UserReflection']['description'];
					$ref_arr[$ref_cnt]['start_time']=$ref_list['UserReflection']['local_reflection_date'];
					$ref_arr[$ref_cnt]['end_time']=$ref_list['UserReflection']['reflection_date'];
					$ref_arr[$ref_cnt]['rating']=$ref_list['UserReflection']['rating_today'];
					$ref_arr[$ref_cnt]['created']=$ref_list['UserReflection']['created'];
					$ref_arr[$ref_cnt]['is_read']=1;
				$ref_cnt++;
				}
			}
			
			$this->CalendarEvent->unbindModel(array('belongsTo'=>array(), 'hasMany'=>array('EventAttendy')));
			$calFields = array('CalendarEvent.id','CalendarEvent.title','CalendarEvent.details','CalendarEvent.local_start','CalendarEvent.local_end','CalendarEvent.rating','CalendarEvent.created','CalendarEvent.event_id');
			$calendarEvents = $this->CalendarEvent->find('all',array('conditions'=>array('CalendarEvent.user_id'=>$_SESSION['Auth']['User']['id'],'CalendarEvent.local_start <='=>$userDateTime),'fields'=>$calFields,'order'=>'CalendarEvent.created DESC'));
			$this->set(compact('calendarEvents'));
			//pr($calendarEvents); die;
			$event_arr = array();
			if(!empty($calendarEvents))
			{ $event_cnt = 0; $duplicateEventArr = array();
				foreach($calendarEvents as $event_list)
				{
					if(in_array($event_list['CalendarEvent']['event_id'],$duplicateEventArr) == false){
						$event_arr[$event_cnt]['model_name']='CalendarEvent';
						$event_arr[$event_cnt]['id']=$event_list['CalendarEvent']['id'];
						$event_arr[$event_cnt]['title']=$event_list['CalendarEvent']['title'];
						$event_arr[$event_cnt]['description']=$event_list['CalendarEvent']['details'];
						$event_arr[$event_cnt]['start_time']=$event_list['CalendarEvent']['local_start'];
						$event_arr[$event_cnt]['end_time']=$event_list['CalendarEvent']['local_end'];
						$event_arr[$event_cnt]['rating']=$event_list['CalendarEvent']['rating'];
						$event_arr[$event_cnt]['created']=$event_list['CalendarEvent']['created'];
						$event_arr[$event_cnt]['is_read']=1;
					$event_cnt++; $duplicateEventArr[] = $event_list['CalendarEvent']['event_id'];
					}
				}
			}
			
			$this->ImportEmail->unbindModel(array('belongsTo'=>array(), 'hasMany'=>array()));
			$emailFields = array('ImportEmail.id','ImportEmail.email_subject','ImportEmail.local_email_date','ImportEmail.rating','ImportEmail.created','ImportEmail.is_read','ImportEmail.email_uid');
			$allEmails = $this->ImportEmail->find('all',array('conditions'=>array('ImportEmail.user_id'=>$_SESSION['Auth']['User']['id'],'ImportEmail.local_email_date <='=>$userDateTime),'fields'=>$emailFields,'order'=>'ImportEmail.created DESC'));
			$this->set(compact('allEmails'));
			//pr($allEmails); 
			$email_arr = array();
			if(!empty($allEmails))
			{ $email_cnt = 0; $duplicateEmailArr = array();
				foreach($allEmails as $email_list)
				{
					if(in_array($email_list['ImportEmail']['email_uid'],$duplicateEmailArr) == false){
						$email_arr[$email_cnt]['model_name']='ImportEmail';
						$email_arr[$email_cnt]['id']=$email_list['ImportEmail']['id'];
						$email_arr[$email_cnt]['title']=$email_list['ImportEmail']['email_subject'];
						$email_arr[$email_cnt]['description']='N/A';
						$email_arr[$email_cnt]['start_time']=$email_list['ImportEmail']['local_email_date'];
						$email_arr[$email_cnt]['end_time']=$email_list['ImportEmail']['local_email_date'];
						$email_arr[$email_cnt]['rating']=$email_list['ImportEmail']['rating'];
						$email_arr[$email_cnt]['created']=$email_list['ImportEmail']['created'];
						$email_arr[$email_cnt]['is_read']=$email_list['ImportEmail']['is_read'];
					$email_cnt++; $duplicateEmailArr[] = $email_list['ImportEmail']['email_uid'];
					}
				}
			}
			//pr($duplicateEmailArr);
			//pr($email_arr); die;
			//$allMessages = $this->Message->find('all',array('conditions'=>array('Message.to_user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'Message.created DESC'));
			//$this->set(compact('allMessages'));
			$save_timeline_act = array();
			$save_timeline_act = array_merge($mission_arr,$act_arr,$ref_arr,$event_arr,$email_arr);
			$save_timeline_act = Set::sort($save_timeline_act,'{n}.start_time','desc');
			
			//pr($save_timeline_act); die;
			
			
			//Delete all old timeline data for user from tmp table
			$this->Timeline->deleteAll(array('Timeline.user_id'=>$_SESSION['Auth']['User']['id']));
			//Save new data to temp table
			$timeLineData = array();
			foreach($save_timeline_act as $row){
				$timeLineData['Timeline']['user_id'] = $_SESSION['Auth']['User']['id'];
				$timeLineData['Timeline']['model_name'] = $row['model_name'];
				$timeLineData['Timeline']['entity_id'] = $row['id'];
				$timeLineData['Timeline']['title'] = $row['title'];
				$timeLineData['Timeline']['description'] = $row['description'];
				$timeLineData['Timeline']['start_date'] = $row['start_time'];
				$timeLineData['Timeline']['end_date'] = $row['end_time'];
				$timeLineData['Timeline']['rating'] = $row['rating'];
				$timeLineData['Timeline']['created'] = $row['created'];
				$timeLineData['Timeline']['is_read'] = $row['is_read'];
				
				$this->Timeline->create();
				$this->Timeline->save($timeLineData);
			}
			
			if($event_type != 'rated'){	
				$this->paginate = array(
					'limit' => 30,
					'order' => array(
						'Timeline.start_date' => 'DESC'
					)
				);
				$conditions = array('Timeline.user_id'=>$_SESSION['Auth']['User']['id']);
			}else{ //Rated events only
				$this->set('event_type','rated');
				$this->paginate = array(
				'limit' => 30,
				'order' => array(
					'Timeline.rating' => 'DESC'
				)
				);
				$conditions = array('Timeline.user_id'=>$_SESSION['Auth']['User']['id'],'Timeline.rating <>'=>0,'Timeline.start_date BETWEEN ? AND ?'=>array($_SESSION['Rating']['start_date'],$_SESSION['Rating']['end_date']));
			}
			$all_timeline_act = $this->paginate('Timeline',$conditions);
			$this->set(compact('all_timeline_act'));
			//pr($all_timeline_act); die;
			
		} else { //echo 2; die;
			//echo $_SESSION["filter_model"]; die;
			$all_timeline_act = array();
			
			if($event_type != 'rated'){
				$this->paginate = array(
					'limit' => 30,
					'order' => array(
						'Timeline.start_date' => 'DESC'
					),
					'conditions'=>array('Timeline.model_name'=>$_SESSION["filter_model"],'Timeline.user_id'=>$_SESSION["Auth"]["User"]["id"]),
				);
			}else{
				$this->set('event_type','rated');
				$this->paginate = array(
					'limit' => 30,
					'order' => array(
						'Timeline.rating' => 'DESC'
					),
					'conditions'=>array('Timeline.model_name'=>$_SESSION["filter_model"],'Timeline.user_id'=>$_SESSION["Auth"]["User"]["id"],'Timeline.rating <>'=>0,'Timeline.start_date BETWEEN ? AND ?'=>array($_SESSION['Rating']['start_date'],$_SESSION['Rating']['end_date'])),
				);
			}	
				$all_timeline_act = $this->paginate('Timeline');
				$this->set(compact('all_timeline_act'));
			
			$all_timeline_act = Set::sort($all_timeline_act,'{n}.start_time','asc');
			//pr($all_timeline_act); die;
			$this->set(compact('all_timeline_act'));
		}
		$logged_id_user = $this->User->find('first',array('conditions'=>array('User.id'=>$_SESSION['Auth']['User']['id'])));
		$latestEntities = array();
		foreach($all_timeline_act as $act){ 
			if(strtotime($logged_id_user['User']['last_accessed']) <= strtotime($act['created'])){
				$latestEntities[] = $act;
			}
		}
		
		$this->Session->write('Timeline.last_updated',sizeof($latestEntities));
		if($this->RequestHandler->isAjax()==0)
			$this->layout = 'individual_dashboard';
		else
			$this->layout = 'ajax';
		
		$this->set('pagetitle',"Timeline");
		//pr($all_timeline_act); die;
		//$this->set('activityList', $this->paginate('Settings',$criteria));
	}
	
	
	/** 
	@function : update_ratings 
	@description : Update rating of an activity,
	@params : NULL
	@Created by : Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 17, 2012
	*/
	function update_ratings($model=NULL, $activity_id=NULL, $rating=NULL) {
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';	
			$this->data[$model]['id'] = $activity_id;
			if($model == 'UserReflection'){
				$this->data[$model]['rating_today'] = $rating;
			} else {
				$this->data[$model]['rating'] = $rating;	
			}
			
			if($this->$model->save($this->data)) {
				echo json_encode('Rating Update Successfully');
				exit;
			}else{
				echo json_encode('Please try again');
				exit;
			}
		}
	}
	     
	     
		
	
	/** 
	@function : email_detail 
	@description : list all activities
	@params : NULL
	@Created by :Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 14, 2012
	*/ 
	function email_detail($id){
	
		$id = base64_decode($id);
		$this->set('heading','Email detail');
		//pr($this->data); exit;
		//echo $entity; exit;
		if($id != NULL) {
			$emailDetails = $this->ImportEmail->find('first',array('conditions'=>array('ImportEmail.id'=>$id)));
			$this->set(compact('emailDetails'));
		
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
	}
	
	/** 
	@function : event_detail 
	@description : event_detail
	@params : NULL
	@Created by :Vikas Uniyal		
	@Modify : NULL
	@Created Date : Feb. 06, 2013
	*/ 
	function event_detail($id){
	
		$id = base64_decode($id);
		$this->layout = 'individual_dashboard';
		$this->set('pagetitle',"Event Detail");
		//pr($this->data); exit;
		//echo $entity; exit;
		if($id != NULL) {
			$eventDetails = $this->CalendarEvent->find('first',array('conditions'=>array('CalendarEvent.id'=>$id)));
			$this->set(compact('eventDetails'));
			//pr($eventDetails); die;
		} 
	}
	
	/** 
	@function : message_detail 
	@description : list all activities
	@params : NULL
	@Created by :Sandeep Verma
	@Modify : NULL
	@Created Date : Dec. 14, 2012
	*/ 
	function message_detail($id){
	
		$id = base64_decode($id);
		$this->set('heading','Message Detail');
		//pr($this->data); exit;
		//echo $entity; exit;
		if($id != NULL) {
			
			$messageDetail = $this->Message->find('first',array('conditions'=>array('Message.id'=>$id)));
			$this->set(compact('messageDetail'));
		
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
	}
	
	
	
	/*
	Function Name: delete_record
	Params: NULL
	Description: Delete records from timeline
	Created BY: Vikas Uniyal
	Created ON : Jan. 22, 2013
	*/
	function delete_record($model=null,$id=null){
	    $id = base64_decode($id);
	    $this->$model->id = $id;
	    $item_info = $this->$model->find('first',array('conditions'=>array($model.'.id'=>$id)));
	    //pr($item_info);
	    $this->loadModel('DeletedItem');
	    $delItem = array();
	    $delItem['DeletedItem']['user_id'] = $item_info[$model]['user_id'];
	    if($model == 'CalendarEvent'){
		$delItem['DeletedItem']['item_id'] = $item_info[$model]['event_id'];
		$delItem['DeletedItem']['item_type'] = 'calendar';
	    } else{
		$delItem['DeletedItem']['item_id'] = $item_info[$model]['email_uid'];
		$delItem['DeletedItem']['item_type'] = 'email';
	    }
	    //pr($delItem);
	    //Save the item in vimbli table so that it will not sync again.
	    $this->DeletedItem->save($delItem);

	    $this->$model->delete($id,true);
	    $this->Timeline->deleteAll(array('Timeline.user_id'=>$_SESSION['Auth']['User']['id'],'Timeline.model_name'=>$model,'Timeline.entity_id'=>$id));
            $this->Session->setFlash('Record deleted','default',array('class'=>'flash_success'));
            $this->redirect($this->referer());
        }
	
	
	/*
	Function Name: delete_bulk_record
	Params: NULL
	Description: Delete records from timeline
	Created BY: Vikas Uniyal
	Created ON : Jan. 22, 2013
	*/
	function delete_bulk_record($mixId=null){
		$this->layout = "ajax";
		$this->autoRender = false;
		//$mixId=$_GET(data);
		$mixIdArr = array_filter(explode(",", $mixId));
		//pr($mixIdArr); die;
	    //Write the following code in loop for each ID
	    foreach($mixIdArr as $mix) {
		$mixArr=explode('_',$mix);
		
		$model = trim($mixArr[0]);
		$id = trim($mixArr[1]);
		//pr($id);
		
		$this->$model->id = $id;
		$item_info = $this->$model->find('first',array('conditions'=>array($model.'.id'=>$id),'recursive'=>-1));
		
		if(!empty($item_info)) { 
			$this->loadModel('DeletedItem');
			 $delItem = array();
				if($model == 'CalendarEvent'){
				    $delItem['DeletedItem']['item_id'] = $item_info[$model]['id'];
				    $delItem['DeletedItem']['user_id'] = $_SESSION['Auth']['User']['id'];   
				    $delItem['DeletedItem']['item_type'] = 'calendar';
				} elseif($model == 'Misssion'){
				    $delItem['DeletedItem']['user_id'] = $_SESSION['Auth']['User']['id'];   
				    $delItem['DeletedItem']['item_id'] = $item_info[$model]['id'];
				    $delItem['DeletedItem']['item_type'] = 'mission';
				}elseif($model == 'UserReflection'){
				   $delItem['DeletedItem']['user_id'] = $_SESSION['Auth']['User']['id'];   
				    $delItem['DeletedItem']['item_id'] = $item_info[$model]['id'];
				    $delItem['DeletedItem']['item_type'] = 'reflection';
				}elseif($model == 'Activity'){
				   $delItem['DeletedItem']['user_id'] = $_SESSION['Auth']['User']['id'];   
				    $delItem['DeletedItem']['item_id'] = $item_info[$model]['id'];
				    $delItem['DeletedItem']['item_type'] = 'activity';
				}
			$this->DeletedItem->save($delItem);
			//pr($delItem);die;
			
		} 
		$this->$model->delete($id,true);
		$this->Timeline->deleteAll(array('Timeline.user_id'=>$_SESSION['Auth']['User']['id'],'Timeline.model_name'=>$model,'Timeline.entity_id'=>$id));
		$this->Session->setFlash('Record(s) deleted','default',array('class'=>'flash_success'));
	    }
        }
	
	/*
	Function Name: confirm_bulk_record
	Params: NULL
	Description: confirm records from timeline
	Created BY: Vikas Uniyal
	Created ON : Jan. 22, 2013
	*/
	function confirm_bulk_record($mixId=null){
		$this->layout = "ajax";
		$this->autoRender = false;
		$this->loadModel('CalendarEvent');
		$this->loadModel('ImportEmail');
		$this->loadModel('Activity');
		$this->loadModel('UserReflection');
		$this->loadModel('Mission');
		$mixId = array_filter(explode(",", $mixId));
		//pr($mixId); die;
	    //Write the following code in loop for each ID
	    foreach($mixId as $mix) {
		$mix=explode('_',$mix);
		//pr($mix);
		$model = $mix[0];
		$id = $mix[1];
		$this->$model->id = $id;
		//pr($model); 
		//pr($id); 
		$item_info = $this->$model->find('first',array('conditions'=>array($model.'.id'=>$id),'recursive'=>-1));
		$this->loadModel('Activity');
		if(!empty($item_info)) {
			//pr($item_info); die; 	
			
		 $delItem = array();
		  
			if($model == 'CalendarEvent'){
				//	$delItem['CalendarEvent']['user_id'] = $item_info[$model]['user_id'];
				//	pr($delItem['CalendarEvent']['user_id']); die;
				    $delItem['CalendarEvent']['confirm'] = 1;
				    $this->CalendarEvent->save($delItem);
				} elseif($model == 'ImportEmail'){
				// $delItem['ImportEmail']['user_id'] = $item_info[$model]['user_id'];  
				  $delItem['ImportEmail']['confirm'] = 1;
				 $this->ImportEmail->save($delItem);
				}elseif($model == 'Activity'){
				// $delItem['Activity']['user_id'] = $item_info[$model]['user_id']; 
				  $delItem['Activity']['confirm'] = 1;
				  $this->Activity->save($delItem);
				}elseif($model == 'UserReflection'){
				// $delItem['UserReflection']['user_id'] = $item_info[$model]['user_id'];  	
				 $delItem['UserReflection']['confirm'] = 1;
				  $this->UserReflection->save($delItem);
				}elseif($model == 'Mission'){
			
				// $delItem['Mission']['user_id'] = $item_info[$model]['user_id'];
				 	
				  $delItem['Mission']['confirm'] = 1;
				 // pr($delItem['Mission']['confirm']); die;
				
				  $this->Mission->save($delItem);
				}
		}//pr($delItem['Mission']['confirm']); die;
	    }
	    $this->Session->setFlash('Record(s) confirmed','default',array('class'=>'flash_success'));
        }
	
	
	function confirm_edit($mixId=null){
		//pr($mixId); die;
		$this->layout = "";
		$this->autoRender = false;
		$mixId = array_filter(explode(",", $mixId));
		//pr($mixId); die;
	    //Write the following code in loop for each ID
	    foreach($mixId as $mix) {
		$mix=explode('_',$mix);
		//pr($mix);die;
		$model = $mix[0];
		$id = $mix[1];
		//pr($model);
		//pr($id);die;
		$this->$model->id = $id;
		
		$this->loadModel('CalendarEvent');
		$this->loadModel('ImportEmail');
		$this->loadModel('Activity');
		$this->loadModel('UserReflection');
		$this->loadModel('Activity');
		 $delItem = array();
		  
			if($model == 'CalendarEvent'){
				//$delItem['CalendarEvent']['user_id'] = $item_info[$model]['user_id'];
				$item_info = $this->$model->find('first',array('conditions'=>array($model.'.id'=>$id),'recursive'=>-1));
				if($item_info[$model]['confirm']==1){
					return 1;
				}else{
					return 0;	
					}
			} elseif($model == 'ImportEmail'){
				$item_info = $this->$model->find('first',array('conditions'=>array($model.'.id'=>$id),'recursive'=>-1));
					if($item_info[$model]['confirm']==1){
						return 1;
					}else{
						return 0;	
					}
			}elseif($model == 'Activity'){
				$item_info = $this->$model->find('first',array('conditions'=>array($model.'.id'=>$id),'recursive'=>-1));
					if($item_info[$model]['confirm']==1){
						return 1;
					}else{
						return 0;
					}
			}elseif($model == 'UserReflection'){
				$item_info = $this->$model->find('first',array('conditions'=>array($model.'.id'=>$id),'recursive'=>-1));
					if($item_info[$model]['confirm']==1){
						return 1;
					}else{
						return 0;	
					}
			}elseif($model == 'Mission'){
				$item_info = $this->$model->find('first',array('conditions'=>array($model.'.id'=>$id),'recursive'=>-1));
					if($item_info[$model]['confirm']==1){
						return 1;
					}else{
						return 0;	
					}
			}
	    }
	    
        }
	
	/*
	Function Name: change_confirm_status 
	Params: NULL
	Description: change confirm status 
	Created BY: Vikas Uniyal
	Created ON : Jan. 22, 2013
	*/
	function change_confirm_status($model=null,$entity_id = null){
		$this->layout = '';
		$this->autoRender = false;
		$model = base64_decode($model);
		$entity_id = base64_decode($entity_id);
		$this->loadModel('Timeline');
		$this->loadModel('CalendarEvent');
		$this->loadModel('ImportEmail');
		$this->loadModel('Activity');
		$this->loadModel('UserReflection');
		$this->loadModel('Activity');
		$timeline_data_status = $this->$model->find('first',array('conditions'=>array($model.'.id'=>$entity_id),'recursive'=>-1,'fields'=>array('confirm')));
		if($timeline_data_status[$model]['confirm'] == 0) {
			$this->data[$model]['id'] = $entity_id;
			$this->data[$model]['confirm'] = 1;
			$status = 1;
		}else{
			$this->data[$model]['id'] = $entity_id;
			$this->data[$model]['confirm'] = 0;
			$status = 0;
		}
		if($this->$model->save($this->data)){
			return $status;
		}
		
	}
	
	/** 
	@function : export_allData 
	@description : Export All data for Individual
	@params : NULL
	@Created by : Sunny chauhan
	@Modify : NULL
	@Created Date : Aug. 02, 2013
	*/
	function export_alldata($id=NULL) {
		//$id = $_SESSION['Auth']['User']['id'];
		$this->loadModel('User');
		$current_user_info = $this->User->find('first',array(
						       'conditions'=>array('User.id'=>$id),
						       'fields'=>array('User.email','User.name')
						       ));
		
		
		//pr($current_user_info); die;
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
		$data.= "\n";
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
		}
		
		$data.= "\n";
		$data.= "\n";
		$data.= "Strengths \n";
		$data.="Strength 1;Strength 2;Strength 3;Strength 4;Strength 5;Strength 6;Strength 7;Rating;Notes;Created Date \n";
		$strengths = $this->StrengthValue->find('all',array('conditions'=>array('StrengthValue.user_id'=>$id)));
		foreach($strengths as $reflection)
		{
				// converting start date to USA format
				if(!empty($reflection['StrengthValue']['created'])){
					$reflection['StrengthValue']['created'] = date('M. d Y',strtotime($reflection['StrengthValue']['created']));
				}else{
					$reflection['StrengthValue']['created'] = 'N/A';
				}
				
				// checking condition for availability of strength 1
				if(empty($reflection['StrengthValue']['1'])){
					$reflection['StrengthValue']['1'] = 'N/A';
				}
				
				// checking condition for availability of strength 2
				if(empty($reflection['StrengthValue']['2'])){
					$reflection['StrengthValue']['2'] = 'N/A';
				}
				// checking condition for availability of strength 3
				if(empty($reflection['StrengthValue']['3'])){
					$reflection['StrengthValue']['3'] = 'N/A';
				}
				// checking condition for availability of strength 4
				if(empty($reflection['StrengthValue']['4'])){
					$reflection['StrengthValue']['4'] = 'N/A';
				}
				// checking condition for availability of strength 5
				if(empty($reflection['StrengthValue']['5'])){
					$reflection['StrengthValue']['5'] = 'N/A';
				}
				// checking condition for availability of strength 6
				if(empty($reflection['StrengthValue']['6'])){
					$reflection['StrengthValue']['6'] = 'N/A';
				}
				// checking condition for availability of strength 7
				if(empty($reflection['StrengthValue']['7'])){
					$reflection['StrengthValue']['7'] = 'N/A';
				}
				
				// checking condition for availability of notes
				if(empty($reflection['StrengthValue']['notes'])){
					$reflection['StrengthValue']['notes'] = 'N/A';
				}
				
				// checking condition for availability of rating
				if(empty($reflection['StrengthValue']['rating'])){
					$reflection['StrengthValue']['rating'] = 'N/A';
				}
				
				// creating data for csv
				
				$data .= $reflection['StrengthValue']['1'].";";
				$data .= $reflection['StrengthValue']['2'].";";
				$data .= $reflection['StrengthValue']['3'].";";
				$data .= $reflection['StrengthValue']['4'].";";
				$data .= $reflection['StrengthValue']['5'].";";
				$data .= $reflection['StrengthValue']['6'].";";
				$data .= $reflection['StrengthValue']['7'].";";
				$data .= $reflection['StrengthValue']['rating'].";";
				$data .= $reflection['StrengthValue']['notes'].";";
				$data .= $reflection['StrengthValue']['created']."\n";
		}
		//pr($strengths); die;
		$data.= "\n";
		$data.= "\n";
		$data.= "Connections \n";
		$data.=" Name;Phone;Email;Group \n";
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
		}
		//pr($_SESSION['Auth']['User']['id']);die;
		$filename ="All_Data_Listing_".$id.".csv";
		//pr($_SERVER['DOCUMENT_ROOT']"/app/webroot/"); die;
		$fp = fopen('files/user'.DS.$filename,"w");
		if($fp){
			fwrite($fp,$data);
			fclose($fp);
		}
		//$path = 'http://vimbli.com/beta/files/user'.DS.$filename;
		$path = 'http://vimbli.com/timelines/export_data_after_login/'.$filename;
		//$path = SITE_URL.'timelines/export_data_after_login/'.$filename;
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
	
	public function bk_export_data(){
		$this->autoRender = false;
		$command = "php /srv/www/htdocs/app/webroot/cron_dispatcher.php /timelines/export_alldata/".$_SESSION['Auth']['User']['id'];
		exec($command."> /dev/null &");
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
			$this->redirect('http://vimbli.com/files/user'.DS.$filename);
		}
		//$this->Session->setFlash('Attachment of Your Vimbli data has been sent to Your Email.','default',array('class'=>'flash_success'));
		//$this->redirect($this->referer());
	}
  }//end class
?>