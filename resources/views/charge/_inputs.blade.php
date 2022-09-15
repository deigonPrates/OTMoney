<div class="row">
    <div class="col-sm-12">
        <div class="d-flex justify-content-center form-horizontal">
            <div class="col-md-7">
                <div class="form-group row">
                    {!! Form::label('value', 'Valor(%):*', [ 'class' => 'col-sm-4 col-form-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::text('value', null, ['id' => 'value', 'class' => 'form-control decimal', 'required' => true]) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('min', 'Valor Minímo(R$):', [ 'class' => 'col-sm-4 col-form-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::text('min', null, ['id' => 'min', 'class' => 'form-control money']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('max', 'Valor Maxímo(R$):', [ 'class' => 'col-sm-4 col-form-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::text('max', null, ['id' => 'max', 'class' => 'form-control money']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    {!! Form::label('status', 'Status', [ 'class' => 'col-sm-4 col-form-label']) !!}
                    <div class="col-sm-8">
                        {!! Form::select('status',[ 1 => 'Ativo',0 => 'Inativo'], null, ['id' => 'status', 'class' => 'form-control']) !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-center form-horizontal">
    <div class="mt-3">
        <a href="{{ route('charge.index') }}" class="btn btn-secondary mr-5">
            <i class="nav-icon fa-solid fa-ban"></i> Cancelar
        </a>
        <button type="submit" class="btn btn-primary" id="submit-button">
            <i class="nav-icon fa-solid fa-floppy-disk"></i> Salvar
        </button>
    </div>
</div>

