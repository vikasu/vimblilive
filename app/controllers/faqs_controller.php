<?php
/*
	* Faqs Controller class
	* PHP versions 5.1.4
	* @filesource
	* @author     Maneesh Garg
	* @link       http://www.smartdatainc.net/
	* @version 0.0.1.3 
*/
App::import('Sanitize');
class FaqsController extends AppController{

	var $name 	= 'Faqs';
	var $uses 	= array('Faq');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('GoogleCal','RequestHandler','Cookie','Email','Auth','Upload','Common','Import');
	 
	
	function beforeFilter(){
		parent::beforeFilter();
		
		if(($this->params['action'] != 'admin_login') && (@$this->params['prefix'] == 'admin'))
		{
		    $this->Auth->allow('sign_up');
		} else {
		       $this->Auth->allow('display_faq');
		}
	    
	    }
	
	
	/** 
	@function : index 
	@description : list all faqs
	@params : NULL
	@Created by :Maneesh Garg
	@Modify : NULL
	@Created Date : Jan. 03, 2013
	*/ 
	function admin_index(){
           
	//pr($this->data); die;
		if((isset($this->data["Faq"]["setStatus"])))
		{
			//echo 'hi'; die;
			$status = ife($_POST['active'],1,0);
			$record = $this->data["Faq"]["Record"];
			$CheckedList=$_POST['box1'];
			$controller= $this->params['controller'];
			$action='index'; 
			$prefix='admin';
			$model='Faq';
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
					$criteria .= " and (Faq.ques LIKE '%".$value1."%')";
				} else {
					if(trim($fieldname)!=''){
						if(isset($value) && $value!=="") {
							$criteria .= " and Faq.".$fieldname." LIKE '%".$value1."%'";
						}
					}
				}
			}
			if(isset($show) && $show!==""){
				if($show == 'All'){
				} else {
					$criteria .= " and Faq.status = '".$matchshow."' ";
					$this->set('show',$show);
				}
			}
			
		}
		
		$this->set('keyword', $value);
		$this->set('show', $show);
		$this->set('fieldname',$fieldname);
		$this->set('heading','Faqs');
		
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
				'Faq.id' => 'DESC'
			)
		);
		
		$this->set('pagetitle',"Faqs");                
		$this->set('faqList', $this->paginate('Faq',$criteria));
		//pr($this->paginate('ConnectionGroup',$criteria)); die;
	}
	
	
	
	/**
	@function:admin_add_Faq
	@description		Add Faqs from admin panel
	@Created by: 		Maneesh Garg
	@Modify:		NULL
	@Created Date:		Jan. 03, 2013
	*/
	function admin_add_faq($id=null){
                $id = base64_decode($id);
		$this->layout = 'admin';	
  		//App::import('Model','EmailTemplate');
      		//$this->EmailTemplate = & new EmailTemplate();
		
		$this->set('pagetitle',"Add Faq");
		$this->Faq->id = $id;
		$admin_id=0;
		if(empty($this->data)){
			$this->data = $this->Faq->read();
		}else if(!empty($this->data)){	
			$this->Faq->set($this->data);
			if($this->Faq->validates()){
				
				uses('sanitize');
				$this->Sanitize = new Sanitize;
				$this->data = $this->Sanitize->clean($this->data);
				//add sales person id
	
				$this->data['Faq']['ques'] = ucwords(strtolower($this->data['Faq']['ques']));
				$this->data['Faq']['status'] = '1';

				if($this->Faq->save($this->data)) {
					$userGroupId = $this->Faq->getLastInsertId();						
			
						$condition=array('Faq.id'=>$userGroupId);
						$user_group = $this->Faq->find('first',array('conditions'=>$condition,'fields'=>array('id','ques','ans')));
						
						//SEND EMAIL TO ADDED USER
										
						$this->Session->setFlash('Faq has been saved successfully.','default',array('class'=>'message/green'));
						$this->redirect('index');
				}
				
			} else{
				$errorArray = $this->Faq->validationErrors;
				$this->set('validationErrorsArray',$errorArray);
			}
		}
	}
	
	/*
	Function Name: delete_faq
	Params: NULL
	Created BY: Maneesh Garg
	Created ON : Jan. 03, 2013
	Description : To delete Faq
	*/
	function admin_delete_faq($id=null){
	    $id = base64_decode($id);
	    
	    $this->Faq->id = $id;
	    $this->Faq->delete($id,true);
            $this->Session->setFlash('Faq deleted sucessfully.','message/green');
            $this->redirect($this->referer());
        }
        
        /*
	Function Name: display_faq
	Params: NULL
	Created BY: Maneesh Garg
	Created ON : Jan. 03, 2013
	Description : To display Faq on front end
	*/
        function display_faq(){
            $this->layout = "inner_pages";
            $this->set('pagetitle',"Faq");
             
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
		$criteria = " Faq.status='1'";
		
		$this->paginate = array(
			'limit' => '6',
			'order' => array(
				'Faq.id' => 'DESC'
			)
		);
		
		$this->set('pagetitle',"Faqs");                
		$this->set('faqList', $this->paginate('Faq',$criteria));
        }
	
	
    
  }//end class
?>