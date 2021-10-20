<?php

$curl = curl_init();

 

curl_setopt_array($curl, array(

  CURLOPT_URL => 'https://webservice.woztell.com/webhook/messages',

  CURLOPT_RETURNTRANSFER => true,

  CURLOPT_ENCODING => '',

  CURLOPT_MAXREDIRS => 10,

  CURLOPT_TIMEOUT => 0,

  CURLOPT_FOLLOWLOCATION => true,

  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,

  CURLOPT_CUSTOMREQUEST => 'POST',

  CURLOPT_POSTFIELDS => 

 array(

  'WOZTELL_ADMIN' => 'susana@hq5.co',

  'WOZTELL_TOKEN' => 'PI3Jr-ATI0NO-FGRnSyzZ-KI1x-AC',

  'DATA' => '{

    "TO":"00573208463317",

    "MESSAGE":"Hello world!",

    "USER":"John Woztell"

    }'

  ),

));

 

$response = curl_exec($curl);

 

curl_close($curl); echo $response;
?>