<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/hq5/report-embed/APLICAR_CONVOCATORIAS_Report/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R'></iframe>
?>
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Requisición</label>
      <input aria-controls="requisicion" type="text" placeholder="Buscar por requisición" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Convocatoria</label>
      <input aria-controls="convocatoria" type="text" placeholder="Buscar por convocatoria" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="temporal">Temporal</option>
        <option value="cargo">Cargo</option>
        <option value="sede">Sede</option>
        <option value="ciudad">Ciudad</option>
        <option value="psicologo">Psicologo</option>
      </select>
      <input aria-controls="specific" placeholder="Otros filtros" type="text" Class="form-control buscarData">
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
while($start < 1001)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/REQUISIONES_OFICINA?privatelink=0pRCHRRRbJ77NtGG3aQQTrDNKnNfK2SJjKp5DbR7r7zP8mDuE4PnNN9PVPZtWXWmmBb12HbGRV8DfQgAOJ6kamDJjEnpTQZXpT1J&from=$start&EMPRESA_USURIA.ID=". $_SESSION['idEmpresa_user'];
  
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

          $cargo = $fila->CARGO->display_value;
          $temporal = $fila->Temporal->display_value;
          $sede = $fila->SEDES->display_value;
          $psicologo = $fila->PSICOLOGO_ENCARGADO[0]->display_value;
          $id = $fila->ID;

      echo "<script>dto = {'Estado':'$fila->ESTADO','ID_REQUSICION':'$fila->ID_REQUISICI_N','Convocatoria':'$fila->NumeroConvocatoria','temporal':'$temporal','Cargo':'$cargo','Vacantes':'$fila->VACANTES','vacantes_restantes':'$fila->Vacantes_Restantes','Sede':'$sede','Ciudad':'$fila->CIUDAD','codigo_empresa':'$fila->C_DIGO_DE_EMPRESA_SOLICITANTE','psicologo_encargado':'$psicologo','id':'$id'};object.push(dto);</script>";

    }
  }
}
?>
<script>

	var viewButton = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
    };


 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitData",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,
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
	paginationSizeSelector:[15, 25, 50, 110],
 	columns:[
		{formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/REQUISIONES_OFICINA/" + cell.getRow().getData().id + "/0pRCHRRRbJ77NtGG3aQQTrDNKnNfK2SJjKp5DbR7r7zP8mDuE4PnNN9PVPZtWXWmmBb12HbGRV8DfQgAOJ6kamDJjEnpTQZXpT1J";
			window.open(link, '_blank');
		}},
	

        {title:"ID Requisicion", field:"ID_REQUSICION"},
        {title:"ID Convocatoria", field:"Convocatoria"},
        {title:"Temporal",field:"temporal"},
        {title:"Cargo",field:"Cargo"},
        {title:"#Vacantes",field:"Vacantes"},
        {title:"Vacantes activas",field:"vacantes_restantes"},
        {title:"Sede",field:"Sede"},
        {title:"Ciudad",field:"Ciudad"},
        {title:"Codigo empresa",field:"codigo_empresa"},
        {title:"Psicologo encargado",field:"psicologo_encargado"},
   	
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
var requisicion = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"Convocatoria", type:"like", value:convocatoria},
      {field:"ID_REQUSICION", type:"like", value:requisicion},
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
  else if($para == "requisicion")
  {
    requisicion = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "temporal")
    {
      sendToFiltrar = {field: "temporal",type:"like",value: $filter};      
    }

    if($specific == "cargo")
    {
      sendToFiltrar = {field: "Cargo",type:"like",value: $filter};      
    }

    if($specific == "sede")
    {
      sendToFiltrar = {field: "Sede",type:"like",value: $filter};      
    }

    if($specific == "ciudad"){
      sendToFiltrar = {field:"Ciudad",type:"like",value:$filter};
    }

    if($specific == "psicologo"){

      sendToFiltrar = {field:"psicologo_encargado",type:"like",value:$filter};
    }

    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Requisiciones_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_Requsiciones"});
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



#download-xls:hover{
    background-color:#FF4C26;
    color:white;
    border-color:#FF4C26;  
}


</style>