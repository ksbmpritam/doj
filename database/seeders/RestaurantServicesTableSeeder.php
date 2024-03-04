<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RestaurantServicesTableSeeder extends Seeder
{
    public function run()
    {
        // Create an instance of Faker
        $faker = Faker::create();

        // Define the number of fake records you want to generate
        $numberOfRecords = 10;

        // Generate fake data and insert into the 'restaurant_services' table
        for ($i = 0; $i < $numberOfRecords; $i++) {
            DB::table('restaurant_services')->insert([
                'restaurant_id' => $faker->numberBetween(1, 20), // Replace 20 with the total number of restaurants you have
                'service_name' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
