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
        DB::table('roles')->insert([
            'name' => 'reg_registrants',
            'display_name' => 'reg_registrants',
            'description' => 'reg_registrants'
        ]);
    }
}
