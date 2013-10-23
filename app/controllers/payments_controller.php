<?php 
class PaymentsController extends AppController{
	public $uses = array('PromotionalCode','Transaction','SubscriptionPlan');
	var $helpers 	= array('Html','Javascript','Ajax','Form','Session','Common');
	var $components = array ('RequestHandler','Cookie','Email','Auth','Common','Paypal');
	
	/**
	@function:beforeFilter 
	@description: function call before any function
	@Created by: Sunny Chauhan
	@Modify:NULL
	@Created Date:July. 18, 2013
	*/
	function beforeFilter(){
		$this->Auth->allow('renewal_reminder','payment','payment_failure','user_payment','notify_url','return_url','thankyou');
        }
	
	/**
	@function:admin_index 
	@description:listing of promotional code in backend
	@Created by: Sunny Chauhan
	@Modify:NULL
	@Created Date:July. 18, 2013
	*/
	function admin_index(){
		$this->set('pagetitle','Promotional Codes');
		$this->layout='admin';
		$codes = $this->PromotionalCode->find('all');
		$this->set('codes',$codes);	
        }
	
	/**
	@function:admin_delete_code 
	@description:delete promotional code in backend
	@Created by: Sunny Chauhan
	@Modify:NULL
	@Created Date:July. 18, 2013
	*/
	function admin_delete_code($id=null){
		//echo "sam"; die;
		//$this->autoRender=false;
		$this->loadModel('PromotionalCode');
		$id = base64_decode($id);
		if($this->PromotionalCode->delete($id)){
			$this->Session->setFlash('Code has been deleted.','message/green');
			$this->redirect(array('action' => 'index'));
		}	
        }
	
	 /**
	@function:admin_index 
	@description:add/edit code in backend
	@Created by:Sunny Chauhan
	@Modified by:Sanchit Negi
	@Created Date:July. 18, 2013
	@Modify:July. 22, 2013
	*/
	function admin_add_code($id=null){
		if(!empty($this->data)){
			//pr($this->data); die;
		}
		$this->set('pagetitle','Add Promotional Codes');
		$this->loadModel('PromotionalCode');
  		$id = base64_decode($id);
		$this->layout = 'admin';
		if($id){
			$this->set('unique_code',$unique_code);
		}
		else{
			$unique_code = $this->random_gen(6);
			$this->set('unique_code',$unique_code);			
		}
		if(!empty($this->data)){
			$this->loadModel('PromotionalCode');
			if(!empty($id)){
				$this->PromotionalCode->id =$id;
			}
			
			if($this->PromotionalCode->save($this->data)){
				$this->Session->setFlash('Code has been added.','message/green');
				//$this->redirect(array('controller'=>'payments','action'=>'admin_index'));
				$this->redirect(array('controller'=>'payments','action'=>'index'));
				
			}else{
				$this->Session->setFlash('Code Already Exist , Try Another One.','message/red');
				$this->redirect(array('controller'=>'payments','action'=>'index'));
			}
		}else{
			$this->PromotionalCode->id = $id;
			$this->data = $this->PromotionalCode->read();
			
		}
	}
	
	
	
	/**
	 @function:admin_subscription
	@description:listing of subscription plan in backend
	@Created by:Sanchitg Negi
	@Modify:NULL
	@Created Date:July. 19, 2013*/
	function admin_subscription(){
		$this->set('pagetitle','Subscription Plans');
		//$this->set('pagetitle','UserReflection');
		$this->layout='admin';
		$this->loadModel('SubscriptionPlan');
		$plan = $this->SubscriptionPlan->find('all');
		//pr($plan);die;
		$this->set('plan',$plan);	
        }
	/**
	 @function:admin_add_plan
	@description:Add of subscription plan in backend
	@Created by:Sanchitg Negi
	@Modify:NULL
	@Created Date:July. 19, 2013*/
	
	function admin_add_plan($id=null){
		$this->set('pagetitle','Add  ,Subscription Plans');
		$this->loadModel('SubscriptionPlan');
  		$id = base64_decode($id);
		$this->layout = 'admin';
		if(!empty($this->data)){

			if(!empty($id)){
				$this->SubscriptionPlan->id = $id;	
			}
			
			if($this->data['SubscriptionPlan']['user_limit'] == ''){
				$this->data['SubscriptionPlan']['user_limit'] = 1;
			}

			if($this->SubscriptionPlan->save($this->data)){
				$this->Session->setFlash('Plan has been added.','message/green');
				$this->redirect(array('controller'=>'payments','action'=>'subscription'));
			}
		}else{
			if(!empty($id)){
				$this->set('id',$id);	
			}
			
			$this->SubscriptionPlan->id = $id;
			$this->data = $this->SubscriptionPlan->read();
		}
	}
	
	/**
	 @function:deactivated_users
	@description:Deactive user
	@Created by:Sunny Chauhan
	@Modify:NULL
	@Created Date:July. 22, 2013*/
	
	function deactivated_user($id=null){
		$this->set('pagetitle','Deactivate User');
		$this->layout = 'individual_dashboard';		
		//Transaction Info
		$transInfo = $this->Transaction->find('first',array('conditions'=>array('Transaction.user_id'=>$_SESSION['Auth']['User']['id']),'order'=>'Transaction.id DESC'));
		$thirtyDaysPlus = strtotime('+1 year' , strtotime ($transInfo['Transaction']['sub_date']));
		$after1yr = date('Y-m-d H:i:s', $thirtyDaysPlus);
		$this->set('acDelDate',$after1yr);
	}
	
	/**
	@function:admin_delete_plan 
	@description:delete plan in backend
	@Created by: Sanchit Negi
	@Modify:NULL
	@Created Date:July. 22, 2013
	*/
	function admin_delete_plan($id){
		$this->loadModel('SubscriptionPlan');
		$id = base64_decode($id);
		if($this->SubscriptionPlan->delete($id)){
			$this->Session->setFlash('Plan has been deleted.','message/green');
			$this->redirect(array('controller'=>'payments','action'=>'admin_subscription'));	
		}	
        }
	
	/**
	@function:subscription_plans 
	@description: listing of subscription plan
	@Created by: Sunny Chauhan
	@Modify:NULL
	@Created Date:July. 23, 2013
	*/
	function subscription_plans($id=NULL){
		if(isset($id)){
			$id = base64_decode($id);	
		}
		$this->set('pagetitle','Subscription Plan');
		$this->layout = 'individual_dashboard';
		$this->loadModel('SubscriptionPlan');
		$plans = $this->SubscriptionPlan->find('all');
		//pr($plans); die;
		//$this->set('individual_plans',$individual_plans);
		//$group_plans = $this->SubscriptionPlan->find('all',array('conditions'=>array('SubscriptionPlan.usertype'=>trim('Group'))));
		$this->set('plans',$plans);
        }
	
	/**
	@function:subscription_plans 
	@description: listing of subscription plan
	@Created by: Sunny Chauhan
	@Modify:NULL
	@Created Date:July. 23, 2013
	*/
	function payment(){
		$this->loadModel('SubscriptionPlan');
		$this->layout = 'inner_pages';
		if(!empty($this->data)){
			$payment = $this->SubscriptionPlan->findById($this->data['SubscriptionPlan']['plan_id']);
			//pr($payment); die;
			$this->set('payment',$payment);
			//$this->redirect('http://www.google.com');
		}else{	
			$payment['SubscriptionPlan']['amount']="";
			$payment['SubscriptionPlan']['plan_title']="";
			$this->set('payment',$payment);
		}
		$this->set('pagetitle','Payment');
        }
	
	
	/** 
	@function : charge_card 
	@description : Processes payments for subscription plans.
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : July 25, 2013
        */
	/*
  	public function charge_card() {
	       try {
			$this->autoRender = false;
			
			$this->loadModel('PromotionalCode');
			$current_date = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
			if($_POST['promoCode']!='')
			{
				//pr($_POST['promoCode']);
				$getPromoInfo = $this->PromotionalCode->find('first',array('conditions'=>array('PromotionalCode.expiration_date >='=>$current_date,'PromotionalCode.unique_code'=>$_POST['promoCode'])));
			}
			
			//pr($getPromoInfo); die;
			if(is_array($getPromoInfo))
			{	
				$lessAmt = ($_POST['subscriptionAmount'] * $getPromoInfo['PromotionalCode']['amount'])/100;
				$reqAmt = $_POST['subscriptionAmount'] - $lessAmt;
			}
			else
			{	
				$reqAmt = $_POST['subscriptionAmount'];	
			}
			//pr($_POST); die;
			//echo $reqAmt; die;
			$this->Paypal->amount = $reqAmt;
			$this->Paypal->currencyCode = $_POST['cccode'];
			$this->Paypal->creditCardNumber = trim($_POST['cardnumber']);// 4008068706418697 Paypal sandbox CC
			$this->Paypal->creditCardCvv = $_POST['cvv2Number']; //123
			$this->Paypal->creditCardExpires = $_POST['expDateMonth'].''.$_POST['expDateYear']; //012020
			$this->Paypal->creditCardType = $_POST['creditCardType'];
			$result = $this->Paypal->doDirectPayment();
			//echo '<pre>';print_r($result);die;
			//pr($_POST); die;
			//Sent Email
			$this->loadModel('User');
			$currentUser = $_SESSION['Auth']['User']['id'];
			
			$planInfo = $this->SubscriptionPlan->find('first',array('conditions'=>array('SubscriptionPlan.id'=>$_POST['plan_id'])));
			$this->Email->smtpOptions = array(
				'port'=>SMTP_PORT,
				'timeout '=> SMTP_TIME_OUT,
				'host' => SMTP_HOST,
				'username'=>SMTP_USER_NAME,
				'password'=>SMTP_PASSOWRD 
			);
			$this->Email->sendAs= 'html';
			
			//import emailTemplate Model and get template
			//Fetch content of 'DAILY_REMINDER'
			$template = $this->Common->getEmailTemplate(21);
			//pr($template); die;
			$this->Email->from = INFO_EMAIL;
			$this->Email->subject = $template['EmailTemplate']['subject'];
			$data=$template['EmailTemplate']['description'];
			$data=str_replace('{NAME}',$_SESSION['Auth']['User']['name'],$data);
			$data=str_replace('{PLAN_TITLE}',$planInfo['SubscriptionPlan']['plan_title'],$data);
			$data=str_replace('{AMOUNT}',' '.'$'.$reqAmt,$data);
			//pr($data); die;
			$this->set('data',$data);
			$this->Email->to = $_SESSION['Auth']['User']['email'];
			//$this->Email->to = "smaartdatatest@gmail.com";
			$this->Email->template='commanEmailTemplate';
			$this->Email->send(); 
			
			//pr($check_PrevEntry); die;
			$getSubsInfo = $this->SubscriptionPlan->findById($_POST['subscriptionType']);
			
			$frequency = '+'.$getSubsInfo['SubscriptionPlan']['plan_months'].' Month';
			$requiredDate = strtotime ($frequency,strtotime($current_date));
			$expiry_date = date('Y-m-d H:i:s',$requiredDate);
			
			$result["user_id"] = $currentUser;
			$result["expiry_date"] = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],$expiry_date)));
			$result["type"] = 'paid';
			$result["sub_date"] = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
			$result["plan_id"] = $_POST['plan_id'];
			$result["success"] = 1; 
			$this->Transaction->create();
			//pr($result); die;
			
			if($this->Transaction->save($result))
			{
				//make dormant => 0 for the user i.e activate user
				$dorStatus = 0; 
				$this->User->updateAll(array('User.dormant_user'=>"'$dorStatus'"),array('User.id'=>$_SESSION["Auth"]["User"]["id"]));
				
				$this->Session->setFlash('Transaction successful.', 'default', array('class' => 'flash_success'));
				if($getSubsInfo['SubscriptionPlan']['usertype'] == 'GM'){//i.e group manager
					//echo 1; die;
					$_SESSION['User']['reload'] = 1;
					$redirectTo = SITE_URL.'groups/dashboard';
					header('Location: '.$redirectTo);
					exit;
				} else{ //echo 2; die;
					$redirectTo = SITE_URL.'users/welcome';
					header('Location: '.$redirectTo);
					exit;
				}
				echo 'Payment Successfull';die;
			}
			else
			{
				$this->Session->setFlash('Transaction Fail.', 'default', array('class' => 'flash_success'));
				$redirectTo = SITE_URL.'payments/subscription_plans';
				header('Location: '.$redirectTo);
				exit;
				//echo 'Error! Please Try Again.';die;
			}
	       }
	       catch(Exception $e)
	       {
		$this->Session->setFlash('Transaction Fail.', 'default', array('class' => 'flash_success'));
		$redirectTo = SITE_URL.'payments/subscription_plans';
		header('Location: '.$redirectTo);
		exit;
	       }
  	}
	*/
	
	/** 
	@function : charge_card 
	@description : Processes recurring payments for subscription plans.
	@params : NULL
	@Created by : Vikas Uniyal
	@Modify : NULL
	@Created Date : July 30, 2013
        */
	function charge_card() {
	      //pr($_POST); die;
		$this->autoRender = false;
		$current_date = date('Y-m-d H:i:s');
	      	
	        $this->Paypal->setIsTest(true); // PayPal test sandbox or live server
		
		// Your PayPal account credentials go here
		$this->Paypal->request['user'] = 'eddypawan-seller1_api1.gmail.com';
		$this->Paypal->request['pwd'] = '1367320435';
		$this->Paypal->request['signature'] = 'Af7b-k2jGmW.ajyumu9Q5FofHQ72AewpUfsstbWjRIszM-j0ih4AYbbb';
		// End PayPal account credentials
		
		// User info
		$this->Paypal->request['firstname'] = $_SESSION['Auth']['User']['name'];
		//$this->Paypal->request['lastname'] = $_SESSION['Auth']['User']['name'];
		$this->Paypal->request['email'] = $_SESSION['Auth']['User']['email'];
		
		$this->Paypal->request['creditcardtype'] = $_POST['creditCardType']; // Visa, Mastercard, Discover, Amex
		$this->Paypal->request['acct'] = trim($_POST['cardnumber']); // Credit card number
		//$this->Paypal->request['expdate'] = str_pad('8',2,'0', STR_PAD_LEFT)  .'2020'; // Expiration month and full year. Pad the month with 0. Month should be 1-12. This example is 8/2020.
		$this->Paypal->request['expdate'] = $_POST['expDateMonth'].''.$_POST['expDateYear'];
		// End user info
		//pr($_POST['billing_cycle']); die;	
		// Product info
		//$this->Paypal->request['countrycode'] = 'US';
		$this->Paypal->request['billingperiod'] = $_POST['billing_cycle']; // Bill per month
		$this->Paypal->request['billingfrequency'] = 1; // How many times to bill per billing period.. This example is once per month
		$this->Paypal->request['currencycode'] = 'USD';
		$this->Paypal->request['amt'] = number_format($_POST['subscriptionAmount'],2); // Amount to bill every month
		//$this->Paypal->request['initamt'] = 0.00; // Setup fee.. One time on account creation
		//$this->Paypal->request['taxamt'] = $this->Paypal->request['amt'] * .07; // Replace .07 with your tax percentage. 0 for no tax.
		$this->Paypal->request['desc'] = 'Vimbli sbscription'; // The description of your product for reporting in your account
		$this->Paypal->request['profilestartdate'] = gmdate('Y-m-d\TH:i:s\Z');
		$this->Paypal->request['totalbillingcycles'] = $_POST['plan_months']; // How many billing cycles. 0 for no expiration. This example is for 3 total months of billing.
		$this->Paypal->request['payerstatus'] = 'verified';
		// End product info
		//pr($this->Paypal->request); die;
		$this->PaypalResponse = $this->Paypal->sendRequest();
		
		if(isset($this->PaypalResponse['L_ERRORCODE0'])){
			$errMsg = "Error: {$this->PaypalResponse['L_LONGMESSAGE0']}";
			
			$this->Session->setFlash($errMsg, 'default', array('class' => 'flash_success'));
			$redirectTo = SITE_URL.'payments/subscription_plans';
			header('Location: '.$redirectTo);
			exit;
		}
		else if(isset($this->PaypalResponse['ACK']) && $this->PaypalResponse['ACK'] == ('Success' || 'SuccessWithWarning')){
			//echo "Success: {$this->PaypalResponse['ACK']}";
			//echo '<pre>'; print_r($this->PaypalResponse);
				
			
			//Save value in transactions table
			$getSubsInfo = $this->SubscriptionPlan->findById($_POST['subscriptionType']);
			
			$frequency = '+'.$getSubsInfo['SubscriptionPlan']['plan_months'].' Month';
			$requiredDate = strtotime ($frequency,strtotime($current_date));
			$expiry_date = date('Y-m-d H:i:s',$requiredDate);
			
			$result["Transaction"]["user_id"] = $_SESSION['Auth']['User']['id'];
			$result["Transaction"]["expiry_date"] = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],$expiry_date)));
			$result["Transaction"]["type"] = 'paid';
			$result["Transaction"]["sub_date"] = date('Y-m-d H:i:s',strtotime($this->Common->userTime($_SESSION['Auth']['User']['timezone'],date('Y-m-d H:i:s'))));
			$result["Transaction"]["plan_id"] = $_POST['plan_id'];
			$result["Transaction"]["AMT"] = number_format($_POST['subscriptionAmount'],2);
			$result["Transaction"]["payment_id"] = $this->PaypalResponse['PROFILEID'];
			$result["Transaction"]["success"] = 1;
			
			$this->Transaction->create();
			if($this->Transaction->save($result))
			{
				$dorStatus = 0; 
				$this->User->updateAll(array('User.dormant_user'=>"'$dorStatus'"),array('User.id'=>$_SESSION["Auth"]["User"]["id"]));
				
				//Sent Email:: START
				$this->loadModel('User');
				$currentUser = $_SESSION['Auth']['User']['id'];
				
				$planInfo = $this->SubscriptionPlan->find('first',array('conditions'=>array('SubscriptionPlan.id'=>$_POST['plan_id'])));
				$this->Email->smtpOptions = array(
					'port'=>SMTP_PORT,
					'timeout '=> SMTP_TIME_OUT,
					'host' => SMTP_HOST,
					'username'=>SMTP_USER_NAME,
					'password'=>SMTP_PASSOWRD 
				);
				$this->Email->sendAs= 'html';
				
				//import emailTemplate Model and get template
				//Fetch content of 'DAILY_REMINDER'
				$template = $this->Common->getEmailTemplate(21);
				//pr($template); die;
				$this->Email->from = INFO_EMAIL;
				$this->Email->subject = $template['EmailTemplate']['subject'];
				$data=$template['EmailTemplate']['description'];
				$data=str_replace('{NAME}',$_SESSION['Auth']['User']['name'],$data);
				$data=str_replace('{PLAN_TITLE}',$planInfo['SubscriptionPlan']['plan_title'],$data);
				$data=str_replace('{FULL_PRICE}',' '.'$'.number_format($planInfo['SubscriptionPlan']['amount'],2),$data);
				$data=str_replace('{EXPIRATION_DATE}',date('M. d, Y',strtotime($result["Transaction"]["expiry_date"])),$data);
				$data=str_replace('{FREQUENCY}',$planInfo['SubscriptionPlan']['plan_months'].' Months',$data);
				$promocode = $_POST['promoCode'];
				$data=str_replace('{PROMO_CODE}',$promocode,$data);
				$data=str_replace('{AMOUNT_DEDUCTED}','$'.number_format($_POST['subscriptionAmount'],2),$data);
				$new_card = "XXXX-XXXX-XXXX-" . substr($_POST['cardnumber'],-4,4);
				$data=str_replace('{CC_NUM}',$new_card,$data);
				
				//pr($data); die;
				$this->set('data',$data);
				$this->Email->to = $_SESSION['Auth']['User']['email'];
				//$this->Email->to = "sdd.sdei@gmail.com";
				$this->Email->template='commanEmailTemplate';
				$this->Email->send(); 
				//END EMAIL	
				
				$this->Session->setFlash('Transaction successful.', 'default', array('class' => 'flash_success'));
				if($getSubsInfo['SubscriptionPlan']['usertype'] == 'GM'){//i.e group manager
					//echo 1; die;
					$_SESSION['User']['reload'] = 1;
					$redirectTo = SITE_URL.'groups/dashboard';
					header('Location: '.$redirectTo);
					exit;
				} else{ //echo 2; die;
					$redirectTo = SITE_URL.'users/welcome';
					header('Location: '.$redirectTo);
					exit;
				}
			}else{
				echo "Error: {$this->PaypalResponse['L_LONGMESSAGE0']}";
				//die;
				$this->Session->setFlash('Transaction Fail.', 'default', array('class' => 'flash_success'));
				$redirectTo = SITE_URL.'payments/subscription_plans';
				header('Location: '.$redirectTo);
				exit;
			}
		}    
		else{
			print_r($this->PaypalResponse);
			exit;		    
		}
		
  	}
	
	//
	function process_payment(){
		$this->layout = false;
		$this->autoRender = false;
		
		//pr($_POST); die;
		
		$this->Paypal->environment = 'sandbox';	// or 'beta-sandbox' or 'live'
		$this->Paypal->paymentType = urlencode('Authorization');				// or 'Sale' or 'Order'
		
		// Set request-specific fields.
		$this->Paypal->startDate = "2013-8-20T0:0:0";
		$this->Paypal->billingPeriod = "Month";				// or "Day", "Week", "SemiMonth", "Year"
		$this->Paypal->billingFreq = "4";						// combination of this and billingPeriod must be at most a year
		$this->Paypal->paymentAmount = '1.00';
		$this->Paypal->currencyID = 'USD';							// or other currency code ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
		
		/* PAYPAL API  DETAILS */
		$this->Paypal->API_UserName = 'eddypawan-sellerz_api1.gmail.com';
		$this->Paypal->API_Password = '1375191939';
		$this->Paypal->API_Signature = 'AD7ZATDVRu4csWxoe2M-yURKZT1oA2pMBei7Gs8PxXGYrq9q7j-LkyaZ';
		$this->Paypal->API_Endpoint = "https://api-3t.paypal.com/nvp";
		
		/*SET SUCCESS AND FAIL URL*/
		$this->Paypal->returnURL = urlencode("http://www.vimbli.com/index.php?task=getExpressCheckout");
		$this->Paypal->cancelURL = urlencode("http://www.google.com");
		//pr($this->Paypal); die;
		
		$task="setExpressCheckout"; //set initial task as Express Checkout
		
		switch($task)
		{
			case "setExpressCheckout":
			$this->Paypal->setExpressCheckout();
			exit;
			case "getExpressCheckout":
			$this->Paypal->getExpressCheckout();
			exit;
			case "error":
			echo "setExpress checkout failed";
			exit;
		}
		
	}
	
	/**
	@function:subscription_plans 
	@description: listing of subscription plan
	@Created by:Sanchit Negi
	@Modify:NULL
	@Created Date:July. 24, 2013
	*/
	function payment_failure(){
		$this->layout = 'inner_pages';
		$payment['0']['SubscriptionPlan']['amount']="";
		$payment['0']['SubscriptionPlan']['plan_title']="";
		$this->set('payment',$payment);
		$this->set('paguser_paymentetitle','Payment Failure');
		
        }
	
	/**
	@function: 
	@description: sending email before 3 days of end subscription date
	@Created by:Suunny Chauhan
	@Modify:NULL
	@Created Date:July. 26, 2013
	*/
	function renewal_reminder(){
		//mail('smaartdatatest@gmail.com','SmartData', 'Smartdata Cron');
		$this->autoRender = false;
		$this->loadModel('Transaction');
		$this->loadMOdel('EmailTemplate');
		$all_Transaction = $this->Transaction->query('SELECT user_id, plan_id ,type,expiry_date,id FROM transactions where id In (select max(id) from transactions group by user_id) GROUP BY user_id');
		//$all_Transaction = $this->Transaction->find('all',array('fields'=>array('user_id','plan_id',"max(expiry_date)"),'group'=>'user_id'));
		//pr($all_Transaction); die;
		foreach($all_Transaction as $transaction){
			//echo '<br>-- '.$transaction['transactions']['user_id'];
			$data ='';
			$current_plan = $this->SubscriptionPlan->find('first',array('conditions'=>array('SubscriptionPlan.id'=>$transaction['transactions']['plan_id'])));
			$current_user = $this->User->find('first',array('conditions'=>array('User.id'=>$transaction['transactions']['user_id'])));
			//pr($current_plan); die;
			$exploded_date = explode(' ',$transaction['transactions']['expiry_date']);
			$sub_exp_date = $exploded_date [0];
			//pr($sub_exp_date); die;
			$before_3_days = date('Y-m-d', strtotime('-3 days', strtotime($sub_exp_date)));
			$before_7_days = date('Y-m-d', strtotime('-7 days', strtotime($sub_exp_date)));
			$current_date = date('Y-m-d');
			$sub_exp_date = date('M d, Y',strtotime($sub_exp_date));
			//pr($sub_exp_date); die;
			$this->Email->smtpOptions = array(
					'port'=>SMTP_PORT,
					'timeout '=> SMTP_TIME_OUT,
					'host' => SMTP_HOST,
					'username'=>SMTP_USER_NAME,
					'password'=>SMTP_PASSOWRD 
				);
			$this->Email->sendAs= 'html';
			
			//User's infor
			//pr($current_user); die;
			
			//If user have no manager
			if(($current_user['User']['manager_id'] != "") OR ($current_user['User']['manager_id'] != 0)){
				//Find GM entry in transaction table
				$gmTransaction = $this->Transaction->find('first',array('conditions'=>array('Transaction.user_id'=>$current_user['User']['manager_id']),'fields'=>array('Transaction.id,Transaction.user_id,Transaction.sub_date,Transaction.expiry_date'), 'order'=>array('Transaction.id DESC')));
				$GMexpDate = date('Y-m-d',strtotime($gmTransaction['Transaction']['expiry_date']));
			}
			
			//pr($gmTransaction); die;
			//When to check for sending reminders
			if(($current_user['User']['manager_id'] == "") OR ($current_user['User']['manager_id'] == 0) OR (!empty($gmTransaction))){
				//pr($gmTransaction);
				//echo '=========================================<br>';
				//echo $transaction['transactions']['user_id']; die;
				if(strtotime($current_date) == strtotime($before_3_days)){
					if($transaction['transactions']['type'] == "paid"){
						//mail('sdd.sdei@gmail.com','TT','MAil');die;
						$template = $this->Common->getEmailTemplate(22);
						//pr($template);die;
						$this->Email->from = INFO_EMAIL;
						$this->Email->subject = $template['EmailTemplate']['subject'];
						$data = $template['EmailTemplate']['description'];
						$data = str_replace('{NAME}',$current_user['User']['name'],$data);
						$data=str_replace('{SUBSCRIBE_LINK}',SITE_URL,$data);
						$data = str_replace('{PLAN}',$current_plan['SubscriptionPlan']['plan_title'],$data);
						$data = str_replace('{END_DATE}',$sub_exp_date,$data);
					}else{
						$template = $this->Common->getEmailTemplate(23);
						$this->Email->from = INFO_EMAIL;
						$this->Email->subject = $template['EmailTemplate']['subject'];
						$data=$template['EmailTemplate']['description'];
						$data=str_replace('{NAME}',$current_user['User']['name'],$data);
						$data=str_replace('{SUBSCRIBE_LINK}',SITE_URL,$data);
						$data=str_replace('{END_DATE}',$sub_exp_date,$data);	
					}
				}elseif($current_date == $before_7_days) {
					if($transaction['transactions']['type'] == "paid"){
						$template = $this->Common->getEmailTemplate(22);
						$this->Email->from = INFO_EMAIL;
						$this->Email->subject = $template['EmailTemplate']['subject'];
						$data=$template['EmailTemplate']['description'];
						$data=str_replace('{NAME}',$current_user['User']['name'],$data);
						$data=str_replace('{PLAN}',$current_plan['SubscriptionPlan']['plan_title'],$data);
						$data=str_replace('{END_DATE}',$sub_exp_date,$data);
					}else{
						$template = $this->Common->getEmailTemplate(23);
						$this->Email->from = INFO_EMAIL;
						$this->Email->subject = $template['EmailTemplate']['subject'];
						$data=$template['EmailTemplate']['description'];
						$data=str_replace('{NAME}',$current_user['User']['name'],$data);
						$data=str_replace('{SUBSCRIBE_LINK}',SITE_URL,$data);
						$data=str_replace('{SUBSCRIBE_LINK}',SITE_URL,$data);
						$data=str_replace('{END_DATE}',$sub_exp_date,$data);
					}
				}
				//pr($data); die;
						$this->Email->to = $current_user['User']['email'];
						//$this->Email->to = "hennies@gmail.com";
						$this->Email->to = 'smaartdatatest@gmail.com';
						$this->set('data',$data);
						$this->Email->template='commanEmailTemplate';
				if(!empty($data)){
						$this->Email->send();
				}
			}
		}
		
		exit;
        }
	
	
	/**
	@function:admin_transaction
	@description: listing of transaction
	@Created by:Sanchit Negi
	@Modify:NULL
	@Created Date:July. 29, 2013
	*/
	public function admin_transaction(){
		$this->set('pagetitle','Transaction');
		$this->layout='admin';
		$this->loadModel('Transaction');
		$res=$this->Transaction->find('all',array('conditions'=>array('type'=>'paid'),'order'=>array('Transaction.created'=>'DESC')));
		//pr($res);die;
		$this->set('transaction',$res);
		
	}
	
	
	/**
	@function:update_amt
	@description: update amount with respect to promo code
	@Created by:Vikas Uniyal
	@Modify:NULL
	@Created Date:July. 31, 2013
	*/
	public function update_amt($pCode = NULL,$mainAmt = NULL,$period = NULL){
		$this->autoRender = false;	
		$this->loadModel('PromotionalCode');
		$current_date = date('Y-m-d');
		$getPromoInfo = $this->PromotionalCode->find('first',array('conditions'=>array('PromotionalCode.expiration_date >='=>$current_date,'PromotionalCode.unique_code'=>trim($pCode))));
		if(strcmp($getPromoInfo['PromotionalCode']['unique_code'],$pCode) == 0) {
			if(is_array($getPromoInfo))
			{
				$lessAmt = ($mainAmt * $getPromoInfo['PromotionalCode']['amount'])/100;
				$reqAmt = $mainAmt - $lessAmt;
				//$reqAmt = $reqAmt * $period;
				echo number_format($reqAmt,2);
			}
		}else{	
				echo "invalid"; exit;
		}
		exit;	
	}
	
	
	function notify_url($id=null) {
		//mail('smaartdatatest@gmail.com','paypal_resp','sam'); die('done');
		//$email = "promatics.vikasuniyal@gmail.com"; //Used to check email 
		$header = ""; 
		$emailtext = ""; 
		$req = 'cmd=_notify-validate';    
		 
		foreach ($_POST as $key => $value) 
		{ 
		 if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) 
		 { 
		  $value = urlencode(stripslashes($value)); 
		 } 
		 else 
		 { 
		  $value = urlencode($value); 
		 } 
		 $req .= "&$key=$value"; 
		} 
		 
		$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n"; 
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n"; 
		$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
		
		mail('smaartdatatest@gmail.com','paypal_resp',$req); //die('Mail Sent');	
		
		$fp = fsockopen ('www.sandbox.paypal.com', 80, $errno, $errstr, 30); 
		 
		if (!$fp) 
		{     
		} 
		else 
		{ 
		fputs ($fp, $header . $req); 
		while (!feof($fp)) 
		{ 
		  if($_POST['payment_status']=='Completed') 
		  {
		  //mail($email,"hello","hello".$other); //Uncomment it to check email 
		  $myDate=strtotime(urldecode($_POST["payment_date"]));        
		  $currentDate = date ('Y-m-d H:i:s', $myDate); 
		   
		$entry = $this->Transaction->find('count',array('conditions'=>array('Transaction.user_id'=>$this->params['named']['user'],'Transaction.payment_id'=>$_POST['txn_id']))); 
		$result = array();
		    if($entry == 0) 
		    { 
			$userInfo=$this->User->find("first",array("conditions"=>array("User.id"=>$this->params['named']['user']))); 
			$getSubsInfo = $this->SubscriptionPlan->findById($_POST['item_number']);
			
			$frequency = strtotime ( '+'.$getSubsInfo['SubscriptionPlan']['plan_months'].' '.$getSubsInfo["SubscriptionPlan"]["billing_cycle"], strtotime($currentDate));
			$expiry_date = date('Y-m-d H:i:s',$frequency);
			if($getSubsInfo['SubscriptionPlan']['plan_months'] == 0){
				$expiry_date = $currentDate;
			}
			
			$result["Transaction"]["user_id"] = $this->params['named']['user'];
			$result["Transaction"]["expiry_date"] = $expiry_date;
			$result["Transaction"]["type"] = 'paid'; 
			$result["Transaction"]["sub_date"] = $currentDate;
			$result["Transaction"]["plan_id"] = $_POST['item_number'];
			$result["Transaction"]["AMT"] = number_format($_POST['mc_gross'],2);
			$result["Transaction"]["payment_id"] = $_POST['txn_id'];
			$result["Transaction"]["success"] = 1;
			
			$this->Transaction->create();
			if($this->Transaction->save($result))
			{
				
				$GM_user_limit = ($getSubsInfo['SubscriptionPlan']['user_limit'] > 1)?$getSubsInfo['SubscriptionPlan']['user_limit']:0;
				$dorStatus = 0; 
				$this->User->updateAll(array('User.dormant_user'=>"'$dorStatus'",'User.dormant_user'=>"'$GM_user_limit'"),array('User.id'=>$this->params['named']['user']));
				
				//Sent Email:: START
				$this->loadModel('User');
				$currentUser = $_SESSION['Auth']['User']['id'];
				
				$this->Email->smtpOptions = array(
					'port'=>SMTP_PORT,
					'timeout '=> SMTP_TIME_OUT,
					'host' => SMTP_HOST,
					'username'=>SMTP_USER_NAME,
					'password'=>SMTP_PASSOWRD 
				);
				$this->Email->sendAs= 'html';
				
				//import emailTemplate Model and get template
				//Fetch content of 'DAILY_REMINDER'
				$template = $this->Common->getEmailTemplate(21);
				//pr($template); die;
				$this->Email->from = INFO_EMAIL;
				$this->Email->subject = $template['EmailTemplate']['subject'];
				$data=$template['EmailTemplate']['description'];
				$data=str_replace('{NAME}',$userInfo['User']['name'],$data);
				$data=str_replace('{PLAN_TITLE}',$getSubsInfo['SubscriptionPlan']['plan_title'],$data);
				$data=str_replace('{FULL_PRICE}',' '.'$'.number_format($getSubsInfo['SubscriptionPlan']['amount'],2),$data);
				$exp = ($getSubsInfo['SubscriptionPlan']['plan_months'] != 0)?date('M. d, Y',strtotime($result["Transaction"]["expiry_date"])):'On cancellation';
				$data=str_replace('{EXPIRATION_DATE}',$exp,$data);
				$data=str_replace('{FREQUENCY}',$getSubsInfo["SubscriptionPlan"]["billing_cycle"],$data);
				
				$end_of_billing = ($getSubsInfo['SubscriptionPlan']['plan_months'] != 0)?$getSubsInfo['SubscriptionPlan']['plan_months']:'Ongoing';
				$data=str_replace('{BILLING_END}',$end_of_billing,$data);
				$promocode = $_POST['option_selection1'];
				$data=str_replace('{PROMO_CODE}',$promocode,$data);
				$data=str_replace('{AMOUNT_DEDUCTED}','$'.number_format($_POST['mc_gross'],2),$data);
				//$new_card = "XXXX-XXXX-XXXX-" . substr($_POST['cardnumber'],-4,4);
				//$data=str_replace('{CC_NUM}',$new_card,$data);
				
				//pr($data); die;
				$this->set('data',$data);
				$this->Email->to = $userInfo['User']['email'];
				//$this->Email->to = "smaartdatatest@gmail.com";
				$this->Email->template='commanEmailTemplate';
				$this->Email->send(); 
				//END EMAIL	
			}
		} 
		     
		} elseif($_POST['txn_type']=='subscr_cancel'){
			$entry = $this->Transaction->find('first',array('conditions'=>array('Transaction.user_id'=>$this->params['named']['user'],'Transaction.payment_id'=>$_POST['txn_id']))); 
			$today = $entry['Transaction']['expiry_date'];
			$yesterday = strtotime ('-1 day', strtotime($today));
			$yesterday = date('Y-m-d H:i:s',$frequency);
			$updatedExpDate = $yesterday; 
			$this->Transaction->updateAll(array('Transaction.expiry_date'=>"'$updatedExpDate'"),array('Transaction.id'=>$entry['Transaction']['id']));
			
		}
		foreach ($_POST as $key => $value) 
		{ 
		 $emailtext .= $key . " = " .$value ."\n\n"; 
		} 
	    
	      } 
	    
	     } 
    
    }
       
       	
	public function thankyou(){
		//pr($_POST); die;
		$this->set('pagetitle','Vimbli Payment');
		$this->layout = "inner_pages";
	}
}
?>