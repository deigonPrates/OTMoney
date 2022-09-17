<div class="row">
    <div class="col-sm-12">
        <div class="d-flex justify-content-center form-horizontal">
            <div class="col-md-7">
                <div class="form-group row">
                    {!! Form::label('gross', 'Valor:', [ 'class' => 'col-sm-4 col-form-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::text('gross', old('gross'), ['id' => 'gross', 'class' => 'form-control money' . (session('gross.error') ? ' is-invalid' : null), 'required' => true]) !!}
                        <span id="feedback-gross" class="invalid-feedback" role="alert">
                            @if(session('gross.error'))
                                <strong>{{ session('gross.error') }}</strong>
                            @endif
                        </span>
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('origin', 'Moeda de origem:', [ 'class' => 'col-sm-4 col-form-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('origin',['BRL' => 'BRL-Real Brasileiro'], null, ['id' => 'origin', 'class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('destiny', 'Moeda de destino:', [ 'class' => 'col-sm-4 col-form-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('destiny[]',[], null, ['id' => 'destiny', 'class' => 'form-control', 'multiple' => true, 'required' => true]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('payment_method_id', 'Forma de Pagamento:', [ 'class' => 'col-sm-4 col-form-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('payment_method_id',[], null, ['id' => 'payment_method_id', 'class' => 'form-control', 'required' => true]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center form-horizontal">
    <div class="mt-3">
        <button type="button" class="btn btn-primary" id="submit-button">
            <i class="fa-solid fa-calculator"></i> Calcular
        </button>
    </div>
</div>

