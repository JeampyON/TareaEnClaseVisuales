<?php
class Auto{
public $placa;
public $marca;
public $modelo;

function __construct($placa,$marca,$modelo){
    $this->placa=$placa;
    $this->marca=$marca;
    $this->modelo=$modelo;
}

function mostrar(){
    echo($this->placa.$this->marca.$this->modelo);
}
}
/*
$Auto1=new Auto();
$Auto1->placa="TBD3333";
$Auto1->marca="Toyota";
$Auto1->modelo="Supra mk4";
$Auto1->mostrar();
*/
//Cunao se crea un constructor ya no funciona el constructo vacio

$Auto2=new Auto("mercedes","TBD4444","x5");
$Auto2->mostrar();

?>