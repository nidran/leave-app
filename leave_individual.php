<html>
<head>
	<script type="text/javascript" src="tcal.js"></script>
	<link rel="stylesheet"  href="tcal.css">
<title>IntraNCAOR - Leave Applications</title>
<style>
#report
{
	margin-left: 25%;
}
th,td
{
   
   margin:0;
   width: 10%;
   table-layout: fixed;
   text-align: center;
   border-collapse: collapse;
   outline: 1px solid black;
}
#viewnext
{
	position:absolute;
  top:33%;
  right:0px;
}
table
{
   margin-left: 0%;
   }
   #display
   {
   	width:40%;
   }
   #logout
{
  position:absolute;
  top:30%;
  right:0px;
}
   </style>
</head>
<body>
<div id="header">
   <img id="line" src="newheader1.png" width="100%" height="250" align="center">
</div>
    	
    <div id="main">
	<h1 align="center">Leave</h1>
	</div>
	
	<div id="report">

<?php
session_start();
require 'variables.php';
$maxcl=MAXCL;
$maxrh=MAXRH;

if($_SESSION['priv1']=='4')
{
$maxcl=TMAXCL;
$maxrh=TMAXRH;
} 
$conn=pg_connect(connection_string);
$empid= $_POST['empid'];
$resultcl=pg_query($conn,"select * from leave where employeeid='".$empid."' and (status='approved') and nature='CL'");
$result=pg_query($query);
$row=pg_fetch_assoc($result);	
			/*Getting the number of Cl leaves left.*/
if(pg_num_rows($resultcl)==0)
	$numcl=$maxcl;
else
{
	$rowcl=pg_fetch_row($resultcl,pg_num_rows($resultcl)-1);
	$numcl=$rowcl[10]-$rowcl[4];
}
$resultrh=pg_query($conn,"select * from leave where (employeeid='".$empid."' and status='approved') and nature='RH'");
			/*Getting the number of RH leaves left.*/
if(pg_num_rows($resultrh)==0)
	$numrh=$maxrh;
else
{
	$rowrh=pg_fetch_row($resultrh,pg_num_rows($resultrh)-1);
	$numrh=$rowrh[10]-$rowrh[4];
}
echo "<h3>Balance Leave Details:</h3>
    <table>
    <tr>
    <td>CL</td>
    <td>$numcl</td>
    </tr>
    <tr>
    <td>RH</td>
    <td>$numrh</td>
    </tr>
    </table>
    <h3>Availed Leaves Dates:</h3>";
    
    $x=pg_num_rows($resultcl);
    $y=pg_num_rows($resultrh);
    $rowx=pg_fetch_all($resultcl);
    $rowy=pg_fetch_all($resultrh);

    echo "<table id='display'><tr><td><h3>CL</h3></td><td><h3>RH</h3></td></tr><tr><td>";
    for($i=0;$i<$x;$i++)
    {
    	echo $rowx[$i]['fromdate']."-".$rowx[$i]['todate']."<br>";
    }
    echo "</td><td>";
    for($i=0;$i<$y;$i++)
    {
    	echo $rowy[$i]['fromdate']."<br>";
    }
    echo "</td></tr></table>
    <div id='logout'><a href='logout.php' target='_parent'>Logout</a></div>
    <div id='viewnext'><a href='individual_form.php'>View_Next</a></div>";

                              
?>
</div>
</body>
</html>