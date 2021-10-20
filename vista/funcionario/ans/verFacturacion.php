
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Cliente</label>
      <input aria-controls="cliente" type="text" id="focu" placeholder="Buscar por Cliente" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Nit</label>
      <input aria-controls="nit" type="text" id="focu" placeholder="Buscar por Nit" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="correo">Correo registrado</option>
        <option value="telefono">Telefono</option>
        <option value="direccion">Dirección</option>

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

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/OV_VER_FACTURACION?privatelink=5jwHGrywxRX0jFqhuw2WXCveJk5YrThNvtCF4XUWgFW3TZmdV1pMu9H7XzD6yHKOWOGW8FJjKKA8AKGQNAtJQ6FJrDw9MpBswZTu&from=$start";
  
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
      $cliente = str_replace("'"," ",$fila->CLIENTE_FACTURACION->display_value);
      $direccion_principales = $fila->DIRECCI_N_PRINCIPAL_REGISTRADA_EN_EL_RUT;
      $correo_registrado = $fila->EMAIL_REGISTRADO_EN_EL_RUT;
      $codigo_postal = $fila->CODIGO_POSTAL;
      $telefono = $fila->TELEFONO_REGISTRADO_EN_EL_RUT;
      $periodo_pago = $fila->PERIODO_DE_PAGO_DE_LA_FACTURA;
      $periodo_factura = $fila->PERIODICIDAD_DE_LA_FACTURACI_N;
      $observaciones = str_replace("\n"," ",$fila->OBSERVACIONES);
      $nit = $fila->{'CLIENTE_FACTURACION.NIT'};

      echo "<script>dto = {'id':'$id','CLIENTE_FACTURACION':'$cliente','DIRECCI_N_PRINCIPAL_REGISTRADA_EN_EL_RUT':'$direccion_principales','EMAIL_REGISTRADO_EN_EL_RUT':'$correo_registrado','CODIGO_POSTAL':'$codigo_postal','TELEFONO_REGISTRADO_EN_EL_RUT':'$telefono','PERIODO_DE_PAGO_DE_LA_FACTURA':'$periodo_pago','PERIODICIDAD_DE_LA_FACTURACI_N':'$periodo_factura','OBSERVACIONES':'$observaciones','NIT':'$nit'};
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
	paginationSizeSelector:[15, 25, 50, 110],
 	columns:[
		{formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/OV_VER_FACTURACION/" + cell.getRow().getData().id + "/5jwHGrywxRX0jFqhuw2WXCveJk5YrThNvtCF4XUWgFW3TZmdV1pMu9H7XzD6yHKOWOGW8FJjKKA8AKGQNAtJQ6FJrDw9MpBswZTu";
			window.open(link, '_blank');
		}},


    {formatter:editButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/FACTURACION/record-edit/OV_VER_FACTURACION/" + cell.getRow().getData().id + "/5jwHGrywxRX0jFqhuw2WXCveJk5YrThNvtCF4XUWgFW3TZmdV1pMu9H7XzD6yHKOWOGW8FJjKKA8AKGQNAtJQ6FJrDw9MpBswZTu?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]);?>";
window.open(link, '_blank');
}},
	

    {title:"Cliente", field:"CLIENTE_FACTURACION"},
    {title:"Nit", field:"NIT"},
    {title:"Dirección Principal", field:"DIRECCI_N_PRINCIPAL_REGISTRADA_EN_EL_RUT"},	
	 	{title:"Email", field:"EMAIL_REGISTRADO_EN_EL_RUT"},	 
	 	{title:"Codigo Postal", field:"CODIGO_POSTAL"},	 
	 	{title:"Teléfono", field:"TELEFONO_REGISTRADO_EN_EL_RUT"},	 
	 	{title:"Periodo de Pago", field:"PERIODO_DE_PAGO_DE_LA_FACTURA"},	 
	 	{title:"Periodicidad de Facturacion", field:"PERIODICIDAD_DE_LA_FACTURACI_N"},
	 	{title:"Observaciones", field:"OBSERVACIONES"},

     
        
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
var nit = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"CLIENTE_FACTURACION", type:"like", value:cliente},
      {field:"NIT", type:"like", value:nit},
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
  else if($para == "nit")
  {
    nit = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "correo")
    {
      sendToFiltrar = {field: "EMAIL_REGISTRADO_EN_EL_RUT",type:"like",value: $filter};      
    }

	if($specific == "telefono")
    {
      sendToFiltrar = {field: "TELEFONO_REGISTRADO_EN_EL_RUT",type:"like",value: $filter};      
    }

    if($specific == "direccion")
    {
      sendToFiltrar = {field: "DIRECCI_N_PRINCIPAL_REGISTRADA_EN_EL_RUT",type:"like",value: $filter};      
    }

    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Ans_Ver_Facturacion_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_Facturacion"});
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