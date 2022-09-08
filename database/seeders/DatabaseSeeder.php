<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Department::factory(1)->create();
         //\App\Models\User::factory(3)->create();
       // \App\Models\Role::factory(1)->create();
    }
}
