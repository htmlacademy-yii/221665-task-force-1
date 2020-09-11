<?php

namespace frontend\controllers;

use frontend\models\Users;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
