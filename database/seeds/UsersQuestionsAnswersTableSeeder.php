<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersQuestionsAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('answers')->delete();
        DB::table('questions')->delete();
        DB::table('users')->delete();

        factory(App\User::class, 4)->create()->each(function ($user) {
            $user->question()
                ->saveMany(
                    factory(Question::class, rand(1,5))->make()
                )
                ->each(function($question){
                    $question->answers()
                        ->saveMany(
                            factory(Answer::class, rand(1,7))->make()
                        );
                });
        });
    }
}
