<?php

use Illuminate\Database\Seeder;

class ProblemTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'สุขภาพ',
            'การเรียน',
            'อาหาร',
            'สถานที่',
            'เข้าออกนอกค่าย',
            'แจ้งเพื่อทราบ'
        ];
        for ($i=0; $i < sizeof($types); $i++) { 
             DB::table('problem_types')->insert([
                 'name' => $types[$i]
             ]);
        }
    }
}
