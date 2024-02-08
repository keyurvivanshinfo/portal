<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            $user =  new User;
            $user->fname = $faker->firstName;
            $user->lname = $faker->lastName;
            $user->username = $faker->userName;
            $user->email = $faker->email;
            $user->password = $faker->password;
            $user->save();
        }
    }
}
