
<html>
<head>
<title>IntraNCAOR - Logout</title>

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
#logout
{
	margin:auto;
	width:185px;
}
#logout2
{
	margin:auto;
	width:210px;
}

#login
{
	margin:auto;
	width:40px;
}
#goback
{
	margin:auto;
	width:275px;
}

</style>
</head>

<body>
<div id="header">
    <img id="line" src="newheader.png" width="100%" height="250" align="center">
	</div>
    
    <div id="main">
<p id="heading">
Logout
</p>

<?php
    session_start();
    $user=$_SESSION['user1'];
$stime=$_SESSION['stime'];
require 'variables.php';

$time_now1=mktime(date('H')+13,date('i')-30,date('s'));
$time1=date('H:i:s',$time_now1);

$ip = getenv("REMOTE_ADDR") ;
$date = date("d-m-Y"); 
$connect = pg_connect(connection_string);

$query1= "INSERT INTO tracking (username,from_time,to_time,ip,date) VALUES ('$user','$stime','$time1','$ip','$date')";
$result5=pg_query($query1); 


    												//Checking if the user is logged in or not.
	if(isset($_SESSION['user1']))
	{
		session_destroy();
										//Destroying session. User is now logged out.
	    echo "<div id='logout'>You have been logged out.</div>";
		echo "<br /><div id='login'><a href='./' target='_parent'>Login</a></div>";
		echo "<br/><div id='goback'><a href='../' target='_parent'>Go Back To Intra-NCAOR Home-Page</a><div><br />";
	}
	
	else
    {
    	
	echo "<div id='logout2'>You are already logged out.</div><br/>".$query1;
	echo "<div id='login'><a href='./' target='_parent'>Login</a></div>";
	echo "<br/><div id='goback'><a href='../' target='_parent'>Go Back To Intra-NCAOR Home-Page</a><div><br/>";
    }
	  
?>
</div>

</body>
</html>