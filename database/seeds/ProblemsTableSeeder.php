<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProblemsTableSeeder extends Seeder
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
             DB::table('problems')->insert([
                 'topic' => $faker->sentence($nbWords = 8, $variableNbWords = true),
                 'problem_type_id' => $faker->numberBetween($min = 1, $max = 6),
                 'description' => $faker->text($maxNbChars = 300),
                 'report_id' => $faker->numberBetween($min = 10000, $max = 10009),
                 'is_solve' => false,
                 'not_solve' => false
             ]);
        }
    }
}
