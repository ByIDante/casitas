<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyImageFactory extends Factory
{
    /**
     * Colección de URLs de imágenes de pisos realistas
     */
    protected $propertyImages = [
        // Interiores de pisos
        'https://images.unsplash.com/photo-1560448204-e02f11c3d0e2',
        'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688',
        'https://images.unsplash.com/photo-1556912172-45b7abe8b7e1',
        'https://images.unsplash.com/photo-1560448205-4d9b3e6bb6db',
        'https://images.unsplash.com/photo-1586105251261-72a756497a11',
        'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267',
        'https://images.unsplash.com/photo-1560185127-6ed189bf02f4',

        // Salones
        'https://images.unsplash.com/photo-1513694203232-719a280e022f',
        'https://images.unsplash.com/photo-1484101403633-562f891dc89a',
        'https://images.unsplash.com/photo-1598928506311-c55ded91a20c',

        // Dormitorios
        'https://images.unsplash.com/photo-1540518614846-7eded433c457',
        'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85',
        'https://images.unsplash.com/photo-1551516594-56cb78394645',

        // Cocinas
        'https://images.unsplash.com/photo-1556911220-bda9f33a8b1f',
        'https://images.unsplash.com/photo-1570739904862-d766fb3e9a43',
        'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136',

        // Baños
        'https://images.unsplash.com/photo-1584622650111-993a426fbf0a',
        'https://images.unsplash.com/photo-1507652313519-d4e9174996dd',
        'https://images.unsplash.com/photo-1600566752355-35792bedaef3',

        // Exteriores de edificios
        'https://images.unsplash.com/photo-1605276374104-dee2a0ed3cd6',
        'https://images.unsplash.com/photo-1460317442991-0ec209397118',
        'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab',

        // Terrazas y balcones
        'https://images.unsplash.com/photo-1580587771525-78b9dba3b914',
        'https://images.unsplash.com/photo-1600607687126-8a3414349a51',
        'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c',

        // Vistas panorámicas
        'https://images.unsplash.com/photo-1512917774080-9991f1c4c750',
        'https://images.unsplash.com/photo-1581279813180-4dddc1009583',
        'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3'
    ];

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        // Añade parámetros de calidad a las URLs de Unsplash
        $randomIndex = array_rand($this->propertyImages);
        $imageUrl = $this->propertyImages[$randomIndex] . '?auto=format&fit=crop&w=800&q=80';

        return [
            'property_id' => \App\Models\Property::factory(),  // Ajusta según tu modelo
            'path' => $imageUrl,
            'is_main' => false,
        ];
    }

    /**
     * Indicate that the image is the main image for the property.
     */
    public function main(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'is_main' => true,
            ];
        });
    }

    /**
     * Generate a specific category of images (bedroom, bathroom, kitchen, etc.)
     */
    public function ofType(string $type): static
    {
        $typeMap = [
            'interior' => [0, 1, 2, 3, 4, 5, 6],
            'living' => [7, 8, 9],
            'bedroom' => [10, 11, 12],
            'kitchen' => [13, 14, 15],
            'bathroom' => [16, 17, 18],
            'exterior' => [19, 20, 21],
            'terrace' => [22, 23, 24],
            'view' => [25, 26, 27],
        ];

        return $this->state(function (array $attributes) use ($type, $typeMap) {
            if (!isset($typeMap[$type])) {
                $randomIndex = array_rand($this->propertyImages);
            } else {
                $randomIndex = $this->faker->randomElement($typeMap[$type]);
            }

            $imageUrl = $this->propertyImages[$randomIndex] . '?auto=format&fit=crop&w=800&q=80';

            return [
                'path' => $imageUrl,
            ];
        });
    }
}
