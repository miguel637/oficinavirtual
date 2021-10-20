<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url(); ?>lib/css/general.css">
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

<div class="row">
    <div class="col-4">
        <label for="">Requisición</label>
        <input aria-controls="requisicion" type="text" id="focu" placeholder="Buscar por Requisición" class="form-control buscarData">

    </div>
    <div class="col-4">
        <label for="">Convocatoria</label>
        <input aria-controls="convocatoria" type="text" placeholder="Buscar por Convocatoria" class="form-control buscarData">
    </div>

    <div class="col-4">
        <select id="filtropor" class="form-control">
            <option value="seleccionar">Seleccionar...</option>
            <option value="empresa">Empresa</option>
            <option value="sede">Sede</option>
            <option value="ciudad">Ciudad</option>
            <option value="departamento">Departamento</option>
            <option value="temporal">Temporal</option>
            <option value="cargo">Cargo</option>
            <option value="psicologo">Psicologo encargado</option>
        </select>
        <input aria-controls="specific" placeholder="Otros filtros" type="text" Class="form-control buscarData">
    </div>
</div>

<div class='text-center m-3 '>
    <span id="example-table-info"></span>
    <button id="download-xls" style="text-align:center;" class="btn btn-outline-secondary"><i class="fas fa-download"></i> Exportar excel</button>
</div>

<div id="table-rendered" class="mt-5"></div>

<?php
echo "<script>object = [];</script>";

$start = 0;
while ($start < 3000) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/CONVOCATORIAS_Report?privatelink=ekmSnPtQdADbeCkHG09kgQ7qvVzZUEHOxaX6631pJj7KmQk3NUHnvdqBv3R4G7KzFEqVOv65u6UkX5tpFTOvQSBw3TxBRk5TmRMK&ID_CONVOCATORIA=3000&ID_CONVOCATORIA_op=21&from=$start",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ));

    $start += 201;

    $result = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $manage = json_decode($result);
    if (isset($manage->data)) {

        foreach ($manage->data as $fila) {


            $id = $fila->ID;
            $codigo = str_replace("'",'"',$fila->Codigo_QR);
            $requi = $fila->REQUISICI_N->display_value;


            $convocatoria = $fila->ID_CONVOCATORIA;


            if (isset($fila->EMPRESA_USURIA->display_value)) {
                $empresa_usuaria = str_replace("'",'',$fila->EMPRESA_USURIA->display_value);
            } else {
                $empresa_usuaria = "";
            }

            $sede = $fila->Sede->display_value;
            $departamento = $fila->DEPARTAMENTO;
            $ciudad = $fila->CIUDAD;
            $temporal = $fila->TEMPORAL;
            $tipo_proceso = $fila->TIPO_DE_PROCESO;
            $cargo = (isset($fila->CARGO->display_value)) ? $fila->CARGO->display_value : "";
            $vacantes = $fila->VACANTES;
            $vacantes_activas = $fila->{"REQUISICI_N.VACANTES"};
            $salario = str_replace("'",".",$fila->SALARIO_ASIGNADO_MENSUAL);
            $beneficio_salarial = str_replace("'",".",$fila->BENEFICIO_SALARIAL_MENSUAL);
            $ben_nosalarial = $fila->BENEFICIO_NO_SALARIAL_MENSUAL;
            $edad_desde = $fila->EDAD_DESDE;
            $edad_hasta = $fila->EDAD_HASTA;
            $genero = $fila->GENERO;
            $clas_riego = $fila->{"CARGO.CLASIFICACION_DE_RIESGOS"};
            $tipo_contrato = (isset($fila->Tipo_de_Contrato->display_value)) ? $fila->Tipo_de_Contrato->display_value : "";
            $nivel_educativo = $fila->NIVEL_EDUCATIVO[0];
            $psicologo = (isset($fila->PSICOLOGO_ENCARGADO[0]->display_value)) ? $fila->PSICOLOGO_ENCARGADO[0]->display_value : "";

            $fecha_apro_rechaz = $fila->{"REQUISICI_N.FECHA_APROBADO_RECHAZADO"};
            $fecha_convocatoria = $fila->Added_Time;
            $fecha_cierre = $fila->FECHA_DE_CIERRE_DE_CONVOCATORIA;
            $tiempo_convocatoria = $fila->TIEMPO_DE_CONVOCATORIA_EN_DIAS;

            echo "<script>dto = {'id':'$id','Codigo_QR':'$codigo','REQUISICI_N':'$requi','ID_CONVOCATORIA':'$convocatoria','EMPRESA_USURIA':'$empresa_usuaria','Sede':'$sede','DEPARTAMENTO':'$departamento','CIUDAD':'$ciudad','TEMPORAL':'$temporal','TIPO_DE_PROCESO':'$tipo_proceso','CARGO':'$cargo','VACANTES':'$vacantes','vacantes_activas':'$vacantes_activas','SALARIO_ASIGNADO_MENSUAL':'$salario','BENEFICIO_SALARIAL_MENSUAL':'$beneficio_salarial','BENEFICIO_NO_SALARIAL_MENSUAL':'$ben_nosalarial','EDAD_DESDE':'$edad_desde','EDAD_HASTA':'$edad_hasta','GENERO':'$genero','CLASIFICACI_N_DE_RIESGOS':'$clas_riego','TIPO_DE_CONTRATO':'$tipo_contrato','PSICOLOGO_ENCARGADO':'$psicologo','FECHA_APROBADO_RECHAZADO':'$fecha_apro_rechaz','Added_Time':'$fecha_convocatoria','FECHA_DE_CIERRE_DE_CONVOCATORIA':'$fecha_cierre','TIEMPO_DE_CONVOCATORIA_EN_DIAS':'$tiempo_convocatoria','NIVEL_EDUCATIVO':'$nivel_educativo'};
                  object.push(dto);</script>";
        }
    }
}
?>

<script>
console.log(object);
    var viewButton = function(cell, formatterParams) { //plain text value
        return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
    };



    var table = new Tabulator("#table-rendered", {
        data: object,
        layout: "fitData",
        maxHeight: "92%",
        pagination: "local",
        paginationSize: 15,

        /*
    groupBy:function(data){
		
        return data.Estado;
    },
    groupHeader:function(value, count, data, group){
    //value - the value all members of this group share
    //count - the number of rows in this group
    //data - an array of all the row data objects in this group
    //group - the group component for the group

        return value + "<span style='color:#d00; margin-left:10px;'>("+count+")</span>";
    },

    */
        paginationSizeSelector: [15, 25, 50, 150,2600],
        columns: [
            {
                formatter: viewButton,
                headerSort: false,
                width: 100,
                hozAlign: "center",
                cellClick: function(e, cell) {

                    var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/CONVOCATORIAS_Report/" + cell.getRow().getData().id + "/ekmSnPtQdADbeCkHG09kgQ7qvVzZUEHOxaX6631pJj7KmQk3NUHnvdqBv3R4G7KzFEqVOv65u6UkX5tpFTOvQSBw3TxBRk5TmRMK";
                    window.open(link, '_blank');
                }
            },

            {
                title: "Código QR",
                width: "10px",
                field: "Codigo_QR"
            },
            {
                title: "ID REQUISICIÓN",
                field: "REQUISICI_N"
            },
            {
                title: "ID CONVOCATORIA",
                field: "ID_CONVOCATORIA"
            },
            {
                title: "Empresa Usuaria",
                field: "EMPRESA_USURIA"
            },
            {
                title: "Sede",
                field: "Sede"
            },
            {
                title: "Departamento",
                field: "DEPARTAMENTO"
            },
            {
                title: "Ciudad",
                field: "CIUDAD"
            },
            {
                title: "Temporal",
                field: "TEMPORAL"
            },
            {
                title: "Tipo de Proceso",
                field: "TIPO_DE_PROCESO"
            },
            {
                title: "Cargo",
                field: "CARGO"
            },
            {
                title: "Vacantes Solicitadas",
                field: "VACANTES"
            },
            {
                title: "Vacantes Activas",
                field: "vacantes_activas"
            },
            {
                title: "Salario Mensual Asignado",
                field: "SALARIO_ASIGNADO_MENSUAL"
            },
            {
                title: "Beneficio Salarial Mensual",
                field: "BENEFICIO_SALARIAL_MENSUAL"
            },
            {
                title: "Beneficio No Salarial Mensual",
                field: "BENEFICIO_NO_SALARIAL_MENSUAL"
            },
            {
                title: "Edad Desde",
                field: "EDAD_DESDE"
            },
            {
                title: "Edad Hasta",
                field: "EDAD_HASTA"
            },
            {
                title: "Genero",
                field: "GENERO"
            },
            {
                title: "Clasificación de Riesgos",
                field: "CLASIFICACI_N_DE_RIESGOS"
            },
            {
                title: "Tipo de Contrato",
                field: "TIPO_DE_CONTRATO"
            },
            {
                title: "Nivel Educativo",
                field: "NIVEL_EDUCATIVO"
            },
            {
                title: "Psicologo Encargado",
                field: "PSICOLOGO_ENCARGADO"
            },
            {
                title: "Fecha Aprobación-Rechazo Req",
                field: "FECHA_APROBADO_RECHAZADO"
            },
            {
                title: "Fecha Inicio Convocatoria",
                field: "Added_Time"
            },
            {
                title: "Fecha de Cierre Convocatoria",
                field: "FECHA_DE_CIERRE_DE_CONVOCATORIA"
            },
            {
                title: "Tiempo de Convocatoria en Días",
                field: "TIEMPO_DE_CONVOCATORIA_EN_DIAS"
            },




        ],


        langs: {
            "spanish": {
                "columns": {
                    "name": "Name", //replace the title of column name with the value "Name"
                },
                "ajax": {
                    "loading": "Loading", //ajax loader text
                    "error": "Error", //ajax error text
                },
                "groups": { //copy for the auto generated item count in group header
                    "item": "item", //the singular  for item
                    "items": "items", //the plural for items
                },
                "pagination": {
                    "page_size": "Por Pagina", //label for the page size select element
                    "page_title": "Show Page",
                    "first": "Primera", //text for the first page button
                    "first_title": "Primera Pagina", //tooltip text for the first page button
                    "last": "Ultima",
                    "last_title": "Ultima Pagina",
                    "prev": "Anterior",
                    "prev_title": "Pagina Anterior",
                    "next": "Siguiente",
                    "next_title": "Pagina Siguiente",
                    "all": "All",
                },
                "headerFilters": {
                    "default": "filter column...", //default header filter placeholder text
                    "columns": {
                        "name": "filter name...", //replace default header filter text for column name
                    }
                }
            }
        },
    });


    table.setLocale("spanish");

    var requisicion = "";
    var convocatoria = "";

    function filtrar(filtroEspecifico = {}) {
        table.setFilter([

            {
                field: "REQUISICI_N",
                type: "like",
                value: requisicion
            },
            {
                field: "ID_CONVOCATORIA",
                type: "like",
                value: convocatoria
            },
            filtroEspecifico,

        ]);
    }

    $(".buscarData").keyup(function() {
        $filter = $(this).val();
        $para = $(this).attr("aria-controls");
        if ($para == "requisicion") {
            requisicion = $filter;
        } else if ($para == "convocatoria") {
            convocatoria = $filter;
        } else if ($para == "specific") {
            $specific = $('#filtropor').val();

            sendToFiltrar = {};

            if ($specific == "empresa") {
                sendToFiltrar = {
                    field: "EMPRESA_USURIA",
                    type: "like",
                    value: $filter
                };
            }

            if ($specific == "sede") {
                sendToFiltrar = {
                    field: "Sede",
                    type: "like",
                    value: $filter
                };
            }

            if ($specific == "ciudad") {
                sendToFiltrar = {
                    field: "CIUDAD",
                    type: "like",
                    value: $filter
                };
            }

            if ($specific == "departamento") {
                sendToFiltrar = {
                    field: "DEPARTAMENTO",
                    type: "like",
                    value: $filter
                };
            }

            if ($specific == "temporal") {

                sendToFiltrar = {
                    field: "TEMPORAL",
                    type: "like",
                    value: $filter
                };
            }

            if ($specific == "cargo") {

                sendToFiltrar = {
                    field: "CARGO",
                    type: "like",
                    value: $filter
                };
            }

            if ($specific == "psicologo") {
                sendToFiltrar = {
                    field: "PSICOLOGO_ENCARGADO",
                    type: "like",
                    value: $filter
                };
            }
            filtrar(sendToFiltrar);
            return true;

        }
        filtrar();

    });


    $("#download-xls").on("click", function() {
        table.download("xlsx", "Seleccion_Ver_Convocatorias<?php echo date('d_m_Y'); ?>.xlsx", {
            sheetName: "Seleccion_Convocatorias"
        });
    });
</script>

<style>
    .tabulator-paginator label {
        visibility: hidden;
    }

    .tabulator-paginator label:after {
        content: 'Ver';
        visibility: visible;
    }
</style>