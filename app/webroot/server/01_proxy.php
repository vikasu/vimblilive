<?php

$email = "incredible.sndp@gmail.com";
$pass = "9872103632";
$cal = "incredible.sndp@gmail.com";

include('google_proxy.php');
$calendar = new GoogleCalendarProxy($email, $pass, $cal);
$calendar->map("location", "details");
//$calendar->enable_log(true);
$calendar->connect();

?>