<?php
	class SendemailComponent
	{
		/**
		 * function : genratepassword()
		 * description : Generate temporary password for user.
		 */
		function genratepassword() {
			$temppasswd='';
			for($i=1;$i<=2;$i++) {
				$small=range('a', 'z');
				$caps=range('A' ,'Z');
				shuffle($caps);
				shuffle($small);
				$num=rand(1,25);
				$temppasswd.=$caps[$num];
				$temppasswd.=rand()%10;
				$temppasswd.=$small[$num];
				$temppasswd.=rand()%100;
			}
			return $temppasswd;
		}

		/**
		 * function : sendMailRemeberMe()
		 * params   : $uEmail : User email address to send password.
		 * description : This function is send a mail to email user for remember about 14 day.
		 */
		
		function sendMailRemeberMe($user_name,$user_email){

			$uEmail = $user_email;
			
			$message='<HTML><HEAD><TITLE>REMEMBER ME</TITLE></HEAD><BODY>';
			$message.= "Hi ". ucfirst($user_name).','."<br><br>";
			$message .= "You have choosen remember me option. So you will be signed in for 14 days.";
			$message .= "<br/><br/>Thanks & Regards, <br>  ".'vimbli'." Team <br>";
			$message .='</BODY></HTML>';
			$subject = "Remeber Me";
			
			$from = "support@vimbli.com";
			$to = $uEmail;
			$ifsend = $this->sendMailContent($to,$from,$subject,$message);
			
			if($ifsend == true)
			{
				return true;
			}
			else
			{
				return false;
			}
			
			
		}
		
		
		
		function sendMailContactUs($userQueryDetails)
		{
			$s_name = $userQueryDetails['sender_name'];
			$s_email = $userQueryDetails['sender_email'];
			$subject = $userQueryDetails['subject'];
			$query = $userQueryDetails['query'];
			$uEmail = 'testmyfb01@gmail.com';
	
			print_r($userQueryDetails);	
			
			$message='<HTML><HEAD><TITLE>CONTACT US</TITLE></HEAD><BODY>';
			$message.= "Hi Admin,<br><br>";
			$message .= "Following message has come through contactus page:<br/>";
			$message .="Sender: ".ucfirst($s_name)."<br/>";
			$message .="Email: $s_email <br/>";
			$message .="Subject: $subject <br/>";
			$message .="Query: $query";
			$message .='</BODY></HTML>';
			$subject = "Message from contact us page";
			$from = "contactus@vimbli.com";
			$to = $uEmail;
			$ifsend = $this->sendMailContent($to,$from,$subject,$message);
				
			if($ifsend == true)
			{
				return true;die('Hello');
			}
			else
			{
				return false;
			}
				
				
		}
		
		
		/**
		 * function : sendmail()
		 * params   : $uName : User full name.
		 * params   : $uEmail : User email address to send password.
		 * params   : $newpassword : New temporary password.
		 * description : This function is use to format mail for user.
		 */
		function sendmail($uName, $uEmail, $newpassword){
			$message='<HTML><HEAD><TITLE>Forgot Password</TITLE></HEAD><BODY>';
			$message.= "Hi ". ucwords($uName).','."<br><br>";
			$message .= "Your new temporary pas
				shuffle($caps);
				shuffle($small);sword is : <b>\"".$newpassword . "\"</b>";
			$message .= "<BR>Please contact us with any questions.<br>";
			$message .= "Since your password has been sent in \"clear-text\", we strongly suggest you delete this email or change your password as soon as possible.<br>";
			$message .= "<a href='".SITE_NAME_FEEDBACK."/users/index/' target='_blank'>Click here to login!</a>"."<br><br>";
			$message .= "If clicking on the link doesn't work, please copy and paste the following link in to your browser:"."<br>";
			$message .= SITE_NAME_FEEDBACK."/users/index/<br>";
			$message .= "<br>Thanks & Regards, <br> The ".DOMAIN_NAME." Team <br>";
			$message .='</BODY></HTML>';
			$subject = "Password Information";

			$from = ADMIN_SUPPORT_MAIL;
			$to = $uEmail;
			$ifsend = $this->sendMailContent($to,$from,$subject,$message);

			if($ifsend == true){
			   return true;
			}else{
			   return false;
			}
		}

		/**
		 * function : sendmail_to_subadmin()
		 * params   : $fullname : User full name.
		 * params   : $email : User email address to send details.
		 * params   : $userdetails : Username and Password details.
		 * description : This function is use to send mail to sub admin with details.
		 */
		function sendmail_to_subadmin($fullname, $email, $userdetails, $action = null){
			$message='<HTML><HEAD><TITLE>Sub Admin</TITLE></HEAD><BODY>';
			$message.= "Hi ". ucwords($fullname).','."<br><br>";
			if($action == 'update') {
				$message .= "Your login details are updated by admin. Please use the following details : <br> Username : <b>".$userdetails['username']."</b> And Password : <b>".$userdetails['password']."</b>";
				$subject = "Update details Notification";
			}else {
				$message .= "You are setup as a sub admin in system. Yuor login details are as follows : <br> Username : <b>".$userdetails['username']."</b> And Password : <b>".$userdetails['password']."</b>";
				$subject = "Sub Admin Notification";
			}
			$message .= "<BR>Please contact us with any questions.<br>";
			$message .= "<a href='".SITE_NAME_FEEDBACK."/admins/login/' target='_blank'>Click here to login!</a>"."<br><br>";
			$message .= "If clicking on the link doesn't work, please copy and paste the following link in to your browser:"."<br>";
			$message .= SITE_NAME_FEEDBACK."/admins/login/<br>";
			$message .= "<br>Thanks & Regards, <br> The ".DOMAIN_NAME." Team <br>";
			$message .='</BODY></HTML>';

			$from = ADMIN_SUPPORT_MAIL;
			$to = $email;
			$ifsend = $this->sendMailContent($to,$from,$subject,$message);

			if($ifsend == true){
			   return true;
			}else{
			   return false;
			}
		}


		/**
		 * function : sendmail_NextChargeDate()
		 * params   : $uName : User full name.
		 * params   : $uEmail : User email address to send password.
		 * params   : $ndate : Next Charge Date.
		 * params   : $ldate : Last Charge Date.
		 * description : This function is use to inform user about thier next charge date in advance.
		 */
		function sendmail_NextChargeDate($uName, $uEmail, $ndate, $ldate){
			$message='<HTML><HEAD><TITLE>Next Charge Date</TITLE></HEAD><BODY>';
			$message.= "Hi ". ucwords($uName).','."<br><br>";
			$message .= "We would like to kindly inform you that your next charge date is due on: <b>\"".$ndate. "\"</b> and you were previously charged on :<b>\"".$ldate."\"</b> for your membership with social club.";
			$message .= "<BR>Please make sure that your payment credentials are valid to ensure that you get all the benefits of your current membership. In case your payment fails your membership level will be set to \"FREE\" which you can then update to your desired membership level.<br>";
			$message .= "<BR>Please contact us with any questions.<br>";
			$message .= "<br>Thanks & Regards, <br> The ".DOMAIN_NAME." Team <br>";
			$message .='</BODY></HTML>';
			$subject = "Next Charge Date Information";

			$from = ADMIN_SUPPORT_MAIL;
			$to = $uEmail;
			$ifsend = $this->sendMailContent($to,$from,$subject,$message);

			if($ifsend == true){
			   return true;
			}else{
			   return false;
			}
		}

		/**
		 * function : send_invitation()
		 * params   : $reffered_by : Id of user who promote this site.
		 * params   : $member_name : User full name.
		 * params   : $memberemail : User email.
		 * params   : $f_email	   : email address to whom invite.
		 * description : This function is use to send mail to invite friends.
		 */
		function send_invitation($reffered_by, $member_name, $memberemail, $f_email) {
			$message='<HTML><HEAD><TITLE>Invite Friend</TITLE></HEAD><BODY>';
			$message.= "Hi, <br><br>";
			$message .= "I have found very interesting site for bookmaring urls. Please have a look and join the following site <br><br>";
			$message .= "<a href='".SITE_NAME."/users/register/".$reffered_by."' target='_blank'>Click Here</a>"."<br><br>";
			$message .= "If clicking on the link doesn't work, please copy and paste the following link in to your browser:"."<br>";
			$message .= SITE_NAME."/users/register/".$reffered_by."<br>";
			$message .= "<br>Thanks & Regards, <br> ".ucwords($member_name)."<br>";
			$message .='</BODY></HTML>';
			$subject = "Inviatation to join site";

			$from = $memberemail;
			$to = trim($f_email);
			$ifsend = $this->sendMailContent($to,$from,$subject,$message);

			if($ifsend == true){
			   return true;
			}else{
			   return false;
			}
		}

		/**
		 * function : send_payment_charge_mail()
		 * params   : $uName   : user full name.
		 * params   : $uEmail  : user email address to send password.
		 * params   : $status : seccess or failure message to send.
		 * params   : $pay_details : payment details.
		 * description : This function is use to inform user about thier transcation which done trough cron						 script.
		 */
		function send_payment_charge_mail($uName, $uEmail, $status, $pay_details) {
			$message='<HTML><HEAD><TITLE>Payment Charge Mail</TITLE></HEAD><BODY>';
			$message.= "Hi ". ucwords($uName).','."<br><br>";
			if($status == true) {
				$message .= "We would like to kindly inform you that an attempt to renew your subscription was done on  ".date("Y-m-d"). " and following were the result of payment <br>";

				$payment = '';
				foreach($pay_details as $key=>$value){
					$payment.="$key=".urldecode($value)."<br>";
				}
				$message .= $payment;
				$message .= "<br> Please enjoy the  benefits of your current membership.";
			}else {
				$message .= "An attempt to renew your subscription has been failed on  ".date("Y-m-d"). ". following were the result of payment <br>";

				$payment = '';
				foreach($pay_details as $key=>$value){
					$payment.="$key=".urldecode($value)."<br><br>";
				}
				$message .= $payment;
				$message .= "<br> As your payment failed, we updated your membership level to \"FREE\" which you can then update to your desired membership level.";
			}

			$message .= "<br>Please contact us with any questions.<br>";
			$message .= "<br>Thanks & Regards, <br> The ".DOMAIN_NAME." Team <br>";
			$message .='</BODY></HTML>';
			$subject = "Payment Status Information";

			$from = ADMIN_SUPPORT_MAIL;
			$to = $uEmail;
			$ifsend = $this->sendMailContent($to,$from,$subject,$message);

			if($ifsend == true){
			   return true;
			}else{
			   return false;
			}
		}

		/**
		 * function : email_file_attach_send()
		 * params   : $content : body of template.
		 * params   : $useremail : user email address.
		 * params   : $mailsubject : subject of the email.
		 * params   : $mailfrom : sender email address.
		 * params   : $cc : carbon copy mail address(optional).
		 * description : Send email to admin to notify about new user.
		 */
		function email_file_attach_send($content, $useremail, $mailsubject, $mailfrom, $title, $filepath ,$cc='')    
		{
		           $pageURI=$this->curPageUrl();
                   $template='
                        <div style="width:550px;clear:both;margin:auto;">
                                <div>
                                        <img  src="'.$pageURI.'/img/mydigitoollogo.jpg"  alt="Logo" />
                                </div>
                                <div style="clear:both;background: url(\''.$pageURI.'/img/menubg.gif\') repeat-x scroll left top transparent;height: 27px;padding: 10px 0 0 20px;color: #FEFEFE;">'.$title.'</div>
                                <div style="clear:both;font-family: serif;font-size: 12px;padding-left:20px;min-height:300px;background:#f57d26;margin:0px;padding-top:0px;padding-bottom:5px;">
                                    '.$content.'
                                </div>
                                <div style="  background: url(\''.$pageURI.'/img/footer_bg.gif\') repeat-x scroll left bottom transparent;width:550px;height:50px;color: #FFFFFF;">
                                        <br /><span style="font-size:10px;padding-top:20px;padding-left: 20px;color: #FFFFFF;">Copyright &copy; MyDigiTool., All Right Reserved</span>
                                </div>

                        </div>
                        <div style="clear:both;"></div>                
                    ';
                    $ifsend = $this->sendMailContent($useremail,$mailfrom,$mailsubject,$template,$filepath,$cc);
                    if($ifsend == true){
                       return true;
                    }else{
                       return false;
                    }
                   
		}


		/**
		 * function : general_email_send()
		 * params   : $name : name of user.
		 * params   : $username : login name of user.
		 * params   : $activation_code : activation code of user.
		 * params   : $memberid : user id.
		 * params   : $useremail : email address of user.
		 * description : Send email to admin to notify about new user.
		 */
		function general_email_send($template, $useremail, $mailsubject, $mailfrom, $cc='')
		{
			$message = $template;
			$subject = $mailsubject;
			$from = $mailfrom;
			$to = $useremail;
			$ifsend = $this->sendMailContent($to,$from,$subject,$message,$cc);
			if($ifsend == true){
			   return true;
			}else{
			   return false;
			}
		}
	//To get current domain and port
	function curPageUrl(){		
	   $pageURL = 'http';
	   if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	   $pageURL .= "://";
	   if ($_SERVER["SERVER_PORT"] != "80") {
	   $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
	   } else {
	   $pageURL .= $_SERVER["SERVER_NAME"];
	   }
	    return $pageURL;
	}                
		/**
		 * function : default_email_send()
		 * params   : $content : body of template.
		 * params   : $useremail : user email address.
		 * params   : $mailsubject : subject of the email.
		 * params   : $mailfrom : sender email address.
		 * params   : $cc : carbon copy mail address(optional).
		 * description : Send email to admin to notify about new user.
		 */
		function default_email_send($content, $useremail, $mailsubject, $mailfrom, $title, $cc='')    
		{
		           $pageURI=$this->curPageUrl();
                   $template='
                        <div style="width:550px;clear:both;margin:auto;">
                                <div>
                                        <img  src="http://75.125.190.162:7280/img/flo360.png"  alt="Logo" />
                                </div>
                                
                                <div style="clear:both;font-family: serif;font-size: 12px;padding-left:20px;min-height:200px;background:#BBBBBB;margin:0px;padding-top:0px;padding-bottom:5px;">
                                	<div><strong style="font-size:18px;">'.$title.'</strong></div>
                                    '.$content.'
                                    <br/><span style="font-size:10px;padding-top:20px;color: #000000;">Copyright &copy; vimbli., All Right Reserved</span>
                                </div>


                        </div>
                        <div style="clear:both;"></div>                
                    ';
                    $ifsend = $this->sendMailContent($useremail,$mailfrom,$mailsubject,$template,$cc);
                    if($ifsend == true){
                       return true;
                    }else{
                       return false;
                    }



                   
		}


		/**
		 * function : forgot_password()
		 * params   : $name : name of user.
		 * params   : $username : login name of user.
		 * params   : $activation_code : activation code of user.
		 * params   : $memberid : user id.
		 * params   : $useremail : email address of user.
		 * description : Send email to admin to notify about new user.
		 */
		function forgot_password($username, $password, $memberid, $useremail)
		{
			$message  ='<HTML><HEAD><TITLE>DMS Password Recovery.</TITLE></HEAD><BODY>';
			$message .= "Dear ".$username.",<br><br>";
			$message .= "Thank you for contacting us to reset your DMS' password.<br><br>";
			$message .= "Your log on email is: ".$useremail."<br> ";
			$message .= "Your password is: ".$password."<br><br><br>";
			$message .= "Please remember, your password is cAsE SenSitiVe.<br /><br />";
			$message .= "Should you have any queries or concerns please contact our Customer Support Team on:<br><br>";
			$message .= "<a href='mailto:info@mydigitool.com'>info@mydigitool.com</a><br>";
			$message .= "tel: 0123456789<br>";
			$message .= "fax: 0123456789<br>";
			$message .= "Down Street<br>";
			$message .= "<br><br>&copy; DMS 2011 - 2011<br>";
			$message .='</BODY></HTML>';
			$subject  = "Message from DMS.";
			$from = "info@mydigitool.com";
			$to = $useremail;
			$ifsend = $this->sendMailContent($to,$from,$subject,$message);

			if($ifsend == true){
			   return true;
			}else{
			   return false;
			}
		}




		/**
		 * function : sendMailContent()
		 * params   : $userEmail : User full name.
		 * params   : $senderEmail : Sender email address.
		 * params   : $subject : Subject line for email.
		 * params   : $message : Actual contents to send to user.
		 * description : This function is use to send mail to user.
		 */
		function sendMailContent($userEmail,$senderEmail,$subject,$message/* ,$filepath,$cc='' */){
			require_once('vendors/phpmailer/class.phpmailer.php');
			$mail = new PHPMailer();
			//$mail->IsSMTP(); // telling the class to use SMTP
			$mail->From = $senderEmail;
			$mail->FromName = $senderEmail;
			$mail->Sender = $userEmail;
			$mail->AddAddress($userEmail,$userEmail);
			
			$mail->Subject = $subject;
			$mail->Body    = $message;
	
			/* if (is_array($cc) && !empty($cc)) {
			 foreach ($cc as $emailcopy) {
			$mail->AddCC($emailcopy);
			}
			} */
			
			/* if($filepath!='') {    
			  $filepatharr = explode(",",$filepath);
			  $tot_file = count($filepatharr);
			  for($i=0;$i<$tot_file;$i++)
			  {
			      $mail->AddAttachment($filepatharr[$i]);
			  }
			  
			} */
			$mail->WordWrap = 100;
			$mail->IsHTML(true);

			if ($mail->Send()) {
				return true;
			}else {
				return false;
			}
		}
	}
?>
