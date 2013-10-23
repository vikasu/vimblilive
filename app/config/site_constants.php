<?php
	/*  site  defined constants  */
	define('MAIL_DELIVERY','smtp');
        // other possible value 'smtp'  if specified 'smtp'  no need to modify other values.
	define("SMTP_PORT",465);
	define("SMTP_TIME_OUT",30);
	define("SMTP_HOST",'smtp.gmail.com');
	define("SMTP_USER_NAME",'info@vimbli.com');
	define("SMTP_PASSOWRD",'V1945inc!');
	define('EMAIL_NOTIFICATION','');
	define('NOREPLY_EMAIL','');
	define("EMAIL_FROM",'');
	define("EMAIL_RESPONSE_GATEWAY","");
        // This is the admin email address where payment gateway send the response
	
        if(env("SERVER_PORT") == "443"){
		define('HTTP_HOST', 'https://'.env('HTTP_HOST')."/");
	}else{
		define('HTTP_HOST', 'http://'.env('HTTP_HOST')."/");
	}
	
	define('SITE_LINK_URL','www.vimbli.com/beta/');
	define('SITE_NAME','Vimbli');
	define('ADMIN_EMAIL','admin@vimbli.com');
	define('INFO_EMAIL','info@vimbli.com');
	define('CONTACT_EMAIL','support@vimbli.com');
	define('MAX_ACTIVATED_CONNECTION',3000);
	define('GROUP_LOGO_WIDTH','200px');
	define('GROUP_LOGO_HEIGHT','115px');
	
	
	define("REGULAR_EXPRESSION_EMAIL","/^([a-z0-9\\+_\\-]+)(\\.[a-z0-9\\+_\\-]+)*@([a-z0-9\\-]+\\.)+[a-z]{2,6}$/ix");
	define("LIMIT","50");
	define("URL_PATTERN","/(http(s)?:\/\/)(www\.)?(.)*[\.](.)*$/i");
	define("CITY_NAME","/^[a-zA-Z]+[a-zA-Z\ ]*$/i");
	define("ONLY_LETTER","/^[a-zA-Z]+$/i");
	define("DOCUMENT_ROOT",$_SERVER['DOCUMENT_ROOT'].'/app/webroot/');
	define("ADDRESS","/^[a-zA-Z]+[a-zA-Z\ ]*$/i");
	define("COMPANY","/^[a-zA-Z0-9]+[a-zA-Z0-9\.\(\)\- ]*$/i");
	define("PHONE","/^([\+][0-9]{1,3}[ \.\-])?([\(]{1}[0-9]{2,6}[\)])?([0-9 \.\-\/]{3,20})((x|ext|extension)[ ]?[0-9]{1,4})?$/i");
	
	///
	//Payment Gateway Constants
	define("PAYMENT_THROUGH_AUTHORIZE",true);
	define("IS_LIVE",false);
	if(IS_LIVE){
		define("API_URL","https://secure.authorize.net/gateway/transact.dll");
		define("API_LOGIN_ID","2CpCx8pn273");
		define("API_TRANSACTION_KEY","6Vt5k6nK8u3YG67K");
	}
	else{
		define("API_URL","https://certification.authorize.net/gateway/transact.dll");
		define("API_LOGIN_ID","2CpCx8pn273");
		define("API_TRANSACTION_KEY","6Vt5k6nK8u3YG67K");
	}
	
	//Payment through paypal
	define("PAYPAL_IS_LIVE",false);
	if(PAYPAL_IS_LIVE){
		define("BUSINESS_ACCOUNT","web_1349425792_biz@gmail.com");
		define("PAYPAL_URL","https://www.paypal.com/cgi-bin/webscr");	
	}
	else{
		define("BUSINESS_ACCOUNT","web_1349425792_biz@gmail.com");
		define("PAYPAL_URL","https://www.sandbox.paypal.com/cgi-bin/webscr");
	}
	
	
	
?>
