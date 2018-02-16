<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['reg_registrants', 'ผู้สมัครค่าย'],
            ['camp_staffs_junior', 'พี่ค่าย (ปี 1)'],
            ['camp_staffs_senior', 'พี่ค่าย (ปี 2 ขึ้นไป)'],
            ['camp_wipper', 'พี่ค่ายที่เข้าถึง wippo system ได้']
        ];
        for ($i=0; $i < sizeof($roles); $i++) { 
             DB::table('roles')->insert([
                'name' => $roles[$i][0],
                'display_name' => $roles[$i][0],
                'description' => $roles[$i][1]
             ]);
        }
    }
}
