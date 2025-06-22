<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonutSeeder extends Seeder
{
    public function run()
    {
         DB::table('donuts')->insert([
            [ 'name' => 'Moonlit Meringue',    'seal_of_approval' => 4, 'price' => 8.0, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Unicorn Rainbow',     'seal_of_approval' => 5, 'price' => 9.5, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Starlight Sprinkle',  'seal_of_approval' => 3, 'price' => 7.0, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Sunfire Glaze',       'seal_of_approval' => 5, 'price' => 8.5, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Dragon’s Breath',      'seal_of_approval' => 4, 'price' => 9.0, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Velvet Crème',        'seal_of_approval' => 2, 'price' => 6.5, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Aurora Swirl',        'seal_of_approval' => 4, 'price' => 8.2, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Midnight Cocoa',      'seal_of_approval' => 3, 'price' => 7.8, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Royal Raspberry',     'seal_of_approval' => 5, 'price' => 9.2, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Lemon Mist',          'seal_of_approval' => 3, 'price' => 7.3, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Caramel Crown',       'seal_of_approval' => 4, 'price' => 8.7, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Cherry Blossom',      'seal_of_approval' => 2, 'price' => 6.9, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Mint Majesty',        'seal_of_approval' => 5, 'price' => 9.1, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Berry Bliss',         'seal_of_approval' => 3, 'price' => 7.5, 'created_at' => '2025-06-12 10:13:15'],
            [ 'name' => 'Golden Honeycomb',    'seal_of_approval' => 4, 'price' => 8.4, 'created_at' => '2025-06-12 10:13:15'],
        ]);
    }
}
