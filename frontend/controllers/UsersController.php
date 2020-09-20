<?php

namespace frontend\controllers;

use frontend\models\UserForm;
use Yii;

class UsersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $form = new UserForm();
        $form->load(Yii::$app->request->post());
        $users = $form->getUsers();
        return $this->render('index', ['users' => $users, 'model' => $form]);
    }
}
