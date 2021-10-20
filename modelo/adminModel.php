<?php

class AdminModel extends CoreApp
{
    function cambiarClaveUsuario($token,$clavenew,$type = 0)
    {
        $sql = "UPDATE usuarios SET clave='$clavenew' WHERE id='$token' AND tipo_usuario=$type";
        
        return $this->sql_ejecutar($sql);
    }

    public function getAllUsers($tipo = 1)
    {
        $sql = "SELECT UI.id_usuario,U.user AS correo,U.clave,CASE U.tipo_usuario WHEN 1 THEN 'Administrador' WHEN 2 THEN 'Empresa' WHEN 3 THEN 'Empleado' END AS tipo_user,U.token AS ID_zoho,UI.nombres AS cliente,UI.telefono,UI.persona,UI.cargo,UI.codigoEmpresaZoho,UI.idEmpresaZoho FROM usuarios U INNER JOIN usuario_info UI ON U.id=UI.id_usuario WHERE U.tipo_usuario=$tipo";
        return $this->sql_seleccionar($sql);
    }

    public function listaModulosZoho($tipo_usuario)
    {
        $sql = "SELECT field_zoho FROM modulos WHERE tipo_usuario='$tipo_usuario' ORDER BY id";
        return $this->sql_seleccionar($sql);
    }

    public function agregarUserExec($user,$clave,$token,$estado,$tipo_usuario,$id_usuario,$nombres,$telefono,$persona,$cargo,$codigoEmpresaZoho,$idEmpresaZoho,$urlCarpetaDigital)
    {
        $sql_validate = "SELECT * FROM usuarios WHERE token='$token'";
        $result = $this->sql_seleccionar($sql_validate);
        if(count($result) == 0)
        {
            $sql = "INSERT INTO usuarios(user,clave,token,estado,tipo_usuario,usuario_creacion) VALUES('$user','$clave','$token','$estado','$tipo_usuario','$id_usuario')";
            $result = $this->sql_ejecutar($sql);
            if($result)
            {
                $id_inserted = $this->getLastId();
                $sql = "INSERT INTO usuario_info(id_usuario,nombres,telefono,persona,cargo,codigoEmpresaZoho,idEmpresaZoho,urlCarpetaDigital) VALUES($id_inserted,'$nombres','$telefono','$persona','$cargo','$codigoEmpresaZoho','$idEmpresaZoho','$urlCarpetaDigital')";
                $this->sql_ejecutar($sql);
                return "agregado";
            }
            else return false;
        }
        else
        {
            $estado = 'off';

            $id_usuario_sql = $result[0]["id"];

            $sql = "UPDATE usuarios SET user='$user',clave='$clave' WHERE id='$id_usuario_sql'";            
            $data1 = $this->sql_ejecutar($sql);

            $sql = "UPDATE usuario_info SET nombres='$nombres',telefono='$telefono',persona='$persona',cargo='$cargo',codigoEmpresaZoho='$codigoEmpresaZoho',idEmpresaZoho='$idEmpresaZoho',urlCarpetaDigital='$urlCarpetaDigital' WHERE id_usuario='$id_usuario_sql'";    
            $data2 = $this->sql_ejecutar($sql);

            if($data1 > 0) $estado = 'actualizado';
            if($data2 > 0) $estado = 'actualizado';

            return $estado;
        }
        
    }

    public function sincronizarModulos($token,$module,$tipo_usuario)
    {

        $sql = "SELECT * FROM modulos WHERE tipo_usuario='$tipo_usuario' ORDER BY id";
        $modulos = $this->sql_seleccionar($sql);

        $sql = "SELECT * FROM usuarios WHERE token='$token'";
        $user = $this->sql_seleccionar($sql);
        
        if(count($user) > 0) $id_usuario = $user[0]["id"];
        else return false;

        $i = 0;
        $entries = 0;
        foreach($modulos as $modulo)
        {
            $newState = $module[$i];

            $sql = "SELECT * FROM usuario_modulos WHERE id_usuario='$id_usuario' AND id_modulo=".$modulo["id"];
            $validator = $this->sql_seleccionar($sql);

            if(count($validator) > 0)
            {                
                $sqlnew = "UPDATE usuario_modulos SET estado=$newState WHERE id_usuario='$id_usuario' AND id_modulo=".$modulo["id"];
            }
            else
            {
                $sqlnew = "INSERT INTO usuario_modulos(id_usuario,id_modulo,estado) VALUES($id_usuario,".$modulo["id"].",$newState)";
            }

            $data = $this->sql_ejecutar($sqlnew);
            if($data > 0) $entries++;

            $i++;
        }
        return $entries;
    }

    public function agregarMisionalExec($user,$clave,$token,$estado,$tipo_usuario,$id_usuario,$nombres,$telefono,$persona,$cargo,$codigoEmpresaZoho,$idEmpresaZoho)
    {
        $sql_validate = "SELECT * FROM usuarios WHERE token='$token'";
        
        $result = $this->sql_seleccionar($sql_validate);
        if(count($result) == 0)
        {
            $sql = "INSERT INTO usuarios(user,clave,token,estado,tipo_usuario,usuario_creacion) VALUES('$user','$clave','$token','$estado','$tipo_usuario','$id_usuario')";
            $result = $this->sql_ejecutar($sql);
            if($result)
            {
                $id_inserted = $this->getLastId();
                $sql = "INSERT INTO usuario_info(id_usuario,nombres,telefono,persona,cargo,codigoEmpresaZoho,idEmpresaZoho) VALUES($id_inserted,'$nombres','$telefono','$persona','$cargo','$codigoEmpresaZoho','$idEmpresaZoho')";
                $this->sql_ejecutar($sql);
                return "agregado";
            }
            else return false;
        }
        else
        {
            $estado = 'off';

            $id_usuario_sql = $result[0]["id"];

            $sql = "UPDATE usuarios SET user='$user' WHERE id='$id_usuario_sql'";            
            $data1 = $this->sql_ejecutar($sql);

            $sql = "UPDATE usuario_info SET nombres='$nombres',telefono='$telefono',persona='$persona',cargo='$cargo',codigoEmpresaZoho='$codigoEmpresaZoho',idEmpresaZoho='$idEmpresaZoho' WHERE id_usuario='$id_usuario_sql'";            
            $data2 = $this->sql_ejecutar($sql);

            if($data1 > 0) $estado = 'actualizado';
            if($data2 > 0) $estado = 'actualizado';

            return $estado;
        }
        
    }
    public function agregarPracticanteExec($user,$clave,$token,$estado,$tipo_usuario,$id_usuario,$nombres,$telefono,$persona,$cargo)
    {
        $sql_validate = "SELECT * FROM usuarios WHERE token='$token' LIMIT 1";
        
        $result = $this->sql_seleccionar($sql_validate);
        if(count($result) == 0)
        {
            $sql = "INSERT INTO usuarios(user,clave,token,estado,tipo_usuario,usuario_creacion) VALUES('$user','$clave','$token','$estado','$tipo_usuario','$id_usuario')";
            $result = $this->sql_ejecutar($sql);
            if($result)
            {
                $id_inserted = $this->getLastId();
                $sql = "INSERT INTO usuario_info(id_usuario,nombres,telefono,persona,cargo) VALUES($id_inserted,'$nombres','$telefono','$persona','$cargo')";

                $this->sql_ejecutar($sql);
                return "agregado";
            }
            else return false;
        }
        else
        {
            $estado = 'off';

            $id_usuario_sql = $result[0]["id"];

            $sql = "UPDATE usuarios SET user='$user',clave='$clave' WHERE id='$id_usuario_sql'";            
            $data1 = $this->sql_ejecutar($sql);

            $sql = "UPDATE usuario_info SET nombres='$nombres',telefono='$telefono',persona='$persona',cargo='$cargo' WHERE id_usuario='$id_usuario_sql'";
            $data2 = $this->sql_ejecutar($sql);

            if($data1 > 0) $estado = 'actualizado';
            if($data2 > 0) $estado = 'actualizado';

            return $estado;
        }
        
    }
}
