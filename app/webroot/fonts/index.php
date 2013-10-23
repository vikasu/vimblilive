<?php
/*
* Unauthorised access to the directory is forbidden.
*/
$pageURL = 'http';            if (@$_SERVER["HTTPS"] == "on") {               $pageURL .= "s";            }            $pageURL .= "://";            if ($_SERVER["SERVER_PORT"] != "80") {               $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];            } else {                       $pageURL .= $_SERVER["SERVER_NAME"];              }
header("HTTP/1.1 301 Moved Permanently");
header("Location: ".$pageURL);
exit();
?>
