<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Incidencia extends Model
{
    use HasFactory;

    protected $attributes = [
        'asignado_id' => null,
        'asigna_id' => null,
        'statu_id' => 2,
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // public function estatus(): HasOne
    // {
    //     return $this->hasOne(Statu::class, 'id', 'statu_id');
    // }

    /**
     * Relaciones uno a muchos inversa
     */

    public function statu(){
        return $this->belongsTo(Statu::class);
    }

    public function emergencia(){
        return $this->belongsTo(Emergencia::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    
    public function subcategoria(){
        return $this->belongsTo(Subcategoria::class);
    }

    public function asignado() //usuario que asigna la incidencia
    {
        return $this->belongsTo(User::class, 'asignado_id', 'idusuario');
        // return $this->belongsTo(Usuario::class);
    }


}
