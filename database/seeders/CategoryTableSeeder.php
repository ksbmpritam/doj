<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        // Create an instance of Faker
        $faker = Faker::create();

        // Define the number of fake categories you want to generate
        $numberOfCategories = 5;

        // Generate fake data and insert into the 'categories' table
        for ($i = 0; $i < $numberOfCategories; $i++) {
            $categoryImage = $this->getRandomCategoryImage();
            DB::table('category')->insert([
                'name' => $faker->word,
                'description' => $faker->sentence,
                'images' => $categoryImage,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

   private function getRandomCategoryImage()
    {
        // Assuming you have category images in the 'storage/app/public/images/categories' directory
        // You can adjust this array with the names of your category images
        $categoryImages = [
            'image1.jpg',
            'image2.jpg',
            'image3.jpg',
            // Add more image names as needed
        ];
    
        $randomImage = $categoryImages[array_rand($categoryImages)];
    
        // Use the storage disk to get the public URL for the image
        $publicImagePath = 'images/categories/' . $randomImage;
        $storagePath = 'public/' . $publicImagePath;
    
        if (Storage::exists($storagePath)) {
            return $publicImagePath;
        }
    
        return null; // Return null if the image doesn't exist
    }

}
