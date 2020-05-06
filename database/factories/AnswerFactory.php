<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        //True converts paragraphs into single string
        'body' => $faker->paragraphs(rand(3,7), true),
        //With the random() it plucks 1 random id
        'user_id' => App\User::pluck('id')->random(),
        'votes_count' => rand(0,9),


    ];
});
