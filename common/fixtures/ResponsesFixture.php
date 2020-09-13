<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class ResponsesFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\Responses';
    public $depends = [
        'common\fixtures\TasksFixture',
        'common\fixtures\StatusesFixture',
        'common\fixtures\UsersFixture'
    ];
}
