<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TimetablesTableSeeder extends Seeder
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

            $date = '2018-06-' . $faker->numberBetween($min = 1, $max = 3);
            $hour = $faker->numberBetween($min = 10, $max = 20);
            $minute = $faker->numberBetween($min = 10, $max = 20);
            $long = $faker->numberBetween($min = 15, $max = 30);

            DB::table('timetables')->insert([
                'event' => $faker->sentence($nbWords = 2, $variableNbWords = true),
                'description' => $faker->text($maxNbChars = 50),
                'location' => $faker->sentence($nbWords = 2, $variableNbWords = true),
                'start_on' => $date . ' ' . $hour . ':' . $minute . ':00',
                'finish_on' => $date . ' ' . $hour . ':' . ($minute + $long) . ':00',
                'created_id' => $faker->numberBetween($min = 100000, $max = 100009),
                'role_team_id' => $faker->numberBetween($min = 1, $max = 6),
            ]);
        }
    }
}
