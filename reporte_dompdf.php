<?php
require_once 'dompdf/autoload.inc.php';
include 'models/conexion.php';

use Dompdf\Dompdf;

// ¿Llegó una cédula por GET? Si llegó, solo ese estudiante; si no, todos.
$cedula = isset($_GET['estcedula']) ? trim($_GET['estcedula']) : '';

if ($cedula != '') {
    $stmt = $mysqli->prepare('SELECT * FROM estudiantes WHERE estcedula = ?');
    $stmt->bind_param('s', $cedula);
    $stmt->execute();
    $respuesta = $stmt->get_result();
    $titulo = 'Reporte de estudiante (Dompdf)';
} else {
    $respuesta = $mysqli->query('SELECT * FROM estudiantes');
    $titulo = 'Reporte general de estudiantes (Dompdf)';
}

$html = '<html><head><meta charset="UTF-8"><style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
    h2 { text-align: center; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #000; padding: 6px; }
    th { background: #eeeeee; }
</style></head><body>';
$html .= '<h2>' . $titulo . '</h2>';
$html .= '<table><tr><th>Cédula</th><th>Nombre</th><th>Apellido</th><th>Dirección</th><th>Teléfono</th></tr>';

if ($respuesta->num_rows > 0) {
    while ($fila = $respuesta->fetch_array()) {
        $html .= '<tr>';
        $html .= '<td>' . htmlspecialchars($fila['estcedula']) . '</td>';
        $html .= '<td>' . htmlspecialchars($fila['estnombre']) . '</td>';
        $html .= '<td>' . htmlspecialchars($fila['estapellido']) . '</td>';
        $html .= '<td>' . htmlspecialchars($fila['estdireccion']) . '</td>';
        $html .= '<td>' . htmlspecialchars($fila['esttelefono']) . '</td>';
        $html .= '</tr>';
    }
} else {
    $html .= '<tr><td colspan="5" style="text-align:center">No hay estudiantes para mostrar</td></tr>';
}

$html .= '</table></body></html>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('reporte_estudiantes.pdf', ['Attachment' => false]);
?>