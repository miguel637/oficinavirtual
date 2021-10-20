<h3>Usuarios</h3>
  <p>Oficina Virtual, se puede administrar los usuarios, cambiar las contraseñas, activar o desactivar usuarios y la capacidad de sincronizar usuarios de Zoho</p>
  <a href="<?php echo site_url("admon/syncusers");?>" class='actLoader'><button class="btn btn-success btn-sm mb-4"><i class="fas fa-sync-alt"></i> Sincronizar Aprobadores</button></a>
  <a href="<?php echo site_url("admon/syncmisionales");?>" class='actLoader'><button class="btn btn-info btn-sm mb-4"><i class="fas fa-sync-alt"></i> Sincronizar Personas</button></a>
  <a href="<?php echo site_url("admon/syncpracticantes");?>" class='actLoader'><button class="btn btn-dark btn-sm mb-4"><i class="fas fa-sync-alt"></i> Sincronizar Funcionarios</button></a>

<link href="https://unpkg.com/tabulator-tables@4.8.2/dist/css/bootstrap/tabulator_bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="<?php echo base_url();?>lib/js/tabulator.min.js"></script>

<h4>Misionales</h4>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<div class="input-group mb-2">
  <input id="buscarData" type="text" class="form-control" placeholder="Buscar  ..." aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button id='btnSearch' class="btn btn-outline-info" type="button">Buscar</button>
  </div>
</div>
<div id="table-rendered"></div>
<button class='d-none' id='btnDo'></button>

<?php

echo "<script>object = ".json_encode($users_persona).";</script>";
?>

<script>

	var changePswButton = function(cell, formatterParams){ //plain text value
		return '<button class="btn btn-outline-info btn-sm"><i class="fas fa-lock"></i> Reset Password</button>';
	};

 var table = new Tabulator("#table-rendered", {
 	data:object,
	layout:"fitData",
	maxHeight:"92%",
	pagination:"local",
	paginationSize:10,
	paginationSizeSelector:[10, 25, 50, 100],
 	columns:[
		{formatter:changePswButton, width:150, hozAlign:"center",cellClick:function(e, cell){
      e.preventDefault();
			alertify.prompt( 'Asignar Nueva Contraseña', 'Cambio para el usuario:<br/> <b>'+cell.getRow().getData().correo + " - " +cell.getRow().getData().persona+"</b><br/><br/><p class='text-success'>Nueva Contraseña</p>", cell.getRow().getData().correo
               , function(evt, value) { 
                 //OK
                 if(value == undefined || value == "")
                 {
                   $('.ajs-input').addClass('border border-danger');
                   $('.ajs-input').after("<p id='alert-text-type1' class='text-danger'>La contraseña no puede ser nula</p>")
                   $('.ajs-input').change(function(){$('#alert-text-type1').remove();$(this).removeClass('border border-danger');});

                    return false; 
                  }
                  else
                  {
                    data = {toUser: cell.getRow().getData().id_usuario, fieldnew: value};
                    myw = window.open(global_url+"api/updateUserPassword?toUser="+data.toUser+"&fieldnew="+encodeURI(value),"_blank");
                    alertify.success("modificada");
                    setTimeout(function(){ myw.close(); },1000);
                  }
                 
                }
               , function() { alertify.error('Cancelado') }).set('labels', {ok:'Cambiar', cancel:'Cancelar!'});;
		}},    
	 	{title:"Usuario", field:"correo"},	 	
	 	{title:"Persona", field:"persona"},
    {title:"Cargo", field:"cargo"},
    {title:"Empresa", field:"cliente"},
    {title:"Telefono", field:"telefono"},	 
 	],
     
 	
});

$("#buscarData").keyup(function()
{
	$filter = $(this).val();
	table.setFilter([
		[
			{field:"correo", type:"like", value:$filter},
			{field:"persona", type:"like", value:$filter}, 
			{field:"cargo", type:"like", value:$filter}, 
			{field:"cliente", type:"like", value:$filter},
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
 