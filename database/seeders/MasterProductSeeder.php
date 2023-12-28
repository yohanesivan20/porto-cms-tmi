<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\MasterProduct;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MasterProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('id_ID');
        $data = [];

        //Generate 1000 Data Product
        for($i=0; $i< 1000; $i++)
        {
            $data[] = [
                'product_code' => "0" . $faker->unique()->numberBetween(1000,9000),
                'description' => $faker->unique()->words(2, true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        MasterProduct::insert($data);
    }
}
