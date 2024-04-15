<?php
namespace App\Http\Controllers;

use App\Http\Requests\LeadRequest;
use App\Models\Estado;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Retorna a view para exibir os leads novos (status 1) e confirma a exclusão de um lead.
     * @return \Illuminate\Contracts\View\View
     */
    public function novos()
    {
        $leads = Lead::with(['comentarios', 'comentarios.user'])->where('status', 1)->paginate(25);
        return view('leads.novos', compact('leads'));
    }
    /**
     * Retorna a view para exibir os leads interessados (status 2).
     * @return \Illuminate\Contracts\View\View
     */
    public function interessados()
    {
        $leads = Lead::with(['comentarios', 'comentarios.user'])->where('status', 2)->paginate(25);
        return view('leads.interessados', compact('leads'));
    }
    /**
     * Retorna a view para exibir os leads interessados (status 2).
     * @return \Illuminate\Contracts\View\View
     */
    public function naoInteressados()
    {
        $leads = Lead::with(['comentarios', 'comentarios.user'])->where('status', 3)->paginate(25);
        return view('leads.nao-interessados', compact('leads'));
    }
    public function funilDeVendas()
    {
        $leads_aguardando_proposta = Lead::with(['comentarios', 'comentarios.user'])->where('status', 4)->get();
        $leads_proposta_enviada = Lead::with(['comentarios', 'comentarios.user'])->where('status', 5)->get();
        $leads_aguardando_contrato = Lead::with(['comentarios', 'comentarios.user'])->where('status', 6)->get();
        $leads_contrato_enviado = Lead::with(['comentarios', 'comentarios.user'])->where('status', 7)->get();
        return view('leads.funil-de-vendas', compact('leads_aguardando_proposta', 'leads_proposta_enviada', 'leads_aguardando_contrato', 'leads_contrato_enviado'));
    }
    /**
     * Retorna a view para exibir o formulário de leads, com os estados para seleção.
     * @return \Illuminate\Contracts\View\View
     */
    public function cadastrar()
    {
        $estados = Estado::all();
        return view('leads.formulario', compact('estados'));
    }
    /**
     * Exibe o formulário para visualização e edição de um lead específico.
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function editar(int $id)
    {
        return view('leads.formulario', [
            'lead' => Lead::findOrFail($id),
            'estados' => Estado::all()
        ]);
    }
    /**
     * Salva um novo lead ou atualiza um lead existente com base nos dados fornecidos.
     * @param  \App\Http\Requests\LeadRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function salvar(LeadRequest $request)
    {
        $validated = $request->validated();
        $validated['id_estado'] = $validated['estado'] ?? null;
        $validated['id_cidade'] = $validated['cidade'] ?? null;
        unset($validated['estado']);
        unset($validated['cidade']);
        if ($request->has('id') && $request->filled('id')) {
            $lead = Lead::findOrFail($request->id);
            $lead->update($validated);
        } else {
            $lead = new Lead;
            $lead->fill($validated);
            $lead->save();
        }
        return redirect()->route('leads.novos');
    }
    /**
     * Move um lead para um novo status.
     * @param  int  $id
     * @param  int  $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mover(int $id, int $status)
    {
        $lead = Lead::findOrFail($id);
        $lead->status = $status;
        $lead->save();
        return redirect()->back();
    }
    public function excluir(int $id)
    {
        Lead::destroy($id);
        return redirect()->route('leads.novos');
    }
}
