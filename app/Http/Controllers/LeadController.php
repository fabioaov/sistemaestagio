<?php
namespace App\Http\Controllers;

use App\Http\Requests\LeadRequest;
use App\Models\Estado;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Retorna a view para exibir os leads novos (status 1) e confirma a exclusão de um lead.
     * @return \Illuminate\Contracts\View\View
     */
    public function novos()
    {
        $leads = Lead::with(['comentarios', 'comentarios.user'])->where('status', 1)->paginate(25);
        $usuarios = User::where('modulo', 2)->get();
        return view('leads.novos', compact('leads', 'usuarios'));
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
    /**
     * Retorna a view para exibir o funil de vendas, dividindo os leads em diferentes estágios.
     * @return \Illuminate\Contracts\View\View
     */
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
     * @param int $idLead
     * @return \Illuminate\Contracts\View\View
     */
    public function editar(int $idLead)
    {
        return view('leads.formulario', [
            'lead' => Lead::findOrFail($idLead),
            'estados' => Estado::all()
        ]);
    }
    /**
     * Salva um novo lead ou atualiza um lead existente com base nos dados fornecidos.
     * @param \App\Http\Requests\LeadRequest $request
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
     * @param int $idLead
     * @param int $status
     * @return \Illuminate\Http\RedirectResponse
     */
    public function mover(int $idLead, int $status)
    {
        $lead = Lead::findOrFail($idLead);
        if ($status === 4 && (is_null($lead->cnpj) || (is_null($lead->razao_social) && is_null($lead->nome_fantasia)) || is_null($lead->email))) {
            return redirect()->back()->with('error', 'O lead deve possuir CNPJ, RAZÃO SOCIAL ou NOME FANTASIA e E-MAIL para ser movido para o funil de vendas.');
        }
        $lead->status = $status;
        $lead->save();
        return redirect()->back();
    }
    /**
     * Vincula um usuário responsável ao lead.
     * @param int $idLead
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vincularResponsavel(int $idLead, Request $request)
    {
        $request->validate([
            'responsavel' => ['nullable', 'exists:users,id'],
        ]);
        $lead = Lead::findOrFail($idLead);
        $lead->id_user = $request->responsavel;
        $lead->save();
        return redirect()->back();
    }
    /**
     * Exclui um lead do banco de dados.
     * @param int $idLead
     * @return \Illuminate\Http\RedirectResponse
     */
    public function excluir(int $idLead)
    {
        Lead::destroy($idLead);
        return redirect()->route('leads.novos');
    }
}
