<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\Mood;
use App\Models\Trip;
use Faker\Generator as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $trip_ids = Trip::all()->pluck('id')->all();
        $mood_ids = Mood::all()->pluck('id')->all();

        for ($i = 0; $i < 30; $i++) {
            $trip_id = $faker->randomElement($trip_ids);
            $user_id = Trip::find($trip_id)->user_id;

            $new_day = new Day();
            $new_day->trip_id = $faker->randomElement($trip_ids);
            $new_day->user_id = $user_id;
            $new_day->mood_id = $faker->optional(weight: 0.9)->randomElement($mood_ids);
            $new_day->title = $faker->sentence();
            $new_day->date = $faker->dateTime();
            $new_day->description = $faker->paragraph();

            $new_day->save();
        };
    }
}
