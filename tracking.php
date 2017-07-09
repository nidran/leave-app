<?php 
session_start();
if($_SESSION['username']=="")
{
    header("Location: ictd.php");
}
?>
<html>
<head>
<div align="center">
	<img id="line" src="newheader.png" width="100%" height="250" align="left">
	<div align="right">
    <a href="logout.php"><font size="5">Logout</font></a>
</div>
	<h2 align="center">Track bookings </h2>
</div>
<div align="center">
<a href="trackexcel.php"><button type="button">Generate excelsheet</button></a><br><br>
</div>
	<title>General Report</title>
	<style>
		/*stlying of the body*/
		body{
			margin-left: 100px;
			margin-right: 100px;
		}
		/*styling the header image of the form on top of the page*/
		img
		{
			border-bottom: solid;
    		margin-left: 0px;
    		border-color:#006699;   
    		color: #006699;
    		margin-right: 0px;
    		text-align: center;
    		margin-bottom: 30px;
		}
		/*styling the tabel*/
		table,th,td
		{
			border: solid;
			border-collapse: collapse;
			margin-left: 300px;
		}
		/*styling the rows and coloumns*/
		td,th{
			text-align: center;
			padding-top: 15px;
			
		}
		/*styling the generate excel sheet button*/
		form{
			margin-left: 1050px;
			margin-top: -80px;
			
		}
	</style>
</head>
<body>

<?php 
//connecting to the database
require 'variables.php'; 
 $dbcon= pg_connect(connection_string); 
if (!$dbcon) 
{
	echo "unable to connect";
}
//selecting from the database
$result=pg_query("SELECT * FROM tracking inner join employee on (employee.employeeid=tracking.username)");
$row=pg_fetch_all($result);
$num=pg_num_rows($result);
//displaying the table
echo "<table>";
 echo "<tr><th>Username</th><th>Name</th><th>Start time</th><th>End time</th><th>IP Address</th><th>Date</th></tr>";
//displaying the rows
for ($i=0; $i <$num ; $i++) 
{ 	//$x=$row[$i]["reqid"];
	echo "<tr>"  ;
	echo "<td>".$row[$i]["username"]."</td>";
	echo "<td>".$row[$i]["name"]."</td>";
	echo "<td>".$row[$i]["from_time"]."</td>";
	echo "<td>".$row[$i]["to_time"]."</td>";
	echo "<td>".$row[$i]["ip"]."</td>";
	echo "<td>".$row[$i]["date"]."</td>";
	echo "</tr>";
}
echo "</table>";
?>
</body>
</html>
