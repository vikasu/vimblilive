<?php

/* JPEGCam Test Script */
/* Receives JPEG webcam submission and saves to local file. */
/* Make sure your directory has permission to write files as your web server user! */

$filename = date('YmdHis') . '.jpg';
$path = $_SERVER['DOCUMENT_ROOT'].'/beta/app/webroot/files/cam_img/';
$result = file_put_contents($path. $filename, file_get_contents('php://input') );
if (!$result) {
	print "ERROR: Failed to write data to $filename, check permissions\n";
	exit();
}

//$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/' . $filename;
$url = 'http://' . $_SERVER['HTTP_HOST'] . '/app/webroot/files/cam_img' . '/' . $filename;
print "$url\n";

?>
