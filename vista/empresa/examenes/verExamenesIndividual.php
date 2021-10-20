<?php
//<iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creatorapp.zohopublic.com/hq5colombia/hq5/report-embed/PROGRAMACI_N_DE_EX_MENES_M_DICOS_Report/zzUFVUA5thBmEYwZxObgMvpfz1bxU711fXRVSs42TCZtR0Ws1TnRA76xtPY5eR4HVMnFCfUeUz7sUUnT3ZvxgetP86OgOR6MpZpt'></iframe>
?>



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
        <label for="">Postulación</label>
          <input aria-controls="postulacion" id="focu" type="text" placeholder="Buscar por Postulación" class="form-control buscarData">
        </div>
    
        <div class="col-4">
          <select id="filtropor" class="form-control">
            <option value="seleccionar">Seleccionar...</option>
            <option value="centro">Centro Medico</option>
            <option value="empresa">Empresa</option>

   
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

    while($start < 1001)
    {
    
      $url = "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/PROGRAMACI_N_DE_EX_MENES_M_DICOS_Report?privatelink=zzUFVUA5thBmEYwZxObgMvpfz1bxU711fXRVSs42TCZtR0Ws1TnRA76xtPY5eR4HVMnFCfUeUz7sUUnT3ZvxgetP86OgOR6MpZpt&from=$start&EMPRESA_USURIA.ID=". $_SESSION['idEmpresa_user'];
      
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
            $id_examanes = $fila->ID_PROGRAMACI_N_EX_MENES_M_DICOS;
            $fecha_examen = $fila->FECHA_A_REALIZAR_EL_EXAMEN;
            $hora_examen = $fila->Hora_del_Examen;
            $Concepto = $fila->Concepto;
            $convocatoria = $fila->CONVOCATORIAS->display_value;
            $postulacion= $fila->POSTULACION->display_value;
            $POSTULADO_p = $fila->POSTULADO_programacion->display_value;
            $centromedico = $fila->CENTRO_MEDICO->display_value;
            $empresa_usuaria = $fila->EMPRESA_USUARIA->display_value;
            $Added_Time = $fila->Added_Time;

    
          echo "<script>dto = {'id':'$id','ID_PROGRAMACI_N_EX_MENES_M_DICOS':'$id_examanes','FECHA_A_REALIZAR_EL_EXAMEN':'$fecha_examen','Hora_del_Examen':'$hora_examen','Concepto':'$Concepto','CONVOCATORIAS':' $convocatoria','POSTULACION':'$postulacion','POSTULADO_programacion':'$POSTULADO_p','CENTRO_MEDICO':'$centromedico','EMPRESA_USUARIA':'$empresa_usuaria','Added_Time':'$Added_Time'};
          object.push(dto);</script>";
    
        }
      } 
    }
    ?>
    
    <script>
    
        var viewButton = function(cell, formatterParams){ //plain text value
               return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> Ver</button>';
        };
    
        var editButton = function(cell, formatterParams){ //plain text value
        return '<button id="viewbtn" class="btn btn-outline-info btn-sm"><i class="fas fa-pencil-alt"></i> Editar</button>';
    };
    
     var table = new Tabulator("#table-rendered", {
         data:object,
        layout:"fitData",
        maxHeight:"92%",
        pagination:"local",
        paginationSize:15,
    
    
        groupBy:function(data){
            
            return data.Concepto;
        },
        groupHeader:function(value, count, data, group){
        //value - the value all members of this group share
        //count - the number of rows in this group
        //data - an array of all the row data objects in this group
        //group - the group component for the group
    
            return value + "<span style='color:#d00; margin-left:10px;'>("+count+")</span>";
        },
    
     
        paginationSizeSelector:[15, 25, 50, 110],
         columns:[
    
    
            {formatter:viewButton, headerSort:false, width:100, hozAlign:"center",cellClick:function(e, cell){
    
                var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/PROGRAMACI_N_DE_EX_MENES_M_DICOS_Report/" + cell.getRow().getData().id + "/zzUFVUA5thBmEYwZxObgMvpfz1bxU711fXRVSs42TCZtR0Ws1TnRA76xtPY5eR4HVMnFCfUeUz7sUUnT3ZvxgetP86OgOR6MpZpt";
                window.open(link, '_blank');
            }},


		{formatter:editButton, width:100, hozAlign:"center",cellClick:function(e, cell){
			
			var link = "https://creatorapp.zohopublic.com/hq5colombia/hq5/PROGRAMACI_N_DE_EX_MENES_M_DICOS/record-edit/PROGRAMACI_N_DE_EX_MENES_M_DICOS_Report/" + cell.getRow().getData().id + "/zzUFVUA5thBmEYwZxObgMvpfz1bxU711fXRVSs42TCZtR0Ws1TnRA76xtPY5eR4HVMnFCfUeUz7sUUnT3ZvxgetP86OgOR6MpZpt?Usuario_OV_modificaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>";
			window.open(link, '_blank');

            
		}},
    
    
        {title:"ID", field:"ID_PROGRAMACI_N_EX_MENES_M_DICOS"},
	 	{title:"Fecha Exámen", field:"FECHA_A_REALIZAR_EL_EXAMEN"},
	 	{title:"Hora", field:"Hora_del_Examen"},	 
	 	{title:"Concepto", field:"Concepto"},	 
	 	{title:"Convocatoria", field:"CONVOCATORIAS"},	 
	 	{title:"Proceso", field:"POSTULACION"},	 
	 	{title:"Nombres y Apellidos", field:"POSTULADO_programacion"},
	 	{title:"Centro Medico", field:"CENTRO_MEDICO"},
	 	{title:"Empresa", field:"EMPRESA_USUARIA"},
	 	{title:"Fecha Registro", field:"Added_Time"},
            
            
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
    var postulación = "";
    
    function filtrar(filtroEspecifico = {})
    {
      table.setFilter([
            
          {field:"CONVOCATORIAS", type:"like", value:convocatoria},
          {field:"POSTULACION", type:"like", value:postulación},
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
      else if($para == "postulacion")
      {
        postulación = $filter;
      }
    
      
      else if($para == "specific")
      {
        $specific = $('#filtropor').val();
    
        sendToFiltrar = {};
        
        if($specific == "centro")
        {
          sendToFiltrar = {field: "CENTRO_MEDICO",type:"like",value: $filter};      
        }
    
        if($specific == "empresa")
        {
          sendToFiltrar = {field: "EMPRESA_USUARIA",type:"like",value: $filter};      
        }
    

        filtrar(sendToFiltrar);
        return true;
    
      }
      filtrar();
    
    });
    
    
    $("#download-xls").on("click", function(){
        table.download("xlsx", "Fidu_Ver_ExamenesMedicos <?php echo date('d_m_Y');?>.xlsx", {sheetName:"Fidu_Ver_ExamenesMedicos"});
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