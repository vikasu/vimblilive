<?php
//session_start();
require_once 'sample/src/Google_Client.php';
require_once 'sample/src/contrib/Google_Oauth2Service.php';



function get_refresh_token($myToken, $reqFor = NULL){
    /*
    echo $myToken;
    echo '<br>';
    echo $reqFor;
    die;
    */
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
 $client->setRedirectUri('http://vimbli.com/connections/oauthRefresh');
// $client->setDeveloperKey('insert_your_developer_key');
$oauth2 = new Google_Oauth2Service($client);

   
    //$tokenInfo['token'] = '{"access_token":"ya29.AHES6ZRQxngAZQLHJjNHb8I3wjK2vsjO1siqUvKAaoebftvHfw","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6IjdiYWM5Yjc4MTY5NmQ3MjhiZTU1NjFmMGZhZjdjNzgwZmUyYjM4NjkifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwidG9rZW5faGFzaCI6Ik12VkNuSXVOTnotLVY4TnBneVI4aFEiLCJhdF9oYXNoIjoiTXZWQ25JdU5Oei0tVjhOcGd5UjhoUSIsInZlcmlmaWVkX2VtYWlsIjoidHJ1ZSIsImVtYWlsX3ZlcmlmaWVkIjoidHJ1ZSIsImVtYWlsIjoic21hYXJ0ZGF0YXRlc3RAZ21haWwuY29tIiwiaWQiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJzdWIiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJhdWQiOiI1MzExMDQ5MjY0NDQtMzA0MW91Z25qc2JrbjA5c2JycTYybWNjZThucDRzMWQuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJjaWQiOiI1MzExMDQ5MjY0NDQtMzA0MW91Z25qc2JrbjA5c2JycTYybWNjZThucDRzMWQuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJhenAiOiI1MzExMDQ5MjY0NDQtMzA0MW91Z25qc2JrbjA5c2JycTYybWNjZThucDRzMWQuYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJpYXQiOjEzNjY2MjQyMzQsImV4cCI6MTM2NjYyODEzNH0.VBCo69ZyoVrH7dSIdmFGuHpjDmykrg7BbXxCvyBe7vRm2rpJ_ph3vYEZDPaP36Mblow8ihsIQwsr-feAOE4L-srLiprm3ZgdZXq9L9vH8TRNCSKa7Oin1zfIg3crEPdiE4t_r3sTF9wSI1WU-vdPmi1p2yhS48UY8iVL7Xs219U","refresh_token":"1\/IYokXwoQuG0luXb4mqIgG0eym_UZqHK-JzapoZ-SS4I","created":1366624533}';
    $tokenInfo['token'] = $myToken;
    //echo $myToken; die;
    
        if (isset($tokenInfo['token'])) {
            $client->setAccessToken($tokenInfo['token']);
        }
        
        $requesttoken = $tokenInfo['token'];
        //echo $requesttoken; die;
        $jsonreq = json_decode($requesttoken, true);  
        /*
        echo "=================<br>";
        echo '<pre>'; print_r($jsonreq);
        echo "=================<br>";
        //die;
        */
        
    if($reqFor == ""){    //echo 'refresh'; die;
        $resultrefresh = $client->refreshToken($jsonreq['refresh_token']);
        //$resultrefresh = $client->refreshToken("1/QPVAqBlT4M65sEse_OJQoXBHe91uGdIwr1BJ3UWAAVEAA"); 
        //echo "<pre>";
        //echo "Token Refreshed";
        //echo "<br>==================<br>";
        //isAccessTokenExpired
        //echo 'New '.$resultrefresh; die;
        
        $tokenArr = json_decode($client->getAccessToken(),true);
        $tokenArr['json_resp'] = $client->getAccessToken();
        
      //echo "<pre><br>NEW TOKEN<br>";
      //print_r($resultrefresh); die;
      
      //echo '<pre>'; print_r($newTokenInfo);
      //die;
      return $tokenArr;
    } else { //echo 'revoke'; die;
        $client->revokeToken($jsonreq['refresh_token']);
        return 1;
    }

}
?>