@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $currencyOriginList[0]->origin  ?? ' '}}</h3>
                            <p>Moeda mais utilizada (Origem)</p>
                        </div>
                        <div class="icon">
                            <i class="ion fa-solid fa-bag-shopping"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $currencyDestinyList[0]->currency  ?? ' '}}</h3>
                            <p>Moeda mais utilizada (Destino)</p>
                        </div>
                        <div class="icon">
                            <i class="ion fa-solid fa-signal"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 class="text-light">{{ $simulationsTotal }}</h3>
                            <p class="text-light">Simulações realizadas</p>
                        </div>
                        <div class="icon">
                            <i class="ion fa-solid fa-user-plus"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ number_format($simulationsValue,2,',', '.') }}</h3>
                            <p>Valor movimentado</p>
                        </div>
                        <div class="icon">
                            <i class="ion fa-solid fa-chart-pie"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <div class="row">
                <div class="col-md-6">
                    <!-- DONUT CHART -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Moedas de origem mais negociadas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="pieChartOrigin" ></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- DONUT CHART -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Moedas de destino mais negociadas</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="pieChartDestiny" ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(function () {

            const chartOrigin = new ApexCharts(document.querySelector("#pieChartOrigin"), {
                series: [{{  implode(',', $currencyOriginList->pluck('total')->toArray()) }}],
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: [{!! '"'.implode('","', $currencyOriginList->pluck('origin')->toArray()).'"' !!}],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            });
            chartOrigin.render();

            const chartDestiny = new ApexCharts(document.querySelector("#pieChartDestiny"), {
                series: [{{  implode(',', $currencyDestinyList->pluck('total')->toArray()) }}],
                chart: {
                    width: 380,
                    type: 'pie',
                },
                labels: [{!! '"'.implode('","', $currencyDestinyList->pluck('currency')->toArray()).'"' !!}],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            });
            chartDestiny.render();

        })
    </script>
@endsection
