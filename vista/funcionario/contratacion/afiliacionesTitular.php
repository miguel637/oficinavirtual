<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo base_url();?>lib/css/general.css">
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Documento</label>
      <input aria-controls="documento" type="text" id="focu" placeholder="Buscar por Documento" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Contrato</label>
      <input aria-controls="contrato" type="text" placeholder="Buscar por Contrato" class="form-control buscarData">
    </div>

    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="empresa">Empresa</option>
        <option value="ciudad">Ciudad</option>
        <option value="cargo">Cargo</option>
        <option value="temporal">Temporal</option>
		<option value="fecha_ingreso">Fecha de ingreso</option>
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
//1001
while($start < 2000)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/AFILIACIONES_TITULAR1?privatelink=hjTGxkGRRU5CmQkNkhnRx9vTbH7BPfyej2754RasOgBOtXWDTsfd8sMjrh30mPsQ0GaO0CMW5DVvVZ3fQ06Y6FPsFGwyPWhtU3Js&from=$start";
  
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
      $eps = (isset($fila->Caja_de_Compensacion_lookup->display_value)) ? $fila->Caja_de_Compensacion_lookup->display_value : "";
      $caja = (isset($fila->EPS_lookup->display_value)) ? $fila->EPS_lookup->display_value : "";
      $num_contrato = $fila->N_mero_de_Contrato;
      $fecha_ingreso = $fila->{"ORDEN_DE_CONTRATACI_N_Numero_de_Orden.Fecha_de_Ingreso"};
      $nombres = $fila->NOMBRES_Y_APELLIDOS->display_value;
      $tipo_documento = $fila->{"HOJA_DE_VIDA1.TIPO_DE_DOCUMENTO"};
      $documento = $fila->DOCUMENTO;
      $empresa = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.EMPRESA_USURIA"};
      $temporal = $fila->TEMPORAL_aplicar_convocatoria->display_value;
      $cargo = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.CARGO"};
      $ciudad = $fila->{"CONVOCATORIAS_APLICAR_CONVOCATORIA.CIUDAD"};
      $convo = $fila->CONVOCATORIAS_APLICAR_CONVOCATORIA->display_value;
      $fecha_afiliacion = $fila->Fecha_Afiliacion_EPS;
      $af_eps = $fila->AFILIACI_N_EPS;
      $fecha_caja = $fila->Fecha_Afiliacion_Caja;
      $af_caja = $fila->AFILIACI_N_CAJA_DE_COMPENSACI_N;
      $Fecha_y_Hora_Contratado = $fila->Fecha_y_Hora_Contratado;
      $convocatoria = $fila->CONVOCATORIAS_APLICAR_CONVOCATORIA->display_value;

      echo "<script>dto = {'id':'$id','EPS':'$eps','CAJA_DE_COMPENSACI_N':'$caja','N_mero_de_Contrato':'$num_contrato','Fecha_de_Ingreso':'$fecha_ingreso','NOMBRES_Y_APELLIDOS':'$nombres','TIPO_DE_DOCUMENTO':'$tipo_documento','DOCUMENTO':'$documento','EMPRESA_USURIA':'$empresa','TEMPORAL_aplicar_convocatoria':'$temporal','CARGO':'$cargo','CIUDAD':'$ciudad','convocatoria':'$convo','Fecha_Afiliacion_EPS':'$fecha_afiliacion','AFILIACI_N_EPS':'$af_eps','Fecha_Afiliacion_Caja':'$fecha_caja','AFILIACI_N_CAJA_DE_COMPENSACI_N':'$af_caja','convocatoria':'$convocatoria','Fecha_y_Hora_Contratado':'$Fecha_y_Hora_Contratado'};
      object.push(dto);</script>";

    }
  } 
}
?>

<script>

var printIcon = function(cell, formatterParams){ //plain text value
    return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button>';
};
var afiliarEPS = function(cell, formatterParams){ //plain text value
	if(cell.getRow().getData().Fecha_Afiliacion_EPS == "")
	{
		return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-user-check"></i> Afiliar EPS</button>';
	}
	else return '<button id="viewbtn" class="btn btn-light btn-sm" disabled><i class="fas fa-user-check"></i> Afiliado EPS</button>';
    
};
var afiliarCaja = function(cell, formatterParams){ //plain text value
    if(cell.getRow().getData().Fecha_Afiliacion_Caja == "")
	{
		return '<button  id="viewbtn"class="btn btn-outline-info btn-sm"><i class="fas fa-user-check"></i> Afiliar Caja</button>';
	}
	else return '<button id="viewbtn" class="btn btn-light btn-sm" disabled><i class="fas fa-user-check"></i> Afiliado Caja</button>';
};



 var table = new Tabulator("#table-rendered", {
    data:object,
    layout:"fitData",
    maxHeight:"92%",
    pagination:"local",
    paginationSize:15,

    groupBy:function(data){
        return data.convocatoria;
    },
    groupHeader:function(value, count, data, group){
        return value + "<span style='color:#FC7827; margin-left:10px;'>("+count+")</span>";
    },

	paginationSizeSelector:[15, 25, 50, 110],
 	columns:[
		{formatter:printIcon,headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){
			
			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/APLICAR_CONVOCATORIAS/record-edit/AFILIACIONES_TITULAR1/" + cell.getRow().getData().id + "/hjTGxkGRRU5CmQkNkhnRx9vTbH7BPfyej2754RasOgBOtXWDTsfd8sMjrh30mPsQ0GaO0CMW5DVvVZ3fQ06Y6FPsFGwyPWhtU3Js?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
			window.open(link, '_blank');
		}},
	
		{formatter:afiliarEPS, headerSort:false, width:120, hozAlign:"center",cellClick:function(e, cell, data){
      if(cell.getRow().getData().Fecha_Afiliacion_EPS == "")
      {
        if(cell.getRow().getData().AFILIACI_N_EPS == "http://creator.zoho.com/DownloadFile.do?filepath=/&sharedBy=709703038" )
        {
          alertify.alert('<span class="text-danger">Error</span>', "<span class='text-info'>Es obligatorio cargar el archivo de Afiliación</span>" );

        }
        else
        {
          $('.loadingOFV').removeClass("d-none");

          var url = "<?php echo site_url("api/afiliarTitular");?>";
          var params = "type=EPS&id="+cell.getRow().getData().id;//PARAMETROS 
          const http = new XMLHttpRequest();
          //Abres la conexion  la URL 
          http.open("POST", url, true); 
          
          //Envias el header requerido para enviar parametros via POST 
          http.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
          
          http.onreadystatechange = function() {//Llama a la funcion cuando el estado cambia 
            if(http.readyState == 4 && http.status == 200) { 
              $('.loadingOFV').addClass("d-none");
              alertify.success("Afiliado a EPS");
            } 
          } 
          http.send(params);
          cell.getRow().getData().Fecha_Afiliacion_EPS = "updated";
        }
        
      }
      else alertify.alert('<span class="text-warning">Aviso</span>', "<span class='text-info'>Ya se ha afiliado previamente</span>")
    }},


    {formatter:afiliarCaja, headerSort:false, width:140, hozAlign:"center",cellClick:function(e, cell){
			if(cell.getRow().getData().Fecha_Afiliacion_Caja == "")
			{
				if(cell.getRow().getData().AFILIACI_N_CAJA_DE_COMPENSACI_N == "http://creator.zoho.com/DownloadFile.do?filepath=/&sharedBy=709703038" )
				{
					alertify.alert('<span class="text-danger">Error</span>', "<span class='text-info'>Es obligatorio cargar el archivo de Afiliación</span>" );

				}
				else
				{
          $('.loadingOFV').removeClass("d-none");
					
					var url = "<?php echo site_url("api/afiliarTitular");?>";
					var params = "type=Caja&id="+cell.getRow().getData().id;//PARAMETROS 
					const http = new XMLHttpRequest();
					//Abres la conexion  la URL 
					http.open("POST", url, true); 
					
					//Envias el header requerido para enviar parametros via POST 
					http.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
					
					http.onreadystatechange = function() {//Llama a la funcion cuando el estado cambia 
						if(http.readyState == 4 && http.status == 200) { 
							$('.loadingOFV').addClass("d-none");
							alertify.success("Afiliado a Caja");
						} 
					} 
					http.send(params);
					cell.getRow().getData().Fecha_Afiliacion_Caja = "updated";
					
				}
			}
		}},

    {title:"Fecha Contratado", field:"Fecha_y_Hora_Contratado"},
    {title:"EPS", field:"EPS"},
	 	{title:"Caja", field:"CAJA_DE_COMPENSACI_N"},	 	
	 	{title:"Contrato", field:"N_mero_de_Contrato"},
	 	{title:"Fecha Ingreso", field:"Fecha_de_Ingreso"},
	 	{title:"Nombres", field:"NOMBRES_Y_APELLIDOS"},
	 	{title:"Tipo Documento", field:"TIPO_DE_DOCUMENTO"},
	 	{title:"Documento", field:"DOCUMENTO"},	 	
	 	{title:"Empresa", field:'EMPRESA_USURIA'},
	 	{title:"Temporal", field:'TEMPORAL_aplicar_convocatoria'},
	 	{title:"Cargo", field:'CARGO'},
	 	{title:"Ciudad", field:'CIUDAD'},  
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

var documento = "";
var contrato = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"DOCUMENTO", type:"like", value:documento},
      {field:"N_mero_de_Contrato", type:"like", value:contrato},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "documento")
  {
    documento = $filter;
  }
  else if($para == "contrato")
  {
    contrato = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "empresa")
    {
      sendToFiltrar = {field: "EMPRESA_USURIA",type:"like",value: $filter};      
    }

    if($specific == "ciudad")
    {
      sendToFiltrar = {field: "CIUDAD",type:"like",value: $filter};      
    }

    if($specific == "temporal")
    {
      sendToFiltrar = {field: "TEMPORAL_aplicar_convocatoria",type:"like",value: $filter};      
    }

    if($specific == "cargo"){
      sendToFiltrar = {field:"CARGO",type:"like",value:$filter};
    }

    if($specific == "fecha_ingreso"){

      sendToFiltrar = {field:"Fecha_de_Ingreso",type:"like",value:$filter};
    }

    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "Ver_Afiliaciones_titular_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"Contratacion_Afiliaciones"});
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