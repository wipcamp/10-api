<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) { 
             DB::table('users')->insert([
                 'email' => $faker->email,
                 'password' => bcrypt($faker->password),
                 'validation_code' => $faker->password,
                 'validation_status' => $faker->numberBetween($min = 1, $max = 9),
                 'remember_token' => $faker->password,
             ]);
        }
    }
}
