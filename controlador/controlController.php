<?php 
require 'modelo/controlModel.php';

class ControlController extends ControlModel
{
    public function __construct() {
        
    }

    public function ingresoPersonal()
    {
        $data["title_app"] = "Ingreso Personal - Oficina Virtual";
        $data["type"] = "Ingreso";
        $this->getView('layout/header.php',$data);
        $this->getView('control/ingresoPersonal.php',$data);
        $this->getView('layout/footer.php',$data);
    }

    public function salidaPersonal()
    {
        $data["title_app"] = "Salida Personal - Oficina Virtual";
        $data["type"] = "Salida";
        $this->getView('layout/header.php',$data);
        $this->getView('control/salidaPersonal.php',$data);
        $this->getView('layout/footer.php',$data);
    }

    public function reporteSintomas()
    {
        if(isset($_GET["accessID"]) && isset($_GET["empresa"]))
        {
            $data["empresa"] = $_GET["accessID"];
        }
        else $data["empresa"] = rand(1000000000,10000000000000);
        $data["title_app"] = "Reporte Sintomas - Oficina Virtual";
        $this->getView('layout/header.php',$data);
        $this->getView('control/reporteSintomas.php',$data);
        $this->getView('layout/footer.php',$data);
    }

    public function doStatus()
    {
        $notify  = (isset($_GET["do"])) ? $_GET["do"] : "";
        $data["title_app"] = "Resultado - Oficina Virtual";
        $data["notify"] = $notify;
        $this->getView('layout/header.php',$data);
        $this->getView('control/showStatus.php',$data);
        $this->getView('layout/footer.php',$data);
    }

    public function actualizarHojaVida()
    {
        $data["title_app"] = "Actualizar la Hoja de Vida - Oficina Virtual";
        $this->getView('layout/header.php',$data);
        $this->getView('control/actualizarHojaVida.php',$data);
        $this->getView('layout/footer.php',$data);
    }
}

$object = new ControlController();