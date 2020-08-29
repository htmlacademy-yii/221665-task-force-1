<?php


namespace TaskForce\Model;

use TaskForce\Actions\CancelAction;
use TaskForce\Actions\DoneAction;
use TaskForce\Actions\FailAction;
use TaskForce\Actions\ReplyAction;
use TaskForce\Actions\AbstractAction;

use TaskForce\Exception\TaskException;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_WORK = 'work';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'fail';

    const CUSTOMER = 'customer';
    const EXECUTOR = 'executor';

    const STATUS_NAME = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCEL => 'Отменено',
        self::STATUS_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAIL => 'Провалено',
    ];

    const status_map = [
        ReplyAction::class => self::STATUS_WORK,
        CancelAction::class => self::STATUS_CANCEL,
        DoneAction::class => self::STATUS_DONE,
        FailAction::class => self::STATUS_FAIL,
    ];

    const action_map = [
        self::STATUS_NEW => [
            self::EXECUTOR => ReplyAction::class,
            self::CUSTOMER => CancelAction::class
        ],
        self::STATUS_CANCEL => null,
        self::STATUS_WORK => [
            self::CUSTOMER => DoneAction::class,
            self::EXECUTOR => FailAction::class
        ],
        self::STATUS_DONE => null,
        self::STATUS_FAIL => null,
    ];


    public function getAction(int $id):?AbstractAction
    {
        $next_actions = self::action_map[$this->status];
        $user_status = $this->getUserStatus($id);
        if ($next_actions && $user_status) {
            return $next_actions[$user_status];
        }
        return null;
    }

    public function getUserStatus(int $id):?string
    {
        if ($id === $this->customer_id) {
            return self::CUSTOMER;
        }
        if ($id === $this->executor_id) {
            return self::EXECUTOR;
        }

        return null;
    }

    public static function getNextStatus(AbstractAction $action):string
    {
        if (!array_key_exists($action, self::status_map)) {
            throw new TaskException('invalid action');
        }
        return self::status_map[$action];
    }

    public function getAvailableActions(string $user_id):?array
    {
        $next_actions = self::action_map[$this->status];
        if (!$next_actions) {
            return null;
        }

        $available_actions = [];
        foreach ($next_actions as $next_action){
            $action = new $next_action;
            if($action->isAllowed($this->customer_id, $this->executor_id, $user_id)) {
                $available_actions[] = $action;
            }
        }

        return $available_actions;
    }

    public int $customer_id;
    public ?int $executor_id;
    private string $status;

    public function __construct(string $status, int $customer_id, ?int $executor_id = null)
    {
        $this->customer_id = $customer_id;
        $this->executor_id = $executor_id; // для новой задачи нам еще не известен исполнитель
        if (!self::STATUS_NAME[$status]) {
            throw new TaskException('invalid status');
        }
        $this->status = $status;
    }

//    проект методов класса

    public function setResponse($response):void
    {
        // регистрирует новый отклик к задаче
    }

    public function setStatus(string $status):void
    {
        if (!self::STATUS_NAME[$status]) {
            throw new TaskException('invalid status');
        }

        $this->status = $status;
    }

    public function setExecutor(int $executor_id):void
    {
        if ($this->$executor_id) {
            throw new TaskException('executor is already set');
        }

        if ($executor_id === $this->customer_id) {
            throw new TaskException('invalid user id');
        }

        $this->executor_id = $executor_id;
    }

}
