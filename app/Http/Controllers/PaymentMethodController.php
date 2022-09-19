<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use App\Models\Simulation;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;
use Yajra\DataTables\DataTables;

class PaymentMethodController extends Controller
{
    private string $titlePage = 'Formas de Pagamento';
    private string $routePage = 'payment-method.index';
    private array  $table     = [];

    function __construct()
    {
        $this->table['columns'] = [
            [
                'label' => '#',
                'name'  => 'id'
            ],
            [
                'label' => 'Descrição',
                'name'  => 'description'
            ],
            [
                'label' => 'Taxa(%)',
                'name'  => 'rate'
            ],
            [
                'label' => 'Status',
                'name'  => 'status'
            ],
            [
                'label' => 'Ação',
                'name' => 'action'
            ],
        ];
        $this->table['list']   = 'payment-method.list';
        $this->table['delete'] = 'payment-method.destroy';
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view("payment-method.index", [
            'table'      => $this->table,
            'titlePage'  => $this->titlePage,
            'routePage'  => $this->routePage,
            'actionPage' => 'Listar',
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function list(Request $request): JsonResponse
    {
        if ($request->ajax()) {
            $data =  PaymentMethod::select(['*']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    return ($row->status) ? 'Ativo' : 'Inativo';
                })->addColumn('action', function($row){
                    return '<a href="'.route("payment-method.edit", [$row->id]).'" class="edit btn btn-warning btn-sm"><span class=" text-white"><i class="nav-icon fa-solid fa-pen-to-square"></i>Editar</span></a>
                               <a href="javascript:void(0)" onclick="destroy(' . $row->id . ')" class="delete btn btn-danger btn-sm"><span class=" text-white"><i class="nav-icon fa-solid fa-ban"></i>  Remover</span></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return response()->json([]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        $payments = PaymentMethod::select(['id', DB::raw('description as name')])
            ->where('description', 'like', '%'.$request->get('name').'%')
            ->where('status','=', PaymentMethod::STATUS_ATIVO)
            ->orderBy('description')
            ->limit(10)
            ->get();

        return response()->json($payments);
    }
    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('payment-method.create', [
            'titlePage'  => $this->titlePage,
            'routePage'  => $this->routePage,
            'actionPage' => 'Novo',
        ]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'description' => 'required',
            'rate'        => 'required'
        ]);

        try {

            PaymentMethod::create([
                'description' => $request->get('description'),
                'rate'        => $request->get('rate'),
                'status'      => $request->get('status', true),
            ]);

            return redirect()->route('payment-method.index')->with('success', 'Operaçao realizada com sucesso');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return Application|Factory|View
     */
    public function edit(PaymentMethod $paymentMethod): Factory|View|Application
    {
        return view('payment-method.edit', [
            'paymentMethod' => $paymentMethod,
            'titlePage'     => $this->titlePage,
            'routePage'     => $this->routePage,
            'actionPage'    => 'Novo',
        ]);
    }

    /**
     * @param Request $request
     * @param PaymentMethod $paymentMethod
     * @return RedirectResponse
     */
    public function update(Request $request, PaymentMethod $paymentMethod): RedirectResponse
    {
        $request->validate([
            'description' => 'required',
            'rate'        => 'required'
        ]);

        try {

            $paymentMethod->description = $request->get('description');
            $paymentMethod->rate        = $request->get('rate');
            $paymentMethod->status      = $request->get('status', true);
            $paymentMethod->save();

            return redirect()->route('payment-method.index')->with('success', 'Operaçao realizada com sucesso');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return JsonResponse
     */
    public function destroy(PaymentMethod $paymentMethod): JsonResponse
    {
        try {
            if(count(Simulation::where('payment_method_id', '=', $paymentMethod->id)->get()) > 0){
                throw new Exception('Existem items associados');
            }
            $paymentMethod->delete();
            return response()->json([]);
        } catch (Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
