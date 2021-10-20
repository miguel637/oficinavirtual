
<?php 

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://creator.zoho.com/publishapi/v2/hq5colombia/contratos-n-mina/report/Contrato_Report?privatelink=CGe1bAAtdds2k9nEgRWrSv4as5WBOn8PNskV8n2343rOYHJvd9vR05wFKNFOMRRxg1hkdCqV0qF0AWEsEbpgKNgCjDtFFO4n5mZJ&criteria=ID==".$_SESSION["token_user"],
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
    $registro = $manage->data[0];

    if(strpos($registro->Salud->display_value,"MUTUAL") !== false || strpos($registro->Salud->display_value, "NUEVA EPS") !== false || strpos($registro->Salud->display_value, "SERVICIO OCCIDENTAL"))
    {
        ?>
        <div class="row p-0 m-0">
            <img src="<?php echo base_url().'lib/img/aviso_eps.jpg';?>" alt="Aviso de EPS" title="Aviso de EPS" width="580px" class="mx-auto">
        </div>
        <?php
    }
    else
    {
        ?>
            <iframe height='98%' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creatorapp.zohopublic.com/hq5colombia/ecosistema-temporal/form-embed/Registro_de_Incapacidad/raXb07m6qH3gPJ8hj1A122efvYs14EJbnP7OE7q5MmRORDfhdEKBwuAWZ6n983EyG4Nq7y5m0Zp3SnmRMYA3DrK54nKCD65JyDEE?Codigo_Empresa=<?php echo $_SESSION["codigoEmpresa_user"];?>&Doc=<?php echo $_SESSION["user_usuario"];?>&Usuario_OV_creaci_n=<?php echo urlencode($_SESSION["user_usuario"]."_".rand(1,100));?>'></iframe>
        <?php
    }

}


?>