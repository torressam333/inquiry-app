<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use Illuminate\Support\Facades\DB;
use App\Answer;

class VoteablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Only delete the records for Questions
        DB::table('voteables')->delete();
        //Get all collections of user instances
        $users = User::all();
        $numberOfUsers = $users->count();
        //Down and Up vote values
        $votes = [-1, 1];

        foreach (Question::all() as $question) {
            for ($i = 0; $i < rand(1, $numberOfUsers); $i++) {
                //Choose a random user
                $user = $users[$i];
                //Randomly vote down or up (0 or 1)
                $user->voteQuestion($question, $votes[rand(0,1)]);
            }
        }

        foreach (Answer::all() as $answer) {
            for ($i = 0; $i < rand(1, $numberOfUsers); $i++) {
                //Choose a random user
                $user = $users[$i];
                //Randomly vote down or up (0 or 1)
                $user->voteAnswer($answer, $votes[rand(0,1)]);
            }
        }
    }
}
