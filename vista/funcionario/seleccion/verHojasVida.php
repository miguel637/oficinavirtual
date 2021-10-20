<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<div class="input-group mb-2">
  <input id="buscarData" type="text" class="form-control" placeholder="Filtro por cargo" aria-label="Recipient's username" aria-describedby="basic-addon2">
  <div class="input-group-append">
    <button id='btnSearch' class="btn btn-outline-info" type="button">Buscar Cargo</button>
  </div>
</div>
<p>Filtro actual cargo: <span id='filter' class="text-info mx-2"> </span><i id='removeFilter' class="fas fa-remove text-danger d-none pointer"></i> </p>
<iframe id="framehv" height='88%' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src=''></iframe>

<script>
$(document).ready(function(){
    linktoframe = "https://creator.zohopublic.com/hq5colombia/hq5/report-embed/HOJA_DE_VIDA_Report/TA0sfNwpGzfGRv0yTwVQgkn35KeyezDbaNKyk96mdHpO7DMTBgXDmQKXE59VRVPbrTEVR9ZHmVY0wzr9NeznTSdqgCnrSPQJ0wxF";
    $iframe = $('#framehv');
    $iframe.attr('src',linktoframe);

    $("#btnSearch").click(function(){
        if($('#buscarData').val() != "")
        {
            $iframe.attr('src',linktoframe+"?SubForm_HISTORIA_LABORAL.CARGO="+$('#buscarData').val()+"&SubForm_HISTORIA_LABORAL.CARGO_op=26");
            $('#filter').html($('#buscarData').val());
            $('#removeFilter').removeClass("d-none");
            
            $('#buscarData').val("");
        }        
    });

    $('#removeFilter').click(function(){
        $('#removeFilter').addClass("d-none");
        $('#filter').html("");
        $iframe.attr('src',linktoframe);
    });
});
</script>