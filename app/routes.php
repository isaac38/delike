<?php

$router->controller("/home","App\\Controllers\\HomeController");
$router->controller("/postre","App\\Controllers\\PostreController");
$router->controller("/usuario","App\\Controllers\\UsuarioController");

$router->get("/",function(){

    \App\Helpers\UrlHelper::redirect("home");

});

$router->get("/help",function (){
    return "Lus isaac";
});