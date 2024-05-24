<?php
include_once "PartidoBasq.php";
include_once "PartidoFutbol.php";
include_once "Equipo.php";

class Torneo{

    private $coleccionPartidos;
    private $importePremio;

    public function __construct($importePremioC)
    {
        $this->coleccionPartidos = [];
        $this->importePremio= $importePremioC;
    }
    public function getColecPartidos(){
        return $this->getColecPartidos();
    }
    public function setColecPartidos($colecPArtidos){
        $this->coleccionPartidos = $colecPArtidos;
    }
    public function getImporte(){
       return $this->importePremio;
    }


    /**Implementar el método ingresarPartido($OBJEquipo1, $OBJEquipo2, $fecha, $tipoPartido) en la  clase Torneo el cual recibe por parámetro 2 equipos, la fecha en la que se realizará el partido y si se trata de un partido de futbol o basquetbol .
     *  El método debe crear y retornar la instancia de la clase Partido que corresponda y almacenarla en la colección de partidos del Torneo. Se debe chequear que los 2 equipos tengan la misma categoría e igual cantidad de jugadores, caso contrario no podrá ser registrado ese partido en el torneo.  */
    public function ingresarPartido($OBJEquipo1,$OBJEquipo2, $fecha, $tipoPartido){
        $cantJugadores1=$OBJEquipo1->getCantJugadores();
        $tipoCategoria1= $OBJEquipo1->getObjCategoria();
        $cantJugadores2= $OBJEquipo2->getCantJugadores();
        $tipoCategoria2= $OBJEquipo2->getObjCategoria();
        $colecPartidos= $this->getColecPartidos();
        $idPartido= 0 ;
        if($tipoPartido == "futbol"){
           
            if($tipoCategoria1 == $tipoCategoria2 && $cantJugadores1 == $cantJugadores2){
                $idPartido= $idPartido + 1;
                $partido = new PartidoFutbol($idPartido,$fecha,$OBJEquipo1,0,$OBJEquipo2,0,$tipoCategoria1);
                array_push($colecPartidos,$partido);
            }
        }elseif($tipoPartido == "basquet"){
            if($cantJugadores1 == $cantJugadores2){
                $idPartido= $idPartido +1;
                $partido = new PartidoBasq($idPartido,$fecha,$OBJEquipo1,0,$OBJEquipo2,0,0);
                array_push($colecPartidos,$partido);
            }
        }
        return $partido;
    }

    public function darGanadores($deporte)  {  // "Futbol" o "Basquet"
        $colPartidos = $this->getColecPartidos();
        $colPartidosBasquet = [];
        $colPartidosFutbol = [];
        $colGanadores = [];
        foreach ($colPartidos as $partido) {
            if ( $deporte == "futbol") {
                if ($partido instanceof PartidoFutbol) {
                    array_push($colPartidosFutbol , $partido);
                }
            } else {
                if ($deporte == "basquet") {
                    if ($partido instanceof PartidoBasq) {
                        array_push($colPartidosBasquet , $partido);
                    }
                }
            }
        }
        foreach ($colPartidosFutbol as $partido) {
            $equipoGanador = $partido->darEquipoGanador(); 
            array_push($colGanadores , $equipoGanador);
        }
        foreach ($colPartidosBasquet as $partido) {
            $equipoGanador = $partido->darEquipoGanador(); 
            array_push($colGanadores , $equipoGanador);
        }
        return $colGanadores;
    }

    public function calcularPremioPartido($objPartido) {

        $coefPartido = $objPartido->coeficientePartido();

        $premioPartido = $this->getImporte() * $coefPartido;

        $ganadorPartido = $objPartido->darEquipoGanador();

        $premio = ["equipoGanador" => $ganadorPartido , "premioPartido" =>$premioPartido];

        return $premio;
    }


    public function __toString()
    {
        return 
        "Colecion partidos: ".$this->getColecPartidos()."\n".
        "importe Premio: ".$this->getImporte()."\n";
    }

}