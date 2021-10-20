<nav class="navbar navbar-dark bg-light mb-5">
  <a href="#"><img src="<?php echo base_url().'lib/img/hq5.png';?>" width='100px' alt=""></a>
  <div class="text-center w-100"><h1 class='text-danger'><i class="fas fa-universal-access"></i> 
  <?php if(!isset($control)) echo "Control de Acceso - ";?><?php echo $type;?></h1></div>  
</nav>
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
    <iframe height="600px" class='w-100 mx-auto d-block' frameborder='0' allowTransparency='true' scrolling='auto' src='https://creator.zohopublic.com/hq5colombia/servicios-hq5/form-embed/control/4dgmVP9PFdwjvPX31hn9MAtU2xFVEqMFJCUhNSuuKbQvVnDOnATSdagdvweRQebFPhRJnBO0ERsqx3OeMGj2vzNT4PjrtOXCtHpa?Target=hq5page&Latitud=`+position.coords.latitude+`&Longitud=`+position.coords.longitude+`'></iframe>
    `;
}

getLocation();
</script>