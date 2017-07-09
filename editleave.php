<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
<title>IntraNCAOR - Casual Leave Application</title>

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

form
{
	margin:auto;
	position:relative;
	width:350px;
}

input[type="submit"]
{
	position:absolute;
	left:50px;
}

input[type="text"], select, textarea
{
	position:absolute;
	left:70%;
}

#add
{
	position:relative;
	left:0px;
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
#reject
{
	display:none;
}

</style>
<script type="text/javascript" language="javascript">						//Code to Show a text-box if reject is selected
function approve(str){
		if(str=='reject')
		{
			document.getElementById('reject').style.display="block";
		}
		else
		{
			document.getElementById('reject').style.display="none";
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
Casual Leave Application
</p>
<div id="mainpart">
<?php
$leaveid=$_GET['q'];
require 'variables.php';
session_start(); 
if(isset($_SESSION['user1']))							//Checking if user is logged-in or not
{
	if($_GET['q']!=NULL)								//Checking if a valid leave-request was selectted in the previous page.
	{
   		$conn=pg_connect(connection_string);
   		if(!$conn)
			echo "<div class='error'>".MSG_NO_CONN."<br/><br/></div>"; 
   		else
	   	{
		   	if ($_SESSION['priv1']==1||$_SESSION['priv1']==7||$_SESSION['priv1']==8)				//Checking privelages of user. Only priv. 7 & 8 allowed.
		   	{	
			   $resultx=pg_query($conn,"select * from leave where flag='".$leaveid."'");
			   $rowx=pg_fetch_row($resultx);
			   $result=pg_query($conn,"select * from leave where leaveid='".$leaveid."'");
		       $row=pg_fetch_row($result);	
		       if($resultx)
			   {
			   		$to=$rowx[7];
			   }
			   else
			   {
			   		$to=$row[7];
			   }								//Getting data from leave table using leaveid
		       $id=$row[1];													//Employee ID
		       $result1=pg_query($conn,"select * from employee where employeeid = '".$id."'");	
		       $row1 = pg_fetch_row($result1);								//Getting data from employee table using employeeID
		   
		       echo "<form method='post' action='updatecompleted.php'>";
		       echo "Leave ID: ";
	           echo "<input type='text' name='lid' value='".$leaveid."' readonly='readonly' /> <br /><br/>";	   
		       echo "Employee ID: ";
		       echo "<input type='text' name='eid' value='".$row[1]."' readonly='readonly' /> <br /><br />";
		       echo "Employee Name: ";
		       echo "<input type='text' name='ename' value='".$row1[1]."' readonly='readonly' /> <br /><br />";
			   echo "No. of leaves left: ";
	   		   echo "<input type='text' name='noleft' value='".$row[10]."' readonly='readonly' /> <br /><br />";
	   		   echo "Purpose:";
	 	      echo "<textarea id='add' name='purpose' rows='1' cols='50' readonly='readonly'>".$row[2]."</textarea> <br /><br/>";
	 	      echo "Nature: ";
	 	      echo "<input type='text' name='nature' value='".$row[3]."' readonly='readonly' /> <br /><br />";
	 	      echo "No. Of Days: ";
		       echo "<input type='text' name='noofdays' value='".$row[4]."' readonly='readonly' /> <br /><br />";
			   
			   echo "Address During Vacation: <br/>";
		       echo "<textarea id='add' name='address' rows='1' cols='50' readonly='readonly'>".$row[5]."</textarea><br /><br/>";
	       
			   $nature=$row[3];											//Nature
			   $nodays=$row[4];											//No of days

			   if($nature=="CL")										//If nature is CL
			   {
				   echo "From: ";
				   echo "<input type='text' name='from' value='".$row[6]."' readonly='readonly' /> <br /><br />";
		   		   echo "To: ";
				   echo "<input type='text' name='to' value='".$to."' readonly='readonly' /> <br /><br />";
			   }
			   	else if($nodays=="1")									//Nature is RH, No. of days = 1
			   	{
				   echo "Date: ";
				   echo "<input type='text' name='from' value='".$row[6]."' readonly='readonly' /> <br /><br />";
			   }
			   else														//Nature is RH, No. of days = 2
			   {
				   echo "Date1: ";
				   echo "<input type='text' name='from' value='".$row[6]."' readonly='readonly' /> <br /><br />";
			       echo "Date2: ";
				   echo "<input type='text' name='to' value='".$to."' readonly='readonly' /> <br /><br />";
			   }
		   	   echo "Prefix Saturday: ";
		       echo "<input type='text' name='prefixsat' value='".$row[15]."' readonly='readonly' /><br /><br />";
		       echo "Prefix Sunday:";
		       echo "<input type='text' name='prefixsun' value='".$row[16]."' readonly='readonly' /> <br /><br />";
		       echo "Suffix Saturday:";
		       echo "<input type='text' name='suffixsat' value='".$row[17]."' readonly='readonly' /><br /><br />";
		       echo "Suffix Sunday: ";
		       echo "<input type='text' name='suffixsun' value='".$row[18]."' readonly='readonly' /> <br /><br />";
		       echo "LTC Taken: ";
		       echo "<input type='text' name='ltc' value='".$row[19]."' readonly='readonly' /> <br /><br />";
		       echo "Permission to leave Head Quaters from: ";
		       echo "<input type='text' name='hqfrom' value='".$row[20]."' readonly='readonly' /><br /><br />";
		       echo "To: ";
		       echo "<input type='text' name='hqto' value='".$row[21]."' readonly='readonly' /> <br /><br />";
	      	 	$attach = $row[8];										//Checking for attachments
	      	 	if ($attach != NULL)
	       			echo "Attachments: <div id='attach'> <a href='attachments/".$attach."' title='Right Click and Select Save Link As to Download'>".$attach."</a></div><br /><br />";
	   
				
				$status=$row[11];										//Checking the status of request
				$adminstatus=$row[22];
				if ($_SESSION['priv1']==1)								//Priv. 7 - Department HOD's
				{
					echo "Status: ";
					switch ($status)
					{
						case approvedbyhod:
							echo "Leave Already Approved by you.<br /><br />";			//Request alreay approved by HOD
							break;
						case reject:													//Request already rejected
							echo "Leave Already Rejected.<br /><br />";
							break;	
						case cancelled:													//Request already cancelled
							echo "The leave was cancelled by the employee.<br/><br/>";
							break;
						case approved:													//Request alreay approved by director
							echo "Leave Already Approved<br /><br />";
							break;
						default:														//Request not yet approved or rejected by HOD
							echo "<select name='status' onchange='approve(this.value)'>";
							echo "<option value='approvedbyhod'>approved</option><option value='reject'>reject</option></select><br/><br/>";
							echo "<div id='reject'>";
							echo "<label>Reason (optional)</label> <input type='text' name='reject'/><br/><br/></div>";
																								//Text-box for reason of rejection
							echo "<input type='submit' name='submit' value='Update'/>";
					}
				}
				else if ($_SESSION['priv1']==7)								//Priv. 7 - Department HOD's
				{
					switch ($adminstatus)
					{
						case approvedbyhod:
							echo "Leave Already Approved by you.<br /><br />";			//Request alreay approved by HOD
							break;
						case reject:													//Request already rejected
							echo "Leave Already Rejected.<br /><br />";
							break;	
						case cancelled:													//Request already cancelled
							echo "The leave was cancelled by the employee.<br/><br/>";
							break;
						default:
							echo "<input type='hidden' name='status' value='verified'>";
							echo "<input type='submit' name='submit' value='Verified'/>";
					}
				}
				else												//Priv. 8 - Director
				{
					echo "Status: ";
					switch ($status)
					{
						case approved:
							echo "Leave Already Approved.<br /><br />";					//Request already approved by director
							break;
						case reject:
							echo "Leave Already Rejected.<br /><br />";					//Request already rejected
							break;
						case cancelled:
							echo "The leave was cancelled by the employee.<br/><br/>";	//Request cancelled
							break;
						default:													//Request not approved or rejected by director
							echo "<select name='status' onchange='approve(this.value)'>";
							echo "<option value='approvedbyhod'>approved</option><option value='reject'>reject</option></select><br/><br/>";
							echo "<div id='reject'>";
							echo "<label>Reason (optional)</label> <input type='text' name='reject'/><br/><br/></div>";
																								//Text-box for reason of rejection
							echo "<input type='submit' name='submit' value='Update'/>";

					}
				}
				echo "</form>";	
	  		}	
		   else
		   {
				echo "<div class='error'>".MSG_NO_PRV."<br/><br/></div>"; 				//wrong privileges
	   		}  
		}
	}
	else
	{
		echo "<div class='error'>".MSG_MISS_DETAILS."<br/><br/></div>"; 				//validation failed
	}
	echo "<br /<br /><br /><div id='goback'><a href='leaveform.php' target='_parent'>Go back to Leaves</a></div>";
	echo "<div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/>";
}
else
{
	echo "<div id='login'>Please login to view this form.<br/>";						//user not logged in
	echo "<a href='./' target='_parent'>Login</a></div><br/>";
}
?>
</div>
</div>
</body>
</html>