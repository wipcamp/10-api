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
            ['reg_registrants_passed', 'ผู้สมัครค่ายที่ได้รับการคัดเลือกแล้ว'],
            ['reg_registrants_cancelled', 'ผู้สมัครค่ายที่ได้รับการคัดเลือกแล้ว แต่ได้ขอสละสิทธิ์ไว้'],
            ['camp_campers', 'ผู้เข้าร่วมค่าย'],
            ['camp_staffs_junior', 'พี่ค่าย (ปี 1)'],
            ['camp_staffs_senior', 'พี่ค่าย (ปี 2 ขึ้นไป)'],
            ['camp_accountants', 'เจ้าหน้าที่บัญชี'],
            ['camp_auditors', 'เจ้าหน้าที่ตรวจสอบบัญชี'],
            ['camp_staffs_speacials', 'พี่ค่ายที่ access profile น้องได้'],
            ['camp_president_vice', 'รองประธานค่าย'],
            ['camp_president', 'ประธานค่าย'],
            ['sys_developer', 'ผู้พัฒนาระบบ'],
            ['sys_admin', 'ผู้ดูแลระบบ'],
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
