@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div style="border:solid white 2px;" class="card">
                <div class="card-header" style="background-color: #08173B; color:white;">{{ __('Registro    ') }}</div>

                <div style="color:white;" class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Escribe tu nombre" style="background-color:#1d57de; border:solid white 2px; color:white;" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="document" class="col-md-4 col-form-label text-md-end">{{ __('Documento') }}</label>

                            <div class="col-md-6">
                                <input style="background-color:#1d57de; border:solid white 2px; color:white;" id="document" type="text" class="form-control @error('document') is-invalid @enderror" name="document" value="{{ old('document') }}" required autocomplete="document" autofocus pattern="[0-9]*" placeholder="Solo numeros">

                                @error('document')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="age" class="col-md-4 col-form-label text-md-end">{{ __('Edad') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Digita tu edad" style="background-color:#1d57de; border:solid white 2px; color:white;" id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" value="{{ old('age') }}" required autocomplete="age" autofocus maxlength="2">

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>La edad solo puede contener 2 numeros</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input placeholder="correo@gmail.com" style="background-color:#1d57de; border:solid white 2px; color:white;" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Este correo ya esta registrado</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="img" class="col-md-4 col-form-label text-md-end">{{ __('Foto de Perfil') }}</label>

                            <div class="col-md-6">
                                <input  style="background-color:#1d57de; border:solid white 2px; color:white;" id="img" type="file" class="form-control @error('img') is-invalid @enderror" name="img" value="{{ old('img') }}" required autocomplete="img">

                                @error('img')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Minimo 8 caracteres" style="background-color:#1d57de; border:solid white 2px; color:white;" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Su contraseña debe contener como minimo 8 caracteres</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input placeholder="Repite la contraseña"  style="background-color:#1d57de; border:solid white 2px; color:white;" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .card{
        background-color:#12378c;
    }
</style>
@endsection
