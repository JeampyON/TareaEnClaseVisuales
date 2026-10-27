<?php
include "conexion.php";

if (isset($_REQUEST['estcedula']) && $_REQUEST['estcedula'] != "") {
    $cedula = $_REQUEST['estcedula'];
    $sql = "SELECT * FROM estudiantes WHERE estcedula = '$cedula'";
} else {
    $sql = "SELECT * FROM estudiantes";
}

$respuesta = $conn->query($sql);
$resultado = array();

if ($respuesta->num_rows > 0) {
    while ($fila = $respuesta->fetch_array()) {
        array_push($resultado, $fila);
    }
}

print_r(json_encode($resultado));
?>