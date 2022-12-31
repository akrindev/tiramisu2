<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'provider_id' => '1488304441314963', // secret
        'remember_token' => str_random(10),
        'username' => $faker->name,
        'biodata' => str_random(40),
        'link' => '-',
        'alamat' => $faker->address,
    ];
});
