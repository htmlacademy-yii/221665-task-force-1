<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class TasksFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\Tasks';
    public $depends = [
        'common\fixtures\CitiesFixture',
        'common\fixtures\CategoriesFixture',
        'common\fixtures\StatusesFixture',
        'common\fixtures\UsersFixture'
    ];
}
