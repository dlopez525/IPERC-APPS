<?php

use App\Risk;
use Illuminate\Database\Seeder;

class ColorRGBASeedr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aceptable = Risk::where('slug', 'aceptable')->first();
        $aceptable->color_rgba = '52, 152, 219';
        $aceptable->save();

        $moderado = Risk::where('slug', 'moderado')->first();
        $moderado->color_rgba = '46, 204, 113';
        $moderado->save();

        $notable = Risk::where('slug', 'notable')->first();
        $notable->color_rgba = '241, 196, 15';
        $notable->save();

        $alto = Risk::where('slug', 'alto')->first();
        $alto->color_rgba = '22, 160, 133';
        $alto->save();

        $inminente = Risk::where('slug', 'inminente')->first();
        $inminente->color_rgba = '231, 76, 60';
        $inminente->save();
    }
}
