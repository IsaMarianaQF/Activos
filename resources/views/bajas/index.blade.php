@extends('adminlte::page')

@section('title', 'ActivosTigo')

@section('content_header')
    <h1>BAJAS</h1>
@stop

@section('content')
    <form action="{{ route('bajas.store') }}" method="POST" id="bajasForm">
        @csrf
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#confirmModal">
            <i class="fas fa-file-excel"></i> Generar Excel
        </button>

        <table id="activos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col" class="text-center">Check</th>
                    <th scope="col">Sys</th>
                    <th scope="col">Atn</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Serial</th>
                    <th scope="col">CodActivo</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Estado</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($activos as $activo)
                    <tr>
                        <td class="text-center">
                            <input type="checkbox" name="activos_seleccionados[]" value="{{ $activo->id }}" class="form-check-input">
                        </td>
                        <td>{{ $activo->sys }}</td>
                        <td>{{ $activo->atn }}</td>
                        <td>{{ $activo->nombre }}</td>
                        <td>{{ $activo->marca }}</td>
                        <td>{{ $activo->modelo }}</td>
                        <td>{{ $activo->serial }}</td>
                        <td>{{ $activo->codactivo }}</td>
                        <td>{{ $activo->ciudad }}</td>
                        <td>{{ $activo->usuario }}</td>
                        <td>{{ $activo->estado }}</td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </form>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas generar el archivo Excel para los activos seleccionados?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmButton">Generar</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <style>
        .table td, .table th {
            vertical-align: middle;
            text-align: center;
        }
        .form-check-input {
            margin-left: auto;
            margin-right: auto;
        }
    </style>
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('#activos').DataTable({
        "lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]]
    });

    $('#confirmButton').on('click', function() {
        $('#bajasForm').submit();
    });

    // Función para cerrar la ventana modal después de generar
    $('#bajasForm').on('submit', function() {
        $('#confirmModal').submit();
    });
});
</script>
@stop
