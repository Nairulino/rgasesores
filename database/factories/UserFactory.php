<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Factory as Factory;

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

$factory->define(User::class, function () {
    $faker = Factory::create('es_ES');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => Hash::make('pruebas1'),
        'remember_token' => Str::random(10),
        'cif' => $faker->dni,
        'phone' => rand(111111111,999999999),
        'description' => $faker->text,
        'img' => '/img/profile/default.png'
    ];
});
