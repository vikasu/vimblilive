<?php
/*
 * Copyright 2011 Google Inc.
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
 */
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_Oauth2Service.php';
session_start();

$client = new Google_Client();
$client->setApplicationName("Google UserInfo PHP Starter Application");
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
 $client->setClientId('531104926444-3041ougnjsbkn09sbrq62mcce8np4s1d.apps.googleusercontent.com');
 $client->setClientSecret('Thn8iNJUc6cZp6IAoVZ1NsMq');
 $client->setRedirectUri('http://www.vimbli.com/beta/app/webroot/sample/examples/userinfo/refresh.php');
// $client->setDeveloperKey('insert_your_developer_key');
$oauth2 = new Google_Oauth2Service($client);

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  return;
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['logout'])) {
  unset($_SESSION['token']);
  $client->revokeToken();
}

if ($client->getAccessToken()) {
  $user = $oauth2->userinfo->get();

  // These fields are currently filtered through the PHP sanitize filters.
  // See http://www.php.net/manual/en/filter.filters.sanitize.php
  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  $personMarkup = "$email<div><img src='$img?sz=50'></div>";

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
}
?>

<?php
  if(isset($authUrl)) {
    $authUrl = 'https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=http://www.vimbli.com/beta/app/webroot/sample/examples/userinfo/refresh.php&client_id=531104926444-3041ougnjsbkn09sbrq62mcce8np4s1d.apps.googleusercontent.com&scope=https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://mail.google.com/ https://www.googleapis.com/auth/calendar https://www.googleapis.com/auth/calendar.readonly http://www.google.com/m8/feeds/&access_type=offline&approval_prompt=force';
    print "<a class='login' href='$authUrl'>Connect Me!</a>";
  } else {
  
  //echo "<br>======********=======<br>";
  //echo $requesttoken = $client->getAccessToken();
  $requesttoken = '{"access_token":"ya29.AHES6ZRmuaap_mtzv1yvjtQYbj0_I53GB_9_WDayPkrDi9z5","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImJiYzAzMjdjNmJiZTQ4MTc4MWIyOTU5NGZhMzRjZjkzMmQ5ZGQ0MWMifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiY2lkIjoiNTMxMTA0OTI2NDQ0LTMwNDFvdWduanNia24wOXNicnE2Mm1jY2U4bnA0czFkLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiNTMxMTA0OTI2NDQ0LTMwNDFvdWduanNia24wOXNicnE2Mm1jY2U4bnA0czFkLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidmVyaWZpZWRfZW1haWwiOiJ0cnVlIiwiZW1haWxfdmVyaWZpZWQiOiJ0cnVlIiwiYXVkIjoiNTMxMTA0OTI2NDQ0LTMwNDFvdWduanNia24wOXNicnE2Mm1jY2U4bnA0czFkLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiaWQiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJzdWIiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJ0b2tlbl9oYXNoIjoiRW0wX0VVeU5GTE1EMHlkNmcwalFIZyIsImF0X2hhc2giOiJFbTBfRVV5TkZMTUQweWQ2ZzBqUUhnIiwiZW1haWwiOiJzbWFhcnRkYXRhdGVzdEBnbWFpbC5jb20iLCJpYXQiOjEzNjYyMDU1MzgsImV4cCI6MTM2NjIwOTQzOH0.uFBaxdimIyKuUPC7jvLzfYyvxoWHN-PobmS_B_73voOkCpTgQh-VwDn_6k_H51nDj68pavVvA16-McRBrmy4Q90uhVOhedT9ud2zbXMASJOHbl3eRk-fVGjotvWVVa4kVUDwWarHkDgy0jmEpe8d5nRY8hygY8G2SV7ILWXc_oE","refresh_token":"1\/QemrlYojjZJ5JMwMRi9pGTUlA8TNDTOlYvIOeZNpJMg","created":1366205837}';
  //echo "<br>=======********======<br>";
  //echo "<br>";
  $jsonreq = json_decode($requesttoken, true);  
  $resultrefresh = $client->refreshToken($jsonreq['refresh_token']);  
  echo "<pre>";
  echo "Token Refreshed";
  echo "<br>";
  echo $requesttoken = $client->getAccessToken();
  echo "<br>";
  print "<a class='logout' href='?logout'>Logout</a>";
}
?>
