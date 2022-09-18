<?php

namespace App\Http\Controllers;

use App\Mail\SimulationSendMail;
use App\Models\Charge;
use App\Models\PaymentMethod;
use App\Models\Simulation;
use App\Models\SimulationCurrencies;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Throwable;
use Yajra\DataTables\DataTables;

class SimulationController extends Controller
{
    private string $titlePage = 'Simulador';
    private string $routePage = 'simulation.index';
    private array $table = [];

    function __construct()
    {

        $this->table['columns'] = [
            [
                'label' => '#',
                'name' => 'id'
            ],
            [
                'label' => 'Valores',
                'name' => 'gross'
            ],
            [
                'label' => 'Forma de pagamento',
                'name' => 'payment_method_id'
            ],
            [
                'label' => 'Taxa de conversão',
                'name' => 'conversion_rate'
            ],
            [
                'label' => 'Taxa de pagamento',
                'name' => 'payment_rate'
            ],
            [
                'label' => 'Data',
                'name' => 'created_at'
            ],
            [
                'label' => 'Ações',
                'name' => 'action'
            ],
        ];
        $this->table['list'] = 'simulation.list';
        $this->table['show'] = 'simulation.show';
    }

    /**
     * @return Factory|View|Application
     */
    public function index(): Factory|View|Application
    {
        return view("simulation.index", [
            'table' => $this->table,
            'titlePage' => $this->titlePage,
            'routePage' => $this->routePage,
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
            $data = Simulation::select(['*']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('gross', function($row){
                   return formatCurrency($row->gross, $row->origin);
                })
                ->addColumn('payment_method_id', function($row){
                    $paymentMethod = PaymentMethod::find($row->payment_method_id);
                   return $paymentMethod->description;
                })
                ->addColumn('conversion_rate', function($row){
                    return formatCurrency($row->conversion_rate, $row->origin);
                })
                ->addColumn('payment_rate', function($row){
                    return formatCurrency($row->payment_rate, $row->origin);
                })
                ->addColumn('created_at', function($row){
                    return '<p class="text-nowrap">'. formatDate($row->created_at, 'd/m/Y H:i').'</p>';
                })
                ->addColumn('action', function($row){
                    return '<a href="javascript:void(0)" onclick="detail(' . $row->id . ')" class="delete btn btn-info btn-sm">
                                <span class=" text-white"><i class="fa-solid fa-book-open"></i> Detalhes</span></a>';
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        }
        return response()->json([]);
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory|View|Application
    {
        return view('simulation.create', [
            'titlePage' => $this->titlePage,
            'routePage' => $this->routePage,
            'actionPage' => 'Novo',
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'payment_method_id' => 'required',
            'origin'            => 'required',
            'gross'             => 'required',
        ], [
            'payment_method_id.required' => 'Escolha uma forma de pagamento',
            'origin.required'            => 'A Moeda de origem é obrigatória',
            'gross.required'             => 'O Valor (R$) é obrigatório',
        ]);


        try {

            if (removeMaskMoney($request->get('gross')) < 1000) {
                throw new Exception( 'Valor mínimo: R$ 1.000,00', 400);
            }
            if (removeMaskMoney($request->get('gross')) > 100000) {
                throw new Exception('Valor maxímo: R$ 100.000,00', 400);
            }

            $paymentMethod = PaymentMethod::findOrFail($request->get('payment_method_id'));
            $charge = Charge::where('min', '<=', $request->get('gross'))
                ->where('max', '>=', $request->get('gross'))
                ->first();

            $simulation = Simulation::create([
                'user_id' => Auth::id(),
                'payment_method_id' => $paymentMethod->id,
                'origin' => $request->get('origin'),
                'gross' => removeMaskMoney($request->get('gross')),
                'conversion_rate' => ((removeMaskMoney($request->get('gross')) / 100) * $charge->value),
                'payment_rate' => ((removeMaskMoney($request->get('gross')) / 100) * $paymentMethod->rate),
            ]);

            $this->createSimulationCurrencies($request, $simulation);

            return $this->receipt($simulation);
        } catch (Throwable $th) {
            return response()->json('errors', [$th->getCode(), $th->getMessage()], $th->getCode());
        }
    }

    /**
     * @param Simulation $simulation
     * @return JsonResponse
     */
    public function show(Simulation $simulation): JsonResponse
    {
        return $this->receipt($simulation);
    }

    /**
     * @param Simulation $simulation
     * @return JsonResponse
     */
    public function sendMail(Simulation $simulation): JsonResponse
    {
       try{
           $data = $this->receipt($simulation);
           Mail::send(new SimulationSendMail($data));
           return response()->json(['Email enviado']);
       }catch (Throwable $th){
           return response()->json(['falha ao enviar', $th->getMessage()], 500);
       }
    }


    /**
     * @param Simulation $simulation
     * @return JsonResponse
     */
    private function receipt(Simulation $simulation): JsonResponse
    {
        $data = SimulationCurrencies::where('simulation_id',$simulation->id)
            ->with('simulation.paymentMethod')
            ->get()
            ->toArray();
      return response()->json($data);
    }
    /**
     * @param Request $request
     * @param Simulation $simulation
     */
    private function createSimulationCurrencies(Request $request, Simulation $simulation){
        $quotation = $this->quotation($request);
        if(is_array($quotation)){
            foreach ($quotation as $item => $value){
                SimulationCurrencies::create([
                    'simulation_id' => $simulation->id,
                    'currency'      => $value['codein'],
                    'quotation'     => $value['bid'],
                ]);
            }
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    private function quotation(Request $request): array
    {
        $combination = '';
        if(is_array($request->get('destiny'))){
            foreach ($request->get('destiny') as $item){
                $combination .= $request->get('origin').'-'.$item;
                $combination .=',';
            }
            $combination = substr($combination,0,-1);
        }else{
            $combination = $request->get('origin').'-'.$request->get('destiny');
        }
        $result = Http::get('https://economia.awesomeapi.com.br/json/last/'.$combination);
        return $result->json();
    }
}
