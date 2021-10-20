
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Fecha</label>
      <input aria-controls="fecha" type="text" id="focu" placeholder="Escribe la Fecha (DD/MM/YYYY) Ej: 08/02/2021 ..." class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Documento</label>
      <input aria-controls="documento" id="focu" type="text" placeholder="Buscar por Documento" class="form-control buscarData">
    </div>

    <!--
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="cliente">Razón social</option>
        <option value="est">Est</option>
        <option value="ciudad">Ciudad</option>
        <option value="representante">Representante legal</option>
        <option value="comercial">Contacto comercial</option>
      </select>
      <input aria-controls="specific" placeholder="Otros filtros" type="text" Class="form-control buscarData">
    </div>
    -->
  </div>

  <div class='text-center m-3 '>
    <span id="example-table-info"></span>
    <button id="download-xls" style="text-align:center;" class="btn btn-outline-secondary"><i class="fas fa-download"></i> Exportar excel</button>    
  </div>

  <div id="table-rendered" class="mt-5"></div>

<?php
echo "<script>object = [];</script>";

$start = 0;
while($start < 2599)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/Gestion_Documental_Postulados_Report?privatelink=6w8x7vB5tYyj0JsdCU9pjBJ17f7taad08JvKjACG6UwrQM9yjwDbKTjDg4OSzyPnZTQPzgHAemNRbeUqYGCKfw7d3XEpfE6pt7K9&from=$start";
  
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
$id_proceso = $fila->ID_Proceso;

$fecha_contratacion = $fila->{"Candidato.Fecha_de_Contrataci_n"};
 $candidato = "";
 $nombres = $fila->Nombres_y_Apellidos->display_value;
 $empresa_solicitante = $fila->Empresa_Solicitante->display_value;
if(isset($fila->Cargo->display_value)){
  $cargo = $fila->Cargo->display_value;
}else {$cargo="";}
 $convocatoria = $fila->convocatoria->display_value;
 $requisicion = $fila->requisicion->display_value;
if(isset($fila->Psicologo_a_Cargo->display_value)){
  $psicologo = $fila->Psicologo_a_Cargo->display_value;
}else {$psicologo="";}
 $documento = $fila->{"Candidato.DOCUMENTO"};
 $estado = $fila->Estado;
 $estado_trabajador = $fila->{"Candidato.Estado_Trabajador"};
 $proceso_inc = $fila->Proceso_que_presenta_inconsistencias;
 $candidato = $fila->Candidato->display_value;

      echo "<script>dto = {'id':'$id','ID_Proceso':'$id_proceso','Fecha_de_Contrataci_n':'$fecha_contratacion','Nombres_y_Apellidos':'$nombres','Empresa_Solicitante':'$empresa_solicitante','convocatoria':'$convocatoria','requisicion':'$requisicion','Psicologo_a_Cargo':'$psicologo','DOCUMENTO':'$documento','Cargo':'$cargo','estado':'$estado','estado_trab':'$estado_trabajador','Proceso_que_presenta_inconsistencias':'$proceso_inc','candidato':'$candidato'};
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
	layout:"",
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

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/Gestion_Documental_Postulados_Report/" + cell.getRow().getData().id + "/6w8x7vB5tYyj0JsdCU9pjBJ17f7taad08JvKjACG6UwrQM9yjwDbKTjDg4OSzyPnZTQPzgHAemNRbeUqYGCKfw7d3XEpfE6pt7K9";
			window.open(link, '_blank');
		}},


    {formatter:editButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){
                
                var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/Gestion_Documental_Postulados/record-edit/Gestion_Documental_Postulados_Report/" + cell.getRow().getData().id + "/6w8x7vB5tYyj0JsdCU9pjBJ17f7taad08JvKjACG6UwrQM9yjwDbKTjDg4OSzyPnZTQPzgHAemNRbeUqYGCKfw7d3XEpfE6pt7K9?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
                window.open(link, '_blank');
            }},
            

            {title:"ID", field:"ID_Proceso"},
            {title:"Estado", field:"estado"},
            {title:"Proceso que Presenta Incosistencia", field:"Proceso_que_presenta_inconsistencias"},
            {title:"Estado Trabajador", field:"estado_trab"},
            {title:"Fecha de Contratación", field:"Fecha_de_Contrataci_n"},
            {title:"Candidato", field:"candidato"},	 
            {title:"Documento", field:"DOCUMENTO"},	 
            {title:"Nombres y Apellidos", field:"Nombres_y_Apellidos"},	 
            {title:"Empresa", field:"Empresa_Solicitante"},
            {title:"Cargo", field:"Cargo"},
            {title:"Convocatoria", field:"convocatoria"},
            {title:"Requisición", field:"requisicion"},
            {title:"Psicologo", field:"Psicologo_a_Cargo"},
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

var fecha = "";
var documento = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"Fecha_de_Contrataci_n", type:"like", value:fecha},
      {field:"DOCUMENTO", type:"like", value:documento},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "fecha")
  {
    fecha = $filter;
  }
  else if($para == "documento")
  {
    documento = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "")
    {
      sendToFiltrar = {field: "",type:"like",value: $filter};      
    }


    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Ans_Ver_clientes_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_Clientes"});
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