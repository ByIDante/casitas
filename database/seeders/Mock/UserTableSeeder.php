<?php

declare(strict_types=1);

namespace Database\Seeders\Mock;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run(): void
    {
        // Crear un usuario administrador
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@example.com',
            'role' => UserRoleEnum::ADMIN->value,
            'password' => Hash::make('password'),
        ]);

        // Crear un usuario regular para pruebas
        User::factory()->create([
            'name' => 'Usuario',
            'email' => 'user@example.com',
            'role' => UserRoleEnum::USER->value,
            'password' => Hash::make('password'),
        ]);

        // Crear usuarios adicionales
        User::factory()->count(8)->create();
    }
}
