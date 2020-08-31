<?php
require('../vendor/autoload.php');
use TaskForce\Model\Task;
use TaskForce\Actions\CancelAction;

$task = new Task(Task::STATUS_NEW,1);
$cancel_action = new CancelAction;

assert($task->customer_id == 1, 'хранит id заказчика');
assert($task->getAction(1) == CancelAction::class, 'возвращает действие');
assert($task::status_map[CancelAction::class] == $task::STATUS_CANCEL, 'возвращает статус');
assert($cancel_action->getName() == 'Отменить', 'называет действие');
assert(Task::getNextStatus(CancelAction::class) == Task::STATUS_CANCEL, 'возвращает следующий статус');
assert($task->getAvailableActions(1) == [$cancel_action], 'возвращает доступные действия');

echo 'done';
