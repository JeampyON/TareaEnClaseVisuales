<?php

class EnlacesPaginas{
    static function enlacesPaginasModel($enlacesModel){
        if($enlacesModel=="nosotros" || $enlacesModel=="servicios" || $enlacesModel=="contactanos"){
            $module="views/".$enlacesModel.".php";
        }else{
            $module="views/inicio.php";
        }
        return $module;
    }
}

?>