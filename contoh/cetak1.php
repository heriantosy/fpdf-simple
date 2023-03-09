<?php
include_once "../koneksi.php";
require('../fpdf.php');

ob_start();
// $pdf = new FPDF();
// $pdf = new FPDF('P','mm','LEGAL');
$pdf = new FPDF('L','mm',array(80,50));
$pdf->AddPage();
// $pdf->Cell(40,10,'Hello World!');
$pdf->SetTitle("Daftar Pegawai");

$t = 6; $no =0;
$pdf->SetFont('Helvetica', 'B', 10);
$pdf->Cell(10,  $t, 'No.', 1, 0, 'R');
$pdf->Cell(15, $t, 'Login', 1, 0, 'L');
$pdf->Cell(25, $t, 'Nama', 1, 0, 'L');
$pdf->Ln($t);

$r = mysqli_query($koneksi, "select * from pegawai");
while($w = mysqli_fetch_array($r)){	
$no++;    
    $pdf->SetFont('Helvetica', '', 10);
    $pdf->Cell(10,  $t, $no, 1, 0, 'R');
    $pdf->Cell(15, $t, $w['Login'], 1, 0, 'L');
    $pdf->Cell(25, $t, $w['Nama'], 1, 0, 'L');
    $pdf->Ln($t);
}

$pdf->Output();
?>
