<?php

namespace frontend\controllers;

use frontend\models\Users;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $users = Users::find()->all();
        return $this->render('index', ['users' => $users]);
    }

}
