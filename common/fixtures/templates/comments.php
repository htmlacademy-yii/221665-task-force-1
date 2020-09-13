<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'text' => $faker->sentence(7),
    'score' => $faker->numberBetween(1, 5),
    'task_id' => $faker->numberBetween(1, 10),
];
