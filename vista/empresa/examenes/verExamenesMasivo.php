<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creatorapp.zohopublic.com/hq5colombia/hq5/report-embed/Ex_menes_Programaci_n_Masivo_Report/TJdJ5JbXrVBa4FgKQj4EZnajfqKkmUmW7QzgxY0PsOOpwT9Geg5Hnx1kqvDnBJR3dJjw6rKOXf4ehEFe3K7OVtPXA3j4wzm1P1dC'></iframe>
?>



<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
    <script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>
    
      <div class="row">
        <div class="col-4">
        <label for="">Convocatoria</label>
          <input aria-controls="convocatoria" type="text" id="focu" placeholder="Buscar por Convocatoria" class="form-control buscarData">
         
        </div>
        <div class="col-4">
        <label for="">Solicitante</label>
          <input aria-controls="solicitante" id="focu" type="text" placeholder="Buscar por Solicitante" class="form-control buscarData">
        </div>
    
        <div class="col-4">
          <select id="filtropor" class="form-control">
            <option value="seleccionar">Seleccionar...</option>
            <option value="empresa">Empresa</option>
            <option value="temporal">Temporal</option>

   
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
    $empresa = $_SESSION['codigoEmpresa_user'];
    $start = 0;

    while($start < 1001)
    {
      $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/Ex_menes_Programaci_n_Masivo_Report?privatelink=TJdJ5JbXrVBa4FgKQj4EZnajfqKkmUmW7QzgxY0PsOOpwT9Geg5Hnx1kqvDnBJR3dJjw6rKOXf4ehEFe3K7OVtPXA3j4wzm1P1dC&from=$start&EMPRESA_USUARIA.C_DIGO_CLIENTE=".$empresa;
    
    
      $start += 200;
    
    
      $opts = array('http' =>
          array(
              'method'  => 'GET'
            
          )
      );
    
      $context = stream_context_create($opts);
    
      $result = @file_get_contents($url, false, $context);
      $manage = json_decode($result);
      if(isset($manage->data))
      {
    
        foreach($manage->data as $fila)
        {
            $id = $fila->ID;
            $id_examenes = $fila->ID_PROGRAMACI_N_EX_MENES_M_DICOS;
            $psicologo = $fila->PSICOLOGO->display_value;
            $convocatoria = $fila->CONVOCATORIAS->display_value;
            $empresa_usuaria = $fila->EMPRESA_USUARIA->display_value;
            $estado = $fila->Estado;

          echo "<script>dto = {'id':'$id','ID_PROGRAMACI_N_EX_MENES_M_DICOS':'$id_examenes','Added_Time':'$fila->Added_Time','PSICOLOGO':'$psicologo','CONVOCATORIAS':'$convocatoria','FECHA_DE_INGRESO':'$fila->FECHA_DE_INGRESO','TEMPORAL':'$fila->TEMPORAL','EMPRESA_USUARIA':'$empresa_usuaria','ESTADO':'$estado'};
          object.push(dto);</script>";
    
        }
      } 
    }
    ?>
    
    <script>
    
        var viewButton = function(cell, formatterParams){ //plain text value
               return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
        };
    
        var editButton = function(cell, formatterParams){ //plain text value
        return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button>';
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
    
    
          {formatter:viewButton, width:100, hozAlign:"center",cellClick:function(e, cell){

var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/Ex_menes_Programaci_n_Masivo_Report/" + cell.getRow().getData().id + "/TJdJ5JbXrVBa4FgKQj4EZnajfqKkmUmW7QzgxY0PsOOpwT9Geg5Hnx1kqvDnBJR3dJjw6rKOXf4ehEFe3K7OVtPXA3j4wzm1P1dC";
window.open(link, '_blank');
}},

{formatter:editButton, width:100, hozAlign:"center",cellClick:function(e, cell){

var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/Ex_menes_Programaci_n_Masivo/record-edit/Ex_menes_Programaci_n_Masivo_Report/" + cell.getRow().getData().id + "/TJdJ5JbXrVBa4FgKQj4EZnajfqKkmUmW7QzgxY0PsOOpwT9Geg5Hnx1kqvDnBJR3dJjw6rKOXf4ehEFe3K7OVtPXA3j4wzm1P1dC?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
window.open(link, '_blank');
}},

            
    
    
    {title:"ID", field:"ID_PROGRAMACI_N_EX_MENES_M_DICOS"},
	 	{title:"Fecha Solicitud", field:"Added_Time"},
	 	{title:"Solicitante", field:"PSICOLOGO"},	 
	 	{title:"Convocatoria", field:"CONVOCATORIAS"},	 
	 	{title:"Fecha Ingreso", field:"FECHA_DE_INGRESO"},	 
	 	{title:"Temporal", field:"TEMPORAL"},	 
	 	{title:"Empresa", field:"EMPRESA_USUARIA"},
            
       
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
    
    var convocatoria = "";
    var solicitante = "";
    
    function filtrar(filtroEspecifico = {})
    {
      table.setFilter([
            
          {field:"CONVOCATORIAS", type:"like", value:convocatoria},
          {field:"PSICOLOGO", type:"like", value:solicitante},
          filtroEspecifico,
            
        ]);
    }
    
    $(".buscarData").keyup(function()
    {
        $filter = $(this).val();
        $para = $(this).attr("aria-controls");
      if($para == "convocatoria")
      {
        convocatoria = $filter;
      }
      else if($para == "solicitante")
      {
        solicitante = $filter;
      }
    
      
      else if($para == "specific")
      {
        $specific = $('#filtropor').val();
    
        sendToFiltrar = {};
        
        if($specific == "empresa")
        {
          sendToFiltrar = {field: "EMPRESA_USUARIA",type:"like",value: $filter};      
        }
    
        if($specific == "temporal")
        {
          sendToFiltrar = {field: "TEMPORAL",type:"like",value: $filter};      
        }
    

        filtrar(sendToFiltrar);
        return true;
    
      }
      filtrar();
    
    });
    
    
    $("#download-xls").on("click", function(){
        table.download("xlsx", "Fidu_Ver_ExamenesMedicos <?php echo date('d_m_Y');?>.xlsx", {sheetName:"Fidu_Ver_ExamenesMedicos"});
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