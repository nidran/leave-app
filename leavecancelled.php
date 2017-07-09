
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
</head>

<body>
	<div id="header">
    <a href="../" title="Click here to go to IntraNCAOR website.">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
	</div>
    <div id="updates-wrapper">
    	<div id="prev"></div>
    	<span>Updates :&nbsp;</span>
    	<div id="updates"></div>
        <div id="next"></div>
    </div>
    <div id="main">
<p id="heading">
Cancel Leave
</p>

<?php
session_start();
require 'variables.php';

if (isset($_SESSION['user1']))								//Checking if user is logged in or not
{
	if($_GET['lid']!=NULL)									//Validation, checking if a valid leave ID was given for cancellation
	{
		$leid=$_GET['lid'];									//Getting leave ID by GET method
		if ($_SESSION['priv1']==6)							//Checking priv. of user. Only priv. 6 (normal user) allowed
		{
			$conn=pg_connect(connection_string);
	
			if(!$conn)
				echo "<div class='error'>".MSG_NO_CONN."<br/><br/></div>";
	
			else
			{
				$result=pg_query($conn,"select * from leave where leaveid='".$leid."'");
				$row=pg_fetch_row($result);					//Getting details of leave request from leave table using leave ID.
				$empid=$row[1];								//Employee ID
				$noofdays=$row[4];							//No. of days
				$status=$row[11];							//Status
				$from=$row[6];								//From Date (CL) or Date 1 (RH)
				
				$fromtime=strtotime($from);					//Converting from date in time
				if($status!="cancelled"&&$status!="reject")				//Checking if leave request is not cancelled or rejected before.
				{
					$currtime=time();									//Getting current time
					if($fromtime>=$currtime)							//Checking that the from date has not passed.
					{
						$query="update leave set status='cancelled' where leaveid='".$leid."'";
						$result2=pg_query($conn,$query);				//Leave request cancelled
						echo "Leave request with the LeaveID ".$leid." has been cancelled.<br/>";
				 
				 		$result3=pg_query($conn,"select * from leave where (employeeid='".$empid."' and leaveid>'".$leid."' and nature='".$nature."')");																	//increasing noleft in all the leave requests made after the cancelled request by the noofdays in the cancelled request
						while($row3=pg_fetch_row($result3))
						{
							$lid=$row3[0];
							$noleft=$row3[10]+$noofdays;
							$result4=pg_query($conn,"update leave set noleft='".$noleft."' where leaveid='".$lid."'");
						}
					}
					else
					{
						echo "<div class='error'>The leave has already been availed.<br/><br/></div>";		//If from date has already passed							
					}
				}
				elseif($status=="cancelled")
				{
					echo "<div class='error'>The leave request has already been cancelled.<br/><br/></div>";
																								//If leave request has already been cancelled
				}
				elseif($status=="reject")
				{
					echo "<div class='error'>The leave request has already been rejected.<br/><br/></div>";
																								//If leave request has already been rejected
				}
			 	echo "<br /><div id='goback'><a href='leaveform.php' target='_parent'>Go back to Leave Form</a></div><br/>";
	    	 	echo "<div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/>";
			}		
		}
		else
		{
			echo "<div class='error'>".MSG_MORE_PREVS."<br/><br/></div>";			//wrong privileges
		}
	}	
	else
	{
		echo "<div class='error'>".MSG_MISS_DETAILS."<br/><br/></div>";				//leave ID not valid 
	}
}
else
{
	//user not logged in
	echo " <div id='login'>Please login to view this page.<br/><a href='login.php' target='_parent'>Login</a></div><br/>";
}
?>
</div>
</body>
</html>