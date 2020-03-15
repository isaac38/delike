<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categoria";

    public function postres()
    {
        return $this-> hasMany('App\Models\Postre');
    }

}