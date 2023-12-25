@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <strong>Exito!</strong> {{ session('success') }}
            <button type="button" class="close-button" data-dismiss="alert">x</button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="close-button" data-dismiss="alert">x</button>
        </div>
    @endif
{{-- crear usuario --}}
    <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#createUserModal">Crear Usuario</a>
{{-- ver usuarios --}}
    <div class="row">
        @foreach ($users as $user)
        <div class="col-md-3">
            <div class="user-card">
                <div class="user-avatar">
                    <img src="{{ asset($user->img) }}" alt="Foto de {{ $user->name }}" style="width: 200px; height: 115px;" data-toggle="modal" data-target="#imgModal">
                </div>
                <div class="user-info" style="overflow: auto;">
                    <h3>{{ $user->name }}</h3>
                    <p class="text-truncate">{{ $user->document }}</p>
                    <p>{{ implode(', ', $user->getRoleNames()->toArray()) }}</p>
                </div>
                <div class="user-actions">
                    <a href="#" data-toggle="modal" data-target="#editUserModal{{ $user->id }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('admin.users.update', $user->id) }}" method="post" style="display: inline;" onsubmit="return confirm('¿Seguro que deseas desactivar este usuario?');">
                        @csrf
                        @method('PUT')
                        <input required type="hidden" value="true" name="validacion">
                        <button type="button" class="btn btn-danger" onclick="confirmDesactivar(event)" data-title="Advertencia">Eliminar</button>
                    </form>
                    <p></p>
                    @if (implode(', ', $user->getRoleNames()->toArray()) == 'empleado')
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post" style="display: inline;" onsubmit="return confirm('¿Seguro que deseas cambiar de rol este usuario?');">
                            @csrf
                            @method('PUT')
                            <input required type="hidden" value="true" name="admin">
                            <button type="submit" onclick="confirmCambiarRol(event)" class="btn btn-primary" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; cursor: pointer; font-size: 16px;">Hacer Admin</button>
                        </form>
                    @else
                        <form action="{{ route('admin.users.update', $user->id) }}" method="post" style="display: inline;" onsubmit="return confirm('¿Seguro que deseas cambiar de rol este usuario?');">
                            @csrf
                            @method('PUT')
                            <input required type="hidden" value="true" name="empleado">
                            <button type="submit" onclick="confirmCambiarRol(event)" class="btn btn-primary" style="background-color: #4CAF50; color: white; border: none; padding: 10px 20px; cursor: pointer; font-size: 16px;">Hacer Empleado</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

            {{-- modal para editar los usuarios --}}

            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info text-white">
                            <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nombre:</label>
                                            <input required type="text" class="form-control" name="name"
                                                value="{{ $user->name }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email:</label>
                                            <input required type="email" class="form-control" name="email"
                                                value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="document">Documento:</label>
                                            <input required type="text" class="form-control" name="document"
                                                value="{{ $user->document }}" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="age">Edad:</label>
                                            <input required type="text" class="form-control" id="age" name="age"
                                                value="{{ $user->age }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="img">Imagen URL:</label>
                                    <input required type="file" class="form-control" name="img" required>
                                </div>

                                <a href="#" onclick="confirmActualizar(event)"
                                    class="btn btn-primary">Actualizar</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-md-12">
            {{$users->links()}}
        </div>
    </div>
{{-- modal para crear eventos --}}
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre:</label>
                                    <input required type="text" class="form-control" name="name" required>
                                </div>

                                <div class="form-group">
                                    <label for="document">Documento:</label>
                                    <input required type="text" class="form-control" name="document" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Contraseña:</label>
                                    <input required type="password" class="form-control" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label for="img">Cargar foto:</label>
                                    <input required type="file" class="form-control custom-border" name="img" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input required type="email" class="form-control" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label for="age">Edad:</label>
                                    <input required type="text" class="form-control" id="age" name="age" required>
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirmar Contraseña:</label>
                                    <input required type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                        </div>
                        <a href="#" onclick="confirmCrear(event)" class="btn btn-primary">Crear Usuario</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .alert {
            padding: 1rem 1.25rem;
            border: 1px solid transparent;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
        }

        .close-button {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            border: none;
            border-radius: 8px;
            background-color: black;
            color: white;
            padding: 8px 16px;
            font-size: 16px;
            line-height: 1;
        }

        .user-card {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        .user-avatar img {
            border-radius: 50%;
            max-width: 100px;
        }

        .user-info h3 {
            margin-top: 10px;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function confirmDesactivar(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Advertencia',
                text: '¿Seguro que deseas desactivar este usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, desactivar'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.parentElement.submit();
                }
            });
        }

        function confirmActualizar(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Actualizar Usuario',
                text: '¿Seguro que deseas actualizar este usuario?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, actualizar'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.parentElement.submit();
                }
            });
        }

        function confirmCrear(event) {
            event.preventDefault();

            let password = document.getElementsByName("password")[0].value;
            let confirmPassword = document.getElementsByName("password_confirmation")[0].value;

            if (password === confirmPassword) {
                Swal.fire({
                    title: 'Crear Nuevo Usuario',
                    text: '¿Seguro que deseas crear un nuevo usuario?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, crear'
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.parentElement.submit();
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Las contraseñas no coinciden!',
                });
            }
        }

        function confirmCambiarRol(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Cambiar Rol de Usuario',
                text: '¿Seguro que deseas cambiar el rol de este usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4CAF50',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, Cambiar Rol'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.parentElement.submit();
                }
            });
        }
    </script>
@stop
