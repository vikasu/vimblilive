<?php //echo 'In Event Vendor'; die;
//session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
//NOTE: including the following files from webroot folder
require_once 'sample/src/Google_Client.php';



    function get_contacts($myToken){
        $client = new Google_Client();
        $client->setApplicationName('Google Contacts PHP Sample');
        
        // Documentation: http://code.google.com/apis/gdata/docs/2.0/basics.html
        // Visit https://code.google.com/apis/console?api=contacts to generate your
        // oauth2_client_id, oauth2_client_secret, and register your oauth2_redirect_uri.
        $client->setClientId('531104926444-aqlo2ks04ru7c7udgocduntnflsu7a8f.apps.googleusercontent.com');
         $client->setClientSecret('ctrF9arKIZcQGxNb6n2oHhSr');
         $client->setRedirectUri('http://vimbli.com/connections/googleContact');
        // $client->setDeveloperKey('insert_your_developer_key');
        
        //$tokenInfo['token'] = '{"access_token":"ya29.AHES6ZQY53_8QT34QwBdM_YVLamy5Hq-ZFDU6fuNE0fm9ZTSyQa0CxA","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImE5N2U5ODQ2ZmNiNjgwMGU4OWY2MDlhOWU1NGMzYWNiZjA4Mjg2OGEifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwidmVyaWZpZWRfZW1haWwiOiJ0cnVlIiwiZW1haWxfdmVyaWZpZWQiOiJ0cnVlIiwiYXVkIjoiNTMxMTA0OTI2NDQ0LWkzcDk2djFlYTJpbmlrN29ja3UwMTZsdnViNThvdDBtLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiY2lkIjoiNTMxMTA0OTI2NDQ0LWkzcDk2djFlYTJpbmlrN29ja3UwMTZsdnViNThvdDBtLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiNTMxMTA0OTI2NDQ0LWkzcDk2djFlYTJpbmlrN29ja3UwMTZsdnViNThvdDBtLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJzbWFhcnRkYXRhdGVzdEBnbWFpbC5jb20iLCJ0b2tlbl9oYXNoIjoib3dCOUZxN0ZMOTEyZktGamZUdWRPdyIsImF0X2hhc2giOiJvd0I5RnE3Rkw5MTJmS0ZqZlR1ZE93IiwiaWQiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJzdWIiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJpYXQiOjEzNjYyNzQ0MDUsImV4cCI6MTM2NjI3ODMwNX0.lHmFZgPMIdorTLkQUBCFGGkT4FA9dc_XOlVIDnEiWIh4oJNXzYFibJoPoVrPyFbEuCg0feDmlQERn1gIpqEIedX8xNtdUZTuOa0YOEpCdm1BcBNVB4_4KV3pMxl17nhr72BpXFf6xlHXTNoHIHEpjO_KAxWaWE0BVttauXgBdXU","refresh_token":"1\/5UZECJc5QSMpiWphW_wY7ohlNgqeI2mu-5DpYScIcbM","created":1366274704}';
        
        $tokenInfo['token'] = $myToken;
        
        if (isset($tokenInfo['token'])) {
         $client->setAccessToken($tokenInfo['token']);
        }
        
        if ($client->getAccessToken()) {
        $req = new Google_HttpRequest("https://www.google.com/m8/feeds/contacts/default/full");
          
        $val = $client->getIo()->authenticatedRequest($req);
        
        
        $jsonreq = json_decode($tokenInfo['token'], true);
        $tok_value = $jsonreq['access_token'];
        //echo $tok_value; die;
        //$tok_value = 'ya29.AHES6ZQHCcpIX29pRirVBCUmpy-6uEci9WhOj-HjvhgiXueaXA';
        //passing accesstoken to obtain contact details
        $xml_response =  file_get_contents('https://www.google.com/m8/feeds/contacts/default/full?oauth_token='.$tok_value.'&max-results=20000');
        
        $xml = new SimpleXMLElement($xml_response);
        $xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
    
        $results = array (); 
        foreach($xml->entry as $entry){
            $xml = simplexml_load_string($entry->asXML());
           
            $ary = array ();
            
            $ary['id'] = (string) $entry->id;
            $ary['name'] = (string) $entry->title;
            
            foreach ($xml->email as $e) {
              $ary['emailAddress'][] = (string) $e['address'];
            }
            
            //echo '<pre>'; print_r($xml->phoneNumber[1]);
            $phCnt = 0;
            foreach ($xml->phoneNumber as $phone) { 
                $ary['phoneNumber'][] = (string) $xml->phoneNumber[$phCnt];
                //$ary['phoneNumber'][] = (string) $xml->phoneNumber[1];
                $phCnt = $phCnt+1;
            }
            
            $adCnt = 0;
            foreach ($xml->postalAddress as $address) { 
              $ary['postalAddress'][] = (string) $xml->postalAddress[$adCnt];
              $adCnt = $adCnt+1;
            }
    
            /*
            if (isset($ary['emailAddress'][0])) {
                $ary['email'] = $ary['emailAddress'][0];
            }*/
    
            $results[] = $ary;
        }
    
        //echo '<pre>'; print_r($results);
    
        //die;
        
        //$xml = new SimpleXMLElement($val->getResponseBody());
       //$xml = simplexml_load_string($xml);
       //echo '<pre>'; print_r($val->getResponseBody()); die;
       
     
        /******Fetch Email*****/
        //$email = $xml->xpath("//gd:email");
        //echo '<pre>'; print_r($email); die;
        /********************/
        /******Fetch Phone*****/
        //$phone = $xml->xpath('//gd:phoneNumber');
        //echo '<pre>'; print_r($phone); die;
        /********************/
         /******Fetch Address*****/
        //$address = $xml->xpath('//gd:postalAddress');
        //echo '<pre>'; print_r($address); die;
        /********************/
        
        
        $response = json_encode(simplexml_load_string($val->getResponseBody()));
        
        //echo '<pre>'; print_r(simplexml_load_string($val->getResponseBody()));
        
      
        
          //print "<pre>" . print_r(json_decode($response, true), true) . "</pre>";
          $result = json_decode($response, true);
        
          // The access token may have been updated lazily.
          $tokenInfo['token'] = $client->getAccessToken();
        } else {
          return true;
        }
        
        //echo '<pre>'; print_r($result); die;
        return $results; 
    }
?>