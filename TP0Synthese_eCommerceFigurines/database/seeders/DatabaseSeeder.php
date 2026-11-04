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
        // pour utiliser mettre php artisan migrate:fresh --seed dans le terminal
        $this->call([
            CategorieSeeder::class,
            ClientSeeder::class,
            FigurineSeeder::class,
        ]);
    }
}
