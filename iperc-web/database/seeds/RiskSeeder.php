<?php

use App\Risk;
use Illuminate\Database\Seeder;

class RiskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Risk::create([
            'name'   => 'Riesgo Aceptable',
            'slug'   => 'aceptable',
            'min'    => '0',
            'max'    => '19',
            'color'  => '3498DB',
        ]);
        Risk::create([
            'name' => 'Riesgo Moderado',
            'slug'   => 'moderado',
            'min' => '20',
            'max' => '69',
            'color' => '2ECC71'
        ]);
        Risk::create([
            'name' => 'Riesgo Notable',
            'slug'   => 'notable',
            'min' => '70',
            'max' => '199',
            'color' => 'F1C40F'
        ]);
        Risk::create([
            'name' => 'Riesgo Alto',
            'slug'   => 'alto',
            'min' => '200',
            'max' => '399',
            'color' => '16A085'
        ]);
        Risk::create([
            'name' => 'Riesgo Inminente',
            'slug'   => 'inminente',
            'min' => '400',
            'max' => '',
            'color' => 'E74C3C'
        ]);
    }
}
