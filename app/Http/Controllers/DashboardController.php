<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Collection;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        // Inicializar properties como colección vacía por defecto
        $properties = new Collection();

        // Obtener las propiedades del usuario autenticado si existe el modelo Property
        if (class_exists('App\Models\Property')) {
            $properties = Property::where('user_id', $user->id)->get();
        }

        // Valores simplificados para estadísticas
        $activeBookings = 0;
        $totalIncome = '0€';

        return view('dashboard', compact('properties', 'activeBookings', 'totalIncome'));
    }
}
