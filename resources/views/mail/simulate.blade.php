<div>
    <h1>Resultado da simulação realizada em {{ Date('d/m/Y H:i', strtotime($simulatins->original[0]['created_at'])) }}</h1>
    <div style="padding-top: 50px; display: grid;grid-template-columns: 1fr 1fr; gap: 10px">
        @foreach($simulatins->original as $item)
            <div style="border: 1px solid black;">
                <div>
                    <div  style="background-color: #bababa; padding: 10px">
                        <h3 class="card-title">{{$item['simulation']['origin'].'-'.$item['currency']}}</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group  list-group-flush">
                            <li class="list-group-item"><strong>Moeda de origem:</strong> {{$item['simulation']['origin']}}</li>
                            <li class="list-group-item"><strong>Moeda de destino:</strong> {{$item['currency']}}</li>
                            <li class="list-group-item"><strong>Valor para conversão:</strong> {{ formatCurrency($item['simulation']['gross'], $item['simulation']['origin']) }}</li>
                            <li class="list-group-item"><strong>Forma de pagamento:</strong> {{$item['simulation']['payment_method']['description']}}</li>
                            <li class="list-group-item">
                                <strong>Valor da "Moeda de destino" usado para conversão:</strong>
                                {{ formatCurrency($item['quotation'], $item['currency']) }}
                            </li>
                            <li class="list-group-item">
                                <strong>Taxa de pagamento:</strong>
                                {{ formatCurrency($item['simulation']['payment_rate'], $item['simulation']['origin']) }}
                            </li>
                            <li class="list-group-item">
                                <strong>Taxa de conversão:</strong>
                                {{ formatCurrency($item['simulation']['conversion_rate'], $item['simulation']['origin']) }}
                            </li>
                            <li class="list-group-item">
                                <strong>Valor utilizado para conversão descontando as taxas:</strong>
                                {{ formatCurrency($item['simulation']['gross'] - $item['simulation']['payment_rate'] - $item['simulation']['conversion_rate'], $item['simulation']['origin']) }}
                            </li>
                            <li class="list-group-item">
                                <strong>Valor comprado em "Moeda de destino":</strong>
                                {{ formatCurrency((($item['simulation']['gross'] - $item['simulation']['payment_rate'] - $item['simulation']['conversion_rate']) * $item['quotation']),$item['currency']) }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
