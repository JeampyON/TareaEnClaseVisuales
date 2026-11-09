<?php
include 'fpdf19/fpdf.php';
include 'models/conexion.php';

// ¿Llegó una cédula por GET? Si llegó, reporte de ese estudiante; si no, de todos.
$cedula = isset($_GET['estcedula']) ? trim($_GET['estcedula']) : '';

if ($cedula != '') {
    $stmt = $mysqli->prepare('SELECT * FROM estudiantes WHERE estcedula = ?');
    $stmt->bind_param('s', $cedula);
    $stmt->execute();
    $respuesta = $stmt->get_result();
    $titulo = 'Reporte de estudiante';
} else {
    $respuesta = $mysqli->query('SELECT * FROM estudiantes');
    $titulo = 'Reporte general de estudiantes';
}

// FPDF trabaja en ISO-8859-1: se convierte para que se vean las tildes
function t($texto) {
    return mb_convert_encoding($texto, 'ISO-8859-1', 'UTF-8');
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetTitle(t($titulo));
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 10, t($titulo), 0, 1, 'C');
$pdf->Ln(4);

// Encabezado (30+35+35+55+35 = 190 mm, el ancho útil de la hoja)
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(30, 10, 'Cedula', 1);
$pdf->Cell(35, 10, 'Nombre', 1);
$pdf->Cell(35, 10, 'Apellido', 1);
$pdf->Cell(55, 10, 'Direccion', 1);
$pdf->Cell(35, 10, 'Telefono', 1, 1);

// Filas
$pdf->SetFont('Arial', '', 11);
if ($respuesta->num_rows > 0) {
    while ($fila = $respuesta->fetch_array()) {
        $pdf->Cell(30, 10, t($fila['estcedula']), 1);
        $pdf->Cell(35, 10, t($fila['estnombre']), 1);
        $pdf->Cell(35, 10, t($fila['estapellido']), 1);
        $pdf->Cell(55, 10, t($fila['estdireccion']), 1);
        $pdf->Cell(35, 10, t($fila['esttelefono']), 1, 1);
    }
} else {
    $pdf->Cell(190, 10, 'No hay estudiantes para mostrar', 1, 1, 'C');
}

$pdf->Output();
?>