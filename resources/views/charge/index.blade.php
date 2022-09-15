@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listagem</h3>
                <div class="card-tools">
                    <a href="{{route('charge.create')}}" class="btn btn-primary btn-sm" title="Novo">
                        <i class="nav-icon fa-solid fa-plus"></i> Novo
                    </a>
                </div>
            </div>
            <div class="card-body">
                @include('table.table')
            </div>

            <div class="card-footer">
            </div>

        </div>
    </section>
@endsection
