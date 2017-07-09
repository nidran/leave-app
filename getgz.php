<?php
$from=$_GET['q'];					//getting from date
$to=$_GET['t'];						//getting to date

$fromtime=strtotime($from);			//converting from date into time
$totime=strtotime($to);				//converting to date into time
	
$path = "gz_list.xls";				//importing excel file
require_once("Excel/reader.php");
$data = new Spreadsheet_Excel_Reader();	
$data->read($path);	
error_reporting(E_ALL ^ E_NOTICE);

$j=0;								//variable for counting no. of GZ holidays between to date and from date

for($i=1; $i<=$data->sheets[0]['numRows'];$i++)				//traversing each row checking till an empty row is encountered
{
	$date=$data->sheets[0]['cells'][$i][1];					//getting value of first column in each row
	$datetime=strtotime($date);								//converting date into time
	if(($datetime>=$fromtime)&&($totime>=$datetime))		//checking if date is b/w to date and from date
	{
		if(date("w",$datetime)!=0&&date("w",$datetime)!=6)	//checking if date is not saturaday or sunday
			$j++;
	}
}

echo $j;							

?>