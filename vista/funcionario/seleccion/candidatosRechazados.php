
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
    <label for="">Identificación</label>
      <input aria-controls="identificacion" id="focu" type="text" placeholder="Buscar por Identificación" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="nombres">Nombres y Apellido</option>
        <option value="psicologo">Psicólogo</option>

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

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/RECHAZADOS?privatelink=JFVhZD7V940Gyg5zw8679bZyKPm2KAWUOSG2jhG60XBHS2K9Jb46BZa08SWTOaw9rerS3QZN63ew0wq8JmOsJvH9AFWwzuCB6T7O&from=$start";
  
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
    $estado_posutlacion = $fila->Estado_Postulacion;
    $motivo_rechazo = $fila->MOTIVO_DEL_RECHAZO;
    $convocatoria = $fila->CONVOCATORIAS_APLICAR_CONVOCATORIA->display_value;
    $documento = $fila->DOCUMENTO;
    $nombres = $fila->NOMBRES_Y_APELLIDOS->display_value;
    if(isset($fila->PSICOLOGO->display_value)){
        $psicologo = $fila->PSICOLOGO->display_value;
    }else {$psicologo="";}

      $estado = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.ESTADO"};
      $empresa = $fila->EMPRESA_APLICAR_CONVOCATORIA->display_value;
      $sede = $fila->SEDE_APLICAR_CONVOCATORIA->display_value;
     if(isset($fila->CARGO_APLICAR_CONVOCATORIA->display_value)){
      $cargo = $fila->CARGO_APLICAR_CONVOCATORIA->display_value;
     }else {$cargo="";}
     $requi = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.REQUISICI_N"};
      echo "<script>dto = {'id':'$id','Estado_Postulacion':'$estado_posutlacion','MOTIVO_DEL_RECHAZO':'$motivo_rechazo','CONVOCATORIAS_APLICAR_CONVOCATORIA':'$convocatoria','DOCUMENTO':'$documento','NOMBRES_Y_APELLIDOS':'$nombres','PSICOLOGO':'$psicologo','estado':'$estado','empresa':'$empresa','sede':'$sede','cargo':'$cargo','requi':'$requi'};
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


    groupBy:function(data){
		
        return data.estado + " > "+data.empresa + "> "+data.sede+ " > "+data.cargo +" > "+data.requi;
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

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/RECHAZADOS/" + cell.getRow().getData().id + "/JFVhZD7V940Gyg5zw8679bZyKPm2KAWUOSG2jhG60XBHS2K9Jb46BZa08SWTOaw9rerS3QZN63ew0wq8JmOsJvH9AFWwzuCB6T7O";
			window.open(link, '_blank');
		}},

	

        {title:"Estado Postulación", field:"Estado_Postulacion"},
        {title:"Motivo Rechazo", field:"MOTIVO_DEL_RECHAZO"},
        {title:"Convocatoria",field:"CONVOCATORIAS_APLICAR_CONVOCATORIA"},
        {title:"N° Identificación",field:"DOCUMENTO"},
        {title:"Nombres y Apellidos",field:"NOMBRES_Y_APELLIDOS"},
        {title:"Psicólogo",field:"PSICOLOGO"},
   
      
        
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
var identificacion = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"CONVOCATORIAS_APLICAR_CONVOCATORIA", type:"like", value:convocatoria},
      {field:"DOCUMENTO", type:"like", value:identificacion},
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
  else if($para == "identificacion")
  {
    identificacion = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "nombres")
    {
      sendToFiltrar = {field: "NOMBRES_Y_APELLIDOS",type:"like",value: $filter};      
    }

    if($specific == "psicologo")
    {
      sendToFiltrar = {field: "PSICOLOGO",type:"like",value: $filter};      
    }

    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Ans_Ver_Candidatos_Rechzados<?php echo date('d_m_Y');?>.xlsx", {sheetName:"Seleccion_Candidatos_Rechazados"});
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