@extends('auth.app')

@section('content')

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <span class="h1"><b>{{ config('app.name', 'Laravel') }}</b></span>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Um link para a redefinição da senha será enviado. Verifique sua caixa de entrada e/ou SPAM</p>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="E-mail"   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

            </div>
            <div class="card-footer">
                <p class="mb-1">
                    <a href="{{ route('login') }}">Voltar ao login</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
