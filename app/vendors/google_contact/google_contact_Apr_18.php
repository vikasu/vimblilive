<?php //echo 'In Event Vendor'; die;
//session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
//NOTE: including the following files from webroot folder
require_once 'sample/src/Google_Client.php';



    function get_contacts(){
        $client = new Google_Client();
        $client->setApplicationName('Google Contacts PHP Sample');
        //$client->setScopes("http://www.google.com/m8/feeds/");
        
        // Documentation: http://code.google.com/apis/gdata/docs/2.0/basics.html
        // Visit https://code.google.com/apis/console?api=contacts to generate your
        // oauth2_client_id, oauth2_client_secret, and register your oauth2_redirect_uri.
        
        $client->setClientId('531104926444-mj8tspetg78vj1ehgl2rqcivq6e7p4mq.apps.googleusercontent.com');
         $client->setClientSecret('c4w2KslQhTeSozvDrm-xU1LS');
         $client->setRedirectUri('http://vimbli.com/beta/connections/googleContact');
        
        // $client->setDeveloperKey('insert_your_developer_key');
        $tokenInfo['token'] = '{"access_token":"ya29.AHES6ZQY53_8QT34QwBdM_YVLamy5Hq-ZFDU6fuNE0fm9ZTSyQa0CxA","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImE5N2U5ODQ2ZmNiNjgwMGU4OWY2MDlhOWU1NGMzYWNiZjA4Mjg2OGEifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwidmVyaWZpZWRfZW1haWwiOiJ0cnVlIiwiZW1haWxfdmVyaWZpZWQiOiJ0cnVlIiwiYXVkIjoiNTMxMTA0OTI2NDQ0LWkzcDk2djFlYTJpbmlrN29ja3UwMTZsdnViNThvdDBtLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiY2lkIjoiNTMxMTA0OTI2NDQ0LWkzcDk2djFlYTJpbmlrN29ja3UwMTZsdnViNThvdDBtLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiNTMxMTA0OTI2NDQ0LWkzcDk2djFlYTJpbmlrN29ja3UwMTZsdnViNThvdDBtLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJzbWFhcnRkYXRhdGVzdEBnbWFpbC5jb20iLCJ0b2tlbl9oYXNoIjoib3dCOUZxN0ZMOTEyZktGamZUdWRPdyIsImF0X2hhc2giOiJvd0I5RnE3Rkw5MTJmS0ZqZlR1ZE93IiwiaWQiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJzdWIiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJpYXQiOjEzNjYyNzQ0MDUsImV4cCI6MTM2NjI3ODMwNX0.lHmFZgPMIdorTLkQUBCFGGkT4FA9dc_XOlVIDnEiWIh4oJNXzYFibJoPoVrPyFbEuCg0feDmlQERn1gIpqEIedX8xNtdUZTuOa0YOEpCdm1BcBNVB4_4KV3pMxl17nhr72BpXFf6xlHXTNoHIHEpjO_KAxWaWE0BVttauXgBdXU","refresh_token":"1\/5UZECJc5QSMpiWphW_wY7ohlNgqeI2mu-5DpYScIcbM","created":1366274704}';
        /*
        if (isset($_GET['code'])) {
          $client->authenticate();
          $_SESSION['token'] = $client->getAccessToken();
          //$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
          $redirect = 'http://vimbli.com/beta/connections/googleContact';
          header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
        }*/
        
        if (isset($tokenInfo['token'])) {
         $client->setAccessToken($tokenInfo['token']);
        }
        
        if (isset($_REQUEST['logout'])) {
          unset($_SESSION['token']);
          $client->revokeToken();
        }
        
        if ($client->getAccessToken()) {
          $req = new Google_HttpRequest("https://www.google.com/m8/feeds/contacts/default/full");
          
              
        
        $val = $client->getIo()->authenticatedRequest($req);
        $response = json_encode(simplexml_load_string($val->getResponseBody()));
        
          print "<pre>" . print_r(json_decode($response, true), true) . "</pre>";
        
          // The access token may have been updated lazily.
          $tokenInfo['token'] = $client->getAccessToken();
        } else {
          $auth = $client->createAuthUrl();
        }
        
        if (isset($auth)) {
          $auth = 'https://accounts.google.com/o/oauth2/auth?scope=https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://mail.google.com/ https://www.googleapis.com/auth/calendar https://www.googleapis.com/auth/calendar.readonly http://www.google.com/m8/feeds/&response_type=code&access_type=offline&redirect_uri=http://vimbli.com/beta/connections/googleContact&approval_prompt=force&client_id=531104926444-mj8tspetg78vj1ehgl2rqcivq6e7p4mq.apps.googleusercontent.com&hl=en-GB&from_login=1&as=3413ddad466b4f6';
            print "<a class=login href='$auth'>Connect Me!</a>";
          } else {
            print "<a class=logout href='?logout'>Logout</a>";
        }

    }
?>