

<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
    <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
    
      <div class="row">
        <div class="col-4">
        <label for="">Requisicion</label>
          <input aria-controls="requisicion" type="text" id="focu" placeholder="Buscar por Requisicion" class="form-control buscarData">
         
        </div>
        <div class="col-4">
        <label for="">Convocatoria</label>
          <input aria-controls="convocatoria" type="text" placeholder="Buscar por Convocatoria" class="form-control buscarData">
        </div>
    
        <div class="col-4">
          <select id="filtropor" class="form-control">
            <option value="seleccionar">Seleccionar...</option>
            <option value="sede">Sede</option>
            <option value="psicologo">Psicologo</option>
            <option value="reclutador">Reclutador</option>
            <option value="empresa">Empresa</option>
            <option value="cargo">Cargo</option>
   
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
    while($start < 2500)
    {
      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/REQUISIONES_OFICINA?privatelink=0pRCHRRRbJ77NtGG3aQQTrDNKnNfK2SJjKp5DbR7r7zP8mDuE4PnNN9PVPZtWXWmmBb12HbGRV8DfQgAOJ6kamDJjEnpTQZXpT1J&ID_REQUISICI_N=4000&ID_REQUISICI_N_op=21&from=$start&ESTADO=ACEPTADA",
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
      if(isset($manage->data))
      {
    
        foreach($manage->data as $fila)
        {
            $id = $fila->ID;
            $cargo = (isset($fila->CARGO->display_value)) ? $fila->CARGO->display_value : "";
           
            $sedes = $fila->SEDES->display_value;
            $psicologo = $fila->PSICOLOGO_ENCARGADO[0]->display_value;

            $reclutadores = (isset($fila->Reclutadores_Asignados[0]->display_value)) ? $fila->Reclutadores_Asignados[0]->display_value: "";

           $empresa_usuaria = str_replace("'",'',$fila->EMPRESA_USURIA->display_value);
           $add_time = $fila->Added_Time;
           $fecha_aprobacion_rechazo = $fila->FECHA_APROBADO_RECHAZADO;
            
           $id_requi = $fila->ID_REQUISICI_N;
           $id_convo = $fila->NumeroConvocatoria;
           $estado = $fila->ESTADO;
          echo "<script>dto = {'id':'$id','CARGO':'$cargo','SEDES':'$sedes','TIPO_DE_PROCESO':'$fila->TIPO_DE_PROCESO','TIPO_DE_COBERTURA':'$fila->TIPO_DE_COBERTURA','PSICOLOGO_ENCARGADO':'$psicologo','Reclutadores_Asignados':'$reclutadores','EMPRESA_USURIA':'$empresa_usuaria','FECHA_APROBADO_RECHAZADO':'$fecha_aprobacion_rechazo','Added_Time':'$add_time','ID_REQUISICI_N':'$id_requi','Convocatoria':'$id_convo','ESTADO':'$estado'};
          object.push(dto);</script>";
    
        }
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
            
            return data.ESTADO;
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
    
                var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/REQUISIONES_OFICINA/" + cell.getRow().getData().id + "/0pRCHRRRbJ77NtGG3aQQTrDNKnNfK2SJjKp5DbR7r7zP8mDuE4PnNN9PVPZtWXWmmBb12HbGRV8DfQgAOJ6kamDJjEnpTQZXpT1J";
                window.open(link, '_blank');
            }},
    
    
               
    {title:"ID Convocatoria", field:"Convocatoria"},
    {title:"ID Requisición", field:"ID_REQUISICI_N"},
    {title:"Cargo", field:"CARGO"},	 
	 	{title:"Sede", field:"SEDES"},	 
	 	{title:"Proceso", field:"TIPO_DE_PROCESO"},	 
	 	{title:"Cobertura", field:"TIPO_DE_COBERTURA"},	 
	 	{title:"Psicologo", field:"PSICOLOGO_ENCARGADO"},	 
	 	{title:"Reclutador", field:"Reclutadores_Asignados"},
	 	{title:"Empresa", field:"EMPRESA_USURIA"},
    {title:"Fecha Aprobado", field:"FECHA_APROBADO_RECHAZADO"},
    {title:"Fecha creada", field:"Added_Time"},
            
            
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
            
          {field:"ID_REQUISICI_N", type:"like", value:requisicion},
          {field:"Convocatoria", type:"like", value:convocatoria},
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
        
        if($specific == "sede")
        {
          sendToFiltrar = {field: "SEDES",type:"like",value: $filter};      
        }
    
        if($specific == "psicologo")
        {
          sendToFiltrar = {field: "PSICOLOGO_ENCARGADO",type:"like",value: $filter};      
        }
    
        if($specific == "reclutador")
        {
          sendToFiltrar = {field: "Reclutadores_Asignados",type:"like",value: $filter};      
        }
    
        if($specific == "empresa")
        {
          sendToFiltrar = {field: "EMPRESA_USURIA",type:"like",value: $filter};      
        }
    
        if($specific == "cargo")    
        {
          sendToFiltrar = {field: "CARGO",type:"like",value: $filter};      
        }
    


        filtrar(sendToFiltrar);
        return true;
    
      }
      filtrar();
    
    });
    
    
    $("#download-xls").on("click", function(){
        table.download("xlsx", "Seleccion_Ver_Requisicione <?php echo date('d_m_Y');?>.xlsx", {sheetName:"Seleccion_Requisiciones"});
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