<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log; // Aggiungi questo import per poter usare Log

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Percorso al file CSV nella stessa cartella del seeder
        $csvFile = __DIR__ . '/notes.csv';
        
        // Controlla se il file esiste
        if (!file_exists($csvFile)) {
            throw new \Exception("Il file CSV non esiste: $csvFile");
        }
        
        // Leggi il file CSV
        $csvData = array_map('str_getcsv', file($csvFile));
        
        // Rimuovi l'intestazione del CSV
        $header = array_shift($csvData);

        foreach ($csvData as $row) {
            // Verifica che il numero di colonne corrisponda a quello dell'intestazione
            if (count($row) == count($header)) {
                // Associa ogni riga del CSV con le intestazioni
                $noteData = array_combine($header, $row);

                // Crea una nuova Note usando i dati dal CSV
                Note::create([
                    'day_id' => $noteData['day_id'],
                    'user_id' => $noteData['user_id'],
                    'text' => $noteData['note'],
                ]);
            } else {
                // Log an error if the row does not match the header
                Log::warning("Riga CSV non valida: " . implode(",", $row));
            }
        }
    }
}
