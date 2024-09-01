<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Percorso al file CSV nella stessa cartella del seeder
        $csvFile = __DIR__ . '/trips.csv';
        // Leggi il file CSV
        $csvData = array_map('str_getcsv', file($csvFile));
        
        // Rimuovi l'intestazione del CSV
        $header = array_shift($csvData);

        foreach ($csvData as $row) {
            // Associa ogni riga del CSV con le intestazioni
            $tripData = array_combine($header, $row);

            // Crea un nuovo Trip usando i dati dal CSV
            Trip::create([
                'user_id' => $tripData['user_id'],
                'location' => $tripData['location'],
                'description' => $tripData['description'],
                'start_date' => $tripData['start_date'],
                'end_date' => $tripData['end_date'] ?: null, // Se end_date è vuoto, imposta a null
            ]);
        }
    }
}
