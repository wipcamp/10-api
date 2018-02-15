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
            ['freshmen', 'ปี 1'],
            ['sophomore', 'ปี 2 ขึ้นไป']
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
