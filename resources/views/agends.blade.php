@extends('adminlte::page')

@section('title', 'Agenda')

@section('content_header')

@stop

@section('content')
    <h1>Agenda</h1>
    <div class="mb-4">
        <!-- Botón para crear una nueva tarjeta -->
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal">Crear Agenda</button>
    </div>
    {{-- Ver las agendas en tarjetas --}}
    @if (count($agends) > 0)
        <div class="container col-12">
            @foreach ($agends as $agend)
            {{-- @if ($agend->statuses_id == 1) --}}
                
            
                <div class="row">
                    <div class="col-md-3">
                        <div class=mx-3>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="form-group">
                                        <img src="{{ asset($agend->img) }}" class="img-fluid">
                                        <div class="card-info">
                                            <h2>{{ $agend->name }}</h2>
                                            <p>{{ $agend->description }}</p>

                                        </div>
                                        <div class="btn-group">
                                            @if ($userlog == $agend->owner_id || $esadmin)
                                                <a href="{{ $agend->id }}" class="btn btn-sm btn-primary"
                                                    data-toggle="modal"
                                                    data-target="#editModal_{{ $agend->id }}">Editar</a>
                                                <div class="ml-1">
                                                    <form action="{{ route('admin.agends.destroy', $agend->id) }}"
                                                        class="d-inline formulario-eliminar" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                </div>
                                                {{-- @else
                                                    <div>
                                                     <p>Colocar algo si no es el owner</p>   
                                                    </div> --}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Modal para editar agenda -->
                <div class="modal fade " id="editModal_{{ $agend->id }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Agenda</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('admin.agends.update', ['agend' => $agend->id]) }}"
                                    enctype="multipart/form-data" class="edit-agend">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name">Nombre:</label>
                                        <input required type="text" class="form-control" name="name"
                                            value="{{ $agend->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Descripción:</label>
                                        <textarea class="form-control" name="description" required>{{ $agend->description }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="imagen">Imagen:</label>
                                        <input  type="file" class="form-control" name="img" id="img"
                                            aria-describedby="img">
                                        <div class="small-image-container">
                                            <img src="{{ asset($agend->img) }}" class="img-fluid">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="img">Agregar usuarios:</label>

                                        <ul>
                                            <table class="table" id="editusers">
                                                <thead>
                                                    <tr>
                                                        <th>Seleccionar</th>
                                                        <th>Nombre</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($users as $user)
                                                        @if ($user->id != $agend->owner_id)
                                                            <tr>
                                                                <td><input  type="checkbox" value="{{ $user->id }}" name="usuarios[]" 
                                                                        @foreach ($usuarios as $usuario)
                                                                            @if ($agend->id == $usuario->agends_id && $user->id == $usuario->users_id)
                                                                                checked='checked'
                                                                            @endif 
                                                                        @endforeach
                                                                    >
                                                                </td>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                                        <a class="btn btn-secondary btn-sm"
                                            href="{{ route('admin.agends.index') }}">Cancelar</a>
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="guardar-tarjeta">Guardar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- @endif --}}
            @endforeach
            <div class="col-md-12">
                {{$agends->links()}}
            </div>
        </div>
    @else
        <p>No hay agendas guardadas.</p>
    @endif

    <!-- Modal para crear agendas -->
    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Agenda</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.agends.store') }}" enctype="multipart/form-data"
                        class="create-agend">
                        @csrf
                        <input required type="hidden" id="tarjeta-id" name="tarjeta-id">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input required type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="img">Imagen:</label>
                            <input required type="file" class="form-control" id="img" name="img">
                        </div>
                        <div class="form-group">
                            <label for="">Agregar usuarios:</label>
                            <table class="table" id="usuarios" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Seleccionar</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary" id="guardar-tarjeta">Guardar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
        }

        .card {
            width: 330px;
            height: 430px;
            border-radius: 8px;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            margin bottom: 20px;
            margin right: 20px;
            text-align: center;
            transition: all 0.25s;
        }

        .card:hover {
            transform: translateY(-15px);
            box-shadow: 0 12px 16px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 330px;
            height: 220px;
        }

        .card-info {
            padding: 10px;
        }

        .small-image-container {
            max-width: 200px;
            max-height: 200px;
            margin: 0 auto;
            overflow: hidden;
        }

        .small-image-container img {
            width: 100%;
            height: auto;
        }
    </style>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        $('#usuarios').DataTable({
            ajax: "{{ route('datatable.users') }}",
            "columns": [{
                    data: null,
                    render: function(data, type, row) {
                        return '<input  type="checkbox" name="users[]" class="checkbox" value="' + data.id +
                            '">';
                    }
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },

            ]
        });
    </script>
    {{-- <script>
        $('#editusers').DataTable({
            ajax: "{{ route('datatable.users') }}",
            "columns": [{
                data: null,
                render: function(data, type, row) {
                     return '<input required type="checkbox" name="users[]" class="checkbox" value="' + data.id + '">';
                    }},
                {data: 'name'},
                {data: 'email'},

            ]
        });
    </script> --}}


    @if (session('success') == 'Agenda eliminada exitosamente.')
        <script>
            Swal.fire(
                'Eliminado!',
                'La Agenda ha sido eliminada.',
                'success'
            )
        </script>
    @endif
    @if (session('success') == 'agendaeditada')
        <script>
            Swal.fire(
                'Editada!',
                'La Agenda ha sido editada.',
                'success'
            )
        </script>
    @endif
    @if (session('success') == 'agendacreada')
        <script>
            Swal.fire(
                'Creada',
                'La agenda ha sido creada correctamente',
                'success'
            )
        </script>
    @endif
    <script>
        $('.formulario-eliminar').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas Seguro?',
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Borrar!',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
    <script>
        $('.edit-agend').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas Seguro?',
                text: "No podras revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Editar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
    <script>
        $('.create-agend').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas Seguro?',
                text: "Se va a crear una nueva agenda",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Crear!'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@endsection
