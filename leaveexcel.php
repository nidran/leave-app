<?php 
 session_start();
 $from=$_SESSION['from'];
$to=$_SESSION['to'];
$dept=$_SESSION["dept"];
$nature=$_SESSION["nature"];
$deptid=$_SESSION["deptid"];
//connecting to the database
 require 'variables.php'; 
 $dbcon= pg_connect(connection_string); 

if (!$dbcon) 
{
	echo "unable to connect";
}
//query to be executed
if($nature=="All")
{
$query="SELECT leaveid,name,nature,fromdate,todate FROM leave inner join employee on (employee.employeeid=leave.employeeid)  where fromdate>='$from' and todate<='$to' and (status='approved') order by designation DESC";

	$result=pg_query($query);
}
else
{
	$query="SELECT leaveid,name,nature,fromdate,todate FROM leave inner join employee on (employee.employeeid=leave.employeeid)  where fromdate>='$from' and todate<='$to' and (status='approved') and leave.deptid='$deptid' order by designation DESC";

	$result=pg_query($query);
}

    //selecting and printing table-rows in excel sheet
	$columns_total = pg_num_fields($result);

for ($i = 0; $i < $columns_total; $i++) 
{
	$heading = pg_field_name($result, $i);
	$output .= '"'.$heading.'",';
}
	$output .="\n";

// Get Records from the table

while ($row = pg_fetch_array($result)) 
{    
	for ($i = 0; $i < $columns_total; $i++) {
	$output .='"'.$row["$i"].'",';
}
	$output .="\n";
}
//downloading the excel file
$f = fopen ('leaveexcel.csv','w');
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="leaveexcel.csv"');
print "$output";
session_destroy();
?>