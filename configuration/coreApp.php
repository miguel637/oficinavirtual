<?php

class coreApp extends Database{

    public function __construct() {
        
    }

    public function getView($view,$data = array())
    {
        foreach($data as $key => $value)
        {
            $$key = $value;
        }
        require 'vista/'.$view;
    }

    public function validateSession($var)
    {
        if(isset($_SESSION[$var])) return true;
        else false;
    }

    public function redirect($uri)
    {
        header("Location: ".LINK_URL.$uri);
        exit();
    }

    public function cargarModulos($tipo_usuario)
    {
        if($tipo_usuario == 1) $tipo = "admin";
        if($tipo_usuario == 2) $tipo = "empresa";
        if($tipo_usuario == 3) $tipo = "empleado";

        if(isset($tipo))
        {
            $sql = "SELECT nombre,link FROM modulos WHERE $tipo=1";
            return $this->sql_seleccionar($sql);
        }
        else return array();
        
    }

    public function checkstatus($validator)
    {
        if(isset($_SESSION["id_user"]) == $validator)
        {
            return true;
        }
        else return false;
    }

    function getModulosHabilitados()
    {
        $sql = "SELECT t1.*,t2.section FROM usuario_modulos t0 
        INNER JOIN modulos_estructura t1 ON t0.id_modulo=t1.id_modulo
        INNER JOIN modulos t2 ON t0.id_modulo=t2.id AND t2.activo=1 
        WHERE t0.estado=1 AND t0.id_usuario=".$_SESSION["id_user"]." ORDER BY t2.orden_section,t2.orden,t1.id";
        return $this->sql_seleccionar($sql);
    }

    function addLog($tipo,$descripcion)
    {
        $file = $_SERVER["REQUEST_URI"];
        $tipo_user = (isset($_SESSION["type_user"])) ? $_SESSION["type_user"] : 0;
        $id_usuario = (isset($_SESSION["id_user"])) ? $_SESSION["id_user"] : 0;
        $address = $_SERVER["REMOTE_ADDR"];
        $sql = "INSERT INTO app_log(tipo,descripcion,file,tipo_user,id_usuario,address) VALUES('$tipo','$descripcion','$file','$tipo_user','$id_usuario','$address')";
        return $this->sql_ejecutar($sql);
    }

    function generarCodigoOAuthZoho()
    {
        $_SESSION["redirWhereIsWithoutToken"] = str_replace("/oficinaNew/","",$_SERVER['REQUEST_URI']);
        if(!isset($_COOKIE["TokenOAuth"]))
        {
            header("Location: https://accounts.zoho.com/oauth/v2/auth?response_type=code&client_id=1000.MK5HX66REN17JC96K526E0LVVOMTPX&scope=ZohoCreator.report.READ&access_type=offline&redirect_uri=".LINK_URL."generateToken/refZoho");
            exit();
        }
    }
}

//https://accounts.zoho.com/oauth/v2/auth?response_type=code&client_id=1000.MK5HX66REN17JC96K526E0LVVOMTPX&scope=ZohoCreator.report.READ&access_type=online&redirect_uri=http://localhost/oficinaNew/generateToken/refZoho&prompt=consent"