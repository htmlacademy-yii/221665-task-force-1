<?php


namespace TaskForce\Actions;

use TaskForce\Model\Task;


class ReplyAction extends AbstractAction
{
    public function isAllowed($customer_id, $executor_id, $user_id): bool
    {
        return $customer_id !== $user_id;
        // вот тут не понятно как проверить статус, без роли пользователя
    }

    public static function getName(): string
    {
        return Task::ACTION_NAME[Task::ACTION_REPLY];
    }

    public static function getSlug(): string
    {
        return Task::ACTION_REPLY;
    }

}
