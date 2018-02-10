<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class EvalAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for ($i=10000; $i < 10010; $i++) { 
            DB::table('eval_answers')->insert([
                'user_id' => $i,
                'question_id' => $faker->numberBetween($min = 1, $max = 6),
                'data' => $faker->text
            ]);
        }
    }
}
