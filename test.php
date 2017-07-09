<?php
require 'variables.php';
$db=pg_connect("host=".$host." dbname=skdata user=postgres password=ncaor123");
$results=pg_query("select * from user_table");
$rows=pg_fetch_all($results);
$num=pg_num_rows($results);

$dbconn=pg_connect("host=".$host." dbname=roombook user=postgres password=ncaor123");
for($i=0;$i<$num;$i++)
{
    
    $username=$rows[$i]['username'];
    $password=$rows[$i]['password'];
    $privelages=$rows[$i]['privelages'];
    $query="insert into user_table (username,password,privelages) values ('$username','$password','$privelages')";
    echo "<br>";
    $result2=pg_query($dbconn,$query);
    echo $query;

}
?> 