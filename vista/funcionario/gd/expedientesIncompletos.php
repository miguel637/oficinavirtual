<?php
//<iframe height='98%' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creatorapp.zohopublic.com/hq5colombia/hq5/report-embed/Expedientes_Incompletos_GDO/nGv8n4A6fkF7sJk52MT6S6akN65UUYqxWTXqy3ge5XGrrJUFvOr3a4DPdUn8dquzeu7QbYF9pVynPknWW5UmefkYJHFX5FFypTvb'></iframe>
?>
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

  <div class="row">
    <div class="col-4">
    <label for="">Documento</label>
      <input aria-controls="documento" type="text" placeholder="Buscar por Documento" class="form-control buscarData">
     
    </div>
    <div class="col-4">
    <label for="">Convocatoria</label>
      <input aria-controls="convocatoria" type="text" placeholder="Buscar por convocatoria" class="form-control buscarData">
    </div>
    <div class="col-4">
      <select id="filtropor" class="form-control">
        <option value="seleccionar">Seleccionar...</option>
        <option value="proceso">Proceso que presenta Inconsistencias</option>
        <option value="empresa">Empresa</option>
        <option value="cargo">Cargo</option>
        <option value="n_candidato">Nº Candidato</option>
        <option value="nombres">Nombres y Apellidos</option>
      </select>
      <input aria-controls="specific" placeholder="Otros filtros" type="text" Class="form-control buscarData">
    </div>
  </div>

  <div class='text-center m-3 '>
    <span id="example-table-info"></span>
    <button id="download-xls" style="position:absolute; right:4%;" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Exportar excel</button>    
  </div>

  <div id="table-rendered" class="mt-5"></div>
  <div id="contador"></div>
<?php
echo "<script>object = [];</script>";

$start = 0;
while($start < 2400)
{

  $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/Expedientes_Incompletos_GDO?privatelink=nGv8n4A6fkF7sJk52MT6S6akN65UUYqxWTXqy3ge5XGrrJUFvOr3a4DPdUn8dquzeu7QbYF9pVynPknWW5UmefkYJHFX5FFypTvb&from=$start";  
  
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
        $Postulado = $fila->Candidato->ID;
        $Candidato = $fila->Candidato->display_value;
        $Nombres_y_Apellidos = $fila->Nombres_y_Apellidos->display_value;
        $Documento = $fila->{"Candidato.DOCUMENTO"};
        $Empresa_Solicitante = $fila->Empresa_Solicitante->display_value;

        $procesosInconsistencia = "";
        
        $itx = 0;
        foreach((array) $fila->Procesos_con_Anotaciones as $filax)
        {
          $itx++;
          if($itx == 1) $procesosInconsistencia.= $filax;
          else $procesosInconsistencia.= " - ".$filax;
        }
        
        if(isset($fila->Cargo->display_value)) $Cargo = $fila->Cargo->display_value;
        else $Cargo = "";
        
        if(isset($fila->Psicologo_a_Cargo->display_value)) $Psicologo_a_Cargo = $fila->Psicologo_a_Cargo->display_value;
        else $Psicologo_a_Cargo = "";

        if(isset($fila->requisicion->display_value)) $requisicion = $fila->requisicion->display_value;
        else $requisicion = "";

        if(isset($fila->convocatoria->display_value)) $convocatoria = $fila->convocatoria->display_value;
        else $convocatoria = "";

        $estado_trabajador = $fila->{"Candidato.Estado_Trabajador"};
        $Fecha_de_Ingreso = $fila->{"Candidato.Fecha_de_Ingreso"};
        $Asesor_Asignado = $fila->{"Candidato.Asesor_Asignado"};
      echo "<script>dto = {'Proceso_que_presenta_inconsistencias':'$procesosInconsistencia','ID_Proceso':'$fila->ID_Proceso','Estado':'$fila->Estado','Candidato':'$Candidato','Nombres_y_Apellidos':'$Nombres_y_Apellidos','Documento':'$Documento','Empresa_Solicitante':'$Empresa_Solicitante','Cargo':'$Cargo','Fecha_de_Ingreso':'$Fecha_de_Ingreso','Psicologo_a_Cargo':'$Psicologo_a_Cargo','Asesor_Asignado':'$Asesor_Asignado','requisicion':'$requisicion','convocatoria':'$convocatoria','ID':'$fila->ID','Postulado':'$Postulado','estado_trabajador':'$estado_trabajador'};object.push(dto);</script>";

    }
  }
}
?>
<script>

	var VerPostulacion = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver Postulación</button>';
    };

	var EnviarValidacion = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-success btn-sm"><i class="fas fa-bells"></i> Enviar a Validación</button>';
    };

 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitData",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:25,
	paginationSizeSelector:[ 25, 50, 110],
 	columns:[
        {formatter:VerPostulacion, width:150, hozAlign:"center",cellClick:function(e, cell){
					
					var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/APLICAR_CONVOCATORIAS/record-edit/APLICAR_CONVOCATORIAS_Report/" + cell.getRow().getData().Postulado + "/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
					window.open(link, '_blank');
				}},
        {formatter:EnviarValidacion, headerSort:false, width:175, hozAlign:"center",cellClick:function(e, cell){

            alertify.prompt( 'Por favor', '¿Que cambios hiciste en el proceso? Escribé los cambiós en el siguiente recuadro antes de enviar <b>Enviar a Validación</b>', ''
               , function(evt, value) { 
                  $(".alertdel").remove();

                  var someText = $('#valorFunction').val();

                  someText = someText.replaceAll(/(\r\n|\n|\r)/gm, " ");

                 if(someText == "") {
                   $('#valorFunction').after("<span class='text-danger alertdel'>El cambio es obligatorio *</span>");
                   return false;
                 }
                 else
                 {
                    const formData = new FormData();
                    formData.append('Record_ID', cell.getRow().getData().ID);
                    formData.append('Anotacion', $('#valorFunction').val());

                    let config = {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json'
                            },
                        body: formData
                    };
                    $('#textLoaderOFV').html("Enviando a Validación...");
                    $('.loadingOFV').removeClass("d-none");

                    fetch("<?php echo site_url("apiZoho/gd_enviar_validacion");?>",config)
                    .then(res => res.json())
                    .then((result) => {
                        $('.loadingOFV').addClass("d-none");
                        console.log(result);
                        alertify.success("se ha enviado a validación");
                        cell.getRow().delete();
                    });
                 }
                },function(){return true;}).setting('modal', false).set({labels:{ok:'Enviar', cancel: 'Cancelar'}});;

               $this = $('.ajs-input');
               $this.after("<textarea id='valorFunction' class='text-area mt-3' onpaste='return false;' row='6'></textarea>");
               $('#valorFunction').val("");
               $('#valorFunction').siblings(".text-danger").remove();
               $this.remove();
           
        }},        
        {title:"Proceso con Inconsistencias", field:"Proceso_que_presenta_inconsistencias"},
        {title:"Estado Trabajador",field:"estado_trabajador"},
        {title:"Candidato",field:"Candidato"},
        {title:"Nombres y Apellidos",field:"Nombres_y_Apellidos"},
        {title:"Documento",field:"Documento"},
        {title:"Empresa",field:"Empresa_Solicitante"},
        {title:"Cargo",field:"Cargo"},
        {title:"Fecha de Ingreso",field:"Fecha_de_Ingreso"},
        {title:"Requisición",field:"requisicion"},
        {title:"Convocatoria",field:"convocatoria"},
        {title:"Psicólogo",field:"Psicologo_a_Cargo"},
        {title:"Asesor",field:"Asesor_Asignado"},        
        {title:"ID Proceso", field:"ID_Proceso"},
        {title:"Estado",field:"Estado"},
   	
 	],
   rowDblClick:function(e, row){
      var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/Expedientes_Incompletos_GDO/" + row.getData().ID + "/nGv8n4A6fkF7sJk52MT6S6akN65UUYqxWTXqy3ge5XGrrJUFvOr3a4DPdUn8dquzeu7QbYF9pVynPknWW5UmefkYJHFX5FFypTvb";
				window.open(link, '_blank');
    },
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

function myFunction() {
  $('#contador').html("<span class='text-info'>Numero de Registros: "+table.getDataCount("active")+"</span>");
}

table.setLocale("spanish");
myFunction();

var convocatoria = "";
var Documento = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"convocatoria", type:"like", value:convocatoria},
      {field:"Documento", type:"like", value:Documento},
      filtroEspecifico,
		
	]);
  myFunction();
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
    Documento = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};

    if($specific == "proceso")
    {
      sendToFiltrar = {field: "Proceso_que_presenta_inconsistencias",type:"like",value: $filter};      
    }

    if($specific == "nombres")
    {
      sendToFiltrar = {field: "Nombres_y_Apellidos",type:"like",value: $filter};      
    }

    if($specific == "n_candidato")
    {
      sendToFiltrar = {field: "Candidato",type:"like",value: $filter};      
    }

    if($specific == "empresa"){
      sendToFiltrar = {field:"Empresa_Solicitante",type:"like",value:$filter};
    }

    if($specific == "cargo"){
      sendToFiltrar = {field:"Cargo",type:"like",value:$filter};
    }

    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});


$("#download-xls").on("click", function(){
    table.download("xlsx", "ExpedientesIncompletos_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ExpedientesIncompletos"});
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