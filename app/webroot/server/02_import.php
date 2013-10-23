<?php

$email = "incredible.sndp@gmail.com";
$pass = "9872103632";
$cal = "incredible.sndp@gmail.com";

$db_host = 'localhost';
$db_user = 'vimbli';
$db_pass = 'vimbli';
$db_name = 'db_vimbli ';
$db_table = 'calendar_events';

$res = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $res);

include('google_proxy.php');
$calendar = new GoogleCalendarProxy($email, $pass, $cal);
//$calendar->enable_log(true);
$calendar->map("location", "details");
//print_r( $res); exit;
$count = $calendar->import($res, $db_table);
echo $count." events was/were imported.";

?>