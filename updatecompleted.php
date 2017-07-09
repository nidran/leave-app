<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>IntraNCAOR - Update Leave</title>

<style>
#main
{
	margin:auto;
	width:600px;
	position:relative;
}

#heading
{
	font-size:30px;
	text-align:center;
}
#mainpart
{
	margin:auto;
	width:235px;
}
#login
{
	text-align:center;
}

#logout
{
	position:absolute;
	top:5px;
	right:50px;
}
#goback
{
	position:absolute;
	top:5px;
	left:-50px;
}

</style>
</head>

<body>
<div id="header">
   <img id="line" src="newheader.png" width="100%" height="250" align="center">
</div>
    <div id="main">
<p id="heading">
Update Leave
</p>
<div id="mainpart">
<?php
require 'variables.php';
session_start(); 
if(isset($_SESSION['user1']))								//Checking if user is logged in or not.
{
	$priv = $_SESSION['priv1'];
	if ($priv==1||$priv==8||$priv==7)									//Checking the privileges of user. Only users with privilege 7 & 8 allowed to view this page.
	{
		if($_POST['status']!=NULL&&$_POST['lid']!=NULL)		//Validation, checking status and leave ID in editleave.php
		{
			$status=$_POST['status'];
			$reason=$_POST['reject'];						//Reason for rejection
	        $leaveid=$_POST['lid'];
			$nature=$_POST['nature'];
			$conn=pg_connect(connection_string);	
			$resultx=pg_query("select * from leave where flag='$leaveid'");
			if(pg_num_rows($resultx)!=0)
			{
			$row2=pg_fetch_assoc($resultx);
			$leaveid2=$row2['leaveid'];
			}
        	if(!$conn)
				echo "<div class='error'>".MSG_NO_CONN."<br/><br/></div>"; 
        	else
			{
				if ($priv==1)								//priv. 1 - Department HOD's
				{
					if($status!="reject")
						{$query="update leave set status='".$status."', currently='director', reason='".$reason."' where leaveid='".$leaveid."'";
							if(pg_num_rows($resultx)!=0)
								$query2="update leave set status='".$status."', currently='director', reason='".$reason."' where leaveid='".$leaveid2."'";
						}									//approved by HOD, passing leave request to Director
					else
						{
							$query="update leave set status='".$status."', reason='".$reason."' where leaveid='".$leaveid."'";
							if(pg_num_rows($resultx)!=0)
								$query2="update leave set status='".$status."', reason='".$reason."' where leaveid='".$leaveid2."'";
						}									//rejected by HOD
				}
				elseif ($priv==7)								//priv. 7 - Admin
				{
					
						$query="update leave set adminstatus='".$status."', currently='director', reason='".$reason."' where leaveid='".$leaveid."'";
						if(pg_num_rows($resultx)!=0)
							$query2="update leave set adminstatus='".$status."', currently='director', reason='".$reason."' where leaveid='".$leaveid2."'";
														//Verified, passing leave request to Director
				}
				else										//for director
				{
					if($status=='approvedbyhod')
						$status='approved';
					$query="update leave set status='".$status."', reason='".$reason."' where leaveid='".$leaveid."'";
					if(pg_num_rows($resultx)!=0)
								$query2="update leave set status='".$status."', reason='".$reason."' where leaveid='".$leaveid2."'";
															//approved or rejected by director
				}
				$result=pg_query($conn,$query);
				if(pg_num_rows($resultx)!=0)
					$result3=pg_query($conn,$query2);
	    	    echo "The leave has been updated.<br/>";				
				
				if($status=='approved'||$status=='reject'||$status=='approvedbyhod')
				{
					$result2=pg_query($conn,"select * from leave where leaveid='".$leaveid."'");
					$row2=pg_fetch_row($result2);
					$noofdays=$row2[4];						//getting the number of days for which the leave was applied.
					$id=$row2[1];							//employee ID of the employee who made the request.
					
					$result3=pg_query($conn,"select * from employee where employeeid='".$id."'");
					$row3=pg_fetch_row($result3);
					$name=$row3[1];							//name of employee ID
					$to=$row3[3];							//e-mail ID of the employee
					
					if($status=='approved')
					{
						$message="Your leave request with leave ID no.=".$leaveid." has been approved.";
															//approved. messege to be sent to employee to inform.
					}
					else if($status=='reject')
					{
															//leave request rejected.
						if($reason!=NULL)
							$message="Your leave request with leave ID no.=".$leaveid." has been rejected because ".$reason.".";
															//reason specified for rejection.
						else
							$message="Your leave request with leave ID no.=".$leaveid." has been rejected.";
															//no reason specified for rejection.
	
						$result5=pg_query($conn,"select * from leave where (employeeid='".$id."' and leaveid>'".$leaveid."' and nature='".$nature."')");
						while($row5=pg_fetch_row($result5))			//increasing the noleft column(by noofdays for which the rejected leave request was made) in the leave table for the leave requests made by the employee after this particular rejected request. 						
						{
					
							$lid=$row5[0];
							$noleft=$row5[10]+$noofdays;			//row5[10] - noleft
							$result6=pg_query($conn,"update leave set noleft='".$noleft."' where leaveid='".$leaveid."'");
							if(pg_num_rows($resultx)!=0)
							$result7=pg_query($conn,"update leave set noleft='".$noleft."' where leaveid='".$leaveid2."'");
						}
					}
					else if($status=='approvedbyhod')
					{
																	//approved by hod.leave request has to go to director now
						$message="Your leave request with leave leave ID no.=".$leaveid." has been approved by your department HOD. It has been passed on to the Director";
						/*$message2="You have recieved a leave request with leaveID no.=".$leaveid." from the employee with employeeId=".$id." and name=".$name.". The leave has already been approved by the respective HOD. Please login at http://172.27.10.90:10000/ncaorintranet/leaveapp/ to view it and/or approve or reject it.";
																	//message2 - to the director

						$result4=pg_query($conn,"select * from employee where employeeid='41'");
						$row4=pg_fetch_row($result4);
						$to2=$row4[3];								//getting e-mail ID of the director
						$subject='Leave Request';
  						$email='ictd.test@ncaor.org';
						$frome='From:'.$email;
						if(!mail($to2,$subject,$message2,$frome))	//sending-email to the director
  							echo MSG_NO_MAIL."<br/><br/>";*/
					}
		
					/*$subject='Leave Request';
  					$email='ictd.test@ncaor.org';
					$frome='From:'.$email;
					if(!mail($to,$subject,$message,$frome))			//sending e-amil to the employee, wuth the message, $message
  						echo MSG_NO_MAIL;
					echo "<br/><br/>";*/
				}													
       	 	}
    	}	
		else
		{
			echo "<div class='error'>".MSG_MISS_DETAILS."<br/><br/></div>"; 			
		}
	}
	else
	{
		echo "<div class='error'>".MSG_NO_PRV."<br/><br/></div>"; 			//wrong privileges
	}
	echo "<br /><div id='goback'><a href='leaveform.php' target='_parent'>Go back to Leaves</a></div><br/>";	
	echo "<div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/>";	
}
else
{
	echo "<div id='login'>Please login to view this form. <br/>";		//not logged in user.
	echo "<a href='./' target='_parent'>Login</a></div><br/>";
}
	   

?>
</div>
</body>
</html>