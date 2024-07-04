@extends('adminlte::page')

@section('title', 'ActivosTigo')

@section('content_header')
    <h1>Crear Activo</h1>
@stop

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<form action="/activos" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="sys" class="form-label">Sys</label>
                <input id="sys" name="sys" type="text" class="form-control form-control-lg" tabindex="1" value="">
                @error('sys')
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2" viewBox="0 0 16 16" role="img" aria-label="Warning:">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                  </svg>
                  <div>
                    El sys introducido ya existe!
                  </div>
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="atn" class="form-label">Atn</label>
                <input id="atn" name="atn" type="number" class="form-control form-control-lg" tabindex="2" value="{{ old('atn') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input id="nombre" name="nombre" type="text" class="form-control form-control-lg" tabindex="3" value="{{ old('nombre') }}">
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input id="marca" name="marca" type="text" class="form-control form-control-lg" tabindex="4" value="{{ old('marca') }}">
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input id="modelo" name="modelo" type="text" class="form-control form-control-lg" tabindex="5" value="{{ old('modelo') }}">
            </div>
            <div class="mb-3">
                <label for="serial" class="form-label">Serial</label>
                <input id="serial" name="serial" type="text" class="form-control form-control-lg" tabindex="6" value="{{ old('serial') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="codactivo" class="form-label">CodActivo</label>
                <input id="codactivo" name="codactivo" type="text" class="form-control form-control-lg" tabindex="7" value="{{ old('codactivo') }}">
            </div>
        </div>
        <div class="col-md-4">
            <label for="estado" class="form-label">Estado</label>
            <div class="form-floating">
                <select class="form-select" id="estado" name="estado" aria-label="Floating label select example">
                    <option value="" selected></option>
                    <option value="ASIGNACION" {{ old('estado') == 'ASIGNACION' ? 'selected' : '' }}>ASIGNACION</option>
                    <option value="DEVOLUCION" {{ old('estado') == 'DEVOLUCION' ? 'selected' : '' }}>DEVOLUCION</option>
                    <option value="REASIGNACION" {{ old('estado') == 'REASIGNACION' ? 'selected' : '' }}>REASIGNACION</option>
                    <option value="BAJA" {{ old('estado') == 'BAJA' ? 'selected' : '' }}>BAJA</option>
                    <option value="PRESTAMO" {{ old('estado') == 'PRESTAMO' ? 'selected' : '' }}>PRESTAMO</option>
                    <option value="PERDIDA" {{ old('estado') == 'PERDIDA' ? 'selected' : '' }}>PÉRDIDA</option>
                </select>
                <label for="estado">Selecciona una opción</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input id="usuario" name="usuario" type="text" class="form-control form-control-lg" tabindex="9" value="{{ old('usuario') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label for="area" class="form-label">AREA</label>
                <div class="form-floating">
                    <select class="form-select" id="area" name="area" aria-label="Floating label select example">
                        <option value="" selected></option>
                        <option value="SAC" {{ old('area') == 'SAC' ? 'selected' : '' }}>SAC</option>
                        <option value="G2M" {{ old('area') == 'G2M' ? 'selected' : '' }}>G2M</option>
                        <option value="B2B" {{ old('area') == 'B2B' ? 'selected' : '' }}>B2B</option>
                        <option value="B2C" {{ old('area') == 'B2C' ? 'selected' : '' }}>B2C</option>
                        <option value="COR" {{ old('area') == 'COR' ? 'selected' : '' }}>COR</option>
                        <option value="TF" {{ old('area') == 'TF' ? 'selected' : '' }}>TF</option>
                        <option value="DIS" {{ old('area') == 'DIS' ? 'selected' : '' }}>DIS</option>
                        <option value="RH" {{ old('area') == 'RH' ? 'selected' : '' }}>RH</option>
                        <option value="HOM" {{ old('area') == 'HOM' ? 'selected' : '' }}>HOM</option>
                        <option value="VENTAS" {{ old('area') == 'VENTAS' ? 'selected' : '' }}>VENTAS</option>
                        <option value="LEG" {{ old('area') == 'LEG' ? 'selected' : '' }}>LEG</option>
                        <option value="ACT" {{ old('area') == 'ACT' ? 'selected' : '' }}>ACT</option>
                        <option value="RSK" {{ old('area') == 'RSK' ? 'selected' : '' }}>RSK</option>
                        <option value="FCC" {{ old('area') == 'FCC' ? 'selected' : '' }}>FCC</option>
                        <option value="MFC" {{ old('area') == 'MFC' ? 'selected' : '' }}>MFC</option>
                        <option value="OTRO" {{ old('area') == 'OTRO' ? 'selected' : '' }}>OTRO</option>
                    </select>
                    <label for="area">Selecciona una opción</label>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="ciudad" class="form-label">Ciudad</label>
                <div class="form-floating">
                    <select class="form-select" id="ciudad" name="ciudad" aria-label="Floating label select example">
                        <option value="" selected></option>
                        <option value="LA PAZ" {{ old('ciudad') == 'LA PAZ' ? 'selected' : '' }}>LA PAZ</option>
                        <option value="ORURO" {{ old('ciudad') == 'ORURO' ? 'selected' : '' }}>ORURO</option>
                        <option value="POTOSI" {{ old('ciudad') == 'POTOSI' ? 'selected' : '' }}>POTOSI</option>
                        <option value="SANTA CRUZ" {{ old('ciudad') == 'SANTA CRUZ' ? 'selected' : '' }}>SANTA CRUZ</option>
                        <option value="BENI" {{ old('ciudad') == 'BENI' ? 'selected' : '' }}>BENI</option>
                        <option value="PANDO" {{ old('ciudad') == 'PANDO' ? 'selected' : '' }}>PANDO</option>
                        <option value="COCHABAMBA" {{ old('ciudad') == 'COCHABAMBA' ? 'selected' : '' }}>COCHABAMBA</option>
                        <option value="SUCRE" {{ old('ciudad') == 'SUCRE' ? 'selected' : '' }}>SUCRE</option>
                        <option value="TARIJA" {{ old('ciudad') == 'TARIJA' ? 'selected' : '' }}>TARIJA</option>
                    </select>
                    <label for="ciudad">Selecciona una opción</label>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="sucursal" class="form-label">Sucursal</label>
                <input id="sucursal" name="sucursal" type="text" class="form-control form-control-lg" tabindex="10" value="{{ old('sucursal') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="observacion" class="form-label">Observacion</label>
                <textarea id="observacion" name="observacion" class="form-control form-control-lg" rows="4" tabindex="11">{{ old('observacion') }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="/activos" class="btn btn-secondary" tabindex="12">Cancelar</a>
            <button type="submit" class="btn btn-primary" tabindex="13">Guardar</button>
        </div>
    </div>
</form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')  
@stop
