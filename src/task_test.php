<?php
require('../vendor/autoload.php');
use TaskForce\Model\Task;

$task = new Task(Task::STATUS_NEW,1);
assert($task->customer_id == 1, 'хранит id заказчика');
assert($task->get_action(1) == Task::ACTION_CANCEL, 'возвращает действие');
assert(Task::ACTION_NAME[$task->get_action(1)] == 'Отменить', 'называет действие');
assert(Task::get_next_status($task->get_action(1)) == Task::STATUS_CANCEL, 'возвращает следующий статус');

echo 'done';
