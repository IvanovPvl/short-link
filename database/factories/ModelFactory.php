<?php

$factory->define(App\Models\Link::class, function (Faker\Generator $faker) {
    return [
        'link' => $faker->url,
        'short' => $faker->regexify('[A-Za-z0-9]{3}'),
        'created_at' => \Carbon\Carbon::now(),
    ];
});
