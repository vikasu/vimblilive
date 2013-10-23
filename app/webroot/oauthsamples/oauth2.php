<!--
 * Copyright 2012 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * Sample code for authenticating to Gmail with OAuth2. See
 * https://code.google.com/p/google-mail-oauth2-tools/wiki/PhpSampleCode
 * for documentation.
 * -->
<html>
<head>
  <title>OAuth2 IMAP example with Gmail</title>
</head>
<body>

<?php 
require_once 'Zend/Mail/Protocol/Imap.php';
require_once 'Zend/Mail/Storage/Imap.php';
//echo "I am Here!!!"; die;
//echo '<pre>'; print_r($_GET); die;

$email = $_GET['email'];
$accessToken = $_GET['token'];
$user_id = $_GET['user_id'];
$source = $_GET['source'];

//echo $user_id; die;
/**make db_connection**/
$con = mysql_connect("localhost","vimbli","vimblisdn");
mysql_select_db("test",$con); 
$db_selected = mysql_select_db("test", $con);
//mysql_close($con);
/*********************/

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
function showInbox($imap) {
  /**
   * Print the INBOX message count and the subject of all messages
   * in the INBOX
   */
  $storage = new Zend_Mail_Storage_Imap($imap);

  include 'header.php';
  //echo '<h1>Total messages: ' . $storage->countMessages() . "</h1>\n";

  /**
   * Retrieve first 5 messages.  If retrieving more, you'll want
   * to directly use Zend_Mail_Protocol_Imap and do a batch retrieval,
   * plus retrieve only the headers
   */
  $emailArr = array();
  //echo 'First five messages: <ul>';
  //echo 'AAA: '.$_GET['user_id']; die;
  $existEmailSql = "SELECT id,email_uid FROM import_emails where user_id=".$_GET['user_id'];
  $existingEmails = mysql_query($existEmailSql) or die(mysql_error());
  //echo '<pre>'; print_r(mysql_fetch_assoc($existingEmails)); die;
  $existingIds = array();
  while($row = mysql_fetch_assoc($existingEmails))
  {
    $existingIds[] = $row['email_uid'];
  }
  
  $today = date ( 'Y-m-d'); 
  $initialDate = date('Y-m-d',strtotime($today. "-7 day"));
  $today = $today.' '.date('H:i:s');
  $initialDate = $initialDate.' '.'00:00:00';
  
  
  for ($i = 1; $i <= $storage->countMessages(); $i++ ){
  echo "<pre>";
   //print_r($storage->getMessage($i)); die;
    if(in_array($storage->getMessage($i)->{"message-id"},$existingIds) == false){
      if(date('Y-m-d H:i:s', strtotime($storage->getMessage($i)->date)) >=$initialDate){
        $emailArr[$i]['message_id'] = $storage->getMessage($i)->{"message-id"};
        $emailArr[$i]['subject'] = $storage->getMessage($i)->subject;
        $emailArr[$i]['from'] = $storage->getMessage($i)->from;
        $emailArr[$i]['date'] = date('Y-m-d H:i:s', strtotime($storage->getMessage($i)->date));
           
        //echo '<li>' . date('Y-m-d H:i:s', strtotime($storage->getMessage($i)->date)) . "</li>\n";
          
      $query = "INSERT INTO import_emails (user_id, source, email_uid, email_subject, email_from, email_date) VALUES ('".$_GET['user_id']."', '".$_GET['source']."','".$emailArr[$i]['message_id']."','".$emailArr[$i]['subject']."','".$emailArr[$i]['from']."','".$emailArr[$i]['date']."')";
      mysql_query($query) or die(mysql_error());
      }
    } 
  }
  
  //$emailArr = array_reverse($emailArr, true);
  //header('Location: http://www.vimbli.com/beta/timelines/index/'.base64_encode($_GET['user_id']));
  //header('Location: http://www.vimbli.com/beta/users/loginIfSessionLost/'.$_GET['user_id']);
  header('Location: http://www.vimbli.com/beta/users/login/oauth@vimbli.com/'.$_GET['user_id']);
  
  echo '<pre>'; echo "In Script";
  print_r($emailArr);
  
  echo '</ul>';
}

/**
 * Tries to login to IMAP and show inbox stats.
 */
function tryImapLogin($email, $accessToken) {
  /**
   * Make the IMAP connection and send the auth request
   */
  $imap = new Zend_Mail_Protocol_Imap('imap.gmail.com', '993', true);
  if (oauth2Authenticate($imap, $email, $accessToken)) {
    echo '<h1>Successfully authenticated!</h1>';
    showInbox($imap);
  } else {
    echo '<h1>Failed to login</h1>';
  }
}

/**
 * Displays a form to collect the email address and access token.
 */
function displayForm($email, $accessToken) {
  echo <<<END
<form method="POST" action="oauth2.php">
  <h1>Please enter your e-mail address: </h1>
  <input type="text" name="email" value="$email"/>
  <p>
  <h1>Please enter your access token: </h1>
  <input type="text" name="access_token" value="$accessToken"/>
  <input type="submit"/>
</form>
<hr>
END;
}

//$email = $_POST['email'];
//$accessToken = $_POST['access_token'];

//$email = 'smaartdatatest@gmail.com';
//$accessToken = 'ya29.AHES6ZTTmjDchIcccDP6ByAA4GuDdE9nVpshO6nJdTxUKdw5yMAiEZ6N';

//displayForm($email, $accessToken);

if ($email && $accessToken) {
  tryImapLogin($email, $accessToken);
}
$tmpVar = 1;
//header('Location: http://www.vimbli.com/beta/connections/saveEmails/22');
?>
</body>
</html>
