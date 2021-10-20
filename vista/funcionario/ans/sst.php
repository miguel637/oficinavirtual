
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Cliente</label>
      <input aria-controls="cliente" type="text" id="focu" placeholder="Buscar por Cliente" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Responsable</label>
      <input aria-controls="responsable" id="focu" type="text" placeholder="Buscar por Responsable" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="telefono">Teléfono</option>

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

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/SST_Report?privatelink=JDZeyJA5bw92rOpUS2gRQrqbQJNpm0gxSmHnAOPeVOV3TKHtSBztmewnhQemjxhTOYYdYk3FPtKqBUaWYmqkJqJWgKmmty1mG3tT&from=$start";
  
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
$emrpesa = $fila->CLIENTE_SST->display_value;
$responsable_sst = $fila->Section;
$correo= $fila->E_mail;
$telefono = $fila->TEL_FONO;
$arl_usuaria = $fila->ARL_USUARIA;
$actividad_eco = $fila->ACTIVIDAD_ECON_MICA;
$accidentes_anteriores = $fila->ACCIDENTES_A_O_ANTERIOR;

      echo "<script>dto = {'id':'$id','CLIENTE_SST':'$emrpesa','Section':'$responsable_sst','E_mail':'$correo','TEL_FONO':'$telefono','ACTIVIDAD_ECON_MICA':'$actividad_eco','ACCIDENTES_A_O_ANTERIOR':'$accidentes_anteriores','ARL_USUARIA':'$arl_usuaria'};
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

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/SST_Report/" + cell.getRow().getData().id + "/JDZeyJA5bw92rOpUS2gRQrqbQJNpm0gxSmHnAOPeVOV3TKHtSBztmewnhQemjxhTOYYdYk3FPtKqBUaWYmqkJqJWgKmmty1mG3tT";
			window.open(link, '_blank');
		}},


	

        {title:"Cliente", field:"CLIENTE_SST"},
        {title:"Responsable de SST Usuaria", field:"Section"},
        {title:"E-mail",field:"E_mail"},
        {title:"Telefono",field:"TEL_FONO"},
        {title:"ARL Usuaria",field:"ARL_USUARIA"},
        {title:"Actividad Económica",field:"ACTIVIDAD_ECON_MICA"},
        {title:"# Accidentes del Año Anterior",field:"ACCIDENTES_A_O_ANTERIOR"},
      
        
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
var responsable = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"CLIENTE_SST", type:"like", value:cliente},
      {field:"Section", type:"like", value:responsable},
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
  else if($para == "responsable")
  {
    responsable = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "telefono")
    {
      sendToFiltrar = {field: "TEL_FONO",type:"like",value: $filter};      
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