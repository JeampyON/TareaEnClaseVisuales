<?php
include "conexion.php"; //primero siempre debo conectarme con en insert
$cedula=$_POST['estcedula']; //este le voy a coger por get y no por post
$sql = "DELETE FROM estudiantes WHERE estcedula = '$cedula'";//despues sigue la sentencia sql - la sentencia que me permite hacer eso es "delete from estudiantes where estcedula"
if($conn->query($sql)==TRUE){ //esto se llama una decision implicita, debe coincidir exactamente como esta escrito, como yo le digo que iguale. Por ahora solo le voy a dejar como ==
    echo(json_encode(['success' => 'Estudiante eliminado'])); //si mi query se ejecuta y devuelve un true entonces me va a decir que el estudiante se agrego, pero en este caso no es asi, lo que quiero es que me diga que se elimino el estudiante
}else{
    echo(json_encode(['error' => 'No se elimino Estudiante'])); //si mi query no se ejecuta y devuelve un false entonces me va a decir que no se inserto el estudiante, pero en este caso no es asi, lo que quiero es que me diga que no se elimino el estudiante
}
?>