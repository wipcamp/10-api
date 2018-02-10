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
                'provider_id' => 1,
                'provider_acc' => $faker->numerify('################'),
                'account_name' => $faker->name,
                'access_token' => '',
                'expired_in' => 7500
            ]);
        }
    }
}
