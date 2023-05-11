<?php

namespace Database\Seeders;

use App\Models\Statu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $statu = Statu::create([
            'nombre' => 'EN ESPERA',
            'color' => 'warning',
            'color2' => 'yellow',
        ]);

        $statu = Statu::create([
            'nombre' => 'ASIGNADA',
            'color' => 'primary',
            'color2' => 'blue',
        ]);

        $statu = Statu::create([
            'nombre' => 'CERRADA (RESUELTA)',
            'color' => 'success',
            'color2' => 'green',
        ]);
        
        $statu = Statu::create([
            'nombre' => 'CERRADA (NO RESUELTA)',
            'color' => 'danger',
            'color2' => 'red',
        ]);

    }
}
