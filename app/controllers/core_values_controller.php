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
class CoreValuesController extends AppController{

	var $name 	= 'CoreValues';
	var $uses 	= array('CoreValue','Activity','ActivityType','Connection','ConnectionGroup','ConnectionPhone','ConnectionEmail','ConnectionAddress','ConGroupRelation');
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
		$this->layout = '';
		$this->set('heading','Core Values');
		$this->set('pagetitle',"CoreValues");                
		
	}
    
  }//end class
?>