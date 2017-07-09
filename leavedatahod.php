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

#goback
{
	position:absolute;
	left:-150px;
	top:10px;
}
#pdf
{
	margin-left: 46%;
}
#logout
{
	position:absolute;
	right:-50px;
	top:10px;
}
</style>
</head>

<body>
	<div id="header">
   <img id="line" src="newheader.png" width="100%" height="250" align="center">
</div>
    <div id="main"> 
<p id="heading">
Leave Submission
</p>
<?php
session_start();
require 'variables.php';
$maxcl=MAXCL;
$maxrh=MAXRH;

if (isset($_SESSION['user1']))						//checking if user is logged in
{
	if ($_SESSION['priv1']==1)						//checking privileges of user. only Priv 6 (normal user) allowed
	{
		if((($_POST['nature']=="CL"&&$_POST['from1']!=NULL&&$_POST['to1']!=NULL)||($_POST['nature']=="RH"&&$_POST['from2']!=NULL)))
													//validation
		{
			echo "<a href='pdf.php' id='pdf'><button type='button' >Generate PDF</button></a><br>";
			$id = $_POST['empid'];	
			//echo $datetime2;
			//echo $datetime1;	
			$name=$_POST['name'];
			$to1=$_POST['e-mail'];
			$pur= $_POST['purpose'];
			$nature=$_POST['nature'];
			$add=$_POST['address'];
			$dname=$_POST['deptname'];
			$prefixsat=$_POST['prefixsat'];
			$prefixsun=$_POST['prefixsun'];
			$sufixsat=$_POST['sufixsat'];
			$sufixsun=$_POST['sufixsun'];
			$ltc=$_POST['ltc'];
			if($ltc=="YES")
				$ltc=$_POST['ltcyear'];
			$hqfrom=$_POST['hqfrom'];
			$hqto=$_POST['hqto'];
			$from=$_POST['from1'];
			$to=$_POST['to1'];
			$_SESSION['from']=$from;
			$_SESSION['to']=$to;
			$_SESSION['name']=$name;
			$_SESSION['dname']=$dname;
			
			if($_POST['nature']=='RH')
			{
				$to=$_POST['to2'];
				$from=$_POST['from2'];
			}
			$year1=date('Y');
			$year2=date('Y');
					if($year1==$year2)
						$year=$year1;
					else
					{
						$tox=date('12/31/Y', strtotime($from));
						$fromx=date('1/1/Y', strtotime($to));
						$temp=$tox;
						$tox=$to;
						$to=$temp;
						$year=$year1;
					}

			if ($_FILES["file"]["size"] != 0)							//Code for file attachment, chekcing if a file is attached
			{
				if ($_FILES["file"]["size"] < 20000000)					//Checking file size < 20 MB
  				{
 					if ($_FILES["file"]["error"] > 0)					//Checking for errors in uploading file
    				{
					    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    				}
  					else
    				{
						$upload=$_FILES["file"]["name"];				
						echo "The file you uploaded was ".$upload.". <br/>";
		  				while(file_exists("attachments/" . $upload))	//Checking if a file exists in attachments folder with the same name. If yes, the file name is appended with a (1)
						{
							$uploaded=explode (".",$upload);
							$length=count($uploaded);
							$uploaded[$length-2]=$uploaded[$length-2]."(1)";
		       		 	    $upload=implode(".",$uploaded);
			   		 	}
		  				move_uploaded_file($_FILES["file"]["tmp_name"],"attachments/" . $upload);	//Moving uploaded file to attachments folder
    				}
  				}
				else
		  		{
		  			echo MSG_LRG_FILE."<br/>";						//File size >20MB
		  		}
			}
			$conn=pg_connect(connection_string);
			$query3="select designation from  employee where employeeid='$id'";
			$result3=pg_query($query3);
			$dsg=pg_fetch_assoc($result3);
			$_SESSION['dsg']=$dsg['designation'];

			if(!$conn)
				echo "<div class='error'>".MSG_NO_CONN."<br/><br/></div>";
			else
			{
				$datetime1=new DateTime($from);
				$datetime2=new DateTime($to);
				$interval = $datetime1->diff($datetime2);
				$_POST['nodays1']= $interval->format('%a')+1;
 				//%R for sign
				if($nature=="CL")									//If nature of leave is CL, total holidays = 8
				{
					$total=$maxcl;
					$noofdays=$_POST['nodays1'];
				}
				elseif($_POST['nodays2']==1)						//If nature of leave is RH, total holidays = 2
				{													//no of days=1
					$total=$maxrh;
					$noofdays=$_POST['nodays2'];
				}
				else
				{													//no of days=2
					$total=$maxrh;
					$noofdays=$_POST['nodays2'];
				}
				$query="select * from leave where (employeeid='".$id."' and status='approved') and (year='$year' and nature='".$nature."')";												//getting leave requests made previously by the same employeewhich were not rejected or cancelled
				$result2=pg_query($query);
				if(pg_num_rows($result2)==0)						//no leave taken till yet
				{
					$noleft=$total;
				}
				else
				{
					$row2=pg_fetch_row($result2,pg_num_rows($result2)-1);		//getting last leave before the present one
					$noleftb=$row2[10];								//getting noleft in last leave before the present one
					$nodaysb=$row2[4];								//getting nodays in last leave before the present one
					$noleft=$noleftb-$nodaysb;						//getting noleft for the present request
				}
				if($noleft==0)										//no of leaves left = 0
				{
					echo "You have exceeded your total allowed leaves for ".$nature.". Hence, your leave request could not be forwarded.";
				}
				else if($noofdays>$noleft)							//no of leaves left < no of days requested	
				{	
					echo "You cannot apply for so many leaves. You only have ".$noleft." leaves left for ".$nature.".";
				}
				else if($noleft>=$noofdays)							//no of leaves left >= no of days requested
				{
					$nolefta=$noleft-$noofdays;						//no. of leaves left after applying for this leave
    				$result1=pg_query($conn,"select * from department where name='".$dname."'");
					$row1=pg_fetch_row($result1);					//getting department ID and HOD ID using dept. name
					$did=$row1[0];									//dept id
					$dhod=$row1[3];									//HOD id
										$to2="";										//variable to store e-mail ID of the person to whon the requsest is passed
					if ($id=='5')					//if request is made by a HOD or someone in the dept. "Director", request forwarded to director
					{
						
						$query="insert into leave (employeeid,purpose,nature,noday,add,fromdate,todate,attachments,deptid,
							noleft,status,currently,year,prefixsat,prefixsun,suffixsat,suffixsun,ltc,hqfrom,hqto,flag,adminstatus) values ('$id','$pur','$nature','$noofdays','$add'
							,'$from','$to','$upload','$did','$noleft','approved','director','$year','$prefixsat','$prefixsun','$sufixsat','$sufixsun',
							'$ltc','$hqfrom','$hqto','NULL','NULL')";
						$result12=pg_query($conn,"select * from employee where employeeid='41'");
						$row12=pg_fetch_row($result12);
						$to2=$row12[3];								//e-mail ID of director
				
					}
					else											//if request is made by a normal employee, request forwarded to department HOD
					{
						
						$query="insert into leave (employeeid,purpose,nature,noday,add,fromdate,todate,attachments,deptid,
							noleft,status,currently,year,prefixsat,prefixsun,suffixsat,suffixsun,ltc,hqfrom,hqto,flag,adminstatus) values ('$id','$pur','$nature','$noofdays','$add',
							'$from','$to','$upload','$did','$noleft','approvedbyhod','$dhod','$year','$prefixsat','$prefixsun','$sufixsat','$sufixsun',
							'$ltc','$hqfrom','$hqto','NULL','NULL')";
						$result13=pg_query($conn,"select * from employee where employeeid='".$dhod."'");
						$row13=pg_fetch_row($result13);
						$to2=$row13[3];								//e-mail ID of HOD
				

					}
					$result=pg_query($conn,$query) ;
					echo "Your leave form has been forwarded. <br/> You will also recieve a mail confirming your leave request.<br/>";
					$result10=pg_query($conn,"select * from leave where employeeid='".$id."'");		//getting leave requests made by user
					$row10=pg_fetch_row($result10,pg_num_rows($result10)-1);						//getting leave ID of leave request just submitted by user
					$lid=$row10[0];
					
					echo "Your Leave ID is ".$lid.". ";
					echo "You now have ".$nolefta." leaves left. <br/>";
		

				$message="Your leave request with leave ID no.=".$lid." has been passed on to  HOD/Director. You will be posted on the status of your request or you can check the status on the Intranet site with the leave ID given.";
					$message2="You have recieved a leave request with leaveID no.=".$lid." from the employee with employeeId=".$id." and name=".$name.". Please login at http://172.27.10.90:10000/ncaorintranet/leaveapp/ to view it and/or approve or reject it.";
		
		
					/*$subject='Leave Request';
  					$email='ictd.test@ncaor.org';
					$frome='From:'.$email;
					if(!mail($to1,$subject,$message,$frome))					//mailing to employee
					{
  						echo MSG_NO_MAIL;
						echo "<br/><br/>";
					}
					if(!mail($to2,$subject,$message2,$frome))					//mailing to the person who recieved the leave request
					{
  						echo MSG_NO_MAIL;		
						echo "<br/><br/>";
					}*/
					session_start();
					$_SESSION['leaveid']=$lid;
				}









				if(($year1!=$year2)&&($result))//putting two seperate entries in database for intervals involving change of year.
				{
				$datetime1=new DateTime($fromx);
				$datetime2=new DateTime($tox);	
				$year=$year2;
				$interval = $datetime1->diff($datetime2);
				$_POST['nodays1']= $interval->format('%a')+1;
 				//%R for sign
				if($nature=="CL")									//If nature of leave is CL, total holidays = 8
				{
					$total=$maxcl;
					$noofdays=$_POST['nodays1'];
					$from=$fromx;
					$to=$tox;
				}
				elseif($_POST['nodays2']==1)						//If nature of leave is RH, total holidays = 2
				{													//no of days=1
					$total=$maxrh;
					$noofdays=$_POST['nodays2'];
					$from=$fromx;
				}
				else
				{													//no of days=2
					$total=$maxrh;
					$noofdays=$_POST['nodays2'];
					$from=$fromx;
					$to=$tox;
				}
				$result2=pg_query($conn,"select * from leave where employeeid='".$id."' and (status<>'cancelled' and status<>'reject') and year='$year' and nature='".$nature."'");												//getting leave requests made previously by the same employeewhich were not rejected or cancelled
			
				if(pg_num_rows($result2)==0)						//no leave taken till yet
				{
					$noleft=$total;
				}
				else
				{
					$row2=pg_fetch_row($result2,pg_num_rows($result2)-1);		//getting last leave before the present one
					$noleftb=$row2[10];								//getting noleft in last leave before the present one
					$nodaysb=$row2[4];								//getting nodays in last leave before the present one
					$noleft=$noleftb-$nodaysb;						//getting noleft for the present request
				}
				if($noleft==0)										//no of leaves left = 0
				{
					echo "You have exceeded your total allowed leaves for ".$nature.". Hence, your leave request could not be forwarded.";
				}
				else if($noofdays>$noleft)							//no of leaves left < no of days requested	
				{	
					echo "You cannot apply for so many leaves. You only have ".$noleft." leaves left for ".$nature.".";
				}
				else if($noleft>=$noofdays)							//no of leaves left >= no of days requested
				{
					$nolefta=$noleft-$nodays;						//no. of leaves left after applying for this leave
    				$result1=pg_query($conn,"select * from department where name='".$dname."'");
					$row1=pg_fetch_row($result1);					//getting department ID and HOD ID using dept. name
					$did=$row1[0];									//dept id
					$dhod=$row1[3];									//HOD id
										$to2="";										//variable to store e-mail ID of the person to whon the requsest is passed
					if ($dhod==$id||$dhod=="41")					//if request is made by a HOD or someone in the dept. "Director", request forwarded to director
					{
						
						$query="insert into leave (employeeid,purpose,nature,noday,add,fromdate,todate,attachments,deptid,
							noleft,status,currently,year,prefixsat,prefixsun,suffixsat,suffixsun,ltc,hqfrom,hqto,flag) values ('$id','$pur','$nature','$noofdays','$add'
							,'$from','$to','$upload','$did','$noleft','OPEN','director','$year','$prefixsat','$prefixsun','$sufixsat','$sufixsun',
							'$ltc','$hqfrom','$hqto','$lid')";
						$result12=pg_query($conn,"select * from employee where employeeid='41'");
						$row12=pg_fetch_row($result12);
						$to2=$row12[3];								//e-mail ID of director
				
					}
					else											//if request is made by a normal employee, request forwarded to department HOD
					{
						
						$query="insert into leave (employeeid,purpose,nature,noday,add,fromdate,todate,attachments,deptid,
							noleft,status,currently,year,prefixsat,prefixsun,suffixsat,suffixsun,ltc,hqfrom,hqto,flag) values ('$id','$pur','$nature','$noofdays','$add',
							'$from','$to','$upload','$did','$noleft','open','$dhod','$year','$prefixsat','$prefixsun','$sufixsat','$sufixsun',
							'$ltc','$hqfrom','$hqto','$lid')";
						$result13=pg_query($conn,"select * from employee where employeeid='".$dhod."'");
						$row13=pg_fetch_row($result13);
						$to2=$row13[3];								//e-mail ID of HOD
				

					}
					$result=pg_query($conn,$query) ;
					$result10=pg_query($conn,"select * from leave where employeeid='".$id."'");		//getting leave requests made by user
					$row10=pg_fetch_row($result10,pg_num_rows($result10)-1);						//getting leave ID of leave request just submitted by user
					$lid=$row10[0];
					
					echo "For year ".$year.",";
					echo "You now have ".$nolefta." leaves left. <br/>";
				}
				//mark!!!!!!!!!!
				}
			}
		}
		
		else
		{
			echo "<div class='error'>".MSG_MISS_DETAILS."<br/><br/></div>";		//validation failed
		}
	}
	else
	{
		echo "<div class='error'>".MSG_MORE_PREVS."<br/><br/></div>";			//wrong privileges
	}
	echo "<div id='goback'><a href='leaveform.php' target='_parent'>Go back to Leave Form</a></div><br/>";
	echo "<div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/>";
			
}
else
{
	echo " <div id='login'>Please login to view this page.<br/><a href='./' target='_parent'>Login</a></div><br/>";
}

?>

</body>
</html>