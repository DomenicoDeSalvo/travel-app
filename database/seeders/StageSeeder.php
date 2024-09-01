<?php

namespace Database\Seeders;

use App\Models\Stage;
use Illuminate\Database\Seeder;

class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Percorso al file CSV nella stessa cartella del seeder
        $csvFile = __DIR__ . '/stages.csv';
        // Leggi il file CSV
        $csvData = array_map('str_getcsv', file($csvFile));
        
        // Rimuovi l'intestazione del CSV
        $header = array_shift($csvData);

        foreach ($csvData as $row) {
            // Verifica che il numero di colonne corrisponda a quello dell'intestazione
            if (count($row) == count($header)) {
                // Associa ogni riga del CSV con le intestazioni
                $stageData = array_combine($header, $row);

                // Crea un nuovo Stage usando i dati dal CSV
                Stage::create([
                    'day_id' => $stageData['day_id'],
                    'user_id' => $stageData['user_id'],
                    'mood_id' => $stageData['mood_id'] ?: null, // Se mood_id è vuoto, imposta a null
                    'title' => $stageData['title'],
                    'description' => $stageData['description'],
                ]);
            } else {
                // Puoi loggare un errore o saltare la riga se il numero di colonne non corrisponde
                // Log::warning("Riga CSV non valida: " . implode(",", $row));
            }
        }
    }
}
