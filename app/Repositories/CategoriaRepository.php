<?php


namespace App\Repositories;


use App\Models\Categoria;
use Core\Log;
use Illuminate\Database\Eloquent\Collection;

class CategoriaRepository
{
    public function __construct()
    {
        $this->categoria = new Categoria();
    }

    public function listar(): Collection
    {
        $datos = [];

        try {
            $datos = $this->categoria->get();
        } catch (\Exception $e) {
            Log::error(PostreRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        return $datos;
    }


    public function obtener($id):Categoria
    {

    }

    public function buscar($query):Collection
    {

    }

    public function guardad($modelo):bool
    {
        $respuesta = false;

        try{
            $this->categoria = $modelo;


            if (isset($modelo->id)){
                $this->categoria->save();
            }

            $respuesta = true;

        }catch (\Exception $e){
            Log::error(CategoriaRepository::class, $e->getMessage() . " Linea: " . $e->getLine());
        }

        return $respuesta;

    }

}