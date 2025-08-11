<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('unidades');
        Storage::makeDirectory('unidades');
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'test@test.com',
            'password' => '12345',
            'tipo' => 1,
        ]);
    }
}
