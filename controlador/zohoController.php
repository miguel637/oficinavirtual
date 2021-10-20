<?php 
require 'modelo/adminModel.php';

class ZohoController extends AdminModel
{
    public function __construct() {
        
    }
    public function generateToken()
    {
        if(empty($_GET["code"])) 
        {
            die("Hubo un error en el generación del token. contacta al administrador");
        }
        //-----------------------------
        if(LINK_URL == "https://gestionhq5.com.co/")
        {
            $clientID = "1000.Q96VDOQ34M8WFWO1KO3FNZCRDM7RBL";
            $clientSecret = "9d138ef7e9d4e596486578f2a7b510e91fc4fee778";
        }
        else
        {
            $clientID = "1000.MK5HX66REN17JC96K526E0LVVOMTPX";
            $clientSecret = "82e8d62d7c0766900493681c030df1345619e4f178";
        }
        //----------------------------
        $postdata = http_build_query(
            array(
              "grant_type" => "authorization_code",
              "client_id" => $clientID,
              "client_secret" => $clientSecret,
              "redirect_uri" => LINK_URL."generateToken/refZoho",
              "code" => $_GET["code"]
            )
        );
          
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
          
          
          $context = stream_context_create($opts);
          
          $result = file_get_contents("https://accounts.zoho.com/oauth/v2/token", false, $context);
          $manage = json_decode($result);
          if(!isset($manage->access_token)) die("error");
          else setcookie("TokenOAuth",$manage->access_token,time()+60*58,"/");

          $this->sql_ejecutar("UPDATE app_variables SET valor_texto='$manage->access_token' WHERE variable='TokenOAuth_Zoho'");

          if(isset($_SESSION["redirWhereIsWithoutToken"]))
          {
                $location = $_SESSION["redirWhereIsWithoutToken"];
                unset($_SESSION["redirWhereIsWithoutToken"]);
                header("Location: ".LINK_URL.$location);
          }
          else header("Location: ".LINK_URL);

    }

    public function gd_enviar_validacion()
    {

        $urlToUpdate = "https://www.zohoapis.com/crm/v2/functions/gd_enviar_validacion/actions/execute?auth_type=apikey&zapikey=1003.6b0aed11df76bd50065c39e0740f8315.5d4f17315e8ee400ca583c3544c8e2da";

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
          CURLOPT_POSTFIELDS => array('arguments' => '{"Record_ID":'.$_POST["Record_ID"].',"UsuarioModificacion":"'.$_SESSION["user_usuario"].'","Anotacion":"'.$_POST["Anotacion"].'"}'),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}

$object = new ZohoController();