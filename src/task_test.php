<?php

use TaskForce\Task;

$task = new Task(1,1);
$this->assertEquals(1, $task->buyer_id);

assert($task->buyer_id == 1, 'buyer id');
