@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cadastro</h3>
                <div class="card-tools">
                    <a href="{{route('payment-method.index')}}" class="btn btn-primary btn-sm" title="Listar">
                        <i class="nav-icon fa-solid fa-bars"></i> Listar
                    </a>
                </div>
            </div>
            <div class="card-body">
                {!! Form::open(['route' => 'payment-method.store', 'method' => 'POST', 'class' => 'forms-sample']) !!}
                @include('payment-method._inputs')
                {!! Form::close() !!}
            </div>
            <div class="card-footer">
            </div>
        </div>
    </section>


@endsection
