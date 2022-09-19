<?php

namespace App\Http\Controllers;

use App\Models\Charge;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;
use Yajra\DataTables\DataTables;

class ChargeController extends Controller
{
    private string $titlePage = 'Taxas';
    private string $routePage = 'charge.index';
    private array  $table     = [];

    function __construct()
    {
        $this->table['columns'] = [
            [
                'label' => '#',
                'name'  => 'id'
            ],
            [
                'label' => 'Valor (%)',
                'name'  => 'value'
            ],
            [
                'label' => 'Minímo',
                'name'  => 'min'
            ],
            [
                'label' => 'Maxímo',
                'name'  => 'max'
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
        $this->table['list']   = 'charge.list';
        $this->table['delete'] = 'charge.destroy';
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view("charge.index", [
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
            $data =  Charge::select(['*']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('min', function($row){
                    return ($row->min);
                })
                ->addColumn('max', function($row){
                    return ($row->max);
                })
                ->addColumn('status', function($row){
                    return ($row->status) ? 'Ativo' : 'Inativo';
                })->addColumn('action', function($row){
                   return '<a href="'.route("charge.edit", [$row->id]).'" class="edit btn btn-warning btn-sm"><span class=" text-white"><i class="nav-icon fa-solid fa-pen-to-square"></i>Editar</span></a>
                               <a href="javascript:void(0)" onclick="destroy(' . $row->id . ')" class="delete btn btn-danger btn-sm"><span class=" text-white"><i class="nav-icon fa-solid fa-ban"></i>  Remover</span></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return response()->json([]);
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('charge.create', [
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
            'value' => 'required'
        ]);

        try {

            Charge::create([
                'value'  => $request->get('value'),
                'min'    => $request->get('min'),
                'max'    => $request->get('max'),
                'status' => $request->get('status', true),
            ]);

            return redirect()->route('charge.index')->with('success', 'Operaçao realizada com sucesso');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * @param Charge $charge
     * @return Application|Factory|View
     */
    public function edit(Charge $charge): Factory|View|Application
    {
        return view('charge.edit', [
            'charge'     => $charge,
            'titlePage'  => $this->titlePage,
            'routePage'  => $this->routePage,
            'actionPage' => 'Novo',
        ]);
    }

    /**
     * @param Request $request
     * @param Charge $charge
     * @return RedirectResponse
     */
    public function update(Request $request, Charge $charge): RedirectResponse
    {
        $request->validate([
            'value' => 'required'
        ]);

        try {

            $charge->value  = $request->get('value');
            $charge->max    = $request->get('max');
            $charge->min    = $request->get('min');
            $charge->status = $request->get('status');
            $charge->save();

            return redirect()->route('charge.index')->with('success', 'Operaçao realizada com sucesso');
        } catch (Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * @param Charge $charge
     * @return JsonResponse
     */
    public function destroy(Charge $charge): JsonResponse
    {
        try {
            $charge->delete();
            return response()->json([]);
        } catch (Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
