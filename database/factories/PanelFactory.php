<?php

use Faker\Generator as Faker;

$factory->define(App\Panel::class, function (Faker $faker) {
    return [
        'org_id' => 1,
        'job_id' => 1,
        'user_id' => 1,
        'circuit_count' => 40,
        'name' => $faker->numerify('Panel ####'),
        'info' => $faker->city,
    ];
});
