@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cadastro</h3>
                <div class="card-tools">
                    <a href="{{route('charge.index')}}" class="btn btn-primary btn-sm" title="Listar">
                        <i class="nav-icon fa-solid fa-bars"></i> Listar
                    </a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::model($charge, ['route' => ['charge.update', $charge->id], 'method' => 'PUT', 'class' =>
                    'forms-sample']) !!}
                @include('charge._inputs')
                {!! Form::close() !!}
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>
@endsection
