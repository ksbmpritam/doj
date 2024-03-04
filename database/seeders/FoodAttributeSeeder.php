<?php
// database/seeders/FoodAttributeSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FoodAttribute;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Storage;



class FoodAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate 30 fake food attributes
        FoodAttribute::factory()->count(30)->create();
    }
}


