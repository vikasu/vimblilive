<?php
/*
* Unauthorised access to the directory is forbidden.
*/
$pageURL = 'http';
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".$pageURL);
exit();
?>