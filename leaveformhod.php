<html>
<head>
	<script type="text/javascript" src="tcal.js"></script>
	<link rel="stylesheet"  href="tcal.css">
<title>IntraNCAOR - Leave Applications</title>
<style>
<style>

form
{
	position:relative;
}

input[type="text"], input[type="file"], textarea, select
{
	position:absolute;
	left:250px;
}


label
{
	width:100px;
}

#from1,#to1,#add
{
	position:relative;
	left:0px;
}

label[for='noleft1'], label[for='noleft2']
{
	color:#3399ff;
}

.ui-datepicker-month
{
	position:relative;
	left:0px;
}

#main
{
	margin:auto;
	width:900px;
	position:relative;
}

#heading,#heading2
{
	font-size:30px;
	text-align:center;
}

#form2
{
	position:absolute;
	top:50px;
	left:470px;
	border-left-style:solid;
	border-bottom-color:#000;
	border-bottom-width:1px;
	padding-left:100px;
	padding-top:20px;
	padding-bottom:50px;
}
#form3
{
	position:absolute;
	top:50px;
	left:20%;
	padding-left:100px;
	padding-top:20px;
	padding-bottom:50px;
}
#form3 input[type="text"]
{
	left:300px;
}
#form2 input[type="text"]
{
	left:300px;
}

#clform
{
	display:block;
}

#rhform, #newday
{
	display:none;
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
#log{
	position:absolute;
	top:35px;
	right:0px;
}
#ltc{
	display:none;
}

</style>
	<script type="text/javascript">
	var oldstr='CL';
	var str;
	function changeform(str)								//function which changes the form for RH and CL
	{
		if(str!=oldstr)
		{
			if(str=='CL')
			{
				document.getElementById('clform').style.display="block";
				document.getElementById('rhform').style.display="none";
			}
			else
			{
				document.getElementById('clform').style.display="none";
				document.getElementById('rhform').style.display="block";
			}
			oldstr=str;
		}
	}

	function checkday(str)								//shows second text-box in RH, when no of days=2
	{
		if(str=='1')
		{
			document.getElementById('newday').style.display="none";
		}
		else
		{
			document.getElementById('newday').style.display="block";
		}
	}

	function checkltc(str)								//shows second text-box in RH, when no of days=2
	{
		if(str=='NO')
		{
			document.getElementById('ltc').style.display="none";
		}
		else
		{
			document.getElementById('ltc').style.display="block";
		}
	}

	$(function () {										//function to calculate number of leaves and show datepicker in to and from text-boxes
		
		var dates = $( "#from1, #to1" ).datepicker({
			dateFormat:'dd-mm-yy',						//format
			defaultDate: "+0",							//date selected by default
			changeMonth: true,
			onSelect: function( selectedDate ) {		//showing calender onselect
				var option = this.id == "from1" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings );
				dates.not( this ).datepicker( "option", option, date );
				
				//getting no. of days between from date and to date and subtracting saturadys and sundays
				if ((this.id=="from1" && $("#to1").datepicker("getDate")) || (this.id=="to1" && $("#from1").datepicker("getDate"))){
					var nodays=($("#to1").datepicker("getDate").getTime()-$("#from1").datepicker("getDate").getTime())/(1000*60*60*24)+1;					
					var date1=$("#from1").datepicker("getDate");
					var date2=$("#to1").datepicker("getDate");
					
					var onejan = new Date(date1.getFullYear(),0,1);
					var week1= Math.ceil((((date1 - onejan) / 86400000) + onejan.getDay()+1)/7);
					var week2= Math.ceil((((date2 - onejan) / 86400000) + onejan.getDay()+1)/7);
					var week=week2-week1;
					var i=week*2;
					
					if(date1.getDay()==0){
						i++;
					}
					if(date2.getDay()==6){
						i++;
					}
					
					//subtracting gazetted holidays
					$.get("getgz.php", {q:document.getElementById('from1').value , t:document.getElementById('to1').value}, function(resp){
						i+=parseInt(resp);
						document.getElementById("nodays1").value=nodays-i;
					});
				}
			}
		});
	});

	</script>
</head>

<body>
<div id="header">
   <img id="line" src="newheader.png" width="100%" height="250" align="center">
</div>
    
    <div id="main">
	<p id='heading'>Casual Leave Application</p>
	<?php
session_start();

require 'variables.php';
$maxcl=MAXCL;
$maxrh=MAXRH;
$conn=pg_connect(connection_string);
if(!$conn)
	echo "<div class='error'>".MSG_NO_CONN."<br/><br/></div>";
else
{
	if(isset($_SESSION['user1']))						//if user is already logged in
	{
		$id=$_SESSION['user1'];							
		$priv1=$_SESSION['priv1'];
						
		if($priv1=='1')									//priv 6 = normal user
	    {
			$id=$_SESSION['user1'];
			$result=pg_query($conn,"select * from employee where employeeid='".$id."'");
  			$row=pg_fetch_row($result);					//getting employee details
			$re=$row[11];								//department ID
   			$result1=pg_query($conn,"select * from department where deptid='".$re."'");												//getting department details
			$row1=pg_fetch_row($result1);
			
			require 'reader.php';			//importing excel sheet with RH holideys list
			$data = new Spreadsheet_Excel_Reader();	
			$data->read('rh_list.xls'); 
			$year=date('Y');
			$resultcl=pg_query($conn,"select * from leave where employeeid='".$id."' and (status<>'cancelled' and status<>'reject') and nature='CL' and year='$year'");
			
			/*Getting the number of Cl leaves left.*/
			if(pg_num_rows($resultcl)==0)
				$numcl=$maxcl;
			else
			{
				$rowcl=pg_fetch_row($resultcl,pg_num_rows($resultcl)-1);
				$numcl=$rowcl[10]-$rowcl[4];
			}
			$resultrh=pg_query($conn,"select * from leave where (employeeid='".$id."' and nature='RH') and (year='$year' and status='approved')");
			/*Getting the number of RH leaves left.*/
			if(pg_num_rows($resultrh)==0)
				$numrh=$maxrh;
			else
			{
				$rowrh=pg_fetch_row($resultrh,pg_num_rows($resultrh)-1);
				$numrh=$rowrh[10]-$rowrh[4];
			}
			error_reporting(E_ALL ^ E_NOTICE);			//gives error when their is an error in importing excel sheet
			echo "							
		     					<form name='form1' method='post' action='leavedatahod.php' enctype='multipart/form-data'>";
								//enctype is mentioned for attachments
			echo"			 	<label for='eid'>Employee ID </label>
                                <input type='text' name='empid' value='".$row[0]."' readonly='readonly'     />
                                <br /> <br />

                                <label for='name'>Name </label>
                                <input type='text' name='name' value='".$row[1]."' readonly='readonly'/>
                                <br /> <br />
  
                                <label for='designation'>Designation </label>
                                <input type='text' name='design' value='".$row[2]."' readonly='readonly' />
                                <br /> <br />

                                <label for='mobile'>Mobile No.</label>
                                <input type='text' name='mobile' value='".$row[4]."' readonly='readonly' />
                                <br /> <br />
    
                                <label for='landline'>Extension No.</label>
                                <input type='text' name='landline' value='".$row[5]."' readonly='readonly' />
                                <br /> <br />

                                <label for='e-mail'>e-mail</label>
                                <input type='text' name='e-mail' value='".$row[3]."' readonly='readonly' />
                                <br /> <br />
  
                                <label for='deptname'>Department Name</label>
                                <input type='text' name='deptname' id='deptname' value='".$row1[1]."' readonly='readonly' />
                                <br /> <br />
  
                                <label for='location'>Location/Room No.</label>
                                <input type='text' name='location' value='".$row1[2]."' readonly='readonly'  />  
                                <br /> <br />

                                <label for='purpose'>Purpose:</label>
                                <textarea cols='50' rows='1' name='purpose'></textarea><br/><br/><br/>
							   
							   	<label for='nature' >Nature of Leave:</label>
								<select id='nature' name='nature' onchange='changeform(this.value)'>
								<option value='CL' selected='selected'>CL</option>
								<option value='RH'>RH</option>
								</select><br /> <br />";
								
//CL form
echo"							<div id='clform'>
               	               <div class='datepicker'>
							   <label for='noleft1'>Remaining CL Leaves</label>
				   		         <input type='text' name='noleft1' id='noleft1' maxlength='20px' width='10px'  readonly='readonly' value='".$numcl."'/><br/><br/>	
                                    <label for='from1'>From </label>
						           <input id='from1'  name='from1' class='tcal' />
						           <label for='to1'>To</label>
									<input  id='to1' name='to1' class='tcal'/>
				   			  </div>	
			   				<br/>
							                
							
							</div>";

//RH form
echo"						<div id='rhform'>
							<label for='noleft2'>Remaining RH Leaves</label>
		   		         <input type='text' name='noleft2' id='noleft2' maxlength='20px' width='10px'  readonly='readonly' value='".$numrh."'/><br/><br/>	
							<label for='nodays2'>Number of Days:</label>
				   		         <select id='nodays2' name='nodays2'  onchange='checkday(this.value)'>
								<option value='1'>1</option>
								<option value='2'>2</option>
								</select>
								 <br/><br/>
							<div class='datepicker'>
									<label for='from2'>Day for RH leave</label>
									<select id='from2' name='from2'>
									";
							for($i=1; $i<=$data->sheets[0]['numRows'];$i++)
							//traversing each row checking till an empty row is encountered
							{
								$currdate=time(); //getting current time
								$otherdate=$data->sheets[0]['cells'][$i][1];
								$dayname=$data->sheets[0]['cells'][$i][2];	//getting value of first column in each row and converting it to time
								 //comparing otherdate with currenttime
									echo "<option value='$otherdate'>$otherdate-$dayname</option>";	//showing otherdate as option
							}
									echo "</select>
									<br /><br />
									<div id='newday'>
									<label for='to2'>Day for RH leave</label>
									<select id='to2' name='to2'>
									";
							for($i=1; $i<=$data->sheets[0]['numRows'];$i++)
							{
								$currdate=time(); //getting current time
								$otherdate=$data->sheets[0]['cells'][$i][1];
								$dayname=$data->sheets[0]['cells'][$i][2];	//getting value of first column in each row and converting it to time
								 //comparing otherdate with currenttime
									echo "<option value='$otherdate'>$otherdate-$dayname</option>";	//showing otherdate as option
							}
									echo "</select>
									<br /><br />
									</div>
				   			  </div>	
							</div>

							<label><b>Saturday,Sunday and Holiday, if any proposed to be</b></label><br>
							<label><i>Prefixed to leave</i></label><br>
							<label for='prefixsat'>Saturday </label>
						    <input id='prefixsat'  name='prefixsat' class='tcal' />
						    <label for='prefixsun'>Sunday</label>
							<input  id='prefixsun' name='prefixsun' class='tcal'/><br><br>
							<label><i>Suffixed to leave</i></label><br>
							<label for='sufixsat'>Saturday</label>
						    <input id='sufixsat'  name='sufixsat' class='tcal' />
						    <label for='sufixsun'>Sunday</label>
							<input  id='sufixsun' name='sufixsun' class='tcal'/><br><br>

							<label><b>Are you availing LTC?</b></label>
							<select  name='ltc' onchange='checkltc(this.value)'>
							<option>NO</option>
							<option>YES</option>
							</select><br><br>

							<div id='ltc'>
							<label for='ltcyear'>If yes, please enter the block year:</label>
							<select name='ltcyear'>
							<option>2014-2015</option>
							<option>2015-2016</option>
							<option>2016-2017</option>
							<option>2017-2018</option>
							</select><br><br>
							</div>

							<label><b>Please specify dates if seeking permision for leaving Head Quarters:</b></label><br>
							<label for='hqfrom'>From </label>
						    <input id='hqfrom'  name='hqfrom' class='tcal' />
						    <label for='hqto'>To</label>
							<input  id='hqto' name='hqto' class='tcal'/><br><br>
	
							<label for='add'>Address during the Leave period:</label><br>
							<textarea cols='50' id='add' rows='1' name='address'></textarea><br/><br/>
 
							<label for='attachment'>Any Attachment</label>
							<input id='file' type='file' name='file'/><br/><br/>
							Please upload only .doc, .docx, .pdf file formats.<br/><br/>
  							<input type='submit' value='Submit' name='submit' /><br/><br/>
  							</form>";
//form2 for checking status

  			echo "<div id='logout'><a href='logout.php' target='_parent'>Logout</a></div><br/><br/><br/><br/><br/>";
  				echo"<div id='log'><a href='status.php' target='_parent'>Check status</a></div><br/>";
		}
			
	}
}
?>