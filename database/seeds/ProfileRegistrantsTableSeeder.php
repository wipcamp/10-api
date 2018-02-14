<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class ProfileRegistrantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $edu_lv = ['มัธยมศึกษาปีที่ 5', 'มัธยมศึกษาปีที่ 6', 'ประกาศนียบัตรวิชาชีพ ปี 1', 'ประกาศนียบัตรวิชาชีพ ปี 2'];
        $edu_major = ['วิทย์-คณิต', 'วิทย์-คอม', 'ศิลป์-คำนวน', 'ประกาศนียบัตรวิชาชีพ'];
        $parent_relation = ['บิดา', 'มารดา', 'อื่น ๆ'];
        $faker = Faker::create('ne_NP');
        for ($i=100000; $i < 100010; $i++) { 
            DB::table('profile_registrants')->insert([
                'user_id' => $i,
                'addr_prov' => $faker->cityName,
                'addr_dist' => $faker->district,
                'telno_personal' => '09912345678',
                'edu_name' => $faker->word,
                'edu_lv' => $edu_lv[$faker->numberBetween($min = 0, $max = 1)],
                'edu_major' => $edu_major[$faker->numberBetween($min = 0, $max = 3)],
                'edu_gpax' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 4),
                'known_via' => $faker->text,
                'activities' => $faker->text,
                'skill_computer' => $faker->text,
                'past_camp' => $faker->text,
                'parent_relation' => $parent_relation[$faker->numberBetween($min = 0, $max = 2)],
                'telno_parent' => '09912345678'
            ]);
        }
    }
}
