<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/contratos-n-mina/report/Contrato_Report?privatelink=CGe1bAAtdds2k9nEgRWrSv4as5WBOn8PNskV8n2343rOYHJvd9vR05wFKNFOMRRxg1hkdCqV0qF0AWEsEbpgKNgCjDtFFO4n5mZJ&criteria=Modified_Time%20is%20Today",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo "<script>var contratosToImport = $response;</script>";
} 
?>

<div class="row">
    <div class="col-12 text-center"><img src="<?php echo base_url().'lib/img/sincronizado.png';?>" alt=""></div>
</div>
<div class="row mt-4">
    <div id='resultAdded' class="alert mx-auto">Sincronizando...</div>
</div>

<script>
    
    $.post("<?php echo site_url("admon/addmisions");?>",contratosToImport ,function( data ) {
        
        if(data.status == 'success')
        {
            $('#resultAdded').addClass('alert-success');
        }
        else
        {
            $('#resultAdded').addClass('alert-danger');
        }
    
        $('#resultAdded').html(data.result);
    });
    
</script>