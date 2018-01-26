<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CampsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $carbon = new Carbon();
        DB::table('camps')->insert([
            'season' => 10,
            'theme_name' => 'รามเกียรติ์',
            'description' => 'ค่ายไอทีบางมด',
            'opened_at' => $carbon->create(2018, 2, 1, 0, 0, 0),
            'closed_at' => $carbon->create(2018, 3, 1, 0, 0, 0),
            'annouced_at' => $carbon->create(2018, 3, 7, 0, 0, 0),
            'started_at' => $carbon->create(2018, 4, 25, 0, 0, 0),
            'ended_at' => $carbon->create(2018, 4, 29, 0, 0, 0),
            'created_at' => $carbon->now(),
            'updated_at' => $carbon->now()
        ]);

    }
}
