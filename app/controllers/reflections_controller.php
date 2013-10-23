<?php
/*
	* Reflection Controller class
	* PHP versions 5.1.4
	* @filesource
	* @author     Vikas Uniyal
	* @link       http://www.smartdatainc.net/
	* @version 0.0.1.3 
*/
App::import('Sanitize');
class ReflectionsController extends AppController{

	var $name 	= 'Reflections';
	var $uses 	= array('UserReflection','Connection','ConnectionGroup','ConnectionPhone','ConGroupRelation','Question','ShareReflection','ReflectionAttendy');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('RequestHandler','Cookie','Email','Common');
	 
	
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
	@description : list all connections
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 14, 2012
	*/ 
	function index($id){
		
	    $this->set('pagetitle','UserReflection');
	    $this->layout = "individual_dashboard";

	    $id = base64_decode($id);

	    $this->paginate=array('order'=>'UserReflection.reflection_date DESC','limit'=>20);
	   
	    $refLists = $this->paginate('UserReflection',array('UserReflection.user_id'=>$id));
	    $this->set('refLists', $refLists);
	    //pr($conLists); die;
	}
	
	/** 
	@function : reflection_detail
	@description : detail of reflection
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 28, 2012
	*/ 
	function reflection_detail($id){
		
		$this->set('pagetitle','Reflections');
		$this->layout = "individual_dashboard";
		
	   $id = base64_decode($id);
	    
	   $refInfo = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.id'=>$id)));
	   $this->set(compact('refInfo'));
	  
	}
	
	
	function getRefUsers($id=NULL)
	{
		$refInfo = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.id'=>$id)));
		
		$participant = '';
		foreach($refInfo["ShareReflection"] as $row):
		$allparticipants = $this->ConGroupRelation->find('all',array('conditions'=>array('ConGroupRelation.group_id'=>$row["group_id"],'Connection.user_id'=>$_SESSION["Auth"]["User"]["id"])));	   $this->set(compact('allparticipants'));
		
		foreach($allparticipants as $listOfUser):
		     $participant = $participant. $listOfUser['Connection']['name'].', ';
		endforeach;
		
		endforeach;
		$participant = substr($participant,0,strlen($participant)-2);
		return $participant = ($participant !="")?$participant:'No Participants';
		
	}
	
	
	/** 
	@function : add_reflection 
	@description : Add Reflection
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 12, 2012
	*/ 
	function add_reflection(){
		/*if(!empty($this->data)) {
			pr($this->data); die;
		} */
		$this->set('pagetitle','Add Reflection');
		$this->layout = "inner_pages";
		
		$autoCompleteConList_first = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'Connection.created DESC'));
		$autoCompleteConList = array();
		foreach($autoCompleteConList_first as $listKey=>$listVal){
			$autoCompleteConList[] = str_replace('"','',$listVal);
		}
		//echo '<pre>'; print_r($autoCompleteConList); die;
		
		$autoCompleteConList = '"'.implode('","', $autoCompleteConList).'"';
		//echo $autoCompleteConList; exit;
		$this->set(compact('autoCompleteConList'));
		//echo '<pre>'; print_r($autoCompleteConList); die;
		
		//$autoForGroups = $this->ConnectionGroup->find('list',array('conditions'=>array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),'fields'=>array('ConnectionGroup.id','ConnectionGroup.title')));
		$autoForGroups = $this->ConnectionGroup->find('list',array('conditions'=>array("OR"=>array(array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),array('ConnectionGroup.group_owner'=>$_SESSION['Auth']['User']['id'], 'ConnectionGroup.status'=>1))),'fields'=>array('ConnectionGroup.id','ConnectionGroup.title')));
		//echo '<pre>'; print_r($autoForGroups); die;
		
		$autoForGroups = '"'.implode('","', $autoForGroups).'"';
		//echo $autoCompleteConList; exit;
		$this->set(compact('autoForGroups'));
		
		
		//All group listing
		$allGroups = $this->ConnectionGroup->find('list',array('conditions'=>array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),'fields'=>array('ConnectionGroup.id','ConnectionGroup.title')));
		$this->set(compact('allGroups'));
		
		//All question listing
		if($_SESSION['Auth']['User']['manager_id'] != ""){
			$allQuestion = $this->Question->find('all',array('conditions'=>array('Question.manager_id'=>$_SESSION['Auth']['User']['manager_id'],'Question.status'=>1),'fields'=>array('Question.id','Question.question', 'Question.rating_strength','Question.frequency')));
		} else {
			$allQuestion = $this->Question->find('all',array('conditions'=>array('Question.manager_id'=>0,'Question.status'=>1),'fields'=>array('Question.id','Question.question', 'Question.rating_strength','Question.frequency')));
		}
		//pr($allQuestion); die;
		foreach($allQuestion as $que_key=>$que_val){
			if($que_val['Question']['frequency'] == 1)
				$alwaysAskQuetions[] = $que_val;
			else
				$randomQuetions[] = $que_val;
		}
		$count_alwaysAskQuestion = sizeof($alwaysAskQuetions);
		$finalQuestions = array();
		if($count_alwaysAskQuestion >= 3){ 
			$finalQuestions = $alwaysAskQuetions;
		}elseif($count_alwaysAskQuestion == 2){//echo 'here'; exit;
			$random_no = rand(1, sizeof($randomQuetions));
			$oneRandomQuestion[] = $randomQuetions[$random_no];
			$finalQuestions = array_merge($alwaysAskQuetions, $oneRandomQuestion);
		}elseif($count_alwaysAskQuestion == 1){
			$random_no = array_rand(array_keys($randomQuetions), 2);
			//pr($random_no); exit;
			$oneRandomQuestion[0] = $randomQuetions[$random_no[0]];
			$secondRandomQuestion[1] = $randomQuetions[$random_no[1]];
			$finalQuestions = array_merge($alwaysAskQuetions, $oneRandomQuestion, $secondRandomQuestion);
		}else{
			$random_no = array_rand(array_keys($randomQuetions), 3);
			//echo $random_no
			$finalQuestions = array($randomQuetions[$random_no[0]],$randomQuetions[$random_no[1]],$randomQuetions[$random_no[2]]);
		}
		
		$this->set(compact('finalQuestions'));
		
		if(!empty($this->data))
		{
		//pr($this->data); die;
		
		if(is_uploaded_file($this->data['UserReflection']['file']['tmp_name']))
		{
		    $fileName=$this->data['UserReflection']['file']['name'];
		    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
		   
		    $this->data['UserReflection']['file_name']='Reflection'.time().'.'.$ext;   
		   
		    App::import('Lib','resize');   
		    $image = new ImageResize();
       
		    move_uploaded_file($this->data['UserReflection']['file']['tmp_name'],'files/reflections/'.$this->data['UserReflection']['file_name']);
		    //$image->resize('files/reflections/original/'.$this->data['UserReflection']['image'],'files/reflections/medium/'.$this->data['Connection']['image'],'aspect_fill',160,110,0,0,0,0);
	        }
			
			$utc_date = date('Y-m-d H:i:s');
			$current_Time = date('Y-m-d', strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],$utc_date)));
			//pr($current_Time); die;
			
			$expDate = explode('/',$this->data['UserReflection']['reflection_date']);
			$db_date=$this->data['UserReflection']['reflection_date'] = $expDate[2].'-'.$expDate[1].'-'.$expDate[0];
			
			//pr($db_date);
			if($current_Time==$db_date ){
				$db_date=$utc_date;
				
				$local_ref_date = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],$utc_date);
			}else{
				$db_date=$db_date.' 23:59:59';
				
				$local_ref_date=$db_date;
			}
			//pr($db_date); die;
			
			$this->data['UserReflection']['user_id'] = $_SESSION['Auth']['User']['id'];
			$this->data['UserReflection']['captured_image'] = end(explode('/',$this->data['UserReflection']['captured_image']));
			$this->data['UserReflection']['reflection_date']=$db_date;
			$this->data['UserReflection']['local_reflection_date']=$local_ref_date;
			//pr($this->data); die;
			
			//pr($this->data); die;
			if($this->UserReflection->save($this->data)){
				$reflectionId = $this->UserReflection->getLastInsertId();
				
				//Save Participants
				$allConnectionNames = array_map('trim',explode(',',$this->data['UserReflection']['connection_title']));
				$allConnectionInfo = $this->Connection->find('all',array('conditions'=>array('Connection.name'=>$allConnectionNames, 'Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
				//pr($allConnectionNames); die;
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
					
					$refConnection['ReflectionAttendy']['reflection_id'] = $reflectionId;
					$refConnection['ReflectionAttendy']['attendy_display_name'] = $row['Connection']['name'];
					$refConnection['ReflectionAttendy']['attendy_email'] = $contactEmail;
					$refConnection['ReflectionAttendy']['connection_id'] = $row['Connection']['id'];
					$refConnection['ReflectionAttendy']['shared_on'] = $db_date;
					//pr($actConnection); die;
					$this->ReflectionAttendy->create();
					$this->ReflectionAttendy->save($refConnection);
					
					//Send Email:: Start
					//Fetch reflection info
					$refInfo = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.id'=>$reflectionId)));
					
					$this->Email->smtpOptions = array(
						'port'=>SMTP_PORT,
						'timeout '=> SMTP_TIME_OUT,
						'host' => SMTP_HOST,
						'username'=>SMTP_USER_NAME,
						'password'=>SMTP_PASSOWRD 
					);
					$this->Email->sendAs= 'html';
					
					//import emailTemplate Model and get template
					App::import('Model','EmailTemplate');
					$this->EmailTemplate = new EmailTemplate;
					$template = $this->Common->getEmailTemplate(19);
					
					$this->Email->from = $_SESSION['Auth']['User']['email'];
					$this->Email->subject = $template['EmailTemplate']['subject'];
					$data=$template['EmailTemplate']['description'];
					$data=str_replace('{NAME}',strtok($row['Connection']['name'], " "),$data);
					$data=str_replace('{SENDER}',strtok($_SESSION['Auth']['User']['name'], " "),$data);
					
					if($refInfo['UserReflection']['description'] != ""){
						$description = $refInfo["UserReflection"]["description"];
					} else{
						$description = 'Reflection';
					}
					$data=str_replace('{DESCRIPTION}',$description,$data);
					
					if($refInfo['UserReflection']['file_name'] != ""){
						$ath_link = '<a href='.SITE_URL.'files/reflections/'.$refInfo["UserReflection"]["file_name"].'>Attachment</a>';
					} else{
						$ath_link = 'No Attachment';
					}
					
					$data=str_replace('{ATTACHMENT}',$ath_link,$data);
					//pr($data); exit;
					$this->set('data',$data);
					$emailstrExp = explode(',',trim($contactEmail));
					$toEmail = $emailstrExp[0];
					$this->Email->to = $toEmail;
					$this->Email->template='commanEmailTemplate';
					$this->Email->send();
					//Send Email:: End
				
				}
				//End:: save participants
				
				/*
				//save groups of reflections
				
				$refGroupArr = array();
                                foreach($this->data['UserReflection']['group_id'] as $group):
                                        $refGroupArr['ShareReflection']['reflection_id'] = $reflectionId;
                                        $refGroupArr['ShareReflection']['group_id'] = $group;
                                        $refGroupArr['ShareReflection']['user_id'] = $_SESSION['Auth']['User']['id'];
					$this->ShareReflection->create();
                                        $this->ShareReflection->save($refGroupArr);
				endforeach;
				*/
				
				$allGroupsNames = array_map('trim',explode(',',$this->data['UserReflection']['group_title']));
				$allGroupInfo = $this->ConnectionGroup->find('all',array('conditions'=>array("OR"=>array(array('ConnectionGroup.title'=>$allGroupsNames, 'ConnectionGroup.group_owner'=>$_SESSION['Auth']['User']['id']),array('ConnectionGroup.title'=>$allGroupsNames, 'ConnectionGroup.group_owner'=>0)))));
				
				$refGroupArr = array();
				foreach($allGroupInfo as $row1){
					$refGroupArr['ShareReflection']['reflection_id'] = $reflectionId;
                                        $refGroupArr['ShareReflection']['group_id'] = $row1['ConnectionGroup']['id'];
                                        $refGroupArr['ShareReflection']['user_id'] = $_SESSION['Auth']['User']['id'];
					$this->ShareReflection->create();
                                        $this->ShareReflection->save($refGroupArr);
					
					//Find all connections of group and send email to them
					$GroupCon = $this->ConGroupRelation->find('all',array('conditions'=>array('ConGroupRelation.user_id'=>$_SESSION['Auth']['User']['id'],'ConGroupRelation.group_id'=>$row1['ConnectionGroup']['id']),'recursive'=>2));
					//Send email to each connection
					$refInfo = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.id'=>$reflectionId)));
					
					foreach($GroupCon as $con){
						//Send Email:: Start
					//Fetch reflection info
					
					$this->Email->smtpOptions = array(
						'port'=>SMTP_PORT,
						'timeout '=> SMTP_TIME_OUT,
						'host' => SMTP_HOST,
						'username'=>SMTP_USER_NAME,
						'password'=>SMTP_PASSOWRD 
					);
					$this->Email->sendAs= 'html';
					
					//import emailTemplate Model and get template
					App::import('Model','EmailTemplate');
					$this->EmailTemplate = new EmailTemplate;
					$template = $this->Common->getEmailTemplate(19);
					
					$this->Email->from = $_SESSION['Auth']['User']['email'];
					$this->Email->subject = $template['EmailTemplate']['subject'];
					$data=$template['EmailTemplate']['description'];
					$data=str_replace('{NAME}',$con['Connection']['name'],$data);
					$data=str_replace('{SENDER}',$_SESSION['Auth']['User']['name'],$data);
					
					if($refInfo['UserReflection']['description'] != ""){
						$description = $refInfo["UserReflection"]["description"];
					} else{
						$description = 'Reflection';
					}
					$data=str_replace('{DESCRIPTION}',$description,$data);
					
					if($refInfo['UserReflection']['file_name'] != ""){
						$ath_link = '<a href='.SITE_URL.'files/reflections/'.$refInfo["UserReflection"]["file_name"].'>Attachment</a>';
					} else{
						$ath_link = 'No Attachment';
					}
					
					$data=str_replace('{ATTACHMENT}',$ath_link,$data);
					//pr($data); exit;
					$this->set('data',$data);
					$this->Email->to = $con['Connection']['ConnectionEmail'][0]['email'];
					$this->Email->template='commanEmailTemplate';
					$this->Email->send();
					
					//Send Email:: End
					}
					
				}
				
                               //End:: save groups
			
			
			
				
			$this->Session->setFlash('Reflection added successfully', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'users','action'=>'welcome'));
			}
		}
		
	}
	
	
	/** 
	@function : edit_reflection 
	@description : Add Reflection
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 07, 2012
	*/ 
	function edit_reflection($id =NULL){
		//$this->set(compact('id'));
		$id = base64_decode($id);
		
		$this->set('pagetitle','Edit Reflection');
		$this->layout = "inner_pages";
		
		$refInfo = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.id'=>$id)));
		//pr($refInfo);
		$this->set(compact('refInfo'));
		
		$allShared = $refInfo['ReflectionAttendy'];
		$allShared = Set::sort($refInfo['ReflectionAttendy'],'{n}.shared_on','DESC');
		$this->set(compact('allShared'));
		//pr($allShared); die;
		
		//All group listing
		$allGroups = $this->ConnectionGroup->find('list',array('conditions'=>array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),'fields'=>array('ConnectionGroup.id','ConnectionGroup.title')));
		$this->set(compact('allGroups'));
		
		$autoCompleteConList_first = $this->Connection->find('list',array('conditions'=>array('Connection.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'Connection.created DESC'));
		$autoCompleteConList = array();
		foreach($autoCompleteConList_first as $listKey=>$listVal){
			$autoCompleteConList[] = str_replace('"','',$listVal);
		}
		//echo '<pre>'; print_r($autoCompleteConList); die;
		
		$autoCompleteConList = '"'.implode('","', $autoCompleteConList).'"';
		//echo $autoCompleteConList; exit;
		$this->set(compact('autoCompleteConList'));
		//echo '<pre>'; print_r($autoCompleteConList); die;
		
		//$autoForGroups = $this->ConnectionGroup->find('list',array('conditions'=>array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),'fields'=>array('ConnectionGroup.id','ConnectionGroup.title')));
		$autoForGroups = $this->ConnectionGroup->find('list',array('conditions'=>array("OR"=>array(array('ConnectionGroup.group_owner'=>0, 'ConnectionGroup.status'=>1),array('ConnectionGroup.group_owner'=>$_SESSION['Auth']['User']['id'], 'ConnectionGroup.status'=>1))),'fields'=>array('ConnectionGroup.id','ConnectionGroup.title')));
		//echo '<pre>'; print_r($autoForGroups); die;
		
		$autoForGroups = '"'.implode('","', $autoForGroups).'"';
		//echo $autoCompleteConList; exit;
		$this->set(compact('autoForGroups'));
		
		//All question listing
		//$allQuestion = $this->Question->find('list',array('conditions'=>array('Question.status'=>1),'fields'=>array('Question.id','Question.question'),'limit'=>3,'order'=>'rand()'));
		//$this->set(compact('allQuestion'));
		
		$selectedGroups= $this->ShareReflection->find('list',array('conditions'=>array('ShareReflection.reflection_id'=>$id,'ShareReflection.user_id'=>$_SESSION["Auth"]["User"]["id"]),'fields'=>array('ShareReflection.group_id')));
		
		$this->set(compact('selectedGroups'));
		
		//Shared Connections
		$sharedWithConnectionIds = $this->ReflectionAttendy->find('list',array('conditions'=>array('ReflectionAttendy.reflection_id'=>$id), 'fields'=>('connection_id')));
		$connectionNames = $this->Connection->find('list',array('conditions'=>array('Connection.id'=>$sharedWithConnectionIds), 'fields'=>('name')));
		$this->set(compact('connectionNames'));
		
		//Shared Groups
		$sharedWithGroupIds = $this->ShareReflection->find('list',array('conditions'=>array('ShareReflection.reflection_id'=>$id), 'fields'=>('group_id')));
		$groupNames = $this->ConnectionGroup->find('list',array('conditions'=>array('ConnectionGroup.id'=>$sharedWithGroupIds), 'fields'=>('title')));
		$this->set(compact('groupNames'));
		
		//pr($selectedGroups); die;
		if(!empty($this->data))
		{
			
			//pr($this->data); die;
		
		if(is_uploaded_file($this->data['UserReflection']['file']['tmp_name']))
		{
		    $fileName=$this->data['UserReflection']['file']['name'];
		    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
		   
		    $this->data['UserReflection']['file_name']='Reflection'.time().'.'.$ext;   
		   
		   
		    App::import('Lib','resize');   
		    $image = new ImageResize();
       
		    move_uploaded_file($this->data['UserReflection']['file']['tmp_name'],'files/reflections/'.$this->data['UserReflection']['file_name']);
		    //$image->resize('files/reflections/original/'.$this->data['UserReflection']['image'],'files/reflections/medium/'.$this->data['Connection']['image'],'aspect_fill',160,110,0,0,0,0);
	       
	        } 
			$utc_date = date('Y-m-d H:i:s');
			$current_Time = date('Y-m-d', strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],$utc_date)));
			//pr($current_Time);
			$expDate = explode('/',$this->data['UserReflection']['reflection_date']);
			
			$db_date=$this->data['UserReflection']['reflection_date'] = $expDate[2].'-'.$expDate[1].'-'.$expDate[0];
			//pr($db_date); die;
			//pr($db_date);
			if($current_Time==$db_date ){
				$db_date=$utc_date;
				
				$local_ref_date = $this->Common->userTime($_SESSION['Auth']['User']['timezone'],$utc_date);
			}else{
				$db_date=$db_date.' 23:59:59';
				
				$local_ref_date=$db_date;
			}
			
			$this->data['UserReflection']['reflection_date'] = $db_date;
			$this->data['UserReflection']['user_id'] = $_SESSION['Auth']['User']['id'];
			$this->data['UserReflection']['captured_image'] = end(explode('/',$this->data['UserReflection']['captured_image'])); 
			$this->data['UserReflection']['local_reflection_date']=$local_ref_date;
			
			//pr($this->data); die;
			if($this->UserReflection->save($this->data)){
				$reflectionId = $this->data['UserReflection']['id'];
				
				//Save Participants
				$this->ReflectionAttendy->deleteAll(array('ReflectionAttendy.reflection_id'=>$reflectionId), true);
				
				if($this->data['UserReflection']['connection_title'] != ""){
					$this->data['UserReflection']['connection_title'] = $this->data['UserReflection']['connection_title'].' '.$this->data['UserReflection']['already_shared'];
				} else{
					$this->data['UserReflection']['connection_title'] = $this->data['UserReflection']['already_shared'];
				}
				
				$allConnectionNames = array_map('trim',explode(',',$this->data['UserReflection']['connection_title']));
				$allConnectionInfo = $this->Connection->find('all',array('conditions'=>array('Connection.name'=>$allConnectionNames, 'Connection.user_id'=>$_SESSION['Auth']['User']['id'])));
				//pr($allConnectionNames); die;
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
					
					$refConnection['ReflectionAttendy']['reflection_id'] = $reflectionId;
					$refConnection['ReflectionAttendy']['attendy_display_name'] = $row['Connection']['name'];
					$refConnection['ReflectionAttendy']['attendy_email'] = $contactEmail;
					$refConnection['ReflectionAttendy']['connection_id'] = $row['Connection']['id'];
					$refConnection['ReflectionAttendy']['shared_on'] = $db_date;
					//pr($actConnection); die;
					$this->ReflectionAttendy->create();
					$this->ReflectionAttendy->save($refConnection);
				}
				//End:: save participants
				
				//Save Groups
				$this->ShareReflection->deleteAll(array('ShareReflection.reflection_id'=>$reflectionId), true);
				$allGroupsNames = array_map('trim',explode(',',$this->data['UserReflection']['group_title']));
				$allGroupInfo = $this->ConnectionGroup->find('all',array('conditions'=>array("OR"=>array(array('ConnectionGroup.title'=>$allGroupsNames, 'ConnectionGroup.group_owner'=>$_SESSION['Auth']['User']['id']),array('ConnectionGroup.title'=>$allGroupsNames, 'ConnectionGroup.group_owner'=>0)))));
				
				$refGroupArr = array();
				foreach($allGroupInfo as $row1){
					$refGroupArr['ShareReflection']['reflection_id'] = $reflectionId;
                                        $refGroupArr['ShareReflection']['group_id'] = $row1['ConnectionGroup']['id'];
                                        $refGroupArr['ShareReflection']['user_id'] = $_SESSION['Auth']['User']['id'];
					$this->ShareReflection->create();
                                        $this->ShareReflection->save($refGroupArr);
				}
				
                               //End:: save groups
				
			$this->Session->setFlash('Reflection added successfully', 'default', array('class' => 'flash_success'));
			$this->redirect(array('controller'=>'users','action'=>'welcome'));
			}
		}
		
	}
	
	
	
	
	/** 
	@function : admin_reflections 
	@description : listing of reflections,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 19, 2012
	*/
	
	function admin_reflections(){
		//pr($this->data); die;
		if((isset($this->data["UserReflection"]["setStatus"])))
		{
			$status = ife($_POST['active'],1,0);
			$record = $this->data["UserReflection"]["Record"];
			$CheckedList=$_POST['box1'];
			$controller= $this->params['controller'];
			$action='reflections'; 
			$prefix='admin';
			$model='UserReflection';
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
		$criteria .= " and (Question.manager_id = 0)";
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
					$criteria .= " and (UserReflection.title LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and UserReflection.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and UserReflection.status = '".$matchshow."'";
					$this->set('show',$show);
				}
			}
			
		}
		
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','Reflection');
		
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
				'Question.id' => 'ASC'
			)
		);
		
		$this->set('pagetitle',"Question");                
		$this->set('reflections', $this->paginate('Question',$criteria));
		//pr($this->paginate('UserReflection',$criteria)); die;
	}
	
	
	
	/*
	Function Name: admin_delete
	Params: NULL
	Created BY: Vikas Uniyal
	Created ON : Dec. 19, 2012
	Description : To delete reflections - Admin Panel 
	*/
	function admin_delete($id=null){
	    $id = base64_decode($id);
	    $this->UserReflection->id = $id;
            $this->UserReflection->delete($id);
	    
            $this->Session->setFlash('Reflection has been deleted sucessfully.','message/green');
            $this->redirect(array('action' => 'reflections'));
        }
	
	/** 
	@function : admin_view_reflection
	@description : Reflection detail in admin panel
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 19, 2012
	*/ 
	function admin_view_reflection($id){
		$this->set('pagetitle','Reflections');
		$this->layout = "admin";
		
	    $id = base64_decode($id);
	    
		$refInfo = $this->UserReflection->find('first',array('conditions'=>array('UserReflection.id'=>$id)));
		$this->set(compact('refInfo'));
	}
	
	
	/** 
	@function : questions 
	@description : list all questions created by group owner
	@params : NULL
	@Created by :Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 26, 2012
	*/ 
	function questions(){
		
	    $this->set('pagetitle','Questions');
	    $this->layout = "group_dashboard";

	    $this->paginate=array('order'=>'Question.id ASC','limit'=>30);
	   
	    $queLists = $this->paginate('Question',array('Question.manager_id'=>array($_SESSION['Auth']['User']['id'], '0')));
	    $this->set('queLists', $queLists);
	    //pr($queLists); die;
	}
	
	
	/** 
	@function : question_actions 
	@description : perform various action from question listing page,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Dec. 26, 2012
	*/
	function question_actions()
	{
		//pr($this->data); die;
		if($this->data['Question']['action'] == 'delete')
		{
			foreach($this->data['Question']['ids'] as $ids){
				$this->Question->delete($ids, true);
			}
			$this->Session->setFlash('Questions deleted successfully', 'default', array('class' => 'flash_success'));
		}
		
		else if($this->data['Question']['action'] == 'activate')
		{
			foreach($this->data['Question']['ids'] as $ids):
				$status = 1;
				 
					$this->Question->updateAll(array('Question.status'=>"'$status'"),array('Question.id'=>$ids));
					$this->Session->setFlash('Question activated successfully.', 'default', array('class' => 'flash_success'));
			endforeach;
		}
		else if($this->data['Question']['action'] == 'deactivate')
		{
			foreach($this->data['Question']['ids'] as $ids):
				$status = 0;
				$this->Question->updateAll(array('Question.status'=>"'$status'"),array('Question.id'=>$ids));
			endforeach;
			$this->Session->setFlash('Question deactivated successfully.', 'default', array('class' => 'flash_success'));
		}
		else if($this->data['Question']['action'] == 'edit')
		{
			$this->redirect(array('controller'=>'reflections','action'=>'add_question',base64_encode($this->data['Question']['ids'][0])));
		}
		
		$this->redirect(array('controller'=>'reflections','action'=>'questions'));
	}
	
	/**
	@function:add_question 
	@description		Add question from front
	@Created by: 		Vikas Uniyal
	@Modify:		NULL
	@Created Date:		Dec. 26, 2012
	*/
	function add_question($id=null){ 
  		$id = base64_decode($id);
		$this->layout = 'inner_pages';	
  		
		$this->set('pagetitle',"Add Question");
		$this->Question->id = $id;
		$admin_id=0;
		if(empty($this->data)){
			$this->data = $this->Question->read();
		}else if(!empty($this->data)){
			$this->Question->set($this->data);
			if($this->Question->validates()){
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				
				$this->data['Question']['manager_id'] = $_SESSION['Auth']['User']['id'];
				
				$countAskAlways = $this->Question->find('count',array('conditions'=>array('Question.manager_id'=>$_SESSION['Auth']['User']['id'],'Question.frequency'=>1)));
				if($countAskAlways<3){
					$this->Question->save($this->data);
					$this->Session->setFlash('New question has been added successfully.', 'default', array('class' => 'flash_success'));
					$this->redirect('questions');
				}else {
					$this->Session->setFlash('Can not set the frequency as always ask for more then 3 questions.', 'default', array('class' => 'flash_error'));
					$this->redirect($this->referer());  
				}
				
			} else{
				$errorArray = $this->Question->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	/** 
	@function : update_ratings 
	@description : Update today rating of an reflection,
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : Jan. 28, 2013
	*/
	function update_ratings($reflection_id=NULL, $rating=NULL) {
		if($this->RequestHandler->isAjax()) {
			$this->layout = 'ajax';	
			$this->data['UserReflection']['id'] = $reflection_id;
			$this->data['UserReflection']['rating_today'] = $rating;
			if($this->UserReflection->save($this->data)) {
				echo json_encode('Rating Update Successfully');
				exit;
			}else{
				echo json_encode('Please try again');
				exit;
			}
		}
	}
	
    function delete_image($id=null) {
	$this->layout = false;
	$this->autoRender = false;
	$status = "";
	$this->UserReflection->updateAll(array('UserReflection.file_name'=>"'$status'"),array('UserReflection.id'=>$id));
	return 1;
    }
    
    /**
	@function:admin_add_question 
	@description		Add question from back end
	@Created by: 		Sunny Chauhan
	@Modify:		NULL
	@Created Date:		July. 18, 2013
	*/
	function admin_add_question($id=null){
  		$id = base64_decode($id);
		$this->layout = 'admin';	
		if(!empty($this->data)){
			if(!empty($id)){
				$this->Question->id = $id;	
			}
			$this->data['Question']['manager_id'] = 0;
			if($this->Question->save($this->data)){
				$this->Session->setFlash('Question has been added.','message/green');
				$this->redirect(array('controller'=>'reflections','action'=>'reflections'));
			}
		}else{
			$this->Question->id = $id;
			$this->data = $this->Question->read();
		}
	}
	
	/**
	@function:admin_delete_question 
	@description		Delete question from Back end
	@Created by: 		Sunny Chauhan
	@Modify:		NULL
	@Created Date:		July. 18, 2013
	*/
	function admin_delete_question($id=null){
  		$id = base64_decode($id);
		$this->layout = 'admin';
		pr($id);
			if($this->Question->delete($id)){
				$this->Session->setFlash('Question has been deleted.','message/green');
				$this->redirect(array('controller'=>'reflections','action'=>'reflections'));
			}
	}
  }//end class
?>