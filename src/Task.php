<?php


namespace TaskForce;


// не нашел синтаксис для вычисляемого поля массива, пришлось так выкручиваться

const STATUS_NEW = 'new';
const STATUS_CANCEL = 'cancel';
const STATUS_WORK = 'work';
const STATUS_DONE = 'done';
const STATUS_FAIL = 'fail';


const ACTION_REPLY = 'reply';
const ACTION_CANCEL = 'cancel';
const ACTION_DONE = 'done';
const ACTION_FAIL = 'fail';


class Task
{
    const Status = [
        'NEW' => STATUS_NEW,
        'CANCEL' => STATUS_CANCEL,
        'WORK' => STATUS_WORK,
        'DONE' => STATUS_DONE,
        'FAIL' => STATUS_FAIL,
    ];

    const Action = [
        'REPLY' => ACTION_REPLY,
        'CANCEL' => ACTION_CANCEL,
        'DONE' => ACTION_DONE,
        'FAIL' => ACTION_FAIL,
    ];

    const status_title = [
        STATUS_NEW => 'Новое',
        STATUS_CANCEL => 'Отменено',
        STATUS_WORK => 'В работе',
        STATUS_DONE => 'Выполнено',
        STATUS_FAIL => 'Провалено',
    ];

    const action_title = [
        ACTION_REPLY => 'Откликнуться',
        ACTION_CANCEL => 'Отменить',
        ACTION_DONE => 'Выполнено',
        ACTION_FAIL => 'Отказаться',
    ];

    const status_map = [
        ACTION_REPLY => STATUS_WORK,
        ACTION_CANCEL => STATUS_CANCEL,
        ACTION_DONE => STATUS_DONE,
        ACTION_FAIL => STATUS_FAIL,
    ];

    const action_map = [
        STATUS_NEW => [ACTION_REPLY, ACTION_CANCEL],
        STATUS_CANCEL => null,
        STATUS_WORK => [ACTION_DONE, ACTION_FAIL],
        STATUS_DONE => null,
        STATUS_FAIL => null,
    ];

    public $buyer_id;
    public $seller_id;
    private $status;

    public function __construct($buyer_id, $seller_id)
    {
        $this->buyer_id = $buyer_id;
        $this->seller_id = $seller_id;
        $this->status = STATUS_NEW;
    }

}
