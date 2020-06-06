<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Question;

$factory->define(Question::class, function (Faker $faker) {
    return [
        //Define db columns you want fake data generated for
        'title'=> rtrim($faker->sentence(rand(5,10)), "."),
        'body' => $faker->paragraphs(rand(3,7), true),
        'views' => rand(0,11),
        'votes_count' => rand(-4,11),
    ];
});
