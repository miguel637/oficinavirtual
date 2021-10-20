
<button id='createHV' class='btn btn-info d-none'>Crear Hoja de Vida</button>
<button id='editHV' class='btn btn-info d-none'>Editar Hoja de Vida</button>
<p class='noteShow d-none'>Nota: Una vez creada o editada la hoja de vida, refrescar o recargar la pagina.</p>
<input type="hidden" id="tokenizate">
<iframe id='viewHV' class='mt-4' height='87%' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src=''></iframe>

    <?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/hq5/report/HOJA_DE_VIDA_Report?privatelink=TA0sfNwpGzfGRv0yTwVQgkn35KeyezDbaNKyk96mdHpO7DMTBgXDmQKXE59VRVPbrTEVR9ZHmVY0wzr9NeznTSdqgCnrSPQJ0wxF&criteria=NO_IDENTIFICACI_N==%22".$_SESSION["user_usuario"]."%22",
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

echo "<script>

var resulting = $result;


if(resulting.data.length > 0)
{
    tokenizateId = resulting.data[0].ID;
    document.getElementById('tokenizate').value = tokenizateId;
    srcToPut = 'https://creatorapp.zohopublic.com/hq5colombia/hq5/record-summary/HOJA_DE_VIDA_Report/'+tokenizateId+'/TA0sfNwpGzfGRv0yTwVQgkn35KeyezDbaNKyk96mdHpO7DMTBgXDmQKXE59VRVPbrTEVR9ZHmVY0wzr9NeznTSdqgCnrSPQJ0wxF';
    document.getElementById('viewHV').setAttribute('src',srcToPut);

    var element = document.getElementById('editHV');
    element.classList.remove('d-none');
}
else
{
    var element = document.getElementById('createHV');
    element.classList.remove('d-none');
}

</script>";

?>

<script>
$(document).ready(function(){
    $('#editHV').click(function(){

        srcToEdit = 'https://creatorapp.zohopublic.com/hq5colombia/hq5/HOJA_DE_VIDA/record-edit/HOJA_DE_VIDA_Report/'+$('#tokenizate').val()+'/TA0sfNwpGzfGRv0yTwVQgkn35KeyezDbaNKyk96mdHpO7DMTBgXDmQKXE59VRVPbrTEVR9ZHmVY0wzr9NeznTSdqgCnrSPQJ0wxF';
        
        $('#viewHV').attr('src',srcToEdit);

        $('.noteShow').removeClass('d-none');
        
    });

    $('#createHV').click(function(){

        srcToAdd = "https://creatorapp.zohopublic.com/hq5colombia/hq5/form-embed/HOJA_DE_VIDA/BbFRTPGTpKv4B45z0OkVg9pqy4w3uxKnJvymfA90589YbVdzVDQWEYG3gz5wPrkKBw8MFrZDPQYGkEbQOWzu5y1QQO9upyUaUu36?NO_IDENTIFICACI_N=<?php echo $_SESSION["user_usuario"];?>";

        $('#viewHV').attr('src',srcToAdd);

        $('.noteShow').removeClass('d-none');
    });
});
</script>
