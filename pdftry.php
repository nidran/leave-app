<?php
require('fpdf.php');
require('variables.php');
session_start();
//print_r($_SESSION);
$db=pg_connect(connection_string);
$from=$_SESSION["from"];
$to=$_SESSION['to'];
$leaveid=$_SESSION['leaveid'];
$name=$_SESSION['name'];
$department=$_SESSION['dname'];
$dsg=$_SESSION['dsg'];

$query="SELECT * from leave where leaveid='$leaveid'";

$result=pg_query($query);
$row=pg_fetch_row($result);

$image1 = "ncaor.gif";
$image2="vrf.gif";
$image3="id.gif";
$image4="name.gif";
$image5="vrh.gif";
$image6="nop.gif";
$image7="desig.gif";
$image8="email.gif";
$image9="vro.gif";
$image10="frmt.gif";
$image11="tot.gif";
$image12="purpose.gif";
$image13="pov.gif";
$image14="deptn.gif";
$image15="guestn.gif";
$image16="guestc.gif";
$image17="emps.gif";
$image18="tco.gif";
$image19="tao.gif";
$image20="avail.gif";
$image21="adminoff.gif";
$image22="big.gif";
$image23="appnot.gif";
$image24="dir.gif";

$pdf->Ln();
$pdf->Cell(0,10,'NATIONAL CENTRE FOR ANTARCTIC & OCEAN RESEARCH','LTR',0,'C');
$pdf->Ln();
$pdf->Cell( 0, 10, $pdf->Image($image1, 55,$pdf->GetY()), 'LBR', 0, 'C');
$pdf->Ln();

$pdf->Ln();
$pdf->Cell(0,10,'VEHICLE REQUISITION FORM','LTR',0,'C');
$pdf->Ln();
$pdf->Cell( 0, 10, $pdf->Image($image2, 55,$pdf->GetY()),'LBR' , 0, 'C');
$pdf->Ln();

$pdf->Ln();
$pdf->Cell(55,11,"Employee ID",'LTR' ,0, 'L');
$pdf->Cell(40,11,"$r[0]",'LTR' ,0, 'L');
$pdf->Cell(55,11,"Employee Name",'LTR' ,0, 'L');
$pdf->Cell(40,11,"$row[0]",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image3,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);
$pdf->Cell( 40, 5.5, '',0, 0, 'C',0);
$pdf->Cell( 55, 5.5, $pdf->Image($image4,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 5.5, '','LBR', 0, 'C',0);

$pdf->Ln();
$pdf->Cell(55,11,"Vehicle required for",'LTR' ,0, 'L';
$pdf->Cell(40,11,"$row[11]",'LTR' ,0, 'L');
$pdf->Cell(55,11,"No. of people",'LTR' ,0, 'L');
$pdf->Cell(40,11,"$row[10]",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image5,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);
$pdf->Cell( 40, 5.5, '',0, 0, 'C',0);
$pdf->Cell( 55, 5.5, $pdf->Image($image6,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 5.5, '','LBR', 0, 'C',0);

$pdf->Ln();
$pdf->Cell(55,11,"Designation",'LTR' ,0, 'L');
$pdf->Cell(40,11,"$row[1]",'LTR' ,0, 'L');
$pdf->Cell(55,11,"e-mail",'LTR' ,0, 'L');
$pdf->Cell(40,11,"$row[3]",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image7,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);
$pdf->Cell( 40, 5.5, '',0, 0, 'C',0);
$pdf->Cell( 55, 5.5, $pdf->Image($image8,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 5.5, '','LBR', 0, 'C',0);

$pdf->Ln();
$pdf->Cell(55,11,"Vehicle required on",'LTR' ,0, 'L');
$pdf->Cell(135,11,"$row[5]",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image9,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 135, 5.5, '',0, 0, 'C',0);

$pdf->Ln();
$pdf->Cell(55,11,"From Time",'LTR' ,0, 'L');
$pdf->Cell(40,11,"$row[6]:$row[25] Hrs",'LTR' ,0, 'L');
$pdf->Cell(55,11,"To Time",'LTR' ,0, 'L');
$pdf->Cell(40,11,"$row[7]:$row[24] Hrs",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image10,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 5.5, '',0, 0, 'C',0);
$pdf->Cell( 55, 5.5, $pdf->Image($image11,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 5.5, '','LBR', 0, 'C',0);


$pdf->Ln();
$pdf->Cell(55,11,"Place of visit",'LTR' ,0, 'L');
$pdf->Cell(135,11,"$row[4]",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image12,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);
$pdf->Cell( 135, 5.5, '',0, 0, 'C',0);

$pdf->Ln();
$pdf->Cell(55,11,"Purpose",'LTR' ,0, 'L');
$pdf->Cell(135,11,"$row[9]",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image13,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);
$pdf->Cell( 135, 5.5, '',0, 0, 'C',0);

$pdf->Ln();
$pdf->Cell(55,11,"Department Name",'LTR' ,0, 'L');
$pdf->Cell(135,11,"$row[2]",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image14,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);
$pdf->Cell( 135, 5.5, '',0, 0, 'C',0);

$pdf->Ln();
$pdf->Cell(55,11,"Guest name",'LTR' ,0, 'L');
$pdf->Cell(135,11,"$row[12]",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image15,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);
$pdf->Cell( 135, 5.5, '',0, 0, 'C',0);

$pdf->Ln();
$pdf->Cell(55,11,"Guest contact",'LTR' ,0, 'L');
$pdf->Cell(135,11,"$row[13]",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 55, 5.5, $pdf->Image($image16,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);
$pdf->Cell( 135, 5.5, '',0, 0, 'C',0);

/*$pdf->Ln();
$pdf->Cell(60,10,"Form id");
$pdf->Cell(100,10,": $row[21]",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"Name");
$pdf->Cell(100,10,": $row[0]",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"Designation");
$pdf->Cell(100,10,": $row[1]",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"Department");
$pdf->Cell(100,10,": $row[2]",0,0,'L');
$pdf->Ln();
//$pdf->Cell(60,10,"email id");
//$pdf->Cell(100,10,": $row[3]",0,0,'L');
$pdf->Cell(60,10,"Destination");
$pdf->Cell(100,10,": $row[4]",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"Date");
$pdf->Cell(100,10,": $row[5]",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"From time");
$pdf->Cell(100,10,": $row[6]:$row[25] hrs",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"To time");
$pdf->Cell(100,10,": $row[7]:$row[24] hrs",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"Duration");
$pdf->Cell(100,10,": $row[8]",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"Purpose");
$pdf->Cell(100,10,": $row[9]",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"Required for");
$pdf->Cell(100,10,": $row[11]",0,0,'L');
$pdf->Ln();
$pdf->Cell(60,10,"Number of people");
$pdf->Cell(100,10,": $row[10]",0,0,'L');
$pdf->Ln();
*/
$pdf->Ln();
$pdf->Cell(170,10,"Signature of employee",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 170, 5.5, $pdf->Image($image17,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);

$pdf->Ln();
$pdf->Cell(60,10,"Through Controlling Officer",'LTR' ,0, 'L');

$pdf->Ln();
$pdf->Cell( 60, 5.5, $pdf->Image($image18,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(60,10,"To, Administrative Officer",'LTR' ,0, 'L');
$pdf->Ln();
$pdf->Cell( 60, 5.5, $pdf->Image($image19,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);

$pdf->Ln();
$pdf->Cell(170,10,"Dept. Vehicle Available/Not Available",'LTR' ,0, 'L');
$pdf->Ln();
$pdf->Cell( 170, 5.5, $pdf->Image($image20,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(170,10,"Administrative Officer",'LTR' ,0, 'L');
$pdf->Ln();
$pdf->Cell( 170, 5.5, $pdf->Image($image21,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);

$pdf->Ln();
$pdf->Cell(170,10,"DIRECTOR: Submitted for approval for hiring of a taxi as proposed above",'LTR' ,0, 'L');
$pdf->Ln();
$pdf->Ln();
$pdf->Cell( 170, 5.5, $pdf->Image($image22,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);

$pdf->Ln();
$pdf->Cell(170,10,"Approved/ Not Approved",'LTR' ,0, 'L');
$pdf->Ln();
$pdf->Cell( 170, 5.5, $pdf->Image($image23,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);

$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(170,10,"Director",'LTR' ,0, 'L');
$pdf->Ln();
$pdf->Cell( 170, 5.5, $pdf->Image($image24,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Output();
}
else
{
$flag=1;	
}
}
?>
<html>
<style type="text/css">
    #button{
        margin-left: 39%;
    }
    #sub{
        margin-top: 2%; 
        margin-left: 43%;
    }
    #l{
        margin-left: 90%;
    }
</style>
<body>
<img id="line" src="newheader.png" width="100%" height="250" align="left">
<a id='l' href="index.php">Logout</a>
   <form action="pdf.php" method="post">
   <div id="button">
    <label >Form Id </label><input type="text" name="form_id" >
    </div>
    <div id="sub">
    <input  type="submit" name="submit" value="Submit">
    <input  type="reset" name="reset" value="Reset">
    <?php if($flag==1) echo "<h3>Please enter correct form id</h3>"; ?>
   </div>
   </form>
</body>
</html>
