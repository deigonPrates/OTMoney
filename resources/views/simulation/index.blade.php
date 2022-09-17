@extends('layouts.app')

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Histórico</h3>
            </div>
            <div class="card-body">
                @include('table.table')
            </div>
            <div class="card-footer"></div>
        </div>
    </section>
@endsection
