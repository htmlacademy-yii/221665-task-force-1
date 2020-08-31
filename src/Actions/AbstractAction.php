<?php

namespace TaskForce\Actions;

abstract class AbstractAction
{
    abstract public function isAllowed(int $customer_id, int $executor_id, int $user_id): bool;

    abstract public static function getName(): string;

    abstract public static function getSlug(): string;

}
