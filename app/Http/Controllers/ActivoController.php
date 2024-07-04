<?php

namespace App\Http\Controllers;
use App\Models\Activo;
use App\Models\Historial;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ActivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activos = Activo::all();
        return view('activos.index')->with('activos',$activos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'sys' => 'required|unique:activos,sys',
            'atn' => 'required',
            'nombre' => 'required',
            'marca' => 'required',
            // Agrega aquí el resto de los campos que necesites validar
        ], [
            'sys.unique' => 'El sys ya existe',
        ]);

        $activos = new Activo();
        
        $activos->sys = $request->get('sys');
        $activos->atn = $request->get('atn');
        $activos->nombre = $request->get('nombre');
        $activos->marca = $request->get('marca');
        $activos->modelo = $request->get('modelo');
        $activos->serial = $request->get('serial');
        $activos->codactivo = $request->get('codactivo');
        $activos->estado = $request->get('estado');
        $activos->usuario = $request->get('usuario');
        $activos->area = $request->get('area');
        $activos->sucursal = $request->get('sucursal');
        $activos->ciudad = $request->get('ciudad');
        $activos->observacion = $request->get('observacion');
        

        $activos->save();

        return redirect('/activos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $activo = Activo::find($id);
        return view('activos.edit')->with('activo',$activo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $activo = Activo::findOrFail($id);
    $original = $activo->getAttributes();

    $request->validate([
        'sys' => [
            'required',
            Rule::unique('activos')->ignore($activo->id),
        ],
        'atn' => 'required',
        'nombre' => 'required',
        'marca' => 'required',
        // Agrega aquí el resto de los campos que necesites validar
    ], [
        'sys.unique' => 'El sys ya existe',
    ]);

    // Comparar valores originales con los nuevos y guardar en historial
    $cambios = [];
    foreach ($request->all() as $campo => $valorNuevo) {
        $valorAnterior = $original[$campo] ?? null;

        if ($valorNuevo != $valorAnterior) {
            $cambios[$campo] = [
                'valor_anterior' => $valorAnterior,
                'valor_nuevo' => $valorNuevo,
            ];
        }
    }

    if (!empty($cambios)) {
        // Guardar cambios en historial si hay modificaciones
        Historial::create([
            'activo_id' => $activo->id,
            'cambios' => json_encode($cambios), // Convertir array a JSON antes de guardar en la base de datos
        ]);
    }

    // Actualizar el activo con los nuevos datos
    $activo->update($request->only($activo->getFillable()));

    // Redirigir al usuario a la lista de activos (index)
    return redirect()->route('activos.index')->with('success', 'Activo actualizado correctamente.');
}

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$activo = Activo::find($id);
        $articulo->delete();
        return redirect('/articulos');*/
    }

    public function historial($id, \Illuminate\Contracts\Auth\Authenticatable $user)
{
    $historiales = Historial::where('activo_id', $id)
                            ->orderByDesc('created_at')
                            ->get();

    $dataHistorial = [];
    foreach ($historiales as $historial) {
        $cambios = json_decode($historial->cambios, true);
        $createdAt = new \DateTime($historial->created_at->toDateTimeString());

        // Convertir la hora a la zona horaria de Bolivia
        $timezone = new \DateTimeZone('America/La_Paz');
        $createdAt->setTimezone($timezone);

        foreach ($cambios as $campo => $cambio) {
            if ($campo !== '_token' && $campo !== '_method') {
                $dataHistorial[] = [
                    'campo' => $campo,
                    'valor_anterior' => $cambio['valor_anterior'],
                    'valor_nuevo' => $cambio['valor_nuevo'],
                    'fecha' => $createdAt->format('Y-m-d'),
                    'hora' => $createdAt->format('H:i:s'),
                    'usuario' => $user->name // o $user->id, dependiendo de lo que necesites
                ];
            }
        }
    }

    return view('activos.historial', compact('dataHistorial', 'user'));
}

public function baja($id)
    {
        return view('activo.bajas');
    }


}
