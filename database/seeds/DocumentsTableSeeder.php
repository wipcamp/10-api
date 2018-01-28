<?php

use App\Models\Document;
use App\Models\DocumentType;
use App\Models\DocumentFormat;
use App\Models\Profile;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;


class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Specify how many rows are there to random.
         */
        $profile_random_ratio = rand(1,200) / 200;
        $profile_random_amount = ceil(Profile::count() * $profile_random_ratio);
        $document_type_random_ratio = rand(1,200) / 200;
        $document_type_random_amount = ceil(DocumentType::count() *
            $document_type_random_ratio);

        /*
         * Specify document type must not included bank payment slip.
         */
        $document_type_rule = [
            ['name', '!=', 'bank_payment_slip']
        ];

        /* 
         * Iterate Profile collection which randomized to create seeders.
         */
        foreach (Profile::inRandomOrder()->take($profile_random_amount)->get()
             as $profile) {
            foreach (DocumentType::where($document_type_rule)->inRandomOrder()
                ->take($document_type_random_amount)->get() as $document_type) {
                $faker = Faker::create();
                $document_format = DocumentFormat::inRandomOrder()->first();

                /* 
                 *Let the random number between -1 and 1 are meaning from the
                 * below.
                 * 
                 * -1: NULL
                 * 0: FALSE
                 * 1: TRUE
                 * 
                 * In the logic, it will insert NULL value instead -1. NULL
                 * value is the dafault value when user just upload a file. That
                 * means staff user is not verify those file yet. But afterward,
                 * that status will change to true or false after staff user
                 * verified.
                 */
                $is_approve = rand(-1,1);

                /* 
                 * If current document type is transcription record, force to
                 * use PDF for first row only.
                 */
                if ($document_type->name == 'transcription_record') {
                    $document_format_pdf = DocumentFormat::where([
                        'mime_type' => 'application/pdf'
                    ])->first();
                    
                    /* 
                     * Sometimes in seeder, Eloquent can't find PDF document
                     * format on the database. Let's Eloquent to re-randomize
                     * a possible format_id.
                     */
                    $document_format = $document_format_pdf 
                        ?: DocumentFormat::inRandomOrder()->first();
                }

                /*
                 * For path field in the document table. Before inserted, it
                 * will rename file as UUID and following by original extension
                 * and store only file name into the table. It's unnecessary to
                 * change extension follow by name field of document format
                 * table.
                 * 
                 * If is_approve is true,
                 * - It will insert date of document issued. In the business
                 *   logic, date picker should set default as date of
                 *   transaction created.
                 * If is_approve is not NULL,
                 * - Staff users should add approve reason.
                 */
                $data = [
                    'user_id' => $profile->user_id,
                    'type_id' => $document_type->id,
                    'format_id' => $document_format->id,
                    'path' => $faker->uuid. '.'. $document_format->name,
                    'issued_at' => $is_approve > 0
                        ? $faker->dateTimeBetween('-90 days', 'now') : null,
                    'is_approve' => $is_approve > -1 ? $is_approve : null,
                    'approve_reason' => $is_approve > -1
                        ? $faker->sentence(6, true) : null,
                ];

                Document::insert($data);
            }
        }
    }
}
