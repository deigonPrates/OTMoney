@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Simular</h3>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'simulation.store', 'id' => 'form-simulator',  'method' => 'POST', 'class' => 'forms-sample']) !!}
                @include('simulation._inputs')
                {!! Form::close() !!}
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>

    <section class="content">
        <div class="col-md-12">
            <div id="result-simulation" class="card d-none">
                <div class="card-header">
                    <h3 class="card-title">Resultado da Simulação</h3>
                </div>
                <div class="card-body">
                    <input type="hidden" id="simulation-id" value="0">
                    <div class="row" id="result-simulation-show"></div>
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-info" onclick="sendMail()">
                        <i class="fa-solid fa-envelope"></i> Enviar por email
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#origin').selectize({
                preload: true,
                valueField: 'coin',
                labelField: 'name',
                searchField: 'name',
                placeholder: "Selecionar itens",
                options: [],
                load: function(query, callback) {
                    const url = "{{ route('currency.search.origin') }}" + "?name=" + encodeURIComponent(query)
                    read(url, callback)
                },
                create:false,
            }).change(() => {
                $('#destiny').selectize()[0].selectize.destroy();
                loadDestiny();
            });
            loadDestiny();

            $('#payment_method_id').selectize({
                preload: true,
                valueField: 'id',
                labelField: 'name',
                searchField: 'name',
                placeholder: "Selecionar itens",
                options: [],
                load: function(query, callback) {
                    const url = "{{ route('payment.method.search') }}" + "?name=" + encodeURIComponent(query)
                    read(url, callback)
                },
                create:false,
            });

            $('#gross').on('blur', function (){
                $(this).removeClass('is-invalid');
                let _tempValue = clearMoneyInput($(this).val());
                if(parseFloat(_tempValue) < 1000){
                    $(this).addClass('is-invalid');
                    $('#feedback-gross').empty().append(`<strong>Valor mínimo: R$ 1.000,00</strong>`);
                }else if(parseFloat(_tempValue) > 100000){
                    $(this).addClass('is-invalid');
                    $('#feedback-gross').empty().append(`<strong>Valor maxímo: R$ 100.000,00</strong>`);
                }
            });

            $('#submit-button').on('click', function (e){
                e.preventDefault();
                let _tempValue = clearMoneyInput($('#gross').val());
                let errors = '';

                if(parseFloat(_tempValue) < 1000){
                    errors += 'Valor mínimo: 1.000,00<br>';
                }else if(parseFloat(_tempValue) > 100000){
                    errors += 'Valor maxímo: 100.000,00<br>';
                }

                if(errors.length === 0){
                    $.ajax({
                        url: '{{ route('simulation.store') }}',
                        type: 'POST',
                        data: $('#form-simulator').serialize(),
                        dataType: 'JSON',
                        beforeSend: function() {
                            Swal.fire({
                                html: '<b>Carregando...</b><br><span class="fas fa-spinner fa-pulse" style="font-size:35px"></span>',
                                showConfirmButton: false
                            });
                        },
                        success: function(data){
                            Swal.close();
                            $('#simulation-id').val(data[0].simulation_id);
                            receipt(data);
                        },
                        error: function(response){
                            Swal.close();
                            let errors = '';
                            $.each(response.responseJSON.errors,function(field_name,error){
                                errors += error+'<br>';
                            });
                            makeErrorToast('Falha ao processar requisição', errors, 4000)
                        }
                    });
                }

            });

        });

        function clearMoneyInput(ref){
            return ref.replaceAll('.','').replace(',','.');
        }

        function loadDestiny(){
            $('#destiny').selectize({
                preload: true,
                valueField: 'coin',
                labelField: 'name',
                searchField: 'name',
                placeholder: "Selecionar itens",
                options: [],
                load: function(query, callback) {
                    const url = "{{ route('currency.search.destiny') }}" + "?name=" + encodeURIComponent(query) + '&origin=' + $('#origin').val()
                    read(url, callback)
                },
                create:false,
            });
        }

        function sendMail(){
            let tempUrl = '{{ route('simulation.send.mail', 0) }}';
            $.ajax({
                url: tempUrl.replace('/0', '/'+$('#simulation-id').val()),
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function() {
                    Swal.fire({
                        html: '<b>Carregando...</b><br><span class="fas fa-spinner fa-pulse" style="font-size:35px"></span>',
                        showConfirmButton: false
                    });
                },
                success: function(){
                    Swal.close();
                    makeSuccessToast('E-mail enviado.', 'confira sua caixa de entrada, caso não encontre verifique a de spam')
                },
                error: function(response){
                    Swal.close();
                    let errors = '';
                    $.each(response.responseJSON.errors,function(field_name,error){
                        errors += error+'<br>';
                    });
                    makeErrorToast('Falha ao processar requisição', errors, 4000)
                }
            });
        }
    </script>
@endsection
