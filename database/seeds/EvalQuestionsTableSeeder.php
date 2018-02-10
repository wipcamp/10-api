<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class EvalQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $faker = Faker::create();
        for ($i=0; $i < 6; $i++) { 
            DB::table('eval_questions')->insert([
                'data' => $faker->text
            ]);
        }
    }
}
