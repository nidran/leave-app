<html>
<head>
<style>
form
{
width:30%;
margin-left: 35%;
}
#logout
{
	position:absolute;
	top:30%;
	right:0px;
}
input
{
	margin-left: 32%;
}
#button
{
	margin-left: 42%;
}
#report
{
	margin-left: 35%;
}
th,td
{
   
   margin:0;
   width: 10%;
   table-layout: fixed;
   text-align: center;
   border-collapse: collapse;
   outline: 1px solid black;
}
table
{
   margin-left: 0%;
   }
   #display
   {
   	width:40%;
   }
</style>
</head>
<body>
<div id="header">
   <img id="line" src="newheader1.png" width="100%" height="250" align="center">
</div>
<?php
session_start();
if(isset($_SESSION['user1']))						//if user is already logged in
	{
echo "<h1 align='center'>Leave Entry Data</h1><br><br>
<form action='leave_individual.php' method='post' id='form3'>
							<h3 align='center'>Enter the Employee ID:</h3>
							<br/>
							<input type='text' name='empid' id='empid' />
							<br/><br/>
							<input id='button' type='submit' value='submit' name='submit' />	<br><br>
							</form>
  			<div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/>";
  	}
 else
 	{
		echo " <div id='login'>Please login to view this page.<br/><a href='./' target='_parent'>Login</a></div><br/>";		//user not logged in
	}
	?>
  			</body>
  			</html>