<?php


namespace App\Controllers;


use App\Helpers\UrlHelper;
use App\Models\Postre;
use App\Repositories\CategoriaRepository;
use App\Repositories\PostreRepository;
use Core\Controller;
use Core\ServicesContainer;

class PostreController extends Controller
{
    private $config;

    public function __construct()
    {
        parent::__construct();
        $this->config = ServicesContainer::getConfig();
    }

    public function getindex()
    {
        return $this->render("postre/index.twig",[
            "title"=>$this->config["company"],
            "datos"=>(new PostreRepository())->listar()
        ]);
    }

    public function getnuevoproducto()
    {
        return $this->render("postre/nuevoproducto.twig", [
            "title"=>$this->config["company"],
            "categoria"=>(new CategoriaRepository())->listar()
        ]);
    }

    public function postnuevoproducto()
    {
         $modelo = new Postre();

         if (isset($_POST["id"])){
             $modelo->id = $_POST["id"];
         }

        if(isset($_POST["id"]))
        {
            $modelo->id = $_POST["id"];
        }

         if (isset($_POST["nombre"])){$modelo->nombre = $_POST["nombre"];} else{$modelo->nombre = "";}
         if (isset($_POST["id_tipo"])){$modelo->id_tipo = $_POST["id_tipo"];} else{$modelo->id_tipo = "";}
         if (isset($_POST["venta"])){$modelo->venta = $_POST["venta"];} else{$modelo->venta = "";}
         if (isset($_POST["descripcion"])){$modelo->descripcion = $_POST["descripcion"];} else{$modelo->descripcion = "";}
         if (isset($_POST["cantidad"])){$modelo->cantidad = $_POST["cantidad"];} else{$modelo->cantidad = "";}

         $modelo->imagen = "";


         /* subir imagen */

        $target_path = _BASE_PATH_ . "public/img/postres/";
        $target_path2 = $target_path;
       /*$target_file = $target_path . basename($_FILES["imagenpostre"]["name"]);*/
        $ext = strtolower(substr($_FILES['imagen']['name'], strripos($_FILES['imagen']['name'], '.') + 1));
        $nombreImgen = "c" . date("Ymd") . date("His" . rand()) . "." . $ext;

        $target_path = $target_path . $nombreImgen;
        if (copy($_FILES['imagen']['tmp_name'], $target_path)){
            $modelo->imagen = $nombreImgen;
            $respuesta = (new PostreRepository())->guardar($modelo);



            /* ESTA PARTE ES DEL ERROR ******************************/
            if (isset($_POST["imgactual"]) != '') {
                unlink($target_path2 . $_POST["imgactual"]);
            }else{
                UrlHelper::redirect("postre");
            }
            /*******************************************************/
            var_dump($respuesta);

            if ($respuesta){
                \App\Helpers\UrlHelper::redirect('postre');
            }else{
                echo "error al guardar la imagen en el servidor";
            }
        }else{
            echo "Ha ocurrido un error";
        }
    }

    public function geteditarproducto($id=0)
    {
        if ($id == 0) {
            UrlHelper::redirect("postre");
        }else{
            return $this->render("postre/editarproducto.twig",[
                "title"=>$this->config["company"],
                "postre"=>(new PostreRepository())->obtener($id),
                "categoria"=>(new CategoriaRepository())->listar()
            ]);
        }
    }

    public function geteliminarproducto($id=0)
    {
        if ($id == 0) {
            UrlHelper::redirect("postre");
        }else{
            return $this->render("postre/eliminarproducto.twig",[
                "title"=>$this->config["company"],
                "postre"=>(new PostreRepository())->obtener($id),
                "categoria"=>(new CategoriaRepository())->listar()
            ]);
        }
    }

    public function posteliminarproducto()
    {

        $respuesta = (new PostreRepository())->borrar($_POST['id']);
        if($respuesta){
            UrlHelper::redirect("postre");
        }else{
            echo"no se borro la el producto ";
        }


    }
}