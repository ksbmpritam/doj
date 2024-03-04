<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            // RestaurantServicesTableSeeder::class,
            CategoryTableSeeder::class,
            FoodAttributeSeeder::class
            // Add other seeder classes if you have more data to seed
        ]);
    }
}
