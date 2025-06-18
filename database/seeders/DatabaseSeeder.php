<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Call the DonutSeeder to seed the donuts table
        $this->call(DonutSeeder::class);
    }
}
