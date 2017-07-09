
<html>
<head>
<div align="center">
<img id="line" src="newheader.png" width="100%" height="220" align="left">
</div>
<div align="right">
    <a href="logout.php"><font size="5">Logout</font></a>
</div>
<h2 align="center">Current leaves</h2>
<div align="center">
<a href="leaveexcel.php"><button type="button">Generate Report</button></a>
</div>
<title>General Report</title>
<style ="position: absolute">
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
		margin-left: 350px;
		margin-top: 20px;
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

$from=$_POST['from'];
$to=$_POST['to'];
$dept=$_POST['department'];
$nature=$_POST['nature'];

//connecting to the database
require 'variables.php'; 
 $dbcon= pg_connect(connection_string); 
if (!$dbcon) {
	echo "unable to connect";
}
session_start();
$_SESSION["to"]=$to;
$_SESSION["from"]=$from;
$_SESSION["dept"]=$dept;
$_SESSION["nature"]=$nature;

if($nature=="All")
{
$query="SELECT * FROM leave inner join employee on (employee.employeeid=leave.employeeid)  where fromdate>='$from' and todate<='$to' and (status='approved') order by designation DESC";

	$result=pg_query($query);
}
else
{
	$result1=pg_query("SELECT deptid FROM department where name='$dept'");
	$row=pg_fetch_assoc($result1);
	$deptid=$row['deptid'];
	$_SESSION["deptid"]=$deptid;
	$query="SELECT * FROM leave inner join employee on (employee.employeeid=leave.employeeid)  where fromdate>='$from' and todate<='$to' and (status='approved') and leave.deptid='$deptid' order by designation DESC";
	
	$result=pg_query($query);
}
$row=pg_fetch_all($result);
$num=pg_num_rows($result);
//displaying the tablE
echo "<table >";
echo "<tr><th>Leave ID</th><th>Employee ID</th><th>Name</th><th>Nature of leave</th><th>From date</th><th>To date</th></tr>";
//displaying the rows
for ($i=0; $i <$num ; $i++) 
{ 
echo "<tr>"  ;

echo "<td>".$row[$i]["leaveid"]."</td>";
echo "<td>".$row[$i]["employeeid"]."</td>";
echo "<td>".$row[$i]["name"]."</td>";
echo "<td>".$row[$i]["nature"]."</td>";
echo "<td>".$row[$i]["fromdate"]."</td>";
echo "<td>".$row[$i]["todate"]."</td>";
echo "</tr>";
}
echo "</table>";

?>
</body>
</html>
