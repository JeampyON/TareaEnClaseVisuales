<?php
    $numero=10;
    print_r($numero);
    var_dump($numero);
    //print cuando voy a imprimir texto
    //echo para imprimir un objeto
    echo("<br>");
    $cadena="Hola mundo";
    print_r($cadena);
    var_dump($cadena);
    echo("<br>");
    $boll=true;
    print_r($boll);
    var_dump($boll);
    echo("<br>");
    $vector=array("Lunes","Martes","Miercoles");
    for($i=0;$i<3;$i++){
        print_r($vector[$i]);
        var_dump($vector[$i]);
    }
    echo("<br>");
    print_r($vector[0]);
    var_dump($vector);

    //arrat asociativo o array con propiedades
    echo("<br>");
    $array=array("dia1"=>"Lunes","dia2"=>"Martes");
    print_r($array["dia1"]);
    var_dump($array["dia1"]);

    //objetos clave - valor
    echo("<br>");
    $obj=(object)["fruta1" => "manzana", "fruta2" => "pera"];
    print_r($obj->fruta1);
    var_dump($obj->fruta1);

    echo("<br>");
    function saludo(){
        echo("Hola mundo");
    }
    function saludo1($var){
        return $var;
    }
    saludo();
    echo("<br>");
    echo(saludo1("Hello"));
    $num1=10.00;
    $num2=18;
    if($num1>$num2){
        echo("<br>El numero mayor es: ".$num1);
    } else {
        echo("<br>El numero mayor es: ".$num2);
    }
    $i=0;
    while($i<3){
        echo($i);
        $i++;
    }
    echo("<br>");
    $auto1 = (object)["placa"=>"TBD1111","marca"=>"Toyota","modelo"=>"Supra mk4"];
    $auto2 = (object)["placa"=>"TBD2222","marca"=>"Ford","modelo"=>"Raptor"];

    function mostrarAuto($auto){
        echo($auto->placa.$auto->marca.$auto->modelo);
    }
    mostrarAuto($auto2);
?>
