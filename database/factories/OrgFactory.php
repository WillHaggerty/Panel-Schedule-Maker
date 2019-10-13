<?php

use Faker\Generator as Faker;

$factory->define(App\Org::class, function (Faker $faker) {
    return [
        // 'owner_id' => function() {
        //   return factory(App\User::class)->create()->id;
        // },
        'owner_id' => 1,
        'name' => $faker->company,
        'email' => $faker->safeEmail,
        'phone' => $faker->tollFreePhoneNumber,
    ];
});
