<html>
<head>
<meta name="robots" content="noindex" />
<title>Import Gmail or Google contacts using Google Contacts Data API and OAuth 2.0</title>
<style type="text/css">
	a:link {color:Chocolate;text-decoration: none;}
	a:hover {color:CornflowerBlue;}
	.logo{width:100%;height:110px;border:2px solid black;background-color:#666666;}
</style>
</head>
<body>
<?php
$client_id='531104926444-vh8t6fe6qledllpfctp9vspadbmpd6cn.apps.googleusercontent.com';
$client_secret='gYLLJRmpmXZUs7Gqw57xUqk5';
$redirect_uri='http://www.vimbli.com/beta/oauth/oauth2.php';
$max_results = 25;
?>	 
 
	<div align="center" >
	<a  style="font-size:25px;font-weight:bold;" href="https://accounts.google.com/o/oauth2/auth?client_id=<?php echo $client_id; ?>&redirect_uri=<?php echo $redirect_uri; ?>&scope=https://www.google.com/m8/feeds/&response_type=code">Click here to Import Gmail Contacts</a>
	</div>
</body>
</html>