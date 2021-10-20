<?php 
require 'modelo/adminModel.php';

class AdminController extends AdminModel
{
    public function __construct() {
        
    }

    public function cambiarClaveUsuarioMisional()
    {
        header('Content-Type: application/json');
        
        if(isset($_GET["toUser"]) && isset($_GET["fieldnew"]) && isset($_SESSION["id_user"]))
        {
            $result = $this->cambiarClaveUsuario($_GET["toUser"],$_GET["fieldnew"],3);
            
            if($result) {
                $print = array("result" => "success");
            }
            else $print = array("result" => "error");
            
        }
        else $print = array("result" => "fatal error");
        

        echo json_encode($print);
    }

    public function administrarUsers()
    {    
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");
        
        if($_SESSION["type_user"] != 1) die("No tienes permisos de acceso");

        $data["users_persona"] = $this->getAllUsers(3);
        
        $data["title_app"] = "Administrar Usuarios - Oficina Virtual";
        $data["script"] = "$('#menu-admin-users').addClass('active');";

        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('admin/users.php',$data);
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function sincronizarUsers()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 1) die("No tienes permisos de acceso");
        
        $data["title_app"] = "Sincronizar Usuarios - Oficina Virtual";
        $data["script"] = "$('#menu-admin-users').addClass('active');";

        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('admin/sync_users.php',$data);
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function sincronizarMisionales()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 1) die("No tienes permisos de acceso");
        
        $data["title_app"] = "Sincronizar Usuarios - Oficina Virtual";
        $data["script"] = "$('#menu-admin-users').addClass('active');";

        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('admin/sync_personas.php',$data);
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }
    public function sincronizarPracticantes()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        if($_SESSION["type_user"] != 1) die("No tienes permisos de acceso");
        
        $data["title_app"] = "Sincronizar Practicantes - Oficina Virtual";
        $data["script"] = "$('#menu-admin-users').addClass('active');";

        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('admin/sync_practicante.php',$data);
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    public function agregarUsers()
    {
        header('Content-Type: application/json');
        
        if(!isset($_POST["data"]))
        {
            $print = array("status" => "error","result" => "No data to load");
        }
        else
        {
            $aprobadores = $_POST["data"];
            $actualizados = 0;
            $agregado = 0;
            $modulosListadoZoho = $this->listaModulosZoho(2);

            $modulosToSync = [];
                
            foreach($modulosListadoZoho as $fila)
            {
                array_push($modulosToSync,$fila["field_zoho"]);
            }

            foreach($aprobadores as $aprobador)
            {
                $user = $aprobador["CORREO"];
                $clave = $aprobador["C_DIGO_DE_AUTORIZACI_N"];
                $token = $aprobador["ID"];
                $estado = 1;
                $tipo_usuario = 2;
                $id_usuario = $_SESSION["id_user"];
                $nombres = $aprobador["CLIENTE_APROBADOR"]["display_value"];
                $telefono = $aprobador["TELEFONO"];
                $persona = $aprobador["PERSONA_QUE_AUTORIZA"];
                $cargo = $aprobador["CARGO_PERSONA_QUE_AUTORIZA"];
                $codigoReferencia = $aprobador["CLIENTE_APROBADOR.C_DIGO_CLIENTE"];
                $codigoEmpresa = $aprobador["CLIENTE_APROBADOR.ID"];
                $urlCarpetaDigital = $aprobador["CLIENTE_APROBADOR.URL_Carpeta_Digital"];

                $i = 0;
                $Modulos_All = [];

                foreach($modulosToSync as $fila)
                {
                    if($aprobador[$fila] == "SI") $Modulos_All[$i] = 1;
                    else $Modulos_All[$i] = 0; 
                    
                    $i++;
                }

                $result = $this->agregarUserExec(strtolower($user),$clave,$token,$estado,$tipo_usuario,$id_usuario,$nombres,$telefono,$persona,$cargo,$codigoReferencia,$codigoEmpresa,$urlCarpetaDigital);

                $modulosSync = $this->sincronizarModulos($token,$Modulos_All,2);
    
                if($result == 'actualizado' || $modulosSync > 0) $actualizados++;
                else if($result == "agregado") $agregado++;
            }

            $print = array("status" => "success","result" => "Se han agregado <b>".$agregado."</b> usuario(s)<br/>Se han actualizado <b>".$actualizados."</b> usuario(s)");
        } 

        echo json_encode($print); 
    }

    public function agregarMisionales()
    {
        header('Content-Type: application/json');
        
        if(!isset($_POST["data"]))
        {
            $print = array("status" => "error","result" => "No data to load");
        }
        else
        {
            $contratos = $_POST["data"];
            $actualizados = 0;
            $agregado = 0;
            foreach($contratos as $contrato)
            {
                $user = $contrato["Numero_de_documento"];//Correo_Electronico
                $clave = $contrato["Numero_de_documento"];
                $token = $contrato["ID"];
                $estado = ($contrato["Estado"] == "ACTIVO") ? 1 : 0;
                $tipo_usuario = 3;
                $id_usuario = $_SESSION["id_user"];
                $nombres = $contrato["Dependencia"];
                $telefono = $contrato["Celular"];
                $persona = $contrato["Primer_Apellido"].' '.$contrato["Primer_Nombre"];
                $cargo = $contrato["Cargo_contratado"];
                $codigoReferencia = $contrato["Nomina"];
                $codigoEmpresa = $contrato["EST"];

                $result = $this->agregarMisionalExec(strtolower($user),$clave,$token,$estado,$tipo_usuario,$id_usuario,$nombres,$telefono,$persona,$cargo,$codigoReferencia,$codigoEmpresa);
    
                if($result == 'actualizado') $actualizados++;
                else if($result == "agregado") $agregado++;
            }

            $print = array("status" => "success","result" => "Se han agregado <b>".$agregado."</b> usuario(s)<br/>Se han actualizado <b>".$actualizados."</b> usuario(s)");
        } 

        echo json_encode($print); 
    }

    public function agregarPracticante()
    {
        header('Content-Type: application/json');
        
        if(!isset($_POST["data"]))
        {
            $print = array("status" => "error","result" => "No data to load");
        }
        else
        {
            $practicantes = $_POST["data"];
            $actualizados = 0;
            $agregado = 0;
            $modulosListadoZoho = $this->listaModulosZoho(4);

            $modulosToSync = [];
                
            foreach($modulosListadoZoho as $dato_file)
            {
                array_push($modulosToSync,$dato_file["field_zoho"]);
            }

            foreach($practicantes as $fila)
            {
                $user = $fila["Correo_Electronico"];//Correo_Electronico
                $clave = $fila["Contrase_a"];
                $token = $fila["ID"];
                $estado = 1;
                $tipo_usuario = 4;
                $id_usuario = $_SESSION["id_user"];
                $nombres = 'HQ5 STAFF';
                $telefono = "9999999999";
                $persona = $fila["Nombres_y_Apellidos"];
                $cargo = $fila["Cargo"];

                $i = 0;
                $Modulos_All = [];

                foreach($modulosToSync as $moduleRow)
                {
                    if($fila[$moduleRow] == "SI") $Modulos_All[$i] = 1;
                    else $Modulos_All[$i] = 0; 
                    
                    $i++;
                }

                $result = $this->agregarPracticanteExec(strtolower($user),$clave,$token,$estado,$tipo_usuario,$id_usuario,$nombres,$telefono,$persona,$cargo);

                $modulosSync = $this->sincronizarModulos($token,$Modulos_All,4);
    
                if($result == 'actualizado' || $modulosSync > 0) $actualizados++;
                else if($result == "agregado") $agregado++;
            }

            $print = array("status" => "success","result" => "Se han agregado <b>".$agregado."</b> usuario(s)<br/>Se han actualizado <b>".$actualizados."</b> usuario(s)");
        } 

        echo json_encode($print); 
    }


    public function verDashboard()
    {
        $this->getView("admin/dashboard.php");
    }
}

$object = new AdminController();