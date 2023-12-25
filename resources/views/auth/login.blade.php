@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border:solid white; margin-top:20%;">
                    <div class="card-header" style="background-color: #08173B; color:white;">{{ __('Iniciar sesion') }}</div>

                    <div class="card-body" style="background-color: #12378c;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end"
                                    style="color:white;">{{ __('Correo') }}</label>

                                <div class="col-md-6">
                                    <input style="background-color:#1d57de; border:solid white 2px;" id="email"
                                        type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end"
                                    style="color:white;">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input style="background-color:#1d57de; border:solid white 2px; color:white;"
                                        id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember" style="color:white;">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary butonLogin">
                                        {{ __('Entrar') }}
                                    </button>

                                    {{-- @if (Route::has('password.request'))
                                        <a class="btn btn-link Forgot" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .Forgot {
            color: white;
        }

        .Forgot:hover {
            color: black;
        }

        .butonLogin {
            background-color: #1d57de;
            border: solid white 1px;
            transition: transform 0.3s ease-in-out;
        }

        .butonLogin:hover {
            transform: translateY(-5px)
        }
    </style>>
@endsection
