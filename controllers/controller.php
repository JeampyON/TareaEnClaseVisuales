<?php
class controllerMvc{

function gettemplate(){
include "views/template.php";
}

function enlacesPaginasController(){
    if(isset($_GET["action"])){
        $enlacesController=$_GET["action"];
    }else{
        $enlacesController="inicio.php";
    }
    $respuesta=EnlacesPaginas:: enlacesPaginasModel($enlacesController);
    include $respuesta;
    }

}
?>