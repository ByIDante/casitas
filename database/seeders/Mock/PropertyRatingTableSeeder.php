<?php

declare(strict_types=1);

namespace Database\Seeders\Mock;

use App\Enums\UserRoleEnum;
use App\Models\Property;
use App\Models\PropertyRating;
use App\Models\User;
use Illuminate\Database\Seeder;

class PropertyRatingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $users = User::where('role', UserRoleEnum::USER->value)->get();
        $properties = Property::all();

        foreach ($properties as $property) {
            // Filtrar usuarios para evitar que el propietario valore su propia propiedad
            $potentialReviewers = $users->filter(function ($user) use ($property) {
                return $user->id !== $property->user_id;
            });

            // Seleccionar algunos usuarios aleatoriamente para valorar
            $reviewers = $potentialReviewers->random(min(3, count($potentialReviewers)));
            
            foreach ($reviewers as $user) {
                PropertyRating::create([
                    'user_id' => $user->id,
                    'property_id' => $property->id,
                    'rating' => rand(1, 5),
                    'comment' => $this->getRandomComment(),
                ]);
            }
        }
    }

    /**
     * Obtener un comentario aleatorio para una valoración.
     *
     * @return string
     */
    private function getRandomComment(): string
    {
        $comments = [
            'Muy buena propiedad, recomendable.',
            'La ubicación es perfecta.',
            'Buena relación calidad-precio.',
            'Las fotos no hacen justicia al lugar.',
            'Justo lo que estaba buscando.',
            'Podría mejorar en algunos aspectos.',
            'Excelente atención por parte del propietario.',
            'La zona es tranquila y segura.',
            'Las instalaciones están muy bien mantenidas.',
            'Me encantó el diseño interior.',
        ];

        return $comments[array_rand($comments)];
    }
}
