<?php

namespace App\Http\Controllers;

use App\Enums\PropertyStatusEnum;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Feature;
use App\Models\Property;
use App\Services\PropertyImageService;
use App\Services\PropertyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
        $this->authorizeResource(Property::class, 'property', [
            'except' => ['index', 'show'],
        ]);
    }

    /**
     * Muestra un listado de propiedades disponibles.
     */
    public function index(): View
    {
        $properties = Property::with(['images', 'user', 'ratings'])
            ->where('status', PropertyStatusEnum::AVAILABLE)
            ->latest()
            ->paginate(12);

        return view('properties.index', compact('properties'));
    }

    /**
     * Muestra el formulario para crear una nueva propiedad.
     */
    public function create(): View
    {
        $features = Feature::all();
        return view('properties.create', compact('features'));
    }

    /**
     * Almacena una nueva propiedad en la base de datos.
     */
    public function store(StorePropertyRequest $request): RedirectResponse
    {
        $property = $this->propertyService->create($request->validated());
        if ($request->hasFile('images')) {
            $this->imageService->storeImages($property, $request->file('images'));
        }

        return redirect()
            ->route('properties.show', $property)
            ->with('success', 'Propiedad creada correctamente');
    }

    /**
     * Muestra una propiedad específica.
     */
    public function show(Property $property): View
    {
        $property->load(['images', 'user', 'ratings.user', 'features']);

        return view('properties.show', compact('property'));
    }

    /**
     * Muestra el formulario para editar una propiedad.
     */
    public function edit(Property $property): View
    {
        $features = Feature::all();
        return view('properties.edit', compact('property', 'features'));
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
            ->route('properties.show', $property)
            ->with('success', 'Propiedad actualizada correctamente');
    }

    /**
     * Elimina una propiedad de la base de datos.
     */
    public function destroy(Property $property): RedirectResponse
    {
        $this->propertyService->delete($property);

        return redirect()
            ->route('properties.index')
            ->with('success', 'Propiedad eliminada correctamente');
    }

    /**
     * Muestra las propiedades del usuario autenticado.
     */
    public function myProperties(): View
    {
        $properties = Property::where('user_id', Auth::id())
            ->with(['images'])
            ->latest()
            ->paginate(12);

        return view('properties.my-properties', compact('properties'));
    }
}
