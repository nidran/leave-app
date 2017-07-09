
<html>
<body>
<div align="left"><br>
<a href="booking.php">Back</a><br>
</div>
<?php
$username_login =$_POST['username'];
$password_login =$_POST['password'];
require 'variables.php'; 
$connect = pg_connect(connection_string); 
session_start();
$_SESSION['username'] = $username_login;
//verifying username
$query = "SELECT username FROM user_table WHERE username='$username_login'";
$result = pg_query($query);
for ($row = 0; $row < pg_numrows($result); $row++) 
{  
	 $username = pg_fetch_result($result, $row,'username'); 
	 
}
//verifying password  
$query2 = "SELECT password FROM user_table WHERE username='$username_login'"; 
$result2 = pg_query($query2);
 for ($row1 = 0; $row1 < pg_numrows($result2); $row1++) 
{  
	 $password = pg_fetch_result($result2, $row1, 'password'); 
}

 if ($username_login==$username && $password_login==$password)
    {  //if valid user then redirects
        header("Location: cancel_book.php");

    }
        else 
    {
         echo " wrong password or username.Please try again"; 
    }
       


 ?>
</body>
</html>












 