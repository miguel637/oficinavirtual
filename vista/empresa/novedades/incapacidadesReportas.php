<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/hq5/report-embed/APLICAR_CONVOCATORIAS_Report/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R'></iframe>
?>
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Cédula</label>
      <input aria-controls="cedula" type="text" placeholder="Buscar por cédula" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Nombres y Apellidos</label>
      <input aria-controls="nombres" type="text" placeholder="Buscar por nombre" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="incapacidad">Tipo de incapacidad</option>

      </select>
      <input aria-controls="specific" placeholder="Otros filtros" type="text" Class="form-control buscarData">
    </div>
  </div>

  <div class='text-center m-3 '>
    <span id="example-table-info"></span>
    <button id="download-xls" style="position:absolute; right:4%;" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Exportar excel</button>    
  </div>

  <div id="table-rendered" class="mt-5"></div>

<?php
echo "<script>object = [];</script>";

$start = 0;
while($start < 1001)
{

    $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/ecosistema-temporal/report/Incapacidades_Generadas?privatelink=hD4JQONRzEpMOJPq5nKAvPKVK5bUr4qwm9yp1ZxAFGZ3rHMQF6447VSvmjZPuns5GRYeZakpZEB3t9qDbsbJJpJpHtT7ddtMh7Ub&from=$start&Codigo_Empresa=". $_SESSION['codigoEmpresa_user'];
  
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

        $identficacion = $fila->Identificaci_n->display_value;
        $estado = $fila->Estado_Trabajador;
        $observaciones = $fila->Observaciones;

        if($estado =='Rechazado' && $observaciones==''){
          $observaciones = 'Sin observaciones';     
        }else {
        $observaciones = $fila->Observaciones;
        }

      echo "<script>dto = {'fecha_registro':'$fila->Added_Time','id':'$fila->ID','tipo_incapacidad':'$fila->Tipo_de_Incapacidad','Estado':'$estado','identificacion':'$identficacion','observaciones':'$observaciones','Nombres_y_Apellidos':'$fila->Nombres_y_Apellidos','fecha_inicio':'$fila->Fecha_de_Inicio_Incapacidad','fecha_final':'$fila->Fecha_de_Fin_Incapacidad','dias_inc':'$fila->Dias_de_Incapacidad'};object.push(dto);</script>";

    }
  }
}
?>
<script>

	var viewButton = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
    };


 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitData",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,
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
	paginationSizeSelector:[15, 25, 50, 110],
 	columns:[
		{formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/ecosistema-temporal/record-summary/Incapacidades_Generadas/" + cell.getRow().getData().id + "/hD4JQONRzEpMOJPq5nKAvPKVK5bUr4qwm9yp1ZxAFGZ3rHMQF6447VSvmjZPuns5GRYeZakpZEB3t9qDbsbJJpJpHtT7ddtMh7Ub";
			window.open(link, '_blank');
		}},
	

        {title:"Fecha Registro", field:"fecha_registro"},
        {title:"Tipo de Incapacidad",field:"tipo_incapacidad"},
        {title:"Identificación",field:"identificacion"},
        {title:"Nombres y Apellidos",field:"Nombres_y_Apellidos"},
        {title:"Fecha Inicio Incapacidad",field:"fecha_inicio"},
        {title:"Fecha final Incapacidad",field:"fecha_final"},
        {title:"Días de Incapacidad",field:"dias_inc"},
        {title:"Casual de Rechazo",field:"observaciones"},
   	
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

var cedula = "";
var nombres = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"identificacion", type:"like", value:cedula},
      {field:"Nombres_y_Apellidos", type:"like", value:nombres},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "cedula")
  {
    cedula = $filter;
  }
  else if($para == "nombres")
  {
    nombres = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "incapacidad")
    {
      sendToFiltrar = {field: "tipo_incapacidad",type:"like",value: $filter};      
    }

    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Incapacidades<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_Incapacidades"});
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



#download-xls:hover{
    background-color:#FF4C26;
    color:white;
    border-color:#FF4C26;  
}


</style>