<?php
require('../vendor/autoload.php');

use TaskForce\Fixtures\CsvParser;

$categories = new CsvParser('../data/categories.csv', ['icon' => 'icon', 'name' => 'title']);
$cities = new CsvParser('../data/cities.csv', ['city' => 'title']);
$users = new CsvParser('../data/users.csv', ['email' => 'email', 'name' => 'name', 'password' => 'password']);
$tasks = new CsvParser('../data/tasks.csv', [
    'description' => 'text',
    'category_id' => 'category_id',
    'expire' => 'deadline',
    'name' => 'title',
    'address' => 'address',
    'budget' => 'budget',
    'lat' => 'latitude',
    'long' => 'longitude',
]);

$profiles = new CsvParser('../data/profiles.csv', ['bd' => 'birthday', 'about' => 'about']);
$comments = new CsvParser('../data/opinions.csv', ['rate' => 'score', 'description' => 'text']);
$responses = new CsvParser('../data/replies.csv', ['description' => 'text']);
$statuses = new CsvParser('../data/statuses.csv', ['title' => 'title']);


try {
    $categories->import();
    $cities->import();
    $users->import();
    $tasks->import();
    $profiles->import();
    $comments->import();
    $responses->import();
    $statuses->import();
} catch (\Exception $e) {
    echo $e;
}

$users->addData('city_id', fn () => random_int(1, count($cities->getData())));
$users->addData('birthday', fn () => $profiles->getData()[array_rand($profiles->getData())]['bd']);
$users->addData('about', fn () => $profiles->getData()[array_rand($profiles->getData())]['about']);
$users->addData('skype', fn () => $profiles->getData()[array_rand($profiles->getData())]['skype']);

echo $users->getSQL('users').PHP_EOL;

$tasks->addData('city_id', fn () => random_int(1, count($cities->getData())));
$tasks->addData('customer_id', fn () => random_int(1, count($users->getData())));
$tasks->addData('status_id', fn () => random_int(1, count($statuses->getData())));

$comments->addData('task_id', fn () => random_int(1, count($tasks->getData())));

$responses->addData('task_id', fn () => random_int(1, count($tasks->getData())));
$responses->addData('user_id', fn () => random_int(1, count($users->getData())));
$responses->addData('price', fn () => random_int(1, 10000));
