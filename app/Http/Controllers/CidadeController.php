<?php
namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    public function getCidadesPorEstado($idEstado)
    {
        $cidades = Cidade::where('id_estado', $idEstado)->get();
        return response()->json($cidades);
    }

    public function getCidadePorNome($nomeCidade)
    {
        $cidade = Cidade::where('nome', $nomeCidade)->first();
        return response()->json($cidade);
    }
}
