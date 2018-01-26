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
                'password' => $faker->password,
                'validation_code' => $faker->word,
                'validation_status' => $faker->boolean,
                'remember_token' => $faker->sha1
            ]);
        }
    }
}
