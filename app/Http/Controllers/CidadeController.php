<?php
namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    /**
     * Obtém todas as cidades pertencentes a um estado específico.
     * @param int $idEstado O ID do estado para o qual buscar cidades.
     * @return mixed|\Illuminate\Http\JsonResponse Um objeto JSON contendo as cidades encontradas.
     */
    public function getCidadesPorIdEstado(int $idEstado)
    {
        $cidades = Cidade::where('id_estado', $idEstado)->get();
        return response()->json($cidades);
    }
    /**
     * Obtém o ID de uma cidade pelo nome da cidade e a sigla do estado.
     * @param string $nomeCidade O nome da cidade a ser buscada.
     * @param string $siglaEstado A sigla do estado ao qual a cidade pertence.
     * @return mixed|\Illuminate\Http\JsonResponse Um objeto JSON contendo o ID da cidade encontrada.
     */
    public function getIdCidadePorNomeESiglaEstado(string $nomeCidade, string $siglaEstado)
    {
        $idEstado = Estado::where('sigla', $siglaEstado)->pluck('id')->first();
        $idCidade = Cidade::where('nome', $nomeCidade)->where('id_estado', $idEstado)->pluck('id')->first();
        return response()->json($idCidade);
    }
}
