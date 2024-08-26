<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        //
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);

        for ($i = 0; $i < 3; $i++) {
            $new_user = new User();
            $new_user->name = $faker->name();
            $new_user->email = $faker->email();
            $password = $faker->password();
            $new_user->password = Hash::make($password);
            $new_user->save();
        };
    }
}

