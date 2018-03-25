<?php

use Illuminate\Database\Seeder;

class PrioritysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'high',
            'medium',
            'low'
        ];
        for ($i=0; $i < sizeof($types); $i++) { 
             DB::table('prioritys')->insert([
                 'name' => $types[$i]
             ]);
        }
    }
}
