<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/hq5/report-embed/ANEXAR_PERFILES_Report/YDD3m9pYwugGJ42xg81unaJb8x065G9HF44Y6Jd5SrAC1PVddRs3eCH6hOwauEKgEhX3MtS1BsCQZ7Y01f2TW345ss18fQNKdF5J'></iframe>
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

$url = "https://creator.zoho.com/api/json/hq5/view/ANEXAR_PERFILES_Report";

$postdata = http_build_query(
    array(
        "authtoken" => "530bbb13d105c9ddffe00f5d794c09ad",
        "scope" => "creatorapi",
		"zc_ownername" => "hq5colombia",
		"criteria" => "EMPRESA.ID == ".$_SESSION["idEmpresa_user"]
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
	var str = JSON.stringify(zohohq5colombiaview4.ANEXAR_PERFILES);
	//str = str.replace(/CONVOCATORIAS_APLICAR_CONVOCATORIA.EMPRESA_USURIA/g, 'EMPRESA_TEXT');

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
			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/ANEXAR_PERFILES_Report/" + cell.getRow().getData().ID + "/YDD3m9pYwugGJ42xg81unaJb8x065G9HF44Y6Jd5SrAC1PVddRs3eCH6hOwauEKgEhX3MtS1BsCQZ7Y01f2TW345ss18fQNKdF5J";
			window.open(link, '_blank');
		}},
		{formatter:editButton, width:100, hozAlign:"center",cellClick:function(e, cell){
			
			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/ANEXAR_PERFILES/record-edit/ANEXAR_PERFILES_Report/" + cell.getRow().getData().ID + "/YDD3m9pYwugGJ42xg81unaJb8x065G9HF44Y6Jd5SrAC1PVddRs3eCH6hOwauEKgEhX3MtS1BsCQZ7Y01f2TW345ss18fQNKdF5J?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
			window.open(link, '_blank');
		}},
        {title:"Cargo", field:"CARGO"},
	 	{title:"Ubicación", field:"UBICACION_SUB_CENTRO"},	 
	 	{title:"Clasificación de Riesgos", field:"CLASIFICACION_DE_RIESGOS"},	 
	 	{title:"Creación", field:"Added_Time"},
	 	{title:"Empresa", field:"EMPRESA"},
 	],
     
 	
});

$("#buscarData").keyup(function()
{
	$filter = $(this).val();
	table.setFilter([
		[
			{field:"CARGO", type:"like", value:$filter},
			{field:"UBICACION_SUB_CENTRO", type:"like", value:$filter}, 
			{field:"CLASIFICACION_DE_RIESGOS", type:"like", value:$filter}, 
			{field:"CARGO", type:"like", value:$filter}, 
			{field:"Added_Time", type:"like", value:$filter}, 
			{field:"EMPRESA", type:"like", value:$filter}, 
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
 