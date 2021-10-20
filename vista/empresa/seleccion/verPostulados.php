<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/hq5/report-embed/APLICAR_CONVOCATORIAS_Report/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R'></iframe>

?>



<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

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
          <option value="identificacion">Número de documento</option>
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

// &EMPRESA_APLICAR_CONVOCATORIA.ID=".$_SESSION["idEmpresa_user"]

$start = 0;

while($start < 1000) {

	
$url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/APLICAR_CONVOCATORIAS_Report?privatelink=D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R&from=$start&EMPRESA_APLICAR_CONVOCATORIA.ID=".$_SESSION["idEmpresa_user"];

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
		$requi = $fila->{'CONVOCATORIAS_APLICAR_CONVOCATORIA.REQUISICI_N'};
		$estado = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.ESTADO"};
		$convocatoria = $fila->CONVOCATORIAS_APLICAR_CONVOCATORIA->display_value;
		$requisicion = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.REQUISICI_N"};
		$cargo = $fila->CARGO_APLICAR_CONVOCATORIA->display_value;
		$documento = $fila->DOCUMENTO;
		$nombres = $fila->NOMBRES_Y_APELLIDOS->display_value;

		  echo "<script>dto = {'id':'$id','Estado_Postulacion':'$fila->Estado_Postulacion','Estado_Trabajador':'$fila->Estado_Trabajador','ESTADO':'$estado','Convocatoria':'$convocatoria','requi':'$requisicion','cargo':'$cargo','documento':'$documento'}; object.push(dto);</script>";
	}
   }
 }


?>
<script>

	var viewButton = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
    };


	var editButton = function(cell, formatterParams){ //plain text value
    return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button>';
};

 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitColumns",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,
  
    groupBy:function(data){
	

     return data.ESTADO;
      
    },
    groupHeader:function(value, count, data, group){


    return value + "<span style='color:#d00; margin-left:10px;'>("+count+")</span>";
    },

	paginationSizeSelector:[15, 25, 50, 100],
 	columns:[
		{formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/APLICAR_CONVOCATORIAS_Report/" + cell.getRow().getData().id + "/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R";
			window.open(link, '_blank');
		}},
		
		{formatter:editButton, width:100, hozAlign:"center",cellClick:function(e, cell){
			
			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/APLICAR_CONVOCATORIAS/record-edit/APLICAR_CONVOCATORIAS_Report/" + cell.getRow().getData().id + "/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
			window.open(link, '_blank');
		}},

    {title:"Estado Proceso", field:"Estado_Postulacion"},
    {title:"Estado Trabajador", field:"Estado_Trabajador"},
		{title:"Convocatoria",field:"Convocatoria"}, 
		{title:"ID Requisición",field:"requi"}, 
		{title:"Cargo",field:"cargo"}, 
		{title:"Documento",field:"documento"}, 
 	],
     
     langs:{
        "colombinos":{
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


table.setLocale("colombinos");


var convocatoria = "";
var requisicion = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"Convocatoria", type:"like", value: convocatoria},
      {field:"requi", type:"like", value: requisicion},
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
    
    if($specific == "identificacion")
    {
      sendToFiltrar = {field: "documento",type:"like",value: $filter};      
    }

    if($specific == "cargo")
    {
      sendToFiltrar = {field: "cargo",type:"like",value: $filter};      
    }



    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Canidatos_En_Proceso_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"Canidatos_En_Proceso"});
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
 

