
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Empresa</label>
      <input aria-controls="empresa" type="text" id="focu" placeholder="Buscar por Empresa" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Ubicación</label>
      <input aria-controls="ubicacion" type="text" id="focu" placeholder="Buscar por Ubicación" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="fecha">Fecha creación</option>
        <option value="cargo">Cargo</option>
      </select>
      <input aria-controls="specific" placeholder="Ej por fecha: 07/04/2021" type="text" Class="form-control buscarData">
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
while($start < 3001)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/ANEXAR_PERFILES_Report?privatelink=YDD3m9pYwugGJ42xg81unaJb8x065G9HF44Y6Jd5SrAC1PVddRs3eCH6hOwauEKgEhX3MtS1BsCQZ7Y01f2TW345ss18fQNKdF5J&from=$start";
  
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



if(isset($fila->EMPRESA->display_value)){
  $empresa = $fila->EMPRESA->display_value;
}else {$empresa="";}
$ubicacion = $fila->UBICACION_SUB_CENTRO;
$riesgo = $fila->CLASIFICACION_DE_RIESGOS;
$cargo = $fila->CARGO;
$creacion = $fila->Added_Time;
$cargo = $fila->CARGO;

$id = $fila->ID;
      echo "<script>dto = {'id':'$id','ubicacion':'$ubicacion','riesgo':'$riesgo','empresa':'$empresa','CARGO':'$cargo','fecha_creacion':'$creacion'};
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
	layout:"fitColumns",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,

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
	paginationSizeSelector:[15, 25, 50, 110],
 	columns:[
		{formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/ANEXAR_PERFILES_Report/" + cell.getRow().getData().id + "/YDD3m9pYwugGJ42xg81unaJb8x065G9HF44Y6Jd5SrAC1PVddRs3eCH6hOwauEKgEhX3MtS1BsCQZ7Y01f2TW345ss18fQNKdF5J";
			window.open(link, '_blank');
		}},


	

        {title:"Ubicación", field:"ubicacion"},
        {title:"Clasificación de Riesgos", field:"riesgo"},
        {title:"Cargo", field:"CARGO"},
        {title:"Empresa", field:"empresa"},
        {title:"Fecha Creación", field:"fecha_creacion"},

       
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

var empresa = "";
var ubicacion = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"empresa", type:"like", value:empresa},
      {field:"ubicacion", type:"like", value:ubicacion},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "empresa")
  {
    empresa = $filter;
  }
  else if($para == "ubicacion")
  {
    ubicacion = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "fecha")
    {
      sendToFiltrar = {field: "fecha_creacion",type:"like",value: $filter};      
    }

    else if($specific=="cargo"){

      sendToFiltrar = {field: "CARGO",type:"like",value: $filter};
    }
    


    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Ans_Ver_Perfiles_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_Perfiles"});
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