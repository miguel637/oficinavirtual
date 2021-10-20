<?php

    set_time_limit(4000);

    $serverName = "192.168.1.198\SQLEXPRESS";
    $connectionInfo = array( "Database"=>"HQ5", "UID"=>"prueba", "PWD"=>"POLO2020**", 'CharacterSet' => 'UTF-8' );
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    if( $conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    $results_inyection = [];

    if((isset($_POST["dia"]) && isset($_POST["mes"])) || isset($_POST["contrato"]))
    {

        if(isset($_POST["contrato"]))
        {
            $contrato_search = $_POST["contrato"];
            $filtro = "nc.Contrato = '$contrato_search'";
        }
        else
        {
            $dia_search = $_POST["dia"];
            $mes_search = $_POST["mes"];
            $filtro = "sl.inserted_date > DATEFROMPARTS (2021, $mes_search, $dia_search)";
        }

        $sqlFirst = "SELECT Distinct nc.Contrato FROM nom_contrato nc INNER JOIN sc_log sl 
        ON nc.Contrato=CONVERT(INT,REPLACE(SUBSTRING(sl.description,25,6),'|','')) 
        AND sl.application='form_contrato_070201' AND sl.action='update'
        WHERE $filtro";

        $queryExec = sqlsrv_query( $conn, $sqlFirst );
        if( $queryExec === false) {
            die( print_r( sqlsrv_errors(), true) );
        }

        $sqlContratos = [];
        while( $row = sqlsrv_fetch_array( $queryExec, SQLSRV_FETCH_ASSOC) ) {

            $contrato_search = $row["Contrato"];
            $contratoSearch = " AND t0.Contrato = '$contrato_search'";

            $sql = "SELECT t0.Contrato as numero_contrato,CASE t0.Estado WHEN 1 THEN 'ACTIVO' ELSE 'RETIRADO' END AS estado_contrato, 
            CASE t0.Id_empresa WHEN 2 THEN 'HQ5 S.A.S' WHEN 5 THEN 'UT COLTEMP-HQ5' WHEN 4 THEN 'TECNOGESTION FD S.A.S' WHEN 3 THEN 'TEMPOENLACE S.A.S' END AS est,
            t1.Tipo_Documento,
            t1.nit AS documento,t1.Primer_Apellido,t1.Segundo_Apellido,t1.Primer_Nombre,t1.Segundo_Nombre,t1.Tipo_Tercero,
            t1.Telefono,t1.Celular, t1.mail as correo,t1.Fecha_Nacimiento
            ,t1.Estado_Civil,t1.Sexo,'Colombia' as pais,
            t1.Departamento,t2.Ciudad,t1.Direccion,t0.Nomina,t0.tipo_contrato,t0.Sabado_habil,t5.Descripcion as centro, t0.Fecha_firma_contrato,
            t3.descripcion as empresa,t4.Cargo as cargo,t0.Fecha_Ingreso as fecha_ingreso,
            t0.Fecha_Retiro,t0.Modalidad_Pago,t0.Tipo_Cuenta,t6.Descripcion as banco,t0.Nro_cuenta,
            t0.Basico as basico,t1.Sexo as sexo, t0.Auxilio_Transporte as auxilio,eps.Descripcion as eps,
            afp.Descripcion as afp,arl.Descripcion as arl,caja.Descripcion as caja,educacion.Nivel_educativo as educacion,
            t0.Estado as estado,t0.Porcentaje_adicional,t0.Fecha_radicacion_eps,t0.Sena,t0.Icbf,t0.Sucursal_Aportes,
            t0.Porcentaje_arp as riesgo_arl,t0.Fecha_afiliacion_arl,t0.Fecha_radicacion_cajacomp,t0.Metodo_Retencion,
            t0.Salud_descontada,t0.Salud_prepagada,t0.Declarante_renta,t0.Porcentaje_Retencion,t0.Vivienda,
            t0.Dependientes, t0.Dependientes_porc ,t7.Descripcion as tipo_cotizante,t8.Descripcion as subtipo_cotizante,
            t0.extranjero as valor1,t0.Colombiano_residente as valor2,t0.Fecha_Retiro,t0.Fecha_Final
            FROM nom_contrato t0
            INNER JOIN mtra_terceros t1 ON t0.Nit=t1.nit
            LEFT JOIN mtra_ciudad t2 ON t1.Ciudad=t2.Ciudad
            INNER JOIN nom_nomina t3 ON t0.Nomina=t3.nomina
            INNER JOIN nom_contrato_cargo t4 ON t0.cargo=t4.Id_cargo
            INNER JOIN nom_centro t5 ON t0.Centro=t5.Centro
            LEFT JOIN mtra_banco t6 ON t0.Banco_Cuenta=t6.Banco
            LEFT JOIN nom_contrato_cotizante t7 ON t0.Tipo_cotizante=t7.Tipo_cotizante
            LEFT JOIN nom_contrato_subtipo_cotizante t8 ON t0.Subtipo_cotizante=t8.Subtipo_cotizante
            LEFT JOIN nom_fondo eps ON t0.Salud=eps.Fondo
            LEFT JOIN nom_fondo afp ON t0.Pension=afp.Fondo
            LEFT JOIN nom_fondo arl ON t0.Arp=arl.Fondo
            LEFT JOIN nom_fondo caja ON t0.Caja_Compensacion=caja.Fondo
            LEFT JOIN nom_contrato_educacion educacion ON t0.Educacion=educacion.Id
            WHERE /*t0.Nomina='194' AND */ t0.Id_empresa=t3.Id_empresa $contratoSearch
            ORDER BY t1.Nombres_completos";
            array_push($sqlContratos,$sql);
        }

        
        if(count($sqlContratos) > 0)
        {
            include('configuration/database.php');
            $db = new Database();

            foreach($sqlContratos as $fila)
            {
                $stmt = sqlsrv_query( $conn, $fila );
                if( $stmt === false) {
                    die( print_r( sqlsrv_errors(), true) );
                }

                while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
                    
                    $url = "https://creator.zoho.com/api/hq5colombia/json/contratos-n-mina/form/Contrato/record/add";
                    $urlToUpdate = "https://creator.zoho.com/api/hq5colombia/json/contratos-n-mina/view/Contrato_Report/record/update";

                    $Numero_de_Contrato = $row["numero_contrato"];
                    $Estado = $row["estado_contrato"];
                    $EST = $row["est"];
                    $tipo_documento_contrato = $row["Tipo_Documento"];
                        if($tipo_documento_contrato == 1) $Tipo_Documento = "CEDULA DE CIUDADANIA";
                        else if($tipo_documento_contrato == 4) $Tipo_Documento = "CEDULA DE EXTRANJERIA";
                        else if($tipo_documento_contrato == 8) $Tipo_Documento = "PERMISO ESPECIAL DE PERMANENCIA";
                        else if($tipo_documento_contrato == 5) $Tipo_Documento = "PASAPORTE";
                        else $Tipo_Documento = "N/A";
                    $Numero_de_documento = $row["documento"];
                    $Primer_Apellido = $row["Primer_Apellido"];
                    $Primer_Nombre = $row["Primer_Nombre"];
                    $Telefono = $row["Telefono"];
                    $Correo_Electronico = (filter_var($row["correo"], FILTER_VALIDATE_EMAIL)) ? $row["correo"] : "";
                    $Estado_Civil_tercero = $row["Estado_Civil"];
                        if($Estado_Civil_tercero == 1) $Estado_Civil = "SOLTERO(A)";
                        else if($Estado_Civil_tercero == 2) $Estado_Civil = "CASADO(A)";
                        else if($Estado_Civil_tercero == 3) $Estado_Civil = "UNION LIBRE";
                        else if($Estado_Civil_tercero == 4) $Estado_Civil = "VIUDO(A)";
                        else if($Estado_Civil_tercero == 5) $Estado_Civil = "SEPARADO(A)";
                        else $Estado_Civil = "N/A";
                    $Segundo_Apellido = $row["Segundo_Apellido"];
                    $Segundo_Nombre = $row["Segundo_Nombre"];
                    $Celular = (is_numeric($row["Celular"])) ? $row["Celular"] : "";
                    $Fecha_Nacimiento = ($row["Fecha_Nacimiento"] != null && $row["Fecha_Nacimiento"] != '') ? date_format($row["Fecha_Nacimiento"],'d-M-Y') : "";
                    $Sexo = ($row["Sexo"] == 'F') ? 'FEMENINO' : 'MASCULINO';
                    $Direccion = $row["Direccion"];
                    $Nomina = $row["Nomina"];
                    $Salario_Basico = number_format($row["basico"],0,'.','');
                    $Dependencia = $row["empresa"];
                    $Fecha_Ingreso =  ($row["fecha_ingreso"] != null && $row["fecha_ingreso"] != '') ? date_format($row["fecha_ingreso"],'d-M-Y') : "";
                    $Auxilio_de_Transporte = ($row["auxilio"] == 1) ? 'SI' : 'NO';
                    $Centro = $row["centro"];
                    $Sabado_Habil = ($row["Sabado_habil"] == 1) ? 'SI' : 'NO';
                    $Fecha_Firma_Contrato = ($row["Fecha_firma_contrato"] != null && $row["Fecha_firma_contrato"] != '') ? date_format($row["Fecha_firma_contrato"],'d-M-Y') : "";
                    $Cargo_contratado = $row["cargo"];
                    $Modalidad_de_Pago = "CONSIGNACIÓN";
                    $Tipo_de_Cuenta = ($row["Tipo_Cuenta"] == 1) ? 'AHORROS' : 'CORRIENTE';
                    $Bancos = $row["banco"];
                    $Numero_de_Cuenta = $row["Nro_cuenta"];
                    $Salud = $row["eps"];
                    $Caja_Compensacion = $row["caja"];
                    $ARL = $row["arl"];
                    $Porcentaje_Adicional = $row["Porcentaje_adicional"];
                    $Fecha_radicacion_EPS = ($row["Fecha_radicacion_eps"] != null && $row["Fecha_radicacion_eps"] != '') ? date_format($row["Fecha_radicacion_eps"],'d-M-Y') : "";
                    $Sena = $row["Sena"];
                    $Sucursal_Aportes = $row["Sucursal_Aportes"];
                    $Pension = $row["afp"];
                    $Cesantias = $row["afp"];
                    $Riesgo_ARL = number_format($row["riesgo_arl"],0);
                    $Fecha_afiliacion_ARL = ($row["Fecha_afiliacion_arl"] != null && $row["Fecha_afiliacion_arl"] != '') ? date_format($row["Fecha_afiliacion_arl"],'d-M-Y') : "";
                    $Fecha_radic_caja_compensaci_n = ($row["Fecha_radicacion_cajacomp"] != null && $row["Fecha_radicacion_cajacomp"] != '') ? date_format($row["Fecha_radicacion_cajacomp"],'d-M-Y') : "";
                    $Icbf = $row["Icbf"];
                    $Metodo_de_Retencion = $row["Metodo_Retencion"];
                    $Salud_Descontada = number_format($row["Salud_descontada"],2);
                    $Salud_Prepagada_poliza_seguros = number_format($row["Salud_prepagada"],2);
                    $Declarante_de_Renta = ($row["Declarante_renta"] == 1) ? 'Si' : 'No';
                    $Porcentaje_Retencion = $row["Porcentaje_Retencion"];
                    $Vivienda = number_format($row["Vivienda"],0);
                    $Dependientes = $row["Dependientes"];
                    $Dependientes_Porc = $row["Dependientes_porc"];
                    $Tipo_Cotizante = $row["tipo_cotizante"];
                    $Valor_1 = $row["valor1"];
                    $Concepto_Cotizante = $row["subtipo_cotizante"];
                    $Valor_2 = $row["valor2"];
                    $Fecha_Retiro = ($row["Fecha_Retiro"] != null && $row["Fecha_Retiro"] != '') ? date_format($row["Fecha_Retiro"],'d-M-Y') : "";
                    $Fecha_Final =($row["Fecha_Final"] != null && $row["Fecha_Final"] != '') ? date_format($row["Fecha_Final"],'d-M-Y') : "";

                    $result_dpto = $db->sql_seleccionar("SELECT * FROM maestro_departamento WHERE id_departamento=".$row["Departamento"]);
                    $departamento_contrato = (isset($result_dpto[0]["departamento"])) ? $result_dpto[0]["departamento"] : "BOGOTA";

                    $result_city = $db->sql_seleccionar("SELECT * FROM maestro_ciudad WHERE id_ciudad_fisoft=".$row["Ciudad"]);
                    $ciudad_contrato = (isset($result_city[0]["ciudad"])) ? $result_city[0]["ciudad"] : "BOGOTA, D.C.";
                    
                    $postdata = http_build_query(
                        array(
                            "authtoken" => "530bbb13d105c9ddffe00f5d794c09ad",
                            "scope" => "creatorapi",
                            "criteria" => "Numero_de_Contrato == ".$Numero_de_Contrato,
                            "Numero_de_Contrato" => $Numero_de_Contrato,
                            "Estado" => $Estado,
                            "EST" => $EST,
                            "Tipo_Documento" => $Tipo_Documento,
                            "Tipo_de_Tercero" => "Empleado",
                            "Numero_de_documento" => $Numero_de_documento,
                            "Primer_Apellido" => $Primer_Apellido,
                            "Primer_Nombre" => $Primer_Nombre,
                            "Telefono" => $Telefono,
                            "Correo_Electronico" => $Correo_Electronico,
                            "Estado_Civil" => $Estado_Civil,
                            "Pais" => "Colombia",
                            "Ciudad" => $ciudad_contrato,
                            "Segundo_Apellido" => $Segundo_Apellido,
                            "Segundo_Nombre" => $Segundo_Nombre,
                            "Celular" => $Celular,
                            "Fecha_Nacimiento" => $Fecha_Nacimiento,
                            "Sexo" => $Sexo,
                            "Departamento" => $departamento_contrato,
                            "Direccion" => $Direccion,
                            "Nomina" => $Nomina,
                            "Cesion_Contrato" => "No",
                            "Orden_Contratacion" => "",
                            "Tipo_de_salario" => "VARIABLE",
                            "Salario_Basico" => $Salario_Basico,
                            "Bonificacion_No_Prestacional" => 0,
                            "Basico" => '$'.number_format($Salario_Basico,0),
                            "Dependencia" =>  $Dependencia,
                            "Jornada" => "NORMAL",
                            "Fecha_Ingreso" => $Fecha_Ingreso,
                            "Nro_Contrato_Cesion" => 0,
                            "Tipo_Contrato" => "OBRA LABOR",
                            "Tipo_de_Jornada" => "NORMAL",
                            "Auxilio_de_Transporte" => $Auxilio_de_Transporte,
                            "Centro" => $Centro,
                            "Sabado_Habil" => $Sabado_Habil,
                            "Fecha_Firma_Contrato" => $Fecha_Firma_Contrato,
                            "Pais_Ubicacion" => "Colombia",
                            "Ciudad_o_Municipio" => $ciudad_contrato,
                            "Departamento_Ubicacion" => $departamento_contrato,
                            "Cargo_contratado" => $Cargo_contratado,
                            "Modalidad_de_Pago" => $Modalidad_de_Pago,
                            "Tipo_de_Cuenta" => $Tipo_de_Cuenta,
                            "Bancos" => $Bancos,
                            "Numero_de_Cuenta" => $Numero_de_Cuenta,
                            "Salud" => $Salud,
                            "Caja_Compensacion" => $Caja_Compensacion,
                            "ARL" => $ARL,
                            "Porcentaje_Adicional" => $Porcentaje_Adicional,
                            "Fecha_radicacion_EPS" => $Fecha_radicacion_EPS,
                            "Sena" => $Sena,
                            "Sucursal_Aportes" => $Sucursal_Aportes,
                            "Pension" => $Pension,
                            "Cesantias" => $Cesantias,
                            "Riesgo_ARL" => $Riesgo_ARL,
                            "Fecha_afiliacion_ARL" => $Fecha_afiliacion_ARL,
                            "Fecha_radic_caja_compensaci_n" => $Fecha_radic_caja_compensaci_n,
                            "Icbf" => $Icbf,
                            "Metodo_de_Retencion" => $Metodo_de_Retencion,
                            "Salud_Descontada" => $Salud_Descontada,
                            "Salud_Prepagada_poliza_seguros" => $Salud_Prepagada_poliza_seguros,
                            "Declarante_de_Renta" => $Declarante_de_Renta,
                            "Porcentaje_Retencion" => $Porcentaje_Retencion,
                            "Vivienda" => $Vivienda,
                            /*"Dependientes" => $Dependientes,*/
                            "Dependientes_Porc" => $Dependientes_Porc,
                            "Tipo_Cotizante" => $Tipo_Cotizante,
                            "Valor_1" => $Valor_1,
                            "Concepto_Cotizante" => $Concepto_Cotizante,
                            "Valor_2" => $Valor_2,
                            "Fecha_Final" => $Fecha_Final,
                            "Fecha_Retiro" => $Fecha_Retiro
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
                    $data_json = json_decode($result);

                    $info = "Contrato: ".$data_json->formname[1]->operation[1]->values->Numero_de_Contrato."<br/>Documento:".$data_json->formname[1]->operation[1]->values->Numero_de_documento;
                    $status = $data_json->formname[1]->operation[1]->status;

                    if($status == "Failure, This value already exists. Enter a unique value.") 
                    {

                        $result = file_get_contents($urlToUpdate, false, $context);
                        $data_json = json_decode($result);

                        $status = "Updated";
                    }

                    $valores_response = array("info" => $info,"status" => $status);
                    
                    array_push($results_inyection, $valores_response);
                }
            }
        }

    }

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Actualizar Contratos</title>
  </head>
  <body>

  <div id='spinnerContainer' class="d-none justify-content-center">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

     <div class="container">
        <div class="row">
            <div class="col-8 offset-2 py-4">
                <div class='text-center'><h3>Sincronización Contratos</h3></div>
                
                <?php if(count($results_inyection) == 0)
                {
                    ?>
                    <form action="#" method="POST">
                        <div class="row text-center p-2">
                            <div class="col-12">Mayor a esta fecha</div>
                            <div class="col-4">
                                <label for="Dia">Dia</label>
                                <input type="number" name='dia' class="form-control" placeholder='' min='0' max='31' required> 
                            </div>
                            <div class="col-4">
                                <label for="Mes">Mes</label>
                                <input type="number" name='mes' class="form-control" placeholder='' min='0' max='12' required> 
                            </div>
                            <div class="col-4">
                                <br>
                                <button class='btn btn-success sincronizar'>Sincronizar</button>
                            </div>
                        </div>
                    </form>
                    <form action="#" method="POST">
                        <div class="row text-center p-2">
                            <div class="col-12">Por Contrato</div>
                            <div class="col-8">
                                <label for="Contrato">Numero de contrato</label>
                                <input type="number" name='contrato' class="form-control" placeholder='' min='0' max='999999' required> 
                            </div>
                            <div class="col-4">
                                <br>
                                <button class='btn btn-success sincronizar'>Sincronizar Contrato</button>
                            </div>
                        </div>
                    </form>
                    <?php
                }
                ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Info</th>
                            <th scope="col">Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            $i = 1;
                            foreach($results_inyection as $fila)
                            {
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $i;?></th>
                                    <td><?php echo $fila["info"];?></td>
                                    <td><?php echo $fila["status"];?></td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>                
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    

   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>

<script>
    $(document).ready(function(){
        $('.sincronizar').click(function(){
            $('#spinnerContainer').removeClass('d-none');
            $('#spinnerContainer').addClass('d-flex');
        });
    });
</script>