<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'status_id' => $faker->numberBetween(1, 3),
    'title' => $faker->sentence(3),
    'text' => $faker->sentence(7),
    'category_id' => $faker->numberBetween(1, 5),
    'customer_id' => $faker->numberBetween(1, 5),
    'executor_id' => $faker->numberBetween(1, 5),
    'address' => $faker->address,
    'city_id' => $faker->numberBetween(1, 10),
    'longitude' =>$faker->longitude,
    'latitude' =>$faker->latitude,
    'budget' => $faker->numberBetween(1000, 10000),
    'deadline' => $faker->dateTimeBetween('10 days', '20 days')->format('Y-m-d H:m'),
    'created' => $faker->dateTimeBetween('-10 days')->format('Y-m-d H:m'),
];
