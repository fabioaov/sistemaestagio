<?php
namespace App\Http\Controllers;

use App\Http\Requests\LeadRequest;
use App\Models\Estado;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Exibe a página inicial de leads, listando os leads paginados.
     * Antes de exibir a página, exibe um diálogo de confirmação para excluir um lead.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $leads = Lead::where('status', '>', 0)->paginate(25);
        $titulo = "Excluir lead";
        $texto = "Tem certeza que deseja excluir este lead?";
        confirmDelete($titulo, $texto);
        return view('leads.novos', compact('leads'));
    }
    /**
     * Exibe o formulário de criação de um novo lead.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $estados = Estado::all();
        return view('leads.form', compact('estados'));
    }
    /**
     * Armazena um novo lead no banco de dados ou atualiza um lead existente.
     * @param  \App\Http\Requests\LeadRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LeadRequest $request)
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
        return redirect()->route('leads.index');
    }
    /**
     * Exibe os detalhes de um lead específico.
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(int $id)
    {
        return view('leads.form', [
            'lead' => Lead::findOrFail($id),
            'estados' => Estado::all()
        ]);
    }
    /**
     * Remove um lead do banco de dados.
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id)
    {
        Lead::destroy($id);
        return redirect()->route('leads.index');
    }
}
