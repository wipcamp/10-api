<?php

use Illuminate\Database\Seeder;

class RoleTeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['ITIM', 'พี่ไอติม'],
            ['VICHAKARN', 'พี่วิชาการ'],
            ['SWATDIKARN', 'พี่สวัสดิการ'],
            ['LOCATION', 'พี่สถานที่'],
            ['MC', 'พี่MC'],
            ['WIPPER', 'พี่WIPPER']
        ];
        for ($i=0; $i < sizeof($roles); $i++) { 
             DB::table('role_teams')->insert([
                'name' => $roles[$i][0],
                'display_name' => $roles[$i][0],
                'description' => $roles[$i][1]
             ]);
        }
    }
}
