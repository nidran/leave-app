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






$pdf = new FPDF();

$pdf->AddPage();

$image1 = "ncaor.gif";
$image2="leave.gif";
$image3="name.gif";
$image4="id.gif";
$image5="design.gif";
$image6="nature.gif";
$image7="dept.gif";
$image8="nod.gif";
$image9="purpose.gif";
$image10="from.gif";
$image11="to.gif";
$image12="presat.gif";
$image13="presun.gif";
$image14="sufsat.gif";
$image15="sufsun.gif";
$image16="addl.gif";
$image17="hqf.gif";
$image18="hqt.gif";
$image19="soa.gif";
$image20="sor.gif";
$image22="soc.gif";
$image23="sr.gif";
$image24="rc.gif";
$image25="soac.gif";
$image26="nol.gif";
$image27="noh.gif";
$image28="ld.gif";
$image29="office.gif";
$image30="big.gif";
$image31="ltc.gif";
$image32="big2.gif";
// Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=false, $link='')

$pdf->SetFont('Times','',11);
$pdf->Cell(0,0);
$pdf->Image("ncaor.jpeg",20,10,20,17);
$pdf->Ln();
$pdf->Cell(0,10,'NATIONAL CENTRE FOR ANTARCTIC & OCEAN RESEARCH',0,0,'C');
$pdf->Ln(7);
//Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])
$pdf->Cell( 0, 10, $pdf->Image($image1, 55,$pdf->GetY()), 0, 0, 'C');
$pdf->Ln(7);
$pdf->Cell(0,10,'LEAVE APPLICATION FORM',0,0,'C');
$pdf->Ln(7);
$pdf->Cell( 55, 10, $pdf->Image($image2, 79,$pdf->GetY()), 0, 0, 'C');
$pdf->Ln();


$pdf->Cell(50,8,"Employee ID:",'LTR',0,'L',0);
$pdf->Cell(40,12.5,"$row[1]",'LTR',0,'L');
$pdf->Cell(55,8,"Employee Name:",'LTR', 0 , 'L');
$pdf->MultiCell(45,4.5,"$name",'LTR','L',false);

$pdf->Cell( 50, 5.5, $pdf->Image($image4,$pdf->GetX(), $pdf->GetY()),'LR', 0, 'C',0);
$pdf->Cell( 40, 4.5, '',0, 0, 'C',0);
$pdf->Cell( 55, 4.5, $pdf->Image($image3,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 45, 4.5, '','LBR', 0, 'C',0);

$pdf->Ln();

$pdf->Cell(50,8,"Designation:",'LTR' , 0 ,'L');
$pdf->Cell(40,12.5,"$dsg",1,0,'L');
$pdf->Cell(55,8,"Nature of leave:",'LTR' , 0, 'L');
$pdf->Cell(45,8,"$row[3]",'LTR',0,'L');
$pdf->Ln();
$pdf->Cell( 50, 4.5, $pdf->Image($image5,$pdf->GetX(), $pdf->GetY()),'LB', 0, 'C',0);
$pdf->Cell( 40, 4.5, '',0, 0, 'C',0);
$pdf->Cell( 55, 4.5, $pdf->Image($image6,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 45, 4.5, '','LBR', 0, 'C',0);

$pdf->Ln();

$pdf->Cell(50,8,"Department Name:",'LTR' , 0 , 'L');
$pdf->Cell(140,13.5,"$department",1,0,'L');
$pdf->Cell( 50, 4.5, '',0, 0, 'C',0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell( 50, 4.5, $pdf->Image($image7,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);


$pdf->Ln();
$pdf->Cell(50,8,"No. of Days:",'LTR', 0, 'L');
$pdf->Cell(40,8,"$row[4]",'',0,'L');
$pdf->Cell(55,8,"Purpose:",'LTR' , 0, 'L');
$pdf->Cell(45,8,"$row[2]",'LTR',0,'L');

$pdf->Ln();
$pdf->Cell( 50, 4.5, $pdf->Image($image8,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 4.5, '','R', 0, 'C',0);
$pdf->Cell( 55, 4.5, $pdf->Image($image9,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 45, 4.5, '','R', 0, 'C',0);


$pdf->Ln();
$pdf->Cell(50,8,"Leave from Date:",'LTR' , 0, 'L');
$pdf->Cell(40,8,"$from",'LTR',0,'L');
$pdf->Cell(55,8,"Leave to Date:",'LTR', 0, 'L');
$pdf->Cell(45,8,"$to",'LTR',0,'L');

$pdf->Ln();
$pdf->Cell( 50, 4.5, $pdf->Image($image10,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 4.5, '','R', 0, 'C',0);
$pdf->Cell( 55, 4.5, $pdf->Image($image11,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 45, 4.5, '','BR', 0, 'C',0);


$pdf->Ln();

$pdf->Cell(50,8,"Prefix Saturday:",'LTR' , 0,'L');
$pdf->Cell(40,8,"$row[15]",'LTR',0,'L');
$pdf->Cell(55,8,"Prefix Sunday:",'LTR', 0, 'L');
$pdf->Cell(45,8,"$row[16]",'LTR',0,'L');

$pdf->Ln();
$pdf->Cell( 50, 4.5, $pdf->Image($image12,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 4.5, '','R', 0, 'C',0);
$pdf->Cell( 55, 4.5, $pdf->Image($image13,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 45, 4.5, '','BR', 0, 'C',0);

$pdf->Ln();

$pdf->Cell(50,8,"Suffix Saturday:",'LTR', 0 , 'L');
$pdf->Cell(40,8,"$row[17]",'LTR',0,'L');
$pdf->Cell(55,8,"Suffix Sunday:",'LTR' ,0, 'L');
$pdf->Cell(45,8,"$row[18]",'LTR',0,'L');

$pdf->Ln();
$pdf->Cell( 50, 4.5, $pdf->Image($image14,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 4.5, '','BR', 0, 'C',0);
$pdf->Cell( 55, 4.5, $pdf->Image($image15,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 45, 4.5, '','BR', 0, 'C',0);


$pdf->Ln();
$pdf->Cell(50,8,"Address During leave:", 'LTR', 0, 'L');
$pdf->Cell(140,8,"$row[5]",'LTR' ,0,'L');

$pdf->Ln();
$pdf->Cell( 50, 4.5, $pdf->Image($image16,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 140, 4.5, '','BR', 0, 'C',0);




$pdf->Ln();
$pdf->Cell(65,8,"HQ permission(if availed)From:",'LTR' ,0,'L');
$pdf->Cell(40,8,"$row[20]",'LTR',0,'L');
$pdf->Cell(40,8,"Till:",'LTR');
$pdf->Cell(45,8,"$row[21]",'LTR',0,'L');

$pdf->Ln();
$pdf->Cell( 65, 5.5, $pdf->Image($image17,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 40, 5.5, '','BR', 0, 'C',0);
$pdf->Cell( 40, 5.5, $pdf->Image($image18,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 45, 5.5, '','BR', 0, 'C',0);

$pdf->Ln();
$pdf->Cell(65,11,"LTC Block year (If Availed) :", 'LBR',0,'C',0);
$pdf->Cell(125,11,"$row[19]",'LR',0,'L');
$pdf->Ln();
$pdf->Cell( 65, 5.5, $pdf->Image($image31,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'C',0);
$pdf->Cell( 125, 5.5, '','BR', 0, 'C',0);


$pdf->Ln();



$pdf->Cell(190,10,"For Office Use Only",0,0,'C');




$pdf->Ln();
$pdf->Cell(45,8,"Nature of leave:",'LTR', 0,'L');
$pdf->Cell(50,8,"",'LTR',0,'L');
$pdf->Cell(45,8,"No. of days applied for:", 'LTR' ,0,'L');
$pdf->Cell(50,8,"",'LTR',0,'L');
$pdf->Ln();
$pdf->Cell( 45, 4.5, $pdf->Image($image26,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'L',0);
$pdf->Cell( 50, 4.5, '','BR', 0, 'C',0);
$pdf->Cell( 45, 4.5, $pdf->Image($image27,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'L',0);
$pdf->Cell( 50, 4.5, '','BR', 0, 'C',0);
$pdf->Ln();



$pdf->Cell(95,8,"Leave due before entertaining this application:",'LTR', 0, 'L');
$pdf->Cell(95,8,"",'LTR',0,'L');
$pdf->Ln();
$pdf->Cell( 95, 4.5, $pdf->Image($image28,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'L',0);
$pdf->Cell( 95, 4.5, '','BR', 0, 'C',0);



$pdf->Ln();
$pdf->Cell(95,8,"Recommended:",'LTR', 0,'L');
$pdf->Cell(95,8,"",'LTR',0,'L');
$pdf->Ln();
$pdf->Cell( 95, 4.5, $pdf->Image($image24,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'L',0);
$pdf->Cell( 95, 4.5, '','BR', 0, 'C',0);


$pdf->Ln();
$pdf->Cell(70,8,"Signature of Recommending Authority:",'LTR',0,'L');
$pdf->Cell(40,8,"",'LTR',0,'L');
$pdf->Cell(45,8,"Sanctioned/Rejected:",'LTR' ,0,'L');
$pdf->Cell(35,8,"",'LTR',0,'L');
$pdf->Ln();
$pdf->Cell( 70, 4.5, $pdf->Image($image20,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'L',0);
$pdf->Cell( 40, 4.5, '','BR', 0, 'C',0);
$pdf->Cell( 45, 4.5, $pdf->Image($image23,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'L',0);
$pdf->Cell( 35, 4.5, '','BR', 0, 'C',0);


$pdf->Ln();
$pdf->Cell(95,8,"Signature of Competent Authority:",'LTR',0,'L');
$pdf->Cell(95,8,"",'LTR',0,'L');
$pdf->Ln();
$pdf->Cell( 95, 4.5, $pdf->Image($image22,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'L',0);
$pdf->Cell( 95, 4.5, '','BR', 0, 'C',0);
$pdf->Ln();
$pdf->Cell(190,8,"Please be informed that competent authority has sanctioned/rejected......days of CL/EL/RH/HPL from ... to ....",'LTR', 0,'L');
$pdf->Ln();
$pdf->Cell(190 ,4.5, $pdf->Image($image30 , $pdf->GetX(), $pdf->GetY()),'LR', 0, 'L');
$pdf->Ln();
$pdf->Cell(190 ,4.5, $pdf->Image($image32 , $pdf->GetX(), $pdf->GetY()), 'LBR', 0, 'L');
$pdf->Ln();
$pdf->Cell(95,8,"Signature of Official Concerned:",'LtR',0,'L');
$pdf->Cell(95,8,"",'LTR',0,'L');
$pdf->Ln();
$pdf->Cell(95, 4.5 ,$pdf->Image($image19,$pdf->GetX(), $pdf->GetY()),'LBR', 0, 'R',0);
$pdf->Cell(95,4.5,"",'BR',0,'L');
$pdf->Output();
?>
