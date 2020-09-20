<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class FavoritesFixture extends ActiveFixture
{
    public $modelClass = 'frontend\models\Favorites';
    public $depends = ['common\fixtures\UsersFixture'];
}
