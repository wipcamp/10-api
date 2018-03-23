<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AnnouncesTableSeeder extends Seeder
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
             DB::table('announces')->insert([
                 'topic' => $faker->sentence($nbWords = 8, $variableNbWords = true),
                 'description' => $faker->text($maxNbChars = 300),
                 'creater_id' => $faker->numberBetween($min = 100000, $max = 100009),
                 'role_team_id' => $faker->numberBetween($min = 2, $max = 6)
             ]);
        }
    }
}
