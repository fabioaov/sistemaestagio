<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Comentario;

class ComentarioController extends Controller
{
    /**
     * Insere um novo comentário para um lead existente.
     * @param int $idLead
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function inserir(int $idLead, Request $request)
    {
        $validated = $request->validate([
            'comentario' => 'required',
        ]);
        $comentario = new Comentario;
        $comentario->fill($validated);
        $comentario->id_lead = $idLead;
        $comentario->id_user = Auth::user()->id;
        $comentario->save();
        return redirect()->back();
    }
}
