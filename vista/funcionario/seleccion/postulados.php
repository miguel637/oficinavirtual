<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/hq5/report-embed/APLICAR_CONVOCATORIAS_Report/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R'></iframe>
?>
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<form action="#" method="get">
<div class="row my-2"><small class="mx-auto">Digita el numero de convocatorias o el numero de documento para iniciar la busqueda del proceso</small></div>
<div class="input-group mb-3">

  
	<input type="number" class="form-control" placeholder="Escribe la convocatoria" name="filterConvocatoria"> <span class="mx-5"> ó </span>
	<input type="number" class="form-control" placeholder="Escribe el documento" name="documento">
  
	<div class="input-group-append">
		<button class="btn btn-outline-info" type="submit">Buscar</button>
	</div>  
</div>
</form>
<hr class="my-4" />
<?php

if(isset($_GET["filterConvocatoria"]) || isset($_GET["documento"]))
{
	?>
		<div class="row" id="result">
			<input id="buscarData" type="text" class="form-control" placeholder="Buscar en la Tabla" aria-label="Recipient's username" aria-describedby="basic-addon2">
		</div>
		<div id="table-rendered"></div>

		<?php
			echo "<script>object = [];</script>";
		
			if($_GET["filterConvocatoria"] != "")
			{
				$filtroDetalle = "Convocatoria: ".intval($_GET["filterConvocatoria"]);
				$filtro = "CONVOCATORIAS_APLICAR_CONVOCATORIA.ID_CONVOCATORIA==".intval($_GET["filterConvocatoria"]);
			}
			else if($_GET["documento"] != "")
			{
				$filtroDetalle = "Documento: ".intval($_GET["documento"]);
				$filtro='DOCUMENTO.contains(%22'.$_GET["documento"].'%22)';
			}
			else {$filtroDetalle = "! Se requiere el numero de convocatoria o el documento ¡";$filtro="DOCUMENTO==datanet";};
			

			$curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/APLICAR_CONVOCATORIAS_Report?privatelink=D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R&criteria=$filtro",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            ));

            $result = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

			$manage = json_decode($result);
			
			if(isset($manage->data))
			{
				foreach($manage->data as $fila)
				{
					$requi = $fila->{'CONVOCATORIAS_APLICAR_CONVOCATORIA.REQUISICI_N'};
					$empresa = $fila->EMPRESA_APLICAR_CONVOCATORIA->display_value;
					$sede = $fila->SEDE_APLICAR_CONVOCATORIA->display_value;
					$psicologo = (isset($fila->PSICOLOGO->display_value)) ? $fila->PSICOLOGO->display_value : "";
					$convocatoria = $fila->CONVOCATORIAS_APLICAR_CONVOCATORIA->display_value;
					$cargo = $fila->CARGO_APLICAR_CONVOCATORIA->display_value;
					$nombres = $fila->NOMBRES_Y_APELLIDOS->display_value;
					echo "<script>dto = {'ID':'$fila->ID','Empresa':'$empresa','Estado_Postulacion':'$fila->Estado_Postulacion', 'SEDE_APLICAR_CONVOCATORIA':'$sede','PSICOLOGO':'$psicologo','CONVOCATORIAS_APLICAR_CONVOCATORIA':'$convocatoria','Requisicion_id':'$requi','CARGO_APLICAR_CONVOCATORIA':'$cargo','DOCUMENTO':'$fila->DOCUMENTO','NOMBRES':'$nombres','Reclutador':''};</script>";
					echo "<script>object.push(dto);</script>";
				}
			}		

		?>
		<script>
			console.log(object);
			var viewButton = function(cell, formatterParams){ //plain text value
				return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
			};

			var editButton = function(cell, formatterParams){ //plain text value
				return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button>';
			};
		
			if(object.length > 0)
			{
				var table = new Tabulator("#table-rendered", {
				data:object,
				layout:"fitData",
				maxHeight:"92%",
				pagination:"local",
				paginationSize:10,
				groupBy:function(data){
					
					return data.SEDE_APLICAR_CONVOCATORIA + " > " + data.Requisicion_id;
				},
				groupHeader:function(value, count, data, group){
				//value - the value all members of this group share
				//count - the number of rows in this group
				//data - an array of all the row data objects in this group
				//group - the group component for the group

					return value + "<span style='color:#d00; margin-left:10px;'>("+count+")</span>";
				},
				paginationSizeSelector:[10, 25, 50, 100],
				columns:[
					{formatter:viewButton, width:100, hozAlign:"center",cellClick:function(e, cell){

						var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/APLICAR_CONVOCATORIAS_Report/" + cell.getRow().getData().ID + "/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R";
						window.open(link, '_blank');
					}},
					{formatter:editButton, width:100, hozAlign:"center",cellClick:function(e, cell){
						
						var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/APLICAR_CONVOCATORIAS/record-edit/APLICAR_CONVOCATORIAS_Report/" + cell.getRow().getData().ID + "/D3GC1487tQ3axErQRgyRVQsdTkECTpaaF9XKHOz25UXv4Zd2RCAtBNG0VqRCr2eWxXGUh04fZsfRe3Z309RQP3sVx9qR9MKXXg2R?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
						window.open(link, '_blank');
					}},
					{title:"Estado", field:"Estado_Postulacion"},
					{title:"Convocatoria", field:"CONVOCATORIAS_APLICAR_CONVOCATORIA"},
					{title:"Documento", field:"DOCUMENTO"},
					{title:"Nombres", field:"NOMBRES"},
					{title:"Cargo", field:"CARGO_APLICAR_CONVOCATORIA"},
					{title:"Psicologo", field:"PSICOLOGO"},
					{title:"Empresa", field:"Empresa"},
					
				],
				
				
				});

				$("#buscarData").keyup(function()
				{
					$filter = $(this).val();
					table.setFilter([
						[
							{field:"Estado_Postulacion", type:"like", value:$filter},
							{field:"CONVOCATORIAS_APLICAR_CONVOCATORIA", type:"like", value:$filter}, 
							{field:"Requisicion_id", type:"like", value:$filter}, 
							{field:"CARGO_APLICAR_CONVOCATORIA", type:"like", value:$filter}, 
							{field:"DOCUMENTO", type:"like", value:$filter}, 
							{field:"NOMBRES", type:"like", value:$filter}, 
							{field:"CARGO_APLICAR_CONVOCATORIA", type:"like", value:$filter}, 
							{field:"SEDE_APLICAR_CONVOCATORIA", type:"like", value:$filter}, 	
							{field:"PSICOLOGO", type:"like", value:$filter}, 
							{field:"Empresa",type:"like", value:$filter},
						
						]
					]);
				});
			}
			else
			{
				$('#result').html("<div class='alert alert-info'>No se encuentran resultados, <b><?php echo $filtroDetalle;?> </div></b>");
			}
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
		<?php }
?>