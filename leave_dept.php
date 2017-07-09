<html>

<head>
	<script type="text/javascript">
	var oldstr='All';
	var str;
	function changeform(str)								
	{
		if(str!=oldstr)
		{
			if(str=='All')
			{
				document.getElementById('All').style.display="block";
				document.getElementById('Individual').style.display="none";
			}
			if(str=='Individual')
			{
				document.getElementById('All').style.display="none";
				document.getElementById('Individual').style.display="block";
			}
			oldstr=str;
		}
	}
	
	</script>
<style>
#All
{
	display:block;
}

#Individual
{
	display:none;
}
#report{
	margin-left:35%;
}
#submit{
    
	margin-left:50%;
}
#logout
{
	position:absolute;
	top:35%;
	right:0px;
	font-size: 25px;
}
</style>
</head>
<script type="text/javascript" src="tcal.js"></script>
	<link rel="stylesheet"  href="tcal.css">
<body>
<?php
session_start();
if(isset($_SESSION['user1']))						//if user is already logged in
	{
echo "<img src='newheader1.png' width='100%' height='300' align='left'>
<h2 align='center'>Department wise Report</h2>
<!--reportgeneration page-->
<form name='form1' method='post' action='deptreport.php'>
<div id='report'>
<br>
	<label for='nature' >Select: </label>
	<select id='nature' name='nature' onchange='changeform(this.value)'>
	<option value='All'>All Departments</option>
	<option value='Individual'>Individual Department</option>
	</select>
<br>
      <div id='Individual'>
      	   Select Department:
           <select name='department'>
           <option value='Administration'>Administration</option>
           <option value='Antartic Science'>Antartic Science</option>
           <option value='Biochemistry'>Biochemistry</option>
           <option value='CLCS'>CLCS</option>
           <option value='Cryobiology'>Cryobiology</option>
           <option value='Director Office'>Director Office</option>
           <option value='EEZ'>EEZ</option>
           <option value='Estate'>Estate</option>
           <option value='Finance'>Finance</option>
           <option value='Ice Core'>Ice Core</option>
           <option value='Information & Technology Communication Division'>Information & Technology Communication Division</option>
           <option value='Library'>Library</option>
           <option value='Logistics'>Logistics</option>
           <option value='Marine Stable Isotope Lab'>Marine Stable Isotope Lab</option>
           <option value='OSSG'>OSSG</option>
           <option value='Polar Biology'>Polar Biology</option>
           <option value='Polar Environment'>Polar Environment</option>
           <option value='Polar Meteorology & Atmospheric Science'>Polar Meteorology & Atmospheric Science</option>
           <option value='Polar Remote Sensing'>Polar Remote Sensing</option>
           <option value='Procurement'>Procurement</option>
       </select><br><br>
      <label for='from'>From</label>
<input id='from' name='from' class='tcal' />
<label for='to'>To</label>
<input  id='to' name='to' class='tcal'/><br><br>

</div>
<div id='All'>
<label for='from'>From</label>
<input id='from' name='from' class='tcal' />
<label for='to'>To</label>
<input  id='to' name='to' class='tcal'/><br><br>							   
			
</div></div><br><br>
 <input type='Submit'  id='submit' value='Submit'> 
 <div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/>

</form>
</body>
</html>";
}
else
{
		echo " <div id='login'>Please login to view this page.<br/><a href='./' target='_parent'>Login</a></div><br/>";		//user not logged in
	}
	?>



















