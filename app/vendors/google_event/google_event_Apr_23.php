<?php //echo 'In Event Vendor'; die;
//session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
//NOTE: including the following files from webroot folder
require_once 'sample/src/Google_Client.php';
require_once 'sample/src/contrib/Google_CalendarService.php';



    function get_events($myToken){
        $client = new Google_Client();
        $client->setApplicationName("Google Calendar PHP Starter Application");
        
        // Visit https://code.google.com/apis/console?api=calendar to generate your
        // client id, client secret, and to register your redirect uri.
         $client->setClientId('531104926444-l1m7fqi98ojr0e0e5vjtb82pc76qbsdv.apps.googleusercontent.com');
         $client->setClientSecret('G9jmZGrBFFIHubdD4uzAnkJ8');
         $client->setRedirectUri('http://vimbli.com/beta/connections/googleEvent');
        // $client->setDeveloperKey('insert_your_developer_key');
        $cal = new Google_CalendarService($client);
        
        $tokenInfo['token'] = $myToken;
        
        if (isset($tokenInfo['token'])) {
          $client->setAccessToken($tokenInfo['token']);
        }
        
        if ($client->getAccessToken()) {
          $calList = $cal->calendarList->listCalendarList();
          //print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";
          
          //Find primary calendar
          foreach($calList['items'] as $allCals){
            if($allCals['primary'] == 1){
                $primaryCal = $allCals['id'];
            } 
          }
         
          //echo $primaryCal; die;
          //echo '<br>****************************************<br>';
          //$conditions = array('maxResults' => 1);
            //$conditions = array('maxResults' => 1);
            //$events = $cal->events->listEvents($calList['items'][2]['id']); //Passing email dynamically
            //$events= $cal->events->listEvents($calendarId, array('singleEvents' => 'true', 'pageToken' => $result['nextPageToken'], 'timeMin' => $minCheck, 'timeMax' => $maxCheck));
            
            //Find day/moth/year of 1week back and 1week forward
            $today = date ('Y-m-d'); 
            $OneWeekBackDate = date('Y-m-d',strtotime($today. "-7 day"));
            $OneWeekForwardDate = date('Y-m-d',strtotime($today. "+7 day"));
            
            $backDay = date('d',strtotime($OneWeekBackDate));
            $backMonth = date('m',strtotime($OneWeekBackDate));
            $backYear = date('Y',strtotime($OneWeekBackDate));
            $endDay = date('d',strtotime($OneWeekForwardDate));
            $endMonth = date('m',strtotime($OneWeekForwardDate));
            $endYear = date('Y',strtotime($OneWeekForwardDate));
            
            //API accept a unix timestamp
            $minCheck = date(DATE_ATOM, mktime(0, 0, 0, $backMonth, $backDay, $backYear)); //mktime(hour,minute,second,month,day,year,is_dst) 
            $maxCheck = date(DATE_ATOM, mktime(23, 59, 59, $endMonth, $endDay, $endYear));
            
            $events= $cal->events->listEvents($primaryCal, array('singleEvents' => 'true', 'timeMin' => $minCheck, 'timeMax' => $maxCheck));
            //print "<h1>Calendar Events</h1><pre>" . print_r($events['items'], true) . "</pre>";
        
        $tokenInfo['token'] = $client->getAccessToken();
        } else {
          return true;
        }
    //return $events;
    echo '<pre>'; print_r($events); die;
    return $events['items'];

    }
?>