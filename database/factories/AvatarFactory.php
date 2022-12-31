<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Avatar;
use App\AvatarList;
use Faker\Generator as Faker;

$factory->define(Avatar::class, function (Faker $faker) {
    return [
        'title' => 'Name avatar',
        'title_en' => $faker->word,
        'cover' => '/img/logo.png',
    ];
});

$factory->define(AvatarList::class, function (Faker $faker) {
    return [
        'title' => 'name avatar',
        'title_en' => $faker->word,
        'image' => '/img/logo.png',
    ];
});
