<?php
    // app/models/User.php
    class User extends AppModel {
        var $name = 'User';
	
	var $hasAndBelongsToMany = array(
	    'UserGroup' => array(
		    'className' => 'UserGroup',
		    'foreignKey'=> 'user_id',
		    'associationForeignKey' => 'group_id',
		    'joinTable' => 'user_groups_users',
		    'unique' => true
	
		) 
	    );
	
	var $hasOne = array(
	    'CohortUser' => array(
		    'className' => 'CohortUser',
		    'foreignKey'=> 'user_id'
		),
	    'SponsorManager' => array(
		    'className' => 'SponsorManager',
		    'foreignKey'=> 'sponsor_id'
		) 
	    );
	
	var $belongsTo = array(
	    'SubscriptionPlan' => array(
		    'className' => 'SubscriptionPlan',
		    'foreignKey'=> 'subscription_plan_id',
		    //'dependent'=> true
		)
	    );
	
	var $errMsg = array();
	
	var $validate = array(
	    
	    'name' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => CLIENT_FIRST_NAME,
			'last' => true,
		)
	    ),
	    'password' => array(
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
	    ),
	    'birth_day' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => 'Please enter day of birth',
			'last' => true,
		)
	    ),
	    'birth_month' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => 'Please enter month of birth',
			'last' => true,
		)
	    ),
	    'birth_year' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => 'Please enter year of birth',
			'last' => true,
		)
	    )
	);
	
	//Validation for sign_up form (Vikas Uniyal @ Nov 30, 2012)
	var $validateSignUp = array(
	    
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
			),
		'minLength' => array(
			'rule' => array('minLength', '2'),
			'message' => MIN_PASS_LEN,
			'last' => true,
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
	    ),
	    'birth_day' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => 'Please enter day of birth',
			'last' => true,
		)
	    ),
	    'birth_month' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => 'Please enter month of birth',
			'last' => true,
		)
	    ),
	    'birth_year' => array(
		'notEmpty' => array(
			'rule' => array('notEmpty'),
			'message' => 'Please enter year of birth',
			'last' => true,
		)
	    )	    
	);
	
	//Validation for login form (Vikas Uniyal @ Dec 03, 2012)
	var $validateLogin = array(
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
		))    
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
	    'password' => array(
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
			)
	    )
	);
	
	function comparePasswords(){
	    if(trim($this->data['User']['confirmpassword']) != trim($this->data['User']['password']))
		return false;
	    else
		return true;
	}
	
	function checkemail($field = null){
            $emailExist = $this->find('count',array('conditions'=>array('User.email'=>$field)));
	    if($emailExist>0) 
                return false;
            else 
                return true;
        }
	
	function checkoldpassword(){
            $id = $_SESSION['User']['User']['id'];
	    $oldpass = $this->data['User']['oldpassword'];
	    $field =Security::hash (Configure::read ('Security.salt') . $oldpass);
	    $correctPass = $this->find('count',array('conditions'=>array('User.id'=>$id,'User.password'=>$field)));
	    if($correctPass>0) 
		return true;
            else
		return false;
        }
	

}
?>