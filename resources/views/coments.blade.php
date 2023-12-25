@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Comentarios</h1>
@stop


@section('content')
    <div class="mt-2">
        <h4 class="bg-primary text-white text-center p-3 mx-0">Comentarios Creados</h4>
    </div>
    <div class="row">
        @foreach ($coments as $coment)
            {{-- @if ($coment->statuses_id == 1) --}}
                <div class="m-3">
                    <div class="card" style="width: 14rem;">
                        <div class="card-body">
                            <h5 class="card-title">Comentario</h5>
                            <p class="card-text">{{ $coment->content }}</p>
                            <div class="row">
                                <div class="ml-2">
                                    <a href="#" class="btn btn-warning" data-toggle="modal"
                                        data-target="#editmodal{{ $coment->id }}">Editar</a>
                                </div>
                                <div class="ml-2">
                                    <form action="{{ route('admin.coments.update', ['coment' => $coment->id]) }}"
                                        method="post" class="desactivar-coment">
                                        @csrf
                                        @method('PUT')
                                        <input required type="hidden" name="validacion" value="true">
                                        <button type="submit" class="btn btn-danger">Desactivar</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editmodal{{ $coment->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editmodal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editmodal">Crear Comentario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="POST" action="{{ route('admin.coments.update', ['coment' => $coment->id]) }}"
                                class="edit-coment">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <label class="form-label">Haz tu comentario</label>
                                    <textarea class="form-control" name="content" rows="3">{{ $coment->content }}</textarea>


                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Editar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- @endif --}}
        @endforeach
    </div>
    <div class="col-md-12">
        {{$coments->links()}}
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success') == 'create')
        <script>
            Swal.fire({
                title: 'Comentario creado',
                text: 'Has creado tu comentario con exito',
                icon: 'success'
            });
        </script>
    @endif
    @if (session('edit') == 'ok')
        <script>
            Swal.fire({
                title: 'Comentario editado',
                text: 'Has editado tu comentario con exito',
                icon: 'success'
            });
        </script>
    @endif
    @if (session('success') == 'delete')
        <script>
            Swal.fire({
                title: 'Comentario eliminado',
                text: 'Has eliminado tu comentario con exito',
                icon: 'success'
            });
        </script>
    @endif

    <script>
        $('.create-coment').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas seguro?',
                text: "Se creara un evento nuevo",
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
    <script>
        $('.edit-coment').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas seguro?',
                text: "Se editara este comentario",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, !Editar!',
                cancelButtonText: 'Cancelar',

            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
     <script>
        $('.desactivar-coment').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas seguro?',
                text: "Se eliminara el comentarios",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, !eliminar!',
                cancelButtonText: 'Cancelar',

            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })
        });
    </script>
@stop
