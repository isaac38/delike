<?php


namespace App\Repositories;



use App\Models\Usuario;
use Core\Log;
use Illuminate\Database\Eloquent\Collection;

class UsuarioRepository
{

    private $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
    }

    public function listar():Collection
    {
        $datos = [];

        try{
            $datos = $this->usuario->get();
        }catch (\Exception $e){
            Log::error(UsuarioRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        return $datos;

    }

    public function guardar($modelo):bool
    {
        $respuesta = false;

        try{
            $this->usuario = $modelo ;

                if (isset($modelo->id)){
                    $this->usuario->exists = true;
                }
                $this->usuario->save();

               $respuesta=true;



        }catch (\Exception $e){
            Log::error(UsuarioRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        return $respuesta;
    }

    public function obtener($id):Usuario
    {
        $usuario = new Usuario();
        try{
            $usuario = $this->usuario->find($id);
        }catch (\Exception $e){
            Log::error(UsuarioRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }
        return $usuario;
    }

    public function borrar($id):bool
    {
        $respuesta = false;

        try{
            $this->usuario = $this->obtener($id);
            $this->usuario->delete();
            $respuesta = true;
        }catch (\Exception $e){
            Log::error(UsuarioRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        return $respuesta;
    }

}