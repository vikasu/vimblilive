<?php
//session_start();
require_once 'sample/src/Google_Client.php';
require_once 'sample/src/contrib/Google_Oauth2Service.php';



function get_access_token(){
    $tokenArr = array();
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


$client = new Google_Client();
$client->setApplicationName("Google UserInfo PHP Starter Application");
// Visit https://code.google.com/apis/console?api=plus to generate your
// oauth2_client_id, oauth2_client_secret, and to register your oauth2_redirect_uri.
 $client->setClientId('531104926444-fp902bdb7jcvcdjouom6fbdufel43nhe.apps.googleusercontent.com');
 $client->setClientSecret('YyeQUpdJO6Gdcz6a9HleiMwD');
 $client->setRedirectUri('http://vimbli.com/connections/oauthVendor');
// $client->setDeveloperKey('insert_your_developer_key');
$oauth2 = new Google_Oauth2Service($client);

    if (isset($_GET['code'])) {
      $client->authenticate($_GET['code']);
      $tokenArr = $client->getAccessToken();
      
      if ($client->getAccessToken()) {
        $user = $oauth2->userinfo->get();
      }
      
      $tokenArr = json_decode($client->getAccessToken(),true);
      $tokenArr['email'] = $user['email'];
      $tokenArr['json_resp'] = $client->getAccessToken();
    }
    //echo '<pre>'; print_r($tokenArr); die;
    return $tokenArr;

}
?>