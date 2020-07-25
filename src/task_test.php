<?php

require('Task.php');

use TaskForce\Task;

$task = new Task(1,1);
assert($task->buyer_id == 1444, 'хранит buyer id');
assert(Task::action_map[Task::STATUS_CANCEL] == null, 'содержит status cancel');

echo 'done';
