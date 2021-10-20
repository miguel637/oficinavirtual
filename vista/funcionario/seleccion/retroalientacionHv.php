

<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
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
            <option value="documento">Documento</option>
            <option value="empresa">Empresa</option>
            <option value="reclutador">Analista Reclutamiento</option>
   
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
    

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/subform_retroalimentacion_hv_Report?privatelink=wK17r45gDHJ91v6JZX3mXGAq3BWGKgESjdBpZmTqmasXuyr5M1W6PKYzvMTXr5t6Kn7QqCrzKZQ0DRmp2MuzXr1C2k3E8aCpKDbf",


        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
      ));
		
      $result = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      $manage = json_decode($result);
      if(isset($manage->data))
      {

        foreach($manage->data as $fila)
        {

       
          $id = $fila->ID;
          $requi = $fila->{"Documento.REQUISICION_RELATED"};
          $convo = $fila->{"Documento.CONVOCATORIAS_APLICAR_CONVOCATORIA"};
          $reclutamiento = $fila->{"Documento.AUXILIAR_PSICOLOGO"};
          $empresa = $fila->{"Documento.EMPRESA_APLICAR_CONVOCATORIA"};
          $cargo = $fila->{"Documento.CARGO_APLICAR_CONVOCATORIA"};
          $documento = $fila->Documento->display_value;
          $nombreApellidos = $fila->Nombre->display_value;
          $retro = $fila->Retroalimentaci_n;
          $motivo = $fila->Motivo;
          $observaciones = $fila->Observaciones;
          $fecha_retroalimentacion = $fila->Added_Time;
           
          echo "<script>dto = {'id':'$id','requisicion':'$requi','convocatoria':'$convo','reclutador':'$reclutamiento','empresa':'$empresa','cargo':'$cargo','documento':'$documento','nombres':'$nombreApellidos','retro':'$retro','motivo':'$motivo','observacion':'$observaciones','fecha':'$fecha_retroalimentacion'};
          object.push(dto);</script>";
    
        }
      } 
  
    ?>
    
    <script>
    
        var viewButton = function(cell, formatterParams){ //plain text value
                return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
        };
        var table = new Tabulator("#table-rendered", {
        data:object,
        layout:"fitData",
        maxHeight:"92%",
        pagination:"local",
        paginationSize:15,
    
      
        groupBy:function(data){
            
            return data.convocatoria;
        },
        groupHeader:function(value, count, data, group){
        //value - the value all members of this group share
        //count - the number of rows in this group
        //data - an array of all the row data objects in this group
        //group - the group component for the group
    
            return value + "<span style='color:#d00; margin-left:10px;'>("+count+")</span>";
        },
    
        
        paginationSizeSelector:[15, 25, 50, 110],
         columns:[
    
    
            {formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){
    
                var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/subform_retroalimentacion_hv_Report/" + cell.getRow().getData().id + "/wK17r45gDHJ91v6JZX3mXGAq3BWGKgESjdBpZmTqmasXuyr5M1W6PKYzvMTXr5t6Kn7QqCrzKZQ0DRmp2MuzXr1C2k3E8aCpKDbf";
                window.open(link, '_blank');
            }},
    
    
               
    {title:"Requisición", field:"requisicion"},
    {title:"Convocatoria", field:"convocatoria"},
    {title:"Analista de Reclutamiento", field:"reclutador"},
    {title:"Empresa", field:"empresa"},
    {title:"Cargo", field:"cargo"},
    {title:"Documento", field:"documento"},
    {title:"Nombres y Apellidos", field:"nombres"},
    {title:"Retroamimentación", field:"retro"},
    {title:"Motivo", field:"motivo"},
    {title:"Observaciones", field:"observacion"},
    {title:"Fecha Retroalimentación", field:"fecha"},

    
         ],
         
    
         langs:{
            "spanish":{
                "columns":{
                    "name":"Name", //replace the title of column name with the value "Name"
                },
                "ajax":{
                    "loading":"Loading", //ajax loader text
                    "error":"Error", //ajax error text
                },
                "groups":{ //copy for the auto generated item count in group header
                    "item":"item", //the singular  for item
                    "items":"items", //the plural for items
                },
                "pagination":{
                    "page_size":"Por Pagina", //label for the page size select element
                    "page_title":"Show Page",
                    "first":"Primera", //text for the first page button
                    "first_title":"Primera Pagina", //tooltip text for the first page button
                    "last":"Ultima",
                    "last_title":"Ultima Pagina",
                    "prev":"Anterior",
                    "prev_title":"Pagina Anterior",
                    "next":"Siguiente",
                    "next_title":"Pagina Siguiente",
                    "all":"All",
                },
                "headerFilters":{
                    "default":"filter column...", //default header filter placeholder text
                    "columns":{
                        "name":"filter name...", //replace default header filter text for column name
                    }
                }
            }
        },
    });
    
    
    table.setLocale("spanish");
    
    var requisicion = "";
    var convocatoria = "";
    
    function filtrar(filtroEspecifico = {})
    {
      table.setFilter([
            
          {field:"requisicion", type:"like", value:requisicion},
          {field:"convocatoria", type:"like", value:convocatoria},
          filtroEspecifico,
            
        ]);
    }
    
    $(".buscarData").keyup(function()
    {
        $filter = $(this).val();
        $para = $(this).attr("aria-controls");

      if($para == "requisicion")
      {
        requisicion = $filter;
      }
      else if($para == "convocatoria")
      {
        convocatoria = $filter;
      }
    
      
      else if($para == "specific")
      {
        $specific = $('#filtropor').val();
    
        sendToFiltrar = {};
        
        if($specific == "documento")
        {
          sendToFiltrar = {field: "documento",type:"like",value: $filter};      
        }
    
        if($specific == "empresa")
        {
          sendToFiltrar = {field: "empresa",type:"like",value: $filter};      
        }

        if($specific == "reclutador")
        {
          sendToFiltrar = {field: "reclutador",type:"like",value: $filter};      
        }

        


        filtrar(sendToFiltrar);
        return true;
    
      }
      filtrar();
    
    });
    
    
    $("#download-xls").on("click", function(){
        table.download("xlsx", "Retroalimentación_Hv <?php echo date('d_m_Y');?>.xlsx", {sheetName:"Seleccion_Retroalimentación"});
    });
    
    
     </script>
    
     <style>
     
     .tabulator-paginator label {
      visibility: hidden;
    }
    .tabulator-paginator label:after {
      content:'Ver'; 
      visibility: visible;
    }
    
    
    
    
    </style>