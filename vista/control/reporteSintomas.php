<div id="insane_staff">
</div>
<div style='font-size:11px;padding:20px;text-align:justify'><b>Nota: </b> Declaro que la información presentada en este formulario es veraz y manifiesto de forma libre, previa, expresa e informada mediante el diligenciamiento del presente formato, y de los datos proporcionados que autorizo a HQ5, identificada con NIT 901.023.218-6 con domicilio en la Calle 52a No 18 73, barrio Galerías, Bogotá, Colombia, quien actúa como Responsable del tratamiento de datos personales, según la normatividad vigente en esta materia, para que recolecte, almacene, procese, use, circule, gestione y en general aplique tratamiento a mis datos personales, de acuerdo con las finalidades aquí descritas o en la POLÍTICA DE TRATAMIENTO DE DATOS PERSONALES de HQ5", disponible en la página web www.hq5.com.co. 

También declaro que soy consciente de que esta información se recoge con fines estrictamente de interés público ante la situación decretada por las Autoridades Públicas, para proteger y salvaguardar un interés esencial para la vida de las personas, en consecuencia, autorizo a la ARL, EPS y a la empresa, para el manejo de la información aportada en esta encuesta para desarrollar acciones de promoción y prevención frente al contagio por COVID-19 acorde con lo normado por el Ministerio de Salud y las demás autoridades competentes.
</div>
<script>
var x = document.getElementById("insane_staff");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "<div class='alert alert-danger'>Es necesario habilitar la Ubicación en el Navegador<br/>Usar Navegador Chrome, Mozilla, Edge o Safari</div>";
  }
}

function showPosition(position) {
    x.innerHTML = `
    <iframe height='500px' width='100%' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creatorapp.zohopublic.com/hq5colombia/sst/form-embed/Reporte_S_ntomas_Covid19/SCtsDu5MZ05HwwMhAbsB74uAJUJkQxuY2mjhQEsx6YZBSs4VSjrEHnFuNM8H4avsE306xMYGHdX0THkeFAYEwhKXS49465TYCzEj?Empresa_Usuaria=<?php echo $empresa;?>'></iframe>
    `;
}

getLocation();
</script>