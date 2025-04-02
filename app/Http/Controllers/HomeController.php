<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Muestra la página principal con las propiedades destacadas.
     */
    public function index(): View
    {
        $featuredProperties = Property::with(['images', 'user', 'ratings'])
            ->where('status', 'available')
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredProperties'));
    }
}
