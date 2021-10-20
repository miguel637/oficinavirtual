
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
        <label for="">Postulación</label>
        <input aria-controls="postulacion" type="text" placeholder="Buscar por postulación" class="form-control buscarData">
      </div>
      <div class="col-4">
        <select id="filtropor" class="form-control">
          <option value="seleccionar">Seleccionar...</option>
          <option value="nombres">Nombres y apellidos</option>
          <option value="temporal">Temporal</option>
          <option value="concepto">Concepto</option>
          <option value="ciudad">Ciudad</option>
          <option value="cargo">Cargo</option>
        </select>
        <input aria-controls="specific" type="text" Class="form-control buscarData">
      </div>
  </div>

<div id="table-rendered" class="mt-5"></div>

<?php


echo "<script>object = [];</script>";

$start = 0;
while($start < 1001)
{

$url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/ENTREVISTA_Report?privatelink=arMW7eFKgvPXw6vMyNhxQpTvjYk1atHeqQmF6ZHzV8sBY882K0terYRhnVn3Fe7mVSjnSVPM1sqRM8s2n2Pk6vWKV75Q5hgx39sm&criteria=EMPRESA_ENTREVISTA.ID=".$_SESSION["idEmpresa_user"]."&from=$start";

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

    $empresa_entrvista = $fila->EMPRESA_ENTREVISTA->display_value;
    $sede_empresa= $fila->{'CONVOCATORIA_ENTREVISTA.Sede'};
    if(isset($fila->CONVOCATORIA_ENTREVISTA->display_value)){
      
      $convocatoria = $fila->CONVOCATORIA_ENTREVISTA->display_value;
    }else {
      $convocatoria = "";
    }
    if(isset($fila->POSTULACI_N_ENTREVISTA->display_value))
    $postulacion = $fila->POSTULACI_N_ENTREVISTA->display_value;
    else $postulacion = "";
    $nombres = $fila->POSTULADO_ENTREVISTA->display_value;
    
    $estado = $fila->{'CONVOCATORIA_ENTREVISTA.ESTADO'};
    $id = $fila->ID;

echo "<script>dto = {'Empresa':'$empresa_entrvista','Sede':'$sede_empresa','Cargo':'$fila->CARGO','Ciudad':'$fila->CIUDAD','Convocatoria':'$convocatoria','nombres_completos':'$nombres','Temporal':'$fila->TEMPORAL','Concepto':'$fila->CONCEPTO','post':'$postulacion','id':'$id','Cargo':'$fila->CARGO','estado':'$estado'};</script>";
echo "<script>object.push(dto);</script>";
	}
 }
}
?>
<script>

var viewButton = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
    };  

    var downloadButton = function(cell, formatterParams){ //plain text value
       return '<button class="btn btn-outline-info btn-sm" class="btn"><i class="fa fa-download"></i> Descargar entrevista</button>';
    };  


 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitData",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,
  
    groupBy:function(data){
	

      return data.Empresa+" - "+data.Sede+" - "+data.Cargo +" - "+data.estado+" - "+data.Convocatoria;
      
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


		{formatter:viewButton,  headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/ENTREVISTA_Report/" + cell.getRow().getData().id + "/arMW7eFKgvPXw6vMyNhxQpTvjYk1atHeqQmF6ZHzV8sBY882K0terYRhnVn3Fe7mVSjnSVPM1sqRM8s2n2Pk6vWKV75Q5hgx39sm";
window.open(link, '_blank');
}},


  {formatter:downloadButton,   headerSort:false, width:200, hozAlign:"center",cellClick:function(e, cell){

var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-pdf/ENTREVISTA_Report/" + cell.getRow().getData().id+"/APLICAR_CONVOCATORIAS/arMW7eFKgvPXw6vMyNhxQpTvjYk1atHeqQmF6ZHzV8sBY882K0terYRhnVn3Fe7mVSjnSVPM1sqRM8s2n2Pk6vWKV75Q5hgx39sm";
window.open(link, '_blank');
}},

/*

openUrl("https://creator.zohopublic.com/hq5colombia/hq5/record-pdf/ENTREVISTA_Report/" + input.ID + "/Entrevista_" + input.NO_IDENTIFIACACI_N + "/arMW7eFKgvPXw6vMyNhxQpTvjYk1atHeqQmF6ZHzV8sBY882K0terYRhnVn3Fe7mVSjnSVPM1sqRM8s2n2Pk6vWKV75Q5hgx39sm","new window");
*/


    {title:"Convocatoria", field:"Convocatoria"}, 
    {title:"Postulacion",field:"post"},
    {title:"Nombres y apellidos",field:"nombres_completos"},
    {title:"Temporal",field:"Temporal"},
    {title:"Concepto",field:"Concepto"},
    {title:"Ciduad", field:"Ciudad"},
    {title:"Cargo",field:"Cargo"},
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
var filtro_postulacion = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"Convocatoria", type:"like", value: filtro_convocatoria},
      {field:"post", type:"like", value: filtro_postulacion},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "convocatoria")
  {
    filtro_convocatoria = $filter;
  }
  else if($para == "postulacion")
  {
    filtro_postulacion = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "nombres")
    {
      sendToFiltrar = {field: "nombres_completos",type:"like",value: $filter};      
    }

    if($specific == "temporal")
    {
      sendToFiltrar = {field: "Temporal",type:"like",value: $filter};      
    }

    if($specific == "concepto")
    {
      sendToFiltrar = {field: "Concepto",type:"like",value: $filter};      
    }


    if($specific == "ciudad"){

   sendToFiltrar = {field:"Ciudad",type:"like",value:$filter};

    }
    
    if($specific == "cargo"){

sendToFiltrar = {field:"Cargo",type:"like",value:$filter};


 }


    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Entrevistas_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_Entrevistas"});
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
 

