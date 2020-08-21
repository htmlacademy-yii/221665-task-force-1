<?php


namespace TaskForce\Actions;

class CancelAction extends AbstractAction
{
    public function isAllowed($customer_id, $executor_id, $user_id): bool
    {
        return $customer_id === $user_id;
    }

    public static function getName(): string
    {
        return 'Отменить';
    }

    public static function getSlug(): string
    {
        return 'cancel';
    }

}
