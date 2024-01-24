<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

use App\Models\images;

class imageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for($i=0;$i<1000;$i++){
            $images =  new images;
            $images->imagePath = $faker->imageUrl;
            $images->updated_at=$faker->time;
            $images->created_at=$faker->dateTime;

            $images->save();

        }
    }
}
