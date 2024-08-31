<?php

namespace Database\Seeders;

use App\Models\Mood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moods = ['Felice','Triste','Entusiasta','Annoiato/a','Arrabbiato/a','Divertito/a'];

        foreach ($moods as $mood) {
            $new_mood = new Mood();

            $new_mood->name = $mood;

            $new_mood->save();
        }
    }
}
