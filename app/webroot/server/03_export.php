<?php

$email = "";
$pass = "";
$cal = "";

$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'connector';
$db_table = 'events';

$res = mysql_connect($db_host, $db_user, $db_pass);
mysql_select_db($db_name, $res);

include('google_proxy.php');
$calendar = new GoogleCalendarProxy($email, $pass, $cal);
//$calendar->enable_log(true);
$calendar->map("location", "details");
$calendar->export($res, $db_table);


?>