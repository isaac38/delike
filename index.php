<?php

function exception_error_handler($severity, $message, $file, $line){
    if(!(error_reporting() & $severity)){
        return;
    }

    throw new ErrorException($message,0,$severity,$file,$line);
}

set_error_handler("exception_error_handler");

/* Composer & PSR-4 */
require_once "vendor/autoload.php";

/* Inicializar contexto BD */

\Core\ServicesContainer::setConfig(
    require_once "config.php"
);
\Core\ServicesContainer::InitializeDBContext();

$config = \Core\ServicesContainer::getConfig();

/*Zona horaria*/
date_default_timezone_get($config["timezone"]);

/* Manejo de memoria */

ini_set("memory_limit",-1);


/* Manejo de URL amigables */
$base_url="";
$base_folder=strtolower(
    str_replace(basename($_SERVER["SCRIPT_NAME"]),"",$_SERVER["SCRIPT_NAME"])
);

if(isset($_SERVER["HTTP_HOST"])){
    $base_url = (isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) !== "off") ? "https" : "http";

    $base_url .="://".$_SERVER["HTTP_HOST"];
    $base_url .=$base_folder;
}

/* Definicion de constantes */

define("_BASE_HTTP_", $base_url);
define("_BASE_PATH_",__DIR__."/");
define("_LOG_PATH_",__DIR__."/log/");
define("_CACHE_PATH_",__DIR__."/cache/");
define("_APP_PATH_",__DIR__."/app/");
define("_CURRENT_URI_", str_replace($base_folder,"",$_SERVER["REQUEST_URI"]));

/* Verificar entorno de trabajo */
if($config["environment"]==="stop"){
    exit("Servidor Suspendido");
}

if($config["environment"]==="prod"){
    error_reporting(0);
}


/* Configuración de manejo de rutas */
$router = new Phroute\Phroute\RouteCollector();

require_once "app/routes.php";

/* Crear despachador */

$dispacher = new Phroute\Phroute\Dispatcher(
    $router->getData()
);

$response=$dispacher->dispatch($_SERVER["REQUEST_METHOD"],_CURRENT_URI_);

echo $response;