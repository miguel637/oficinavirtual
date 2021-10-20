<?php
$fila = 1;
if (($gestor = fopen("test.csv", "r")) !== FALSE) {
    while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
        $numero = count($datos);
        //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
        $fila++;
        for ($c=0; $c < $numero; $c++) {
            $url = "http://localhost/oficinaNew/sync_contratos.php";
            $postdata = http_build_query(
                array(
                    "contrato" => $datos[$c]
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
            
            $result = file_get_contents($url, false, $context);
            
            echo $result;
        }
    }
    fclose($gestor);
}
?>

