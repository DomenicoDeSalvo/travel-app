<?php

namespace Database\Seeders;

use App\Models\Day;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Percorso al file CSV nella stessa cartella del seeder
        $csvFile = __DIR__ . '/days.csv';
        // Leggi il file CSV
        $csvData = array_map('str_getcsv', file($csvFile));
        
        // Rimuovi l'intestazione del CSV
        $header = array_shift($csvData);

        foreach ($csvData as $row) {
            // Verifica che il numero di colonne corrisponda a quello dell'intestazione
            if (count($row) == count($header)) {
                // Associa ogni riga del CSV con le intestazioni
                $dayData = array_combine($header, $row);

                // Crea un nuovo Day usando i dati dal CSV
                Day::create([
                    'trip_id' => $dayData['trip_id'],
                    'user_id' => $dayData['user_id'],
                    'mood_id' => $dayData['mood_id'] ?: null, // Se mood_id è vuoto, imposta a null
                    'title' => $dayData['title'],
                    'date' => $dayData['date'],
                    'description' => $dayData['description'],
                ]);
            } else {
                // Puoi loggare un errore o saltare la riga se il numero di colonne non corrisponde
                // Log::warning("Riga CSV non valida: " . implode(",", $row));
            }
        }
    }
}
