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
class StrengthValuesController extends AppController{

	var $name 	= 'StrengthValues';
	var $uses 	= array('StrengthValue','CoreValue','Activity','ActivityType','Connection','ConnectionGroup','ConnectionPhone','ConnectionEmail','ConnectionAddress','ConGroupRelation');
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
		$this->set('heading','StrengthValues');
		$this->set('pagetitle',"StrengthValues");
		//pr($_SESSION['Auth']['User']['id']);die;
		
		//set saved strength values
		$find_strength_values = $this->StrengthValue->find('first', array('order'=>array('StrengthValue.created DESC'))); 
		//pr($find_strength_values);die;
		$stValArr = array();
		for($i=1; $i<=7; $i++)
		{
			if($find_strength_values['StrengthValue'][$i] != ""){
				$stValArr[]=trim($find_strength_values['StrengthValue'][$i]);
				$this->data['StrengthValue'][$i] = $find_strength_values['StrengthValue'][$i];
			}
		}
		//pr($this->data); die;
		$this->set(compact('stValArr'));
		
	}
    
  }//end class
?>