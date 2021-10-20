<?php

define("URL_APP", __DIR__);
$iplocal = $_SERVER["SERVER_NAME"];
define("LINK_URL", "http://$iplocal/oficinavirtual/");
define("REPLACE_URL", '/oficinavirtual/');
require('configuration/config.php');
require('configuration/database.php');
require('configuration/coreApp.php');
require('configuration/route.php');
require('configuration/configRoute.php');

?>