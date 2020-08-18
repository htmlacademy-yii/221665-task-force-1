<?php


namespace TaskForce\Model;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCEL = 'cancel';
    const STATUS_WORK = 'work';
    const STATUS_DONE = 'done';
    const STATUS_FAIL = 'fail';


    const ACTION_REPLY = 'reply';
    const ACTION_CANCEL = 'cancel';
    const ACTION_DONE = 'done';
    const ACTION_FAIL = 'fail';

    const CUSTOMER = 'customer';
    const EXECUTOR = 'executor';

    const STATUS_NAME = [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCEL => 'Отменено',
        self::STATUS_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAIL => 'Провалено',
    ];

    const ACTION_NAME = [
        self::ACTION_REPLY => 'Откликнуться',
        self::ACTION_CANCEL => 'Отменить',
        self::ACTION_DONE => 'Выполнено',
        self::ACTION_FAIL => 'Отказаться',
    ];

    const status_map = [
        self::ACTION_REPLY => self::STATUS_WORK,
        self::ACTION_CANCEL => self::STATUS_CANCEL,
        self::ACTION_DONE => self::STATUS_DONE,
        self::ACTION_FAIL => self::STATUS_FAIL,
    ];

    const action_map = [
        self::STATUS_NEW => [
            self::EXECUTOR => self::ACTION_REPLY,
            self::CUSTOMER => self::ACTION_CANCEL
        ],
        self::STATUS_CANCEL => null,
        self::STATUS_WORK => [
            self::CUSTOMER => self::ACTION_DONE,
            self::EXECUTOR => self::ACTION_FAIL
        ],
        self::STATUS_DONE => null,
        self::STATUS_FAIL => null,
    ];


    public function get_action($id)
    {
        $next_actions = self::action_map[$this->status];
        $user_status = $this->get_user_status($id);
        if ($next_actions && $user_status) {
            return $next_actions[$user_status];
        }
        return null;
    }

    public function get_user_status($id)
    {
        if ($id === $this->customer_id) {
            return self::CUSTOMER;
        }
        if ($id === $this->executor_id) {
            return self::EXECUTOR;
        }

        return null;
    }

    public static function get_next_status($action)
    {
        return self::status_map[$action];
    }

    public static function getStatusMap()
    {
        return self::ACTION_NAME;
    }

    public static function getActionMap()
    {
        return self::STATUS_NAME;
    }

    public $customer_id;
    public $executor_id;
    private $status;

    public function __construct($status, $customer_id, $executor_id = null)
    {
        $this->customer_id = $customer_id;
        $this->executor_id = $executor_id; // для новой задачи нам еще не известен исполнитель
        $this->status = $status;
    }

//    проект методов класса

    public function setResponse($response)
    {
        // регистрирует новый отклик к задаче
    }

    public function setStatus($status)
    {
        // устанавливает статус задачи
    }

    public function setExecutor($executor_id)
    {
        // устанавливает исполнителя задачи
    }

}
