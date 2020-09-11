<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->name,
    'email' => $faker->email,
    'address' => $faker->address,
    'phone' => substr($faker->e164PhoneNumber, 1, 11),
    'city_id' => $faker->numberBetween(1,10),
    'password' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
    'about' => $faker->sentence(7),
    'popularity' => $faker->numberBetween(1,100),
    'activity' => $faker->dateTime,

];