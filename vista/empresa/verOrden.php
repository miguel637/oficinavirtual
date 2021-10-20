<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Número de orden</label>
      <input aria-controls="orden" type="text" placeholder="Buscar por Número de orden" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Cédula</label>
      <input aria-controls="cedula" type="text" placeholder="Buscar por Cédula" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="nombres">Nombres y apellidos</option>
        <option value="cargo">Cargo</option>
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

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/ORDEN_DE_CONTRATACI_N_Report?privatelink=Efd64MDsQFwrA7MwD3xXWrmSMD41mgXWwC2QKOVKVbOvPSxHzfUH5JEkPQSTttvXBjp5myS47KRffR36b1QkNGK4bUjUQnRkxkKm&from=$start&criteria=NOMBRE_EMPRESA_SOLICITANTE_CONTRATACI_N.ID==". $_SESSION['idEmpresa_user'];
  
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

    
$empresa_solicitante = $fila->NOMBRE_EMPRESA_SOLICITANTE_CONTRATACI_N->display_value;
$centro_costo = $fila->Centro_de_Costos_o_sub_centro->display_value;
$Postulacion = $fila->Postulacion->display_value;
$Convocatoria = $fila->Convocatoria->display_value;
$nombres= $fila->Apellidos_Y_Nombres_Completos_de_la_Persona_a_Contratar->display_value;
$departamento = $fila->DEPARTAMENTOORDENCONTRATACION->display_value;
$ciudad = $fila->CIUDAD->display_value;
$id = $fila->ID;

		echo "<script>dto = {'Numero':'$fila->Numero_de_Orden','Empresa':'$empresa_solicitante','Centro':'$centro_costo','Postulacion':'$Postulacion','Convocatoria':'$Convocatoria','Nombres':'$nombres','Cargo':'$fila->Cargo_de_la_Persona_a_Contratar','persona_manejo':'$fila->Persona_de_Manejo_y_Confianza','Sitio':'$fila->Sitio_De_Trabajo_y_o_rea','Departamento':'$departamento','Ciudad':'$ciudad','Beneficio_no_salarial':'$fila->Beneficios_no_salarial_No_prestacionales','Beneficio_salarial':'$fila->Beneficios_Salarial_Prestacionales','Empresa_temporal':'$fila->Empresa_de_servicios_temporales','Identificacion':'$fila->Identificaci_n','id':'$id'};</script>";
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
	layout:"fitData",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:15,
    groupBy:function(data){
		
        return data.Empresa+" - "+data.Centro+" - "+data.Cargo;
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

            var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/ORDEN_DE_CONTRATACI_N_Report/" + cell.getRow().getData().id + "/Efd64MDsQFwrA7MwD3xXWrmSMD41mgXWwC2QKOVKVbOvPSxHzfUH5JEkPQSTttvXBjp5myS47KRffR36b1QkNGK4bUjUQnRkxkKm";
			window.open(link, '_blank');
		}},
	

{title:"Numero de Orden", field:"Numero"},
 {title:"Empresa",field:"Empresa"},
 {title:"Centro de Costo Sub Centro",field:"Centro"},
 {title:"Postulacion",field:"Postulacion"},
 {title:"Convocatoria",field:"Convocatoria"},
 {title:"Nombres y apellidos",field:"Nombres"},
 {title:"Cargo",field:"Cargo"},
 {title:"Persona de Manejo y Confianza",field:"persona_manejo"},
 {title:"Sitio de Trabajo y/o Área",field:"Sitio"},
 {title:"Departamento",field:"Departamento"},
 {title:"Ciduad",field:"Ciudad"},
 {title:"Salario Asignado Mensual: (Prestacionales)",field:"Beneficio_no_salarial"},
 {title:"Beneficios no salarial: (No prestacionales)",field:"Beneficio_salarial"},
 {title:"Empresa de servicios temporales",field:"Empresa_temporal"},
 {title:"Identificación",field:"Identificacion"},
   	
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

var orden = "";
var cedula = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"Numero", type:"like", value:orden},
      {field:"Identificacion", type:"like", value:cedula},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "orden")
  {
    orden = $filter;
  }
  else if($para == "cedula")
  {
    cedula = $filter;
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


    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Ordenes_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_Ordenes"});
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