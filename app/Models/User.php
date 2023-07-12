<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'rrhh';
    protected $table = 'acceso.usuarios';
    protected $primaryKey = 'idusuario';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'name',
        // 'email',
        // 'password',

        'nombre',
        'uid',
        'correo',
        'clave',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'password',
        'clave',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function esGerente()
    {
        $administradores = DB::connection('rrhh')->table('rrhh.vis_exp_jefesxunidad')
            ->where('idgerencia', 901)

            // ->pluck('nombre', 'idusuario');
            ->get();

        //  dump($administradores) ;

        foreach ($administradores as $admin) {
            if ($this->uid === $admin->uid) {
                return true;
            }
        }
        
        return false;
    }

}
