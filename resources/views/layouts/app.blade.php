<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

    <!-- CUSTOM -->
    <link href="{{ asset('css/selectize.bootstrap5.css') }}" rel="stylesheet">

    @yield('styles')
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button{
            padding: 0!important;
        }
    </style>
   <body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @include('layouts.nav')
        @include('layouts.menu')

        <div class="content-wrapper p-5">
            @include('layouts.info')
            @yield('content')

        </div>

        @include('layouts.footer')

    </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.min.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/selectize.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>

    <script>

        $(document).ready(function () {
            $(".decimal").maskMoney({thousands:'', decimal:'.', allowZero:true});
            $(".money").maskMoney({thousands:'.', decimal:',', allowZero:true});
        });

        function read(url, callback){
            $.ajax({
                url,
                type: 'GET',
                error: function() {
                    callback();
                },
                success: function(res) {
                    callback(res);
                }
            });
        }

        function store(url, callback, data){
            $.ajax({
                url,
                type: 'POST',
                data,
                success: function (result) {
                    if (result) {
                        callback(result);
                    }
                }
            });
        }

        function makeSuccessToast(title, body, delay = 5000){
            makeToast(title, body, delay, 'bg-success m-1');
        }

        function makeErrorToast(title, body, delay = 5000){
            makeToast(title, body, delay, 'bg-danger m-1')
        }

        function makeWarningToast(title, body, delay = 5000){
            makeToast(title, body, delay, 'bg-warning m-1')
        }

        function makeToast(title, body, delay, className){
            $(document).Toasts('create', {
                icon: 'fas fa-exclamation-triangle',
                class: className,
                autohide: true,
                delay,
                title,
                body
            });
        }

        function globalMoney(money, mask){
            try {
                const formatter = new Intl.NumberFormat('pt-BR', {
                    style: 'currency',
                    currency: mask
                });
                return formatter.format(money);
            }catch(er) {
               return money;
            }
        }

        function receipt(data){
            let html = "";
            data.forEach(item =>{
                html += ` <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-dark">
                                            <h3 class="card-title">${item.simulation.origin} - ${item.currency}</h3>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group  list-group-flush">
                                                <li class="list-group-item"><strong>Moeda de origem:</strong> ${item.simulation.origin}</li>
                                                <li class="list-group-item"><strong>Moeda de destino:</strong> ${item.currency}</li>
                                                <li class="list-group-item"><strong>Valor para conversão:</strong> ${globalMoney(item.simulation.gross, item.simulation.origin)}</li>
                                                <li class="list-group-item"><strong>Forma de pagamento:</strong> ${item.simulation.payment_method.description}</li>
                                                <li class="list-group-item">
                                                    <strong>Valor da "Moeda de destino" usado para conversão:</strong>
                                                    ${globalMoney(item.quotation, item.currency)}
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Taxa de pagamento:</strong>
                                                    ${globalMoney(item.simulation.payment_rate, item.simulation.origin)}
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Taxa de conversão:</strong>
                                                    ${globalMoney(item.simulation.conversion_rate, item.simulation.origin)}
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Valor utilizado para conversão descontando as taxas:</strong>
                                                    ${globalMoney(item.simulation.gross - item.simulation.payment_rate - item.simulation.conversion_rate, item.simulation.origin)}
                                                </li>
                                                <li class="list-group-item">
                                                    <strong>Valor comprado em "Moeda de destino":</strong>
                                                    ${globalMoney(((item.simulation.gross - item.simulation.payment_rate - item.simulation.conversion_rate) * item.quotation).toFixed(2),item.currency)}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>`;
            });
            $('#result-simulation-show').empty().append(html);
            $('#result-simulation')?.removeClass('d-none');

            $('html, body').animate({ scrollTop: $('#result-simulation-show').offset().top}, 1000);
        }

        function modalClose(id){
            $(id).modal('hide');
        }
    </script>
    @yield('script')

</body>
</html>
