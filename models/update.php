<?php
include "conexion.php";
$cedula = $_POST['txtcedula'];
$nombre = $_POST['txtnombre'];
$apellido = $_POST['txtapellido'];
$direccion = $_POST['txtdireccion'];
$telefono = $_POST['txttelefono'];
$sql = "UPDATE estudiantes SET estnombre='$nombre', estapellido='$apellido', estdireccion='$direccion', esttelefono='$telefono' WHERE estcedula='$cedula'";
if($conn->query($sql)==TRUE){
    echo(json_encode(['success' => 'Estudiante actualizado']));
}else{
    echo(json_encode(['error' => 'No se actualizo Estudiante']));
}
?>