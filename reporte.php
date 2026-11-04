<?php
include "fpdf19/fpdf.php";
include "models/conexion.php";
$sql = "select * from estudiantes";
$respuesta = $mysqli->query($sql);
$pdf = new FPDF();
$pdf->addPage();
$pdf ->SetFont("Arial", "B", 12);
$pdf->SetTitle("Reporte estudiantes");
$pdf->cell(50,10,"Cedula", 1);
$pdf->cell(125,10,"Nombre", 1);
$pdf->Ln();
while($fila=$respuesta->fetch_array()){
    $cedula=$fila['estcedula'];
    $nombre=$fila['estnombre'];
    $pdf->cell(50,10,$cedula, 1);
    $pdf->cell(125,10,$nombre, 1);
    $pdf->Ln();
}
$pdf->OutPut();
?>