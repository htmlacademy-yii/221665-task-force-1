<?php


namespace TaskForce;

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

    const BUYER = 'buyer';
    const SELLER = 'seller';

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
            self::SELLER => self::ACTION_REPLY,
            self::BUYER => self::ACTION_CANCEL
        ],
        self::STATUS_CANCEL => null,
        self::STATUS_WORK => [
            self::BUYER => self::ACTION_DONE,
            self::SELLER => self::ACTION_FAIL
        ],
        self::STATUS_DONE => null,
        self::STATUS_FAIL => null,
    ];

    // из учебника не очевидно преимущество таких методов перед свойствами

    public static function get_action($status)
    {
        return self::action_map[$status];
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

    public $buyer_id;
    public $seller_id;
    private $status;

    public function __construct($buyer_id, $seller_id)
    {
        $this->buyer_id = $buyer_id;
        $this->seller_id = $seller_id; // при создании задачи нам еще не известен исполнитель
        $this->status = self::STATUS_NEW;
    }

}
