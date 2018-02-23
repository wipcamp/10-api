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
            ProvidersTableSeeder::class,
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
            RolesTableSeeder::class,
            DocumentTypesTableSeeder::class,
            DocumentFormatsTableSeeder::class,
            DocumentsTableSeeder::class,
            RoleTeamsTableSeeder::class,
            TimetablesTableSeeder::class
        ]);
    }
}