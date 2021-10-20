<?php
//<iframe height='98%' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/hq5/report-embed/CONTRATADOS/GZAOy3Q8h9z5fgjbMDbTytEZDWvpvvgmxF1HrOJq0zjSTYj9d5GsrX7tQTRnnuzGOXyHmpjdtR2kTsbC0SrNtvpFw36t8YWDSV5D'></iframe>
?>
<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<form action="#" method="get">
<div class="input-group mb-3">
	<input type="text" class="form-control" placeholder="Escribe la empresa  ..." aria-label="Recipient's username" aria-describedby="basic-addon2" name="filterEmpresa" required>
	<div class="input-group-append">
		<button class="btn btn-outline-info" type="submit">Buscar</button>
	</div>  
</div>
</form>
<hr class="my-4" />
<?php

if(isset($_GET["filterEmpresa"]))
{
	?>
		<div class="row" id="result">
			<input id="buscarData" type="text" class="form-control" placeholder="Buscar en la Tabla" aria-label="Recipient's username" aria-describedby="basic-addon2">
		</div>
		<div id="table-rendered"></div>

		<?php
		echo "<script>object = [];</script>";
		
			$filtro = $_GET["filterEmpresa"];

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/CONTRATADOS?privatelink=GZAOy3Q8h9z5fgjbMDbTytEZDWvpvvgmxF1HrOJq0zjSTYj9d5GsrX7tQTRnnuzGOXyHmpjdtR2kTsbC0SrNtvpFw36t8YWDSV5D&criteria=EMPRESA_APLICAR_CONVOCATORIA.RAZ_N_SOCIAL.contains(%22$filtro%22)",
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
					$TEMPORAL = $fila->{'CONVOCATORIAS_APLICAR_CONVOCATORIA.TEMPORAL'};
					$EMPRESA = $fila->{'CONVOCATORIAS_APLICAR_CONVOCATORIA.EMPRESA_USURIA'};
					$CARGO = $fila->{'CONVOCATORIAS_APLICAR_CONVOCATORIA.CARGO'};
					$SALARIO = $fila->{'ORDEN_DE_CONTRATACI_N_Numero_de_Orden.Compensaci_n'};
					$Fecha_de_Ingreso = $fila->{'ORDEN_DE_CONTRATACI_N_Numero_de_Orden.Fecha_de_Ingreso'};
					$NOMBRES_Y_APELLIDOS = $fila->NOMBRES_Y_APELLIDOS->display_value;

					echo "<script>dto = {'ID':'$fila->ID','Numero_de_contrato':'$fila->N_mero_de_Contrato','ID_POSTULANTE':'$fila->ID_POSTULANTE', 'DOCUMENTO':'$fila->DOCUMENTO','NOMBRES_Y_APELLIDOS':'$NOMBRES_Y_APELLIDOS','TEMPORAL':'$TEMPORAL','EMPRESA':'$EMPRESA','CARGO':'$CARGO','SALARIO':'$SALARIO','Fecha_de_Ingreso':'$Fecha_de_Ingreso','Fecha_de_Contrataci_n':'$fila->Fecha_de_Contrataci_n','Fecha_Afiliacion_EPS':'$fila->Fecha_Afiliacion_EPS','Fecha_Afiliacion_Caja':'$fila->Fecha_Afiliacion_Caja'};</script>";
					echo "<script>object.push(dto);</script>";
				}
			}
		 
		

		?>
		<script>
			console.log(object);
			var viewButton = function(cell, formatterParams){ //plain text value
				return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
			};

			var editButton = function(cell, formatterParams){ //plain text value
				return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button>';
			};
		
		if(object.length > 0)
		{
            fieldEditar = {headerSort:false};
            <?php if(str_contains($_SESSION["user_usuario"],"ejecutivodecuenta") || str_contains($_SESSION["user_usuario"],"coordinador.servicio") || str_contains($_SESSION["user_usuario"],"desarrollo") )
            {
                ?>

                fieldEditar = {formatter:editButton, width:100, hozAlign:"center",
                cellClick:function(e, cell){					
					var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/APLICAR_CONVOCATORIAS/record-edit/CONTRATADOS/" + cell.getRow().getData().ID + "/GZAOy3Q8h9z5fgjbMDbTytEZDWvpvvgmxF1HrOJq0zjSTYj9d5GsrX7tQTRnnuzGOXyHmpjdtR2kTsbC0SrNtvpFw36t8YWDSV5D?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
					window.open(link, '_blank');
				}};

                <?php
            }
            ?>

			var table = new Tabulator("#table-rendered", {
			data:object,
			layout:"fitData",
			maxHeight:"92%",
			pagination:"local",
			paginationSize:10,
			paginationSizeSelector:[10, 25, 50, 100],
			columns:[
				{formatter:viewButton, width:100, hozAlign:"center",cellClick:function(e, cell){

					var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/CONTRATADOS/" + cell.getRow().getData().ID + "/GZAOy3Q8h9z5fgjbMDbTytEZDWvpvvgmxF1HrOJq0zjSTYj9d5GsrX7tQTRnnuzGOXyHmpjdtR2kTsbC0SrNtvpFw36t8YWDSV5D";
					window.open(link, '_blank');
				}},
				fieldEditar,
				{title:"Número de Contrato", field:"Numero_de_contrato"},
				{title:"Postulado", field:"ID_POSTULANTE"},
				{title:"Documento", field:"DOCUMENTO"},
				{title:"Nombres", field:"NOMBRES_Y_APELLIDOS"},
				{title:"Cargo", field:"CARGO"},
				{title:"Empresa", field:"EMPRESA"},
				{title:"Temporal", field:"TEMPORAL"},
				{title:"Salario", field:"SALARIO"},
				{title:"Fecha de Ingreso", field:"Fecha_de_Ingreso"},
				{title:"Fecha de Contratación", field:"Fecha_de_Contrataci_n"},
				{title:"Afiliación a EPS", field:"Fecha_Afiliacion_EPS"},
				{title:"Afiliación a Caja", field:"Fecha_Afiliacion_Caja"},
				
			],
			
			
			});

			$("#buscarData").keyup(function()
			{
				$filter = $(this).val();
				table.setFilter([
					[
						{field:"Numero_de_contrato", type:"like", value:$filter},
						{field:"ID_POSTULANTE", type:"like", value:$filter}, 
						{field:"DOCUMENTO", type:"like", value:$filter}, 
						{field:"NOMBRES_Y_APELLIDOS", type:"like", value:$filter}, 
						{field:"CARGO", type:"like", value:$filter}, 
						{field:"EMPRESA", type:"like", value:$filter}, 
						{field:"TEMPORAL", type:"like", value:$filter}, 
						{field:"SALARIO", type:"like", value:$filter}, 	
						{field:"Fecha_de_Ingreso", type:"like", value:$filter}, 
						{field:"Fecha_de_Contrataci_n", type:"like", value:$filter},
						{field:"Fecha_Afiliacion_EPS",type:"like", value:$filter},
					
					]
				]);
			});
		}
		else
		{
			$('#result').html("<div class='alert alert-info'>No se encuentran resultados con la empresa:<b><?php echo $_GET["filterEmpresa"];?></div></b>");
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