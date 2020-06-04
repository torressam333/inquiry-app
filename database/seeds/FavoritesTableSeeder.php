<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Question;
use Illuminate\Support\Facades\DB;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Ensures we have no duplicate records when we run seeder individually
        DB::table('favorites')->delete();
        //Get all user id's
        $users = User::pluck('id')->all();
        //Count all users
        $numberOfUsers = count($users);
        //Iterate through questions
        foreach (Question::all() as $question)
        {
            //Make every question to be favorited by at least one user
            for ($i = 0; $i < rand(1, $numberOfUsers); $i++) {
                $user = $users[$i]; //Get random user
                //Attach current question to random user
                $question->favorites()->attach($user);

            }
        }
    }
}
