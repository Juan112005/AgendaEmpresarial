@extends('adminlte::page')

@section('content')
    <div class="my-2">
        <h2>Comentarios existentes</h2>
        <a href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#miModalCreate">Calificanos</a>
    </div>

    <div class="row">
        @foreach ($ratings as $rating)
            @if ($rating->statuses_id == 1)
                <div class="card text bg-dark m-1" style="max-width: 20rem; min-width: 20rem;">
                    <div class="card-header">Calificación:
                        @for ($i = 0; $i < $rating->assessment; $i++)
                            <span class="fa-solid fa-star" style="color: orange;"></span>
                        @endfor
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Comentario:</h4>
                        <p class="card-text" style="height: 100px; overflow: hidden;">{{ $rating->review }}</p>
                        @if ($user->hasRole('admin'))
                            <form method="post" action="{{ route('admin.rating.update', $rating->id) }}" class="delete-rating">
                                @csrf
                                @method('put')
                                <input required type="hidden" name="eliminar" value="true">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    {{-- Modal para calificar --}}
    <div class="modal fade" id="miModalCreate" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="miModalLabel">Calificar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.rating.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="assessment">Calificación:</label>
                            <span class="fa-solid fa-star" onclick="calificar(this)" style="cursor: pointer" id="1" ></span>
                            <span class="fa-solid fa-star" onclick="calificar(this)" style="cursor: pointer" id="2" ></span>
                            <span class="fa-solid fa-star" onclick="calificar(this)" style="cursor: pointer" id="3" ></span>
                            <span class="fa-solid fa-star" onclick="calificar(this)" style="cursor: pointer" id="4" ></span>
                            <span class="fa-solid fa-star" onclick="calificar(this)" style="cursor: pointer" id="5" ></span>
                            <input required type="hidden" name="assessment" id="assessment" value="">
                        </div>
                        <div class="form-group">
                            <label for="review">Comentario:</label>
                            <textarea class="form-control" name="review" rows="4" required></textarea>
                        </div>
                        <button type="submit" id="enviarestre" class="btn btn-primary">Enviar Calificación</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <script src="https://kit.fontawesome.com/07006c140e.js" crossorigin="anonymous"></script>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        var contador;
        function calificar(item){
            contador=item.id;
            let nombre = item.id.substring(1);
            for(let i=0;i<5;i++){
                if (i<contador) {
                    document.getElementById((i+1)+nombre).style.color="orange";
                }else{
                    document.getElementById((i+1)+nombre).style.color="black";
                }
            }
            document.getElementById('assessment').value = contador;
        }
    </script>

    @if (session('eliminado') == 'ok')
        <script>
            Swal.fire({
                title: 'ELIMINADA',
                text: 'Has eliminado la calificacion',
                icon: 'success'
            });
        </script>
    @endif
    @if (session('creado') == 'ok')
        <script>
            Swal.fire({
                title: 'Gracias',
                text: 'Seguiremos trabajando para mejorar',
                icon: 'success'
            });
        </script>
    @endif
    <script>
        $('.delete-rating').submit(function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Estas seguro?',
                text: "Esta calificacion se eliminara",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, !DESACTIVAR!',
                cancelButtonText: 'Cancelar',

            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            })

        });
    </script>
@stop
