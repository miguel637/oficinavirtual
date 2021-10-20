<?php if($_SESSION["idEmpresa_user"] == "HQ5 S.A.S")
{
    ?>
        <a href="https://creator.zohopublic.com/hq5colombia/contratos-n-mina/record-pdf/ContratoHQ5/<?php echo $_SESSION["token_user"];?>/CertificadoLaboral/qORCk2B3ttHUEqaCuRj04fa2eqBmQW1YaG1yeRrvyz7GdPQK3RygtDhsmhC5kvzhET6eaTHDU4BFYgbgVXdb5mwGsu8zeFTTAED0" target='_blank'><button class='btn btn-info'>Descargar Certificado Laboral</button></a>
    <?php
}
else if($_SESSION["idEmpresa_user"] == "TEMPOENLACE S.A.S")
{
    ?>
        <a href="https://creator.zohopublic.com/hq5colombia/contratos-n-mina/record-pdf/ContratoTempoenlace/<?php echo $_SESSION["token_user"];?>/CertificadoLaboral/4k4CaOaqd2PkzdKUYOeCSv5MHs6faPBp9wJ1w68zJxgqTWrdVWDr6Kj1rdAa3vGhKsF9SBYf4x0baC2Wk9NwD44OWXBt6AF5RyS9" target='_blank'><button class='btn btn-info'>Descargar Certificado Laboral</button></a>
    <?php
}
else if($_SESSION["idEmpresa_user"] == "UT COLTEMP-HQ5")
{
    ?>
        <a href="https://creator.zohopublic.com/hq5colombia/contratos-n-mina/record-pdf/ContratoColtemp/<?php echo $_SESSION["token_user"];?>/CertificadoLaboral/QJbhQGEMe7aDbse1CNJX11QenydOmFW9JDnqywdQ21550UsZB7p1zubN9XrRQ6b6AstrvAmtBZv4Xun3OFK6E1WVySKw9Z4dmVGa" target='_blank'><button class='btn btn-info'>Descargar Certificado Laboral</button></a>
    <?php
}
else if($_SESSION["idEmpresa_user"] == "TECNOGESTION FD S.A.S")
{
    ?>
        <a href="https://creator.zohopublic.com/hq5colombia/contratos-n-mina/record-pdf/ContratoTecnogestion/<?php echo $_SESSION["token_user"];?>/CertificadoLaboral/YnMxnssVNCn7eTGY5fBYHEju60D5DaG1Rbu8RS4812R25e2yxRUMbg16uJHwYpeTaTJJ8B1MnFnzz0kM9BvBTyV0mmuSYEQhN6Fv" target='_blank'><button class='btn btn-info'>Descargar Certificado Laboral</button></a>
    <?php
}
?>