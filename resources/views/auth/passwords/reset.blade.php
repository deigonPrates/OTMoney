@extends('auth.app')

@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        @include('layouts.info')
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <span class="h1"><b>{{ config('app.name', 'Laravel') }}</b></span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="E-mail"   name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Senha" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirme a senha">
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-primary btn-block"> {{ __('Reset Password') }}</button>
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
