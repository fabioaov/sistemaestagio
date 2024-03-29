<?php
namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;

class EstadoController extends Controller
{
    /**
     * Obtém o ID de um estado a partir da sigla.
     * @param string $siglaEstado A sigla do estado.
     * @return mixed|\Illuminate\Http\JsonResponse Um objeto JSON contendo o ID do estado encontrado.
     */
    public function getIdEstadoPorSigla(string $siglaEstado)
    {
        $idEstado = Estado::where('sigla', $siglaEstado)->pluck('id')->first();
        return response()->json($idEstado);
    }
}
