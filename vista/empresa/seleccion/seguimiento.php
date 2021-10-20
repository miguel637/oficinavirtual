<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url(); ?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

<div class="row">

  <div class="col-4">
    <label for="">Convocatoria</label>
    <input aria-controls="convocatoria" type="text" placeholder="Buscar por convocatoria" class="form-control buscarData">
  </div>
  <div class="col-4">
    <label for="">Requisición</label>
    <input aria-controls="requisicion" type="text" placeholder="Buscar por requisicion" class="form-control buscarData">
  </div>
  <div class="col-4">
    <select id="filtropor" class="form-control">
      <option value="seleccionar">Seleccionar...</option>
      <option value="nombres">Nombres y apellidos</option>
      <option value="numero_identificacion">Número de documento</option>
      <option value="psicologo_encargado">Psicologo</option>
      <option value="cargo">Cargo</option>
    </select>
    <input aria-controls="specific" type="text" Class="form-control buscarData">
  </div>
</div>

<div class='text-center m-3 '>
  <span id="example-table-info"></span>
  <button id="download-xls" style="position:absolute; right:4%;" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Exportar excel</button>
</div>

<div id="table-rendered" class="mt-5"></div>

<?php


echo "<script>object = [];</script>";

$start = 0;
while ($start < 1001) {

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/OV_Postulados_Clientes?privatelink=7HTK7R8fgE3vKd58W9af4BFOSuNSsC2GtO7dvpWhk2gu1wFJNZKgwSa3FYT0Cb7m84JdYKK0RrVdFTXjnqst7VFNy4OuGJVdEUxg&CONVOCATORIAS_APLICAR_CONVOCATORIA.ESTADO=ACTIVO&from=$start&EMPRESA_APLICAR_CONVOCATORIA.ID=" . $_SESSION["idEmpresa_user"];

  $start += 200;


  $opts = array(
    'http' =>
    array(
      'method'  => 'GET'

    )
  );

  $context = stream_context_create($opts);

  $result = @file_get_contents($url, false, $context);
  $manage = json_decode($result);


  if (isset($manage->data)) {

    foreach ($manage->data as $fila) {

      $requi = $fila->{'CONVOCATORIAS_APLICAR_CONVOCATORIA.REQUISICI_N'};
      $estado = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.ESTADO"};
      $cargo = $fila->CARGO_APLICAR_CONVOCATORIA->display_value;
      $empresa = $fila->EMPRESA_APLICAR_CONVOCATORIA->display_value;
      $convocatoria = $fila->CONVOCATORIAS_APLICAR_CONVOCATORIA->display_value;
      $nombres = $fila->NOMBRES_Y_APELLIDOS->display_value;

      if (isset($fila->PSICOLOGO->display_value))

        $psicologo = $fila->PSICOLOGO->display_value;

      else
        $psicologo = "";


      $requisicion = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.REQUISICI_N"};
      $id = $fila->ID;
      $validado_examenes = $fila->Validado_Examen_Con_Concepto;


      echo "<script>dto = {'Requisicion_id':'$requi','ESTADO':'$estado','Cargo':'$cargo','Estado_Postulacion':'$fila->Estado_Postulacion','EMPRESA':'$empresa','CONVOCATORIAS_APLICAR_CONVOCATORIA':'$convocatoria','NOMBRES_Y_APELLIDOS':'$nombres','DOCUMENTO':'$fila->DOCUMENTO','PSICOLOGO':'$psicologo','Requisicion_id':'$requisicion','fecha_creacion':'$fila->Added_Time','id':'$id','validacion_examenes':'$validado_examenes'};</script>";
      echo "<script>object.push(dto);</script>";
    }
  }
}
?>
<script>
  var viewButton = function(cell, formatterParams) { //plain text value
    return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
  };





  var table = new Tabulator("#table-rendered", {
    data: object,
    layout: "fitData",
    maxHeight: "92%",
    pagination: "local",
    paginationSize: 15,

    groupBy: function(data) {


      return data.ESTADO + " - " + data.Cargo + " - " + data.Requisicion_id;

    },
    groupHeader: function(value, count, data, group) {


      //value - the value all members of this group share
      //count - the number of rows in this group
      //data - an array of all the row data objects in this group
      //group - the group component for the group

      return value + "<span style='color:#d00; margin-left:10px;'>(" + count + ")</span>";
    },

    paginationSizeSelector: [15, 25, 50, 100],
    columns: [


      {
        formatter: viewButton,
        headerSort: false,
        width: 100,
        hozAlign: "center",
        cellClick: function(e, cell) {

          var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/OV_Postulados_Clientes/" + cell.getRow().getData().id + "/7HTK7R8fgE3vKd58W9af4BFOSuNSsC2GtO7dvpWhk2gu1wFJNZKgwSa3FYT0Cb7m84JdYKK0RrVdFTXjnqst7VFNy4OuGJVdEUxg";
          window.open(link, '_blank');
        }
      },



      {
        title: "Estado",
        field: "Estado_Postulacion"
      },
      {
        title: "Empresa",
        field: "EMPRESA"
      },
      {
        title: "Convocatoria",
        field: "CONVOCATORIAS_APLICAR_CONVOCATORIA"
      },
      {
        title: "Nombres y apellidos",
        field: "NOMBRES_Y_APELLIDOS"
      },
      {
        title: "Numero identificacion",
        field: "DOCUMENTO"
      },
      {
        title: "Psicologo",
        field: "PSICOLOGO"
      },
      {
        title: "ID Requisicion",
        field: "Requisicion_id"
      },
      {
        title: "Creada",
        field: "fecha_creacion"
      },
      {
        title: "Cargo",
        field: "Cargo"
      },
      {
        title: "Validado con Concepto",
        field: "validacion_examenes"
      },
    ],

    langs: {
      "colombinos": {
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


  table.setLocale("colombinos");


  var filtro_cedula = "";
  var filtro_fecha = "";

  function filtrar(filtroEspecifico = {}) {
    table.setFilter([

      {
        field: "CONVOCATORIAS_APLICAR_CONVOCATORIA",
        type: "like",
        value: filtro_cedula
      },
      {
        field: "Requisicion_id",
        type: "like",
        value: filtro_fecha
      },
      filtroEspecifico,

    ]);
  }

  $(".buscarData").keyup(function() {
    $filter = $(this).val();
    $para = $(this).attr("aria-controls");
    if ($para == "convocatoria") {
      filtro_cedula = $filter;
    } else if ($para == "requisicion") {
      filtro_fecha = $filter;
    } else if ($para == "specific") {
      $specific = $('#filtropor').val();

      sendToFiltrar = {};

      if ($specific == "nombres") {
        sendToFiltrar = {
          field: "NOMBRES_Y_APELLIDOS",
          type: "like",
          value: $filter
        };
      }

      if ($specific == "numero_identificacion") {
        sendToFiltrar = {
          field: "DOCUMENTO",
          type: "like",
          value: $filter
        };
      }

      if ($specific == "psicologo_encargado") {
        sendToFiltrar = {
          field: "PSICOLOGO",
          type: "like",
          value: $filter
        };
      }


      if ($specific == "cargo") {

        sendToFiltrar = {
          field: "Cargo",
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
    table.download("xlsx", "Seguimiento_<?php echo date('d_m_Y'); ?>.xlsx", {
      sheetName: "ANS_Seguimiento"
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



  #download-xls:hover {

    background-color: #FF4C26;
    color: white;
    border-color: #FF4C26;


  }
</style>