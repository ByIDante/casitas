<?php

namespace Database\Seeders\Mock;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            ['name' => 'Piscina', 'description' => 'Piscina privada o comunitaria.'],
            ['name' => 'Jardín', 'description' => 'Jardín privado o compartido.'],
            ['name' => 'Terraza', 'description' => 'Terraza con vistas.'],
            ['name' => 'Garaje', 'description' => 'Plaza de garaje incluida.'],
            ['name' => 'Aire acondicionado', 'description' => 'Sistema de climatización.'],
            ['name' => 'Ascensor', 'description' => 'Edificio con ascensor.'],
            ['name' => 'Amueblado', 'description' => 'Propiedad completamente amueblada.'],
            ['name' => 'Cerca del transporte público', 'description' => 'Ubicación cercana a estaciones de transporte público.'],
        ];

        foreach ($features as $feature) {
            Feature::create($feature);
        }
    }
}
