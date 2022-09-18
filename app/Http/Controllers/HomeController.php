<?php

namespace App\Http\Controllers;

use App\Models\Simulation;
use App\Models\SimulationCurrencies;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        $currencyOriginList =  Simulation::select(['origin', DB::raw('count(origin) as total')])
            ->where('user_id', Auth::id())
            ->orderByDesc('total')
            ->groupBy('origin')->get();
        $currencyDestinyList = SimulationCurrencies::select(['currency', DB::raw('count(currency) as total')])
            ->leftJoin('simulations', 'simulations.id', '=', 'simulation_currencies.simulation_id')
            ->where('simulations.user_id', Auth::id())
            ->orderByDesc('total')
            ->groupBy('currency')->get();
        $simulationsTotal   =  Simulation::where('user_id', Auth::id())->count();
        $simulationsValue   =  Simulation::where('user_id', Auth::id())->sum('gross');
        return view('home', compact(
            'simulationsTotal', 'simulationsValue', 'currencyOriginList', 'currencyDestinyList'));
    }

}
