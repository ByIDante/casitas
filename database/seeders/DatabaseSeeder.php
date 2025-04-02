<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Seeders\Mock\FeatureTableSeeder;
use Database\Seeders\Mock\PropertyRatingTableSeeder;
use Database\Seeders\Mock\PropertyTableSeeder;
use Database\Seeders\Mock\UserTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run base seeders
        $this->call([
            UserTableSeeder::class,
            FeatureTableSeeder::class,
            PropertyTableSeeder::class,
            PropertyRatingTableSeeder::class
        ]);
    }
}
