<?php

namespace Database\Seeders;

use App\Models\StageImage;
use Illuminate\Database\Seeder;

class StageImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Percorso al file CSV nella stessa cartella del seeder
        $csvFile = __DIR__ . '/stage_images.csv';
        // Leggi il file CSV
        $csvData = array_map('str_getcsv', file($csvFile));

        // Rimuovi l'intestazione del CSV
        $header = array_shift($csvData);

        foreach ($csvData as $row) {
            // Verifica che il numero di colonne corrisponda a quello dell'intestazione
            if (count($row) == count($header)) {
                // Associa ogni riga del CSV con le intestazioni
                $imageData = array_combine($header, $row);

                // Crea un nuovo StageImage usando i dati dal CSV
                StageImage::create([
                    'stage_id' => $imageData['stage_id'],
                    'image_path' => $imageData['image_path'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                // Puoi loggare un errore o saltare la riga se il numero di colonne non corrisponde
                // Log::warning("Riga CSV non valida: " . implode(",", $row));
            }
        }
    }
}

