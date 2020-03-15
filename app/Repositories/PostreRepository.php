<?php


namespace App\Repositories;


use App\Models\Postre;
use Core\Log;
use Illuminate\Database\Eloquent\Collection;


class PostreRepository
{
    private $postre;

    public function __construct()
    {
        $this->postre = new Postre();
    }

    public function listar():Collection
    {
        $datos = [];

        try{
            $datos = $this->postre->get();
        }catch (\Exception $e){
            Log::error(PostreRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        return $datos;
    }

    public function listarUltimos($cant):Collection
    {
        $datos = [];

        try{
            $datos = $this->postre->orderBy('id','desc')->take($cant)->get();
        }catch (\Exception $e){
            Log::error(PostreRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        return $datos;
    }

    public function obtener($id):Postre
    {
        $postre = new Postre();
        try{
            $postre = $this->postre->find($id);
        }catch (\Exception $e){
            Log::error(PostreRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }
        return $postre;
    }

    public function buscar($query):Collection
    {
        $datos = [];

        try{
            $datos = $this->postre->where('nombre', 'like', '%'.$query."%")->get();
        }catch (\Exception $e){
            Log::error(PostreRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        return $datos;

    }

    public function guardar($modelo):bool
    {

        $respuesta = false;

        try{
            $this->postre = $modelo;

            if (isset($modelo->id))
            {
                $this->postre->exists = true;
            }
            $this->postre->save();
            $respuesta = true;
        }catch (\Exception $e){
            Log::error(PostreRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        var_dump($respuesta);

        return $respuesta;



    }

    public function borrar($id):bool
    {
        $respuesta = false;

        try{
            $this->postre = $this->obtener($id);
            $this->postre->delete();
            $respuesta = true;
        }catch (\Exception $e){
            Log::error(PostreRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        return $respuesta;
    }

}