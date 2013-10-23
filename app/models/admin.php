<?php

    // app/models/sportcategory.php
    class Admin extends AppModel {
        var $name = 'Admin';
	var $errMsg = array();
	
	var $validate = array(
	    
	    'name' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => CLIENT_FIRST_NAME,
			'last' => true,
		)
	    ),
	    'pwd' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => PASSWORD_EMPTY,
			'last' => true,
			)
	    ),
	    'confirmpassword' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => CONFIRM_PASSWORD_EMPTY,
			'last' => true,
			),
			'comparePasswords' => array(
				'rule' => array('comparePasswords'),
				'message' => PASSWORD_NOT_MATCH
			)
	    ),
	    'email' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => ADMIN_EMAIL_EMPTY,
			'last' => true,
			),
		'email' => array(
			'rule' => array('email'),
			'message' => INVALID_EMAIL,
			'last' => true,
		),
		'isUnique' => array(
			'rule' => 'isUnique',
			'message' => ADMIN_EMAIL_EXIST
			)
	    )
	);
	
	
	var $validateChangePassword = array(
	    
	    'oldpassword' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => ADMIN_OLD_PASSWORD_EMPTY,
			'last' => true,
			),
			'checkoldpassword' => array(
				'rule' => array('checkoldpassword'),
				'message' => ADMIN_OLD_PASSWORD_WRONG
			)
	    ),
	    'pwd' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => PASSWORD_EMPTY,
			'last' => true,
			)
	    ),
	    'confirmpassword' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => CONFIRM_PASSWORD_EMPTY,
			'last' => true,
			),
			'comparePasswords' => array(
				'rule' => array('comparePasswords'),
				'message' => PASSWORD_NOT_MATCH
			)
	    ),
	    'email' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => EMAIL_EMPTY,
			'last' => true,
			),
		'email' => array(
			'rule' => array('email'),
			'message' => INVALID_EMAIL,
			'last' => true,
		),
		'isUnique' => array(
			'rule' => 'isUnique',
			'message' => ADMIN_EMAIL_EXIST
			)
	    )
	);
	
	function comparePasswords(){
	    if(trim($this->data['Admin']['confirmpassword']) != trim($this->data['Admin']['pwd']))
		return false;
	    else
		return true;
	}
	
	function checkusername($field = null){
            $userExist = $this->find('count',array('conditions'=>array('Admin.username'=>$field)));
	    if($userExist>0) 
                return false;
            else 
                return true;
        }
	
	function checkemail($field = null){
            $emailExist = $this->find('count',array('conditions'=>array('Admin.email'=>$field)));
	    if($emailExist>0) 
                return false;
            else 
                return true;
        }
	
	function checkoldpassword(){
            $id = $_SESSION['Auth']['User']['id'];
	    $oldpass = $this->data['Admin']['oldpassword'];
	    $field =Security::hash (Configure::read ('Security.salt') . $oldpass);
	    $correctPass = $this->find('count',array('conditions'=>array('Admin.id'=>$id,'Admin.password'=>$field)));
	    if($correctPass>0) 
		return true;
            else
		return false;
        }
	

	/*
	 * Refrance : Function for the custom validation 
	 */
	function validate_admin_user($post_array){
	    
	    if(isset($post_array['Admin']['username'])) {
		if(trim($post_array['Admin']['username']) == ""){
		    $this->errMsg['username'][] = "Enter the Username"."\n";
		}
		if(trim($post_array['Admin']['username']) != ""){
		    if(!$this->checkusername($post_array['Admin']['username'])){
			$this->errMsg['username'][] = "Username already exist, Please try some diffrent Username"."\n";
		    }
		}
	    }
	    return $this->errMsg;
	}
	
	
	function parentNode() {
	    //pr($this->id);pr($this->data);exit;
	    if (!$this->id && empty($this->data)) {
	    return null;
	    }
	    if (isset($this->data['Admin']['group_id'])) {
	    $groupId = $this->data['Admin']['group_id'];
	    } else {
	    $groupId = $this->field('group_id');
	    }
	    if (!$groupId) {
	    return null;
	    } else {
	    return array('Group' => array('id' => $groupId));
	    }
	}
	
	
	
}
?>