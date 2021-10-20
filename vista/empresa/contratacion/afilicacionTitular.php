<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

<div class="row">

      <div class="col-4">
        <label for="">Contrato</label>
        <input aria-controls="contrato" type="text" placeholder="Buscar por convocatoria" class="form-control buscarData">
      </div>
      <div class="col-4">
        <label for="">N° Documento</label>
        <input aria-controls="documento" type="text" placeholder="Buscar por requisicion" class="form-control buscarData">
      </div>
      <div class="col-4">
        <select id="filtropor" class="form-control">
          <option value="seleccionar">Seleccionar...</option>
          <option value="nombres">Nombre y Apellido</option>
          <option value="fecha">Fecha Ingreso</option>
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

while($start < 2001) {

	
$url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/AFILIACIONES_TITULAR1?privatelink=hjTGxkGRRU5CmQkNkhnRx9vTbH7BPfyej2754RasOgBOtXWDTsfd8sMjrh30mPsQ0GaO0CMW5DVvVZ3fQ06Y6FPsFGwyPWhtU3Js&from=$start&EMPRESA_APLICAR_CONVOCATORIA.ID=".$_SESSION["idEmpresa_user"];

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
        $estado = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.ESTADO"};
		$eps = $fila->EPS;
		$caja = $fila->CAJA_DE_COMPENSACI_N;
		$contrato = $fila->N_mero_de_Contrato;
		$fecha_ingreso = $fila->{"ORDEN_DE_CONTRATACI_N_Numero_de_Orden.Fecha_de_Ingreso"};
		$nombres = $fila->NOMBRES_Y_APELLIDOS->display_value;
		$tipo_documento = $fila->{"HOJA_DE_VIDA1.TIPO_DE_DOCUMENTO"};
		$documento = $fila->DOCUMENTO;
	    $empresa = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.EMPRESA_USURIA"};
	    $temporal = $fila->TEMPORAL_aplicar_convocatoria->display_value;
		$cargo = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.CARGO"};
		$ciudad = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.CIUDAD"};

		  echo "<script>dto = {'id':'$id','ESTADO':'$estado','EPS':'$eps','CAJA_DE_COMPENSACI_N':'$caja','N_mero_de_Contrato':'$contrato','Fecha_de_Ingreso':'$fecha_ingreso','NOMBRES_Y_APELLIDOS':'$nombres','TIPO_DOCUMENTO':'$tipo_documento','DOCUMENTO':'$documento','EMPRESA_TEXT':'$empresa','TEMPORAL_aplicar_convocatoria':'$temporal','Cargo':'$cargo','Ciudad':'$ciudad'}; object.push(dto);</script>";
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


    //value - the value all members of this group share
    //count - the number of rows in this group
    //data - an array of all the row data objects in this group
    //group - the group component for the group

    return value + "<span style='color:#d00; margin-left:10px;'>("+count+")</span>";
    },

	paginationSizeSelector:[15, 25, 50, 100],
 	columns:[
		{formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/AFILIACIONES_TITULAR1/" + cell.getRow().getData().id + "/hjTGxkGRRU5CmQkNkhnRx9vTbH7BPfyej2754RasOgBOtXWDTsfd8sMjrh30mPsQ0GaO0CMW5DVvVZ3fQ06Y6FPsFGwyPWhtU3Js";
			window.open(link, '_blank');
		}}, 


		{formatter:editButton, width:100, hozAlign:"center",cellClick:function(e, cell){
			
			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/APLICAR_CONVOCATORIAS/record-edit/AFILIACIONES_TITULAR1/" + cell.getRow().getData().id + "/hjTGxkGRRU5CmQkNkhnRx9vTbH7BPfyej2754RasOgBOtXWDTsfd8sMjrh30mPsQ0GaO0CMW5DVvVZ3fQ06Y6FPsFGwyPWhtU3Js?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
			window.open(link, '_blank');
		}},




		{title:"EPS", field:"EPS"},
	 	{title:"Caja", field:"CAJA_DE_COMPENSACI_N"},	 	
	 	{title:"Contrato", field:"N_mero_de_Contrato"},
	 	{title:"Fecha Ingreso", field:"Fecha_de_Ingreso"},
	 	{title:"Nombres", field:"NOMBRES_Y_APELLIDOS"},
	 	{title:"Tipo Documento", field:"TIPO_DOCUMENTO"},
	 	{title:"Documento", field:"DOCUMENTO"},	 	
	 	{title:"Empresa", field:'EMPRESA_TEXT'},
	 	{title:"Temporal", field:'TEMPORAL_aplicar_convocatoria'},
	 	{title:"Cargo", field:'Cargo'},
	 	{title:"Ciudad", field:'Ciudad'},
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


var contrato = "";
var documento = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"N_mero_de_Contrato", type:"like", value: contrato},
      {field:"DOCUMENTO", type:"like", value: documento},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "contrato")
  {
    contrato = $filter;
  }
  else if($para == "documento")
  {
    documento = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "nombres")
    {
      sendToFiltrar = {field: "NOMBRES_Y_APELLIDOS",type:"like",value: $filter};      
    }

    if($specific == "fecha")
    {
      sendToFiltrar = {field: "Fecha_de_Ingreso",type:"like",value: $filter};      
    }



    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Afiliacion_Titular_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"Afiliacion_Titular"});
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
 

