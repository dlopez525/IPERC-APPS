<?php

namespace App\Http\Controllers;

use App\Area;
use App\Audit;
use Carbon\Carbon;
use App\Headquarter;
use App\JobPosition;
use Carbon\CarbonPeriod;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public $headquarter;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->headquarter = session()->has('headlocal') == true ? session()->get('headlocal') : auth()->user()->headquarter_id;
            return $next($request);
        });
    }

    public function index()
    {
        $headquarters = Headquarter::all();

        return view('reports.index', compact('headquarters'));
    }

    public function getIndexChart()
    {
        $hoy = Carbon::now()->format('Y-m-d');
        $desde = Carbon::now()->subDay(5)->format('Y-m-d'); /// NUMERO DE  dias - 1

        $period = CarbonPeriod::create($desde, '1 days', $hoy);
        $dates = array();
        $dates2 = array();

        foreach ($period as $key => $date) {
            $dates[] = $date->format('d-m');
            $dates2[] = $date->format('Y-m-d');
        }

        $series = array();

        if (auth()->user()->isSuperAdmin()) {
            $data = Headquarter::get(['id', 'name']);
            $cont = 0;
            foreach ($data as $d) {
                $series[$cont] = ['name' => $d->name];
                for ($i=0; $i < count($dates2); $i++) {
                    $s = Audit::where('date', $dates2[$i])->where('headquarter_id', $d->id)->count();
                    $series[$cont]['data'][$i] = $s;
                }
                $cont++;
            }
        } else {
            $jobs = JobPosition::where('headquarter_id', $this->headquarter)->pluck('name');
            $data = Area::join('job_positions','areas.job_position_id', '=', 'job_positions.id')
                    ->where('job_positions.headquarter_id', $this->headquarter)
                    ->whereIn('job_positions.name', $jobs)->select('areas.name')->distinct()->get();
            $cont = 0;
            foreach ($data as $d) {
                $series[$cont] = ['name' => $d->name];
                for ($i=0; $i < count($dates2); $i++) {
                    // $s = Audit::where('date', $dates2[$i])->where('area_id', $d->id)->count();
                    $s = Audit::where('date', $dates2[$i])->where('area', $d->name)->count();
                    $series[$cont]['data'][$i] = $s;
                }
                $cont++;
            }
        }

        return response()->json(array('dates' => $dates, 'series' => $series, 'status' => true));
    }

    public function getReportsChart(Request $request)
    {
        $desde = Carbon::createFromFormat('d/m/Y', Str::before($request->dates, ' -'))->format('Y-m-d');
        $hasta = Carbon::createFromFormat('d/m/Y', Str::after($request->dates, '- '))->format('Y-m-d');

        $period = CarbonPeriod::create($desde, '1 days', $hasta);
        $dates = array();
        $dates2 = array();

        foreach ($period as $key => $date) {
            $dates[] = $date->format('d-m');
            $dates2[] = $date->format('Y-m-d');
        }

        $series = array();

        if (auth()->user()->isSuperAdmin()) {
            $jobs = JobPosition::where('headquarter_id', $request->headquarter)->pluck('name');
            $data = Area::join('job_positions','areas.job_position_id', '=', 'job_positions.id')
                    ->where('job_positions.headquarter_id', $request->headquarter)
                    ->whereIn('job_positions.name', $jobs)->select('areas.name')->distinct()->get();
                // ->whereIn('job_positions.name', $jobs)->select('areas.name','areas.id')->distinct()->get();
            $cont = 0;
            foreach ($data as $d) {
                $series[$cont] = ['name' => $d->name];
                for ($i=0; $i < count($dates2); $i++) {
                    // $s = Audit::where('date', $dates2[$i])->where('area_id', $d->id)->count();
                    $s = Audit::where('date', $dates2[$i])->where('area', $d->name)->count();
                    $series[$cont]['data'][$i] = $s;
                }
                $cont++;
            }
        } else {
            $jobs = JobPosition::where('headquarter_id', $this->headquarter)->pluck('name');
            $data = Area::join('job_positions','areas.job_position_id', '=', 'job_positions.id')
                    ->where('job_positions.headquarter_id', $this->headquarter)
                    ->whereIn('job_positions.name', $jobs)->select('areas.name')->distinct()->get();
            $cont = 0;
            foreach ($data as $d) {
                $series[$cont] = ['name' => $d->name];
                for ($i=0; $i < count($dates2); $i++) {
                    // $s = Audit::where('date', $dates2[$i])->where('area_id', $d->id)->count();
                    $s = Audit::where('date', $dates2[$i])->where('area', $d->name)->count();
                    $series[$cont]['data'][$i] = $s;
                }
                $cont++;
            }
        }

        return response()->json(array('dates' => $dates, 'series' => $series, 'status' => true));
    }
}
