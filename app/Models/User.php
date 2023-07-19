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

    /**
     * Gerente de la gerencia de Tecnología
     * @return boolean
     */
    public function esGerente()
    {
        $gerentes = DB::connection('rrhh')->table('rrhh.vis_exp_jefesxunidad')
            ->where('idgerencia', 901)
            ->where('idtipocargo', 4)

            // ->pluck('nombre', 'idusuario');
            ->get();

        //  dump($gerentes) ;

        foreach ($gerentes as $gerente) {
            if ($this->uid === $gerente->uid) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Jefes de la gerencia de Tecnología
     * @return boolean
     */
    public function esJefe() 
    {
        $jefes = DB::connection('rrhh')->table('rrhh.vis_exp_jefesxunidad')
            ->where('idgerencia', 901)
            // ->whereIn('idcargo', [45, 417, 432, 433, 434, 435])
            ->where('idtipocargo', 5)
            ->orderBy('idcargo')

            // ->pluck('nombre', 'idusuario');
            ->get();

        //  dump($jefes) ;

        foreach ($jefes as $jefe) {
            if ($this->uid === $jefe->uid) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Analistas de la gerencia de Tecnología
     * @return boolean
     */
    public function esAnalista() 
    {
        $analistas = DB::connection('rrhh')->table('rrhh.vis_exp_datos_empleado')
            ->whereBetween('idunidadestructura', [901,907])
            ->whereNotIn('idcargo', [20, 45, 417, 432, 433, 434, 435])
            ->orderBy('idcargo')
            
            // ->pluck('nombre', 'idusuario');
            ->get();

        //  dump($analistas) ;

        foreach ($analistas as $analista) {
            if ($this->uid === $analista->uid) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Pasantes de la gerencia de Tecnología
     * @return boolean
     */
    public function esPasante() 
    {
        $pasantes = DB::connection('rrhh')->table('rrhh.vis_exp_datos_empleado')
            // ->where('idunidadestructura', 901)
            ->whereBetween('idunidadestructura', [901,907])
            ->where('idcargo', 204)
            ->orderBy('idcargo')

            // ->pluck('nombre', 'idusuario');
            ->get();

        //  dump($pasantes) ;

        foreach ($pasantes as $pasante) {
            if ($this->uid === $pasante->uid) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Administradores de la gerencia de Tecnología
     * @return boolean
     */
    function esAdmin() {
        if ( $this->esGerente() || $this->esJefe() ) {
            return true;
        }
        return false;
    }

    /**
     * Descripción de los usuarios de la gerencia de Tecnología
     */
    function desCargo() {
        if ( $this->esGerente() || $this->esJefe() ) {
            return 'Administrador';
        }

        if ( $this->esAnalista() ) {
            return 'Analista';
        }

        if ( $this->esPasante() ) {
            return 'Pasante';
        }
        
    }

    function perteceTecnologia() {

        if ( $this->esAdmin() || $this->esAnalista() || $this->esPasante()) {
            return true;
        }

        return false;
    }

}
