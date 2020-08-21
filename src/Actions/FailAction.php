<?php


namespace TaskForce\Actions;

class FailAction extends AbstractAction
{
    public function isAllowed($customer_id, $executor_id, $user_id): bool
    {
        return $executor_id === $user_id;
    }

    public static function getName(): string
    {
        return 'Отказаться';
    }

    public static function getSlug(): string
    {
        return 'fail';
    }

}
