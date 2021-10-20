<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/hq5/report-embed/APLICAR_CONVOCATORIAS_Report/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R'></iframe>
?>
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

<div class="row">
      <div class="col-4">
        <label for="">Cedula</label>
        <input aria-controls="cedula" type="text" placeholder="Buscar por cedula" class="form-control buscarData">
      </div>
      <div class="col-4">
        <label for="">Fecha de reporte</label>
        <input aria-controls="fecha" type="text" placeholder="Buscar por fecha" class="form-control buscarData">
      </div>
      <div class="col-4">
        <select id="filtropor" class="form-control">
          <option value="seleccionar">Seleccionar...</option>
          <option value="nombres">Nombres y apellidos</option>
          <option value="cargo">Cargo</option>
          <option value="codigo_reporte">Codigo Reporte</option>
          <option value="est">Est</option>
        </select>
        <input aria-controls="specific" type="text" Class="form-control buscarData">
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
$url = "https://creator.zoho.com/publishapi/v2/hq5colombia/sst/report/Reporte_Covid_19_Report?privatelink=txe9T8xPQRtZbDQbv4wkKVJ2NhGJm5xOqeYFEkKY1pyDhBb6mQGg6939enPunPpBEVwPOzGtQ1vmNFbY5dUVj597AaCC4XSfHha2&from=$start&criteria=Codigo_Empresa==". $_SESSION['codigoEmpresa_user'];
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

           $documento = $fila->documento->display_value;    
           $id = $fila->ID  ;

		echo "<script>dto = {'Estado':'$fila->Estado_del_Trabajador','Fecha_reporte':'$fila->Fecha_y_Hora_del_Reporte_Covid','Nombres':'$fila->Apellidos_y_Nombres','Documento':'$documento','Cargo':'$fila->Cargo','Sintomas':'$fila->S_ntomas_o_Datos_de_Contagio','ID_reporte':'$fila->ID_Reporte','Empresa':'$fila->Empresa','Est':'$fila->EST','id':'$id'}</script>";
		echo "<script>object.push(dto);</script>";
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
	layout:"fitColumns",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,
    groupBy:function(data){
		
        return data.Estado + " - " + data.Est;
    },
    groupHeader:function(value, count, data, group){
    //value - the value all members of this group share
    //count - the number of rows in this group
    //data - an array of all the row data objects in this group
    //group - the group component for the group

        return value + "<span style='color:#d00; margin-left:10px;'>("+count+")</span>";
    },
	paginationSizeSelector:[15, 25, 50, 100],
 	columns:[
		{formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/sst/record-summary/Reporte_Covid_19_Report/" + cell.getRow().getData().id + "/txe9T8xPQRtZbDQbv4wkKVJ2NhGJm5xOqeYFEkKY1pyDhBb6mQGg6939enPunPpBEVwPOzGtQ1vmNFbY5dUVj597AaCC4XSfHha2";
			window.open(link, '_blank');
		}}, 





	
     {title:"Fecha Reporte", field:"Fecha_reporte"},
     {title:"Apellidos y Nombres",field:"Nombres"},  
     {title:"Documento",field:"Documento"},  
     {title:"Cargo",field:"Cargo"},  
     {title:"ID Reporte",field:"ID_reporte"},  
     {title:"Sintomas",field:"Sintomas"},   
     
 	],
     
     langs:{
        "colombinos":{
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


table.setLocale("colombinos");





var filtro_cedula = "";
var filtro_fecha = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"Documento", type:"like", value: filtro_cedula},
      {field:"Fecha_reporte", type:"like", value: filtro_fecha},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "cedula")
  {
    filtro_cedula = $filter;
  }
  else if($para == "fecha")
  {
    filtro_fecha = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "nombres")
    {
      sendToFiltrar = {field: "Nombres",type:"like",value: $filter};      
    }

    if($specific == "cargo")
    {
      sendToFiltrar = {field: "Cargo",type:"like",value: $filter};      
    }

    if($specific == "codigo_reporte")
    {
      sendToFiltrar = {field: "ID_reporte",type:"like",value: $filter};      
    }


    if($specific == "est"){

   sendToFiltrar = {field:"Est",type:"like",value:$filter};


    }


    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Reporte covid_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_reporte_Covid"});
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
 

