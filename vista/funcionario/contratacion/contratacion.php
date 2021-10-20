
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
    <label for="">Empresa</label>
      <input aria-controls="empresa" id="focu" type="text" placeholder="Buscar por Empresa" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="nombre">Nombres</option>
        <option value="cargo">Cargo</option>
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

$start = 0;
while($start < 1001)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/VER_POSTULADOS_CONTRATADOS?privatelink=E185MUp8nGCRD7RNgYFX10MNngGfPkT0PH8g13T6Z0kw2MOTGKn44uyry5d5BunUGUaAt4HVp2zFKGeunFe3W3dJH0X7y8TgKdev&from=$start";
  
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
$estado_firma = $fila->estado_firma_sign;
$fecha_ingreso = $fila->{"ORDEN_DE_CONTRATACI_N_Numero_de_Orden.Fecha_de_Ingreso"};
$contrato_num = $fila->N_mero_de_Contrato;
$fecha_contratacion = $fila->Fecha_de_Contrataci_n;
$nombres = $fila->NOMBRES_Y_APELLIDOS->display_value;
$documento = $fila->DOCUMENTO;
$empresa_usuaria = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.EMPRESA_USURIA"};
$cargo = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.CARGO"};
$temporal = $fila->TEMPORAL_aplicar_convocatoria->display_value;
$contratado = $fila->Contratado;
$convocatoria = $fila->CONVOCATORIAS_APLICAR_CONVOCATORIA->display_value;
$estado = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.ESTADO"};

      echo "<script>dto = {'id':'$id','estado_firma_sign':'$estado_firma','Fecha_de_Ingreso':'$fecha_ingreso','N_mero_de_Contrato':'$contrato_num','Fecha_de_Contrataci_n':'$fecha_contratacion','NOMBRES_Y_APELLIDOS':'$nombres','DOCUMENTO':'$documento','EMPRESA_USURIA':'$empresa_usuaria','CARGO':'$cargo','TEMPORAL_aplicar_convocatoria':'$temporal','Contratado':'$contratado','CONVOCATORIAS_APLICAR_CONVOCATORIA':'$convocatoria','estado':'$estado'};
      object.push(dto);</script>";

    }
  } 
}
?>

<script>

var printIcon = function(cell, formatterParams){ //plain text value
    return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button>';
};

var contratado = function(cell, formatterParams){ //plain text value
	if(cell.getRow().getData().Contratado == true)
	{
		return '<button id="viewbtn" class="btn btn-light btn-sm" disabled><i class="fas fa-user-check"></i> Hecho</button>';
	}
    else if( cell.getRow().getData().Contratado == false && cell.getRow().getData().N_mero_de_Contrato != "" && cell.getRow().getData().Fecha_de_Contrataci_n != "")
    {
        return '<button id="viewbtn" class="btn btn-outline-info btn-sm">Contratado</button>';
    }
	else return '<span>No disponible</span>';
    
};
var actualizarSign = function(cell, formatterParams){ 
    return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-sync"></i> Actualizar Sign</button>';
};


 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitColumns",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,

  
    groupBy:function(data){
		
        return data.CONVOCATORIAS_APLICAR_CONVOCATORIA + " > " + data.estado;
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
	

        {formatter:printIcon, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){
			
			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/APLICAR_CONVOCATORIAS/record-edit/VER_POSTULADOS_CONTRATADOS/" + cell.getRow().getData().id + "/E185MUp8nGCRD7RNgYFX10MNngGfPkT0PH8g13T6Z0kw2MOTGKn44uyry5d5BunUGUaAt4HVp2zFKGeunFe3W3dJH0X7y8TgKdev?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
			window.open(link, '_blank');


		}},
	
{title:"Estado Firma - Sign", field:"estado_firma_sign"},
	 	{title:"Fecha de Ingreso", field:"Fecha_de_Ingreso"},	 	
	 	{title:"Contrato", field:"N_mero_de_Contrato"},
	 	{title:"Fecha de Contratación", field:"Fecha_de_Contrataci_n"},
	 	{title:"Nombres", field:"NOMBRES_Y_APELLIDOS"},
	 	{title:"Documento", field:"DOCUMENTO"},
	 	{title:"Empresa", field:'EMPRESA_USURIA'},
	 	{title:"Cargo", field:'CARGO'},
        {title:"Temporal", field:'TEMPORAL_aplicar_convocatoria'},
      
        
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
var empresa = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"DOCUMENTO", type:"like", value:documento},
      {field:"EMPRESA_USURIA", type:"like", value:empresa},
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
  else if($para == "empresa")
  {
    empresa = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "nombre")
    {
      sendToFiltrar = {field: "NOMBRES_Y_APELLIDOS",type:"like",value: $filter};      
    }

    if($specific == "cargo")
    {
      sendToFiltrar = {field: "CARGO",type:"like",value: $filter};      
    }

    if($specific == "temporal")
    {
      sendToFiltrar = {field: "TEMPORAL_aplicar_convocatoria",type:"like",value: $filter};      
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