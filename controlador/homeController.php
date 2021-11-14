<?php 
require 'modelo/homeModel.php';

class HomeController extends HomeModel
{
    
    public function __construct()
    {
        
    }

    public function cargarDocumentos()
    {
        $data["title_app"] = "Cargar Documentos - Oficina Virtual";
        $this->getView('layout/header.php',$data);
        $this->getView('home/cargarDocumentos.php',$data);
        $this->getView('layout/footer.php');
    }

    public function ingreso()
    {
        $activeSession = $this->validateSession("type_user");
        if($activeSession)
        {
            $this->redirect("panel");
        }
        else
        {
            $data["title_app"] = "Oficina Virtual";
            $this->getView('layout/header.php',$data);
            $this->getView('home/ingresoView.php',$data);
            $this->getView('layout/footer.php');
        }
    }

    public function restablecer()
    {
        $activeSession = $this->validateSession("type_user");
        if($activeSession)
        {
            $this->redirect("panel");
        }
        else
        {
            $data["title_app"] = "Restablecer - Oficina Virtual";
            $this->getView('layout/header.php',$data);
            $this->getView('home/restablecer.php',$data);
            $this->getView('layout/footer.php');
        }
    }    

    public function validarLogin()
    {
        header('Content-Type: application/json');

        define("CLAVE_SECRETA", "6LcJJzIdAAAAAO-FXnYIld88-3OBAPftgWAIiVkx");

        if (!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"])) {
            exit("Debes completar el captcha");
        }

        $token = $_POST["g-recaptcha-response"];
        $verificado = verificarToken($token, CLAVE_SECRETA);
        
        if ($verificado) {
            $usuario = (isset($_POST["user"])) ? $_POST["user"] : "";
            $password = (isset($_POST["pass"])) ? $_POST["pass"] : "";

            $result = $this->ingresarUsuario(strtolower($usuario),$password);
            if($result == 200) $print = array("result" => "successAccess");
            if($result == 4) $print = array("result" => "errorDuringAccess");
            if($result == 3) $print = array("result" => "noFoundUser");
            if($result == 2) $print = array("result" => "offUserAccess");
            if($result == 1)  $print = array("result" => "errorAccess");
            if(!isset($print)) $print = array("result" => "empty");

            echo json_encode($print);
        }
        else 
        {
            exit("Lo siento, parece que eres un robot");
        }

    }

    public function verificarToken($token, $claveSecreta)
    {
        # La API en donde verificamos el token
        $url = "https://www.google.com/recaptcha/api/siteverify";
        # Los datos que enviamos a Google
        $datos = [
            "secret" => $claveSecreta,
            "response" => $token,
        ];
        // Crear opciones de la petición HTTP
        $opciones = array(
            "http" => array(
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($datos), # Agregar el contenido definido antes
            ),
        );
        # Preparar petición
        $contexto = stream_context_create($opciones);
        # Hacerla
        $resultado = file_get_contents($url, false, $contexto);
        # Si hay problemas con la petición (por ejemplo, que no hay internet o algo así)
        # entonces se regresa false. Este NO es un problema con el captcha, sino con la conexión
        # al servidor de Google
        if ($resultado === false) {
            # Error haciendo petición
            return false;
        }
    
        # En caso de que no haya regresado false, decodificamos con JSON
        # https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/
    
        $resultado = json_decode($resultado);
        # La variable que nos interesa para saber si el usuario pasó o no la prueba
        # está en success
        $pruebaPasada = $resultado->success;
        # Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
        return $pruebaPasada;
    }
    
    public function cerrarSesion()
    {
        session_destroy();
        $this->redirect("");
    }

    public function cambiarClave()
    {
        header('Content-Type: application/json');
        
        if(isset($_POST["fieldactual"]) && isset($_POST["fieldnew"]) && isset($_SESSION["pass_user"]))
        {
            if($_SESSION["pass_user"] == $_POST["fieldactual"])
            {
                $result = $this->cambiarClaveUsuario($_POST["fieldnew"]);

                if($result) {
                    $print = array("result" => "success");
                    $_SESSION["pass_user"] = $_POST["fieldnew"];
                }
                else $print = array("result" => "error");
            }
            else $print = array("result" => "not equals found");
            
        }
        else $print = array("result" => "fatal error");
        

        echo json_encode($print);
    }

    public function verPanel()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Panel - Oficina Virtual";
        $data["script"] = "$('#menu-home-panel').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('home/panel.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }


    
    public function verCalendario()
    {
        $online = $this->checkstatus(true);
        if(!$online) $this->redirect("");

        $data["title_app"] = "Calendario - Oficina Virtual";
        $data["script"] = "$('#menu-home-panel').addClass('active');";
        $data["modulos"] = $this->getModulosHabilitados();
        
        $this->getView('layout/header.php',$data);
        $this->getView('layout/topmenu.php',$data);
        $this->getView('home/verCalendario.php');
        $this->getView('layout/bottommenu.php');
        $this->getView('layout/footer.php',$data);
    }

    // APIs
    public function afiliarTitular()
    {
        header('Content-Type: application/json');

        if(!isset($_POST["type"]) || !isset($_POST["id"]) )
        {
            die("it isn't working");
        }
        if($_POST["type"] == "EPS") $field = "Fecha_Afiliacion_EPS";
        else if($_POST["type"] == "Caja") $field = "Fecha_Afiliacion_Caja";
        else $field = "nothing";

        /** ---------------------- */
        $urlToUpdate = "https://www.zohoapis.com/crm/v2/functions/zoho_creator_afiliar_titular/actions/execute?auth_type=apikey&zapikey=1003.6b0aed11df76bd50065c39e0740f8315.5d4f17315e8ee400ca583c3544c8e2da";

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $urlToUpdate,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => false,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => array('arguments' => '{"Record_ID":'.$_POST["id"].',"UsuarioModificacion":"'.$_SESSION["user_usuario"].'","nombreCampo":"'.$field.'"}'),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function btnContratadoPostulados()
    {
        header('Content-Type: application/json');

        if(!isset($_POST["postulado"]) )
        {
            die("it isn't working");
        }
        
        $urlToUpdate = "https://www.zohoapis.com/crm/v2/functions/postuladosexterno_btncontratado/actions/execute?auth_type=apikey&zapikey=1003.6b0aed11df76bd50065c39e0740f8315.5d4f17315e8ee400ca583c3544c8e2da&postulado=".$_POST["postulado"];

       

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded'
            )
        );

        $context = stream_context_create($opts);

        $result = file_get_contents($urlToUpdate, false, $context);

        echo $result;
    }

    public function btnActualizarSignPostulados()
    {
        header('Content-Type: application/json');

        if(!isset($_POST["postulado"]) )
        {
            die("it isn't working");
        }
        
        $urlToUpdate = "https://www.zohoapis.com/crm/v2/functions/postuladosexterno_btnactualizarsign/actions/execute?auth_type=apikey&zapikey=1003.6b0aed11df76bd50065c39e0740f8315.5d4f17315e8ee400ca583c3544c8e2da&postulado=".$_POST["postulado"];

       

        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded'
            )
        );

        $context = stream_context_create($opts);

        $result = file_get_contents($urlToUpdate, false, $context);

        echo $result;
    }

    public function closePage()
    {
        $data["title_app"] = "Mensaje - Oficina Virtual";
        $data["titulo"] = "El error";
        $data["texto1"] = "El error";
        $data["texto2"] = "El error";
        $this->getView('layout/header.php',$data);
        $this->getView('home/mensaje.php',$data);
        $this->getView('layout/footer.php');
    }
}


$object = new HomeController();