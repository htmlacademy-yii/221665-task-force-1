<?php


namespace TaskForce\Actions;

use TaskForce\Model\Task;


class CancelAction extends AbstractAction
{
    public function isAllowed($customer_id, $executor_id, $user_id): bool
    {
        return $executor_id === $user_id;
    }

    public static function getName(): string
    {
        return Task::ACTION_NAME[Task::ACTION_CANCEL];
    }

    public static function getSlug(): string
    {
        return Task::ACTION_CANCEL;
    }

    public static function getNextStatus(): string
    {
        return Task::STATUS_CANCEL;
    }

}
