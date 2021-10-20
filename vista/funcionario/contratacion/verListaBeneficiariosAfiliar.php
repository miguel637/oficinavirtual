<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>
<script type="text/javascript" src="https://oss.sheetjs.com/sheetjs/xlsx.full.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<form action="#" method="get">
<div class="input-group mb-3">
	<input type="text" class="form-control" placeholder="busqueda  ..." aria-label="Recipient's username" aria-describedby="basic-addon2" id="buscarData" name="filterEmpresa" required>
	<div class="input-group-append">
		<button class="btn btn-outline-info" type="button">Buscar</button>
	</div>  
</div>
</form>
<hr class="my-4" />

<div class='text-center m-4 '>
    <span id="example-table-info"></span>
    <button id="download-xls" style="position:absolute; right:4%;" class="btn btn-success btn-sm"><i class="fas fa-download"></i> Exportar excel</button>    
</div>

<div id="table-rendered" class="mt-5"></div>

		<?php
		echo "<script>object = [];</script>";
		
		$start = 0;
		while($start < 400)
		{
			
            $curl = curl_init();

            curl_setopt_array($curl, array(
				CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/REPORTE_DE_AFILIACI_N_DE_BENEFICIARIOS?privatelink=RrRzaHuCU2GqsCFYgkA6gGKsVU4s4uw6fVOFbCPKvP1F7GU3a4Tmm0ZbjOu5Qa4ry9jOPkeCH74d60Wn1nVgaMFDKDGfJg2W39RS&from=$start",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => false,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
            ));

			$start +=200;

            $result = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

			$manage = json_decode($result);

			if(isset($manage->data))
			{
				foreach($manage->data as $fila)
				{

                    if(isset($fila->Identificaci_n->display_value)) $identificacion = $fila->Identificaci_n->display_value;
                    else $identificacion = "0";
					echo "<script>dto = {'ID':'$fila->ID','Fecha_y_Hora_del_Reporte':'$fila->Fecha_y_Hora_del_Reporte','Desea_afiliar_a_Caja_de_Compensaci_n_Familiar':'$fila->Desea_afiliar_a_Caja_de_Compensaci_n_Familiar','Desea_afiliar_a_EPS':'$fila->Desea_afiliar_a_EPS','Beneficiario':'$fila->Nombres_y_Apellidos','Parentezco':'$fila->Parentezco','Tel_fono_de_Contacto':'$fila->Tel_fono_de_Contacto','CCF_Estado':'$fila->CCF_Estado','EPS_Estado':'$fila->EPS_Estado','Numero_de_Contrato':'$fila->Numero_de_Contrato','Apellidos_y_Nombres':'$fila->Apellidos_y_Nombres','Identificaci_n':'$identificacion'};</script>";
					echo "<script>object.push(dto);</script>";
				}
			}
		}
		

		?>
		<script>
			var viewButton = function(cell, formatterParams){ //plain text value
				return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
			};

			var editButton = function(cell, formatterParams){ //plain text value
				return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button>';
			};

			var deseaAfiliar = function(cell, formatterParams){
				cell.getElement().style.color = "#000";
				cell.getElement().style.textAlign = "center";
				cell.getElement().style.border = "1px solid #fff";

				if(cell.getValue() == "SI")
				{
					cell.getElement().style.backgroundColor = "#9BEE87";					
					return "SI";
				}
				else{
					cell.getElement().style.backgroundColor = "#F8AF91";					
					return "NO";
				}
			};
		
		if(object.length > 0)
		{
			var table = new Tabulator("#table-rendered", {
			data:object,
			layout:"fitData",
			maxHeight:"92%",
			pagination:"local",
			paginationSize:10,
			paginationSizeSelector:[10, 25, 50, 100],
            groupBy:function(data){
                return data.Numero_de_Contrato+" - "+data.Identificaci_n+" "+data.Apellidos_y_Nombres;
            },
            groupHeader:function(value, count, data, group){
                var plurar = (count == 1) ? "" : "s";
                return value + "<span style='color:#d00; margin-left:10px;'>- "+count+" Beneficiario"+plurar+"</span>";
            },
			columns:[
				{formatter:viewButton, width:100, hozAlign:"center",cellClick:function(e, cell){

					var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/REPORTE_DE_AFILIACI_N_DE_BENEFICIARIOS/" + cell.getRow().getData().ID + "/RrRzaHuCU2GqsCFYgkA6gGKsVU4s4uw6fVOFbCPKvP1F7GU3a4Tmm0ZbjOu5Qa4ry9jOPkeCH74d60Wn1nVgaMFDKDGfJg2W39RS";
					window.open(link, '_blank');
				}},
				{formatter:editButton, width:100, hozAlign:"center",cellClick:function(e, cell){

					var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/AFILIACI_N_DE_BENEFICIARIOS/record-edit/REPORTE_DE_AFILIACI_N_DE_BENEFICIARIOS/" + cell.getRow().getData().ID + "/RrRzaHuCU2GqsCFYgkA6gGKsVU4s4uw6fVOFbCPKvP1F7GU3a4Tmm0ZbjOu5Qa4ry9jOPkeCH74d60Wn1nVgaMFDKDGfJg2W39RS?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
					window.open(link, '_blank');
				}},
				{title:"Fecha/Hora Reporte", field:"Fecha_y_Hora_del_Reporte"},
				{title:"¿Desea Afiliarlo a CCF?", field:"Desea_afiliar_a_Caja_de_Compensaci_n_Familiar",formatter:deseaAfiliar},
				{title:"¿Desea Afiliarlo a EPS?", field:"Desea_afiliar_a_EPS",formatter:deseaAfiliar},
				{title:"Beneficiario", field:"Beneficiario"},
				{title:"Parentesco", field:"Parentezco"},
				{title:"Telefono", field:"Tel_fono_de_Contacto"},
				{title:"Estado CCF", field:"CCF_Estado"},
				{title:"Estado EPS", field:"EPS_Estado"},				
			],
			
			
			});

			$("#buscarData").keyup(function()
			{
				$filter = $(this).val();
				table.setFilter([
					[
						{field:"Numero_de_Contrato", type:"like", value:$filter},
						{field:"Identificaci_n", type:"like", value:$filter}, 
						{field:"Apellidos_y_Nombres", type:"like", value:$filter}, 
						{field:"Beneficiario", type:"like", value:$filter}, 
						{field:"Tel_fono_de_Contacto", type:"like", value:$filter}, 
						{field:"Parentezco", type:"like", value:$filter}, 
					]
				]);
			});
		}

        $("#download-xls").on("click", function(){
            table.download("xlsx", "ListaBeneficiarios_Afiliar_<?php echo date('d_m_Y');?>.xlsx", {sheetName:"Beneficiarios a Afiliar"});
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