
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Convocatoria</label>
      <input aria-controls="convocatoria" type="text" id="focu" placeholder="Buscar por Convocatoria" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Documento</label>
      <input aria-controls="documento" id="focu" type="text" placeholder="Buscar por Documento" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="nombres">Nombres y Apellidos</option>
        <option value="psicologo">Psicólogo(a)</option>
  
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
while($start < 2001)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/OV_REFERENCIACIONES?privatelink=yRZsazrX5TUkpwgwhKBP5FsaECWE8whhVmqJh3ASxynqBzSvKprvwrqEPdZnsr4kHzHDC6Vnak7zdAz54SWthmTN9DEywYP2pUkm&from=$start";
  
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
$cod_entrevista = $fila->C_DIGO_DE_ENTREVISTA;
$convo = $fila->CONVOCATORIA_ENTREVISTA->display_value;
$psicologo = $fila->PSICOLOGO_ENCARGADO[0]->display_value;

if(isset($fila->POSTULACI_N_ENTREVISTA->display_value)){
    $postulacion = $fila->POSTULACI_N_ENTREVISTA->display_value;
}else {$postulacion="";}

$postulado =$fila->POSTULADO_ENTREVISTA->display_value;
if($fila->APROBADO){
$aprobado = $fila->APROBADO =  'Si';
}else {$aprobado="No";}
$empresa = $fila->EMPRESA_ENTREVISTA->display_value;

      echo "<script>dto = {'id':'$id','C_DIGO_DE_ENTREVISTA':'$cod_entrevista','CONVOCATORIA_ENTREVISTA':'$convo','PSICOLOGO_ENCARGADO':'$psicologo','POSTULACI_N_ENTREVISTA':'$postulacion','POSTULADO_ENTREVISTA':'$postulado','APROBADO':'$aprobado','EMPRESA_ENTREVISTA':'$empresa '};
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
		
        return data.estado;
    },
    groupHeader:function(value, count, data, group){
    //value - the value all members of this group share
    //count - the number of rows in this group
    //data - an array of all the row data objects in this group
    //group - the group component for the group

        return value + "<span style='color:#FC7827; margin-left:10px;'>("+count+")</span>";
    },
    
*/
    
	paginationSizeSelector:[15, 25, 50, 110],
 	columns:[
		{formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/OV_REFERENCIACIONES/" + cell.getRow().getData().id + "/yRZsazrX5TUkpwgwhKBP5FsaECWE8whhVmqJh3ASxynqBzSvKprvwrqEPdZnsr4kHzHDC6Vnak7zdAz54SWthmTN9DEywYP2pUkm";
			window.open(link, '_blank');
		}},


        {title:"ID Referenciación", field:"C_DIGO_DE_ENTREVISTA"},
        {title:"Convocatoria", field:"CONVOCATORIA_ENTREVISTA"},
        {title:"Psicólogo encargado",field:"PSICOLOGO_ENCARGADO"},
        {title:"Postulación",field:"POSTULACI_N_ENTREVISTA"},
        {title:"Nombres y Apellidos",field:"POSTULADO_ENTREVISTA"},
        {title:"Empresa",field:"EMPRESA_ENTREVISTA"},
         {title:"Aprobación",field:"APROBADO"},
 
         
        
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

var convocatoria = "";
var documento = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"CONVOCATORIA_ENTREVISTA", type:"like", value:convocatoria},
      {field:"POSTULACI_N_ENTREVISTA", type:"like", value:documento},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "convocatoria")
  {
    convocatoria = $filter;
  }
  else if($para == "documento")
  {
    documento = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "nombres")
    {
      sendToFiltrar = {field:"POSTULADO_ENTREVISTA",type:"like",value:$filter};      
    }

    if($specific == "psicologo")
    {
      sendToFiltrar = {field:"PSICOLOGO_ENCARGADO",type:"like",value:$filter};      
    }

    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Ans_Ver_Referenciacion<?php echo date('d_m_Y');?>.xlsx", {sheetName:"Estudios_seguridad_Referenciacion"});
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