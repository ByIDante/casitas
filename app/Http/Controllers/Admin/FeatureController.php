<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FeatureController extends Controller
{
    /**
     * Muestra un listado de todas las características.
     */
    public function index(): View
    {
        $features = Feature::all();
        
        return view('admin.features.index', compact('features'));
    }

    /**
     * Muestra el formulario para crear una nueva característica.
     */
    public function create(): View
    {
        return view('admin.features.create');
    }

    /**
     * Almacena una nueva característica en la base de datos.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:features',
            'description' => 'nullable|string',
        ]);

        Feature::create($validated);
        
        return redirect()
            ->route('admin.features.index')
            ->with('success', 'Característica creada correctamente');
    }

    /**
     * Muestra el formulario para editar una característica.
     */
    public function edit(Feature $feature): View
    {
        return view('admin.features.edit', compact('feature'));
    }

    /**
     * Actualiza una característica en la base de datos.
     */
    public function update(Request $request, Feature $feature): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:features,name,' . $feature->id,
            'description' => 'nullable|string',
        ]);

        $feature->update($validated);
        
        return redirect()
            ->route('admin.features.index')
            ->with('success', 'Característica actualizada correctamente');
    }

    /**
     * Elimina una característica de la base de datos.
     */
    public function destroy(Feature $feature): RedirectResponse
    {
        $feature->delete();
        
        return redirect()
            ->route('admin.features.index')
            ->with('success', 'Característica eliminada correctamente');
    }
}
