@extends('adminlte::page')

@section('title', 'ActivosTigo')

@section('content_header')
    <h1>Listado de activos</h1>
@stop

@section('content')
   <a href="activos/create" class="btn btn-primary mb-3">CREAR</a>

<table id="activos" class="table table-striped table-bordered shadow-lg mt-4" style="width:100%">
    <thead class="bg-primary text-white">
        <tr>
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
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($activos as $activo)
        <tr>
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
            <td>
                <a href="/activos/{{ $activo->id }}/edit" class="btn btn-info">
                    <i class="fas fa-pencil-alt"></i> Editar
                </a>
                <a href="{{ route('activos.historial', $activo->id) }}" class="btn btn-secondary">
                    <i class="fas fa-history"></i> Historial
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#activos').DataTable({
        "lengthMenu": [[5,10, 50, -1], [5, 10, 50, "All"]]
    });
});
</script>
@stop