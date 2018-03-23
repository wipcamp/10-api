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
            'มาก',
            'ธรรมดา',
            'น้อย'
        ];
        for ($i=0; $i < sizeof($types); $i++) { 
             DB::table('prioritys')->insert([
                 'name' => $types[$i]
             ]);
        }
    }
}
