@extends('adminlte::page')

@section('title', 'Agenda')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-md-4 mt-4">
        <div class="card h-100">
            <div class="card-body text-center flex-column">
                <div style="position: absolute; top: 125px; right: 90px; background-color: #f0f0f0; padding: 4px; border-radius: 50%; width: 33px; height: 33px;">
                    <label for="image" style="cursor: pointer;">
                        <img src="{{ asset('img/camera2.png') }}" style="width: 25px; height: 25px;">
                    </label>
                </div>                
                <img src="{{ asset($user->img) }}" class="rounded-circle img-thumbnail mb-3 border border-secondary" style="width: 150px; height: 150px;" data-toggle="modal" data-target="#imgModal">
                <h3>{{ $user->name }}</h3>
                
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Nombre</th>
                            <td class="text-nowrap">{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <th>Gmail</th>
                            <td class="text-nowrap">{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <th>Documento</th>
                            <td class="text-nowrap">{{ $user->document }}</td>
                        </tr>
                        <tr>
                            <th>Edad</th>
                            <td class="text-nowrap">{{ $user->age }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    <div class="col-md-5 mt-4">
        <div class="card h-100">
            <div class="card-body">
                <form id="updateForm" action="{{ route('admin.profile.update', ['profile' => $user->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <h3>Actualizar datos</h3>
                    <div>
                        <input type="file" name="image" id="image" style="display: none">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="name" class="form-control" maxlength="255">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Gmail:</label>
                        <input type="email" id="email" name="email" class="form-control" maxlength="255">
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="documento">Documento:</label>
                        <input type="text" name="document" class="form-control" id="document">
                    </div>
                    <div class="form-group mb-3">
                        <label for="edad">Edad:</label>
                        <input type="text" name="age" class="form-control" id="age">
                    </div>
                    <button type="submit" class="btn btn-block btn-primary" onclick="return confirmUpdate()">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imgModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ $user->img }}" style="max-width: 100%; height: auto;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>

        function confirmUpdate() {
            Swal.fire({
                title: 'Confirmar actualización',
                text: "¿Estás seguro de que deseas actualizar los datos de tu perfil?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, actualízalo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateForm').submit();
                }
            });
            return false;
        }

        document.getElementById('image').addEventListener('change', function() {
            Swal.fire({
                title: 'Confirmar cambio de imagen',
                text: "¿Estás seguro de que quieres cambiar tu foto de perfil?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, cámbiala!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateForm').submit();
                } else {
                    this.value = '';
                }
            });
        });

        function validarEdad(input, limiteSuperior) {
            input.value = input.value.replace(/\D/g, '');
            if (input.value > limiteSuperior) {
                input.value = limiteSuperior;
            }
        }

        document.getElementById('age').addEventListener('input', function() {
            validarEdad(this, 99);
        });

        document.getElementById('document').addEventListener('input', function() {
            validarEdad(this, 9999999999999999999);
        });

        @if ($errors->has('email'))
            Swal.fire({
                title: 'Error',
                text: '{{ $errors->first('email') }}',
                icon: 'error'
            });
        @endif

        @if (session('actualizar_perfil') == 'ok')
            Swal.fire({
                title: 'PERFIL ACTUALIZADO',
                text: 'Perfil actualizado con éxito',
                icon: 'success'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error',
                text: '{{ session('error') }}',
                icon: 'error'
            });
        @endif

    </script>
@stop
