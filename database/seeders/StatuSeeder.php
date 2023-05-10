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
            'name' => 'EN ESPERA',
            'color' => 'warning',
            'color2' => 'yellow',
        ]);

        $statu = Statu::create([
            'name' => 'ASIGNADA',
            'color' => 'primary',
            'color2' => 'blue',
        ]);

        $statu = Statu::create([
            'name' => 'CERRADA (RESUELTA)',
            'color' => 'success',
            'color2' => 'green',
        ]);
        
        $statu = Statu::create([
            'name' => 'CERRADA (NO RESUELTA)',
            'color' => 'danger',
            'color2' => 'red',
        ]);

    }
}
