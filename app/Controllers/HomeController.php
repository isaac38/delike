<?php

namespace App\Controllers;

use App\Models\Usuario;
use App\Repositories\PostreRepository;
use App\Repositories\UsuarioRepository;
use Core\Controller;
use Core\ServicesContainer;

class HomeController extends Controller
{
    private $config;

    public function __construct()
    {
        parent::__construct();
        $this->config = ServicesContainer::getConfig();
    }

    public function getIndex()
    {
        return $this->render("home/index.twig",
            [
                "title" => $this->config["company"],
                "datos" => (new PostreRepository())->listarUltimos(5)
            ]);
    }

    public function getempresa()
    {
        return $this->render("home/empresa.twig",
            ["title" => $this->config ["company"]]
        );
    }

    public function getcontactos()
    {
        return $this->render("home/contactos.twig",
            ["title" => $this->config["company"]]
        );
    }

    public function getproductos()
    {
        return $this->render("home/productos.twig",
            ["title" => $this->config["company"],
             "datos" => (new PostreRepository())->listar()

            ]);
    }

    public function postproductos()
    {
        return $this->render("home/productos.twig",
            ["title" => $this->config["company"],
                "datos" => (new PostreRepository())->buscar($_POST["buscarProducto"])

            ]);
    }

    public function getlogin()
    {
        return $this->render("home/login.twig", [
            "title" => $this->config["company"],

        ]);
    }

    public function getnuevousuario()
    {
        return $this->render("home/nuevousuario.twig",
            ["title" => $this->config["company"]]
        );
    }

    public function postnuevousuario()
    {
        $modelo = new Usuario();

        if (isset($_POST["nomusuario"])) {$modelo->nomusuario = $_POST["nomusuario"];} else {$modelo->nomusuario = "";}
        if (isset($_POST["email"])) {$modelo->email = $_POST["email"];} else {$modelo->email = "";}
        if (isset($_POST["user_psw"])) {$modelo->user_psw = $_POST["user_psw"];} else {$modelo->user_psw = "";}

        $respuesta = (new UsuarioRepository())->guardar($modelo);

        var_dump($respuesta);


        if ($respuesta) {
            \App\Helpers\UrlHelper::redirect('home');
        }
        //codigo a ejecutar cuando no se gardo la info.
        //}//




        /* terminar las funciones asindo referencia al archivo twig que ba a llamar */
    }
}