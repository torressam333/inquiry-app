<?php

use App\Answer;
use App\Question;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Seeders to call
       $this->call([
           UsersQuestionsAnswersTableSeeder::class,
           FavoritesTableSeeder::class,
           VoteablesTableSeeder::class
       ]);
    }
}
