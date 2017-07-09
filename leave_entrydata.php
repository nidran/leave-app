<html>
<head>
<style>
form
{
width:30%;
margin-left: 35%;
border: solid;
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
</style>
</head>
<body>
<div id="header">
   <img id="line" src="newheader1.png" width="100%" height="250" align="center">
</div>
<h1 align="center">Leave Entry Data</h1><br><br>
<form action='updateleave.php' method='post' id='form3'>
							<h3 align="center">Enter the Employee ID:</h3>
							<br/>
							<input type='text' name='empid' id='empid' />
							<br/><br/>
							<input id="button" type='submit' value='Submit' name='submit1' />	<br><br>
							</form>
  			<div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/>
  			</body>
  			</html>