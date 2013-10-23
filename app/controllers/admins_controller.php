<?php
/*
* AdminsController class
* PHP versions 5.2.12
* @filesource
* @author	Vikas Uniyal 
* @date		Nov. 19, 2012
* @link       http://www.smartdatainc.net/
* @version 1.0.0 
* - Initial release
*/
App::import('Sanitize');
class AdminsController extends AppController
{
    var $name = 'Admins';
    var $helpers = array('Common','Validation','Thumbnail','Ajax');
    var $components = array('Resize','Session');

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('admin_demo','admin_login','admin_validate_login','admin_ajax_login','admin_ajax_validate','admin_request');
	
    }
    
    /*
	Function Name: admin_login
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : for the login to - Admin Panel
    */
    function admin_login() {
        
	$this->set('pagetitle',"Admin Login");
        $this->layout='';
        $userdata=$this->Auth->User();
	//pr($this->request->data); exit;
	if(!empty($this->data)) {
		if($this->Auth->user()) {
		    $this->redirect(array('controller' => 'admins', 'action' => 'dashboard','admin'=>true));
		} else { 
		    $this->redirect($this->Auth->logout());
		}
	}
    }
    
    /*
	Function Name: admin_dashboard
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : Dashboard of - Admin Panel 
    */
    function admin_dashboard() {
        $this->set('pagetitle',"Admin Dashboard");
        $this->layout='admin';
    }
    
    /*
	Function Name: admin_logout
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : for the logout from Admin - Admin Panel 
    */
    function admin_logout() { 
        $this->autoRender=false;
	$this->Session->setFlash('Administrator has been logout successfully.','admin_mess_success');
	$this->redirect($this->Auth->logout());
    }
    
    /*
	Function Name: admin_index
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : for the listing of Admin User - Admin Panel
    */
    function admin_index() {
	$this->layout='admin';
	$this->set('pagetitle',"Manage Admin User");
	$this->paginate=array('order'=>'Admin.id ASC','limit'=>10);
	$lists = $this->paginate('Admin');
	$this->set('list', $lists);
	
	if((isset($this->data["Admin"]["setStatus"]))) {
	    $status = ife($_POST['active'],1,0);
	    $record = $this->data["Admin"]["Record"];
	    $CheckedList=$_POST['box1'];
	    $controller= $this->params['controller'];
	    $action='index'; 
	    $prefix='admin';
	    $model='Admin';
	    $relation=null;

	    switch($status) { 
	        case '1': 
		    $this->setStatus('1',$CheckedList,$model,$relation,$controller,$action,$prefix,$record); 
		break;
		case '0':
		    $this->setStatus('0',$CheckedList,$model,$relation,$controller,$action,$prefix,$record); 
	        break; 
	    }
	}    
    }
    
    /*
	Function Name: admin_add
	params: NULL
	Created BY:Vikas Uniyal
	Created ON : Nov. 19, 2012
	Description : Add admin user - Admin Panel
    */
    function admin_add() {
        $this->set('pagetitle',"Add Admin User");
        $this->layout='admin';
        
        if(isset($this->data) && !empty($this->data)) {
	    
	    // To check the validation using ajax - pass model and model unset fields
	    if ($this->RequestHandler->isAjax()) {
		$this->ajax_check(array('Admin'),$this->data);
	    }
	    
	    $this->Admin->set($this->data);
	    
	    if($this->Admin->validates() ) {
		$this->data['Admin']['password'] = Security::hash (Configure::read ('Security.salt') . $this->data['Admin']['pwd']);
                if($this->Admin->save($this->data)) {
                    $this->Session->setFlash(SUCCESS_MSG_ADMIN_CREATE,'message/green');
		    $this->redirect(array('action' => 'index'));
                }
            } else {
		$this->set('validationErrorsArray', $this->Admin->invalidFields());
	    }  
	
	}
    }
    
    /*
	 Function Name: admin_edit
	 params: id (id of the Admin user to be edited)
	 Created BY:Vikas Uniyal
	 Created ON : Nov. 19, 2012
	 Description : Edit detail of the Admin user - Admin Panel 
    */
    function admin_edit($id = null) {
        $id = base64_decode($id);
	$this->set('pagetitle',"Edit Admin User");
        $this->layout='admin';
        
	if(isset($this->data) && !empty($this->data)) {
	    
	    // To check the validation using ajax - pass model and model unset fields
	    if ($this->RequestHandler->isAjax()) {
		$unsetData = array('Admin.email.isUnique');
		$this->ajax_check(array('Admin'),$this->data,$unsetData);
	    }
	    
	    $this->Admin->set($this->data);
	    unset($this->Admin->validate['email']['isUnique']);
	    
	    if($this->Admin->validates()) {
                $this->data['Admin']['id'] = $id;
		$this->data['Admin']['password'] = Security::hash (Configure::read ('Security.salt') . $this->data['Admin']['pwd']);
		
                if($this->Admin->save($this->data)) {
                    $this->Session->setFlash(SUCCESS_MSG_ADMIN_EDIT,'message/green');
		    $this->redirect(array('action' => 'index'));
                }
            } else {
		$this->set('validationErrorsArray', $this->Admin->invalidFields());
	    }   
        }
	    $this->data = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$id)));
    }
    
    /*
	 Function Name: admin_change_password
	 params: Null
	 Created BY:Vikas Uniyal
	 Created ON : Nov. 19, 2012
	 Description : for chnageing the password of logged in admin user - Admin Panel 
    */
    function admin_change_password() {
        $id = $this->Auth->user('id');
	
	$this->set('pagetitle',"Change Password");
        $this->layout='admin';

	if(isset($this->data) && !empty($this->data)) {
    
	    $this->Admin->validate=$this->Admin->validateChangePassword;
	    
	    // To check the validation using ajax - pass model and model unset fields
	    if ($this->RequestHandler->isAjax()) {
		$this->ajax_check(array('Admin'),$this->data);
	    }
	    
            $this->Admin->set($this->data);
	    
	    if($this->Admin->validates() ) {
		$this->data['Admin']['id'] = $id;
		$this->data['Admin']['password'] = Security::hash (Configure::read ('Security.salt') . $this->data['Admin']['pwd']);
		
                if($this->Admin->save($this->data)) {
                    $this->Session->setFlash(SUCCESS_MSG_ADMIN_PASSWORD_CHANGE,'message/green');
		    $this->redirect(array('action' => 'index'));
                }
            } else {
		$this->set('validationErrorsArray', $this->Admin->invalidFields());
	    }  
        }
    }
    
    /*
	Function Name: admin_delete
	params: id (id of the Admin user to be deleted)
	Created BY:Vikas Uniyal
	 Created ON : Nov. 19, 2012
	Description : for deleting the admin user - Admin Panel
    */
    function admin_delete($id) {
	$id = base64_decode($id);
        $this->Admin->id = $id;
        $this->Admin->delete();
        $this->Session->setFlash(SUCCESS_MSG_ADMIN_DELETE,'message/green');
	$this->redirect(array('action' => 'index'));
    }
        
    
    /*
	Function Name: admin_edit_account
	params: Null
	Created BY:Vikas Uniyal
	 Created ON : Nov. 19, 2012
	Description : for chnageing the information of logged in admin user - Admin Panel 
    */
    function admin_edit_account() {
        $id = $this->Auth->user('id');
	$this->set('pagetitle',"Edit Account");
        $this->layout='admin';
        
	if(isset($this->data) && !empty($this->data)) {
           
	    $this->Admin->validate=$this->Admin->validateChangePassword;
	    
	    // To check the validation using ajax - pass model and model unset fields
	    if ($this->RequestHandler->isAjax()) {
		$this->ajax_check( array('Admin'),$this->data );
	    }
	    
            $this->Admin->set( $this->data );
	    
	    if( $this->Admin->validates() ) {
		$this->data['Admin']['id'] = $id;
		$this->data['Admin']['password'] = Security::hash (Configure::read ('Security.salt') . $this->data['Admin']['pwd']);
		
                if($this->Admin->save($this->data)) {
                    $this->Session->setFlash(SUCCESS_MSG_ADMIN_EDIT,'message/green');
		    $this->redirect(array('action' => 'index'));
                }
            } else {
		$this->set('validationErrorsArray', $this->Admin->invalidFields());
	    }  
        }
	$id = $_SESSION['Auth']['User']['id'];
	$this->data = $this->Admin->find('first',array('conditions'=>array('Admin.id'=>$id)));
    }
    
    /* Don't remove - Refrance for the model validation using ajax */
    function admin_ajax_validate() {
	Configure::write('debug', 0);
	$this->autoRender = false;
	$ret = "false";
	if ($this->RequestHandler->isAjax()) {
	// If we have data, process it. If not send back an error.
	    if(is_array($this->data)){
		$this->Admin->create($this->data);
		
		$this->Admin->validates();
		$errors = $this->Admin->invalidFields();
		// grab the error message from the array
		$ret = '';
		
		foreach ($this->data['Admin'] as $k => $value ) {
		    if( array_key_exists ( $k, $errors) ) {
			$v = $errors[ $k ];
			$ret .= "error|$k|$v\n";
		    } else {
			    $ret .= "ok|$k\n";
		    }
		}
	    }
		echo $ret;
	} else {
		echo 'not_ajax';
	}
    }
	
    /*
	Refrence: Function for the refrance of the ajax validation using model function
    */
    function admin_validate_admin() {
	$this->layout = "";
	$this->autoRender = false;
	
	if($this->RequestHandler->isAjax()) {
	    $errors_msg = null;
	    App::import("Model",'Admin');
	    $this->Admin = new Admin();
	    $errors = $this->Admin->validate_admin_user($this->data);
				
	    if (is_array($this->data)) {
		foreach ($this->data['Admin'] as $key => $value ) {
		    if( array_key_exists ( $key, $errors) ) {
			foreach ( $errors [ $key ] as $k => $v ) {
			    $errors_msg .= "error|$key|$v";
			}	
		    } else {
			$errors_msg .= "ok|$key\n";
		    }
		}
	    }
	    echo $errors_msg;
	    exit();
	}
    }
    
     /*
	 Function Name: admin_add_carousel_image
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : July. 19, 2013
	 Description : for add/edit Carousel image in Admin Panel
    */
    function admin_add_carousel_image($id = null){
	$this->layout='admin';
	$this->loadModel('CarouselDetail');
	$id = base64_decode($id);
	$this->set('pagetitle',"Upload Image");
	if(!empty($this->data)){
		if(!empty($id)){
			$this->CarouselDetail->id = $id;	
		}
		if(!empty($this->data['CarouselDetail']['Carousel_image']['name'])){
		    if(is_uploaded_file($this->data['CarouselDetail']['Carousel_image']['tmp_name'])){
			$fileName=$this->data['CarouselDetail']['Carousel_image']['name'];
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			$this->data['CarouselDetail']['file_name']='slide'.time().'.'.$ext;  
			$this->data['CarouselDetail']['carousel_image'] = $this->data['CarouselDetail']['file_name'];
			if($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'bmp' || $ext == 'gif'){
				move_uploaded_file($this->data['CarouselDetail']['Carousel_image']['tmp_name'],'img/slider-img/newslideroriginal/'.$this->data['CarouselDetail']['carousel_image']);
			       $this->Resize->resize('img/slider-img/newslideroriginal/'.$this->data['CarouselDetail']['carousel_image'],'img/slider-img/newsliderimg/'.$this->data['CarouselDetail']['carousel_image'],'aspect_fill',1024,642,0,0,0,0);
			}else{
			    echo "file cant uploaded";
			}
		    }
		}else{
			unset($this->data['CarouselDetail']['Carousel_image']);
		}
		if($this->CarouselDetail->save($this->data)){
			    $this->Session->setFlash(' image uploaded successfully.','message/green');
			    $this->redirect(array('controller'=>'admins','action'=>'admin_homes_image_listing'));
		}
	}else{
		$this->CarouselDetail->id = $id;
		$this->data = $this->CarouselDetail->read();
	    }
    }
    
     /*
	 Function Name: admin_homes_image_listing
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : July. 19, 2013
	 Description : for listing Carousel images in Admin Panel
    */
    function admin_homes_image_listing(){
	$this->layout='admin';
	$this->set('pagetitle','Carousel Listing');
	$this->loadModel('CarouselDetail');
	$homes_images = $this->CarouselDetail->find('all');
	$this->set('homes_images',$homes_images);
    }
   
    /*
	 Function Name: admin_delete_carousel_image
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : July. 19, 2013
	 Description : for deleting Carousel image in Admin Panel
    */
   function admin_delete_carousel_image($id = null){
	$this->loadModel('CarouselDetail');
	$id = base64_decode($id);
	if($this->CarouselDetail->delete($id)){
	    $this->Session->setFlash('Carousel Image has been deleted.','message/green');
	    $this->redirect(array('controller'=>'admins','action'=>'admin_homes_image_listing'));
	}
			
    }
    
     /*
	 Function Name: change_status_carousel_image
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : July. 22, 2013
	 Description : for changing status Carousel image in Admin Panel
    */
   function admin_change_status_carousel_image($id = null){
	$this->autoRender = false;
	$this->loadModel('CarouselDetail');
	$id = base64_decode($id);
	 $this->data['CarouselDetail']['id'] = $id;
	 $status = $this->CarouselDetail->find('first',array('conditions'=>array('CarouselDetail.id'=>$id),'fields'=>array('status')));
	 if($status['CarouselDetail']['status'] == 1) {
	     $this->data['CarouselDetail']['status'] = 0;
	 }else{
	    $this->data['CarouselDetail']['status'] = 1;
	 }
	 if($this->CarouselDetail->save($this->data)){
	     $this->Session->setFlash('Image Status  has been changed.','message/green');
	    $this->redirect(array('controller'=>'admins','action'=>'admin_homes_image_listing'));
	 }
	 
    }
    
      /*
	 Function Name: admin_export_data
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Aug. 19, 2013
	 Description : for provide layout for export data
    */
   function admin_export_data(){
	$this->layout='admin';
	$this->set('pagetitle','Export Data');
    }
    
     /*
	 Function Name: admin_export_user_data
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Aug. 19, 2013
	 Description : for export user data
    */
   function admin_export_user_data(){
	$this->layout='';
	$this->loadModel('User');
	$data = $this->User->find('all');
	$this->set('rows',$data);
	header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=\"User_Report.xls" );
	header ("Content-Description: Generated Report" );
	
    }
    
    
     /*
	 Function Name: admin_export_mission_data
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Aug. 19, 2013
	 Description : for export mission data
    */
   function admin_export_mission_data(){
	$this->layout='';
	$this->loadModel('Mission');
	$this->loadModel('MissionConnection');
	$this->loadModel('KeyToSuccess');
	$data = $this->Mission->find('all');
	$this->set('rows',$data);
	$cons = $this->MissionConnection->find('all');
	$this->set('cons',$cons);
	$keys = $this->KeyToSuccess->find('all');
	$this->set('keys',$keys);
	header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=\"Mission_Report.xls" );
	header ("Content-Description: Generated Report" );
    }
    
    /*
	 Function Name: admin_export_timeline_data
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Aug. 19, 2013
	 Description : for export scheduleBalances data
    */
   function admin_export_scheduleBalances_data(){
	$this->layout='';
	$this->loadModel('ScheduleBalance');
	$data = $this->ScheduleBalance->find('all',array('fields'=>array('DISTINCT ScheduleBalance.user_id')));
	$this->set('rows',$data);
	header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=\"Schedule Balances_Report.xls" );
	header ("Content-Description: Generated Report" );
	
    }
    
    
     /*
	 Function Name: admin_export_timeline_data
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Aug. 19, 2013
	 Description : for export timeline data
    */
   function admin_export_timeline_data(){
	$this->layout='';
	$this->loadModel('Timeline');
	$data = $this->Timeline->find('all',array('contain' => array('User')));
	$this->set('rows',$data);
	header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=\"Timeline_Report.xls" );
	header ("Content-Description: Generated Report" );
    }
    
    
     /*
	 Function Name: admin_export_reflections_data
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Aug. 19, 2013
	 Description : for export reflections data
    */
   function admin_export_reflections_data(){
	$this->layout='';
	$this->loadModel('UserReflection');
	$data = $this->UserReflection->find('all');
	$this->set('rows',$data);
	header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
	header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
	header ("Cache-Control: no-cache, must-revalidate");
	header ("Pragma: no-cache");
	header ("Content-type: application/vnd.ms-excel");
	header ("Content-Disposition: attachment; filename=\"UserReflection_Report.xls" );
	header ("Content-Description: Generated Report" );
	
    }
    
     /*
	 Function Name: admin_request
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Aug. 19, 2013
	 Description : for request
    */
   function admin_request($day,$user_id){
	$this->layout='';
	$this->autoRender = false;
	$this->loadModel('ScheduleBalance');
	$data = $this->ScheduleBalance->find('first',array('conditions'=>array('ScheduleBalance.user_id'=>$user_id,'ScheduleBalance.day'=>$day)));
	return $data;
    }
    
      /*
	 Function Name: admin_content_row_list
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON :Sep. 9, 2013
	 Description : for listing content row
    */
   function admin_content_row_list(){
	$this->layout='admin';
	$this->set('pagetitle',"Content Row LIsting");
	$this->layout='admin';
	$this->loadModel('ContentRow');
	$content_rows = $this->ContentRow->find('all');
	$this->set('content_rows',$content_rows);
    }
    
      /*
	 Function Name: admin_delete_content_row
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Sep. 9, 2013
	 Description : for deleting content row
    */
   function admin_delete_content_row($id = null){
	$this->loadModel('ContentRow');
	$id = base64_decode($id);
	//pr($id);
	if($this->ContentRow->delete($id)){
	    $this->Session->setFlash('Content Row has been deleted.','message/green');
	    $this->redirect(array('controller'=>'admins','action'=>'admin_content_row_list'));
	}
			
    }
    
      /*
	 Function Name: admin_add_content_row
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON :Sep. 9, 2013
	 Description : for add/edit Carousel image in Admin Panel
    */
    function admin_add_content_row($id = null){
	$this->layout='admin';
	$this->loadModel('ContentRow');
	if(!empty($id)){
		    $this->set('pagetitle','Update Content Row');
		    $id = base64_decode($id);
		    $this->set('id',$id);
	}else{
		$this->set('pagetitle','Add Content Row');
	    }
	if(!empty($this->data)){
		if(!empty($id)){
		    $this->ContentRow->id = $id;	
		}
		if(!empty($this->data['ContentRow']['content_image']['name'])){
		    if(is_uploaded_file($this->data['ContentRow']['content_image']['tmp_name'])){
			$tmp = $this->data['ContentRow']['content_image']['tmp_name'];
			$fileName=$this->data['ContentRow']['content_image']['name'];
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			$this->data['ContentRow']['file_name']='CONTENT'.time().'.'.$ext;  
			$this->data['ContentRow']['content_image'] = $this->data['ContentRow']['file_name'];
			if($ext == 'jpeg' || $ext == 'jpg' || $ext == 'png' || $ext == 'bmp' || $ext == 'gif'){
				//move_uploaded_file($tmp,'img/slider-img/newslideroriginal/content/'.$this->data['ContentRow']['content_image']);
			       //$this->Resize->resize('img/slider-img/newslideroriginal/content/'.$this->data['ContentRow']['content_image'],'img/slider-img/newsliderimg/content/'.$this->data['ContentRow']['content_image'],'aspect_fill',1024,642,0,0,0,0);
			       move_uploaded_file($tmp,'img/contentRowImage/'.$this->data['ContentRow']['content_image']);
			       $this->Resize->resize('img/contentRowImage/'.$this->data['ContentRow']['content_image'],'img/contentRowImage/'.$this->data['ContentRow']['content_image'],'aspect_fill',1024,642,0,0,0,0);
			}else{
			    echo "file cant uploaded";
			}
		    }
		}else{
			unset($this->data['ContentRow']['content_image']);
		}
		if($this->ContentRow->save($this->data)){
			    $this->Session->setFlash(' image uploaded successfully.','message/green');
			    $this->redirect(array('controller'=>'admins','action'=>'admin_content_row_list'));
		}
	}else{
		$this->ContentRow->id = $id;
		$this->data = $this->ContentRow->read();
	    }
    }
	
     /*
	 Function Name: admin_change_status_content_row
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Sep. 11, 2013
	 Description : for changing status of content row
    */
   function admin_change_status_content_row($id = null){
	$this->autoRender = false;
	$this->loadModel('ContentRow');
	$id = base64_decode($id);
	$this->data['ContentRow']['id'] = $id;
	$status = $this->ContentRow->find('first',array('conditions'=>array('ContentRow.id'=>$id),'fields'=>array('status')));
	if($status['ContentRow']['status'] == 1) {
	     $this->data['ContentRow']['status'] = 0;
	}else{
	    $this->data['ContentRow']['status'] = 1;
	}
	if($this->ContentRow->save($this->data)){
	    $this->Session->setFlash('Image Status  has been Updated.','message/green');
	    $this->redirect(array('controller'=>'admins','action'=>'admin_content_row_list'));
	}
    }
    
    /*
	 Function Name: admin_manage_rating
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Sep. 11, 2013
	 Description : for managing Rating
    */
    function admin_manage_rating($id){
        $id = base64_decode($id);
	$this->layout='admin';
	$this->set('pagetitle',"Manage Rating");
	$this->loadModel('Rating');
	//$this->loadModel('Rating1');
	//$rating = $this->Rating->find('first',array('conditions'=>array('Rating.id'=>$id)));
	$rating = $this->Rating->find('first',array('conditions'=>array('Rating.id'=>$id)));
	$this->set('rating',$rating);
	    // for updating rating quote text
	    if(!empty($this->data)) {
		$this->Rating->id = $this->data['Rating']['id'];
		    if($this->Rating->save($this->data)){
			$this->Session->setFlash('Rating has been saved.','message/green');
			$this->redirect(array('controller'=>'admins','action'=>'admin_list_rating'));
		    }
	    }
	}
   
    /*
	 Function Name: admin_edit_rating
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Sep. 11, 2013
	 Description : for editing Rating
    */
    function admin_list_rating(){
	$this->layout='admin';
	$this->set('pagetitle',"Rating List");
	//$this->loadModel('Rating');
	//$rating = $this->Rating->find('all');
	$this->loadModel('Rating');
	$rating = $this->Rating->find('all');
	$this->set('rating',$rating);
    }
   
    /*
	 Function Name: admin_thoughts_listing
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Sep. 16, 2013
	 Description : for listing thoughts
    */
    function admin_thoughts_listing(){
	 $this->layout='admin';
	 $this->set('pagetitle',"Thought Listing");
	 $this->loadModel('Thought');
	 $thoughts = $this->Thought->find('all');
	 $this->set('thoughts',$thoughts);
	 //pr($thoughts);die;
    }
   
   /*
	 Function Name: admin_thought_status
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Sep. 16, 2013
	 Description : for changing status
    */
   function admin_thought_status($id){
	$this->autoRender = false;
	$this->loadModel('Thought');
	$id = base64_decode($id);
	$this->data['Thought']['id'] = $id;
	$status = $this->Thought->find('first',array('conditions'=>array('Thought.id'=>$id),'fields'=>array('status')));
	if($status['Thought']['status'] == 0) {
	    $this->Thought->updateAll(array('Thought.status' => 0)); // updating status of all records to Deactive
	    $this->data['Thought']['status'] = 1;
	}
	if($this->Thought->save($this->data)){
	    $this->Session->setFlash('Thought Status  has been changed.','message/green');
	    $this->redirect(array('controller'=>'admins','action'=>'admin_thoughts_listing'));
	}
    }
    
    /*
	 Function Name: admin_delete_thought
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Sep. 16, 2013
	 Description : for delete thought
    */
    function admin_delete_thought($id){
	$id = base64_decode($id);
	$this->loadModel('Thought');
	if($this->Thought->delete($id)){
	    $this->Session->setFlash('Thought has been deleted.','message/green');
	    $this->redirect(array('controller'=>'admins','action'=>'admin_thoughts_listing'));
	}
    }
    
    /*
	 Function Name: admin_add_thought
	 params: Null
	 Created BY:Sunny Chauhan
	 Created ON : Sep. 16, 2013
	 Description : for add/update thought
    */
    function admin_add_thought($id = null){
		$this->loadModel('Thought');
  		$this->layout = 'admin';
		    if(!empty($id)){
			$this->set('pagetitle','Update Thought');
			$id = base64_decode($id);
			$this->set('id',$id);
		    }else{
			$this->set('pagetitle','Add Thought');
		    }
		    if(!empty($this->data)){
			    if(!empty($id)){
				    $this->Thought->id = $id;
			    }
			    if($this->data['Thought']['status'] == 1){
				 $this->Thought->updateAll(array('Thought.status' => 0));  // updating status of all records to Deactive
				 $this->data['Thought']['status'] = 1;                     // making current Thought status active
			    }
			    if($this->Thought->save($this->data)){
				if(empty($id)){
				    $this->Session->setFlash('Thought has been added.','message/green');
				}else{	
				    $this->Session->setFlash('Thought has been updated.','message/green');
				}
				$this->redirect(array('controller'=>'admins','action'=>'admin_thoughts_listing'));
			    }
		    }elseif(!empty($id)){
			    $this->Thought->id = $id;
			    $this->data = $this->Thought->read();
		    }
    }
    
}
?>