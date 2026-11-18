<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // Admins (equipe): recebem as recomendações do formulário de contato. Senha: password
        foreach (['Antonio Sena', 'Arthur Gutemberg', 'Beatriz Galdino', 'Giovanna Torres'] as $name) {
            User::factory()->admin()->create([
                'name' => $name,
                'email' => strtolower(strtok($name, ' ')).'@lumin.test',
            ]);
        }
    }
}
