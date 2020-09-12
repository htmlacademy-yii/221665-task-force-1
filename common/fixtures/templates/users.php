<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */
return [
    'name' => $faker->name,
    'email' => $faker->email,
    'phone' => substr($faker->e164PhoneNumber, 1, 11),
    'skype' => $faker->domainWord,
    'telegram' => $faker->domainWord,
    'city_id' => $faker->numberBetween(1,10),
    'password' => Yii::$app->getSecurity()->generatePasswordHash('password_' . $index),
    'about' => $faker->sentence(7),
    'popularity' => $faker->numberBetween(1,100),
    'activity' => $faker->dateTime()->format('Y-m-d H:i:s'),
    'birthday' => $faker->date(),
];