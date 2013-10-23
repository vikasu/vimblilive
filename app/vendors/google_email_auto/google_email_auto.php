<?php //echo 'In Vendor'; die;
//echo '<pre>';print_r($_SESSION); die;
require_once 'Zend/Mail/Protocol/Imap.php';
require_once 'Zend/Mail/Storage/Imap.php';

//function get_google_emails(){

//echo 1; die;

/**
 * Builds an OAuth2 authentication string for the given email address and access
 * token.
 */
function constructAuthString($email, $accessToken) {
  return base64_encode("user=$email\1auth=Bearer $accessToken\1\1");
}

/**
 * Given an open IMAP connection, attempts to authenticate with OAuth2.
 *
 * $imap is an open IMAP connection.
 * $email is a Gmail address.
 * $accessToken is a valid OAuth 2.0 access token for the given email address.
 *
 * Returns true on successful authentication, false otherwise.
 */
function oauth2Authenticate($imap, $email, $accessToken) {
  $authenticateParams = array('XOAUTH2',
      constructAuthString($email, $accessToken));
  $imap->sendRequest('AUTHENTICATE', $authenticateParams);
  while (true) {
    $response = "";
    $is_plus = $imap->readLine($response, '+', true);
    if ($is_plus) {
      error_log("got an extra server challenge: $response");
      // Send empty client response.
      $imap->sendRequest('');
    } else {
      if (preg_match('/^NO /i', $response) ||
          preg_match('/^BAD /i', $response)) {
        error_log("got failure response: $response");
        return false;
      } else if (preg_match("/^OK /i", $response)) {
        return true;
      } else {
        // Some untagged response, such as CAPABILITY
      }
    }
  }
}

/**
 * Given an open and authenticated IMAP connection, displays some basic info
 * about the INBOX folder.
 */
function showInbox($imap,$user) {
    //echo 'I am here Now.'; die;
    //echo $user; die;
    
  /**
   * Print the INBOX message count and the subject of all messages
   * in the INBOX
   */
  $storage = new Zend_Mail_Storage_Imap($imap);

  //include 'header.php';
  echo '<h1>Total messages: ' . $storage->countMessages() . "</h1>\n";
  
  /****** Code for save data with core ******/
  //include 'db_config.php'; //Import db_config file.
    /**make db_connection**/
    $con = mysql_connect("vimblidb.cvxwtu7q95t7.us-east-1.rds.amazonaws.com","vimbli","smartdata");
    mysql_select_db("db_vimbli_prod",$con); 
    $db_selected = mysql_select_db("db_vimbli_prod", $con);
    //mysql_close($con);
    /*********************/

  $emailArr = array();
  //echo 'First five messages: <ul>';
  //echo 'AAA: '.$_GET['user_id']; die;
  
  $existEmailSql = "SELECT id,email_uid FROM import_emails where user_id=".$user;
  $existingEmails = mysql_query($existEmailSql) or die(mysql_error());
  //echo '<pre>'; print_r(mysql_fetch_assoc($existingEmails)); die;
  $existingIds = array();
  while($row = mysql_fetch_assoc($existingEmails))
  {
    $existingIds[] = $row['email_uid'];
  }
  //echo '<pre>'; print_r($existingIds); die;
  
  //Deleted Items
  $delEmailSql = "SELECT id,item_id FROM deleted_items where user_id=".$user." AND item_type = 'email'";
  $deletedEmails = mysql_query($delEmailSql) or die(mysql_error());
  //echo '<pre>'; print_r(mysql_fetch_assoc($existingEmails)); die;
  $delEmailIds = array();
  while($row1 = mysql_fetch_assoc($deletedEmails))
  {
    $delEmailIds[] = $row1['item_id'];
  }
  
  $today = date ( 'Y-m-d'); 
  $initialDate = date('Y-m-d',strtotime($today. "-7 day"));
  $today = $today.' '.date('H:i:s');
  $initialDate = $initialDate.' '.'00:00:00';
  /****************************************/

  $totalMsz =  $storage->countMessages(); //&& $i <= 5;
  //echo 'First five messages: <ul>';
  $mailCounter = 0;
  
  
 
  for ($i = $totalMsz; $i >= 1; $i--){
  //for($i=1; $i<=$storage->countMessages(); $i++){
    if(in_array($storage->getMessage($i)->{"message-id"},$existingIds) == false){
      if(date('Y-m-d H:i:s', strtotime($storage->getMessage($i)->date)) >=$initialDate){
        $emailArr[$i]['message_id'] = $storage->getMessage($i)->{"message-id"};
        //$emailArr[$i]['subject'] = str_replace("'","\'",$storage->getMessage($i)->subject);
        $emailArr[$i]['subject'] = mysql_real_escape_string($storage->getMessage($i)->subject);
        $emailArr[$i]['from'] = mysql_real_escape_string($storage->getMessage($i)->from);
        $emailArr[$i]['date'] = date('Y-m-d H:i:s', strtotime($storage->getMessage($i)->date));
           
        //echo '<li>' . date('Y-m-d H:i:s', strtotime($storage->getMessage($i)->date)) . "</li>\n";
      
      //If item is not delted then save it
      if(in_array($storage->getMessage($i)->{"message-id"},$delEmailIds) == false){    
        $query = "INSERT INTO import_emails (user_id, source, email_uid, email_subject, email_from, email_date) VALUES ('".$user."', '1','".$emailArr[$i]['message_id']."','".$emailArr[$i]['subject']."','".$emailArr[$i]['from']."','".$emailArr[$i]['date']."')";
        mysql_query($query) or die(mysql_error());
      }
      } 
    }
      $mailCounter = $mailCounter+1;
      if($mailCounter >400){ $i=0; } //Exit over 500 loops
 
   //print_r($storage->getMessage($i));
   
    //echo '<li>' . htmlentities($storage->getMessage($i)->subject) . "</li>\n";
  }
   //echo "<pre>"; print_r($emailArr);
   //return $emailArr; 
}

/**
 * Tries to login to IMAP and show inbox stats.
 */
function tryImapLogin($email, $accessToken) {
 /*
  echo "Hello I am Inn!!!";
  echo '<br>'.$email;
  echo '<br>'.$accessToken;
  die;
   */
  /**** Get Token info ***/
  $tokenInfoSql = "SELECT * FROM sync_details where link_email='".$email."' AND oauth_access_token='".$accessToken."'";
  $tokenInfo = mysql_query($tokenInfoSql) or die(mysql_error());
  //echo '<pre>'; print_r(mysql_fetch_assoc($tokenInfo)); die;
  
  $row = mysql_fetch_assoc($tokenInfo);
  /*******************/
  
  $email = $email;
  $accessToken = $accessToken;
  
  /**
   * Make the IMAP connection and send the auth request
   */
  $imap = new Zend_Mail_Protocol_Imap('imap.gmail.com', '993', true);
  if (oauth2Authenticate($imap, $email, $accessToken)) {
    echo '<h1>Successfully authenticated!</h1>';
    showInbox($imap,$row['user_id']);
  } else {
    echo '<h1>Failed to login</h1>';
  }
}

//Let these vars here for further process, they do not empact any flow but necessary to have here.
function tryMe($email,$accessToken){
    //echo '===========<br>'.$email; echo '<br>'.$accessToken; echo '<br>=========='; die;
  //$email = 'test@vimbli.com';
  //$accessToken = 'ya29.AHES6ZRHsZdRDkxBACtT1Z_B5HWLktvhHSxZ3spOn55BCiS62Q';
  if ($email && $accessToken) {
    tryImapLogin($email, $accessToken);
  }
}

/*
  if ($email && $accessToken) {
    tryImapLogin($email, $accessToken);
  }
*/
//} ?>