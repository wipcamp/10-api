<?php

use Illuminate\Database\Seeder;
use App\Models\DocumentType;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'profile_picture',
                'display_name' => 'รูปประจำตัว',
                'description' => 'รูปแสดงตัวตนของผู้สมัครค่าย โดยปกติรูปนี้จะเรียกมาจากบัญชีบุคคลที่สาม เช่น Facebook ซึ่งอาจจะอัปโหลดมาโดยตรงหรือไม่ก็ได้'
            ],
            [
                'name' => 'parental_authorization',
                'display_name' => 'หนังสือขออนุญาตจากผู้ปกครอง',
                'description' => 'เอกสารขออนุญาตจากผู้ปกครองให้สามารถเข้าร่วมกิจกรรมนี้ได้ ซึ่งสามารถพิมพ์ได้จากระบบ'
            ],
            [
                'name' => 'transcription_record',
                'display_name' => 'ระเบียนแสดงผลการเรียน',
                'description' => 'เอกสารที่ออกโดยสถานศึกษา ซึ่งแสดงถึงผลการเรียนตลอดหลักสูตรกระทั่งภาคการเรียนล่าสุด เช่น ปพ. 1'
            ],
            [
                'name' => 'bank_payment_slip',
                'display_name' => 'หลักฐานการชำระเงิน',
                'description' => 'เอกสารที่ออกโดยธนาคาร หรือผู้รับชำระค่าบริการที่กำหนดไว้ ซึ่งเป็นหลักฐานว่าได้ทำการโอนเงิน หรือชำระเงินเต็มจำนวนเรียบร้อยแล้ว'
            ],
        ];
        
        DocumentType::insert($data);
    }
}
