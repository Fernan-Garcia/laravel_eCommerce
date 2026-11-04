<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // insertion des données dans la table categories
        DB::table('categories')->insert([
            ['id' => 1, 'nom' => 'DC Comics'],
            ['id' => 2, 'nom' => 'Frieren: Beyond Journey\'s End'],
            ['id' => 3, 'nom' => 'Marvel Studios'],
            ['id' => 4, 'nom' => 'Pokemon'],
            ['id' => 5, 'nom' => 'Warhammer 40K'],
            ['id' => 6, 'nom' => 'Warhammer Fantasy'],
        ]);
    }
}
