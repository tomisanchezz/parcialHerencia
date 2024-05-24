<?php

include_once "Partido.php";
include_once "Categoria.php";

class PartidoFutbol extends Partido{

    private $objCategoria;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$objCategoria){
        parent:: __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2);
        $this->objCategoria=$objCategoria;
    }
    public function getObjCategoria(){
        return $this->objCategoria;
    }


    public function coeficientePartido()
    {
        $descCategoria = $this->getObjCategoria()->getDescripcion();

        if($descCategoria == "Menores"){
            $coefCategoria = 0.13;
        }elseif($descCategoria == "juveniles"){
            $coefCategoria = 0.19;
        }elseif($descCategoria == "Menores"){
            $coefCategoria= 0.17;
        }

        $cantJugadores = $this->getObjEquipo1()->getCantJugadores() + $this->getObjEquipo2()->getCantJugadores();
        $cantGolesTotal = $this->getCantGolesE1() + $this->getCantGolesE2();

        $coeficientePartido = $coefCategoria * $cantJugadores * $cantGolesTotal;
        return $coeficientePartido;

    }

    public function __toString()
    {
        $cadena= parent :: __toString();
        $cadena .= "Categoria: ".$this->getObjCategoria()."\n";
    }


}