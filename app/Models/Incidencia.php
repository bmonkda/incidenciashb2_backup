<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Incidencia extends Model
{
    use HasFactory;



    public function estatus(): HasOne
    {
        return $this->hasOne(Statu::class, 'id', 'statu_id');
    }
}
