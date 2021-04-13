<?php

use App\Danger;
use Illuminate\Database\Seeder;

class DangersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Danger::create([
            'name' => '1. FISICOS (SO)',
            'img' => '/img/dangers/fisico.png'
        ]);
        Danger::create([
            'name' => '2. QUIMICOS (SO)',
            'img' => '/img/dangers/quimicos.png'
        ]);
        Danger::create([
            'name' => '3. BIOLOGICOS (SO)',
            'img' => '/img/dangers/biologicos.png'
        ]);
        Danger::create([
            'name' => '4. ELECTRICOS (S)',
            'img' => '/img/dangers/electricos.png'
        ]);
        Danger::create([
            'name' => '5. FISICOQUIMICOS (S)',
            'img' => '/img/dangers/fisicosquimicos.png'
        ]);
        Danger::create([
            'name' => '6. PSICOSOCIALES (SO)',
            'img' => '/img/dangers/psicosociales.png'
        ]);
        Danger::create([
            'name' => '7. LOCATIVOS (S)',
            'img' => '/img/dangers/locativos.png'
        ]);
        Danger::create([
            'name' => '8. ERGONOMICOS (SO)',
            'img' => '/img/dangers/ergonomicos.png'
        ]);
        Danger::create([
            'name' => '9. MECANICOS (S)',
            'img' => '/img/dangers/mecanicos.png'
        ]);
        Danger::create([
            'name' => '10. OTROS (S)',
            'img' => '/img/dangers/otros.png'
        ]);
    }
}
