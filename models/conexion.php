<?php
$servername="localhost";
$username="root";
$password="";
$database="cuartoB";

$conn=mysqli_connect($servername,$username,$password,$database);
$mysqli=new mysqli($servername,$username,$password,$database);

if(!$mysqli){
    die("Error en la conexion".mysqli_connect_error());
    //echo ("Estas conectado");
    }

?>