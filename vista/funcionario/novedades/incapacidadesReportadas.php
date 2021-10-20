
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Documento</label>
      <input aria-controls="documento" type="text" id="focu" placeholder="Buscar por Documento" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Codigo</label>
      <input aria-controls="codigo" id="focu" type="text" placeholder="Buscar por Codigo" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="empresa">Empresa Usuaria</option>
        <option value="nombres">Nombres y Apellidos</option>

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
while($start < 1001)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/ecosistema-temporal/report/Incapacidades_Reportadas?privatelink=8zqSw3tdJhpPk2kvTHkwgyjCZ1dEtUuDjAPW3WgsmnyrvbzC28eFrw4AjgAx75uPq6Mv1BeDe2VhdfFuBn9bwkt17f99r5W1Ohdy&from=$start";
  
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
$est = $fila->EST;
$estado = $fila->Estado;

$empresa_usuaria = $fila->Empresa_Usuaria;
$cargo = $fila->Cargo;
$nombres = $fila->Nombres_y_Apellidos;
$documento = $fila->Identificaci_n->display_value;
$fechaInicio_incapacidad = $fila->Fecha_de_Inicio_Incapacidad;
$fechaFinal_incapacidad = $fila->Fecha_de_Fin_Incapacidad;
$dias_incapacidad = $fila->Dias_de_Incapacidad;
$codigo = $fila->{"Diagnostico.Codigo"};
$descripcion = $fila->{"Diagnostico.Descripcion"};
$prorroga = $fila->Es_Prorroga;
$fecha = $fila->Added_Time;


      echo "<script>dto = {'id':'$id','est':'$est','estado':'$estado','cargo':'$cargo','nombres':'$nombres','empresa_usuario':'$empresa_usuaria','documento':'$documento','fecha_incapacidad':'$fechaInicio_incapacidad','fecha_final':'$fechaFinal_incapacidad','dias_incapacidad':'$dias_incapacidad','codigo':'$codigo','descripcion':'$descripcion','prorroga':'$prorroga','fecha':'$fecha'};
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
   		return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Editar</button>';
    };


 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitData",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,

  
    groupBy:function(data){
		
        return data.estado;
    },
    
    groupHeader:function(value, count, data, group){
    //value - the value all members of this group share
    //count - the number of rows in this group
    //data - an array of all the row data objects in this group
    //group - the group component for the group

        return value + "<span style='color:#FC7827; margin-left:10px;'>("+count+")</span>";
    },

    
	paginationSizeSelector:[15, 25, 50, 110],
 	columns:[
		{formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/ecosistema-temporal/record-summary/Incapacidades_Generadas/" + cell.getRow().getData().id + "/hD4JQONRzEpMOJPq5nKAvPKVK5bUr4qwm9yp1ZxAFGZ3rHMQF6447VSvmjZPuns5GRYeZakpZEB3t9qDbsbJJpJpHtT7ddtMh7Ub";
			window.open(link, '_blank');
		}},


    {formatter:editButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

var link = "https://creatorapp.zohopublic.com/hq5colombia/ecosistema-temporal/Registro_de_Incapacidad/record-edit/Incapacidades_Generadas/" + cell.getRow().getData().id + "/hD4JQONRzEpMOJPq5nKAvPKVK5bUr4qwm9yp1ZxAFGZ3rHMQF6447VSvmjZPuns5GRYeZakpZEB3t9qDbsbJJpJpHtT7ddtMh7Ub?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]);?>";
window.open(link, '_blank');
}},
	
        {title:"EST", field:"est"},
        {title:"Empresa Usuaria", field:"empresa_usuario"},
        {title:"Cargo", field:"cargo"},
        {title:"Nombres y Apellidos", field:"nombres"},
        {title:"Identificación", field:"documento"},
        {title:"Fecha Inicio Incapacidad", field:"fecha_incapacidad"},
        {title:"Fecha Final Incapacidad", field:"fecha_final"},
        {title:"Dias de Incapacidad", field:"dias_incapacidad"},
        {title:"Código", field:"codigo"},
        {title:"Descripción", field:"descripcion"},
        {title:"¿Es Prorroga?", field:"prorroga"},
        {title:"Fecha Registro", field:"fecha"},
        
      
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

var documento = "";
var codigo = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"documento", type:"like", value:documento},
      {field:"codigo", type:"like", value:codigo},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "documento")
  {
    documento = $filter;
  }
  else if($para == "codigo")
  {
    codigo = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "nombres")
    {
      sendToFiltrar = {field: "nombres",type:"like",value: $filter};      
    }

    if($specific == "empresa")
    {
      sendToFiltrar = {field: "empresa_usuario",type:"like",value: $filter};      
    }

    filtrar(sendToFiltrar);
    return true;
  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Ans_Ver_incapacidades_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"Novedades_Reportadas"});
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