<html>
<head>
	<script type="text/javascript" src="tcal.js"></script>
	<link rel="stylesheet"  href="tcal.css">
<title>IntraNCAOR - Leave Applications</title>
  
<script type="text/javascript">
    function changeform(str)                                //function which invokes the required no. of interval enteries
    {
       		if(str=='0')
            {
                document.getElementById('other1').style.display="none";
                document.getElementById('other2').style.display="none";
                document.getElementById('other3').style.display="none";
                document.getElementById('other4').style.display="none";
                document.getElementById('other5').style.display="none";
                document.getElementById('other6').style.display="none";
                document.getElementById('other7').style.display="none";
                document.getElementById('other8').style.display="none";
            }
           else if(str=='1')
            {
                document.getElementById('other1').style.display="block";
                document.getElementById('other2').style.display="none";
                document.getElementById('other3').style.display="none";
                document.getElementById('other4').style.display="none";
                document.getElementById('other5').style.display="none";
                document.getElementById('other6').style.display="none";
                document.getElementById('other7').style.display="none";
                document.getElementById('other8').style.display="none";
            }
            else if(str=='2')
            {
                 document.getElementById('other1').style.display="block";
                document.getElementById('other2').style.display="block";
                document.getElementById('other3').style.display="none";
                document.getElementById('other4').style.display="none";
                document.getElementById('other5').style.display="none";
                document.getElementById('other6').style.display="none";
                document.getElementById('other7').style.display="none";
                document.getElementById('other8').style.display="none";
            }
             else if(str=='3')
            {
                 document.getElementById('other1').style.display="block";
                document.getElementById('other2').style.display="block";
                document.getElementById('other3').style.display="block";
                document.getElementById('other4').style.display="none";
                document.getElementById('other5').style.display="none";
                document.getElementById('other6').style.display="none";
                document.getElementById('other7').style.display="none";
                document.getElementById('other8').style.display="none";
            }
            else if(str=='4')
            {
                 document.getElementById('other1').style.display="block";
                document.getElementById('other2').style.display="block";
                document.getElementById('other3').style.display="block";
                document.getElementById('other4').style.display="block";
                document.getElementById('other5').style.display="none";
                document.getElementById('other6').style.display="none";
                document.getElementById('other7').style.display="none";
                document.getElementById('other8').style.display="none";
            }
            else if(str=='5')
            {
                 document.getElementById('other1').style.display="block";
                document.getElementById('other2').style.display="block";
                document.getElementById('other3').style.display="block";
                document.getElementById('other4').style.display="block";
                document.getElementById('other5').style.display="block";
                document.getElementById('other6').style.display="none";
                document.getElementById('other7').style.display="none";
                document.getElementById('other8').style.display="none";
            }
            else if(str=='6')
            {
                 document.getElementById('other1').style.display="block";
                document.getElementById('other2').style.display="block";
                document.getElementById('other3').style.display="block";
                document.getElementById('other4').style.display="block";
                document.getElementById('other5').style.display="block";
                document.getElementById('other6').style.display="block";
                document.getElementById('other7').style.display="none";
                document.getElementById('other8').style.display="none";
            }
            else if(str=='7')
            {
                 document.getElementById('other1').style.display="block";
                document.getElementById('other2').style.display="block";
                document.getElementById('other3').style.display="block";
                document.getElementById('other4').style.display="block";
                document.getElementById('other5').style.display="block";
                document.getElementById('other6').style.display="block";
                document.getElementById('other7').style.display="block";
                document.getElementById('other8').style.display="none";
            }
            else if(str=='8')
            {
                 document.getElementById('other1').style.display="block";
                document.getElementById('other2').style.display="block";
                document.getElementById('other3').style.display="block";
                document.getElementById('other4').style.display="block";
                document.getElementById('other5').style.display="block";
                document.getElementById('other6').style.display="block";
                document.getElementById('other7').style.display="block";
                document.getElementById('other8').style.display="block";
            }
    }
    function checkday(str)                              //shows second text-box in RH, when no of days=2
    {
        if(str=='0')
        {
            document.getElementById('newday1').style.display="none";
            document.getElementById('newday').style.display="none";
        }
        if(str=='1')
        {
            document.getElementById('newday1').style.display="block";
            document.getElementById('newday').style.display="none";
        }
        if(str=='2')
        {
            document.getElementById('newday1').style.display="block";
            document.getElementById('newday').style.display="block";
        }
    }
</script>
<style>
body
{
	width:80%;
	margin-left: 10%;
	border: solid;
}
form
{
	position:relative;
	margin-left: 28%;

}

#heading
{
	font-size:30px;
	text-align:center;
}
label{
   width: 44%;
   float: left; 
    
}
#login
{
	text-align:center;
}

#logout
{
	position:absolute;
	top:10px;
	right:0px;
}
#button
{
	margin-left:28%;
}


</style>
</head>
<body>
<div id="header">
   <img id="line" src="newheader1.png" width="100%" height="250" align="center">
</div>
    
    <div id="main">
	<p id='heading'>Leave</p>
	</div>
<?php
session_start();
require 'variables.php'; 
$conn=pg_connect(connection_string);
$empid= $_POST['empid'];
$query="select * from employee where employeeid='$empid'";
$result=pg_query($query);
$row=pg_fetch_assoc($result);
$designation=$row['designation'];
$name=$row['name'];
$deptid=$row['deptid'];
$resultcl=pg_query($conn,"select * from leave where employeeid='".$empid."' and (status<>'cancelled' and status<>'reject') and nature='CL'");
$query="select * from department where deptid='$deptid'";
$result=pg_query($query);
$row=pg_fetch_assoc($result);
$deptname=$row['name'];			
			/*Getting the number of Cl leaves left.*/
			if(pg_num_rows($resultcl)==0)
            {
				$numcl=MAXCL;
                if($_SESSION['priv1']=='4')
                    $numcl=TMAXCL;
            }
			else
			{
				$rowcl=pg_fetch_row($resultcl,pg_num_rows($resultcl)-1);
				$numcl=$rowcl[10]-$rowcl[4];
			}
$resultrh=pg_query($conn,"select * from leave where employeeid='".$empid."' and (status<>'cancelled' and status<>'reject') and nature='RH'");
			/*Getting the number of RH leaves left.*/
			if(pg_num_rows($resultrh)==0)
            {
				$numrh=MAXRH;
                if($_SESSION['priv1']=='4')
                    $numcl=TMAXRH;
            }
			else
			{
				$rowrh=pg_fetch_row($resultrh,pg_num_rows($resultrh)-1);
				$numrh=$rowrh[10]-$rowrh[4];
			}
echo "							
		     					<form name='form1' method='post' action='' enctype='multipart/form-data'>
		     								 	<label for='name'>Employee Name: </label>
                                <input type='text' name='name' value='$name' readonly='readonly'     />
                                <br /> <br />
		     								 	<label for='empid'>Employee ID: </label>
                                <input type='hidden' name='empid' value='$empid' readonly='readonly'     />
                                <br /> <br />

                                
                                <label for='designation'>Designation:</label>
                                <input type='text' name='design' value='$designation' readonly='readonly' />
                                <br /> <br />

                                <label for='deptname'>Department Name:</label>
                                <input type='text' name='deptname' id='deptname' value='$deptname' readonly='readonly' />
                                <br /> <br />
                                <label for='deptid'>Department ID: </label>
                                <input type='hidden' name='deptid' value='$deptid' readonly='readonly'     />
                                <br /> <br />


                                <label for='leftcl'>Balance available CL Leaves:</label>
                                <input type='text' name='leftcl' id='leftcl' value='$numcl' readonly='readonly'/>
                                <br /> <br />

                                <label for='leftrh'>Balance available RH Leaves:</label>
                                <input type='text' name='leftrh' id='leftrh' value='$numrh' readonly='readonly'/>
                                <br /> <br />
                                
                                <label for='clnum'>Availed CL details from Jan to Jun:</label><br><br>
                                <label for='clnum'>Number of CL availed:</label>
                                <input type='text' name='clnum' id='clnum'/><br>";  
                                
require 'reader.php';           //importing excel sheet with RH holidays list
            $data = new Spreadsheet_Excel_Reader(); 
            $data->read('rh_list.xls'); 
            ?>
<label >Number of slots required:</label><!--select option for no. of entries-->
<select id="types" name="types" onchange="changeform(this.value)" >
 <option value="0">0</option>    
 <option value="1">1</option>     
 <option value="2">2</option>     
 <option value="3">3</option>
 <option value="4">4</option>     
 <option value="5">5</option>
 <option value="6">6</option>     
 <option value="7">7</option>
 <option value="8" selected>8</option>     
</select> <br><br>
    <div id="other1">  
        From
        <input id='from1'  name='from1' class='tcal' />
        To
        <input  id='to1' name='to1' class='tcal'/>
    </div> 
    <div id="other2">  
        From
        <input id='from2'  name='from2' class='tcal' />
        To
        <input  id='to2' name='to2' class='tcal'/>
    </div>
    <div id="other3">  
        From
        <input id='from3'  name='from3' class='tcal' />
        To
        <input  id='to3' name='to3' class='tcal'/>
    </div>
    <div id="other4">  
        From
        <input id='from4'  name='from4' class='tcal' />
        To
        <input  id='to4' name='to4' class='tcal'/>
    </div>
    <div id="other5">  
        From
        <input id='from5'  name='from5' class='tcal' />
        To
        <input  id='to5' name='to5' class='tcal'/>
    </div>
    <div id="other6">  
        From
        <input id='from6'  name='from6' class='tcal' />
        To
        <input  id='to6' name='to6' class='tcal'/>
    </div>
    <div id="other7">  
        From
        <input id='from7'  name='from7' class='tcal' />
        To
        <input  id='to7' name='to7' class='tcal'/>
    </div>
    <div id="other8">  
        From
        <input id='from8'  name='from8' class='tcal' />
        To
        <input  id='to8' name='to8' class='tcal'/>
    </div>
   <br>
    <label for='nodays2'>Number of RH Availed:</label>
    <select id='nodays2' name='nodays2'  onchange='checkday(this.value)'>
    <option value='0' >0</option>
        <option value='1' >1</option>
        <option value='2'selected>2</option>
    </select><br/><br/>
    <div id="newday1">
    <select name='from4'>
     <label for='from4'>Number of RH availed:</label>
    <?php    
    for($i=1; $i<=$data->sheets[0]['numRows'];$i++)
                    //traversing each row checking till an empty row is encountered
    {
        $currdate=time(); //getting current time
        $otherdate=$data->sheets[0]['cells'][$i][1];
        $dayname=$data->sheets[0]['cells'][$i][2];  //getting value of first column in each row and converting it to time
                             //comparing otherdate with currenttime
        echo "<option value='$otherdate'>$otherdate-$dayname</option>";    //showing otherdate as option
    }
    echo "</select></div>
        <br /><br />
        <div id='newday'>
        <select id='to4' name='to4'>";
    for($i=1; $i<=$data->sheets[0]['numRows'];$i++)
    {
        $currdate=time(); //getting current time
        $otherdate=$data->sheets[0]['cells'][$i][1];
        $dayname=$data->sheets[0]['cells'][$i][2];  //getting value of first column in each row and converting it to time
                             //comparing otherdate with currenttime
        echo "<option value='$otherdate'>$otherdate-$dayname</option>";    //showing otherdate as option
    }
    echo "</select>
        <br /><br />
        </div>
    </div>    
    </div>";
 echo "<input type='submit' id='button' name='Submit' value='submit'>
                                </form>";

if ($_POST['Submit'] == "submit") 
{
	//print_r($_POST);
	$leftcl=$_POST['leftcl'];
	$leftrh=$_POST['leftrh'];
	$clnum=$_POST['clnum'];
	$num=$_POST['types'];
	$empid=$_POST['empid'];
	$nodays2=$_POST['nodays2'];
	$deptid=$_POST['deptid'];						//no. of leaves left after applying for this leave
	$result1=pg_query($conn,"select * from department where deptid='$deptid'");
	$row1=pg_fetch_row($result1);					//getting department ID and HOD ID using dept. name
	//$did=$row1[0];									//dept id
	$dhod=$row1[3];
	$noleft1=$leftrh-$nodays2;
	$clcount=0;
	$diff=array();
	for($i=1;$i<$num+1;$i++)
	{
		$datetime1=new DateTime($_POST['from'.$i]);
		$datetime2=new DateTime($_POST['to'.$i]);	
		$interval = $datetime1->diff($datetime2);
		$diff[$i]= $interval->format('%a')+1;
		$clcount+=$diff[$i];
	}
	$year=date(Y);
				//HOD id
if(($nodays2>$leftrh)||($clcount>$clnum))
{
	echo "You have exceeded no. of available days!!";
}
else
{
	if($nodays2>0)
	{
		$from=$_POST['from4'];
		$to=$_POST['to4'];
		if($nodays2==1)
		{
		$query="insert into leave (employeeid,nature,noday,fromdate,deptid,
			noleft,status,currently,year) values ('$empid','RH','$nodays2',
			'$from','$deptid','$leftrh','open','$dhod','$year')";
		}
		else
		{
		$query="insert into leave (employeeid,nature,noday,fromdate,todate,deptid,
			noleft,status,currently,year) values ('$empid','RH','$nodays2',
			'$from','$to','$deptid','$leftrh','open','$dhod','$year')";
		}							//e-mail ID of HOD
		$result=pg_query($conn,$query) ;
	}
	$noleft2=$leftcl;
	for($i=1;$i<$num+1;$i++)
	{
		$from=$_POST['from'.$i];
		$to=$_POST['to'.$i];
		$query="insert into leave (employeeid,nature,noday,fromdate,todate,deptid,
			noleft,status,currently,year) values ('$empid','CL','$diff[$i]',
			'$from','$to','$deptid','$noleft2','open','$dhod','$year')";							//e-mail ID of HOD
		$result=pg_query($conn,$query) ;
		$noleft2-=$diff[$i];
	}
}
}
?>

</body>
</html>

























