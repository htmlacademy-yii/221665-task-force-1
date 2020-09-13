<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class UsersСategoriesFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\UsersCategories';
    public $depends = ['common\fixtures\UsersFixture', 'common\fixtures\CategoriesFixture'];
}
