<html>
<body>
<form method="POST" action="report.php">
<img id="line" src="newheader.png" width="100%" height="250" align="left">
<div align="left"><br>
<a href="ictd.php">Back</a><br>
</div>
</form>
<?php
$username_login =$_POST['username'];
$password_login=$_POST['password'];
require 'variables.php'; 
$connect = pg_connect(connection_string); 
session_start();
$_SESSION['username'] = $username_login;
//checking if user is admin 
$query = "SELECT username FROM user_table WHERE username='ictd'";

$result = pg_query($query);

for ($row = 0; $row < pg_numrows($result); $row++) 
{  
	 $username = pg_fetch_result($result, $row,'username'); 
}	
//verifying user password
$query2 = "SELECT password FROM user_table WHERE username='ictd'";
//$result2 = pg_exec($connect, $query2);  
$result2 = pg_query($query2);
 for ($row1 = 0; $row1 < pg_numrows($result2); $row1++) 
{  
	 $password = pg_fetch_result($result2, $row1, 'password'); 
} 
  


 if ($username_login==$username && $password_login==$password)
    {  //if user is valid admin
        header("Location: tracking.php");

    }
        else 
    {
         echo " wrong password or username.Please try again"; 
    }
       


 ?>

</form>
</body>
</html>












 