<?php

use Illuminate\Database\Seeder;
use App\Models\DocumentFormat;

class DocumentFormatsTableSeeder extends Seeder
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
                'name' => 'jpeg',
                'mime_type' => 'image/jpeg',
                'display_name' => 'JPEG',
            ],
            [
                'name' => 'png',
                'mime_type' => 'image/png',
                'display_name' => 'PNG',
            ],
            [
                'name' => 'pdf',
                'mime_type' => 'application/pdf',
                'display_name' => 'PDF',
            ],
        ];
        
        DocumentFormat::insert($data);
    }
}
