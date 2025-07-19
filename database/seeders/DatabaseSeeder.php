<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(3)->create();
        //Run the seeder classes here in the database seeder
        $this->call([
            BlogSeeder::class,
            BlogSectionSeeder::class,
        ]);
    }
}
