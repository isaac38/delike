<?php


namespace App\Controllers;


use App\Helpers\UrlHelper;
use App\Models\Usuario;
use App\Repositories\UsuarioRepository;
use Core\Controller;
use Core\ServicesContainer;

class UsuarioController extends Controller
{
    private $config;

    public function __construct()
    {
        parent::__construct();
        $this->config = ServicesContainer::getConfig();
    }

    public function getindex()
    {
        return $this->render("usuario/index.twig",[
            "title"=>$this->config["company"],
            "datos"=>(new UsuarioRepository())->listar()
        ]);
    }

    public function geteditarusuario($id=0)
    {
        if ($id == 0){
            UrlHelper::redirect("usuario");
        }else{
            return $this->render("usuario/editarusuario.twig", [
                "title"=>$this->config["company"],
                "usuario"=>(new UsuarioRepository())->obtener($id)
            ]);
        }

    }

    public function getnuevousuariobaken ()
    {
        return $this->render("usuario/nuevousuariobaken.twig",
            ["title" => $this->config["company"]]
        );
    }


    public function postnuevousuariobaken ()
    {
        $modelo = new Usuario();

        if (isset($_POST["id"])){
            $modelo->id = $_POST["id"];
        }

        if(isset($_POST["id"]))
        {
            $modelo->id = $_POST["id"];
        }

        if (isset($_POST["nomusuario"])){$modelo->nomusuario = $_POST["nomusuario"];} else{$modelo->nomusuario = "";}
        if (isset($_POST["email"])){$modelo->email = $_POST["email"];} else{$modelo->email = "";}
        if (isset($_POST["user_psw"])){$modelo->user_psw = $_POST["user_psw"];} else{$modelo->user_psw = "";}

        $respuesta = (new UsuarioRepository())->guardar($modelo);

        if ($respuesta){
            \App\Helpers\UrlHelper::redirect('usuario');
        }else{
            echo "nose guardaron los datos";
        }


        // if ($respuesta){
        //codiago a ejecutar cuando se garda la info.
        //}else{//
        //codigo a ejecutar cuando no se gardo la info.
    }



    public function geteliminarusuario($id=0)
    {
        if ($id == 0) {
            UrlHelper::redirect("usuario");
        }else{
            return $this->render("usuario/eliminarusuario.twig",[
                "title"=>$this->config["company"],
                "usuario"=>(new UsuarioRepository())->obtener($id)

            ]);
        }
    }

    public function posteliminarusuario()
    {

        $respuesta = (new UsuarioRepository())->borrar($_POST['id']);

        if($respuesta){
            UrlHelper::redirect("usuario");
        }else{
            echo"no se borro la el usuario ";
        }


    }





}