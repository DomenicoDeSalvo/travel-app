<?php

namespace Database\Seeders;

use App\Models\Trip;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $user_ids = User::all()->pluck('id')->all();

        
        for ($i = 0; $i < 10; $i++) {
            $new_trip = new Trip();
            $new_trip->user_id = $faker->randomElement($user_ids);
            $new_trip->location = $faker->city();
            $new_trip->thumb = $faker->optional(weight: 0.9)->imageUrl();
            $new_trip->description = $faker->paragraph();
            $new_trip->start_date = $faker->dateTime();
            if ($faker->boolean(90)) {
                $new_trip->end_date = (clone $new_trip->start_date)->modify('+'. $faker->numberBetween(1, 30) .' days');
            } else {
                $new_trip->end_date = null;
            }
    
            $new_trip->save();
        };
    }
}
