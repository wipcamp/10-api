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
        $blood_group = ['A', 'B', 'O', 'AB', 'อื่น ๆ'];
        $faker = Faker::create();
        $fakerPerson = Faker::create('ar_SA');
        for ($i=1; $i < 11; $i++) { 
             DB::table('profiles')->insert([
                 'user_id' => $i,
                 'first_name' => $faker->firstNameMale,
                 'last_name' => $faker->lastName,
                 'first_name_en' => $faker->firstNameMale,
                 'last_name_en' => $faker->lastName,
                 'nickname' => $faker->word,
                 'gender_id' => $faker->numberBetween($min = 1, $max = 2),
                 'citizen_id' => $fakerPerson->nationalIdNumber,
                 'religion_id' => $faker->numberBetween($min = 1, $max = 4),
                 'birth_at' => $faker->date($format = 'Y-m-d', $max = '1999-12-31'),
                 'blood_group' => $blood_group[$faker->numberBetween($min = 0, $max = 4)],
                 'congenital_diseases' => $faker->word,
                 'allergic_foods' => $faker->word,
                 'congenital_drugs' => $faker->word
             ]);
        }
    }
}
