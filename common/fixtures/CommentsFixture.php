<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class CommentsFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\Comments';
    public $depends = [
        'common\fixtures\TasksFixture',
    ];
}
