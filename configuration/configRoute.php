<?php

$requestTotal = $_SERVER['REQUEST_URI'];
$openRoute = str_replace(REPLACE_URL,'',$requestTotal);
$openRoute = explode("?",$openRoute)[0];

/*
$variableGlobalRouting = "";

if (!array_key_exists($openRoute, $routes)) {

    $rutaSplit = explode('/',$openRoute);        
    $counter = count($rutaSplit);        
    if($counter > 1)
    {
        $variableGlobalRouting = $rutaSplit[$counter-1];
        $openRoute = str_replace($rutaSplit[$counter-1],'(:any)',$openRoute);
    }
        


    if (!array_key_exists($openRoute, $routes)) {
        $openRoute = "error";
    }
}
*/

$finded = false;
foreach($routes as $key => $value)
{
    if($key == $openRoute)
    {
        $finded = true;

        $rutas = explode('/',$value);
       
        
        if(count($rutas) == 1) 
        {
            require URL_APP . '/controlador/'.$rutas[0].'Controller.php';
            if(isset($object)) $object->index();
        }
        else
        {
            require URL_APP . '/controlador/'.$rutas[0].'Controller.php';
            $funtionExec = $rutas[1];            
            if(method_exists($object,$funtionExec)) $object->$funtionExec();
            else die("no existe el metodo");
            
        }
        
    }
}

if(!$finded) 
{
    http_response_code(404);
    require URL_APP . '/controlador/errorController.php';
}