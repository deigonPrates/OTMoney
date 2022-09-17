<?php

namespace App\Http\Controllers;

use App\Models\CurrencyCombination;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyCombinationController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function origin(Request $request): JsonResponse
    {
        $currencyCombination = CurrencyCombination::select([DB::raw('coin_origin as coin'), DB::raw('concat(coin_origin, "-", name_origin)  as name')])
            ->where('coin_origin', 'like', '%'.$request->get('name').'%')
            ->where('name_origin', 'like', '%'.$request->get('name').'%')
            ->orderBy('name_origin')
            ->groupBy('coin_origin', 'name_origin')
            ->limit(10)
            ->get();
        return response()->json($currencyCombination);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destiny(Request $request): JsonResponse
    {


        $currencyCombination = CurrencyCombination::select([DB::raw('coin_destiny as coin'),DB::raw('concat(coin_destiny, "-", name_destiny)  as name')])
            ->where('coin_origin', '=', $request->get('origin', 'BRL'))
            ->where('coin_destiny', 'like', '%'.$request->get('name').'%')
            ->where('coin_destiny', '<>', 'BRL')
            ->where('name_destiny', 'like', '%'.$request->get('name').'%')
            ->orderBy('name_destiny')
            ->groupBy('coin_destiny', 'name_destiny')
            ->limit(10)
            ->get();

        return response()->json($currencyCombination);
    }

}
