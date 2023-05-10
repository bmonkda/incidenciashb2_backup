<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'slug'];

    // para url amigable

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Relación uno a muchos

    public function subcategorias(){
        return $this->hasMany(Subcategoria::class);
    }
}
