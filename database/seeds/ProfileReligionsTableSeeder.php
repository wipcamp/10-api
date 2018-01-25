<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProfileReligionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $religions = ['พุธ', 'คริสต์', 'อิสลาม', 'อื่นๆ'];
        for ($i=0; $i < count($religions); $i++) { 
            DB::table('profile_religions')->insert([
                'name' => $religions[$i],
                'display_name' => $faker->word,
                'description' => $faker->text,
            ]);
        }
    }
}
