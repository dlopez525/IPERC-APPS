<?php

namespace App\Http\View\Composers;

use App\Headquarter;
use Illuminate\View\View;

class HeadquarterComposer
{
    public function compose(View $view)
    {
        $view->with('headquarters', Headquarter::get(['id', 'name']));
    }
}