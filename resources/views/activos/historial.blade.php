@extends('adminlte::page')

@section('title', 'ActivosTigo')

@section('content_header')
    <h1>HISTORIAL DE CAMBIOS</h1>
@stop

@section('content')

<table id="activos" class="table table-striped">
    <thead>
        <tr>
            <th>Campo</th>
            <th>Valor Anterior</th>
            <th>Valor Nuevo</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($dataHistorial as $cambio)
        <tr>
            <td>{{ $cambio['campo'] }}</td>
            <td>{{ $cambio['valor_anterior'] }}</td>
            <td>{{ $cambio['valor_nuevo'] }}</td>
            <td>{{ $cambio['fecha'] }}</td>
            <td>{{ $cambio['hora'] }}</td>
            <td>{{ $cambio['usuario'] }}</td>
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
        "lengthMenu": [[5,10, 50, -1], [5, 10, 50, "All"]],
        "language": {
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
        }
    });
});
</script>
@stop