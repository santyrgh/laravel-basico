<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // use HasFactory;
    // protected $filable = ['nombre', 'descripcion', 'imagen','_token'];
    protected $fillable = [
        'nombre', 'descripcion', 'imagen'
        // otras columnas que puedan ser llenadas masivamente
    ];
}
