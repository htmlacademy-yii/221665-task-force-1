<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'text' => $faker->sentence(7),
    'status_id' => $faker->numberBetween(1, 3),
    'user_id' => $faker->numberBetween(1, 5),
    'task_id' => $faker->numberBetween(1, 10),
    'price' => $faker->numberBetween(1000, 10000),
    'created' => $faker->dateTimeBetween('-10 days')->format('Y-m-d H:m'),
];
