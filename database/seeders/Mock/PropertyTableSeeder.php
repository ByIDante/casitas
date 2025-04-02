<?php

namespace Database\Seeders\Mock;

use App\Enums\UserRoleEnum;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyRating;
use App\Models\User;
use App\Models\PropertyImage;
use Illuminate\Database\Seeder;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los usuarios excepto el administrador
        $users = User::where('role', UserRoleEnum::USER->value)->get();

        // Obtener todas las características
        $features = Feature::all();

        // Crear propiedades para cada usuario
        foreach ($users as $user) {
            // Crear entre 2 y 5 propiedades por usuario
            $properties = Property::factory(rand(2, 5))->create([
                'user_id' => $user->id,
            ]);

            foreach ($properties as $property) {
                // Crear imágenes para cada propiedad
                $this->createPropertyImages($property);

                // Crear valoraciones para cada propiedad
                $this->createPropertyRatings($property, $users->where('id', '!=', $user->id));

                // Asignar características a la propiedad
                $this->assignFeaturesToProperty($property, $features);
            }
        }
    }

    /**
     * Crear imágenes para una propiedad.
     */
    private function createPropertyImages(Property $property): void
    {
        // Crear entre 1 y 3 imágenes por propiedad
        $images = PropertyImage::factory(rand(1, 3))->create([
            'property_id' => $property->id,
        ]);

        // Marcar la primera imagen como principal
        $images->first()->update(['is_main' => true]);
    }

    /**
     * Crear valoraciones para una propiedad.
     */
    private function createPropertyRatings(Property $property, $users): void
    {
        // Seleccionar entre 1 y 3 usuarios aleatorios para valorar la propiedad
        $reviewers = $users->random(rand(1, min(3, $users->count())));

        foreach ($reviewers as $user) {
            PropertyRating::create([
                'property_id' => $property->id,
                'user_id' => $user->id,
                'rating' => rand(1, 5),
                'comment' => $this->getRandomComment(),
            ]);
        }
    }

    /**
     * Asignar características a una propiedad.
     */
    private function assignFeaturesToProperty(Property $property, $features): void
    {
        // Seleccionar entre 2 y 5 características aleatorias
        $randomFeatures = $features->random(rand(2, 5));

        // Asignar las características a la propiedad
        $property->features()->attach($randomFeatures);
    }

    /**
     * Obtener un comentario aleatorio para una valoración.
     */
    private function getRandomComment(): string
    {
        $comments = [
            'Excelente propiedad, muy recomendable.',
            'Buena ubicación y precio razonable.',
            'La propiedad cumple con las expectativas.',
            'Podría mejorar en algunos aspectos.',
            'La zona es tranquila y segura.',
            'Me encantó el diseño interior.',
            'Las fotos no hacen justicia al lugar.',
            'Buena atención por parte del propietario.',
        ];

        return $comments[array_rand($comments)];
    }
}
