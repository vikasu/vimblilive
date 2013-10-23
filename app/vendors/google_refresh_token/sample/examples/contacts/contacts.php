<html>
<head>
<meta name="robots" content="noindex" />
<title>Email address list - Import Gmail or Google contacts</title>
<style type="text/css">
	a:link {color:Chocolate;text-decoration: none;}
	a:hover {color:CornflowerBlue;}
	.logo{width:100%;height:110px;border:2px solid black;background-color:#666666;}
</style>
</head>
<body>
	<div class="logo" >
		<a href="http://25labs.com/" >
			<img style="padding-top: 10px;" src="http://25labs.com/wp-content/themes/TheStyle/images/logo.png"></img>
		</a>
	</div>
	<br/>
	<div><b>Visit Tutorial: </b><a style="font-size:17px;" href="http://25labs.com/import-gmail-or-google-contacts-using-google-contacts-data-api-3-0-and-oauth-2-0-in-php/" >Import Gmail or Google contacts using Google Contacts Data API and OAuth 2.0 in PHP</a></div>
	<br/>
	<div style="padding-left: 50px;">
<?php
$client_id='531104926444-2299mie5h111l4mg9fu6923r8ekg1v39.apps.googleusercontent.com';
$client_secret='Tp2z_t2ee0VhG_HCls0vADiK';
$redirect_uri='http://www.vimbli.com/beta/sample/examples/contacts/contacts.php';
$max_results = 25;
 
$auth_code = "ya29.AHES6ZSJg-_01X5NZezEU-N5EprM7utnv03n49fpFauWLjA";
 
function curl_file_get_contents($url)
{
 $curl = curl_init();
 $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
 
 curl_setopt($curl,CURLOPT_URL,$url);	//The URL to fetch. This can also be set when initializing a session with curl_init().
 curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);	//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
 curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);	//The number of seconds to wait while trying to connect.	
 
 curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);	//The contents of the "User-Agent: " header to be used in a HTTP request.
 curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);	//To follow any "Location: " header that the server sends as part of the HTTP header.
 curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);	//To automatically set the Referer: field in requests where it follows a Location: redirect.
 curl_setopt($curl, CURLOPT_TIMEOUT, 10);	//The maximum number of seconds to allow cURL functions to execute.
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);	//To stop cURL from verifying the peer's certificate.
 
 $contents = curl_exec($curl);
 curl_close($curl);
 return $contents;
}
 
$fields=array(
    'code'=>  urlencode($auth_code),
    'client_id'=>  urlencode($client_id),
    'client_secret'=>  urlencode($client_secret),
    'redirect_uri'=>  urlencode($redirect_uri),
    'grant_type'=>  urlencode('authorization_code')
);

echo "<pre>";
print_r($fields);

$post = '';
foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
$post = rtrim($post,'&');
 
$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
curl_setopt($curl,CURLOPT_POST,5);
curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,FALSE);
$result = curl_exec($curl);
curl_close($curl);
 
$response =  json_decode($result);
$accesstoken = $response->access_token;
 
$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&oauth_token='.$accesstoken;
$xmlresponse =  curl_file_get_contents($url);

echo "A<pre>";
print_r($xmlresponse);


if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0)) //At times you get Authorization error from Google.
{
	echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
	exit();
}
echo "<h3>Email Addresses:</h3>";
$xml =  new SimpleXMLElement($xmlresponse);
$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
$result = $xml->xpath('//gd:email');
 
foreach ($result as $title) {
  echo $title->attributes()->address . "<br>";
}
?>
	</div>
</body></html>