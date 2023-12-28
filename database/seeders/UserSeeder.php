<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
        $data = [];
        //
        for($i=0; $i < 3; $i++)
        {
            $firstname = $faker->firstName();
            $lastname = $faker->lastName();
            $data[] = [
                'branch_id' => $faker->numberBetween(1,7),
                'role' => $faker->numberBetween(1,3),
                'name' => $firstname . " " . $lastname,
                'email' => strtolower($firstname.$lastname."@gmail.com"),
                'phone_number' => $faker->phoneNumber(),
                'password' => Hash::make('password'),
                'flag_active' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        User::insert($data);


    }
}
