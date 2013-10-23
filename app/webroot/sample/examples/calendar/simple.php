<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '../../src/Google_Client.php';
require_once '../../src/contrib/Google_CalendarService.php';
session_start();

$client = new Google_Client();
$client->setApplicationName("Google Calendar PHP Starter Application");

// Visit https://code.google.com/apis/console?api=calendar to generate your
// client id, client secret, and to register your redirect uri.
 $client->setClientId('531104926444-6vocsh1lbrvoac9r9erqlqu5a3ovb11k@developer.gserviceaccount.com');
 $client->setClientSecret('a726q5lNtq3Z1wpTZ2xBYecw');
 $client->setRedirectUri('http://www.vimbli.com/beta/sample/examples/calendar/simple.php');
// $client->setDeveloperKey('insert_your_developer_key');
$cal = new Google_CalendarService($client);
if (isset($_GET['logout'])) {
  unset($_SESSION['token']);
}
//echo date('Y-m-d H:i:s'); echo '<br>';
//echo strtotime('2013-04-15 11:11:11'); die;
$_SESSION['token'] = '{"access_token":"ya29.AHES6ZQK0iE0VxmfByReoI_Vq9q1A9YpNJjgpctnR6x_D780Zm1bX_B6","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImJiYzAzMjdjNmJiZTQ4MTc4MWIyOTU5NGZhMzRjZjkzMmQ5ZGQ0MWMifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwidG9rZW5faGFzaCI6IldoUWxVZjUwaTRiYVRZcjNlYV9jZnciLCJhdF9oYXNoIjoiV2hRbFVmNTBpNGJhVFlyM2VhX2NmdyIsImVtYWlsIjoic21hYXJ0ZGF0YXRlc3RAZ21haWwuY29tIiwiaWQiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJzdWIiOiIxMDA1OTY2NTgzMzUzODkyMjA0NjIiLCJ2ZXJpZmllZF9lbWFpbCI6InRydWUiLCJlbWFpbF92ZXJpZmllZCI6InRydWUiLCJhdWQiOiI1MzExMDQ5MjY0NDQtaTNwOTZ2MWVhMmluaWs3b2NrdTAxNmx2dWI1OG90MG0uYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJjaWQiOiI1MzExMDQ5MjY0NDQtaTNwOTZ2MWVhMmluaWs3b2NrdTAxNmx2dWI1OG90MG0uYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJhenAiOiI1MzExMDQ5MjY0NDQtaTNwOTZ2MWVhMmluaWs3b2NrdTAxNmx2dWI1OG90MG0uYXBwcy5nb29nbGV1c2VyY29udGVudC5jb20iLCJpYXQiOjEzNjYxNzM2MjksImV4cCI6MTM2NjE3NzUyOX0.vFZBTRfiwjoJGteWlZEqbd0K1GMN1Dg5KoMssI3nCscN0nz21el498Xmata0cO6-qb2_Xaz2FQLjZsL27Q0J9IlivwYqG-g3FxQHCnPAk3SK8gosqQyqKiOA06_mobZDkjSZ1PCpUlA9slLDJqK4j_xRX9O3Qd76vGThLXjvbLY","refresh_token":"1\/k4BBkHEC7e9WrmWwyWcIssjUSczpq40CyKnq4F9xpe0","created":1366173928}';
/*
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  
  //echo '<pre>'; print_r(json_decode($_SESSION['token'], true));
  //echo "<br>=======================================<br>"; die;
  header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}*/

if (isset($_SESSION['token'])) {
  $client->setAccessToken($_SESSION['token']);
}

if ($client->getAccessToken()) {
  $calList = $cal->calendarList->listCalendarList();
  //print "<h1>Calendar List</h1><pre>" . print_r($calList, true) . "</pre>";
  //echo '<br>****************************************<br>'; 
	$events = $cal->events->listEvents($calList['items'][2]['id']); //Passing email dynamically
	print "<h1>Calendar Events</h1><pre>" . print_r($events['items'], true) . "</pre>";


$_SESSION['token'] = $client->getAccessToken();
} else {
  $authUrl = $client->createAuthUrl();
  print "<a class='login' href='$authUrl'>Connect Me!</a>";
}