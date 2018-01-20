<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $blood_group = ['A', 'B', 'O', 'AB', 'อื่นๆ'];
        $faker = Faker::create();
        for ($i=0; $i < 10; $i++) { 
             DB::table('profiles')->insert([
                 'first_name' => $faker->firstName($gender = null|'male'|'female'),
                 'last_name' => $faker->lastName,
                 'first_name_en' => $faker->firstName($gender = null|'male'|'female'),
                 'last_name_en' => $faker->lastName,
                 'nickname' => $faker->word,
                 'gender_id' => $faker->numberBetween($min = 1, $max = 2),
                 'citizen_id' => $faker->nationalIdNumber,
                 'religion_id' => $faker->numberBetween($min = 1, $max = 4),
                 'birth_at' => $faker->date($format = 'Y-m-d', $max = '1999-12-31'),
                 'blood_group' => $blood_group[$faker->numberBetween($min = 1, $max = 5)],
                 'congenital_diseases' => $faker->word,
                 'allergic_foods' => $faker->word,
                 'congenital_drugs' => $faker->word
             ]);
        }
    }
}
