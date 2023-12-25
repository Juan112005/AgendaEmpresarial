@extends('adminlte::page')

@section('title', 'Agenda')

@section('content_header')
    <h1>Eventos</h1>
@stop

@section('content')
    <p>Bienvenido a los eventos</p>
    {{-- boton para crear eventos --}}

    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#miModalCreate">CREAR
        EVENTO</a>
    {{-- modal para crear eventos --}}
    <div class="modal fade" id="miModalCreate" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="miModalLabel">Detalles del Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.events.store') }}" class="create-event">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input required type="text" class="form-control" name="name" id="name"
                                aria-describedby="heplId" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <input required type="text" class="form-control" name="description" id=""
                                aria-describedby="helpId" placeholder="Description">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Ubication</label>
                            <input required type="text" class="form-control" name="ubication" id="ubication"
                                aria-describedby="helpId" placeholder="Ubication">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha Inicio</label>
                            <input required type="datetime-local" class="form-control" name="fech_inicio" id="fechinicio"
                                aria-describedby="helpId" placeholder="fechinicio">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Fecha de Finalizacion</label>
                            <input required type="datetime-local" class="form-control" name="fech_final" id="fechfinal"
                                aria-describedby="helpId" placeholder="fechfinal">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Asignar a:</label> <br>
                            <select name="agend" id="" class="form-control" aria-label="Default select example" required>
                                <option disabled selected>Eliga una agenda</option>
                                @foreach ($agends as $agends)
                                    <option value = '{{ $agends->id }}'>{{ $agends->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" onclick="confirmCrear(event)" class="btn btn-primary">Crear
                                Evento</button>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>

    {{-- Ver los eventos que hay creados --}}

    <div class="row">

        <div class="col-md-12">

            <div class="row">
                <div class="col">
                    <h4 class="bg-primary text-white text-center p-3 mx-0">EVENTOS CREADOS</h4>
                </div>
            </div>

            <div class="row">
                @foreach ($events as $event)
                    {{-- @if ($event->statuses_id == 1) --}}
                        <div class="col-md-2 mb-4 height: 100%;">
                            <div class="card" style=" height: 100%;">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold; color: #333;">{{ $event->name }}</h5>
                                    <br>
                                    <p class="card-text mt-n8" style="height: 100px; overflow: hidden;">
                                        {{ $event->description }}
                                    </p>
                                    <div class="row">
                                        <a href="#" class="btn btn-sm btn-primary col mr-2 mt-2 ver-evento"
                                            data-toggle="modal" data-target="#miModal{{ $event->id }}">Ver</a>


                                        <a href="#" data-toggle="modal"
                                            data-target="#editEventModal{{ $event->id }}"
                                            class="btn btn-sm btn-warning col mt-2">Editar</a>



                                        <div class="modal fade" id="editEventModal{{ $event->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Detalles del Evento</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    {{-- formulario de editar eventos --}}
                                                    <div class="modal-body">
                                                        <form method="POST" class="edit-event"
                                                            action="{{ route('admin.events.update', ['event' => $event->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Name</label>
                                                                <input required type="text" class="form-control" name="name"
                                                                    id="name" aria-describedby="heplId"
                                                                    placeholder="Name" value="{{ $event->name }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for=""
                                                                    class="form-label">Description</label>
                                                                <input required type="text" class="form-control"
                                                                    name="description" id=""
                                                                    aria-describedby="helpId" placeholder="Description"
                                                                    value="{{ $event->description }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Ubication</label>
                                                                <input required type="text" class="form-control"
                                                                    name="ubication" id="ubication"
                                                                    aria-describedby="helpId" placeholder="Ubication"
                                                                    value="{{ $event->ubication }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Fecha
                                                                    Inicio</label>
                                                                <input required type="datetime-local" class="form-control"
                                                                    name="fech_inicio" id="fechinicio"
                                                                    aria-describedby="helpId" placeholder="fechinicio"
                                                                    value="{{ $event->fech_inicio }}">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Fecha de
                                                                    Finalizacion</label>
                                                                <input required type="datetime-local" class="form-control"
                                                                    name="fech_final" id="fechfinal"
                                                                    aria-describedby="helpId"placeholder="fechfinal"
                                                                    value="{{ $event->fech_final }}">
                                                            </div>

                                                            <div class="mb-3">
                                                                <button type="submit"
                                                                    class="btn btn-primary edit-event">Editar
                                                                    Evento</button>
                                                            </div>
                                                            <div class="mb-3">
                                                                <a href="{{ route('admin.events.index') }}"
                                                                    class="btn btn-secondary btn-danger">Cancelar</a>

                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="modal fade" id="comentar{{ $event->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Crear Comentario</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{ route('admin.coments.store') }}"
                                                        class="create-coment">
                                                        <div class="modal-body">

                                                            @csrf
                                                            <input required type="hidden" name="eventocomentario" value="true">
                                                            <input required type="hidden" value="{{ $event->id }}"
                                                                name="event">
                                                            <label class="form-label">Haz tu comentario</label>
                                                            <textarea class="form-control" name="content" rows="3"></textarea>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Crear</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>




                                        {{-- poner desactivado un usuario --}}
                                        <form method="POST"
                                            action="{{ route('admin.events.update', ['event' => $event->id]) }}"
                                            class="col delete-event">
                                            @csrf
                                            @method('PUT')
                                            <input required type="hidden" name="status" value="{{ $event->statuses_id }}">
                                            <button type="submit"
                                                class="btn btn-sm {{ $event->statuses_id == 1 ? 'btn-danger' : 'btn-success' }} col mt-2">
                                                {{ $event->statuses_id == 1 ? 'Desactivar' : 'Activar' }}
                                            </button>
                                        </form>

                                        <a href="#" data-toggle="modal"
                                            data-target="#vercomentario{{ $event->id }}"
                                            class="btn btn-sm btn-dark col mt-2">Ver comentarios</a>

                                        <div class="modal fade" id="vercomentario{{ $event->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="miModalLabel">Comentarios</h5>

                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#comentar{{ $event->id }}"
                                                            class="btn btn-sm btn-primary col-2 ml-auto"
                                                            data-dismiss="modal">Comentar</a>
                                                        <div class="row">
                                                            @foreach ($comentario as $coments)
                                                                @if ($coments->statuses_id == 1)
                                                                    @if ($coments->events_id == $event->id)
                                                                        <div class="m-3">
                                                                            <div class="card" style="width: 13rem;">
                                                                                <div class="card-body">
                                                                                    <h5 class="card-title">Comentario</h5>
                                                                                    <p class="card-text">
                                                                                        {{ $coments->content }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cerrar</button>
                                                    </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- model para ver los detalles del evento --}}

                        <div class="modal fade" id="miModal{{ $event->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="miModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="miModalLabel">Detalles del Evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Nombre: </strong>{{ $event->name }} <span
                                                id="event-name{{ $event->id }}"></span></p>
                                        <p><strong>Descripción: </strong>{{ $event->description }} <span
                                                id="event-description{{ $event->id }}"></span></p>
                                        <p><strong>Ubicación: </strong> {{ $event->ubication }}<span
                                                id="event-ubication{{ $event->id }}"></span></p>
                                        <p><strong>Fecha de inicio: </strong>{{ $event->fech_inicio }} <span
                                                id="event-fech-inicio{{ $event->id }}"></span></p>
                                        <p><strong>Fecha de finalización: </strong>{{ $event->fech_final }} <span
                                                id="event-fech-final{{ $event->id }}"></span></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- @endif --}}
                @endforeach
                <div class="col-md-12">
                    {{$events->links()}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire({
                title: 'DESACTIVADO',
                text: 'Has desactivado tu evento',
                icon: 'success'
            });
        </script>
    @endif


    @if (session('crear') == 'ok')
        <script>
            Swal.fire({
                title: 'EVENTO CREADO',
                text: 'Has creado tu evento con exito',
                icon: 'success'
            });
        </script>
    @endif

    @if (session('editar') == 'ok')
        <script>
            Swal.fire({
                title: 'EVENTO EDITADO',
                text: 'Has editado tu evento con exito',
                icon: 'success'
            });
        </script>
    @endif
    @if (session('comentario') == 'comencreate')
        <script>
            Swal.fire({
                title: 'Comentario creado',
                text: 'Has creado tu comentario con exito',
                icon: 'success'
            });
        </script>
    @endif



    <script>
        $('.delete-event').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas seguro?',
                text: "Este evento se desactivara",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, !DESACTIVAR!',
                cancelButtonText: 'Cancelar',

            }).then((result) => {
                if (result.isConfirmed) {
                    /*Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )*/
                    this.submit();
                }
            })

        });
    </script>





    <script>
        $('.create-event').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estas seguro?',
                text: "Crearas un evento nuevo",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, !CREAR!',
                cancelButtonText: 'Cancelar',

            }).then((result) => {
                if (result.isConfirmed) {
                    /*Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )*/
                    this.submit();
                }
            })

        });
    </script>



    <script>
        $('.edit-event').submit(function(e) {
            e.preventDefault();
            Swal.fire({
                title: '¿Estas seguro?',
                text: "Este evento se editara",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, !EDITAR!',
                cancelButtonText: 'Cancelar',

            }).then((result) => {
                if (result.isConfirmed) {
                    /*Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )*/
                    this.submit();
                }
            })

        });
    </script>
    <script>
        $('.create-coment').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas seguro?',
                text: "Se creara un comentario",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, !Crear!',
                cancelButtonText: 'Cancelar',

            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>

@stop
