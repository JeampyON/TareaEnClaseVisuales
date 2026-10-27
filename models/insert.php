<?php
include "conexion.php";
$cedula=$_POST["txtcedula"];
$nombre=$_POST["txtnombre"];
$apellido=$_POST["txtapellido"];
$direccion=$_POST["txtdireccion"];
$telefono=$_POST["txttelefono"];
$sql = "insert into estudiantes values('$cedula','$nombre','$apellido','$direccion','$telefono')"; 
if($conn->query($sql)==TRUE){
    echo(json_encode(['success' => 'Estudiante agregado']));
}else{
    echo(json_encode(['error' => 'No se inserto Estudiantes']));
}

?>