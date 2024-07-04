<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historial;


class HistorialController extends Controller
{
    public function showHistorial($activoId)
{
    $historial = Historial::where('activo_id', $activoId)->get();
    return view('activos.historial', compact('historial', 'activoId'));
}
}