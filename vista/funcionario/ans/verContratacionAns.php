
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

    <!--
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

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/CONTRATACI_N_Report?privatelink=0yqQakWpsehxvjdfr9z4UaQWE3sUeAweED35RmV4QPY4EfArwvE2VtzWTB6yW1ywkP6ynEwObxwgCywDW0npC2hX4OA0WBHt6QEZ&from=$start";
  
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
     if(isset($fila->CLIENTE_CONTRATACION->display_value)){
        $cliente_contratacion = $fila->CLIENTE_CONTRATACION->display_value;
     }else {$cliente_contratacion="";}
    
     $medio_inforamcion = $fila->MEDIO_DE_INFORMACI_N_DE_LA_CONTRATACI_N;
     $tiempo_promedio = $fila->TIEMPO_PROMEDIO_DE_CONTRATACI_N;
     $observaciones = $fila->OBSERVACIONES_AUTORIZACION_INGRESOS;
     $permite_ingresos = $fila->PERMITE_INGRESOS_DE_PERSONAL_CON_DOCUMENTACI_N_INCOMPLETA;
     $que_documentos = $fila->QUE_DOCUMENTOS_PERMITE_LA_USUARIA_DEJAR_PENDIENTES_CON_COMPROMISO_DE_ENTREGARLOS_A_LOS_15_DIAS;


      echo "<script>dto = {'id':'$id','CLIENTE_CONTRATACION':'$cliente_contratacion','MEDIO_DE_INFORMACI_N_DE_LA_CONTRATACI_N':'$medio_inforamcion','TIEMPO_PROMEDIO_DE_CONTRATACI_N':'$tiempo_promedio','OBSERVACIONES_AUTORIZACION_INGRESOS':'$observaciones','PERMITE_INGRESOS_DE_PERSONAL_CON_DOCUMENTACI_N_INCOMPLETA':'$permite_ingresos','QUE_DOCUMENTOS_PERMITE_LA_USUARIA_DEJAR_PENDIENTES_CON_COMPROMISO_DE_ENTREGARLOS_A_LOS_15_DIAS':'$que_documentos'};
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

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/CONTRATACI_N_Report/" + cell.getRow().getData().id + "/0yqQakWpsehxvjdfr9z4UaQWE3sUeAweED35RmV4QPY4EfArwvE2VtzWTB6yW1ywkP6ynEwObxwgCywDW0npC2hX4OA0WBHt6QEZ";
			window.open(link, '_blank');
		}},

	

        {title:"Cliente", field:"CLIENTE_CONTRATACION"},
        {title:"Medio de Información de la Contratación", field:"MEDIO_DE_INFORMACI_N_DE_LA_CONTRATACI_N"},
        {title:"Tiempo promedio de la Contratación",field:"TIEMPO_PROMEDIO_DE_CONTRATACI_N"},
        {title:"Observaciones",field:"OBSERVACIONES_AUTORIZACION_INGRESOS"},
        {title:"Permite Ingreso con Documentacion Incompleta",field:"PERMITE_INGRESOS_DE_PERSONAL_CON_DOCUMENTACI_N_INCOMPLETA"},
        {title:"Que Documentos permite dejar Pendientes con Compromiso De Entrega alos 15 dias",field:"QUE_DOCUMENTOS_PERMITE_LA_USUARIA_DEJAR_PENDIENTES_CON_COMPROMISO_DE_ENTREGARLOS_A_LOS_15_DIAS"},

      
        
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


function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"CLIENTE_CONTRATACION", type:"like", value:cliente},

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
    table.download("xlsx", "Ans_Ver_contratacion_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_ver_contratacion"});
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