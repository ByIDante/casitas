<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Feature;
use App\Models\Property;
use App\Services\PropertyImageService;
use App\Services\PropertyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PropertyController extends Controller
{
    protected PropertyService $propertyService;
    protected PropertyImageService $imageService;

    public function __construct(
        PropertyService $propertyService,
        PropertyImageService $imageService
    ) {
        $this->propertyService = $propertyService;
        $this->imageService = $imageService;
    }

    /**
     * Muestra un listado de todas las propiedades.
     */
    public function index(): View
    {
        $properties = Property::with(['user', 'images'])
            ->latest()
            ->paginate(15);
        
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Muestra una propiedad específica.
     */
    public function show(Property $property): View
    {
        $property->load(['images', 'user', 'ratings.user', 'features']);
        
        return view('admin.properties.show', compact('property'));
    }

    /**
     * Muestra el formulario para editar una propiedad.
     */
    public function edit(Property $property): View
    {
        $features = Feature::all();
        return view('admin.properties.edit', compact('property', 'features'));
    }

    /**
     * Actualiza una propiedad en la base de datos.
     */
    public function update(UpdatePropertyRequest $request, Property $property): RedirectResponse
    {
        $this->propertyService->update($property, $request->validated());

        if ($request->hasFile('images')) {
            $this->imageService->storeImages($property, $request->file('images'));
        }

        return redirect()
            ->route('admin.properties.show', $property)
            ->with('success', 'Propiedad actualizada correctamente');
    }

    /**
     * Elimina una propiedad de la base de datos.
     */
    public function destroy(Property $property): RedirectResponse
    {
        $this->propertyService->delete($property);

        return redirect()
            ->route('admin.properties.index')
            ->with('success', 'Propiedad eliminada correctamente');
    }
}
