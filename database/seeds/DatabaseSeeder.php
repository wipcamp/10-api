<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ProblemTypesTableSeeder::class,
            ProblemsTableSeeder::class,
            ProfileGendersTableSeeder::class,
            ProfileReligionsTableSeeder::class,
            ProfilesTableSeeder::class,
            ProfileRegistrantsTableSeeder::class,
            CampsTableSeeder::class,
            EvalQuestionsTableSeeder::class,
            EvalAnswersTableSeeder::class,
            DocumentTypesTableSeeders::class,
            DocumentFormatsTableSeeders::class,
            DocumentsTableSeeders::class
        ]);
    }
}