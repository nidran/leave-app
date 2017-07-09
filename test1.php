<?php
require 'variables.php';
$db=pg_connect("host=".$host." dbname=leave user=postgres password=ncaor123");
$results=pg_query("select * from employee");
$rows=pg_fetch_all($results);
$num=pg_num_rows($results);

$dbconn=pg_connect("host=".$host." dbname=ncaor-leave user=postgres password=ncaor123");
for($i=0;$i<$num;$i++)
{
    
    $employeeid=$rows[$i]['employeeid'];
    $name=$rows[$i]['name'];
    $designation=$rows[$i]['designation'];
    $email=$rows[$i]['email'];
    $mobileno=$rows[$i]['mobileno'];
    $deskno=$rows[$i]['deskno'];
    $dob=$rows[$i]['dob'];
    $joindate=$rows[$i]['joindate'];
    $presentadd=$rows[$i]['presentadd'];
    $qualification=$rows[$i]['qualification'];
    $deptid=$rows[$i]['deptid'];
    $query="insert into employee (employeeid,name,designation,email,mobileno,deskno,dob,joindate,presentadd,qualification,deptid) 
    values ('$employeeid','$name','$designation','$email','$mobileno','$deskno','$dob','$joindate','$presentadd','$qualification','$deptid')";
    echo "<br>";
    $result2=pg_query($dbconn,$query);
    echo $query;

}
?> 