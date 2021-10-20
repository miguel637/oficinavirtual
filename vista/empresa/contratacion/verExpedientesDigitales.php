
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

<div class="row">

      <div class="col-4">
        <label for="">Concovatoria</label>
        <input aria-controls="convocatoria" type="number" placeholder="Buscar por convocatoria" class="form-control buscarData">
      </div>
    
      <div class="col-4">
        <label for="">Estado</label>
        <select id="estadoTrabajador" class="form-control">
          <option value="">TODOS</option>
		      <option value="ACTIVO">ACTIVO</option>
          <option value="RETIRADO">RETIRADO</option>   
        </select>
      </div>
    
      <div class="col-4">        
        <select id="filtropor" class="form-control">
          <option value="seleccionar">Seleccionar...</option>
		      <option value="documento">Documento</option>
          <option value="nombres">Nombres y apellidos</option>
          <option value="sede">Sede</option>   
        </select>
        <input aria-controls="specific" type="text" Class="form-control buscarData">
      </div>
  </div>

  <div class='text-center m-3 '>
    <span id="example-table-info"></span>
    <button id="download-xls" style="position:absolute; right:4%;" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Exportar excel</button>    
</div>

<div id="table-rendered" class="mt-5"></div>
<div id="contador"></div>
<?php


$url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/Expedientes_Validados_GDO?privatelink=VKWMSnmjZbwAmkNeXY4UJ4TsX3z326q26yAGS9uzFztPUXPNKs39nf5kRhE9w9aREAMbAKWXH9YJPaNyRuT87S8dmGnRJR9eeWgk&criteria=Empresa_Solicitante.ID==". $_SESSION['idEmpresa_user'];



$opts = array('http' =>
    array(
        'method'  => 'GET'
      
    )
);

$context = stream_context_create($opts);

$result = file_get_contents($url, false, $context);
$manage = json_decode($result);
echo "<script>object = [];</script>";

if(isset($manage->data))
{

	foreach($manage->data as $fila)
	{


    $id = $fila->ID;
    $nombres = $fila->Nombres_y_Apellidos->display_value;
    $cargo = $fila->Cargo->display_value;
    $documento = $fila->{"Candidato.DOCUMENTO"};
    $convocatoria = $fila->convocatoria->display_value;
    $req = $fila->requisicion->display_value;
    $candiadto = $fila->Candidato->display_value;
    $sede = $fila->{"Candidato.SEDE_APLICAR_CONVOCATORIA"};
    $estado_trabajador = $fila->{"Candidato.Estado_Trabajador"};

		echo "<script>dto = {'id':'$id','Nombres_y_Apellidos':'$nombres','Cargo':'$cargo','Documento':'$documento','Convocatoria':'$convocatoria','requi':'$req','Candidato':'$candiadto','Sede':'$sede','estado_trabajador':'$estado_trabajador'};</script>";
		echo "<script>object.push(dto);</script>";
	}
}
?>  
<script>
  
    var viewButton = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
    };  
 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitColumns",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,
	paginationSizeSelector:[15, 25, 50, 100],
 	columns:[
		{formatter:viewButton,  headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/Expedientes_Validados_GDO/" + cell.getRow().getData().id + "/VKWMSnmjZbwAmkNeXY4UJ4TsX3z326q26yAGS9uzFztPUXPNKs39nf5kRhE9w9aREAMbAKWXH9YJPaNyRuT87S8dmGnRJR9eeWgk";
			window.open(link, '_blank');
		}},
		{title:"Estado del Trabajador",field:"estado_trabajador"},
		{title:"Documento",field:"Documento"},
    {title:"Nombres y Apellidos", field:"Nombres_y_Apellidos"}, 
    {title:"Cargo",field:"Cargo"},
    {title:"Convocatoria",field:"Convocatoria"},
    {title:"Requisicion",field:"requi"},
    {title:"Candidato",field:"Candidato"},
	  {title:"Sede",field:"Sede"},
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

var filtro_convocatoria= "";
var estado= "";

function myFunction() {
  $('#contador').html("<span class='text-info'>Numero de Registros: "+table.getDataCount("active")+"</span>");
}
myFunction();
function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"Convocatoria", type:"like", value: filtro_convocatoria},
      {field:"estado_trabajador", type:"like", value: estado},
      filtroEspecifico,
		
	]);
  myFunction();
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "convocatoria")
  {
    filtro_convocatoria = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "documento")
    {
      sendToFiltrar = {field: "Documento",type:"like",value: $filter};      
    }

    if($specific == "nombres")
    {
      sendToFiltrar = {field: "Nombres_y_Apellidos",type:"like",value: $filter};      
    }

    if($specific == "sede")
    {
      sendToFiltrar = {field: "Sede",type:"like",value: $filter};      
    }



    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});

$('#estadoTrabajador').change(function(){
  var $status = $(this).val();
  estado = $status;
  filtrar();
});


$("#download-xls").on("click", function(){
    table.download("xlsx", "ExpedientesDigitales_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_ExpedientesDigitales"});
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
 

