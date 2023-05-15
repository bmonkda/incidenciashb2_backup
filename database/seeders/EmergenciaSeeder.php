<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmergenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $emergency = Emergencia::create([
            'nombre' => 'BAJA',
            'color' => 'warning',
            'color2' => '#e2a03f',
        ]);

        $emergency = Emergencia::create([
            'nombre' => 'MEDIA',
            'color' => 'secondary',
            'color2' => '#d1d1d1',
        ]);

        $emergency = Emergencia::create([
            'nombre' => 'ALTA',
            'color' => 'danger',
            'color2' => '#e7515a',
        ]);
    }
}
