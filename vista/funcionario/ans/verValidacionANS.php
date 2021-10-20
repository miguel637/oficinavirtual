
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
    <label for="">Aprobador</label>
      <input aria-controls="aprobador" type="text" id="focu" placeholder="Buscar por Aprobador" class="form-control buscarData">
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
while($start < 1001)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/ANS_Validations?privatelink=HG6kOyuMfMNAgO2hsffmxZWMqxZuhb8SGQhG2q6n7vht8MCuf88DDbPS5xOJTRx8ECAOJEvzbr36RvnkgSp2t1jUQr9HbqnQJfuY&from=$start";
  
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

   if(isset($fila->CLIENTE->display_value)){
       $cliente = $fila->CLIENTE->display_value;
   }else {$cliente="";}

   $aprobadores = $fila->No_Aprobadores;
   $contratacion = $fila->CONTRATACION;
   $sst = $fila->SST;
   $compensacion = $fila->COMPENSACION;
   $facturacion = $fila->FACTURACION;
   $bienestar = $fila->BIENESTAR;
   $procesos = $fila->PROCESOS_DISCIPLINARIOS;

      echo "<script>dto = {'id':'$id','CLIENTE':'$cliente','No_Aprobadores':'$aprobadores','CONTRATACION':'$contratacion','SST':'$sst','COMPENSACION':'$compensacion','FACTURACION':'$facturacion','BIENESTAR':'$bienestar','PROCESOS_DISCIPLINARIOS':'$procesos'};
      object.push(dto);</script>";

    }
  } 
}
?>

<script>

	var viewButton = function(cell, formatterParams){ //plain text value
   		return '<button id="viewbtn"  class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
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

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/ANS_Validations/" + cell.getRow().getData().id + "/HG6kOyuMfMNAgO2hsffmxZWMqxZuhb8SGQhG2q6n7vht8MCuf88DDbPS5xOJTRx8ECAOJEvzbr36RvnkgSp2t1jUQr9HbqnQJfuY";
			window.open(link, '_blank');
		}},


        {title:"Cliente", field:"CLIENTE"},
	 	{title:"Nº Aprobadores", field:"No_Aprobadores"},
 
        {title:"Selección", hozAlign:"center", field:"CONTRATACION", formatter:function(cell, formatterParams){

var value = cell.getValue();
if(value > 0) return "SI";
else return "NO";
}},	
{title:"Contratación", hozAlign:"center", field:"CONTRATACION", formatter:function(cell, formatterParams){
var value = cell.getValue();
if(value > 0) return "SI";
else return "NO";
}},	 
{title:"SST", hozAlign:"center", field:"SST", formatter:function(cell, formatterParams){
var value = cell.getValue();
if(value > 0) return "SI";
else return "NO";
}},	 
{title:"Compensación", hozAlign:"center", field:"COMPENSACION", formatter:function(cell, formatterParams){
var value = cell.getValue();
if(value > 0) return "SI";
else return "NO";
}},	 
{title:"Facturación", hozAlign:"center", field:"FACTURACION", formatter:function(cell, formatterParams){
var value = cell.getValue();
if(value > 0) return "SI";
else return "NO";
}},	 
{title:"Bienestar", hozAlign:"center", field:"BIENESTAR", formatter:function(cell, formatterParams){
var value = cell.getValue();
if(value > 0) return "SI";
else return "NO";
}},
{title:"Procesos Disciplinarios", hozAlign:"center", field:"PROCESOS_DISCIPLINARIOS", formatter:function(cell, formatterParams){
var value = cell.getValue();
if(value > 0) return "SI";
else return "NO";
}},
	
 
      
        
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
var aprobador = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"CLIENTE", type:"like", value:cliente},
      {field:"No_Aprobadores", type:"like", value:aprobador},
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
  else if($para == "aprobador")
  {
    aprobador = $filter;
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
    table.download("xlsx", "Ans_Validaciones_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_Validaciones"});
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