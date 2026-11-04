<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * contenu des tables générés par ChatGPT
     */
    public function run(): void
    {
        DB::table('clients')->insert([
            [
                'id' => 1,
                'email' => 'john.doe@email.com',
                'nom' => 'Doe',
                'prenom' => 'John',
                'password' => Hash::make('password123'),
                'adresse' => '123 Rue Sainte-Catherine',
                'ville' => 'Montréal',
                'codePostal' => 'H2X 1Y4',
                'province' => 'QC',
                'telephone' => '514-555-1234',
                'is_admin' => false
            ],
            [
                'id' => 2,
                'email' => 'jane.smith@email.com',
                'nom' => 'Smith',
                'prenom' => 'Jane',
                'password' => Hash::make('password123'),
                'adresse' => '456 Avenue du Parc',
                'ville' => 'Montréal',
                'codePostal' => 'H2V 4G7',
                'province' => 'QC',
                'telephone' => '514-555-5678',
                'is_admin' => false
            ],
            [
                'id' => 3,
                'email' => 'mike.johnson@email.com',
                'nom' => 'Johnson',
                'prenom' => 'Mike',
                'password' => Hash::make('password123'),
                'adresse' => '789 Boulevard Saint-Laurent',
                'ville' => 'Montréal',
                'codePostal' => 'H2Y 2Y5',
                'province' => 'QC',
                'telephone' => '514-555-9012',
                'is_admin' => false
            ],
            [
                'id' => 4,
                'email' => 'emily.davis@email.com',
                'nom' => 'Davis',
                'prenom' => 'Emily',
                'password' => Hash::make('password123'),
                'adresse' => '321 Rue Sherbrooke O',
                'ville' => 'Montréal',
                'codePostal' => 'H3A 1B2',
                'province' => 'QC',
                'telephone' => '514-555-3456',
                'is_admin' => false
            ],
            [
                'id' => 5,
                'email' => 'alex.brown@email.com',
                'nom' => 'Brown',
                'prenom' => 'Alex',
                'password' => Hash::make('password123'),
                'adresse' => '654 Rue Jean-Talon E',
                'ville' => 'Montréal',
                'codePostal' => 'H2R 1S7',
                'province' => 'QC',
                'telephone' => '514-555-7890',
                'is_admin' => false
            ],
            [
                'id' => 6,
                'email' => 'admin@cstj.qc.ca',
                'nom' => 'Admin',
                'prenom' => 'Admin',
                'password' => Hash::make('webH2026'),
                'adresse' => 'Admin Address',
                'ville' => 'Admin',
                'codePostal' => 'H2R 1S7',
                'province' => 'QC',
                'telephone' => '514-555-7890',
                'is_admin' => true
            ]
        ]);
    }
}
