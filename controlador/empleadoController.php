<?php 
require 'modelo/empleadoModel.php';

class EmpleadoController extends EmpleadoModel
{
    
    public function __construct()
    {
        
    }

    public function verDocumentos()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 3) die("No tienes permisos de acceso");

        $data["title_app"] = "Documentos - Oficina Virtual";
        $data["script"] = "$('#menu-emp-files').addClass('active');";
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('empleado/verDocumentos.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function reportarCovid()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 3) die("No tienes permisos de acceso");

        $data["title_app"] = "Reportar Covid - Oficina Virtual";
        $data["script"] = "$('#menu-emp-reporteCovid').addClass('active');";
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('empleado/reportarCovid.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function hojadevida()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 3) die("No tienes permisos de acceso");

        $data["title_app"] = "Hoja de vida - Oficina Virtual";
        $data["script"] = "$('#menu-emp-hojaVida').addClass('active');";
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('empleado/hojadevida.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function verBeneficiarios()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 3) die("No tienes permisos de acceso");

        $data["title_app"] = "Beneficiarios - Oficina Virtual";
        $data["script"] = "$('#menu-mis-beneficiarios').click();$('#menu-mis-verBenef').addClass('active');";
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('empleado/verBeneficiarios.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function agregarBeneficiario()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 3) die("No tienes permisos de acceso");

        $data["title_app"] = "Nuevo Beneficiario - Oficina Virtual";
        $data["script"] = "$('#menu-mis-beneficiarios').click();$('#menu-mis-addBenef').addClass('active');";
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('empleado/agregarBeneficiario.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function cambiarPassword()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 3) die("No tienes permisos de acceso");

        $data["title_app"] = "Cambiar Clave - Oficina Virtual";
        $data["script"] = "$('#menu-mis-cambiarPassword').click();$('#menu-mis-cambiarClave').addClass('active');";
        $data["run_jquery"] = true;
        $data["js_extra_path"] = '';
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('empleado/cambiarPassword.php');
        $this->getView('layout/bottommenu.php',$data);
        $this->getView('layout/footer.php',$data);
    }

    public function crearIncapacidad()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 3) die("No tienes permisos de acceso");

        $data["title_app"] = "Nueva Incapacidad - Oficina Virtual";
        $data["script"] = "$('#menu-mis-incapacidades').click();$('#menu-mis-incapacidades_new').addClass('active');";
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('empleado/nuevaIncapacidad.php');
        $this->getView('layout/bottommenu.php',$data);
        $this->getView('layout/footer.php',$data);
    }

    public function verIncapacidades()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 3) die("No tienes permisos de acceso");

        $data["title_app"] = "Incapacidades Generadas - Oficina Virtual";
        $data["script"] = "$('#menu-mis-incapacidades').click();$('#menu-mis-incapacidades_ver').addClass('active');";
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('empleado/verIncapacidades.php');
        $this->getView('layout/bottommenu.php',$data);
        $this->getView('layout/footer.php',$data);
    }


}

$object = new EmpleadoController();