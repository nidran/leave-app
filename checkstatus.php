<html>
<head>
<style>
#main
{
	margin:auto;
	width:400px;
	position:relative;
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
	top:5px;
	right:-50px;
}
#goback
{
	position:absolute;
	top:5px;
	left:-150px;
}

</style>
<script type="text/javascript" language="javascript">
var leaveid;
function verify(leaveid)										//function to confirm cancellation of leave
{
	var a = confirm ("Are you sure you want to cancel your leave with id : "  +  leaveid);	//Conformation message
	if(a)														//if yes
	{
		//go to leavecancelled.php and pass leave ID by GET method
		var b = window.location.href;
		var bs=b.split("/");
		bs[bs.length-1]="leavecancelled.php?lid="+leaveid;
		var newloc = bs.join("/");
		window.location=newloc;
	}
}
</script>
</head>

<body>
	<div id="header">
   <img id="line" src="newheader.png" width="100%" height="250" align="center">
</div>
    <div id="main">
<p id="heading">
Leave Status
</p>

<?php
session_start();
require 'variables.php';
if (isset($_SESSION['user1']))					//Checking of user is logged in
{
	if ($_SESSION['priv1']==6||$_SESSION['priv1']==4||$_SESSION['priv1']==1)					//Checking priv. of user. Only priv. 6 (normal user) allowed
	{	
		if($_POST['compid']!=NULL)				//Validation, checking a valid leave ID is passed
		{
			$leaveid=$_POST['compid'];			//getting the leave ID by POST method
			$eid=$_SESSION['user1'];			//getting employee ID from session variable
			$conn=pg_connect(connection_string);
	
			if(!$conn)
				echo "<div class='error'>".MSG_NO_CONN."<br/><br/></div>"; 
	
			else
			{   	
			    $result=pg_query($conn,"select * from leave where (leaveid='".$leaveid."' and employeeid='".$eid."')");
												//getting the details of leave request from leave table using employee ID and leave ID
				if(pg_num_rows($result)==0)
				{	//leave ID and employee ID not matching	
					echo "<div class='error'>".MSG_NO_LEVID."<br/><br/></div>"; 
				}
				else
				{
					$row=pg_fetch_row($result);
					$result1=pg_query($conn,"select * from employee where employeeid='".$eid."'");	
					$row1=pg_fetch_row($result1);			//employee name
					echo "The leave ID entered was ".$leaveid.".</br>"; 
					echo "This leave request was given by ".$row1[1].".</br>";
					echo "The current status of leave is ".$row[11].".</br>";		//leave status
					if($row[23]!='verified')	//not verified by admin yet
					{
						echo "Your leave has not been verified by Admin.<br>";
					}
					else{
						echo "Your leave has been verified by Admin.<br>";
					}
					echo "</br><div id='cancel'><a href='javascript:verify(\"".$leaveid."\")' target='_parent'> Cancel Leave</a></div><br/>";
																					//cancel leave option, calls a javascript function, varify
				}
			}
		}
		else
		{
			echo "<div class='error'>".MSG_MISS_DETAILS."<br/><br/></div>";			//Validation failed
		}
	}
	else 
		echo "<div class='error'>".MSG_MORE_PREVS."<br/><br/></div>";				//Wrong privileges
	echo "<br /><div id='goback'><a href='leaveform.php' target='_parent'>Go back to Leave form</a></div><br/>";
	echo "<div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/>";
}
else																				//user not logged in
	echo " <div id='login'>Please login to view this page.<br/><a href='./' target='_parent'>Login</a></div><br/>";
?>

</body>
</html>