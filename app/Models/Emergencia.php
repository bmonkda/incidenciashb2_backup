<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'color',  'color2', 'status'];
}
