<html>
<head>
	<script type="text/javascript" src="tcal.js"></script>
	<link rel="stylesheet"  href="tcal.css">
<title>IntraNCAOR - Leave Applications</title>
<style>
<style>

form
{
	position:relative;
}

input[type="text"], input[type="file"], textarea, select
{
	margin-left: 40%;
	position:absolute;
	left:160px;
}


label
{margin-left: 40%;
	width:100px;
}



#heading
{
	font-size:30px;
	text-align:center;
}



#login
{
	text-align:center;
}

#logout
{
	position:absolute;
	top:10px;
	right:0px;
}

</style>
</head>
<body>
<div id="header">
   <img id="line" src="newheader.png" width="100%" height="250" align="center">
</div>
    
    <div id="main">
	<p id='heading'>Leave</p>
	</div>
<?php
session_start();
require 'variables.php'; 
$conn=pg_connect(connection_string);
$empid= $_GET['q'];
echo "<br>CL<br>";
$query="select * from leave where employeeid='".$empid."' and (status<>'cancelled' and status<>'reject') and nature='CL'";
$result=pg_query($query);
$row=pg_fetch_all($result);
$num=pg_num_rows($result);
for ($i=0; $i <$num ; $i++) 
{ 
echo $row[$i]["fromdate"];
}
echo "<br>RH<br>";
$query="select * from leave where employeeid='".$empid."' and (status<>'cancelled' and status<>'reject') and nature='RH'";
$result=pg_query($query);
$row=pg_fetch_all($result);
$num=pg_num_rows($result);
for ($i=0; $i <$num ; $i++) 
{ 
echo $row[$i]["fromdate"];
}
?>


