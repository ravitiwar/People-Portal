<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(\App\ConferenceRoom::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'room_id' => $faker->uuid,
        'booking_email' => $faker->unique()->safeEmail,
        'sitting' => rand(10,20),
        'current_status' =>\App\Utils\AppUtils::getRoomStatuses()[rand(0,1)]
    ];
});
