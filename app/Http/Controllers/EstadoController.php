<?php
namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function getEstadoPorSigla($siglaEstado)
    {
        $estado = Estado::where('sigla', $siglaEstado)->first();
        return response()->json($estado);
    }
}
