<?php

use Faker\Generator as Faker;

$factory->define(App\Job::class, function (Faker $faker) {
    return [
      'org_id' => 1,
      'user_id' => 1,
      'name' => $faker->secondaryAddress,
    ];
});
