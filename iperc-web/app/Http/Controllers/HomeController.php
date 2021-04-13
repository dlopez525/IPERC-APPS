<?php

namespace App\Http\Controllers;

use App\Audit;
use Carbon\Carbon;
use App\Headquarter;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $headquarter;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->headquarter = session()->has('headlocal') == true ? session()->get('headlocal') : auth()->user()->headquarter_id;
            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->isSuperAdmin()) {
            $requests = Audit::where('date', date('Y-m-d'))->get(['id'])->count();

        } else {
            $requests = Audit::where('headquarter_id', $this->headquarter)->where('date', date('Y-m-d'))->get(['id'])->count();
        }

        $headquarters = Headquarter::with('files:id,headquarter_id')->get(['id','name']);

        return view('home', compact('requests','headquarters'));
    }
}
