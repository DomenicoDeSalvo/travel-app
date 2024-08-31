<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\Mood;
use App\Models\Stage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class StageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $day_ids = Day::all()->pluck('id')->all();
        $mood_ids = Mood::all()->pluck('id')->all();

        for ($i = 0; $i < 30; $i++) {
            $day_id = $faker->randomElement($day_ids);
            $user_id = Day::find($day_id)->user_id;

            $new_stage = new Stage();
            $new_stage->day_id = $faker->randomElement($day_ids);
            $new_stage->user_id = $user_id;
            $new_stage->mood_id = $faker->optional(weight: 0.9)->randomElement($mood_ids);
            $new_stage->title = $faker->sentence();
            $new_stage->thumb = $faker->optional(weight: 0.9)->imageUrl();
            $new_stage->description = $faker->paragraph();

            $new_stage->save();
        };
    }
}
