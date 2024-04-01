<?php
namespace App\Http\Controllers;

use App\Http\Requests\LeadRequest;
use App\Models\Estado;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leads = Lead::paginate(25);
        return view('leads.novos', compact('leads'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estados = Estado::all();
        return view('leads.form', compact('estados'));
    }
    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return view('leads.form', [
            'lead' => Lead::findOrFail($id),
            'estados' => Estado::all()
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
