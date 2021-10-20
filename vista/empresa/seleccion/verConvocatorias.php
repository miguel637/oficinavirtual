<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/hq5/report-embed/CONVOCATORIAS_Report/ekmSnPtQdADbeCkHG09kgQ7qvVzZUEHOxaX6631pJj7KmQk3NUHnvdqBv3R4G7KzFEqVOv65u6UkX5tpFTOvQSBw3TxBRk5TmRMK'></iframe>
?>
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/tabulator.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="input-group mb-3">
  <input id="buscarData" type="text" class="form-control" placeholder="Buscar  ..." aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button id='btnSearch' class="btn btn-outline-info" type="button">Buscar</button>
  </div>
</div>

<div id="table-rendered"></div>

<?php

$url = "https://creator.zoho.com/api/json/hq5/view/CONVOCATORIAS_Report";

$postdata = http_build_query(
    array(
        "authtoken" => "530bbb13d105c9ddffe00f5d794c09ad",
        "scope" => "creatorapi",
		"zc_ownername" => "hq5colombia",
		"criteria" => "EMPRESA_USURIA.ID == ".$_SESSION["idEmpresa_user"]
    )
);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);

$context = stream_context_create($opts);

$result = file_get_contents($url, false, $context);

echo "<script>".$result."</script>";
?>
<script>
var str = JSON.stringify(zohohq5colombiaview35.CONVOCATORIAS);

object = JSON.parse(str);

    console.log(object);

	var viewButton = function(cell, formatterParams){ //plain text value
   		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
    };

	var editButton = function(cell, formatterParams){ //plain text value
		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button>';
	};

 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitData",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:10,
	paginationSizeSelector:[10, 25, 50, 100],
 	columns:[
		{formatter:viewButton, width:100, hozAlign:"center",cellClick:function(e, cell){

			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/CONVOCATORIAS_Report/" + cell.getRow().getData().ID + "/ekmSnPtQdADbeCkHG09kgQ7qvVzZUEHOxaX6631pJj7KmQk3NUHnvdqBv3R4G7KzFEqVOv65u6UkX5tpFTOvQSBw3TxBRk5TmRMK";
			window.open(link, '_blank');
		}},

		
		{formatter:editButton, width:100, hozAlign:"center",cellClick:function(e, cell){
			
			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/CONVOCATORIAS/record-edit/CONVOCATORIAS_Report/" + cell.getRow().getData().ID + "/ekmSnPtQdADbeCkHG09kgQ7qvVzZUEHOxaX6631pJj7KmQk3NUHnvdqBv3R4G7KzFEqVOv65u6UkX5tpFTOvQSBw3TxBRk5TmRMK?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
			window.open(link, '_blank');
		}},
        {title:"Convocatoria", field:"ID_CONVOCATORIA"},        
        {title:"Requisición", field:"REQUISICI_N"},
        {title:"Cargo", field:"CARGO"}, 	
	 	{title:"Tipo de Proceso", field:"TIPO_DE_PROCESO"},
	 	{title:"Vacantes", field:"VACANTES"},
	 	{title:"Salario", field:"SALARIO_ASIGNADO_MENSUAL"},
         {title:"Sede", field:"SEDES"},	 
         {title:"Departamento", field:"DEPARTAMENTO"},	 
	 	{title:"Ciudad", field:"CIUDAD"},
	 	{title:"Temporal", field:"TEMPORAL"},
 	],
     
 	
});

$("#buscarData").keyup(function()
{
	$filter = $(this).val();
	table.setFilter([
		[
			{field:"ID_CONVOCATORIA", type:"like", value:$filter},
			{field:"REQUISICI_N", type:"like", value:$filter}, 
			{field:"CARGO", type:"like", value:$filter}, 
			{field:"TIPO_DE_PROCESO", type:"like", value:$filter}, 
			{field:"VACANTES", type:"like", value:$filter}, 
			{field:"SALARIO_ASIGNADO_MENSUAL", type:"like", value:$filter}, 
			{field:"SEDES", type:"like", value:$filter}, 
			{field:"DEPARTAMENTO", type:"like", value:$filter}, 
			{field:"CIUDAD", type:"like", value:$filter}, 
			{field:"TEMPORAL", type:"like", value:$filter}, 
		]
	]);
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
 