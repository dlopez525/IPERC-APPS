<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changeHeadquarter(Request $request)
    {
        session()->forget('headlocal');
        $newLocal = $request->headquarter;
        session()->put('headlocal', $newLocal);

        return redirect()->back();
    }
}
