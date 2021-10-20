<?php

class HomeModel extends CoreApp
{
    function ingresarUsuario($usuario,$pass)
    {
        $datosUsuario = $usuario;
        $sql = "SELECT U.tipo_usuario,UI.id_usuario,UI.nombres,UI.persona,UI.telefono,UI.codigoEmpresaZoho,UI.idEmpresaZoho,U.token,UI.urlCarpetaDigital FROM usuarios U INNER JOIN usuario_info UI ON U.id=UI.id_usuario WHERE user='$usuario' AND U.estado=1 AND clave='$pass' ORDER BY U.id DESC LIMIT 1";

        $result = $this->sql_seleccionar($sql);
        if(count($result) > 0) 
        {
            $usuario = $result[0];
            
            if($usuario["tipo_usuario"] == 2)
            {

                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/APROBADORES_Report?privatelink=htvWkRH39TppWfzSvMmpjERVxt6s6XW3nWysa7APfutpKS1WSNR3wbn0s8E6UO7ktD5PdPN4aK3MqEqjHuYU3V9V33hKkQKOj2KZ&criteria=ID==".$usuario["token"],
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => false,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                curl_close($curl);

                if ($err) {
                    return 4;
                } else {
                    $manage = json_decode($response);
                }

                
                if(!isset($manage->data[0]->Activo)) return 3;
                else if($manage->data[0]->Activo != "ACTIVO") return 2;
                else {};
            }            
            
            $_SESSION["type_user"] = $usuario["tipo_usuario"];
            $_SESSION["pass_user"] = $pass;
            $_SESSION["id_user"] = $usuario["id_usuario"];
            $_SESSION["token_user"] = $usuario["token"];
            $_SESSION["persona_user"] = $usuario["persona"];
            $_SESSION["nombre_user"] = $usuario["nombres"];
            $_SESSION["telefono_user"] = $usuario["telefono"];
            $_SESSION["codigoEmpresa_user"] = $usuario["codigoEmpresaZoho"];
            $_SESSION["idEmpresa_user"] = $usuario["idEmpresaZoho"];
            $_SESSION["urlExpedientes_user"] = $usuario["urlCarpetaDigital"];
            $_SESSION["user_usuario"] = $datosUsuario;
            
            $this->addLog('Login','Inicio Sesión Correctamente');
            return 200;
        }
        else
        {
            return 1;
        }
    }
    
    function cambiarClaveUsuario($clavenew)
    {
        $token = (isset($_SESSION["token_user"])) ? $_SESSION["token_user"] : "nofound";
        $sql = "UPDATE usuarios SET clave='$clavenew' WHERE token='$token'";
        
        return $this->sql_ejecutar($sql);
    }
}

