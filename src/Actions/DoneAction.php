<?php


namespace TaskForce\Actions;

use TaskForce\Model\Task;


class DoneAction extends AbstractAction
{
    public function isAllowed($customer_id, $executor_id, $user_id): bool
    {
        return $customer_id === $user_id;
    }

    public static function getName(): string
    {
        return Task::ACTION_NAME[Task::ACTION_DONE];
    }

    public static function getSlug(): string
    {
        return Task::ACTION_DONE;
    }

}
