<?php

namespace frontend\controllers;

use frontend\models\Users;
use frontend\models\UsersCategories;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $users = Users::find()->innerJoinWith('usersCategories')->groupBy('id')->all();
        return $this->render('index', ['users' => $users]);
    }
}
