<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/hq5/report-embed/APLICAR_CONVOCATORIAS_Report/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R'></iframe>
?>
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

<div class="row">

      <div class="col-4">
        <label for="">Contrato</label>
        <input aria-controls="contrato" type="text" placeholder="Buscar por contrato" class="form-control buscarData">
      </div>
      <div class="col-4">
        <label for="">Número de cedula</label>
        <input aria-controls="cedula" type="text" placeholder="Buscar por cedula" class="form-control buscarData">
      </div>
      <div class="col-4">
        <select id="filtropor" class="form-control">
          <option value="seleccionar">Seleccionar...</option>
          <option value="dependencia">Dependencia</option>

        </select>
        <input aria-controls="specific" type="text" Class="form-control buscarData">
      </div>
  </div>

  <div class='text-center m-3 '>
    <span id="example-table-info"></span>
    <button id="download-xls" style="position:absolute; right:4%;" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Exportar excel</button>    
</div>
<div id="table-rendered" class="mt-5"></div>


<div id="table-rendered"></div>

<?php

    echo "<script>object = [];</script>";
    $start = 0;
    while($start < 1001)
    {
        $idNomina = $_SESSION["codigoEmpresa_user"];
        $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/contratos-n-mina/report/Contrato_Report?privatelink=CGe1bAAtdds2k9nEgRWrSv4as5WBOn8PNskV8n2343rOYHJvd9vR05wFKNFOMRRxg1hkdCqV0qF0AWEsEbpgKNgCjDtFFO4n5mZJ&Nomina=$idNomina&from=$start";
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
                
            $departamento = $fila->Departamento->display_value;
            $ciudad = $fila->Ciudad->display_value;
            $id = $fila->ID;

            if(isset($fila->Bancos->display_value)){
              $bancos = $fila->Bancos->display_value;}
            else {
            $bancos="";
            }
             if(isset($fila->Salud->display_value)){
              $salud = $fila->Salud->display_value;
             }else {
               $salud="";
             }
            if(isset($fila->Pension->display_value)){
               $pension = $fila->Pension->display_value;
          
            }else {
              $pension = "";
            }

            if(isset($fila->Caja_Compensacion->display_value)){
            $caja = $fila->Caja_Compensacion->display_value;
            }else {
              $caja = "";
            }

            if(isset($fila->Cesantias->display_value)){
            $cesantias = $fila->Cesantias->display_value;
            }else {
              $cesantias="";
            }

            if(isset($fila->ARL->display_value)){

            $arl = $fila->ARL->display_value;
            }else {
              $arl = "";
            }
            if(isset($fila->Tipo_Cotizante->display_value)){
            $tipo_cotizante = $fila->Tipo_Cotizante->display_value;
            }else {$tipo_cotizante="";}
            if(isset($fila->Concepto_Cotizante->display_value)){
            $concepto_cotizante = $fila->Concepto_Cotizante->display_value;}else{$concepto_cotizante="";}

            echo "<script>dto = {'Estado':'$fila->Estado','Est':'$fila->EST','Contrato':'$fila->Numero_de_Contrato','Numero_documento':'$fila->Numero_de_documento','Cargo_contratado':'$fila->Cargo_contratado','Tipo_documento':'$fila->Tipo_Documento','Primer_apellido':'$fila->Primer_Apellido','Segundo_apellido':'$fila->Segundo_Apellido','Primer_nombre':'$fila->Primer_Nombre','Segundo_nombre':'$fila->Segundo_Nombre','Tercero':'$fila->Tipo_de_Tercero','Telefono':'$fila->Telefono','Celular':'$fila->Celular','Correo_electronico':'$fila->Correo_Electronico','Fecha_Nacimiento':'$fila->Fecha_Nacimiento','Estado_Civil':'$fila->Estado_Civil','Sexo':'$fila->Sexo','Pais':'$fila->Pais','Departamento':'$departamento','Ciudad':'$ciudad','Direccion':'$fila->Direccion','Nomina':'$fila->Nomina','Cesion_Contrato':'$fila->Cesion_Contrato','Orden_Contratacion':'$fila->Orden_Contratacion','id':'$id','est':'$fila->EST','documento':'$fila->Numero_de_documento','rh':'$fila->RH','Tipo_Contrato':'$fila->Tipo_Contrato','Tipo_de_salario':'$fila->Tipo_de_salario','Jornada':'$fila->Jornada','Salario_Basico':'$fila->Basico','Auxilio_de_Transporte':'$fila->Auxilio_de_Transporte','Dependencia':'$fila->Dependencia','Centro':'$fila->Centro','Sabado_Habil':'$fila->Sabado_Habil','Fecha_Ingreso':'$fila->Fecha_Ingreso','Fecha_Firma_Contrato':'$fila->Fecha_Firma_Contrato','Fecha_Final':'$fila->Fecha_Final','Fecha_Retiro':'$fila->Fecha_Retiro','Modalidad_de_Pago':'$fila->Modalidad_de_Pago','Bancos':'$bancos','Tipo_de_Cuenta':'$fila->Tipo_de_Cuenta','Numero_de_Cuenta':'$fila->Numero_de_Cuenta','Salud':'$salud','Pension':'$pension','Caja_Compensacion':'$caja','Cesantias':'$cesantias','ARL':'$arl','Riesgo_ARL':'$fila->Riesgo_ARL','Porcentaje_Adicional':'$fila->Porcentaje_Adicional','Fecha_afiliacion_ARL':'$fila->Fecha_afiliacion_ARL','Fecha_radicacion_EPS':'$fila->Fecha_radicacion_EPS','Fecha_radic_caja_compensaci_n':'$fila->Fecha_radic_caja_compensaci_n','Sena':'$fila->Sena','Icbf':'$fila->Icbf','Sucursal_Aportes':'$fila->Sucursal_Aportes','Metodo_de_Retencion':'$fila->Metodo_de_Retencion','Porcentaje_Retencion':'$fila->Porcentaje_Retencion','Salud_Descontada':'$fila->Salud_Descontada','Vivienda':'$fila->Vivienda','Salud_Prepagada_poliza_seguros':'$fila->Salud_Prepagada_poliza_seguros','Dependientes':'$fila->Dependientes','Declarante_de_Renta':'$fila->Declarante_de_Renta','Declarante_de_Renta':'$fila->Declarante_de_Renta','Tipo_Cotizante':'$tipo_cotizante','Concepto_Cotizante':'$concepto_cotizante','Valor_1':'$fila->Valor_1','Valor_2':'$fila->Valor_2','rh':'$fila->RH'}</script>";
            echo "<script>object.push(dto);</script>";
        }
    }
}



?>
<script>    

	var downloadButton = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-ey"></i> Certificado laboral</button>';
    };

    var viewButton = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
    };


 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitData",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:20,
    groupBy:function(data){
		
        return data.Est+" - "+data.Estado;
    },
    groupHeader:function(value, count, data, group){
    //value - the value all members of this group share
    //count - the number of rows in this group
    //data - an array of all the row data objects in this group
    //group - the group component for the group

        return value + "<span style='color:#d00; margin-left:10px;'>("+count+")</span>";
    },
	paginationSizeSelector:[20, 50, 100, 110],
 	columns:[

        {formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){

var link = "https://creatorapp.zohopublic.com/hq5colombia/contratos-n-mina/record-summary/Contrato_Report/" + cell.getRow().getData().id + "/CGe1bAAtdds2k9nEgRWrSv4as5WBOn8PNskV8n2343rOYHJvd9vR05wFKNFOMRRxg1hkdCqV0qF0AWEsEbpgKNgCjDtFFO4n5mZJ";
window.open(link, '_blank');

}},   

		{formatter:downloadButton, width:200, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/contratos-n-mina/record-summary/Contrato_Report/" + cell.getRow().getData().id + "/CGe1bAAtdds2k9nEgRWrSv4as5WBOn8PNskV8n2343rOYHJvd9vR05wFKNFOMRRxg1hkdCqV0qF0AWEsEbpgKNgCjDtFFO4n5mZJ";
		


if(cell.getRow().getData().est == "HQ5 S.A.S")

var link = "https://creator.zohopublic.com/hq5colombia/contratos-n-mina/record-pdf/ContratoHQ5/" + cell.getRow().getData().id+ "/CertificadoLaboral_"+cell.getRow().getData().documento+"/qORCk2B3ttHUEqaCuRj04fa2eqBmQW1YaG1yeRrvyz7GdPQK3RygtDhsmhC5kvzhET6eaTHDU4BFYgbgVXdb5mwGsu8zeFTTAED0";

else if(cell.getRow().getData().est == "TEMPOENLACE S.A.S")

var link = "https://creator.zohopublic.com/hq5colombia/contratos-n-mina/record-pdf/ContratoTempoenlace/" + cell.getRow().getData().id + "/CertificadoLaboral_"+cell.getRow().getData().documento+"/4k4CaOaqd2PkzdKUYOeCSv5MHs6faPBp9wJ1w68zJxgqTWrdVWDr6Kj1rdAa3vGhKsF9SBYf4x0baC2Wk9NwD44OWXBt6AF5RyS9";

else if(cell.getRow().getData().est == "UT COLTEMP-HQ5") 

var link = "https://creator.zohopublic.com/hq5colombia/contratos-n-mina/record-pdf/ContratoColtemp/" + cell.getRow().getData().id + "/CertificadoLaboral_"+cell.getRow().getData().documento+"/QJbhQGEMe7aDbse1CNJX11QenydOmFW9JDnqywdQ21550UsZB7p1zubN9XrRQ6b6AstrvAmtBZv4Xun3OFK6E1WVySKw9Z4dmVGa";

else var link="#blank";

window.open(link, '_blank');




		}}, 
	


        {title:"Contrato", field:"Contrato"},  
        {title:"Numero de Documento", field:"Numero_documento"},
        {title:"Cargo Contratado",field:"Cargo_contratado"},
        {title:"Tipo de Documento",field:"Tipo_documento"},
        {title:"Primer apellido",field:"Primer_apellido"},
        {title:"Segundo apellido",field:"Segundo_apellido"},
        {title:"Primer nombre",field:"Primer_nombre"},
        {title:"Segundo nombre",field:"Segundo_nombre"},
        {title:"Tipo de Tercero",field:"Tercero"},
        {title:"Telefono",field:"Telefono"},
        {title:"Celular",field:"Celular"},
        {title:"Correo Electronico",field:"Correo_electronico"},
        {title:"Fecha Nacimiento",field:"Fecha_Nacimiento"}, 
        {title:"Estado Civil",field:"Estado_Civil"},
        {title:"Sexo",field:"Sexo"},
        {title:"Pais",field:"Pais"},
        {title:"Departamento",field:"Departamento"},
        {title:"Ciudad",field:"Ciudad"},
        {title:"Direccion",field:"Direccion"},
        {title:"Nomina",field:"Nomina"},
        {title:"Cesión Contrato",field:"Cesion_Contrato"},
        {title:"Orden Contratación",field:"Orden_Contratacion"},
        {title:"Tipo Contrato",field:"Tipo_Contrato"},
        {title:"Tipo de Salario",field:"Tipo_de_salario"},
        {title:"Tipo de jornada",field:"Jornada"},
        {title:"Especificaciones Salariales",field:"Salario_Basico"},
        {title:"Auxilio de Transporte",field:"Auxilio_de_Transporte"},
        {title:"Dependecia (Empresa)",field:"Dependencia"},
        {title:"Centro (Sede)",field:"Centro"},
        {title:"Sabado Habil",field:"Sabado_Habil"},
        {title:"Fecha Ingreso",field:"Fecha_Ingreso"},
        {title:"Fecha Firma Contrato",field:"Fecha_Firma_Contrato"},
        {title:"Fecha Final",field:"Fecha_Final"},
        {title:"Fecha Retiro",field:"Fecha_Retiro"},
        {title:"Modalidad de Pago",field:"Modalidad_de_Pago"},
        {title:"Bancos",field:"Bancos"},
        {title:"Tipo de Cuenta",field:"Tipo_de_Cuenta"},
        {title:"Número de Cuenta",field:"Numero_de_Cuenta"},
        {title:"Salud",field:"Salud"},
        {title:"Pensión",field:"Pension"},
        {title:"Caja Compensación",field:"Caja_Compensacion"},
        {title:"Cesantias",field:"Cesantias"},
        {title:"ARL",field:"ARL"},
        {title:"Riesgo ARL",field:"Riesgo_ARL"},
        {title:"Porcentaje Adicional",field:"Porcentaje_Adicional"},
        {title:"Fecha afiliación ARL",field:"Fecha_afiliacion_ARL"},
        {title:"Fecha afiliación EPS",field:"Fecha_radicacion_EPS"},
        {title:"Fecha radic. Caja compensación",field:"Fecha_radic_caja_compensaci_n"},
        {title:"Sena",field:"Sena"},
        {title:"Icbf",field:"Icbf"},
        {title:"Sucursal Aportes",field:"Sucursal_Aportes"},
        {title:"Metodo de Retención",field:"Metodo_de_Retencion"},
        {title:"Porcentaje Retención",field:"Porcentaje_Retencion"},
        {title:"Salud Descontada",field:"Salud_Descontada"},
        {title:"Vivienda",field:"Vivienda"},
        {title:"Salud Prepagada/Poliza seguros",field:"Salud_Prepagada_poliza_seguros"},
        {title:"Dependientes",field:"Dependientes"},
        {title:"Declarante de Renta",field:"Declarante_de_Renta"},
        {title:"Dependietnes Porc",field:"Dependientes_Porc"},
        {title:"Tipo Cotizante",field:"Tipo_Cotizante"},
        {title:"Conceptos Cotizante",field:"Concepto_Cotizante"},
        {title:"Valor 1",field:"Valor_1"},  
        {title:"Valor 2",field:"Valor_2"},
        {title:"Rh",field:"rh"},


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

var filtro_contrato = "";
var filtro_cedula = "";

function filtrar(filtroEspecifico = {})
{
  table.setFilter([
		
      {field:"Contrato", type:"like", value: filtro_contrato},
      {field:"Numero_documento", type:"like", value: filtro_cedula},
      filtroEspecifico,
		
	]);
}

$(".buscarData").keyup(function()
{
	$filter = $(this).val();
	$para = $(this).attr("aria-controls");
  if($para == "contrato")
  {
    filtro_contrato = $filter;
  }
  else if($para == "cedula")
  {
    filtro_cedula = $filter;
  }

  
  else if($para == "specific")
  {
    $specific = $('#filtropor').val();

    sendToFiltrar = {};
    
    if($specific == "dependencia")
    {
      sendToFiltrar = {field: "Dependencia",type:"like",value: $filter};      
    }



    filtrar(sendToFiltrar);
    return true;

  }
  filtrar();

});



$("#download-xls").on("click", function(){
    table.download("xlsx", "PersonalActivo_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"ANS_PersonalActivo"});
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
 
