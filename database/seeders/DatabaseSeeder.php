<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            MoodSeeder::class,
            UserSeeder::class,
            TripSeeder::class,
            DaySeeder::class,
            StageSeeder::class,
            NoteSeeder::class,
            StageImageSeeder::class
        ]);
    }
}
