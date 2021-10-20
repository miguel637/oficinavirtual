<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creatorapp.zohopublic.com/hq5colombia/gesti-n-del-riesgo/report-embed/Reporte_Error_Organizacional/x7sbtptk6V7QRwNnb6aZbbG7OWZTVZ9bRhw0hYB5HhtptN7R0J0n7BtdmBtFS8C10zeqPq7d5mMtHFUud92Qu9weHSXSJNVbPd3w'></iframe>
?>
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Documento</label>
      <input aria-controls="documento" type="text" placeholder="Buscar por documento" class="form-control buscarData">
     
    </div>
  </div>

  <div class='text-center m-3'>
    <span id="example-table-info"></span>
    <button id="download-xls" style="position:absolute; right:4%;" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Exportar excel</button>    
  </div>

  <div id="table-rendered" class="mt-5"></div>

<?php
echo "<script>object = [];</script>";


  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/gesti-n-del-riesgo/report/Reporte_Error_Organizacional?privatelink=x7sbtptk6V7QRwNnb6aZbbG7OWZTVZ9bRhw0hYB5HhtptN7R0J0n7BtdmBtFS8C10zeqPq7d5mMtHFUud92Qu9weHSXSJNVbPd3w";

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

         
        $documento =  $fila->Numero_de_Documento->display_value;
        $Falta_Cometida =  (isset($fila->Falta_Cometida->display_value)) ? $fila->Falta_Cometida->display_value : "";
        echo "<script>dto = {'C_digo_Empresa':'$fila->C_digo_Empresa','Cargo':'$fila->Cargo','Falta_Cometida':'$Falta_Cometida','Fecha_de_Aceptaci_n_o_Rechazo':'$fila->Fecha_de_Aceptaci_n_o_Rechazo','Fecha_y_Hora_del_Reporte':'$fila->Fecha_y_Hora_del_Reporte','Empresa_Usuaria':'$fila->Empresa_Usuaria','Nombres_y_Apellidos':'$fila->Nombres_y_Apellidos','Sexo':'$fila->Sexo','Estado':'$fila->Estado','Celular':'$fila->Celular','documento':'$documento','ID':'$fila->ID'};object.push(dto);</script>";

    }
  }

?>
<script>

	var viewButton = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
    };
	var editRegistro = function(cell, formatterParams){ //plain text value
      if(cell.getRow().getData().Estado != "Pendiente Cargar Soporte"){
          return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-edit"></i> Edit</button>';
      }
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

      var link = "https://creatorapp.zohopublic.com/hq5colombia/gesti-n-del-riesgo/record-summary/Reporte_Error_Organizacional/" + cell.getRow().getData().ID + "/x7sbtptk6V7QRwNnb6aZbbG7OWZTVZ9bRhw0hYB5HhtptN7R0J0n7BtdmBtFS8C10zeqPq7d5mMtHFUud92Qu9weHSXSJNVbPd3w";
      window.open(link, '_blank');
    }},
    {formatter:editRegistro, headerSort:false, width:120, hozAlign:"center",cellClick:function(e, cell){
        var link = "https://creatorapp.zohopublic.com/hq5colombia/gesti-n-del-riesgo/Error_Organizacional/record-edit/Reporte_Error_Organizacional/" + cell.getRow().getData().ID + "/x7sbtptk6V7QRwNnb6aZbbG7OWZTVZ9bRhw0hYB5HhtptN7R0J0n7BtdmBtFS8C10zeqPq7d5mMtHFUud92Qu9weHSXSJNVbPd3w?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
        window.open(link, '_blank');   
    }},
    {title:"Estado", field:"Estado"},        
    {title:"Documento", field:"documento"},
    {title:"Nombres y Apellidos",field:"Nombres_y_Apellidos"},
    {title:"Cargo",field:"Cargo"},
    {title:"Falta Cometida", field:"Falta_Cometida"},
    {title:"Celular",field:"Celular"},
    {title:"Fecha Reporte",field:"Fecha_y_Hora_del_Reporte"},
   	
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

function filtrar()
{
  table.setFilter([
		
      {field:"documento", type:"like", value:documento}
		
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

  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "ErroresOrganizacionales_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"Errores Organizacionales"});
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