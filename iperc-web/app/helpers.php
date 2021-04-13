<?php

use App\Headquarter;

    function currentHeadquater(){
        if (session()->has('headlocal')) {
            $id = session()->get('headlocal');
        } else {
            $id = auth()->user()->headquarter_id;
        }
        $headquarter = Headquarter::select('name')->find($id);

        if ($headquarter != null) {
            return $headquarter->name;
        }

        return '';
    }