
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Cliente</label>
      <input aria-controls="cliente" id="focu" type="search" placeholder="Buscar por Cliente" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Encargado</label>
      <input aria-controls="encargado" id="focu" type="search" placeholder="Buscar por encargado" class="form-control buscarData">
    </div>

	<!--
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="cliente">Razón social</option>

      </select>
      <input aria-controls="specific" placeholder="Otros filtros" type="text" Class="form-control buscarData">
    </div>
	-->
  </div>

  <div class='text-center m-3 '>
    <span id="example-table-info"></span>
    <button id="download-xls" style="text-align:center;" id="viewbtn" class="btn btn-outline-secondary"><i class="fas fa-download"></i> Exportar excel</button>    
  </div>

  <div id="table-rendered" class="mt-5"></div>

<?php
echo "<script>object = [];</script>";

$start = 0;
while($start < 1001)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/OV_VER_COMPENSACI_N?privatelink=QqvfWtnCb5574FvCBtn4CNaEghhNZ219RxXe8uwvgJYgPjO0bdSNEk8WHz0w5pa10CP2YeUeCnVp00vgReBMG3F4PrJOEKWtKd3S&from=$start";
  
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
  
if(isset($fila->CLIENTE_COMPENSACION->display_value)){ $cliente = $fila->CLIENTE_COMPENSACION->display_value; } else {$cliente="";}
		

		

		if(isset($fila->AUTORIZADORES[0]->display_value)){
			$encargado = $fila->AUTORIZADORES[0]->display_value;
		}else {
			$encargado = "";
		}
$periodo_pago = $fila->PERIODICIDAD_DE_PAGO;
$dias_pago = $fila->D_AS_DE_PAGO_FECHAS;
$pago_liquidacion = $fila->TIEMPO_PARA_PAGO_DE_LIQUIDACIONES;
$id = $fila->ID;
$comprobante = $fila->ENV_O_DE_COMPROBANTES_DE_N_MINA;
$dias_liquidacion = $fila->{"CLIENTE_COMPENSACION.CUANTOS_D_AS_ANTES_SE_REPORTARA_LAS_NOVEDADES"};
$observaciones = $fila->OBSERVACIONES_NOMINA;

      echo "<script>dto = {'id':'$id','CLIENTE_COMPENSACION':'$cliente','AUTORIZADORES':'$encargado','PERIODICIDAD_DE_PAGO':'$periodo_pago','D_AS_DE_PAGO_FECHAS':'$dias_pago','TIEMPO_PARA_PAGO_DE_LIQUIDACIONES':'$pago_liquidacion','ENV_O_DE_COMPROBANTES_DE_N_MINA':'$comprobante','CUANTOS_D_AS_ANTES_SE_REPORTARA_LAS_NOVEDADES':'$dias_liquidacion','OBSERVACIONES_NOMINA':'$observaciones'};
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
   		return '<button id="viewbtn"  class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Editar</button>';
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

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/OV_VER_COMPENSACI_N/" + cell.getRow().getData().id + "/QqvfWtnCb5574FvCBtn4CNaEghhNZ219RxXe8uwvgJYgPjO0bdSNEk8WHz0w5pa10CP2YeUeCnVp00vgReBMG3F4PrJOEKWtKd3S";
			window.open(link, '_blank');
		}},


    {formatter:editButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/COMPENSACI_N/record-edit/OV_VER_COMPENSACI_N/" + cell.getRow().getData().id + "/QqvfWtnCb5574FvCBtn4CNaEghhNZ219RxXe8uwvgJYgPjO0bdSNEk8WHz0w5pa10CP2YeUeCnVp00vgReBMG3F4PrJOEKWtKd3S?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]);?>";
window.open(link, '_blank');
}},
	

        {title:"Cliente", field:"CLIENTE_COMPENSACION"},
	 	{title:"Encargado", field:"AUTORIZADORES"},	
	 	{title:"Periocidad Pago", field:"PERIODICIDAD_DE_PAGO"},	 
	 	{title:"Dias de Pago", field:"D_AS_DE_PAGO_FECHAS"},	 
	 	{title:"Tiempo Pagar Liquidaciones", field:"TIEMPO_PARA_PAGO_DE_LIQUIDACIONES"},	 
	 	{title:"Envío Comprobante Nómina", field:"ENV_O_DE_COMPROBANTES_DE_N_MINA"},	 
	 	{title:"Dias Antes de Reporte Novedades", field:"CUANTOS_D_AS_ANTES_SE_REPORTARA_LAS_NOVEDADES"},
	 	{title:"Observaciones", field:"OBSERVACIONES_NOMINA"},
      
        
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

var cliente = "";
var encargado = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"CLIENTE_COMPENSACION", type:"like", value:cliente},
      {field:"AUTORIZADORES", type:"like", value:encargado},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "cliente")
  {
    cliente = $filter;
  }
  else if($para == "encargado")
  {
    encargado = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "cliente")
    {
      sendToFiltrar = {field: "razon_social",type:"like",value: $filter};      
    }

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
    table.download("xlsx", "Ans_Ver_Compensacion_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_Compensaciones"});
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