
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Nit</label>
      <input aria-controls="nit" type="text" id="focu" placeholder="Buscar por Nit" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Código empresa</label>
      <input aria-controls="codigo" id="focu" type="text" placeholder="Buscar por codigo" class="form-control buscarData">
    </div>
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

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/OV_VER_CLIENTES?privatelink=6PXuYrVyJ7PSKyvPvpvhKX5J0r4EN8F0wWvEwQGU8g9tbt1xkDDYAzZD3gdPXnnMAMNZGvbhnCqNDUstSt6YVXN1GK4JMV7Tkjq8&from=$start";
  
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
  
$cliente = $fila->RAZ_N_SOCIAL;

$str = $cliente;
$new_str = str_replace("'", ' ', $str);

$nit = $fila->NIT;
$codigo_empresa = $fila->C_DIGO_CLIENTE;
$est = $fila->EST[0];
$ciudad = $fila->CIUDAD->display_value;
$representante = $fila->REPRESENTANTE_LEGAL;
$comercial = $fila->CONTACTO_COMERCIAL;
$id = $fila->ID;


      echo "<script>dto = {'razon_social':'$new_str','nit':'$nit','codigo_empresa':'$codigo_empresa','est':'$est','ciudad':'$ciudad','Representante':'$representante','comercial':'$comercial','id':'$id'};
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

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/OV_VER_CLIENTES/" + cell.getRow().getData().id + "/6PXuYrVyJ7PSKyvPvpvhKX5J0r4EN8F0wWvEwQGU8g9tbt1xkDDYAzZD3gdPXnnMAMNZGvbhnCqNDUstSt6YVXN1GK4JMV7Tkjq8";
			window.open(link, '_blank');
		}},


    {formatter:editButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/CLIENTE1/record-edit/OV_VER_CLIENTES/" + cell.getRow().getData().id + "/6PXuYrVyJ7PSKyvPvpvhKX5J0r4EN8F0wWvEwQGU8g9tbt1xkDDYAzZD3gdPXnnMAMNZGvbhnCqNDUstSt6YVXN1GK4JMV7Tkjq8?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]);?>";
window.open(link, '_blank');
}},
	

        {title:"Razón social", field:"razon_social"},
        {title:"NIT", field:"nit"},
        {title:"Codigo",field:"codigo_empresa"},
        {title:"EST",field:"est"},
        {title:"Ciudad",field:"ciudad"},
        {title:"Representante Legal",field:"Representante"},
        {title:"Contacto Comercial",field:"comercial"},
      
        
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

var nit = "";
var codigo = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"nit", type:"like", value:nit},
      {field:"codigo_empresa", type:"like", value:codigo},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "nit")
  {
    nit = $filter;
  }
  else if($para == "codigo")
  {
    codigo = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "cliente")
    {
      sendToFiltrar = {field: "razon_social",type:"like",value: $filter};      
    }

    if($specific == "est")
    {
      sendToFiltrar = {field: "est",type:"like",value: $filter};      
    }

    if($specific == "ciudad")
    {
      sendToFiltrar = {field: "ciudad",type:"like",value: $filter};      
    }

    if($specific == "representante"){
      sendToFiltrar = {field:"Representante",type:"like",value:$filter};
    }

    if($specific == "comercial"){

      sendToFiltrar = {field:"comercial",type:"like",value:$filter};
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