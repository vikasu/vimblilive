<?php

/**
* Class Name: CommonsController it extends class AppController
* Description: This class is for controlling all the common functions 
* By - Amit
*/

class CommonsController extends AppController {

	var $name = 'Commons';
	var $uses = array('User','Password_token','UserBio','Country','Message');
	var $helpers = array('Html', 'Form');
	var $components = array('Sendemail','Session','Cookie');
	//var $paginate = array('limit' => 10);
	
	/**
	 * Function : beforeFilter
	 * Description : For every action of User controller, control first come here
	 * Parameter : no
	 * Return : no
	 */
	
	
	function beforeFilter()
	{
		parent::beforeFilter();
	}
	
	
	/**
	 * Function : industryList
	 * Description : Manage array of Industry
	 * Parameter : no
	 * Return : $industryArray
	 */
	
	
	function industryList(){
		$this->layout = "";
		$this->autoRendar = false;
		$industryArray = array(
								'Agriculture' =>'Agriculture',
								'Mining' => 'Mining',
								'Construction'=> 'Construction',
								'Finance, Insurance, Real Estate' => 'Finance, Insurance, Real Estate',
								'Government' => 'Government',
								'Health Care' => 'Health Care',
								'Internet & Technology' => 'Internet & Technology',
								'Manufacturing' => 'Manufacturing',
								'Retail, Wholesale' => 'Retail, Wholesale',
								'Services' => 'Services',
								'Transportation' => 'Transportation',
								'Telecommunications' => 'Telecommunications', 
								'Utilities' => 'Utilities',
								'Nonprofit' => 'Nonprofit',
								'Other' => 'Other'
								);
		
		return $industryArray;
		
	}
	
	function getHeightFt(){
		$this->layout = "";
		$this->autoRendar = false;
		$ftArray = array(
							   '3'=>'3',	
							   '4'=>'4',
							   '5'=>'5',
							   '6'=>'6',
							   '7'=>'7',
							   '8'=>'8',
							   '9'=>'9'							   
								);
		return $ftArray;		
	}

	function getHeightInch(){
		$this->layout = "";
		$this->autoRendar = false;
		$inArray = array(
							   '1'=>'1',
							   '2'=>'2',
							   '3'=>'3',	
							   '4'=>'4',
							   '5'=>'5',
							   '6'=>'6',
							   '7'=>'7',
							   '8'=>'8',
							   '9'=>'9',	
							   '10'=>'10',
							   '11'=>'11'
								);
		return $inArray;		
	}	
	

	/**
	 * Function : relationShipList
	 * Description : Manage Gender
	 * Parameter : no
	 * Return : $genderArray
	 */
	
	
	function getGender(){
		$this->layout = "";
		$this->autoRendar = false;
		$genderArray = array(
							   'Male'=>'Male',	
							   'Female'=>'Female',		
								);
		return $genderArray;		
	}
	
	/**
	 * Function : relationShipList
	 * Description : Manage array of relationShip
	 * Parameter : no
	 * Return : $relationShipArray
	 */
	
	
	function relationShipList(){
		$this->layout = "";
		$this->autoRendar = false;
		$relationShipArray = array('Single'=>'Single',
								   'In a relationship'=>'In a relationship',	
								   'Married'=>'Married',
								   'In a relationship'=>'In a relationship',
								   'Divorced or separated' =>'Divorced or separated',
								   'Widowed' =>'Widowed',
								   'Other' =>'Other'		
								);
		return $relationShipArray;		
	}		
	
	
	/**
	 * Function : incomeList
	 * Description : Manage array of Income
	 * Parameter : no
	 * Return : $incomeArray
	 */
	
	function incomeList(){
		$this->layout = "";
		$this->autoRendar = false;
		$incomeArray =  array('Less than $10,000'=>'Less than $10,000',
							  '$10,000 to $19,999' => '$10,000 to $19,999',
							  '$20,000 to $29,999' => '$20,000 to $29,999',
							  '$30,000 to $39,999' => '$30,000 to $39,999',
							  '$40,000 to $49,999' => '$40,000 to $49,999',
							  '$50,000 to $59,999' => '$50,000 to $59,999',
							  '$60,000 to $69,999' => '$60,000 to $69,999',
							  '$70,000 to $79,999' => '$70,000 to $79,999',
							  '$80,000 to $89,999' => '$80,000 to $89,999',
							  '$90,000 to $99,999' => '$90,000 to $99,999',
							  '$100,000 to $149,999' => '$100,000 to $149,999',
							  '$150,000 or more' =>'$150,000 or more',
							  'Other' => 'Other'
							 );
		return $incomeArray;
	}
	
	
	
	/**
	 * Function : educationList
	 * Description : Manage array of education
	 * Parameter : no
	 * Return : $educationArray
	 */
	
	function educationList(){
		$this->layout = "";
		$this->autoRendar = false;
		$educationArray =  array('Less than high school' =>'Less than high school',
								 'High school' => 'High school',
								 'Some college'=> 'Some college',
								 'Associate or bachelor'=>'Associate or bachelor',
								 'Graduate' =>'Graduate',
								 'Other'=>'Other'
								);
		return $educationArray;
	}
	
	
	/**
	 * Function : employementList
	 * Description : Manage array of employement
	 * Parameter : no
	 * Return : $employmentArray
	 */
	
	function employementList(){
		$this->layout = "";
		$this->autoRendar = false;
		$employmentArray = array('Full-time (more than 30 hours)'=>'Full-time (more than 30 hours)',
								 'Part-time/casual job' =>'Part-time/casual job',
								 'Home maker' => 'Home maker',
								 'Full-time student' => 'Full-time student',
								 'Retired' => 'Retired',
								 'Out of work - looking for work' => 'Out of work - looking for work',
								 'Out of work - currently not looking for work'=>'Out of work - currently not looking for work',
								 'Unable to work' =>'Unable to work',
								 'Other' => 'Other'
								);
		return $employmentArray;
	}
	
	
	/**
	 * Function : workList
	 * Description : Manage array of $work
	 * Parameter : no
	 * Return : $workArray
	 */
	
	function workList(){
		$this->layout = "";
		$this->autoRendar = false;
		$workArray =  array(
							'Upper management' => 'Upper management',
							'Middle management' => 'Middle management',
							'Junior management' => 'Junior management',
							'Administrative staff' => 'Administrative staff',
							'Support staff' => 'Support staff',
							'Student' => 'Student',
							'Trained professional' => 'Trained professional',
							'Skilled laborer' =>'Skilled laborer',
							'Consultant' => 'Consultant',
							'Temporary employee' => 'Temporary employee',
							'Researcher' => 'Researcher',
						    'Self-employed' => 'Self-employed', 
							'Other' => 'Other'
							);
		return $workArray;
	}
	
	
	/**
	 * Function : relViewList
	 * Description : Manage array of religion View
	 * Parameter : no
	 * Return : $relViewArray
	 */
	
	
	function relViewList(){
		$this->layout = "";
		$this->autoRendar = false;
		$relViewArray =  array(
								'Protestant Christian' => 'Protestant Christian',
								'Roman Catholic' => 'Roman Catholic',
							    'Evangelical Christian' => 'Evangelical Christian',
								'Jewish'=>'Jewish',
								'Muslim' => 'Muslim',
								'Hindu' => 'Hindu',
								'Buddhist' => 'Buddhist',
								'Other' => 'Other'
							  );
		return $relViewArray;
	}
	
	
	/**
	 * Function : polViewList
	 * Description : Manage array of Political View
	 * Parameter : no
	 * Return : $polViewArray
	 */
	
	
	function polViewList(){
		$this->layout = "";
		$this->autoRendar = false;
		$polViewArray =  array(
								'Left (Liberal)' => 'Left (Liberal)',
								'Right (Conservative)' => 'Right (Conservative)',
								'Centrist' => 'Centrist',
								'Other' => 'Other'
							  );
		return $polViewArray;
	}
	
	
	/**
	 * Function : livingList
	 * Description : Manage array of living View
	 * Parameter : no
	 * Return : $livingViewArray
	 */
	
	function livingList(){
		$this->layout = "";
		$this->autoRendar = false;
		$livingViewArray =  array(
								'Own' => 'Own',
								'Rent' => 'Rent', 
								'Live with parents/family/friends' => 'Live with parents/family/friends',
								'Other' => 'Other'
							  );
		return $livingViewArray;
	}
	
	
	/**
	 * Function : relActivityList
	 * Description : Manage array of Religion Activity
	 * Parameter : no
	 * Return : $relActivityArray
	 */
	
	
	
	function relActivityList(){
		$this->layout = "";
		$this->autoRendar = false;
		$relActivityArray =  array(
									'Regular participant' =>'Regular participant',
									'Infrequent participant/ Lapsed'=> 'Infrequent participant/ Lapsed',
									'Other' =>'Other'
								  );
		return $relActivityArray;
	}
	
	
	/**
	 * Function : countryList
	 * Description : Manage array of Country
	 * Parameter : no
	 * Return : $countryListArray
	 */
	
	function countryList(){
		$this->layout = "";
		$this->autoRendar = false;
		
		$countryListArray = $this->Country->find('list',array('fields'=>array('Country.id','Country.country')));
		return $countryListArray;
		
	}
	
	
	/**
	 * Function : linkMgrList
	 * Description : Manage array of link
	 * Parameter : no
	 * Return : $linkMgrArray
	 */
	
	function linkMgrList()
	{
		$this->layout = "";
		$this->autoRendar = false;
		
		$linkMgrArray = array(
								'1'=>'1',
								'2'=>'2',
								'3'=>'3',
								'4'=>'4',
								'5'=>'5',
								'6'=>'6',
								'7'=>'7',
								'8'=>'8',
								'9'=>'9',
								'10'=>'10'	
							); 
		
		return $linkMgrArray;
	}
	
	/**
	 * Function : testdata
	 * Description : Manage array of test data (only used for testing purposes)
	 * Parameter : no
	 * Return : $testDataArray
	 */
	
	function testdata()
	{
		$this->layout = "";
		$this->autoRendar = false;
	
		$testDataArray = array(
				'test1'=>'test1',
				'test2'=>'test2',
				'test3'=>'test3',
				'test4'=>'test4',
				'test5'=>'test5',
				'test6'=>'test6',
				'test7'=>'test7',
				'test8'=>'test8',
				'test9'=>'test9',
				'test10'=>'test10'
		);
	
		return $testDataArray;
	}
	
	
	/**
	 * Function : findCountry
	 * Description : Used for find country
	 * Parameter : $id
	 * Return : $countryData
	 */
	
	
	function findCountry($id){
		
		$this->layout = "";
		$this->autoRendar = false;
		$countryData = $this->Country->find('first',array('conditions'=>array('Country.id'=>$id)));
		return $countryData; 
	}
	
	
	/**
	 * Function : findUserById
	 * Description : Used for find user
	 * Parameter : $id
	 * Return : $userData
	 */
	
	function findUserById($id){
	
		$this->layout = "";
		$this->autoRendar = false;
		$this->User->recursive=-1;
		$userData = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
		return $userData;
	}
	
	/**
	 * Function : countryNameList
	 * Description : find country based on Name
	 * Parameter : $id
	 * Return : $userData
	 */
	
	function countryNameList($name=null){
		$this->layout = "";
		$this->autoRendar = false;
	    if($name!=null)
	    {
			$countryNameListArray = $this->Country->find('first',array('conditions'=>array('Country.country'=>$name)));
			return $countryNameListArray;
	    }
	}	
	
	/**
	 * Function : priorityList
	 * Description : manage array of priority
	 * Parameter : no
	 * Return : $priortyArray
	 */
	
	function priorityList()
	{
		$this->layout = "";
		$this->autoRendar = false;
		$priortyArray = array();
		for($i=1;$i<=50;$i++)
		{
			$priortyArray[$i] = $i;
		}
		return $priortyArray;
	}
	
	
	/**
	 * Function : messageType
	 * Description : manage array of messageType
	 * Parameter : no
	 * Return : $messageTypeArray
	 */
	
	
	function messageType()
	{
		$this->layout = "";
		$this->autoRendar = false;
		$messageTypeArray = array('Message','Notification','Warning');
		return $messageTypeArray;
	}
	
	
	/**
	 * Function : subjectType
	 * Description : manage array of subjectType
	 * Parameter : no
	 * Return : $subjectTypeArray
	 */
	
	
	function subjectType()
	{
		$this->layout = "";
		$this->autoRendar = false;
		$subjectTypeArray = array('Message'=>'Message','Suggestion'=>'Suggestion','Idea'=>'Idea');
		return $subjectTypeArray;
	}
	
	
	/**
	 * Function : UserList
	 * Description : manage list of User
	 * Parameter : no
	 * Return : $userArray
	 */
	
	
	function UserList()
	{
		$this->layout = "";
		$this->autoRendar = false;
		$userArray = $this->User->find('list',array('conditions'=>array('User.user_type'=>0)));
		return $userArray;
	}
	
	
	/**
	 * Function : commonGoalMinList
	 * Description : manage array of minutes
	 * Parameter : no
	 * Return : $userArray
	 */
	
	
	function commonGoalMinList()
	{
		$this->layout = "";
		$this->autoRendar = false;
		
		$commonGoalMinArray = array("45"=>"45", "60"=>"60", "90"=>"90", "120"=>"120");
		return $commonGoalMinArray;
		
	}
	
	
	/**
	 * Function : commonGoalMinList
	 * Description : manage array of minutes
	 * Parameter : no
	 * Return : $userArray
	 */
	
	
	function commonDaySchList()
	{
		$this->layout = "";
		$this->autoRendar = false;
	
		$commonDaySchArray = array('0'=>'0%','25'=>'25%','50'=>'50%','75'=>'75%'); 
		return $commonDaySchArray;
	
	}
	
	
	/**
	 * Function : countUnreadMsgById
	 * Description : Count unread messages By passed Id
	 * Parameter : $id
	 * Return : no of messages list
	 */
	
	
	function countUnreadMsgById($id = null)
	{
		$this->layout = "";
		$this->autoRendar = false;
	
		$msgList = $this->Message->find('all',array('conditions'=>array('Message.user_id_to'=>$id,'Message.message_status'=>0)));
		return $msgList;
		
	}
	

	
}
	
	
