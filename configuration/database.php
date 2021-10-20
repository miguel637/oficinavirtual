<?php

class Database
{
    
    public $settings;
    public $conexion;
    public $query;
    public $error;
    public $last_id;

	function getSettings()
	{
		// variables de base de datos
		// Nombre de Host
		$this->settings['host'] = 'localhost';
		// Nombre base de datos
		$this->settings['base'] = 'oficina';
		// Nombre de usuario
		$this->settings['usuario'] = 'root';
		// Contraseña
		$this->settings['pass'] = '';
		
		return $this->settings;
	}

    
    function open() {
        
        // Cargar configuracion del modelo base de datos
        $settings = $this->getSettings();
                    
        // obtener el array del modelo
        $host = $settings['host'];
        $usuario = $settings['usuario'];
        $pass = $settings['pass'];
        $base = $settings['base'];

        $mysqli = new mysqli($host, $usuario, $pass, $base);
        $mysqli->set_charset("utf8");
        if ($mysqli->connect_errno) {
            $this->error = "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            $this->conexion = false;
        }
        else
            $this->conexion = $mysqli;
    }

    function getLastId()
    {
        return $this->last_id;
    }

    function sql_ejecutar($query)
    {
        $this->open();
        $this->conexion->query($query);
        $this->last_id = $this->conexion->insert_id;      
        $retorno = $this->conexion->affected_rows;
        $this->close();
        return $retorno;
    }

    function sql_seleccionar($query)
    {
        $this->open();

        $resultado = $this->conexion->query($query);
        if($resultado)
        {
            $retorno = [];
            while($row = $resultado->fetch_assoc())
            {$retorno[] = $row;}
        }            
        else $retorno = [];

        $this->close();

        return $retorno;

    }

    function errors()
    {
        return $this->error;
    }

    function close()
    {
        $this->conexion->close();
    }

}