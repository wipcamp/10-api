<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProfileGendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $sex = ['ชาย', 'หญิง'];
        for ($i=0; $i < 2; $i++) {
            DB::table('profile_genders')->insert([
                'name' => $sex[$i],
                'display_name' => $faker->word,
                'description' => $faker->text,
            ]);
        }
    }
}
