<?php

namespace Database\Seeders;

use App\Models\images;
use  Database\Seeders\imageSeeder;
use Database\Seeders\userSeeder;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory(20)->create();
        // \App\Models\Role::create(["role_name"=>"User"]);
        // \App\Models\Role::create(["role_name"=>"Editor"]);
        // \App\Models\Role::create(["role_name"=>"Admin"]);
        // $this->call(imageSeeder::class);
        // $this->call(userSeeder::class);
    }
}
