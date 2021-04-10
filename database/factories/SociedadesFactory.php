<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Sociedade;
use Illuminate\Support\Str;
use Faker\Factory as Factory;

$factory->define(Sociedade::class, function () {
    $faker = Factory::create('es_ES');
    return [
        'name'=> $faker->company,
        'cif' => rand(11111111,99999999).substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,1), 
        'phone' => rand(11111111,99999999),
        'email' => $faker->unique()->safeEmail,
        'id_user' => 1,
        'user_name' => 'admin'
    ];
});
