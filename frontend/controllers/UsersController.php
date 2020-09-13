<?php

namespace frontend\controllers;

use frontend\models\Users;
use frontend\models\UsersCategories;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        // TODO упростить запрос
        $usersCategoriesQuery = UsersCategories::find()->select('user_id')->distinct();
        $users = Users::find()->where(['id' => $usersCategoriesQuery])->all();
        return $this->render('index', ['users' => $users]);
    }
}
