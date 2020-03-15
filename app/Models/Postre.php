<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postre extends Model
{
    use SoftDeletes;

    protected $table = "postres";

    public function categoria()
    {
        return $this-> belongsTo('App\Models\Categoria');
    }

}