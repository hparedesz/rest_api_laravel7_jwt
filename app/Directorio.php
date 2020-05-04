<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Directorio extends Model
{
    //tabla que se va a utilizar
    protected $table="directorios";
    //campos de la tabla a utilizar
    protected $fillable=[
        "nombre",
        "direccion",
        "telefono",
        "foto"
    ];
    //campos que queremos ocultar
    protected $hidden=[
        "created_at",
        "updated_at"
    ];

}
