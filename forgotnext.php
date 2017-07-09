<html>
<body>
<form method="POST" >
<img id="line" src="newheader.png" width="100%" height="250" align="left">
<div align="left">
<a href="index.php"><b>Back</b></a>
</div>
</form>
</body>
</html>


<?php

$username_login =$_POST['username'];
//setting the encription key
define('ENCRYPTION_KEY', 'd0a7e7997b6d5fcd55f4b5c32611b87cd923e88837b63bf2941ef819dc8ca282');
if($_POST['submit']=='send mail')
{ 
    //checking the username entered with the username in the database and retrieving the password
	$mail = $_POST['eid'].$_POST['ncaor.gov.in'];
	require 'variables.php'; 
 	$db= pg_connect(connection_string); 
  	$query = "SELECT password FROM user_table WHERE username='$username_login'";
  	$result = pg_query($query);
	for ($row = 0; $row < pg_numrows($result); $row++) 
	{  
	 	$password = pg_fetch_result($result, $row,'password'); 
	}  
     //function to decrypt the password from database 
	function mc_decrypt($decrypt, $key){
    $decrypt = explode('|', $decrypt);
    $decoded = base64_decode($decrypt[0]);
    $iv = base64_decode($decrypt[1]);
    $key = pack('H*', $key);
    $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
    $mac = substr($decrypted, -64);
    $decrypted = substr($decrypted, 0, -64);
    $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
    if($calcmac!==$mac)
    { 
    	return false; 
    }
    $decrypted = unserialize($decrypted);
    return $decrypted;
}

$encpassword=mc_decrypt($password);
session_start();
$_SESSION['message']="Your password is ".$encpassword;
//include "email.php";
session_destroy();
}
?>

