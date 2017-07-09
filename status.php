<html>
<style>
#lam
{	margin-top: 2%;
	margin-left: 45%;
}
#logout
{
	margin-left: 85%;
}
</style>
<head>
	<div id="header">
   <img id="line" src="newheader.png" width="100%" height="250" align="center">
</div>
</head>
<body>
<?php
echo"<div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/><br/><br/><br/>";
echo"						<form  id='lam' name='form2' action='checkstatus.php' method='post' id='form2'>
							<p id='heading2'>Check Your Leave Status</p>

							<label for='compid'>Enter the Leave ID</label>
							<input type='text' name='compid' id='compid' />
							<br/><br/>
							<input type='submit' value='Check Status' name='submit1' />	
							</form>";
							
?>
</body>

</html>