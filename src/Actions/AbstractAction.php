<?php

namespace TaskForce\Actions;

abstract class AbstractAction
{
    abstract public function isAllowed($customer_id, $executor_id, $user_id): bool;

    abstract public static function getName(): string;

    abstract public static function getSlug(): string;

}
