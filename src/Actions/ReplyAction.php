<?php


namespace TaskForce\Actions;

class ReplyAction extends AbstractAction
{
    public function isAllowed($customer_id, $executor_id, $user_id): bool
    {
        return $customer_id !== $user_id;
    }

    public static function getName(): string
    {
        return 'Откликнуться';
    }

    public static function getSlug(): string
    {
        return 'reply';
    }

}
