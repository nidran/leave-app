<?php 
 session_start();
if($_SESSION['username']=="")
{
    header("Location: adminlogin.php");
}
//connecting to the database
require 'variables.php'; 
 $dbcon= pg_connect(connection_string); 

if (!$dbcon) 
{
	echo "unable to connect";
}
//query to be executed
$result=pg_query("SELECT username,name,from_time,to_time,ip,date FROM tracking inner join employee on (employee.employeeid=tracking.username)");

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
	for ($i = 0; $i < $columns_total; $i++) 
	{
		$output .='"'.$row["$i"].'",';
	}
	$output .="\n";
}
//downloading the excel file
$f = fopen ('trackexcel.csv','w');
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="trackexcel.csv"');
print "$output";
?>