<?php
session_start();
if(isset($_SESSION['user1']))								//Re-directing to leaveform.php if user is already is logged in.
{
	$host  = $_SERVER['HTTP_HOST'];
	$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'leaveform.php';
	header("Location: http://$host$uri/$extra");
}
else
{
	echo '
<html>
<head>

<title>Login Form</title>

<style>
#main
{
	margin:auto;
	width:400px;
}

#heading
{
	font-size:30px;
	text-align:center;
}

#form
{
	margin:auto;
	width:250px;
}

form
{
	position:relative;
}

input[type="text"], input[type="password"]
{
	position:absolute;
	left:80px;
}

#form input[type="submit"]
{   
	margin-left:50px;
	width:70px;
}



</style>
</head>

<body>
<div id="header">
   <img id="line" src="newheader.png" width="100%" height="250" align="center">
</div>

<div id="main">
<p id="heading">Login Form</p>
<div id="form">';													//Login Form
echo '
<form method="post" action="leaveform.php">

  <label for:"userid">User ID</label>
  <input type="text" name="userid" id="userid" />
   <br /> <br/>
  <label for="password">Password</label>
  <input type="password" name="password" id="password" />
  <br /><br/><br/>
  <input type="submit" value="Submit" name="submit" />
  <input type ="Reset" name="reset" value="reset">
  <br/><br/>
</form>
</div>

</div>';															//Change Password and Forgot Password Link.
echo '

</div>
</body>
</html>';
}
?>
