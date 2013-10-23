<?php
echo $localtz = "+5:30";//date("P");
echo "<br>";
//echo date("Y-m-d H:i:s");
$tz = substr($localtz, 1);
$tz_arr = explode(":", $tz);
$tz_sec = ($tz_arr[0]*60*60)+$tz_arr[1];

$sign = substr($localtz, 0,1);
echo $starttime = "2012-08-24 21:30";
$starttimeintosec = strtotime($starttime);
switch($sign){
	case "+":
		$endtimeintosec = $starttimeintosec - $tz_sec;
	break;
	case "-":
		$endtimeintosec = $starttimeintosec + $tz_sec;
	break;
}



echo "<br>";
echo date("Y-m-d H:i",$endtimeintosec);

?>

